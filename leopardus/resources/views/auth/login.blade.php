@extends('layouts.login')

@section('content')
@php
    if(!request()->secure())
    {
        // dd('entre');
        header('location: https://cruzatel.com/mioficina/login');
        // return redirect()->secure(request()->getPathInfo());
        // redirect()->secure(request()->getPathInfo(),301);
    }
@endphp

<style>
    .card-alt{
        background: #3A58A2 0% 0% no-repeat padding-box !important;
        border-radius: 25px !important;
        opacity: 1 !important;
    }

    .input-alt{
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border-radius: 25px;
        opacity: 1;
        text-align: left;
        letter-spacing: 0px;
        color: #434343;
    }

    .bg-white{
        background: #ffffff !important;
    }

    .btn-alt{
        background: #5CBDEB 0% 0% no-repeat padding-box !important;
        border-radius: 25px !important;
    }

    .form-label-group > input:not(:active):not(:placeholder-shown) ~ label{
        color: #ffffff !important;
    }
</style>


<section class="row flexbox-container">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0 card-alt card-alt col-8 col-sm-6 col-lg-5">
            <div class="row m-0">
                {{-- <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    <img style="max-width: 250px;"src="{{asset('assets/imgLanding/logo2.png')}}" alt="branding logo" width="300">
                    <img src="{{asset('app-assets/images/pages/login.png')}}" alt="branding logo">
                </div> --}}
                <div class="col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2 card-alt">
                        <div class="card-header pb-1">
                            <div class="card-title inicio" style="width: auto; margin: auto auto;">
                                <h4 class="mb-0 text-white">Iniciar sesión</h4>
                            </div>
                            <div class="card-title recuperar" style="display:none;">
                                <h4 class="mb-0 text-white">Recuperar tu clave</h4>
                            </div>
                        </div>
                        {{-- alertas --}}
                        @include('dashboard.componentView.alert')

                        {{-- <p class="px-2">Welcome back, please login to your account.</p> --}}
                        <div class="card-content">
                            <div class="card-body pt-1 pb-0">
                                {{-- registro --}}
                                <form class="login-form inicio" method="POST"
                                    action="{{ route('autenticacion-login') }}">
                                    {{ csrf_field() }}
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input type="text" class="form-control input-alt" id="user-name" placeholder="Username"
                                            required value="{{ old('user_email') }}" name="user_email">
                                        <div class="form-control-position">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        <label for="user-name" class="text-white">Usuario</label>
                                    </fieldset>

                                    <fieldset class="form-label-group position-relative has-icon-left mb-0">
                                        <input type="password" class="form-control input-alt" id="user-password"
                                            placeholder="Password" required name="password">
                                        <div class="form-control-position">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        <label for="user-password" class="text-white">Contraseña</label>
                                    </fieldset>
                                    
                                        <div class="text-center" >
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary" >
                                                    <input type="checkbox">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"> </i>
                                                        </span>
                                                    </span>
                                                    <span class="text-white" >   Recordar</span>
                                                </div>
                                            </fieldset>
                                        </div>

                                    <div class="text-center">
                                        <a class="card-link text-white" onclick="toggle()" href="javascript:;">
                                         ¿Olvidaste tu Clave?
                                         </a>
                                    </div>

                                    {{-- <a href="{{route('autenticacion.new-register')}}"
                                        class="btn btn-outline-primary float-left btn-inline">Registro</a> --}}
                                    <button type="submit" class="btn btn-primary btn-block btn-inline btn-alt mt-4">Session</button>
                                    
                                </form>
                                {{-- reset password --}}
                                <form class="forget-form recuperar" action="{{route('autenticacion.clave')}}"
                                    method="post" style="display:none;">
                                    {{ csrf_field() }}
                                    <div class="form-label-group">
                                        <input type="email" id="inputEmail" class="form-control input-alt" placeholder="Email" name="email">
                                        <label for="inputEmail">Correo</label>
                                    </div>

                                    <div class="float-md-right d-block mb-1 col-12">
                                        <button type="submit" class="btn btn-primary btn-alt btn-block px-75">Recuperar tu Clave</button>
                                    </div>
                                    <div class="float-md-left d-block mb-1 col-12">
                                        <a href="javascript:;" class="btn btn-outline-primary bg-white btn-block px-75"
                                            onclick="toggle()">Regresar al Login</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="login-footer">
                            <div class="divider">
                                <div class="divider-text">OR</div>
                            </div>
                            <div class="footer-btn d-inline">
                                <a href="#" class="btn btn-facebook"><span class="fa fa-facebook"></span></a>
                                <a href="#" class="btn btn-twitter white"><span class="fa fa-twitter"></span></a>
                                <a href="#" class="btn btn-google"><span class="fa fa-google"></span></a>
                                <a href="#" class="btn btn-github"><span class="fa fa-github-alt"></span></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    function toggle() {
        $('.inicio').toggle('slow')
        $('.recuperar').toggle('slow')
    }
</script>
@endsection