<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Auth;
use DB;


class ProfilesController extends Controller
{
    public function index($slug){
        $id = Auth::user()->id;
        $data = DB::select("select * from profile where user_id = '$id' ");
        $usrData = DB::select("SELECT * FROM users WHERE id = '$id'");

        $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$id'");
        $following = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$id'");
        $postsCount = DB::select("SELECT COUNT(*) as p FROM posts WHERE owner_id = '$id'");
        $posts = DB::select("SELECT * FROM posts WHERE owner_id = '$id' ORDER BY time DESC");

        $notifications = DB::select("SELECT * 
                                    FROM 
                                    notifications_log, follow_notification, users
                                    
                                    WHERE 
                                    notification_id = follow_noti_id 
                                    AND user_to_be_notified = '$id'
                                    AND notification_from = id
                                ");
        //dd($followers);
        if($data){
            return view('profiles.index')->with('data', $data[0])
            ->with('followers', $followers[0])
            ->with('following', $following[0])
            ->with('postCount', $postsCount[0])
            ->with('posts', $posts)
            ->with('usrData', $usrData[0])
            ->with('notifications', $notifications);

        }else{
            return view('profiles.index')->with('followers', $followers[0])
                                        ->with('following', $following[0])
                                        ->with('postCount', $postsCount[0])
                                        ->with('posts', $posts)
                                        ->with('usrData', $usrData[0])
                                        ->with('notifications', $notifications);
        }
    }

    public function uploadPhoto(Request $request){
        $slug = Auth::user()->slug;
        if($request->hasFile('pic')){
            $pic = $request->file('pic');
            $fileName = $pic->getClientOriginalName();
            $id = Auth::user()->id;
            

            $hash_token = md5($fileName);
            if($hash_token === DB::select("select pHash from users where  id = '$id'")){
                return view('profiles.index');
            }

            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileName = $id . Auth::user()->name . Carbon::now()->toDateTimeString() .'.'. $ext;
            $path = public_path(). '/img/user_imgs';

            $pic->move($path, $fileName);
    
            $query = "update users set profile_pic = '$fileName', pHash = '$hash_token'  where id = '$id'"; 
            $is_update = DB::update($query);
            
            $message  = "";
    
            if($is_update){
                $message = "Sucsses_ Updated your profile picture succesfully";
            }else{
                $message = "Error_ could not update your profile picture at this moment";
            }

            $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$id'");
            $following = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$id'");
            $posts = DB::select("SELECT COUNT(*) as p FROM posts WHERE owner_id = '$id'");
            return redirect()->to("/profile/$slug");
            
        }

        return redirect()->to("/profile/$slug")->with('message', 'empty file uploaded');
    }

    public function editInfo(){
        $id = Auth::user()->id;
        $data = DB::select("select * from profile where user_id = '$id' ");
        $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$id'");
        $following = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$id'");
        $posts = DB::select("SELECT COUNT(*) as p FROM posts WHERE owner_id = '$id'");
        $usrData = DB::select("SELECT * FROM users WHERE id = '$id'");
        $notifications = self::getNotifications($id);
     
        
        
        if($data){
            return view('profiles.editInfo')->with('data', $data[0])
                                            ->with('followers', $followers[0])
                                            ->with('following', $following[0])
                                            ->with('postCount', $posts[0])
                                            ->with('usrData', $usrData[0])
                                            ->with('notifications', $notifications);
        }else{
            return view('profiles.loadInfo')->with('followers', $followers[0])
                                            ->with('following', $following[0])
                                            ->with('postCount', $posts[0])
                                            ->with('usrData', $usrData[0])
                                            ->with('notifications', $notifications);  
        }   
    }

    public function storeInfo(Request $request){
        $fname = '';
        $lname = '';
        $city = '';
        $about  = '';
        $bio = ''; 
        $id = Auth::user()->id;
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        
        if($request->Input('fname') != ''){
            $fname = $request->input('fname');
        }

        if($request->input('lname') != ''){
            $lname = $request->input('lname');
        }

        if($request->input('city') != ''){
            $city = $request->input('city');
        }
        if($request->input('country') != ''){
            $country = $request->input('country');
        }

        if($request->input('about') != ''){
            $about  = $request->input('about');
        }

        if($request->input('bio') != ''){
            $bio = $request->input('bio');
        }
        
       
        try{
            $query = "insert into profile 
                    (city, country, fname, lname, about, bio, user_id, created_at, updated_at) 
                    values 
                    ('$city', '$country', '$fname', '$lname', '$about', '$bio', '$id', '$created_at', '$updated_at') ";
            DB::insert($query);
        }catch(\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
        }

        return redirect()->action('ProfilesController@editInfo');
    }

    public function updateInfo(Request $request){

        $id = Auth::user()->id;

        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $city = $request->input('city');
        $country = $request->input('country');
        $about  = $request->input('about');
        $bio = $request->input('bio');
        $updated_at = Carbon::now()->toDateTimeString();
        
        try{
            $query = " update profile set fname = '$fname', lname = '$lname', city = '$city', country = '$country',
                        about = '$about', bio = '$bio', updated_at = '$updated_at' where user_id = $id ";
            DB::update($query);
        }catch(\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
        }

        return redirect()->action('ProfilesController@editInfo');
    }

    public function getProfilePicSectionData(){
        $id = Auth::user()->id;
        $data = DB::select("select * from profile where user_id = '$id' ");
        
        return ($data);
    }

    public function getFollowerCount(){
        $id = Auth::user()->id;
        $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$id'");

        return ($followers);
    }

    public function getFolloweeCount(){
        $id = Auth::user()->id;
        $followees = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$id'");
        
        return ($followees);
    }

    public function getNotifications($id){
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

    
}
