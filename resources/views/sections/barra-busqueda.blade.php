<div class=" mt-5">

    <div class="page-header page-header-small header-filter skew-separator skew-mini">
      {{-- header-filter skew-separator skew-mini --}}

      <div class="page-header-image bg-gradient-warning" style="z-index: 1 !important;"></div>
      <div class="container pt-3">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h1 class="title text-neutral text-capitalize">encontrá fácilmente lo que estás buscando</h1>
            <form action="/buscar" method="GET">
                <div class="row">
    
                    <div class="col-lg-12">
                        <div class="input-group mb-3">
                        <input name="buscandoProducto" type="text" class="form-control" placeholder="Buscar" value="{{ request()->input('buscandoProducto') }}">
                            <div class="input-group-append">
                              <input type="submit" class="btn btn-info add" id="button-addon2" value="Buscar">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- SVG separator -->
      <div class="separator separator-bottom separator-skew">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
  </div>
</div>