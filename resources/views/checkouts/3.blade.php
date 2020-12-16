@php
    $usuario = Session::get('usuario');
@endphp
<div class="container">
  <h3 class="title h4 text-center mt-3">Finalizar Compra</h3>
  
  <h4 class="title">Forma de Pago</h4>

  <div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 text-capitalize active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-credit-card mr-2"></i>Pagar online con tarjeta de crédito o débito</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 text-capitalize" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-money-coins mr-2"></i>pago en efectivo en el local</a>
        </li>
    </ul>
</div>
<div class="card card-plain mb-0">
    <div class="card-body pb-0">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

               <form class="js-validate" action="{{ route('Paso Tres') }}" method="post" id="paymentForm">
                @csrf
                <div class="row mb-3">
                  <div class="col-md-6 mt-3">
                    <label class="labels">
                      Nombre Completo
                    </label>
                    <input type="text" class="form-control" required="" value="{{ $usuario->name }}">
                  </div>
                  <div class="col-md-6 mt-3">
                      <div class="js-form-message">
                        <label class="labels">
                          Email
                        </label>
                        <input type="email" class="form-control" name="email" data-checkout="cardholderEmail" required="" value="{{ $usuario->email }}">
                      </div>
                  </div>

                  <div class="col-md-3 mt-3">
                    <label class="labels">
                      Tipo Documento
                      <span class="text-danger">*</span>
                    </label>
                    <select class="form-control" data-checkout="docType">
                      <option>Cargando...</option>
                    </select>
                  </div>

                  <div class="col-md-9 mt-3">
                    <label class="labels">
                      Número de Documento
                      <span class="text-danger">*</span>
                    </label>
                      <input type="text" class="form-control" data-checkout="docNumber" required="">
                  </div>
                </div>

                <br>

                <div class="row">
                  <div class="col-md-12">
                    <div class="js-form-message">
                      <label class="form-label">
                        Número de Tarjeta
                        <span class="text-danger">*</span>
                      </label>
                      <input type="text" class="form-control" placeholder="**** **** **** ***" id="cardNumber" data-checkout="cardNumber" required="">
                    </div>
                  </div>
                </div>
                <br>

                <div class="row">
                  <div class="col-lg-8">
                    <div class="js-form-message mb-4">
                      <label class="form-label">
                        Nombre escrito en la Tarjeta
                        <span class="text-danger">*</span>
                      </label>
                      <input type="text" class="form-control text-capitalize" placeholder="Juanito Alcachofa" data-checkout="cardholderName" required="">
                    </div>
                  </div>
                  
                  <div class="col-lg-4">
                    <div class="js-form-message mb-4">
                      <label class="form-label">
                        Fecha de Expiración
                        <span class="text-danger">*</span>
                      </label>
                      <div class="mx-2 row d-flex justify-content-around">
                        <input type="text" class="form-control col-lg-5 mb-3" placeholder="MM" data-checkout="cardExpirationMonth" id="mes" maxlength="2" required="">
                        <input type="text" class="form-control col-lg-5 mb-3" placeholder="AA" data-checkout="cardExpirationYear" id="year" maxlength="2" required="">
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-lg-12">
                    <div class="js-form-message mb-4">
                      <label class="form-label text-left">
                        CVC
                        <span class="text-danger">    *    </span>
                        <small class="text-muted">(Los 3 o 4 números detrás de tu tarjeta)</small>
                      </label>
                      <input type="text" class="form-control col-lg-2" placeholder="***" data-checkout="securityCode" required="" id="cvc">
                    </div>
                  </div>
                  
                  <div class="col-lg-12">
                    <label for="installments">Cuotas<span class="text-danger">*</span></label>
                    <select class="form-control" id="installments" name="installments" required>
                        <option value="">Cargando...</option>
                    </select>
                  </div>
                </div>
                <br>
                @if (session()->has('pagando_seña'))
                    <div class="row d-none">
                      <div class="col-lg-12">
                        <div class="js-form-message mb-4">
                          <label class="form-label text-left">
                            Ingresar Cupón de Descuento
                          </label>
                          <input type="text" class="form-control" placeholder="Cupón de Descuento" name="cupon">
                        </div>
                      </div>
                    </div>
                @else
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="js-form-message mb-4">
                          <label class="form-label text-left">
                            Ingresar Cupón de Descuento
                          </label>
                          <input type="text" class="form-control" placeholder="Cupón de Descuento" name="cupon">
                        </div>
                      </div>
                    </div>
                @endif

                <div class="alert alert-primary d-none" role="alert" id="d-none">
                  <p>Cargando. Por favor espere, esto puede tardar unos momentos mientras verificamos todo. Sea paciente.</p>
                  <div class="spinner-border text-info" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
                <div class="form-group form-row">
                  <div class="col">
                      <small class="form-text text-danger" id="paymentErrors" role="alert"></small>
                  </div>
                </div>

                <div class="col-lg-12">
                  @if (Session::has('message'))    
                      <div class="alert alert-danger" role="alert">
                          {{ Session::get('message') }}
                      </div>
                  @endif
                </div>

                <div class="row d-flex justify-content-between align-items-center pb-3">
                  <a href="{{ route('Destroy Order', Session::get('ordenCompra')) }}" id="back" class="text-left"><span class="fas fa-angle-left mr-2 mt-3"></span> Volver A La Tienda</a>
                  <input type="submit" class="btn btn-success col-lg-4 mt-3" value="Finalizar Compra"></input>
                </div>

                <input type="hidden" id="cardNetwork" name="card_network">
                <input type="hidden" id="cardToken" name="card_token">
                <input type="hidden" name="ordenCompra" value="{{ Session::get('ordenCompra') }}">
                
              </form>

            </div>

            {{-- PAGAR EN EFECTIVO --}}
            <div class="tab-pane fade text-center pb-4" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
              <a href="{{ route('Pago En La Entrega', Session::get('ordenCompra')) }}" class="btn btn-success my-4">Finalizar Compra</a>

              <p>Al pagar en efectivo obtendrás un descuento exclusivo del <u class="text-success">5%</u> en el total de todos los productos que compres. (No podrás aplicar cupones de descuento al elegir éste medio de pago).</p>
              
              <small class="text-danger mb-3">
                Importante: Si estás pagando un pedido de importación de cartas, no se calculará el 5% de descuento.
              </small>
            </div>
        </div>
    </div>
  </div>
  
</div>

<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

<script type="text/javascript">
    window.addEventListener('load', () => {

      const getTotal = document.getElementById('totalAPagar')

      const total = getTotal.getAttribute('total')

      const mercadoPago = window.Mercadopago;

      const cardNumber = document.getElementById("cardNumber");

      var bin

      const cardNetwork = document.getElementById("cardNetwork")

      // ----------------------------------

      //lo de que al completar el mes de vencimiento salte al año
      document.getElementById('mes').addEventListener('keyup', () => {
        if (document.getElementById('mes').value >= 2) {
          document.getElementById("year").focus()
        }
      })

      // ----------------------------------

      cardNumber.addEventListener('keyup', async () => {
        bin = cardNumber.value.substring(0,6)

        await setCardNetwork(bin)
      })//keyup para conseguir la red de la tarjeta y mostrar las cuotas

      // ----------------------------------

      mercadoPago.setPublishableKey('{{ config('services.mercadopago.key') }}');

      mercadoPago.getIdentificationTypes();

      // ----------------------------------

      async function setCardNetwork(binCard)
      {
        console.log(binCard)
          return await mercadoPago.getPaymentMethod(
              { 
                "bin": bin 
              },
              (status, response) => {
                  cardNetwork.value = response[0].id;
                }
          );
      }//obtener la red de la tarjeta

      // -----------------------------------

      //enviar el formulario
      const mercadoPagoForm = document.getElementById("paymentForm");

      mercadoPagoForm.addEventListener('submit', e => {
              e.preventDefault();

              document.getElementById('d-none').classList.toggle("d-none")

              mercadoPago.createToken(mercadoPagoForm, (status, response) => {
                  if (status != 200 && status != 201) {
                      const errors = document.getElementById("paymentErrors");

                      document.getElementById('d-none').classList.toggle("d-none")

                      errors.textContent = response.cause[0].description;
                  } else {
                      const cardToken = document.getElementById("cardToken");

                      setCardNetwork()

                      cardToken.value = response.id;

                      // setTimeout(() => {
                      //   console.log(cardNetwork.value)
                      //   console.log(cardToken.value)
                        mercadoPagoForm.submit();
                      // }, 1000);
                  }
              });
      });

      // --------------------------------------------
      //cuotas
      
      // Consultá el recurso de installments // obtener interés y precio final por cada cuota
      Mercadopago.getInstallments({
          "payment_method_id": "visa",
          "bin": 424242,
          "amount": total
      }, showInstallments);

      // Mostrá las cuotas
      function showInstallments(status, response){
        var selectorInstallments = document.getElementById('installments'),
            fragment = document.createDocumentFragment();
        selectorInstallments.options.length = 0;
        if (response.length > 0){
          var option = new Option("Elija una cuota...", '-1'),
              payerCosts = response[0].payer_costs;
          fragment.appendChild(option);
          for (var i = 0; i < payerCosts.length; i++) {
              option = new Option(payerCosts[i].recommended_message || payerCosts[i].installments, payerCosts[i].installments);
              var tax = payerCosts[i].labels;
              if(tax.length > 0){
                for (var l = 0; l < tax.length; l++) {
                  if (tax[l].indexOf('CFT_') !== -1){
                    option.setAttribute('data-tax', tax[l]);
                  }
                }
              }
              fragment.appendChild(option);
          }
          selectorInstallments.appendChild(fragment);
          selectorInstallments.removeAttribute('disabled');
        }
        else {
          console.log('Error: Could not get installments');
        }
      }

      // Actualizá el resumen cuando el usuario elija las cuotas
      document.getElementById('installments').onchange = function(){
        var cur_i = this.options[this.selectedIndex].getAttribute('data-tax');
        if(cur_i != null){
          // document.getElementById('total-financed').innerHTML = this.options[this.selectedIndex].text;
          showTaxes(cur_i);
        }
      };
      
      function showTaxes(tax){
        var tax_split = tax.split('|');
            var CFT = tax_split[0].replace('CFT_', ''),
            TEA = tax_split[1].replace('TEA_', '');
        // document.getElementById('cft').innerHTML = CFT;
        // document.getElementById('tea').innerHTML = TEA;
      }

    })
</script>
