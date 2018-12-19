<style>
    .bar_set{
        position: relative;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    .bar_set:hover{
        overflow-y: scroll;
    }
    #Scrollstyle::-webkit-scrollbar-track{
        background-color: #FFFFFF;
    }

    #Scrollstyle::-webkit-scrollbar{
        width: 8px;
        background-color: rgba(106, 97, 97, 0.55);
    }

    #Scrollstyle::-webkit-scrollbar-thumb{
        background-color: #555;
    }

    .Fixed{
        position: fixed;
        width: 23%;
    }

    .link_fix{
        text-decoration: none;
        color:black;
    }

    .link_fix:hover{
        text-decoration: none;
        color:grey;        
    }
</style>

<div  class="card Fixed h-100">
    <div class="card-header bg-white text-center ">  
            Talk    
    </div>
    <div id="scrollstyle" class="card-body bar_set" style="padding-left:5px; padding-right:5px; padding-top:5px">

        @php
            $uid = Auth::user()->id; 
            $contacts = DB::select("SELECT DISTINCT * FROM users 
                                    WHERE id IN
                                    ((SELECT follower FROM follows WHERE followee = '$uid' ))

                                    UNION

                                    SELECT * FROM users 
                                    WHERE id IN
                                    ((SELECT followee FROM follows WHERE follower = '$uid' ))

                                    ORDER BY name
                                ");
        @endphp



        @foreach ($contacts as $user)
            <div class="jumbotron  no_wrap bg-light" style="margin-bottom:2px; padding:8px">    
                <div class="row">
                    @if (Cache::has('user-is-online-' . $user->id))
                        <div class="col-md-1">

                        </div>
                        <div class="col-md-11">
                            <a href="/show_conversation/{{$user->id}}" class="link_fix">
                                <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                    alt="image not found" class="rounded-circle" style="width:40px; length:40px"> 
                                {{'@'.$user->name." "}}
                                <img src="{{ URL::to('img/icons/active.png') }}" 
                                    alt="image not found" class="rounded-circle" style="width:10px; length:10px"> 
                            </a>
                        </div>

                    @else
                    <div class="col-md-1">

                        </div>
                        <div class="col-md-11">
                            <a href="/show_conversation/{{$user->id}}" class="link_fix">
                            <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                alt="image not found" class="rounded-circle" style="width:40px; length:40px"> 
                            {{'@'.$user->name." "}}
                            <img src="{{ URL::to('img/icons/offline.png') }}" 
                                alt="image not found" class="rounded-circle" style="width:7px; length:7px"> 
                            </a>
                        </div>
                    @endif    
                </div>
            </div>       
        @endforeach
    </div>
</div>