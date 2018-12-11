<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }
    .f_icon_wrap{
        width: 25px;
        height: 25px;
    }

</style>


<div id="f" class="card shadow-sm card_margin card_marg container content_Section text-center fixed-side">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <h4> {{$postCount->p}}</h4>
            </div>
            <div class="col-md-4">
                <h4> {{$followers->f}} </h5>
            </div>
            <div class="col-md-4">
                <h4> {{$following->f}} </h5>
                
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                @if ($postCount->p == 0)

                    <img src="{{URL::to('img/icons/post.png')}}" alt="" 
                        class="f_icon_wrap" style="width: 25px;height: 25px;"><br>
                    <small>Posts</small>
                    
                @else

                    <a href="#">
                        <img src="{{URL::to('img/icons/post.png')}}" alt="" 
                            class="f_icon_wrap" style="width: 25px;height: 25px;"><br>
                        <small>Posts</small>
                    </a>
                    
                @endif
            </div>

            <div class="col-md-4">
                @if ($followers->f == 0)

                    <img src="{{URL::to('img/icons/follower.png')}}" alt="" 
                        class="f_icon_wrap" style="width: 25px;height: 25px;"><br>
                    <small>Followers</small>
                    
                @else

                    <a href="/show_followers">
                        <img src="{{URL::to('img/icons/follower.png')}}" alt="" 
                            class="f_icon_wrap" style="width: 25px;height: 25px;"><br>
                        <small>Followers</small>
                    </a>
                    
                @endif
            </div>

            <div class="col-md-4">
                @if ($following->f == 0)
                    <img src="{{URL::to('img/icons/following.png')}}" alt="" 
                        class="f_icon_wrap" style="width: 25px;height: 25px;"><br>
                    <small>Following</small>
                @else
                    <a href="/show_followees">
                        <img src="{{URL::to('img/icons/following.png')}}" alt="" 
                            class="f_icon_wrap" style="width: 25px;height: 25px;"><br>
                        <small>Following</small>
                    </a>   
                @endif
            </div>    
        </div>
    </div>
</div>