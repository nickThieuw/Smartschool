<?php

require_once ("data/evenementDAO.php");

class evenementservice{

    public function voegNieuwEvenementToe($title,$info,$start,$end,$klasid,$toets,$vakantie){
        $evenementDAO = new evenementDAO();
        $evenementDAO->create($title,$info,$start,$end,$klasid,$toets,$vakantie);
    }
    
    public function EvenementLijst($klasid){
        $evenementDAO = new evenementDAO();
        $evenementlijst= $evenementDAO->evenementenlijst($klasid);
        return $evenementlijst;
    }
    
    public function FullEvenementLijst(){
        $evenementDAO = new evenementDAO();
        $evenementlijst= $evenementDAO->fullevenementenlijst();
        return $evenementlijst;
    }
    
    public function VakantieLijst(){
        $evenementDAO = new evenementDAO();
        $evenementlijst= $evenementDAO->vakantielijst();
        return $evenementlijst;
    }
    
    public function EvenementtoetsLijst($klasid){
        $evenementDAO = new evenementDAO();
        $evenementlijst= $evenementDAO->evenemententoetslijst($klasid);
        return $evenementlijst;
    }
    
    public function getevenementid($title,$klasid){
        $evenementDAO = new evenementDAO();
        $evenementid = $evenementDAO->getevenementid($title, $klasid);
        return $evenementid;
    }
    
    public function UpdateEvenement($id,$title,$info,$start,$end,$klasid){
        $evenementDAO = new evenementDAO();
        $evenementDAO->Update($id,$title,$info,$start,$end,$klasid); 
    }
    
    public function DeleteEvent($id){
        $evenementDAO = new evenementDAO();
        $evenementDAO->delete($id);
    }
    
    public function removeevents(){
        $evenementDAO = new evenementDAO();
        $evenementDAO->removepunten();
    }
}