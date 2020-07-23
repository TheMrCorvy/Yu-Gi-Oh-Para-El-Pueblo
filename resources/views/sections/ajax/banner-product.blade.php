@if (isset($imagenes->ubicacion_archivo_imagen))
    <div id="productCarousel" class="carousel slide" data-ride="carousel" data-interval="8000">
        <ol class="carousel-indicators mt-5">
            <li data-target="#productCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#productCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block" src="{{ $imagenes->link_img }}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block" src="{{ $imagenes->ubicacion_archivo_imagen }}" alt="Second slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
            <button type="button" class="btn btn-warning btn-icon btn-round btn-sm" name="button">
                <i class="ni ni-bold-left"></i>
            </button>
        </a>
        <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
            <button type="button" class="btn btn-warning btn-icon btn-round btn-sm" name="button">
                <i class="ni ni-bold-right"></i>
            </button>
        </a>
    </div>
@else
    <div id="productCarousel" class="carousel slide" data-ride="carousel" data-interval="8000">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active container">
                <img class="d-block" src="{{ $imagenes->link_img }}" alt="{{ $imagenes->link_img }}">
            </div>
        </div>
    </div>
@endif