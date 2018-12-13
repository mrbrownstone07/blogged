<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ReactsController extends Controller
{
    public function handleRequest($post_id, $liked_by){
        
        $check = DB::select("SELECT * FROM reacts WHERE liker_id = '$liked_by' AND liked_post = '$post_id' ");
       
        if($check){
            if($check[0]->reaction == 1)
                DB::update("UPDATE reacts SET reaction = 0 WHERE liker_id = '$liked_by' AND liked_post = '$post_id' ");
            else 
                DB::update("UPDATE reacts SET reaction = 1 WHERE liker_id = '$liked_by' AND liked_post = '$post_id' ");
        }else{

            DB::insert("INSERT INTO reacts (reaction, liker_id, liked_post) VALUES (1, '$liked_by', '$post_id')");
        }      
        return redirect()->to("/home");
    }

    
}
