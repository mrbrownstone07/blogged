<style>
    button[type=submit].hide {
        display: block;
        position: absolute;
        visibility: hidden;
    }
    .no_wapper{
        padding: 10px;
        margin: 0px;
    }
    .comment_bubble{
        background-color: #F6FBFF;
        border-radius: 1rem;
        
    }
</style>

<div id="comments_Section{{$p->post_id}}"  style="display:none">
    <div class="container container-fluid whitebg card_margin" >
        <hr>   
        @php
            $comments = DB::select("SELECT * 
                                    FROM comments_log 
                                    INNER JOIN users 
                                    ON (commented_by = id) 
                                    WHERE commented_on = '$p->post_id'
                        ");
        @endphp

                             
            @foreach ($comments as $comment)
            <div id="comments">  
                <div class="row">
                    <div class="col-md-1">
                        <a href="">
                            <img src="{{ URL::to('img/user_imgs/' . $comment->profile_pic) }}" 
                                alt="image not found" class="rounded-circle" style="width:40px; length:40px">
                        </a>

                    </div>
                        
                    <div class="col-md-10 text-left">
                        <div class="container comment_bubble no_wapper">
                            <a href=""> <b> {{'@'.$comment->name}} </b> </a>
                            {{$comment->comment}}
                        </div>
                    </div>

                    <div class="col-md-1">
                        @if($comment->id == Auth::user()->id)
                            <a id="Dropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ URL::to('img/icons/comset.png') }}" alt="image not found" style="width:20px; length:20px"> 
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <h5 class="dropdown-item"> Settings </h5>
                                <a class="dropdown-item" href="#">
                                    Edit
                                </a>
                
                                <a id="deleteBtn" class="dropdown-item" href="#" data-target="#deletePost" data-toggle="modal" data-postId="1">
                                    Delete   
                                </a>
                            </div>
                        @endif    
                    </div>
                </div>
            </div>   
            <br>
            @endforeach
       
        
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <form action="/store_comment" method="post">
                        @csrf
                        <div class="row">  
                            <div class="col-md-1 text-left">                                
                                <img src="{{ URL::to('img/user_imgs/' . Auth::user()->profile_pic) }}" 
                                    alt="image not found" class="rounded-circle" style="width:40px; length:40px">

                                {!! Form::hidden('path', $location, ['class' => 'form-control']) !!}
                                {!! Form::hidden('post_id', $p->post_id, ['class' => 'form-control']) !!}
                                {!! Form::submit('Comment', ['id' => "btn".$p->post_id,'class' => 'btn btn-outline-success', 'style' => 'display:none']) !!}
                            </div>   
                            <div class="col-md-11"> 
                                {!! Form::textarea('comment', '' , ['id'=> "comm".$p->post_id, 'class' => ['form-control', 'form-rounded'],  'placeholder' => 'comment', 'rows' => '1']) !!}
                            </div> 
                        </div>    
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    
                </div>
            </div>
        </div>

    </div>
</div>

