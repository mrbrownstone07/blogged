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
       
</body>
</html>


<script>

    var tx = document.getElementsByTagName('textarea');
    for (var i = 0; i < tx.length; i++) {
        tx[i].setAttribute('style', 'height:' + (tx[i].scrollHeight) + 'px;overflow-y:hidden;');
        tx[i].addEventListener("input", OnInput, false);
    }
    
    var idle = true;
    function OnInput() {
        if(this.scrollHeight < 200){
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        }else{
            this.setAttribute('style', 'height: 200px;overflow-y:scroll;')
        }
    }


</script>