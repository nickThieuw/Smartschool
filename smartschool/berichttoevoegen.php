<?php 
session_start();
require_once 'business/BerichtenService.php';
require_once 'entities/leerkracht.php';
require_once 'entities/leerling.php';

//beveiliging
if(isset($_SESSION['rechten'])){
    unset($_SESSION['verzonden']);
    if($_SESSION['rechten'] === "leerkracht_level"){
        $klaslijst = unserialize($_SESSION['klaslijst']);
    }else{
        $leerkrachtlijst = unserialize($_SESSION['leerkrachtlijst']);
    }
    //variabelen ter kontrole van de input zie elseif's vanonderen
    $toBool = false;
    $onderwerpBool = false;
    $textaeraBool = false;
//het verzenden    
if(isset($_GET['action'])&&$_GET['action']==="voegtoe"){
          
if(isset($_POST['to'])&&!empty($_POST['to'])){
          $toId = $_POST['to'];
}
if(isset($_POST['titel'])&&!empty($_POST['titel'])){
          $titel = $_POST['titel'];
}
if(isset($_POST['bericht'])&&!empty($_POST['bericht'])){
          $bericht=$_POST['bericht'];
}
if(isset($toId, $titel, $bericht)) {
        
        /* addslashes : Returns a string with backslashes before characters that need to be
        escaped. These characters are single quote ('), double quote ("),
        backslash (\) and NUL (the NULL byte).*/
        
        //titel kontroleren
        //haal alle mogelijke conversatiewaarden uit de tabel berichten voor een bepaalde titel
        $berichtS = new BerichtenService();
        $conversatiewaarde = array();
        $conversatiewaarde = $berichtS->kontroleerTitel($titel);
        
        //voor alle mogelijke waardes van conversatie de grootsten uithalen
        $opslag = 0;
        foreach ($conversatiewaarde as $value) {
            if($value['conversatie']> $opslag){
               $opslag = $value['conversatie']; 
            }
        }
        //is er geen waarde gevonden =0 else +1 
        if($opslag == 0){
            $conversatieW = 1; 
        }else{
            $conversatieW = $opslag + 1;
        }
        //print("conversatiewaarde: " + $conversatiewaarde);
        $titelSlash = addslashes($titel);
        $berichtSlash = addslashes($bericht);
            
        //datum maken
        date_default_timezone_set('Europe/Brussels');
        $datum = new DateTime;
       
        //////////array maken
        $arr= ['fromId' => $_SESSION['fromId'],
            'fromStatus' => $_SESSION['fromStatus'],
            'titel' => $titelSlash,
            'conversatie'=> $conversatieW,
            'toId' => $toId,
            'toStatus' => $_SESSION['toStatus'],
            'bericht' => $berichtSlash,
            'datum' => $datum];
        
        $berichtS->voegBerichtToe($arr);
        
        $_SESSION['verzonden']="Uw bericht is verzonden";
        
        //include 'presentation/presBerichttoevoegen.php';
        header('location: berichtenverzonden.php');
        
        }
  }else{
      include 'presentation/presBerichttoevoegen.php';
  } 
}else{
    header('location: home.php');
    exit(0);
}