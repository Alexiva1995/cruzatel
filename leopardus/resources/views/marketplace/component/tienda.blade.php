<div class="col-12 mt-4 text-white  ">
    {{-- //$resultados = count($productos) ; echo "$resultados ";
    Resultados coincicen con la búsqueda --}}
    <div class="card  h-100 mt-1 mb-1 menu-color text-white">
        <!--Menu color-->

        <section id="ecommerce-products">
            {{-- <div class="card-header d-flex bg-blue-dark-2 ">
                <input type="search" class="form-control  text-white" aria-controls="mytable" placeholder="Buscar">
            </div> --}}
            <div class="card-body">
                <div class="card-content">
                    <div class="row justify-content-center">
                        @foreach ($productos as $product)
                        <div class="col-12 col-md-6 col-lg-4 mt-2 d-flex justify-content-center">
                            <!--BEGING: Prueba tarjeta -->
                            <div class="card bg-blue-dark h-100" style="width: 20rem;">
                                <!--Imgen del producto-->
                                <img class="card-img-top" src="{{$product->imagen}}" alt="Card image cap">
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

                                @auth
                                <form action="{{route('tienda-save-compra')}}" method="post">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="idproducto" id="product_id" value="{{$product->ID}}">
                                    <input type="hidden" class="title2" name="name" id="product_name"
                                        value="{{$product->post_title}}">
                                    <input type="hidden" class="price2" name="precio" id="product_price"
                                        value="{{$product->meta_value}}">
                                    <input type="hidden" name="tipo" value="paypal">
                                    <button type="submit" class="btn btn-primary btn-block">Comprar</button>
                                </form>
                                @else
                                <a class="btn btn-primary btn-block"
                                    href="{{route('autenticacion.new-register')}}">Comprar</a>
                                @endauth
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>