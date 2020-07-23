<footer class="footer footer-big bg-gradient-default">
  <div class="container">
    <div class="content">
      <div class="row mb-5">
        <div class="column mx-auto">
          <h4 class="mb-4">Gracias por visitarnos!</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <div class="column">
            <h4 class="mb-4">MercadoLibre</h4>
            <ul class="links-vertical">
              <p>También tenemos una tienda online en MercadoLibre, clickea en el ícono debajo para visitarla.</p>
              {{-- <li>
                <a href="https://eshops.mercadolibre.com.ar/yugiohparaelpueblo" target="_blank" type="button" class="text-white btn bg-primary">
                  <span class="btn-inner--icon">Visitar MercadoLibre</span>
                </a>
              </li> --}}
              <li>
                <a href="https://eshops.mercadolibre.com.ar/yugiohparaelpueblo" target="_blank" class="btn-icon-only btn bg-warning text-white">
                  <span class="btn-inner--icon"><i class="ni ni-shop"></i></span>
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-12 text-capitalize">
          <div class="column">
            <h4 class="mb-4">comprar</h4>
            <ul class="links-vertical">
              <li>
                <a href="/">
                  HOME PAGE
                </a>
              </li>
              <li>
                <a href="/ofertas">ofertas</a>
              </li>
              <li>
                <a href="/cartas">
                  cartas sueltas
                </a>
              </li>
              <li>
                <a href="/productos-relacionados">
                  productos relacionados
                </a>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="col-md-3 col-12 text-capitalize">
          <div class="column">
            <h4 class="mb-4">información</h4>
            <ul class="links-vertical">
              <li>
                <a href="/info#comoComprar">¿Cómo Comprar?</a>
              </li>
              <li>
                <a href="/info#preguntas">
                  preguntas frecuentes
                </a>
              </li>
              <li>
                <a href="/info#devolucion">
                  política de devolución
                </a>
              </li>
              <li>
                <a href="/info#terminos">
                  términos y condiciones de venta
                </a>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="title text-center">
          <h3 class="text-white mb-0 pb-3 pl-3">Compartir</h3>
        </div>
        <div class="social-line col-lg-12 social-line-big-icons">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 mt-3 col-md-6">
                <a href="https://twitter.com/intent/tweet?text=Visitá%20la%20web%20de%20Yu-Gi-Oh!%20Para%20El%20Pueblo%20¡HAY%20OFERTAS%20EXCLUSIVAS%20DISPONIBLES%20POR%20TIEMPO%20LIMITADO!%20&amp;url={{ route('Landing') }}&amp;hashtags=YuGiOhParaElPueblo" target="_blank" class="btn btn-gradient-twitter btn-footer">
                  <i class="fab fa-twitter"></i>
                  <p class="title text-capitalize">twitter</p>
                  <p class="subtitle">compartir</p>
                </a>
              </div>
              <div class="col-lg-4 mt-3 col-md-6">
                <a href="https://www.facebook.com/sharer/sharer.php?u{{ route('Landing') }}" target="_blank" class="btn btn-gradient-facebook btn-footer">
                  <i class="fab fa-facebook-square"></i>
                  <p class="title text-capitalize">facebook</p>
                  <p class="subtitle">compartir</p>
                </a>
              </div>
              <div class="col-lg-4 mt-3 col-md-6">
                <a href="https://api.whatsapp.com/send?text=Visitá%20la%20web%20de%20Yu-Gi-Oh!%20Para%20El%20Pueblo%20¡HAY%20OFERTAS%20EXCLUSIVAS%20DISPONIBLES%20POR%20TIEMPO%20LIMITADO!%20&amp;{{ route('Landing') }}" target="_blank" class="btn btn-gradient-slack btn-footer">
                  <i class="fab fa-whatsapp"></i>
                  <p class="title text-capitalize">WhatsApp</p>
                  <p class="subtitle">compartir</p>
                </a>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>
    <hr class="bg-white opacity-3">
    <div class="row">
      <div class="col-lg-12">
        <div class="column">
          <ul class="d-flex justify-content-start">
            <li>
              <a href="http://www.corvalangonzalo.xyz" target="_blank" class="nav-link text-white">
                Ésta página fue hecha por <u>Gonzalo Salvador Corvalán</u>
              </a>
            </li>
          </ul>
        </div>
      </div>
      
      <div class="col-lg-12">
        <div class="column">
          <ul class="d-flex justify-content-end">
            <li>
              <a href="https://www.creative-tim.com/">Diseño frontend por &copy; 2020 <u>Creative Tim</u></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
@guest
@else
@include('sections.modal-cart')
@endguest