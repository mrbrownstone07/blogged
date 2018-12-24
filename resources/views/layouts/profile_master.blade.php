<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- stylesheet -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
    

    <title>{{config('app.name'), 'Blogged'}}</title>
    <style>
        .whitebg{
            background-color: white;
        }
        .p_icon_wrap{
            width: 20px;
            height: 20px;
        }
        .content_section{
            padding: 10px;
        }
        .img_wrap{
            width: 100px;
            height: 100px;
        }
        .modal_img_wrap{
            width: 500px;
            height: 500px;
        }
        .non_bottom{
            padding:10px 10px 0px 10px;
        }
        .img_wrap{
            width: 100px;
            height: 100px;
        }
        .card_margin{
            margin-top: 10px;
        }
        .icon_wrap{
            width:12px;
            height: 12px;
        }
        .form-rounded {
            border-radius: 1rem;
        }
        textarea {
            overflow: auto;
            resize: none;
            outline: none;
        }
        .body_wrap{
            margin-top: 75px;
        }
        hr.divider { 
            margin: 0px;
            border-width: 0px;
        }
        .card_bottom{
            margin-bottom: 20px;
        }
        .no_wapper{
            padding: 10px;
            margin: 0px;
        }
        body{
            overflow-y:scroll;
            background-color: #EBF5F5;  
        }
        
        .fix_link{
            text-decoration: none;
            text-decoration-color: black;
        }
        .bar_set{
            position: relative;
            overflow-y: hidden;
            overflow-x: hidden;
        }
    
        .bar_set:hover{
            overflow-y: scroll;
        }
    </style>

</head>
<body>
    @include('inc.nonauth_navbar')
    
        <div class="container-fluid body_wrap wrap">
            <div class="row">
                
                <div class="col-md-3">
                    
                    @yield('left_section')
                         
                </div>
                
                <div class="col-md-6">
                    
                    @yield('mid_section')
                </div>
                
                <div class="col-md-3">
                    
                    @yield('right_section')
                   
                </div>
            </div> 
        </div>
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        
        <script>
            CKEDITOR.replace( 'article-ckeditor' );   
        </script>


</body>
</html>

<script>
        function addShadow(id) {
            var element = document.getElementById(id);
            element.classList.add("shadow");
        }
    
        function removeShadow(id) {
            var element = document.getElementById(id);
            element.classList.remove("shadow");
        }

        var tx = document.getElementsByTagName('textarea');
        for (var i = 0; i < tx.length; i++) {

          tx[i].setAttribute('style', 'height:' + (tx[i].scrollHeight) + 'px;overflow-y:hidden;');
          tx[i].addEventListener("input", OnInput, false);
        }
        
        var idle = true;

        function OnInput() {
          this.style.height = 'auto';
          this.style.height = (this.scrollHeight) + 'px';
          idle = false;
          
        }

        idleTimer = null;
        idleState = false;
        idleWait = 40000;
        var pathName = window.location['pathname'];
        (function ($) {

            $(document).ready(function () {
            
                $('*').bind('mousemove keydown scroll', function () {
                
                    clearTimeout(idleTimer);
                    console.log(20);
                    if (idleState == true) { 
                        alert('welcome back again');
                    }
                    
                    idleState = false;
                    
                    idleTimer = setTimeout(function () { 
                        console.log(pathName);
                        setTimeout("location.href = pathName",10000);                        
                        idleState = true; }, idleWait);
                });
                
                $("body").trigger("mousemove");
            
            });
        }) (jQuery)


        function updateLastSeen(){
            
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

   




