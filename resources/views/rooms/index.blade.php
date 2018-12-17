@extends('layouts.profile_master')

@section('left_section')
    @include('profiles.sections.left_section.profilePic')
@endsection

@section('mid_section')
    <div class="card">
        <div class="card-header">
            <div class="col-md-12 text-center">
                Your dicussion rooms
            </div>
        </div>
        <div class="jumbotron bg-white">
            <hr>
            <div class="card-title text-center">
                Your rooms
            </div>
            <hr>
            <div class="card-body">
              
        
        
            </div> 
        </div>
        <div class="jumbotron bg-white">
            <hr>
            <div class="card-title text-center">
                Rooms you are member of
            </div>
            <hr>
            <div class="card-body">


            </div>
        </div> 
    </div>
@endsection

@section('right_section')
    
@endsection

