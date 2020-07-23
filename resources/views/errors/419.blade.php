@extends('layouts.app')

@section('content')
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header error-page">
      <div class="page-header-image" style="background-image: url('{{ asset('assets') }}/img/ill/404.svg');"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h1 class="title">419</h1>
            <p class="lead">La sesión ha expirado</p>
            {{-- <h4 class="description text-default">Vaya! no encontramos lo que estás buscando.</h4> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
  