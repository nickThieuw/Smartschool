<?php

class gemeente {
    private static $idmap = array();
    private $gemeente_id;
    private $postcode;
    private $gemeente_naam;


    private function __construct($gemeente_id,$postcode,$gemeente_naam) {
        $this->gemeente_id = $gemeente_id;
        $this->postcode = $postcode;
        $this->gemeente_naam = $gemeente_naam;
    }
    public function create($gemeente_id,$postcode,$gemeente_naam) {
        if (!isset(self::$idmap[$gemeente_id])){
            self::$idmap[$gemeente_id]= new gemeente($gemeente_id,$postcode,$gemeente_naam);
        }
        return self::$idmap[$gemeente_id];
    }
    public function getGemeente_id() {
        return $this->gemeente_id;
    }
    public function getPostcode() {
        return $this->postcode;
    }
    public function getGemeente_naam(){
        return $this->gemeente_naam;
    }
    public function setGemeente_id($gemeente_id) {
        $this->gemeente_id = $gemeente_id;
    }
    public function setPostcode($postcode) {
        $this->postcode = $postcode;
    }
    public function setGemeente_naam($gemeente_naam){
        $this->gemeente_naam = $gemeente_naam;
    }
}
