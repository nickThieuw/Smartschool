<?php

require_once 'data/Dbconfig.php';

class BerichtenDao {
    
    public function voegToe($arr) {
 
        $db = new PDO(Dbconfig::$DB_CONNSTRING, Dbconfig::$DB_USERNAME, Dbconfig::$DB_PASSWORD);
        //prepare
        $stmt = $db->prepare("INSERT INTO berichten (fromId, fromStatus, titel, conversatie, toId, toStatus, bericht, datumTijd)"
                . " VALUES (:fromId, :fromStatus,:titel, :conversatie, :toId, :toStatus, :bericht, :datum)");
        
//        print ($arr['fromId']
//        ." / ".$arr['fromStatus']
//        ." / ".$arr['titel']
//        ." / ".(int)$arr['conversatie']
//        ." / ".$arr['toId']
//        ." / ".$arr['toStatus']
//        ." / ".$arr['bericht']
//        ." / ".$arr['datum']->format('Y-m-d H:i:s'));

        $fromId = $arr['fromId'];
        $fromStatus = $arr['fromStatus'];
        $titel = $arr['titel'];
        $conversatie = (int)$arr['conversatie'];
        $toId = $arr['toId'];
        $toStatus = $arr['toStatus'];
        $bericht = $arr['bericht'];
        $datum = $arr['datum']->format('Y-m-d H:i:s');

        //set parameters and execute
        $stmt->bindParam(':fromId', $fromId);
        $stmt->bindParam(':fromStatus', $fromStatus);
        $stmt->bindParam(':titel', $titel);
        $stmt->bindParam(':conversatie', $conversatie);
        $stmt->bindParam(':toId', $toId);
        $stmt->bindParam(':toStatus', $toStatus);
        $stmt->bindParam(':bericht', $bericht);
        $stmt->bindParam(':datum', $datum);
        $stmt->execute();
        
        $db =null;  
    }
    //berichtenzien postvak in OK
    public function getAll($from, $status){
          $db = new PDO(Dbconfig::$DB_CONNSTRING, Dbconfig::$DB_USERNAME, Dbconfig::$DB_PASSWORD);
          $stmt = $db->prepare("select berichten.id, berichten.fromId, berichten.fromStatus, berichten.titel, berichten.conversatie,"
                    . " berichten.gelezen, berichten.datumTijd from berichten" 
                    ." inner join (select titel, conversatie, max(datumTijd) as datum from berichten where toId = :from and toStatus = :status"
                    ." group by titel, conversatie) as sms on (berichten.titel = sms.titel and berichten.conversatie =sms.conversatie"
                    ." and berichten.datumTijd = sms.datum) order by berichten.datumTijd DESC");
          $stmt->bindParam(':from', $from);
          $stmt->bindParam(':status', $status);
          $stmt->execute();
          $arr = array();
          $arr = $stmt->fetchAll();
          $db = null;
          return $arr;
    }
    //nog niet OK 
    //hier moet voor postvak in de eerste dat je ziet het laatste bericht zijn dat je gekregen hebt
    //en voor verzonden items het laatste bericht dat jij verzonden hebt
    public function getAllConversation($onderwerp, $conversatie, $laatsteDatum){
          $db = new PDO(Dbconfig::$DB_CONNSTRING, Dbconfig::$DB_USERNAME, Dbconfig::$DB_PASSWORD);
          $stmt = $db->prepare("select id, fromId, fromStatus, titel, conversatie,"
                    . " gelezen, toId, toStatus, bericht, datumTijd from berichten where" 
                    ." conversatie = :conversatie and titel = :titel and datumTijd <= :datum"
                    ." order by berichten.datumTijd DESC");
          $stmt->bindParam(':conversatie', $conversatie);
          $stmt->bindParam(':titel', $onderwerp);
          $stmt->bindParam(':datum', $laatsteDatum);
          $stmt->execute();
          $arr = array();
          $arr = $stmt->fetchAll();
          $db = null;
          return $arr;
    }
    //om te beantwoorden van postvak in
    public function getBericht($id){
        $db = new PDO(Dbconfig::$DB_CONNSTRING, Dbconfig::$DB_USERNAME, Dbconfig::$DB_PASSWORD);
        $stmt = $db->prepare("select fromId, fromStatus, gelezen, titel, conversatie, toId, toStatus, bericht, datumTijd from berichten where id= :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $arr = array();
        $arr = $stmt->fetch(PDO::FETCH_ASSOC);
        $db = null;
        return $arr;
    }
    //set gelezen
    public function setGelezenDao($id) {
        $db = new PDO(Dbconfig::$DB_CONNSTRING, Dbconfig::$DB_USERNAME, Dbconfig::$DB_PASSWORD);
        $stmt = $db->prepare("update berichten set gelezen = 1 where id= :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
    //berichtenverzonden OK
    public function getAlleVerzondenDao($from, $status){
        $db = new PDO(Dbconfig::$DB_CONNSTRING, Dbconfig::$DB_USERNAME, Dbconfig::$DB_PASSWORD);
        $stmt = $db->prepare("select berichten.id, berichten.fromId, berichten.fromStatus, berichten.titel, berichten.conversatie,"
                    ." berichten.datumTijd from berichten" 
                    ." inner join (select titel, conversatie, max(datumTijd) as datum from berichten where fromId = :from and fromStatus = :status"
                    ." group by titel, conversatie) as sms on (berichten.titel = sms.titel and berichten.conversatie =sms.conversatie"
                    ." and berichten.datumTijd = sms.datum) order by berichten.datumTijd DESC");
        $stmt->bindParam(':from', $from);
        $stmt->bindParam(':status', $status);
        $stmt->execute();
        $arr = array();
        $arr = $stmt->fetchAll();
        $db = null;
        return $arr;
    }
    public function kontrTitel($titel){
        $db = new PDO(Dbconfig::$DB_CONNSTRING, Dbconfig::$DB_USERNAME, Dbconfig::$DB_PASSWORD);
        $stmt = $db->prepare("select conversatie from berichten where titel= :titel");
        $stmt->bindParam(':titel', $titel);
        $stmt->execute();
        $arr = array();
        $arr = $stmt->fetchAll();
        $db = null;
        return $arr;
    }
   
    public function removeberichten(){
        $sql = "TRUNCATE berichten";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $dbh->exec($sql);
        $dbh = null;
    }
}
