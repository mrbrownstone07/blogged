<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;

class FollowsController extends Controller
{
    public function index(){

        
        if(Auth::check()) {
            $uid = Auth::user()->id;
            $users = DB::select("SELECT * FROM users u LEFT JOIN profile p on (u.id = p.user_id) WHERE u.id != '$uid'");

            return view('follows.findPeople')->with('users', $users);
        }

     
    }

    public function followRequest($followee_id){
        return Auth::user()->follow($followee_id);
    }
}
