<?php

namespace App\Services;

use Carbon\Carbon;
use DB;

/**
 * Class NotificationService.
 */
class NotificationService
{


    public static function getProfileReceivedNotificationsFromFollowings($profileId)
    {

        return DB::table("notifications")
            ->join(
                "profile_follow",
                "profile_follow.profile2_id",
                "=",
                "notifications.notifiable_id"
            )
            ->where("profile_follow.profile1_id", "=", $profileId)
            ->where("notifications.notifiable_id", "!=", $profileId)
            // ->whereRaw("notifications.created_at > profile_follow.created_at")
            ->orWhereNotNull("notifications.read_at")
            ->where("profile_follow.profile1_id", "=", $profileId)
            ->where("notifications.notifiable_id", "!=", $profileId)

            ->orderByDesc("notifications.created_at")
            ->get();
    }

    public static function getProfileReceivedNotificationsFromConnections($profileId)
    {

        return DB::table("notifications")
            ->join(
                "profile_connection",
                "profile_connection.profile2_id",
                "=",
                "notifications.notifiable_id"
            )
            ->where("profile_connection.profile1_id", "=", $profileId)
            ->where("notifications.notifiable_id", "!=", $profileId)
            ->orWhereNotNull("notifications.read_at")
            ->where("profile_connection.profile1_id", "=", $profileId)
            ->where("notifications.notifiable_id", "!=", $profileId)
            ->orderByDesc("notifications.created_at")
            ->get();
    }

    public static function getProfileAllReceivedNotifications($profileId)
    {
        $followingsNotifications = self::getProfileReceivedNotificationsFromFollowings($profileId);
        $connectionsNotifications = self::getProfileReceivedNotificationsFromFollowings($profileId);

        $merged = array_merge($followingsNotifications, $connectionsNotifications);
        return $merged;
    }

    public static function getProfileUnReadedNotificationsCount($profileId)
    {

        return DB::table("notifications")
            ->join(
                "profile_follow",
                "profile_follow.profile2_id",
                "=",
                "notifications.notifiable_id"
            )
            ->where("profile_follow.profile1_id", "=", $profileId)
            ->where("notifications.notifiable_id", "!=", $profileId)
            ->whereNull("notifications.read_at")

            ->orderByDesc("notifications.created_at")
            ->count();
    }
}
