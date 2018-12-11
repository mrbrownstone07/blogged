<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::select('select * from posts');
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' =>'required'
        ]);

        $time = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();
        $id = Auth::user()->id;
        $title = $request->title;
        $body = $request->body;
        $slug = Auth::user()->slug;
        $query = "INSERT INTO posts (
                    title, 
                    body, 
                    time, 
                    owner_id, 
                    updated_at
                ) 
                VALUES (
                    '$title', 
                    '$body', 
                    '$time', 
                    '$id', 
                    '$updated_at'
                )";

        DB::insert($query);

        return redirect()->to("/profile/$slug");
        
    }

    public function show($id)
    {   
        $query = "select * from posts where post_id = '$id'";
        $post = DB::select($query);
        $uid = Auth::user()->id;
        $notifications = self::fetchNotifications($uid);

        return view('posts.show')->with('post', $post)->with('notifications', $notifications);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = DB::select("SELECT * FROM posts WHERE post_id = '$id'");
        $id = Auth::user()->id;
        $data = DB::select("select * from profile where user_id = '$id' ");
        $usrData = DB::select("SELECT * FROM users WHERE id = '$id'");

        $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$id'");
        $following = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$id'");
        $postsCount = DB::select("SELECT COUNT(*) as p FROM posts WHERE owner_id = '$id'");
        $notifications = self::fetchNotifications($id);
        //dd($post);
        return view('posts.edit')   ->with('followers', $followers[0])
                                    ->with('following', $following[0])
                                    ->with('postCount', $postsCount[0])
                                    ->with('post', $post[0])
                                    ->with('usrData', $usrData[0])
                                    ->with('data', $data[0])
                                    ->with('notifications', $notifications);
        
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' =>'required'
        ]);

        $title = $request->title;
        $body = $request->body;
        $updated_at = Carbon::now()->toDateTimeString();

        
        DB::update("UPDATE posts SET title = '$title', body = '$body', updated_at = '$updated_at' WHERE post_id = '$id'");
        
        return redirect("/post/$id/edit")->with('success', 'post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slug = Auth::user()->slug;
       // dd($id);
        DB::delete("DELETE FROM posts WHERE post_id = '$id'");

        return redirect()->to("/profile/$slug")->with('success', 'post deleted');
        
    }



    // DB access funcitons

    public function getFollowerCount($id){
        $followers = DB::select("SELECT COUNT(follower) as f FROM follows WHERE followee = '$id'");

        return ($followers);
    }

    public function getFolloweeCount($id){
        $followees = DB::select("SELECT COUNT(followee) as f FROM follows WHERE follower = '$id'");
        
        return ($followees);
    }

    public function getPostsCount($id){
        $postsCount = DB::select("SELECT COUNT(*) as p FROM posts WHERE owner_id = '$id'");
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

    public function fetchUserPosts($id){
        $posts = DB::select("SELECT * FROM posts WHERE owner_id = '$id' ORDER BY time DESC");

        return $posts;
    }

    public function fetchProfileData($id){
        $data = DB::select("select * from profile where user_id = '$id' ");

        return $data;
    }

    public function fetchUserData($id){
        DB::select("select * from profile where user_id = '$id' ");   
    }


}
