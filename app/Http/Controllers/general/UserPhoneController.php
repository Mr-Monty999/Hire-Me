<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPhoneStoreRequest;
use App\Http\Requests\UserPhoneUpdateRequest;
use App\Models\User;
use App\Models\UserPhone;
use App\Services\ResponseService;
use App\Services\UserService;
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
        $this->middleware("permission:create-users-phones|create-any-users-phones")->only(["store"]);
        $this->middleware("permission:view-users-phones|view-any-users-phones")->only(["index", "show"]);
        $this->middleware("permission:edit-users-phones|edit-any-users-phones")->only(["update"]);
        $this->middleware("permission:delete-users-phones|delete-any-users-phones")->only(["destroy"]);
    }

    public function index($userId)
    {

        $phones =  UserService::showPhones($userId);
        // $phones = UserPhone::where("user_id", $userId)->get();

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
    public function store(UserPhoneStoreRequest $request, $userId)
    {

        $data = $request->all();
        $data["user_id"] = $userId;
        $phone = UserPhone::create($data);

        return ResponseService::json($phone, "تم إضافة رقم الهاتف بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userId)
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
    public function update(UserPhoneUpdateRequest $request, $userId, $id)
    {

        $data = $request->all();
        $data["user_id"] = $userId;
        $phone = UserPhone::findOrFail($id);
        $phone->update($data);
        return ResponseService::json($phone, "تم التعديل بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId, $phoneId)
    {
        $phone = UserPhone::where("user_id", $userId)->where("id", $phoneId);
        $phone->delete();
        return ResponseService::json($phone, "تم حذف رقم الهاتف بنجاح");
    }
}
