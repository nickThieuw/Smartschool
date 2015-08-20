<?php
require_once ("data/klasDAO.php");
class klasservice{
    
    public function addKlas($klas_naam){
        $exist = $this->checkexist($klas_naam);
        if($exist!=true){
            $klasDAO = new klasDAO();
            $klasDAO->addKlas($klas_naam);
            $succes = true;
        }else{
            $succes = false;
        }
        return $succes;
    }
    
    public function getklas($klasid){
        $klasDAO = new klasDAO();
        $klas = $klasDAO->getklas($klasid);
        return $klas;
    }
    
    public function klasByNaam($klas_naam){
        $klasDAO = new klasDAO();
        $klas = $klasDAO->getklasBynaam($klas_naam);
        return $klas;
    }
    
    public function checkexist($klas_naam){
        $control = $this->klasByNaam($klas_naam);
        if($control->getKlasid()!=0){
            $exist = true;
        }else{
            $exist = false;
        }
        return $exist;
    }
    
    public function getklassenlijst(){
        $klasDAO = new klasDAO();
        $klassenlijst=$klasDAO->getklassenlijst();
        return $klassenlijst;
    }
    
    public function getklasnaam($klasid){
        $klasDAO = new klasDAO();
        $naamklas = $klasDAO->getklasnaam($klasid);
        return $naamklas;
    }
    
    public function getklasid ($klasnaam){
        $klasDAO = new klasDAO();
        $klasid = $klasDAO->getklasid($klasnaam);
        return $klasid;
    }
}

