
<ion-view style="background-color: rgb(117, 119, 194);" id="page1" title="Foodsaver">
    <ion-content class="has-header" padding="true">
        <ion-list style="">
        
 <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style>

* {
  margin: 0;
  padding: 0;
  font-family: roboto;
}



label.star {
  
  padding: 3px;
  font-size: 18px;
  color: #444;
  transition: all .2s;
}


label.star:before {
  content: '\f005';
  color: #FD4;
  font-family: FontAwesome;
}
</style>


        <?php 

//$datum = "2016-04-16";
$datum = date("Y-m-d");
$datenbank_ip = "127.0.0.1";

include  '../include/database_settings.php';
$mysqli = new mysqli($datenbank_ip, $DBuser, $DBpasswort, $DBname);  
   
      $result = $mysqli->query("SELECT gericht.gerichtID, gericht.gericht_name FROM gericht where gericht.datum = '".$datum."'");  
   
$i = 1;
$gerichteListe = array();
$gerichteID = array();
$gerichteRatings = array();

while ($obj = mysqli_fetch_object($result)) {


        
        $name = substr($obj->gericht_name,0,-1*(strlen($obj->gericht_name)-strpos($obj->gericht_name,"(")));
        if(mb_detect_encoding($name) != 'UTF-8') {          $name = utf8_encode($name); }
         $umlaute = array("ä", "ö", "ü", "Ä", "Ö", "Ü", "ß");
    $htmlchar = array("&auml;", "&ouml;", "&uuml;", "&Auml;", "&Ouml;", "&Uuml;", "&szlig;");
    $name = str_replace($umlaute, $htmlchar,$name);
        //printf ("%s <br>\n",$name);
        //$wertung = $obj->wertung;
        //if($wertung == "0"||$wertung == 0){
          //$wertung = "Keine Bewertungen";
        //} else {
         // $wertung = $wertung." von 5 Sterne";
        //}
        //echo("<a href=gericht_bewerten_formular.php?id=".$obj->gerichtID.">".$name ." bewerten</a><p>");
       /*
        switch($i){
        case 1:  echo('<ion-item style="" ui-sref="bewertung">'.$name.'</ion-item>');
        break;
        case 2:  echo('<ion-item style="" href="www.google.de" ui-sref="bewertung2" >'.$name.'</ion-item>');
        break;
       case 3:  echo('<ion-item style="" ui-sref="bewertung3">'.$name.'</ion-item>');
        break;
          
        
        }*/
        $gerichteListe[$i]='<ion-item style="" href="#/bewertung/HG'.$i.'">'.$name.'<br>';
        //$gerichteListe[$i] = $gerichteListe[$i].'(Noch keine Bewertungen)</ion-item>';
        //echo($gerichteListe[$i]);
        $gerichteID[$i] = $obj -> gerichtID;
        if($i == 1){
        $sqlIDs = "".$gerichteID[$i];
        }else{
        $sqlIDs = $sqlIDs.",".$gerichteID[$i];
        }
        $i++;
        //echo($name);
           

    }
    $anzahlGerichte = $result -> num_rows;
    
    //ratings aus datenbank abfragen
    $sqlRatings = "SELECT gericht.gerichtID, gericht.gericht_name, AVG(bewertung.wertung) as ratingAVG \n"
    . "from gericht\n"
    . "inner join bewertung \n"
    . "on bewertung.gerichtID = gericht.gerichtID\n"
    . "where gericht.gerichtID in (".$sqlIDs.")\n"
    . "GROUP by gericht.gerichtID";
     $result = $mysqli->query($sqlRatings); 
     $i = 1;
     while ($obj = mysqli_fetch_object($result)){
     for($i = 1; $i <= $anzahlGerichte; $i++){
     
      if($gerichteID[$i] == $obj->gerichtID){
        $gerichteRatings[$i] = substr($obj->ratingAVG,0,3);
        
      }
     
     }
     
     
     }

  
  
    
    //ausgabe
    for($j = 0;$j<10;$j++){   
     if(isset($gerichteListe[$j])){
     
     if(isset($gerichteRatings[$j])){
    //$gerichteListe[$j] = $gerichteListe[$j].$gerichteRatings[$j];
    
    switch(substr($gerichteRatings[$j],0,1)){
    case 1: $gerichteListe[$j] = $gerichteListe[$j].'('.$gerichteRatings[$j].' <label class="star star-2" > </label>)';
    break;
    case 2: $gerichteListe[$j] = $gerichteListe[$j].'('.$gerichteRatings[$j].' <label class="star star-2" > </label><label class="star star-2" > </label>)';
    break;
    case 3: $gerichteListe[$j] = $gerichteListe[$j].'('.$gerichteRatings[$j].' <label class="star star-2" > </label><label class="star star-2" > </label><label class="star star-2" > </label>)';
    break;
    case 4: $gerichteListe[$j] = $gerichteListe[$j].'('.$gerichteRatings[$j].' <label class="star star-2" > </label><label class="star star-2" > </label><label class="star star-2" > </label><label class="star star-2" > </label>)';
    break;
    case 5: $gerichteListe[$j] = $gerichteListe[$j].'('.$gerichteRatings[$j].' <label class="star star-2" > </label><label class="star star-2" > </label><label class="star star-2" > </label><label class="star star-2" > </label><label class="star star-2" > </label>)';
    break;
    }
    
    }else{
    $gerichteListe[$j] = $gerichteListe[$j].'(Noch keine Bewertungen)';
    }
     
    $gerichteListe[$j] = $gerichteListe[$j].'</ion-item>';
    echo($gerichteListe[$j]);
    }
    }
    
    

//$getID = mysqli_fetch_array($result);
//echo(implode($getID));



            
            ?>
        </ion-list>
    </ion-content>
</ion-view>