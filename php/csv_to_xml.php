<?PHP
//Refactored script based on Prakash Chatterjee example 
echo "working... wait";
ob_flush();
flush();

$Data_id = ["3" => "Brislington", "6" => "Fishponds", "8" => "Parsons St", "9" => "Rupert St", "10" => "Wells Rd", "11" => "Newfoundland Way"];

foreach($Data_id as $key=>$value) {

  if(($handle = fopen("../xml/air_quality.csv", "r")) !== FALSE) {

    $header = array('id', 'desc', 'date', 'time', 'nox', 'no', 'no2', 'lat', 'long');

    fgetcsv($handle, 200, ",");

    $cols = count($header);
    $count = 1;
    $row = 2;
    $out = '<records>';

    while(($data = fgetcsv($handle, 200, ",")) !== FALSE) {

      if($data[0] == $key) {

        $rec = '<row count="' . $count . '" id="' . $row . '">';

        for($c=0; $c < $cols; $c++) {
          $rec .= '<' . trim($header[$c]) . ' val="' . trim($data[$c]) .'"/>';
        }

        $rec .= '</row>';
        $count++;
        $out .= $rec;
      }
      
      $row++;
    }    

    $out .= '</records>';

    $value = str_replace(' ', '_', $value);
    $value = strtolower($value);

    file_put_contents('../xml/'. $value .'.xml', $out); //$key

    fclose($handle);
  }
}

echo " ....all done";

?>
