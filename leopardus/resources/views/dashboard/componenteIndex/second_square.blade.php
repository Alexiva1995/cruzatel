<div class="col-12">
    <section class="mt-1 mb-1">
        <h2 class="text-white mt-2 mb-2">
            <strong>Publicidad diaria</strong>
        </h2>
        <div class="row">
            {{-- grafico semanal --}}
            <div class="col-12">
                <div class="card bg-blue-dark">
                    {{-- <div class="card-header">
                        <h4 class="card-title text-white">Publicidad diaria</h4>
                    </div> --}}
                    <div class="card-content">
                        <div class="card-body">
                            <div id="g_publicidad"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin grafico semanal --}}
            {{-- publicidad --}}
            <div class="col-12">
                <h2 class="text-white mb-2">
                    <strong>Publicidad</strong>
                </h2>
                <div class="row">
                    @foreach ($data['publicidades'] as $item)
                    <div class="col-lg-6 col-sm-12">
                        <div class="card text-center bg-blue-dark">
                            <div class="card-content">
                                <div class="card-body d-flex align-items-start text-left pb-0">
                                    <img src="{{$item->img}}" alt="element 01" width="150" height="150"
                                        class="float-left rounded px-1">
                                    <div>
                                        <h4 class="card-title text-white mt-3">{{$item->titulo}}</h4>
                                        <p class="card-text text-white">{!!$item->descripcion!!}</p>
                                    </div>
                                    {{-- <button class="btn btn-primary">Buy Now</button> --}}
                                </div>
                                <div class="card-footer p-0 text-right card-footer-alt bg-blue-dark">
                                    @foreach ($item['social'] as $social)
                                    @if ($social == 'facebook')
                                    <button type="button" class="btn btn-icon text-white bg-blue-dark-2"
                                        onclick="fbs_click({{json_encode($item)}})">
                                        Compartir <i class="feather icon-facebook"></i>
                                    </button>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{-- fin publicidad --}}
        </div>
    </section>
</div>