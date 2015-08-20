<?php

class punten {
    private static $idmap = array();
    private $puntenid;
    private $leerlingid;
    private $punten;
    private $testid;


    private function __construct($puntenid,$leerlingid,$punten,$testid) {
        $this->puntenid = $puntenid;
        $this->leerlingid = $leerlingid;
        $this->punten = $punten;
        $this->testid = $testid;
    }
    
    public static function create($puntenid,$leerlingid,$punten,$testid){
        if (!isset(self::$idmap[$puntenid])){
            self::$idmap[$puntenid]= new punten($puntenid,$leerlingid,$punten,$testid);
        }
        return self::$idmap[$puntenid];
    }
    
     public function getPuntenid() {
        return $this->puntenid;
    }
    
    public function getLeerlingid() {
        return $this->leerlingid;
    }
    
    public function getPunten() {
        return $this->punten;
    }
    
    public function getTestid() {
        return $this->testid;
    }
    
    public function setLeerlingid($leerlingid) {
        $this->leerlingid = $leerlingid ;
    }
    
    public function setPunten($punten) {
        $this->punten = $punten;
    }
    
    public function setTestnr($testid) {
        $this->testid = $testid;
    }
     
}