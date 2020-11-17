<nav class="navbar navbar-expand-lg navbar-transparent headroom headroom--not-bottom headroom--not-top headroom--pinned ">
  <div class="container">
      <a class="navbar-brand" href="{{ route('Landing') }}">Yu-Gi-Oh! para el Pueblo</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-success" aria-controls="navbar-success" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar-success">
          <div class="navbar-collapse-header">
              <div class="row">
                  <div class="col-10 collapse-brand"> 
                      <a href="{{ route('Landing') }}">
                          Yu-Gi-Oh! para el Pueblo
                      </a>
                  </div>
                  <div class="col-2 collapse-close">
                      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-success" aria-controls="navbar-success" aria-expanded="false" aria-label="Toggle navigation">
                          <span></span>
                          <span></span>
                      </button>
                  </div>
              </div>
          </div>
          
          <ul class="navbar-nav navbar-nav-hover ml-lg-auto">
              <li class="nav-item dropdown">
                  <a class="nav-link nav-link-icon text-capitalize dropdown-toggle" href="#" id="navbar-success_dropdown_1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      comprar
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-success_dropdown_1">

                      <a class="dropdown-item menu-responsive text-capitalize" scroll-to="cartas-sueltas" href="/cartas">yu-gi-oh! comprar cartas</a>
                      {{-- <div class="dropdown-divider"></div> --}}
                      <a class="dropdown-item menu-responsive text-capitalize" scroll-to="productos" href="/productos-relacionados">yu-gi-oh! productos</a>
                      <a class="dropdown-item menu-responsive text-capitalize" scroll-to="productos" href="/ofertas">ofertas disponibles</a>
                  </div>
              </li>

              <div id="categorias">
                    <div class="spinner-grow mt-2" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
              </div>


              @guest
                  <li class="nav-item dropdown">
                      <a class="nav-link nav-link-icon text-capitalize dropdown-toggle" id="navbar-success_dropdown_1" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown">
                          login / registro
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-success_dropdown_1">
                          <a class="dropdown-item text-capitalize" href="{{ route('login') }}">ingresar</a>

                          @if (Route::has('register'))
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item text-capitalize" href="{{ route('register') }}">registrarse</a>
                          @endif
                      </div>
                  </li>
              @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @can('admin.index')
                            <a class="dropdown-item text-capitalize" href="{{ route('admin.index') }}">administrar sitio web</a>
                            @endcan
                            <a class="dropdown-item text-capitalize" href="{{ route('Importar Cartas') }}">importar cartas</a>
                            <a class="dropdown-item text-capitalize" href="{{ route('Editar Perfil') }}">editar mi perfil</a>
                            
                            {{-- <a class="dropdown-item text-capitalize" href="{{ route('Pedidos') }}">armar un pedido</a> --}}
                            
                            <a class="dropdown-item text-capitalize" href="{{ route('home', Auth::user()->username) }}">mis compras</a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Cerrar Sesión
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
              @endguest

              
              @guest
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="{{ route('login') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="nav-link-inner--text d-lg-none text-capitalize">carrito de compras</span>
                        </a>
                    </li>
              @else
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon text-capitalize" href="{{ route('login') }}" data-toggle="modal" data-target=".shoppingCartModal">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="nav-link-inner--text d-lg-none">carrito de compras</span>
                            <span class="badge badge-default">{{ Cart::session(auth()->id())->getTotalQuantity() }}</span>
                        </a>
                    </li>
              @endguest
          </ul>
          
      </div>
  </div>
</nav>