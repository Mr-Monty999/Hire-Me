<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Services\CommentService;
use App\Services\NotificationService;
use App\Services\ResponseService;
use Auth;
use Illuminate\Http\Request;
use Notification;
use RateLimiter;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware("permission:create-comments|create-any-comments")->only(["store"]);
        $this->middleware("permission:view-comments|view-any-comments")->only(["index", "show"]);
        $this->middleware("permission:edit-comments|edit-any-comments")->only(["update"]);
        $this->middleware("permission:delete-comments|delete-any-comments")->only(["destroy"]);
        $this->middleware("throttle:20,1")->only("store");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = CommentService::getAllComments();
        return ResponseService::json($comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {

        $data = $request->all();
        $data["user_id"] = Auth::id();
        $comment = CommentService::store($data);
        $data["comment_id"] = $comment->id;
        if (isset($data["mention_id"])) {
            $data["notifiable_id"] = $data["mention_id"];
            NotificationService::sendMentionUserNotification($data);
        } else {
            $data["notifiable_id"] = $comment->post->user->id;
            NotificationService::sendCommentNotification($data);
        }
        return ResponseService::json($comment);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = CommentService::show($id);
        return ResponseService::json($comment);
    }
    public static function getReplies($commentId)
    {
        $replies = CommentService::getReplies($commentId);

        return ResponseService::json($replies);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, $id)
    {
        $comments = CommentService::update($id, $request->all());
        return ResponseService::json($comments);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comments = CommentService::destroy($id);
        return ResponseService::json($comments);
    }
}
