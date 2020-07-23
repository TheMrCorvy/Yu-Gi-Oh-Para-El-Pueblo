
@foreach ($novedades as $nuevo)
<div class="col-lg-2 col-md-3 d-inline mr-5">
    <div class="card-plain card-product">
        <div class="card-image">
            <a href="{{ route('Producto', $nuevo->id) }}">
                <img src="{{ $nuevo->link_img }}" alt="{{ $nuevo->link_img }}" />
            </a>
        </div>
        <div class="card-body">
            <a class="card-title" href="{{ route('Producto', $nuevo->id) }}">
            {{ \Illuminate\Support\Str::limit($nuevo->nombre, 25, '...') }}
            </a>
            <div class="card-footer">
                <div class="price-container">

                    @if ($nuevo->oferta > 0 && $nuevo->fecha_oferta >= date('Y-m-d'))
                        @php
                            //calculo el numero que voy a restar
                            $restar = ($nuevo->oferta / 100) * ($nuevo->precio * $multiplicador->multiplicador);

                            //calculo el numero que voy a mostrar
                            $mostrar = ($nuevo->precio * $multiplicador->multiplicador) - $restar;
                        @endphp
                        <span class="price-old text-danger opacity-8"> $ {{ round($nuevo->precio * $multiplicador->multiplicador, -1) }}</span>
                        <span class="price-new text-success opacity-8"> $ {{ floor($mostrar) }}</span>
                    @else
                        <span class="price opacity-8"> $ {{ round($nuevo->precio * $multiplicador->multiplicador, -1) }}</span>
                    @endif
                </div>
                <a href="{{ route('Añadir Al Carrito', $nuevo->id) }}" class="btn btn-sm btn-primary btn-tooltip addAjax" data-toggle="tooltip" data-placement="top" title="Agregar Al Carrirto" data-container="body" data-animation="true">Agregar Al Carrito</a>
            </div>
        </div>
    </div> <!-- end card -->
</div>
@endforeach

