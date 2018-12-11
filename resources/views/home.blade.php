@extends('layouts.profile_master')

@section('mid_section')
    @include('profiles.sections.mid_section.createPosts')
    @include('profiles.sections.mid_section.showPosts')
@endsection
