@if ($categories->count() > 1) 
<li class="nav-item dropdown">
    <a class="nav-link nav-link-icon text-capitalize dropdown-toggle" href="#" id="navbar-success_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        categorías
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-success_dropdown_1">
        @foreach ($categories as $category)    
            <a class="dropdown-item menu-responsive text-capitalize" scroll-to="cartas-sueltas" href="{{ route('Categoria', $category->ruta) }}">{{ $category->categoria }}</a>
            <div class="dropdown-divider"></div>
        @endforeach
        <a class="dropdown-item menu-responsive text-capitalize" scroll-to="cartas-sueltas" href="{{ route('Productos General') }}">Productos General</a>
    </div>
</li>
@elseif($general->count() >= 1)
<li class="nav-item">
    <a class="nav-link nav-link-icon text-capitalize" href="{{ route('Productos General') }}" role="button" >
        productos general
    </a>
</li>
@else

@endif