<div class="modal fade shoppingCartModal" id="shoppingCartModal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title text-capitalize" id="exampleModalScrollableTitle">carrito de compras</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
        @php
        $productos = Cart::session(auth()->id())->getContent();
        @endphp
        @if ($productos->count() >= 1)
            
            @foreach ($productos as $item)
                <div class="card bg-gradient-default col-lg-12">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-lg-2 mb-1">
                            <!-- Avatar -->
                                <a href="{{ route('Producto', $item->id) }}" >
                                    <img alt="{{ $item->attributes[0] }}" class="avatar avatar-xl rounded-circle" src="{{ $item->attributes[0] }}">
                                </a>
                            </div>
                            <div class="col-lg-3 ml--2 px-o">
                                <a href="{{ route('Producto', $item->id) }}" class="card-link text-danger"><u>{{ \Illuminate\Support\Str::limit($item->name, 30, '...') }}</u></a>
                                <br>
                                <small class="text-sm text-info mb-0">X {{ $item->quantity }} Unidad/es</small>
                                <br>
                                <span class="text-success">●</span>
                                <small class="text-success">Subtotal: ${{ Cart::session(auth()->id())->get($item->id)->getPriceSum() }}</small>
                            </div>
                            <div class="col-lg-5 px-0">
                                <form action="{{ route('Actualizar Carrito', $item->id) }}" method="post">
                                    @csrf
                                    <div class="input-group my-3">
                                        <input type="number" class="form-control" value="{{ $item->quantity }}" name="Actualizar{{ $item->id }}">
                                        <div class="input-group-append">
                                        <input type="submit" class="btn btn-outline-warning add" type="button" value="Guardar"></input>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-2 px-0 text-right">
                                <a href="{{ route('Quitar Del Carrito', $item->id) }}" class="btn btn-sm btn-danger add delete">Quitar Producto</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="card bg-gradient-primary col-lg-5 mx-auto">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row" style="position: relative;">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0 text-white">Total:</h5>
                            <span class="h5 font-weight-bold mb-0 text-white">${{ Cart::session(auth()->id())->getTotal() }}</span>
                        </div>
                        <div class="float-right">
                            <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                                <i class="ni ni-money-coins text-info"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-sm">
                        <span class="text-light mr-2"><i class="fas fa-info-circle text-white"></i> Podrás aplicar un cupón en el checkout al realizar la compra.</span>
                    </p>
                </div>
            </div>
        @else

        <div class="card bg-gradient-success col-lg-5 mx-auto">
            <!-- Card body -->
            <div class="card-body">
                <div class="row" style="position: relative;">
                    <div class="col">
                        <h5 class="card-title text-capitalize text-muted mb-0 text-white">tu carrito está vacío...</h5>
                    </div>
                    <div class="float-right">
                        <div class="icon icon-shape bg-white text-dark rounded-circle shadow">
                            <i class="ni ni-tag text-info"></i>
                        </div>
                    </div>
                </div>
                <p class="mt-3 mb-0 text-white text-sm">
                    ¡Aprovechá que tenemos cupones y descuentos exclusivos!
                </p>
            </div>
        </div>
            
        @endif
    </div>
    <div class="modal-footer">
        @if ($productos->count() >= 1)
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
            <a href="{{ route('Checkout') }}" type="button" class="btn btn-primary">¡Pagar Ahora!</a>
        @else
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
        @endif
    </div>
  </div>
  </div>
</div>

<script>
    window.addEventListener('load', () => {
        let remover = document.querySelectorAll('.delete')
        // console.log(remover)

        remover.forEach(removiendo => {
            removiendo.addEventListener('click', () => {
                // console.log('hola mundo')
                const modal = document.getElementById('shoppingCartModal');

                // change state like in hidden modal
                modal.classList.remove('show');
                modal.setAttribute('aria-hidden', 'true');
                modal.setAttribute('style', 'display: none');
            })
        });
    })
</script>