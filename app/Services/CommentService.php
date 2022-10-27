<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Gate;

/**
 * Class CommentService.
 */
class CommentService
{
    public static function store($data)
    {
        $comment = Comment::create($data);
        return $comment;
    }
    public static function update($commentId, $data)
    {
        unset($data["user_id"]);
        unset($data["post_id"]);

        $comment = Comment::find($commentId);
        Gate::authorize("update", $comment);

        $comment->update($data);
        return $comment;
    }
    public static function destroy($commentId)
    {
        $comment = Comment::find($commentId);
        Gate::authorize("delete", $comment);

        $comment->delete();
        return $comment;
    }
    public static function show($commentId)
    {
        $comment = Comment::with([
            "user.profile",
            "parentComment",
            "replies.user.profile" => function ($q) {
                $q->latest()->paginate(5);
            },
            "post"
        ])->withCount("replies")->find($commentId);
        return $comment;
    }

    public static function getAllComments()
    {
        $comments = Comment::with([
            "user.profile",
            "parentComment",
            "post",
        ])->withCount("replies")->get();
        return $comments;
    }
}
