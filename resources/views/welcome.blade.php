@extends('layouts.app', ['class' => 'ecommerce-page sections-page'])

@section('content')

<script>
  window.addEventListener('load', () => {
    window.scrollTo({
      top: 0,
      left: 0
    })
  })
</script>
  
@include('sections.barra-busqueda')
    <div class="main" style="margin-top: -50px !important;">
      
      @include('sections.ofertas', ['ofertas' => $ofertas, 'multiplicador' => $multiplicador])

      {{-- @include('sections.singles', ['singles' => $singles, 'ofertas' => $ofertas, 'multiplicador' => $multiplicador]) --}}

      <section>

      </section>
        @if ($ofertas->count() < 6)
          <div class="section" style="z-index: 30 !important;">
        @else
          <div class="section bg-secondary" style="z-index: 30 !important;">
        @endif
        
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-10 mx-auto text-center">
                  <h3 class="desc my-5"><u>Recientemente Añadidos</u></h3>
                </div>
              </div>
              <div class="d-flex justify-content-between" id="nuevosProductos" style="overflow-x: scroll; white-space: nowrap; position: relative;">
                {{-- <div class="col-md-12"> --}}
                  {{-- <div class="row"  > --}}

                    <div class="alert alert-primary d-flex justify-content-between col-lg-12" id="cargando" role="alert">
                      <strong class="pt-1">Cargando Novedades...</strong>
                      <div class="spinner-border text-white" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </div>
                    
                  {{-- </div> --}}
                {{-- </div> --}}
              </div>

              <div class="col-md-3 ml-auto mr-auto mt-5 text-center">
                <button class="btn btn-primary btn-round btn-simple my-auto"id="desliza">¡Deslíza!</button>
              </div>

              <script>
                document.getElementById('desliza').addEventListener('click', () => {
                    document.getElementById('nuevosProductos').scrollBy({
                      top: 0,
                      left: +200,
                      behavior: 'smooth',
                    })
                })
            </script>

            </div>
          </div>
      <section>
        {{-- @if ($ofertas->count() < 6)
        <div class="section" style="z-index: 30 !important;" id="cartas-sueltas">
        @else
        <div class="section bg-secondary" style="z-index: 30 !important;" id="cartas-sueltas">
        @endif --}}
        <div class="section">
            <div class="container">
              <div class="row">
                <div class="col-md-10 mx-auto text-center">
                  <h3 class="desc my-5">Singles de Yu-Gi-Oh!</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="row" id="singles">

                    <div class="alert alert-success d-flex justify-content-between col-lg-12" id="cargando" role="alert">
                      <strong class="pt-1">Cargando Singles...</strong>
                      <div class="spinner-border text-white" role="status">
                        <span class="sr-only">Loading...</span>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
      </section>
      
      {{-- @include('sections.productos-sellados', ['otros' => $otros, 'multiplicador' => $multiplicador]) --}}
      <section class="bg-secondary">
        <div class="container text-center pt-5 pb-8" id="productos">
          <div class="row pt-5">
            <div class="col-md-12 mx-auto">
              <h3 class="display-3">Productos Sellados / Relacionados Yu-Gi-Oh!</h3>
              <p class="lead mt-1">Tenemos stock de Playmats / Mantas, Deckboxes, Folios, Boosterboxes, sobres, Megatins, etc.</p>
            </div>
          </div>
          <div id="accesorios">

            <div class="alert alert-info d-flex justify-content-between col-lg-12" id="cargando" role="alert">
              <strong class="pt-1">Cargando Accesorios y otros Productos Relacionados...</strong>
              <div class="spinner-border text-white" role="status">
                <span class="sr-only">Loading...</span>
              </div>
            </div>

            
          </div>
          <a href="/productos-relacionados" class="btn btn-icon btn-primary mt-4" type="button">
            <span class="btn-inner--text">Ver Todos</span>
            <span class="btn-inner--icon"><i class="ni ni-bold-right"></i></span>
          </a>
        </div>
      </section>

      {{-- @include('sections.pedidos') --}}
      
      @include('sections.contacto')

      @include('sections.info')

      
    </div>
    {{-- no borrar --}}

    <script>
      async function GetNuevosProductos(){
          await fetch('/api/v1/APIPage/GetNuevosHome', {
              headers: {
                      'Content-Type': 'application/json',
                  },
              method: 'get',
          })
          .then(jsonResponse => jsonResponse.text())
          .then(response => {
            document.getElementById('nuevosProductos').innerHTML = ''
            document.getElementById('nuevosProductos').innerHTML = response
          })
        }

        async function GetSingles(){
          await fetch('/api/v1/APIPage/GetAccesoriosHome', {
              headers: {
                      'Content-Type': 'application/json',
                  },
              method: 'get',
          })
          .then(jsonResponse => jsonResponse.text())
          .then(response => {
            document.getElementById('accesorios').innerHTML = ''
            document.getElementById('accesorios').innerHTML = response
          })
        }
  
        async function GetAccesorios(){
          await fetch('/api/v1/APIPage/GetSinglesHome', {
              headers: {
                      'Content-Type': 'application/json',
                  },
              method: 'get',
          })
          .then(jsonResponse => jsonResponse.text())
          .then(response => {
            document.getElementById('singles').innerHTML = ''
            document.getElementById('singles').innerHTML = response
          })
        }

      window.addEventListener('load', async () => {
        await Promise.all([ //esto es para ejecutar funciones asincronas en paralelo, en lugar de primero ejecutar y esperar a una y luego a la otra
          GetSingles(),
          GetAccesorios(),
          GetNuevosProductos(),
        ])
        .then(() => {
          document.querySelectorAll('.addAjax').forEach(boton => {
              boton.addEventListener('click', e => {

                let id = e.target.getAttribute('id')
                let alert = document.getElementById('alert')

                alert.classList.toggle('show')
              })
            })
        })
      })
    </script>
@endsection