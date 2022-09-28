<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Profile;

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
}
