<div class="col-lg-12 text-center mb-4 px-0" id="zona-construccion-tablas">
    <div class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body pb-0 table-responsive">
            <h3 class="text-left pb-3">Paquetes Finalizados</h3>
            <p class="text-center">
                En esta tabla están todos aquellos paquetes cuyo estado sea "Finalizado", y que el usuario ya pagó el precio final.
            </p>
            <table class="table table-striped px-0">
                <thead>
                    <tr>
                        <th >Fecha (DD/MM/AAAA)</th>
                        <th>Número de Pedido</th>
                        <th class="text-center">Ver Detalle</th>
                        <th>Forma de Pago</th>
                        <th>Seña Pagada</th>
                        <th class="text-center">Precio y Método de envio <br> <span class="text-muted">(Si lo hay)</span></th>
                        <th class="text-center">Eliminar Pedido</th>
                        <th class="text-right">Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($paquetesFinalizados->count() < 1)
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
                        @foreach ($paquetesFinalizados as $paquete)    
                            <tr>
                                <td class="text-center">{{ $paquete->created_at->format('d/m/Y') }}</td>
                                
                                <td class="text-center">{{ $paquete->id }}</td>
                                
                                <td class="text-center">
                                    <a href="{{route('admin.list-pakage-details', $paquete->id)}}">Ver Detalle del Paquete</a>
                                </td>

                                <td class="text-success">
                                    {{$paquete->forma_de_pago}}
                                </td>

                                <td>
                                    $ {{$paquete->monto_total}}
                                </td>

                                <td class="text-info text-center">
                                    @if ($paquete->envio)
                                        {{$paquete->metodo_envio}}, $ {{$paquete->precio_envio}}
                                    @else
                                        No solicitó envío
                                    @endif
                                </td>

                                <td class="text-center">
                                    <a 
                                        href="{{route('admin.delete-pakage', $paquete->id)}}" 
                                        class="btn btn-outline-danger btn-icon-only"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="Eliminar Pedido"
                                    >
                                        <i class="fas fa-times"></i>
                                    </a>
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
            <div class="pagination-container d-flex justify-content-center">
                {{ $paquetesFinalizados->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        getTablas()
    })
    
    async function getTablas(){
        await fetch('/api/v1/APIPage/getTablasPaquetes', 
        {
            headers: 
            {
                'Content-Type': 'application/json',
            },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.text())
        .then(response => {
            document.getElementById('zona-construccion-tablas').innerHTML = response
        })
    }
</script>