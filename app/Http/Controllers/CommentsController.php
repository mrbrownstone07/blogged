<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;
class CommentsController extends Controller
{
    public function store(Request $request){
        
        $post_id = $request->post_id;
        $comment = $request->comment;
        $location = $request->path;
        
        $user = Auth::user()->id;
        //dd($commented_at);
        $commented_at = Carbon::now()->toDateTimeString();
        try{
            
            DB::insert("INSERT INTO comments_log 
                        (commented_on, commented_by, commented_at, comment) 
                        VALUES ('$post_id', '$user', '$commented_at', '$comment') ");
            
        }catch(\Illuminate\Database\QueryException $ex){
            dd($ex);
        }
    }
}
