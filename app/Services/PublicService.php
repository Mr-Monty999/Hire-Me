<?php

namespace App\Services;

use App\Models\Post;
use App\Models\Profile;
use phpDocumentor\Reflection\Types\Self_;

/**
 * Class PublicService.
 */
class PublicService
{

    public static function search($type, $pattern)
    {
        $result = null;
        if ($type == "users")
            $result = UserService::searchForUser($pattern);
        else if ($type == "posts")
            $result = PostService::searchForPost($pattern);
        else if ($type == "jobs")
            $result = JobService::searchForJob($pattern);

        return $result;
    }
}
