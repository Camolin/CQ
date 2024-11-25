function initMap() {
    var cor = {lat: 5.695633, lng: -76.649812};
    var map = new google.maps.Map(document.getElementById('map'), {
        center: cor,
        zoom: 15
    });
    
    // Agregar el marcador
    var marker = new google.maps.Marker({
        position: cor,
        map: map,
        title: 'Mi ubicación'
    });
}