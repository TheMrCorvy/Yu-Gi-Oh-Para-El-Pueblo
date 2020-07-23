@foreach ($recomendaciones as $item)
  <div class="col-lg-3 col-md-6">
    <div class="card card-product">
      <div class="card-image">
        @if ($item->oferta > 0 && $item->fecha_oferta >= date('Y-m-d'))
        <span class="badge badge-warning mb-2">OFERTA</span>
        @endif
        <a href="{{ route('Producto', $item->id) }}">
          <img class="img rounded" src="{{ $item->link_img }}" />
        </a>
      </div>
      <div class="card-body">
          <a href="{{ route('Producto', $item->id) }}" class="card-link card-title">{{ $item->nombre }}</a>
        <div class="card-footer">
          @if ($item->oferta > 0 && $item->fecha_oferta >= date('Y-m-d'))
          
            <div class="price-container">
              <span class="price-old text-danger">$ {{ round($item->precio * $multiplicador->multiplicador, -1) }}</span>
            </div>
            
            {{
              $precioMultiplicado = $item->precio * $multiplicador->multiplicador,
              $restar = ($item->oferta / 100) * ($precioMultiplicado),
              $mostrar = $precioMultiplicado - $restar
            }}
            
            @if (round($mostrar, -1) == round($precioMultiplicado, -1))
            <div class="price-container">
              <span class="price-new text-success">$ {{ floor($mostrar) }}</span>
            </div>
            @else
            <div class="price-container">
              <span class="price-new text-success">$ {{ round($mostrar, -1) }}</span>
            </div>
            @endif
            

          @else
            <div class="price-container">
              <span class="price text-success">$ {{ round(($item->precio * $multiplicador->multiplicador), -1) }}</span>
            </div>
          @endif
          <a href="{{ route('Añadir Al Carrito', $item->id) }}" id="{{ $item->id }}" class="btn btn-simple btn-warning btn-icon-only btn-sm btn-round pull-right addAjax">
              <i class="ni ni-cart" id="{{ $item->id }}"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
@endforeach