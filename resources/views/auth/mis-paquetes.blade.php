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

        <div class="section section-item" style="z-index: 12 !important;">
            <div class="container" id="misCompras">
                <div class="row">

                    @if ($paquetes->count() < 1)
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
                                    <button class="btn btn-outline-success"  data-toggle="modal" data-target="#bd-example-modal-xl">armar un pedido</button>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12">
                            <div class="col-lg-6 mx-auto mt-5">
                                <button class="btn btn-outline-success btn-block"  data-toggle="modal" data-target="#bd-example-modal-xl">agregar cartas a un pedido abierto</button>
                            </div>
                        </div>

                        @foreach ($paquetes as $paquete)
                            <div class="col-lg-6 mx-auto mt-5">
                                <div class="card bg-secondary container">
                                    <div class="card-header bg-white row d-flex justify-content-between">
                                        <h6 class="card-title text-primary mt-3 col-lg-6">Número de Paquete: {{$paquete->id}}</h6>
                                        <h6 class="card-title text-primary mt-3 text-right col-lg-6">
                                            @if ($paquete->fecha_caducidad_precio)
                                                Fecha: {{$paquete->fecha_caducidad_precio->format('d/m/y')}}
                                                <br><small class="text-muted">(Día/Mes/Año)</small>
                                            @else
                                                Fecha: 
                                                <small class="text-warning">
                                                    Aún no disponible
                                                </small>
                                            @endif
                                        </h6>
                                    </div>

                                    <div class="card-body">
                                        <p class="">
                                            Mandános un <strong class="text-success">WhatsApp a 011 3771-9677</strong> para coordinar la entrega/envío, o también podés contactarnos por <span class="text-primary">email a <u>info@yugiohparaelpueblo.com</u></span>
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
                                        <td>Estado: <span class="text-success">{{$paquete->estado}}</span></td>
                                        <br>
                                        <td><small>Todavía puedes añadir o quitar cartas, o modificar sus cantidades</small></td>
                                        <br>
                                        <br>
                                        <p>Forma de Entrega: <span class="text-danger">Elegir después de pagar la seña</span>.</p>
                                    </div>

                                    <div class="card-footer bg-secondary">
                                        <a href="{{route('Administrar Paquete', $paquete->id)}}" class="btn btn-link float-right addAjax detalles">
                                            ver detalles y Administrar Paquete
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif
                    
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

    <div class="modal fade bd-example-modal-xl" id="bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
                                Expansión/Rareza (opcional, si no se especifica se usará el precio más barato)
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
                    <button type="button" class="btn btn-primary" onclick="comenzarPedido()">comenzar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-xl" id="modal-pedido" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Sumar Cartas a un Pedido Abierto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-secondary">
                    <div class="card card-plain">
                        <div class="carb-body container">
                            <div class="row justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="nombre">Nombre de la Carta</label>
                                        <input 
                                            type="text" 
                                            class="form-control form-control-alternative text-capitalize" 
                                            placeholder="Obligatorio"
                                            id="nombre"
                                        >
                                        <label class="text-danger error-message d-none"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="expansion">Expansión/Rareza Buscada</label>
                                        <input 
                                            type="text" 
                                            class="form-control form-control-alternative text-capitalize" 
                                            placeholder="Opcional"
                                            id="expansion"
                                        >
                                        <label class="text-danger error-message d-none"></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad deseada</label>
                                        <input 
                                            type="number" 
                                            class="form-control form-control-alternative is-invalid" 
                                            placeholder="Obligatorio"
                                            id="cantidad"
                                        >
                                        <label class="text-danger error-message d-none"></label>
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center">
                                    <button class="btn btn-warning" onclick="sumarAlPaquete(event)">sumar al paquete</button>
                                    <br>
                                    <div class="spinner-border text-primary mt-3 d-none" id="spinner" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <div class="col-lg-12 error-message mt-3 d-none">
                                    <div class="alert alert-danger" role="alert" id="alerta-error">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <ol id="lista-paquete">
                                
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="description mt-5">
                        Las cartas que añadas se sumarán a un paquete que tengas con estado "Abierto". En caso de no haber ninguno, se creará uno nuevo.
                    </p>
                    <p class="description">
                        Cada vez que sumes alguna carta tu paquete con estado "Abierto", tendrás que volver a enviarlo a revisión para que se actualice el precio.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">regresar</button>
                    <button type="button" class="btn btn-primary" onclick="location.reload()">sumar al pedido</button>
                </div>
            </div>
        </div>
    </div>

<script>
    const nombre = document.getElementById('nombre')
    const expansion = document.getElementById('expansion')
    const cantidad = document.getElementById('cantidad')
    const username = '{{Auth::user()->username}}'

    async function GetRecomendaciones() {
        await fetch('/api/v1/APIPage/GetRecomendaciones', {
            headers: {
                    'Content-Type': 'application/json',
                },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.text())
        .then(response => {
            document.getElementById('getRecomendaciones').innerHTML = response
        })
    }

    window.addEventListener('load', async () => {

        await Promise.all([
            GetRecomendaciones(),
        ])
    })//window

    function comenzarPedido()
    {
        $("#bd-example-modal-xl").modal("hide")
        $("#modal-pedido").modal("show")
    }

    async function sumarAlPaquete(e)
    {
        e.target.setAttribute('disabled', '')

        document.getElementById('spinner').classList.remove('d-none')

        let pedido = {
            username,
            nombre: nombre.value,
            expansion: expansion.value,
            cantidad: cantidad.value
        }

        eliminarMensajesDeError()

        nombre.value = ''
        expansion.value = ''
        cantidad.value = ''

        await fetch("/api/v1/ApiPage/addToPakage", {
            headers: {
                "Content-Type": "application/json",
            },
            method: "post",
            body: JSON.stringify(pedido)
        })
        .then((jsonResponse) => jsonResponse.json())
        .then((response) => {

            e.target.removeAttribute('disabled', '')

            document.getElementById('spinner').classList.add('d-none')

            if (response.errors) 
            {
                if (response.errors.nombre) 
                {
                    nombre.parentNode.lastElementChild.innerText = response.errors.nombre[0]

                    nombre.parentNode.lastElementChild.classList.remove('d-none')
                }
                if (response.errors.expansion) 
                {
                    expansion.parentNode.lastElementChild.innerText = response.errors.expansion[0]

                    expansion.parentNode.lastElementChild.classList.remove('d-none')
                }
                if (response.errors.cantidad) 
                {
                    cantidad.parentNode.lastElementChild.innerText = response.errors.cantidad[0]

                    cantidad.parentNode.lastElementChild.classList.remove('d-none')
                }
            }else if (response.err) 
            {
                document.getElementById('alerta-error').innerText = response.err

                document.getElementById('alerta-error').parentNode.classList.remove('d-none')
            }else
            {
                document.getElementById('lista-paquete').innerHTML += 
                `
                <li class="container">
                    <p class="description">
                        <strong>
                            <span class="text-capitalize text-primary">${pedido.nombre}</span>,
                            ${pedido.expansion ? `<span class="text-capitalize text-success">${pedido.expansion}</span>, ` : ``}
                            <span class="text-warning">x${pedido.cantidad}</span>.
                        </strong>
                    </p>
                </li>
                `
            }
        })
        .catch((error) => console.log(error));
    }

    function eliminarMensajesDeError()
    {
        document.querySelectorAll('.error-message').forEach(errorMessage => {
            errorMessage.classList.add('d-none')
        });
    }
</script>

@endsection