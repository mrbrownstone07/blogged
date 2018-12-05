<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;


class ProfilesController extends Controller
{
    public function index($slug){
        
        return view('profiles.index');
    }

    public function uploadPhoto(Request $request){
        $file = $request->file('pic');
        $fileName = $file->getClientOriginalName();
        $path = 'public/img/user_imgs';
        
        
        $id = Auth::user()->id;
        $query = "update users set profile_pic = '$fileName' where id = '$id'";
        
        DB::update($query);
        
        $file->move(public_path('img/user_imgs/' ,$fileName));
    
        return $fileName;

    }

}
