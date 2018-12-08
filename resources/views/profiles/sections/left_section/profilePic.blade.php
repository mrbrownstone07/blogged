<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }

</style>

<div class="card card_marg container content_Section text-center fixed-side">
    <div class="card-img-top">
        <div class="row">
            <div class="col-12">
                <a href="#" data-target="#change_pro_pic" data-toggle="modal">
                    <img src="{{ URL::to('img/user_imgs/' . Auth::user()->profile_pic) }}" 
                        alt="image not found" class="rounded-circle img_wrap img-thumbnail">
                </a>
            </div>
        </div>
    </div>

    <div class="card-title">
        <a href="/profile/{{Auth::user()->slug}}" style="text-decoration:none">
            <h3> {{'@'. Auth::user()->name}} </h3>
        </a>
        
        <small>{{Auth::user()->email}}</small>
    </div>    
</div>

   
@if (!empty($message))
    <script>
        window.location = "/profile/{{Auth::user()->slug}}"
    </script>
    <div class="alert alert-secondary alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{$message}}
    </div>
@endif