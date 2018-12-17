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
            padding-top: 70px;
        }
        body{
            background-color: #FFFF66;
            
        }
        .form-rounded {
            border-radius: 1rem;
        }
        body {
            padding: 20px;
            overflow:hidden;
            margin-top: 30px;
        }
    </style>

</head>
<body>
    <div class="jumbotron bg-transparent">
        <div class="row">
            <div class="col-md-12 text-center">
                <h2 class=" text-monospace"> {!!$msg!!} </h2>
                <h3 class=" text-capitalize text-monospace"> Good Attempt ! </h3>
                <h5 class=" text-monospace"> HERE IS SOME POTATO FOR YOU ENJOY ! </h5>
                <img src="{{URL::to('img/icons/potato.png')}}" alt="" 
                        class="f_icon_wrap" style="width: 300px;height: 250px;"><br>
                    
            </div>
        </div>
    </div>
</body>
</html>