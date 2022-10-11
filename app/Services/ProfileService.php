<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Profile;
use DB;
use Illuminate\Database\Eloquent\Collection;
use Notification;

/**
 * Class ProfileService.
 */
class ProfileService
{
    public static function showProfileWithRelations($id)
    {
        $profile = Profile::with([
            "phones",
            "skills",
            "experiences",
            // "posts" => function ($q) {
            //     $q->latest();
            // },
            // "posts.comments.replies",
            // "posts.profile:id,firstname,lastname,avatar",
            // "posts.reacts",
            // "posts.tags",
            "user",
            "followers" => function ($q) {
                $q->paginate(5);
            },
            "followings" => function ($q) {
                $q->paginate(5);
            }
        ])->withCount("followers", "followings")->find($id);
        // $data = $profile;

        return $profile;
    }
    public static function showProfileOnly($id)
    {
        $profile = Profile::find($id);
        return $profile;
    }

    public static function showPhones($profileId)
    {
        $phones =  Profile::with("phones")->find($profileId)->only("phones");
        // $phones = ProfilePhone::where("profile_id", $profileId)->get();

        return $phones;
    }
    public static function showPosts($profileId)
    {

        $posts =  Post::with([
            "comments",
            "reacts" => function ($q) {
                $q->latest()->paginate(1);
            },
            "profile:id,firstname,lastname,avatar",
            "tags"
        ])->where("profile_id", $profileId)->latest()->paginate(5);
        // $posts["count"] = self::getPostsCount($profileId);
        return $posts;
    }
    public static function getPostsCount($profileId)
    {
        $count = Post::where("profile_id", $profileId)->count();
        return $count;
    }
    public static function followProfile($request, $myProfileId)
    {
        $profile = Profile::findOrFail($myProfileId);
        $profile->followings()->syncWithoutDetaching($request->profile_id);
        return $profile;
    }

    public static function unFollowProfile($myProfileId, $targetProfileId)
    {
        $profile = Profile::findOrFail($myProfileId);
        $profile->followings()->detach($targetProfileId);
        return $profile;
    }
    public static function isFollowed($myProfileId, $targetProfileId)
    {
        $profile = Profile::findOrFail($myProfileId);
        $exist =  $profile->followings()->wherePivot("profile2_id", "=", $targetProfileId)->exists();
        return $exist;
    }

    public static function sendConnectionRequest($profileId, $targetProfileId)
    {
        $profile = Profile::find($profileId);
        $profile->connectionsTo()->syncWithoutDetaching([$targetProfileId => ["accepted" => false]]);

        return $profile;
    }
    public static function removeConnection($profileId, $targetProfileId)
    {
        $profile = Profile::find($profileId)->connectionsFrom()->detach($targetProfileId);
        $profile = Profile::find($profileId)->connectionsTo()->detach($targetProfileId);

        return $profile;
    }

    public static function acceptConnectionRequest($profileId, $targetProfileId)
    {
        $profile = Profile::find($profileId)->connectionsFrom()->syncWithoutDetaching([$targetProfileId => ["accepted" => true]]);
        $profile = Profile::find($profileId)->connectionsTo()->syncWithoutDetaching([$targetProfileId => ["accepted" => true]]);

        return $profile;
    }
    public static function getAllAcceptedConnections($profileId)
    {
        $connections = Profile::find($profileId)->connectionsTo()->wherePivot("accepted", "=", true)->get();
        $connections->merge(Profile::find($profileId)->connectionsFrom()->wherePivot("accepted", "=", true)->get());

        return $connections;
    }
    public static function getConnectionStatus($profileId, $targetProfileId)
    {
        $profile = Profile::find($profileId)->connectionsTo()->wherePivot("profile2_id", $targetProfileId)->first();

        return $profile;
    }
    public static function getAllPendingConnections($profileId)
    {
        $connections = Profile::find($profileId)->connectionsTo()->wherePivot("accepted", "=", "false")->paginate(10);

        return $connections;
    }

    public static function getAllIncommingConnections($profileId)
    {
        $connections = Profile::find($profileId)->connectionsFrom()->wherePivot("accepted", "=", "false")->paginate(10);

        return $connections;
    }
    public static function getAllIncommingConnectionsCount($profileId)
    {
        $count = Profile::find($profileId)->connectionsFrom()->wherePivot("accepted", "=", "false")->count();

        return $count;
    }
    public static function searchForProfile($pattern)
    {
        $pattern = trim($pattern);
        $pattern =   explode(" ", $pattern, 2);
        $result = null;
        if (isset($pattern[1])) {
            $result = Profile::withCount("followers", "followings")->where("firstname", "LIKE", "%$pattern[0]%")
                ->where("lastname", "LIKE", "%$pattern[1]%")
                ->get();
        } else {
            $result = Profile::withCount("followers", "followings")->where("firstname", "LIKE", "%$pattern[0]%")
                ->get();
        }

        return $result;
    }
}
