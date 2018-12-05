<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function index($slug){
        
        return view('profiles.index');
    }

    public function changePhoto(){
        return view('profiles.changePhoto');
    }
}
