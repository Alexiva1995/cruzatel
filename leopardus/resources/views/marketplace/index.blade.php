@extends('layouts.dashboard')
@push('page_css')
<style>
    .button-paypal {
        background-color: #009FDB;
        text-align: center;
        color: white;
    }
    .button-paypal:hover {
        color: #009FDB;
        background-color: white;
        border: solid #009FDB 1px;
    }
    .btn-raduis {
        padding: 5px 20px;
        border-radius: 10px;
    }

    .content-right {
    float: right;
    margin-left: -260px;
}
</style>
@endpush
@push('page_js')
<script src="https://kit.fontawesome.com/13c3feec08.js" crossorigin="anonymous"></script>
@endpush
@section('content')

<div class="row menu-color text-white">  
    
    <div class="col-lg-3 col-sm-6 col-12 mt-2 menu-color text-white">    Filtros
        <div class="card h-100 mt-1 mb-1 d-flex flex-column bg-blue-dark  text-white">

        <div class="card-body">
                                <div class="multi-range-price">
                                    <div class="multi-range-title pb-75">
                                        <h6 class="filter-title mb-0 text-white">Multi Range</h6>
                                    </div>
                                    <ul class="list-unstyled price-range" id="price-range">
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" checked="" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">All</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> &lt;=$10</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">$10 - $100</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">$100 - $500</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="price-range" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">&gt;= $500</span>
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                                <!-- /Price Filter -->
                                <hr>
                                <!-- /Price Slider -->
                                <div class="price-slider">
                                    <div class="price-slider-title mt-1">
                                        <h6 class="filter-title mb-0 text-white">Slider</h6>
                                    </div>
                                    <div class="price-slider">
                                        <div class="price_slider_amount mb-2">
                                        </div>
                                        <div class="form-group">
                                            <div class="slider-sm my-1 range-slider noUi-target noUi-ltr noUi-horizontal" id="price-slider"><div class="noUi-base"><div class="noUi-connects"><div class="noUi-connect" style="transform: translate(0%, 0px) scale(1, 1);"></div></div><div class="noUi-origin" style="transform: translate(-1000%, 0px); z-index: 5;"><div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="51.0" aria-valuemax="5000.0" aria-valuenow="51.0" aria-valuetext="51"><div class="noUi-touch-area"></div><div class="noUi-tooltip">51</div></div></div><div class="noUi-origin" style="transform: translate(0%, 0px); z-index: 4;"><div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="51.0" aria-valuemax="5000.0" aria-valuenow="5000.0" aria-valuetext="5000"><div class="noUi-touch-area"></div><div class="noUi-tooltip">5000</div></div></div></div></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Price Range -->
                                <hr>
                                <!-- Categories Starts -->
                                <div id="product-categories">
                                    <div class="product-category-title">
                                        <h6 class="filter-title mb-1 text-white">Categories</h6>
                                    </div>
                                    <ul class="list-unstyled categories-list">
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false" checked="">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Appliances</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> Audio</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Cameras &amp; Camcorders</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50 text-white">Car Electronics &amp; GPS</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50 text-white">Cell Phones</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Computers &amp; Tablets</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50"> Health, Fitness &amp; Beauty</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Office &amp; School Supplies</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">TV &amp; Home Theater</span>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="vs-radio-con vs-radio-primary py-25">
                                                <input type="radio" name="category-filter" value="false">
                                                <span class="vs-radio">
                                                    <span class="vs-radio--border"></span>
                                                    <span class="vs-radio--circle"></span>
                                                </span>
                                                <span class="ml-50">Video Games
                                                </span>
                                            </span>
                                        </li>

                                    </ul>
                                </div>
                                <!-- Categories Ends -->
                                <hr>
                                <!-- Brands -->
                                <div class="brands">
                                    <div class="brand-title mt-1 pb-1">
                                        <h6 class="filter-title mb-0 text-white">Brands</h6>
                                    </div>
                                    <div class="brand-list" id="brands">
                                        <ul class="list-unstyled">
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Insignia™</span>
                                                </span>
                                                <span>746</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">
                                                        Samsung
                                                    </span>
                                                </span>
                                                <span>633</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">
                                                        Metra
                                                    </span>
                                                </span>
                                                <span>591</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">HP</span>
                                                </span>
                                                <span>530</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Apple</span>
                                                </span>
                                                <span>442</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">GE</span>
                                                </span>
                                                <span>394</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Sony</span>
                                                </span>
                                                <span>350</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Incipio</span>
                                                </span>
                                                <span>320</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">KitchenAid</span>
                                                </span>
                                                <span>318</span>
                                            </li>
                                            <li class="d-flex justify-content-between align-items-center py-25">
                                                <span class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" value="false">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">Whirlpool</span>
                                                </span>
                                                <span>298</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Brand -->
                                <hr>
                                <!-- Rating section starts -->
                                <div id="ratings">
                                    <div class="ratings-title mt-1 pb-75">
                                        <h6 class="filter-title mb-0">Ratings</h6>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <ul class="unstyled-list list-inline ratings-list mb-0">
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li>&amp; up</li>
                                        </ul>
                                        <div class="stars-received">(160)</div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <ul class="unstyled-list list-inline ratings-list mb-0">
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li>&amp; up</li>
                                        </ul>
                                        <div class="stars-received">(176)</div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <ul class="unstyled-list list-inline ratings-list mb-0">
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li>&amp; up</li>
                                        </ul>
                                        <div class="stars-received">(291)</div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <ul class="unstyled-list list-inline ratings-list mb-0 ">
                                            <li class="ratings-list-item"><i class="feather icon-star text-warning"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li class="ratings-list-item"><i class="feather icon-star text-light"></i></li>
                                            <li>&amp; up</li>
                                        </ul>
                                        <div class="stars-received">(190)</div>
                                    </div>
                                </div>
                                <!-- Rating section Ends -->
                                <hr>
                                <!-- Clear Filters Starts -->
                                <div id="clear-filters">
                                    <button class="btn btn-block btn-primary waves-effect waves-light">CLEAR ALL FILTERS</button>
                                </div>
                                <!-- Clear Filters Ends -->

                            </div>
       
        </div>   
    </div>
    
    
    <div class="col-lg-8 col-md-4 col-12 mt-4 menu-color text-white  ">Resultados coincicen con la búsqueda
        <div class="card  h-100 mt-1 mb-1 menu-color text-white"> <!--Menu color--> 
            <input type="search" class="form-control  text-white" aria-controls="mytable" placeholder="Buscar"  >
            
            <section id="ecommerce-products">
            <div class="card-header d-flex bg-blue-dark-2 ">

            <!--BEGING: Prueba tarjeta -->
            @foreach ($productos as $product)
            <div class="card bg-blue-dark" style="width: 20rem;">
                <!--Imgen del producto-->
              <img class="card-img-top" src="{{$product->imagen}}"  alt="Card image cap" width="220" height="220">
                <!--Precio del producto-->
                <h6 class="item-price text-white text-right" >
                    <strong>  $ {{$product->meta_value}}</strong> 
                </h6>     
                    <!--Titulo del producto-->
              <div class="card-title text-center"> <strong>  {{$product->post_title}} </strong>  </h5></div>
                    <!--Descripción del producto-->
                <div class= " card-body " style="float:left; text-align: justify;">
                    <p>
                        {{$product->post_content}}
                    </p>
                </div>
                
                <a href="#" class="btn btn-primary">AÑADIR AL CARRITO</a>
            </div>
               @endforeach
            <!--END: Prueba tarjeta -->


            <!--BEGING: Productos de la tienda-->
            
           
            <!--END: Productos de la tienda-->

                   
            </div>
            </section>
        </div>
    </div>
</div>

    

{{-- alertas --}}
@include('dashboard.componentView.alert')
@include('dashboard.componentView.optionDatatable')

{{-- modales --}}
@include('tienda.modalCompra')
@include('tienda.modalBancos')
{{-- @include('tienda.modalCupon') --}}
<script>
    function detalles(product) {
        $('.ecommerce-card').removeClass('bg-blue-dark')
        $('#producto' + product.ID).addClass('bg-blue-dark')
        $('#product_id').val(product.ID)
        $('#product_name').val(product.post_title)
        $('#product_price').val(product.meta_value)
        // $('#myModalB').modal('show')
    }
    function compleform(valor) {
        if (valor == 'paypal') {
            $('.hiddenbtc').css('display', 'none')
            $('.hiddenbtc .requier').removeAttr('required')
            $('.hiddensp').css('display', 'none')
            $('.hiddensp .requier').removeAttr('required')
        } else if (valor == 'btc') {
            $('.hiddensp').css('display', 'none')
            $('.hiddensp .requier').removeAttr('required')
            $('.hiddenbtc').css('display', 'initial')
            $('.hiddenbtc .requier').prop('required', true)
        } else {
            $('.hiddensp').css('display', 'initial')
            $('.hiddensp .requier').prop('required', true)
            $('.hiddenbtc').css('display', 'none')
            $('.hiddenbtc .requier').removeAttr('required')
        }
    }
</script>
@endsection