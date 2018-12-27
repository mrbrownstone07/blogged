<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class AdminController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function login(){
        if(Auth::user()->id == 106){
            return view('admin.adminPanel');
        }
        
    }

    public function showAllPosts(){
        $posts = DB::select("SELECT * FROM posts, users WHERE owner_id = id");
        
        return view('admin.showallposts')->with('posts', $posts);
    }

    public function deletePost($id){

        
        if(Auth::user()->id == 106){
            
            DB::delete("DELETE FROM reacts WHERE  liked_post = '$id'");
            $react_id = DB::select("SELECT * FROM react_notifications WHERE post_reacted = '$id'");

            foreach($react_id as $r){
                DB::delete("DELETE FROM react_notifications WHERE noti_id = '$r->noti_id'");
                DB::delete("DELETE FROM notifications_log WHERE notification_id = '$r->noti_id'");
            

            }

            DB::delete("DELETE FROM comments_log where commented_on = '$id' ");
            $noti_id = DB::select("SELECT * FROM comment_notifications WHERE post_commented = '$id'");

            foreach($noti_id as $i){
                DB::delete("DELETE FROM comment_notifications WHERE comment_noti_id = '$i->comment_noti_id' ");
                DB::delete("DELETE FROM notifications_log WHERE notification_id = '$i->comment_noti_id'");
            }

            DB::delete("DELETE FROM posts WHERE post_id = '$id'");

            return \redirect()->to('/showAllPosts');
        }
    }

    public function showAllUsers(){
        $users = DB::select ("SELECT * FROM users");

        return view('admin.showallusers')->with('users', $users);
    }


}
