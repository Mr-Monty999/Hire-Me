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
        Route::get("profiles/{id}/phones", "ProfileController@showPhones");
        Route::get("profiles/{id}/posts", "ProfileController@showPosts");
        Route::get("profiles/{id}/info", "ProfileController@showProfileOnly");
        Route::post("profiles/{id}/follow/{targetId}", "ProfileController@followProfile");
        Route::post("profiles/{id}/unfollow/{targetId}", "ProfileController@unFollowProfile");
        Route::get("profiles/{id}/followed/{targetId}", "ProfileController@isFollowed");

        //Profile Phones
        Route::resource("profile-phones", "ProfilePhoneController");

        //Certificates
        Route::resource("certificates", "CertificateController");

        //Comments
        Route::resource("comments", "CommentController");

        //Companies
        Route::resource("companies", "CompanyController");

        //Company Phones
        Route::resource("companies.phones", "CompanyPhoneController");

        //Experiences
        Route::resource("experiences", "ExperienceController");

        //Posts
        Route::resource("posts", "PostController");
        Route::post("posts/react/{id}/{profileId}/{type}", "PostController@react");
        Route::post("posts/unreact/{id}/{profileId}", "PostController@unReact");
        Route::get("posts/react-type/{id}/{profileId}", "PostController@isReacted");

        //Skills
        Route::resource("skills", "SkillController");
        Route::delete("skills/detach/{profileId}/{skillId}", "SkillController@detach");
        Route::get("skills/search/{name}", "SkillController@search");

        //Tags
        Route::resource("tags", "TagController");
    });
});
