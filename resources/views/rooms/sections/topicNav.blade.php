<div id="i" class="card shadow-sm card_bottom card_marg text-center cotentsection card_margin">

    <div class="card-header bg-white">
        Topic navigation
    </div>

    <div class="card-body">  
        @foreach ($topics as $index => $topic)
            <div class="row">
                <div class="col-md-12 text-center">
                    <a href="#topic{{$topic->topic_id}}"> {{($index+1).'. '}} {{$topic->topic}} </a> 
                </div>
            </div>           
        @endforeach    
    </div>

</div>

            

