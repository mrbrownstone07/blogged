<style>
    
</style>

@extends('layouts.globalLayout')

@section('content')
    <div class=" container container-fluid">
        @php
           
        @endphp
        @foreach ($posts as $p)
            <div class="jumbotron no_wrap j_wrap" style="padding:20px; background-color:white">
                <div class="row">
                    <div class="col-md-6 push-left">
                        
                        <img src="{{ URL::to('img/user_imgs/' . $p->profile_pic) }}" 
                            alt="image not found" class="rounded-circle" style="width:50px; length:50px">
                        {{'@'. $p->name}}
                                                  
                    </div>
                    <div class="col-md-6 text-right">
                        
                        @php
                            $t= (new Carbon\Carbon( $p->time))->diffForHumans();
                        @endphp
                        posted: {{$t}}
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <h4> {{$p->title}} </h4>  
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            {!!$p->body!!}
                        </div>
                    </div>
                    <hr>
                </div>
                @php
                    $reacts = DB::select("SELECT * FROM reacts WHERE liked_post = '$p->post_id' ");
                    $comments = DB::Select("SELECT * FROM comments_log,users 
                                    WHERE commented_by = id AND commented_on = '$p->post_id' "); 
                @endphp 
                <div class="row container">
                    <div class="col-md-1">
                        <img src="{{ URL::to('img/icons/like.png')}}" alt="image not found" class="p_icon_wrap">
                        {{count($reacts)}}
                    </div>
                    <div id="" class="col-md-1 text-left"  onclick="showTog('comments_Section{{$p->post_id}}')">
                        <img src="{{ URL::to('img/icons/comment.png')}}" alt="image not found" class="p_icon_wrap">
                        {{count($comments)}}
                    </div>
                    
                                       
                </div>
                <div class="row container">
                    <div class="col-md-12">
                        @include('profiles.sections.mid_section.comment_section')
                    </div>    
                </div>
            </div>
        @endforeach
    </div>
    

@endsection

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


