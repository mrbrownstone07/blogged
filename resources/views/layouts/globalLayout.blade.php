<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- stylesheet -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    

    <title>{{config('app.name'), 'Blogged'}}</title>
    <style>

        .form-rounded {
                border-radius: 1rem;
        }
        .body_wrap{
            margin-top: 75px;
        }
        body{
           
            background-image: url('img/background/global.jpg') !important;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            
        }
        .transparent{
            background-color: rgba(44, 44, 44, 0.7) !important;
            color:snow;
        }
        .whitebg{
            background-color: white;
        }
        .p_icon_wrap{
            width: 20px;
            height: 20px;
        }
        .wrap{
            margin-left: 20px;
            margin-right: 20px;
            padding-top: 20px;
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
        body{
            overflow-y:scroll;  
        }
    </style>

</head>
<body>
    @include('inc.nonauth_navbar')

  
    <div class="container body_wrap">
            @yield('content')
    </div>
   


</body>
</html>

<script>
    window.onload = function(){
        $('#password').keyup(function(e){
            if(isInvalid(e.keyCode)){
                alert('HELLO THERE');
                $('#password').val('');
            }
        });

        $('#email').keyup(function(e){
            console.log($('#email').val());
        });
        
        
  
    }
    
    function isInvalid(code){
        if(code == 222) return true;
        if(code == 187) return true;
        if(code == 188) return true;
        if(code == 190) return true;
        if(code == 191) return true;
        if(code == 220) return true;
        if(code == 219) return true;
        if(code == 221) return true;
        
        return false;
    }
</script>