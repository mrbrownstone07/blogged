<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }

</style>

    <div class="card shadow-sm card_marg container content_Section text-center fixed-side">
        <div class="card-img-top">
            <div class="row">
                <div class="col-12">
                    @if(Auth::user()->id == $usrData->id)
                        <a href="#" data-target="#change_pro_pic" data-toggle="modal">
                            <img src="{{ URL::to('img/user_imgs/' . $usrData->profile_pic) }}" 
                                alt="image not found" class="rounded-circle img_wrap img-thumbnail">
                        </a>
                    @endif

                    @if(Auth::user()->id != $usrData->id)
                        <a href="#">
                            <img src="{{ URL::to('img/user_imgs/' . $usrData->profile_pic) }}" 
                                alt="image not found" class="rounded-circle img_wrap img-thumbnail">
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-title">
            <a href="/profile/{{$usrData->slug}}" style="text-decoration:none">
                <h3> {{'@'. $usrData->name}} </h3>
            </a>
            
            <small>{{$usrData->email}}</small>
        </div>    
    </div>

   
@if (!empty($message))
    <script>
        window.location = "/profile/{{$usrData->slug}}"
    </script>
    <div class="alert alert-secondary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{$message}}
    </div>
@endif  