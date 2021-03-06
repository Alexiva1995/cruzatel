@extends('layouts.dashboard')

@section('content')
<style>
	.nombre {
		margin: -22px 5px 0px;
		background: #1199c4;
		color: #ffffff;
		padding: 3px 3px;
	}

	li {
		position: relative;
	}

	li img:hover+.inforuser {
		transform: translateY(-100px);
	}

	input.form-control {
		background-color: #e2e2e2 !important;
	}


	.col-sm-10.col-sm-offset-1.panel.panel-default.taq.dobi {
		margin-top: 20px;
		padding-top: 20px;
	}

	.inforuser {
		width: 300px;
		position: absolute;
		/* top: 0; */
		/* left: 0; */
		/* margin: 0; */
		z-index: 9996;
		border: 0px !important;
		/* box-shadow: 1px 1px 10px 1px; */
		transition: 0.8s all;
		transform: translateY(-1000px);
	}

	.tree {
		margin-left: 0%;
		width: 100%;
		display: flex;
		justify-content: center;
	}

	.green {
		background: #00702e !important;
		color: #ffffff;
		border-radius: 10px;
	}

	.padre ul {
		padding-top: 20px;
		position: relative;
		display: flex;
		/* overflow: auto; */
		transition: all 0.5s;
		-webkit-transition: all 0.5s;
		-moz-transition: all 0.5s;
	}

	.padre ul ul {
		padding-left: 0;
	}

	.padre li {
		float: left;
		text-align: center;
		list-style-type: none;
		position: relative;
		padding: 20px 5px 0 5px;
		transition: all 0.5s;
		-webkit-transition: all 0.5s;
		-moz-transition: all 0.5s;
	}

	/*We will use ::before and ::after to draw the connectors*/

	.padre li::before,
	.padre li::after {
		content: '';
		position: absolute;
		top: 0;
		right: 50%;
		border-top: 1px solid #ccc;
		width: 50%;
		height: 20px;
	}

	.padre li::after {
		right: auto;
		left: 50%;
		border-left: 1px solid #ccc;
	}

	/*We need to remove left-right connectors from elements without 
any siblings*/
	.padre li:only-child::after,
	.padre li:only-child::before {
		display: none;
	}

	/*Remove space from the top of single children*/
	.padre li:only-child {
		padding-top: 0;
	}

	/*Remove left connector from first child and 
right connector from last child*/
	.padre li:first-child::before,
	.padre li:last-child::after {
		border: 0 none;
	}

	/*Adding back the vertical connector to the last nodes*/
	.padre li:last-child::before {
		border-right: 1px solid #ccc;
		border-radius: 0 5px 0 0;
		-webkit-border-radius: 0 5px 0 0;
		-moz-border-radius: 0 5px 0 0;
	}

	.padre li:first-child::after {
		border-radius: 5px 0 0 0;
		-webkit-border-radius: 5px 0 0 0;
		-moz-border-radius: 5px 0 0 0;
	}

	/*Time to add downward connectors from parents*/
	.padre ul ul::before {
		content: '';
		position: absolute;
		top: 0;
		left: 50%;
		border-left: 1px solid #ccc;
		width: 0;
		height: 20px;
	}

	.padre li a {
		border: 1px solid #ccc;
		padding: 8px 5px;
		text-decoration: none;
		color: #666;
		font-family: arial, verdana, tahoma;
		font-size: 11px;
		display: inline-block;
		height: 60px;
		width: 60px;
		border-radius: 5px;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;

		transition: all 0.5s;
		-webkit-transition: all 0.5s;
		-moz-transition: all 0.5s;
	}

	/*Time for some hover effects*/
	/*We will apply the hover effect the the lineage of the element also*/
	.padre li a:hover,
	.padre li a:hover+ul li a {
		background: #c8e4f8;
		color: #000;
		border: 1px solid #94a0b4;
	}

	/*Connector styles on hover*/
	.padre li a:hover+ul li::after,
	.padre li a:hover+ul li::before,
	.padre li a:hover+ul::before,
	.padre li a:hover+ul ul::before {
		border-color: #94a0b4;
	}

	.padre img {
		height: 64px;
		border-radius: 50%;
		border: 1px solid #cccccc;
	}
</style>

{{-- formulario de fecha  --}}
{{-- @include('dashboard.componentView.formSearchSimple', ['route' => 'moretree', 'name1' => 'id', 'type' => 'number',
'text' => 'ID del Usuario']) --}}

@if (Session::has('msj2'))
<div class="col-md-12">
	<div class="alert alert-warning">
		<button class="close" data-close="alert"></button>
		<span>
			{{Session::get('msj2')}}
		</span>
	</div>
</div>
<hr>

@endif

<div class="col-12 text-center">
	<div class="padre tree">
		<ul>
			<li>
				<img title="{{ ucwords($base->display_name) }}" src="{{ $base->avatar }}" style="width:64px">
				{{-- Nivel 1 --}}
				<ul>
					@foreach ($trees as $child)
					{{-- lado Derecho --}}
					@include('referraltree::sideempty', ['side' => 'D', 'cant' => count($base->children)])
					<li>
						@include('referraltree::infouser', ['data' => $child])
						@if (!empty($child->children))
						{{-- nivel 2 --}}
						<ul>
							@foreach ($child->children as $child2)
							{{-- lado Derecho --}}
							@include('referraltree::sideempty', ['side' => 'D', 'cant' => count($child->children)])
							<li>
								
								@include('referraltree::infouser', ['data' => $child2])
								@if (!empty($child2->children))
								{{-- nivel 3 --}}
								<ul>
									@foreach ($child2->children as $child3)
									{{-- lado Derecho --}}
									@include('referraltree::sideempty', ['side' => 'D', 'cant' => count($child2->children)])
									<li>
										@include('referraltree::infouser', ['data' => $child3])
										@if (!empty($child3->children))
										{{-- nivel 4 --}}
										<ul>
											@foreach ($child3->children as $child4)
											{{-- lado Derecho --}}
											@include('referraltree::sideempty', ['side' => 'D', 'cant' => count($child3->children)])
											<li>
												@include('referraltree::infouser', ['data' => $child4])

												@if (!empty($child4->children))
												{{-- nivel 5 --}}
												<ul>
													@foreach ($child4->children as $child5)
													{{-- lado Derecho --}}
													@include('referraltree::sideempty', ['side' => 'D', 'cant' => count($child4->children)])
													<li>
														@include('referraltree::infouser', ['data' => $child5])
													</li>
													{{-- lado Izquierdo --}}
													@include('referraltree::sideempty', ['side' => 'I', 'cant' => count($child4->children)])
													@endforeach
												</ul>
												{{-- fin nivel 5 --}}
												@endif
											</li>
											{{-- lado Izquierdo --}}
											@include('referraltree::sideempty', ['side' => 'I', 'cant' => count($child3->children)])
											@endforeach
										</ul>
										{{-- fin nivel 4 --}}
										@endif
									</li>
									{{-- lado Izquierdo --}}
									@include('referraltree::sideempty', ['side' => 'I', 'cant' => count($child2->children)])
									@endforeach
								</ul>
								{{-- fin nivel 3 --}}
								@endif
							</li>
							{{-- lado Izquierdo --}}
							@include('referraltree::sideempty', ['side' => 'I', 'cant' => count($child->children)])
							@endforeach
						</ul>
						{{-- fin nivel 2 --}}
						@endif
					</li>
					{{-- lado Izquierdo --}}
					@include('referraltree::sideempty', ['side' => 'I', 'cant' => count($base->children)])
					@endforeach
				</ul>
				{{-- fin nivel 1 --}}
			</li>
		</ul>
	</div>
	@if (Auth::id() != $base->ID)
	<div class="col-12 text-center">
		<a class="btn btn-info" href="{{route('referraltree', strtolower($type))}}">Regresar a mi arbol</a>
	</div>
	@endif
</div>

<script>
	function nuevoreferido(id, type) {
		let ruta = "{{url('mioficina/referraltree')}}/" + type + '/' + id
		window.location.href = ruta
	}
</script>
@endsection