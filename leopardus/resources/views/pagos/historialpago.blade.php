@extends('layouts.dashboard')

@section('content')
{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')

{{-- formulario de fecha  --}}
@include('dashboard.componentView.formSearch', [
	'route' => 'price-filtro',
	'name1' => 'desde',
	'name2' => 'hasta',
	'text1' => 'Fecha Desde',
	'text2' => 'Fecha Hasta',
	'type' => 'date',
	'volver' => false,
	'ruta'
	'form' => 'historialpago'
])

@if (Session::has('msj'))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
			aria-hidden="true">&times;</span></button>
	<strong>{{Session::get('msj')}}</strong>
</div>
@endif
@if (Session::has('msj2'))
<div class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
			aria-hidden="true">&times;</span></button>
	<strong>{{Session::get('msj2')}}</strong>
</div>
@endif

{{-- fecha --}}
@if (!empty($fechas['desde']) && !empty($fechas['desde']))
<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="row">
				<div class="form-group col-12 col-md-6">
					<label>Fecha Desde</label>
					<h5>{{ date('d-m-Y', strtotime($fechas['desde'])) }}</h5>
				</div>
				<div class="form-group col-12 col-md-6">
					<label>Fecha Hasta</label>
					<h5>{{date('d-m-Y', strtotime($fechas['hasta']))}}</h5>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr class="text-center">
							<th>
								#
							</th>
							<th>
								Usuario
							</th>
							<th>
								Correo
							</th>
							<th>
								Monto
							</th>
							<th>
								Descuento
							</th>
							<th>
								Total
							</th>
							<th>
								Fecha
							</th>
							<th>
								Estado
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pagos as $pago)
						<tr class="text-center">
							<td>
								{{$pago->id}}
							</td>
							<td>
								{{$pago->username}}
							</td>
							<td>
								{{$pago->email}}
							</td>
							<td>
								
									@if ($moneda->mostrar_a_d)
									{{$moneda->simbolo}} {{$pago->monto}}
									@else
									{{$pago->monto}} {{$moneda->simbolo}}
									@endif
								
							</td>
							<td>
								
									@if ($moneda->mostrar_a_d)
									{{$moneda->simbolo}} {{$pago->descuento}}
									@else
									{{$pago->descuento}} {{$moneda->simbolo}}
									@endif
								
							</td>
							<td>
								
									@if ($moneda->mostrar_a_d)
									{{$moneda->simbolo}} {{($pago->monto + $pago->descuento)}}
									@else
									{{($pago->monto + $pago->descuento)}} {{$moneda->simbolo}}
									@endif
								
							</td>
							<td>
								{{$pago->fechapago}}
							</td>
							<td>
								
									@if ($pago->estado == 1)
									Aprobado
									@elseif ($pago->estado == 2)
									Rechazado
									@endif
								
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