<?php
session_start();
require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/gemeenteservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if (isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "ouders_level") {
    session_destroy();
}
if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "ouders_level" && !isset($_GET["log"])){
        //unserialize
    $leerling = unserialize($_SESSION["gebruiker"]);
    $id_leerling = $leerling->getLeerlingid();
    $klasid = $leerling->getKlasid();
    //echo $klasid;
    //mocht er een leraar ziek zijn, dan kan een leerling 2 leerkrachten hebben
    $leerkrachtsvc = new leerkrachtservice();
    $_SESSION['leerkrachtlijst'] = serialize($leerkrachtsvc->getLeerkracht($klasid));
    //print_r($leerkrachtsvc->getLeerkracht($klasid));
    //status
    $_SESSION['fromId']= $id_leerling;
    $_SESSION['fromStatus'] = 0;
    $_SESSION['toStatus'] = 1;
    
    include("presentation/HomeOudersPresentation.php"); 
}else{
    header("location: home.php");
}

