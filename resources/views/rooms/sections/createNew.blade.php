<style>
    .card_marg{
        margin-left:0 !important; 
        margin-right:0 !important;
    }

</style>

@include('inc.Ermsg')

<div id="i" class="card shadow-sm card_bottom card_marg text-center cotentsection card_margin">

    <div class="card-header">
        create new dicussion room
    </div>

    <div class="card-body">
        
        <form action="/create_room" method="post" style="margin-top:20px">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    {!! Form::text('name', '', ['class' => ' form-control', 'placeholder' => 'Discussion Room name']) !!}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    {!! Form::submit('create', ['class' => 'btn btn-outline-dark']) !!}
                </div>
            </div>    
        </form>
       
    </div>

</div>