function initMap() {
    var location = { lat: 14.420159, lng: 120.990546 };
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 10,
        center: location
    });

    var marker = new google.maps.Marker({
        position: location,
        map: map
    });
}