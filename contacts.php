<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <!-- Site Title-->
  <title>Contacts</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="images/faviconRodriel.png" type="image/x-icon">
  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald:200,400%7CLato:300,400,300italic,700%7CMontserrat:900">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/fonts.css">
  <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"> </script>
		<![endif]-->
</head>

<body>
  <!-- Page preloader-->
  <?php require_once('page_loader.php') ?>
  <!-- Page-->
  <!-- <div class="page"><a class="section section-banner text-center d-none d-xl-block" href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(images/banner/background-04-1920x60.jpg); background-image: -webkit-image-set( url(images/banner/background-04-1920x60.jpg) 1x, url(images/banner/background-04-3840x120.jpg) 2x )"><img src="images/banner/foreground-04-1600x60.png" srcset="images/banner/foreground-04-1600x60.png 1x, images/banner/foreground-04-3200x120.png 2x" alt="" width="1600" height="310"></a> -->
  <!-- Page Header-->
  <?php require_once('header3.php') ?>
  <!-- Contact info-->
  <section class="section section-lg bg-default text-center">
    <div class="container container-wide">
      <div class="row row-fix row-50 row-custom-bordered">
        <div class="col-sm-6 col-lg-3">
          <!-- Box minimal-->
          <article class="box-simple">
            <div class="box-simple-icon novi-icon mdi mdi-map-marker"></div>
            <h6>Direccion</h6>
            <div class="box-simple-text"><a href="#">Calle Libertad #3, La caleta</a></div>
          </article>
        </div>
        <div class="col-sm-6 col-lg-3">
          <!-- Box simple-->
          <article class="box-simple">
            <div class="box-simple-icon novi-icon mdi mdi-phone"></div>
            <h6>Telefonos</h6>
            <div class="box-simple-text">
              <ul class="list-comma list-0">
                <li><a href="tel:#">movil: 849-449-1598</a></li>
                <li><a href="tel:#">Oficina: 809-532-6645</a></li>
              </ul>
            </div>
          </article>
        </div>
        <div class="col-sm-6 col-lg-3">
          <!-- Box simple-->
          <article class="box-simple">
            <div class="box-simple-icon novi-icon mdi mdi-email-open"></div>
            <h6>e-mail</h6>
            <div class="box-simple-text">
              <ul class="list-comma list-0">
                <li><a href="mailto:#">info@rodrieltours.com</a></li>
              </ul>
            </div>
          </article>
        </div>
        <div class="col-sm-6 col-lg-3">
          <!-- Box simple-->
          <article class="box-simple">
            <div class="box-simple-icon novi-icon mdi mdi-calendar-clock"></div>
            <h6>Oficina Hora</h6>
            <div class="box-simple-text">
              <ul class="list-0">
                <li>Lunes–Sabado: 8:00 am–7:00 pm</li>

              </ul>
            </div>
          </article>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact us-->
  <section class="section section-wrap bg-gray-lighter novi-background bg-cover">
    <div class="section-wrap-inner">
      <div class="container container-bigger">
        <div class="row row-fix row-50">
          <div class="col-lg-8 col-xl-7">
            <div class="section-wrap-content section-lg">
              <h3>Contacta con Nosotro</h3>
              <hr class="divider divider-left divider-secondary">
              <p class="big">Puede contactarnos de cualquier forma que le resulte conveniente. Estamos disponibles las 24 horas, los 7 días de la semana, por correo electrónico. También puede utilizar el formulario de contacto rápido a continuación o visitar nuestra oficina personalmente.</p>
              <!-- RD Mailform-->
              <form class="rd-mailform" id="contactForm">
                <div class="row row-fix row-20">
                  <div class="col-md-6">
                    <div class="form-wrap form-wrap-validation">
                      <label class="form-label-outside" for="form-1-name">First name</label>
                      <!-- <input class="form-input" id="form-1-name" type="text" name="name" data-constraints="@Required" /> -->
                      <input type="text" class="form-input" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                  </div>
                  <!-- <div class="col-md-6">
                      <div class="form-wrap form-wrap-validation">
                        <label class="form-label-outside" for="form-1-last-name">Last name</label>
                        <input class="form-input" id="form-1-last-name" type="text" name="last-name" data-constraints="@Required" />
                      </div>
                    </div> -->
                  <div class="col-md-6">
                    <div class="form-wrap form-wrap-validation">
                      <label class="form-label-outside" for="form-1-email">E-mail</label>
                      <!-- <input class="form-input" id="form-1-email" type="email" name="email" data-constraints="@Email @Required" /> -->
                      <input type="email" class="form-input" id="email" name="email" placeholder="Enter email address" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-wrap form-wrap-validation">
                      <label class="form-label-outside" for="form-1-phone">Subject</label>
                      <!-- <input class="form-input" id="form-1-phone" type="text" name="phone" data-constraints="@Numeric @Required" /> -->
                      <input type="text" class="form-input" id="subject" name="subject" placeholder="Enter Subject" required>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-wrap form-wrap-validation">
                      <label class="form-label-outside" for="form-1-message">Message</label>
                      <textarea class="form-input" name="message" id="message" rows="1" placeholder="Enter Message" required></textarea>
                    </div>
                  </div>
                  <div class="col-sm-12 offset-custom-1">
                    <div class="form-button">
                      <button class="button button-secondary button-nina" id="confirmBtn" type="submit">send message</button>

                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <div id="success" class="modal modal-message fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="fa fa-close"></i>
              </button>
              <h2>Thank you</h2>
              <p>Your message is successfully sent...</p>
            </div>
          </div>
        </div>
      </div>

      <div class="section-wrap-aside">
        <!-- RD Google Map-->
        <div class="google-map-container google-map-with-icon rd-google-map__model" data-zoom="5" data-center="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-icon="images/gmap_marker.png" data-icon-active="images/gmap_marker_active.png" data-styles="[{&quot;featureType&quot;:&quot;landscape&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;lightness&quot;:60}]},{&quot;featureType&quot;:&quot;road.local&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;lightness&quot;:40},{&quot;visibility&quot;:&quot;on&quot;}]},{&quot;featureType&quot;:&quot;transit&quot;,&quot;stylers&quot;:[{&quot;saturation&quot;:-100},{&quot;visibility&quot;:&quot;simplified&quot;}]},{&quot;featureType&quot;:&quot;administrative.province&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;water&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;on&quot;},{&quot;lightness&quot;:30}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#ef8c25&quot;},{&quot;lightness&quot;:40}]},{&quot;featureType&quot;:&quot;road.highway&quot;,&quot;elementType&quot;:&quot;geometry.stroke&quot;,&quot;stylers&quot;:[{&quot;visibility&quot;:&quot;off&quot;}]},{&quot;featureType&quot;:&quot;poi.park&quot;,&quot;elementType&quot;:&quot;geometry.fill&quot;,&quot;stylers&quot;:[{&quot;color&quot;:&quot;#b6c54c&quot;},{&quot;lightness&quot;:40},{&quot;saturation&quot;:-40}]},{}]">
          <div class="google-map"></div>
          <ul class="google-map-markers">
            <li data-location="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-description="9870 St Vincent Place, Glasgow"></li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Page Footer-->
  <!-- Footer Minimal-->
  <div class="page">
  /* min-height: 96vh !important;
    <?php require_once('footer.php')   ?>
  </div>
  </div>
  <!-- Global Mailform Output-->
  <div class="snackbars" id="form-output-global"> </div>
  <!-- Javascript-->
  <script src="js/core.min.js"></script>
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    document.getElementById('confirmBtn').addEventListener('click', function() {
      var form = document.getElementById('contactForm');
      var formData = new FormData(form);

      // Configurar la solicitud AJAX
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'process/contact_process.php', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

      // Manejadores de respuesta
      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
          try {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              });
              form.reset();
            } else {
              Swal.fire({
                position: "top-end",
                icon: "error",
                title: response.message,
                showConfirmButton: false,
                timer: 1500
              });
            }
          } catch (e) {
            Swal.fire({
              position: "top-end",
              icon: "error",
              title: "Error inesperado. Verifica la consola para más detalles.",
              showConfirmButton: false,
              timer: 1500
            });
          }
        } else {
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Error en la solicitud AJAX. Verifica la consola para más detalles.",
            showConfirmButton: false,
            timer: 1500
          });

        }
      };
      // Enviar la solicitud
      xhr.send(formData);
    });
  </script>
</body>

</html>