<?php

require_once ("data/puntenDAO.php");

class puntenservice{
    public function puntenLijst($testId){
        $puntenDAO= new puntenDAO();
        $puntenlijst= $puntenDAO->getBytestid($testId);
        return $puntenlijst;
    }
    
    public function voegNieuwePuntToe($leerlingid,$punten,$testid){
        $puntenDAO= new puntenDAO();
        $puntenDAO->create($leerlingid, $punten, $testid);
    }
    
    public function UpdatePunten($leerlingid,$punten,$testid){
        $puntenDAO= new puntenDAO();
        $puntenDAO->Update($leerlingid, $punten, $testid);
    }
    
    public function removepunten(){
        $puntenDAO = new puntenDAO();
        $puntenDAO->removepunten();
    }
}

