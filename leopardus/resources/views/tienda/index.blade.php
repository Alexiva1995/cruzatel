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
    {{-- <div class="card-header">
        <h4 class="card-title">Artículos de la Tienda</h4>
    </div> --}}
    <div class="card-content">
        <div class="card-body">
            <button class="btn btn-info" data-toggle="modal" data-target="#myModalB">Datos para la Transferencias
                Bancarias</button>
            <hr>
            <div class="row">
                <div class="col-12">
                    <h6>Elige una membresia</h6>
                </div>
                @foreach ($productos as $item)
                <div class="col-md-4 col-sm-12">
                    <a onclick="detalles({{json_encode($item)}})">
                        <div class="card ecommerce-card p-2" id="producto{{$item->ID}}">
                            <div class="card-content">
                                <div class="item-img text-center">
                                    <img class="img-fluid" src="{{$item->imagen}}" alt="{{$item->post_title}}">
                                </div>
             {{-- <div class="card-body">
                                        <div class="item-name">
                                            <span>
                                                {{$item->post_title}}
                                </span>
                            </div>
                            <div>
                                <p class="item-description">
                                    {{$item->post_content}}
                                </p>
                            </div>
                        </div> --}}
                        {{-- <div class="item-options text-center">
                                        <div class="item-wrapper">
                                            <div class="item-cost">
                                                <h6 class="item-price">
                                                    ${{$item->meta_value}}
                        </h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <h6 class="text-center">
                        <form action="{{route('tienda-save-compra')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" name="idproducto" class="idproducto" value="{{$item->meta_value}}">
                            <input type="hidden" claa="title2" name="name" value="{{$item->post_title}}">
                            <input type="hidden" class="price2" name="precio" value="{{$item->meta_value}}">
                            <input type="hidden" name="tipo" value="paypal">
                            <button type="submit" class="btn button-paypal"><i class="fab fa-paypal"
                                    style="font-size: 1.500rem;"></i> Paypal</button>
                        </form>
                    </h6>
                </div>
            </div>
            <!--<div class="btn btn-info mt-1 text-white">
                                            <i class="feather icon-shopping-cart"></i>
                                        </div>-->
        </div> --}}
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
                                    <input type="radio" name="tipo" value="transferencia" onclick="compleform(this.value)">
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
                        </div>
                        <input type="hidden" name="idproducto" id="product_id">
                        <input type="hidden" class="title2" name="name" id="product_name">
                        <input type="hidden" class="price2" name="precio" id="product_price">
                        <div class="col-12 hiddensp">
                            <div class="row">
                                <div class="form-group col-12 col-md-4">
                                    <label for="" class="text-white">Titular</label>
                                    <input type="text" class="form-control requier" name="titular" required>
                                </div>
                                <div class="form-group col-12 col-md-4">
                                    <label for="" class="text-white">Número de cuenta</label>
                                    <input type="text" class="form-control requier" name="n_cuenta" required>
                                </div>
                                <div class="form-group col-12">
                                    <label for="" class="text-white">Adjuntar comprobante</label>
                                    <input type="file" name="bauche" class="form-control mb-2 requier" required
                                accept="image/jpeg, image/png">
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
            $('.hiddensp').css('display', 'none')
            $('.hiddensp .requier').removeAttr('required')
        }else{
            $('.hiddensp').css('display', 'initial')
            $('.hiddensp .requier').prop('required', true)
        }
    }

</script>

@endsection