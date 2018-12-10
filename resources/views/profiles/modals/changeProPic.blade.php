<div class="modal" id="change_pro_pic">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                {{--  <h5 class="modal-title">Change profile picture</h5>  --}}
                <p class="modal-title">Change Profile Picture</p> 
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          
            <!-- Modal body -->
            <div class="modal-body">
                <div class="row container text-center">
                    <div class="col">
                        <img src="{{ URL::to('img/user_imgs/' . Auth::user()->profile_pic) }}" 
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
        </div>
    </div>
</div>