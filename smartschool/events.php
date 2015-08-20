<?php
session_start();

require_once("business/leerkrachtservice.php");
require_once("business/evenementservice.php");
require_once ("business/leerlingservice.php");

$evenementservice = new evenementservice();
$leerkrachtsvc = new leerkrachtservice();
$leerlingsvc = new leerlingservice();
if (isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && ($_SESSION["rechten"] == "leerkracht_level" || $_SESSION["rechten"] == "admin_level")) {
    session_destroy();
}

if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])) {
        $leerkacht = unserialize($_SESSION["gebruiker"]);
        //initialiseer alle services
        
        $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
        echo json_encode($evenementservice->EvenementLijst($klasid));
}else {
    if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
            $_SESSION["rechten"] == "admin_level" && !isset($_GET["log"])) {
            echo json_encode($evenementservice->FullEvenementLijst());
        } else {
            if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
            $_SESSION["rechten"] == "ouders_level" && !isset($_GET["log"])){
                $leerling = unserialize($_SESSION["gebruiker"]);
                $klasid = $leerling->getKlasid();
                echo json_encode($evenementservice->EvenementLijst($klasid));
            }else{
                header("location: home.php");
            }
        }
    
}