<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class RoomsController extends Controller
{
    public function index($slug){
        $id = Auth::user()->id;
        $user = DB::select("SELECT * FROM users WHERE id = '$id'");
        $notifications = self::getNotifications();
        
        
        return view('rooms.index')  ->with('notifications', $notifications)
                                    ->with('usrData', $user[0]);
    }

    public function getNotifications(){
        $id = Auth::user()->id;
        $notifications = DB::select( "SELECT * 
                                        FROM 
                                        notifications_log, users
                                        WHERE 
                                        user_to_be_notified = '$id'
                                        AND notification_from = users.id
                                        ORDER BY notification_send_at DESC
                                    ");
        return $notifications;       
    }
}
