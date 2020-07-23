@extends('layouts.app', ['class' => 'product-page'])

@section('content')

    <div class="wraper">
        <div class="page-header page-header-small skew-separator skew-mini">
            
            <div class="page-header-image bg-gradient-danger"></div>
            
            <div class="container">
              <div class="row">
                <div class="col-lg-9 col-md-7 mr-auto text-left">
                  <h1 class="title text-white" style="margin-top: -30px !important;">{{ $producto->nombre }}</h1>
                </div>
              </div>
            </div>

        </div>
          
          <div class="section section-item" style="z-index: 12 !important;">
            <div class="container">
              <div class="row">
                
                <div class="col-lg-12 text-left mb-3">
                  <a href="#" class="btn btn-sm btn-danger add" id="back">volver</a>
                </div>
              
                <div class="col-lg-6 col-md-12">

                  <div id="getProductImage">
                    <div class="alert alert-success mt-5 d-flex justify-content-between" id="cargando" role="alert">
                      <strong class="pt-1">Cargando...</strong>
                      <div class="spinner-border text-white" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </div>
                  </div>
                  @if ($producto->stock <= 0)
                      <a href="#" class="btn btn-danger mt-3 col-lg-12 disabled">Sin Stock</a>
                  @else
                      <a href="{{ route('Comprar Ahora', $producto->id) }}" class="btn btn-danger mt-3 col-lg-12 add">COMPRAR AHORA</a>
                  @endif
                  

                </div>

                <div class="col-lg-6 col-md-12 mx-auto">
                  <h2 class="title pt-5">{{ $producto->nombre }}</h2>
                  <hr class="line-success mb-3">
                  <br />
                  @if ($producto->stock <= 0)
                    <h2 class="main-price text-muted">
                      Precio por unidad: $ {{ round($producto->precio * $multiplicador->multiplicador, -1) }}
                    </h2>
                    <hr class="line-success mb-3">
                  @else
                      @if ($producto->oferta > 0 && $producto->fecha_oferta >= date('Y-m-d'))
                        
                        <h5>¡Oferta! {{ $producto->oferta }}%</h5>
                        
                        <h2 class="main-price price-old text-danger">
                          <strike>Precio por unidad: $ {{ round($producto->precio * $multiplicador->multiplicador, -1) }}</strike>
                        </h2>

                      @php
                      $restar = $producto->oferta / 100 * $producto->precio * $multiplicador->multiplicador;

                      $mostrar = ($producto->precio * $multiplicador->multiplicador) - $restar;
                      @endphp

                      @if (round($mostrar, -1) == round($producto->precio * $multiplicador->multiplicador, -1))
                          <h2 class="main-price price-new text-success">
                            Precio por unidad: $ {{ floor($mostrar) }}
                          </h2>
                      @else
                          <h2 class="main-price price-new text-success">
                            Precio por unidad: $ {{ round($mostrar, -1) }}
                          </h2>
                      @endif

                      <hr class="line-success mb-3">
                    @else    
                      <h2 class="main-price">
                        Precio por unidad: $ {{ round($producto->precio * $multiplicador->multiplicador, -1) }}
                      </h2>
                      <hr class="line-success mb-3">
                    @endif
                  @endif
                  <h6 class="category">Producto:</h6>
                  <p class="description" id="tipoProducto">{{ $producto->producto }}</p>

                  <h5 class="category">Estado:</h5>
                  @if ($producto->estado == 'Nuevo')
                    <h6 >{{ $producto->estado }}</h6>
                  @else
                    <h6 >{{ $producto->estado }}</h6>
                  @endif

                  <div class="row pick-size mt-3">
                    <div class="col-lg-4 col-md-4">
                        <label>Cantidad Disponible</label>
                        <div class="input-group my-2">
                          <input type="text" id="myNumber" class="form-control input-number" value="{{ $producto->stock }}" disabled />
                        </div>
                      </div>
                  </div>

                  @if ($producto->stock <= 0) 
                    <div class="row justify-content-start mb-3">
                      <a href="{{ route('Añadir Al Carrito', $producto->id) }}" class="btn btn-warning ml-3 disabled">Sin Stock &nbsp;<i class="ni ni-cart"></i></a>
                    </div>
                  @else    
                    <div class="row justify-content-start mb-3">
                      <a href="{{ route('Añadir Al Carrito', $producto->id) }}" class="btn btn-warning ml-3 add">Añadir al Carrito &nbsp;<i class="ni ni-cart"></i></a>
                    </div>
                  @endif
                  @if (!empty($producto->cantidad_incluida))
                    <h6 class="category">Cantidad de unidades incluidas por producto:</h6>
                    <p class="description">{{ $producto->cantidad_incluida }} unidad/es</p>
                  @endif
                  @if (!empty($producto->tipo))
                    <h6 class="category">Tipo de la carta:</h6>
                    <p class="description">{{ $producto->tipo }}</p>
                  @endif
                  @if (!empty($producto->idioma))
                    <h6 class="category">Idioma:</h6>
                    <p class="description">{{ $producto->idioma }}</p>
                  @endif
                  @if (!empty($producto->rareza))
                    <h6 class="category">Rareza de la carta:</h6>
                    <p class="description">{{ $producto->rareza }}</p>
                  @endif
                  @if (!empty($producto->expansion))
                    <h6 class="category">Expansión:</h6>
                    <p class="description">{{ $producto->expansion }}</p>
                  @endif
                  @if (!empty($producto->marca))
                    <h6 class="category">Marca:</h6>
                    <p class="description">{{ $producto->marca }}</p>
                  @endif
                  @if (!empty($producto->capacidad))
                    <h6 class="category">Capacidad de almacenamiento del deckbox:</h6>
                    <p class="description">{{ $producto->capacidad }}</p>
                  @endif
                  @if (!empty($producto->color))
                    <h6 class="category">Color:</h6>
                    <p class="description">{{ $producto->color }}</p>
                  @endif
                  @if (!empty($producto->size))
                    <h6 class="category">Tamaño:</h6>
                    <p class="description">{{ $producto->size }}</p>
                  @endif

                  @if (!empty($producto->descripcion))
                    <h6 class="category">Descripción:</h6>
                    <p class="description">{{ $producto->descripcion }}</p>
                  @endif

                </div>
              </div>
            </div>
          </div>
          <div class="section related-products bg-secondary skew-separator skew-top">
            <div class="container">
              <div class="col-md-8">
                <h2 class="title text-capitalize">Tal vez te interesen</h2>
              </div>
              <div class="row" id="getRecomendaciones">

                <div class="alert alert-primary d-flex justify-content-between col-lg-12" id="cargando" role="alert">
                  <strong class="pt-1">Cargando Recomendaciones...</strong>
                  <div class="spinner-border text-white" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>

              </div>
            </div>
          </div>

          @include('sections.info')
    </div>

    <script>
      window.addEventListener('load', () => {

        document.getElementById('back').addEventListener('click', e => {
                e.preventDefault()
                window.history.go(-1)
            })

        fetch('/api/v1/TypeProduct/show/{{ $producto->producto }}', {
            headers: {
                    'Content-Type': 'application/json',
                },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.json())
        .then(response => {
            document.getElementById('tipoProducto').innerText = response.tipo.tipo_producto
        })
        
        fetch('/api/v1/APIPage/GetCarousel/{{ $producto->id }}', {
            headers: {
                    'Content-Type': 'application/json',
                },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.text())
        .then(response => {
            document.getElementById('getProductImage').innerHTML = ''
            document.getElementById('getProductImage').innerHTML = response

            
        })
        
        fetch('/api/v1/APIPage/GetRecomendaciones', {
            headers: {
                    'Content-Type': 'application/json',
                },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.text())
        .then(response => {
            document.getElementById('getRecomendaciones').innerHTML = ''
            document.getElementById('getRecomendaciones').innerHTML = response

            document.querySelectorAll('.addAjax').forEach(boton => {
              boton.addEventListener('click', e => {

                let id = e.target.getAttribute('id')
                let alert = document.getElementById('alert')

                alert.classList.toggle('show')
              })
            })
        })
      })
    </script>

@endsection