<?php
class leerkracht{
    private static $idMap = array();
    private $leerkrachtid;
    private $emailadres;
    private $wachtwoord;
    private $voornaam;
    private $familienaam;
    private $geboortedatum;
    private $foto;
    private $klasid;
    private $admin;
    
    private function __construct($leerkrachtid,$emailadres,$wachtwoord,$voornaam,$familienaam,$geboortedatum,$foto,$klasid,$admin) {
        $this->leerkrachtid=$leerkrachtid;
        $this->emailadres=$emailadres;
        $this->wachtwoord=$wachtwoord;
        $this->voornaam=$voornaam;
        $this->familienaam=$familienaam;
        $this->geboortedatum=$geboortedatum;
        $this->foto=$foto;
        $this->klasid=$klasid;
        $this->admin=$admin;
    }
    
    public static function create($leerkrachtid,$emailadres,$wachtwoord,$voornaam,$familienaam,$geboortedatum,$foto,$klasid,$admin){
        if(!isset(self::$idMap[$leerkrachtid])){
            self::$idMap[$leerkrachtid]=new leerkracht($leerkrachtid,$emailadres,$wachtwoord,$voornaam,$familienaam,$geboortedatum,$foto,$klasid,$admin);
        }
        return self::$idMap[$leerkrachtid];
    }
    
    public function getLeerkrachtid(){
        return $this->leerkrachtid;
    }
    
    public function getEmailadres(){
        return $this->emailadres;
    }
    
    public function getWachtwoord(){
        return $this->wachtwoord;
    }
    
    public function getVoornaam(){
        return $this->voornaam;
    }
    
    public function getFamilienaam(){
        return $this->familienaam;
    }
    
    public function getGeboortedatum(){
        return $this->geboortedatum;
    }
    
    public function getFoto(){
        return $this->foto;
    }
    
    public function getKlasid(){
        return $this->klasid;
    }
    
    public function getAdmin(){
        return $this->admin;
    }
    
    public function setEmailadres(){
        return $this->emailadres;
    }
    
    public function setWachtwoord($wachtwoord){
        $this->wachtwoord=$wachtwoord;
    }
    
    public function setVoornaam($voornaam){
        $this->voornaam=$voornaam;
    }
    
    public function setFamilienaam($familienaam){
        $this->familienaam=$familienaam;
    }
    
    public function setGeboortedatum($geboortedatum){
        $this->geboortedatum=$geboortedatum;
    }
    
    public function setFoto($foto){
        $this->foto=$foto;
    }
    
    public function setKlasid($klasid){
        $this->klasid=$klasid;
    }
    
    public function setAdmin($admin){
        $this->admin=$admin;
    }
}