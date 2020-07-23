<h5 class="h5 title mt-5">Resultados</h5>
@foreach ($resultados as $resultado)
<div class="card col-lg-12 py-3 container">
    <div class="row text-center">
        <h5 class="col-lg-10 text-primary text-left">{{ $resultado->nombre }}</h5>
        <div class="col-lg-2">
            <a href="{{ route('products.show-form', $resultado->id) }}" class="btn btn-outline-success">
                editar
            </a>
        </div>
    </div>
</div>
@endforeach