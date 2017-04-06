<?php

include_once ('connect.settings.php');

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
    <script src="js/maps.js"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=<?php echo $api_key_google_maps; ?>&callback=initMap">
    </script>
</body>
</html>
