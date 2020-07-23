@extends('layouts.app')

@section('content')
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header error-page">
      <div class="page-header-image" style="background-image: url('{{ asset('assets') }}/img/ill/404.svg');"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="title">403</h1>
            <p class="lead">No tenés permiso de estar acá</p>
            <h4 class="description text-default">Intentá de vuelta despues de iniciar sesión.</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
  