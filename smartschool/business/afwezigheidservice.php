<?php

require_once ("data/afwezigheidDAO.php");

class afwezigheidservice {

    public function voegNieuwAfwezigheidToe($leerlingid, $datum) {
        $afwezigheidDAO = new afwezigheidDAO();
        return $afwezigheidDAO->create("", $leerlingid, $datum);
    }

    public function getaanwezigheid() {
        $afwezigheidDAO = new afwezigheidDAO();
        $datetime = new DateTime();
        $date = $datetime->format('Y-m-d H');
        $hour = $datetime->format('H');
        if ($hour < 12) {
            $date=$datetime->setTime(0, 0, 0);
            $date1=$datetime->format('Y-m-d H');
            $datetime->setTime(12, 0, 0);
            $date2=$datetime->format('Y-m-d H');
            return $afwezigheidDAO->getaanwezigheidvoorm($date1,$date2);
        } else {
            $date=$datetime->setTime(12, 0, 0);
            $date1 = $datetime->format('Y-m-d H');
            $datetime->setTime(23, 59, 29);
            $date2 = $datetime->format('Y-m-d H');
            return $afwezigheidDAO->getaanwezigheidnam($date1,$date2);
        }
    }
    
    public function deleteAfwezigheid($leerlingid){
        $afwezigheidDAO = new afwezigheidDAO();
        $datetime = new DateTime();
        $date = $datetime->format('Y-m-d H');
        $hour = $datetime->format('H');
        if ($hour < 12) {
            $date=$datetime->setTime(0, 0, 0);
            $date1=$datetime->format('Y-m-d H');
            $datetime->setTime(12, 0, 0);
            $date2=$datetime->format('Y-m-d H');
            $afwezigheidDAO->deleteAfwezigheidvoorm($leerlingid,$date1,$date2);
        } else {
            $date=$datetime->setTime(12, 0, 0);
            $date1 = $datetime->format('Y-m-d H');
            $datetime->setTime(23, 59, 29);
            $date2 = $datetime->format('Y-m-d H');
            $afwezigheidDAO->deleteAfwezigheidnam($leerlingid,$date1,$date2);
        }
    }
    
    public function removeafwezigheden(){
        $afwezigheidDAO = new afwezigheidDAO();
        $afwezigheidDAO->removeafwezigheden();    
    }
    
    public function boolgetafwezigheidleerlingiddate($datum,$leerlingid){
        $afwezighedenDAO = new afwezigheidDAO();
        $result = $afwezighedenDAO->boolgetafwezigheidleerlingiddate($datum, $leerlingid);
        return $result;
    }
}
