<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3&callback=initMap&libraries=places&key=AIzaSyCO8WIGpCttR6bydhWF1rQ8gUjKpRmYTu4" async defer>
        </script>
        <link rel="stylesheet" href="/css/fa.css">
    </head>
    <body >

  <div class="main" id="map">   
         <?php 
         $json_url = "http://washstation.servismart.net/washstation/frontend/web/index.php?r=stores/get";
         $json = file_get_contents($json_url);
         $json=str_replace('},]',"}]",$json);
         ?>
  </div>
 <div class="menu">
    <div class="menuitem" id="1">AVEIRO</div>
    <div class="menuitem" id="2">COIMBRA</div>
    <div class="menuitem" id="3">FARO</div>
    <div class="menuitem" id="4">FUNCHAL</div>
    <div class="menuitem" id="5">LEIRIA</div>
    <div class="menuitem" id="6">LISBOA</div>
    <div class="menuitem" id="7">PORTO</div>
    <div class="menuitem" id="8">SANTAREM</div>
    <div class="menuitem" id="9">SETUBAL</div>
    <div class="menuitem" id="10">VISEU</div>
  </div>
    <script>
       var map;
       var infowindow;
       var coordinates;
       var coord;
       var bounds;  
      function initMap() {
       var obj = JSON.parse('<?= $json; ?>');   
       var coordinates = obj.loja;
        var coord;
      // console.log(coordinates);    
        var portugal = {
        lat: 38.813296,
        lng: -9.188284
        };
      //  console.log(portugal);
     map = new google.maps.Map(document.getElementById('map'), {
       center: portugal,      
       zoom:6,   
       radius: 100,
       styles: [
    {
        "featureType": "all",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "weight": "2.00"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "geometry.stroke",
        "stylers": [
            {
                "color": "#9c9c9c"
            }
        ]
    },
    {
        "featureType": "all",
        "elementType": "labels.text",
        "stylers": [
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "all",
        "stylers": [

            {
                "color": "#f2f2f2"
            }
        ]
    },
    {
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "landscape.man_made",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "all",
        "stylers": [
            {
                "saturation": -100
            },
            {
                "lightness": 45
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#eeeeee"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#7b7b7b"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    },
    {
        "featureType": "road.highway",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "simplified"
            }
        ]
    },
    {
        "featureType": "road.arterial",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "all",
        "stylers": [
            {
                "color": "#46bcec"
            },
            {
                "visibility": "on"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [
            {
                "color": "#c8d7d4"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "color": "#070707"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels.text.stroke",
        "stylers": [
            {
                "color": "#ffffff"
            }
        ]
    }
]
     });
     bounds = new google.maps.LatLngBounds();
     var infoWindow = new google.maps.InfoWindow();
        for(i in coordinates)
        {           
            coord = coordinates[i];            
            var lt = coord.gps; 

            var loc = coord.gps.split(",") 
            var lat = parseFloat(loc[0]);   
            var lng = parseFloat(loc[1]);
            var myLatlng = new google.maps.LatLng(lat,lng);
           // var name = coord.name;
          
            //alert(newURl);

            //alert(myLatlng);
            var image = {
            url: "/images/Logo WS_small_3.png",
           scaledSize: new google.maps.Size(40, 40)
           };
           var marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            animation: google.maps.Animation.DROP,
            title: coord.name ,
            icon: image,
           });
        marker.addListener('click', toggleBounce);
           (function (marker, coord) {
            var name = coord.name;
              var url = 'https://maps.google.com?saddr=Current+Location&daddr=';
           
            var newURl = url + lat + ', '+ lng ;
            //alert(newURl);
              // console.log(gps);
            google.maps.event.addListener(marker, "mouseover", function (e) {
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    infoWindow.setContent("<div style = 'width:300px;min-height:40px;font-size:16px' >" +"<b>" + name.toUpperCase() + "</b>" +'<a href="' + newURl + '"><img src="/images/direction.png"  style="position:relative;float:right;height:30px;width:30px;"></a> '+ "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, coord);
   }
      
 function toggleBounce() {
        if (marker.getAnimation() !== null) {
          marker.setAnimation(null);
        } else {
          marker.setAnimation(google.maps.Animation.BOUNCE);
        }
      }
     }    


$(document).ready(function ()
{
    $("#1").on('click', function ()
    {
      var southWest = new google.maps.LatLng(40.6241712,-8.665443800000002);
      var northEast = new google.maps.LatLng(40.6545896,-8.6238121);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(10);
    });
  
    $("#2").on('click', function ()
    {
      var southWest = new google.maps.LatLng(40.1713722,-8.5096411);
      var northEast = new google.maps.LatLng(40.2861477,-8.322907599999999);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(10);
    });
  
    $("#3").on('click', function ()
    {
      var southWest = new google.maps.LatLng(36.9617104,-8.0004686);
      var northEast = new google.maps.LatLng(37.0738998,-7.8093544);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(9);
    });
     $("#4").on('click', function ()
    {
      var southWest = new google.maps.LatLng(32.63294520000001,-16.9672461);
      var northEast = new google.maps.LatLng(32.6871381,-16.882095);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(10);
    });
      $("#5").on('click', function ()
    {
      var southWest = new google.maps.LatLng(39.70991799999999,-8.8768517);
      var northEast = new google.maps.LatLng(39.798205,-8.7350657);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(10);
    });
       $("#6").on('click', function ()
    {
      var southWest = new google.maps.LatLng(38.6913994,-9.229835599999999);
      var northEast = new google.maps.LatLng(38.7958538,-9.090570899999999);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(11);
    });
        $("#7").on('click', function ()
    {
      var southWest = new google.maps.LatLng(41.1383506,-8.6912939);
      var northEast = new google.maps.LatLng(41.1859353,-8.5526134);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(10);
    });
         $("#8").on('click', function ()
    {
      var southWest = new google.maps.LatLng(39.1687465,-8.899447499999999);
      var northEast = new google.maps.LatLng(39.4830094,-8.5431227);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(11);
    });
          $("#9").on('click', function ()
    {
      var southWest = new google.maps.LatLng(38.4539603,-9.055624099999999);
      var northEast = new google.maps.LatLng(38.5807011,-8.734231299999999);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(11);
    });
           $("#10").on('click', function ()
    {
     var southWest = new google.maps.LatLng(40.6072458,-7.9660481);
      var northEast = new google.maps.LatLng(40.7325793,-7.8250273);
      var bounds = new google.maps.LatLngBounds(southWest,northEast);
      map.fitBounds(bounds);
      map.setZoom(13);
    });
});
 </script>
</body>
</html>
