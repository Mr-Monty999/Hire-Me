<?php

namespace App\Services;

use App\Models\Profile;
use App\Notifications\CreatePostNotification;
use App\Notifications\ReactToPostNotification;
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
    public static function readAllNotifications($profileId)
    {
        $notifications = Profile::find($profileId)->unreadNotifications;
        foreach ($notifications as  $value) {
            $value->markAsRead();
        }
    }
    public static function sendNotifications($request)
    {

        /*
        notifications types :
            1 = Posts notifications
            2 = Reacts notifcations
        */

        $profile = Profile::find($request->profile_id);
        $followings = $profile->followings()->get()->except($request->profile_id);
        $connetions = $profile->connectionsTo()->get()->except($request->profile_id);


        $targets =  $followings->merge($connetions)->unique("id");

        if ($request->type == 1)

            Notification::send($targets, new CreatePostNotification($request->all()));
        else if ($request->type == 2) {
            if ($request->post_author != $request->profile_id)
                Profile::find($request->post_author)->notify(new ReactToPostNotification($request->all()));
        }

        return $targets;
    }

    public static function getProfileUnReadedNotificationsCount($profileId)
    {
        return Profile::find($profileId)->unreadNotifications()->count();
    }
}
