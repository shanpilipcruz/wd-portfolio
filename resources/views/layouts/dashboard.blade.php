<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <title>Manage Projects</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/album.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/floating-labels.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/croppie.css') }}">
    <link rel="icon" href="{{ asset('images/new-logo-s.png') }}" type="image/gif" sizes="16x16">

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
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand flat col-sm-3 col-md-2 mr-0" href="{{ action('DashboardController@index') }}">
        Project Management
    </a>

    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Sign Out') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    @if(Auth::user()->Profile->first_name === null)
                        <li class="navbar-nav px-3">
                            <a href="{{ action('UserProfileController@create', Auth::user()->id) }}" class="nav-link flat">
                                <span class="sr-only">(current)</span>
                                <img src="{{ url('/') }}/images/profile_images/default.png" alt="default.png" class="rounded img-responsive mr-3" width="25px" height="25px">Hi! {{ Auth::user()->Profile->username }}
                            </a>
                        </li>
                    @else
                        <li class="navbar-nav px-3">
                            <a href="{{ action('UserProfileController@show', Auth::user()->id) }}" class="nav-link flat">
                                <span class="sr-only">(current)</span>
                                @if(Auth::user()->Profile->profile_picture === null)
                                    <img src="{{ url('/') }}/images/profile_images/default.png" alt="default.png" class="rounded img-responsive mr-3" width="25px" height="25px">Hi! {{ Auth::user()->Profile->first_name }}
                                @else
                                    <img src="{{ url('/') }}/images/profile_images/{{ Auth::user()->Profile->profile_picture }}" alt="{{ Auth::user()->Profile->profile_picture }}" class="rounded img-responsive mr-3" width="25px" height="25px">Hi! {{ Auth::user()->Profile->first_name }}
                                @endif
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
                        <a class="nav-link" href="{{ action('IndexController@index') }}">
                            <i class="fa fa-home mr-1"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ action('DashboardController@create') }}">
                            <i class="fa fa-plus-square mr-2"></i>
                            Create
                        </a>
                    </li>
                    @if(Auth::user()->user_role === 1)

                    @else
                        @if(Auth::user()->Profile->first_name === null)

                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ action('DashboardController@showUsers') }}">
                                    <i class="fa fa-user mr-2"></i>
                                    Users
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-5">
            @yield('content')
        </main>

        @include('responses.modals')
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/croppie.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let resize = $("#upload-demo").croppie({
        enableExif: true,
        enableOrientation: true,
        viewport: {
            width: 200,
            height: 200,
            type: 'square'
        },
        boundary: {
            width: 300,
            height: 300
        }
    });

    $("#profile_img").on('change', function(){
        let reader = new FileReader();
        reader.onload = function (e) {
            resize.croppie('bind', {
                url: e.target.result
            }).then(function(){
               console.log('jQuery Bind Complete');
            });
        };
        reader.readAsDataURL(this.files[0]);
        $("#cropModal").modal('show');
    });

    $('.upload-image').on('click', function(){
        resize.croppie('result', {
            type: 'canvas',
            size: 'viewport',
        }).then(function(img){
            $.ajax({
                url: "{{ route('upload.image') }}",
                type: "POST",
                data: { "profile_img" : img},
                success: function(data){
                    $('#cropModal').modal('hide');
                    $("#preview").attr("src", img);
                    $("#profile_picture").val(data);
                }
            });
        });
    });

</script>
{{--TODO set img src to image filename that is in the local and save to database --}}
<script src="{{ asset('js/jquery.inputmask.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
<script src="{{ asset('js/inputmask.js') }}"></script>
<script src="{{ asset('js/customScripts.js') }}"></script>

</body>
</html>
