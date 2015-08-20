<?php
require_once 'DBconfig.php';
class Pdf_en_grafiekDAO {

    public function createViewProcenttabel(){
       $db= new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
       $sql="create view procent2 as select trimister, leerlingID, vakid, ((sum(punten)/sum(puntentotaal))*100) "
        ."as percentage, klasidvak from basistabel "
   //kontrole van leerling en vak, komen die van dezelfde klas?
        ."where klasidleerling = klasidvak "
        ."group by trimister, leerlingID, vakid, klasidvak";
       $db->query($sql);
       $db=null;       
    }
    public function dropViewProcenttabel(){
       $db= new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
       $sql="drop view procent2";
       $db->query($sql);
       $db=null;
    }
    //de juiste klas wordt gekontroleerd, de klas die van de website komt
    public function createViewKlasgemiddelde($trim, $klas){
        $db= new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
        $sql = "create view klasgemiddelde_per_vak as SELECT vakid, sum(percentage)/count(percentage) "
         ."as klasgemiddelde  FROM  procent2 where trimister='$trim' and klasidvak='$klas' group by vakid";
        $db->query($sql);
        $db=null;
    }
    public function dropViewKlasgemiddelde() {
         $db= new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
         $sql = "drop view klasgemiddelde_per_vak";
         $db->query($sql);
         $db=null;
    }
    
    //deze methode werkt nu met ID i.p.v. voornaam en familienaam
    //dit ter beveiliging, wat als iemand een leerling aanmaakt met dezelfde naam?
    public function selectPercentageLeerling($trim, $id){
         $db= new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
         $sql = "SELECT distinct vaknaam, percentage  FROM  procent2 inner join basistabel "
        ."on procent2.leerlingID=basistabel.leerlingID "
        ."and procent2.vakID=basistabel.vakID "
        ."where procent2.trimister='$trim' "
        ."and procent2.leerlingID='".$id."' "
        ."order by procent2.vakID";
         $query=$db->query($sql);
         $result=$query->fetchAll(PDO::FETCH_ASSOC);
         $db=null;
         return $result;
    }
    public function selectKlasgemiddelde() {
         $klasgemiddelde= array();
         $db= new PDO(DBconfig::$DB_CONNSTRING, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
         $sql = "SELECT vaknaam, klasgemiddelde FROM klasgemiddelde_per_vak inner join vak "
            ."on klasgemiddelde_per_vak.vakid=vak.vakid order by vaknaam";
         $query = $db->query($sql);
         $result=$query->fetchAll(PDO::FETCH_ASSOC);
         $db=null;
         return $result;
            
    }  
}

