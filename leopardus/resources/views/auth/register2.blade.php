@extends('layouts.login')

@section('content')
<script>
    function validarEdad(edad) {
        var hoy = new Date();
        var cumpleanos = new Date(edad);

        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();

        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }

        if (edad < {
                {
                    $settings - > edad_minino
                }
            }) {
            document.getElementById("btn").disabled = true;
            document.getElementById("errorEdad").style.display = 'block';
        } else {
            document.getElementById("btn").disabled = false;
            document.getElementById("errorEdad").style.display = 'none';
        }
    }
</script>
@php
$referred = null;
@endphp
@if ( request()->referred_id != null )
@php
$referred = DB::table($settings->prefijo_wp.'users')
->select('display_name')
->where('ID', '=', request()->referred_id)
->first();
@endphp

@endif

<style>
    .card-alt {
        background: #3A58A2 0% 0% no-repeat padding-box !important;
        border-radius: 25px !important;
        opacity: 1 !important;
    }

    .input-alt {
        background: #FFFFFF 0% 0% no-repeat padding-box;
        border-radius: 25px;
        opacity: 1;
        text-align: left;
        letter-spacing: 0px;
        color: #434343;
    }

    .bg-white {
        background: #ffffff !important;
    }

    .btn-alt {
        background: #5CBDEB 0% 0% no-repeat padding-box !important;
        border-radius: 25px !important;
    }

    .form-label-group>input:not(:active):not(:placeholder-shown)~label {
        color: #ffffff !important;
    }

    .z-index-alt input{
        z-index: 2;
    }
    .z-index-alt label{
        z-index: 1;
    }
</style>

<section class="row flexbox-container">
    <div class="col-xl-8 col-10 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0 card-alt col-8 col-sm-6 col-lg-5">
            <div class="row m-0">
                {{-- <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                    <img src="{{asset('assets/imgLanding/logo2.png')}}" alt="branding logo" width="350">
                <img src="{{asset('assets/imgLanding/logo2.png')}}" alt="branding logo" width="300">
                <img src="../../../app-assets/images/pages/register.jpg" alt="branding logo">
            </div> --}}
            <div class="col-12 p-0">
                <div class="card rounded-0 mb-0 p-2 card-alt pb-0">
                    <div class="card-header pt-50 pb-0 mb-2">
                        <div class="card-title">
                            <h4 class="mb-0 text-white">Registrarse</h4>
                        </div>
                    </div>
                    @if ($referred != null)
                    <p class="px-2 text-white">Referido de : <strong>{{ $referred->display_name }}</strong> </p>
                    @endif

                    {{-- alertas --}}
                    <div class="col-12">
                        @include('dashboard.componentView.alert')
                    </div>

                    {{-- <p >Fill the below form to create a new account.</p> --}}
                    <div class="card-content">
                        <div class="card-body pt-0">

                            <form method="POST" action="{{ route('autenticacion.save-register') }}">
                                {{ csrf_field() }}

                                @foreach($campos as $campo)
                                @if($campo->tipo == 'select')
                                <div class="form-label-group input-alt">

                                    <select class="form-control input-alt" name="{{$campo->nameinput}}"
                                        required="{{($campo->requerido == 1) ? 'true' : 'false'}}">
                                        <option value="" disabled selected>{{$campo->label}}
                                            {{($campo->requerido == 1) ? '(*)' : ''}}</option>
                                        @foreach($valoresSelect as $valores)
                                        @if ($valores['idselect'] == $campo->id)
                                        <option value="{{$valores['valor']}}">{{$valores['valor']}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                @elseif($campo->tipo == 'number')
                                <div class="form-label-group input-alt">
                                    <label class="" for=""></label>
                                    <input class="form-control input-alt" step="1" type="{{$campo->tipo}}"
                                        placeholder="'{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}'"
                                        name="{{$campo->nameinput}}" min="{{(!empty($campo->min)) ? $campo->min : ''}}"
                                        max="{{(!empty($campo->max)) ? $campo->max : ''}}"
                                        required="{{($campo->requerido == 1) ? 'true' : 'false'}}"
                                        value="{{old($campo->nameinput)}}">
                                </div>
                                @else
                                @if($campo->input_edad == 1)
                                <div class="form-label-group input-alt">

                                    <input class="form-control input-alt" type="{{$campo->tipo}}"
                                        placeholder="'{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}'"
                                        name="{{$campo->nameinput}}" value="{{old($campo->nameinput)}}"
                                        onblur="validarEdad(this.value)"
                                        required="{{($campo->requerido == 1) ? 'true' : 'false'}}">
                                </div>
                                @else
                                <div class="form-label-group input-alt">

                                    <input class="form-control input-alt"
                                        placeholder="{{$campo->label}} {{($campo->requerido == 1) ? '(*)' : ''}}"
                                        type="{{$campo->tipo}}" name="{{$campo->nameinput}}"
                                        value="{{old($campo->nameinput)}}"
                                        minlength="{{(!empty($campo->min)) ? $campo->min : ''}}"
                                        maxlength="{{(!empty($campo->max)) ? $campo->max : ''}}"
                                        required="{{($campo->requerido == 1) ? 'true' : 'false'}}">
                                </div>
                                @endif
                                @endif
                                @endforeach


                                <div class="form-label-group form-group position-relative z-index-alt">
                                    <input
                                        class="form-control input-alt form-control-solid placeholder-no-fix form-label-group"
                                        placeholder="Ingresa tu email" type="text" autocomplete="off" name="user_email"
                                        required oncopy="return false" onpaste="return false" />
                                    <label class="text-white">Email</label>
                                </div>



                                <div class="form-label-group form-group position-relative z-index-alt">

                                    <input
                                        class="form-control input-alt form-control-solid placeholder-no-fix form-label-group"
                                        placeholder="Ingresa tu nombre de usuario" type="text" autocomplete="off"
                                        name="user_login" required oncopy="return false" onpaste="return false" />
                                    <label class="text-white">Usuario</label>
                                </div>


                                <div class="form-label-group form-group position-relative z-index-alt">

                                    <input
                                        class="form-control input-alt form-control-solid placeholder-no-fix form-label-group"
                                        type="password" autocomplete="off" name="password"
                                        placeholder="Ingresar una contraseña" required style="background-color:f7f7f7;"
                                        oncopy="return false" onpaste="return false" />
                                    <label class="text-white">Contraseña</label>
                                </div>

                                <div class="form-label-group form-group position-relative z-index-alt">

                                    <input
                                        class="form-control input-alt form-control-solid placeholder-no-fix form-label-group"
                                        type="password" autocomplete="off" name="password_confirmation"
                                        placeholder="Confirmar la contraseña" required style="background-color:f7f7f7;"
                                        oncopy="return false" onpaste="return false" />
                                    <label class="text-white">Repetir Contraseña</label>
                                </div>

                                <input type="hidden" name="ladomatrix" value="{{request()->lado}}">

                                @if (request()->referred_id == null)
                                <div class="form-label-group form-group position-relative z-index-alt">

                                    <input
                                        class="form-control input-alt form-control-solid placeholder-no-fix form-label-group"
                                        placeholder="ID Del Patrocinador" type="text" autocomplete="off"
                                        name="referred_id" />
                                    <label class="text-white">Usuario</label>
                                </div>
                                @else
                                <input type="hidden" name="referred_id" value="{{ request()->referred_id }}" />
                                @endif

                                @if (empty(request()->tipouser))
                                <input type="hidden" name="tipouser" value="Normal" />
                                @else
                                <input type="hidden" name="tipouser" value="{{ request()->tipouser }}" />
                                @endif

                                <button type="submit" class="btn btn-primary btn-block btn-alt btn-inline mb-50">Registrar</button>
                                    <div class="mt-3">
                                        <h6 class="text-white text-center">
                                            <small>
                                                ¿Ya tienes una cuenta? <strong><a href="{{route('login')}}" class="text-white">Ingresa</a></strong>
                                            </small>
                                        </h6>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection