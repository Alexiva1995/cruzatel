@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')
<br>

<div class="col-xs-12">
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Nuevo Banco
    </button>
</div>

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')
<div class="card bg-blue-dark text-white">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr>
                            <th class="text-center">
                                ID Banco
                            </th>
                            <th class="text-center">
                                DNI
                            </th>
                            <th class="text-center">
                                Titular
                            </th>
                            <th class="text-center">
                                Nombre
                            </th>
                            <th class="text-center">
                                Correo
                            </th>
                            <th class="text-center">
                                Tipo de Cuenta
                            </th>
                            <th class="text-center">
                                Número de Cuenta
                            </th>
                            <th>
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banks as $bank)
                        <tr>
                            <td class="text-center">
                                {{$bank->id}}
                            </td>
                            <td class="text-center">
                                {{$bank->dni}}
                            </td>
                            <td class="text-center">
                                {{$bank->titular}}
                            </td>
                            <td class="text-center">
                                {{$bank->nombre}}
                            </td>
                            <td class="text-center">
                                {{$bank->correo}}
                            </td>
                            <td class="text-center">
                                {{$bank->tipo_cuenta}}
                            </td>
                            <td class="text-center">
                                {{$bank->numero_cuenta}}
                            </td>
                            <td>
                                <a class="btn btn-info" onclick="editProduct({{json_encode($bank)}})"> Editar</a>
                                <a class="btn btn-danger" href="{{route('banks.delete', [$bank->id])}}"> Borrar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Agregar -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Nuevo Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('banks.save')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nombre del banco</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Titular de la cuenta</label>
                        <input type="text" name="titular" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">DNI</label>
                        <input type="text" name="dni" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Correo</label>
                        <input type="email" class="form-control" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo de Cuenta</label>
                        <input type="text" class="form-control" name="tipo_cuenta" required>
                    </div>
                    <div class="form-group">
                        <label for="">Numero de cuenta</label>
                        <input type="number" class="form-control" name="numero_cuenta" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{-- modal Editar --}}
<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('banks.update')}}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="idbank" id="idbanco">
                    <div class="form-group">
                        <label for="">Nombre del banco</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Titular de la cuenta</label>
                        <input type="text" name="titular" id="titular" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">DNI</label>
                        <input type="text" name="dni" id="dni" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Correo</label>
                        <input type="email" class="form-control" name="correo" id="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo de Cuenta</label>
                        <input type="text" class="form-control" name="tipo_cuenta" id="tipo_cuenta" required>
                    </div>
                    <div class="form-group">
                        <label for="">Numero de cuenta</label>
                        <input type="number" class="form-control" name="numero_cuenta" id="numero_cuenta" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    function editProduct(dataProduct) {
        $('#idbanco').val(dataProduct.id)
        $('#nombre').val(dataProduct.nombre)
        $('#titular').val(dataProduct.titular)
        $('#dni').val(dataProduct.dni)
        $('#correo').val(dataProduct.correo)
        $('#tipo_cuenta').val(dataProduct.tipo_cuenta)
        $('#numero_cuenta').val(dataProduct.numero_cuenta)
        $('#myModalEdit').modal('show')
    }
</script>