@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')
<br>

{{-- <div class="col-xs-12">
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Nuevo Banco
    </button>
</div> --}}

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')
<div class="card">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Usuario
                            </th>
                            <th class="text-center">
                                Orden Compra
                            </th>
                            <th class="text-center">
                                Producto
                            </th>
                            <th class="text-center">
                                Precio
                            </th>
                            <th class="text-center">
                                Titular
                            </th>
                            <th class="text-center">
                                N° de cuenta
                            </th>
                            <th class="text-center">
                                Bauche
                            </th>
                            <th>
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ordens as $orden)
                        <tr>
                            <td class="text-center">
                                {{$orden->user_name}}
                            </td>
                            <td class="text-center">
                                {{$orden->idorden}}
                            </td>
                            <td class="text-center">
                                {{$orden->producto}}
                            </td>
                            <td class="text-center">
                                {{$orden->precio}}
                            </td>
                            <td class="text-center">
                                {{$orden->titular}}
                            </td>
                            <td class="text-center">
                                {{$orden->n_cuenta}}
                            </td>
                            <td class="text-center">
                                <img src="{{asset('Bauches/'.$orden->bauche)}}" alt="{{'Bauche_'.$orden->producto}}" height="300">
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{route('banks.action', [$orden->id, 'aprobada'])}}"> Aceptar</a>
                                <a class="btn btn-danger" href="{{route('banks.action', [$orden->id, 'cancelada'])}}"> Cancelar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
