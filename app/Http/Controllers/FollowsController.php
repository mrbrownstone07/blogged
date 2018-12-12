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
            $postsCount = DB::select("SELECT COUNT(*) as p FROM posts WHERE owner_id = '$uid'");
            $usrData = DB::select("SELECT * FROM users WHERE id = '$uid'");
            $notifications = self::fetchNotifications($uid);
            //dd($following);
            return view('follows.findPeople')->with('users', $users)
            ->with('followers', $followers[0])
            ->with('following', $following[0])
            ->with('postCount', $postsCount[0])
            ->with('usrData', $usrData[0])
            ->with('notifications', $notifications);
        }

    }

    public function followRequest($followee_id){
        return Auth::user()->follow($followee_id);
    }

    public function followFromProfileRequest($followee_id){
        return Auth::user()->followFromProfile($followee_id);
    }

    public function showFollowers(){
        $uid = Auth::user()->id;
        $people_followers = DB::select("SELECT * FROM users u join follows f on (follower = u.id) WHERE followee = '$uid'");
        $notifications = self::fetchNotifications($uid);
        $followersCount = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$uid'");
        $followeesCount = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$uid'");
        $postsCount = DB::select("SELECT COUNT(*) as p FROM posts WHERE owner_id = '$uid'");
        $usrData = DB::select("SELECT * FROM users WHERE id = '$uid'");
        $data = DB::select("select * from profile where user_id = '$uid' ");

        if($data){
            return view('follows.showFollowers')->with('people_followers', $people_followers)
            ->with('data', $data[0])
            ->with('followers', $followersCount[0])
            ->with('following', $followeesCount[0])
            ->with('postCount', $postsCount[0])
            ->with('usrData', $usrData[0])
            ->with('notifications', $notifications);


        }else{
            return view('follows.showFollowers')->with('people_followers', $people_followers)
            ->with('followers', $followersCount[0])
            ->with('following', $followeesCount[0])
            ->with('postCount', $postsCount[0])
            ->with('usrData', $usrData[0])
            ->with('notifications', $notifications);

        }
        return view('follows.showFollowers')->with('followers', $followers)
        ->with('notifications', $notifications);
    }

    public function showFollowees(){
        $uid = Auth::user()->id;
        $followees = DB::select("SELECT * FROM users u join follows f on (followee = u.id) 
                        WHERE follower = '$uid' ORDER BY follow_time DESC");

        $data = DB::select("select * from profile where user_id = '$uid' ");

        $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$uid'");
        $following = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$uid'");
        $postsCount = DB::select("SELECT COUNT(*) as p FROM posts WHERE owner_id = '$uid'");
        $usrData = DB::select("SELECT * FROM users WHERE id = '$uid'");
        $notifications = self::fetchNotifications($uid);

        if($data){
            return view('follows.showFollowees')->with('followees', $followees)
            ->with('data', $data[0])
            ->with('followers', $followers[0])
            ->with('following', $following[0])
            ->with('postCount', $postsCount[0])
            ->with('usrData', $usrData[0])
            ->with('notifications', $notifications);

        }else{
            return view('follows.showFollowees')->with('followees', $followees)
            ->with('followers', $followers[0])
            ->with('following', $following[0])
            ->with('postCount', $postsCount[0])
            ->with('usrData', $usrData[0])
            ->with('notifications', $notifications);
        }
        return view('follows.showFollowees')
        ->with('followees', $followees)
        ->with('notifications', $notifications);
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

    public function unfollowFromProfileRequest($followee_id){
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
   
        $s = DB::select("SELECT * FROM users WHERE id = '$followee_id' ");
        $data = $s[0];
        
        return redirect()->to("/profile/$data->slug");       
    }

    public function fetchNotifications($id){
        $notifications = DB::select("   SELECT * 
                                        FROM 
                                        notifications_log, follow_notification, users
                                        
                                        WHERE 
                                        notification_id = follow_noti_id 
                                        AND user_to_be_notified = '$id'
                                        AND notification_from = id
                                        ORDER BY notification_send_at DESC
                                    ");
        return $notifications;       
    }

    public function removeFollower($follower){
        $followee_id = Auth::user()->id;
        $hash_id = md5($followee_id . $follower);

        if(DB::select("select * from follows where follows_id = '$hash_id'")){
            try{
               
               DB::delete("delete from follows where follows_id = '$hash_id' ");
               
            }catch(\Illuminate\Database\QueryException $ex){
                dd($ex->getMessage());
            }
        }else{
            echo "1234";
        }
   
        return redirect()->to('/show_followers'); 

    }
}
