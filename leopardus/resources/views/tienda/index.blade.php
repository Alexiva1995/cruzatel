@extends('layouts.dashboard')

@push('page_css')
    <style>
        .button-paypal{
            background-color: #009FDB; 
            text-align: center;
            color: white;
        }
        .button-paypal:hover{
            color: #009FDB; 
            background-color: white; 
            border: solid #009FDB 1px;
        }
    </style>
@endpush
@push('page_js')
    <script src="https://kit.fontawesome.com/13c3feec08.js" crossorigin="anonymous"></script>
@endpush

@section('content')

{{-- alertas --}}
@include('dashboard.componentView.alert')

<div class="card">
    <div class="card-header">
        <h4 class="card-title">Artículos de la Tienda</h4>
    </div>
    <div class="card-content">
        <div class="card-body">
            <button class="btn btn-info" data-toggle="modal" data-target="#myModalB">Datos para la Transferencias Bancarias</button>
            <hr>
            <div class="row">
                @foreach ($productos as $item)
                    <div class="col-md-4 col-sm-12">
                        <div class="card ecommerce-card">
                            <div class="card-content">
                                <div class="item-img text-center">
                                    <img class="img-fluid" src="{{$item->imagen}}" alt="{{$item->post_title}}">
                                </div>
                                <div class="card-body">
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
                                </div>
                                <div class="item-options text-center">
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
                                                    <button type="submit" class="btn button-paypal"><i class="fab fa-paypal" style="font-size: 1.500rem;"></i> Paypal</button>
                                                </form>
                                            </h6>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <h6 class="text-center">
                                                <button class="btn btn-info" onclick="detalles({{json_encode($item)}})"><i class="fas fa-university"></i> Transferencia Bancaria</button>
                                            </h6>
                                        </div>
                                    </div>
                                    <!--<div class="btn btn-info mt-1 text-white">
                                        <i class="feather icon-shopping-cart"></i>
                                        <a class="view-in-cart" onclick="detalles({{json_encode($item)}})">Comprar</a>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
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
        $('#idproducto').val(product.ID)
        //$('#img').attr('src', product.imagen)
        //$('#title').html(product.post_title)
        $('#product_name').val(product.post_title)
        //$('#content').html(product.post_content)
        //$('#price').html('$ ' + product.meta_value)
        $('#product_price').val(product.meta_value)
        // $('#id_coinbase').val(id)
        // $('#code_coinbase').val(code)
        $('#myModalB').modal('show')
    }

    function validarCupon() {
        let cupon = $('#cupon').val();
        let url = '{{route('tienda-verificar-cupon')}}'
        let token = '{{ csrf_token() }}'
        $.post(url, {
            '_token': token,
            'cupon': cupon
        }).done(function (response) {
            let data = JSON.parse(response)
            if (data.msj != '') {
                alert(data.msj)
            } else {
                $("#tipo1").val(data.tipo)
                $("#producto" + 1).val(data.paquete)
                $("#total" + 1).val(data.precio)
                $("#myModalLabel1").text('Cupon del Producto ' + data.paquete)
                $("#idproducto" + 1).val(data.idpaquete)
                $("#restante" + 1).val(0)
                $("#btn" + 1).text('Recibir Cupon')
                $("#cupon" + 1).val(data.cupon)
                $("#myModal" + 1).modal('show')
            }
        })
    }
</script>

@endsection