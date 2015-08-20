<?php

session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/toetsservice.php");
require_once ("business/vakservice.php");
require_once ("business/puntenservice.php");
require_once ("business/evenementservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//alle vakservices en toetsservices aangemaakt
$vakservice = new vakservice();
$toetsservice = new toetsservice();
$puntensvc = new puntenservice();
$evenementsvc = new evenementservice();
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
    if (isset($_GET["action"]) && $_GET["action"] == "afw") {
        //alles wordt opgevangen,gecontroleerd en klaargezet om te worden verstuurd
        if (empty($_GET["toets"])) {
            print($testerror = "missing test");
            $doorgaan = false;
        } else {
            $toets = $_GET["toets"];
        }
        if (empty($_GET["vak"])) {
            print($vakerror = "missing vak");
            $doorgaan = false;
        } else {
            $vaknaam = $_GET["vak"];
        }
        
        if (!isset($doorgaan)) {
            $doorgaan = true;
        }
        if ($doorgaan == true) {
            // vanaf hier worden alle gegeven verstuurd naar database
            $vakid = $vakservice->getVakid($vaknaam, $klasid);
            $test = $toetsservice->getTest($vakid, $toets);
            $toetsid = $test->getTestid();
            $k = 0;
            if (isset($_POST["puntentotaal"])) {
                $puntentotaal = $_POST["puntentotaal"];
            } else {
                $puntentotaal = $test->getPuntentotaal();
            }
            if(isset($_POST["testnaam"])){
                $nieuwetestnaam = $_POST["testnaam"];
            } else {
                $nieuwetestnaam = $test->getTestomschrijving();
            }
            
            if (isset($_POST["testdatum"])){
                $toetsdatum = $_POST["testdatum"];
            } else {
                $toetsdatum =$test->GetDatum();
            }
            $date = new DateTime($toetsdatum);
            $datum = $date->format("Y-m-d H-m-s");
            $toetsservice->UpdateToets($toetsid,$vakid, $nieuwetestnaam,$toetsdatum, $puntentotaal);
            $info = $vaknaam;
            $evenementid = $evenementsvc->getevenementid($test->getTestomschrijving(), $klasid);
            $evenementsvc->UpdateEvenement($evenementid, $nieuwetestnaam, $info, $datum, $datum, $klasid);
            header("location:toetsenpagina.php");
            exit(0);
        } else {
            header("location: toetsenpagina.php?error=missinglink");
            exit(0);
        }
    } else {
        if (isset($_GET["vak"]) && isset($_GET["toets"])) {
            $vak = $_GET["vak"];
            $toets = $_GET["toets"];
        } else {
            header("location: toetsenpagina.php");
            exit(0);
        }
        $vakid = $vakservice->getVakid($vak, $klasid);
        $test = $toetsservice->getTest($vakid, $toets);
        $testId = $test->getTestid();
        $puntenlijst = $puntensvc->puntenLijst($testId);
        $j = 0;
        include("presentation/toetsenupdatepres.php");
    }
} else {
    header("location: home.php");
    exit(0);
}
