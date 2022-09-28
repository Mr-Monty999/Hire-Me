<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileFollowStoreRequest;
use App\Http\Requests\ProfileStoreRequest;
use App\Http\Requests\ProfileUpdateRquest;
use App\Http\Resources\ProfileResource;
use App\Models\Post;
use App\Models\Profile;
use App\Models\ProfilePhone;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\NotificationService;
use App\Services\ProfileService;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Notification;

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

        $profile = ProfileService::showProfileWithRelations($id);

        return ResponseService::json($profile, "تم جلب البيانات بنجاح");
    }

    public function showProfileOnly($id)
    {

        $profile = ProfileService::showProfileOnly($id);
        return ResponseService::json($profile, "تم جلب البيانات بنجاح");
    }

    public function showPhones($profileId)
    {
        $phones =  ProfileService::showPhones($profileId);
        // $phones = ProfilePhone::where("profile_id", $profileId)->get();

        return ResponseService::json($phones, "تم جلب أرقام الهواتف بنجاح");
    }
    public function showPosts($profileId)
    {
        $posts =  ProfileService::showPosts($profileId);

        return ResponseService::json($posts, "تم جلب المنشورات بنجاح");
    }
    public function followProfile(ProfileFollowStoreRequest $request, $myProfileId)
    {
        $profile = ProfileService::followProfile($request, $myProfileId);

        return ResponseService::json($profile, "تم المتابعة بنجاح");
    }
    public function unFollowProfile($myProfileId, $targetProfileId)
    {
        $profile = ProfileService::unFollowProfile($myProfileId, $targetProfileId);
        return ResponseService::json($profile, "تم إلغاء المتابعة بنجاح");
    }
    public function isFollowed($myProfileId, $targetProfileId)
    {
        $exist =  ProfileService::isFollowed($myProfileId, $targetProfileId);
        return ResponseService::json($exist, "تمت العملية بنجاح");
    }

    public function getNotifications($id)
    {

        $notifications = NotificationService::getProfileReceivedNotificationsFromFollowings($id);
        $data["notifications"] = $notifications;
        $data["unreaded_notifications_count"] = NotificationService::getProfileUnReadedNotificationsCount($id);
        return ResponseService::json($data, "تمت العملية بنجاح");
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
        } else {
            $data["avatar"] = $profile->avatar;
        }



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
