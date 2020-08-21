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
	'volver' => $data['volver'],
	'form' => 'confirmarpago',
	'ruta' => url('mioficina/admin/transactions/networkorders')
])

{{-- alertas --}}
@include('dashboard.componentView.alert')

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

@php
$total = 0;
@endphp
<div class="card">
	<div class="card-content">
		<div class="card-body">
			<div class="table-responsive">
				<table id="mytable" class="table zero-configuration">
					<thead>
						<tr>
							<th>#</th>
							<th>Usuario</th>
							<th>Correo</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Wallet de Retiro</th>
							<th>Metodo</th>
							<th>Tipo de Metodo</th>
							<th>Estado</th>
							<th>Accion</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data['pagos'] as $pago)
						@php
						$total = ($total + $pago->monto);
						@endphp
						<tr>
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
								{{$pago->fechasoli}}
							</td>
							<td>
									@if ($pago->tipowallet == 0)
									Point
									@elseif($pago->tipowallet == 1)
									Cash
									@else
									Tantech
									@endif
							</td>
							<td>
								{{$pago->metodo}}
							</td>
							<td>
								{{$pago->tipopago}}
							</td>
							<td>
								@if ($pago->estado == 0)
								Pendiente
								@endif
							</td>
							<td>
								<a class="btn btn-info" href="{{route('price-aprobar', [$pago->id])}}"><i
										class="fas fa-check"></i></a>
								<a class="btn btn-danger" href="{{route('price-rechazar', [$pago->id])}}"><i
										class="fas fa-ban"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<td colspan="3"> Total:</td>
						<td colspan="5"> {{$total}}</td>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection