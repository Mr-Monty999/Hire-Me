<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFollowStoreRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Services\NotificationService;
use App\Services\ResponseService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Notification;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("permission:create-users")->only(["store"]);
        $this->middleware("permission:view-users")->only(["index", "show"]);
        $this->middleware("permission:edit-users")->only(["update"]);
        $this->middleware("permission:delete-users")->only(["destroy"]);
    }
    public function index()
    {
        $user  = UserService::getAllUsers();
        return ResponseService::json($user);
    }

    public function login(UserLoginRequest $request)
    {
        $login = UserService::login($request);

        if ($login)
            return ResponseService::json($login, "تم تسجيل الدخول بنجاح");
        else
            return ResponseService::json(null, "الرجاء التحقق من البيانات !", 401);
    }

    public function register(UserRegisterRequest $request)
    {
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
        $user = UserService::showUserWithRelations($id);
        return ResponseService::json($user);
    }

    public function showPhones($userId)
    {
        $phones =  UserService::showPhones($userId);
        // $phones = UserPhone::where("user_id", $userId)->get();

        return ResponseService::json($phones, "تم جلب أرقام الهواتف بنجاح");
    }
    public  function showProfile($userId)
    {

        $profile = UserService::showProfile($userId);
        return ResponseService::json($profile);
    }
    public function showPosts($userId)
    {
        $posts =  UserService::showPosts($userId);

        return ResponseService::json($posts, "تم جلب المنشورات بنجاح");
    }
    public function followUser(UserFollowStoreRequest $request, $targetUserId)
    {

        $user = UserService::followUser(Auth::id(), $targetUserId);
        NotificationService::sendFollowNotification(["user_id" => $targetUserId]);
        return ResponseService::json($user, "تم المتابعة بنجاح");
    }
    public function unFollowUser($targetUserId)
    {
        $user = UserService::unFollowUser(Auth::id(), $targetUserId);
        return ResponseService::json($user, "تم إلغاء المتابعة بنجاح");
    }
    public function isFollowed($myUserId, $targetUserId)
    {
        $exist =  UserService::isFollowed($myUserId, $targetUserId);
        return ResponseService::json($exist, "تمت العملية بنجاح");
    }

    public function getNotifications($id)
    {

        $notifications = NotificationService::getUserAllReceivedNotifications($id);
        $data["notifications"] = $notifications;
        $data["unreaded_notifications_count"] = NotificationService::getUserUnReadedNotificationsCount($id);
        return ResponseService::json($data, "تمت العملية بنجاح");
    }
    public function getHeaderCounts()
    {
        $userId = Auth::user()->id;
        $data["incoming_connections_count"] = UserService::getAllIncommingConnectionsCount($userId);
        $data["unreaded_notifications_count"] = NotificationService::getUserUnReadedNotificationsCount($userId);
        return ResponseService::json($data, "تمت العملية بنجاح");
    }
    public function readAllNotifications()
    {
        $userId = Auth::user()->id;
        NotificationService::readAllNotifications($userId);
        return ResponseService::json(null, "تمت العملية بنجاح");
    }

    public function sendConnectionRequest(Request $request, $targetUserId)
    {
        $data = UserService::sendConnectionRequest(Auth::id(), $targetUserId);
        NotificationService::sendConnectionRequestNotification([
            "notifiable_id" => $targetUserId,
            "user_id" => Auth::id(),
        ]);
        return ResponseService::json($data, "تمت العملية بنجاح");
    }
    public function removeConnection($targetUserId)
    {
        $data = UserService::removeConnection(Auth::id(), $targetUserId);

        return ResponseService::json($data, "تمت العملية بنجاح");
    }

    public function acceptConnectionRequest(Request $request, $userId)
    {
        $data = UserService::acceptConnectionRequest($userId, $request->target_user_id);

        return ResponseService::json($data, "تمت العملية بنجاح");
    }
    public function getAllAcceptedConnections($userId)
    {
        $data = UserService::getUserConnections($userId);

        return ResponseService::json($data, "تمت العملية بنجاح");
    }

    public function getConnectionStatus($targetUserId)
    {
        $data = UserService::getConnectionStatus(Auth::id(), $targetUserId);

        return ResponseService::json($data, "تمت العملية بنجاح");
    }
    public function getAllIncommingConnections($userId)
    {
        $data = UserService::getAllIncommingConnections($userId);

        return ResponseService::json($data, "تمت العملية بنجاح");
    }
    public function getAllIncommingConnectionsCount($userId)
    {
        $count = UserService::getAllIncommingConnectionsCount($userId);

        return ResponseService::json($count, "تمت العملية بنجاح");
    }
    public function search($pattern)
    {
        $user = UserService::searchForUser($pattern);
        return ResponseService::json($user, "تمت العملية بنجاح");
    }
    public function showFeedbackPosts($userId)
    {
        $posts = UserService::getFeedPosts($userId);
        return ResponseService::json($posts, "تمت العملية بنجاح");
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
