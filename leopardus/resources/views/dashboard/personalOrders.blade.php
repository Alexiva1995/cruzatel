@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', [
	'route' => 'buscarpersonalorder',
	'name1' => 'fecha1',
	'name2' => 'fecha2',
	'text1' => 'Fecha Desde',
	'text2' => 'Fecha Hasta',
	'type' => 'date',
	'volver' => $data['volver'],
	'ruta' => url('mioficina/admin/transactions/personalorders'),
	'form' => ''
])

<div class="card bg-blue-dark text-white">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="text-center">
							<th>Numero de Orden</th>
							<th>Fecha</th>
							<th>Concepto</th>
							<th>Total</th>
							<th>Estado</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data['ordenes'] as $orden)
						<tr class="text-center">
							<td>{{ $orden['idorden'] }}</td>
							<td>{{ date('Y-m-d', strtotime($orden['fecha_orden'])) }}</td>
							<td>
								{{$orden['productos']}}
							</td>
							<td>$ {{ $orden['total'] }}</td>
							<td>{{ $orden['estado'] }}</td>
						</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


@endsection