<?php


//define("debug", true);

if(defined("debug")){
echo($_GET["id"]."<br>");
echo(serialize($_POST));
echo($_POST["star"]);
}


$gerichtID = $_GET["id"];

$mail = $_POST["e-mail"];
$kommentar = $_POST["kommentar"];
$menge = $_POST["menge"];
$sterne = $_POST["star"];


if(isset($_POST["salzig"]) && $_POST["salzig"] == "on"){
  $salzig = 1;
}else{
  $salzig = 0;
}

$datum = date("Y-m-d");
include 'include/database_settings.php';
$mysqli = new mysqli($datenbank_ip, $DBuser, $DBpasswort, $DBname);  
//echo("mail: ".substr($mail,-17));
if(substr($mail,-17) == "oth-regensburg.de"){
  //userID, punkte und letzeBewertung abfragen
  
  $result = $mysqli->query("SELECT userID, punkte, letzteBewertung from student where email =  '".$mail."'"); 
  if($result->num_rows != 0){
    $obj = mysqli_fetch_object($result);
    $userID = $obj -> userID;
    $punkte = $obj -> punkte;
    $letzteBewertung = $obj -> letzteBewertung;
   // echo ($letzteBewertung);
   $mysqli->query("INSERT INTO bewertung VALUES(DEFAULT,".$userID.",".$gerichtID.",'".$datum."',".$sterne.",".$salzig.", NULL,".$menge.",'".$kommentar."')");   
        
   if($datum != $letzteBewertung){
    $mysqli->query("UPDATE student SET letzteBewertung='" . $datum . "', punkte = ".($punkte + 1)." where userID = ".$userID);
   }
  }else{
    $mysqli->query("INSERT INTO student VALUES(DEFAULT,'".$mail."',1,'".$datum."')");
  }
  
}else{
   $mysqli->query("INSERT INTO bewertung VALUES(DEFAULT,NULL,".$gerichtID.",'".$datum."',".$sterne.",".$salzig.", NULL,".$menge.",'".$kommentar."')");

}
if(!defined("debug")){
header("Refresh:0; url=index.html#page3");
echo("Weiterleitung..");
}




?>