<?php
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/gemeenteservice.php");
require_once ("business/klasservice.php");
    $leerlingsvc = new leerlingservice();
    $gemeentesvc = new gemeenteservice();

     $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
if(isset($_GET['leerlingid']) && isset($_SESSION["aangemeld"]) && isset($_SESSION["rechten"]) && $_SESSION["aangemeld"]
        && $_SESSION["rechten"]=="leerkracht_level"){
    // pagina resultaar na ingelogd als leerkracht met een leerling id in link
    $id = $_GET['leerlingid'];
    $leerkacht=  unserialize($_SESSION["gebruiker"]);
    $leerlingsvc = new leerlingservice();
    $klasid=$leerkacht->getKlasid();//haalt klasid op om toegang tot andere klassen te vermijden
    $GebruikerNaam = $leerkacht->getEmailadres();
    $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
    $leerling = $leerlingsvc->getleerlingbyid($id);

    include ('presentation/leerlingDetailPresentation.php');
    
}else{
    //header weg van pagina om geen toegang te geven aan not authorizede viewers.
    header("location: home.php");
    exit(0);
}