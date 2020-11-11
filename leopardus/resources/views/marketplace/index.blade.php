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

@include('dashboard.componentView.optionDatatable')

<div class="card body-color">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Imagen
                            </th>
                            <th class="text-center">
                                Nombre
                            </th>
                            <th class="text-center">
                                Descripcion
                            </th>
                            <th class="text-center">
                                Precio
                            </th>
                        </tr>
                    </thead> 
                    <tbody>
                        @foreach ($productos as $product)
                        <tr>
                            <td class="text-center">
                                <img src="{{$product->imagen}}" height="50">
                            </td>
                            <td class="text-center">
                                {{$product->post_title}}
                            </td>
                            <td class="text-center">
                                {{$product->post_content}}
                            </td>
                            <td class="text-center">
                                $ {{$product->meta_value}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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