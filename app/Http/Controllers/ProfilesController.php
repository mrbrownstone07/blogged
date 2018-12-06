<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;
use DB;


class ProfilesController extends Controller
{
    public function index($slug){
        
        return view('profiles.index');
    }

    public function uploadPhoto(Request $request){
        if($request->hasFile('pic')){
            
            $id = Auth::user()->id;
            $pic = $request->file('pic');
            $fileName = $pic->getClientOriginalName();
            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileName = $id . Auth::user()->name .'.'. $ext;
            $path = public_path(). '/img/user_imgs';
    
            $pic->move($path, $fileName);
    
            $query = "update users set profile_pic = '$fileName' where id = '$id'"; 
            $is_update = DB::update($query);
            $message  = "";
    
            if($is_update){
                $message = "Sucsses_ Updated your profile picture succesfully";
            }else{
                $message = "Error_ could not update your profile picture at this moment";
            }
        
            return view('profiles.index')->with('message', $message);
        }

        return view('profiles.index')->with('message', 'empty file uploaded');

    }

}
