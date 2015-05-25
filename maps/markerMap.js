var map, i, midLat, midLng;
function markInMap(addresses, names, id_map) {

    midLat = 0;
    midLng = 0;


    map = new google.maps.Map(document.getElementById(id_map), {
        zoom: 10,
        center: new google.maps.LatLng(0, 0),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    for (i = 0; i < addresses.length; i++) {


        $.getJSON('http://maps.googleapis.com/maps/api/geocode/json?address=' + addresses[i] + '&sensor=false&region=es', null, function (data) {

            var p = data.results[0].geometry.location

            midLat += p.lat;
            midLng += p.lng;

            var infowindow = new google.maps.InfoWindow({
                content: data.results[0].formatted_address
                //content: names[i] + ":<br>" + adresses[i]
            });


            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(p.lat, p.lng),
                map: map,
                title: data.results[0].formatted_address
                //icon: 'cine.png'
            });


            google.maps.event.addListener(marker, 'click', function () {

                infowindow.open(map, marker);

                //$("#description").html("<p>"+adresses[i]+"</p>");

            });

            //no siempre funciona por el asincrono...
            map.setCenter(new google.maps.LatLng(midLat / i, midLng / i));

        });


    }

}
;

