<form class="js-validate" method="POST" action="{{ route('Paso Dos') }}">
  @csrf
  @php
      $usuario = Session::get('usuario');
  @endphp
  <input type="hidden" name="ordenCompra" value="{{ Session::get('ordenCompra') }}">

  <div class="container">
    <h3 class="title h4 mt-3 col-lg-12 text-center">Paso 2</h3>
    <h5 class="title mt-3">Datos Para El Envío</h5>
    
    <div class="row justify-content-between">
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
