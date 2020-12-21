@extends('layouts.app', ['class' => 'product-page'])

@section('content')
  <div class="wrapper">
    @include('sections.barra-busqueda')
    
    <section class="section" style="z-index: 30 !important; margin-top: -100px !important;" id="preguntas">
      <div class="testimonials-3">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 mx-auto text-center">
              <h3 class="display-3">Preguntas Frecuentes</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-8 col-10 positioned">
              <h3 class="display-3">Bienvenido/a a nuestra Seccón de Información</h3>
              <p class="lead">
                Aquí podrás encontrar respuestas a algunas preguntas frecuentes acerca de nuestro sitio. Incluyendo temas como medios de pago, envíos, compras, entre otros.
              </p>
            </div>
            {{-- <div class="col-md-12"> --}}
              <div class="testimonial-glide col-md-12" id="ocultar">
                <div class="glide__arrows" data-glide-el="controls">
                  <button class="glide__arrow glide__arrow--left text-default" data-glide-dir="<"><i class="ni ni-bold-left"></i></button>
                  <button class="glide__arrow glide__arrow--right text-default" data-glide-dir=">"><i class="ni ni-bold-right"></i></button>
                </div>
                <div class="glide__track" data-glide-el="track">
                  <ul class="glide__slides">
                    <li class="glide__slide" style="padding-right: 30px !important">
                      <div class="info text-left" style="height: 100% !important; width: auto !important;">
                        <div class="author title px-2 py-2">
                          <span>¿Qué formas de pago están disponibles?</span>
                        </div>
                        <div class="description px-2 py-2">
                          <p>Disponemos de los siguientes medios de pago:<br />
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/visa@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/mastercard@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/amex@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/diners@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/banelco@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/cabal@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/tarjeta-naranja@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/tarjeta-shopping@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/mercadopago@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/argencard@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/nativa@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/ar/cencosud@2x.png" /> 
                            {{-- <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/pagofacil@2x.png" /> 
                            <img alt="" class="user-page-logos" style="width: 45px; margin: 0 !important;" src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/rapipago@2x.png" /> --}}
                            <br><br>
                            O también en efectivo, y obtendrás un descuento del 5% sobre el valor total de los productos (no acumulable con el uso de cupones).
                          </p>
                        </div>
                      </div>
                    </li>
                    <li class="glide__slide" style="padding-right: 30px !important">
                      <div class="info text-left" style="height: 100% !important; width: auto !important;">
                        <div class="author px-2 py-2">
                          <span>¿Puedo retirar mi compra en persona?</span>
                        </div>
                        <p class="description px-2 py-2">
                          Sí. En el checkout, al momento de elegir el medio de pago, también deberás elegir si pedir envío, o retiro en persona. <br><br> Para ambos casos deberás ponerte en contacto con nosotros luego de tu compra.
                        </p>
                      </div>
                    </li>
                    <li class="glide__slide" style="padding-right: 30px !important">
                      <div class="info text-left" style="height: 100% !important; width: auto !important;">
                        <div class="author px-2 py-2">
                          <span>¿Cómo son los envíos?</span>
                        </div>
                        <p class="description px-2 py-2">
                          Nosotros contamos con distintas modalidades de entrega. Durante el proceso de pagos, podrás elegir entre envío por Correo Argentino y/o retiro en persona en el local.
                          <br>
                          Al elegir una modalidad de envío, se sumará al precio total de todos los productos en tu carrito de compras.
                        </p>
                      </div>
                    </li>
                    <li class="glide__slide" style="padding-right: 30px !important">
                      <div class="info text-left" style="height: 100% !important; width: auto !important;">
                        <div class="author px-2 py-2">
                          <span>¿Cuál es el plazo para realizar cámbios o devoluciones?</span>
                        </div>
                        <p class="description px-2 py-2">
                          Podrás solicitar un cambio o devolución de los productos comprados, en un período de <u class="text-danger">10 días</u> luego de realizada la compra.
                        </p>
                      </div>
                    </li>
                    <li class="glide__slide" style="padding-right: 30px !important">
                      <div class="info text-left" style="height: 100% !important; width: auto !important;">
                        <div class="author px-2 py-2">
                          <span>¿Qué debo hacer si mis compras llegan en mal estado?</span>
                        </div>
                        <p class="description px-2 py-2">
                          Podés escribirnos a <u class="text-primary">info@yugiohparaelpueblo.com</u> o a nuestro <u class="text-success">WhatsApp</u> para exigir un cambio o devolucion por los items dañados. <br>
                          Como mínimo se te pedirán fotos del estado de los productos al momento de recibirlos, pero la mejor forma de facilitar el proceso es grabar en video el momento de la apertura del embalaje del paquete.
                        </p>
                      </div>
                    </li>
                  </ul>
                </div>
                
              </div>
            {{-- </div> --}}
          </div>
        </div>
      </div>
    </section>

    <section class="section mt-5" id="comoComprar">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h3 class="title">¿Cómo Comprar?</h3>
            <ol>
              <li>
                <p>Elejí el producto que quieras comprar. Podés recorrer nuestro catálogo completo, por categorías, o utilizando el buscador ubicado en la parte superior de la página.</p>
              </li>
              <li>
                <p>Cuando encuentres el producto que estás buscando, hacé click en el botón de "Agregar al Carrito" (<u class="text-danger">tené en cuenta que deberás iniciar sesión o registrarte</u> para poder agregar productos a tu carrito de compras. Podrás hacerlo haciendo dirigiendote a la sección de "Login / Registro" en la barra de navegación de la página), esto agregará el producto a tu carrito y clickeando en el ícono del carrito en la parte superior derecha de la pantalla, tendras la "Vista Rápida" del mísmo, en donde podrás ver qué productos agregaste, podrás modificar la cantidad de cada uno, y tendrás disponible cuánto será el precio final por todo lo añadido. Si querés seguir agregando productos, es tan sencillo como continuar navegando hasta encontrar otro producto que te interese.</p>
              </li>
              <li>
                <p>Una vez estés satisfecho con todos los productos que hayas agregado al carrito, y desees finalizar tu compra, dirígete a la "Vista Rápida", y a continuación al boton azul de "Comprar Ahora".</p>
              </li>
              <li>
                <p>Dentro del Checkout se te pedirá que completes con tus datos de facturación, que elijas uno de los medios de pago disponibles dentro de ésta página, y también si retirarás tus productos en persona o si deseas que te los enviemos a tu domicilio.</p>
              </li>
              <li>
                <p>Dentro del Checkout tendrás la posibilidad de ingresar un cupón de descuento. El porcentaje de descuento proporcionado por el cupón se aplicará al monto total de tu carrito, sin importar cuántos productos estés comprando. <u class="text-danger">El descuento del 5% pagando en efectivo NO es acumulable con el descuento proporcionado por un cupón</u>, pero si se podrá aplicar al comprar productos que se encuentren en oferta individualmente.</p>
              </li>
              <li>
                <p>Habiendo elegido la forma de pago y el medio de envío, deberás completar los datos que te serán requeridos, para de ésta forma poder proceder al cobro y la emisión de Factura por la venta. Puedes estar tranquilo, ya que tus datos permanecerán seguros y codificados en todo momento gracias a las tecnologías de <u class="text-info">MercadoPago</u>, y la <u class="text-success">Codificación SSL</u> de éste sitio web.</p>
              </li>
              <li>
                <p>En caso de no haber ningún problema con la entidad financiera proveedora de la tarjeta de débito / crédito, se te redirijirá a tu sección de "Mis Compras", en donde verás el detalle de tu orden de compra recién realizada.</p>
                <p>En el caso de que se encuentra algún problema, luego de haber enviado el formulario con tus datos, se te mostrará dentro del mismo checkout, un texto rojo que te indicará cuál fue el motivo por el que no se pudo concretar la transacción y se te pedirá que lo corrijas para luego reenviar el formulario. (Ésto no generará pagos duplicados en tu tarjeta, ni reducirá el stock disponible de los productos actualmente en tu carrito de compras hasta que envíes el formulario con los datos correctos y seas redirigido a tu sección de "Mis Compras").</p>
              </li>
            </ol>
            <strong>Los productos en tu carrito de compras no serán reservados hasta que termines de realizar la compra, habiendo finalizado exitósamente el proceso del Checkout.</strong><br><br>
            <strong>Los productos en tu carrito de compras permanecerán mientras mantengas la sesión iniciada, y no se mantendrán al cerrar sesión y volver a ingresar.</strong><br><br>
            <strong>Un cupón ingresado exitósamente será consumido de inmediato al finalizar la compra.</strong>
          </div>
        </div>
      </div>
    </section>
    <section class="section mt-5" id="terminos">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h3 class="title">Términos y Condiciones de Venta:</h3>
            <p><u>Los presentes términos y condiciones generales, regulan el uso del sitio web: </u><br><u class="text-info">https://yugiohparaelpueblo.com</u> Cualquier persona que desee usar los servicios de Yu-Gi-Oh! Para El Pueblo, visitar el sitio web y realizar transacciones, quedará sujeta a los términos y condiciones que aquí se describen. Resultarán aplicables los términos y condiciones a la legislación de la República Argentina para todos los efectos jurídicos que se produzcan. Para hacer uso del sitio web de Yu-Gi-Oh! Para El Pueblo, los consumidores deben leer y aceptar las condiciones establecidas en los términos y condiciones. Quién haga uso de éste sitio acepta las condiciones del servicio quedando sujeta a ellas.</p>
            <p>Las imágenes que acompañan a cada producto son de carácter ilustrativo y sólo a fines orientativos, por lo que no necesariamente reflejan el producto final. Cada consumidor se declara con plena capacidad para utilizar tarjetas de crédito y que las mismas tienen fondos suficientes para cubrir todos los costes que resultan de la compra de productos a través de <u class="text-info">https://yugiohparaelpueblo.com</u> al presionar el botón de "Finalizar Compra" durante el proceso de compra, el consumidor declara aceptar plenamente y sin reservas la totalidad de las presentes términos y condiciones generales. Yu-Gi-Oh! Para El Pueblo confirmará su pedido de compra a través del envío de un correo electrónico al email utilizado por el usuario para inicias sesión, o pagar mediante tarjetas de crédito o débito. En los precios de nuestros productos están incluidos todos los impuestos, pero no incluyen los gastos de transporte, el cual correrá por cuenta del comprador luego de finalizada la compra.</p>
            <p>Yu-Gi-Oh! Para El Pueblo se reserva el derecho a modificar sus precios en cualquier momento sin previo aviso, pero los productos se facturarán sobre la base de las tarifas en vigor en el momento del registro de los pedidos.</p>
            <h6 class="title">Disponibilidad</h6>
            <p>Yu-Gi-Oh! Para El Pueblo hará todo lo posible para satisfacer la demanda de los productos por parte de los consumidores. En caso de indisponibilidad del producto después de haberse realizado el pedido el usuario, sin que el mismo haya consultado con anterioridad la disponiblidad del mismo por algun medio de contacto, será informado por correo electrónico de la anulación de su orden de compra. En virtud de esto la rapidéz de la devolución en la cuenta bancaria del cliente dependerá del tipo de tarjeta bancaria y de las condiciones de cada entidad bancaria.</p>
            <h6 class="title">Pagos</h6>
            <p>Yu-Gi-Oh! Para El Pueblo acepta como medios de pago, tanto pago en efectivo en persona, como cualquiera de las siguientes tarjetas bancarias: Visa, American Express, Master Card, Argencard, Naranja, Cabal, Shopping e Italcred, por medio de MercadoPago. En caso de denegación de la tarjeta, se cancelará automáticamente el pedido, informando online al cliente de dicha anulación.</p>
            <p>NOTA: Todas las tarjetas de crédito están sujetas a la aprobación de la entidad financiera que las otorgó. Si la entidad financiera rechazara la operación a nuestro sitio, se producirá una suspensión de la transacción. Por lo tanto el producto no podrá ser entregado, no siendo responsable Yu-Gi-Oh! Para El Pueblo, por la demora o la no entrega de los productos. Tampoco podemos garantizar que una vez resuelto el problema con la tarjeta, el producto se encuentre todavía disponible en stock, dado que el producto no será separado hasta no ser acreditado el pago del mismo.</p>
            <h6 class="title">Seguridad</h6>
            <p>Los datos bancarios introducidos son encriptados y transmitidos de forma segura a los servidores de la entidad bancaria y, posteriormente, son verificados con el banco emisor para evitar posibles fraudes y abusos.</p>
            <p>Éste procedimiento de introducción de datos está garantizado por la tecnología de encriptación ssl (secure socker layer) -128 bits, uno de los sistemas de protección más avanzados y eficaces actualmente disponibles, gracias al cual, ningún tercero tendrá acceso vía internet a esta información relativa a los datos bancarios introducidos por el cliente.</p>
            <h6 class="title">Entrega</h6>
            <p>Cada vez que Yu-Gi-Oh! Para El Pueblo vaya a enviar un pedido, el comprador será notificado mediante el/los medio/s de contacto almacenado/s en el sitio web, o que se le haya sido proporcionado a través de medios externos a Yu-Gi-Oh! Para El Pueblo. los gastos de transporte serán a cuenta del comprador, y se le será proporcionado con un botón o QR de pago especificando los costos del mismo, luego de finalizada la compra y haberse contactado con Yu-Gi-Oh! Par El Pueblo mediante email a <u class="text-primary">info@yugiohparaelpueblo.com</u>, o mediante <u class="text-success">WhatsApp</u> a 11 3771-9677.</p>
            <p>Los tiempos de entrega de los productos pueden variar de acuerdo a el método de envío elegido y la región del país desde donde se solicitó.</p>
            <p>La empresa responsable de la entrega de nuestros productos es <u class="text-success">Correo Argentino</u>. Una vez que el producto haya sido entregado a la empresa transportista, usted recibirá un número de tracking para el seguimiento del producto. Una vez despachada la Orden de Compra, no es posible cambiar la dirección de entrega. La entrega de la mercadería se pactará dentro del domicilio que usted nos proporcionó para ello. De no encontrarse usted en el domicilio al momento de la entrega, la empresa transportista dejara un aviso de visita para que usted pueda retirar su pedido en la sucursal asignada en dicho aviso en un lapso no mayor a 5 días hábiles, de no concurrir en ese plazo tu pedido será devuelto a Yu-Gi-Oh! Para El Pueblo.</p>
            <p>Cada entrega se considera efectuada a partir de la puesta a disposición del producto al cliente por parte del transportista, materializado por el sistema de control utilizado por el transportista. Corresponde al destinatario comprobar el pedido en el momento de la entrega y hacer entonces todas los reclamos que aparecieran justificados, incluso tiene la posibilidad de rechazar el paquete, si éste hubiera sido abierto.</p>
            <h6 class="title">Cambios y Devoluciones</h6>
            <p>Los cambios o devoluciones se podrán hacer durante los <u class="text-danger">10 (diez) días consecutivos</u> siguientes de efectuada la compra.</p>
            <h6 class="title">Jurisdicción y Ley Aplicable</h6>
            <p>El presente contrato se rige por las leyes de la República Argentina.</p>
            <p>Cualquier controversia derivada del presente contrato, su existencia, validez, interpretación, alcance o cumplimiento, será sometida a los tribunales ordinarios de justicia de la nación y los procedimientos se llevarán a cabo en idioma castellano.</p>
          </div>
        </div>
      </div>
    </section>
    <section class="section mt-5" id="devolucion">
      <div class="container">
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h3 class="title">Política de Devolución:</h3>
            <p>Podrás realizar el cambio o devolución de tu compra dentro de los <u class="text-danger">10 días consecutivos</u> a partir de la fecha en la que se realizó la compra. Una vez transcurrido ese lapso de tiempo, Yu-Gi-Oh! Para El Puebo se reserva el derecho de aceptar o rechazar cualquier solicitud de cambio o devolución.</p>
            <p>El costo de devolución y re-envío corre por tu cuenta. Éste se abonará a través de MercadoPago, mediante un botón o QR de pago.</p>
            <p>En caso de que el/los producto/s presentaran fallas (manchas, roturas, desteñido, etc.), por favor enviános un mail a <u class="text-primary">info@yugiohparaelpueblo.com</u>, o un <u class="text-success">WhatsApp</u> a 11 3771-9677, describiendo el inconveniente y adjuntando las fotos o videos correspondientes. A la brevedad evaluaremos tu caso y nos pondremos en contacto para indicarte cómo proceder con el cambio o devolución.</p>
            <h6 class="title">¿Cómo es el proceso?</h6>
            <ol>
              <li>
                <p>
                  Enviános un <u class="text-success">WhatsApp</u> a 11 3771-9677, o un mail a <u class="text-primary">info@yugiohparaelpueblo.com</u> con el asunto "Solicitud de Cambio o Devolución" (según corresponda), especificando los siguientes datos: <br>
                <br>
                A) Datos Personales (nombre, apellido, y número de teléfono en caso de habernos contactado por email). <br>
                B) Número de Orden de Compra (lo podrás encontrar al iniciar sesión en éste sitio, yendo a "Mis Compras"). <br>
                C) Motivo del Cambio o Devolución. <br>
                D) Nombre de referencia del producto que deseas cambiar y del nuevo (en caso de corresponder). <br>
                </p>
              </li>
              <li>
                <p>Una vez confirmada tu solicitud te proveeremos con la dirección para realizar el envío del producto a devolver, y luego deberás acercarte a la sucursal de correo más cercana a tu domicilio para despacharlo.</p>
              </li>
              <li>
                <p>Cuando el paquete llegue a nuestras manos resolveremos la gestión enviandote el nuevo producto (si corresponde), o realizando el reintegro de la compra. Lo que corresponda de acuerdo a lo que hayas solicitado.</p>
              </li>
            </ol>
            <h6 class="title">¿Puedo realizar el cambio o devolución de manera presencial?</h6>
            <p>Sí, para ello debés ponerte en contacto con nosotros enviandonos un mail a <u class="text-primary">info@yugiohparaelpueblo.com</u> con el asunto "Solicitud de Cambio o Devolución" (según corresponda), o un <u class="text-success">WhatsApp</u> a 11 3771-9677, indicándonos tu número de Orden de Compra, y motivo del cambio o devolución. Una vez confirmada tu solicitud, te indicaremos cuando el cambio esté listo para que lo retires por el local, y también te proveeremos con la dirección del mísmo. Deberás entregarnos el/los productos para cambio sin signos de uso y con su embalaje y etiqueta original. En caso de devolución, una vez que nos entregues el/los productos y confirmemos que están en condiciones, procederemos a efectuar el re-embolso de tu compra por el mismo medio por el que fue hecha.</p>
            <strong><u class="text-danger">IMPORTANTE</u> Es crucial para proceder con el cambio o devolución que el/los productos que nos remitas estén embalados correctamente para preservar el estado de los mismos; podés usar el mismo embalaje con el que lo/s recibiste. El/los productos debén ser enviados SIN USO, CON SUS ETIQUETAS Y EMPAQUES ORIGINALES.</strong>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="{{ asset('assets') }}/js/plugins/glide.js" type="text/javascript"></script>
  
  <script>
    if(screen.width <= 991 ){
      new Glide('.testimonial-glide', 
      {
        type: 'carousel',
        startAt: 0,
        focusAt: 0,
        perTouch: 1,
        perView: 1,
      }).mount();

    }else {
      new Glide('.testimonial-glide', 
      {
        type: 'carousel',
        startAt: 0,
        focusAt: 2,
        perTouch: 1,
        perView: 4,
      }).mount();
    }
  </script>
</body>

</html>
@endsection