
<style>
    .show_link{
        text-decoration: inherit;
    }
</style>

@php
    $location = $_SERVER['REQUEST_URI'];
    $location = ($location[1] == 'h') ? 
        substr($location, 1, 4) : 
            str_replace('/', '_', substr($location, 1, strlen($location))) ;   
@endphp



<div class="card shadow-sm  card_marg card_bottom text-center cotentsection">
    <div class="card-header">
        @if($location[0] == 'h')
            Your Home page
        @else
            {{'@'.substr($location, 8, strlen($location))."'s posts"}}
        @endif

        <img src="{{ URL::to('img/icons/post.png')}}" alt="image not found" class="icon_wrap">      
    </div>

    <div class="card-body card_marg" style="padding:0px; background-color:whitesmoke">
        @if(count($posts) == 0)
            <div class="jumbotron jumbotron-fluid text-center whitebg card_bottom">
                <h4> No posts </h4>
            </div>
        @endif
        @foreach ($posts as $p)
        {{--  <div class="card card_bottom">  --}}
           
            <div id="b{{$p->post_id}}" class="jumbotron jumbotron-fluid whitebg card_bottom" style="padding:20px"
                onmouseover="addShadow('b{{$p->post_id}}')" onmouseout="removeShadow('b{{$p->post_id}}')">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 text-left">
                            
                                @if (empty($usrData))
                                <a href="/profile/{{$p->slug}}">  
                                    <img src="{{ URL::to('img/user_imgs/' . $p->profile_pic) }}" 
                                        alt="image not found" class="rounded-circle img-thumbnail" style="width:50px; length:50px">
                                    {{'@'. $p->name}}
                                </a>                                      
                                @else
                                <a href="/profile/{{$usrData->slug}}">
                                    <img src="{{ URL::to('img/user_imgs/' . $usrData->profile_pic) }}" 
                                        alt="image not found" class="rounded-circle img-thumbnail" style="width:50px; length:50px">
                                    {{'@'. $usrData->name}}
                                </a>      
                                @endif

                            </div>
                            @if($p->id == Auth::user()->id)
                                <div id="setting_d" class="col-md-6 text-right">
                                    <a id="Dropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="{{ URL::to('img/icons/settings.png')}}" alt="image not found" class="icon_wrap">
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <h5 class="dropdown-header"> Settings </h5>
                                        <hr class="divider">
                                        <a class="dropdown-item" href="/post/{{$p->post_id}}/edit">
                                            Edit 
                                        </a>
                    
                                        <a id="deleteBtn" class="dropdown-item" href="#" data-target="#deletePost" data-toggle="modal" data-postId="1">
                                            Delete    
                                        </a>
                                    </div>   
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <div class="container">
                                <div class="col-md-12 text-left">
                                    {{$p->title}}           
                                </div> 
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2 pull-left">

                                @php
                                    $likes = 0;
                                    $liked_flag = 0;
                                    
                                    if(!empty($reactions))
                                    foreach($reactions as $react){
                                        if($react->reaction == 1 && $react->liked_post == $p->post_id ){
                                            $likes++;
                                            if($react->liker_id == Auth::user()->id)
                                                $liked_flag = 1;
                                        }
                                    }                                    
                                @endphp

                                @if ($liked_flag == 0)
                                    <a href="/like/{{$p->post_id}}/{{Auth::user()->id}}/{{$location}}" id="icon_link">
                                        <img src="{{ URL::to('img/icons/like.png')}}" alt="image not found" class="p_icon_wrap">                                         
                                    </a>
                                    {{$likes}}                                     
                                @endif

                                @if ($liked_flag == 1)
                                    <a href="/like/{{$p->post_id}}/{{Auth::user()->id}}/{{$location}}" id="icon_link">
                                        <img src="{{ URL::to('img/icons/likedIcon.png')}}" alt="image not found" class="p_icon_wrap">
                                        
                                    </a>
                                    {{$likes}}                                     
                                @endif

                            </div>
                            <div class="col-md-2 pull-left" onclick="showTog('comments_Section{{$p->post_id}}')">
                                    @php
                                        $comments = DB::select("SELECT * 
                                                                FROM comments_log 
                                                                INNER JOIN users 
                                                                ON (commented_by = id) 
                                                                WHERE commented_on = '$p->post_id'
                                                    ");
                                    @endphp
                                
                                    <img src="{{ URL::to('img/icons/comment.png')}}" alt="image not found" class="p_icon_wrap">
                                    {{count($comments)}}
                                
                            </div> 
                            <div class="col-md-2 pull-left">
                                    <a href="/posts/{{$p->post_id}}" class="show_link">
                                        <img src="{{ URL::to('img/icons/show.png')}}" alt="image not found" class="p_icon_wrap">
                                        Show
                                    </a>
                            </div> 
                            {{--  time here  --}}

                            <div class="col-md-6 text-right">
                                @php
                                    $d= (new Carbon\Carbon( $p->time))->diffForHumans();
                                @endphp
                                <small class="col-md-8 text-right"> Posted:  {{$d}} </small>
                            </div> 

                        </div>                        
                    </div>
                </div> 
                @include('profiles.sections.mid_section.comment_section')  
            </div>
        {{--  </div>  --}}
                    
        @endforeach 
    </div>
</div>

{{--  delete post modal  --}}


<script type="text/javascript">

    function showTog(id){
        var el = document.getElementById(id);
        
        if(el.style.display === "none"){
            el.style.display = "block";
            var t = el.id.substr(16);
            t = "comm"+t;
            var text_box = document.getElementById(t);
            text_box.style['height'] = '40px';
            var b = "btn"+el.id.substr(16);
            $('#'+t).keydown(function(e){
                if(e.keyCode == 13 && !e.shiftKey){
                    e.preventDefault();
                    $("#"+b).trigger('click');
                }
            });
        }    
        else el.style.display = "none";
    }
</script>





