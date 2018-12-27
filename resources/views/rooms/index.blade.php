<style>
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
    @include('profiles.sections.left_section.profilePic')
    @include('rooms.sections.createNew')
    @include('rooms.sections.findRoom')
@endsection

@section('mid_section')
    <div class="card shadow">
        <div class="card-header bg-white">
            <div class="col-md-12 text-center">
                Dicussion Rooms
            </div>
        </div>
        <div class="jumbotron bg-white">
            <hr>
            <div class="card-title text-center">
                Your rooms
            </div>
            <hr class="divider">
            <div class="card-body">
                @if (!empty($owned_rooms))
                    @foreach ($owned_rooms as $index => $room)
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <a href="/show_room/{{$room->room_id}}"> {{($index+1).'. '}} {{$room->room_name}} </a>
                        </div>
                    </div>
                    @endforeach    
                @else
                    <div class="row">
                        <div class="col-md-12 text-center">
                            You dont own any room
                        </div>
                    </div>
                @endif
            </div> 
        </div>
        <div class="jumbotron jumbotron-fluid bg-white">
            <hr>
            <div class="card-title text-center">
                Rooms you are member of
            </div>
            <hr class="divider">
            <div class="card-body">
                @if(empty($joined_rooms))
                    <div class="row">
                        <div class="col-md-12 text-center">
                            You are not member of any discussion room currently
                        </div>
                    </div>
                @else
                    @foreach ($joined_rooms as $index => $room)
                        <div class="row">
                            <div class="col-md-12 text-center">
                                {{($index+1).'  '}} 
                                <a href="/show_room/{{$room->room_id_ref}}"> 
                                    {{$room->room_name}} 
                                </a>
                            </div>
                        </div>  
                    @endforeach
                @endif
            </div>
        </div> 
    </div>
@endsection

@section('right_section')
    @include('talk.showOnline')
@endsection

