@extends('layouts.app', ['class' => 'checkout-page'])

@section('content')

<div class="wrapper">
    <div class="section-shaped my-0 skew-separator skew-mini">
      <div class="page-header page-header-small">
        <div class="page-header-image bg-gradient-info">
        </div>
        <div class="container-fluid">
          <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
              <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                <h1 class="text-white">Checkout</h1>
                <p class="text-lead text-white">Completá el siguiente formulario para que podamos procesar tu pago.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="upper">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="container">
              <h3 class="title text-white" style="margin-top: 40px !important;">Resumen de Compras</h3>
              <div class="row">
                
                <div class="card">
                  <div class="card-body">

                    @foreach ($productosEnCarrito as $item)
                        <div class="media align-items-center mb-3">
                            <div class="col-md-5 col-6">
                                <img src="{{ $item->attributes[0] }}" alt="Rounded image" class="img-fluid">
                            </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h2 class="h6">{{ $item->name }}</h2>
                            </div>
                            <div class="col-lg-12">
                                <small class="d-block opacity-8">Cantidad: {{ $item->quantity }}</small>
                            </div>
                            <div class="col-lg-12">
                                <span>Precio: $ {{ Cart::session(auth()->id())->get($item->id)->getPriceSum() }}</span>
                            </div>
                        </div>
                      </div>
                    @endforeach

                    <hr class="line-info mb-3">
                    <div class="media align-items-center">
                      <h3 class="h6 opacity-8 mr-3">Subtotal</h3>
                      <div class="media-body text-right">
                        <span>$ {{ Cart::session(auth()->id())->getSubTotal() }}</span>
                      </div>
                    </div>
                    <div class="media align-items-center">
                      <h3 class="h6 opacity-8 mr-3">Envío</h3>
                      <div class="media-body text-right">
                        <small class="text-muted">(coordinar luego de la compra)</small>
                      </div>
                    </div>
                    <hr class="line-info mb-3">
                    <div class="media align-items-center">
                      <h3 class="h6">Total</h3>
                      <div class="media-body text-right">
                        <span class="font-weight-semi-bold" total="{{ Cart::session(auth()->id())->getTotal() }}" id="totalAPagar">${{ Cart::session(auth()->id())->getTotal() }}</span>
                      </div>
                    </div>

                  </div>
                  <div class="info info-horizontal row py-0" style="margin-top: -20px;">
                    <div class="col-lg-12 text-center d-flex justify-content-center">
                      <div class="icon icon-shape icon-shape-success rounded-circle text-white bg-success">
                        {{-- <i class="ni ni-hat-3 text-success"></i> --}}
                        <i class="fas fa-fingerprint" style="font-size: 2rem !important;"></i>
                      </div>
                    </div>
                    <div class="description pl-4">
                      <h5 class="title text-success" style="margin-top: 10px !important;">Sitio Seguro</h5>
                      <p>Todos tus datos permanecerán seguros gracias a la tecnología de codificación de MercadoPago, y a las más avanzadas técnicas de seguridad web.</p>
                    </div>
                  </div>
                </div>
                

              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card">

              @if (Session::has('errors'))    
                  <div class="alert alert-danger" role="alert">
                      <strong>{{ Session::get('errors') }}</strong>
                  </div>
              @endif
              
              @if (!Session::has('formulario'))
                  @include('checkouts.1', ['usuario' => $usuario])
              @else
                  @include('checkouts.' . Session::get('formulario'))
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>

    
</div>

@endsection