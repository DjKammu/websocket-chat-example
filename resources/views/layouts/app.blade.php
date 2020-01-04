<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/css/swiper.min.css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
<div class="main">
<header>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <div class="container">
            <div class="col-sm-12">
                <div class="row d-flex align-items-center justify-content-between">
                    <div class="choose-language d-flex text-white">
                        <span><i class="fa fa-globe" aria-hidden="true"></i></span>
                        <span>
                            <p class="mb-0"><small>Your Language</small></p>
                            <select>
                                <option>English</option>
                            </select>
                        </span>
                    </div>
                    <a href="{{ url('/') }}" class="brand-logo text-white"><img src="{{ asset('images/logo.png') }} " height="50px"></a>
                    @guest
                       <a class="text-white" href="{{ route('login') }}">{{ __('Signin') }}</a>   
                    @else
                    
                    <div class="dropdown">
                       
                        <a href="javascript:void(0);" class="text-white" data-toggle="dropdown">
                            {{ Auth::user()->name }}  <span><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                        </a>
                        <div class="dropdown-menu">

                            <a class="dropdown-item" href="{{ route('account') }}">My Account</a>
                            
                            @if(Auth::user()->role == App\User::ROLE_BUYER)
                               <a class="dropdown-item" href="{{ route('girls') }}">Girls</a>
                            @endif
                            
                            <a class="dropdown-item" href="{{ route('messages') }}">Messages</a>
                            <a class="dropdown-item" href="{{ route('bids') }}">Bids</a>

                            <a class="dropdown-item" href="{{ route('info','information') }}">Information</a>
                            <a class="dropdown-item" href="{{ route('settings') }}">Settings</a>
                        
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                           
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
    <!-- <section> -->
         @yield('content')
    <!-- </section> -->
<footer>
    <div class="container">
        <div class="col-sm-12 text-center py-5">
            <h4 class="text-white mb-4">
                <img src="{{ asset('images/logo.png') }}" height="110px">
            </h4>
            <ul class="list-inline m-0">
                <li class="list-inline-item text-low-alpha">
                    <a href="{{ route('page','administrator')}}">Administrator</a>
                </li>
                <li class="list-inline-item text-low-alpha">
                    <a href="{{ route('page','agreement')}}">Agreement</a>
                </li>
                <li class="list-inline-item text-low-alpha">
                    <a href="{{ route('page','stories')}}">Stories</a>
                </li>
                <li class="list-inline-item text-low-alpha">
                    <a href="{{ route('page','auctions')}}">Auctions</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-btm bg-dark py-3 text-center">
        <p class="m-0 text-white">All Rights Reserved © 2019 <a href="{{ url('/') }}" class="text-yellow">VIP Auction Club</a></p>
    </div>
</footer>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="https://unpkg.com/swiper/js/swiper.min.js"></script>
<script src="{{ asset('js/custom.js') }} "></script>
@yield('pagescript')
</body>
</html>