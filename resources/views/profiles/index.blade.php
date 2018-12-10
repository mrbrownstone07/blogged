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
    [v-cloak]{
        display: none;
    }
</style>

<script>

</script>

@extends('layouts.profile_master')

@section('left_section')
    
    @include('profiles.sections.left_section.profilePic')
    @include('profiles.sections.left_section.followFollowing')
    @include('profiles.sections.left_section.informations')
    @include('profiles.modals.changeProPic')
     
@endsection

@section('mid_section')
    @include('profiles.sections.mid_section.createPosts')
    @include('profiles.sections.mid_section.showPosts')
@endsection

@section('right_section')

@endsection

