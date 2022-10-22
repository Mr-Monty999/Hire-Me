<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Profile;
use Auth;
use DB;
use Gate;
use Illuminate\Database\Eloquent\Collection;
use Notification;

/**
 * Class ProfileService.
 */
class ProfileService
{
    public static function update($request, $profile)
    {
        Gate::authorize("update", $profile);

        $data = $request->all();
        if ($request->file("avatar") != null) {
            $data["avatar"] = FileUploadService::uploadImage($request->file("avatar"), "/images/profiles");

            FileUploadService::deleteImageIfExists(public_path($profile->avatar));
        } else {
            $data["avatar"] = $profile->avatar;
        }

        $profile->update($data);
        return $profile;
    }

    public static function forceDelete($profile)
    {
        Gate::authorize("forceDelete", $profile);
        $profile->delete();
        return $profile;
    }
}
