<?php

namespace App\Services;

use App\Models\Profile;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Auth;
use Hash;

/**
 * Class UserService.
 */
class UserService
{

    public static function login($request)
    {


        if (Auth::attempt($request->only(["email", "password"]), true)) {
            $data = Auth::user();
            $user = Auth::user();
            $data["profile_id"] = Auth::user()->profile->id;
            unset($data["profile"]);
            $data["token"] = Auth::user()->createToken(uniqid("token_"))->plainTextToken;
            return $data;
        } else
            return false;
    }

    public static function register($data)
    {


        $data["password"] = bcrypt($data["password"]);
        $user = User::create($data);
        $data["user_id"] =  $user->id;
        $user["token"] = $user->createToken(uniqid("token_"))->plainTextToken;
        $user["profile_id"] = Profile::create($data)->id;
        $user->assignRole('user');

        return $user;
    }
    public static function logout()
    {
        // Auth::user()->tokens()->delete();

        $data = null;
        if (Auth::user() != null)
            $data = Auth::user();

        // Auth::logout();

        return $data;
    }

    public static function getAllUsers()
    {
        $users = User::all();
        return $users;
    }
}
