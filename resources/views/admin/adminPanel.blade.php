@extends('layouts.admin_master')

@section('left_section')
    @include('admin.adminSideBar')    
@endsection

@section('mid_section')
    <div class="card">
        <div class="card-header bg-white text-center">
            WEB SITE STATS
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    @php
                        $tpost = DB::select("SELECT count(post_id) as total FROM posts")
                    @endphp
                    <h4> {{$tpost[0]->total}} </h4>
                </div>

                <div class="col-md-4 text-center">
                    @php
                        $tuser = DB::select("SELECT count(id) as total FROM users")
                    @endphp
                    <h4> {{$tuser[0]->total}} </h4>
                    
                </div>

                <div class="col-md-4 text-center">
                    @php
                        $troom = DB::select("SELECT count(room_id) as total FROM room_log")
                    @endphp
                    <h4> {{$troom[0]->total}} </h4>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    <img src="{{ URL::to('img/icons/post.png')}}" alt="image not found" class="" style="width:30px;height:30px">
                </div>

                <div class="col-md-4 text-center">
                    <img src="{{ URL::to('img/icons/sex.png')}}" alt="image not found" class="" style="width:35px;height:35px">
                </div>

                <div class="col-md-4 text-center">
                        <img src="{{ URL::to('img/icons/room.png')}}" alt="image not found" class="" style="width:35px;height:35px">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center">
                    Posts
                </div>

                <div class="col-md-4 text-center">
                    Users
                    
                </div>

                <div class="col-md-4 text-center">
                    Discussion Rooms
                    
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>

    <div class="card">
        <div class="card-header text-center bg-white">
            <div class="row">
                <div class="col-md-12">
                    Users From
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-4 text-right">
                            <b> country Name </b>
                        </div>
                        <div class="col-md-4 text-left">
                            <b> users </b>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                    <hr style="margin-bottom:0px">
                    @php
                        $countrys = DB::select("SELECT country, count(profile_id) as pep FROM profile 
                                            GROUP BY country ")
                    @endphp
                    @foreach ($countrys as $c)
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-4 text-right">
                            {{$c->country}}
                        </div>
                        <div class="col-md-4 text-left">
                            {{$c->pep}}
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                    <hr class="divider">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection