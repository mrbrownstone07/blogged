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
        .wrap{
            margin-left: 20px;
            margin-right: 20px;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    @include('inc.nonauth_navbar')
  
    <div class="container-fluid wrap">
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

