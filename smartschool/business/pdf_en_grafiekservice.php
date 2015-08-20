<?php
require_once 'data/pdf_en_grafiekDAO.php';

class Pdf_en_GrafiekService {
////////////////////////////////GRAFIEK/////////////////////////////////////////
    public function maakPuntenLeerling($trim, $id){
        $leerling=array();
        $puntenleerling=array();
        $grafiekDAO = new Pdf_en_grafiekDAO();
        $grafiekDAO->createViewProcenttabel();
        $puntenLeerling = $grafiekDAO->selectPercentageLeerling($trim, $id);
        if ($puntenLeerling) {
             foreach ($puntenLeerling as $row) {                
                //max 3 letters substring en uppercase
                $leerling[strtoupper(substr($row["vaknaam"], 0, 3))] = $row["percentage"];
            }
        }
        $grafiekDAO->dropViewProcenttabel();
        return $leerling;
    }

    public function maakKlasgemiddelde($trim, $klas){
        $klasgemiddelde=array();
        $klasgemiddelden=array();
        $grafiekDAO = new Pdf_en_grafiekDAO();
        $grafiekDAO->createViewProcenttabel();
        $grafiekDAO->createViewKlasgemiddelde($trim, $klas);
        $klasgemiddelde = $grafiekDAO->selectKlasgemiddelde();
        if ($klasgemiddelde) {
                foreach ($klasgemiddelde as $row) {
            //max 3 letters substring en uppercase
            $klasgemiddelden[strtoupper(substr($row["vaknaam"], 0, 3))] = $row["klasgemiddelde"];
            }
         }
        $grafiekDAO->dropViewProcenttabel();
        $grafiekDAO->dropViewKlasgemiddelde();
        return $klasgemiddelden;
    }
 //////////////////////////////PDF//////////////////////////////////////////////   
    public function createViewProcent() {
        $pdfDAO= new Pdf_en_grafiekDAO();
        $pdfDAO->createViewProcenttabel();
    }
    public function deleteViewProcent(){
        $pdfDAO= new Pdf_en_grafiekDAO();
        $pdfDAO->dropViewProcenttabel();
    }
    public function berekenKlasgemiddelde($trim, $klas){
        //op dit moment is de view Procent2 al aangemaakt door de PDF-creator
        //dit komt doordat de PDF-generator werkt met sql
        $pdfDAO = new Pdf_en_grafiekDAO(); 
        $pdfDAO->createViewKlasgemiddelde($trim, $klas);
        $klasgemiddelde = $pdfDAO->selectKlasgemiddelde();
        $count=0;
        $tot=0;
        if ($klasgemiddelde) {
                foreach ($klasgemiddelde as $row) {
                    $tot=$tot+$row['klasgemiddelde'];
                    $count++;
            }
         }
         $pdfDAO->dropViewKlasgemiddelde();
         return round(($tot/$count),1)."%";
    }
    
}