<?php
session_start();

require_once ("business/leerkrachtservice.php");
require_once ("business/klasservice.php");

if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "admin_level"){
    session_destroy();
}

if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "admin_level" && !isset($_GET["log"])){
        if(isset($_GET["action"]) && $_GET["action"] == "process"){
            //leerkrachtservice
            $leerkrachtsvc = new leerkrachtservice();
            $klassvc = new klasservice();
            
            //de variabels die naar db gaan
            $emailadres = $_POST["email"];         
            $voornaam = $_POST["Voornaam"];
            $familienaam = $_POST["Familienaam"];
            
            $geboortedatumold = $_POST["geboortedatum"];
            $datetime = new DateTime($geboortedatumold);
            
            
            $klas_naam = $_POST["klas"];
            
            //klas bestaand of nieuw indien nieuw toevoegen
            $klasadd = $klassvc->addKlas($klas_naam);//in klas add zit een bool of de add geslaagd is of niet
            
            //haal het klas obj op aan de hand van de gekregen naam
            $klas = $klassvc->klasByNaam($klas_naam);
            
            $klasid = $klas->getKlasid();
            
                        if(isset($_FILES["foto_leerkracht"]) && $_FILES["foto_leerkracht"]['error']!=4){
                            $target_folder="Foto_leerkracht/";
                            $target_file= $target_folder.basename($_FILES["foto_leerkracht"]["name"]);
                            $uploadSucces=1;
                            $imageFileType=  pathinfo($target_file,PATHINFO_EXTENSION);
                            $daytime= new DateTime($geboortedatumold);
                            $geboortedatum=$daytime->format('Y-m-d');
                            //echo $geboortedatum;
                            $foto_naam= $geboortedatum.$voornaam.$familienaam;
                            $target_file = $target_folder . basename($foto_naam.".".$imageFileType);//rename

                            $foto_leerkracht=$target_file;
                            //echo $foto_leerling;

                            //controle op image beschikbaar
                            $check = getimagesize($_FILES["foto_leerkracht"]["tmp_name"]);
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
                            if ($_FILES["foto_leerkracht"]["size"] > 1000000) {
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
                            $uploadSucces = 0;
                           // header("location: home.php");
                        }
                        
                        if(isset($_FILES["foto_leerkracht"])){
                            // controle of alle checks geslaagd waren
                            if ($uploadSucces == 0) {
                                $foto='Foto_leerling/defaul_foto.png';
                                //er word geen bestand upgeload
                            } else {
                                if (move_uploaded_file($_FILES["foto_leerkracht"]["tmp_name"], $target_file)) {
                                    $foto=$foto_leerkracht;
                                    //als file upgeload werd
                                } else {
                                    //als niet correct is
                                }
                            }
                        }
            $geboortedatum = $datetime->format('Y,m,d');
            $admin = false;
            
            $wachtwoord = $leerkrachtsvc->generate($emailadres);
            
            $leerkacht = $leerkrachtsvc->leerkrachttoevoegen($emailadres, $wachtwoord, $voornaam, $familienaam, $geboortedatum, $foto, $klasid, $admin);
            
            header("location: leerkrachtlijst.php");
        }else{
            include("presentation/leerkrachttoevoegenpresentation.php");
        }
}else{
    header("location: home.php");
}
