<div class="col-lg-12 px-0">
    <div class="card">
        <div class="card-body pb-0 table-responsive">
            <h3 class="text-left pb-3">Paquetes listos para importar</h3>
            <p class="">
                Desde acá se puede notificar a los usuarios cuando ya hayas hecho el pedido de importación.
            </p>
            @if ($paquetesParaImportar->count() < 1)
                <table class="table table-striped px-0">
            @else
                <table class="table table-striped px-0">
            @endif
                <thead>
                    <tr>
                        <th >Fecha (DD/MM/AAAA)</th>
                        <th>Número de Pedido</th>
                        <th class="text-center">Ver Detalle</th>
                        <th class="text-center">Notificar Pedido Realizado</th>
                        <th>Forma de Pago</th>
                        <th class="text-center">Seña Pagada</th>
                        <th class="text-center">Precio y Método de envio <br> <span class="text-muted">(Si lo hay)</span></th>
                        <th class="text-right">Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($paquetesParaImportar->count() < 1)
                        <tr>
                            <td>No hay ningún paquete para mostrar.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($paquetesParaImportar as $paquete)    
                            <tr>
                                <td class="text-center">{{ $paquete->created_at->format('d/m/Y') }}</td>
                                
                                <td class="text-center">{{ $paquete->id }}</td>
                                
                                <td class="text-center">
                                    <a href="{{route('admin.list-pakage-details', $paquete->id)}}">Ver Detalle del Paquete</a>
                                </td>
                                
                                <td class="text-capitalize">
                                    <a href="{{route('admin.notify', $paquete->id)}}" class="btn btn-outline-success">
                                        notificar
                                    </a>
                                </td>

                                <td class="text-success">
                                    {{$paquete->forma_de_pago}}
                                </td>

                                <td class="text-center">
                                    $ {{$paquete->monto_total}}
                                </td>

                                <td class="text-info text-center">
                                    @if ($paquete->envio)
                                        {{$paquete->metodo_envio}}, $ {{$paquete->precio_envio}}
                                    @else
                                        No solicitó envío
                                    @endif
                                </td>

                                @if (!is_null($paquete->comentario_al_paquete))
                                    <td class="text-right">{{ $paquete->comentario_al_paquete }}</td>
                                @else
                                    <td class="text-right">No hay ningún comentario en este paquete</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body table-responsive pb-0">
            <h3 class="text-right pb-3">Paquetes en camino</h3>
            <p class="">
                Desde acá se puede notificar a los usuarios cuando haya algún cambio en el seguimiento del envío.
            </p>
            <table class="table table-striped px-0">
                <thead>
                    <tr>
                        <th >Fecha (DD/MM/AAAA)</th>
                        <th>Número de Pedido</th>
                        <th class="text-center">Ver Detalle</th>
                        <th class="text-center">Seguimiento del Envío</th>
                        <th class="text-right">Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($paquetesImportandose->count() < 1)
                        <tr>
                            <td>No hay ningún paquete para mostrar.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($paquetesImportandose as $paquete)    
                            <tr>
                                <td class="text-center">{{ $paquete->created_at->format('d/m/Y') }}</td>
                                
                                <td class="text-center">{{ $paquete->id }}</td>
                                
                                <td class="text-center">
                                    <a href="{{route('admin.list-pakage-details', $paquete->id)}}">Ver Detalle del Paquete</a>
                                </td>
                                
                                <td>
                                    <form action="{{route('admin.notify-shipment')}}" method="post">
                                        <div class="form-group">
                                            <label>
                                                <small>{{$paquete->seguimiento_envio}}</small>
                                            </label>
                                            <select class="form-control form-control-sm" name="seguimiento-envio">
                                                <option value="0">El Paquete ya fue pedido</option>
                                                <option value="1">El Paquete ya fue despachado de EEUU</option>
                                                <option value="2">El paquete ya ingresó a Argentina</option>
                                                <option value="3">El paquete ya está listo para la entrega</option>
                                            </select>
                                        </div>
    
                                        <input type="hidden" name="id-paquete" value="{{$paquete->id}}">
    
                                        <input type="submit" value="Notificar" class="btn btn-outline-primary btn-sm">
                                    </form>
                                </td>

                                @if (!is_null($paquete->comentario_al_paquete))
                                    <td class="text-right">{{ $paquete->comentario_al_paquete }}</td>
                                @else
                                    <td class="text-right">No hay ningún comentario en este paquete</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-body table-responsive pb-0">
            <h3 class="text-center pb-3">Paquetes en el local</h3>
            <p class="">
                En esta tabla se muestran solo aquellos paquetes que ya llegaron, y que el usuario <strong>aún no pagó</strong> el precio final.
            </p>
            <table class="table table-striped px-0">
                <thead>
                    <tr>
                        <th >Fecha (DD/MM/AAAA)</th>
                        <th>Número de Pedido</th>
                        <th class="text-center">Ver Detalle</th>
                        <th class="text-right">Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($paquetesPendientesDePagoFinal->count() < 1)
                        <tr>
                            <td>No hay ningún paquete para mostrar.</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @else
                        @foreach ($paquetesPendientesDePagoFinal as $paquete)    
                            <tr>
                                <td class="text-center">{{ $paquete->created_at->format('d/m/Y') }}</td>
                                
                                <td class="text-center">{{ $paquete->id }}</td>
                                
                                <td class="text-center">
                                    <a href="{{route('admin.list-pakage-details', $paquete->id)}}">Ver Detalle del Paquete</a>
                                </td>

                                @if (!is_null($paquete->comentario_al_paquete))
                                    <td class="text-right">{{ $paquete->comentario_al_paquete }}</td>
                                @else
                                    <td class="text-right">No hay ningún comentario en este paquete</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
</div>