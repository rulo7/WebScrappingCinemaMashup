<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="utf-8">
        <title>Simple markers</title>
        <style>
            html, body {
                width: 100%;
                height: 100%;
                margin: 0px;
                padding: 0px;
            }

            #maps{
                float:left;
                border: solid 1px;
                width: 50%;
                padding: 1%;
            }

            #map-canvas{                
                width: 100%;
                height: 600px;
            }

            #description {
                padding: 1%;
                float:left;
                border: solid 1px;
                width: 45%;
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <script src="maps/markerMap.js"></script>
        <script type="text/javascript">


            var adresses = [<?PHP
require_once('wsdl/lib/nusoap.php');
require_once('tools/cleanString.php');

$cliente = new nusoap_client('http://localhost/proyectos/mashup/wsdl/servicio.php');

$cines = $cliente->call('getCinesFromPeliculaCiudad', array($_REQUEST["filmName"], $_REQUEST["cityId"]));
$ultimo = end($cliente->call('getCinesFromPeliculaCiudad', array($_REQUEST["filmName"], $_REQUEST["cityId"])));

foreach ($cines as $cine) {
    echo " '" . string2url($cine["dir"]) . "'";
    if (strcmp($cine["dir"], $ultimo["dir"]) != 0) {
        echo ",";
    }
}
?>];


            var names = [<?PHP
require_once('wsdl/lib/nusoap.php');
require_once('tools/cleanString.php');

$cliente = new nusoap_client('http://localhost/proyectos/mashup/wsdl/servicio.php');

$cines = $cliente->call('getCinesFromPeliculaCiudad', array($_REQUEST["filmName"], $_REQUEST["cityId"]));
$ultimo = end($cliente->call('getCinesFromPeliculaCiudad', array($_REQUEST["filmName"], $_REQUEST["cityId"])));

foreach ($cines as $cine) {
    echo " '" . string2url($cine["name"]) . "'";
    if (strcmp($cine["name"], $ultimo["name"]) != 0) {
        echo ",";
    }
}
?>];

            window.onload = function () {
                markInMap(adresses, names, "map-canvas");
            }

        </script>
    </head>
    <body>

        <div id="maps">
            <?PHP
            require_once'tools/cleanString.php';
            $filmName = string2url($_REQUEST["filmName"]);

            echo "<h1>Cines donde se proyecta \"$filmName\" en la zona</h1>";
            ?>
            <div id="map-canvas"></div>
        </div>

        <div id="description">
            <h1>TWITTER</h1>
            <?PHP
            require_once'twitter/twitter.php';
            require_once'tools/cleanString.php';

            $filmName = string2url($_REQUEST["filmName"]);

            echo "<h3>\"$filmName\"</h3>";
            //Llamada a los twitts con el nombre de la pelicula

            foreach (getTweetsPeliculas($filmName) as $tweet) {
                echo "<p>";
                echo "<img border='1px' style='vertical-align: text-bottom;' src='" . $tweet['user']['profile_image_url'] . "'>";
                echo " <b>" . $tweet['user']['name'] . " [@" . $tweet['user']['screen_name'] . "]: </b>";
                echo $tweet["text"] . ".";
                echo "</p>";
            }
            ?>
        </div>
    </body>
</html>



