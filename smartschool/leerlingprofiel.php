<?php
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/gemeenteservice.php");
require_once ("business/klasservice.php");

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level"){
    session_destroy();
}

if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])){
    $leerkacht=  unserialize($_SESSION["gebruiker"]);
    $leerlingsvc = new leerlingservice();
    $gemeentesvc = new gemeenteservice();
    $klasid=$leerkacht->getKlasid();//haalt klasid op om toegang tot andere klassen te vermijden
        $GebruikerNaam = $leerkacht->getEmailadres();
    $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
    if(isset($_GET["action"]) && isset($_GET["update"]) && $_GET["action"] == "process" && $_GET["update"] == "yes"){
        $old_foto_path=$_SESSION['old_foto_path'];
        $leerlingid= $_GET["leerlingid"];
        $voornaam=$_POST["Voornaam"];
        $familienaam=$_POST["Familienaam"];
        $geboortedatum=$_POST["geboortedatum"];
        
        $datetime = new DateTime($geboortedatum);
        
        
                        if(isset($_FILES["foto_leerling"]) && $_FILES["foto_leerling"]['error']!=4){
                            $target_folder="Foto_leerling/";
                            $target_file= $target_folder.basename($_FILES["foto_leerling"]["name"]);
                            $uploadSucces=1;
                            $imageFileType=  pathinfo($target_file,PATHINFO_EXTENSION);
                            $daytime= new DateTime($geboortedatum);
                            $geboortedatum=$daytime->format('Y-m-d');
                            //echo $geboortedatum;
                            $foto_naam= $geboortedatum.$voornaam.$familienaam;
                            $target_file = $target_folder . basename($foto_naam.".".$imageFileType);//rename

                            $foto_leerling=$target_file;
                            //echo $foto_leerling;

                            //controle op image beschikbaar
                            $check = getimagesize($_FILES["foto_leerling"]["tmp_name"]);
                            if($check !== false) {
                                $uploadSucces = 1;
                            } else {
                                $uploadSucces = 0;
                            }

                            //controle of bestand al bestaat in folder
                            if (file_exists($target_file)) {
                                //pagina naar error image bestaat
                                $exists_foto = 0;
                            }

                            //max grootte op 2mb --ongeveer--
                            if ($_FILES["foto_leerling"]["size"] > 1000000) {
                                //pagina naar error te groot
                                $uploadSucces = 0;
                            }

                            // laat enkel jpg,png,jpeg,gif door 
                            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                            && $imageFileType != "gif" ) {
                                //pagina naar error niet juiste extentie
                                $uploadSucces = 0;
                            }

                        }else{
                           $foto=$old_foto_path;
                           $uploadSucces = 0;//no file added
                            header("location: home.php");
                        }
                        
                        if(isset($_FILES["foto_leerling"]) && $_FILES["foto_leerling"]['error']!=4){
                            // controle of alle checks geslaagd waren
                            if ($uploadSucces == 0) {
                                //$foto='Foto_leerling/defaul_foto.png';
                                //er word geen bestand upgeload
                            } else {
                                if($old_foto_path!="Foto_leerling/defaul_foto.png"){
                                    unlink($old_foto_path);
                                }
                                if (move_uploaded_file($_FILES["foto_leerling"]["tmp_name"], $target_file)) {
                                    $foto=$foto_leerling;
                                    //als file upgeload werd
                                } else {
                                    //als niet correct is
                                }
                            }
                        }
        
        
        $straat=$_POST["straat"];
        $huisnr=$_POST["huisnr"];
        $bus=$_POST["bus"];
        $postcode=$_POST["postcode"];
        $gemeente = strip_tags(trim($_POST["gemeente"]));
        $gemeente = strtolower($gemeente);
        
        $geboortedatum = $datetime->format('Y,m,d');
        //gemeete toevoegen indien mogelijk
        if($postcode!=null&&$gemeente==null){
            header("location: leerlingprofiel.php?error=postcode&update=yes&leerlingid=".$leerlingid);
        }elseif($gemeente!=null&&$postcode==null){
            header("location: leerlingprofiel.php?error=postcode&update=yes&leerlingid=".$leerlingid);
        }else{
            $gemeentesvc->addGemeente($postcode,$gemeente);
        }
        //postcode id zoeken
        $gemeenteObj= $gemeentesvc->getGemeente($postcode,$gemeente);
        $postcode_id= $gemeenteObj->getGemeente_id();
                
        $telefoonnr=$_POST["telefoonnr"];
        $klasid=$leerkacht->getKlasid();
        $voornaamouder1=$_POST["voornaamouder1"];
        $familienaamouder1=$_POST["familienaamouder1"];
        $voornaamouder2=$_POST["voornaamouder2"];
        $familienaamouder2=$_POST["familienaamouder2"];
        $GSMouder1=$_POST["GSMouder1"];
        $GSMouder2=$_POST["GSMouder2"];
        $emailadres=$_POST["email"];
        //$wachtwoord=$_POST["wachtwoord"];
        
        //$wachtwoord= sha1($wachtwoord);
        if($postcode!=null&&$gemeente==null){
            header("location: leerlingprofiel.php?error=postcode&update=yes&leerlingid=".$leerlingid);
        }elseif($gemeente!=null&&$postcode==null){
            header("location: leerlingprofiel.php?error=postcode&update=yes&leerlingid=".$leerlingid);
        }else{
            $leerlingsvc->updateLeerling($leerlingid,$voornaam, $familienaam, $geboortedatum, $foto, $straat, $huisnr,$bus,$postcode_id, $telefoonnr
            , $klasid, $voornaamouder1, $familienaamouder1, $voornaamouder2, $familienaamouder2, $GSMouder1
            , $GSMouder2, $emailadres);
            header("location: klaslijst.php");
        }
        
    
        
    }else{
        
        if(isset($_GET["leerlingid"]) && !isset($_GET["update"])){
            $id = $_GET["leerlingid"];
            $leerling = $leerlingsvc->getleerlingbyid($id);
            include("presentation/leerlingprofielpresentation.php");
        }else{
            if(isset($_GET["update"]) && $_GET["update"] == "yes" && isset($_GET["leerlingid"])){
                $id = $_GET["leerlingid"];
                $leerling = $leerlingsvc->getleerlingbyid($id);
                $old_foto_path=$leerling->getFoto();
                $_SESSION['old_foto_path']=$old_foto_path;
                include("presentation/updateleerlingpresentation.php");
            }else{
                header("location: klaslijst.php");
            }
        }
        
    }
}else{
    header("location: home.php");
}

