<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Auth;
use DB;


class ProfilesController extends Controller
{
    public function index($slug){
        $id = Auth::user()->id;
        $data = DB::select("select * from profile where user_id = '$id' ");

        if($data){
            return view('profiles.index')->with('data', $data[0]);
        }else{
            return view('profiles.index');;  
        }
    }

    public function uploadPhoto(Request $request){
     
        if($request->hasFile('pic')){
            $pic = $request->file('pic');
            $fileName = $pic->getClientOriginalName();

            $hash_token = md5($fileName);
            if(DB::select("select * from users where  pHash = '$hash_token'")){
                return view('profiles.index');
            }

            $id = Auth::user()->id;

            $ext = pathinfo($fileName, PATHINFO_EXTENSION);
            $fileName = $id . Auth::user()->name . Carbon::now()->toDateTimeString() .'.'. $ext;
            $path = public_path(). '/img/user_imgs';

            $pic->move($path, $fileName);
    
            $query = "update users set profile_pic = '$fileName', pHash = '$hash_token'  where id = '$id'"; 
            $is_update = DB::update($query);
            
            $message  = "";
    
            if($is_update){
                $message = "Sucsses_ Updated your profile picture succesfully";
            }else{
                $message = "Error_ could not update your profile picture at this moment";
            }
        
            return view('profiles.index')->with('message', $message);
        }

        return redirect()->to('/profiles.index')->refresh()->with('message', 'empty file uploaded');
    }

    public function editInfo(){
        $id = Auth::user()->id;
        $data = DB::select("select * from profile where user_id = '$id' ");

        if($data){
            return view('profiles.editInfo')->with('data', $data[0]);
        }else{
            return view('profiles.loadInfo');  
        }   
    }

    public function storeInfo(Request $request){
        $fname = '';
        $lname = '';
        $city = '';
        $about  = '';
        $bio = ''; 
        $id = Auth::user()->id;
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        
        if($request->Input('fname') != ''){
            $fname = $request->input('fname');
        }

        if($request->input('lname') != ''){
            $lname = $request->input('lname');
        }

        if($request->input('city') != ''){
            $city = $request->input('city');
        }
        if($request->input('country') != ''){
            $country = $request->input('country');
        }

        if($request->input('about') != ''){
            $about  = $request->input('about');
        }

        if($request->input('bio') != ''){
            $bio = $request->input('bio');
        }
        
       
        try{
            $query = "insert into profile 
                    (city, country, fname, lname, about, bio, user_id, created_at, updated_at) 
                    values 
                    ('$city', '$country', '$fname', '$lname', '$about', '$bio', '$id', '$created_at', '$updated_at') ";
            DB::insert($query);
        }catch(\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
        }

        return redirect()->action('ProfilesController@editInfo');
    }

    public function updateInfo(Request $request){

        $id = Auth::user()->id;

        $fname = $request->input('fname');
        $lname = $request->input('lname');
        $city = $request->input('city');
        $country = $request->input('country');
        $about  = $request->input('about');
        $bio = $request->input('bio');
        $updated_at = Carbon::now()->toDateTimeString();
        
        try{
            $query = " update profile set fname = '$fname', lname = '$lname', city = '$city', country = '$country',
                        about = '$about', bio = '$bio', updated_at = '$updated_at' ";
            DB::update($query);
        }catch(\Illuminate\Database\QueryException $ex){
            dd($ex->getMessage());
        }

        return redirect()->action('ProfilesController@editInfo');
    }
}
