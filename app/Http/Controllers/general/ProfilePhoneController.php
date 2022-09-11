<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfilePhoneStoreRequest;
use App\Http\Requests\ProfilePhoneUpdateRequest;
use App\Models\Profile;
use App\Models\ProfilePhone;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class ProfilePhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(ProfilePhoneStoreRequest $request)
    {
        $request->validated();

        $phone = ProfilePhone::create($request->all());

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilePhoneUpdateRequest $request, $id)
    {

        $request->validated();
        $phone = ProfilePhone::findOrFail($id);
        $phone->update($request->all());
        return ResponseService::json($phone, "تم التعديل بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($phoneId)
    {
        $phone = ProfilePhone::findOrFail($phoneId);
        $phone->delete();
        return ResponseService::json($phone, "تم حذف رقم الهاتف بنجاح");
    }
}
