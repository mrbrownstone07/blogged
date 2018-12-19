<style>
    .bar_set{
        height: 90%;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    #Scrollstyle::-webkit-scrollbar-track{
        
     
    }

    #Scrollstyle::-webkit-scrollbar{
        display: none;
    }

    #Scrollstyle::-webkit-scrollbar-thumb{
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
</style>

<div id="scrollstyle" class="card bar_set">
    <div class="card-body" style="padding-left:5px; padding-right:5px">
        <div class="card-title  text-center">
             
                Talk
            
        </div>
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
                            <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                alt="image not found" class="rounded-circle" style="width:40px; length:40px"> 
                            {{'@'.$user->name." "}}
                            <img src="{{ URL::to('img/icons/active.png') }}" 
                                alt="image not found" class="rounded-circle" style="width:10px; length:10px"> 
                        </div>

                    @else
                    <div class="col-md-1">

                        </div>
                        <div class="col-md-11">
                            <img src="{{ URL::to('img/user_imgs/' . $user->profile_pic) }}" 
                                alt="image not found" class="rounded-circle" style="width:40px; length:40px"> 
                            {{'@'.$user->name." "}}
                            <img src="{{ URL::to('img/icons/offline.png') }}" 
                                alt="image not found" class="rounded-circle" style="width:7px; length:7px"> 
                        </div>
                    @endif    
                </div>
            </div>       
        @endforeach
    </div>
</div>