<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use App\Models\Profile;
use App\Services\FileUploadService;
use App\Services\PostService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostService::getAllPosts();

        return ResponseService::json($posts, "تم جلب جميع المنشورات بنجاح");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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
        $post = $post->with("reacts", "comments", "profile:id,firstname,lastname,avatar", "tags")->find($post->id);

        return ResponseService::json($post, "تم إنشاء المنشور بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        $post = $post->with("comments", "reacts", "tags", "profile:id,firstname,lastname,avatar");
        return ResponseService::json($post, "تم عرض المنشور بنجاح");
    }

    public function react(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $post->reacts()->syncWithoutDetaching([
            $request->profile_id => ["type" => $request->type]
        ]);
        $reacted = $post->reacts()->wherePivot("profile_id", "=", $request->profile_id)->first();
        return ResponseService::json($reacted, "تم التفاعل مع المنشور بنجاح");
    }
    public function unReact($postId, $profileId)
    {
        $post = Post::findOrFail($postId);
        $post->reacts()->detach($profileId);
        $reacted = $post->reacts()->wherePivot("profile_id", "=", $profileId)->first();
        return ResponseService::json($reacted, "تم التفاعل مع المنشور بنجاح");
    }

    public function isReacted($postId, $profileId)
    {
        $post = Post::findOrFail($postId);
        $reacted =  $post->reacts()->wherePivot("profile_id", "=", $profileId)->first();

        if ($reacted != null)
            $reacted = $reacted->pivot->type;

        return ResponseService::json($reacted, "تمت العملية بنجاح");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $data = $request->all();
        if ($request->file("photo") != null) {
            $data["photo"] = FileUploadService::uploadImage($request->file("photo"), "/images/posts");
            FileUploadService::deleteImageIfExists(public_path($post->photo));
        } else
            $data["photo"] = $post->photo;
        $post->update($data);
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
        FileUploadService::deleteImageIfExists(public_path($post->photo));

        $post->delete();

        return ResponseService::json($post, "تم حذف المنشور بنجاح");
    }
}
