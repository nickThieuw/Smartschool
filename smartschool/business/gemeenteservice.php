<?php
require_once ("data/gemeenteDAO.php");
class gemeenteservice{
    public function getGemeente($postcode,$gemeente){
        $gemeenteDAO= new gemeenteDAO();
        $gemeente=  strtoupper($gemeente);
        $gemeente= $gemeenteDAO->getGemeente($postcode,$gemeente);
        return $gemeente;
    }
    public function addGemeente($postcode,$gemeente){
        $gemeenteDAO= new gemeenteDAO();
        $gemeenteupper= strtoupper($gemeente);
        $bestaand= $this->getGemeente($postcode, $gemeenteupper);
        if($gemeente=="" && $postcode==""){
            //geen waardes ingevuld
        }else{
            if($bestaand->getGemeente_id()==0){
                $gemeenteDAO->addGemeente($postcode,$gemeente,$gemeenteupper);
            }else{
                //als gemeente bestaat
            }
        }
        
    }
    public function getGemeenteById($postcode_id){
        $gemeenteDAO= new gemeenteDAO();
        $gemeente= $gemeenteDAO->getGemeenteById($postcode_id);
        return $gemeente;
    }
}

