<style>
    .transparent{
        background-color: rgba(44, 44, 44, 0.7) !important;
        color:snow;
    }
    .no_wrap{
        padding: 0px;
        margin:0px;
    }
    .nav{
        background-color: transparent !important;
        {{--  font-weight: bolder;  --}}
    }

    .nav_links{
        color:skyblue !important;
    }
</style>

@extends('layouts.indexPageLayout')
@section('content')
    <div class="container container-fluid row h-100">
        <div class="col-sm-12 my-auto">
            <div class="jumbotron no_wrap transparent">
                
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
                
                <hr> 

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

                <div class="row r">
                    <div class="col-md-3 text-center">
                        <a class="nav-link nav_links" href="/about_us">About us</a> 
                    </div>
                    <div class="col-md-3 text-center">
                        <a class="nav-link nav_links" href="/contact_us">Contact us</a>
                    </div>
                    <div class="col-md-3 text-center">
                        <a class="nav-link nav_links" href="/faq">FAQ</a>
                    </div>           
                    <div class="col-md-3 text-center">
                        <a class="nav-link nav_links" href="/blog"> Blog </a>  
                    </div>                                                 
                </div>              
            </div>
        </div>
    </div>
@endsection

