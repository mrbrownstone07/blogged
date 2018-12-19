<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;
use DB;
use Carbon\Carbon;
use App\User;
class TalkController extends Controller
{
    public function index(){
        $notifications = self::getNotifications();
        
        return view('talk.index')->with('notifications', $notifications);
    }

    public function conversation($reciver){
        $sender = Auth::user()->id;
        $convId = md5($reciver . $sender);
        $convID_of_reciver = md5($sender . $reciver);
        $check = DB::select("SELECT * FROM conversations WHERE conversation_id = '$convId' ");
        
        
        if(!$check){
            self::createConversation($convId, $reciver);
        }

        $reciver_info = DB::select("SELECT * FROM users WHERE id = '$reciver'");
        $notifications = self::getNotifications();
        $oldMsgs = DB::select("SELECT * FROM texts, conversations 
                                WHERE conversation_ref = '$convID_of_reciver'
                                AND conversation_ref = conversation_id
                                UNION 
                                SELECT * FROM texts, conversations
                                WHERE conversation_ref = '$convId'
                                AND conversation_ref = conversation_id
                                ORDER BY sent_at");
            
        return view('talk.index')   ->with('notifications', $notifications)
                                    ->with('reciver', $reciver_info [0])
                                    ->with('oldMsgs', $oldMsgs);
        
        
    }

    public function createConversation($convId, $reciver){
        $created_at = Carbon::now()->toDateTimeString();
        $sent_from = Auth::user()->id;

        try{
            DB::insert("INSERT INTO conversations (conversation_id, sent_from, sent_to, conversation_started)
                        VALUES ('$convId', '$sent_from', '$reciver', '$created_at')    
                    ");
        }catch(QueryException $ex){
            dd($ex);
        }

    }

    public function sendMessage(Request $request){
        if($request->ajax()){
            $sender = Auth::user()->id;
            $reciver = $request->reciver_id;
            $msg = $request->msg;
            $convId = md5($reciver . $sender);
            $sent_at = Carbon::now()->toDateTimeString();
            DB::insert("INSERT INTO texts (conversation_ref, text, sent_at, status) 
                        VALUES ('$convId', '$msg', '$sent_at', '0')");
        }
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


    public function fetchMessages(Request $request){
        if($request->ajax()){
            $reciver = $request->reciver_id;
            $sender = Auth::user()->id;
            $convID_of_reciver = md5($sender . $reciver);
            
            $msgs = DB::select("SELECT * FROM texts 
                                WHERE conversation_ref = '$convID_of_reciver'
                                AND status = 0
                                ORDER BY sent_at
                            ");

            if($msgs){
                $result = "";
                foreach($msgs as $msg){
                    $result.= "<div>" . $msg->text . "</div>";
                }

                return response($result);
            }
            else{
                return response("909");
            }


            
        }
    }
}
