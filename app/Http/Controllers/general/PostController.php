<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\Profile;
use App\Services\FileUploadService;
use App\Services\NotificationService;
use App\Services\PostService;
use App\Services\ResponseService;
use Auth;
use Gate;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("permission:create-posts|create-any-posts")->only(["store"]);
        $this->middleware("permission:view-posts|view-any-posts")->only(["index", "show"]);
        $this->middleware("permission:edit-posts|edit-any-posts")->only(["update"]);
        $this->middleware("permission:delete-posts|delete-any-posts")->only(["destroy"]);
    }

    public function index()
    {
        // return Auth::user();
        $posts = PostService::getAllPosts();

        return ResponseService::json($posts, "تم جلب جميع المنشورات بنجاح");
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
    public function store(PostStoreRequest  $request)
    {
        $post = PostService::store($request, Auth::id());

        return ResponseService::json($post, "تم إنشاء المنشور بنجاح", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($postId)
    {

        $post = PostService::getPost($postId, Auth::user()->id);
        return ResponseService::json($post, "تم عرض المنشور بنجاح");
    }



    public function react(Request $request, $postId)
    {

        $data = $request->all();
        $data["user_id"] = Auth::id();
        $reacted = PostService::react($data, $postId);
        NotificationService::sendReactToPostNotification($data);
        return ResponseService::json($reacted, "تم التفاعل مع المنشور بنجاح");
    }
    public function unReact($postId)
    {
        $userId = Auth::id();
        $reacted = PostService::unReact($postId, $userId);
        return ResponseService::json($reacted, "تم التفاعل مع المنشور بنجاح");
    }

    public function isReacted($postId, $userId)
    {
        $reacted = PostService::isReacted($postId, $userId);
        return ResponseService::json($reacted, "تمت العملية بنجاح");
    }
    public function search($pattern)
    {
        $post = PostService::searchForPost($pattern);
        return ResponseService::json($post, "تمت العملية بنجاح");
    }
    public static function getComments($postId)
    {

        $comments = PostService::getComments($postId);
        return ResponseService::json($comments);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        PostService::update($request, $post);

        return ResponseService::json($post, "تم تعديل المنشور بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        PostService::forceDelete($post);

        return ResponseService::json($post, "تم حذف المنشور بنجاح");
    }
}
