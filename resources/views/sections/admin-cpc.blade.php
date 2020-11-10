<hr class="col-lg-12 my-8">

<h1 class="h1 title text-center col-lg-12 text-capitalize"><u>Categorías, Tipos de Productos, tipos de cartas</u></h1>
                
<div class="col-lg-12 container row d-flex justify-content-between">
    <div class="col-lg-6">
        <div class="accordion-1">
            <div class="container">
                <div class="row">
                <div class="col-md-12 ml-auto">
                    <div class="accordion my-3" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link w-100 text-primary text-left" type="button" data-toggle="collapse" data-target="#collapseOneCrear" aria-expanded="true" aria-controls="collapseOne">
                            Crear un Nuevo Tipo de Producto
                            <i class="ni ni-bold-down float-right"></i>

                            </button>
                        </h5>
                        </div>

                        <div id="collapseOneCrear" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body opacity-8">
                            <form method="POST" action="{{ route('admin.create-type') }}" class="col-lg-12">
                                @csrf
                                <h5 class="h5 title text-capitalize text-success">crear tipo de producto</h5>
                                <div class="form-group mt-4">
                                    <label class="form-control-label">Tipo de Producto:</label>
                                    <input id="tipoProductoCrear" name="tipoProductoCrear" class="form-control @error('tipoProductoCrear') is-invalid @enderror" type="text" value="{{ old('tipoProductoCrear') }}">
                                    @error('tipoProductoCrear')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        
                                  <div class="form-group col-lg-12 text-center">
                                    <input class="btn btn-success" type="submit" value="guardar">
                                </div>
                            </form>   
                        </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link w-100 text-primary text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwoCrear" aria-expanded="false" aria-controls="collapseTwo">
                            Crear una Nueva Categoría
                            <i class="ni ni-bold-down float-right"></i>

                            </button>
                        </h5>
                        </div>
                        <div id="collapseTwoCrear" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body opacity-8">
                            <form method="POST" action="{{ route('admin.create-category') }}" class="col-lg-12">
                                @csrf
                                <h5 class="h5 title text-capitalize text-success">crear categoría</h5>
                                <div class="form-group mt-4">
                                    <label class="form-control-label">Nombre Completo Categoría:</label>
                                    <input id="nombreCategoryCrear" name="nombreCategoryCrear" class="form-control @error('nombreCategoryCrear') is-invalid @enderror" type="text" value="{{ old('nombreCategoryCrear') }}">
                                    @error('nombreCategoryCrear')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group mt-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="rutaCategoryCrear">
                                            URL Para La Categoría 
                                            <br>
                                            <small>
                                                (No Incluyas Espacios, Ni " / ", Ni Acentos, Ni "Ñ")
                                            </small>
                                        </label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">yugiohparaelpueblo.com/</span>
                                          </div>
                                          <input type="text" id="rutaCategoryCrear" name="rutaCategoryCrear" class="form-control @error('rutaCategoryCrear') is-invalid @enderror" value="{{ old('rutaCategoryCrear') }}">
                                        </div>
                                        @error('rutaCategoryCrear')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        
                                  <div class="form-group col-lg-12 text-center">
                                    <input class="btn btn-success" type="submit" value="guardar">
                                </div>
                            </form>   
                        </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link w-100 text-primary text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeCrear" aria-expanded="false" aria-controls="collapseThree">
                            Crear un Nuevo Tipo de Carta
                            <i class="ni ni-bold-down float-right"></i>

                            </button>
                        </h5>
                        </div>
                        <div id="collapseThreeCrear" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body opacity-8">
                            <form method="POST" action="{{ route('admin.create-type-carta') }}" class="col-lg-12">
                                @csrf
                                <h5 class="h5 title text-capitalize text-success">crear tipo de carta</h5>
                                <div class="form-group mt-4">
                                    <label class="form-control-label">Tipo de Carta:</label>
                                    <input id="tipoCartaCrear" name="tipoCartaCrear" class="form-control @error('tipoCartaCrear') is-invalid @enderror" type="text" value="{{ old('tipoCartaCrear') }}">
                                    @error('tipoCartaCrear')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        
                                  <div class="form-group col-lg-12 text-center">
                                    <input class="btn btn-success" type="submit" value="guardar">
                                </div>
                            </form>  
                        </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
                </div>
            </div>
            </div>
    </div>
    
    <div class="col-lg-6">
        <div class="accordion-1">
            <div class="container">
                <div class="row">
                <div class="col-md-12 ml-auto">
                    <div class="accordion my-3" id="accordionExample2">
                    <div class="card">
                        <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link w-100 text-primary text-left" type="button" data-toggle="collapse" data-target="#collapseOneEditar" aria-expanded="true" aria-controls="collapseOne">
                            Editar Tipos de Productos
                            <i class="ni ni-bold-down float-right"></i>

                            </button>
                        </h5>
                        </div>

                        <div id="collapseOneEditar" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample2">
                        <div class="card-body opacity-8">
                            @foreach ($typeProducts as $typeProduct)
                            <form action="{{ route('admin.edit-type', $typeProduct->id) }}" method="POST" class="col-lg-12">
                                @csrf
                                <label class="form-control-label">Número para el Excel: {{ $typeProduct->id }}</label>
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control @error('tipoProductoEditar') is-invalid @enderror" name="tipoProductoEditar" value="{{ $typeProduct->tipo_producto }}">
                                    <div class="input-group-append">
                                      <input class="btn btn-outline-primary" type="submit" value="guardar"></input>
                                    </div>
                                    @error('tipoProductoEditar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </form>
                            @endforeach
                        </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link w-100 text-primary text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Editar Categorías
                            <i class="ni ni-bold-down float-right"></i>

                            </button>
                        </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample2">
                        <div class="card-body opacity-8">
                            @foreach ($categories as $category)
                                <form method="POST" action="{{ route('admin.edit-category', $category->id) }}" class="col-lg-12">
                                    @csrf
                                    <h5 class="h5 title text-capitalize text-primary">Número para el Excel: {{ $category->id }}</h5>
                                    <div class="form-group mt-4">
                                        <label class="form-control-label">Nombre Completo Categoría:</label>
                                        <input name="nombreCategoryEditar" class="form-control @error('nombreCategoryEditar') is-invalid @enderror" type="text" value="{{ $category->categoria }}">
                                        @error('nombreCategoryEditar')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group mt-4">
                                        <div class="form-group">
                                            <label class="form-control-label text-capitalize" for="rutaCategoryCrear">URL para la Categoría <br><small>(No incluyas espacios, ni " / ", ni acentos, ni "Ñ")</small></label>
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">yugiohparaelpueblo.com/</span>
                                            </div>
                                            <input type="text" name="rutaCategoryEditar" class="form-control @error('rutaCategoryEditar') is-invalid @enderror" value="{{ $category->ruta }}">
                                            </div>
                                            @error('rutaCategoryEditar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                            
                                    <div class="form-group col-lg-12 text-center">
                                        <input class="btn btn-primary" type="submit" value="guardar">
                                    </div>
                                </form> 
                            @endforeach
                        </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" id="headingThree">
                        <h5 class="mb-0">
                            <button class="btn btn-link w-100 text-primary text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeEditar" aria-expanded="false" aria-controls="collapseThree">
                            Editar Tipos de Cartas
                            <i class="ni ni-bold-down float-right"></i>

                            </button>
                        </h5>
                        </div>
                        <div id="collapseThreeEditar" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample2">
                        <div class="card-body opacity-8">
                            @foreach ($typeCartas as $typeCarta)
                            <form action="{{ route('admin.edit-type-carta', $typeCarta->id) }}" method="POST" class="col-lg-12">
                                @csrf
                                <label class="form-control-label">Número para el Excel: {{ $typeCarta->id }}</label>
                                <div class="input-group mb-4">
                                    <input type="text" class="form-control @error('tipoCartaEditar') is-invalid @enderror" name="tipoCartaEditar" value="{{ $typeCarta->tipo_carta }}">
                                    <div class="input-group-append">
                                      <input class="btn btn-outline-primary" type="submit" value="guardar"></input>
                                    </div>
                                    @error('tipoCartaEditar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </form>
                            @endforeach
                        </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
                </div>
            </div>
            </div>
    </div>
</div>