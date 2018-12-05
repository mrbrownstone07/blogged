<style>
    .content_section{
        padding: 10px;
    }
    .img_wrap{
        width: 100px;
        height: 100px;
    }
    .modal_img_wrap{
        width: 500px;
        height: 500px;
    }
</style>


@extends('layouts.3_sections')

@section('left_section')
    
    <div class="card container content_Section">

        <div class="card-img-top center">
            <div class="row">
                <div class="col-6">
                    <a href="#" data-target="#myModal" data-toggle="modal">
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

    <div class="modal" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Change profile picture</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
              
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row container">
                            <div class="col">
                                <img src="{{ URL::to('img/user_imgs/' . Auth::user()->profile_pic . '.png') }}" 
                                    alt="image not found" class="modal_img_wrap">
                            </div>    
                        </div>
                        <div class="row container" style="padding-top:10px;">
                            <div class="col">

                                <form action="/uploadPhoto" method="post" enctype="multipart/form-data"> 
                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                    <input type="file" name="pic" class="form-control-file"/>
                                    <br>
                                    <input type="submit" class="btn btn-outline-success" name="btn" id="img_submit"/>
                                </form>

                            </div>
                        </div>  
                    </div>
              
                    <!-- Modal footer -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
    </div>
    
@endsection

@section('mid_section')
  
@endsection

@section('right_section')

@endsection