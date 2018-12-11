
<style>
    .whitebg{
        background-color: white;
    }
    .p_icon_wrap{
        width: 20px;
        height: 20px;
    }
    icon_link: hover{
        color:red;
    }
</style>



<div class="card shadow  card_margin card_marg text-center cotentsection">
    <div class="card-header">
        your posts
        <img src="{{ URL::to('img/icons/post.png')}}" alt="image not found" class="icon_wrap">      
    </div>
    @if(count($posts) == 0)
        <div>

        </div>
    @endif
    <div class="card-body card_marg" style="padding:0px; background-color:whitesmoke">
        @if(count($posts) == 0)
            <div class="jumbotron jumbotron-fluid whitebg card_bottom">
                post something....
            </div>
        @endif
        @foreach ($posts as $p)
            
            <div id="b" class="jumbotron jumbotron-fluid whitebg card_bottom" style="padding:20px"
                onmouseover="addShadow('b')" onmouseout="removeShadow('b')">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <img src="{{ URL::to('img/user_imgs/' . Auth::user()->profile_pic) }}" 
                                    alt="image not found" class="rounded-circle img-thumbnail" style="width:50px; length:50px">
                                {{'@'. $usrData->name}}         
                            </div>

                            <div class="col-md-6 text-right">
                                <li class="dropdown">
                                    <a id="Dropdown" class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        <img src="{{ URL::to('img/icons/settings.png')}}" alt="image not found" class="icon_wrap">
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <h5 class="dropdown-item"> Settings </h5>
                                            <a class="dropdown-item" href="/post/{{$p->post_id}}/edit">
                                                Edit
                                            </a>
                
                                            <a id="deleteBtn" class="dropdown-item" href="#" data-target="#deletePost" data-toggle="modal" data-postId="1">
                                                Delete   
                                            </a>
                                    </div>
                                </li> 
                            </div>


                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>

                        </div>
                        <hr>
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
                                <a href="" id="icon_link">
                                    <img src="{{ URL::to('img/icons/like.png')}}" alt="image not found" class="p_icon_wrap">
                                    Like 
                                </a>

                            </div>
                            <div class="col-md-2 pull-left">
                                <a href="" id="icon_link">
                                    <img src="{{ URL::to('img/icons/comment.png')}}" alt="image not found" class="p_icon_wrap">
                                    Comment 
                                </a>
                            </div> 
                            {{--  time here  --}}
                            @php
                                $d = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $p->time)->format('M d Y');
                            @endphp
                            <small class="col-md-8 text-right"> Posted on:  {{$d}} </small>
                        </div>                        
                    </div>
                </div> 
               
                <div class="container container-fluid whitebg card_margin">
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['', 'method' => 'POST']) !!}
                
                                @csrf
                                <div class="form-group row">    
                                    <div class="col-md-10">
                                        {!! Form::textarea('comment', '' , ['class' => 'form-control', 'placeholder' => 'comment', 'rows' => '1']) !!}
                                    </div> 
                                    <div class="col-md-2">
                                        {!! Form::submit('Comment', ['class' => 'btn btn-outline-success']) !!}
                                    </div>       
                                </div>    
                            
                            {!! Form::close() !!}  
                        </div>
                    </div>
                </div>
            </div>
            
        @endforeach 
    </div>
</div>

{{--  delete post modal  --}}
@if (count($posts) > 0)
<div class="modal" id="deletePost">
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
                            {!! Form::open(['action' => ['PostsController@destroy', $p->post_id],
                                'method' => 'POST', 'class' => '']) !!}

                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::submit('Yes, Delete', ['class' => 'btn btn-outline-danger']) !!}
                                
                            {!! Form::close() !!}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

@endif

<script>
    $(document).on("click", ".open-deletePost", function(){
        var post_id = $(this).data('postId');
        $(".modal-body #post_id").val(post_id);
    })

</script>




