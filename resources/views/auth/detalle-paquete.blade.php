@extends('layouts.app', ['class' => 'pricing-page'])

@section('content')

    <style>
        .boton-hover-pedido:hover{
            cursor: pointer;
            text-decoration: underline;
        }
    </style>

    <div class="main">
        <div class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center my-5">
                        <h3 class="display-3 pt-4">Detalles del Paquete</h3>
                        <small class="description">Estado actual del Paquete: <span class="text-success">{{$paquete->estado}}</span></small>
                        <br>
                        @if ($paquete->comentario_al_paquete)
                            <small class="description">{{$paquete->comentario_al_paquete}}</small>
                        @endif
                    </div>
                    
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
                                    <tr>
                                        <td class="text-left text-capitalize">{{$cartaPedida->nombre_carta}}</td>
                                        
                                        @if ($cartaPedida->expansion)
                                            <td class="text-center text-capitalize">{{$cartaPedida->expansion}}</td>
                                        @else
                                            <td class="text-center text-capitalize text-success">El precio más barato.</td>
                                        @endif
                                        
                                        @if ($cartaPedida->precio)
                                            <td class="text-center">{{$cartaPedida->precio}}</td>
                                        @else
                                            <td class="text-center text-warning">Aún no disponible.</td>
                                        @endif

                                        <td class="text-center">
                                            <button 
                                                class="btn btn-icon-only btn-action-pedido btn-outline-danger"
                                                data-toggle="tooltip" 
                                                data-placement="left" 
                                                title="Quitar Una"
                                                action="restar"
                                                card-id="{{$cartaPedida->id}}"
                                                onclick="modificarCantidad(event)"
                                            >
                                                <i 
                                                    class="fas fa-minus"
                                                    action="restar"
                                                    card-id="{{$cartaPedida->id}}"
                                                ></i>
                                            </button>
                                            {{$cartaPedida->cantidad}} 
                                            <button 
                                                class="btn btn-icon-only btn-action-pedido btn-outline-success ml-2"
                                                data-toggle="tooltip" 
                                                data-placement="right" 
                                                title="Sumar Una"
                                                action="sumar"
                                                id="{{$cartaPedida->id}}"
                                                onclick="modificarCantidad(event)"
                                            >
                                                <i 
                                                    class="fas fa-plus"
                                                    action="sumar"
                                                    card-id="{{$cartaPedida->id}}"
                                                ></i>
                                            </button>
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
                
                    <div class="col-lg-12 row justify-content-center">
                        @if ($montoTotal > 0)
                            <div class="col-lg-12 pr-0 text-right mb-5">
                                <button class="btn btn-outline-info">pagar seña</button>
                            </div>
                        @endif
                        <div class="col-lg-4 pr-0 text-right">
                            <p>
                                @if ($paquete->fecha_caducidad_precio)
                                    <strong>
                                        Precio Válido Hasta: {{$paquete->fecha_caducidad_precio}}
                                    </strong>
                                    <br>
                                    <small class="text-muted">(Año-Mes-Día)</small>
                                @else
                                    <strong>
                                        Precio Válido Hasta: <small class="text-warning">Aún no disponible.</small>
                                    </strong>
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-4 pr-0 text-right">
                            <p>
                                @if ($montoTotal > 0)
                                    <strong>
                                        Monto Total: $ {{$montoTotal}}.
                                    </strong>
                                @else
                                    <strong>
                                        Monto Total: <small class="text-warning">Aún no disponible.</small>
                                    </strong>
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-4 pr-0 text-right">
                            <p>
                                @if ($pagoInicial > 0)
                                    <strong>
                                        Seña a Pagar: $ {{$pagoInicial}}.
                                    </strong>
                                @else
                                    <strong>
                                        Seña a Pagar: <small class="text-warning">Aún no disponible.</small>
                                    </strong>
                                @endif
                            </p>
                        </div>
                    </div>      
                    <div class="col-lg-12 d-flex justify-content-end">
                        <small class="text-muted">Podrás editar un producto del paquete, siempre y cuando este no esté en revisión.</small>
                    </div>   
                    <div class="col-lg-12 d-flex justify-content-end pt-2">
                        <small class="text-muted">Una vez presupuestado el paquete podrás volver a editarlo, pero ten en cuenta que al agregar cartas a tu pedido, este deberá volver a revisarse.</small>
                    </div> 

                    <div class="col-lg-12 text-center">
                        <a href="#" class="btn mt-4 btn-warning" id="back">VOLVER</a>
                    </div>
              
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('back').addEventListener('click', e => {
            e.preventDefault()
            window.history.go(-1)
        })

        function modificarCantidad(e)
        {
            console.log(e.target.getAttribute('action'))
            document.getElementById('alert').classList.add('show')

            const botones = document.querySelectorAll('.btn-action-pedido')

            botones.forEach(boton => {
                boton.setAttribute('disabled', '')
            });

            setTimeout(() => {
                botones.forEach(boton => {
                    boton.removeAttribute('disabled', '')

                    document.getElementById('alert').classList.remove('show')
                });
            }, 3000);
        }
    </script>
@endsection