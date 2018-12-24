<style>
    .bar_set{
        position: relative;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    .bar_set:hover{
        overflow-y: scroll;
    }

    #showOnline::-webkit-scrollbar-track{
        background-color: #FFFFFF;
    }

    #showOnline::-webkit-scrollbar{
        width: 8px;
        background-color: rgba(106, 97, 97, 0.55);
    }

    #showOnline::-webkit-scrollbar-thumb{
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
    
    <div  class="card Fixed shadow" style=" height: 87%">
        <div class="card-header bg-white text-center ">  
            <img src="{{ URL::to('img/icons/talk.png') }}" 
                alt="image not found" class="p_icon_wrap"> 
            <span> Talk </span>   
        </div>
        <div id="showOnline" class="card-body bar_set" style="padding-left:5px; padding-right:5px; padding-top:5px">
    
            {{--  @php
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
            @endphp  --}}
    
    
    
            {{--  @foreach ($contacts as $user)
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
            @endforeach  --}}
        </div>
    </div>

<script>

    window.onload = function(){
        
        alert('ypp');       
    }

    function lastText(){
        fetchLastText();
        setTimeout(lastText, 3000);     
    }

    function fetchLastText(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }),

        $.ajax({
            method: 'GET',
            url: '{{URL::to('last_text')}}',
            data: {},
            success:function(data){
                if(data != ''){
                    $('#showOnline').html(data);
                    
                }else{
                    console.log('909');
                }
            }  
        });        
    }   
</script>