<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $id = Auth::user()->id;  
        $notifications = self::getNotifications();
        $posts = self::getPosts();
        $reactions = self::getReactions();

        return view('home')->with('notifications', $notifications)
                            ->with('posts', $posts)
                            ->with('reactions', $reactions);
    }

    public function getNotifications(){
        $id = Auth::user()->id;
        $notifications = DB::select( "SELECT * 
                                        FROM 
                                        notifications_log, users
                                        WHERE 
                                        user_to_be_notified = '$id'
                                        AND notification_from = users.id
                                        ORDER BY notification_send_at DESC
                                    ");
        return $notifications;       
    }

    public function getposts(){
        $id = Auth::user()->id;  
        $posts = DB::select("   SELECT * 
                                FROM posts p
                                LEFT JOIN users u   
                                ON(u.id = p.owner_id) 
                                WHERE EXISTS(
                                    SELECT * 
                                    FROM follows f 
                                    WHERE f.followee = u.id 
                                    AND f.follower = '$id'
                                )
                                

                                UNION

                                SELECT * 
                                FROM posts, users
                                WHERE id = owner_id
                                AND id = '$id'
                                
                                
                                ORDER BY time DESC
                                ");

        return $posts;
    }

    public function getReactions(){
        $id = Auth::user()->id;
        $reactions = DB::select("SELECT * 
                            FROM reacts 
                            WHERE reacts.liked_post IN (
                                SELECT posts.post_id 
                                FROM posts
                                WHERE posts.owner_id IN (
                                    SELECT follows.followee
                                    FROM follows
                                    WHERE follows.follower = '$id'
                                )
                            )

                            UNION

                            SELECT * 
                            FROM reacts
                            WHERE reacts.liked_post IN (
                                SELECT posts.post_id
                                FROM posts
                                WHERE posts.owner_id = '$id'
                            )");

        return $reactions;
    }
    
}
