@if ($ofertas->count() > 6)
<div class="container">
  <div class="row">

    <div class="col-lg-12 text-right" style="z-index: 30 !important;">
      <h1 class="display-3 text-capitalize mb-5">¡tenemos ofertas disponibles!</h1>
    </div>
  
    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide" data-interval="false" data-ride="carousel" style="z-index: 30 !important;">
  
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            @if ($ofertas->count() >= 12)
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            @endif
        </ol>
          
        <div class="carousel-inner">
            
          <div class="carousel-item active">
              
            <div class="container">
              <div class="row">
  
                  @for ($i = 0; $i < 4; $i++)
                    <div class="col-lg-3 col-md-6">
                      <div class="card card-product" style="width: 100%;">
                        <div class="card-image">
                          <span class="badge badge-warning mb-2">OFERTA</span>
                        <a href="{{ route('Producto', $ofertas[$i]->id) }}">
                          <img src="{{ $ofertas[$i]->link_img }}" alt="{{ $ofertas[$i]->link_img }}" />
                          </a>
                        </div>
                        <div class="card-body">
                          <a class="card-title" href="{{ route('Producto', $ofertas[$i]->id) }}">
                            {{ $ofertas[$i]->nombre }}
                          </a>
                          <div class="card-footer">
                            <div class="price-container">
                              <span class="price-old opacity-8 text-danger">$ {{ round($ofertas[$i]->precio * $multiplicador->multiplicador, -1) }}</span>
                              
                              @php
                                  //calculo el numero que voy a restar
                                  $restar = ($ofertas[$i]->oferta / 100) * ($ofertas[$i]->precio * $multiplicador->multiplicador);
  
                                  //calculo el numero que voy a mostrar
                                  $mostrar = ($ofertas[$i]->precio * $multiplicador->multiplicador) - $restar;
                              @endphp
                               @if (round($mostrar, -1) == round($ofertas[$i]->precio * $multiplicador->multiplicador, -1))
                               <span class="price-new text-success ml-3">$ {{ floor($mostrar) }}</span>
                               @else  
                               <span class="price-new text-success ml-3">$ {{ round($mostrar, -1) }}</span>
                               @endif
                            </div>
                            <a href="{{ route('Añadir Al Carrito', $ofertas[$i]->id) }}" class="btn btn-sm btn-primary btn-tooltip add">Agregar Al Carrito</a>
                          </div>
                        </div>
                      </div> 
                    </div>
                  @endfor
  
              </div>
            </div>
            
          </div>
  
          <div class="carousel-item">
              
              <div class="container">
                <div class="row">
  
                  @for ($i = 4; $i < 8; $i++)
                    <div class="col-lg-3 col-md-6">
                      <div class="card card-product" style="width: 100%;">
                        <div class="card-image">
                          <span class="badge badge-warning mb-2">OFERTA</span>
                        <a href="{{ route('Producto', $ofertas[$i]->id) }}">
                          <img src="{{ $ofertas[$i]->link_img }}" alt="{{ $ofertas[$i]->link_img }}" />
                          </a>
                        </div>
                        <div class="card-body">
                          <a class="card-title" href="{{ route('Producto', $ofertas[$i]->id) }}">
                            {{ $ofertas[$i]->nombre }}
                          </a>
                          <div class="card-footer">
                            <div class="price-container">
                              <span class="price-old opacity-8 text-danger">$ {{ round($ofertas[$i]->precio * $multiplicador->multiplicador, -1) }}</span>
                              
                              @php
                                  //calculo el numero que voy a restar
                                  $restar = ($ofertas[$i]->oferta / 100) * ($ofertas[$i]->precio * $multiplicador->multiplicador);
  
                                  //calculo el numero que voy a mostrar
                                  $mostrar = ($ofertas[$i]->precio * $multiplicador->multiplicador) - $restar;
                              @endphp
                              @if (round($mostrar, -1) == round($ofertas[$i]->precio * $multiplicador->multiplicador, -1))
                              <span class="price-new text-success ml-3">$ {{ floor($mostrar) }}</span>
                              @else  
                              <span class="price-new text-success ml-3">$ {{ round($mostrar, -1) }}</span>
                              @endif
                            </div>
                            <a href="{{ route('Añadir Al Carrito', $ofertas[$i]->id) }}" class="btn btn-sm btn-primary btn-tooltip add">Agregar Al Carrito</a>
                          </div>
                        </div>
                      </div> 
                    </div>
                  @endfor
  
                </div>
              </div>
  
          </div>
  
          @if ($ofertas->count() >= 12)
            <div class="carousel-item">
              <div class="container">
                <div class="row">
  
                    @for ($i = 8; $i < $ofertas->count(); $i++)
                      <div class="col-lg-3 col-md-6">
                        <div class="card card-product" style="width: 100%;">
                          <div class="card-image">
                            <span class="badge badge-warning mb-2">OFERTA</span>
                          <a href="{{ route('Producto', $ofertas[$i]->id) }}">
                            <img src="{{ $ofertas[$i]->link_img }}" alt="{{ $ofertas[$i]->link_img }}" />
                            </a>
                          </div>
                          <div class="card-body">
                            <a class="card-title" href="{{ route('Producto', $ofertas[$i]->id) }}">
                              {{ $ofertas[$i]->nombre }}
                            </a>
                            <div class="card-footer">
                              <div class="price-container">
                                <span class="price-old opacity-8 text-danger">$ {{ round($ofertas[$i]->precio * $multiplicador->multiplicador ,-1) }}</span>
                              
                              @php
                                  //calculo el numero que voy a restar
                                  $restar = ($ofertas[$i]->oferta / 100) * ($ofertas[$i]->precio * $multiplicador->multiplicador);
  
                                  //calculo el numero que voy a mostrar
                                  $mostrar = ($ofertas[$i]->precio * $multiplicador->multiplicador) - $restar;
                              @endphp
                               @if (round($mostrar, -1) == round($ofertas[$i]->precio * $multiplicador->multiplicador, -1))
                               <span class="price-new text-success ml-3">$ {{ floor($mostrar) }}</span>
                               @else  
                               <span class="price-new text-success ml-3">$ {{ round($mostrar, -1) }}</span>
                               @endif
                              </div>
                              <a href="{{ route('Añadir Al Carrito', $ofertas[$i]->id) }}" class="btn btn-sm btn-primary btn-tooltip add">Agregar Al Carrito</a>
                            </div>
                          </div>
                        </div> 
                      </div>
                    @endfor
  
                </div>
              </div>
            </div>
          @endif
  
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="left: -4vw !important; opacity: 1 !important;">
            <i class="fas fa-chevron-left text-warning fa-3x"></i>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="right: -4vw !important; opacity: 1 !important;">
            <i class="fas fa-chevron-right text-warning fa-3x"></i>
          </a>
        </div>
      </div>
    </div>
  
    <div class="col-lg-12 text-right text-default mb-5" style="z-index: 2 !important;">
      <a href="/ofertas" class="btn btn-outline-primary">
        Ver Todas
        <i class="fas fa-chevron-right"></i>
      </a>
    </div>
  </div>
</div>
@endif