<?php

require_once ("data/leerlingDAO.php");
require_once ("exceptions/EmailadresBestaatException.php");

class leerlingservice {
    public function voegNieuwLeerlingToe($voornaam, $familienaam, $geboortedatum, $foto, $straat, $huisnr,$bus,$postcode, $telefoonnr
    , $klasid, $voornaamouder1, $familienaamouder1, $voornaamouder2, $familienaamouder2, $GSMouder1
    , $GSMouder2, $emailadres){
        $leerlingDao= new leerlingDAO();
        if($leerlingDao->kontroleerEmail($emailadres, $voornaam, $familienaam))
        {
        $wachtwoord= $leerlingDao->randomPassword($emailadres);
        //$wachtwoord = sha1('123'); //mocht je de email willen omzeilen
        $leerlingDao->create($voornaam, $familienaam, $geboortedatum, $foto, $straat, $huisnr, $bus, $postcode, $telefoonnr, $klasid, $voornaamouder1, $familienaamouder1, $voornaamouder2, $familienaamouder2, $GSMouder1, $GSMouder2, $emailadres, $wachtwoord);
        }else{
            throw new EmailadresBestaatException();
        }
        
        }
    
    public function klasLijst($klasId){
        $leerlingDAO= new leerlingDAO();
        $klaslijst= $leerlingDAO->getByKlasId($klasId);
        return $klaslijst;
    }
    
    public function getleerlingbyid($id){
        $leerlingDAO = new leerlingDAO();
        $leerling = $leerlingDAO->getById($id);
        return $leerling;
    }

    public function logincheck($emailadres,$wachtwoord){
        $leerlingDAO = new leerlingDAO();
        $fetchedleerling = $leerlingDAO->getByGebruiker($emailadres, $wachtwoord);
        $fetchedemail = NULL;
        if($fetchedleerling!=false){
        $fetchedemail = $fetchedleerling->getEmailadres();
        }
        if($emailadres == $fetchedemail){
            $leerlingLogin = $fetchedleerling;
        }else{
            $leerlingLogin = null;
        }
        return $leerlingLogin;
    }
    
    public function deleteleerling($id){
        $leerlingDAO = new leerlingDAO();
        $leerlingDAO->delete($id);
    }

    public function verwijderGebruiker($id) {
        $GebruikerDAO = new gebruikerDAO();
        $gebruikerDAO->delete($id);
    }

    public function haalGebruikerOpId($id) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker = $gebruikerDAO->getById($id);
        return $gebruiker;
    }
    
    public function haalGebruikerOpemailadres($emailadres) {
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker = $gebruikerDAO->getByemailadres($emailadres);
        return $gebruiker;
    }
    
    public function updateLeerling($leerlingid,$voornaam,$familienaam,$geboortedatum,$foto,$straat,$huisnr,$bus,$postcode,$telefoonnr
    , $klasid, $voornaamouder1, $familienaamouder1, $voornaamouder2, $familienaamouder2, $GSMouder1
    , $GSMouder2, $emailadres){
        $leerlingDAO = new leerlingDAO();
        $leerling = self::getleerlingbyid($leerlingid);
        $leerling->setVoornaam($voornaam);
        $leerling->setFamilienaam($familienaam);
        $leerling->setGeboortedatum($geboortedatum);
        $leerling->setFoto($foto);
        $leerling->setStraat($straat);
        $leerling->setHuisnr($huisnr);
        $leerling->setBus($bus);
        $leerling->setPostcode($postcode);
        $leerling->setTelefoonnr($telefoonnr);
        $leerling->setKlasid($klasid);
        $leerling->setVoornaamouder1($voornaamouder1);
        $leerling->setFamilienaamouder1($familienaamouder1);
        $leerling->setVoornaamouder2($voornaamouder2);
        $leerling->setFamilienaamouder2($familienaamouder2);
        $leerling->setGSMouder1($GSMouder1);
        $leerling->setGSMouder2($GSMouder2);
        $leerling->setEmailadres($emailadres);
        $leerlingDAO->update($leerling);
    }
    
    /*public function updateWachtwoord($emailadres,$pass1){
        $gebruikerDAO = new gebruikerDAO();
        $gebruiker1 = self::haalGebruikerOpemailadres($emailadres);
        $gebruiker1->setWachtwoord($pass1);
        $gebruikerDAO->update($gebruiker1);
    }*/
    
    public function logout(){
        session_start();
        unset($_SESSION['gebruikerid']);
        unset($_SESSION['emailadres']);
        unset($_SESSION['wachtwoord']);
        session_destroy();
    }
    
    public function overgangLeerling($leerlingid,$nieuwklasid){
        //first test
        $leerlingDAO = new leerlingDAO();
        $leerling = $leerlingDAO->getById($leerlingid);
        
        // needed information
        $oudklasid = $leerling->getKlasid();
        
        $uniekovergang=$leerlingDAO->overganguniek($leerlingid);
        if($uniekovergang){
            $leerlingDAO->overgangLeerling($leerlingid, $oudklasid, $nieuwklasid);
        }else{
            $leerlingDAO->updateovergang($leerlingid, $oudklasid, $nieuwklasid);
        }
    }
    
    public function overgaande($oudklasid){
        $leerlingDAO=new leerlingDAO();
        $overgaande=$leerlingDAO->overgaande($oudklasid);
        return $overgaande;
    }
    
    public function removeovergang($leerlingid){
        $leerlingDAO = new leerlingDAO();
        $leerlingDAO->removeovergang($leerlingid);
    }
    
    public function getallovergangactions(){
        $leerlingDAO = new leerlingDAO();
        $volbracht=$leerlingDAO->getallovergangactions();
        return $volbracht;
    }
    
    public function getklastot($klasid){
        $leerlingDAO = new leerlingDAO();
        $total = $leerlingDAO->getklastot($klasid);
        return $total;
    }
    
    public function gettotleerlingen(){
        $leerlingDAO = new leerlingDAO();
        $total = $leerlingDAO->gettotleerlingen();
        return $total;
    }
    
    public function gettotalovergangklas($oudklasid){
        $leerlingDAO = new leerlingDAO();
        $total = $leerlingDAO->gettotalovergangklas($oudklasid);
        return $total;
    }
    
    public function getnieuwklasid($oudklasid){
        $leerlingDAO = new leerlingDAO();
        $nieuwklasid = $leerlingDAO->getnieuwklasid($oudklasid);
        return $nieuwklasid;
    }
    
    public function overgangVoltooien($klassenlijst){
        $leerlingDAO = new leerlingDAO();
        foreach ($klassenlijst as $klas){
            $klasid = $klas->getKlasid();
            $Klasoverganglijst= $this->overgaande($klasid);
            if($Klasoverganglijst != null){
                $size = count($Klasoverganglijst);
                for($x=0; $x<$size; $x++){
                    $fetchedllid = $Klasoverganglijst [$x][0];      //$fetchedllid = leerlingid uit overgang db
                    $fetchednkid = $Klasoverganglijst [$x][2];      //$fetchednkid = nieuw  klasid uit overgang db
                    $this->changeklasidbyleerlingid($fetchedllid,$fetchednkid);
                }
            }
        }
        
    }
    
    //functie die gebruikt word voor de overgang uit te voeren
    public function changeklasidbyleerlingid($leerlingid,$nieuwklasid){
        $leerlingDAO = new leerlingDAO();
        $leerlingDAO->changeklasidbyleerlingid($leerlingid, $nieuwklasid);
    }
    
}