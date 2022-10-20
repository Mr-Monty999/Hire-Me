<?php

namespace App\Services;

use App\Models\Post;
use Auth;
use DB;
use Gate;

/**
 * Class PostService.
 */
class PostService
{

    public static function update($request, $post)
    {

        Gate::authorize("update", $post);

        $data = $request->all();
        if ($request->file("photo") != null) {
            $data["photo"] = FileUploadService::uploadImage($request->file("photo"), "/images/posts");
            FileUploadService::deleteImageIfExists(public_path($post->photo));
        } else
            $data["photo"] = $post->photo;
        $post->update($data);
        return $post;
    }
    public static function forceDelete($post)
    {
        Gate::authorize("forceDelete", $post);
        FileUploadService::deleteImageIfExists(public_path($post->photo));
        $post->delete();
        return $post;
    }
    public static function getAllPosts()
    {
        $profileId = Auth::user()->profile->id;
        $posts = Post::with([
            "comments.replies",
            "reacts" => function ($q) {
                $q->latest()->paginate(5);
            },
            "tags",
            "profile:id,firstname,lastname,avatar",
        ])->withCount("comments", "reacts", "tags", "likes", "dislikes")->latest()->paginate(5);

        foreach ($posts as  $post) {
            $post->created_at_diff_for_humans = $post->created_at->diffForHumans();

            $react = $post->reacts()->where("profile_id", "=", $profileId)->first();
            if ($react)
                $post->react_type = $react->pivot->type;
            else
                $post->react_type = 0;
        }


        return $posts;
    }


    public static function getPost($postId, $authProfileId)
    {

        $post = Post::with(
            [
                "comments.replies",
                "reacts" => function ($q) {
                    $q->latest()->paginate(5);
                },
                "tags",
                "profile:id,firstname,lastname,avatar"
            ]
        )->withCount(["reacts", "comments", "tags", "likes", "dislikes"])->find($postId);

        $post->created_at_diff_for_humans = $post->created_at->diffForHumans();
        $react = $post->reacts()->where("profile_id", "=", $authProfileId)->first();
        if ($react)
            $post->react_type = $react->pivot->type;
        else
            $post->react_type = 0;




        // $post["likes_counts"]  = $post->reacts()->wherePivot("type", "=", 1)->count();
        // $post["dislikes_counts"]  = $post->reacts()->wherePivot("type", "=", 2)->count();

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

    public static function searchForPost($content)
    {
        $content = trim($content);
        $result = Post::withCount("reacts", "likes", "dislikes")->where("content", "LIKE", "%$content%")
            ->get();

        return $result;
    }
}
