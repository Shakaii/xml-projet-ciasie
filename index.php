<?php


function get_contents() {
    $opts = array('http' => array('proxy'=> 'tcp://www-cache:3128', 'request_fulluri'=> true));
    $context = stream_context_create($opts);
    $file = file_get_contents("http://ip-api.com/xml/",false, $context);
    $ip = simplexml_load_string($file);
    meteo($ip->lat, $ip->lon);
 
  }

function meteo($lat, $lon)
{
    $str = "http://www.infoclimat.fr/public-api/gfs/xml?_ll=".$lat.",".$lon."&_auth=ARsDFFIsBCZRfFtsD3lSe1Q8ADUPeVRzBHgFZgtuAH1UMQNgUTNcPlU5VClSfVZkUn8AYVxmVW0Eb1I2WylSLgFgA25SNwRuUT1bPw83UnlUeAB9DzFUcwR4BWMLYwBhVCkDb1EzXCBVOFQoUmNWZlJnAH9cfFVsBGRSPVs1UjEBZwNkUjIEYVE6WyYPIFJjVGUAZg9mVD4EbwVhCzMAMFQzA2JRMlw5VThUKFJiVmtSZQBpXGtVbwRlUjVbKVIuARsDFFIsBCZRfFtsD3lSe1QyAD4PZA%3D%3D&_c=19f3aa7d766b6ba91191c8be71dd1ab2";
    
    $opts = array('http' => array('proxy'=> 'tcp://www-cache:3128', 'request_fulluri'=> true));
    $context = stream_context_create($opts);
    $file = file_get_contents($str,false,$context);
    $meteo = simplexml_load_string($file);
    $strVelib = "http://www.velostanlib.fr/service/carto";
    $fileVelib = file_get_contents($strVelib);
    $Velib = simplexml_load_string($fileVelib); 
    $xsl = new DOMDocument;
    $xsl->load("meteo.xsl");
    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl);
    

   
    echo '<html> <head> 
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    </head><body><div id="mapid">
    </div>
    <script src="js/carte.js"></script>
    <script>showMap('.$lat.','.$lon.');';

    foreach ($Velib->markers->marker as $mark) {
      $tmp ="http://www.velostanlib.fr/service/stationdetails/nancy/".$mark["number"];
      $fileStation = file_get_contents($tmp);
      $station = simplexml_load_string($fileStation); 

      echo 'addMarker('.$mark["lat"].','.  $mark["lng"].','.$station->free .');';
   }
    echo '</script>'.$proc->transformToXML($meteo)."<body></html>";

}



  get_contents();
