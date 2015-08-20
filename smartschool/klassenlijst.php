<?php //op deze contoller maakt de pagina die de lijst van alle klassen van de school geeft enkel voor admin
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/klasservice.php");

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "admin_level"){
    session_destroy();
}

if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "admin_level" && !isset($_GET["log"])){
    
    $leerkacht=  unserialize($_SESSION["gebruiker"]);
    $leerkrachtsvc = new leerkrachtservice();
   
    $klassvc = new klasservice();
    
    $klassenlijst =  $klassvc->getklassenlijst();
    $leerkrachtlijst = $leerkrachtsvc->leerkrachtlijst();
    
    include("presentation/klassenlijstpresentation.php"); 
}else{
    header("location: home.php");
}

