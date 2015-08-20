<?php

session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/vakservice.php");
require_once ("business/toetsservice.php");
require_once ("business/puntenservice.php");
require_once ("business/klasservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if (isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level") {
    session_destroy();
}

if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])) {
    $leerkacht = unserialize($_SESSION["gebruiker"]);
    //initialiseer alle services
    $vaksvc = new vakservice();
    $toetsservice = new toetsservice();
    $puntensvc = new puntenservice();
    $leerlingsvc = new leerlingservice();
    $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
        $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
//get vakkenlijst en testlijst per vak op
    $klaslijst = $leerlingsvc->klasLijst($klasid);
    if (isset($_GET["action"]) && $_GET["action"] = "afw") {
        $k = 0;
        if (isset($_GET["toets"])) {
            $toets = $_GET["toets"];
        }
        $toetsid = $toetsservice->gettestid($toets);
        foreach ($klaslijst as $leerling) {
            if (isset($_POST["punten$k"]) && $_POST["punten$k"] != null) {
                $punten = $_POST["punten$k"];
                $puntensvc->voegNieuwePuntToe($leerling->getLeerlingid(), $punten, $toetsid);
                $k++;
            }else{
                $k++;//deze zorgt dat de teller toch omhoog gaat als er geen punt was
            }     
        }
        header("location:toetsenpagina.php");
    } else {
        $j = 0;
        if (isset($_GET["toets"]) && isset($_GET["vak"])) {
            $toets = $_GET["toets"];
            $vak = $_GET["vak"];
            $vakid = $vaksvc->getVakid($vak, $klasid);
            $test = $toetsservice->getTest($vakid, $toets);
        }
        include("presentation/puntentoevoegenpres.php");
    }
} else {
    header("location: home.php");
}