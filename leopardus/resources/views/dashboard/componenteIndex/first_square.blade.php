<div class="col-12">
    {{-- fila 1 --}}
    <section class="mt-2 mb-2">
        <div class="row">
            {{-- Estado Binario --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div
                    class="card h-100 mt-1 mb-1 d-flex flex-column align-items-center justify-content-center bg-blue-dark">
                    <div class="card-header d-flex flex-column align-items-center justify-content-center pb-2">
                        <div class="avatar p-50 m-0">
                            <div class="avatar-content avatar-content-alt2">
                                <img class="round" src="{{ asset('avatar/'.Auth::user()->avatar) }}" alt="avatar"
                                    height="40" width="40">
                            </div>
                        </div>
                        <p class="mb-0 mt-1">
                            <h6 class="text-white">
                                Estado Binario
                            </h6>
                            <h2 class="text-bold-700 text-blue-light">
                                <small class="text-bold-700">
                                    @if ($data['activoBinario'])
                                    Activo
                                    @else
                                    Inactivo
                                    @endif
                                </small>
                            </h2>
                            <h6>
                                <small class="text-white">Lado activo de registro binario</small>
                            </h6>
                            <ul class="list-unstyled mb-0 d-flex">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="customRadio"
                                                id="customRadio1" @if (Auth::user()->ladoregistrar == 'D') checked
                                            @endif onclick="updateSideBinary('D')">
                                            <label class="custom-control-label text-white"
                                                for="customRadio1">Derecha</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="customRadio"
                                                id="customRadio2" @if (Auth::user()->ladoregistrar == 'I') checked
                                            @endif onclick="updateSideBinary('I')">
                                            <label class="custom-control-label text-white"
                                                for="customRadio2">Izquierda</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </p>
                    </div>
                </div>
            </div>
            {{-- fin estado binario --}}
            {{-- Membresia --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div
                    class="card h-100 mt-1 mb-1 d-flex flex-column align-items-center justify-content-center bg-blue-dark">
                    <div class="card-header d-flex flex-column align-items-center justify-content-center pb-2">
                        <div class="avatar p-50 m-0">
                            <div class="avatar-content avatar-content-alt">
                                <img class="img-fluid" src="{{$data['membresia']['img']}}" alt="img placeholder"
                                    height="">
                            </div>
                        </div>
                        <p class="mb-0 mt-1 text-white">Membresia</p>
                        <h3 class="text-bold-700 text-blue-light">
                            <small class="text-bold-700">{{$data['membresia']['nombre']}}</small>
                        </h3>
                    </div>
                </div>
            </div>
            {{-- fin Membresia --}}
            {{-- Barra de progreso --}}
            <div class="col-lg-6 col-sm-6 col-12 mt-2">
                <div class="card h-100 mt-1 mb-1 bg-blue-dark">
                    <div class="card-header d-flex align-items-center pb-2 mt-2">
                        <div>
                            <h3 class="text-bold-700 mt-1 text-right text-white">Progreso Diario</h3>
                            {{-- <h2 class="text-bold-700 mt-1 text-right text-white">{{$data['progresoDiario']}} %</h2>
                            --}}
                            {{-- <p class="mb-0 text-white">Progreso Diario</p> --}}
                        </div>
                        <div class="avatar bg-transparent p-50 m-0">
                            <div class="avatar-content text-blue-light">
                                <i class="feather icon-activity font-icons-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="progress progress-bar-primary progress-xl">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width:{{$data['progresoDiario']}}%">
                                {{$data['progresoDiario']}} %
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin barra de progreso --}}
        </div>
    </section>
    {{-- fin fila 1 --}}
    {{-- fila 2 --}}
    <section class="mt-2 mb-2">
        <div class="row">
            {{-- link de referido --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div class="card h-100 mt-1 mb-1 bg-blue-dark" onclick="copyToClipboard('copy')">
                    <div class="card-header d-flex align-items-center pb-0">
                        <div class="avatar bg-transparent p-50 m-0">
                            <div class="avatar-content text-blue-light">
                                <i class="feather icon-link text-info font-icons-alt"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-bold-700 mt-0 text-white text-right">Copiar Link</h3>
                            <p class="mb-0 text-white">
                                <small>Copia tu link de referido</small>
                            </p>
                            <p style="display:none;" id="copy">
                                {{route('autenticacion.new-register').'?referred_id='.Auth::user()->ID}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin link de referido --}}
            {{-- puntos a la Izquierda --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div class="card h-100 mt-1 mb-1 bg-blue-dark">
                    <div class="card-header d-flex align-items-center pb-0">
                        <div class="avatar bg-transparent p-50 m-0">
                            <div class="avatar-content text-blue-light">
                                <i class="feather icon-corner-down-left font-icons-alt"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-bold-700 mt-0 text-right text-white">{{$data['puntos']['izquierdos']}}</h3>
                            <p class="mb-0 text-white text-right">Puntos izquierdos</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin puntos a la izquierda --}}
            {{-- puntos a la derecha --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div class="card h-100 mt-1 mb-1 bg-blue-dark">
                    <div class="card-header d-flex align-items-center pb-0">
                        <div>
                            <h3 class="text-bold-700 mt-0 text-white">{{$data['puntos']['derechos']}}</h3>
                            <p class="mb-0 text-white text-left">Puntos derechos</p>
                        </div>
                        <div class="avatar bg-transparent p-50 m-0">
                            <div class="avatar-content text-blue-light">
                                <i class="feather icon-corner-down-right font-icons-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin puntos a la derecha --}}
            {{-- billetera --}}
            <div class="col-lg-3 col-sm-6 col-12 mt-2">
                <div class="card h-100 mt-1 mb-1 bg-blue-dark">
                    <div class="card-header d-flex align-items-center pb-0">
                        <div class="avatar bg-transparent p-50 m-0">
                            <div class="avatar-content text-blue-light">
                                <i class="fa fa-usd font-icons-alt"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-bold-700 mt-0 text-right text-white">{{$data['billetera']}} $</h3>
                            <p class="mb-0 text-white text-right">Tu billetera</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin billetera --}}
        </div>
    </section>
    {{-- fin fila 2 --}}
</div>



{{-- <div class="col-lg-3 col-sm-6 col-12">
    <div class="card h-100 mt-1 mb-1">
        <div class="card-header d-flex flex-column align-items-center justify-content-center pb-2">
            <div class="avatar bg-rgba-danger p-50 m-0">
                <div class="avatar-content">
                    <i class="feather icon-shopping-cart text-danger font-medium-5"></i>
                </div>
            </div>
            <h2 class="text-bold-700 mt-1">36%</h2>
            <p class="mb-0">Quarterly Sales</p>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
    <div class="card h-100 mt-1 mb-1">
        <div class="card-header d-flex flex-column align-items-center justify-content-center pb-2">
            <div class="avatar bg-rgba-warning p-50 m-0">
                <div class="avatar-content">
                    <i class="feather icon-package text-warning font-medium-5"></i>
                </div>
            </div>
            <h2 class="text-bold-700 mt-1">97.5K</h2>
            <p class="mb-0">Orders Received</p>
        </div>
    </div>
</div> --}}