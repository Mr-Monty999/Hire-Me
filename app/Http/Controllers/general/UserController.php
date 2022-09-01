<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Profile;
use App\Models\User;
use App\Services\ResponseService;
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
        $data = $request->all();


        if (Auth::attempt($request->only(["email", "password"]), true)) {
            // Auth::user()->tokens()->delete();
            $data = Auth::user();
            $data["token"] = Auth::user()->createToken($data["email"])->plainTextToken;

            return ResponseService::json($data, "تم تسجيل الدخول بنجاح");
        } else
            return ResponseService::json($data, "الرجاء التحقق من البيانات !", 401);
    }

    public function logout()
    {
        $data = Auth::user();
        Auth::logout();
        return ResponseService::json($data, "تم تسجيل الخروج بنجاح");
    }


    public function store(UserRegisterRequest $request)
    {
        $request->validated();
        $data = $request->all();
        $data["password"] = bcrypt($data["password"]);
        $data["repassword"] = bcrypt($data["repassword"]);
        $user = User::create($data);
        $data["user_id"] =  $user->id;
        $data["token"] = $user->createToken($data["email"])->plainTextToken;
        Profile::create($data);
        return ResponseService::json($data, "تم إنشاء الحساب بنجاح");
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
