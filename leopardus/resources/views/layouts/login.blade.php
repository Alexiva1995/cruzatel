<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->name }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/authentication.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <!-- END: Custom CSS-->

    <style>
        .bg-full-screen-image-alt{
            background: url("{{asset('assets/img/newfondo.jpg')}}");
            background-size: cover;
        }

        /* #imagen{
            position: absolute;
            top: 150;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        } */

    </style>

</head>

<body
    class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image-alt blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <nav class="navbar navbar-expand-lg sticky-top navbar-light" id="menu">

            <a class="navbar-brand" href="javascript:;" onclick="moveDiv('#header')">
        
                {{-- <img id="imagen" src="{{asset('assets/imgLanding/logo-cruzatel.png')}}" height="90" alt=""> --}}
        
            </a>
        
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
        
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        
                <span class="navbar-toggler-icon text-white"></span>
        
            </button>
        
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
        
                <ul class="navbar-nav" style="margin-right: 100px">
                    {{-- <li class="nav-item active">
                        <a class="nav-link d-flex text-small text-white" href="javascript:;" onclick="moveDiv('#quienessomos')">
                            <div class="point"></div> Filosofía <span class="sr-only">(current)</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link d-flex text-small text-white" href="javascript:;">
                            Nosotros
                        </a>
                    </li>
        
                    <li class="nav-item">
                        <a class="nav-link d-flex text-small text-white" href="javascript:;">
                            Servicios
                        </a>
                    </li>
        
                    <li class="nav-item mr-5">
                        <a class="nav-link d-flex text-small text-white" >
                            Equipo
                        </a>
                    </li>
        
                    <li class="nav-item ml-5">
                        <a class="nav-link d-flex text-small text-white" href="{{route('login')}}">
                             Login
                        </a>
                    </li>
        
                </ul>
        
            </div>
        
        </nav>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
</body>

<!-- BEGIN: Vendor JS-->
<script src="{{asset('/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('/app-assets/js/core/app.js')}}"></script>
<script src="{{asset('/app-assets/js/scripts/components.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<!-- END: Page JS-->

</html>