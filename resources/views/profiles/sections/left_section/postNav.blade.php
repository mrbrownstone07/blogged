<div class="card">
    <div class="card-header bg-white text-center">
        post navigation
    </div>

    <div class="card-body text-center">
        @if (empty($posts))
           no posts  
        
        @else
            @foreach ($posts as $index => $p)
            <div class="row">
                <div class="col-md-12">
                    <a href="/post/{{$p->post_id}}"> {{($index+1).'. '}}    {{$p->title}} </a> 
                </div>
            </div>            
            @endforeach
        @endif
        
    </div>
</div>