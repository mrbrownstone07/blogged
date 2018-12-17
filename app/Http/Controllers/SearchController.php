<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SearchController extends Controller
{   
    public function index(){
        return view('pages.search');
    }



    public function search(Request $request){
    
        if($request->ajax()){
            $result = '';
            $users = DB::select("SELECT * FROM users 
                                    WHERE name LIKE '$request->search%' 
                                    OR email LIKE '$request->search%'
                                    OR name LIKE '%$request->search%'
                                ");
            $posts = DB::select("SELECT * FROM posts 
                                    WHERE title LIKE '%$request->search'
                                    OR body LIKE '%$request->search' 
                                    OR title LIKE '%$request->search%' 
                                    OR body LIKE '%$request->search%' 
                                    OR title LIKE '$request->search[0]%'
                                    OR body LIKE '$request->search[0]%'

                                ");
            if($users){
                $result.="<div class='dropdown-header'>users</div><hr class='divider'>";
                foreach($users as $user){
                    $result.= "<div class='container dropdown-item'> <a href= '/profile/$user->slug'>@".$user->name."</a></div>";    
                }

                if($posts){
                    $result.="</div><hr class='divider'><div class='dropdown-header'>posts</div></div><hr class='divider'>";
                    foreach($posts as $p){
                        $result.= "<div class='container dropdown-item'> <a href= '/post/$p->post_id'>"
                                        .$p->title."</a></div>";    
                    } 
                }

                return Response($result);   
            }

            return Response('1234');
        }
    }
}
