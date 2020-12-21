@extends('layouts.app', ['class' => 'pricing-page bg-secondary'])

@section('content')
    <style>
        .boton-hover-pedido:hover{
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
    <div class="main">
        <div class="my-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mt-5 mb-3">
                        <h3 class="display-3 pt-4">Detalles del Paquete</h3>
                        <small class="description">Estado actual del Paquete: <span class="text-success" id="estado-paquete">{{$paquete->estado}}</span></small>
                        <br>
                        @if ($paquete->comentario_al_paquete)
                            <small class="description">{{$paquete->comentario_al_paquete}}</small>
                        @endif
                        @if (!($paquete->fecha_caducidad_precio >= now()->format('Y-m-d')) && !is_null($paquete->fecha_caducidad_precio))
                            <form 
                                method="post" 
                                action="{{route('Pedir Presupuesto')}}" 
                                class="col-lg-12 text-center mt-4" 
                                id="pedir-presupuesto"
                                estado="{{$paquete->estado}}"
                            >
                                @csrf
                                <input type="hidden" name="id-paquete" value="{{$paquete->id}}">
                                <button class="btn btn-outline-success btn-action-pedido">
                                    Pedir presupuesto
                                </button>
                            </form>
                        @else
                            <form 
                                method="post" 
                                action="{{route('Pedir Presupuesto')}}" 
                                class="col-lg-12 text-center mt-4 d-none" 
                                id="pedir-presupuesto"
                                estado="{{$paquete->estado}}"
                            >
                                @csrf
                                <input type="hidden" name="id-paquete" value="{{$paquete->id}}">
                                <button class="btn btn-outline-success btn-action-pedido">
                                    Pedir presupuesto
                                </button>
                            </form>
                        @endif
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
                                            <span id="carta-id-{{$cartaPedida->id}}">
                                                {{$cartaPedida->cantidad}}
                                            </span> 
                                            @if ($cartaPedida->cantidad === 0)
                                                <button 
                                                    class="btn btn-icon-only btn-action-pedido ml-2"
                                                    data-toggle="tooltip" 
                                                    data-placement="right" 
                                                    title="Sumar Una"
                                                    action="sumar"
                                                    card-id="{{$cartaPedida->id}}"
                                                    onclick="modificarCantidad(event)"
                                                    disabled
                                                >
                                                    <i 
                                                        class="fas fa-plus"
                                                        action="sumar"
                                                        card-id="{{$cartaPedida->id}}"
                                                    ></i>
                                                </button>
                                            @else
                                                <button 
                                                    class="btn btn-icon-only btn-action-pedido btn-outline-success ml-2"
                                                    data-toggle="tooltip" 
                                                    data-placement="right" 
                                                    title="Sumar Una"
                                                    action="sumar"
                                                    card-id="{{$cartaPedida->id}}"
                                                    onclick="modificarCantidad(event)"
                                                >
                                                    <i 
                                                        class="fas fa-plus"
                                                        action="sumar"
                                                        card-id="{{$cartaPedida->id}}"
                                                    ></i>
                                                </button>
                                            @endif
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
                        @if ($montoTotal > 0 && $paquete->estado === "Abierto y Confirmado")
                            <div class="col-lg-12 pr-0 text-right mb-5" id="pagar-seña">
                                <a href="{{route('Añadir Al Carrito', [0, $paquete->id])}}" class="btn btn-outline-info">pagar seña</a>
                            </div>
                        @endif
                        <div class="col-lg-4 pr-0 text-right">
                            <p>
                                @if ($paquete->fecha_caducidad_precio)
                                    <strong>
                                        Precio Válido Hasta: {{$paquete->fecha_caducidad_precio->format('d/m/Y')}}
                                    </strong>
                                    <br>
                                    <small class="text-muted">(Año-Mes-Día)</small>
                                @else
                                    @if ($paquete->estado === 'Cerrado y Tramitando Importación')
                                        <strong>
                                            Precio Válido Hasta: <small class="text-warning">Ya se pagó la seña.</small>
                                        </strong>
                                    @else
                                        <strong>
                                            Precio Válido Hasta: <small class="text-warning">Aún no disponible.</small>
                                        </strong>
                                    @endif
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-4 pr-0 text-right">
                            <p>
                                @if ($montoTotal > 0)
                                    <strong>
                                        Monto Total: $ {{$montoTotal}}
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
                                @if ($pagoInicial > 0 || !is_null($paquete->pago_inicial))
                                    @if (!is_null($paquete->pago_inicial))
                                        <strong>
                                            Seña a Pagar: $ {{$paquete->pago_inicial}}
                                        </strong>
                                    @else
                                        <strong>
                                            Seña a Pagar: $ {{$pagoInicial}}
                                        </strong>
                                    @endif
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
        const pedirPresupuesto = document.getElementById('pedir-presupuesto')
        const pagarSeña = document.getElementById('pagar-seña')

        if (pedirPresupuesto.getAttribute('estado') === "Abierto") 
        {
            pedirPresupuesto.classList.remove('d-none')
            pagarSeña.classList.remove('d-none')
        }

        document.getElementById('back').addEventListener('click', e => {
            e.preventDefault()
            window.history.go(-1)
        })

        let botones

        window.addEventListener('load', () => {
            botones = document.querySelectorAll('.btn-action-pedido')
        })

        function evaluarRespuesta(respuesta)
        {
            document.getElementById('alert').classList.remove('show')

            botones.forEach(boton => {
                boton.removeAttribute('disabled', '')
            });

            if (respuesta.nueva_cantidad_carta) 
            {
                document.getElementById('carta-id-' + respuesta.id_carta_pedida).innerText = respuesta.nueva_cantidad_carta
            }

            if (respuesta.nuevo_estado_paquete) 
            {
                document.getElementById('estado-paquete').innerText = respuesta.nuevo_estado_paquete

                if (respuesta.nuevo_estado_paquete === "Abierto") 
                {
                    pedirPresupuesto.classList.remove('d-none')
                    pagarSeña.classList.add('d-none')
                }
            }
            
            if (respuesta.carta_removida) 
            {
                document.getElementById('fila-carta-' + respuesta.carta_removida).classList.add('d-none')
            }

            if (respuesta.errors) 
            {
                console.log(respuesta.errors)
                const errorMessage = document.getElementById('errors')

                errorMessage.innerText = respuesta.errors

                errorMessage.classList.remove('d-none')
            }
        }

        async function modificarCantidad(e)
        {
            document.getElementById('alert').classList.add('show')

            botones.forEach(boton => {
                boton.setAttribute('disabled', '')
            });

            await fetch('/api/v1/APIPage/modificarCantidades', {
                headers: {
                        'Content-Type': 'application/json',
                    },
                method: 'post',
                body: JSON.stringify({
                    idCarta: e.target.getAttribute('card-id'),
                    accion: e.target.getAttribute('action'),
                    username: "{{Auth::user()->username}}"
                })
            })
            .then(jsonResponse => jsonResponse.json())
            .then(response => {
                evaluarRespuesta(response)
            })
            .catch(error => {

                document.getElementById('alert').classList.remove('show')

                console.log(error)
            })
        }
    </script>
@endsection