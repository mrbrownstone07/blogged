@extends('layouts.talkLayout')

@section('left_section')
    @include('talk.showOnline')
@endsection

@section('mid_section')
    @include('talk.showText')
@endsection

@section('right_section')
    @include('talk.setting')
@endsection