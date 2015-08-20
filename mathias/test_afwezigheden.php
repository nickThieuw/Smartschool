<?php

session_start();

require_once ("business/leerlingservice.php");
require_once ("business/leerkrachtservice.php");

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level"){
    session_destroy();
}

//logout
if(!isset($_GET["action"])){
    $action="" ;
} else{
    $action=$_GET["action"];
}

if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])) {
    $leerkacht = unserialize($_SESSION["gebruiker"]);
    $leerlingsvc = new leerlingservice();
    $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
    if ($action == "afw") {
        $klassize = $leerlingsvc->klassize($klasid);
        echo $klassize;
        echo $klasid;
    }else{
        $klaslijst = $leerlingsvc->klasLijst($klasid); //hier kun je het klasid invullen om te kiezen welke lijst je wil laden
        include("presentation/aanwezigheidslijstpresentation.php");
    }
}else{
    header("location: home.php");
}