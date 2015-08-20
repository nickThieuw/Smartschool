<?php

require_once ("data/toetsDAO.php");

class toetsservice{
    public function toetsenLijst($vakId){
        $toetsDAO= new toetsDAO();
        $toetsenlijst= $toetsDAO->getByVakid($vakId);
        return $toetsenlijst;
    }
    
    public function voegNieuweToetsToe($vakid,$testomschrijving,$datum,$trimister,$puntentotaal){
        $toetsDAO= new toetsDAO();
        $toetsDAO->create($vakid,$testomschrijving,$datum,$trimister,$puntentotaal);
    }
    
        public function gettestid($testomschrijving){
        $toetsDAO = new toetsDAO();
        $toetsid = $toetsDAO->gettestid($testomschrijving);
        return $toetsid;
    }
    
    public function getTest($vakid,$testomschrijving){
        $toetsDAO = new toetsDAO();
        $test = $toetsDAO->getBytestnaamvak($vakid, $testomschrijving);
        return $test;
    }
    
    public function UpdateToets($toetsid,$vakid,$testomschrijving,$datum,$puntentotaal){
        $toetsDAO= new toetsDAO();
        $toetsDAO->Update($toetsid,$vakid,$testomschrijving,$datum,$puntentotaal);
    }
    
    public function removetoetsen(){
        $toetsDAO = new toetsDAO();
        $toetsDAO->removetoetsen();
    }
}