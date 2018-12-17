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


<div id="f" class="card shadow-sm card_bottom card_margin card_marg container content_Section text-center fixed-side">
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
                @if ($postCount->p == 0 || Auth::user()->id != $usrData->id)

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
                @if ($followers->f == 0 || Auth::user()->id != $usrData->id)

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
                @if ($following->f == 0 || Auth::user()->id != $usrData->id)
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

        {{--  check if the user follows the auth user  --}}
        @if (Auth::user()->id != $usrData->id)
            @php
                $auid = Auth::user()->id;
                $check = DB::select("SELECT * FROM follows 
                                         WHERE follower = '$usrData->id'
                                         AND followee = '$auid'
                                    ");
                
            @endphp

            @if(!empty($check))
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <small> {{'@'. $usrData->name}} Follows You </small> 
                    </div>
                </div>
            @endif
              
        @endif

        {{--  check if the auth user follows the user  --}}
        @if (Auth::user()->id != $usrData->id)
            <hr>
            @php
                $auid = Auth::user()->id;
                $check = DB::select("SELECT * FROM follows 
                                        WHERE follower = '$auid'
                                        AND followee = '$usrData->id'
                                    ");
                
            @endphp

            @if(!empty($check))
                
                <div class="row">
                    <div class="col-md-12">
                        <small> Your are following {{'@'. $usrData->name}} </small> 
                    </div>  
                </div>
                <div class="row card_margin">          
                    <div class="col-md-12">
                        <a href="/unfollowFrompProfileView/{{$usrData->id}}">
                            <img src="{{URL::to('img/icons/cross.png')}}" alt="" 
                                class="p_icon_wrap" style="width: 15px;height: 15px;"><br>
                            <small> Unfollow </small>
                            </a> 
                    </div>
                </div>
            @else
                <a href="/followFrompProfileView/{{$usrData->id}}">
                    <img src="{{URL::to('img/icons/follow.png')}}" alt="" 
                        class="icon_wrap">
                    <small> Follow {{'@'. $usrData->name}} </small>
                </a>
            @endif  
        @endif
    </div>
</div>