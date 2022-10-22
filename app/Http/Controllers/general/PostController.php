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
        $this->middleware("permission:create-posts")->only(["store"]);
        $this->middleware("permission:view-posts")->only(["index", "show"]);
        $this->middleware("permission:edit-posts")->only(["update"]);
        $this->middleware("permission:delete-posts")->only(["destroy"]);
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

        $data = $request->all();
        if ($request->file("photo") != null)
            $data["photo"] = FileUploadService::uploadImage($request->file("photo"), "/images/posts");

        $post = Post::create($data);
        $data["post_id"] = $post->id;
        NotificationService::sendCreatePostNotification($data);
        $post = PostService::getPost($post->id, Auth::user()->profile->id);

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

        $post = PostService::getPost($postId, Auth::user()->profile->id);
        return ResponseService::json($post, "تم عرض المنشور بنجاح");
    }



    public function react(Request $request, $postId)
    {
        $reacted = PostService::react($request, $postId);
        NotificationService::sendReactToPostNotification($request->all());
        return ResponseService::json($reacted, "تم التفاعل مع المنشور بنجاح");
    }
    public function unReact($postId, $profileId)
    {
        $reacted = PostService::unReact($postId, $profileId);
        return ResponseService::json($reacted, "تم التفاعل مع المنشور بنجاح");
    }

    public function isReacted($postId, $profileId)
    {
        $reacted = PostService::isReacted($postId, $profileId);
        return ResponseService::json($reacted, "تمت العملية بنجاح");
    }
    public function search($pattern)
    {
        $post = PostService::searchForPost($pattern);
        return ResponseService::json($post, "تمت العملية بنجاح");
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
