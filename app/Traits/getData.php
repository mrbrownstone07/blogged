<?php

namespace App\Traits;
use Carbon\Carbon;
use Auth;
use DB;

trait getData{
    public function getUserData($user_id){
        $usrData = DB::select("SELECT * 
                                FROM users 
                                WHERE id = '$id'
                            ");

        return $userData;
    }
}