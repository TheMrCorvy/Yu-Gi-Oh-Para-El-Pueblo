@extends('layouts.app', ['class' => 'pricing-page bg-secondary'])

@section('content')
    <style>
        .boton-hover-pedido:hover{
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
    <div class="main">
        <div class="mt-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mt-5 mb-3">
                        <h3 class="display-3 pt-4">Detalles del Paquete</h3>
                        <small class="description">Estado actual del Paquete: <span class="text-success" id="estado-paquete">{{$paquete->estado}}</span></small>
                        <br>
                        @if ($paquete->comentario_al_paquete)
                            <small class="description">{{$paquete->comentario_al_paquete}}</small>
                        @endif
                        <br>
                        <small class="description">{{$paquete->seguimiento_envio}}</small>
                    </div>

                    @if (Session::has('message'))
                        <div class="col-lg-12">
                            <div class="alert alert-info">
                                <strong>Advertencia</strong>
                                <br>
                                <p>
                                    {{Session::get('message')}}
                                </p>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-12 text-center">
                        <a href="#" class="btn mb-3 btn-warning btn-sm" id="back">VOLVER</a>
                    </div>

                    @if (!($paquete->fecha_caducidad_precio >= now()->format('Y-m-d')) && !is_null($paquete->fecha_caducidad_precio))
                        <div class="col-lg-12 text-center">
                            <p class="text-danger" id="errors">
                                Ya pasó la fecha límite en la que podías pagar la seña para este paquete. Tendrás que enviarlo a revisión nuevamente para que podamos darte un precio actualizado.
                            </p>
                        </div>
                    @else
                        <div class="col-lg-12 text-center">
                            <p class="text-danger d-none" id="errors">
                            </p>
                        </div>
                    @endif

                    @if ($paquete->username === Auth::user()->username && $paquete->estado === "El paquete llegó al local")
                        <div class="col-lg-12 text-right mb-5" style="padding-right: 2rem;">
                            <a href="{{route('Realizar Pago Final', $paquete->id)}}" class="btn btn-outline-danger">pagar precio Final</a>
                        </div>
                    @endif
                    
                    <div class="col-lg-12 table-responsive mb-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">Nombre de la Carta</th>
                                    <th class="text-center">Expansión Deseada</th>
                                    <th class="text-center">Precio Unitario</th>
                                    <th class="text-center">Cantidad Pedida</th>
                                    <th class="text-left">Comentarios</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($pedidos as $cartaPedida)    
                                    <tr id="fila-carta-{{$cartaPedida->id}}">
                                        <td class="text-left text-capitalize">{{$cartaPedida->nombre_carta}}</td>
                                        
                                        @if ($cartaPedida->expansion)
                                            <td class="text-center">{{$cartaPedida->expansion}}</td>
                                        @else
                                            <td class="text-center text-success">El precio más barato.</td>
                                        @endif
                                        
                                        @if ($cartaPedida->precio)
                                            <td class="text-center">$ {{$cartaPedida->precio}}</td>
                                        @else
                                            <td class="text-center text-warning">Aún no disponible.</td>
                                        @endif

                                        <td class="text-center">
                                            <span id="carta-id-{{$cartaPedida->id}}">
                                                {{$cartaPedida->cantidad}}
                                            </span> 
                                        </td>
                                        
                                        @if ($cartaPedida->comentario)
                                            <td class="text-left">{{$cartaPedida->comentario}}</td>
                                        @else
                                            <td class="text-left">No hay comentarios.</td>
                                        @endif
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                
                    <div class="col-lg-12 row justify-content-end">
                        @if ($paquete->username === Auth::user()->username && $paquete->estado === "El paquete llegó al local")
                            <div class="col-lg-12 pr-0 text-right mb-5">
                                <a href="{{route('Realizar Pago Final', $paquete->id)}}" class="btn btn-outline-danger">pagar precio Final</a>
                            </div>
                        @endif
                        <div class="col-lg-4 pr-0 text-right">
                            <p>
                                <strong>
                                    Monto Total: $ {{$montoTotal}}
                                </strong>
                            </p>
                        </div>
                        @if (isset($ordenCompra) && !is_null($ordenCompra->precio_envio))
                            <div class="col-lg-4 pr-0 text-right">
                                <p>
                                    <strong>
                                        Seña Pagada: $ {{ceil($paquete->pago_inicial)}}
                                    </strong>
                                </p>
                            </div>
                            <div class="col-lg-4 pr-0 text-right">
                                <p>
                                    <strong>
                                        Costo del Envío Pagado: $ {{$ordenCompra->precio_envio}}
                                    </strong>
                                </p>
                            </div>
                        @else
                            <div class="col-lg-4 pr-0 text-right">
                                <p>
                                    <strong>
                                        Seña Pagada: $ {{ceil($paquete->pago_inicial)}}
                                    </strong>
                                </p>
                            </div>
                        @endif
                    </div>
                    @if (isset($ordenCompra) && $ordenCompra->envio)
                        <div class="col-lg-8 mx-auto text-center mb-3">
                            <h3 class="display-3 pt-4">Detalles para el Envío</h3>
                            <div class="col-lg-12 text-center px-3">
                                <p>
                                    <strong>Método de Envío elegido: </strong> <span class="text-warning">{{$ordenCompra->metodo_envio}}</span>
                                </p>
                                <p>
                                    <strong>Forma de Pago elegida: </strong> <span class="text-success">{{$ordenCompra->forma_de_pago}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-12 table-responsive mb-5">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Calle Principal <br><br> <small>(Incluyendo cualquier aclaración)</small></th>
                                        <th>Calle Secundaria</th>
                                        <th>Número/Altura</th>
                                        <th>Barrio</th>
                                        <th>Ciudad</th>
                                        <th>Provincia</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-capitalize">{{ $usuario->name }}</td>
                                        <td class="text-capitalize">{{ $usuario->calle1_timbre }}</td>
                                        <td class="text-capitalize">{{ $usuario->calle2 }}</td>
                                        <td class="text-capitalize">{{ $usuario->altura_domicilio }}</td>
                                        <td class="text-capitalize">{{ $usuario->barrio }}</td>
                                        <td class="text-capitalize">{{ $usuario->ciudad }}</td>
                                        <td class="text-capitalize">{{ $usuario->localidad }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-lg-8 mx-auto text-center my-5">
                            <h6 class="display-3 pt-4">El paquete se retirará por el Local</h6>
                        </div>
                    @endif

                    @isset($ordenCompra)
                        @if ($ordenCompra->username !== Auth::user()->username)
                            <div class="col-lg-12 card card-plain mb-4" style="margin-top: -50px !important;">
                                <div class="card-header pt-0 bg-secondary text-center">
                                    <h4 class="lead mt-3">
                                        Datos de Facturación
                                    </h4>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <p class="lead mt-0">
                                        <strong class="text-capitalize">
                                            {{ $ordenCompra->nombre }}
                                        </strong>
                                        - DNI o CUIL 
                                        <strong class="text-capitalize">
                                            {{ $ordenCompra->dni }}
                                        </strong>
                                    </p>
                                    <p class="lead">
                                        <strong class="text-capitalize">
                                            {{ $ordenCompra->calle }}, 
                                        </strong>
                                        <strong class="text-capitalize">
                                            {{ $ordenCompra->altura }}
                                        </strong> - Código Postal: 
                                        <strong>
                                            {{ $ordenCompra->codigo_postal }}, 
                                        </strong>
                                        <strong class="text-capitalize">
                                            {{ $ordenCompra->ciudad }}, 
                                        </strong>
                                        <strong class="text-capitalize">
                                            {{ $ordenCompra->provincia }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endisset
              
                </div>
            </div>
        </div>
    </div>

    <script>

        document.getElementById('back').addEventListener('click', e => {
            e.preventDefault()
            window.history.go(-1)
        })

    </script>
@endsection