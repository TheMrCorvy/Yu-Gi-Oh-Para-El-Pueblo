@extends('layouts.app', ['class' => 'ecommerce-page'])

@section('content')
  
@include('sections.barra-busqueda')
    <div class="main" style="margin-top: -50px !important;">
        <div class="upper">
            <div style="padding: 15px;">
                <div class="row" style="min-height: 110vh !important;">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="">
                                <h3 class="title mt-5 ml-3 text-capitalize">{{ $titulo }}</h3>
                                <hr class="line-success ml-3 mb-3">
                                <div class="row">

                                    <div class="col-lg-12 d-flex justify-content-center">
                                        <div class="pagination-container justify-content-center">
                                        {{ $resultados->links() }}
                                        </div>
                                    </div>

                                    @foreach ($resultados as $resultado)
                                        <div class="col-lg-2 d-flex justify-content-center">
                                            <div class="card card-product card-plain row">
                                                <div class="card-image d-flex justify-content-center" >
                                                    <a href="{{ route('Producto', $resultado->id) }}">
                                                    <img class="img rounded" async src="{{ $resultado->link_img }}" alt="/images/logo.jpeg" style="max-width: 5rem !important;"/>
                                                    </a>
                                                </div>
                                                <div class="card-body">
                                                    {{-- <h4 class="card-title mb-4"> --}}
                                                    @if ($resultado->stock <= 0)
                                                        <a href="{{ route('Producto', $resultado->id) }}" class="card-link text-danger">- SIN STOCK - <br>{{ $resultado->nombre }}
                                                            <p class="text-success">Precio: $ {{ round(($resultado->precio * $multiplicador->multiplicador), -1) }}</p>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('Producto', $resultado->id) }}" class="card-link">{{ $resultado->nombre }} <br>
                                                        {{-- </h4> --}}
                                                            @if ($resultado->oferta > 0 && $resultado->fecha_oferta >= date('Y-m-d'))
                                                                
                                                                <p class="price-old text-danger">
                                                                    Precio: $ 
                                                                    {{ round(($resultado->precio * $multiplicador->multiplicador), -1) }}
                                                                </p>
                                                                <p class="text-priamry" style="margin-top: -20px;">
                                                                    ¡Oferta: {{ $resultado->oferta }}%!
                                                                </p>
                                                                <p class="text-success" style="margin-top: -20px;">
                                                                    Precio: $ 
                                                                    {{ floor(($resultado->precio * $multiplicador->multiplicador)
                                                                    - (($resultado->oferta / 100) 
                                                                    * ($resultado->precio * $multiplicador->multiplicador))) }}
                                                                </p>
                                                                <a href="{{ route('Añadir Al Carrito', $resultado->id) }}" class="btn btn-sm btn-primary btn-tooltip add" style="margin-top: -20px;">Agregar Al Carrito</a>
                                                            @else
                                                                <p class="text-success">Precio: $ {{ round(($resultado->precio * $multiplicador->multiplicador), -1) }}</p>
                                                                <a href="{{ route('Añadir Al Carrito', $resultado->id) }}" class="btn btn-sm btn-gradient-primary btn-tooltip add" style="margin-top: -20px;">Agregar Al Carrito</a>
                                                            @endif
                                                        </a>
                                                    @endif
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
@endsection