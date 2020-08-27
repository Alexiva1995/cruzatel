<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">

    {{-- <div class="navbar-header">
        <ul class="nav navbar-nav flex-row"> --}}
    {{-- <li class="nav-item mr-auto"> --}}
    {{-- <a class="navbar-brand" href="" href="" style="width: 100%;margin: 0px; margin-top: 1rem;">
                <div class="brand-logo2" style="width: 100%;">
                    <img src="https://comunidadlevelup.com/assets/imgLanding/logo.png" style="width: 100%;">
                </div>
            </a> --}}
    {{-- </li> --}}
    <!--    <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                    <i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i>
                    <i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i>
                </a>
            </li>-->
    {{-- </ul>

    </div> --}}

    <div class="shadow-bottom"></div>

    <div class="main-menu-content">

        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item d-flex justify-content-center">

                <div>

                    <div id="diseng" class="color-example"
                        style="background: url('{{ asset('avatar/'.Auth::user()->avatar) }}')">

                    </div>

                    <h5 class="text-center">Hola {{Auth::user()->user_nicename}}</h5>

                    <h6 class="text-center">{{Auth::user()->user_email}}</h6>

                </div>

            </li>

            {{-- INICIO --}}



            <li class="nav-item">

                <a href="{{url('mioficina/admin')}}" class="nav-link nav-toggle">

                    <i class="feather icon-home"></i>

                    <span class="title">Dashboard</span>

                </a>

            </li>

            @if (Auth::user()->ID == 1)

            {{-- INICIO TIENDA INTERNA --}}
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="feather icon-shopping-cart"></i>
                    <span class="title">E-commerce</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{route('listProduct')}}" class="nav-link">

                            <span class="title">Productos</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('tienda-index', ['membresia'])}}" class="nav-link nav-toggle">
                            <span class="title">Tienda</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- FIN TIENDA INTERNA --}}

            {{-- HISTORIAL DE PEDIDOS --}}
            <li class="nav-item">

                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="feather icon-activity"></i>
                    <span class="title">Pedidos</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{url('mioficina/admin/transactions/networkorders')}}" class="nav-link">
                            <span class="title">Historial de pedidos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('mioficina/admin/price/confirmar')}}" class="nav-link">
                            <span class="title">Pagos Por Aprobar</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- FIN HISTORIAL DE PEDIDOS --}}

            {{-- INICIO BANCO --}}
            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="feather icon-award"></i>
                    <span class="title">Bancos</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{route('banks.index')}}" class="nav-link">
                            <span class="title">Bancos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('banks.solitud')}}" class="nav-link">
                            <span class="title">Solicitudes</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- FIN BANCO --}}

            {{-- RED DE USUARIO --}}

            <li class="nav-item">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="feather icon-users"></i>
                    <span class="title">Mi Red</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    {{-- <li class="nav-item">
                        <a href="{{route('autenticacion.new-register').'?referred_id='.Auth::user()->ID}}"
                    class="nav-link">
                    <span class="title">Nuevo Usuario</span>
                    </a>
            </li> --}}
            <li class="nav-item">
                <a href="{{route('referraltree', ['tree'])}}" class="nav-link">
                    <span class="title">Árbol Directo</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('referraltree', ['matriz'])}}" class="nav-link">
                    <span class="title">Árbol Binario</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('mioficina/admin/network/directrecords')}}" class="nav-link">
                    <span class="title">Lista de Directos</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('mioficina/admin/network/networkrecords')}}" class="nav-link">
                    <span class="title">Usuarios en Red</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('mioficina/admin/network/binaryrecord')}}" class="nav-link">
                    <span class="title">Usuarios Binarios</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('mioficina/admin/userrecords')}}" class="nav-link">
                    <span class="title">Administracion de Usuario</span>
                </a>
            </li>
        </ul>
        </li>
        {{-- FIN RED DE USUARIO --}}
        @endif

        {{-- PUBLICIDAD--}}

        <li>
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="feather icon-share"></i>
                <span class="title">Publicidad</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('publicidad')}}" class="nav-link">
                        <span class="title">Subir Publicidad</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('publicidad.historial')}}" class="nav-link">
                        <span class="title">Historial de Publicidad por usuario</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- FIN PUBLICIDAD --}}

        {{--LIQUIDACION --}}
        <li>
            <a href="javascript:;" class="nav-link nav-toggle">
                <i class="feather icon-trending-up"></i>
                <span class="title">Liquidaciones</span>
                <span class="arrow"></span>
            </a>
            <ul class="sub-menu">
                <li class="nav-item">
                    <a href="{{route('liquidacion')}}" class="nav-link">
                        {{-- <i class="feather icon-circle"></i> --}}
                        <span class="title">
                            <small>Liquidación Comisiones</small>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('liquidacion.pendientes')}}" class="nav-link">
                        {{-- <i class="feather icon-circle"></i> --}}
                        <span class="title">
                            <small>Liquidaciones Pendientes</small>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('liquidacion.realizadas')}}" class="nav-link">
                        {{-- <i class="feather icon-circle"></i> --}}
                        <span class="title">
                            <small>Historial de Liquidaciones</small>
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('wallet-historial')}}" class="nav-link">
                        {{-- <i class="feather icon-circle"></i> --}}
                        <span class="title">
                            <small>Historial de Comisiones</small>
                        </span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- FIN LIQUIDACION --}}


        {{-- CERRAR SESIÓN --}}

        <li class="nav-item">

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">

                <i class="feather icon-log-out"></i>

                <span class="title">Cerrar Sesión</span>

            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                {{ csrf_field() }}

            </form>

        </li>

        </ul>

    </div>

</div>