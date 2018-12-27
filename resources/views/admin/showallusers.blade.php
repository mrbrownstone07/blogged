@extends('layouts.admin_master')

@section('left_section')
    @include('admin.adminSideBar')    
@endsection

@section('mid_section')
    <div class="container">
        @if (!empty($users))
            @foreach ($users as $user)
                <div class="card">
                    <div class="card-header bg-white">
                        <div class="row">
                            <div class="col-md-1">
                                <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                    alt="image not found" class="rounded-circle img-thumbnail" style="width:50px; length:50px">
                            </div>
                            <div class="col-md-6 text-left">
                               <a href="/profile/{{$user->slug}}"> {{'@' . $user->name}} </a> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-6">
                                <small> {{$user->email}} </small>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                
            @endforeach
        @endif
    </div>
@endsection