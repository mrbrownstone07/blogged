<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }
</style>

<div class="card card_marg container content_Section text-center">
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
        <h3> {{Auth::user()->name}} </h3>
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

        
 <div class="card card_marg container content_Section text-center cotentsection card_margin">
    <div class="card-title">
        informations
        <a href="/editInfo">
            <img src="{{ URL::to('img/icons/edit.png')}}" alt="image not found" class="icon_wrap">    
        </a>
        <hr>        
    </div>
    @if (!empty($data))
        <div class="card-body card_marg" style="margin-top: -30px;">
            
            <div class="row">
               <h4> Bio </h4> 
            </div>      
            <div class="col-md-12" style="margin-top:-10px;">
                {{$data->bio}}
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                   Lives in {{$data->city}}, {{$data->country}} 
                </div>         
            </div>
            
        </div>
                
    @endif

</div>
    

   