<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function about_us(){
        return view('pages.about');
    }

    public function contact_us(){
        return view('pages.contact');
    }

    public function faq(){
        return view('pages.faq');
    }

    public function blog(){
        $posts = DB::select('SELECT * FROM posts, users WHERE owner_id = id order by time DESC');

        return view('pages.blog')->with('posts', $posts);

    }
}
