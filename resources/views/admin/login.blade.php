@extends('layouts.globalLayout')

@section('content')

<div class="container wrap">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-white text-center">{{ __('Admin Login') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="/admin_log_in_request">
                            @csrf
                            <div class="row">
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-2 text-right">
                                    <label for="name"> Admin  </label>
                                </div>
                                <div class="col-md-5">
                                    {!! Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'hash id', 'autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-2 text-right">
                                    <label for="password"> password</label>
                                </div>
                                <div class="col-md-5">
                                    {!! Form::password('password', ['class' => 'form-control', 'id' => 'pswd']) !!}    
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2">

                                </div>
                                <div class="col-md-2 text-center">
                                    
                                    
                                    
                                </div>
                                <div class="col-md-5">
                                    {!! Form::submit('login', ['class' => 'btn btn-success']) !!}   
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    @include('inc.Ermsg')   
@endsection