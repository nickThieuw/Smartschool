
<?php
require_once 'data/BerichtenDao.php';

class BerichtenService{
    
    public function voegBerichtToe($arr){
        $bericht = new BerichtenDao();
        $bericht->voegToe($arr);
    }
    public function getAlleBerichtGegvens($from, $status){
        $berichten = new BerichtenDao();
        return $berichten->getAll($from, $status);   
    }
    public function getBericht($id) {
        $bericht = new BerichtenDao();
        return $bericht->getBericht($id);
    }
    public function setGelezen($id) {
        $bericht = new BerichtenDao();
        $bericht->setGelezenDao($id);    
    }
    public function getAlleVerzonden($from, $status){
        $berichten = new BerichtenDao();
        return $berichten->getAlleVerzondenDao($from, $status);
    }
    public function kontroleerTitel($titel){
        $berichten = new BerichtenDao();
        return $berichten->kontrTitel($titel);
    }
    public function getAlleConversaties($onderwerp, $conversatie, $laatstedatum){
        $berichten = new BerichtenDao();
        return $berichten->getAllConversation($onderwerp, $conversatie, $laatstedatum);
    }
     public function removeberichten(){
        $bericht = new BerichtenDao();
        $bericht->removeberichten();    
    }
}

