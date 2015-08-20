<?php

session_start();

require_once ("business/leerlingservice.php");
require_once ("business/leerkrachtservice.php");
require_once ("exceptions/EmailadresBestaatException.php");
require_once ("exceptions/EmailPaswoordException.php");
require_once ("business/gemeenteservice.php");
require_once ("business/klasservice.php");

$leerlingsvc = new leerlingservice();
$leerkrachtsvc = new leerkrachtservice();
$gemeentesvc = new gemeenteservice();

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level"){
    session_destroy();
}

//controle voor het level van authenticatie controle structuur
if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])) {
    $leerkacht=  unserialize($_SESSION["gebruiker"]); //
        //alle controle voor invoeging in db
        $klasid=$leerkacht->getKlasid();//haalt klasid op om toegang tot andere klassen te vermijden
    $GebruikerNaam = $leerkacht->getEmailadres();
    $klassvc = new klasservice();
    $klas = $klassvc->getklas($klasid);
    $klasnaam = $klas->getNaamklas();
        if (!isset($_GET["action"])) {
            $action = null;
        } else
            $action = $_GET["action"];
        $doorgaan = true;
        if ($action == "process") {
            if (empty($_POST["Voornaam"])) {
                $voornaamerror = "missing";
                $doorgaan = false;
            } else {
                $voornaam = strip_tags(trim($_POST["Voornaam"]));
                if (empty($voornaam)) {
                    $doorgaan = false;
                    $voornaamerror = "missing";
                }
            }
            if (empty($_POST["Familienaam"])) {
                $familienaamerror = "missing";
                $doorgaan = false;
            } else {
                $familienaam = strip_tags(trim($_POST["Familienaam"]));
                if (empty($familienaam)) {
                    $familienaamerror = "missing";
                    $doorgaan = false;
                }
            }
            if (empty($_POST["geboortedatum"])) {
                $geboortedaumerror = "missing";
                $doorgaan = false;
            } else {
                $geboortedatum = strip_tags(trim($_POST["geboortedatum"]));
                if (empty($geboortedatum)) {
                    $geboortedaumerror = "missing";
                    $doorgaan = false;
                }
            }
            if (empty($_POST["email"])) {
                $emailadreserror = "missing";
                $doorgaan = false;
            } else {
                if (preg_match("/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", $_POST["email"])) {
                    $emailadres = strip_tags(trim($_POST["email"]));
                    if (empty($emailadres)) {
                        $emailadreserror = "missing";
                        $doorgaan = false;
                    }
                } else {
                    $doorgaan = false;
                }
            }
            if ($doorgaan == true) {
                
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
                                $uploadSucces = 0;
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
                            $uploadSucces = 0;//als er geen foto is om toe te voegen
                        }
                
                $foto="";
                $straat = strip_tags(trim($_POST["straat"]));
                $huisnr = strip_tags(trim($_POST["huisnr"]));
                $bus = strip_tags(trim($_POST["bus"]));
                $postcode = strip_tags(trim($_POST["postcode"]));
                $gemeente = strip_tags(trim($_POST["gemeente"]));
                $gemeente = strtolower($gemeente);
                //gemeete toevoegen indien mogelijk
                if($postcode!=null&&$gemeente==null){
                    header("location: leerlingaanmelden.php?error=postcode");
                }elseif($gemeente!=null&&$postcode==null){
                    header("location: leerlingaanmelden.php?error=postcode");
                }else{
                    $gemeentesvc->addGemeente($postcode,$gemeente);
                }
                //postcode id zoeken
                $gemeenteObj= $gemeentesvc->getGemeente($postcode,$gemeente);
                $postcode_id= $gemeenteObj->getGemeente_id();
                $telefoonnr = strip_tags(trim($_POST["telefoonnr"]));
                $voornaamouder1 = strip_tags(trim($_POST["voornaamouder1"]));
                $voornaamouder2 = strip_tags(trim($_POST["voornaamouder2"]));
                $familienaamouder1 = strip_tags(trim($_POST["familienaamouder1"]));
                $familienaamouder2 = strip_tags(trim($_POST["familienaamouder2"]));
                $GSMouder1 = strip_tags(trim($_POST["GSMouder1"]));
                $GSMouder2 = strip_tags(trim($_POST["GSMouder2"]));
                
                        if(isset($_FILES["foto_leerling"])){
                            // controle of alle checks geslaagd waren
                            if ($uploadSucces == 0) {
                                $foto='Foto_leerling/defaul_foto.png';
                                //er word geen bestand upgeload
                            } else {
                                if (move_uploaded_file($_FILES["foto_leerling"]["tmp_name"], $target_file)) {
                                    $foto=$foto_leerling;
                                    //als file upgeload werd
                                } else {
                                    //als niet correct is
                                }
                            }
                        }
                        
                
                try {
                    $datetime = new DateTime($geboortedatum);
                    $leerlingsvc->voegNieuwLeerlingToe($voornaam, $familienaam
                            , $datetime->format('Y,m,d'),$foto, $straat, $huisnr
                            , $bus, $postcode_id, $telefoonnr, $leerkacht->getKlasid(), $voornaamouder1    //klasid van het leerkracht object die via sesie doorgegeven wordt
                            , $familienaamouder1, $voornaamouder2, $familienaamouder2
                            , $GSMouder1, $GSMouder2, $emailadres);
                    //echo '',$voornaam,'&nbsp',$familienaam,'&nbsp',$geboortedatum,'&nbsp',$straat,'&nbsp','<br/>',$huisnr,'&nbsp',$bus,'&nbsp',$postcode;
                    if($postcode!=null&&$gemeente==null){
                        header("location: leerlingaanmelden.php?error=postcode");
                    }elseif($gemeente!=null&&$postcode==null){
                        header("location: leerlingaanmelden.php?error=postcode");
                    }else{
                        header("location:klaslijst.php");
                    }
                    exit(0);
                } catch (EmailadresBestaatException $ebe) {
                    header("location:leerlingaanmelden.php?error=emailexists");
                    exit(0);
                } catch (EmailPaswoordException $e) {
                  header("location: leerlingaanmelden.php?".$e->getMessage());
                  exit(0);
                 }
                 
            } else {
                header("location:aanmelden.php?error=fouteinvoer");
                exit(0);
            }
        } else {
            if (!isset($_GET["error"])) {
                $error = null;
            } else
                $error = $_GET["error"];
            include("presentation/leerlingtoevoegenpresentation.php");
        }
}else {
    header("location: home.php");
}