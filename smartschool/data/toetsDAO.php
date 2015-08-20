<?php

require_once("data/DBconfig.php");
require_once ("entities/toets.php");
require_once ("exceptions/toetsbestaatexception.php");

class toetsDAO {
    public function create($vakid,$testomschrijving,$datum,$trimister,$puntentotaal){
        $bestaandtoets = $this->getBytestnaamvak($vakid, $testomschrijving);
        if ($bestaandtoets->getTestid() == 0) {
            $sql = "insert into test (vakid,testomschrijving,datum,trimister,puntentotaal)
                values ('" . $vakid . "', '" . $testomschrijving . "','" . $datum . "','" . $trimister . "','"
                    . $puntentotaal . "')";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->exec($sql);
            $testid = $dbh->lastInsertId();
            $dbh = null;
            $toets = toets::create($testid, $vakid, $testomschrijving, $datum, $trimister, $puntentotaal);
            return $toets;
            
        } else {
            throw new toetsbestaatexception;
        }
    }
    
    public function getByVakid($vakid) {
        $toetsenlijst = array();
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "select testid, testomschrijving as testnaam, datum, trimister, puntentotaal from test where vakid ='".$vakid."'";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $toets = toets::create($rij["testid"],$vakid,$rij["testnaam"],$rij["datum"],$rij["trimister"],$rij["puntentotaal"]);
            array_push($toetsenlijst, $toets);
        }
        return $toetsenlijst;
    }
    
    public function getBytestnaamvak($vakid,$testomschrijving){
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $sql = "select testid, datum,trimister,puntentotaal from test where vakid ='".$vakid."' and testomschrijving ='".$testomschrijving."' limit 1";
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $dbh = null;
        $test = toets::create($rij["testid"], $vakid, $testomschrijving, $rij["datum"]
                        , $rij["trimister"], $rij["puntentotaal"]);
        return $test;
    }
    
    public function gettestid($testnaam) {
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "select testid from test where testomschrijving = '".$testnaam."' limit 1";
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $testid = $rij["testid"];
        $dbh = null;
        return $testid;
    }
    
    public function Update($toetsid,$vakid,$testomschrijving,$datum,$puntentotaal){
        $bestaandtoets = $this->getBytestnaamvak($vakid, $testomschrijving);
        if ($bestaandtoets->getTestid() == 0 | $bestaandtoets->getTestomschrijving() == $testomschrijving) {
            $sql = "update test set testomschrijving='".$testomschrijving."',datum='".$datum."', puntentotaal='".$puntentotaal."' where testid='".$toetsid."'";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->exec($sql);
            $dbh = null;
        } else {
            throw new toetsbestaatexception;
        }
    }
    
    // zal moeten herschreven worden als foreign key weer gebruikt worden
    public function removetoetsen(){
        $sql = "TRUNCATE test";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}
