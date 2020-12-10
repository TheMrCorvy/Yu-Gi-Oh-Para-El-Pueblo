@extends('layouts.app', ['class' => 'pricing-page'])

@section('content')
    <div class="main">
        <div class="my-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center my-5">
                        <h3 class="display-3 pt-4">Detalle de la Venta</h3>
                        {{-- <p class="lead">Los productos que compró están detallados abajo. </p> --}}
                    </div>
                    
                    <div class="col-lg-12 row d-flex justify-content-center">
                        <table class="table table-striped w-100">
                            <thead>
                                <tr>
                                    <th class="text-center">ID Producto</th>
                                    <th class="text-center">Producto</th>
                                    <th>Cantidad Comprada</th>
                                    <th class="text-right">Precio Unitario</th>
                                    <th class="text-right">SubTotal por producto</th>
                                    <th class="text-center">Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($compras as $compra)    
                                    <tr>
                                        <td class="text-center">{{ $compra->id_producto }}</td>
                                        <td><a href="{{ route('Producto', $compra->id_producto) }}">{{ $compra->producto }}</a></td>
                                        <td class="text-center">{{ $compra->unidades_compradas }}</td>
                                        <td class="text-center">${{ $compra->precio_unidad }}</td>
                                        <td class="text-center">${{ $compra->precio_unidad * $compra->unidades_compradas }}</td>
                                        <td class="text-right"><a href="/producto/{{ $compra->id_producto }}/editar">Editar Producto</a></td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>

                    
                
                <div class="col-lg-12 mt-5 d-flex justify-content-end">
                    <p class="mr-8">
                        <strong>
                            Fecha: {{ $ordenDeCompra->fecha->format('d/m/Y') }}
                        </strong> 
                        <br>
                        <small class="text-muted">
                            (Día/Mes/Año)
                        </small>
                    </p>
                    <p>
                        <strong>Monto Total: $ {{ $ordenDeCompra->monto_total }}.</strong>
                    </p>
                </div>      
                <div class="col-lg-12 d-flex justify-content-end">
                    <small class="text-muted">
                        Es posible que el monto total y la suma de los precios no coincida. Esto puede ser por que el usuario consumió un cupón de descuento.
                    </small>
                </div>   
                <div class="col-lg-12 d-flex justify-content-end pt-2">
                    <small class="text-muted">Éstos números muestran a qué precio compraron los usuarios. Si se actualiza el valor del dolar, estos precios no cambiarán.</small>
                </div> 

                <div class="col-lg-12 text-center">
                    <a href="#" class="btn mt-4 btn-warning" id="back">VOLVER</a>
                </div>

                @if (isset($ordenDeCompra->agregar_dinero_envio))
                <div class="col-lg-12 text-center mt-4">
                    <h6 class="h6 title text-warning">A ésta compra ya se le agregó un botón de "Agregar Dinero", podés cambiarlo las veces que quieras agregando otro.</h6>
                </div>
                @endif

                <div class="col-lg-12 text-center mt-4">
                    <form action="{{ route('Agregar Dinero', $ordenDeCompra->id) }}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="boton" class="form-control">
                            <div class="input-group-append">
                              <button class="btn btn-success" type="submit">agregar dinero</button>
                            </div>
                        </div>
                    </form>
                </div>

                @if ($ordenDeCompra->envio !== 'Retiro en el Local')
                    <div class="col-lg-8 mx-auto text-center mt-5 mb-3">
                        <h3 class="display-3 pt-4">Detalles para el Envío</h3>
                        <small class="lead">Método de Envío: {{$ordenDeCompra->metodo_envio}} </small>
                    </div>
                    
                    <div class="col-lg-12 row d-flex justify-content-center">
                        <table class="table table-responsive">
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
                                    <td class="text-capitalize">{{ $detallesUsuario->name }}</td>
                                    <td class="text-capitalize">{{ $detallesUsuario->calle1_timbre }}</td>
                                    <td class="text-capitalize">{{ $detallesUsuario->calle2 }}</td>
                                    <td class="text-capitalize">{{ $detallesUsuario->altura_domicilio }}</td>
                                    <td class="text-capitalize">{{ $detallesUsuario->barrio }}</td>
                                    <td class="text-capitalize">{{ $detallesUsuario->ciudad }}</td>
                                    <td class="text-capitalize">{{ $detallesUsuario->localidad }}</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="col-lg-8 mx-auto text-center mt-5">
                        <h6 class="display-3 pt-4">Retirará el pedido en el Local</h6>
                    </div>
                @endif
                
                <div class="col-lg-8 mx-auto text-center my-5">
                    <h3 class="display-3 pt-4">Detalles de Facturación</h3>
                </div>

                <div class="col-lg-12 card card-plain" style="margin-top: -50px !important;">
                    <div class="card-body">
                        <p class="lead">
                            <strong class="text-capitalize">
                                {{ $ordenDeCompra->nombre }}
                            </strong>
                            - DNI o CUIL 
                            <strong class="text-capitalize">
                                {{ $ordenDeCompra->dni }}
                            </strong>
                        </p>
                        <p class="lead">
                            <strong class="text-capitalize">
                                {{ $ordenDeCompra->calle }}, 
                            </strong>
                            <strong class="text-capitalize">
                                {{ $ordenDeCompra->altura }}
                            </strong> - Código Postal: 
                            <strong>
                                {{ $ordenDeCompra->codigo_postal }}, 
                            </strong>
                            <strong class="text-capitalize">
                                {{ $ordenDeCompra->ciudad }}, 
                            </strong>
                            <strong class="text-capitalize">
                                {{ $ordenDeCompra->provincia }}
                            </strong>
                        </p>
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
    </script>
@endsection