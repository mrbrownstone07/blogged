@extends('layouts.profile_master')

@section('left_section')
    @include('profiles.sections.left_section.profilePic')
    @include('profiles.sections.left_section.followFollowing')
    @include('components.trending')
@endsection

@section('mid_section')
    @include('profiles.sections.mid_section.createPosts')
    @include('profiles.sections.mid_section.showPosts')
@endsection

@section('right_section')
    @include('talk.showOnline')
@endsection

<script type="text/javascript">

</script>