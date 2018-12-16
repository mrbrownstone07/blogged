<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use AUTH;
use Carbon\Carbon;

class NotificationsController extends Controller
{
    public function fetchNotifications($user_id){
        $notifications = DB::select("SELECT * 
                                    FROM 
                                    notifications_log, users
                                    WHERE 
                                    user_to_be_notified = '$id'
                                    AND notification_from = users.id
                                    ORDER BY notification_send_at DESC");

        return $notifications;
    }

    public function showNotifications($noti_id, $noti_type){
        
        

        $seen_at = Carbon::now()->toDateTimeString();
        DB::update("UPDATE notifications_log
                    SET notification_status = 1,
                        notification_seen_at = '$seen_at'
                    WHERE notification_id = '$noti_id'");
            
        if($noti_type == 1){
            
            $user = DB::select("SELECT * FROM users WHERE id = (
                                SELECT notification_from 
                                FROM notifications_log
                                WHERE notification_id = '$noti_id')
                            ");

            $slug = $user[0]->slug;
            
            return \redirect()->to("/profile/$slug");
        }
        if($noti_type == 2){
            $post = DB::select("SELECT * FROM posts WHERE post_id = (
                                SELECT post_reacted 
                                FROM react_notifications
                                WHERE noti_id = '$noti_id')
                            ");
            $post_id = $post[0]->post_id;
            return redirect()->to("/posts/$post_id");
        }
        if($noti_id == 3){
            $post = DB::select("SELECT * FROM posts WHERE post_id = (
                SELECT post_reacted 
                FROM react_notifications
                WHERE noti_id = '$noti_id')
            ");
            $post_id = $post[0]->post_id;
            $block = 'block';
            return redirect()->to("/posts/$post_id")->with('style', $block);
        }
    }
}
