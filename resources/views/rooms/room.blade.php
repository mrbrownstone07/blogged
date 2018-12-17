<style>
    button[type=submit].hide {
        display: block;
        position: absolute;
        visibility: hidden;
    }
    .no_wapper{
        padding: 10px;
        margin: 0px;
    }
    .comment_bubble{
        background-color: #F6FBFF;
        border-radius: 1rem;
        
    }
</style>



@extends('layouts.profile_master')

@section('left_section')
    @php
        $has_auth = false; 
    @endphp

    @if($room->room_owner == Auth::user()->id)
        @php
            $has_auth = true;  
        @endphp  
    @else  
        @foreach ($members as $member)
            @if ($member->id == Auth::user()->id)
                @php
                    $has_auth = true; 
                @endphp     
            @endif
        @endforeach
    @endif
    
    @include('profiles.sections.left_section.profilePic')
    @include('rooms.sections.about')
    @if ($has_auth)
        @include('rooms.sections.topicNav')   
    @endif
    
@endsection

@section('mid_section')
        @include('inc.Ermsg')
        <div class="card bg-white card_bottom">
            <div class="card-header">
                <div class="col-md-12 text-center">
                    {{$room->room_name}} 
                </div>
            </div>


            @if ($has_auth)
                <div class="card-body">
                    <form action="/create_topic">  

                        {!! Form::textarea('topic', '', ['class' => 'form-control', 'rows' => '2', ' placeholder' => 'your topic']) !!}
                        {!! Form::hidden('topic_room', $room->room_id, ['class' => 'form-control']) !!}
                        <br>
                        {!! Form::submit('create topic', ['class' => ['form-control', 'btn btn-outline-success']]) !!}

                    </form>
                </div>   
            @else
                <div class="card-body text-center">
                    <a href="/join_room/{{$room->room_id}}">
                        Join This Room 
                        <img src="{{ URL::to('img/icons/join.png')}}" alt="image not found" class="p_icon_wrap">  
                    </a>

                </div>  
            @endif

        </div>
    @if ($has_auth)
        @foreach ($topics as $topic)
            <div id="topic.$topic->topic_id" class="card bg-white card_bottom">
                <div class="card-header">
                    <a href="/profile/{{$topic->slug}}">  
                        <img src="{{ URL::to('img/user_imgs/' . $topic->profile_pic) }}" 
                            alt="image not found" class="rounded-circle img-thumbnail" style="width:50px; length:50px">
                        {{'@'. $topic->name}}
                        @php
                            $d= (new Carbon\Carbon($topic->topic_created_at))->diffForHumans();
                        @endphp 
                    </a> 
                    <small> {{$d}} </small>  
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            {{$topic->topic}}
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            @php
                                $comments = DB::select("SELECT * 
                                                        FROM users, topic_comment_log 
                                                        WHERE id = commented_by
                                                        AND commented_on = '$topic->topic_id'
                                                    ");
                            @endphp

                            @foreach ($comments as $comment)
                                <div id="comments">  
                                    <div class="row">
                                        <div class="col-md-1">
                                            <a href="">
                                                <img src="{{ URL::to('img/user_imgs/' . $comment->profile_pic) }}" 
                                                    alt="image not found" class="rounded-circle" style="width:40px; length:40px">
                                            </a>
                                        
                                        </div>

                                        <div class="col-md-10 text-left">
                                            <div class="container comment_bubble no_wapper">
                                                <a href=""> <b> {{'@'.$comment->name}} </b> </a>
                                                {{$comment->comment}}

                                            </div>

                                            @php
                                                $d= (new Carbon\Carbon($comment->commented_at))->diffForHumans();
                                            @endphp
                                            <small> {{$d}} </small>

                                        </div>
                                        {{-- @if (Auth::check())
                                            <div class="col-md-1">
                                                @if($comment->id == Auth::user()->id)
                                                    <a id="Dropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <img src="{{ URL::to('img/icons/comset.png') }}" alt="image not found" style="width:20px; length:20px"> 
                                                    </a>
                                                
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                        <h5 class="dropdown-item"> Settings </h5>
                                                        <a class="dropdown-item" href="#">
                                                            Edit
                                                        </a>
                                                    
                                                        <a class="dropdown-item" href="/delete_comment/{{$comment->comment_id}}/{{$location}}">
                                                            Delete   
                                                        </a>
                                                    </div>
                                                @endif    
                                            </div>
                                        @endif --}}
                                    </div>
                                </div>   
                                <br>
                            @endforeach
                    <div class="row">
                        <div class="col-md-12">
                            <form action="/store_topic/comment" method="post">
                                @csrf
                                <div class="row">  
                                    <div class="col-md-1 text-left">                                
                                        <img src="{{ URL::to('img/user_imgs/' . Auth::user()->profile_pic) }}" 
                                            alt="image not found" class="rounded-circle" style="width:40px; length:40px">
                                    </div>
                                    <div class="col-md-8">

                                        {!! Form::hidden('room_id', $room->room_id, ['class' => 'form-control']) !!}
                                        {!! Form::hidden('topic_id', $topic->topic_id, ['class' => 'form-control']) !!}
                                        {!! Form::textarea('comment', '' , ['class' => ['form-control'],  'placeholder' => 'comment', 'rows' => '1']) !!}

                                    </div>
                                    <div class="col-md-3">
                                        {!! Form::submit('Comment', ['class' => 'btn btn-md btn-outline-success']) !!}
                                    </div> 
                                </div>    
                            </form>
                        </div>
                    </div>

                        </div>
                    </div>
                </div>

            </div>   
        @endforeach        
    @endif

@endsection


@section('right_section')
    
@endsection



