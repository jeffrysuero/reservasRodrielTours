<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

// Carga el archivo .env desde el directorio padre
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <!-- Site Title-->
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="../images/faviconRodriel.png" type="image/x-icon">
    <!-- Stylesheets -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald:200,400%7CLato:300,400,300italic,700%7CMontserrat:900">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/fonts.css">
    <link rel="stylesheet" href="../css/traslate.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"> </script>
		<![endif]-->

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['MAP_KEY']; ?>&callback=initMap&libraries=places&v=weekly" defer></script>
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <style>
        #extraFields {
            display: none;
        }

        .span-button {
            cursor: pointer;
        }
    </style>
    <style type="text/css">
        #map {
            height: 500px;
            width: 800px;
            border-radius: 15px;
            margin: 100px auto;
        }
    </style>
    <script>
        let timer;

        function initMap() {
            const directionsRenderer = new google.maps.DirectionsRenderer();
            const directionsService = new google.maps.DirectionsService();
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 8,
                center: {
                    lat: 18.7357,
                    lng: -70.1627
                },
            });

            directionsRenderer.setMap(map);

            // Llama a la función para calcular y mostrar la ruta cuando la página se carga
            calculateAndDisplayRoute(directionsService, directionsRenderer);

            // Agrega autocompletado a los campos de entrada de origen y destino
            const originInput = document.getElementById('destination');
            const destinationInput = document.getElementById('origin');
            const originAutocomplete = new google.maps.places.Autocomplete(originInput);
            const destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);

            originAutocomplete.bindTo('bounds', map);
            destinationAutocomplete.bindTo('bounds', map);

            // Agrega eventos de escucha para los cambios en los campos de entrada
            originAutocomplete.addListener('place_changed', function() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    geocodeAddress(originInput.value, function(coordinates) {
                        calculateAndDisplayRoute(directionsService, directionsRenderer, coordinates);
                    });
                }, 500); // Retraso de 500ms antes de realizar la búsqueda
            });

            destinationAutocomplete.addListener('place_changed', function() {
                clearTimeout(timer);
                timer = setTimeout(function() {
                    geocodeAddress(destinationInput.value, function(coordinates) {
                        calculateAndDisplayRoute(directionsService, directionsRenderer, coordinates);
                    });
                }, 500); // Retraso de 500ms antes de realizar la búsqueda
            });
        }

        function geocodeAddress(address, callback) {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                address: address
            }, function(results, status) {
                if (status === "OK") {
                    const location = results[0].geometry.location;
                    const coordinates = {
                        lat: location.lat(),
                        lng: location.lng()
                    };
                    callback(coordinates);
                } else {
                    console.log("Geocode was not successful for the following reason: " + status);
                }
            });
        }

        function calculateAndDisplayRoute(directionsService, directionsRenderer, coordinates) {
            // Obtiene los valores de los inputs de origen y destino
            const origin = document.getElementById('origin').value;
            const destination = document.getElementById('destination').value;

            // Realiza la solicitud de dirección
            directionsService.route({
                    origin: coordinates || origin,
                    destination: destination,
                    travelMode: google.maps.TravelMode["DRIVING"],
                },
                (response, status) => {
                    if (status == "OK") {
                        directionsRenderer.setDirections(response);
                    } else {
                        //   window.alert("Directions request failed due to " + status);
                    }
                }
            );
        }
    </script>
    <style>
        .btn-wsp {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 40px;
            background-color: #25d366;
            color: #fff;
            border-radius: 50px;
            text-align: center;
            font-size: 30px;
            box-shadow: 2px 2px 3px #999;
            z-index: 1000;
        }

        .btn-wsp .icono {
            margin-top: 16px;
        }
    </style>
</head>

<body>
    <!-- Page preloader-->
    <?php require_once('../page_loader.php')   ?>
    <!-- Page-->

    <!-- Page Header-->
    <?php require_once('header.php')   ?>
    <section class="section">
        <div class="swiper-form-wrap">
            <!-- Swiper-->
            <div class="swiper-container swiper-slider swiper-slider_height-1 swiper-align-left swiper-align-left-custom context-dark bg-gray-darker" data-loop="false" data-autoplay="5500" data-simulate-touch="false" data-slide-effect="fade">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" data-slide-bg="../images/fondo1.JPG">
                        <div class="swiper-slide-caption">
                            <div class="container container-bigger swiper-main-section">
                                <div class="row row-fix justify-content-sm-center justify-content-md-start">
                                    <div class="col-md-6 col-lg-5 col-xl-4 col-xxl-5">
                                        <h3>Explorez, découvrez, voyagez confortablement avec nous</h3>
                                        <!-- <div class="divider divider-decorate"></div> -->
                                        <p class="text-spacing-sm">Chauffeurs formés pour un voyage sûr et fiable.
                                            Profitez de confort, d'élégance et de sécurité à chaque voyage.
                                            Réservez avec nous pour une expérience de transport inégalée.</p>
                                        <!-- <a class="button button-default-outline button-nina button-sm" href="#">learn more</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" data-slide-bg="../images/fondo2.JPG">
                        <div class="swiper-slide-caption">
                            <div class="container container-bigger swiper-main-section">
                                <div class="row row-fix justify-content-sm-center justify-content-md-start">
                                    <div class="col-md-6 col-lg-5 col-xl-4 col-xxl-5">
                                        <h3></h3>
                                        <!-- <div class="divider divider-decorate"></div> -->
                                        <!-- <p class="text-spacing-sm"></p><a class="button button-default-outline button-nina button-sm" href="#">learn more</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" data-slide-bg="../images/fondo3.JPG">
                        <div class="swiper-slide-caption">
                            <div class="container container-bigger swiper-main-section">
                                <div class="row row-fix justify-content-sm-center justify-content-md-start">
                                    <div class="col-md-6 col-lg-5 col-xl-4 col-xxl-5">
                                        <h3></h3>
                                        <!-- <div class="divider divider-decorate"></div> -->
                                        <!-- <p class="text-spacing-sm"></p><a class="button button-default-outline button-nina button-sm" href="#">learn more</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Swiper controls-->
                <div class="swiper-pagination-wrap">
                    <div class="container container-bigger">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container container-bigger form-request-wrap form-request-wrap-modern">
                <div class="row row-fix justify-content-sm-center justify-content-lg-end">
                    <div class="col-lg-6 col-xxl-5">
                        <div class="form-request form-request-modern bg-gray-lighter novi-background">
                            <h4>Réservation</h4>
                            <!-- RD Mailform-->
                            <form id="reservationForm" class="rd-mailform form-fix">
                                <div class="row row-20 row-fix">
                                    <div class="col-sm-4">
                                        <label class="form-label-outside">Prénom</label>
                                        <div class="form-wrap form-wrap-inline">
                                            <input type="text" name="name" id="name" class="form-input input-append" required placeholder="Prénom">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label-outside">Nom de famille</label>
                                        <div class="form-wrap form-wrap-inline">
                                            <input type="text" name="lastname" id="lastname" class="form-input input-append" required placeholder="Nom de famille">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label-outside">Téléphone</label>
                                        <div class="form-wrap form-wrap-inline">
                                            <input type="tel" name="phone" id="phone" class="form-input input-append" required placeholder="Téléphone">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form-label-outside">Origine</label>
                                        <div class="form-wrap form-wrap-inline">
                                            <input type="text" name="origin" id="origin" required class="form-input input-append" placeholder="Origine">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label class="form-label-outside">Destination</label>
                                        <div class="form-wrap form-wrap-inline">
                                            <input type="text" name="destination" id="destination" required class="form-input input-append" placeholder="Destination">
                                        </div>
                                    </div>
                                </div>

                               
                                <div class="form-wrap form-button">
                                    <button type="button" id="submitBtn" class="button button-block button-secondary">Réserver</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Trayectoria a Recorrer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div>
                                <div class="row row-20 row-fix">
                                    <div class="col-sm-12">
                                        <label class="form-label-outside">E-mail</label>
                                        <div class="form-wrap form-wrap-inline">
                                            <input type="email" name="email" required id="email" class="form-input input-append" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label-outside">Heure</label>
                                        <div class="form-wrap form-wrap-inline">
                                            <input type="time" name="hour" id="hour" class="form-input input-append" placeholder="Heure">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-lg-4">
                                        <label class="form-label-outside">Date de réservation</label>
                                        <div class="form-wrap form-wrap-validation">
                                            <input class="form-input" id="dateForm" name="date1" id="datepicker" type="text" data-time-picker="date">
                                            <label class="form-label" for="dateForm">Date de réservation</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label-outside">Numéro de vol</label>
                                        <div class="form-wrap form-wrap-inline">
                                            <input type="text" name="numVuelo" id="numVuelo" class="form-input input-append" placeholder="Vol">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label-outside">Valises</label>
                                        <div class="form-wrap form-wrap-modern">
                                            <input type='number' name="suitcases" id="suitcases" required class="form-input input-append" min="1" max="300" value="2">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label-outside">Adultes</label>
                                        <div class="form-wrap form-wrap-modern">
                                            <input type="number" name="adults" required id="adults" class="form-input input-append" min="1" max="300" value="2">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="form-label-outside">Enfants</label>
                                        <div class="form-wrap form-wrap-modern">
                                            <input type="number" name="children" id="children" class="form-input input-append" min="0" max="300" value="0">
                                            <input type="hidden" name="infants" id="infants" class="form-control" placeholder="Nombre de bébés (0-2 ans)" min="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-lg-12" id="map"></div>
                            <div class="">
                                <!-- <span> Total a Pagar $200 usd</span> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" id="confirmBtn" class="btn btn-primary">Confirmer</button>
                </div>
            </div>
        </div>
    </div>

    <section class="section section-variant-1 bg-default novi-background bg-cover">
        <div class="container container-wide">
            <div class="row row-fix justify-content-xl-end row-30 text-center text-xl-left">
                <div class="col-xl-8">
                    <div class="parallax-text-wrap">
                        <h3>Confort et Sécurité</h3><span class="parallax-text">RODRIEL TOURS</span>
                    </div>
                    <hr class="divider divider-decorate">
                </div>
                <div class="col-xl-3 text-xl-right"><a class="button button-secondary button-nina" href="#">Réserver</a></div>
            </div>
            <div class="row row-50">
                <div class="col-md-6 col-xl-4">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image"><img src="../images/changai.jpg" alt="" width="570" height="370" />
                            </figure>
                            <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#">En savoir plus</a></div>
                        </div>
                        <div class="event-default-inner">
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-xl-4">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image"><img src="../images/changai8.jpg" alt="" width="570" height="370" />
                            </figure>
                            <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#">En savoir plus</a></div>
                        </div>
                        <div class="event-default-inner">
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-xl-4">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image"><img src="../images/changai4.jpg" alt="" width="570" height="370" />
                            </figure>
                            <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#">En savoir plus</a></div>
                        </div>
                        <div class="event-default-inner">
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-xl-4">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image"><img src="../images/auto7.jpg" alt="" width="570" height="370" />
                            </figure>
                            <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#">En savoir plus</a></div>
                        </div>
                        <div class="event-default-inner">
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-xl-4">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image"><img src="../images/auto8.jpg" alt="" width="570" height="370" />
                            </figure>
                            <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#">En savoir plus</a></div>
                        </div>
                        <div class="event-default-inner">
                        </div>
                    </article>
                </div>
                <div class="col-md-6 col-xl-4">
                    <article class="event-default-wrap">
                        <div class="event-default">
                            <figure class="event-default-image"><img src="../images/auto11.jpg" alt="" width="570" height="370" />
                            </figure>
                            <div class="event-default-caption"><a class="button button-xs button-secondary button-nina" href="#">En savoir plus</a></div>
                        </div>
                        <div class="event-default-inner">
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>



    <!-- our advantages-->
    <section class="section section-lg bg-gray-lighter novi-background bg-cover text-center">
        <div class="container container-wide">
            <h3>Nos Services</h3>
            <div class="divider divider-decorate"></div>
            <div class="row row-50 justify-content-sm-center text-left">
                <div class="col-sm-10 col-md-6 col-xl-3">
                    <article class="box-minimal box-minimal-border">
                        <div class="box-minimal-icon novi-icon mdi mdi-airplane"></div>
                        <p class="big box-minimal-title">Transferts Aéroport</p>
                        <hr>
                        <div class="box-minimal-text text-spacing-sm">
                            Voyagez sans souci jusqu'à l'aéroport avec notre service de transfert ponctuel et fiable. Nous vous assurons d'arriver à l'heure pour votre vol et nous vous accueillons à votre arrivée pour un voyage détendu de l'aéroport à votre destination.
                        </div>
                    </article>
                </div>
                <div class="col-sm-10 col-md-6 col-xl-3">
                    <article class="box-minimal box-minimal-border">
                        <div class="box-minimal-icon novi-icon mdi mdi-car"></div>
                        <p class="big box-minimal-title">Services de Taxi</p>
                        <hr>
                        <div class="box-minimal-text text-spacing-sm">
                            Profitez d'un service de taxi rapide et efficace pour vos trajets quotidiens. Qu'il s'agisse d'un court trajet en ville ou d'un transfert vers une autre destination, nos chauffeurs professionnels vous emmèneront à votre destination en toute sécurité et confort.
                        </div>
                    </article>
                </div>
                <div class="col-sm-10 col-md-6 col-xl-3">
                    <article class="box-minimal box-minimal-border">
                        <div class="box-minimal-icon novi-icon mdi mdi-headset"></div>
                        <p class="big box-minimal-title">Support Client 24/7</p>
                        <hr>
                        <div class="box-minimal-text text-spacing-sm">
                            Notre service client est disponible 24 heures sur 24, 7 jours sur 7. Nous sommes toujours prêts à vous assister pour toute question, changement d'itinéraire ou assistance d'urgence.
                        </div>
                    </article>
                </div>
                <div class="col-sm-10 col-md-6 col-xl-3">
                    <article class="box-minimal box-minimal-border">
                        <div class="box-minimal-icon novi-icon mdi mdi-calendar-clock"></div>
                        <p class="big box-minimal-title">Réservations Personnalisées</p>
                        <hr>
                        <div class="box-minimal-text text-spacing-sm">
                            Chez Rodriel Tours, nous comprenons que chaque client a des besoins de transport uniques et spécifiques. C'est pourquoi nous offrons un service de réservation personnalisé qui s'adapte à vos horaires, préférences et exigences particulières.
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>



    <!-- Tips & tricks-->


    <section class="section section-lg text-center bg-gray-lighter novi-background bg-cover">
        <div class="container container-bigger">
            <h3>Témoignages</h3>
            <div class="divider divider-decorate"></div>
            <!-- Owl Carousel-->
            <div class="owl-carousel owl-layout-1" data-items="1" data-dots="true" data-nav="true" data-stage-padding="0" data-loop="true" data-margin="30" data-mouse-drag="false" data-autoplay="true">
                <article class="quote-boxed">
                    <div class="quote-boxed-aside"><img class="quote-boxed-image" src="https://media-cdn.tripadvisor.com/media/photo-l/1a/f6/e7/3d/default-avatar-2020-55.jpg" alt="" width="210" height="210" />
                    </div>
                    <div class="quote-boxed-main">
                        <div class="quote-boxed-text">
                            <p>J'ai aimé leur service de transport très ponctuel, le chauffeur était très aimable et amical. Je le recommande et je l'utiliserai à nouveau à l'avenir.</p>
                        </div>
                        <div class="quote-boxed-meta">
                            <a href="https://www.tripadvisor.es/ShowUserReviews-g13199011-d27521919-r945275446-Rodriel_Tours-Santo_Domingo_Este_Santo_Domingo_Province_Dominican_Republic.html">
                                <p class="quote-boxed-cite">Felix C</p>
                                <!-- <p class="quote-boxed-small">Client Régulier</p> -->
                            </a>
                        </div>
                    </div>
                </article>
                <article class="quote-boxed">
                    <div class="quote-boxed-aside"><img class="quote-boxed-image" src="../images/carmen-p.jpg" alt="" width="210" height="210" />
                    </div>
                    <div class="quote-boxed-main">
                        <div class="quote-boxed-text">
                            <p>Très bonne attention, aimable. Ils étaient ponctuels et accessibles à tout moment.</p>
                        </div>
                        <div class="quote-boxed-meta">
                            <a href="https://www.tripadvisor.es/Profile/836carmenp?fid=42f22415-5251-4c2e-8462-32190a9a201d">
                                <p class="quote-boxed-cite">Carmen P</p>
                                <!-- <p class="quote-boxed-small">Client Régulier</p> -->
                            </a>
                        </div>
                    </div>
                </article>
                <article class="quote-boxed">
                    <div class="quote-boxed-aside"><img class="quote-boxed-image" src="../images/testim1.png" alt="" width="210" height="210" />
                    </div>
                    <div class="quote-boxed-main">
                        <div class="quote-boxed-text">
                            <p>Excellent, fiable et très sûr avec une expérience incroyable, ce sont les mots qui définissent les transferts et les excursions.</p>
                        </div>
                        <div class="quote-boxed-meta">
                            <a href="https://www.google.com/maps/contrib/113337780061978184172/reviews/@18.5731351,-69.936854,11z/data=!4m3!8m2!3m1!1e1?entry=ttu">
                                <p class="quote-boxed-cite">Juniorpaulino Delacruzpaulino</p>
                                <!-- <p class="quote-boxed-small">Client Régulier</p> -->
                            </a>
                        </div>
                    </div>
                </article>
                <article class="quote-boxed">
                    <div class="quote-boxed-aside"><img class="quote-boxed-image" src="../images/testim2.png" alt="" width="210" height="210" />
                    </div>
                    <div class="quote-boxed-main">
                        <div class="quote-boxed-text">
                            <p>Excellent service, totalement recommandé, très aimable et très disponible, excellentes excursions qu'ils réalisent. J'ai eu un problème avec notre transfert et M. Andy l'a résolu, et nous avons atteint notre destination. Très ponctuel et responsable. Totalement fiable. Un 10.</p>
                        </div>
                        <div class="quote-boxed-meta">
                            <a href="https://www.google.com/maps/contrib/113648382259471318522/reviews/@18.5703226,-69.0707497,10z/data=!4m3!8m2!3m1!1e1?entry=ttu">
                                <p class="quote-boxed-cite">Brisa Castillo</p>
                                <!-- <p class="quote-boxed-small">Client Régulier</p> -->
                            </a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>



    <section class="section section-md text-center text-md-left bg-gray-700 novi-background bg-cover">
        <div class="container container-wide">
            <div class="row row-fix row-50 justify-content-sm-center">
                <div class="col-xxl-8">
                    <div class="box-cta box-cta-inline">
                        <div class="box-cta-inner">
                            <h3 class="box-cta-title">RÉSERVEZ AVEC NOUS SANS QUITTER VOTRE MAISON</h3>
                            <p>En utilisant notre site web, vous pouvez réserver en seulement quelques clics</p>
                        </div>
                        <div class="box-cta-inner"><a class="button button-secondary button-nina" href="#">Réservez Maintenant</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <a href="https://api.whatsapp.com/send?phone=18096451945" class="btn-wsp" target="_blank">
        <i class="fa fa-whatsapp icono"></i>
    </a>
    <!-- <a class="section section-banner" href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(images/banner/background-03-1920x310.jpg); background-image: -webkit-image-set( url(images/banner/background-03-1920x310.jpg) 1x, url(images/banner/background-03-3840x620.jpg) 2x )"><img src="images/banner/foreground-03-1600x310.png" srcset="images/banner/foreground-03-1600x310.png 1x, images/banner/foreground-03-3200x620.png 2x" alt="" width="1600" height="310"></a> -->
    <!-- Footer Minimal-->
    <div class="page">

        <?php require_once('../footer.php')   ?>
    </div>

    </div>

    <section style="display: none;" class="accomodation_area section_gap">
        <div class="container">
            <div class="section_title text-center">
                <h2 class="title_color">Chemin à Parcourir</h2>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-lg-12" id="map"></div>
            </div>

        </div>
    </section>
    <!-- Global Mailform Output-->
    <!-- <div class="snackbars" id="form-output-global"> </div> -->
    <!-- Javascript-->
    <script src="../js/core.min.js"></script>
    <script src="../js/script.js"></script>
    <script src="../js/traslate.js"></script>
    <!-- coded by barber-->
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('submitBtn').addEventListener('click', function() {
            var form = document.getElementById('reservationForm');

            // Verificar si el formulario es válido
            if (form.checkValidity() === false) {
                // Mostrar mensajes de error por defecto de HTML5
                form.reportValidity();
                return;
            }
            // Abrir el modal si el formulario es válido
            $('#exampleModal').modal('show');
        });

        document.getElementById('confirmBtn').addEventListener('click', function() {
            var form = document.getElementById('reservationForm');

            // Crear objeto FormData y agregar los datos del formulario
            var formData = new FormData(form);
            var email = document.getElementById('email').value;
            var hour = document.getElementById('hour').value;
            var date1 = document.getElementById('dateForm').value;
            var numVuelo = document.getElementById('numVuelo').value;
            var suitcases = document.getElementById('suitcases').value;
            var adults = document.getElementById('adults').value;
            var children = document.getElementById('children').value;

            // Crear objeto FormData y agregar los datos del formulario y los adicionales

            formData.append('email', email);
            formData.append('hour', hour);
            formData.append('date1', date1);
            if (numVuelo.trim() !== '') { // Verificar si el número de vuelo no está vacío
                formData.append('numVuelo', numVuelo);
            }
            formData.append('suitcases', suitcases);
            formData.append('adults', adults);
            if (children.trim() !== '') {

                formData.append('children', children);
            }
            // Configurar la solicitud AJAX
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../process/fr/processReservation.php', true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            // Manejadores de respuesta
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    try {
                        var response = JSON.parse(xhr.responseText);
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        form.reset();
                        $('#exampleModal').modal('hide');
                    } catch (e) {
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Error inesperado. Verifica la consola para más detalles.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        console.error("No se pudo parsear la respuesta como JSON:", e);
                        console.error("Respuesta recibida:", xhr.responseText);
                    }
                } else {
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "Error en la solicitud AJAX. Verifica la consola para más detalles.",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    console.error("Error en la solicitud AJAX:", xhr.status, xhr.statusText);
                    console.error("Respuesta del servidor:", xhr.responseText);
                }
            };

            // Enviar la solicitud
            xhr.send(formData);
        });
    </script>
    <script>
        document.getElementById('moreOptionsBtn').addEventListener('click', function() {
            var extraFields = document.getElementById('extraFields');
            if (extraFields.style.display === 'none' || extraFields.style.display === '') {
                extraFields.style.display = 'block';
                this.textContent = 'Menos opciones';
            } else {
                extraFields.style.display = 'none';
                this.textContent = 'Más opciones';
            }
        });
    </script>
</body>

</html>