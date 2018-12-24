@include('inc.Ermsg')
<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }

    #post_btn{
        display: none
    }

    #shadow_change{

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



<div id="a" class="card  shadow-sm shadowElement card_marg card_bottom text-center cotentsection" 
    onmouseover="show('post_btn'); addShadow('a')" onmouseout="hide('post_btn'); removeShadow('a')">
    <div class="card-header bg-white">
            Share your thoughts
            <a href="">
                <img src="{{ URL::to('img/icons/post.png')}}" alt="image not found" class="icon_wrap">    
            </a>
    </div>

    
    <div class="card-body card_marg">
        @php
            $location = $_SERVER['REQUEST_URI'];
            $location = ($location[1] == 'h') ? 
                substr($location, 1, 4) : 
                    str_replace('/', '_', substr($location, 1, strlen($location)));
                
        @endphp
        
        {!! Form::open(['action' => ['PostsController@store', $location], 'method' => 'POST']) !!}
           
            @csrf
            <div class="form-group row">    
                <div class="col-md-12">
                    {!! Form::text('title', '' , ['class' => ['form-control', 'form-rounded'], 
                            'placeholder' => 'title', 'autocomplete' => 'off']) !!}
                </div>         
            </div>
            
            <div id="post_btn">
                <hr>
                <div class="form-group row" >  
                    <div class="col-md-12">
                        {!! Form::textarea('body', '', ['class' => ['form-control', 'form-rounded'],  
                                'placeholder' => "what's in your mind", 'rows' => '2', 
                                'id' => 'article-ckeditor', 'autocomplete' => 'off']) !!}
                    </div>         
                </div>
            </div>
            <div class="form-group row" id="">  
                <div class="col-md-12">
                    
                    {!! Form::hidden('path', $location, ['class' => 'form-control']) !!}
                    
                    {!! Form::submit('Post', ['class' => 'btn btn-outline-success']) !!}
                </div>         
            </div> 
    
        
        {!! Form::close() !!}
                       
    </div>
</div> 


