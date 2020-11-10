<form method="POST" action="{{ route('products.create') }}" enctype="multipart/form-data" class="mt-5">
    @csrf
    <div class="row justify-content-between">
        <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Nombre del producto:</label>
        <input id="nombreProducto" name="nombreProducto" class="form-control form-control-alternative @error('nombreProducto') is-invalid @enderror" type="text" value="{{ old('nombreProducto') }}">
            @error('nombreProducto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          
          <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Precio: (siempre poner "." nunca ",")</label>
          <input id="precioProducto" name="precioProducto" class="form-control form-control-alternative @error('precioProducto') is-invalid @enderror" type="text" value="{{ old('precioProducto') }}">
            @error('precioProducto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Categoría:</label>
              <select id="categoriaProducto" name="categoriaProducto" class="form-control form-control-alternative @error('categoriaProducto') is-invalid @enderror">
                  <option value="" id="cargandoCategoria">Cargando...</option>
              </select>
              @error('categoriaProducto')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          
          <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Tipo de Producto:</label>
              <select id="tipoProducto" name="tipoProducto" class="form-control form-control-alternative @error('tipoProducto') is-invalid @enderror">
                  <option value="" id="cargando">Cargando...</option>
              </select>
              @error('tipoProducto')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>

          <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Cantidad disponible:</label>
            <input id="cantidadProducto" name="cantidadProducto" class="form-control form-control-alternative @error('cantidadProducto') is-invalid @enderror" type="number" value="{{ old('cantidadProducto') }}">
            @error('cantidadProducto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Estado:</label>
            <input id="estadoProducto" name="estadoProducto" class="form-control form-control-alternative @error('estadoProducto') is-invalid @enderror" type="text" value="{{ old('estadoProducto') }}">
            @error('estadoProducto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

            <div class="form-group col-lg-4 mt-4">
              <label class="form-control-label">Rareza:</label>
              <input placeholder="opcional" id="rarezaProducto" name="rarezaProducto" class="form-control form-control-alternative @error('rarezaProducto') is-invalid @enderror" type="text" value="{{ old('rarezaProducto') }}">
              @error('rarezaProducto')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
          
          <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Link a una Imagen:</label>
            <input id="linkImagenProducto" name="linkImagenProducto" class="form-control form-control-alternative @error('linkImagenProducto') is-invalid @enderror" type="text" value="{{ old('linkImagenProducto') }}" placeholder="opcional">
            @error('linkImagenProducto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          
          <div class="form-group col-lg-4 mt-4">
              <label class="form-control-label">Subir una Imagen: (solo una) (opcional)</label>
              <div class="custom-file">
                  <input type="file" class="custom-file-input @error('imagenProducto') is-invalid @enderror" id="imagenProducto" name="imagenProducto" lang="es">
                  <label class="custom-file-label" for="imagenProducto">Elegir Archivo</label>
              </div>
          </div>
          @error('imagenProducto')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

          <div class="form-group col-lg-4 mt-4">
              <label class="form-control-label">Expansión:</label>
              <input placeholder="opcional" id="expansionProducto" name="expansionProducto" class="form-control form-control-alternative @error('expansionProducto') is-invalid @enderror" type="text" value="{{ old('expansionProducto') }}">
              @error('expansionProducto')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group col-lg-4 mt-4">
              <label class="form-control-label">Tipo de la Carta: (opcional)</label>
                <select id="tipoCartaProducto" name="tipoCartaProducto" class="form-control form-control-alternative @error('tipoCartaProducto') is-invalid @enderror">
                    <option value="">Default (Vacío)</option>
                </select>
                @error('tipoCartaProducto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

          <div class="form-group col-lg-4 mt-4">
              <label class="form-control-label">Marca:</label>
              <input placeholder="opcional" id="marcaProducto" name="marcaProducto" class="form-control form-control-alternative @error('marcaProducto') is-invalid @enderror" type="text" value="{{ old('marcaProducto') }}">
              @error('marcaProducto')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>
            <div class="form-group col-lg-4 mt-4">
                <label class="form-control-label">Tamaño:</label>
                <input placeholder="opcional" id="sizeProducto" name="sizeProducto" class="form-control form-control-alternative @error('sizeProducto') is-invalid @enderror" type="text" value="{{ old('sizeProducto') }}">
                @error('sizeProducto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

            <div class="form-group col-lg-4 mt-4">
                <label class="form-control-label">Capacidad:</label>
                <input placeholder="opcional" id="capacidadProducto" name="capacidadProducto" class="form-control form-control-alternative @error('capacidadProducto') is-invalid @enderror" type="text" value="{{ old('capacidadProducto') }}">
                @error('capacidadProducto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

            <div class="form-group col-lg-4 mt-4">
                <label class="form-control-label">Idioma:</label>
                <input placeholder="opcional" id="idiomaProducto" name="idiomaProducto" class="form-control form-control-alternative @error('idiomaProducto') is-invalid @enderror" type="text" value="{{ old('idiomaProducto') }}">
                @error('idiomaProducto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            
            <div class="form-group col-lg-4 mt-4">
                <label class="form-control-label">Color o Background:</label>
                <input placeholder="opcional" id="colorProducto" name="colorProducto" class="form-control form-control-alternative @error('colorProducto') is-invalid @enderror" type="text" value="{{ old('colorProducto') }}">
                @error('colorProducto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
            
            <div class="form-group col-lg-4 mt-4">
                <label class="form-control-label">Cuántas unidades incluye?</label>
                <input placeholder="opcional" id="cantidadIncluidaProducto" name="cantidadIncluidaProducto" class="form-control form-control-alternative @error('cantidadIncluidaProducto') is-invalid @enderror" type="number" value="{{ old('cantidadIncluidaProducto') }}">
                @error('cantidadIncluidaProducto')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>
          
          <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Oferta: (opcional)</label>
              <select id="ofertaProducto" name="ofertaProducto" class="form-control form-control-alternative @error('ofertaProducto') is-invalid @enderror">
                  <option value="0">0%</option>
                  <option value="5">5%</option>
                  <option value="10">10%</option>
                  <option value="15">15%</option>
                  <option value="20">20%</option>
                  <option value="25">25%</option>
                  <option value="30">30%</option>
                  <option value="40">40%</option>
                  <option value="50">50%</option>
                  <option value="60">60%</option>
                  <option value="75">75%</option>
                  <option value="80">80%</option>
                  <option value="85">85%</option>
                  <option value="90">90%</option>
                  <option value="95">95%</option>
              </select>
              @error('ofertaProducto')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
          
          <div class="form-group col-lg-4 mt-4">
            <label class="form-control-label">Hasta cuándo estará de oferta? (opcional)</label>
            <input class="form-control form-control-alternative" type="date" id="fechaOfertaProducto" name="fechaOfertaProducto" class="form-control @error('fechaOfertaProducto') is-invalid @enderror" value="{{ old('fechaOfertaProducto') }}">
            @error('fechaOfertaProducto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group col-lg-12">
            <label class="form-control-label">Descripción (opcional)</label>
            <textarea id="descripcionProducto" name="descripcionProducto" class="form-control form-control-alternative @error('descripcionProducto') is-invalid @enderror" rows="7" value="">{{ old('descripcionProducto') }}</textarea>
            @error('descripcionProducto')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <div class="form-group col-lg-12 text-center">
            <input class="btn btn-success add" type="submit" value="guardar">
          </div>
    </div>

  <a href="javascript:;" class="btn btn-link" data-toggle="modal" data-target=".bd-example-modal-xl">instrucciones para añadir imágenes <i class="fas fa-info-circle text-primary"></i></a>

    
  </form>

  <script>
      window.addEventListener('load', () => {
          //tipo de producto
            fetch('/api/v1/TypeProduct/index', {
                headers: {
                        'Content-Type': 'application/json',
                    },
                method: 'get',
            })
            .then(jsonResponse => jsonResponse.json())
            .then(response => {
                response.tipos.forEach(tipo => {
                    
                    let option = document.createElement('option')
                    
                    option.innerText = tipo.tipo_producto
                    
                    option.setAttribute('value', tipo.id)
                    
                    document.getElementById('tipoProducto').appendChild(option)
                });
                document.getElementById('cargando').remove()
            })
            
            //categoria
            fetch('/api/v1/Category/index', {
                headers: {
                        'Content-Type': 'application/json',
                    },
                method: 'get',
            })
            .then(jsonResponse => jsonResponse.json())
            .then(response => {

                let yugioh = document.createElement('option')
            
                yugioh.innerText = 'Yu-Gi-Oh!'
        
                yugioh.setAttribute('value', "0")
        
                document.getElementById('categoriaProducto').appendChild(yugioh)
            
                response.categorias.forEach(categoria => {

                    let option = document.createElement('option')
            
                    option.innerText = categoria.categoria
            
                    option.setAttribute('value', categoria.id)
            
                    document.getElementById('categoriaProducto').appendChild(option)
                });
                document.getElementById('cargandoCategoria').remove()
            })

            //tipo de carta
            fetch('/api/v1/TypeCarta/index', {
                headers: {
                        'Content-Type': 'application/json',
                    },
                method: 'get',
            })
            .then(jsonResponse => jsonResponse.json())
            .then(response => {
            
                response.tiposCartas.forEach(tipo => {
            
                    let option = document.createElement('option')
            
                    option.innerText = tipo.tipo_carta
            
                    option.setAttribute('value', tipo.id)
            
                    document.getElementById('tipoCartaProducto').appendChild(option)
                });
            })
      })
  </script>