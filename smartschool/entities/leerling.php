<?php

class leerling {

    private static $idMap = array();
    private $leerlingid;
    private $voornaam;
    private $familienaam;
    private $geboortedatum;
    private $foto;
    private $straat;
    private $huisnr;
    private $bus;
    private $postcode;
    private $telefoonnr;
    private $klasid;
    private $voornaamouder1;
    private $familienaamouder1;
    private $voornaamouder2;
    private $familienaamouder2;
    private $GSMouder1;
    private $GSMouder2;
    private $emailadres;
    private $wachtwoord;

    private function __construct($leerlingid, $voornaam, $familienaam, $geboortedatum, $foto, $straat, $huisnr
    , $bus, $postcode, $telefoonnr, $klasid, $voornaamouder1, $familienaamouder1
    , $voornaamouder2, $familienaamouder2, $GSMouder1, $GSMouder2, $emailadres
    , $wachtwoord) {
        $this->leerlingid = $leerlingid;
        $this->voornaam = $voornaam;
        $this->familienaam = $familienaam;
        $this->geboortedatum = $geboortedatum;
        $this->foto= $foto;
        $this->straat = $straat;
        $this->huisnr = $huisnr;
        $this->bus = $bus;
        $this->postcode = $postcode;
        $this->telefoonnr = $telefoonnr;
        $this->klasid = $klasid;
        $this->voornaamouder1 = $voornaamouder1;
        $this->familienaamouder1 = $familienaamouder1;
        $this->voornaamouder2 = $voornaamouder2;
        $this->familienaamouder2 = $familienaamouder2;
        $this->GSMouder1 = $GSMouder1;
        $this->GSMouder2 = $GSMouder2;
        $this->emailadres = $emailadres;
        $this->wachtwoord = $wachtwoord;
    }

    public static function create($leerlingid, $voornaam, $familienaam, $geboortedatum, $foto, $straat, $huisnr
    , $bus, $postcode, $telefoonnr, $klasid, $voornaamouder1, $familienaamouder1
    , $voornaamouder2, $familienaamouder2, $GSMouder1, $GSMouder2, $emailadres
    , $wachtwoord) {
        if (!isset(self::$idMap[$leerlingid])) {
            self::$idMap[$leerlingid] = new leerling($leerlingid, $voornaam, $familienaam, $geboortedatum, $foto, $straat, $huisnr
                    , $bus, $postcode, $telefoonnr, $klasid, $voornaamouder1, $familienaamouder1
                    , $voornaamouder2, $familienaamouder2, $GSMouder1, $GSMouder2, $emailadres
                    , $wachtwoord);
        }
        return self::$idMap[$leerlingid];
    }

    public function getLeerlingid() {
        return $this->leerlingid;
    }

    public function getVoornaam() {
        return $this->voornaam;
    }

    public function getFamilienaam() {
        return $this->familienaam;
    }

    public function getGeboortedatum() {
        return $this->geboortedatum;
    }
    
    public function getFoto(){
        return $this->foto;
    }

    public function getStraat() {
        return $this->straat;
    }

    public function getHuisnr() {
        return $this->huisnr;
    }

    public function getBus() {
        return $this->bus;
    }

    public function getPostcode() {
        return $this->postcode;
    }

    public function getTelefoonnr() {
        return $this->telefoonnr;
    }

    public function getKlasid() {
        return $this->klasid;
    }

    public function getVoornaamouder1() {
        return $this->voornaamouder1;
    }

    public function getFamilienaamouder1() {
        return $this->familienaamouder1;
    }

    public function getVoornaamouder2() {
        return $this->voornaamouder2;
    }

    public function getFamilienaamouder2() {
        return $this->familienaamouder2;
    }

    public function getGSMouder1() {
        return $this->GSMouder1;
    }

    public function getGSMouder2() {
        return $this->GSMouder2;
    }

    public function getEmailadres() {
        return $this->emailadres;
    }

    public function getWachtwoord() {
        return $this->wachtwoord;
    }

    public function setVoornaam($voornaam) {
        $this->voornaam = $voornaam;
    }

    public function setFamilienaam($familienaam) {
        $this->familienaam = $familienaam;
    }

    public function setGeboortedatum($geboortedatum) {
        $this->geboortedatum = $geboortedatum;
    }
    
    public function setFoto($foto){
        $this->foto = $foto;
    }

    public function setStraat($straat) {
        $this->straat = $straat;
    }

    public function setHuisnr($huisnr) {
        $this->huisnr = $huisnr;
    }

    public function setBus($bus) {
        $this->bus = $bus;
    }

    public function setPostcode($postcode) {
        $this->postcode = $postcode;
    }

    public function setTelefoonnr($telefoonnr) {
        $this->telefoonnr = $telefoonnr;
    }

    public function setKlasid($klasid) {
        $this->klasid = $klasid;
    }

    public function setVoornaamouder1($voornaamouder1) {
        $this->voornaamouder1 = $voornaamouder1;
    }

    public function setFamilienaamouder1($familienaamouder1) {
        $this->familienaamouder1 = $familienaamouder1;
    }

    public function setVoornaamouder2($voornaamouder2) {
        $this->voornaamouder2 = $voornaamouder2;
    }

    public function setFamilienaamouder2($familienaamouder2) {
        $this->familienaamouder2 = $familienaamouder2;
    }

    public function setGSMouder1($GSMouder1) {
        $this->GSMouder1 = $GSMouder1;
    }

    public function setGSMouder2($GSMouder2) {
        $this->GSMouder2 = $GSMouder2;
    }
    
    public function setEmailadres($Emailadres){
        $this->emailadres = $Emailadres;
    }

    public function setWachtwoord($wachtwoord) {
        $this->wachtwoord = $wachtwoord;
    }

}
