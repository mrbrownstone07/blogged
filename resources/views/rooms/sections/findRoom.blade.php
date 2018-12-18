<div class="card">
    <div class="card-header text-center">
        Find Discussion Room    
    </div>

    <div class="card-body">
        @php
            $allRooms = DB::select("SELECT * FROM room_log 
                                    JOIN room_topics ON (room_id = topic_of_room)  
                                    GROUP BY(room_id) ORDER BY count(topic) DESC 
                                ");
            
        @endphp
        <div class="card-title text-center">
            <b> Top Rooms </b>    
        </div>
        
        @foreach ($allRooms as $index => $room)
        <div class="row">
            <div class="col-md-12 text-center">
                {{($index+1).'. '}}   
                <a class=" text-capitalize" href="/show_room/{{$room->room_id}}"> 
                    {{$room->room_name}} 
                </a>  
            </div>
        </div>   
        @endforeach
       
    </div>
</div>