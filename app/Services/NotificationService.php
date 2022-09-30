<?php

namespace App\Services;

use App\Models\Profile;
use App\Notifications\ConnectionRequestNotification;
use App\Notifications\CreatePostNotification;
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
            $value->data = $temp;
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
    public static function sendCreatePostNotification($data)
    {
        $profile = Profile::find($data["profile_id"]);
        $followings = $profile->followings()->get()->except($data["profile_id"]);
        $connections = ProfileService::getAllAcceptedConnections($data["profile_id"]);
        $targets =  $followings->merge($connections)->unique("id");

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

    public static function getProfileUnReadedNotificationsCount($profileId)
    {
        return Profile::find($profileId)->unreadNotifications()->count();
    }
}
