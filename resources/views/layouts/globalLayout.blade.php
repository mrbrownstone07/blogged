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

    <title>{{config('app.name'), 'Blogged'}}</title>
    <style>
        .form-rounded {
                border-radius: 1rem;
                }
        .wrap{
            padding-top: 70px;
        }
        body{
           
            background-image: url('img/background/global.jpg') !important;
            background-size: cover !important; 
            
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
    </style>

</head>
<body>
    @include('inc.nonauth_navbar')

  
    <div class="container">
            @yield('content')
    </div>
   


</body>
</html>