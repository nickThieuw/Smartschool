<?php
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "ouders_level"){
    session_destroy();
}

if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "ouders_level" && !isset($_GET["log"])){
    $ouder=  unserialize($_SESSION["gebruiker"]);
    $leerlingsvc = new leerlingservice();
    $leerling=$leerlingsvc->getleerlingbyid($ouder->getLeerlingid());//hier kun je het klasid invullen om te kiezen welke lijst je wil laden
    include("presentation/oudersgegevenspresentation.php"); 
}else{
    header("location: home.php");
}

