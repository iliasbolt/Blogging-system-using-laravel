<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top bg-light navbar-dark">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#okOpen">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/posts') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="okOpen">
                <!-- Left Side Of Navbar -->
                <!--<ul class="nav navbar-nav">
                    &nbsp;why
                </ul>-->
                <ul class="nav navbar-nav navbar-left">

                    <!--<a href="/About" class="btn btn-info">About</a>
                    <a href="/Services" class="btn btn-primary">Services</a>
                        -->

                    <a href="/posts" class="nav-item btn-lg btn btn-light">{{__('text.Home')}}</a>
                    @if(!Auth::guest())
                        <a href="/" class="nav-item btn-lg btn btn-light">{{__('text.Myposts')}}</a>
                    @endif
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right navbar-dark">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>

                    @else

                        <li class="dropdown" id="dropDown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu" >
                                <li><a href="/profile">{{__('text.MyProfile')}}</a> </li>
                                <li><a href="#" id="languages">{{__('text.languages')}}</a></li>

                                <div id="lang" style="display: none">
                                    <ul>
                                        @if(isset($meProfile))
                                            <li><a href="/profile/lang/fr">french</a></li>
                                            <li><a href="/profile/lang/en">english</a></li>
                                            <li><a href="/profile/lang/ar">arabic</a></li>
                                        @elseif(isset($me))
                                            <li><a href="/lang/fr">french</a></li>
                                            <li><a href="/lang/en">english</a></li>
                                            <li><a href="/lang/ar">arabic</a></li>
                                        @elseif(isset($ediTP))
                                            <li><a href="/posts/{{$id}}/edit/lang/fr">french</a></li>
                                            <li><a href="/posts/{{$id}}/edit/lang/en">english</a></li>
                                            <li><a href="/posts/{{$id}}/edit/lang/ar">arabic</a></li>
                                        @else<!-- dashboard -->
                                        <li><a href="/posts/lang/fr">french</a></li>
                                        <li><a href="/posts/lang/en">english</a></li>
                                        <li><a href="/posts/lang/ar">arabic</a></li>
                                        @endif

                                    </ul>
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        $("#languages").hover(function () {
                                            $("#lang").css("display","block");
                                        });
                                        //to keep laguages opened
                                        $("#lang").hover(function () {
                                            $("#lang").css("display","block");
                                        });


                                    });
                                </script>

                                <li><a href="/home">{{__('text.Posts')}}</a> </li>

                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{__('text.Logout')}}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>

            </div>

        </div>
    </nav>

    @yield('content')

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
