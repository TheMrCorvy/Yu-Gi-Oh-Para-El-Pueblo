<form class="js-validate" method="POST", action="{{ route('Paso Uno') }}">
  @csrf
    <div class="container">
      <h3 class="title h4 mt-3 col-lg-12 text-center">Paso 1</h3>
      <h5 class="title mt-3">Datos de Facturación</h5>
      <div class="row">
        <div class="col-md-12">
          <label class="labels">
            Nombre Completo
            <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" placeholder="Obligatorio" required="">
          @error('nombre')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-6">
          <div class="js-form-message">
            <label class="labels">
              Email
            </label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="emailAddress" placeholder="Opcional" value="{{ $usuario->email }}">
            @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <div class="js-form-message">
            <label class="labels">
              Teléfono de Contacto
            </label>
            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror" placeholder="Opcional" value="{{ $usuario->num_telefono }}">
            @error('telefono')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-12">
          <label class="labels">
            DNI o CUIL
            <span class="text-danger">*</span>
          </label>
          <input type="text" name="dni" class="form-control @error('dni') is-invalid @enderror" placeholder="Obligatorio" required="">
          @error('dni')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>
      <br>
      <h5 class="title mt-3">Domicilio de Facturación</h5>
      <div class="row">
        <div class="col-md-8">
          <div class="js-form-message">
            <label class="labels">
              Calle 
              <span class="text-danger">*</span>
              <small>(especificá departamento, piso, timbre, etc., en éste campo)</small>
            </label>
            <input type="text" class="form-control @error('calle') is-invalid @enderror" name="calle" placeholder="Obligatorio" required="">
            @error('calle')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        <div class="col-md-4 mx-auto">
          <div class="js-form-message">
            <label class="labels">
              Número/Altura
              <span class="text-danger">*</span>
            </label>
            <input type="number" class="form-control @error('altura') is-invalid @enderror" name="altura" placeholder="Obligatorio" required="">
            @error('altura')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-4 mx-auto">
          <div class="js-form-message mb-4">
            <label class="labels">
              Código Postal
              <span class="text-danger">*</span>
            </label>
            <input type="number" class="form-control @error('codigoPostal') is-invalid @enderror" name="codigoPostal" placeholder="Obligatorio" required="">
            @error('codigoPostal')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        <div class="col-md-4 mx-auto">
          <div class="js-form-message mb-4">
            <label class="labels">
              Provincia
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control @error('provincia') is-invalid @enderror" name="provincia" placeholder="Obligatorio" required="">
            @error('provincia')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
        <div class="col-md-4 mx-auto">
          <div class="js-form-message mb-4">
            <label class="labels">
              Ciudad
              <span class="text-danger">*</span>
            </label>
            <input type="text" class="form-control @error('ciudad') is-invalid @enderror" name="ciudad" placeholder="Obligatorio">
            @error('ciudad')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
        </div>
      </div>
      <br>
      <div class="row text-center mb-4 d-flex justify-content-center">
        <div class="custom-control custom-radio px-3 mb-3">
          <input name="envio" class="custom-control-input" id="customRadio1" type="radio" value="0">
          <label class="custom-control-label" for="customRadio1">Retirar mi pedido en el local</label>
        </div>

        <div class="custom-control custom-radio px-3 mb-3">
          <input name="envio" class="custom-control-input" id="customRadio2" checked="" value="1" type="radio">
          <label class="custom-control-label" for="customRadio2">Enviarme mi pedido</label>
        </div>

        @error('envio')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <div class="row px-3 d-flex justify-content-between align-items-center pb-3">
        <a href="{{ route('Landing') }}" id="back"><span class="fas fa-angle-left mr-2"></span> Volver A La Tienda</a>
        <input type="submit" class="btn btn-info col-lg-4 mt-3" value="continuar"></input>
      </div>
    </div>
  </form>
