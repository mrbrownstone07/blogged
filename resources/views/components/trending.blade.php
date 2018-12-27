<div class="card shadow-sm card_bottom">
    <div class="card-header text-center bg-white">
        <b>#Trending </b> 
    </div>
    <div class="card-body">
        @php
           $topPosts = DB::select("SELECT *, count(reaction_id) as reactions 
                                    FROM reacts, posts WHERE liked_post = post_id 
                                    GROUP BY (liked_post) 
                                    ORDER BY count(reaction_id) DESC 
                                    LIMIT 10"); 
        @endphp

        @foreach ($topPosts as $index => $post)
            <div class="row">
                <div class="col-md-12">
                    <a href="/posts/{{$post->post_id}}"> {{$post->title}} </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <small> reacts {{" " .$post->reactions}} </small> 
                </div>
            </div>
            
             
        @endforeach
    </div>



</div>