<h1 class="h1 title text-center col-lg-12 text-capitalize"><a href="{{ route('admin.compras') }}"><u>ventas del último mes</u></a></h1>

<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-header text-center">
            <h5>Métodos y Zonas de envios</h5>
        </div>
        <div class="card-body">
            <h6>Crear Método de Envío:</h6>
            <form action="">
                <div class="input-group mb-3">
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Recuerda incluir mayúsculas"  
                        aria-describedby="button-addon2"
                    >
                    <div class="input-group-append">
                        <button class="btn btn-outline-success" type="button" id="button-addon2">Guardar</button>
                    </div>
                </div>
            </form>
            <h6 class="mt-5">Crear Zona de Envío:</h6>
            <form class="row justify-content-around">
                <div class="col-lg-4">
                    <div class="js-form-message">
                        <label class="labels">
                            Nombre de la Zona: 
                            <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('zona') is-invalid @enderror" 
                            name="zona" 
                            placeholder="Ej: Interior a Domicilio" 
                            required
                        />

                        @error('zona')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="labels">
                            Costo del Envío: 
                            <span class="text-danger">*</span>
                        </label>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            
                            <input 
                                type="number" 
                                class="form-control @error('precio') is-invalid @enderror" 
                                name="precio" 
                                required
                            />
                        </div>

                        @error('precio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="js-form-message">
                        <div class="form-group">
                            <label class="labels">
                                Método de Envío: 
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="metodoEnvio">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>

                        @error('metodoEnvio')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2">
                    <input type="submit" value="guardar" class="btn btn-outline-warning">
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <button class="btn btn-link text-primary" data-toggle="modal" data-target="#modalMetodosEnvio">
                Editar Métodos y Zonas de Envío
            </button>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMetodosEnvio" tabindex="-1" role="dialog" aria-labelledby="modalMetodosEnvioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Métodos y Zonas de Envío</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>