<style>
    .bg_{
        background-color: rgba(36, 36, 44, 0.7)  !important;
        color: aliceblue;
    }

    .post_block{
        color: white !important ;
        margin-top: 10px; 
    }

    hr{
        height: 1px;
        color: #ffffff;
        background-color: #ffffff;
        border: none;
    }
    h2{
        text-align: center;
    }
    a{
        text-decoration: none;
    }
</style>
@extends('layouts.globalLayout')

@section('content')
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <div class="jumbotron bg_">
        <h2>Posts</h2>
        <hr>
        @if (count($posts) > 0)
            @foreach ($posts as $p)

                <div class="well post_block container">
                    <h4>
                        <a href="/post/{{$p->id}}">{{$p->title}}</a>
                    </h4>
                    <small>
                        posted on: {{$p->time}}
                    </small>
                </div>
                <hr>
            @endforeach
        @else
            <p> No posts yet ! wow </p>   
        @endif
            
    </div>
@endsection