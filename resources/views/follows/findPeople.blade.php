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
    {{--  .card_size{
        width: 300px;
        height: 300px;
    }  --}}
</style>

@extends('layouts.profile_master')

@section('left_section')
    @include('profiles.sections.left_section.profilePic')
    @include('profiles.sections.left_section.followFollowing')
@endsection

{{--  @section('mid_section')
<div class="card non_bottom text-center">
    <div class="card-title" style="margin-bottom: -10px;">
        <h5> People You May Know </h5> 
    </div>
    <hr>
    <div class="card-body">
        <div class="card-deck">
            <div class="row">
                @foreach ($people as $user)
                    <div class="col-md-12">
                        <div class="card card_size card_bottom">
                            <div class="card-img-top card_margin">
                                <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                    alt="image not found" class="img_wrap rounded-circle">
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="/profile/{{$user->slug}}"> <h5> {{'@'.$user->name}} </h5> </a>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        @php
                                            $followers = DB::select("SELECT name FROM users WHERE users.id IN(
                                                SELECT follower FROM follows WHERE followee = '$user->id')");
                                        @endphp
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
                            <div class="card card_size card_bottom">
                                <div class="card-img-top card_margin">
                                    <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                        alt="image not found" class="img_wrap rounded-circle">
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="/profile/{{$user->slug}}"> <h5> {{'@'.$user->name}} </h5> </a>
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
    @if(count($people) > 0)
        <div class="card text-center">
            <div class="card-header">
                People You May Know 
            </div>
            
            @foreach($people as $person)
                <div class="jumbotron no_wapper border-bottom" style="background-color:white;">
                        <div class="card-img-top ">
                                <img src="{{ URL::to('img/user_imgs/' . $person->profile_pic) }}" 
                                    alt="image not found" class="img_wrap rounded-circle">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/profile/{{$person->slug}}"> <h5> {{'@'.$person->name}} </h5> </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            {{$person->email}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <small> {{$person->fname .' '. $person->lname }} </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                
                                @php
                                    $id = Auth::user()->id;
                                    $query = "SELECT * FROM follows f LEFT JOIN users
                                    ON (f.follower = id) WHERE EXISTS 
                                    (SELECT 1 FROM follows a WHERE follower = '$id' AND f.follower = a.followee)
                                    AND f.followee = '$person->id' ";
                                    //dd($query);
                                    $followers = DB::select($query);
                                    
                                    //dd($followers);
                                    $count = (count($followers));
                                    $other = $count - 2;
                                @endphp
                                <b>
                                    Followed by
                                    @if ($count > 2) 
                                        @foreach ($followers as $i => $follower)
                                            @if($i == 2)
                                                @break
                                            @endif
                                            <a href="/profile/{{$follower->slug}}"> {{'@'. $follower->name }} </a>, 
                                        @endforeach
                                        and
                                        {{$other == 1? " $other other." : " $other others."}}
                                    @else
                                        @if ($count == 2) 
                                            <a href="/profile/{{$followers[0]->slug}}"> {{'@'.$followers[0]->name}}  </a>
                                            and 
                                            <a href="/profile/{{$followers[1]->slug}}"> {{'@'.$followers[1]->name}}  </a>
                                        @endif
                                        @if ($count == 1)                                        
                                            <a href="/profile/{{$followers[0]->slug}}"> {{'@'.$followers[0]->name}}  </a>   
                                        @endif
                                    @endif
                                </b>                                       
                            </div>
                        </div>
                        <hr>
                        <a href="/follow/{{$person->id}}">
                            <img src="{{URL::to('img/icons/follow.png')}}" alt="" 
                                class="icon_wrap">
                            Follow
                        </a>
                </div>      
            @endforeach
        </div>
    @endif

    @if(count($users) > 0)
        <div class="card text-center">
            <div class="card-header">
                Find People 
            </div>
            
            @foreach($users as $user)
                <div class="jumbotron no_wapper border-bottom" style="background-color:white;">
                        <div class="card-img-top card_bottom">
                                <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                    alt="image not found" class="img_wrap rounded-circle">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/profile/{{$user->slug}}"> <h5> {{'@'.$user->name}} </h5> </a>
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
                        <div class="row">
                            <div class="col-md-12">
        
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
    @endif
@endsection