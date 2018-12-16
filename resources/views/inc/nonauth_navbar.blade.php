<style>
    .noti_badge{
        position: relative;
        top:-5px;
        left:-10px;
    }
    .unseen_noti_bg{
        background-color: rgb(244, 245, 245);
    }
    .scrollable-menu {
        height: auto;
        //width: auto;
        max-height: 500px;
        //max-width: 500px;
        width:500px;
        overflow-x: hidden;
    }

    hr.divider { 
        margin: 0em;
        border-width: 2px;
    } 

    .line_header{
        padding-bottom: 2px;
        padding-top: 2px;
    }


    #Scrollstyle::-webkit-scrollbar-track{
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
    }

    #Scrollstyle::-webkit-scrollbar{
        width: 12px;
        background-color: #F5F5F5;
    }

    #Scrollstyle::-webkit-scrollbar-thumb{
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #555;
    }
</style>


<nav class="navbar shadow fixed-top navbar-expand-md navbar-dark navbar-laravel bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @guest
                <li class="nav-item active">
                    <a class="nav-link" href="/about_us">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact_us">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/faq">FAQ</a>
                </li>
                @endguest

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Home</a>
                    </li>
                    
                    {{--  notifications drop down  --}}
                    @php
                        $noti_count = 0;
                        foreach ($notifications as $noti) {
                            if($noti->notification_status == 0){
                                $noti_count++;
                            }
                        }   
                    @endphp

                    <li class="nav-item dropdown ">
                        <a id="navbarDropdown" class="nav-link " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ URL::to('img/icons/noti2.png')}}" alt="image not found" class="p_icon_wrap">
                            @if ($noti_count > 0)
                                <span class="badge noti_badge badge-pill badge-light">{{$noti_count}}</span>                                
                            @endif    
                        </a>

                        <div id="Scrollstyle" class="dropdown-menu scrollable-menu dropdown-menu-right shadow-lg " aria-labelledby="navbarDropdown">
                            
                            <div class="dropdown-header position-fixed col-12" style="background-color:white; margin-top:-10px">
                                    <b> Notifications </b>       
                            </div>
                            
                            
                            
                            <br>
                            @if (count($notifications) > 0)
                                
                                <hr class="divider" style=" margin-top:2px">
                                <small class="dropdown-header line_header"> NEW </small>
                                <hr class="divider">
                                
                                @if($noti_count == 0)
                                    <div class="dropdown-item text-center">
                                        <small> No new notification </small>    
                                    </div>
                                    <hr class="divider" style="">
                                @endif

                                @foreach ($notifications as $noti)
                                    @if ($noti->notification_status == 0)
                                        <a href="/show_notifiaction/{{$noti->notification_id}}/{{$noti->notification_type}}" 
                                                class="dropdown-item unseen_noti_bg">
                                            <div class="dropdown-item">
                                                <div class="row">
                                                    <div class="text-left">
                                                        
                                                        <img src="{{ URL::to('img/user_imgs/' . $noti->profile_pic) }}" 
                                                            alt="image not found" class="rounded-circle" style="width:30px; height:30px">  
                                                        <b> {{'@'.$noti->name}} </b>      
                                                    
                                                        
                                                        @if ($noti->notification_type == 1)
                                                            started following you !
                                                        @endif

                                                        @if($noti->notification_type == 2)
                                                            @php
                                                                $notiPost = DB::select("SELECT * FROM posts WHERE post_id = (
                                                                            SELECT post_reacted
                                                                            FROM react_notifications 
                                                                            WHERE noti_id = '$noti->notification_id')"
                                                                        );
                                                                $title = substr($notiPost[0]->title, 0, 10);
                                                            @endphp
                                                            liked your post!  <b> {{$title}} </b>
                                                            
                                                        @endif

                                                        
                                                        @if ($noti->notification_type == 3)
                                                            @php
                                                                $comNotiPost = DB::select("SELECT * FROM posts WHERE post_id = (
                                                                    SELECT post_commented FROM comment_notifications WHERE
                                                                    comment_noti_id = '$noti->notification_id'
                                                                    
                                                                )");
                                                                $title = substr($comNotiPost[0]->title, 0, 10);
                                                            @endphp
                                                            commented on your post {{$title}}
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="text-left">
                                                        @php
                                                            $noti_time = (new Carbon\Carbon($noti->notification_send_at))->diffForHumans();
                                                        @endphp
        
                                                        <small> {{$noti_time}} </small> 
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <hr class="divider" style="">
                                    @endif
                                @endforeach
                                <hr class="divider">
                                <small class="dropdown-header line_header"> EARLIER </small>
                                
                                <hr class="divider" style="">
                                @php
                                    $i = 0
                                @endphp
                                @foreach ($notifications as $noti)
                                    
                                    @if ($noti->notification_status == 1)
                                        <a href="/show_notifiaction/{{$noti->notification_id}}/{{$noti->notification_type}}" 
                                            class="dropdown-item">
                                            <div class="dropdown-item">
                                                <div class="row">
                                                    
                                                        <div class="text-left">
                                                            
                                                            <img src="{{ URL::to('img/user_imgs/' . $noti->profile_pic) }}" 
                                                                alt="image not found" class="rounded-circle" style="width:30px; height:30px">  
                                                            {{'@'.$noti->name}}     
                                                        
                                                            
                                                            @if ($noti->notification_type == 1)
                                                                started following you!
                                                            @endif

                                                            @if ($noti->notification_type == 2)
                                                                @php
                                                                    $notiPost = DB::select("SELECT * FROM posts WHERE post_id = (
                                                                                SELECT post_reacted
                                                                                FROM react_notifications 
                                                                                WHERE noti_id = '$noti->notification_id')"
                                                                            );
                                                                    $title = substr($notiPost[0]->title, 0, 10);
                                                                @endphp
                                                                liked your post!  <b> {{$title}} </b>
                                                            @endif

                                                            @if ($noti->notification_type == 3)
                                                                @php
                                                                    $comNotiPost = DB::select("SELECT * FROM posts WHERE post_id = (
                                                                        SELECT post_commented FROM comment_notifications WHERE
                                                                        comment_noti_id = '$noti->notification_id'
                                                                        
                                                                    )");
                                                                    dd($comNotiPost);
                                                                    $title = substr($comNotiPost[0]->title, 1, 10);
                                                                @endphp
                                                                commented on your post {{$title}}
                                                            @endif
                                                        </div>
                                                    
                                                </div>

                                                <div class="row">
                                                    <div class="text-left">
                                                        @php
                                                        $noti_time = (new Carbon\Carbon($noti->notification_send_at))->diffForHumans();
                                                        @endphp
                                                        <small> {{$noti_time}} </small> 
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        
                                        @php
                                        $i++;  
                                        @endphp

                                        @if ($i == 9)
                                            @break;
                                        @endif
                                        <hr class="divider" style="">
                                    @endif

                                @endforeach
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="">
                                            <small class="dropdown-item text-center"> View all notifications</small>
                                        </a> 
                                    </div>
                                </div>    
                            @endif


                        </div>
                    </li>
                    {{--  notifications drop down ends here  --}}

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ URL::to('img/user_imgs/' . Auth::user()->profile_pic) }}" 
                                alt="image not found" class="rounded-circle" style="width:25px; height:25px"> 
                        </a>

                        <div class="dropdown-menu shadow-lg dropdown-menu-right" aria-labelledby="navbarDropdown">
                            
                            <div class="dropdown-item">
                                <h4>{{ '@'. Auth::user()->name }}</h4>
                                {{ Auth::user()->email }}
                            </div>
                            <hr class="divider">
                            
                            
                            <a class="dropdown-item" href="/profile/{{Auth::user()->slug}}">
                                Profile
                            </a>

                            <a class="dropdown-item" href="/findPeople">
                                Find People
                            </a>

                            <a class="dropdown-item" href="#">
                                Discussion Room
                            </a>
                            
                            {{--  more code goes here  --}}
                            
                            <hr class="divider">

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>