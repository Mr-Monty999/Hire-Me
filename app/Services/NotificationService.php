<?php

namespace App\Services;

use App\Models\Profile;
use App\Notifications\PostNotification;
use App\Notifications\ReactNotification;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;
use Laravel\Ui\Presets\React;
use PhpParser\ErrorHandler\Collecting;
use stdClass;

/**
 * Class NotificationService.
 */
class NotificationService
{





    public static function getProfileAllReceivedNotifications($profileId)
    {
        return Profile::find($profileId)->notifications()->get();
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
            Notification::send($targets, new PostNotification($request->all()));
        else if ($request->type == 2) {
            if ($request->post_author != $request->profile_id)
                Profile::find($request->post_author)->notify(new ReactNotification($request->all()));
        }

        return $targets;
    }

    public static function getProfileUnReadedNotificationsCount($profileId)
    {
        return Profile::find($profileId)->unreadNotifications()->count();
    }
}
