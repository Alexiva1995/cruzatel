@extends('layouts.dashboard')

@section('content')
{{-- alertas --}}
@include('dashboard.componentView.alert')
<br>

<div class="col-xs-12">
    <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">
        Agregar Nuevo Producto
    </button>
</div>

{{-- option datatable --}}
@include('dashboard.componentView.optionDatatable')
<div class="card bg-blue-dark text-white">
    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table id="mytable" class="table zero-configuration">
                    <thead>
                        <tr>
                            <th class="text-center">
                                Product ID
                            </th>
                            <th class="text-center">
                                Imagen
                            </th>
                            <th class="text-center">
                                Nombre
                            </th>
                            <th class="text-center">
                                Descripcion
                            </th>
                            <th class="text-center">
                                Limite de Publicación
                            </th>
                            <th class="text-center">
                                Tipo
                            </th>
                            <th class="text-center">
                                Precio
                            </th>
                            <th class="text-center">
                                Visible en la tienda
                            </th>
                            <th>
                                Acción
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td class="text-center">
                                {{$product->ID}}
                            </td>
                            <td class="text-center">
                                <img src="{{$product->imagen}}" height="50">
                            </td>
                            <td class="text-center">
                                {{$product->post_title}}
                            </td>
                            <td class="text-center">
                                {{$product->post_content}}
                            </td>
                            <td class="text-center">
                                {{$product->limite}}
                            </td>
                            <td class="text-center">
                                {{$product->tipo}}
                            </td>
                            <td class="text-center">
                                $ {{$product->meta_value}}
                            </td>
                            <td class="text-center">
                                {{$product->visible}}
                            </td>
                            <td>
                                @if ($product->tipo != 'membresia')
                                <a class="btn btn-info" onclick="editProduct({{json_encode($product)}})"> Editar</a>
                                <a class="btn btn-danger" href="{{route('save.delete', [$product->ID])}}"> Borrar</a>
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

<!-- Modal Agregar -->
<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="card bg-blue-light">
        <div class="modal-content bg-blue-dark text-white">

            {{-- Formulario Agregar --}}
            
            <div class="modal-header blue-header new">
                <h4 class="" id="myModalLabel" > Añadir Nuevo Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            
            <div class="modal-body new">
                <form action="{{route('save.product')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nombre del Producto</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea name="content" id="" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Limite de Publiciacion</label>
                        <input type="number" min="0" max="1000" name="limite" placeholder="5" class="form-control" required>
                        
                    </div>
                    <div class="form-group">
                        <label for="">Precio $$$</label>
                        <input data-prefix="$" type="number" step="0.01" data-decimals="2" class="form-control" name="price" placeholder="100.00" >

                    </div>
                    <div class="form-group">
                        <label for="">Visible en la tienda</label>
                        <select class="form-control" name="visible" id="" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="Visible">Visible</option>
                            <option value="No Visible">No Visible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo (Producto o Membresia)</label>
                        <select class="form-control" name="tipo" id="" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="membresia">Membresia</option>
                            <option value="producto">Producto</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Imagen Producto</label>
                        <input type="file" name="imagen" class="form-control" required accept="image/jpeg, image/png">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>


            {{-- formulario Editar --}}

            <div class="modal-header edit" style="display: none">
                <h4 class="modal-title" id="myModalLabelEdit">Editar Producto</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body edit" style="display: none">
                <form action="{{route('edit.product')}}" method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="idproduct" id="product">
                    <div class="form-group">
                        <label for="">Nombre del Producto</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Descripcion</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Limite de Publiciacion</label>
                        <input type="text" name="limite" class="form-control" id="limite" required>
                    </div>
                    <div class="form-group">
                        <label for="">Precio</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="">Visible en la tienda</label>
                        <select class="form-control" name="visible" id="visible" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="Visible">Visible</option>
                            <option value="No Visible">No Visible</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Tipo (Producto o Membresia)</label>
                        <select class="form-control" name="tipo" id="tipo" required>
                            <option value="" disabled selected>Seleccione una opción</option>
                            <option value="membresia">Membresia</option>
                            <option value="producto">Producto</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Imagen Producto</label>
                        <input type="file" name="imagen" class="form-control" accept="image/jpeg, image/png">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>



@endsection

<script>
    function editProduct(dataProduct) {
        $('#price').val(dataProduct.meta_value)
        $('#content').val(dataProduct.post_content)
        $('#name').val(dataProduct.post_title)
        $('#product').val(dataProduct.ID)
        $('#limite').val(dataProduct.limite)
        $('#nivel_pago').val(dataProduct.nivel_pago)
        $('#porcentaje').val(dataProduct.porcentaje)
        $('#visible').val(dataProduct.visible)
        $('#tipo').val(dataProduct.tipo)
        $('.edit').fadeIn('1000')
        $('.new').fadeOut('1000')
        $('#myModal').modal('show')
    }
</script>