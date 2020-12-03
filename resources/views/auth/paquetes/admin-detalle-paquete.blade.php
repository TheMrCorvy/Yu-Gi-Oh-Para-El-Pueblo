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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center my-5">
                        <h3 class="display-3 pt-4">Detalles del Paquete</h3>
                        <small class="description">Estado actual del Paquete: <span class="text-success" id="estado-paquete">{{$paquete->estado}}</span></small>
                        <br>

                        <form class="form-group mt-3">
                            <label for="comentar-paquete">Dejar un comentario al paquete:</label>
                            <textarea class="form-control" id="comentar-paquete" rows="3">{{$paquete->comentario_al_paquete}}</textarea>

                            <input type="submit" value="Guardar Comentario" class="btn btn-outline-primary mt-2 btn-sm">
                        </form>

                        @if ($paquete->estado === "Abierto")
                            <form method="post" action="{{route('Pedir Presupuesto')}}" class="col-lg-12 text-center mt-4">
                                @csrf
                                <input type="hidden" name="id-paquete" value="{{$paquete->id}}">
                                <button class="btn btn-outline-success btn-action-pedido">
                                    Pedir presupuesto
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="col-lg-12 text-center">
                        <a href="#" class="btn mb-4 btn-warning btn-sm" id="back">VOLVER</a>
                    </div>

                    <div class="col-lg-12 text-center">
                        <p class="text-danger d-none" id="errors">
                            
                        </p>
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
                                    <tr id="fila-carta-{{$cartaPedida->id}}">
                                        <td class="text-left text-capitalize">{{$cartaPedida->nombre_carta}}</td>
                                        
                                        @if ($cartaPedida->expansion)
                                            <td class="text-left text-capitalize">{{$cartaPedida->expansion}}</td>
                                        @else
                                            <td class="text-left text-capitalize text-success">El precio más barato.</td>
                                        @endif

                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Precio unitario en Pesos">
                                                <div 
                                                    class="input-group-append"
                                                    data-toggle="tooltip" 
                                                    data-placement="top" 
                                                    title="Guardar Precio"
                                                >
                                                    <button class="btn btn-outline-success btn-sm" type="button" id="button-addon2">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <span id="carta-id-{{$cartaPedida->id}}" class="mr-3">
                                                {{$cartaPedida->cantidad}}
                                            </span>
                                            <button 
                                                class="btn btn-icon-only btn-action-pedido btn-outline-danger"
                                                data-toggle="tooltip" 
                                                data-placement="right" 
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
                                        </td>

                                        <td>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="Comentario" value="{{$cartaPedida->comentario}}">
                                                <div class="input-group-append">
                                                    <button 
                                                        class="btn btn-outline-success btn-sm" 
                                                        type="button" 
                                                        id="button-addon2"
                                                        data-toggle="tooltip" 
                                                        data-placement="top" 
                                                        title="Guardar Comentario"
                                                    >
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                
                    <div class="col-lg-12 row justify-content-center mt-5">
                        <div class="col-lg-2 pr-0 text-center">
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
                        <div class="col-lg-2 pr-0 text-center">
                            <p>
                                @if ($pagoInicial > 0)
                                    <strong>
                                        Seña a Pagar: $ {{$pagoInicial}}
                                    </strong>
                                @else
                                    <strong>
                                        Seña a Pagar: <small class="text-warning">Aún no disponible.</small>
                                    </strong>
                                @endif
                            </p>
                        </div>
                        <div class="col-lg-2 ml-0 form-group">
                            <p>
                                <strong class="text-capitalize">
                                    precio válido hasta:
                                </strong>
                            </p>
                            <input class="form-control" type="date" value="{{$paquete->fecha_caducidad_precio}}" id="fecha-caducidad-precio">
                            <button class="btn btn-sm btn-outline-success mt-2 float-right">guardar</button>
                        </div>
                        <div class="col-lg-3 text-right ">
                            <button class="btn btn-warning">marcar como revisado</button>
                        </div>
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