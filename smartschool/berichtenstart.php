<?php
session_start();
require_once 'business/leerkrachtservice.php';
require_once 'business/leerlingservice.php';
require_once 'entities/leerkracht.php';
require_once 'entities/leerling.php';

/*leerkracht of ouders?*/
if($_SESSION['rechten']==="leerkracht_level"){
    //unserialize
    $leerkracht = unserialize($_SESSION["gebruiker"]);
    $id_leerkracht = $leerkracht->getLeerkrachtid();
    $klasid = $leerkracht->getKlasid();
    //getKlasLijst
    $leerlingsvc = new leerlingservice();
    $_SESSION['klaslijst'] = serialize($leerlingsvc->klasLijst($klasid));
    //status
    $_SESSION['fromId']= $id_leerkracht;
    $_SESSION['fromStatus'] = 1;
    $_SESSION['toStatus'] = 0;
  
    
}elseif($_SESSION['rechten']==="ouders_level"){
    //unserialize
    $leerling = unserialize($_SESSION["gebruiker"]);
    $id_leerling = $leerling->getLeerlingid();
    $klasid = $leerling->getKlasid();
    //echo $klasid;
    //mocht er een leraar ziek zijn, dan kan een leerling 2 leerkrachten hebben
    $leerkrachtsvc = new leerkrachtservice();
    $_SESSION['leerkrachtlijst'] = serialize($leerkrachtsvc->getLeerkracht($klasid));
    //print_r($leerkrachtsvc->getLeerkracht($klasid));
    //status
    $_SESSION['fromId']= $id_leerling;
    $_SESSION['fromStatus'] = 0;
    $_SESSION['toStatus'] = 1;
  
    //print_r($leerkrachtsvc->getLeerkracht($klasid));
}else{
    header("location: home.php");
    exit(0);
}
include 'presentation/presStart.php';