<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <!-- BASICS -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>The creation station</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/isotope.css" media="screen" />	
        <link rel="stylesheet" href="js/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap-theme.css">
        <link rel="stylesheet" href="css/style.css">
        <!-- skin -->
        <link rel="stylesheet" href="skin/default.css">
    </head>

    <body>
        <?php $this->load->view("themes/" . THEME . "/layout/inc-header"); ?>

        <section class="content-area">
            <div class="container"> 
                <div class="row mar-bot40">
                    <div class="subpages"> 
                        <?php echo $contents; ?>
                    </div>
                </div>
            </div>
        </section>

        <footer id="footer" class="section footer">
            <div class="container">
                <?php $this->load->view("themes/" . THEME . "/layout/inc-footer"); ?>
            </div>
        </footer>
        <a href="#header" class="scrollup"><i class="fa fa-chevron-up"></i></a>	

        <script src="js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASm3CwaK9qtcZEWYa-iQwHaGi3gcosAJc&sensor=false"></script>
        <script src="js/jquery.isotope.min.js"></script>
        <script src="js/jquery.nicescroll.min.js"></script>
        <script src="js/fancybox/jquery.fancybox.pack.js"></script>
        <script src="js/skrollr.min.js"></script>		
        <script src="js/jquery.scrollTo-1.4.3.1-min.js"></script>
        <script src="js/jquery.localscroll-1.2.7-min.js"></script>
        <script src="js/stellar.js"></script>
        <script src="js/jquery.appear.js"></script>
        <script src="js/validate.js"></script>
        <script src="js/main.js"></script>
        <script type="text/javascript">
            // When the window has finished loading create our google map below
            google.maps.event.addDomListener(window, 'load', init);

            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,
                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(40.6700, -73.9400), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{featureType: "all", elementType: "all", stylers: [{invert_lightness: true}, {saturation: 10}, {lightness: 30}, {gamma: 0.5}, {hue: "#1C705B"}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using out element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);
            }
        </script>
    </body>
</html>
