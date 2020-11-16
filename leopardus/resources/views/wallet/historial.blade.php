@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', [
	'route' => 'wallet-historial-fechas',
	'name1' => 'primero',
	'name2' => 'segundo',
	'text1' => 'Fecha Desde',
	'text2' => 'Fecha Hasta',
	'type' => 'date',
	'volver' => $data['volver'],
	'form' => 'historial',
	'ruta' => route('wallet-historial')
	]
)


<div class="card bg-blue-dark text-white">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="text-center">
							<th>#</th>
							<th>Usuario</th>
							<th>Descripcion</th>
							<th>Cash</th>
							{{-- <th>Credito</th> --}}
							<th>Fecha</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($data['billetera'] as $bille)
						<tr class="text-center">
							<td>{{ $bille->id }}</td>
							<td>{{ $bille->usuario }}</td>
							<td>{{ $bille->descripcion }}</td>
							{{-- <td>{{ $bille->puntos }}</td> --}}
							<td>
								@if ($moneda->mostrar_a_d)
								{{$moneda->simbolo}} {{ $bille->debito }}
								@else
								{{ $bille->debito }} {{$moneda->simbolo}}
								@endif
							</td>
							{{-- <td>
								@if ($moneda->mostrar_a_d)
								{{$moneda->simbolo}} {{ $bille->credito }}
								@else
								{{ $bille->credito }} {{$moneda->simbolo}}
								@endif
							</td> --}}
							{{-- <td>
								@if ($moneda->mostrar_a_d)
								{{$moneda->simbolo}} {{ $bille->balance }}
								@else
								{{ $bille->balance }} {{$moneda->simbolo}}
								@endif
							</td> --}}
							<td>{{ date('d-m-Y', strtotime($bille->created_at)) }}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection