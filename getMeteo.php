<?php
$apiKey = "your_openweathermap_apiKey";
$latitude=$_POST['lat'];
$longitude=$_POST['lon'];

// $data=$name."  ".$latitude."  ".$longitude;
// echo $data;


$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?lon=" . $longitude . "&lat=" .$latitude . "&lang=en&units=metric&APPID=" . $apiKey;
//echo $googleApiUrl;

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
//$data = json_decode($response);

$currentTime = time();
echo($response);

?>