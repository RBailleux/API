<?php

// Include API Keys
include_once ('API/Maps/connect.settings.php');
include_once ('API/Meteo/meteo.php');

$geocoder = "http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false";

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>API Google Maps</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        body {
            height: 100%;
        }
        .map-responsive{
            overflow: hidden;
            padding-bottom: 50%;
            position: relative;
            height: 0;
        }
        .map-responsive iframe{
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            position: absolute;
        }
    </style>
</head>
<body class="container">
<h1>Google Maps - Agenda - Weather</h1>
<div id="map" class="map-responsive"></div>


<div class="container-marker">
    <div class="row">
        <div class="col-xs-12">
            <h2>Mon évênement 1</h2>
            <p>Mon texte descriptif</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>Informations relative à l'évênement</h3>
            <h4>Localisation :</h4>
            <p>Lieu exacte</p>
            <h4>Horraire :</h4>
            <p>Datetime</p>
            <h4>Avec : </h4>
            <p>Machin et Machin</p>
        </div>
        <?php if ($meteo->exists()) { ?>
            <div class="col-md-6">
                <h3>Météo lors de l'évênement</h3>
                <h4>Température</h4>
                <p><?php echo $meteo->getTemperature(); ?>°C</p>
                <h4>Vitesse du vent</h4>
                <p><?php echo $meteo->getWind(); ?>km/h</p>
                <?php if ($meteo->getSnowRisk()) { ?>
                    <h4>Risque de Neige</h4>
                    <p><?php echo $meteo->getSnowRisk(); ?></p>
                <?php } ?>
                <h4>Niveau de Pluit de 0 à 10</h4>
                <p><?php echo $meteo->getRainLevel(); ?></p>
            </div>
        <?php } ?>
    </div>
</div>


<script src="API/Maps/js/maps.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key_google_maps; ?>&callback=initMap">
</script>
</body>
</html>
