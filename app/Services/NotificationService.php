<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Job;
use App\Models\Post;
use App\Models\User;
use App\Notifications\ConnectionRequestNotification;
use App\Notifications\CreatePostNotification;
use App\Notifications\FollowNotification;
use App\Notifications\MentionUserNotification;
use App\Notifications\OfferJobNotification;
use App\Notifications\ReactToPostNotification;
use App\Notifications\SendCommentNotification;
use App\Notifications\SendCommentReplyNotification;
use App\Notifications\SendConnectiondataNotification;
use App\Notifications\SendConnectionRequestNotification;
use Auth;
use DB;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Laravel\Ui\Presets\React;
use PhpParser\ErrorHandler\Collecting;

/**
 * Class NotificationService.
 */
class NotificationService
{

    public static function getUserAllReceivedNotifications($userId)
    {
        $notifications =  User::find($userId)->notifications()->paginate(10);
        foreach ($notifications as $key => $value) {
            $temp = $value->data;
            $temp["profile"] = User::find($value->data["user_id"])->profile;
            if (isset($value->data["post_id"]))
                $temp["post"] = Post::find($value->data["post_id"]);
            if (isset($value->data["job_id"]))
                $temp["job"] = Job::find($value->data["job_id"]);
            if (isset($value->data["comment_id"]))
                $temp["comment"] = Comment::find($value->data["comment_id"]);
            if (isset($value->data["parent_comment_id"]))
                $temp["parent_comment"] = Comment::find($value->data["parent_comment_id"]);

            $value->data = $temp;
            // $value->data->user = User::find($value->data["user_id"]);
        }
        return $notifications;
    }
    public static function readAllNotifications($userId, $except = [])
    {
        $notifications = User::find($userId)->unreadNotifications;
        foreach ($notifications as  $value) {
            if (!in_array($value->type, $except))
                $value->markAsRead();
        }
    }
    public static function readNotification()
    {
    }
    public static function sendCreatePostNotification($data)
    {
        $user = User::find($data["user_id"]);
        $followers = $user->followers()->get();
        $connections = UserService::getUserConnections($data["user_id"]);
        $targets =  $followers->merge($connections)->except($data["user_id"])->unique("id");

        Notification::send($targets, new CreatePostNotification($data));

        return true;
    }
    public static function sendReactToPostNotification($data)
    {

        $notification =  DB::table("notifications")
            ->where("type", "=", "App\Notifications\ReactToPostNotification")
            ->where("notifiable_id", "=", $data["post_author"])
            ->whereJsonContains("data->post_id", $data["post_id"])
            ->whereJsonContains("data->user_id", $data["user_id"]);


        $notification->delete();

        if ($data["post_author"] != $data["user_id"])
            User::find($data["post_author"])->notify(new ReactToPostNotification($data));

        return true;
    }
    public static function sendConnectionRequestNotification($data)
    {
        User::find($data["notifiable_id"])->notify(new ConnectionRequestNotification($data));
        return true;
    }
    public static function sendOfferJobNotification($data)
    {

        $user = User::find($data["user_id"]);
        $followers = $user->followers()->get();
        $connections = UserService::getUserConnections($data["user_id"]);
        $targets =  $followers->merge($connections)->except($data["user_id"])->unique("id");

        Notification::send($targets, new OfferJobNotification($data));

        return true;
    }
    public static function sendFollowNotification($data)
    {
        User::find($data["notifiable_id"])->notify(new FollowNotification($data));
        return true;
    }
    public static function sendCommentNotification($data)
    {

        if ($data["notifiable_id"] != Auth::id())
            User::find($data["notifiable_id"])->notify(new  SendCommentNotification($data));
        return true;
    }
    public static function sendMentionUserNotification($data)
    {

        if ($data["notifiable_id"] != Auth::id())
            User::find($data["notifiable_id"])->notify(new MentionUserNotification($data));
        return true;
    }

    public static function getUserUnReadedNotificationsCount($userId)
    {
        return User::find($userId)->unreadNotifications()->count();
    }
}
