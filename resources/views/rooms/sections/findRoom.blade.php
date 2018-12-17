<div class="card">
    <div class="card-header text-center">
        Find Discussion Room    
    </div>

    <div class="card-body">
        @php
            $allRooms = DB::select("SELECT * FROM room_log 
                                    JOIN room_topics ON (room_id = topic_of_room)  
                                    GROUP BY(room_id) ORDER BY count(topic)
                                ");
            
        @endphp
        <div class="card-title text-center">
            <b> Top Rooms </b>    
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                @foreach ($allRooms as $index => $room)
                    {{($index+1).'. '}}   
                    <a class=" text-capitalize" href="/show_room/{{$room->room_id}}"> 
                        {{$room->room_name}} 
                    </a>     
                @endforeach
            </div>
        </div>
    </div>
</div>