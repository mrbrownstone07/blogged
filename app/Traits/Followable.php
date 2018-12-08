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

        if(!DB::select("select * from follows where follows_id = '$hash_id'")){
            try{
                DB::insert("INSERT INTO follows (follows_id, followee, follower, follow_time) values ('$hash_id', '$followee', '$follower', '$created_at') ");
            }catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
            }
        }
   
        return redirect()->to('/findPeople');
    }
}

