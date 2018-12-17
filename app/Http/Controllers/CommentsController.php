<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;
class CommentsController extends Controller
{
    public function store(Request $request){
        
        $post_id = $request->post_id;
        $comment = $request->comment;
        $location = $request->path;
        
        $user = Auth::user()->id;        
        $commented_at = Carbon::now()->toDateTimeString();

        try{
            
            DB::insert("INSERT INTO comments_log 
                        (commented_on, commented_by, commented_at, comment) 
                        VALUES ('$post_id', '$user', '$commented_at', '$comment') ");
            
            $post = DB::select("SELECT * FROM posts WHERE post_id = '$post_id'");
            $post_of = $post[0]->owner_id;

            $hash_id = md5($post_of . $user);        
            $notification_id = md5($hash_id.''.$commented_at);

            if($post_of != $user){
                DB::insert("INSERT INTO notifications_log (
                    notification_id,
                    notification_send_at,
                    notification_type, 
                    user_to_be_notified, 
                    notification_from 
                )
                VALUES(
                    '$notification_id',
                    '$commented_at', 
                    '3',
                    '$post_of',
                    '$user'
                )");

                
                $comment_t = DB::select("SELECT * FROM comments_log 
                                            WHERE commented_on = '$post_id' 
                                            AND commented_by =  '$user'
                                            AND commented_at = '$commented_at'
                                            AND comment = '$comment'
                                        ");
                
                $comment_t = $comment_t[0]->comment_id;
                
                //dd($comment_t);

                DB::insert("INSERT INTO comment_notifications (
                                comment_noti_id,
                                post_commented,
                                comment_track_id)
    
                            VALUES (
                                '$notification_id',
                                '$post_id',
                                '$comment_t'
                            )
                ");
            }

            
            
        }catch(\Illuminate\Database\QueryException $ex){
            dd($ex);
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
        
    }

    public function deleteComment($comment_id, $location){
        //dd($comment_id);
        DB::delete("DELETE FROM comments_log  WHERE comment_id = '$comment_id'");
        
        $noti_id = DB::select("SELECT * FROM comment_notifications WHERE comment_track_id = '$comment_id'");
        $noti_id = $noti_id[0]->comment_noti_id;
        
        DB::delete("DELETE FROM comment_notifications WHERE comment_noti_id = '$noti_id'");
        DB::delete("DELETE FROM notifications_log WHERE notification_id = '$noti_id'");
        
        if($location == "home"){
            return redirect()->to("/home");
        }
        elseif(substr($location, 0, 7) == 'profile'){
            return  redirect()->to("/profile/".substr($location, 8, strlen($location)));
        }
        else{
            return redirect()->to("/post/".substr($location, 5, strlen($location)));
        }   
    }

}
