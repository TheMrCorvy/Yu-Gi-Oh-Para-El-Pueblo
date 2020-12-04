@extends('layouts.app', ['class' => 'bg-secondary'])

@section('content')
    <div class="main">
        <div class="container">
            <div class="row py-5">

                <h1 class="h1 title text-center col-lg-12 pt-6"><u>Zona de Administración</u></h1>

                <div class="col-lg-12">
                    @if (Session::has('message'))    
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif
                    @if (Session::has('errors'))    
                        <div class="alert alert-danger" role="alert">
                            <strong>Hubo un error, por favor revisá lo que estabas haciendo.</strong>
                        </div>
                    @endif
                </div>
                
                <div class="form-group col-lg-6 my-auto">
                    <form method="post" action="{{ route('multiplicador.edit') }}">
                        @csrf
                        <label for="example-text-input" class="form-control-label">Multiplicador de precios (A cuánto está el dolar?)</label>
                        <div class="input-group mb-3">
                        <input name="dolarActual" type="number" class="form-control" value="{{ $dolar[0]->multiplicador }}">
                            <div class="input-group-append">
                                <input class="btn btn-outline-primary" type="submit" value="actualizar"></input>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="form-group col-lg-6 mt-5">
                    <h4 class="title text-center">Generar Cupón de Descuento</h4>
                    
                    <form action="{{ route('Generar Cupon') }}" method="post" class="row">
                        @csrf
                        <div class="col-lg-12">
                            <label for="example-text-input" class="form-control-label">Fecha de caducidad:</label>
                            <div class="input-group mb-3"> 
                                <input type="date" class="form-control @error('fechaCupon') is-invalid @enderror" name="fechaCupon"/>
                                <div class="input-group-append">
                                <input class="btn btn-outline-success" type="submit" value="generar"/>
                            </div>
                            @error('fechaCupon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-control-label">Porcentaje de Descuento:</label>
                                  <select id="descuentoCupon" name="descuentoCupon" class="form-control @error('descuentoCupon') is-invalid @enderror">
                                      <option value="5">5%</option>
                                      <option value="7">7%</option>
                                      <option value="10">10%</option>
                                      <option value="12">12%</option>
                                      <option value="15">15%</option>
                                      <option value="18">18%</option>
                                      <option value="20">20%</option>
                                      <option value="25">25%</option>
                                      <option value="30">30%</option>
                                      <option value="35">35%</option>
                                      <option value="40">40%</option>
                                      <option value="45">45%</option>
                                      <option value="50">50%</option>
                                      <option value="55">55%</option>
                                      <option value="60">60%</option>
                                      <option value="65">65%</option>
                                      <option value="75">75%</option>
                                      <option value="80">80%</option>
                                      <option value="85">85%</option>
                                      <option value="90">90%</option>
                                      <option value="95">95%</option>
                                  </select>

                            @error('descuentoCupon')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>

                    <a href="{{ Route('Ver Cupones') }}" class="title card-link text-center ">Mostrar cupones disponibles.</a>

                    @if (Session::has('cupones'))    
                        @foreach (Session::get('cupones') as $cupon)    
                            <div class="alert alert-success" role="alert">
                                Cupón disponible para usar: <strong>{{ $cupon->codigo }}</strong> <br> Fecha de caducidad: <strong>{{ $cupon->fecha }}</strong> (Año-Mes-Día)<br>
                            </div>
                        @endforeach
                    @endif
                </div>

                <hr class="col-lg-12 my-8">

                <h1 
                    class="h1 title text-center col-lg-12 text-capitalize pb-4"
                >
                    <a href="{{ route('admin.list-pakages') }}">
                        <u>
                            ver pedidos pendientes de revisión
                        </u>
                    </a>
                </h1>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pb-0">
                            <h3 class="text-left pb-3">Paquetes listos para importar</h3>
                            <table class="table table-responsive table-striped px-0">
                                <thead>
                                    <tr>
                                        <th >Fecha (DD/MM/AAAA)</th>
                                        <th>Número de Pedido</th>
                                        <th class="text-center">Ver Detalle</th>
                                        <th class="text-center">Estado</th>
                                        <th>Fecha límite del presupuesto (si la hay)</th>
                                        <th class="text-center">Comentario</th>
                                        <th class="text-right">Usuario</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($paquetesParaImportar->count() < 1)
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>No hay ningún pedido de importación de cartas actualmente.</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @else
                                        @foreach ($paquetesParaImportar as $paquete)    
                                            <tr>
                                                <td class="text-center">{{ $paquete->created_at->format('d/m/Y') }}</td>
                                                
                                                <td class="text-center">{{ $paquete->id }}</td>
                                                
                                                <td class="text-center">
                                                    <a href="{{route('admin.list-pakage-details', $paquete->id)}}">Ver Detalle del Paquete</a>
                                                </td>
                                                
                                                <td class="text-capitalize">{{ $paquete->estado }}</td>

                                                @if (!is_null($paquete->fecha_caducidad_precio))
                                                    <td class="text-center">{{ $paquete->fecha_caducidad_precio->format('d/m/Y') }}</td>
                                                @else
                                                    <td class="text-center">Aún no hay presupuesto</td>
                                                @endif
                                                
                                                @if (!is_null($paquete->comentario_al_paquete))
                                                    <td>{{ $paquete->comentario_al_paquete }}</td>
                                                @else
                                                    <td>No hay ningún comentario en este paquete</td>
                                                @endif

                                                <td class="text-right">
                                                    <a href="{{route('admin.list-pakage-details', $paquete->id)}}">{{$paquete->username}}</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                            <div class="pagination-container d-flex justify-content-center">
                                {{ $paquetesParaImportar->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="col-lg-12 my-8">

                <h1 class="h1 title text-center col-lg-12 text-capitalize"><u>excel</u></h1>
                
                <div class="col-lg-12 pt-5 text-center">
                    <form action="{{ route('admin.excel-import') }}" method="post" class="row justify-content-between" enctype="multipart/form-data">
                        @csrf
                        <div class="custom-file col-lg-8 mt-2">
                            <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="file" name="file" lang="es">
                            <label class="custom-file-label" for="file">Elegir Archivo</label>
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="submit" value="importar" class="btn btn-success mt-2 col-lg-3">
                    </form>
                    
                </div>

                <div class="col-lg-12 pt-5 text-center">
                    <a href="{{ route('admin.excel-productos') }}" class="btn btn-outline-success">Exportar todos los productos en un archivo excel</a>
                </div>
                <a href="javascript:;" class="btn btn-link mt-4" data-toggle="modal" data-target="#bd-example-modal-xl">instrucciones importar excel <i class="fas fa-info-circle text-primary"></i></a>

                <hr class="col-lg-12 my-8">

                <h1 class="h1 title text-center col-lg-12 text-capitalize"><a href="{{ route('admin.compras') }}"><u>ventas del último mes</u></a></h1>

                @include('sections.admin-cpc', [
                    'typeProducts' => $typeProducts,
                    'typeCartas' => $typeCartas,
                    'categories' => $categories,
                ])

                <hr class="col-lg-12 my-8">

                <h1 class="h1 title text-center col-lg-12"><u>Agregar un Producto</u></h1>

                @include('sections.admin-forms')

                <hr class="col-lg-12 my-8">

                <h1 class="h1 title text-center col-lg-12"><u>Editar un Producto</u></h1>

                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="example-text-input" class="form-control-label">Buscar</label>
                                <input type="text" class="form-control" id="barraBusqueda">
                            </div>
                        </div>
                        <div class="col-lg-12 ml-1 container row" id="resultados">
                                
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', () => {
            let barraBusqueda = document.getElementById('barraBusqueda')

            //escuchar cuando y lo que se escribe en el input
            barraBusqueda.addEventListener('keyup', () => {
                if (barraBusqueda.value.length >= 1) 
                {
                    let resultados = document.getElementById('resultados')

                    resultados.innerHTML = "<h5 class='h5 title mt-5'>Buscando...</h5>"

                    //hay que buscar pasando los parametros de busqueda por get
                    fetch('/api/v1/APIPage/BuscarProducto/' + barraBusqueda.value, {
                        method: 'GET',
                        headers: {
                                    'Content-Type': 'application/json',
                                },
                    })

                    .then(response => response.text())

                    .then(html => {
                        resultados.innerHTML = ''
                        resultados.innerHTML = html
                    })
                }else{
                    resultados.innerHTML = ''
                }
            })
        })
    </script>


@include('sections.modal-instrucciones')
@endsection