<?php

date_default_timezone_set('GMT');
include 'functions.php';

$location = $_POST['location'];
$date = $_POST['date'];

$d = explode('-', $date);

$day = $d[2];
$month = $d[1];
$year = $d[0];

$dayReadings = dayReadings($location, $day, $month, $year);

$json_data = jsonDataDay($dayReadings);

?>