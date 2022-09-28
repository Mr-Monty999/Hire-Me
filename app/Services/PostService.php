<?php

namespace App\Services;

use App\Models\Post;

/**
 * Class PostService.
 */
class PostService
{

    public static function getAllPosts()
    {
        $posts = Post::with([
            "comments.replies",
            "reacts" => function ($q) {
                $q->latest()->paginate(5);
            },
            "tags",
            "profile:id,firstname,lastname,avatar",
        ])->withCount("comments", "reacts", "tags")->latest()->paginate(5);

        return $posts;
    }
}
