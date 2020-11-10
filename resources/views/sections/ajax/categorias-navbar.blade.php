@if ($categories->count() >= 1) 
<li class="nav-item dropdown">
    <a class="nav-link nav-link-icon text-capitalize dropdown-toggle" href="#" id="navbar-success_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        categorías
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-success_dropdown_1">
        @for ($i = 0; $i <= $categories->count(); $i++)
            @isset($categories[$i])
                <a 
                    class="dropdown-item menu-responsive text-capitalize" 
                    href="{{ route('Categoria', $categories[$i]->ruta) }}"
                >
                    {{ $categories[$i]->categoria }}
                </a>

                @isset($categories[++$i])
                    <div class="dropdown-divider"></div>
                @else
                    <div class="dropdown-divider"></div>
                    <a 
                        class="dropdown-item menu-responsive text-capitalize" 
                        href="{{ route('Productos General') }}"
                    >
                    productos general
                    </a>
                @endisset
            @endisset
        @endfor
    </div>
</li>
@else
<li class="nav-item">
    <a class="nav-link nav-link-icon text-capitalize" href="{{ route('Productos General') }}" role="button" >
        productos general
    </a>
</li>
@endif