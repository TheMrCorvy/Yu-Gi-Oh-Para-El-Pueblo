@foreach ($singles as $single)
  <div class="col-lg-3 col-md-6">
    <div class="card card-product ">
      <div class="card-image">
      <a href="{{ route('Producto', $single->id) }}">
          <img src="{{ $single->link_img }}" alt="{{ $single->link_img }}" />
        </a>
      </div>
      <div class="card-body">
        <a class="card-title" href="{{ route('Producto', $single->id) }}">
          {{ $single->nombre }}
        </a>
        <div class="card-footer">
          <div class="price-container">

            @if ($single->oferta > 0 && $single->fecha_oferta >= date('Y-m-d'))
              @php
                //calculo el numero que voy a restar
                $restar = ($single->oferta / 100) * ($single->precio * $multiplicador->multiplicador);

                //calculo el numero que voy a mostrar
                $mostrar = ($single->precio * $multiplicador->multiplicador) - $restar;
              @endphp
              <span class="price-old text-danger opacity-8"> $ {{ round($single->precio * $multiplicador->multiplicador, -1) }}</span>
              <span class="price-new text-success opacity-8"> $ {{ floor($mostrar) }}</span>
            @else
              <span class="price opacity-8"> $ {{ round($single->precio * $multiplicador->multiplicador, -1) }}</span>
            @endif
          </div>
          <a href="{{ route('Añadir Al Carrito', $single->id) }}" class="btn btn-sm btn-primary btn-tooltip addAjax" data-toggle="tooltip" data-placement="top" title="Agregar Al Carrir
          to" data-container="body" data-animation="true">Agregar Al Carrito</a>
        </div>
      </div>
    </div> <!-- end card -->
  </div>
@endforeach

<div class="col-md-3 ml-auto mr-auto mt-5 text-center">
  <a href="/cartas" class="btn btn-primary btn-round btn-simple">Ver Todas</a>
</div>