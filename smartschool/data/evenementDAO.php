<?php

require_once("data/DBconfig.php");
require_once("entities/evenement.php");
require_once("exceptions/evenementbestaatexception.php");

class evenementDAO{
    public function create($title,$info,$start,$end,$klasid,$toets,$vakantie){
        $bestaandevenement = 0;
        $bestaandevenement = $this->getevenementid($title,$klasid);
        if ($bestaandevenement == 0) {
            $sql = "insert into evenement (title,info,start,end,klasid,toets,vakantie)
                values (:title,:info ,:start ,:end ,:klasid,:toets,:vakantie)";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $q = $dbh->prepare($sql);
            $q->execute(array(':title' => $title,':info'=> $info,':start' => $start, ':end' => $end,':klasid' =>$klasid, ':toets' => $toets, ':vakantie' =>$vakantie));
            $id = $dbh->lastInsertId();
            $dbh = null;
            $evenement = evenement::create($id,$title,$info,$start,$end,$klasid,$toets,$vakantie);
            return $evenement;
        } else {
            throw new evenementbestaatexception;
        }
    }
    
    public function evenementenlijst($klasid){
        $sql = "select * from evenement where (klasid ='".$klasid."' OR klasid = 1) AND toets = 0 AND vakantie = 0";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultaten = $dbh->query($sql);
        return $resultaten->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function fullevenementenlijst(){
        $sql = "select * from evenement where toets=0 AND vakantie=0";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultaten = $dbh->query($sql);
        return $resultaten->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function vakantielijst(){
        $sql = "select * from evenement where toets=0 AND vakantie=1";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultaten = $dbh->query($sql);
        return $resultaten->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function evenemententoetslijst($klasid){
        $sql = "select * from evenement where klasid ='".$klasid."' AND toets = 1";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultaten = $dbh->query($sql);
        return $resultaten->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getById($id){
        $sql = "select * from evenement where id ='".$id."'";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $dbh = null;
        $evenement = evenement::create($rij["id"],$rij["title"] , $rij["start"], $rij["end"],$rij["info"],$rij["klasid"],$rij["toets"]);
        return $evenement;
    }
    
    public function getevenementid($title, $klasid) {
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "select id from evenement where title = '".$title."' && klasid ='".$klasid."' limit 1";
        $resultset = $dbh->query($sql);
        if($resultset!=""){
        $rij = $resultset->fetch();
        $evenementid = $rij["id"];
        } else {
            $evenementid="";
        }
        $dbh = null;
        return $evenementid;
    }
    
     public function Update($id, $title, $info, $start, $end, $klasid){
        $bestaand = $this->getById($id);
        if ($id>0 | $bestaand->getTitle() == $title){
            $sql = "update evenement set title='".$title."', start='".$start."',end='".$end."', info='".$info."',klasid='".$klasid."' where id='".$id."'";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $dbh->exec($sql);
            $dbh = null;
        } else {
            throw new evenementbestaatexception;
        }
    }
    
    public function delete($id){
        $sql = "delete from evenement where id = '".$id."'";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
    
    // zal moeten herschreven worden als foreign key weer gebruikt worden
    public function removepunten(){
        $sql = "TRUNCATE evenement";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}