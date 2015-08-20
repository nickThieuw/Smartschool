<?php
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/klasservice.php");
require_once ("business/BerichtenService.php");
require_once ("business/afwezigheidservice.php");
require_once ("business/evenementservice.php");
require_once ("business/puntenservice.php");
require_once ("business/toetsservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "admin_level"){
    session_destroy();
}

if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "admin_level" && !isset($_GET["log"])){
    $includestate = false;
    if(isset($_GET['validation'])&& $_GET['validation']=='Y'){
        $includestate = true;
    }
    $leerkacht=  unserialize($_SESSION["gebruiker"]);
    $leerkrachtsvc = new leerkrachtservice();
    
    $GebruikerNaam=$leerkacht->getVoornaam();
    
    
    //enkel nodig voor removes
    
    $berichtenscv = new BerichtenService();
    $afwezigheidsvc = new afwezigheidservice();
    $evenementsvc = new evenementservice();
    $puntensvc = new puntenservice();
    $toetssvc = new toetsservice();
    
    //////////////////////////
    
    
    $leerlingsvc = new leerlingservice();
    
    $klassvc = new klasservice();
    $leerkrachtlijst = $leerkrachtsvc->leerkrachtlijst();//hier kun je het klasid invullen om te kiezen welke lijst je wil laden
    
    $lijstleerkrachtidsArr = $leerkrachtsvc->getallleerkrachtklasid();
    //is de array me klasnamen die in pres getoond zal worden
    $klasnaamlijstArr = array();
    $klastotalenArr = array();
    
    $show = true;
    
    foreach ($lijstleerkrachtidsArr as $klasidlk){//lk = leerkracht
        if($klasidlk != 1){
            $tempnaam = $klassvc->getklasnaam($klasidlk);
            $tempklastot = $leerlingsvc->getklastot($klasidlk);
            array_push($klasnaamlijstArr, $tempnaam);
            array_push($klastotalenArr, $tempklastot);
        }
    }
    $lijstoverganggevonden = $leerlingsvc->getallovergangactions();
    
    $gevondenovergangklasnaam = array();
    $klasovergangtotalen = array();
    
    foreach ($lijstoverganggevonden as $oudklasid){
        if($oudklasid != 1){
            $tempnaam = $klassvc->getklasnaam($oudklasid);
            $tempovergangtotalen = $leerlingsvc->gettotalovergangklas($oudklasid);
            array_push($gevondenovergangklasnaam, $tempnaam);
            array_push($klasovergangtotalen, $tempovergangtotalen);
        }
    }
    
    //presentatie arrays
    $klasnamenArr = array();           //array met alle klasnamen van oude klas
    $nieuwklasnamenArr = array();      //array met alle nieuwe klasnamen
    $foundklasoverArr = array();       //array met bool gevonden of niet
    $geslaagdenArr = array();          //array met count van de geslaagden
    $totleerlingenklasArr = array();   //array met de totaal aantal leerlingen per klas
    
    $totrows = count($klasnaamlijstArr);
    
    $gevondenrow = count($gevondenovergangklasnaam);
    
    $klasnamenArr = $klasnaamlijstArr;
    $totleerlingenklasArr = $klastotalenArr;
    
    for($y=0;$y<$totrows;$y++){
        $found = false;
        for($x=0;$x<$gevondenrow;$x++){
            if($klasnamenArr[$y] == $gevondenovergangklasnaam[$x] && $found == false){
                $found = true;
                $tempgevondenoudklasid = $klassvc->getklasid($gevondenovergangklasnaam[$x]);
                $tempnieuwklasid = $leerlingsvc->getnieuwklasid($tempgevondenoudklasid);
                $nieuwklasnaam = $klassvc->getklasnaam($tempnieuwklasid);
                array_push($foundklasoverArr,'volbracht');
                array_push($geslaagdenArr, $klasovergangtotalen[$x]);
                array_push($nieuwklasnamenArr, $nieuwklasnaam);
            }
        }
        if($found == false){
            array_push($foundklasoverArr,'niet volbracht');
            array_push($geslaagdenArr, 'geen');  
            array_push($nieuwklasnamenArr, 'ongewijzigd');
            $show = false;
        }
    }
    //functionaliteit als de for validation voltooid word
    if(isset($_GET['Code']) && $_GET['Code'] == 'Send'){
        $TempSubCode = $_POST['code'];
        $SubCode = sha1($TempSubCode);//submited code
        $Valresult = $leerkrachtsvc->validationcheckAdmin($leerkacht->getLeerkrachtid(), $SubCode);
        if($Valresult == 'succes'){
            //deze code word uitgevoerd als de admin een geldige code geeft en op voltooien klikt
            $level = $leerkacht->getAdmin();
            $leerkrachtsvc->DbtransferArchive($level);
            $klaslijstdoorzend = $klassvc->getklassenlijst();
            $leerlingsvc->overgangVoltooien($klaslijstdoorzend);
            //////////////hieronder staan alle removes die uitgevoerd worden
            $puntensvc->removepunten();
            $toetssvc->removetoetsen();
            $berichtenscv->removeberichten();
            $evenementsvc->removeevents();
            $afwezigheidsvc->removeafwezigheden();
            $leerkrachtsvc->removeovergangen();
            ////////////////////////////////////////////////////////////////
            header("location: home.php");
        }elseif($Valresult == 'incorrect'){
            header("location: overgang.php?validation=Y&&error=code");
        }elseif($Valresult == 'noadmin'){
            header("location: home.php");
        }
    }
    //$totaalll = $leerlingsvc->gettotleerlingen(); //als je totaal leerlingen wil kennen
    if($includestate == false){
        include 'presentation/overgangpresentatie.php';
    }else{
        //send mail to admin before include
        //get admin leerkracht eerst
        $adminDB = $leerkrachtsvc->getadmin();
        $Isobj = is_object($adminDB);
        if($Isobj){
            $adminDBid = $adminDB->getLeerkrachtid();
            $leerkrachtsvc->validationcontrolsend($adminDBid);
        }else{
            foreach ($adminDB as $admins){
                $adminsid = $admins->getLeerkrachtid();
                $leerkrachtsvc->validationcontrolsend($adminsid);
            }
        }
        //einde van de functionaliteit om de email met code te versturen
        include 'presentation/overgangvalidationpresentation.php';
    }
}else{
    header("location: home.php");
}
