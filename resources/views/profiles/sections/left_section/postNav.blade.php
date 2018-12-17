<div class="card">
    <div class="card-header text-center">
        post navigation
    </div>

    <div class="card-body text-center">
        @if (empty($posts))
           no posts  
        
        @else
            @foreach ($posts as $index => $p)
            <a href="/post/{{$p->post_id}}"> {{($index+1).'. '}}    {{$p->title}} </a> 
            @endforeach
        @endif
        
    </div>
</div>