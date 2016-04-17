<ion-view style="" id="page2" title="Bewertung">
    <ion-content class="has-header" padding="true">
    <?php 

//$datum = "2016-04-16";
$datum = date("Y-m-d");

$mysqli = new mysqli("172.18.0.171", "mensaDBuser", "passwort", "mensadb");
   
   $i = 1; 
   $nameAkt;
   $idAkt;
    $result = $mysqli->query("SELECT gericht.gerichtID, gericht.gericht_name FROM gericht where gericht.datum = '".$datum."'"); 
while ($obj = mysqli_fetch_object($result)) {
        $name = substr($obj->gericht_name,0,-1*(strlen($obj->gericht_name)-strpos($obj->gericht_name,"(")));
        //printf ("%s <br>\n",$name);
        //$wertung = $obj->wertung;
        //if($wertung == "0"||$wertung == 0){
          //$wertung = "Keine Bewertungen";
        //} else {
         // $wertung = $wertung." von 5 Sterne";
        //}
        //echo("<a href=gericht_bewerten_formular.php?id=".$obj->gerichtID.">".$name ." bewerten</a><p>");
        if($i==1){
              $nameAkt = $name;
                $idAkt = $obj->gerichtID;          
        }
        $i++;
        

    }

//$getID = mysqli_fetch_array($result);
//echo(implode($getID));



            
            ?>
        <h1 style="color: rgb(0, 0, 0); text-align: center;" id="bewertung-heading1"><?php  echo($nameAkt); ?></h1>
        <div style="" class="button-bar">
            <button class="button button-positive  button-block" id="bewertung-button1">doof</button>
            <button class="button button-positive  button-block" id="bewertung-button2">2</button>
            <button class="button button-positive  button-block" id="bewertung-button4">3</button>
            <button class="button button-positive  button-block" id="bewertung-button5">4</button>
            <button class="button button-positive  button-block" id="bewertung-button3">sehr gut</button>
        </div>
        <form style="" class="list" method="POST" action="formular_absenden.php?id=<?php echo($idAkt); ?>">
            <ion-item style="" class="range range-positive">Menge&nbsp; 
            viel 
                <input name="menge" max="1" min="-1" value="0" type="range">
                wenig
            </ion-item>
            <ion-toggle style="" name="salzig" toggle-class="toggle-positive">salzig</ion-toggle>
            <label style="" name="kommentar" class="item item-input">
                <span class="input-label">Kommentar</span>
                <input placeholder="" type="text" name="kommentar">
            </label>
            <label style="" name="e-mail" class="item item-input">
                <span class="input-label">E-mail</span>
                <input placeholder="" type="email"  name="e-mail">
            </label>

        <button type="submit" class="button button-positive  button-block" id="bewertung-button6" href="formular_absenden.php?id=<?php echo($idAkt); ?>">Senden</a>
         </form>   </ion-content>
</ion-view>