<?php

require_once("data/DBconfig.php");
require_once("entities/afwezigheid.php");

class afwezigheidDAO {

    public function create($id, $leerlingid, $datum) {
        $sql = "insert into afwezigheden (afwezigheidid,leerlingid,datum)
                values('" . $id . "','" . $leerlingid . "','" . $datum . "')";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $test = $dbh->exec($sql);
        return $test;
    }

    public function getaanwezigheidvoorm($date1, $date2) {
        $lijst = array();
        $sql = "select afwezigheidid as id,leerlingid,datum from afwezigheden where datum > '" . $date1 . "' and datum < '" . $date2 . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            $afwezigheid = afwezigheid::create($rij["id"], $rij["leerlingid"], $rij["datum"]);
            array_push($lijst, $afwezigheid);
        }
        $dbh = null;
        return $lijst;
    }

    public function getaanwezigheidnam($date1, $date2) {
        $lijst = array();
        $sql = "select afwezigheidid as id,leerlingid,datum from afwezigheden where datum >= '" . $date1 . "' and datum < '" . $date2 . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);

        foreach ($resultSet as $rij) {
            $afwezigheid = afwezigheid::create($rij["id"], $rij["leerlingid"], $rij["datum"]);
            array_push($lijst, $afwezigheid);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function deleteAfwezigheidvoorm($leerlingid,$date1,$date2) {
        $sql = "delete from afwezigheden where leerlingid = '".$leerlingid."' and datum > '" . $date1 . "' and datum < '" . $date2 . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
    
    public function deleteAfwezigheidnam($leerlingid,$date1,$date2) {
        $sql = "delete from afwezigheden where leerlingid = '".$leerlingid."' and datum >= '" . $date1 . "' and datum < '" . $date2 . "'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }

    public function removeafwezigheden(){
        $sql = "TRUNCATE afwezigheden";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
    
    public function boolgetafwezigheidleerlingiddate($datum,$leerlingid){
        $date = new DateTime($datum);
        //$date->format('Y-m-d H');
//        print_r($date);
        $date->setTime(0,0,0);
        $datumstart = $date->format('Y-m-d H');
        $date->setTime(23,0,0);
        $datumend = $date->format('Y-m-d H');
//        echo "<br/>";
//        print_r($datumstart);
//        echo "<br/>";
//        print_r($datumend);
//        echo "<br/>";
        $result = false;
        $sql = "select * from afwezigheden where leerlingid = '".$leerlingid."' AND datum < '".$datumend."' AND datum > '".$datumstart."' ";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $rij) {
            if($rij["afwezigheidid"]>0){
                $result = true;//to see if there was found a match
            } 
        }
        $dbh = null;
        return $result;
    }
}
