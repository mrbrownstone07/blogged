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
    .recived{
        background-color:  #D1E2E2;
        padding: 5px;
        border-radius: 39px;
        margin-bottom: 2px;
        max-width: 300px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .sent{
        background-color:   #e0e0eb;
        padding: 5px;
        border-radius: 39px;
        margin-bottom: 2px;
        max-width: 300px;
        padding-left: 10px;
        padding-right: 10px;       
    }

    .m_wrap{
        padding: 5px;
        
    }

    .format{
        margin-top: 10px;
    }



</style>




<div class="card size shadow">
    <div class="card-header bg-white text-right">
        <div class="row ">
            <div class="col-md-12">
                @if (!empty($reciver))
                    <a href="/profile/{{$reciver->slug}}"> {{'@'.$reciver->name}} </a>
                    <span id="reciver_id" style=" display:none"> {{$reciver->id}} </span>                      
                @else
                    <span> No one selected </span>
                @endif
  
            </div>
        </div>
    </div>
    
    {{--  <div id="chat_box" class="card-body  bar_set" style="">
        <div class="row">            
            @foreach ($oldMsgs as $msg)
                <div id="reciver" class="col-md-6 m_wrap text-left">
                    @if($msg->sent_from == $reciver->id)
                        <div class="">
                            <img src="{{ URL::to('img/user_imgs/' . $reciver->profile_pic) }}" 
                                alt="image not found" class="rounded-circle" style="width:22px; length:2px"> 
                            <span class="jumbotron no_wrap text-left recived"> {{$msg->text}} </span>
                        </div>   
                    @endif  
                </div>
                <div id="sender" class="col-md-6 m_wrap text-right">
                    @if($msg->sent_to == $reciver->id)
                        <div>
                            <span class=" jumbotron no_wrap text-right sent"> {{$msg->text}} </span>      
                        </div>
                    @endif
                </div>
            @endforeach                                    
        </div>
    </div>  --}}
    <div id="chat_box" class="card-body  bar_set" style="">
        <div id="write" class="row">            
            {{--  <small class="text-center"> {{$last_chat}}  </small>                                 --}}
        </div>
    </div>

    <div class="card-footer bg-white">
        <form action="#" method="post">
            @csrf
            <div class="row">
                @if(!empty($reciver))                                                    
                    {!! Form::hidden('reciver_id', $reciver->id, ['class' => 'form-control']) !!}
                    {!! Form::submit('message', ['id' => 'btn','class' => 'btn btn-outline-success', 'style' => 'display:none']) !!}
                @endif
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
                
            }
        });
        pullData();
        fetchAll();
        lastText();  
    } 
    
    function fetchAll(){
        var reciver_id = $('#reciver_id').html();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }),

        $.ajax({
            method: 'GET',
            url: '{{URL::to('fetch_all')}}',
            data: {'reciver_id' : reciver_id},
            success:function(data){
                if(data != ''){
                    $('#write').append("" +data+ "")
                    
                }
            }  
        });        
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
                        console.log(msg);
                        $('#write').append("<div id='sender' class='col-md-12 m_wrap text-right bg-white'> <img ><span class=' format no_wrap text-center sent'>"
                                        +msg+"</span><div>")
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
        setTimeout(pullData, 3000);
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
                if(data != ''){
                    $('#write').append("" +data+ "")
                    console.log(data);
                }
            }  
        });        
    }

        
    
</script>