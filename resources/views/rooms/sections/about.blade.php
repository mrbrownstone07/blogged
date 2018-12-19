<div class="card card_bottom">
    <div class="card-header bg-white">
        <div class="row">
            <div class="col-md-12 text-center">
                About this room
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-12 text-center">
                @php
                    $owner = DB::select("SELECT * FROM users WHERE id = '$room->room_owner'");
                @endphp
                <b> Owner </b>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <a href="/profile/{{$owner[0]->slug}}"> {{'@'.$owner[0]->name}} </a>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <b> Members: </b> {{count($members)+1}}
            </div>
        </div>
    </div>
</div>