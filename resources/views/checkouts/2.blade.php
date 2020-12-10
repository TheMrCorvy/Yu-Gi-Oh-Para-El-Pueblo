<form class="js-validate" method="POST" action="{{ route('Paso Dos') }}">
  @csrf
  @php
      $usuario = Session::get('usuario');
      $envios = Session::get('envios');
  @endphp
  <input type="hidden" name="ordenCompra" value="{{ Session::get('ordenCompra') }}">

  <div class="container">
    <h3 class="title h4 mt-3 col-lg-12 text-center">Paso 2</h3>
    <h5 class="title mt-3">Datos Para El Envío</h5>

    <div class="row justify-content-between">

      <div class="accordion-1" style="min-width: 100%;">
        <div class="container">
          <div class="row">
            <div class="col-md-12 ml-auto">
              <div class="accordion my-3" id="accordionExample">
                @foreach ($envios as $envio)
                  <div class="card">
                    <div class="card-header px-0" id="heading-{{$envio[0]->id_metodo}}">
                      <h5 class="mb-0">
                        @if ($envio[0]->id_metodo <= 1)
                          <button 
                              class="btn btn-link w-100 text-primary text-left" 
                              type="button" 
                              data-toggle="collapse" 
                              data-target="#collapse-{{$envio[0]->id_metodo}}" 
                              aria-expanded="true" 
                              aria-controls="collapse-{{$envio[0]->id_metodo}}"
                          >
                            {{$envio[0]->metodo}}
                            <i class="ni ni-bold-down float-right"></i>
                          </button>
                        @else
                          <button 
                              class="btn btn-link w-100 text-primary text-left collapsed" 
                              type="button" 
                              data-toggle="collapse" 
                              data-target="#collapse-{{$envio[0]->id_metodo}}" 
                              aria-expanded="false" 
                              aria-controls="collapse-{{$envio[0]->id_metodo}}"
                          >
                            {{$envio[0]->metodo}}
                            <i class="ni ni-bold-down float-right"></i>
                          </button>
                        @endif
                      </h5>
                    </div>
        
                    @if ($envio[0]->id_metodo <= 1)
                      <div id="collapse-{{$envio[0]->id_metodo}}" class="collapse show" aria-labelledby="heading-{{$envio[0]->id_metodo}}" data-parent="#accordionExample">
                    @else
                      <div id="collapse-{{$envio[0]->id_metodo}}" class="collapse" aria-labelledby="heading-{{$envio[0]->id_metodo}}" data-parent="#accordionExample">
                    @endif
                      <div class="card-body opacity-8 row justify-content-between">
                        @foreach ($envio as $zonaEnvio)
                          <div class="custom-control custom-radio mb-4 col-lg-6">
                            <input 
                              name="metodoEnvio" 
                              class="custom-control-input" 
                              id="metodo-{{$zonaEnvio->id_zona}}"
                              type="radio" 
                              value="{{$envio[0]->metodo}}, {{$zonaEnvio->zona}}"
                            >
                            <label class="custom-control-label" for="metodo-{{$zonaEnvio->id_zona}}">
                              {{$zonaEnvio->zona}}, ${{$zonaEnvio->precio}}.
                              <br>
                              Tiempo estimado: {{$zonaEnvio->tiempo_previsto}}.
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <p>
          Recuerda que si eliges la opción de retirar por sucursal de correo, la dirección que debes ingresar es la dirección de la sucursal de correo argentino en la que desees recibir tus productos.
        </p>
      </div>

      <div class="form-group col-lg-12">
        <label for="example-text-input" class="form-control-label">Calle 1 <small>(especificá departamento, piso, timbre, etc., en éste campo)</small> <span class="text-danger">*</span></label>
         <input id="calle1" name="calle1" class="form-control @error('calle1') is-invalid @enderror" type="text" placeholder="Obligatorio" required value="{{ $usuario->calle1_timbre }}">
        @error('calle1')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      
      <div class="form-group col-lg-6">
        <label for="example-text-input" class="form-control-label">Calle 2</label>
        <input id="calle2" name="calle2" class="form-control @error('calle2') is-invalid @enderror" placeholder="Opcional" type="text" value="{{ $usuario->calle2 }}">
        @error('calle2')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      
      <div class="form-group col-lg-6">
        <label for="example-text-input" class="form-control-label">Número/Altura <span class="text-danger">*</span></label>
        <input id="altura" name="altura" class="form-control @error('altura') is-invalid @enderror" type="number" placeholder="Obligatorio" required value="{{ $usuario->altura_domicilio }}">
        @error('altura')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      
      <div class="form-group col-lg-6">
        <label for="example-text-input" class="form-control-label">Barrio</label>
        <input id="barrio" name="barrio" class="form-control @error('barrio') is-invalid @enderror" placeholder="Opcional" type="text" value="{{ $usuario->barrio }}">
        @error('barrio')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      
      <div class="form-group col-lg-6">
        <label for="example-text-input" class="form-control-label">Ciudad <span class="text-danger">*</span></label>
        <input id="ciudad" name="ciudad" class="form-control @error('ciudad') is-invalid @enderror" type="text" placeholder="Obligatorio" required value="{{ $usuario->ciudad }}">
        @error('ciudad')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
      
      <div class="form-group col-lg-6">
        <label for="example-text-input" class="form-control-label">Provincia<span class="text-danger">*</span></label>
        <input id="provincia" name="provincia" class="form-control @error('provincia') is-invalid @enderror" type="text" placeholder="Obligatorio" required value="{{ $usuario->localidad }}">
        @error('provincia')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
      </div>
    </div>
    <div class="row px-3 d-flex justify-content-between align-items-center pb-3">
      <a href="{{ route('Destroy Order', Session::get('ordenCompra')) }}" id="back"><span class="fas fa-angle-left mr-2"></span> Volver A La Tienda</a>
      <input type="submit" class="btn btn-info col-lg-4 mt-3" value="continuar"></input>
    </div>
  </div>
</form>
