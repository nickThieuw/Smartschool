<?php

class afwezigheid {
    private static $idmap = array();
    private $id;
    private $leerlingid;
    private $datum;
    
    private function __construct($id,$leerlingid,$datum) {
        $this->id = $id;
        $this->leerlingid = $leerlingid;
        $this->datum = $datum;
    }
    
    public static function create($id,$leerlingid,$datum){
        if (!isset(self::$idmap[$id])){
            self::$idmap[$id]= new afwezigheid($id, $leerlingid, $datum);
        }
        return self::$idmap[$id];
    }
    
    public function getId() {
        return $this->id;
    }

    public function getLeerlingid() {
        return $this->leerlingid;
    }

    public function getDatum() {
        return $this->datum;
    }
    
    public function setLeerlingid($leerlingid) {
        $this->leerlingid = $leerlingid;
    }

    public function setDatum($datum) {
        $this->datum = $datum;
    }
}