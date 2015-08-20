<?php
session_start();

require_once 'business/BerichtenService.php';
require_once 'business/leerkrachtservice.php';
require_once 'business/leerlingservice.php';
require_once 'entities/leerling.php';
require_once 'entities/leerkracht.php';

if(isset($_SESSION['rechten'])){
    
   
    if(isset($_GET["id"], $_GET['onderwerp'], $_GET['conversatie']) && !empty($_GET['id']) && !empty($_GET['onderwerp'])&& !empty($_GET['conversatie'])){
    $berichtS= new BerichtenService;
    
    //waarom sessions als hij een bericht verstuurd zonder boodschap is hij zijn berichtid kwijt, vandaar
    $bericht = $berichtS->getBericht($_GET['id']);
    //alle conversaties ophalen uit database
    $conversatie = $berichtS->getAlleConversaties($_GET['onderwerp'], $_GET['conversatie'], $bericht['datumTijd']);
    //print_r($bericht);
    if($bericht['fromStatus'] == 1){
     
            $leerkrachtServ = new leerkrachtservice();
            $leerkracht = $leerkrachtServ->getByid($bericht['fromId']);
            $voornaam = ucfirst($leerkracht->getVoornaam());
            $familienaam = ucfirst($leerkracht->getFamilienaam());
            $vanTerug = $voornaam. " " .$familienaam;
    }else{                  
            $leerlingServ = new leerlingservice();
            $leerling = $leerlingServ->getleerlingbyid($bericht['fromId']);
            $voornaam = ucfirst($leerling->getVoornaam());
            $familienaam = ucfirst($leerling->getFamilienaam());
            $vanTerug = $voornaam. " " .$familienaam;
    }
    if($bericht['toStatus'] == 1){
     
            $leerkrachtServ = new leerkrachtservice();
            $leerkracht = $leerkrachtServ->getByid($bericht['toId']);
            $voornaam = ucfirst($leerkracht->getVoornaam());
            $familienaam = ucfirst($leerkracht->getFamilienaam());
            $naarTerug = $voornaam. " " .$familienaam;
    }else{                  
            $leerlingServ = new leerlingservice();
            $leerling = $leerlingServ->getleerlingbyid($bericht['toId']);
            $voornaam = ucfirst($leerling->getVoornaam());
            $familienaam = ucfirst($leerling->getFamilienaam());
            $naarTerug = $voornaam. " " .$familienaam;
    }
    
    include 'presentation/presBekijkverzondenbericht.php';
}
}else{
    header('location: home.php');
}
