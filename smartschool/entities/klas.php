<?php

class klas {
    private static $idmap = array();
    private $klasid;
    private $naamklas;
    
    private function __construct($klasid,$naamklas) {
        $this->klasid = $klasid;
        $this->naamklas = $naamklas;
    }
    
    public function create($klasid,$naamklas) {
        if (!isset(self::$idmap[$klasid])){
            self::$idmap[$klasid]= new klas($klasid, $naamklas);
        }
        return self::$idmap[$klasid];
    }
    
    public function getNaamklas() {
        return $this->naamklas;
    }
    
    public function getKlasid() {
        return $this->klasid;
    }
    
    public function setNaamklas($naamklas) {
        $this->naamklas = $naamklas;
    }
    
    public function setKlasid($klasid) {
        $this->klasid = $klasid;
    }
}
