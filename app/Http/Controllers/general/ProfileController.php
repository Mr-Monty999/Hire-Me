<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRquest;
use App\Http\Resources\ProfileResource;
use App\Models\Post;
use App\Models\Profile;
use App\Models\ProfilePhone;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Profile::with("phones", "skills", "experiences", "posts")->get();
        return ResponseService::json($data, "تم جلب البيانات بنجاح");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileStoreRequest $request)
    {
        $request->validated();
        Profile::create($request->all());

        return ResponseService::json($request->all(), "تم اضافة الملف الشخصي");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $profile = Profile::with([
            "phones",
            "skills",
            "experiences",
            // "posts" => function ($q) {
            //     $q->latest();
            // },
            // "posts.comments.replies",
            // "posts.profile:id,firstname,lastname,avatar",
            // "posts.reacts",
            // "posts.tags",
            "user",
            "followers" => function ($q) {
                $q->paginate(5);
            },
            "followings" => function ($q) {
                $q->paginate(5);
            }
        ])->find($id);
        // $data = $profile;
        $profile["followersCount"] = $profile->followers()->count();
        $profile["followingsCount"] = $profile->followings()->count();

        return ResponseService::json($profile, "تم جلب البيانات بنجاح");
    }

    public function showProfileOnly($id)
    {

        $profile = Profile::find($id);
        return ResponseService::json($profile, "تم جلب البيانات بنجاح");
    }

    public function showPhones($profileId)
    {
        $phones =  Profile::with("phones")->find($profileId)->only("phones");
        // $phones = ProfilePhone::where("profile_id", $profileId)->get();

        return ResponseService::json($phones, "تم جلب أرقام الهواتف بنجاح");
    }
    public function showPosts($profileId)
    {
        $posts =  Post::with("comments", "reacts", "profile:id,firstname,lastname,avatar", "tags")->where("profile_id", $profileId)->latest()->paginate(5);

        return ResponseService::json($posts, "تم جلب المنشورات بنجاح");
    }
    public function followProfile($myProfileId, $targetProfileId)
    {
        $profile = Profile::findOrFail($myProfileId);
        $profile->followings()->syncWithoutDetaching($targetProfileId);
        return ResponseService::json($profile, "تم المتابعة بنجاح");
    }
    public function unFollowProfile($myProfileId, $targetProfileId)
    {
        $profile = Profile::findOrFail($myProfileId);
        $profile->followings()->detach($targetProfileId);
        return ResponseService::json($profile, "تم إلغاء المتابعة بنجاح");
    }
    public function isFollowed($myProfileId, $targetProfileId)
    {
        $profile = Profile::findOrFail($myProfileId);
        $exist =  $profile->followings()->wherePivot("profile2_id", "=", $targetProfileId)->exists();
        return ResponseService::json($exist, "تمت العملية بنجاح");
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //




    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRquest $request, $id)
    {


        $data = $request->all();
        $profile = Profile::where("user_id", $id)->first();
        if ($request->file("avatar") != null) {
            $data["avatar"] = FileUploadService::uploadImage($request->file("avatar"), "/images/profiles");
            FileUploadService::deleteImageIfExists(public_path($profile->avatar));
        } else
            $data["avatar"] = $profile->avatar;

        $profile->update($data);

        return ResponseService::json($profile, "تم حفظ الملف الشخصي بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = Profile::where("user_id", $id)->first();
        $profile->delete();
        return ResponseService::json($profile, "تم حذف الملف الشخصي بنجاح");
    }
}
