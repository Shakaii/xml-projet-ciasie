<?php
$opts = array('http' => array('proxy'=> 'tcp://127.0.0.1:8080', 'request_fulluri'=> true));

$context = stream_context_create($opts);

function get_contents() {
    $test = file_get_contents("http://ip-api.com/xml/");
    $ip = simplexml_load_string($test);
    echo $ip->status;
    meteo($ip->lat, $ip->lon);
  }

function meteo($lat, $lon)
{
    $str = "http://www.infoclimat.fr/public-api/gfs/xml?_ll=".$lat.",".$lon."&_auth=ARsDFFIsBCZRfFtsD3lSe1Q8ADUPeVRzBHgFZgtuAH1UMQNgUTNcPlU5VClSfVZkUn8AYVxmVW0Eb1I2WylSLgFgA25SNwRuUT1bPw83UnlUeAB9DzFUcwR4BWMLYwBhVCkDb1EzXCBVOFQoUmNWZlJnAH9cfFVsBGRSPVs1UjEBZwNkUjIEYVE6WyYPIFJjVGUAZg9mVD4EbwVhCzMAMFQzA2JRMlw5VThUKFJiVmtSZQBpXGtVbwRlUjVbKVIuARsDFFIsBCZRfFtsD3lSe1QyAD4PZA%3D%3D&_c=19f3aa7d766b6ba91191c8be71dd1ab2";
    $test = file_get_contents($str);
    $meteo = simplexml_load_string($test);
    echo $meteo->message;
}

  get_contents();
