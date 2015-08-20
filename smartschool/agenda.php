<?php

session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/vakservice.php");
require_once ("business/klasservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//alle vakservices en toetsservices aangemaakt
$vakservice = new vakservice();
if (isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && ($_SESSION["rechten"] == "leerkracht_level" || $_SESSION["rechten"] == "admin_level" )) {
    session_destroy();
}

if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])) {
    $leerkacht = unserialize($_SESSION["gebruiker"]);
    $leerlingsvc = new leerlingservice();
    $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
    $vakkenlijst = $vakservice->vakkenLijst($klasid);
    $klaslijst = $leerlingsvc->klasLijst($klasid);
        $GebruikerNaam = $leerkacht->getEmailadres();
        $klassvc = new klasservice();
    $klasnaam = $klassvc->getklasnaam($klasid);

    include("presentation/default.php");

} else {
    if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "admin_level" && !isset($_GET["log"])) {
    $leerkacht = unserialize($_SESSION["gebruiker"]);
    $leerlingsvc = new leerlingservice();
    $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
    $GebruikerNaam = $leerkacht->getEmailadres();
    include("presentation/admindefault.php");

    } else {
    header("location: home.php");
        exit(0);
    }
}
