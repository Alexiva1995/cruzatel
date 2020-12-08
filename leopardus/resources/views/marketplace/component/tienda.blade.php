<div class="menu-color text-white  ">
    
    <div class="card  h-100 mt-1 mb-1 menu-color text-white">
        <!--Menu color-->
        <?php $resultados = count($productos) ; echo "$resultados ";?>
    Resultados coincicen con la búsqueda
        <input type="search" class="form-control  text-white" aria-controls="mytable" placeholder="Buscar">

        <section id="ecommerce-products">
            <div class="card-header d-flex bg-blue-dark-2 ">

                <!--BEGING: Prueba tarjeta -->
                @foreach ($productos as $product)
                <div class="card bg-blue-dark" style="width: 20rem;">
                    <!--Imgen del producto-->
                    <img class="card-img-top" src="{{$product->imagen}}" alt="Card image cap" width="250" height="250">
                    <!--Precio del producto-->
                    <h6 class="item-price text-white text-right">
                        <strong> $ {{$product->meta_value}}</strong>
                    </h6>
                    <!--Titulo del producto-->
                    <div class="card-title text-center"> <strong> {{$product->post_title}} </strong> </h5>
                    </div>
                    <!--Descripción del producto-->
                    <div class="card-body" style="float:left; text-align: justify;">
                        <p>
                            {{$product->post_content}}
                        </p>
                    </div>

                    <form action="{{route('tienda-save-compra')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="idproducto" id="product_id" value="{{$product->ID}}">
                        <input type="hidden" class="title2" name="name" id="product_name" value="{{$product->post_title}}">
                        <input type="hidden" class="price2" name="precio" id="product_price" value="{{$product->meta_value}}">
                        <input type="hidden" name="tipo" value="paypal">
                        <button type="submit" class="btn btn-primary btn-block">Comprar</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>