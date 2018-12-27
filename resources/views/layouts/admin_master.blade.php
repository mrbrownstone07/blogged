<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
    @include('admin.admin_navbar')
    <div class="container-fluid body_wrap wrap">
        <div class="row">
            <div class="col-md-3">
                @yield('left_section')                         
            </div>
            
            <div class="col-md-9">                    
                @yield('mid_section')
            </div>                
        </div> 
    </div>  
</body>
</html>

<script>

</script>


