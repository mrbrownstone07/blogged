<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use App\User;
class TalkController extends Controller
{
    public function index(){
        $notifications = self::getNotifications();
        $users = User::all();
        return view('talk.index')->with('notifications', $notifications)->with('users', $users);
    }



    public function getNotifications(){
        $id = Auth::user()->id;
        $notifications = DB::select("SELECT *
                                    FROM
                                    notifications_log, users
                                    WHERE
                                    user_to_be_notified = '$id'
                                    AND notification_from = users.id
                                    ORDER BY notification_send_at DESC");
        return $notifications;
    }
}
