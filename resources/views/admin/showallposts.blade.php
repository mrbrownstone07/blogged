@extends('layouts.admin_master')

@section('left_section')
    @include('admin.adminSideBar')    
@endsection

@section('mid_section')
    <div class="container">
        @if (!empty($posts))
            @foreach ($posts as $post)
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-md-6">
                                {{"@" . $post->name}}
                            </div>
                            <div class="col-md-6 text-right">
                                <a href="/deletePost/{{$post->post_id}}"> Delete </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                @php
                                    $d= (new Carbon\Carbon( $post->time))->diffForHumans();    
                                @endphp
                                <small> {{$d}} </small>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4> <b> {{$post->title}} </b> </h4>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div  class="col-md-12">
                                {!!$post->body!!}
                            </div>
                        </div>
                    </div>
                </div>

                <br>
            @endforeach
        @endif
    </div>
@endsection