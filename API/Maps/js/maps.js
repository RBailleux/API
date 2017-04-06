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
    var contentString = document.querySelector('.container-marker').innerHTML;

    // Add content HTML to Marker Container
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    // Show Modal Marker on Click
    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });
}
