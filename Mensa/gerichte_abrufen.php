<?php



$row = 1;
if (($handle = fopen("http://www.stwno.de/infomax/daten-extern/csv/HS-R-tag/15.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num Felder in Zeile $row: <br /></p>\n";
        $row++;
        if(substr($data[2],0,2)=="HG"){
        
          for ($c=0; $c < $num; $c++) {
        
              echo $data[$c] . "<br />\n";
            }
            // 0 datum
            // 3 name
            // 6 preis student
            sendToSQL($data[3],$data[6],$data[0]);
        }
    }
    fclose($handle);
}

function sendToSQL($gerichtName, $gerichtPreisStudent, $datum){
$mysqli = new mysqli("172.18.0.171", "mensaDBuser", "passwort", "mensadb");

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

if ($result = $mysqli->query("SELECT gerichtID FROM gericht where gericht.gericht_name = \"".$gerichtName."\"")) {
    echo($result->current_field.'<br />');
    echo($result->field_count.'<br />');
    //echo(implode($result->lengths).'<br />');
    printf("Select returned %d rows.<br />", $result->num_rows);
    $datum = substr($datum,6,4)."-".substr($datum,3,2)."-".substr($datum,0,2);
    
    echo($datum);
    $gerichtPreisStudent = str_replace(",",".",$gerichtPreisStudent);
    if($result->num_rows == 0 ){
      echo ("<br> ".$gerichtPreisStudent);
      $mysqli->query("INSERT INTO gericht VALUES(DEFAULT,'".$gerichtName."',".$gerichtPreisStudent.",'".$datum."')");
    }

    /* free result set */
    $result->close();
    //echo("Hallo");
}
//echo("Welt");



}


?>
