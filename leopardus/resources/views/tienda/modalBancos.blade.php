<!-- Modal -->
<div class="modal fade" id="myModalB" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Informacion de los Bancos
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel1"></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach ($banks as $bank)
                        <div class="col-12 col-md-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-header">
                                        <h4 class="card-title">
                                           {{$bank->nombre}}
                                        </h4>
                                    </div>
                                    <div class="card-body">
                                        <h5>Nombre: <strong>{{$bank->nombre}}</strong></h5>
                                        <h5>Titular: <strong>{{$bank->titular}}</strong></h5>
                                        <h5>DNI: <strong>{{$bank->dni}}</strong></h5>
                                        <h5>Correo: <strong>{{$bank->correo}}</strong></h5>
                                        <h5>Tipo de Cuenta: <strong>{{$bank->tipo_cuenta}}</strong></h5>
                                        <h5>Número de Cuenta: <strong>{{$bank->numero_cuenta}}</strong></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- <div class="row">
                    <div class="col-12 col-md-4"></div>
                    <div class="col-12 col-md-4 text-center">
                        Seleccione el soporte del bauche
                        <form action="{{route('tienda-save-compra')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" name="idproducto" id="product_id">
                            <input type="hidden" class="title2" name="name" id="product_name">
                            <input type="hidden" class="price2" name="precio" id="product_price">
                            <input type="hidden" name="tipo" value="transferencia">
                            <input type="file" name="bauche" class="form-control mb-2" required accept="image/jpeg, image/png">
                            <button type="submit" class="btn btn-info">Procesar</button>
                        </form>
                    </div>
                    <div class="col-12 col-md-4"></div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>