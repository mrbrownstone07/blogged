<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
class ReactsController extends Controller
{
    public function handleRequest($post_id, $liked_by, $location){
        $post_data = DB::select("SELECT * FROM posts WHERE post_id ='$post_id'");

        if(!$post_data){
            $msg = 'post not Found <br> request sent by <b> @'.Auth::user()->name. '</b>';
            return view('potato')->with('msg', $msg);            
        }

        if($liked_by != Auth::user()->id){
            $msg = 'unauthorized page <br> request sent by <b> @'.Auth::user()->name. '</b>';
            return view('potato')->with('msg', $msg);
        }

        $user_to_ber_notified = $post_data[0]->owner_id;
        $hash_id = md5($user_to_ber_notified . $liked_by);        
        $check = DB::select("SELECT * FROM reacts WHERE liker_id = '$liked_by' AND liked_post = '$post_id' ");
        $created_at = Carbon::now()->toDateTimeString();
        $notification_id = md5($hash_id.''.$created_at);

        if($check){
            if($check[0]->reaction == 1)
                DB::update("UPDATE reacts SET reaction = 0 WHERE liker_id = '$liked_by' AND liked_post = '$post_id' ");
            else 
                DB::update("UPDATE reacts SET reaction = 1 WHERE liker_id = '$liked_by' AND liked_post = '$post_id' ");
        }else{

            DB::insert("INSERT INTO reacts (reaction, liker_id, liked_post) VALUES (1, '$liked_by', '$post_id')");
            
            if($liked_by != $user_to_ber_notified){
                DB::insert("INSERT INTO notifications_log (
                    notification_id,
                    notification_send_at,
                    notification_type, 
                    user_to_be_notified, 
                    notification_from 
                )
                VALUES(
                    '$notification_id',
                    '$created_at', 
                    '2',
                    '$user_to_ber_notified',
                    '$liked_by'
                )");
    
                
                DB::insert("INSERT INTO react_notifications (
                                noti_id,
                                post_reacted)
    
                            VALUES (
                                '$notification_id',
                                '$post_id'
                            )
                ");
            }

            
            
        }

        if($location == "home"){
            return redirect()->to("/home");
        }
        elseif(substr($location, 0, 7) == 'profile'){
            return  redirect()->to("/profile/".substr($location, 8, strlen($location)));
        }
        else{
            return redirect()->to("/post/".$post_id);
        }

        //return ($location == 'home')? redirect()->to("/home") : redirect()->to("/profile/".substr($location, 8, strlen($location)));
    } 
}
        