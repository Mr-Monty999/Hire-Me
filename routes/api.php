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
        Route::apiResource("users", "UserController");


        //Profiles
        Route::apiResource("profiles", "ProfileController");


        // Route::get("profiles/{id}/phones", "UserController@showPhones");
        Route::get("profiles/{id}/posts", "UserController@showPosts");
        Route::get("profiles/{id}/info", "UserController@showUserOnly");
        Route::post("profiles/{id}/follows", "UserController@followUser");
        Route::delete("profiles/{id}/profiles/{targetId}/follows", "UserController@unFollowUser");
        Route::get("profiles/{id}/profiles/{targetId}/is-followed", "UserController@isFollowed");
        Route::get("profiles/{id}/notifications", "UserController@getNotifications");
        Route::get("profiles/{id}/header/counts", "UserController@getHeaderCounts");
        Route::post("profiles/{id}/notifications/readall", "UserController@readAllNotifications");
        Route::post("profiles/{id}/connections/request", "UserController@sendConnectionRequest");
        Route::post("profiles/{id}/connections/accept", "UserController@acceptConnectionRequest");
        Route::delete("profiles/{id}/profiles/{targetId}/connections/remove", "UserController@removeConnection");
        Route::get("profiles/{id}/connections", "UserController@getAllAcceptedConnections");
        Route::get("profiles/{id}/connections/incomming", "UserController@getAllIncommingConnections");
        Route::get("profiles/{id}/profiles/{targetId}/connection-status", "UserController@getConnectionStatus");
        Route::get("profiles/search/{pattern}", "UserController@search");
        Route::get("profiles/{profileId}/feedback/posts", "UserController@showFeedbackPosts");


        //User Phones
        Route::apiResource("profiles.phones", "UserPhoneController");

        //Certificates
        Route::apiResource("certificates", "CertificateController");

        //Comments
        Route::apiResource("comments", "CommentController");

        //Companies
        Route::apiResource("companies", "CompanyController");

        //Company Phones
        Route::apiResource("companies.phones", "CompanyPhoneController");

        //Experiences
        Route::apiResource("experiences", "ExperienceController");

        //Posts
        Route::apiResource("posts", "PostController");
        Route::post("posts/{id}/profiles", "PostController@react");
        Route::delete("posts/{id}/profiles/{profileId}", "PostController@unReact");
        Route::get("posts/{id}/profiles/{profileId}/react-type", "PostController@isReacted");
        Route::get("posts/search/{pattern}", "PostController@search");


        //Skills
        Route::apiResource("skills", "SkillController");
        Route::delete("skills/{skillId}/profiles/{profileId}", "SkillController@detach");
        Route::get("skills/{name}/search", "SkillController@search");
        //Tags
        Route::apiResource("tags", "TagController");

        // //Noctifications
        // Route::apiResource("notifications", "NotificationController");

        ///Public Routes
        Route::get("search/{pattern}", "PublicController@searchForAll");

        ///Jobs Routes
        Route::apiResource("jobs", "JobController");
        Route::get("jobs/search/{pattern}", "JobController@search");
    });
});
