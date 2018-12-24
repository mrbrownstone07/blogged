<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Auth;
use DB;
use Carbon\Carbon;
use App\User;
use Cache;

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
        
        return view('talk.index')   ->with('notifications', $notifications)
                                    ->with('reciver', $reciver_info [0]);   
    }

    public function fetchAll(Request $request){
        if($request->ajax()){
            $reciver = $request->reciver_id;
            $sender = Auth::user()->id;
            $convId = md5($reciver . $sender);
            $convID_of_reciver = md5($sender . $reciver);
            
            $oldMsgs = DB::select("SELECT * FROM texts, conversations 
            WHERE conversation_ref = '$convID_of_reciver'
            AND conversation_ref = conversation_id 
            UNION 
            SELECT * FROM texts, conversations
            WHERE conversation_ref = '$convId'
            AND conversation_ref = conversation_id
            ORDER BY sent_at");
            $reciverData = DB::select("SELECT * FROM users WHERE id = ' $reciver '");

            if($oldMsgs){
                $result = "";
                $last_chat = DB::select("SELECT * FROM conversations 
                                        WHERE conversation_id = '$convId' 
                                        OR conversation_id = '$convID_of_reciver'
                                        ORDER BY last_chat_time DESC");

                $time = "no chats yet!";
                if($last_chat){
                    $time = (new Carbon( $last_chat[0]->last_chat_time))->diffForHumans();
                }

                foreach($oldMsgs as $msg){

                    DB::update("UPDATE texts set status = 1 where text_id = '$msg->text_id' ");
                    if($msg->conversation_ref == $convID_of_reciver)
                        $result.= "<div id='reciver' class='col-md-12 m_wrap text-left bg-white'>
                        <img class='rounded-circle' style='width:30px; length:30px' src='/img/user_imgs/" .$reciverData[0]->profile_pic. "' />
                                    <span class='format no_wrap text-center recived '>" . $msg->text . "</span></div>";

                    else 
                      $result.= "<div id='sender' class='col-md-12 m_wrap text-right bg-white'>
                                    <span class='no_wrap text-center sent' >" .$msg->text. "</span></div>"; 
                    
                }

                $result.=' <div class="col-md-12 text-center"> <small><u>'. $time .'</u></small></div>';

                return response($result);
            }            
        }
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
            DB::update("UPDATE conversations set last_chat_time = '$sent_at' where conversation_id = '$convId' ");
            DB::insert("INSERT INTO texts (conversation_ref, text, sent_at, status) 
                        VALUES ('$convId', '$msg', '$sent_at', '0')");
        }
    }

    public function fetchOnlineusers(Request $request){

        if($request->ajax()){
            $uid = Auth::user()->id; 
            $contacts = DB::select("SELECT DISTINCT * FROM users 
                                    WHERE id IN
                                    ((SELECT follower FROM follows WHERE followee = '$uid' ))
    
                                    UNION
    
                                    SELECT * FROM users 
                                    WHERE id IN
                                    ((SELECT followee FROM follows WHERE follower = '$uid' ))
    
                                    ORDER BY name
                                ");

            

            if($contacts){
                $result = "";
                foreach($contacts as $user){
                    $convId = md5($user->id . $uid);
                    $convID_of_reciver = md5($uid . $user->id);
                    $msg = "";
                    $last_text = DB::select("SELECT * 
                                                FROM texts,conversations 
                                                WHERE conversation_id = conversation_ref
                                                AND conversation_ref = '$convId' 
                                                OR conversation_ref = '$convID_of_reciver' 
                                                
                                                ORDER BY sent_at DESC LIMIT 1");
                    if($last_text){
                        $msg = $last_text[0]->text;
                    }

                    if(Cache::has('user-is-online-' . $user->id)){
                        if($last_text && $last_text[0]->status == 0 && $last_text[0]->sent_to == Auth::user()->id){
                            $result.= '<div class="jumbotron  no_wrap" style="margin-bottom:2px; padding:8px; background-color:#E3F7F7;">
                                        <div class=row> 
                                            <div class="col-md-1"></div><div class="col-md-11">
                                                <img id="theImg" class="rounded-circle" style="width:40px; length:40px" src="/img/user_imgs/'.$user->profile_pic .'" />
                                                <a href="/show_conversation/'.$user->id.'" class="link_fix">'
                                                . "@".$user->name . '
                                                </a>
                                                <img id="theImg" class="" style="width:10px; length:10px" src="/img/icons/active.png" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-10 "> <small>'
                                                . $msg  .
                                            '</small> </div>
                                            </div>
                                        </div>';                            
                        }else{
                            $result.= '<div class="jumbotron  no_wrap bg-light" style="margin-bottom:2px; padding:8px">
                                        <div class=row> 
                                            <div class="col-md-1"></div><div class="col-md-11">
                                                <img id="theImg" class="rounded-circle" style="width:40px; length:40px" src="/img/user_imgs/'.$user->profile_pic .'" />
                                                <a href="/show_conversation/'.$user->id.'" class="link_fix">'
                                                . "@".$user->name . '
                                                </a>
                                                <img id="theImg" class="" style="width:10px; length:10px" src="/img/icons/active.png" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-10 "> <small>'
                                                . $msg  .
                                            '</small> </div>
                                        </div>
                                        </div>';
                        }

                    }else{
                        if($last_text && $last_text[0]->status == 0 && $last_text[0]->sent_to == Auth::user()->id){
                            $result.= '<div class="jumbotron no_wrap" style="margin-bottom:2px; padding:8px; background-color:#E3F7F7;">
                                        <div class="row"> 
                                            <div class="col-md-1"></div><div class="col-md-11">
                                                <img id="theImg" class="rounded-circle" style="width:40px; length:40px" src="/img/user_imgs/'.$user->profile_pic .'" />
                                                <a href="/show_conversation/'.$user->id.'" class="link_fix">'
                                                . "@".$user->name . '
                                                </a>
                                                <img id="theImg" class="" style="width:10px; length:10px" src="/img/icons/offline.png" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-10 "> <small>'
                                                .$msg.
                                            '</small> </div>
                                        </div>
                                        </div>';   
                        }else{
                            $result.= '<div class="jumbotron  no_wrap bg-light" style="margin-bottom:2px; padding:8px">
                                        <div class="row"> 
                                            <div class="col-md-1"></div><div class="col-md-11">
                                                <img id="theImg" class="rounded-circle" style="width:40px; length:40px" src="/img/user_imgs/'.$user->profile_pic .'" />
                                                <a href="/show_conversation/'.$user->id.'" class="link_fix">'
                                                . "@".$user->name . '
                                                </a>
                                                <img id="theImg" class="" style="width:10px; length:10px" src="/img/icons/offline.png" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-10 "> <small>'
                                                .$msg.
                                            '</small> </div>
                                        </div>
                                        </div>';
                        }
                    }
                }
                return response($result);
            }
        }
    }


    public function fetchMsgNoti(Request $request){

        if($request->ajax()){
            $id = Auth::user()->id;
            $notifications = DB::select("SELECT * FROM texts Where conversation_ref in
            (SELECT conversation_id FROM conversations WHERE sent_to = '$id')
            AND status = 0
            GROUP BY conversation_ref");

            $result = "";
            $count = 0;
            foreach($notifications as $n){
                $count++;
            }

            $result = $count;
      

            return response($result);
        }

    }

    public function getNewMsg(Request $request){

        $uid = Auth::user()->id; 
        $contacts = DB::select("SELECT DISTINCT * FROM users 
                                WHERE id IN
                                ((SELECT follower FROM follows WHERE followee = '$uid' ))

                                UNION

                                SELECT * FROM users 
                                WHERE id IN
                                ((SELECT followee FROM follows WHERE follower = '$uid' ))

                                ORDER BY name
                            ");
        if($contacts){
            $result = "";
            foreach($contacts as $user){
                $convId = md5($user->id . $uid);
                $convID_of_reciver = md5($uid . $user->id);
                $msg = "";
                $last_text = DB::select("SELECT * 
                                            FROM texts,conversations 
                                            WHERE conversation_id = conversation_ref
                                            AND conversation_ref = '$convID_of_reciver' 
                                            ORDER BY sent_at DESC LIMIT 0");
                if($last_text){
                    $msg = $last_text[0]->text;
                    $result.= '<div class="jumbotron  no_wrap" style="margin-bottom:2px; padding:8px; background-color:#E3F7F7;">
                                        <div class=row> 
                                            <div class="col-md-1"></div><div class="col-md-11">
                                                <img id="theImg" class="rounded-circle" style="width:40px; length:40px" src="/img/user_imgs/'.$user->profile_pic .'" />
                                                <a href="/show_conversation/'.$user->id.'" class="link_fix">'
                                                . "@".$user->name . '
                                                </a>
                                                <img id="theImg" class="" style="width:10px; length:10px" src="/img/icons/active.png" />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                            </div>
                                            <div class="col-md-10 "> <small>'
                                                . $msg  .
                                            '</small> </div>
                                            </div>
                                        </div>';  

                }
            }

            
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

            $reciverData = DB::select("SELECT * FROM users WHERE id = ' $reciver '");

            if($msgs){
                $result = "";
                foreach($msgs as $msg){
                    $result.= "";
                    $result.= "<div id='reciver' class='col-md-12 m_wrap text-left bg-white'><img class='rounded-circle' style='width:30px; length:30px' src='/img/user_imgs/" .$reciverData[0]->profile_pic. "' /><span class='format no_wrap text-center recived'>" . $msg->text . "</span></div>";
                    
                    DB::update("UPDATE texts set status = 1 where text_id = '$msg->text_id' ");
                    
                    
                }

                return response($result);
            }
            else{
                return null;
            }   
        }
    }

    public function deleteChatHistory($reciver_id){
        //dd($reciver_id);

        $convId = md5($reciver_id . Auth::user()->id);
        $reciverConvId = md5(Auth::user()->id. $reciver_id);
        
        
        DB::delete("DELETE FROM texts WHERE conversation_ref = '$convId' ");
        DB::delete("DELETE FROM texts WHERE conversation_ref = '$reciverConvId' ");

        return \redirect()->to("/show_conversation/".$reciver_id);
        
    }
}
