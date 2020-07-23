<div class="row align-items-center">
  @foreach ($otros as $otro)    
  <div class="col-lg-3">
    <div class="card card-blog card-background" data-animation="zooming">
      <div class="full-background" style="background-image: url('{{ $otro->link_img }}')"></div>
      <a href="{{ route('Producto', $otro->id) }}">
        <div class="card-body">
          <div class="content-bottom">
            <h6 class="card-category text-white opacity-8">{{ $otro->producto }}</h6>
            <h5 class="card-title">{{ $otro->nombre }}</h5>
          </div>
        </div>
      </a>
    </div>
  </div>
  @endforeach
</div>