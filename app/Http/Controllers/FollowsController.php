<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use Auth;
use DB;

class FollowsController extends Controller
{
    public function index(){

        if(Auth::check()) {
            $uid = Auth::user()->id;
            $query = "
                SELECT * 
                FROM users LEFT JOIN profile ON(id = user_id) 
                WHERE id NOT IN
                ( SELECT followee FROM follows WHERE follower = '$uid' ) AND id != '$uid'
            ";
            $users = DB::select($query);

            $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$uid'");
            $following = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$uid'");
            //dd($following);
            return view('follows.findPeople')->with('users', $users)->with('followers', $followers[0])->with('following', $following[0]);
        }

    }

    public function followRequest($followee_id){
        return Auth::user()->follow($followee_id);
    }

    public function showFollowers(){
        $uid = Auth::user()->id;
        $followers = DB::select("SELECT * FROM users u join follows f on (follower = u.id) WHERE followee = '$uid'");

        //dd($followers);
        return view('follows.showFollowers');
    }

    public function showFollowees(){
        $uid = Auth::user()->id;
        $followees = DB::select("SELECT * FROM users u join follows f on (followee = u.id) 
                        WHERE follower = '$uid' ORDER BY follow_time DESC");

        $data = DB::select("select * from profile where user_id = '$uid' ");

        $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$uid'");
        $following = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$uid'");

        if($data){
            return view('follows.showFollowees')->with('followees', $followees)->with('data', $data[0])->with('followers', $followers[0])->with('following', $following[0]);

        }else{
            return view('follows.showFollowees')->with('followees', $followees)->with('followers', $followers[0])->with('following', $following[0]);
        }
        return view('follows.showFollowees')->with('followees', $followees);
    }

    public function unfollowRequest($followee_id){
        $follower = Auth::user()->id;
        $hash_id = md5($followee_id . $follower);
        // echo $hash_id;
        // echo $follower;
        // echo $followee_id;
        if(DB::select("select * from follows where follows_id = '$hash_id'")){
            try{
               
               DB::delete("delete from follows where follows_id = '$hash_id' ");
               
            }catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
            }
        }else{
            echo "1234";
        }
   
        return redirect()->to('/show_followees');        
    }

}
