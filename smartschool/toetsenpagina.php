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
    if (isset($_GET["vak"])&&!isset($_GET["toets"])) {
        $vak = $_GET["vak"];
        $klaslijst = $leerlingsvc->klasLijst($klasid); //hier kun je het klasid invullen om te kiezen welke lijst je wil laden
        $vakId = $vaksvc->getVakid($vak, $klasid);
        $toetsenlijst = $toetsservice->toetsenLijst($vakId);
        $k = 0;
        include("presentation/toetsenlijstpres.php");
    } else {
        if (isset($_GET["toets"])) {
            $toets = $_GET["toets"];
            $vak = $_GET["vak"];
            $vakid = $vaksvc->getVakid($vak, $klasid);
            $test = $toetsservice->getTest($vakid, $toets);
            $testId = $toetsservice->gettestid($toets);
            $puntenlijst = $puntensvc->puntenLijst($testId);
            $klaslijst = $leerlingsvc->klasLijst($klasid); //hier kun je het klasid invullen om te kiezen welke lijst je wil laden
            $j = 0;
            if(isset($puntenlijst[0])){
            include("presentation/puntenlijstpres.php");
            }else{
                header ("location:puntentoevoegen.php?vak=$vak&toets=$toets");
            }
        } else {
            $vakkenlijst = $vaksvc->vakkenLijst($klasid);
            $i = 0;
            include("presentation/vakkenlijstpres.php");
        }
    }
} else {
    header("location: home.php");
}