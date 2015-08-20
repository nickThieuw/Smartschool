<?php
require_once("data/DBconfig.php");
require_once("entities/punten.php");
require_once("exceptions/puntbestaatexception.php");

class puntenDAO {
    public function create($leerlingid,$punten,$testid){
        $bestaandpunten = $this->getByleerlingtest($leerlingid, $testid);
        if ($bestaandpunten->getPuntenid() == 0) {
            $sql = "insert into punten (leerlingid,punten,testid)
                values ('" . $leerlingid . "', '" . $punten . "','" . $testid .  "')";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->exec($sql);
            $puntenid = $dbh->lastInsertId();
            $dbh = null;
            $punt = punten::create($puntenid, $leerlingid, $punten, $testid);
            return $punt;
            
        } else {
            throw new puntbestaatexception;
        }
    }
    
    public function Update($leerlingid,$punten,$testid){
    $sql = "update punten set punten='".$punten."' where leerlingid='".$leerlingid."' and testid='".$testid."'";
    $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
    $dbh->exec($sql);
    $dbh = null;
    }
    
    public function getBytestid($testid) {
        $puntenlijst = array();
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "select puntenid, leerlingid, punten from punten where testid ='".$testid."'";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $punt = punten::create($rij["puntenid"],$rij["leerlingid"],$rij["punten"],$testid);
            array_push($puntenlijst, $punt);
        }
        return $puntenlijst;
    }
    
    public function getByleerlingtest($leerlingid,$testid){
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select puntenid, punten from punten where leerlingid = '".$leerlingid."' and testid ='".$testid."' limit 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $dbh = null;
        $punt = punten::create($rij["puntenid"],$leerlingid, $rij["punten"],$testid);
        return $punt;
    }
    
    // zal moeten herschreven worden als foreign key weer gebruikt worden
    public function removepunten(){
        $sql = "TRUNCATE punten";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}
