<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Connect;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conn = mysqli_connect("127.0.0.1", "root", "ibanezgio", "blogged");
        $res = mysqli_query($conn, "select * from posts order by time desc");
        $conn->close();
        return view('posts.index')->with('posts', $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $conn = mysqli_connect("127.0.0.1", "root", "ibanezgio", "blogged"); 
        $tile = mysqli_real_escape_string($conn, $_REQUEST['title']);
        $body = mysqli_real_escape_string($conn, $_REQUEST['body']);
        $query = "insert into posts (title, body) values ('$tile', '$body')";
        $conn->query($query);
        $conn->close();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $query = "select * from posts where id = '$id'";
        $conn = mysqli_connect("127.0.0.1", "root", "ibanezgio", "blogged");
        $res = mysqli_query($conn, $query);
        $conn->close();

        return view('posts.show')->with('post', $res);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('post.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
