<?php

session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/vakservice.php");
require_once ("business/klasservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//alle vakservices en toetsservices aangemaakt
$vakservice = new vakservice;
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
        $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
    if (isset($_GET["action"]) && $_GET["action"] == "process") {
        //alles wordt opgevangen,gecontroleerd en klaargezet om te worden verstuurd
        if (empty($_POST["vakNaam"])) {
            print($vakerror = "missing vak");
            $doorgaan = false;
        } else {
            $vaknaam = strip_tags(trim($_POST["vakNaam"]));
            if (empty($vaknaam)) {
                $doorgaan = false;
                $vaknaamerror = "missing";
            }
        }
        
        if (!isset($doorgaan)) {
            $doorgaan = true;
        }
        if ($doorgaan == true) {

            // vanaf hier worden alle gegeven verstuurd naar database
            
            try{
            $vakservice->voegNieuwVakToe($vaknaam,$klasid);
            header("location:vakkentoevoegen.php?gelukt=true");
            exit(0);
            } catch (vakbestaatexception $vbe){
                header("location:vakkentoevoegen.php?error=vakbestaat");
                exit(0);
            }
                }
    }else {
        include("presentation/vakkentoevoegenpres.php");
    }
    if (isset($_GET["gelukt"]) && $_GET["gelukt"] == "true"){
        echo '<div id="dialog" title="Vak toegevoegd">Vak is toegevoegd</div>';
    }
} else {
    header("location: home.php");
    exit(0);
}