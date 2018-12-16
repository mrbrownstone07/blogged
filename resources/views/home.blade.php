@extends('layouts.profile_master')

@section('left_section')
    @include('profiles.sections.left_section.profilePic')
    @include('profiles.sections.left_section.followFollowing')
@endsection

@section('mid_section')
    @include('profiles.sections.mid_section.createPosts')
    @include('profiles.sections.mid_section.showPosts')
@endsection


<script type="text/javascript">

</script>