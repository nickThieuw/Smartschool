<?php

require_once("data/DBconfig.php");
require_once("entities/vak.php");
require_once("exceptions/vakbestaatexception.php");

class vakDAO{

    public function create($vaknaam,$klasid){
        $bestaandvak = 0;
        $bestaandvak = $this->getVakid($vaknaam,$klasid);
        if ($bestaandvak == 0) {
            $sql = "insert into vak (vaknaam,klasid)
                values ('" . $vaknaam . "','" . $klasid . "')";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->exec($sql);
            $vakid = $dbh->lastInsertId();
            $dbh = null;
            $vak = vak::create($vakid, $vaknaam, $klasid);
            return $vak;
            
        } else {
            throw new vakbestaatexception;
        }
    }
    
    public function getByKlasid($klasid) {
        $vakkenlijst = array();
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "select vakid, vaknaam from vak where klasid ='".$klasid."'";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $vak = vak::create($rij["vakid"], $rij["vaknaam"], $klasid);
            array_push($vakkenlijst, $vak);
        }
        return $vakkenlijst;
    }
    
//    public function getByVakid($vakid){
//        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
//        $sql = "select vaknaam, klasid from vak where vakid ='".$vakid."' limit 1";
//        $resultSet = $dbh->query($sql);
//        $rij = $resultSet->fetch();
//        $dbh = null;
//        $vak = vak::create($vakid, $rij["vaknaam"], $rij["klasid"]);
//        return $vak;
//    }

    public function getVakid($vaknaam, $klasid) {
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "select vakid from vak where vaknaam = '".$vaknaam."' && klasid ='".$klasid."' limit 1";
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $vakid = $rij["vakid"];
        $dbh = null;
        return $vakid;
    }
    
    public function Update($vakid,$vaknaam,$klasid){
        $bestaandvak = 0;
        $bestaandvak = $this->getVakid($vaknaam,$klasid);
        if ($bestaandvak == 0) {
            $sql = "update vak set vaknaam ='".$vaknaam."' where vakid='".$vakid."' ";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            return $dbh->exec($sql);
            $dbh = null;
        } else {
            throw new vakbestaatexception;
        }
    }
}
