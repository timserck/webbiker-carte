<!DOCTYPE html>

<html lang="fr">
	<head> 
		<meta charset="utf-8" />
		<title>ma page</title>
		<style>
		*{
			margin: 0; padding: 0;
		}
		#map,body,html{
		width: 100%;
		height: 100%;
		}
		</style>
	</head>
	
	<body>
		<div id="map"></div> <!-- container -->azerazerilazeeazrzrearezzreauhzreauzreazreazreu!ç
 		<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
 
		      <script type="text/javascript">
      var map;
      function initMap() {

 // NOTE: This uses cross-domain XHR, and may not work on older browsers.
 

  // Create an array of styles.
  var styles = [
    {
      stylers: [
        { hue: "#00ffe6" },
        { saturation: -20 }
      ]
    },{
      featureType: "road",
      elementType: "geometry",
      stylers: [
        { lightness: 100 },
        { visibility: "simplified" }
      ]
    },{
      featureType: "road",
      elementType: "labels",
      stylers: [
        { visibility: "off" }
      ]
    }
  ];
  var initialLocation;
    var myLatLng = {lat: 50.470076899999996, lng: 4.86103890000005};
    //set namur gare enstead

   // Try W3C Geolocation (Preferred)

  if(navigator.geolocation) {
    browserSupportFlag = true;
    navigator.geolocation.getCurrentPosition(function(position) {
	 var initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
      map.setCenter(initialLocation);


    }, function() {
      handleNoGeolocation(browserSupportFlag);
    });
  }
  // Browser doesn't support Geolocation
  else {
    browserSupportFlag = false;
    handleNoGeolocation(browserSupportFlag);
  }
  function handleNoGeolocation(errorFlag) {
    if (errorFlag == true) {
      alert("Geolocation service failed.");
      initialLocation = myLatLng;
    } else {
      alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
      initialLocation = myLatLng;
    }
    map.setCenter(initialLocation);
  }

  // Create a new StyledMapType object, passing it the array of styles,
  // as well as the name to be displayed on the map type control.
  var styledMap = new google.maps.StyledMapType(styles,
    {name: "Styled Map"});

  // Create a map object, and include the MapTypeId to add
  // to the map type control.
  var mapOptions = {
    zoom: 15,
    center: myLatLng,
    mapTypeControlOptions: {
      mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
    }
  };
  var map = new google.maps.Map(document.getElementById('map'),
    mapOptions);

  //Associate the styled map with the MapTypeId and set it to display.
  map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');
   

  // Set destination, origin and travel mode.
 function trajet(marker_position){
if(directionsDisplay) {
directionDisplay.setMap(null);
    
}
 var directionsDisplay = new google.maps.DirectionsRenderer({
    map: map
  });

  var request = {
    destination: marker_position,
    origin: myLatLng,
    travelMode: google.maps.TravelMode.WALKING
  };

  // Pass the directions request to the directions service.
  var directionsService = new google.maps.DirectionsService();
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      // Display the route on the map.
      directionsDisplay.setDirections(response);
    }
  });

   }



$.getJSON("namur.json", function(json1) {
    $.each(json1, function(key, data) {
        var myLatLng = new google.maps.LatLng(data.latitude, data.longitude); 
        // Creating a marker and putting it on the map
        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            title: data.address
        });

        marker.addListener('click', function() {
    	 map.setCenter(marker.getPosition());
    	 var marker_position = marker.getPosition();
    	trajet(marker_position);
  		});
    });
});

 





}



	</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDantvsbWyrcyA1y91q_YaYbxEdYyQ876U&callback=initMap"
         type="text/javascript"></script>

	
</script>
         
		
	</body>
</html>
