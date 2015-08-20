<?php
require_once("data/DBconfig.php");
require_once ("entities/klas.php");
class klasDAO{
    
    public function getklas($klasid){
        $sql = "select klasid,naamklas from klas where klasid='".$klasid."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $rij = $resultSet->fetch();
        $klas = klas::create($rij["klasid"],$rij["naamklas"]);
        $dbh = null;
        return $klas;
    }
    
    public function getklasBynaam($klas_naam){
        $sql = "select klasid,naamklas from klas where naamklas='".$klas_naam."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $klas = klas::create($rij["klasid"],$rij["naamklas"]);
        $dbh = null;
        return $klas;
    }
    
    public function getklasnaam($klasid){
        $sql = "select klasid,naamklas from klas where klasid='".$klasid."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $naamklas = $rij["naamklas"];
        $dbh = null;
        return $naamklas;
    }

    public function addKlas($klas_naam){
        $sql = "insert into klas (naamklas) values('".$klas_naam."')";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null; 
    }
    
    public function getklassenlijst(){
        $klassenlijst = array();
        $sql = "select klasid,naamklas from klas";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        foreach ($resultset as $rij){
            $temp = klas::create($rij["klasid"],$rij["naamklas"]);
            array_push($klassenlijst, $temp);
        }
        return $klassenlijst;
    }
    
    public function getklasid($klasnaam){
        $sql = "select klasid from klas where naamklas = '".$klasnaam."' ";
        $dbh = new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $resultset = $dbh->query($sql);
        $rij = $resultset->fetch();
        $klasid = $rij["klasid"];
        $dbh = null;
        return $klasid;
    }
}
