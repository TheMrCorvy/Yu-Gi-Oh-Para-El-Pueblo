@extends('layouts.app', ['class' => 'product-page'])

@section('content')

<div class="wraper">
    <div class="page-header page-header-small skew-separator skew-mini">
        
        <div class="page-header-image bg-gradient-primary"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-7 mr-auto text-left">
                        <h1 class="title text-white">Mis Paquetes de Importación</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Armar un Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="description">
                    Para armar un pedido de importación de cartas solo hace falta que nos des los siguientes datos:
                </p>
                <ol>
                    <li>
                        <p>Nombre de la Carta</p>
                    </li>
                    <li>
                        <p>
                            Cantidad Deseada
                        </p>
                    </li>
                    <li>
                        <p>
                            Expansión (opcional, si no se especifica se usará el precio más barato)
                        </p>
                    </li>
                </ol>
                <p class="description">
                    Podrás añadir todas las cartas que quieras. Una vez completado, tu paquete será enviado a revisión en donde evaluaremos los precios, y te responderemos con el precio unitario para cada ítem, y de igual manera un comentario si no hay stock, o si no hay suficientes unidades en stock.
                </p>
                <p class="description">
                    <strong>LOS PRECIOS DADOS LUEGO DE LA REVISIÓN NO SON PERMANENTES</strong>. El precio final que reciba tu paquete tendrá una fecha de caducidad, y si no pagas la seña antes de dicha fecha, el paquete no será válido para importar y tendrá que pasar nuevamente por revisión para darte un presupuesto nuevo.
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">volver</button>
                <button type="button" class="btn btn-primary">comenzar</button>
              </div>
            </div>
            </div>
          </div>

        <div class="section section-item" style="z-index: 12 !important;">
            <div class="container" id="misCompras">
                <div class="row">
                    
                    <div class="col-lg-12 mb-8">
                        <div class="col-lg-6 mx-auto">
                            <div class="card card-plain">
                                <div class="progress-wrapper">
                                    <div class="progress-info">
                                        <div class="progress-label">
                                            <p class="">Aún no pediste ningún paquete.</p>
                                        </div>
                                    </div>
                                    <div class="progress">
                                        <div 
                                            class="progress-bar bg-info" 
                                            role="progressbar" 
                                            aria-valuenow="60" 
                                            aria-valuemin="0" 
                                            aria-valuemax="0" 
                                            style="width: 100%;"
                                        ></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 mx-auto mt-5">
                        <div class="card bg-secondary container">
                            <div class="card-header bg-white row d-flex justify-content-between">
                                <h6 class="card-title text-primary mt-3 col-lg-6">Número de Orden: id compra</h6>
                                <h6 class="card-title text-primary mt-3 text-right col-lg-6">
                                    Fecha: yy-mm-dd
                                    <br><small class="text-muted">(Año-Mes-Día)</small>
                                </h6>
                            </div>
                
                            <div class="card-body">
                                <p class="">
                                    Mandános un <strong class="text-success">WhatsApp a 011 3771-9677</strong> para coordinar la entrega/envío, o también podés contactarnos por <strong class="text-primary">email a info@yugiohparaelpueblo.com</strong>.
                                </p>
                                <div class="progress">
                                    <div 
                                        class="progress-bar bg-success" 
                                        role="progressbar" 
                                        aria-valuenow="60" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100" 
                                        style="width: 100%;"
                                    ></div>
                                </div>
                              <td>Forma de Pago: Forma de Pago</td>
                              <br>
                              <br>
                              {{-- @if ($compra->envio)
                                <p>Forma de Entrega: Envío (Coordinar con el vendedor).</p>
                              @else --}}
                                <p>Forma de Entrega: Retiro en el local.</p>
                              {{-- @endif --}}
                              <p class="mt-3">Monto Total de la Venta: <strong>$ Moto Total</strong>.</p>
                
                              {{-- @if (isset($compra->agregar_dinero_envio))
                                  <a href="{{ $compra->agregar_dinero_envio }}" class="btn btn-primary mt-3">Agregar Dinero</a>
                              @endif --}}
                            </div>
                
                            <div class="card-footer bg-secondary" id="detalle1">
                              <a href="#" id="1" class="btn btn-link float-right addAjax detalles" data-toggle="modal" data-target=".bd-example-modal-xl">
                                Ver Detalle
                                <i class="fas fa-chevron-right"></i>
                              </a>
                            </div>
                        </div>
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
    </div>

<script>
    const username = '{{ Auth::user()->username }}'

    async function GetRecomendaciones() {
        await fetch('/api/v1/APIPage/GetRecomendaciones', {
            headers: {
                    'Content-Type': 'application/json',
                },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.text())
        .then(response => {
            document.getElementById('getRecomendaciones').innerHTML = ''
            document.getElementById('getRecomendaciones').innerHTML = response
        })
    }


    window.addEventListener('load', async () => {

        await Promise.all([
            GetRecomendaciones(),
        ])
        .then(
            
        )//.then
    })//window
</script>

@endsection