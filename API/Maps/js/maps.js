function initMap() {
    var myPosition = {lat: 48.856614, lng: 2.352222};
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17,
        center: myPosition
    });

    // Create Marker container
    var marker = new google.maps.Marker({
        position: myPosition,
        map: map,
        title: 'Hello World!'
    });

    // Create HTML content Modals Marker
    var contentString =
        '<div class="row">' +
            '<div class="col-xs-12">' +
                '<h2>Mon évênement 1</h2>' +
                '<p>Mon texte descriptif</p>' +
            '</div>' +
        '</div>' +
        '<div class="row">' +
            '<div class="col-md-6">' +
                '<h3>Informations relative à l\'évênement</h3>' +
                '<h4>Localisation :</h4>' +
                '<p>Lieu exacte</p>' +
                '<h4>Horraire :</h4>' +
                '<p>Datetime</p>' +
                '<h4>Avec : </h4>' +
                '<p>Machin et Machin</p>' +
            '</div>' +
            '<div class="col-md-6">' +
                '<h3>Météo lors de l\'évênement</h3>' +
                '<h4>Température</h4>' +
                '<p>14°C</p>' +
                '<h4>Vitesse du vent</h4>' +
                '<p>140km/h</p>' +
                '<h4>Type de temps</h4>' +
                '<p>Pluit / Neige</p>' +
            '</div>' +
        '</div>';

    // Add content HTML to Marker Container
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    // Show Modal Marker on Click
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

}
