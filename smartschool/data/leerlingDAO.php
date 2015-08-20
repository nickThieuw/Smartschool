<?php

require_once("data/DBconfig.php");
require_once("entities/leerling.php");
require_once("PHPMailerAutoload.php");
require_once("exceptions/EmailPaswoordException.php");
$bestaandleerling = null;

class leerlingDAO {

    public function getById($id) {
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "select leerlingid, voornaam, familienaam, geboortedatum, foto, straat, huisnr,bus,postcodeid, telefoonnr
    , klasid, voornaamouder1, familienaamouder1, voornaamouder2, familienaamouder2, GSMouder1
    , GSMouder2, emailadres, wachtwoord from leerling where leerlingid ='$id'";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $leerling = leerling::create($rij["leerlingid"], $rij["voornaam"], $rij["familienaam"], $rij["geboortedatum"], $rij["foto"]
                        , $rij["straat"], $rij["huisnr"], $rij["bus"], $rij["postcodeid"], $rij["telefoonnr"], $rij["klasid"]
                        , $rij["voornaamouder1"], $rij["familienaamouder1"], $rij["voornaamouder2"], $rij["familienaamouder2"]
                        , $rij["GSMouder1"], $rij["GSMouder2"], $rij["emailadres"], $rij["wachtwoord"]);
        $dbh = null;
        return $leerling;
    }

    public function getByKlasId($klasid) {
        $klaslijst = array();
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "select leerlingid, voornaam, familienaam, geboortedatum, foto, straat, huisnr,bus,postcodeid, telefoonnr
    , klasid, voornaamouder1, familienaamouder1, voornaamouder2, familienaamouder2, GSMouder1
    , GSMouder2, emailadres, wachtwoord from leerling where klasid ='$klasid'";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $leerling = leerling::create($rij["leerlingid"], $rij["voornaam"], $rij["familienaam"], $rij["geboortedatum"], $rij["foto"]
                            , $rij["straat"], $rij["huisnr"], $rij["bus"], $rij["postcodeid"], $rij["telefoonnr"], $rij["klasid"]
                            , $rij["voornaamouder1"], $rij["voornaamouder2"], $rij["familienaamouder1"], $rij["familienaamouder2"]
                            , $rij["GSMouder1"], $rij["GSMouder2"], $rij["emailadres"], $rij["wachtwoord"]);
            array_push($klaslijst, $leerling);
        }
        $dbh = null;
        return $klaslijst;
    }

    //deze functie dient om de inlog te zien.
    public function getByGebruiker($emailadres, $wachtwoord) {
        $sql = "select leerlingid, voornaam, familienaam, geboortedatum, foto, straat, huisnr,bus,postcodeid, telefoonnr
        , klasid, voornaamouder1, familienaamouder1, voornaamouder2, familienaamouder2, GSMouder1
        , GSMouder2, emailadres, wachtwoord from leerling where emailadres ='" . $emailadres . "' and wachtwoord ='" . $wachtwoord . "' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $leerling = leerling::create($rij["leerlingid"], $rij["voornaam"], $rij["familienaam"], $rij["geboortedatum"], $rij["foto"]
                        , $rij["straat"], $rij["huisnr"], $rij["bus"], $rij["postcodeid"], $rij["telefoonnr"], $rij["klasid"]
                        , $rij["voornaamouder1"], $rij["voornaamouder2"], $rij["familienaamouder1"], $rij["familienaamouder2"]
                        , $rij["GSMouder1"], $rij["GSMouder2"], $rij["emailadres"], $rij["wachtwoord"]);
        $dbh = null;
        if ($leerling->getLeerlingid() == 0) {
            return false;
        } else {
            return $leerling;
        }
    }
    
    public function kontroleerEmail($emailadres, $voornaam, $familienaam) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select leerlingid, voornaam, familienaam, geboortedatum, foto, straat, huisnr,bus,postcodeid, telefoonnr
    , klasid, voornaamouder1, familienaamouder1, voornaamouder2, familienaamouder2, GSMouder1
    , GSMouder2, emailadres, wachtwoord from leerling where emailadres ='$emailadres' and voornaam ='$voornaam' and familienaam ='$familienaam'";
        
        $result = $dbh->prepare($sql);
        $result->execute();
        $check = $result->rowCount();
        $dbh=null;
        if($check!=0){
        return false;
        }else{
        return true;
        }
        
    }
    
    public function getByemailadresNaam($emailadres, $voornaam, $familienaam) {
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select leerlingid, voornaam, familienaam, geboortedatum, foto, straat, huisnr,bus,postcodeid, telefoonnr
    , klasid, voornaamouder1, familienaamouder1, voornaamouder2, familienaamouder2, GSMouder1
    , GSMouder2, emailadres, wachtwoord from leerling where emailadres ='$emailadres' and voornaam ='$voornaam' and familienaam ='$familienaam'limit 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $dbh->exec($sql);
        $dbh = null;
        $gebruiker = leerling::create($rij["leerlingid"], $rij["voornaam"], $rij["familienaam"], $rij["geboortedatum"], $rij["foto"]
                        , $rij["straat"], $rij["huisnr"], $rij["bus"], $rij["postcodeid"], $rij["telefoonnr"], $rij["klasid"]
                        , $rij["voornaamouder1"], $rij["voornaamouder2"], $rij["familienaamouder1"], $rij["familienaamouder2"]
                        , $rij["GSMouder1"], $rij["GSMouder2"], $emailadres, $rij["wachtwoord"]);
        return $gebruiker;
    }

    public function create($voornaam, $familienaam, $geboortedatum, $foto, $straat, $huisnr, $bus, $postcodeID, $telefoonnr
    , $klasid, $voornaamouder1, $familienaamouder1, $voornaamouder2, $familienaamouder2, $GSMouder1
    , $GSMouder2, $emailadres, $wachtwoord) {
        
            $sql = "insert into leerling (voornaam, familienaam, geboortedatum, foto, straat, huisnr,bus,postcodeID, telefoonnr
    , klasid, voornaamouder1, familienaamouder1, voornaamouder2, familienaamouder2, GSMouder1
    , GSMouder2, emailadres, wachtwoord)
                values ('" . $voornaam . "', '" . $familienaam . "','" . $geboortedatum . "','".$foto."','" . $straat . "','"
                    . $huisnr . "','" . $bus . "','" . $postcodeID . "','" . $telefoonnr . "','" . $klasid . "','"
                    . $voornaamouder1 . "', '" . $familienaamouder1 . "', '" . $voornaamouder2 . "', '" . $familienaamouder2 . "', '"
                    . $GSMouder1 . "', '" . $GSMouder2 . "', '" . $emailadres . "', '" . $wachtwoord . "')";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $test = $dbh->exec($sql);
            $leerlingid = $dbh->lastInsertId();
            print_r($sql);
            $dbh = null;
            $leerling = leerling::create($leerlingid, $voornaam, $familienaam, $geboortedatum, $foto, $straat, $huisnr, $bus
                            , $postcodeID, $telefoonnr, $klasid, $voornaamouder1, $familienaamouder1, $voornaamouder2, $familienaamouder2
                            , $GSMouder1, $GSMouder2, $emailadres, $wachtwoord);
            return $leerling;
        
    }

    public function randomPassword($emailadres) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $password = implode($pass);
            ///////////////////////MAILGUN
            $mail = new PHPMailer;
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'postmaster@sandbox86ff17174d5a4d96943b0d40a5dd36e2.mailgun.org';   // SMTP username
            $mail->Password = 'db8bb1afdc4d869b436f64a44be5e2ce';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted
            $mail->From = 'smartschool@vdab.be';
            $mail->FromName = 'smartschool';
            $mail->addAddress($emailadres);                 // Add a recipient
            $mail->WordWrap = 120;                                 // Set word wrap to 120 characters
            $mail->Subject = 'Inloggevens';
            $mail->Body    = 'uw wachtwoord voor smartschool is: ' . $password;
            if(!$mail->send()) {
                throw new EmailPaswoordException('Mailer Error: ' . $mail->ErrorInfo);
            } else {              
                 return sha1($password);
            }
    }

    public function delete($id) {
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "delete from leerling where leerlingid = " . $id;
        $dbh->exec($sql);
        $dbh = null;
    }

    public function update($leerling) {
        $id = $leerling->getLeerlingid();
        $sql = "update leerling set voornaam='" . $leerling->getVoornaam() . "', familienaam='" . $leerling->getFamilienaam() . "', geboortedatum='" . $leerling->getGeboortedatum() . "', foto='" . $leerling->getFoto() . "', straat='" . $leerling->getStraat() . "'
        , huisnr='" . $leerling->getHuisnr() . "', bus='" . $leerling->getBus() . "',postcodeID='" . $leerling->getPostcode() . "', telefoonnr='" . $leerling->getTelefoonnr() . "'
        , klasid='" . $leerling->getKlasid() . "', voornaamouder1='" . $leerling->getVoornaamouder1() . "', familienaamouder1='" . $leerling->getFamilienaamouder1() . "', voornaamouder2='" . $leerling->getVoornaamouder2() . "', familienaamouder2='" . $leerling->getFamilienaamouder2() . "', GSMouder1='" . $leerling->getGSMouder1() . "'
        , GSMouder2='" . $leerling->getGSMouder2() . "', emailadres='" . $leerling->getEmailadres() . "' where leerlingid = " . $id;
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
    
    public function overgangLeerling($leerlingid,$oudklasid,$nieuwklasid){
        $sql = "insert into overgang (leerlingid,oudklasid,nieuwklasid) values('".$leerlingid."','".$oudklasid."','".$nieuwklasid."')";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING,  DBconfig::$DB_USERNAME,  DBconfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
    
    public function overgaande($oudklasid){
        $overgaande=array();
        $sql = "select leerlingid,oudklasid,nieuwklasid from overgang where oudklasid='".$oudklasid."' ";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $record = 0;
        foreach ($resultset as $rij){
            
            $overgaande[$record][0]= $rij['leerlingid'];
            $overgaande[$record][1]= $rij['oudklasid'];
            $overgaande[$record][2]= $rij['nieuwklasid'];
            $record = $record+1;
        }
        return $overgaande;
        
        $dbh = null;
    }
    
    public function overganguniek($leerlingid){
        $uniek=true;
        $sql ="select * from overgang where leerlingid='".$leerlingid."' ";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $leerlingiduniek=$rij['nieuwklasid'];
        if($leerlingiduniek>0){
            $uniek=false;
        }else{
            $uniek=true;
        }
        return $uniek;
        $dbh = null;
    }
    
    public function removeovergang($leerlingid){
        $sql = "delete from overgang where leerlingid='".$leerlingid."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        
        $dbh->exec($sql);
        
        $dbh = null;
    }
    
    public function getallovergangactions(){
        $lijst=array();
        $sql = "select DISTINCT oudklasid from overgang ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $record=0;
        foreach ($resultset as $rij){
            $lijst[$record]= $rij['oudklasid'];
            $record=$record+1;
        }
        return $lijst;
    }
    
    public function updateovergang($leerlingid,$oudklasid,$nieuwklasid){
        $sql = "update overgang set nieuwklasid='".$nieuwklasid."' where leerlingid='".$leerlingid."' and oudklasid='".$oudklasid."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
    
    public function getklastot($klasid){
        $sql = "select count(DISTINCT leerlingid) AS number from leerling where klasid='".$klasid."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset=$dbh->query($sql);
        $rij = $resultset->fetch();
        $total = $rij["number"];
        return $total;
    }
    
    public function gettotalovergangklas($oudklasid){
        $sql = "select count(DISTINCT leerlingid) AS aantal from overgang where oudklasid='".$oudklasid."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset=$dbh->query($sql);
        $rij = $resultset->fetch();
        $total = $rij["aantal"]; 
        return $total;
    }
    public function getnieuwklasid($oudklasid){
        $sql = "select DISTINCT nieuwklasid AS nieuwid from overgang where oudklasid ='".$oudklasid."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset=$dbh->query($sql);
        $rij = $resultset->fetch();
        $nieuwklasid = $rij["nieuwid"];
        return $nieuwklasid;
    }

    
    public function gettotleerlingen(){
        $sql = "select count(DISTINCT leerlingid) AS number from leerling";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset=$dbh->query($sql);
        $rij = $resultset->fetch();
        $total = $rij["number"];
        return $total;
    }
    
    public function changeklasidbyleerlingid($leerlingid,$nieuwklasid){
        $sql = "update leerling set klasid = '".$nieuwklasid."' where leerlingid = '".$leerlingid."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}
