<?php
require_once 'entities/leerkracht.php';
require_once("PHPMailerAutoload.php");
require_once 'DBconfig.php';

class leerkrachtDAO{
    public function addLeeracht($emailadres,$wachtwoord,$voornaam,$familienaam,$geboortedatum,$foto,$klasid,$admin){
        $sql = "insert into leerkracht(emailadres,wachtwoord,voornaam,familienaam,geboortedatum,foto,klasid,admin)
        values ('".$emailadres."','".$wachtwoord."','".$voornaam."','".$familienaam."','".$geboortedatum."','".$foto."',
        '".$klasid."','".$admin."')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $leerkracht = $dbh->exec($sql);
        $leerkrachtid = $dbh->lastInsertId();
        $dbh = null;
    }
    
    public function getByEmailadres($emailadres){
        $sql = "select leerkrachtid,emailadres,wachtwoord,voornaam,familienaam,geboortedatum,foto,klasid,admin from leerkracht where emailadres ='".$emailadres."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $leerkracht = leerkracht::create($rij["leerkrachtid"],$rij["emailadres"],$rij["wachtwoord"],$rij["voornaam"],$rij["familienaam"],$rij["geboortedatum"],$rij["foto"],$rij["klasid"],$rij["admin"]);
        $dbh = null;
        return $leerkracht;
    }
    
    public function getByid($leerkrachtid){
        $sql="select leerkrachtid,emailadres,wachtwoord,voornaam,familienaam,geboortedatum,foto,klasid,admin from leerkracht where leerkrachtid =".$leerkrachtid;
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $leerkracht = leerkracht::create($rij["leerkrachtid"],$rij["emailadres"],$rij["wachtwoord"],$rij["voornaam"],$rij["familienaam"],$rij["geboortedatum"],$rij["foto"],$rij["klasid"],$rij["admin"]);
        $dbh = null;
        return $leerkracht;
    }

    public function  leerkrachtlijst(){
        $lijst = array();
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select leerkrachtid,emailadres,wachtwoord,voornaam,familienaam,geboortedatum,foto,klasid,admin from leerkracht where admin=false";
        $resultset = $dbh->query($sql);
        foreach ($resultset as $rij){
            $leerkracht = leerkracht::create($rij["leerkrachtid"],$rij["emailadres"],$rij["wachtwoord"],$rij["voornaam"],$rij["familienaam"],$rij["geboortedatum"],$rij["foto"],$rij["klasid"],$rij["admin"]);
            array_push($lijst, $leerkracht);
        }
        $dbh = null;
        return $lijst;
    }

    public function getByGebruiker($emailadres,$wachtwoord){
        $sql = "select leerkrachtid,emailadres,wachtwoord,voornaam,familienaam,geboortedatum,foto,klasid,admin from leerkracht where emailadres ='$emailadres' and wachtwoord='$wachtwoord' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $leerkracht = leerkracht::create($rij["leerkrachtid"],$rij["emailadres"],$rij["wachtwoord"],$rij["voornaam"],$rij["familienaam"],$rij["geboortedatum"],$rij["foto"],$rij["klasid"],$rij["admin"]);
        $dbh = null;
        if($leerkracht->getLeerkrachtid()==0){
            return false;
        }else{
            return $leerkracht;
        } 
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
    
    public function codegenerator($admin) {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $code = implode($pass);
                
//        ///////////////////////MAILGUN
//            $mail = new PHPMailer;
//            $mail->isSMTP();                                      // Set mailer to use SMTP
//            $mail->Host = 'smtp.mailgun.org';                     // Specify main and backup SMTP servers
//            $mail->SMTPAuth = true;                               // Enable SMTP authentication
//            $mail->Username = 'postmaster@sandbox86ff17174d5a4d96943b0d40a5dd36e2.mailgun.org';   // SMTP username
//            $mail->Password = 'db8bb1afdc4d869b436f64a44be5e2ce';                           // SMTP password
//            $mail->SMTPSecure = 'tls';                            // Enable encryption, only 'tls' is accepted
//            $mail->From = 'smartschool@vdab.be';
//            $mail->FromName = 'smartschool';
//            $mail->addAddress($admin);                 // Add a recipient
//            $mail->WordWrap = 250;                                 // Set word wrap to 120 characters
//            $mail->Subject = 'code';
//            $mail->Body    = 'uw validatie code voor smartschool overgang is: ' . $code;
//            if(!$mail->send()) {
//                throw new EmailPaswoordException('Mailer Error: ' . $mail->ErrorInfo);
//            } else {              
//                 return sha1($code);
//            }
            return sha1($code);
    }
    
    public function updateLeerkracht($leerkrachtid,$email,$voornaam,$familienaam,$geboortedatum,$foto,$klasid){
        $sql="update leerkracht set emailadres='".$email."',voornaam='".$voornaam."',familienaam='".$familienaam."',geboortedatum='".$geboortedatum."',foto='".$foto."',klasid='".$klasid."' where leerkrachtid=".$leerkrachtid;
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
    
    public function getallleerkrachtklasid(){
        $lijst=array();
        $sql="select DISTINCT klasid from leerkracht";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $record=0;
        foreach ($resultset as $rij){
            $lijst[$record]= $rij['klasid'];
            $record=$record+1;
        }
        return $lijst;
    }
    
    public function DbtransferArchive($level,$dbNameTake,$dbNameGet,$sqlFile){
        //functie om db te clonen naar een andere db.
        exec('C:\xampp\mysql\bin\mysqldump --user=root --host=localhost "'.$dbNameTake.'" > "'.$sqlFile.'" ');
        $this->createarchivedb($dbNameGet);
        exec('C:\xampp\mysql\bin\mysql --user=root --host=localhost "'.$dbNameGet.'" < "'.$sqlFile.'" ');
    }
    
    public function createarchivedb($name){
        $sql = "CREATE DATABASE ".$name;
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);
        $dbh->exec($sql);
        $dbh = null;
    }


    public function getLeerkracht($klasid){
        $lijst = array();
         $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
         $sql = "select leerkrachtid,emailadres,wachtwoord,voornaam,familienaam,geboortedatum,foto,klasid,admin from leerkracht where klasid='".$klasid."'";
         $resultset = $dbh->query($sql);
         foreach ($resultset as $rij){
             $leerkracht = leerkracht::create($rij["leerkrachtid"],$rij["emailadres"],$rij["wachtwoord"],$rij["voornaam"],$rij["familienaam"],$rij["geboortedatum"],$rij["foto"],$rij["klasid"],$rij["admin"]);
             array_push($lijst, $leerkracht);
         }
         $dbh = null;
         return $lijst;

    }
   //deze functie voegt record toe aan db als er niet binnen de voorgaande 20 min eentje werd toegevoegd
    public function validationadd($leerkrachtid,$code,$email,$datum , $status,$disabled){
        $gebruiker = true;//gebruiker true beteken dat het voor een leerkracht is
        $sql = "insert into validation(gebruiker,gebruikerid,code,email,datum,status,disabled) values('".$gebruiker."','".$leerkrachtid."','".$code."','".$email."','".$datum."','".$status."','".$disabled."')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $antispam = $this->validationantispam($leerkrachtid);
        if($antispam == true){
            $dbh->exec($sql); // laad het sql insert uitvoeren voor de admins
        }
        $dbh = null;
    }
    //in onderstaande functie word gezocht naar record waar leerkrachtid en sha1code klopen
    //verder roept deze functie andere twee functies op de de status als disable uitvoeren
    public function validationcheckAdmin($leerkrachtid,$code){
        $gebruiker = $this->getByid($leerkrachtid);
        if($gebruiker->getAdmin() == true){
            $sql = "select * from validation where gebruikerid='".$leerkrachtid."' AND code='".$code."' ";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $resultset = $dbh->query($sql);
            $rij = $resultset->fetch();
            if(isset($rij) && $rij != null){
                $validationid = $rij['validationid'];
                $validationdate = $rij['datum'];
                $this->updatevalidationstatus($validationid, $validationdate);
                $result = 'succes'; 
            }else{
                $result = 'incorrect';//error moest er geen record gevonden worden
            }
        }else{
            $result = 'noadmin';//error die zou doorkome moest gebruiker geen admin zijn
        }
        return $result;
    }
    //in onderstaande functie wordt de status upgedate van wie deze werd gebruikt
    //alsook word de disable voor gezamelijke groep
    public function updatevalidationstatus($validationid,$validationdate){
        $sql = "update validation set status = true where validationid = '".$validationid."' AND disabled = false";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
        if($this->countadmins()>=1){
            $this->disablevalidationadminupdate($validationdate);
        }
    }
    //onderstaande functie past de disable toe wanneer een van de admins voltooien klikte
    public function disablevalidationadminupdate($validationdate){
        $datetime = new DateTime($validationdate);
        $firstdatetime = $datetime->format("Y-m-d H:i:s");
        $datetime->modify('-60 seconds');
        $seconddatetime = $datetime->format("Y-m-d H:i:s");
        $adminlijst = $this->getadmin();
        foreach ($adminlijst as $admin){
            $id = $admin->getLeerkrachtid();
            $sql = "update validation set disabled = true where gebruikerid = '".$id."' AND datum <= '".$firstdatetime."' AND datum >= '".$seconddatetime."' ";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->exec($sql);
            $dbh = null;
        }
    }

    public function validationantispam($gebruikerid){
        $datetime = new DateTime();
        $result = true;
        $gebruiker = true;
        //first mark moment of trigger
        $firstdatetimes = $datetime->format("Y-m-d H:i:s");
        //second mark is 20 min before triger
        $datetime->modify('-20 minutes');
        $seconddatetimes = $datetime->format("Y-m-d H:i:s");
        //made the two strings of dates 
        //hieronder gaan we op zoek naar records met gegevens hiertussen
       
        $sql = "select * from validation where gebruiker = '".$gebruiker."' AND gebruikerid = '".$gebruikerid."' AND datum <= '".$firstdatetimes."' AND datum >= '".$seconddatetimes."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        foreach($resultset as $rij){
            $foundid = $rij['validationid'];
            if($foundid>0){
                $result = false;// blijf false als er geen matches gevonden werden
            }  else {
                $result = true;//result is true als er al een id werd toegevoegd
            }
        }
        return $result;//is een bool wordt true als er al een code toegevoegd werd aan de db 
    }

    public function countadmins(){//deze functie telt aantal admins in de db table van leerkrachten (returnt een aantal)
        $aantal = 0;
        $sql="select count(leerkrachtid) AS total from leerkracht where admin=true";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset=$dbh->query($sql);
        $rij = $resultset->fetch();
        $aantal = $rij["total"];
        return $aantal;
    }
   
    public function getadmin(){//deze functie haalt de admins op afhankelijk van het aantal een lijst of een enkel obj.
        $aantalAdmins = $this->countadmins();
        $sql="select * from leerkracht where admin=true ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        if($aantalAdmins < 2 && $aantalAdmins > 0){
             $resultset = $dbh->query($sql);
             $rij = $resultset->fetch();
             $leerkracht = leerkracht::create($rij["leerkrachtid"],$rij["emailadres"],$rij["wachtwoord"],$rij["voornaam"],$rij["familienaam"],$rij["geboortedatum"],$rij["foto"],$rij["klasid"],$rij["admin"]);
             return $leerkracht;
         }elseif($aantalAdmins > 1){
             $resultset = $dbh->query($sql);
             $lijst = array();
             foreach($resultset as $rij){
                $leerkracht = leerkracht::create($rij["leerkrachtid"],$rij["emailadres"],$rij["wachtwoord"],$rij["voornaam"],$rij["familienaam"],$rij["geboortedatum"],$rij["foto"],$rij["klasid"],$rij["admin"]);
                array_push($lijst, $leerkracht);
             }
             return $lijst;
        }
    }
   
    public function removeovergangen(){
        $sql = "TRUNCATE overgang";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}
