@extends('layouts.app', ['class' => 'pricing-page bg-secondary'])

@section('content')
{{dd($ordenAsociada)}}
    <style>
        .boton-hover-pedido:hover{
            cursor: pointer;
            text-decoration: underline;
        }
    </style>
    <div class="main">
        <div class="my-5">
            <div class="container-fluid">
                <form class="row" id="formulario" method="post" action="{{route('admin.review-pakage', $paquete->id)}}">
                    @csrf
                    <div class="col-lg-8 mx-auto text-center my-5">
                        <h3 class="display-3 pt-4">Detalles del Paquete</h3>
                        <small class="description">Estado actual del Paquete: <span class="text-success" id="estado-paquete">{{$paquete->estado}}</span></small>
                        <br>

                        <div class="form-group mt-3">
                            <label for="comentar-paquete">Dejar un comentario al paquete:</label>
                            <textarea 
                                class="form-control form-control-alternative" 
                                id="comentar-paquete" 
                                rows="3"
                                name="comentarioAlPaquete"
                            >{{$paquete->comentario_al_paquete}}</textarea>
                            <small class="description float-right" id="desc-comentario">0/190</small>
                            @error('comentarioAlPaquete')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        @if (Session::has('message'))    
                        <div class="alert alert-danger mt-4" role="alert">
                            <strong>{{Session::get('message')}}</strong>
                        </div>
                    @endif

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
                                    <input type="hidden" name="carta-{{$cartaPedida->id}}[]" value="{{$cartaPedida->id}}">   
                                    <tr id="fila-carta-{{$cartaPedida->id}}">
                                        <td class="text-left text-capitalize">{{$cartaPedida->nombre_carta}}</td>
                                        
                                        @if ($cartaPedida->expansion)
                                            <td class="text-left text-capitalize">{{$cartaPedida->expansion}}</td>
                                        @else
                                            <td class="text-left text-capitalize text-success">El precio más barato.</td>
                                        @endif

                                        <td class="row justify-content-center">
                                            <div class="col-lg-1 pt-3">
                                                $
                                            </div>
                                            <input 
                                                type="number" 
                                                class="form-control form-control-alternative col-lg-9" 
                                                placeholder="Precio unitario en Pesos"
                                                name="carta-{{$cartaPedida->id}}[]"
                                                value="{{$cartaPedida->precio}}"
                                            >
                                        </td>

                                        <td class="text-center">

                                            <input 
                                                type="number" 
                                                name="carta-{{$cartaPedida->id}}[]"
                                                id="cantidad-{{$cartaPedida->id}}"
                                                value="{{$cartaPedida->cantidad}}"
                                                class="d-none"
                                            >

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
                                        </td>

                                        <td>
                                            <input 
                                                type="text" 
                                                class="form-control form-control-alternative" 
                                                placeholder="Comentario" 
                                                value="{{$cartaPedida->comentario}}"
                                                name="carta-{{$cartaPedida->id}}[]"
                                            >
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                
                    <div class="col-lg-12 pr-0 row justify-content-end mt-5">
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
                        <div class="col-lg-2 pr-0 form-group">
                            <p>
                                <strong class="text-capitalize">
                                    precio válido hasta:
                                </strong>
                            </p>
                            @if (!is_null($paquete->fecha_caducidad_precio))
                                <input 
                                    class="form-control form-control-alternative" 
                                    type="date" 
                                    value="{{$paquete->fecha_caducidad_precio->format('Y-m-d')}}" 
                                    id="fechaCaducudadPrecio"
                                    name="fechaCaducudadPrecio"
                                >
                            @else
                                <input 
                                    class="form-control form-control-alternative" 
                                    type="date" 
                                    id="fechaCaducudadPrecio"
                                    name="fechaCaducudadPrecio"
                                >
                            @endif
                            @error('fechaCaducudadPrecio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-2 text-right pt-4 mt-3">
                            <input 
                                type="submit" 
                                value="guardar cambios" 
                                class="btn btn-warning"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Este proceso puede demorar unos segundos"
                            >
                        </div>
                    </div>
              
                </form>
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

        const textArea = document.getElementById('comentar-paquete')

        let descComentario = document.getElementById('desc-comentario')

        const formulario = document.getElementById('formulario')

        textArea.addEventListener('keyup', e => 
        {
            if (e.target.value.length > 190) 
            {
                descComentario.classList.add('text-danger')
            }else
            {
                descComentario.classList.remove('text-danger')
            }

            descComentario.innerText = e.target.value.length + '/190'
        })

        formulario.addEventListener('submit', e => {
            e.preventDefault()

            document.getElementById('alert').classList.add('show')

            formulario.submit()
        })

        function modificarCantidad(e)
        {
            e.preventDefault()

            let cardId = e.target.getAttribute('card-id')

            let action = e.target.getAttribute('action')

            let cantidad = document.getElementById('cantidad-' + cardId)

            let show = document.getElementById('carta-id-' + cardId)

            if (action === 'sumar') 
            {
                cantidad.value = Number(cantidad.value) + 1
            } else if(cantidad.value > 0)
            {
                cantidad.value = Number(cantidad.value) - 1
            }

            show.innerText = cantidad.value
        }
    </script>
@endsection