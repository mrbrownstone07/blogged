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
        $is_owner = false;
    @endphp

    @if($room->room_owner == Auth::user()->id)
        @php
            $has_auth = true; 
            $is_owner = true; 
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
@endsection

@section('mid_section')
    <div class="card">
        <div class="card-header bg-white text-center">
            Discussion Room Members
        </div>
        <div class="card-body text-center">
            @foreach ($members as $mem)
                <div class="jumbotron no_wapper shadow-sm whitebg border-bottom">
                    <div class="col-md-12 card_bottom ">
                            <img src="{{ URL::to('img/user_imgs/' . $mem->profile_pic) }}" 
                                alt="image not found" class="img_wrap rounded-circle">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/profile/{{$mem->slug}}"> <h5> {{'@'.$mem->name}} </h5> </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        {{$mem->email}}
                        </div>
                    </div>
                    @if ($is_owner)
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <a href="/remove_member/{{$mem->id}}/{{$room->room_id}}">
                                    <img src="{{ URL::to('img/icons/remove.png') }}" 
                                        alt="image not found" class="p_icon_wrap rounded-circle">
                                    <small> Remove member </small>    
                                </a>
                            </div>
                        </div>
                    @endif
                </div> 
            @endforeach
        </div>
    </div>
@endsection


@section('right_section')
    @include('talk.showOnline')
@endsection