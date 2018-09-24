<?php
date_default_timezone_set('GMT');

include('functions.php');

$defra_colors[] = array('low'=>'0', 'high'=>'67', 'color'=>'#9cff9c');
$defra_colors[] = array('low'=>'68', 'high'=>'134', 'color'=>'#31ff00');
$defra_colors[] = array('low'=>'135', 'high'=>'200', 'color'=>'#23d100');
$defra_colors[] = array('low'=>'201', 'high'=>'267', 'color'=>'#ffff00');
$defra_colors[] = array('low'=> '268', 'high'=>'334', 'color'=>'#ffcf00');
$defra_colors[] = array('low'=> '335', 'high'=>'400', 'color'=>'#ff9a00');
$defra_colors[] = array('low'=> '401', 'high'=>'467', 'color'=>'#ff6464');
$defra_colors[] = array('low'=> '468', 'high'=>'534', 'color'=>'#f00');
$defra_colors[] = array('low'=> '535', 'high'=>'600', 'color'=>'#900');
$defra_colors[] = array('low'=> '601', 'high'=>'800', 'color'=>'#ce30ff');

$location = $_POST['location'];
$time = $_POST['time'];
$year = $_POST['year'];

$year_readings = yearReadings($location, $year, $time);

$json_data = jsonData($year_readings, $defra_colors);

?>