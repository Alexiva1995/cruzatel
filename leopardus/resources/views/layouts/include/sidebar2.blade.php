<div class="main-menu menu-fixed menu-light menu-color menu-accordion menu-shadow" data-scroll-to-active="true" style="overflow-y: auto">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="" href="" style="width: 100%;margin: 0px; margin-top: 1rem;">
                    <div class="brand-logo2" style="width: 100%;">
                        <img src="{{asset('assets/imgLanding/logo-cruzatel.png')}}" style="width: 100%;">
                    </div>
                </a>
            </li>
            <!--    <li class="nav-item nav-toggle text-white">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i>
                </a>
            </li>-->
        </ul>
    </div>
{{-- <div class="shadow-bottom"></div> --}}
<div class="main-menu-content">
    <ul class="navigation navigation-main menu-color" id="main-menu-navigation" data-menu="menu-navigation">
        {{-- INICIO --}}
        <li class="nav-item">
            <a href="{{url('mioficina/admin')}}" class="nav-link nav-toggle text-white">
                <i class="feather icon-home"></i>
                <span class="title">Dashboard</span>
            </a>
        </li>
        {{-- RANKING --}}
        <li class="nav-item">
            <a href="{{route('tienda-index', ['membresia'])}}" class="nav-link nav-toggle text-white">
                <i class="feather icon-shopping-cart"></i>
                <span class="title">Membresia</span>
            </a>
        </li>
        {{--FIN RANKING --}}
        {{-- MARKETING --}}
        <li class="nav-item">
            <a href="{{route('tienda-index', ['tienda'])}}" class="nav-link nav-toggle text-white">
                <i class="feather icon-shopping-cart"></i>
                <span class="title">Marketplace</span>
            </a>
        </li>
        {{-- FIN MARKETING --}}
        {{-- GEONOLOGIA --}}
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle text-white">
                <i class="feather icon-users"></i>
                <span class="title">Mi Red</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu menu-color">
                {{-- <li class="nav-item">
                    <a href="{{route('autenticacion.new-register').'?referred_id='.Auth::user()->ID}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Nuevo Usuario</span>
                    </a>
                </li>--}}
                {{-- <li class="nav-item">
                    <a href="{{route('referraltree', ['tree'])}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Árbol Directo</span>
                    </a>
                </li>--}}
                <li class="nav-item">
                    <a href="{{route('referraltree', ['matriz'])}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Árbol Binario</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('mioficina/admin/network/directrecords')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Registros Directos</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{url('mioficina/admin/network/networkrecords')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Registros en Red</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('mioficina/admin/network/binaryrecord')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Usuarios Binarios</span>
                    </a>
                </li>--}}
            </ul>
        </li>
        {{-- FIN GENEALOGIA --}}
        {{--INICIO BILLETERA --}}
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle text-white">
                <i class="feather icon-trending-up"></i>
                <span class="title">Billetera</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu menu-color">
                <li class="nav-item">
                    <a href="{{url('mioficina/admin/wallet')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">E-wallet</span>
                    </a>
                </li>
                {{--<li class="nav-item">
                    <a href="{{url('mioficina/admin/wallet/cobros')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Historial de Retiro</span>
                    </a>
                </li>--}}
            </ul>
        </li>
        {{-- FIN BILLETERA --}}

        {{-- TRANSACCIONES --}}
        <li class="nav-item">
            <a href="javascript:;" class="nav-link nav-toggle text-white">
                <i class="feather icon-activity"></i>
                <span class="title">Mi Negocio</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu menu-color">
                <li class="nav-item">
                    <a href="{{url('mioficina/admin/transactions/personalorders')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Historial de Membresia</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('mioficina/admin/transactions/networkorders')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Historial de Compras Membresia</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('mioficina/admin/wallet/puntos')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Historial de Puntos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('mioficina/admin/wallet/')}}" class="nav-link text-white">
                        <i class="feather icon-circle"></i>
                        <span class="title">Historial de Comisiones</span>
                    </a>
                </li>
            </ul>
        </li>
        {{--FIN TRANSACCIONES --}}

        <li>
            <a href="{{route('publicidad.user')}}" class="nav-link nav-toggle text-white">
                <i class="feather icon-share"></i>
                <span class="title">Publicidad</span>
            </a>
        </li>

        {{-- CERRAR SESIÓN --}}
        <li class="nav-item">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link text-white">
                <i class="feather icon-log-out"></i>
                <span class="title">Cerrar Sesión</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
        {{-- FIN CERRAR SESIÓN --}}
    </ul>
</div>
</div>