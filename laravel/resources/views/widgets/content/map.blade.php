<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key={{ config('morillas.google_map_key') }}'></script>
<div style='overflow:hidden;height:100vh;width:100%;'>
    <div id='gmap_canvas' style='height:100vh;width:100%;'></div>
    <style>#gmap_canvas img {
            max-width: none !important;
            background: none !important
        }</style>
</div> <a href='https://www.embed-map.net/'>adding a google map to website</a>
<script type='text/javascript'
        src='https://embedmaps.com/google-maps-authorization/script.js?id=fd9537b71350095bf562dd7b9f362c0e934ede37'></script>
<script type='text/javascript'>function init_map() {
        var myOptions = {
            zoom: 16,
            center: new google.maps.LatLng(28.1125872, -15.41944060000003),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            scrollwheel: false,
            zoomControl: true
        };
        map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
        marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(28.1125872, -15.41944060000003)});
        /*infowindow = new google.maps.InfoWindow({content: '<strong>Implantis</strong><br>C/ León y Castillo, 64<br>35003 Las Palmas de Gran Canaria<br>'});
        google.maps.event.addListener(marker, 'click', function () {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);*/
    }
    google.maps.event.addDomListener(window, 'load', init_map);</script>