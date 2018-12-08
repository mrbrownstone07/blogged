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
@endsection

{{--  @section('mid_section')
    <div class="card non_bottom text-center">
        <div class="card-title" style="margin-bottom: -10px;">
            <h5> Find People </h5> 
        </div>
        <hr>
        <div class="card-body">
            <div class="card-deck">
                <div class="row">
                    @foreach ($users as $user)
                        <div class="col-md-12">
                            <div class="card card_bottom">
                                <div class="card-img-top card_margin">
                                    <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                        alt="image not found" class="img_wrap rounded-circle">
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="http://"> <h5> {{'@'.$user->name}} </h5> </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {{$user->email}}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <small> {{$user->fname .' '. $user->lname }} </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="/follow/{{$user->id}}">
                                        <img src="{{URL::to('img/icons/follow.png')}}" alt="" 
                                            class="icon_wrap">
                                    </a>

                                </div>
                            </div>
                        </div>   
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection  --}}

@section('mid_section')
<div class="card text-center">
    <div class="card_margin card-title" style="margin-bottom: -10px;">
        <h5> Find People </h5> 
    </div>
    <hr>
    @foreach($users as $user)
        <div class="jumbotron border-top border-bottom" style="background-color:white;">
                <div class="card-img-top card_bottom">
                        <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                            alt="image not found" class="img_wrap rounded-circle">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="http://"> <h5> {{'@'.$user->name}} </h5> </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                       {{$user->email}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <small> {{$user->fname .' '. $user->lname }} </small>
                    </div>
                </div>
                <hr>
                <a href="/follow/{{$user->id}}">
                    <img src="{{URL::to('img/icons/follow.png')}}" alt="" 
                        class="icon_wrap">
                </a>
        </div>      
    @endforeach
</div>
@endsection