<style>
    .noti_badge{
        position: relative;
        top:-5px;
        left:-10px;
        background-color: #FFAA99;
        box-shadow: 6px 4px 37px -4px rgba(0,0,0,0.39); 
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

    .rounded {
        border-radius: 1rem;
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

    .no_wrap{
        padding: 0px;
       
    }

    {{-- input[type=text] {
        width: 130px;
        box-sizing: border-box;
        border: 2px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: white;
        background-image: url('/home/opt/lampp/htdocs/blogged/public/img/icons/search.png') !important;
        background-position: 10px 10px; 
        background-repeat: no-repeat;
        padding: 12px 20px 12px 40px;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }
    input[type=text]:focus {
        width: 100%;
    } --}}

    .gredient_bg{
        {{--  background: -webkit-linear-gradient(-45deg, rgba(240,249,255,1) 0%,rgba(224,243,255,1) 53%,rgba(206,237,255,1) 100%);   --}}
        {{--  background: -webkit-linear-gradient(-45deg, rgba(254,255,255,1) 0%,rgba(221,241,249,1) 35%,rgba(160,216,239,1) 100%);  --}}
        background: linear-gradient(to bottom, rgba(255,255,255,1) 
                    0%,rgba(246,246,246,1) 47%,
                    rgba(237,237,237,1) 100%);
    }
</style>


<nav class="navbar shadow fixed-top navbar-expand-sm navbar-light navbar-laravel gredient_bg">
    <div class="container no_wrap container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ URL::to('img/icons/favicon.png')}}" alt="image not found" class="p_icon_wrap">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            @if (!Auth::check())
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/about_us">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact_us">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/blog">Blog</a>
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faq">Faq</a>
                    </li>
                
                @endguest
            @endif      
            </ul>


            @if (Auth::check())
                <div class="col-md-6">
                        @include('inc.searchBar')
                </div>                
            @endif

                

            

            
            

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

                    {{--  messages  --}}
                        @include('inc.messages')
                    {{--  messages ends here  --}}
                    
                    {{--  notifications drop down  --}}
                        @include('inc.notifications')
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

                            <a class="dropdown-item" href="/dicussion_rooms/{{Auth::user()->slug}}">
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

