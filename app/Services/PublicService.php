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

    public static function search($pattern)
    {
        // $result = self::searchForProfile($pattern);
        $result = PostService::searchForPost($pattern);
        return $result;
    }
}
