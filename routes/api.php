<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::group(["namespace" => "general"], function () {


    Route::post("users/login", "UserController@login");
    Route::post("users/register", "UserController@register");

    Route::group(["middleware" => "auth:sanctum"], function () {
        //User Logout
        Route::post("users/logout", "UserController@logout");

        //Users
        Route::resource("users", "UserController");

        //Profiles
        Route::resource("profiles", "ProfileController");
        Route::get("profiles/{id}/phones", "ProfileController@getPhones");
        Route::get("profiles/{id}/posts", "ProfileController@getPosts");

        //Profile Phones
        Route::resource("profile-phones", "ProfilePhoneController");

        //Certificates
        Route::resource("certificates", "CertificateController");

        //Comments
        Route::resource("comments", "CommentController");

        //Companies
        Route::resource("companies", "CompanyController");

        //Company Phones
        Route::resource("companies-phones", "CompanyPhoneController");

        //Experiences
        Route::resource("experiences", "ExperienceController");

        //Posts
        Route::resource("posts", "PostController");

        //Skills
        Route::resource("skills", "SkillController");
        Route::delete("skills/detach/{profileId}/{skillId}", "SkillController@detach");

        //Tags
        Route::resource("tags", "TagController");
    });
});
