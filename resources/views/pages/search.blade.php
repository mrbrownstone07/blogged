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
                
                <div class="container">        
                    <input type="text" class="form-control" id="s" name="s"></input>
                </div>

                <div class="jumbotron">
                    <div class="row">
                        <div id="name" class="col-md-12">

                        </div>
                    </div>
                </div>
                   
            </div>
        </div>
    </div>
</body>
</html>

<script>
    window.onload = function(){
        $('#s').keyup(function(e){
            $value=$(this).val();
            console.log($value);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            }),

            $.ajax({
                method: 'GET',
                url: '{{URL::to('search')}}',
                data: {'search': $value},
                success:function(data){
                    console.log(data);
                    for(var i = 0; i < data.length; i++)
                        $('#name').html(data[i].name);
                }
            })
        });
    }         
</script>
