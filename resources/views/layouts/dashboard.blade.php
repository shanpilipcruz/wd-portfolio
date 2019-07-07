<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Manage Projects</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/floating-labels.css') }}">

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
    </style>
</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow navbar-expand-lg">
    <a class="navbar-brand flat col-sm-3 col-md-2 mr-0" href="{{ action('DashboardController@index') }}">
        Project Management
    </a>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    @if($user = auth()->user())
                        <li class="navbar-nav px-3">
                            <a href="{{ action('UserProfileController@show', $user) }}" class="nav-link flat">
                                <span class="sr-only">(current)</span>
                                <img src="{{ url('/') }}/images/profile_images/{{ $user->profile_img }}" alt="{{ $user->profile_img }}" class="rounded img-responsive mr-3" width="25px" height="25px">Hi! {{ Auth::user()->first_name }}
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ action('DashboardController@index') }}">
                            <i class="fa fa-tachometer-alt mr-1"></i>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ action('DashboardController@create') }}">
                            <i class="fa fa-plus-square mr-2"></i>
                            Create
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ action('DashboardController@showUsers') }}">
                            <i class="fa fa-user mr-2"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off mr-2"></i>{{ __('Logout') }}
                        </a>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
            @yield('content')
        </main>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/inputmask.js') }}"></script>
<script src="{{ asset('js/customScripts.js') }}"></script>
</body>
</html>
