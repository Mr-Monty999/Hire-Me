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
        // Route::apiResource("profiles", "ProfileController");


        Route::get("users/{userId}/posts", "UserController@showPosts");
        Route::get("users/{userId}/profile", "UserController@showProfile");
        Route::put("users/{userId}/profile", "UserController@updateProfile");
        Route::post("users/auth/follows/{targetId}", "UserController@followUser");
        Route::delete("users/auth/unfollows/{targetId}", "UserController@unFollowUser");
        Route::get("users/{userId}/is-followed/{targetId}", "UserController@isFollowed");
        Route::get("users/auth/notifications", "UserController@getNotifications");
        Route::get("users/auth/header/counts", "UserController@getHeaderCounts");
        Route::post("users/auth/notifications/readall", "UserController@readAllNotifications");
        Route::post("users/auth/connections/request/{targetUser}", "UserController@sendConnectionRequest");
        Route::post("users/auth/connections/accept", "UserController@acceptConnectionRequest");
        Route::delete("users/auth/connections/remove/{targetUser}", "UserController@removeConnection");
        Route::get("users/{userId}/connections", "UserController@getAllAcceptedConnections");
        Route::get("users/auth/connections/incomming", "UserController@getAllIncommingConnections");
        Route::get("users/auth/connection-status/{targetId}", "UserController@getConnectionStatus");
        Route::get("users/search/{pattern}", "UserController@search");
        Route::get("users/{userId}/feedback/posts", "UserController@showFeedbackPosts");


        //User Phones
        Route::apiResource("users.phones", "UserPhoneController");

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
        Route::post("posts/{id}/react", "PostController@react");
        Route::delete("posts/{id}/unreact", "PostController@unReact");
        Route::get("posts/{id}/react-type", "PostController@isReacted");
        Route::get("posts/search/{pattern}", "PostController@search");


        //Skills
        Route::apiResource("skills", "SkillController");
        Route::delete("skills/{skillId}/detach", "SkillController@detach");
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
