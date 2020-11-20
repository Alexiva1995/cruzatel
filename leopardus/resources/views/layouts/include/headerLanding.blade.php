{{-- Menu --}}

<style>
    #imagen{
    position: absolute;
    width: 100px;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
}

</style>

{{-- <nav class="navbar navbar-expand-lg {{($landing == 0) ? 'fixed-top' : 'sticky-top'}} navbar-light" id="menu"> --}}
<nav class="navbar navbar-expand-lg sticky-top navbar-light" id="menu">

    <a class="navbar-brand" href="javascript:;" onclick="moveDiv('#header')">

        <img id="imagen" src="{{asset('assets/imgLanding/logo-cruzatel.png')}}" height="90" alt="">

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
                <a class="nav-link d-flex text-small text-white" href="javascript:;">
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

{{-- informacion principal --}}

<div class="container" id="header" style="height: 81.5vh">
    @include('layouts.include.sublanding.inicio')
</div>