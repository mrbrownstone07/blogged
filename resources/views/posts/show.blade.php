@extends('layouts.profile_master')

@section('mid_section')
    @if (!empty($post))
        @php
            $p = $post
        @endphp
               <div class="card">
                    <div class="card-header"> 
                        <div class="row">
                            <div class="col-md-6 push-left">
                                <a href="/profile/{{$p->slug}}">  
                                    <img src="{{ URL::to('img/user_imgs/' . $p->profile_pic) }}" 
                                        alt="image not found" class="rounded-circle img-thumbnail" style="width:50px; length:50px">
                                    {{'@'. $p->name}}
                                </a>
                                @php
                                    $t= (new Carbon\Carbon( $p->time))->diffForHumans();
                                @endphp 
                                
                            </div>
                            <div class="col-md-6 push-right">                               
                                @if($p->id == Auth::user()->id)
                                    <div id="setting_d" class="text-right">
                                        <a id="Dropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            <img src="{{ URL::to('img/icons/settings.png')}}" alt="image not found" class="icon_wrap">
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <h5 class="dropdown-header"> Settings </h5>
                                            <hr class="divider">
                                            <a class="dropdown-item" href="/post/{{$p->post_id}}/edit">
                                                Edit 
                                            </a>
                        
                                            <a id="deleteBtn" class="dropdown-item" href="#" data-target="#deletePost_show" data-toggle="modal" data-postId="1">
                                                Delete    
                                            </a>
                                        </div>   
                                    </div>
                                @endif                                                               
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-3 text-right">
                                    <small class="card-title">posted: {{ $t}}</small>
                            </div>                           
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title text-center">{{$p->title}}</h4>
                        <hr>
                        <div class="card-text">
                            {!!$p->body!!}
                        </div>
                        <hr> 
                    </div>
                    @php
                        $reactions = DB::select("SELECT * FROM reacts WHERE liked_post = '$p->post_id'");
                    
                        $comments = DB::select("SELECT * 
                                                FROM comments_log 
                                                INNER JOIN users 
                                                ON (commented_by = id) 
                                                WHERE commented_on = '$p->post_id'
                                    ");
                                   
                        $location = $_SERVER['REQUEST_URI'];
                        $location = ($location[1] == 'h') ? 
                            substr($location, 1, 4) : 
                                str_replace('/', '_', substr($location, 1, strlen($location))) ;   
                            
                    @endphp
                    
                        <div class="row">
                            <div class="col-md-2 text-center">
                                @include('components.likes')
                            </div>
                            <div class="col-md-6 text-left" onclick="showTog('comments_Section{{$p->post_id}}')">
                                <img src="{{ URL::to('img/icons/comment.png')}}" alt="image not found" class="p_icon_wrap">
                                {{count($comments)}}    
                            </div>  
                        </div>                        
                    @include('profiles.sections.mid_section.comment_section')
                    <br> 
                </div>
                   
    @else
        <p> Post could not be found! </p>
    @endif

@endsection

<div class="modal" id="deletePost_show">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <p class="modal-title">Delete post?</p> 
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          
            <!-- Modal body -->
            <div class="modal-body">
                <input type="hidden" name="p" id="hidden_value" value=""/>
                <div class="row">
                    <div class="container">
                        <p class="text-left"> 
                            Are you sure you want to delete this post? 
                            <br> You can edit it if you just need to change something. 
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-outline-success" data-dismiss="modal">No, Cancel</button>                         
                    </div>
                    <div class="col-md-1">                         
                        {!! Form::open(['action' => ['PostsController@destroy', $p->post_id], 'method' => 'POST', 'class' => '']) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::submit('Yes, Delete', ['class' => 'btn btn-outline-danger']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

<script>
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
