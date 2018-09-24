<?php
include 'functions.php';

$location = $_POST['location'];
$time = $_POST['time'];
$year = $_POST['year'];

$year_readings = yearReadings($location, $year, $time);

$json_data = jsonData($year_readings);

?>
