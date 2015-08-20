<?php

class toets {
    private static $idmap = array();
    private $testid;
    private $vakid;
    private $testomschrijving;
    private $datum;
    private $trimister;
    private $puntentotaal;


    private function __construct($testid,$vakid,$testomschrijving,$datum,$trimister,$puntentotaal) {
        $this->testid = $testid;
        $this->vakid = $vakid;
        $this->testomschrijving = $testomschrijving;
        $this->datum = $datum;
        $this->trimister = $trimister;
        $this->puntentotaal = $puntentotaal;
    }
    
    public static function create($testid,$vakid,$testomschrijving,$datum,$trimister,$puntentotaal){
        if (!isset(self::$idmap[$testid])){
            self::$idmap[$testid]= new toets($testid,$vakid,$testomschrijving,$datum,$trimister,$puntentotaal);
        }
        return self::$idmap[$testid];
    }
    
     public function getTestid() {
        return $this->testid;
    }
    
    public function getVakid() {
        return $this->vakid;
    }
    
    public function getTestomschrijving() {
        return $this->testomschrijving;
    }
    
    public function getDatum() {
        return $this->datum;
    }
    
    public function getTrimister() {
        return $this->trimister;
    }
    
    public function getPuntentotaal() {
        return $this->puntentotaal;
    }
    
     public function setVakid($vakid) {
        $this->vakid = $vakid;
    }
    
    public function setTestomschrijving($testomschrijving) {
        $this->testomschrijving = $testomschrijving;
    }
    
    public function setDatum($datum) {
        $this->datum = $datum;
    }
    
    public function setTrimister($trimister) {
        $this->trimister = $trimister;
    }
    
    public function setPuntentotaal($puntentotaal) {
        $this->puntentotaal = $puntentotaal;
    }
}
