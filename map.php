<?php

include 'conn.php';

// $servername = "localhost";
// $username = "username";
// $password = "password";

$dbname = "bot_data_collection";

// $conn = new mysqli($servername, $username, $password, $dbname);


$sql = "SELECT longitude, latitude FROM bot_data_collection where is_resolved='no'";
$result = $con->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}



?>

<script>
// Convert the PHP array to a JavaScript array
var locations = <?php echo json_encode($data); ?>;
// console.log(locations);



</script>

<script>

var locationsArray = [];

for (var i = 0; i < locations.length; i++) {
    // var location = locations[i];
    locationsArray.push([locations[i].longitude, locations[i].latitude]);
}

console.log(locationsArray);

</script>


<html>
  <head>
    <title>Complex Marker Icons</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script>
      /**
       * @license
       * Copyright 2019 Google LLC. All Rights Reserved.
       * SPDX-License-Identifier: Apache-2.0
       */
      // The following example creates complex markers to indicate beaches near
      // Sydney, NSW, Australia. Note that the anchor is set to (0,32) to correspond
      // to the base of the flagpole.
      function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 10,
          center: { lat: 26.881506, lng: 75.813788 },
        });

        setMarkers(map);
      }

      // Data for the markers consisting of a name, a LatLng and a zIndex for the
      // order in which these markers should display on top of each other.
      
      const beaches = [
        ["Bondi Beach", 26.881559, 75.813842, 4],
        ["Coogee Beach", -33.923036, 151.259052, 5],
        ["Cronulla Beach", -34.028249, 151.157507, 3],
        ["Manly Beach", -33.80010128657071, 151.28747820854187, 2],
        ["Maroubra Beach", -33.950198, 151.259302, 1],
      ];

      function setMarkers(map) {
        // Adds markers to the map.
        // Marker sizes are expressed as a Size of X,Y where the origin of the image
        // (0,0) is located in the top left of the image.
        // Origins, anchor positions and coordinates of the marker increase in the X
        // direction to the right and in the Y direction down.
        const image = {
          url: "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png",
          // This marker is 20 pixels wide by 32 pixels high.
          size: new google.maps.Size(20, 32),
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 32),
        };
        // Shapes define the clickable region of the icon. The type defines an HTML
        // <area> element 'poly' which traces out a polygon as a series of X,Y points.
        // The final coordinate closes the poly by connecting to the first coordinate.
        const shape = {
          coords: [1, 1, 1, 20, 18, 20, 18, 1],
          type: "poly",
        };

        locations = beaches
        for (let i = 0; i < locations.length; i++) {
          const beach = locations[i];

          new google.maps.Marker({
            position: { lat: beach[0], lng: beach[1] },
            map,
            icon: image,
            shape: shape,
          });
        }
      }

      window.initMap = initMap;
    </script>
    <style>
      /**
       * @license
       * Copyright 2019 Google LLC. All Rights Reserved.
       * SPDX-License-Identifier: Apache-2.0
       */
      /* 
        * Always set the map height explicitly to define the size of the div element
        * that contains the map. 
        */
      #map {
        height: 100%;
      }

      /* 
      * Optional: Makes the sample page fill the window. 
      */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTSVvHNFrbBDCf77izbQaM044LS-GEB4Q&callback=initMap&v=weekly"
      defer
    ></script>
  </body>
</html>