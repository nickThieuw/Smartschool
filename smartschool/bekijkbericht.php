<?php
session_start();

require_once 'business/BerichtenService.php';
require_once 'business/leerkrachtservice.php';
require_once 'business/leerlingservice.php';
require_once 'entities/leerling.php';
require_once 'entities/leerkracht.php';

if(isset($_SESSION['rechten'])){
    
    //mocht je geen boodschap ingeven en toch verzenden
    if(isset($_SESSION['id'])&& isset($_SESSION['onderwerp'])&& isset($_SESSION ['conversatie'])){
        //alle conversaties opnieuw halen
        $berichtS= new BerichtenService;
        $conversatie = $berichtS->getAlleConversaties($_SESSION['onderwerp'], $_SESSION['conversatie'], $_SESSION['laatstedatum']);
    
        //bericht opnieuw halen
        $bericht = $berichtS->getBericht($_SESSION['id']);
            
            if($bericht['fromStatus'] == 1){
     
                    $leerkrachtServ = new leerkrachtservice();
                    $leerkracht = $leerkrachtServ->getByid($bericht['fromId']);
                    $voornaam = ucfirst($leerkracht->getVoornaam());
                    $familienaam = ucfirst($leerkracht->getFamilienaam());
                    $naarTerug = $voornaam. " " .$familienaam;
            }else{                  
                    $leerlingServ = new leerlingservice();
                    $leerling = $leerlingServ->getleerlingbyid($bericht['fromId']);
                    $voornaam = ucfirst($leerling->getVoornaam());
                    $familienaam = ucfirst($leerling->getFamilienaam());
                    $naarTerug = $voornaam. " " .$familienaam;
            }
            if($bericht['toStatus'] == 1){

                    $leerkrachtServ = new leerkrachtservice();
                    $leerkracht = $leerkrachtServ->getByid($bericht['toId']);
                    $voornaam = ucfirst($leerkracht->getVoornaam());
                    $familienaam = ucfirst($leerkracht->getFamilienaam());
                    $vanTerug = $voornaam. " " .$familienaam;
            }else{                  
                    $leerlingServ = new leerlingservice();
                    $leerling = $leerlingServ->getleerlingbyid($bericht['toId']);
                    $voornaam = ucfirst($leerling->getVoornaam());
                    $familienaam = ucfirst($leerling->getFamilienaam());
                    $vanTerug = $voornaam. " " .$familienaam;
            }
    }
        
if(isset($_GET["id"], $_GET['onderwerp'], $_GET['conversatie']) && !empty($_GET['id']) && !empty($_GET['onderwerp'])&& !empty($_GET['conversatie'])){
    $berichtS= new BerichtenService;
    //gelezen setten
    $berichtS ->setGelezen($_GET['id']);
    //opslag onderwerp en conversatie, als je een bericht mist ben je anders de gegevens kwijt
    $_SESSION['id']= $_GET['id'];
    $_SESSION['onderwerp'] = $_GET['onderwerp'];
    $_SESSION['conversatie'] = $_GET['conversatie'];
     //waarom sessions als hij een bericht verstuurd zonder boodschap is hij zijn berichtid kwijt, vandaar
    $bericht = $berichtS->getBericht($_SESSION['id']);
    $_SESSION['laatstedatum']= $bericht['datumTijd'];
    //alle conversaties ophalen uit database
    $conversatie = $berichtS->getAlleConversaties($_SESSION['onderwerp'], $_SESSION['conversatie'], $_SESSION['laatstedatum']);
    //print_r($conversatie);
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
    
    include 'presentation/presBekijkbericht.php';
}
if(isset($_GET['action'])&& $_GET['action'] === "beantwoord"){
    if(isset($_POST['response'])&&!empty($_POST['response'])) {
        
        /* addslashes : Returns a string with backslashes before characters that need to be
        escaped. These characters are single quote ('), double quote ("),
        backslash (\) and NUL (the NULL byte).*/
    
        $boodschap=$_POST['response'];
        $boodschapje = addslashes($boodschap);
              
        //datum maken
        date_default_timezone_set('Europe/Brussels');
        $datum = new DateTime;
       
        $toId = $bericht["toId"];
        $toStatus=$bericht["toStatus"];
        $titel=$bericht["titel"];
        $conversatie=$bericht["conversatie"];
        $fromId=$bericht["fromId"];
        $fromStatus=$bericht["fromStatus"];
        
        
        //////////array maken
        $arr= ['fromId' => $toId,
            'fromStatus' => $toStatus,
            'titel' => $titel,
            'conversatie' => $conversatie,
            'toId' => $fromId,
            'toStatus' => $fromStatus,
            'bericht' => $boodschapje,
            'datum' => $datum];
        $berichtS = new BerichtenService();
        $berichtS->voegBerichtToe($arr);
        unset($_SESSION['id']);
        unset($_SESSION['onderwerp']);
        unset($_SESSION['conversatie']);
        unset($_SESSION['laatstedatum']);
        header('location: berichtenzien.php');

        exit(0);
        

        }else{
            
            include 'presentation/presBekijkbericht.php';
        }
}
}else{
    header('location: home.php');
}
?> 
