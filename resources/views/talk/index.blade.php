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
    .bar_set{
        position: relative;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    .bar_set:hover{
        overflow-y: scroll;
    }
</style>

@php
$location = $_SERVER['REQUEST_URI'];  
@endphp
@extends('layouts.talkLayout')

@section('left_section')
    @include('talk.sideBar')
@endsection

@section('mid_section')
    @include('talk.showText')
@endsection

@section('right_section')
    @if ($location[1] == 's')
        @include('talk.setting')
    @endif
    
@endsection