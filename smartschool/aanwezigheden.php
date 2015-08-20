<?php

session_start();

require_once ("business/leerlingservice.php");
require_once ("business/leerkrachtservice.php");
require_once ("business/afwezigheidservice.php");
require_once ("business/klasservice.php");
$leerlingsvc = new leerlingservice();
$afwezigheidservice = new afwezigheidservice();

    $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
if (isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level") {
    session_destroy();
}

//logout
if (!isset($_GET["action"])) {
    $action = "";
} else {
    $action = $_GET["action"];
}

if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])) {
    $afwezigen = $afwezigheidservice->getaanwezigheid();
    $aantalafwezigen = count($afwezigen) - 1;
    $leerkacht = unserialize($_SESSION["gebruiker"]);
    $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
    $klaslijst = $leerlingsvc->klasLijst($klasid); //hier kun je het klasid invullen om te kiezen welke lijst je wil laden
    $i = 0;
    $k = 0;
    $L = 0;
    $maxaantalleerlingen = count($klaslijst) - 1;
    $afwezighedenlijst = array();
    $afwezighedenlijstvalues = array();
    $GebruikerNaam = $leerkacht->getEmailadres();
    $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
$id_leerkracht = $leerkacht->getLeerkrachtid();
    // afwezigheden worden aangepast
    $_SESSION['klaslijst'] = serialize($leerlingsvc->klasLijst($klasid));
    //status
    $_SESSION['fromId']= $id_leerkracht;
    $_SESSION['fromStatus'] = 1;
    $_SESSION['toStatus'] = 0;


    if ($action == "afw") {
        while ($i <= $maxaantalleerlingen) {
            if (isset($_POST["afwezig$i"])) {
                $afwezig = $_POST["afwezig$i"];
                if ($afwezig == "on") {
                    $afwezighedenlijst[$i] = 1;
                }
            } else
                $afwezighedenlijst[$i] = 0;
            $i++;
        }
        if ($aantalafwezigen != -1) {
            while ($L <= $maxaantalleerlingen) {
                $afwezighedenlijstvalues[$L] = 0;
                $L++;
            }
            $i = 0;
            while ($k <= $aantalafwezigen) {
                $afwezigLid = $afwezigen[$k]->getLeerlingid();
                while ($i <= $maxaantalleerlingen) {
                    $leerling = $klaslijst[$i];
                    $leerlingid = $leerling->getLeerlingid();
                    if ($leerlingid == $afwezigLid) {
                        $afwezighedenlijstvalues[$i] = 1;
                    }
                    $i++;
                } $k++;
                $i = 0;
            }
            $k = 0;
        } else {
            while ($L <= $maxaantalleerlingen) {
                $afwezighedenlijstvalues[$L] = 0;
                $L++;
            }
        }
        while ($k <= $maxaantalleerlingen) {
            if ($afwezighedenlijst[$k] == 1) {
                if ($afwezighedenlijst[$k] != $afwezighedenlijstvalues[$k]) {
                    $leerling = $klaslijst[$k];
                    $datetime = new DateTime();
                    $datum = $datetime->format('Y-m-d H');
                    $leerlingid = $leerling->getLeerlingid();
                    $afwezigheidservice->voegNieuwAfwezigheidToe($leerlingid, $datum);
                }
            } else {
                if ($afwezighedenlijstvalues[$k] = 1) {
                    $leerling = $klaslijst[$k];
                    $leerlingid = $leerling->getLeerlingid();
                    $afwezigheidservice->deleteAfwezigheid($leerlingid);
                }
            }
            $k++;
        }
        header("location:klaslijst.php");
        exit(0);
    }

    // er wordt niets aangepast enkel naar de website gegaan
    else {
        $afwezigen = $afwezigheidservice->getaanwezigheid();
        $aantalafwezigen = count($afwezigen) - 1;
        $leerkacht = unserialize($_SESSION["gebruiker"]);
        $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
        $klaslijst = $leerlingsvc->klasLijst($klasid); //hier kun je het klasid invullen om te kiezen welke lijst je wil laden
        $i = 0;
        $k = 0;
        $L = 0;
        $maxaantalleerlingen = count($klaslijst) - 1;
        $afwezighedenlijstvalues = array();
        if ($aantalafwezigen != -1) {
            while ($L <= $maxaantalleerlingen) {
                $afwezighedenlijstvalues[$L] = 0;
                $L++;
            }
            while ($k <= $aantalafwezigen) {
                $afwezigLid = $afwezigen[$k]->getLeerlingid();

                while ($i <= $maxaantalleerlingen) {
                    $leerling = $klaslijst[$i];
                    $leerlingid = $leerling->getLeerlingid();

                    if ($leerlingid == $afwezigLid) {
                        $afwezighedenlijstvalues[$i] = 1;
                    }
                    $i++;
                } $k++;
                $i = 0;
            }
        } else {
            while ($L <= $maxaantalleerlingen) {
                $afwezighedenlijstvalues[$L] = 0;
                $L++;
            }
        }
        $j = 0;
        include("presentation/aanwezigheidslijstpresentation.php");
    }
} else {
    header("location: home.php");
    exit(0);
}