@extends('layouts.dashboard')

@push('page_css')
<style>
    .button-paypal {
        background-color: #009FDB;
        text-align: center;
        color: white;
    }

    .button-paypal:hover {
        color: #009FDB;
        background-color: white;
        border: solid #009FDB 1px;
    }

    .btn-raduis {
        padding: 5px 20px;
        border-radius: 10px;
    }
</style>
@endpush
@push('page_js')
<script src="https://kit.fontawesome.com/13c3feec08.js" crossorigin="anonymous"></script>
@endpush

@section('content')

{{-- alertas --}}
@include('dashboard.componentView.alert')

<div class="card body-color">
    <div class="card-content">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h6 class="text-white">Elige una membresia</h6>
                </div>
                @foreach ($productos as $item)
                <div class="col-md-4 col-sm-12">
                    <a onclick="detalles({{json_encode($item)}})">
                        <div class="card ecommerce-card p-2" id="producto{{$item->ID}}">
                            <div class="card-content">
                                <div class="item-img text-center">
                                    <img class="img-fluid" src="{{$item->imagen}}" alt="{{$item->post_title}}">
                                </div>
                                <div class="card-body bg-blue-dark">
                                    <div class="item-name text-white">
                                        <span>
                                            {{$item->post_title}}
                                        </span>
                                    </div>
                                    <div>
                                        <p class="item-description text-white">
                                            {{$item->post_content}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                <div class="col-12">
                    <h6 class="text-white">Elige un metodo de pago</h6>
                    <form action="{{route('tienda-save-compra')}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="d-flex">
                            <fieldset class="m-1">
                                <div class="vs-radio-con">
                                    <input type="radio" name="tipo" value="transferencia"
                                        onclick="compleform(this.value)">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="text-white btn-raduis">
                                        <i class="fas fa-university"></i>
                                        Transferencia Bancaria
                                    </span>
                                </div>
                            </fieldset>
                            <fieldset class="m-1">
                                <div class="vs-radio-con">
                                    <input type="radio" name="tipo" value="paypal" onclick="compleform(this.value)">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="button-paypal btn-raduis">
                                        <i class="fab fa-paypal" style="font-size: 1.500rem;"></i>
                                        Paypal
                                    </span>
                                </div>
                            </fieldset>
                            <fieldset class="m-1">
                                <div class="vs-radio-con">
                                    <input type="radio" name="tipo" value="btc" onclick="compleform(this.value)">
                                    <span class="vs-radio">
                                        <span class="vs-radio--border"></span>
                                        <span class="vs-radio--circle"></span>
                                    </span>
                                    <span class="text-white btn-raduis">
                                        <i class="fab fa-btc" style="font-size: 1.500rem;"></i>
                                        Cripto
                                    </span>
                                </div>
                            </fieldset>
                        </div>
                        <input type="hidden" name="idproducto" id="product_id">
                        <input type="hidden" class="title2" name="name" id="product_name">
                        <input type="hidden" class="price2" name="precio" id="product_price">
                        <div class="col-12 hiddensp" style="display: none;">
                            <div>
                                <h5 class="text-white">Datos Bancarios</h5>
                                <div class="row">
                                    @foreach ($banks as $bank)
                                    <div class="col-12 col-md-4">
                                        <div class="card bg-blue-dark text-white">
                                            <div class="card-content">
                                                <div class="card-header">
                                                    <h4 class="card-title text-white">
                                                        Banco {{$bank->nombre}}
                                                    </h4>
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="text-white">Nombre: <strong>{{$bank->nombre}}</strong>
                                                    </h5>
                                                    <h5 class="text-white">Titular: <strong>{{$bank->titular}}</strong>
                                                    </h5>
                                                    <h5 class="text-white">DNI: <strong>{{$bank->dni}}</strong></h5>
                                                    <h5 class="text-white">Correo: <strong>{{$bank->correo}}</strong>
                                                    </h5>
                                                    <h5 class="text-white">Tipo de Cuenta:
                                                        <strong>{{$bank->tipo_cuenta}}</strong>
                                                    </h5>
                                                    <h5 class="text-white">Número de Cuenta:
                                                        <strong>{{$bank->numero_cuenta}}</strong></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" name="titular" value="Banco">
                                <div class="form-group col-12 col-md-4">
                                    <label for="" class="text-white">Número De Referencia</label>
                                    <input type="text" class="form-control requier" name="n_cuenta" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="" class="text-white">Adjuntar comprobante</label>
                                    <input type="file" name="bauche" class="form-control mb-2 requier" required
                                        accept="image/jpeg, image/png">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 hiddenbtc" style="display: none">

                            <h5 class="text-white">Billeteras</h5>
                            <h5 class="text-white">
                                <strong>BTC: 1BL3JEbxxXwTDA2rmusT2br6FG6WE74QMb</strong>
                            </h5>
                            <h5 class="text-white">
                                <strong>ETH: 0xCA307e967238C68Ce53B126de5Bcb31e71660791</strong>
                            </h5>
                            <div class="row">
                                <input type="hidden" name="titular" value="Cripto">
                                <div class="form-group col-12">
                                    <label for="" class="text-white">Hash Transacion</label>
                                    <input type="text" class="form-control requier" name="n_cuenta" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info">Procesar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- modales --}}
@include('tienda.modalCompra')
@include('tienda.modalBancos')
{{-- @include('tienda.modalCupon') --}}

<script>
    function detalles(product) {
        $('.ecommerce-card').removeClass('bg-blue-dark')
        $('#producto' + product.ID).addClass('bg-blue-dark')
        $('#product_id').val(product.ID)
        $('#product_name').val(product.post_title)
        $('#product_price').val(product.meta_value)
        // $('#myModalB').modal('show')
    }

    function compleform(valor) {
        if (valor == 'paypal') {
            $('.hiddenbtc').css('display', 'none')
            $('.hiddenbtc .requier').removeAttr('required')
            $('.hiddensp').css('display', 'none')
            $('.hiddensp .requier').removeAttr('required')
        } else if (valor == 'btc') {
            $('.hiddensp').css('display', 'none')
            $('.hiddensp .requier').removeAttr('required')
            $('.hiddenbtc').css('display', 'initial')
            $('.hiddenbtc .requier').prop('required', true)
        } else {
            $('.hiddensp').css('display', 'initial')
            $('.hiddensp .requier').prop('required', true)
            $('.hiddenbtc').css('display', 'none')
            $('.hiddenbtc .requier').removeAttr('required')
        }
    }
</script>

@endsection