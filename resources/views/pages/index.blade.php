<style>
    .transparent{
        background-color: rgba(44, 44, 44, 0.7) !important;
        color:snow;
    }
</style>

@extends('layouts.indexPageLayout')
@section('content')
    <div class="container row h-100">
        <div class="col-sm-12 my-auto">
            <div class="jumbotron transparent">
                
                <div class="row text-center">
                    <div class="col">
                        <h1 style="letter-spacing:1px" class="text-uppercase">Blogged</h1>
                    </div>
                </div>
                
                <div class="row text-center">
                    <div class="col">
                        <p style="color:orange" class="text-uppercase">A blog based social networking site </p>
                    </div>
                </div>
                
                <hr> <br> <br> 
                
                <div class="row text-center">
                    <div class="col">
                        <a class="btn btn-success" href="{{ route('login') }}" role="button"> Log-in </a>
                        @if (Route::has('register'))
                        <a class="btn btn-primary" href="{{ route('register') }}"role="button">Register</a>
                        @endif
                    </div>
                </div>           
                
                <br>
                
                <div class="row text-center">
                    <div class="col">
                        <p style="">Join us by registering. <br> Hope you will find intersting 
                            bloggs, contents, and meet some interesting people.
                        </p>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col">
                        @include('inc.navbar')
                    </div>
                </div>                
            </div>
        </div>
    </div>
@endsection