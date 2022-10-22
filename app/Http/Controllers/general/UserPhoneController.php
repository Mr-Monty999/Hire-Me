<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePhoneStoreRequest;
use App\Http\Requests\ProfilePhoneUpdateRequest;
use App\Models\Profile;
use App\Models\ProfilePhone;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class UserPhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware("permission:create-profiles-phones")->only(["store"]);
        $this->middleware("permission:view-profiles-phones")->only(["index", "show"]);
        $this->middleware("permission:edit-profiles-phones")->only(["update"]);
        $this->middleware("permission:delete-profiles-phones")->only(["destroy"]);
    }

    public function index($profileId)
    {
        $phones =  Profile::with("phones")->find($profileId)->only("phones");
        // $phones = ProfilePhone::where("profile_id", $profileId)->get();

        return ResponseService::json($phones, "تم جلب أرقام الهواتف بنجاح");
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
    public function store(ProfilePhoneStoreRequest $request, $profileId)
    {
    
        $data = $request->all();
        $data["profile_id"] = $profileId;
        $phone = ProfilePhone::create($data);

        return ResponseService::json($phone, "تم إضافة رقم الهاتف بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($profileId)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilePhoneUpdateRequest $request, $profileId, $id)
    {

        $data = $request->all();
        $data["profile_id"] = $profileId;
        $phone = ProfilePhone::findOrFail($id);
        $phone->update($data);
        return ResponseService::json($phone, "تم التعديل بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($profileId, $phoneId)
    {
        $phone = ProfilePhone::where("profile_id", $profileId)->where("id", $phoneId);
        $phone->delete();
        return ResponseService::json($phone, "تم حذف رقم الهاتف بنجاح");
    }
}
