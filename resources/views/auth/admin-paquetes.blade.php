@extends('layouts.app', ['class' => 'product-page'])

@section('content')
    <div class="wraper">
        <div class="page-header page-header-small skew-separator skew-mini">
            <div class="page-header-image bg-gradient-primary"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 col-md-7 mr-auto text-left">
                            <h1 class="title text-white">Pedidos de Importación del Exterior</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section section-item" style="z-index: 12 !important;">
                <div class="container-fluid">
                    <div class="row justify-content-center" style="min-height: 100vh !important">
                        <div class="col-lg-12 col-md-12 mb-5 row d-flex justify-content-center">
                            <table class="table table-responsive px-5">
                                <thead>
                                    <tr>
                                        <th >Fecha (DD/MM/AAAA)</th>
                                        <th>Número de Pedido</th>
                                        <th class="text-center">Ver Detalle</th>
                                        <th class="text-center">Estado</th>
                                        <th>Fecha límite del presupuesto (si la hay)</th>
                                        <th class="text-center">Comentario</th>
                                        <th class="text-right">Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$paquetes->count() < 1)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>No hay ningún pedido de importación de cartas actualmente.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @else
                                        @foreach ($paquetes as $paquete)    
                                            <tr>
                                                <td class="text-center">{{ $paquete->created_at->format('d/m/Y') }}</td>
                                                
                                                <td class="text-center">{{ $paquete->id }}</td>
                                                
                                                <td class="text-center">
                                                    <a href="{{route('admin.list-pakage-details', $paquete->id)}}">Ver Detalle del Paquete</a>
                                                </td>
                                                
                                                <td class="text-capitalize">{{ $paquete->estado }}</td>

                                                @if (!is_null($paquete->fecha_caducidad_precio))
                                                    <td class="text-center">{{ $paquete->fecha_caducidad_precio->format('d/m/Y') }}</td>
                                                @else
                                                    <td class="text-center">Aún no hay presupuesto</td>
                                                @endif
                                                
                                                @if (!is_null($paquete->comentario_al_paquete))
                                                    <td>{{ $paquete->comentario_al_paquete }}</td>
                                                @else
                                                    <td>No hay ningún comentario en este paquete</td>
                                                @endif

                                                <td class="text-right">
                                                    <a href="{{route('admin.list-pakage-details', $paquete->id)}}">{{$paquete->username}}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                            <div class="pagination-container justify-content-center">
                                {{ $paquetes->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection