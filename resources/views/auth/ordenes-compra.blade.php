@extends('layouts.app', ['class' => 'product-page'])

@section('content')

    <div class="wraper">

      <div class="page-header page-header-small skew-separator skew-mini">
            
        <div class="page-header-image bg-gradient-primary"></div>
        
        <div class="container">
          <div class="row">
            <div class="col-lg-9 col-md-7 mr-auto text-left">
              <h1 class="title text-white text-capitalize">ordenes de compra</h1>
            </div>
          </div>
        </div>

      </div>

      <div class="section section-item" style="z-index: 12 !important;">
        <div class="container">
          <div class="row" style="min-height: 100vh !important">
            <div class="col-lg-12 mt-5 text-center">
              <a href="{{ route('admin.excel-ventas') }}" class="btn btn-outline-success">Exportar todo el historial de ventas en un archivo excel</a>
            </div>

            <div class="col-lg-12 col-md-12 mb-8 row d-flex justify-content-center">
                <table class="table mx-7 table-striped">
                    <thead>
                        <tr>
                            <th >Fecha (AAAA-MM-DD)</th>
                            <th>Número de Venta</th>
                            <th>Nombre de Usuario</th>
                            <th>Forma de Pago</th>
                            <th>Forma de Entrega</th>
                            <th>Monto de la Venta</th>
                            <th class="text-right">Ver Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($ordenes->count() < 1)
                          <tr>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td>Aún no hay ninguna orden de compra.</td>
                              <td></td>
                              <td></td>
                              <td></td>
                          </tr>
                        @else
                          @foreach ($ordenes as $orden)    
                            <tr>
                                <td class="text-center">{{ $orden->fecha->format('d/m/Y') }}</td>
                                <td class="text-center">{{ $orden->id }}</td>
                                <td class="text-center"><a href="/admin/detalle-venta/{{ $orden->username }}/{{ $orden->id }}">{{ $orden->username }}</a></td>
                                <td>{{ $orden->forma_de_pago }}</td>
                                @if ($orden->envio)
                                    <td>Solicitó Envío</td>
                                @else
                                    <td>Retirará en el Local</td>
                                @endif
                                <td class="text-center">${{ $orden->monto_total }}</td>
                                <td class="text-right"><a href="/admin/detalle-venta/{{ $orden->username }}/{{ $orden->id }}">Ver Detalle</a></td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="pagination-container justify-content-center">
                  {{ $ordenes->links() }}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection