<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }

            #links {
                color: #ffffff;
                padding: 10px 25px 15px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/album.css') }}">
        <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/materialize.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/floating-labels.css') }}">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <link rel="icon" href="{{ asset('images/new-logo-s.png') }}" type="image/gif" sizes="16x16">
        <title>Sean Philip Cruz - Information Technology Specialist</title>
    </head>
<body>
<div class="bg-dark collapse" id="navbarHeader">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
                <h4 class="text-white">About</h4>
                <p class="text-muted">
                    Hi I'm Sean Philip Cruz, a freelance developer based in Manila, Philippines. <br>
                    I am quite flexible regarding on developing variety of software, I can develop <br>
                    web and with assistance mobile app. You need my service? contact me in the <br>
                    links or send me an email. <br>
                </p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
                <h4 class="text-white">Contact</h4>
                <ul class="list-unstyled">
                    <li>
                        <a href="http://twitter.com/naaaeeessss" target="_blank">
                            {{--<i class="fab fa-twitter"></i>--}}
                            Twitter
                        </a>
                    </li>
                    <li>
                        <a href="http://facebook.com/shan.pilip" target="_blank">
                            {{--<i class="fab fa-facebook"></i>--}}
                            Facebook
                        </a>
                    </li>
                    <li>
                        <a href="http://github.com/shanpilipcruz" target="_blank">
                            {{--<i class="fab fa-github"></i>--}}
                            Github
                        </a>
                    </li>
                    <li>
                        <a href="https://www.linkedin.com/in/sean-philip-cruz-77b43b143/" target="_blank">
                            {{--<i class="fab fa-linkedin"></i>--}}
                            LinkedIn
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container d-flex justify-content-between">
        <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center">
            <img src="{{ asset('images/new-logo-s.png') }}" width="30px" alt="website_logo"/>
        </a>
        @auth
            <ul class="navbar-nav ml-auto mr-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
            </ul>
        @endauth
        @if(url()->current() == "http://localhost:8000/login" && Route::has('register'))
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            </ul>
        @elseif(url()->current() == "http://localhost:8000/register" && Route::has('login'))
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            </ul>
        @elseif(url()->current() == "http://localhost:8000/email/verify")
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        @else
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        @endif
    </div>
</nav>
    <header>
        @yield('main')
    </header>
<footer class="text-muted @if(url()->current() == "http://localhost:8000/login" || url()->current() == "http://localhost:8000/sendemail" || url()->current() == "http://localhost:8000/email/verify") fixed-bottom @else @endif">
    <div class="container">
        <p class="float-right">
            @if(url()->current() == "http://localhost:8000/login" || url()->current() == "http://localhost:8000/sendemail" || url()->current() == "http://localhost:8000/register" || url()->current() == "http://localhost:8000/email/verify")

            @else
                <a href="#">Back to top</a>
            @endif
        </p>
    </div>
</footer>
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jQueryScripts.js') }}"></script>
</body>
</html>
