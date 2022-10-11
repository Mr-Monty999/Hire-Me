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
        // Route::get("profiles/{id}/phones", "ProfileController@showPhones");
        Route::get("profiles/{id}/posts", "ProfileController@showPosts");
        Route::get("profiles/{id}/info", "ProfileController@showProfileOnly");
        Route::post("profiles/{id}/follows", "ProfileController@followProfile");
        Route::delete("profiles/{id}/profiles/{targetId}/follows", "ProfileController@unFollowProfile");
        Route::get("profiles/{id}/profiles/{targetId}/is-followed", "ProfileController@isFollowed");
        Route::get("profiles/{id}/notifications", "ProfileController@getNotifications");
        Route::get("profiles/{id}/header/counts", "ProfileController@getHeaderCounts");
        Route::post("profiles/{id}/notifications/readall", "ProfileController@readAllNotifications");
        Route::post("profiles/{id}/connections/request", "ProfileController@sendConnectionRequest");
        Route::post("profiles/{id}/connections/accept", "ProfileController@acceptConnectionRequest");
        Route::delete("profiles/{id}/profiles/{targetId}/connections/remove", "ProfileController@removeConnection");
        Route::get("profiles/{id}/connections", "ProfileController@getAllAcceptedConnections");
        Route::get("profiles/{id}/connections/incomming", "ProfileController@getAllIncommingConnections");
        Route::get("profiles/{id}/profiles/{targetId}/connection-status", "ProfileController@getConnectionStatus");
        Route::get("profiles/search/{pattern}", "ProfileController@search");


        //Profile Phones
        Route::resource("profiles.phones", "ProfilePhoneController");

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
        Route::post("posts/{id}/profiles", "PostController@react");
        Route::delete("posts/{id}/profiles/{profileId}", "PostController@unReact");
        Route::get("posts/{id}/profiles/{profileId}/react-type", "PostController@isReacted");
        Route::get("posts/search/{pattern}", "PostController@search");


        //Skills
        Route::resource("skills", "SkillController");
        Route::delete("skills/{skillId}/profiles/{profileId}", "SkillController@detach");
        Route::get("skills/{name}/search", "SkillController@search");

        //Tags
        Route::resource("tags", "TagController");

        //Noctifications
        Route::resource("notifications", "NotificationController");

        ///Public Routes
        Route::get("search/{pattern}", "PublicController@search");
    });
});
