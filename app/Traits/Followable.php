<?php

namespace App\Traits;
use Auth;
use DB;
trait Followable{

    public function check(){
        return 'trats';
    }

    public function follow($followee){

        $follower = Auth::user()->id;
        $hash_id = md5($followee . $follower);

        if(!DB::select("select * from follows where id = '$hash_id'")){
            try{
                DB::insert("INSERT INTO follows (id, followee, follower) values ('$hash_id', '$followee', '$follower') ");
            }catch(\Illuminate\Database\QueryException $ex){
    
            }
        }

        
        
        
        
        return redirect()->to('/findPeople');
    }
}

