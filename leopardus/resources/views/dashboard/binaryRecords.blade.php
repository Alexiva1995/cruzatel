@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', [
	'route' => 'buscarbinaryrecord',
	'name1' => 'fecha1', 'name2' => 'fecha2',
	'text1' => 'Fecha Desde',
	'text2' => 'Fecha Hasta',
	'type' => 'date',
	'volver' => $data['volver'],
	'ruta' => url('mioficina/admin/network/binaryrecord'),
	'form' => ''
])



<div class="card bg-blue-dark text-white">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="text-center">
							<th>ID</th>
							<th>Nombre</th>
							<th>Correo</th>
							<th>Paquete</th>
							<th>Estato</th>
							<th>Auspiciador</th>
							<th>Nivel Binario</th>
							<th>Ingreso</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($data['allReferido'] as $referido)
						@php
						$paquete = null;
							$nombre = 'Sin Paquete';
							if ($referido->status == 1) {
								$paquete = json_decode($referido->paquete);
								if (!empty($paquete)) {
									$nombre = $paquete->nombre;
								} 
							}
						@endphp
						<tr class="text-center">
							<td>{{ $referido->ID }}</td>
							<td>{{ $referido->display_name }}</td>
							<td>{{ $referido->user_email }}</td>
							<td>{{ $nombre }}</td>
							@if ($referido->status == 0)
							<td>Inactive</td>
							@else
							<td>Active</td>
							@endif
							<td>
								{{$referido['patrocinador']}}
							</td>
							<td>
								@if($referido['nivel'] == 1)
								1
								@else
								{{$referido['nivel']}}
								@endif
							</td>
							<td>{{ date('d-m-Y', strtotime($referido->created_at)) }}</td>
						</tr>

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


@endsection