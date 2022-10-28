<?php

namespace App\Services;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Auth;
use Gate;

/**
 * Class CommentService.
 */
class CommentService
{
    public static function store($data)
    {
        $comment = Comment::create($data);
        $comment = self::show($comment->id);
        $comment->created_at_diff_for_humans = "الأن";

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
            "post"
        ])->withCount("replies")->find($commentId);
        $comment->created_at_diff_for_humans = $comment->created_at->diffForHumans();

        return $comment;
    }

    public static function getAllComments()
    {
        $comments = Comment::with([
            "user.profile",
            "parentComment",
            "post"
        ])->withCount("replies")->get();

        foreach ($comments as $comment) {
            $comment->created_at_diff_for_humans = $comment->created_at->diffForHumans();
        }
        return  $comments;
    }
    public static function getReplies($commentId)
    {
        $comments = Comment::with([
            "user.profile",
            // "parentComment",
            "post"
        ])->withCount("replies")
            ->where("comment_id", "=", $commentId)
            ->get();

        foreach ($comments as $comment) {
            $comment->created_at_diff_for_humans = $comment->created_at->diffForHumans();
        }
        return $comments;
    }
}
