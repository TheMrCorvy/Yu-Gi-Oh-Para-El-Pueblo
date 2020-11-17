<div class="row">

    @if ($compras->count() < 1)
    <div class="col-lg-12 mb-8">
      <div class="col-lg-6 mx-auto">
        <div class="card card-plain">
            <div class="progress-wrapper">
                <div class="progress-info">
                  <div class="progress-label">
                    <p class="">Aún no compraste nada.</p>
                  </div>
                </div>
                <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                </div>
              </div>
          </div>
      </div>
    </div>
    @endif

    @foreach ($compras as $compra)
      <div class="col-lg-6 mx-auto mt-5">
        <div class="card bg-secondary container">
            <div class="card-header bg-white row d-flex justify-content-between">
              
              <h6 class="card-title text-primary mt-3 col-lg-6">Número de Orden: {{ $compra->id }}</h6>

              <h6 class="card-title text-primary mt-3 text-right col-lg-6">Fecha: {{ $compra->fecha }} <br><small class="text-muted">(Año-Mes-Día)</small></h6>
            </div>

            <div class="card-body">
              <p class="">Mandános un <strong class="text-success">WhatsApp a 011 3771-9677</strong> para coordinar la entrega/envío, o también podés contactarnos por <strong class="text-primary">email a info@yugiohparaelpueblo.com</strong>.</p>
              <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
              </div>
              <td>Forma de Pago: {{ $compra->forma_de_pago }}</td>
              <br>
              <br>
              @if ($compra->envio)
                <p>Forma de Entrega: Envío (Coordinar con el vendedor).</p>
              @else
                <p>Forma de Entrega: Retiro en el local.</p>
              @endif
              <p class="mt-3">Monto Total de la Compra: <strong>$ {{ $compra->monto_total }}</strong>.</p>

              @if (isset($compra->agregar_dinero_envio))
                  <a href="{{ $compra->agregar_dinero_envio }}" class="btn btn-primary mt-3">Agregar Dinero</a>
              @endif
            </div>

            <div class="card-footer bg-secondary" id="detalle{{ $compra->id }}">
              <a href="#" id="{{ $compra->id }}" class="btn btn-link float-right addAjax detalles">
                Ver Detalle
                <i class="fas fa-chevron-right"></i>
              </a>
            </div>
        </div>
      </div>
    @endforeach 
  </div>
