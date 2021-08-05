<?php 
define('HOSTNAME','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME', 'weather');

//global $con;
$con = mysqli_connect(HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_NAME ) or die ("error");
// Check connection
if(mysqli_connect_errno($con))	echo "Failed to connect MySQL: " .mysqli_connect_error();

$apiKey = "api_key";
$latitude=$_POST['lat'];
$longitude=$_POST['lon'];
$motif=$_POST['motif'];
$namePlace=$_POST['namePlace'];


$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?lon=" . $longitude . "&lat=" .$latitude . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response);

$temp = $data->main->temp;
$windSpeed = ($data->wind->speed)*3.6;
$visibility=($data->visibility)/1000;
$pressure = $data->main->pressure;
$windDirection = $data->wind->deg;
$humidity=$data->main->humidity;
$description=$data->weather[0]->description;
$clouds=$data->clouds->all;

$sql="INSERT INTO weather (temperature,motif,timeSave,dateSave,windSpeed,lat,lon,visibility,pressure,windDirection,humidity,description,placeName,clouds) VALUES (round($temp),'$motif',current_time(),curdate(),round($windSpeed),$latitude,$longitude,round($visibility),round($pressure),round($windDirection),round($humidity),'$description','$namePlace',$clouds)";

$insert=mysqli_query($con, $sql);
if ($insert) {
echo "created ";
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($con);
}


?>