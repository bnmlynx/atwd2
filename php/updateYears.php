<?php

include 'functions.php';

$location = $_POST['location'];

$location = '../' . $location;

echo json_encode(availableYears($location));


?>