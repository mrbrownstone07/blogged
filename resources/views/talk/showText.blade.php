<style>
    .bar_set{
        position: relative;
        overflow-y: hidden;
        overflow-x: hidden;
    }

    .bar_set:hover{
        overflow-y: scroll;
    }

    .size{
        height: 87%;
    }

    .msg{
        overflow-y: hidden;
    }

    #chat_box::-webkit-scrollbar-track{
        //background-color: #FFFFFF;
        display:none;
    }

    #chat_box::-webkit-scrollbar{
        {{--  width: 8px;
        background-color: rgba(106, 97, 97, 0.55);  --}}
        display:none;
    }

    #chat_box::-webkit-scrollbar-thumb{
        {{--  background-color: #555;  --}}
        display:none;
    }

    #msg::-webkit-scrollbar {
        {{--  width: 0px;  
        background: transparent;    --}}
        display:none;
    }

</style>




<div class="card size">
    <div class="card-header bg-white text-right">
        <div class="row ">
            <div class="col-md-12">
                <a href="/profile/{{$reciver->slug}}"> {{'@'.$reciver->name}} </a>
                <span id="reciver_id" style=" display:none"> {{$reciver->id}} </span>    
            </div>
        </div>
    </div>
    <div id="chat_box" class="card-body  bar_set" style="">
        <div class="row">
            <div id="reciver" class="col-md-6 text-left">
                @foreach ($oldMsgs as $msg)
                    @if($msg->sent_from == $reciver->id)
                        {{$msg->text}}
                    @endif
                @endforeach
            </div>
            <div id="sender" class="col-md-6 text-right">
                @foreach ($oldMsgs as $msg)
                    @if($msg->sent_to == $reciver->id)
                        {{$msg->text}}
                    @endif
                @endforeach                        
            </div>
        </div>
    </div>

    <div class="card-footer bg-white">
        <form action="#" method="post">
            @csrf
            <div class="row">                                                    
                    {!! Form::hidden('reciver_id', $reciver->id, ['class' => 'form-control']) !!}
                    {!! Form::submit('message', ['id' => 'btn','class' => 'btn btn-outline-success', 'style' => 'display:none']) !!}
                 
                <div class="col-md-12"> 
                    {!! Form::textarea('message', '' , ['id'=> "msg", 'class' => ['form-control', 'form-rounded', 'auto-text-area'],  
                                            'placeholder' => 'Type a message....', 'rows' => '2', 'autocomplete' => 'off']) !!}
                </div> 
            </div>    
        </form>
    </div>
</div>

<script type="text/javascript">
   
    window.onload = function(){
        $('#msg').keydown(function(e){
            if(e.keyCode == 13 && !e.shiftKey){
                e.preventDefault();
                sendMsg();
            }else{
                console.log('typing');
                console.log(e);
            }
        });

        pullData();

        
    }  
    
    function sendMsg(){
        var msg = $('#msg').val();
        var reciver_id = $('#reciver_id').html();
        console.log(reciver_id);

        if(msg.length > 0){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }),
    
                $.ajax({
                    method: 'POST',
                    url: '{{URL::to('send_message')}}',
                    data: {'msg': msg, 'reciver_id' : reciver_id},
                    success:function(data){
                        $('#msg').val('');
                        $('#msg').height('40px'); 
                    }
                });
        
        }else{
            console.log(0);
        }
    }

    function pullData(){
        fetchChatMessages();
        setTimeout(pullData, 2000);
    }

    function fetchChatMessages(){
        var reciver_id = $('#reciver_id').html();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }),

        $.ajax({
            method: 'GET',
            url: '{{URL::to('get_messages')}}',
            data: {'reciver_id' : reciver_id},
            success:function(data){
                for(var i = 0; i < data.length; i++)
                    $('#reciver').html(data[i].reciver);
                    console.log(data);
            }
        });        
    }

        
    
</script>