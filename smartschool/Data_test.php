<?php
require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/klasservice.php");
require_once ("business/BerichtenService.php");
require_once ("business/afwezigheidservice.php");
require_once ("business/evenementservice.php");
require_once ("business/puntenservice.php");
require_once ("business/toetsservice.php");

$leerkrachtsvc = new leerkrachtservice();
//$leerkrachtsvc->DbtransferArchive('admin_level');
//
//echo "test";
//
//    $leerkrachtsvc = new leerkrachtservice();
//    $berichtenscv = new BerichtenService();
    $afwezigheidsvc = new afwezigheidservice();
//    $evenementsvc = new evenementservice();
//    $puntensvc = new puntenservice();
//    $toetssvc = new toetsservice();
//
//
//    $puntensvc->removepunten();
//    $toetssvc->removetoetsen();
//    $berichtenscv->removeberichten();
//    $evenementsvc->removeevents();
//    $afwezigheidsvc->removeafwezigheden();
//    $leerkrachtsvc->removeovergangen();
//    
//    /////////om te zien of leerling op datum van test afwezig was    
//    $date = new DateTime();
//    $date->modify('-8 day');
//    $date->modify('-1 month');
//    $datum = $date->format('Y-m-d H:i:s');
//    $boolean=$afwezigheidsvc->boolgetafwezigheidleerlingiddate($datum, 2);
//    if($boolean){
//        print_r("testing this");
//    }else{
//        print_r("dees gaat verkeerd");
//    }
