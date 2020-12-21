<h1 class="h1 title text-center col-lg-12 text-capitalize"><a href="{{ route('admin.compras') }}"><u>ver historial de ventas</u></a></h1>

<div class="col-lg-12 mt-3">
    <div class="card">
        <div class="card-header text-center">
            <h5>Métodos y Zonas de envios</h5>
        </div>
        <div class="card-body">
            <h6>Crear Método de Envío:</h6>
            <form method="post" action="{{route('admin.create-method')}}" class="row">
                @csrf
                <div class="col-lg-5">
                    <div class="js-form-message">
                        <label class="labels">
                            Método de Envío: 
                            <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text" 
                            class="form-control @error('metodo') is-invalid @enderror" 
                            name="metodo" 
                            required
                        />

                        @error('metodo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label class="labels">
                            Tiempo Estimado de Entrega: 
                            <span class="text-danger">*</span>
                        </label>
                            
                        <input 
                            type="text" 
                            class="form-control @error('tiempoPrevisto') is-invalid @enderror" 
                            name="tiempoPrevisto" 
                            placeholder="Ej: De 1 a 3 días Hábiles"
                            required
                        />

                        @error('tiempoPrevisto')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-2 pt-4 mt-2">
                    <input type="submit" value="guardar" class="btn btn-outline-success">
                </div>
            </form>
            <h6 class="mt-5">Crear Zona de Envío:</h6>
            <form class="row justify-content-around" method="post" action="{{route('admin.create-zone')}}">
                @csrf
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
                            <select class="form-control" name="metodoEnvio" id="crearZonaEnvio">
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
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Métodos y Zonas de Envío</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row" id="editarZonas-metodos">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Volver</button>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', () => {
        cargarMetodosEnvio()
    })

    const crearZonaEnvio = document.getElementById('crearZonaEnvio')

    const zonaConstruccionEdicion = document.getElementById('editarZonas-metodos')

    async function cargarMetodosEnvio() 
    {
        await fetch('/api/v1/APIPage/getMetodosEnvio', 
        {
            headers:
            {
                'Content-Type': 'application/json',
            },
            method: 'get',
        })
        .then(jsonResponse => jsonResponse.json())
        .then(response => 
        {
            construirZonasEnvio(response.zonas, response.metodos)
        })
    }

    function construirZonasEnvio(zonas, metodos)
    {

        crearZonaEnvio.innerHTML = construirMetodos(metodos, 0)

        zonaConstruccionEdicion.innerHTML += 
        `
            <h6 class="col-lg-12 text-center">Editar Métodos de Envío:</h6>
        `
        
        metodos.forEach(metodo => 
        {
            zonaConstruccionEdicion.innerHTML += 
            `
                <form method="post" action="{{route('admin.edit-method')}}" class="w-100 pl-5 row">
                    @csrf
                    <input type="hidden" name="id-metodo" value="${metodo.id}">
                    <div class="col-lg-4">
                        <div class="js-form-message">
                            <label class="labels">
                                Método de Envío: 
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('metodo') is-invalid @enderror" 
                                name="metodo" 
                                value="${metodo.metodo}"
                                required
                            />

                            @error('metodo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label class="labels">
                                Tiempo Estimado de Entrega: 
                                <span class="text-danger">*</span>
                            </label>
                                
                            <input 
                                type="text" 
                                class="form-control @error('tiempoPrevisto') is-invalid @enderror" 
                                name="tiempoPrevisto" 
                                placeholder="Ej: De 1 a 3 días Hábiles"
                                required
                                value="${metodo.tiempo_previsto}"
                            />

                            @error('tiempoPrevisto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-2 pt-4 mt-2">
                        <input type="submit" value="guardar" class="btn btn-outline-success">
                    </div>
                    <div class="col-lg-1 pt-4 mt-2">
                        <a 
                            href="/admin/eliminar-metodo-envio/${metodo.id}" 
                            class="btn btn-outline-danger btn-icon-only"
                            data-toggle="tooltip" 
                            data-placement="left" 
                            title="Eliminar"
                        >
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            `
        });

        zonaConstruccionEdicion.innerHTML += 
        `
            <h6 class="col-lg-12 text-center mt-4">Editar Zonas de Envío:</h6>
        `

        zonas.forEach(zona => 
        {
            zonaConstruccionEdicion.innerHTML += 
            `
                <form class="col-lg-12 mb-4 pb-4 row justify-content-between" method="post" action="{{route('admin.edit-zone')}}">
                    @csrf
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
                                value="${zona.zona}"
                            />
                        </div>
                    </div>
                    <div class="col-lg-3">
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
                                    value="${zona.precio}"
                                />
                            </div>
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
                                    ${construirMetodos(metodos, zona.metodo_envio)}
                                </select>
                            </div>
                        </div>
                    </div>
                    <a 
                        href="/admin/eliminar-zona-envio/${zona.id}" 
                        class="btn btn-outline-danger btn-icon-only float-left"
                        style="margin-top: 2rem;"
                        data-toggle="tooltip" 
                        data-placement="left" 
                        title="Eliminar"
                    >
                        <i class="fas fa-times"></i>
                    </a>
                    <div class="col-lg-2 float-left">
                        <input type="submit" value="guardar" class="btn btn-outline-warning btn-sm">
                    </div>
                    <input type="hidden" name="id-zona" value="${zona.id}">
                </form>
            `
        });

        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    }

    function construirMetodos(metodos, idMetodo)
    {
        const index = idMetodo <= 0 ? 0 : idMetodo -1

        let opciones = ``

        if (idMetodo > 0) 
        {
            opciones = opciones + `<option value="${metodos[index].id}">${metodos[index].metodo}</option>`
        }

        metodos.forEach(metodo => 
        {
            opciones = opciones + `<option value="${metodo.id}">${metodo.metodo}</option>`
        });

        return opciones
    }
</script>