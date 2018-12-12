<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use AUTH;

class NotificationsController extends Controller
{
    public function fetchNotifications($user_id){
        $notifications = DB::select("SELECT * 
                                    FROM 
                                    notifications_log, follow_notification, users
                                    
                                    WHERE 
                                    notification_id = follow_noti_id 
                                    AND user_to_be_notified = '$user_id'
                                    AND notification_from = id
                                    ORDER BY notification_send_at DESC
        ");

        return $notifications;
    }

    public function showNotifications($id){
        $noti_type = DB::select("SELECT * 
                                    FROM notifications_log 
                                    WHERE notification_id = '$id' ");
  
                                
        if ($noti_type[0]->notification_type == 1) {
            
            DB::update("UPDATE follow_notification
                        SET notification_status = 1
                        WHERE follow_noti_id = '$id'");
            
            return redirect()->to("/show_followers");
        }

    }
}
