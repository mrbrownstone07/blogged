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
        //dd($comment);
        $user = Auth::user()->id;
        //dd($commented_at);
        $commented_at = Carbon::now()->toDateTimeString();

        try{
            
            DB::insert("INSERT INTO comments_log 
                        (commented_on, commented_by, commented_at, comment) 
                        VALUES ('$post_id', '$user', '$commented_at', '$comment') ");
            
            $post = DB::select("SELECT * FROM posts WHERE post_id = '$post_id'");
            $post_of = $post[0]->owner_id;

            $hash_id = md5($post_of . $user);        
            $notification_id = md5($hash_id.''.$commented_at);

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

            
            DB::insert("INSERT INTO comment_notifications (
                            comment_noti_id,
                            post_commented)

                        VALUES (
                            '$notification_id',
                            '$post_id'
                        )
            ");
            
            
        }catch(\Illuminate\Database\QueryException $ex){
            dd($ex);
        }


        if($location == 'home'){
            redirect()->to("/home");
        }
        elseif(substr($location, 0, 1) == 'profile'){
            return  redirect()->to("/profile/".substr($location, 8, strlen($location)));
        }
        else{
            return redirect()->to("/post/$post_id");
        }
    }
}
