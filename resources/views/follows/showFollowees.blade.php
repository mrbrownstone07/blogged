<style>
    .img_wrap{
        width: 100px;
        height: 100px;
    }
    .card_margin{
        margin-top: 10px;
    }
    .icon_wrap{
        widht:12px;
        height: 12px;
    }
    .card_bottom{
        margin-bottom: 20px !important;
    }
</style>

@extends('layouts.profile_master')

@section('left_section')
    @include('profiles.sections.left_section.profilePic')
    @include('profiles.sections.left_section.followFollowing')
    @include('profiles.sections.left_section.informations')  
@endsection 

@section('mid_section')
    <div class="card text-center">
        <div class="card-header">
            People You Follow
        </div>

        @foreach($followees as $f)
            <div id="showFollowees{{$f->follows_id}}" class="jumbotron shadow-sm whitebg border-bottom"
                onmouseover="addShadow('showFollowees{{$f->follows_id}}')" 
                    onmouseout="removeShadow('showFollowees{{$f->follows_id}}')">
                    <div class="col-md-12card_bottom ">
                            <img src="{{ URL::to('img/user_imgs/' . $f->profile_pic) }}" 
                                alt="image not found" class="img_wrap rounded-circle">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/profile/{{$f->slug}}"> <h5> {{'@'.$f->name}} </h5> </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        {{$f->email}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $f->follow_time)->format('d M Y');
                            @endphp
                            <small> following since {{" ". $date}} </small>
                        </div>
                    </div>
                    <hr>
                    <a href="/unfollow/{{$f->id}}">
                        <img src="{{URL::to('img/icons/unfollow.png')}}" alt="" 
                            class="icon_wrap">
                        <span> <small> Unfollow</small> </span>
                    </a>

            </div>      
        @endforeach
    </div>
@endsection