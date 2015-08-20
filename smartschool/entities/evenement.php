<?php

class evenement {
    private static $idmap = array();
    private $id;
    private $title;
    private $info;
    private $start;
    private $end;
    private $klasid;
    private $toets;
    private $vakantie;


    private function __construct($id,$title,$info,$start,$end,$klasid,$toets,$vakantie) {
        $this->id = $id;
        $this->title = $title;
        $this->info = $info;
        $this->start = $start;
        $this->end = $end;
        $this->klasid = $klasid;
        $this->toets = $toets;
        $this->vakantie = $vakantie;
    }
    
    public function create($id,$title,$info,$start,$end,$klasid,$toets,$vakantie) {
        if (!isset(self::$idmap[$id])){
            self::$idmap[$id]= new evenement($id, $title, $info, $start, $end, $klasid,$toets,$vakantie);
        }
        return self::$idmap[$id];
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitle() {
        return $this->title;
    }
    
    public function getInfo() {
        return $this->info;
    }
    
    public function getStart() {
        return $this->start;
    }
    
    public function getEnd() {
        return $this->end;
    }
    
    public function getKlasid() {
        return $this->klasid;
    }
    
    public function getToets() {
        return $this->toets;
    }
    
    public function getVakantie() {
        return $this->vakantie;
    }
    
    public function setId($id) {
        $this->id= $id;
    }
    
    public function setTitle($title) {
        $this->title= $title;
    }
    
    public function setInfo($info) {
        $this->info= $info;
    }
    
    public function setStart($start) {
        $this->start = $start;
    }
    
    public function setEnd($end) {
        $this->end= $end;
    }
    
    public function setKlasid($klasid) {
        $this->klasid = $klasid;
    }
    
    public function setToets($toets) {
        $this->toets = $toets;
    }
    
    public function setVakantie($vakantie) {
        $this->vakantie = $vakantie;
    }

}