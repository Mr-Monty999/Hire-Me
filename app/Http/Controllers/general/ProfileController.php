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
use App\Notifications\SendConnectionRequestNotification;
use App\Services\FileUploadService;
use App\Services\NotificationService;
use App\Services\PostService;
use App\Services\ProfileService;
use App\Services\ResponseService;
use App\Services\UserService;
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
    public function __construct()
    {
        // $this->middleware("permission:create-profiles")->only(["store"]);
        $this->middleware("permission:view-profiles")->only(["index", "show"]);
        $this->middleware("permission:edit-profiles")->only(["update"]);
        // $this->middleware("permission:delete-profiles")->only(["destroy"]);
    }

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
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileStoreRequest $request)
    {
        $profile = ProfileService::store($request->all());

        return ResponseService::json($profile, "تم اضافة الملف الشخصي");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $profile = UserService::showUserWithRelations($id);

        return ResponseService::json($profile, "تم جلب البيانات بنجاح");
    }

    public function showUserProfileOnly($id)
    {

        $user = UserService::showUserProfileOnly($id);
        return ResponseService::json($user, "تم جلب البيانات بنجاح");
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


        $profile =   ProfileService::update($request, Profile::find($id));

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
        $profile = ProfileService::forceDelete(Profile::find($id));
        return ResponseService::json($profile, "تم حذف الملف الشخصي بنجاح");
    }
}
