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

    public static function getPost($postId)
    {

        $post = Post::with(
            [
                "comments.replies",
                "reacts",
                "tags",
                "profile:id,firstname,lastname,avatar"
            ]
        )->withCount("reacts", "comments", "tags")->find($postId);
        return $post;
    }
    public static function react($request, $postId)
    {
        $post = Post::findOrFail($postId);
        $post->reacts()->syncWithoutDetaching([
            $request->profile_id => ["type" => $request->type]
        ]);
        $reacted = $post->reacts()->wherePivot("profile_id", "=", $request->profile_id)->first();
        return $reacted;
    }
    public static function unReact($postId, $profileId)
    {
        $post = Post::findOrFail($postId);
        $post->reacts()->detach($profileId);
        $reacted = $post->reacts()->wherePivot("profile_id", "=", $profileId)->first();
        return $reacted;
    }

    public static function isReacted($postId, $profileId)
    {
        $post = Post::findOrFail($postId);
        $reacted =  $post->reacts()->wherePivot("profile_id", "=", $profileId)->first();

        if ($reacted != null)
            $reacted = $reacted->pivot->type;

        return $reacted;
    }
}
