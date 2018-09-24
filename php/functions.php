<?php

//Function to collect the times available for the data
function availableTimes($file="data/brislington_no2.xml") {
	$xmlReader = new xmlReader();
	$xmlReader->open($file);
	$Times = [];

	while($xmlReader->read()) {
		if($xmlReader->localName == "reading") {
			$time = $xmlReader->getAttribute('time');
			if(!in_array($time, $Times)) {
				$Times[] = $time;
			}
		}
	}
	sort($Times);
	return $Times;
}

//Function to get the available date range for readings for the stations
function availableDates($file="data/brislington_no2.xml") {
	$xmlReader = new xmlReader();
	$xmlReader->open($file);
	$Values = [];

	while($xmlReader->read()) {
		if($xmlReader->nodeType == XMLReader::ELEMENT && $xmlReader->localName == "reading") {

			$no2 = $xmlReader->getAttribute('no2');

			$date = $xmlReader->getAttribute('date');
			$date = str_replace('/', '-', $date);
			$d = strtotime($date);

			$Values[] = $d;
		}
	}

	$maxDate = max($Values);
	$minDate = min($Values);

	$max = date('Y-m-d', $maxDate);
	$min = date('Y-m-d', $minDate);

	$array = array(
			'min' => $min,
			'max' => $max
		);

	return $array;
}

//Function to get the years that data is available for each station
function availableYears($file="data/brislington_no2.xml") {
	$xmlReader = new xmlReader();
	$xmlReader->open($file);
	$Years = [];

	while($xmlReader->read()) {
		if($xmlReader->localName == "reading") {
			$date = $xmlReader->getAttribute('date');

			$year = getYear($date);

			if(!in_array($year, $Years)) {
				$Years[] = $year;
			}
		}
	}
	sort($Years);
	return $Years;
}

//Get year function
function getYear($date) {
	$Date = explode("/", $date);
	return $Date[2];
}

//Function to turn zero the months for Google Charts API format
function zeroMonth($readings) {
	$Dates = explode("/", $readings);
	$trim_zero = ltrim($Dates[1], '0');
	$zero_month = $trim_zero - 1;

	$Dates_formatted = [];
	$Dates_formatted[] = $Dates[2];
	$Dates_formatted[] = $zero_month;
	$Dates_formatted[] = $Dates[0];

	return $Dates_formatted;
}

//Readings for a day 
function dayReadings($xml="data/brislington_no2.xml", $day="13", $month="12", $year="2016") {

	$Data = [];
	$xmlReader = new XMLReader();
	$xmlReader->open('../' . $xml);

	$array = [];
	
	
	$array[] = $year;
	$array[] = $month;
	$array[] = $day;

	$combined_date = implode('/', $array);

	$timeStamp2 = strtotime($combined_date); //check this is correct
	$formatted_date = zeroMonth($combined_date);

	while($xmlReader->read()) {
		if($xmlReader->nodeType == XMLReader::ELEMENT && $xmlReader->localName == "reading") {
		
			$date = $xmlReader->getAttribute('date');
			$date = str_replace('/', '-', $date);
			$timeStamp1 = strtotime($date);

			if($timeStamp1 == $timeStamp2) {
				
				$no2 = $xmlReader->getAttribute('no2');
				$time = $xmlReader->getAttribute('time');

				$s = strtotime($time);

				$Data[] = array(
						'no2' => $no2,
						'time' => $time
					);
			}
		}
	}

	$t = array();

	foreach($Data as $key=>$row) {
		$t[$key] = $row['time'];
	}

	array_multisort($t, SORT_ASC, $Data);

	foreach($Data as $key=>$value) {

		$s = strtotime($value['time']);

		$date_object = 'Date(' .  $formatted_date[2].  ',' . $formatted_date[1] .',' . $formatted_date[0] . ','  . date('G', $s) . ',' . date('i', $s) . ',' . date('s', $s) . ')';

		$Data[$key]['time'] = $date_object;
	}

	return $Data;
}

function jsonDataDay($day_readings) {

	$Rows = [];
	$Table = [];
	$Table['cols'] = array(
		array(
				'label' => 'Time of day',
				'type' => 'datetime'
		),
		array(
				'label' => 'Level of NO2',
				'type' => 'number'
		)
	);

	foreach($day_readings as $value) {

		$Sub_array = [];
		$Sub_array[] = array(
				"v" => $value['time']
			);
		$Sub_array[] = array(
				"v" => $value['no2']
			);
		$Rows[] = array(
				"c" =>	$Sub_array
			);
	}

	$Table['rows'] = $Rows;

	echo json_encode($Table);

}

//Function to get the years worth of readings 
function yearReadings($xml="data/brislington_no2.xml", $year="2017", $hour="12:00:00") {
	
	$Data = [];
	$xmlReader = new XMLReader();
	$xmlReader->open('../' . $xml);

	while($xmlReader->read()) {
		if($xmlReader->nodeType == XMLReader::ELEMENT && $xmlReader->localName == "reading") {

			$date = $xmlReader->getAttribute('date');
			$time = $xmlReader->getAttribute('time');

			if(preg_match('/'. $year .'/', $date) && preg_match('/'. $hour .'/', $time)) {

				$no2 = $xmlReader->getAttribute('no2');
				$time = $xmlReader->getAttribute('time');

				if($no2 > 0) {

					$Data[] = array(
							'date' => $date,
							'no2' => $no2
						);	
				}
			}
		}
	}

	return $Data;
}

//Function to provide year readings
function jsonData($year_readings, $defra_colors) {

	$rows = [];
	$table = [];
	$table['cols'] = array(
		array(
			'label' => 'Days of the year',
			'type' => 'date'
		),
		array(
			'label' => 'Level of NO2',
			'type' => 'number'
		),
		array(
			'role' => 'style',
			'type' => 'string'
		)
	);
	
	foreach($year_readings as $value) {

		$color = defra_color($value['no2'], $defra_colors);
		$date = zeroMonth($value['date']);
		$sub_array = [];
		$sub_array[] = array(
				"v" => 'Date(' . $date[0] . ', ' . $date[1] . ', ' . $date[2] . ')'
			);
		$sub_array[] = array(
				"v" => $value['no2']
			);
		$sub_array[] = array(
				"v" => $color
			);

		$rows[] = array(
			"c" => $sub_array
		);

	}

	$table['rows'] = $rows;

	echo json_encode($table);
}

//Function for 
function defra_color($no2_value, $defra_colors) {

	foreach($defra_colors as $value) {
		$low = $value['low'];
		$high = $value['high'];
		$range = range($low, $high);

		if(in_array($no2_value, $range)) {

			return $value['color'];			
		}
	}
}


?>