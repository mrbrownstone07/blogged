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
</style>

@extends('layouts.profile_master')

@section('left_section')
    @include('profiles.sections.left_section.profilePic')
    @include('profiles.sections.left_section.followFollowing')
    @include('profiles.sections.left_section.informations')
@endsection

@section('mid_section')
    <div class="card non_bottom text-center ">
        <div class="card-header bg-white">
            Edit Informations  
        </div>

        <div class="card-body text-center">
            
            <form action="/storeInfo" method="post" style="margin-top:20px">
            
                @csrf
                <div class="form-group row">
                    {!! Form::label('fname', 'First Name:', ['class' => 'col-md-3 col-form-label text-md-right']) !!}   
                    <div class="col-md-6">
                        {!! Form::text('fname', '', ['class' => 'form-control']) !!}
                    </div>         
                </div>

                <div class="form-group row">
                    {!! Form::label('lname', 'Last Name:', ['class' => 'col-md-3 col-form-label text-md-right']) !!}   
                    <div class="col-md-6">
                        {!! Form::text('lname', '', ['class' => 'form-control']) !!}
                    </div>         
                </div>

                <div class="form-group row">
                    {!! Form::label('city', 'City:', ['class' => 'col-md-3 col-form-label text-md-right']) !!}   
                    <div class="col-md-6">
                        {!! Form::text('city', '', ['class' => 'form-control']) !!}
                    </div>         
                </div>
                
                <div class="form-group row">
                    {!! Form::label('country', 'Country:', ['class' => 'col-md-3 col-form-label text-md-right']) !!}   
                    <div class="col-md-6">
                        {!! Form::text('country', '', ['class' => 'form-control']) !!}
                    </div>         
                </div>

                <div class="form-group row">
                    {!! Form::label('about', 'About:', ['class' => 'col-md-3 col-form-label text-md-right']) !!}   
                    <div class="col-md-6">
                        {!! Form::textarea('about', '', ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) !!}   
                    </div>         
                </div>

                <div class="form-group row">
                    {!! Form::label('bio', 'Bio:', ['class' => 'col-md-3 col-form-label text-md-right']) !!}   
                    <div class="col-md-6">
                        {!! Form::textarea('bio', '', ['class' => 'form-control', 'rows' => '4', 'cols' => '50']) !!}   
                    </div>         
                </div>

                
                {!! Form::submit('Submit', ['class' => 'btn btn-outline-success']) !!}
                
            </form>  
        </div>

        <br>

    </div>


        
@endsection

@section('right_section')
    @include('talk.showOnline')
@endsection


<script>
        window.onload = function (){
            alert(1);
        }
    
</script>