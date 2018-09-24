<?php

@date_default_timezone_set("GMT");

$Data = [];

$xmlReader = new XMLReader();
$xmlReader->open('../xml/wells_rd.xml');

$xmlWriter = new XMLWriter();
$xmlWriter->openURI('../data/wells_rd_no2.xml');
$xmlWriter->startDocument('1.0', 'UTF-8');
$xmlWriter->startElement("data");
$xmlWriter->writeAttribute('type', 'nitrogen dioxide');
$xmlWriter->startElement("location");
	$xmlWriter->writeAttribute('id', 'Wells Road');
	$xmlWriter->writeAttribute('lat', '51.427');
	$xmlWriter->writeAttribute('long', '-2.568');

	while($xmlReader->read()) {
		if($xmlReader->nodeType == XMLREADER::ELEMENT && $xmlReader->localName == "row") {
			while($xmlReader->read()) {
				if($xmlReader->localName == "date") {
					$date = $xmlReader->getAttribute('val');
					$Data[] = $date;
					$xmlReader->next();
				}
				if($xmlReader->localName == "time") {
					$time = $xmlReader->getAttribute('val');
					$Data[] = $time;					
					$xmlReader->next();
				}
				if($xmlReader->localName == "no2") {
					$no2 = $xmlReader->getAttribute('val');
					$Data[] = $no2;					
					$xmlReader->next();	
				}
			}
		}
	}

	for($i = 0; $i < count($Data);  $i += 3) {
		$xmlWriter->startElement("reading");
			$xmlWriter->writeAttribute('date', $Data[$i]);
			$xmlWriter->writeAttribute('time', $Data[$i + 1]);
			$xmlWriter->writeAttribute('no2', $Data[$i + 2]);
		$xmlWriter->endElement();
	}

$xmlWriter->endDocument();
$xmlWriter->flush();

echo "....all done";

?>