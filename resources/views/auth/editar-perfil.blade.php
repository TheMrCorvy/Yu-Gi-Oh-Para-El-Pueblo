@extends('layouts.app', ['class' => 'profile-page'])

@section('content')
<section class="section-profile-cover section-shaped my-0 bg-gradient-info">
  <!-- Circles background -->
  {{-- <img class="bg-image" src="../assets/img/pages/mohamed.jpg" style="width: 100%;"> --}}
  <h3 class="text-center title text-capitalize pt-8 text-white">completá tu perfil para que podamos enviarte tus compras</h3>
  <!-- SVG separator -->
  <div class="separator separator-bottom separator-skew">
    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
      <polygon class="fill-secondary" points="2560 0 2560 100 0 100"></polygon>
    </svg>
  </div>
</section>
<section class="section bg-secondary">
  <div class="container">
    <div class="card card-profile shadow mt--300">
      <div class="px-4 py-4">
        <form method="POST" class="row justify-content-between" action="{{ route('Editar Mi Usuario') }}">
            @csrf

            <div class="col-lg-12 text-center">
              <h5 class="h5 title">Tus datos</h5>
            </div>

            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Tu Nombre Completo:</label>
            <input id="nombreUsuario" name="nombreUsuario" class="form-control @error('nombreUsuario') is-invalid @enderror" type="text" value="{{ $usuario->name }}">
              @error('nombreUsuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            
            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Email: (con el que iniciarás sesión)</label>
              <input id="emailUsuario" name="emailUsuario" class="form-control @error('emailUsuario') is-invalid @enderror" type="email" value="{{ $usuario->email }}">
              @error('emailUsuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Tu apodo dentro del sitio:</label>
              <input id="apodoUsuario" name="apodoUsuario" class="form-control @error('apodoUsuario') is-invalid @enderror" type="text" value="{{ $usuario->username }}" disabled>
              @error('apodoUsuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group col-lg-4 mx-auto">
              <label for="example-text-input" class="form-control-label">Tu Número de Teléfono (WhatsApp):</label>
              <input id="numeroUsuario" name="numeroUsuario" class="form-control @error('numeroUsuario') is-invalid @enderror" type="text" value="{{ $usuario->num_telefono }}">
              @error('numeroUsuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="col-lg-12 text-center">
              <h5 class="h5 title pt-3">Tu dirección para los envíos</h5>
            </div>
            
            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Calle 1: (especificá departamento, piso, timbre, etc., en éste campo)</label>
              <input id="calle1Usuario" name="calle1Usuario" class="form-control @error('calle1Usuario') is-invalid @enderror" type="text" value="{{ $usuario->calle1_timbre }}">
              @error('calle1Usuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            
            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Calle 2:</label>
              <input id="calle2Usuario" name="calle2Usuario" class="form-control @error('calle2Usuario') is-invalid @enderror" type="text" value="{{ $usuario->calle2 }}">
              @error('calle2Usuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            
            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Número/Altura:</label>
              <input id="alturaUsuario" name="alturaUsuario" class="form-control @error('alturaUsuario') is-invalid @enderror" type="number" value="{{ $usuario->altura_domicilio }}">
              @error('alturaUsuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            
            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Barrio:</label>
              <input id="barrioUsuario" name="barrioUsuario" class="form-control @error('barrioUsuario') is-invalid @enderror" type="text" value="{{ $usuario->barrio }}">
              @error('barrioUsuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            
            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Ciudad:</label>
              <input id="ciudadUsuario" name="ciudadUsuario" class="form-control @error('ciudadUsuario') is-invalid @enderror" type="text" value="{{ $usuario->ciudad }}">
              @error('ciudadUsuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            
            <div class="form-group col-lg-4">
              <label for="example-text-input" class="form-control-label">Provincia / Localidad:</label>
              <input id="provinciaUsuario" name="provinciaUsuario" class="form-control @error('provinciaUsuario') is-invalid @enderror" type="text" value="{{ $usuario->localidad }}">
              @error('provinciaUsuario')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group col-lg-12 text-center">
              <input class="btn btn-success" type="submit" value="Completar">
            </div>
          </form>
          <p class="my-3">Todos tus datos permanecerán en secreto. Si tienes algún problema, no dudes en contactarnos en <u class="text-primary">WhatsApp: 011 3771-9677</u> <u>(Lun a Sab de 11am a 17pm)</u>, o al email: <u class="text-primary">info@yugiohparaelpueblo.com</u>. Podrás actualizar tus datos las veces que quieras.</p>
      </div>
    </div>
  </div>
</section>
@endsection