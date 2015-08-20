<?php
require_once 'data/leerkrachtDAO.php';

class leerkrachtservice{
    public function leerkrachttoevoegen($emailadres,$wachtwoord,$voornaam,$familienaam,$geboortedatum,$foto,$klasid,$admin){
        $leerkrachtDAO = new leerkrachtDAO();
        $leerkrachtDAO->addLeeracht($emailadres, $wachtwoord, $voornaam, $familienaam, $geboortedatum, $foto, $klasid, $admin);
    }
    
    public function logincheck($emailadres,$wachtwoord){
        $leerkrachtDAO = new leerkrachtDAO();
        $fetchedleerkracht = $leerkrachtDAO->getByGebruiker($emailadres, $wachtwoord);
        $fetchedemail = NULL;
        if($fetchedleerkracht!=false){
        $fetchedemail = $fetchedleerkracht->getEmailadres();
        }
        if($emailadres == $fetchedemail){
            $leerkrachtLogin = $fetchedleerkracht;
        }else{
            $leerkrachtLogin = null;
        }
        return $leerkrachtLogin;
    }
    
    public function generate($emailadres){
        $leerkrachtDAO = new leerkrachtDAO();
        $wachtwoord = $leerkrachtDAO->randomPassword($emailadres);
        
        return $wachtwoord;
    }
    
    public function leerkrachtlijst(){
        $leerkrachtDAO = new leerkrachtDAO();
        $lijst = $leerkrachtDAO->leerkrachtlijst();
        return $lijst;
    }
    
    public function getByid($leerkrachtid){
        $leerkrachtDAO = new leerkrachtDAO();
        $leerkracht = $leerkrachtDAO->getByid($leerkrachtid);
        return $leerkracht;
    }
    
    public function updateLeerkracht($leerkrachtid,$email,$voornaam,$familienaam,$geboortedatum,$foto,$klasid){
        $leerkrachtDAO = new leerkrachtDAO();
        $leerkrachtDAO->updateLeerkracht($leerkrachtid,$email,$voornaam,$familienaam,$geboortedatum,$foto,$klasid);
    }
    
    public function getallleerkrachtklasid(){
        $leerkrachtDAO = new leerkrachtDAO();
        $lijst = $leerkrachtDAO->getallleerkrachtklasid();
        return $lijst;
    }
    public function getLeerkracht($klasid){
        $leerkrachtDAO = new leerkrachtDAO();
        return $leerkrachtDAO->getLeerkracht($klasid);
    }
    
    public function DbtransferArchive($level){
        $leerkrachtDAO = new leerkrachtDAO();
        $dbNameTake = "smartschool";
        $dateyear = new DateTime();
        $year = $dateyear->format("Y");
        $dbNameGet = "Archivesmartschool".$year;
        $sqlFile = "sql/sql".$year.".sql";
        $test = $leerkrachtDAO->DbtransferArchive($level,$dbNameTake,$dbNameGet,$sqlFile);
        return $test;
    }
    
    public function validationadd($leerkrachtid,$code,$email,$datum){
        $leerkrachtDAO = new leerkrachtDAO();
        $leerkrachtDAO->validationadd($leerkrachtid, $code, $email, $datum, false, false);
    }
    
    public function validationcontrolsend($leerkrachtid){                   //
        $leerkrachtDAO = new leerkrachtDAO();
        $leerkracht = $leerkrachtDAO->getByid($leerkrachtid);
        $email = $leerkracht->getEmailadres();
        $code = $leerkrachtDAO->codegenerator($email);
        $tempdatum = new DateTime();
        $datum = $tempdatum->format('Y-m-d H:i:s');
        $this->validationadd($leerkrachtid, $code, $email, $datum);
    }
    
    public function getadmin(){
        $leerkrachtDAO = new leerkrachtDAO();
        $admin = $leerkrachtDAO->getadmin();
        return $admin;
    }
    
    public function validationcheckAdmin($leerkrachtid,$code){
        $leerkrachtDAO = new leerkrachtDAO();
        $result = $leerkrachtDAO->validationcheckAdmin($leerkrachtid, $code);
        return $result;
    }
    
    public function validationantispam($gebruikerid){
        $leerkrachtDAO = new leerkrachtDAO();
        $leerkrachtDAO->validationantispam($gebruikerid);
    }
    
    public function removeovergangen(){
        $leerkrachtDAO = new leerkrachtDAO();
        $leerkrachtDAO->removeovergangen();
    }
}
