<h5 class="title text-left col-lg-12 text-primary">
    Costos de los Envíos
</h5>
@foreach ($enviosCacheados as $envios)
    <div class="col-lg-12">
        <h6 class="text-center mt-3">{{$envios[0]->metodo}}</h6>
        <ul class="text-left pl-3">
            @foreach ($envios as $envio)
                <li>
                    <p>
                        {{$envio->zona}}, <span class="text-success">$ {{$envio->precio}}</span>.
                        <br>
                        Tiempo Estimado de Entrega: <span class="text-warning">{{$envio->tiempo_previsto}}</span>.
                    </p>
                </li>
            @endforeach
        </ul>
    </div>
@endforeach