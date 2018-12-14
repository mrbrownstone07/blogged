<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }

    #post_btn{
        display: none
    }

</style>

@extends('layouts.profile_master')

@section('left_section')
    @include('profiles.sections.left_section.profilePic')
    @include('profiles.sections.left_section.followFollowing')
    @include('profiles.sections.left_section.informations')   
@endsection

@section('mid_section')
    @include('inc.Ermsg')




    <div id="edit_post" class="card shadow-sm card_marg text-center cotentsection"
        onmouseover="addShadow('edit_post')" onmouseout="removeShadow('edit_post')" >
        <div class="card-header">
                Share your thoughts
                <a href="">
                    <img src="{{ URL::to('img/icons/post.png')}}" alt="image not found" class="icon_wrap">    
                </a>
        </div>

        
        <div class="card-body card_marg" style="">

            
            {!! Form::open(['action' => ['PostsController@update', $post->post_id], 'method' => 'POST']) !!}
            
                @csrf
                <div class="form-group row">    
                    <div class="col-md-12">
                        {!! Form::text('title', $post->title , ['class' => ['form-control', 'form-rounded'], 'placeholder' => 'title']) !!}
                    </div>         
                </div>
                <hr>
                <div class="form-group row">  
                    <div class="col-md-12">
                        {!! Form::textarea('body', $post->body, ['class' => ['form-control', 'form-rounded'], 
                            'placeholder' => "what's in your mind", 'id' => 'article-ckeditor']) !!}
                    </div>         
                </div>

                {!! Form::hidden('_method', 'PUT') !!}
                
                <div class="form-group row">  
                    <div class="col-md-12">
                        {!! Form::submit('Edit', ['class' => 'btn btn-outline-success']) !!}
                    </div>         
                </div>     
            
            {!! Form::close() !!}
                        
        </div>
    </div> 

@endsection

@section('right_section')
    
@endsection