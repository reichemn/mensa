<?php



$row = 1;
$kw  = 0;
$kw  = date('W', time());
if (($handle = fopen("http://www.stwno.de/infomax/daten-extern/csv/HS-R-tag/" . $kw . ".csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $num = count($data);
        //echo "<p> $num Felder in Zeile $row: <br /></p>\n";
        $row++;
        if (substr($data[2], 0, 2) == "HG") {
            
            for ($c = 0; $c < $num; $c++) {
                
                echo $data[$c] . "<br />\n";
            }
            // 0 datum
            // 3 name
            // 6 preis student
            sendToSQL($data[3], $data[6], $data[0]);
        }
    }
    fclose($handle);
}

function sendToSQL($gerichtName, $gerichtPreisStudent, $datum)
{
   // $mysqli = new mysqli($datenbank_ip, "mensaDBuser", "passwort", "mensadb");
   
   include 'templates/database_settings.php';
$mysqli = new mysqli($datenbank_ip, $DBuser, $DBpasswort, $DBname);  
    
    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }
    
    if ($result = $mysqli->query("SELECT gerichtID FROM gericht where gericht.gericht_name = \"" . $gerichtName . "\"")) {
        //echo ($result->current_field . '<br />');
        //echo ($result->field_count . '<br />');
        //echo($result->lengths.'<br />');
        printf("Select returned %d rows.<br />", $result->num_rows);
        $datum = substr($datum, 6, 4) . "-" . substr($datum, 3, 2) . "-" . substr($datum, 0, 2);
        
        echo ($datum);
        $gerichtPreisStudent = str_replace(",", ".", $gerichtPreisStudent);
        if ($result->num_rows == 0) {
            echo ("<br> " . $gerichtPreisStudent);
            $mysqli->query("INSERT INTO gericht VALUES(DEFAULT,'" . $gerichtName . "'," . $gerichtPreisStudent . ",'" . $datum . "')");
        } else {
            //echo("HAHAHAHAAH");
            $mysqli->query("UPDATE gericht SET datum='" . $datum . "' where gericht.gericht_name = \"" . $gerichtName . "\"");
        }
        
        /* free result set */
        $result->close();
        //echo("Hallo");
    }
    //echo("Welt");
    
    
    
}


?>
