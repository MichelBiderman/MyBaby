<?php
require_once('inc/cfg.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="css/style.css"/>
<title>Contact</title>
</head>
<body>
<?php include('inc/entete.php');
      include('menu.php');
?>
<nav id="contact">
<div id="map">
 <script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script><div style='overflow:hidden;height:400px;width:520px;'><div id='gmap_canvas' style='height:400px;width:520px;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='http://maps-generator.com/fr'>Sur www.maps-generator.com</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=8b4f87afae91be3324f92bf2e53efd6fb90eff74'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(43.6065722,1.449831300000028),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(43.6065722,1.449831300000028)});infowindow = new google.maps.InfoWindow({content:'<strong></strong><br>25, all�e jean jeaures<br>31000 Toulouse<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script> 
 </div>
 <aside id="coordonnees">
 <p>Vous pouvez nous contacter au :<br />
 <ul>
 <li>tel: 06.58.94.67.66</li>
 <li>mail: michou@michou.fr</li>
 </ul>
 </p>
 </aside>
</nav>
</body>
</html>