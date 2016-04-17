<ion-view style="" id="page4" title="Bewertung">
    <ion-content class="has-header" padding="true">
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
<style>
@import url(http://fonts.googleapis.com/css?family=Roboto:500,100,300,700,400);

* {
  margin: 0;
  padding: 0;
  font-family: roboto;
}

body { background: #000; }

.cont {
  width: 93%;
  max-width: 350px;
  text-align: center;
  margin: 4% auto;
  padding: 30px 0;
  background: #111;
  color: #EEE;
  border-radius: 5px;
  border: thin solid #444;
  overflow: hidden;
}

hr {
  margin: 20px;
  border: none;
  border-bottom: thin solid rgba(255,255,255,.1);
}

div.title { font-size: 2em; }

h1 span {
  font-weight: 300;
  color: #Fd4;
}

div.stars {
  width: 270px;
  display: inline-block;
}

input.star { display: none; }

label.star {
  float: right;
  padding: 10px;
  font-size: 36px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
</style>
<link href="http://www.cssscript.com/wp-includes/css/sticky.css" rel="stylesheet" type="text/css">

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
        if($i==2){
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
            
        </div>
        <form style="" class="list" method="POST" action="formular_absenden.php?id=<?php echo($idAkt); ?>">
            <div class="stars">
    
      <input class="star star-5" id="star-5" type="radio" name="star"/>
      <label class="star star-5" for="star-5"></label>
      <input class="star star-4" id="star-4" type="radio" name="star"/>
      <label class="star star-4" for="star-4"></label>
      <input class="star star-3" id="star-3" type="radio" name="star"/>
      <label class="star star-3" for="star-3"></label>
      <input class="star star-2" id="star-2" type="radio" name="star"/>
      <label class="star star-2" for="star-2"></label>
      <input class="star star-1" id="star-1" type="radio" name="star"/>
      <label class="star star-1" for="star-1"></label>
   
  </div>
            
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