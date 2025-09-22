 <div class="grid grid-cols-12 gap-x-6">
     <div class="xxl:col-span-8 col-span-8">
         <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>GPS Tracker</strong>
         </h6>
         <span>You can modify the credit details here.</span>
         <hr class="mb-3 !mt-3">
         @if ($errors->any())
             <div
                 class="alert alert-danger alert-dismissible fade show custom-alert-icon shadow-sm flex items-center mx-3">
                 <div>
                     <strong class="text-danger">Whoops! Something went wrong:</strong>
                     <ul class="list-disc list-inside mt-2 mx-4">
                         @foreach ($errors->all() as $error)
                             <li class="text-dark"><i>{{ $error }}</i></li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         @endif
         <div class="box-body">
            <div id="map1"></div>
         </div>
     </div>
     <div class="xxl:col-span-4 col-span-4">
         <h6 class="font-bold text-2xl text-gray-700 dark:text-white">
             <strong>Tools</strong>
         </h6>
         <span>You can adjust credit here.</span>
         <hr class="mb-3 !mt-3">

     </div>
 </div>


<link rel="stylesheet" href="../assets/libs/leaflet/leaflet.css">
 <!-- Leaflet Maps JS -->
 <script src="/assets/libs/leaflet/leaflet.js"></script>
<script>
    (function () {
    "use strict";

    /* default map */
  

    /* maps with markers circles and polygons */
    var shapesmap = L.map('map1').setView([51.505, -0.09], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'Â© OpenStreetMap'
    }).addTo(shapesmap);
    var marker = L.marker([51.5, -0.09]).addTo(shapesmap);
    var circle = L.circle([51.508, -0.11], {
        color: '#e354d4',
        fillColor: '#e354d4',
        fillOpacity: 0.5,
        radius: 500
    }).addTo(shapesmap);
    var polygon = L.polygon([
        [51.509, -0.08],
        [51.503, -0.06],
        [51.51, -0.047]
    ], {
        color: "#fe5454",
        fillColor: "#fe5454"
    }).addTo(shapesmap);

    // L.geoJson(statesData).addTo(geomap);
    function getColor(d) {
        return d > 1000 ? '#800026' :
            d > 500 ? '#BD0026' :
                d > 200 ? '#E31A1C' :
                    d > 100 ? '#FC4E2A' :
                        d > 50 ? '#FD8D3C' :
                            d > 20 ? '#FEB24C' :
                                d > 10 ? '#FED976' :
                                    '#FFEDA0';
    }
    function style(feature) {
        return {
            fillColor: getColor(feature.properties.density),
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.7,
            // fillColor: '#fff'
        };
    }
    // L.geoJson(statesData, { style: style }).addTo(geomap);
    function highlightFeature(e) {
        var layer = e.target;
        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.7
        });
        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }
    }
    function resetHighlight(e) {
        geojson.resetStyle(e.target);
    }
    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

})();
</script>
