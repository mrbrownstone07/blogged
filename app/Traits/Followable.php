<?php

namespace App\Traits;
use Carbon\Carbon;
use Auth;
use DB;
trait Followable{

    public function check(){
        return 'trats';
    }

    public function follow($followee){

        $follower = Auth::user()->id;
        $hash_id = md5($followee . $follower);
        $created_at = Carbon::now()->toDateTimeString();
        $notification_id = md5($hash_id.''.$created_at);

        if(!DB::select("select * from follows where follows_id = '$hash_id'")){
            try{
                DB::insert("INSERT INTO follows (follows_id, followee, follower, follow_time) values ('$hash_id', '$followee', '$follower', '$created_at') ");
                
                DB::insert("INSERT INTO notifications_log (
                                            notification_id,
                                            notification_type
                                        ) 
                                        VALUES (
                                            '$notification_id',
                                            '1'
                                        )");

                DB::insert("INSERT INTO follow_notification (
                                            follow_noti_id,
                                            notification_send_at, 
                                            user_to_be_notified, 
                                            notification_from 
                                        )
                                        VALUES(
                                            '$notification_id',
                                            '$created_at',
                                            '$followee',
                                            '$follower'
                                        )");
                
            }catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
            }
        }
   
        return redirect()->to('/findPeople');
    }
}

