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
        $user = DB::select("SELECT * FROM users WHERE id = '$id'");
        $room = DB::select("SELECT * FROM room_log WHERE room_id = '$room_id'");

        if(!$room){
            return view('potato')->with('msg', 'Is 13 Monkeys a real thing ? Are you From the future ? 
                                            <br> because this room does not exist
                                            <br> request sent by <b> @'.Auth::user()->name.'</b>');
        }

        $notifications = self::getNotifications();
        
        $topics = DB::select("SELECT * FROM room_topics, users
                                WHERE topic_of_room = '$room_id' 
                                AND topic_owned_by = id ORDER BY topic_created_at DESC ");
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
                                AND topic_of_room = '$request->topic_room'
                            ");

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
        $check = DB::select("SELECT * FROM room_members WHERE member_id= '$id' AND room_id_ref = '$room_id'");

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

    public function showRoomMembers($room_id){
        $members = DB::select("SELECT * FROM room_members, users 
                                WHERE room_id_ref = '$room_id'
                                AND member_id = id");
        $id = Auth::user()->id;

        $notifications = self::getNotifications();
        $user = DB::select("SELECT * FROM users WHERE id = '$id'");
        $room = DB::select("SELECT * FROM room_log WHERE room_id = '$room_id'");
        $room = DB::select("SELECT * FROM room_log WHERE room_id = '$room_id'");
       
        return view('rooms.member') ->with('notifications', $notifications)
                                    ->with('usrData', $user[0])
                                    ->with('room', $room[0])
                                    ->with('members', $members);
    }

    public function deletTopic($topic_id){
        $check = DB::select("SELECT * FROM room_topics WHERE topic_id = '$topic_id'");

        if(!$check){
            $msg = 'You stink! <br> request sent by <b> @'.Auth::user()->name. '</b>';
            return view('potato')->with('msg', $msg);
        }

        if($check[0]->topic_owned_by != Auth::user()->id){
            $msg = 'Unauthorized Request ! <br> request sent by <b> @'.Auth::user()->name. '</b>';
            return view('potato')->with('msg', $msg);
        }

        DB::delete("DELETE FROM topic_comment_log WHERE commented_on = '$topic_id'");
        db::delete("DELETE FROM room_topics WHERE topic_id = '$topic_id'");
        
        return redirect()->to('/show_room/'.$check[0]->topic_of_room)->with('success', 'post deleted');
  
    }

    public function removeMember($mem_id, $room_id){
        $owner = DB::select("SELECT * FROM room_log WHERE room_id = '$room_id'");
        $owner = $owner[0]->room_owner;

        if(Auth::user()->id == $mem_id || Auth::user()->id == $owner){
            
            DB::delete("DELETE FROM room_members WHERE room_id_ref = '$room_id' AND member_id = '$mem_id'");
            DB::delete("DELETE FROM room_topics WHERE topic_of_room = '$room_id' AND topic_owned_by = '$mem_id'");

            return redirect()->to('/show_room_members/'.$room_id)
                                ->with('succsess', 'Rmoved user from group');
        }
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
