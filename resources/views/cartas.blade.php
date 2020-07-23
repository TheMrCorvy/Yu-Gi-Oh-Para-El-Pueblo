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
                                                        <a href="/cartas/nuevos" class="add btn btn-info mt-2 mx-auto col-lg-12">más recientes primero</a>

                                                        <a href="/cartas/no-tan-nuevos" class="add btn btn-info mt-2 mx-auto col-lg-12">más recientes último</a>
                
                                                        <hr class="line-info mb-3">
                                                        <a href="/cartas/a-z" class="add btn btn-primary mt-2 mx-auto col-lg-12">nombre A-Z</a>
                
                                                        <a href="/cartas/z-a" class="add btn btn-primary mt-2 mx-auto col-lg-12">nombre Z-A</a>
                
                                                        <hr class="line-info mb-3">
                                                        <a href="/cartas/precio-menor-mayor" class="add btn btn-success mt-2 mx-auto col-lg-12">precio (menor a mayor)</a>
                
                                                        <a href="/cartas/precio-mayor-menor" class="add btn btn-success mt-2 mx-auto col-lg-12">precio (mayor a menor)</a>
                
                                                        <hr class="line-info mb-3">
                                                        <a href="/cartas/tipo" class="add btn btn-warning mt-2 mx-auto col-lg-12">tipo de carta</a>
                
                                                        <a href="/cartas/rareza" class="add btn btn-info bg-gradient-warning mt-2 mx-auto col-lg-12">rareza</a>
                
                                                        <a href="/cartas/expansion" class="add btn btn-outline-success mt-2 mx-auto col-lg-12">expansión</a>
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
                    <div class="card">
                        <div class="container">
                            <h1 class="title mt-5 ml-3 text-capitalize">comprar cartas</h1>
                            <hr class="line-success ml-3 mb-3">
                            <div class="row">

                                <div class="col-lg-12 d-flex justify-content-center">
                                    <div class="pagination-container justify-content-center">
                                      {{ $resultados->links() }}
                                    </div>
                                </div>

                                @foreach ($resultados as $resultado)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card card-product card-plain row">
                                            <div class="card-image d-flex justify-content-center">
                                                <a href="{{ route('Producto', $resultado->id) }}">
                                                <img class="img rounded" async src="{{ $resultado->link_img }}" alt="/images/logo.jpeg" style="max-width: 5rem !important;"/>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <a href="{{ route('Producto', $resultado->id) }}" class="card-link">{{ $resultado->nombre }}</a>
                                                <p class="text-success">Precio: $ {{ round(($resultado->precio * $multiplicador->multiplicador), -1) }}</p>
                                                @if (!empty($resultado->rareza))
                                                <p style="margin-top: -20px;">Rareza: <span class="text-warning">{{ $resultado->rareza }}</span></p>
                                                @endif
                                                @if (!empty($resultado->tipo_carta))
                                                <p style="margin-top: -20px;">Tipo de Carta: <span class="text-primary">{{ $resultado->tipo_carta }}</span></p>
                                                @endif
                                                @if (!empty($resultado->expansion))
                                                <p style="margin-top: -20px;">Expansión: <span class="text-danger">{{ $resultado->expansion }}</span></p>
                                                @endif
                                                <a href="{{ route('Añadir Al Carrito', $resultado->id) }}" class="btn btn-sm btn-gradient-warning text-white btn-tooltip add" style="margin-top: -20px;">Agregar Al Carrito</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                

                                <div class="col-lg-12 d-flex justify-content-center">
                                  <div class="pagination-container justify-content-center">
                                    {{ $resultados->links() }}
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

@include('sections.info')
@endsection