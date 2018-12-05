<style>
    .content_section{
        padding: 10px;
    }
    .img_wrap{
        width: 100px;
        height: 100px;
    }
</style>

@extends('layouts.3_sections')

@section('left_section')
    
    <div class="card container content_Section">

        <div class="card-img-top center">
            <div class="row">
                <div class="col-6">
                    <a href="/changePhoto" target="myMondal">
                        <img src="{{ URL::to('img/user_imgs/' . Auth::user()->profile_pic . '.png') }}" 
                            alt="image not found" class="rounded-circle img_wrap img-thumbnail">
                    </a>
                </div>
            </div>
        </div>

        <hr>
        <div class="card-title">
            <h3> {{Auth::user()->name}} </h3> 
            <small>{{Auth::user()->email}}</small>
        </div>
        
    </div>
    
@endsection

@section('mid_section')
  
@endsection

@section('right_section')

@endsection