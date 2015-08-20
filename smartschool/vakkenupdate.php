<?php

session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/toetsservice.php");
require_once ("business/vakservice.php");
require_once ("business/puntenservice.php");
require_once ("business/klasservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//alle vakservices en toetsservices aangemaakt
$vakservice = new vakservice();
$toetsservice = new toetsservice();
$puntensvc = new puntenservice();
if (isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level") {
    session_destroy();
}

if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])) {
    $leerkacht = unserialize($_SESSION["gebruiker"]);
    $leerlingsvc = new leerlingservice();
    $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
    $vakkenlijst = $vakservice->vakkenLijst($klasid);
    $klaslijst = $leerlingsvc->klasLijst($klasid);
            $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
    if (isset($_GET["action"]) && $_GET["action"] == "afw") {
        //alles wordt opgevangen,gecontroleerd en klaargezet om te worden verstuurd
        if (empty($_GET["vak"])) {
            print($vakerror = "missing vak");
            $doorgaan = false;
        } else {
            $vak = $_GET["vak"];
        }
        if (empty($_POST["vakNaam"])) {
            print($vakerror = "missing vak");
            $doorgaan = false;
        } else {
            $vaknaam = $_POST["vakNaam"];
        }
        if (!isset($doorgaan)) {
            $doorgaan = true;
        }
        if ($doorgaan == true) {
            // vanaf hier worden alle gegeven verstuurd naar database
            $vakid= $vakservice->getVakid($vak, $klasid);
            $vakservice->UpdateVak($vakid,$vaknaam,$klasid);
            header("location:toetsenpagina.php");
            exit(0);
        } else {
            header("location: toetsenpagina.php?error=missinglink");
            exit(0);
        }
    } else {
        if(isset($_GET["vak"])){
            $vaknaam = $_GET["vak"];
        } else {
            header("location:toetsenpagina.php?error=missinglink");
            exit(0);
        }
        include("presentation/vakkenupdatepres.php");
    }
} else {
    header("location: home.php");
    exit(0);
}
