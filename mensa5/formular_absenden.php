<?php

//echo($_GET["id"]."<br>");
//echo(serialize($_POST));

$gerichtID = $_GET["id"];

$mail = $_POST["e-mail"];
$kommentar = $_POST["kommentar"];
$menge = $_POST["menge"];

if(isset($_POST["salzig"]) && $_POST["salzig"] == "on"){
  $salzig = 1;
}else{
  $salzig = 0;
}

$datum = date("Y-m-d");
$mysqli = new mysqli("172.18.0.171", "mensaDBuser", "passwort", "mensadb");
echo("mail: ".substr($mail,-17));
if(substr($mail,-17) == "oth-regensburg.de"){
  //userID, punkte und letzeBewertung abfragen
  
  $result = $mysqli->query("SELECT userID, punkte, letzteBewertung from student where email =  '".$mail."'"); 
  if($result->num_rows != 0){
    $obj = mysqli_fetch_object($result);
    $userID = $obj -> userID;
    $punkte = $obj -> punkte;
    $letzteBewertung = $obj -> letzteBewertung;
   // echo ($letzteBewertung);
   $mysqli->query("INSERT INTO bewertung VALUES(DEFAULT,".$userID.",".$gerichtID.",'".$datum."',".rand(1,5).",".$salzig.", NULL,".$menge.",'".$kommentar."')");   
        
   if($datum != $letzteBewertung){
    $mysqli->query("UPDATE student SET letzteBewertung='" . $datum . "', punkte = ".($punkte + 1)." where userID = ".$userID);
   }
  }else{
    $mysqli->query("INSERT INTO student VALUES(DEFAULT,'".$mail."',1,'".$datum."')");
  }
  
}else{
   $mysqli->query("INSERT INTO bewertung VALUES(DEFAULT,NULL,".$gerichtID.",'".$datum."',".rand(1,5).",".$salzig.", NULL,".$menge.",'".$kommentar."')");

}

header("Refresh:0; url=index.html#page3");





?>