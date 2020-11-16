@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')
<br>

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')
<div class="card bg-blue-dark text-white">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr class="text-center">
                            <th>
                                ID Publicidad
                            </th>
                            <th>
                                Publicidad
                            </th>
                            <th>
                                ID Usuario
                            </th>
                            <th>
                                Usuario
                            </th>
                            <th>
                                Fecha Compartida
                            </th>
                            <th>
                                Red Social Compartida
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historial as $publicidad)
                        <tr class="text-center">
                            <td>{{$publicidad->idpublicidad}}</td>
                            <td>{{(!empty($publicidad->titulo)) ? $publicidad->titulo : 'Publicidad No Disponible'}}</td>
                            <td>{{$publicidad->iduser}}</td>
                            <td>{{(!empty($publicidad->display_name)) ? $publicidad->display_name : 'Usuario No Disponible'}}</td>
                            <td>{{$publicidad->fecha}}</td>
                            <td>{{$publicidad->red_social}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @push('custom_js')
<script src="{{asset('assets/scripts/graficas.js')}}"></script>

<script type="text/javascript">
	function fbs_click(publi) {
		u=publi.img;
		// t=document.title;
   		t=publi.title
		let urlCom = "{{route('publicidad.compartido')}}"
		let url = 'http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t)
   		window.open(url, 'sharer', 'toolbar=0,status=0,width=626,height=436')
		data = {
			id: publi.id,
            social: 'facebook'
            _token: '{{ csrf_token() }}'
        }
		$.post(urlCom, data, function(){
            alert('compartido')
			window.location.reload()
		})
		return false;
	}
</script>
@endpush --}}