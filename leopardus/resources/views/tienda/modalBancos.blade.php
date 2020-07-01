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
                                        Banco {{$bank->nombre}}
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>