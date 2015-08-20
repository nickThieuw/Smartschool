<?php
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/gemeenteservice.php");
require_once ("business/klasservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if (isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "ouders_level") {
    session_destroy();
}
if(isset($_SESSION["aangemeld"]) && isset($_SESSION["rechten"]) && $_SESSION["aangemeld"]
        && $_SESSION["rechten"]=="ouders_level" && !isset($_GET["log"])){
        $leerlingsvc = new leerlingservice();
    $gemeentesvc = new gemeenteservice();
    // pagina resultaar na ingelogd als leerkracht met een leerling id in link
    $Ouders=  unserialize($_SESSION["gebruiker"]);
    $GebruikerNaam = $Ouders->getEmailadres();
    $leerlingID = $Ouders->getLeerlingId();
    $leerling = $leerlingsvc->getleerlingbyid($leerlingID);
    
    include ('presentation/leerlingOudersDetailPresentation.php');
    
}else{
    //header weg van pagina om geen toegang te geven aan not authorizede viewers.
    header("location: home.php");
}