<?php
$opts = array('http' => array('proxy'=> 'tcp://127.0.0.1:8080', 'request_fulluri'=> true));

$context = stream_context_create($opts);

function get_contents() {
    $file = file_get_contents("https://geo.api.gouv.fr/communes?nom=Nantes&fields=centre");
    $ip = json_decode($file);
    route($ip[0]->centre->coordinates[0], $ip[0]->centre->coordinates[1]);
 
  }

function getImage()
{
    $file = file_get_contents("https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?earth_date=2019-01-01&api_key=kdlIh4yvdWnDv8ag5AYZpCrlYWU8dfU4V1fACMc0");
    $ip = json_decode($file);
    return $ip->photos[2]->img_src;
}

function route($lon, $lat)
{
    $str = "http://api.loire-atlantique.fr:80/opendata/1.0/traficevents?filter=Tous";
    $file = file_get_contents($str);
    $route = json_decode($file);
    echo '<html> <head> 
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin="">
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>
    </head><body><div id="mapid">
    </div>
    <script src="js/carte.js"></script>
    <script>showMap('.$lat.','.$lon.');</script>';
    echo "<script>";
    $str = "";
    foreach ($route as $value) {
        $lati = $value->latitude;
        $long = $value->longitude;
        $rea= $value->ligne1  . $value->ligne2  . $value->ligne3   . $value->ligne5 .  $value->ligne6 ;
        $rais = str_replace("'","", $rea) ;
        $str .= 'addMarkerN('.$lati.','.  $long.', "'.$rais.'");';
    }
    echo $str;
    echo "</script>";
    echo "<img src='".getImage()."'>";
}

get_contents();
