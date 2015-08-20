<?php

class vak {
    private static $idmap = array();
    private $vakid;
    private $vaknaam;
    private $klasid;
    
    private function __construct($vakid,$vaknaam,$klasid) {
        $this->vakid = $vakid;
        $this->vaknaam = $vaknaam;
        $this->klasid = $klasid;
    }
    
    public static function create($vakid,$vaknaam,$klasid){
        if (!isset(self::$idmap[$vakid])){
            self::$idmap[$vakid]= new vak($vakid, $vaknaam, $klasid);
        }
        return self::$idmap[$vakid];
    }
    
    public function getVakid() {
        return $this->vakid;
    }
    
    public function getVaknaam() {
        return $this->vaknaam;
    }
    
    public function getKlasid() {
        return $this->klasid;
    }
    
    public function setVaknaam($vaknaam) {
        $this->vaknaam = $vaknaam;
    }
    
    public function setKlasid($klasid) {
        $this->klasid = $klasid;
    }
}