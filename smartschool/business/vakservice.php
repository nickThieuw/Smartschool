<?php

require_once ("data/vakDAO.php");

class vakservice{
   
    public function voegNieuwVakToe($vaknaam,$klasid){
        $vakDAO= new vakDAO();
        $vakDAO->create($vaknaam, $klasid);
    }
    
    public function vakkenLijst($klasId){
        $vakDAO= new vakDAO();
        $vakkenlijst= $vakDAO->getByKlasid($klasId);
        return $vakkenlijst;
    }
    
    public function getVakid($vaknaam,$klasid){
        $vakDAO = new vakDAO();
        $vakid = $vakDAO->getVakid($vaknaam, $klasid);
        return $vakid;
    }
    
     public function UpdateVak($vakid,$vaknaam,$klasid){
        $vakDAO= new vakDAO();
        return $vakDAO->Update($vakid,$vaknaam, $klasid); 
    }
}

