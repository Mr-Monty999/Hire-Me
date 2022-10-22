<?php

namespace App\Services;

use App\Models\Post;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Auth;
use Hash;

/**
 * Class UserService.
 */
class UserService
{

    public static function login($request)
    {


        if (Auth::attempt($request->only(["email", "password"]), true)) {
            $data = Auth::user();
            $user = Auth::user();
            // $data["user_id"] = Auth::user()->user->id;
            // unset($data["user"]);
            $data["token"] = Auth::user()->createToken(uniqid("token_"))->plainTextToken;
            return $data;
        } else
            return false;
    }

    public static function register($data)
    {


        $data["password"] = bcrypt($data["password"]);
        $user = User::create($data);
        $data["user_id"] =  $user->id;
        $user["token"] = $user->createToken(uniqid("token_"))->plainTextToken;
        // $user["user_id"] = User::create($data)->id;
        $user->assignRole('user');

        return $user;
    }
    public static function logout()
    {
        // Auth::user()->tokens()->delete();

        $data = null;
        if (Auth::user() != null)
            $data = Auth::user();

        // Auth::logout();

        return $data;
    }

    public static function getAllUsers()
    {
        $users = User::all();
        return $users;
    }
    public static function showUserWithRelations($id)
    {
        $user = User::with([
            "phones",
            "skills",
            "experiences",
            "profile",
            // "posts" => function ($q) {
            //     $q->latest();
            // },
            // "posts.comments.replies",
            // "posts.user:id,firstname,lastname,avatar",
            // "posts.reacts",
            // "posts.tags",
            "followers" => function ($q) {
                $q->paginate(5);
            },
            "followings" => function ($q) {
                $q->paginate(5);
            }
        ])->withCount("followers", "followings")->find($id);

        return $user;
    }
    public static function showUserProfileOnly($id)
    {
        $user = User::find($id)->profile()->get();
        return $user;
    }
    public static function showPhones($userId)
    {
        // $phones =  User::with("phones")->find($userId)->only("phones");
        $phones = User::find($userId)->phones()->get();
        // $phones = UserPhone::where("user_id", $userId)->get();

        return $phones;
    }
    public static function showPosts($userId)
    {

        $posts =  Post::with([
            "comments",
            "reacts" => function ($q) {
                $q->latest()->paginate(5);
            },
            "user.profile",
            "tags"
        ])->withCount("reacts", "likes", "dislikes")->where("user_id", $userId)->latest()->paginate(5);

        // $posts["count"] = self::getPostsCount($userId);
        foreach ($posts as  $post) {
            $post->created_at_diff_for_humans = $post->created_at->diffForHumans();

            $react = $post->reacts()->where("user_id", "=", $userId)->first();
            if ($react)
                $post->react_type = $react->pivot->type;
            else
                $post->react_type = 0;
        }
        return $posts;
    }

    public static function getFeedPosts($userId)
    {

        $userIds = self::getFeedbackRelations($userId)->pluck("id")->push((int)$userId);

        $posts = Post::with([
            "comments.replies",
            "reacts" => function ($q) {
                $q->latest()->paginate(5);
            },
            "user.profile",
            "tags",
        ])->withCount("comments", "reacts", "tags", "likes", "dislikes")->whereIn("user_id", $userIds)->latest()->paginate(5);

        foreach ($posts as  $post) {
            $post->created_at_diff_for_humans = $post->created_at->diffForHumans();

            $react = $post->reacts()->where("user_id", "=", $userId)->first();
            if ($react)
                $post->react_type = $react->pivot->type;
            else
                $post->react_type = 0;
        }

        return $posts;
    }
    public static function getPostsCount($userId)
    {
        $count = Post::where("user_id", $userId)->count();
        return $count;
    }
    public static function followUser($request, $myUserId)
    {
        $user = User::findOrFail($myUserId);
        $user->followings()->syncWithoutDetaching($request->user_id);
        return $user;
    }

    public static function unFollowUser($myUserId, $targetUserId)
    {
        $user = User::findOrFail($myUserId);
        $user->followings()->detach($targetUserId);
        return $user;
    }
    public static function isFollowed($myUserId, $targetUserId)
    {
        $user = User::findOrFail($myUserId);
        $exist =  $user->followings()->wherePivot("user2_id", "=", $targetUserId)->exists();
        return $exist;
    }

    public static function sendConnectionRequest($userId, $targetUserId)
    {
        $user = User::find($userId);
        $user->connectionsTo()->syncWithoutDetaching([$targetUserId => ["accepted" => false]]);

        return $user;
    }
    public static function removeConnection($userId, $targetUserId)
    {
        $user = User::find($userId)->connectionsFrom()->detach($targetUserId);
        $user = User::find($userId)->connectionsTo()->detach($targetUserId);

        return $user;
    }

    public static function acceptConnectionRequest($userId, $targetUserId)
    {
        $user = User::find($userId)->connectionsFrom()->syncWithoutDetaching([$targetUserId => ["accepted" => true]]);
        $user = User::find($userId)->connectionsTo()->syncWithoutDetaching([$targetUserId => ["accepted" => true]]);

        return $user;
    }
    public static function getUserConnections($userId)
    {
        $connections = User::find($userId)->connectionsTo()->wherePivot("accepted", "=", true)->get();
        $connections->merge(User::find($userId)->connectionsFrom()->wherePivot("accepted", "=", true)->get());

        return $connections;
    }
    public static function getConnectionStatus($userId, $targetUserId)
    {
        $user = User::find($userId)->connectionsTo()->wherePivot("user2_id", $targetUserId)->first();

        return $user;
    }
    public static function getAllPendingConnections($userId)
    {
        $connections = User::find($userId)->connectionsTo()->wherePivot("accepted", "=", "false")->paginate(10);

        return $connections;
    }

    public static function getAllIncommingConnections($userId)
    {
        $connections = User::find($userId)->connectionsFrom()->wherePivot("accepted", "=", "false")->paginate(10);

        return $connections;
    }
    public static function getAllIncommingConnectionsCount($userId)
    {
        $count = User::find($userId)->connectionsFrom()->wherePivot("accepted", "=", "false")->count();

        return $count;
    }
    public static function searchForUser($pattern)
    {
        $pattern = trim($pattern);
        $pattern =   explode(" ", $pattern, 2);
        $result = null;
        if (isset($pattern[1])) {
            $result = User::withCount("followers", "followings")
                ->where("firstname", "LIKE", "%$pattern[0]%")
                ->where("lastname", "LIKE", "%$pattern[1]%")
                ->latest()
                ->paginate(5);
        } else {
            $result = User::withCount("followers", "followings")
                ->where("firstname", "LIKE", "%$pattern[0]%")
                ->latest()
                ->paginate(5);
        }

        return $result;
    }

    public static function getFeedbackRelations($userId)
    {
        $user = User::find($userId);
        $followings = $user->followings()->get();
        $connections = self::getUserConnections($userId);

        $relations =  $followings->merge($connections)->except($userId)->unique("id");

        return $relations;
    }
}
