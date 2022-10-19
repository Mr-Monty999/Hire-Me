<?php

namespace App\Services;

use App\Models\Job;
use App\Models\Post;
use App\Models\Profile;
use App\Notifications\ConnectionRequestNotification;
use App\Notifications\CreatePostNotification;
use App\Notifications\FollowNotification;
use App\Notifications\OfferJobNotification;
use App\Notifications\ReactToPostNotification;
use App\Notifications\SendConnectiondataNotification;
use App\Notifications\SendConnectionRequestNotification;
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

    public static function getProfileAllReceivedNotifications($profileId)
    {
        $notifications =  Profile::find($profileId)->notifications()->paginate(10);
        foreach ($notifications as $key => $value) {
            $temp = $value->data;
            $temp["profile"] = Profile::find($value->data["profile_id"]);
            if (isset($value->data["post_id"]))
                $temp["post"] = Post::find($value->data["post_id"]);
            if (isset($value->data["job_id"]))
                $temp["job"] = Job::find($value->data["job_id"]);

            $value->data = $temp;
            // $value->data->profile = Profile::find($value->data["profile_id"]);
        }
        return $notifications;
    }
    public static function readAllNotifications($profileId, $except = [])
    {
        $notifications = Profile::find($profileId)->unreadNotifications;
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
        $targets = ProfileService::getAllRelations($data["profile_id"]);
        Notification::send($targets, new CreatePostNotification($data));

        return true;
    }
    public static function sendReactToPostNotification($data)
    {

        if ($data["post_author"] != $data["profile_id"])
            Profile::find($data["post_author"])->notify(new ReactToPostNotification($data));

        return true;
    }
    public static function sendConnectionRequestNotification($data)
    {
        Profile::find($data["notifiable_id"])->notify(new ConnectionRequestNotification($data));
        return true;
    }
    public static function sendOfferJobNotification($data)
    {

        $targets = ProfileService::getAllRelations($data["profile_id"]);
        Notification::send($targets, new OfferJobNotification($data));

        return true;
    }
    public static function sendFollowNotification($data)
    {
        Profile::find($data["profile_id"])->notify(new FollowNotification($data));
        return true;
    }
    public static function getProfileUnReadedNotificationsCount($profileId)
    {
        return Profile::find($profileId)->unreadNotifications()->count();
    }
}
