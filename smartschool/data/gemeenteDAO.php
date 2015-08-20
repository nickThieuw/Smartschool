<?php

require_once("data/DBconfig.php");
require_once ("entities/gemeente.php");

class gemeenteDAO{
    public function getGemeente($postcode,$gemeente){
        $sql="select id,postcode,up from gemeente where postcode='".$postcode."' and naam='".$gemeente."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset=$dbh->query($sql);
        $rij=$resultset->fetch();
        $gemeente=  gemeente::create($rij["id"],$rij["postcode"],$rij["up"]);
        return $gemeente;       
    }
    public function addGemeente($postcode,$gemeente,$uppergemeente){
        $sql="insert into gemeente (postcode,naam,up) values ('".$postcode."','".$gemeente."','".$uppergemeente."')";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh=null;
    }
    public function getGemeenteById($postcode_id){
        $sql="select id,postcode,naam from gemeente where id='".$postcode_id."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset=$dbh->query($sql);
        $rij=$resultset->fetch();
        $gemeente=  gemeente::create($rij["id"],$rij["postcode"],$rij["naam"]);
        return $gemeente;  
    }
}
