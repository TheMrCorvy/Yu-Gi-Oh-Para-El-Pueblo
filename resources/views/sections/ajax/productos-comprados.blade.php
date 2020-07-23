@foreach ($productos as $producto)
    <p class="">
        <strong><a href="{{ route('Producto', $producto->id_producto) }}" class="card-link"><u>{{ $producto->producto }}</u></a></strong> X <strong>{{ $producto->unidades_compradas }} Unidad/es</strong>. <br> 
        Precio: <strong>$ {{ $producto->precio_unidad }}</strong> X unidad.
    </p>
    <br>
@endforeach