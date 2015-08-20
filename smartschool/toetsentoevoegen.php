<?php

session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/toetsservice.php");
require_once ("business/vakservice.php");
require_once ("business/evenementservice.php");
require_once ("business/klasservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//alle vakservices en toetsservices aangemaakt
$vakservice = new vakservice();
$toetsservice = new toetsservice();
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
            $GebruikerNaam = $leerkacht->getEmailadres();
    $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
    if ((isset($_GET["action"])|isset($_POST["action"]) )&&( $_GET["action"] == "process" | $_POST["action"] == "process")) {
        //alles wordt opgevangen,gecontroleerd en klaargezet om te worden verstuurd
        if (empty($_POST["testnaam"])) {
            print($testerror = "missing test");
            $doorgaan = false;
        } else {
            $testnaam = strip_tags(trim($_POST["testnaam"]));
            if (empty($testnaam)) {
                $doorgaan = false;
                $testnaamerror = "missing";
            }
        }
        if (empty($_POST["puntentotaal"])) {
            print($puntentotaalerror = "missing puntentotaal");
            $doorgaan = false;
        } else {
            $puntentotaal = strip_tags(trim($_POST["puntentotaal"]));
            if (empty($puntentotaal)) {
                $doorgaan = false;
                $puntentotaalerror = "missing";
            }
        }
        if (empty($_POST["testdatum"])) {
            print($testdatumerror = "missing testdatum");
            $doorgaan = false;
        } else {
            $testdatum = strip_tags(trim($_POST["testdatum"]));
            if (empty($testdatum)) {
                $doorgaan = false;
                $testdatumerror = "missing";
            }
        }
        if (!isset($doorgaan)) {
            $doorgaan = true;
        }
        if ($doorgaan == true) {
            $vak = $_POST["vak"];
            $date = new DateTime($testdatum);
            $datum = $date->format("Y-m-d");
            $testdatum = $date->format("Y-m-d H-m-s");
            $date1 = new DateTime();
            $maand = $date1->format("m");
            if ($maand >= 9) {
                $trimister = 1;
            } else {
                if ($maand <= 4) {
                    $trimister = 2;
                } else{
                    $trimister = 3;
                }
            }
            
            // vanaf hier worden alle gegeven verstuurd naar database
            $vakid = $vakservice->getVakid($vak, $klasid);
            try{
                $toetsservice->voegNieuweToetsToe($vakid, $testnaam, $datum, $trimister, $puntentotaal);
            } catch (toetsbestaatexception $tbe){
                header("location:toetsentoevoegen.php?error=testbestaat");
                exit(0);
            }
            $info = $vak;
            $evenementsvc->voegNieuwEvenementToe($testnaam, $info, $testdatum, $testdatum, $klasid,1,0);
            header("location:agenda.php");
            exit(0);
        } else {
//            header("location:toetsenpagina.php");
//            exit(0);
        }
    }else {
        include("presentation/toetstoevoegenpres.php");
    }
} else {
    header("location: home.php");
    exit(0);
}
