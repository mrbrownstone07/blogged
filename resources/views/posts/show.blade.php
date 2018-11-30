@extends('layouts.globalLayout')

@section('content')
    {{--  <div class="jumbotron">
        <
    </div>  --}}
    @if (count($post) === 1)
        @foreach ($post as $item)
            <div class="jumbotron">
                <div class="card">
                    <img class="card-img-top" src="holder.js/100x180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{$item->title}}</h4>
                        <small class="card-title">posted on: {{ $item->time }}</small>
                        <hr>
                        <p class="card-text">{{$item->body}}</p>
                    </div>
                </div>
            </div>
        @endforeach       
    @else
        <p> Post could not be found! </p>
    @endif

@endsection
