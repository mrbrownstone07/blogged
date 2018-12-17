
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
@if (Auth::check())
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
@else
    <img src="{{ URL::to('img/icons/like.png')}}" alt="image not found" class="p_icon_wrap">
    {{$likes}}  
@endif

