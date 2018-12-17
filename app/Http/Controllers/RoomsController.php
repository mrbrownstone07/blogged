<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
class RoomsController extends Controller
{
    public function index($slug){
        $id = Auth::user()->id;
        $user = DB::select("SELECT * FROM users WHERE id = '$id'");
        $notifications = self::getNotifications();
        $userRooms = DB::select("SELECT * FROM room_log WHERE room_owner = '$id'");
        $memberRooms = DB::select("SELECT * FROM room_members, room_log 
                                    WHERE member_id = '$id'
                                    AND room_id_ref = room_id
                                ");
        
        return view('rooms.index')  ->with('notifications', $notifications)
                                    ->with('usrData', $user[0])
                                    ->with('owned_rooms', $userRooms)
                                    ->with('joined_rooms', $memberRooms);
    }

    public function create(Request $request){
        $id = Auth::user()->id;
        $check = DB::select("SELECT * from room_log WHERE room_name = '$request->name'");

        if($check){
            return redirect()->to('/dicussion_rooms/Auth::user()->slug')->with('error', 'Duplicate name, please select another name');
        }else{
            DB::insert("INSERT INTO room_log (room_owner, room_name) VALUES ('$id', '$request->name')");
            return redirect()->to('/dicussion_rooms/Auth::user()->slug')->with('success', 'Created Dicussion Room'.$request->name);
        }
    }

    public function show($room_id){
        $id = Auth::user()->id;
        $room = DB::select("SELECT * FROM room_log WHERE room_id = '$room_id'");
        $notifications = self::getNotifications();
        $user = DB::select("SELECT * FROM users WHERE id = '$id'");
        $topics = DB::select("SELECT * FROM room_topics, users
                                WHERE topic_of_room = '$room_id' 
                                AND topic_owned_by = id");
        $members = DB::select("SELECT * FROM room_members, users 
                                WHERE room_id_ref = '$room_id'
                                AND id = member_id 
                            ");
        
        //dd($room);
        return view('rooms.room')   ->with('room', $room[0])
                                    ->with('notifications', $notifications)
                                    ->with('usrData', $user[0])
                                    ->with('topics', $topics)
                                    ->with('members', $members);
    }

    public function createTopic(Request $request){
        $id = Auth::user()->id;

        //dd($request);
        $check = DB::select("SELECT * 
                                FROM room_topics 
                                WHERE topic = '$request->topic'
                                AND topic_of_room = '$request->topic_room'");

        if($check){
            return redirect()->to('/show_room/'.$request->topic_room)->with('error', 'Exactly Duplicate of a topic created before');
        }else{
            $created_at = Carbon::now()->toDateTimeString();
            DB::insert("INSERT INTO room_topics (topic_owned_by, topic_of_room, topic, topic_created_at)
                        VALUES ('$id', '$request->topic_room', '$request->topic', '$created_at')");
            return redirect()->to('/show_room/'.$request->topic_room)->with('success', 'new topic created successfully');
                    
        }
    }

    public function joinRoom($room_id){
        $id = Auth::user()->id;
        $check = DB::select("SELECT * FROM room_members WHERE member_id= '$id'");

        if($check){
            return redirect()->to('/show_room/'.$room_id)->with('error', 'Already a member of this room');
        }else{
            
            $joined = Carbon::now()->toDateTimeString();
            DB::insert("INSERT INTO room_members 
                        (room_id_ref, member_id, joined) 
                        VALUES ('$room_id', '$id', '$joined') ");
            return redirect()->to('/show_room/'.$room_id)->with('success', 'welcome to our Discussion Room');
        }
        
    }

    public function storeComment(Request $request){
        $id = Auth::user()->id;
        $created_at = Carbon::now()->toDateTimeString();
        DB::insert("INSERT INTO topic_comment_log (commented_on, commented_at, commented_by, comment)
                    VALUES ('$request->topic_id', '$created_at', '$id', '$request->comment')
                 ");

        return redirect()->to('/show_room/'.$request->room_id);
        
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
}
