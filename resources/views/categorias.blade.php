@extends('layouts.app', ['class' => 'ecommerce-page'])

@section('content')
  
@include('sections.barra-busqueda')
    <div class="main" style="margin-top: -50px !important;">
      <div class="upper">
        <div style="padding: 15px;">
          <div class="row">
              <div class="col-lg-3">
                  <div class="container">
                      <div class="row">
                          <div class="card col-lg-12">
                            <div class="accordion-1">  
                                <div class="row">
                                  <div class="col-md-12 ml-auto">
                                    <div class="accordion my-3" id="accordionExample">
                                      <div class="card">
                                        <div class="card-header" id="headingFifth">
                                          <h5 class="mb-0">
                                            <button class="btn btn-link w-100 text-primary text-left" type="button" data-toggle="collapse" data-target="#collapseFifth" aria-controls="collapseFifth">
                                              Ordenar
                                              <i class="ni ni-bold-down float-right"></i>
                            
                                            </button>
                                          </h5>
                                        </div>
                            
                                        <div id="collapseFifth" class="collapse" aria-labelledby="headingFifth" data-parent="#accordionExample">
                                          <div class="">
                                              <a href="/categoria/{{ $categoria->ruta }}/recientes" class="add btn btn-info mt-2 mx-auto col-lg-12">más recientes primero</a>

                                              <a href="/categoria/{{ $categoria->ruta }}/no-tan-recientes" class="add btn btn-info mt-2 mx-auto col-lg-12">más recientes último</a>
      
                                              <hr class="line-info mb-3">
                                              <a href="/categoria/{{ $categoria->ruta }}/a-z" class="add btn btn-primary mt-2 mx-auto col-lg-12">nombre A-Z</a>
      
                                              <a href="/categoria/{{ $categoria->ruta }}/z-a" class="add btn btn-primary mt-2 mx-auto col-lg-12">nombre Z-A</a>
      
                                              <hr class="line-info mb-3">
                                              <a href="/categoria/{{ $categoria->ruta }}/precio-menor-mayor" class="add btn btn-success mt-2 mx-auto col-lg-12">precio (menor a mayor)</a>
      
                                              <a href="/categoria/{{ $categoria->ruta }}/precio-mayor-menor" class="add btn btn-success mt-2 mx-auto col-lg-12">precio (mayor a menor)</a>
      
                                              {{-- <hr class="line-info mb-3">
                                              <a href="/categoria/{{ $categoria->ruta }}/oferta-mayor-menor" class="add btn btn-warning mt-2 mx-auto col-lg-12">Oferta (De Más a Menos)</a>
                                              <a href="/categoria/{{ $categoria->ruta }}/oferta-menor-mayor" class="add btn btn-warning mt-2 mx-auto col-lg-12">Oferta (De Menos a Más)</a> --}}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-lg-9">
              <div class="card" style="min-height: 100vh;">
                  <div class="container">
                      <h1 class="title mt-5 ml-3 text-capitalize">{{ $categoria->categoria }}</h1>
                      <hr class="line-success ml-3 mb-3">
                      <div class="row d-flex justify-content-around">

                          @if ($resultados->count() >= 1)
                            <div class="col-lg-12 d-flex justify-content-center">
                              <div class="pagination-container justify-content-center">
                                {{ $resultados->links() }}
                              </div>
                            </div>

                            @foreach ($resultados as $producto)
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-product card-plain row">
                                        <div class="card-image d-flex justify-content-center">
                                            <a href="{{ route('Producto', $producto->id) }}">
                                            <img class="img rounded" async src="{{ $producto->link_img }}" alt="/images/logo.jpeg" style="max-width: 5rem !important;"/>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ route('Producto', $producto->id) }}" class="card-link">{{ $producto->nombre }}</a>
                                            <p class="text-success">Precio: $ {{ round(($producto->precio * $multiplicador->multiplicador), -1) }}</p>
                                            
                                            <a href="{{ route('Añadir Al Carrito', $producto->id) }}" class="btn btn-sm btn-gradient-default text-white btn-tooltip add" style="margin-top: -20px;">Agregar Al Carrito</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            

                            <div class="col-lg-12 d-flex justify-content-center">
                              <div class="pagination-container justify-content-center">
                                {{ $resultados->links() }}
                              </div>
                            </div>
                          @else
                            <div class="card bg-gradient-warning col-lg-5 col-md-5 mt-8 mx-3">
                              <!-- Card body -->
                              <div class="card-body">
                                  <div class="row" style="position: relative;">
                                      <div class="col">
                                          <h5 class="card-title text-uppercase text-muted mb-0 text-white">¡Vaya!</h5>
                                          <span class="h5 font-weight-bold mb-0 text-white">No pudimos encontrar nada...</span>
                                      </div>
                                      <div class="float-right">
                                          <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                              <i class="ni ni-support-16 text-success"></i>
                                          </div>
                                      </div>
                                  </div>
                                  <p class="mt-3 mb-0 text-sm">
                                      <span class="text-white mr-2">Tal vez te interese ver alguno de nuestros otros productos:</span>
                                  </p>
                                  <br>
                                  <a href="{{ route('Cartas') }}" class="text-white">
                                    <i class="ni ni-bold-right pt-2 text-white"></i> Cartas de Yu-Gi-Oh!
                                  </a>
                                  <br>
                                  <br>
                                  <a href="{{ route('Productos Relacionados') }}" class="text-white">
                                    <i class="ni ni-bold-right text-white"></i> Productos de Yu-Gi-Oh!
                                  </a>
                              </div>
                            </div>
                          @endif

                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

@include('sections.info')

@endsection