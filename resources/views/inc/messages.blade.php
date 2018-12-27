<style>
    .hide{
        display: none;
    }
</style>


<li class="nav-item dropdown ">
    <a id="navbarDropdown" class="nav-link " href="/talk"  aria-haspopup="true" aria-expanded="false" v-pre>
        <img src="{{ URL::to('img/icons/talk.png')}}" alt="image not found" class="p_icon_wrap">
        @if (1 == 1)
            <span id="notiCount" class="badge noti_badge hide badge-pill"></span>                                
        @endif    
    </a>
    <div id="msgNoti" class="dropdown-menu scrollable-menu dropdown-menu-right shadow-lg " aria-labelledby="navbarDropdown">

    </div>
</li>



<script>

    window.onload = function(){
        getMessageNotification();
       
    }

    function pusher(){
        
        getMessageNotification;
        setInterval(pusher, 3000);
    }

    function getMessageNotification (){
        console.log(1);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }),

        $.ajax({
            method: 'GET',
            url: '{{URL::to('get_msg_noti')}}',
            data: {},
            success:function(data){
                if(data != ''){
                    if(data > 0){
                        $('#notiCount').removeClass('hide');
                        $('#notiCount').html(data);  
                    }else{
                        $('#notiCount').addClass('hide');
                    }
                    
                }
            }  
        })   
    }

</script>