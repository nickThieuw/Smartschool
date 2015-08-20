<?php
session_start();
require_once 'business/leerkrachtservice.php';
require_once 'business/leerlingservice.php';
//$addfirst= new leerkrachtservice();   werd gebruik om eens de invoeg functies te kunnen uit testen. pas is admin hashed
//$addfirst->leerkrachttoevoegen("admin", "d033e22ae348aeb5660fc2140aec35850c4da997", "admin", "unknown", "1111-11-11", "", 1, true);
//$addfirst->leerkrachttoevoegen("paul.de_bakker@skynet.be", "75ef9faee755c70589550b513ad881e5a603182c", "paul", "de bakker", "1978-04-01", "", 1, false);

if(isset($_GET["submited"]) && $_GET["submited"]){
    $emailadres = $_POST["gebruikersnaam"];
    $wachtwoord =  sha1($_POST["wachtwoord"]);
    
    $leerkrachtservic = new leerkrachtservice();
    $leerkracht = $leerkrachtservic->logincheck($emailadres, $wachtwoord);
    
    if($leerkracht == false){
       
       $leerlingservice = new leerlingservice();
       $leerling = $leerlingservice->logincheck($emailadres, $wachtwoord);
       
       if($leerling == false){
           
           echo '<div id="dialog" title="Verkeerde inlog">Email en/of wachtwoord werd niet teruggevonden in onze database</div>';           
       }else{
           $_SESSION["aangemeld"]=true;
           $_SESSION["rechten"]="ouders_level";
           
           $_SESSION["gebruiker"]=  serialize($leerling);
       }
    }else{
        if($leerkracht->getAdmin() == true){
           $_SESSION["aangemeld"]=true;
           $_SESSION["rechten"]="admin_level";
           
        }else{
           $_SESSION["aangemeld"]=true;
           $_SESSION["rechten"]="leerkracht_level";
        }
        print_r($leerkracht);
        $_SESSION["gebruiker"]=serialize($leerkracht);
    }
}

if(isset($_SESSION["aangemeld"])){//controle ingelogd of niet met bij ingelogd contlore op gebruikers niveau
    if(isset($_SESSION["aangemeld"]) && isset($_SESSION["rechten"]) && $_SESSION["rechten"]=="admin_level"){
        header("location: leerkrachtlijst.php");
    }elseif(isset ($_SESSION["aangemeld"]) && isset($_SESSION["rechten"]) && $_SESSION["rechten"]=="leerkracht_level"){
        header("location: aanwezigheden.php");
    }elseif(isset ($_SESSION["aangemeld"]) && isset($_SESSION["rechten"]) && $_SESSION["rechten"]=="ouders_level"){
        header("location: HomeOuders.php");
    }else{
        header("location: home.php");
    }
}else{
    include'presentation/homepresentation.php';
}



