<?php
session_start();
require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/klasservice.php");


if(isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "admin_level"){
    session_destroy();
}
if(isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "admin_level" && !isset($_GET["log"]) && isset($_GET['leerkrachtupid'])){
    //admin leerkract gegevens
    $leerkacht=  unserialize($_SESSION["gebruiker"]);
    $leerkrachtsvc = new leerkrachtservice();
    //admin
    //up te daten leerkracht id
    $leerkachtupid=$_GET['leerkrachtupid'];
    $leerkachtup=$leerkrachtsvc->getByid($leerkachtupid);
    $old_foto_path=$leerkachtup->getFoto();
    $_SESSION['old_foto_path']=$old_foto_path;
    
    $klassvc = new klasservice();
    $klasid=$leerkachtup->getKlasid();
    $klas=$klassvc->getklas($klasid);
    $klasnaam=$klas->getNaamklas();
    
    $foto="";
    
    if(isset($_GET["action"]) && $_GET["action"] == "process"){
        //$leerkachtup =
        $updateEmail=$_POST['email'];
        $updateVoornaam=$_POST['Voornaam'];
        $updateFamilienaam=$_POST['Familienaam'];
        $updateGeboortedatum=$_POST['geboortedatum'];
        $updateKlas=$_POST['klas'];
        $datetime= new DateTime($updateGeboortedatum);
        
                        if(isset($_FILES["foto_leerkracht"]) && $_FILES["foto_leerkracht"]['error']!=4){
                            $target_folder="Foto_leerkracht/";
                            $target_file= $target_folder.basename($_FILES["foto_leerkracht"]["name"]);
                            $uploadSucces=1;
                            $imageFileType=  pathinfo($target_file,PATHINFO_EXTENSION);
                            $daytime= new DateTime($updateGeboortedatum);
                            $updateGeboortedatum=$daytime->format('Y-m-d');
                            //echo $geboortedatum;
                            $foto_naam= $updateGeboortedatum.$updateVoornaam.$updateFamilienaam;
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
                                $exists_foto = 0;
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
                            $foto=$old_foto_path;
                            $uploadSucces = 0;
                            // header("location: home.php");
                        }
                        
                        if(isset($_FILES["foto_leerkracht"]) && $_FILES["foto_leerkracht"]['error']!=4){
                            // controle of alle checks geslaagd waren
                            if ($uploadSucces == 0) {
                                //er word geen bestand upgeload
                            } else {
                                if($old_foto_path!="Foto_leerling/defaul_foto.png"){
                                    unlink($old_foto_path);
                                }
                                if (move_uploaded_file($_FILES["foto_leerkracht"]["tmp_name"], $target_file)) {
                                    $foto=$foto_leerkracht;
                                    //als file upgeload werd
                                } else {
                                    //als niet correct is
                                }
                            }
                        }
        $updateGeboortedatum = $datetime->format('Y,m,d');
                        
        $new=$klassvc->addKlas($updateKlas);//$new is bool of klas nieuw is of niet
        
        $klasup= $klassvc->klasByNaam($updateKlas);
        $newKlasId= $klasup->getKlasid();
        
        $leerkrachtsvc->updateLeerkracht($leerkachtupid, $updateEmail, $updateVoornaam, $updateFamilienaam, $updateGeboortedatum, $foto, $newKlasId);
        header ("location: leerkrachtlijst.php");
    }
    include("presentation/updateleerkrachtpresentation.php"); 
}else{
    header("location: home.php");
}
