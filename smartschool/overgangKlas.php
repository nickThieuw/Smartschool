<?php //deze pagina is de pagina die voor de leerkracht het klas overzicht geeft
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/klasservice.php");
require_once ("business/gemeenteservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level"){
    session_destroy();
}

if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])){
    $leerkacht=  unserialize($_SESSION["gebruiker"]);
    $leerlingsvc = new leerlingservice();
    $klasid=$leerkacht->getKlasid();//haalt klasid op om toegang tot andere klassen te vermijden
    $GebruikerNaam = $leerkacht->getEmailadres();
    $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
    $klassenlijst = $klassvc->getklassenlijst();
    
    $gemeentesvc= new gemeenteservice();
    
    $klaslijst=$leerlingsvc->klasLijst($klasid);//hier kun je het klasid invullen om te kiezen welke lijst je wil laden
    $overgaande=$leerlingsvc->overgaande($klasid);
    $size=  count($overgaande);
    //init
    $lijst=array();
    $groottelijst=0;
    //lus runover get needed range
    foreach ($klaslijst as $record){
        $groottelijst=$groottelijst+1;
        $lijst[$groottelijst]=$record->getLeerlingid();
    }
        
    if(isset($_GET["action"]) && $_GET["action"]="over"){
        
        //lus om db aan te vullen met gekregen info
        $lijstpos = 0;
        if(isset($_POST['klasselectie'])){
            $keuzeklas = $_POST['klasselectie'];
        }
        foreach($klaslijst as $Use){
            $lijstpos=$lijstpos+1;
            $id=$lijst[$lijstpos];
            if(isset($_POST["overgang$id"])){
                $leerlingOver = $_POST["overgang$id"];
            }else{
                $leerlingOver = false;
            }
            
            if($leerlingOver=="on"){
                $leerlingsvc->overgangLeerling($id, $keuzeklas);
            }else{
                $leerlingsvc->removeovergang($id);
            }
        }
        header("location:klaslijst.php");
    }else{
        include("presentation/overgangklaspresentation.php"); 
    }
}else{
    header("location: home.php");
}