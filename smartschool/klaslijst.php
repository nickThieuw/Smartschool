<?php //deze pagina is de pagina die voor de leerkracht het klas overzicht geeft
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/klasservice.php");
require_once ("business/gemeenteservice.php");
require_once ("business/pdf_en_grafiekservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level"){
    session_destroy();
}

if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])){
    $leerkacht=  unserialize($_SESSION["gebruiker"]);
    $id_leerkracht = $leerkacht->getLeerkrachtid();
    $leerlingsvc = new leerlingservice();
    $klasid=$leerkacht->getKlasid();//haalt klasid op om toegang tot andere klassen te vermijden
    $GebruikerNaam = $leerkacht->getEmailadres();
    $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
    
    $gemeentesvc= new gemeenteservice();
    
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
    
        $_SESSION['klaslijst'] = serialize($leerlingsvc->klasLijst($klasid));
    //status
    $_SESSION['fromId']= $id_leerkracht;
    $_SESSION['fromStatus'] = 1;
    $_SESSION['toStatus'] = 0;
    
    
    if(isset($_GET["del"]) && $_GET["del"]=="yes" && isset($_GET["id"])){
        $todeleteid = $_GET["id"];
        $leerlingsvc->deleteleerling($todeleteid);
        header("location: klaslijst.php");
    }else{
        
    }
    $klaslijst=$leerlingsvc->klasLijst($klasid);//hier kun je het klasid invullen om te kiezen welke lijst je wil laden
    include("presentation/klaslijstpresentation.php"); 
}else{
    header("location: home.php");
}