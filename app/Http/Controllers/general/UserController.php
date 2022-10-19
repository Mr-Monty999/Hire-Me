<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Profile;
use App\Models\User;
use App\Services\ResponseService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

    public function login(UserLoginRequest $request)
    {
        $request->validated();
        $login = UserService::login($request);

        if ($login)
            return ResponseService::json($login, "تم تسجيل الدخول بنجاح");
        else
            return ResponseService::json(null, "الرجاء التحقق من البيانات !", 401);
    }

    public function register(UserRegisterRequest $request)
    {
        $request->validated();
        $user = UserService::register($request->all());
        return ResponseService::json($user, "تم إنشاء الحساب بنجاح");
    }
    public function logout()
    {
        $logout = UserService::logout();

        return ResponseService::json($logout, "تم تسجيل الخروج بنجاح");
    }


    public function store(UserRegisterRequest $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
