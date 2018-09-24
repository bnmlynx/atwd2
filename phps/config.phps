<?php
date_default_timezone_set('GMT');
include 'php/functions.php';

$locations = ['Brislington', 'Fishponds', 'Newfoundland Way', 'Parsons Street', 'Rupert Street', 'Wells Road'];

$available_times = availableTimes();
$available_years = availableYears();
$available_dates = availableDates();

$file_names = glob("data/*.xml");
$available_locations = array_combine($file_names, $locations);


?>
