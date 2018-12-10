@include('inc.Ermsg')
<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }

    #post_btn{
        display: none
    }

</style>

<script>

    function show(id){
        document.getElementById(id).style.display = 'block';
    }

    function hide(id){
        document.getElementById(id).style.display = 'none';
    }

</script>



<div class="card card_marg text-center cotentsection" onmouseover="show('post_btn')" onmouseout="hide('post_btn')">
    <div class="card-header">
            Share your thoughts
            <a href="">
                <img src="{{ URL::to('img/icons/post.png')}}" alt="image not found" class="icon_wrap">    
            </a>
    </div>

    
    <div class="card-body card_marg">

        
        {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST']) !!}
           
            @csrf
            <div class="form-group row">    
                <div class="col-md-12">
                    {!! Form::text('title', '' , ['class' => 'form-control', 'placeholder' => 'title']) !!}
                </div>         
            </div>
            <div id="post_btn">
                <div class="form-group row" >  
                    <div class="col-md-12">
                        {!! Form::textarea('body', '', ['class' => 'form-control', 
                                'placeholder' => "what's in your mind", 'rows' => '2', 'id' => 'article-ckeditor']) !!}
                    </div>         
                </div>
            </div>
            <div class="form-group row" id="">  
                <div class="col-md-12">
                    {!! Form::submit('Post', ['class' => 'btn btn-outline-success']) !!}
                </div>         
            </div> 
    
        
        {!! Form::close() !!}
                       
    </div>
</div> 
