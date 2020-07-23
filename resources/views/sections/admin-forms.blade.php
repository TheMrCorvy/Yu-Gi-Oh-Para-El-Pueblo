{{-- <div class="col-lg-12 mt-4">
    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Carta Suelta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Tin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Boosterbox</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-4" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">Sobres Sellados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-4-tab" data-toggle="tab" href="#tabs-icons-text-5" role="tab" aria-controls="tabs-icons-text-4" aria-selected="true">Deckbox</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-5-tab" data-toggle="tab" href="#tabs-icons-text-6" role="tab" aria-controls="tabs-icons-text-5" aria-selected="false">Folios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-6-tab" data-toggle="tab" href="#tabs-icons-text-7" role="tab" aria-controls="tabs-icons-text-6" aria-selected="false">Playmat Manta</a>
            </li>
        </ul>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    
                    <form method="POST" action="/productos/create/carta" class="formReset">
                        @csrf
                        <div class="row justify-content-between">
                            <div class="form-group col-lg-4">
                                <label class="form-control-label">Nombre de la Carta:</label>
                                <input id="nombreCarta" name="nombreCarta" class="form-control @error('nombreCarta') is-invalid @enderror" type="text" >
                                @error('nombreCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              
                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Cantidad disponible:</label>
                                <input id="cantidadCarta" name="cantidadCarta" class="form-control @error('cantidadCarta') is-invalid @enderror" type="number" >
                                @error('cantidadCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                  
                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Precio: (Siempre poner "." nunca ",")</label>
                                <input id="precioCarta" name="precioCarta" class="form-control @error('precioCarta') is-invalid @enderror" type="text" >
                                @error('precioCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              
                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Rareza:</label>
                                <input id="rarezaCarta" name="rarezaCarta" class="form-control @error('rarezaCarta') is-invalid @enderror" type="text" placeholder="opcional">
                                @error('rarezaCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              
                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Link a una Imagen:</label>
                                <input id="linkImagenCarta" name="linkImagenCarta" class="form-control @error('linkImagenCarta') is-invalid @enderror" type="text">
                                @error('linkImagenCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              
                              <div class="form-group col-lg-4">
                                  <label class="form-control-label">Subir una Imagen:</label>
                                  <div class="custom-file">
                                      <input type="file" class="custom-file-input @error('imagenCarta') is-invalid @enderror" id="imagenCarta" name="imagenCarta" lang="es">
                                      <label class="custom-file-label" for="imagenCarta">Elegir Archivo</label>
                                  </div>
                              </div>
                              @error('imagenCarta')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                              
                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Expansión:</label>
                                <input placeholder="opcional" id="expansionCarta" name="expansionCarta" class="form-control @error('expansionCarta') is-invalid @enderror" type="text" >
                                @error('expansionCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              
                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Tipo de la Carta: (opcional)</label>
                                  <select id="tipoCarta" name="tipoCarta" class="form-control @error('tipoCarta') is-invalid @enderror">
                                      <option value="Monstruo Normal">Monstruo Normal</option>
                                      <option value="Monstruo Efecto">Monstruo Efecto</option>
                                      <option value="Monstruo Gemini">Monstruo Gemini</option>
                                      <option value="Monstruo Cyberse">Monstruo Cyberse</option>
                                      <option value="Monstruo Ritual">Monstruo Ritual</option>
                                      <option value="Monstruo Fusión">Monstruo Fusión</option>
                                      <option value="Monstruo Synchro">Monstruo Synchro</option>
                                      <option value="Monstruo XYZ">Monstruo XYZ</option>
                                      <option value="Monstruo Péndulo">Monstruo Péndulo</option>
                                      <option value="Monstruo Link">Monstruo Link</option>
                                      <option value="">-----------------</option>
                                      <option value="Magia Normal">Magia Normal</option>
                                      <option value="Magia Ritual">Magia Ritual</option>
                                      <option value="Magia Contínua">Magia Contínua</option>
                                      <option value="Magia Rápida">Magia Rápida</option>
                                      <option value="Magia de Campo">Magia de Campo</option>
                                      <option value="Magia de Equipo">Magia de Equipo</option>
                                      <option value="">-----------------</option>
                                      <option value="Trampa Normal">Trampa Normal</option>
                                      <option value="Trampa Contínua">Trampa Contínua</option>
                                      <option value="Trampa de Contraefecto (Countertrap)">Trampa de Contraefecto (Countertrap)</option>
                                  </select>
                                  @error('tipoCarta')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>

                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Estado:</label>
                                <input id="estadoCarta" name="estadoCarta" class="form-control @error('estadoCarta') is-invalid @enderror" type="text" >
                                @error('estadoCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              
                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Idioma:</label>
                                <input placeholder="opcional" id="idiomaCarta" name="idiomaCarta" class="form-control @error('idiomaCarta') is-invalid @enderror" type="text" >
                                @error('idiomaCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                              

                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Oferta: (opcional)</label>
                                  <select id="ofertaCarta" name="ofertaCarta" class="form-control @error('ofertaCarta') is-invalid @enderror">
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
                                  @error('ofertaCarta')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              
                              <div class="form-group col-lg-4">
                                <label class="form-control-label">Hasta cuándo estará de oferta? (opcional)</label>
                                <input class="form-control" type="date" id="fechaOfertaCarta" name="fechaOfertaCarta" class="form-control @error('fechaOfertaCarta') is-invalid @enderror">
                                @error('fechaOfertaCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>

                              <div class="form-group col-lg-12">
                                <label class="form-control-label">Descripción (opcional)</label>
                                <textarea id="descripcionCarta" name="descripcionCarta" class="form-control @error('descripcionCarta') is-invalid @enderror" rows="3"></textarea>
                                @error('descripcionCarta')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                  
                              <div class="form-group col-lg-12 text-center">
                                <input class="btn btn-success" type="submit" value="agregar">
                              </div>
                        </div>
                        
                    </form>
                </div>
                
                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <form method="POST" class="row justify-content-between formReset" action="productos/create/tin">
                        @csrf
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Nombre del Tin:</label>
                          <input id="nombreTin" name="nombreTin" class="form-control @error('nombreTin') is-invalid @enderror" type="text" >
                          @error('nombreTin')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Cantidad disponible:</label>
                          <input id="cantidadTin" name="cantidadTin" class="form-control @error('cantidadTin') is-invalid @enderror" type="number" >
                          @error('cantidadTin')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
            
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Precio: (Siempre poner "." nunca ",")</label>
                          <input id="precioTin" name="precioTin" class="form-control @error('precioTin') is-invalid @enderror" type="text" >
                          @error('precioTin')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Link a una Imagen:</label>
                          <input id="linkImagenTin" name="linkImagenTin" class="form-control @error('linkImagenTin') is-invalid @enderror" type="text">
                          @error('linkImagenTin')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Estado:</label>
                          <input id="estadoTin" name="estadoTin" class="form-control @error('estadoTin') is-invalid @enderror" type="text" >
                          @error('estadoTin')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Idioma:</label>
                          <input placeholder="opcional" id="idiomaTin" name="idiomaTin" class="form-control @error('idiomaTin') is-invalid @enderror" type="text" >
                          @error('idiomaTin')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Oferta: (opcional)</label>
                            <select id="ofertaTin" name="ofertaTin" class="form-control @error('ofertaTin') is-invalid @enderror">
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
                            @error('ofertaTin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Hasta cuándo estará de oferta? (opcional)</label>
                          <input class="form-control" type="date" id="fechaOfertaTin" name="fechaOfertaTin" class="form-control @error('fechaOfertaTin') is-invalid @enderror">
                          @error('fechaOfertaTin')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                            <div class="form-group col-lg-12">
                                <label class="form-control-label">Descripción (opcional)</label>
                                <textarea id="descripcionTin" name="descripcionTin" class="form-control @error('descripcionTin') is-invalid @enderror" rows="3"></textarea>
                                @error('descripcionTin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
            
                        <div class="form-group col-lg-12 text-center">
                          <input class="btn btn-success" type="submit" value="agregar">
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <form method="POST" class="row justify-content-between formReset" action="productos/create/boosterbox">
                        @csrf
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Nombre del Boosterbox:</label>
                          <input id="nombreBoosterbox" name="nombreBoosterbox" class="form-control @error('nombreBoosterbox') is-invalid @enderror" type="text" >
                          @error('nombreBoosterbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Cantidad disponible:</label>
                          <input id="cantidadBoosterbox" name="cantidadBoosterbox" class="form-control @error('cantidadBoosterbox') is-invalid @enderror" type="number" >
                          @error('cantidadBoosterbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
            
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Precio: (Siempre poner "." nunca ",")</label>
                          <input id="precioBoosterbox" name="precioBoosterbox" class="form-control @error('precioBoosterbox') is-invalid @enderror" type="text" >
                          @error('precioBoosterbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Link a una Imagen:</label>
                          <input id="linkImagenBoosterbox" name="linkImagenBoosterbox" class="form-control @error('linkImagenBoosterbox') is-invalid @enderror" type="text">
                          @error('linkImagenBoosterbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Expansión:</label>
                          <input placeholder="opcional" id="expansionBoosterbox" name="expansionBoosterbox" class="form-control @error('expansionBoosterbox') is-invalid @enderror" type="text" >
                          @error('expansionBoosterbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Estado:</label>
                          <input id="estadoBoosterbox" name="estadoBoosterbox" class="form-control @error('estadoBoosterbox') is-invalid @enderror" type="text" >
                          @error('estadoBoosterbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Idioma:</label>
                          <input placeholder="opcional" id="idiomaBoosterbox" name="idiomaBoosterbox" class="form-control @error('idiomaBoosterbox') is-invalid @enderror" type="text" >
                          @error('idiomaBoosterbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Oferta: (opcional)</label>
                            <select id="ofertaBoosterbox" name="ofertaBoosterbox" class="form-control @error('ofertaBoosterbox') is-invalid @enderror">
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
                            @error('ofertaBoosterbox')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Hasta cuándo estará de oferta? (opcional)</label>
                          <input class="form-control" type="date" id="fechaOfertaBoosterbox" name="fechaOfertaBoosterbox" class="form-control @error('fechaOfertaBoosterbox') is-invalid @enderror">
                          @error('fechaOfertaBoosterbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                            <div class="form-group col-lg-12">
                                <label class="form-control-label">Descripción (opcional)</label>
                                <textarea id="descripcionBoosterbox" name="descripcionBoosterbox" class="form-control @error('descripcionBoosterbox') is-invalid @enderror" rows="3"></textarea>
                                @error('descripcionBoosterbox')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
            
                        <div class="form-group col-lg-12 text-center">
                          <input class="btn btn-success" type="submit" value="agregar">
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-4" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <form method="POST" class="row justify-content-between formReset" action="productos/create/sobre-sellado">
                        @csrf
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Nombre del Sobre Sellado:</label>
                          <input id="nombreSobreSellado" name="nombreSobreSellado" class="form-control @error('nombreSobreSellado') is-invalid @enderror" type="text" >
                          @error('nombreSobreSellado')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Cantidad disponible:</label>
                          <input id="cantidadSobreSellado" name="cantidadSobreSellado" class="form-control @error('cantidadSobreSellado') is-invalid @enderror" type="number" >
                          @error('cantidadSobreSellado')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
            
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Precio: (Siempre poner "." nunca ",")</label>
                          <input id="precioSobreSellado" name="precioSobreSellado" class="form-control @error('precioSobreSellado') is-invalid @enderror" type="text" >
                          @error('precioSobreSellado')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Link a una Imagen:</label>
                          <input id="linkImagenSobreSellado" name="linkImagenSobreSellado" class="form-control @error('linkImagenSobreSellado') is-invalid @enderror" type="text">
                          @error('linkImagenSobreSellado')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Expansión:</label>
                          <input placeholder="opcional" id="expansionSobreSellado" name="expansionSobreSellado" class="form-control @error('expansionSobreSellado') is-invalid @enderror" type="text" >
                          @error('expansionSobreSellado')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <div class="form-group col-lg-4">
                            <label class="form-control-label">Estado:</label>
                            <input id="estadoSobreSellado" name="estadoSobreSellado" class="form-control @error('estadoSobreSellado') is-invalid @enderror" type="text" >
                            @error('estadoSobreSellado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          
                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Idioma:</label>
                            <input placeholder="opcional" id="idiomaSobreSellado" name="idiomaSobreSellado" class="form-control @error('idiomaSobreSellado') is-invalid @enderror" type="text" >
                            @error('idiomaSobreSellado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Oferta: (opcional)</label>
                            <select id="ofertaSobreSellado" name="ofertaSobreSellado" class="form-control @error('ofertaSobreSellado') is-invalid @enderror">
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
                            @error('ofertaSobreSellado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Hasta cuándo estará de oferta? (opcional)</label>
                          <input class="form-control" type="date" id="fechaOfertaSobreSellado" name="fechaOfertaSobreSellado" class="form-control @error('fechaOfertaSobreSellado') is-invalid @enderror">
                          @error('fechaOfertaSobreSellado')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="form-control-label">Descripción (opcional)</label>
                            <textarea id="descripcionSobreSellado" name="descripcionSobreSellado" class="form-control @error('descripcionSobreSellado') is-invalid @enderror" rows="3"></textarea>
                            @error('descripcionSobreSellado')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            
                        <div class="form-group col-lg-12 text-center">
                          <input class="btn btn-success" type="submit" value="agregar">
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-5" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <form method="POST" class="row justify-content-center formReset" action="productos/create/deckbox">
                        @csrf
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Nombre del Deckbox:</label>
                          <input id="nombreDeckbox" name="nombreDeckbox" class="form-control @error('nombreDeckbox') is-invalid @enderror" type="text" >
                          @error('nombreDeckbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Cantidad disponible:</label>
                          <input id="cantidadDeckbox" name="cantidadDeckbox" class="form-control @error('cantidadDeckbox') is-invalid @enderror" type="number" >
                          @error('cantidadDeckbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
            
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Precio: (Siempre poner "." nunca ",")</label>
                          <input id="precioDeckbox" name="precioDeckbox" class="form-control @error('precioDeckbox') is-invalid @enderror" type="text" >
                          @error('precioDeckbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Link a una Imagen:</label>
                          <input id="linkImagenDeckbox" name="linkImagenDeckbox" class="form-control @error('linkImagenDeckbox') is-invalid @enderror" type="text">
                          @error('linkImagenDeckbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Marca:</label>
                          <input placeholder="opcional" id="marcaDeckbox" name="marcaDeckbox" class="form-control @error('marcaDeckbox') is-invalid @enderror" type="text" >
                          @error('marcaDeckbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Tamaño (Yu-Gi-Oh!, Pokemon, Magic, etc):</label>
                            <input placeholder="opcional" id="tamañoDeckbox" name="tamañoDeckbox" class="form-control @error('tamañoDeckbox') is-invalid @enderror" type="text" >
                            @error('tamañoDeckbox')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Capacidad:</label>
                            <input placeholder="opcional" id="capacidadDeckbox" name="capacidadDeckbox" class="form-control @error('capacidadDeckbox') is-invalid @enderror" type="text" >
                            @error('capacidadDeckbox')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Estado:</label>
                            <input id="estadoDeckbox" name="estadoDeckbox" class="form-control @error('estadoDeckbox') is-invalid @enderror" type="text" >
                            @error('estadoDeckbox')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          
                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Color:</label>
                            <input placeholder="opcional" id="colorDeckbox" name="colorDeckbox" class="form-control @error('colorDeckbox') is-invalid @enderror" type="text" >
                            @error('colorDeckbox')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Oferta: (opcional)</label>
                            <select id="ofertaDeckbox" name="ofertaDeckbox" class="form-control @error('ofertaDeckbox') is-invalid @enderror">
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
                            @error('ofertaDeckbox')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Hasta cuándo estará de oferta? (opcional)</label>
                          <input class="form-control" type="date" id="fechaOfertaDeckbox" name="fechaOfertaDeckbox" class="form-control @error('fechaOfertaDeckbox') is-invalid @enderror">
                          @error('fechaOfertaDeckbox')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="form-control-label">Descripción (opcional)</label>
                            <textarea id="descripcionDeckbox" name="descripcionDeckbox" class="form-control @error('descripcionDeckbox') is-invalid @enderror" rows="3"></textarea>
                            @error('descripcionDeckbox')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            
                        <div class="form-group col-lg-12 text-center">
                          <input class="btn btn-success" type="submit" value="agregar">
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-6" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <form method="POST" class="row justify-content-between formReset" action="productos/create/folios">
                        @csrf
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Nombre de los Folios:</label>
                          <input id="nombreFolios" name="nombreFolios" class="form-control @error('nombreFolios') is-invalid @enderror" type="text" >
                          @error('nombreFolios')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Cantidad disponible:</label>
                          <input id="cantidadFolios" name="cantidadFolios" class="form-control @error('cantidadFolios') is-invalid @enderror" type="number" >
                          @error('cantidadFolios')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
            
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Precio: (Siempre poner "." nunca ",")</label>
                          <input id="precioFolios" name="precioFolios" class="form-control @error('precioFolios') is-invalid @enderror" type="text" >
                          @error('precioFolios')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Link a una Imagen:</label>
                          <input id="linkImagenFolios" name="linkImagenFolios" class="form-control @error('linkImagenFolios') is-invalid @enderror" type="text">
                          @error('linkImagenFolios')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Marca:</label>
                          <input placeholder="opcional" id="marcaFolios" name="marcaFolios" class="form-control @error('marcaFolios') is-invalid @enderror" type="text" >
                          @error('marcaFolios')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Tamaño (Yu-Gi-Oh!, Pokemon, Magic, etc):</label>
                            <input placeholder="opcional" id="tamañoFolios" name="tamañoFolios" class="form-control @error('tamañoFolios') is-invalid @enderror" type="text" >
                            @error('tamañoFolios')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Estado:</label>
                            <input id="estadoFolios" name="estadoFolios" class="form-control @error('estadoFolios') is-invalid @enderror" type="text" >
                            @error('estadoFolios')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          
                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Color:</label>
                            <input placeholder="opcional" id="colorFolios" name="colorFolios" class="form-control @error('colorFolios') is-invalid @enderror" type="text" >
                            @error('colorFolios')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                          
                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Cantidad de Folios que trae:</label>
                            <input placeholder="opcional" id="cantidadIncluidaFolios" name="cantidadIncluidaFolios" class="form-control @error('cantidadIncluidaFolios') is-invalid @enderror" type="number" >
                            @error('cantidadIncluidaFolios')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Oferta: (opcional)</label>
                            <select id="ofertaFolios" name="ofertaFolios" class="form-control @error('ofertaFolios') is-invalid @enderror">
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
                            @error('ofertaFolios')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Hasta cuándo estará de oferta? (opcional)</label>
                          <input class="form-control" type="date" id="fechaOfertaFolios" name="fechaOfertaFolios" class="form-control @error('fechaOfertaFolios') is-invalid @enderror">
                          @error('fechaOfertaFolios')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="form-control-label">Descripción (opcional)</label>
                            <textarea id="descripcionFolios" name="descripcionFolios" class="form-control @error('descripcionFolios') is-invalid @enderror" rows="3"></textarea>
                            @error('descripcionFolios')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            
                        <div class="form-group col-lg-12 text-center">
                          <input class="btn btn-success" type="submit" value="agregar">
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="tabs-icons-text-7" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <form method="POST" class="row justify-content-between formReset" action="productos/create/playmat">
                        @csrf
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Nombre del Playmat / Manta:</label>
                          <input id="nombrePlaymat" name="nombrePlaymat" class="form-control @error('nombrePlaymat') is-invalid @enderror" type="text" >
                          @error('nombrePlaymat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Cantidad disponible:</label>
                          <input id="cantidadPlaymat" name="cantidadPlaymat" class="form-control @error('cantidadPlaymat') is-invalid @enderror" type="number" >
                          @error('cantidadPlaymat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
            
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Precio: (Siempre poner "." nunca ",")</label>
                          <input id="precioPlaymat" name="precioPlaymat" class="form-control @error('precioPlaymat') is-invalid @enderror" type="text" >
                          @error('precioPlaymat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Link a una Imagen:</label>
                          <input id="linkImagenPlaymat" name="linkImagenPlaymat" class="form-control @error('linkImagenPlaymat') is-invalid @enderror" type="text">
                          @error('linkImagenPlaymat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Marca:</label>
                          <input placeholder="opcional" id="marcaPlaymat" name="marcaPlaymat" class="form-control @error('marcaPlaymat') is-invalid @enderror" type="text" >
                          @error('marcaPlaymat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Tamaño:</label>
                            <input placeholder="opcional" id="tamañoPlaymat" name="tamañoPlaymat" class="form-control @error('tamañoPlaymat') is-invalid @enderror" type="text" >
                            @error('tamañoPlaymat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>

                          <div class="form-group col-lg-4">
                            <label class="form-control-label">Estado:</label>
                            <input id="estadoPlaymat" name="estadoPlaymat" class="form-control @error('estadoPlaymat') is-invalid @enderror" type="text" >
                            @error('estadoPlaymat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Oferta: (opcional)</label>
                            <select id="ofertaPlaymat" name="ofertaPlaymat" class="form-control @error('ofertaPlaymat') is-invalid @enderror">
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
                            @error('ofertaPlaymat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group col-lg-4">
                          <label class="form-control-label">Hasta cuándo estará de oferta? (opcional)</label>
                          <input class="form-control" type="date" id="fechaOfertaPlaymat" name="fechaOfertaPlaymat" class="form-control @error('fechaOfertaPlaymat') is-invalid @enderror">
                          @error('fechaOfertaPlaymat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="form-control-label">Descripción (opcional)</label>
                            <textarea id="descripcionPlaymat" name="descripcionPlaymat" class="form-control @error('descripcionPlaymat') is-invalid @enderror" rows="3"></textarea>
                            @error('descripcionPlaymat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            
                        <div class="form-group col-lg-12 text-center">
                          <input class="btn btn-success" type="submit" value="agregar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <a href="javascript:;" class="btn btn-link" data-toggle="modal" data-target=".bd-example-modal-xl">instrucciones para añadir imágenes <i class="fas fa-info-circle text-primary"></i></a>
</div> --}}

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
            <textarea id="descripcionProducto" name="descripcionProducto" class="form-control form-control-alternative @error('descripcionProducto') is-invalid @enderror" rows="3" value="">{{ old('descripcionProducto') }}</textarea>
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