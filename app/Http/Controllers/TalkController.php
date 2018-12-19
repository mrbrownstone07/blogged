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

    public function conversation($reciver){
        $sender = Auth::user()->id;
        $convId = md5($reciver . $sender);
        $check = DB::select("SELECT * FROM conversation WHERE conversation_id = '$convId' ");

        if($check){
            return $convId;
        }

        else{

        }
        
    }

    public function createConversation($convId, $reciver){
        $created_at = Carbon::now()->toDateTimeString();
        $sent_from = Auth::user()->id;

        $sql = DB::insert("INSERT INTO conversations (conversation_id, )");
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
