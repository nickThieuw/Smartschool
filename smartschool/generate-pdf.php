<?php

require('mysql_table.php');
require_once ('data/DBconfig.php');
require_once ('business/pdf_en_grafiekservice.php');
require_once ("business/leerlingservice.php");

 if (isset($_GET['id']) && !empty(trim($_GET['id']))) {
    $id = trim($_GET['id']);
} 
 
if (isset($_GET['trimister']) && !empty(trim($_GET['trimister']))) {
    $trim = trim($_GET['trimister']);
} 

class PDF extends PDF_MySQL_Table {

    function Header() {
        //Title
        $this->SetFont('times', 'I', 20);
        $this->Image($link = 'images/header.png');
    
        $this->Ln(12);
        //Ensure table header is output
        parent::Header();
    }
}

//connectie met database
mysql_connect(DBconfig::$DB_HOST, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD);
mysql_select_db(DBconfig::$DB_NAME);

//pdfService
$pdfServ= new Pdf_en_GrafiekService();
$pdfServ->createViewProcent();

//sql om gegevens in de pdf te krijgen van een leerling
$query = "SELECT naamklas, voornaam, familienaam, geboortedatum FROM leerling"
        . " inner join klas on leerling.klasid=klas.klasid where"
        . " leerlingID='".$id."'";

//sql voor het opvragen van gegevens van een tabel in de database
$q = "SELECT distinct vaknaam, percentage  FROM  procent2 inner join basistabel "
        ."on procent2.leerlingID=basistabel.leerlingID "
        ."and procent2.vakID=basistabel.vakID "
        ."where procent2.trimister='$trim' "
        ."and procent2.leerlingID='".$id."'"
        ." order by procent2.vakID";

//HAAL INFO VAN DE LEERLING
$leerlingsvc = new leerlingservice();
$leerlingobj = $leerlingsvc->getleerlingbyid($id);

//VARIABELEN
$klas = $leerlingobj->getKlasid();
$vnaam = $leerlingobj->getVoornaam();
$fnaam = $leerlingobj->getFamilienaam();
//mysql_query($q)
$resultG = mysql_query($q);

//gemiddelde punten berekenen
$total = 0;
$counter = 0;
while ($row = mysql_fetch_array($resultG, MYSQL_ASSOC)) {
    $total = $total + $row['percentage'];
    $counter++;
}
//terug naar klaslijst als punten leeg zijn
if($counter!=0){
    
$gemiddelde = round(($total / $counter),1)."%";

//pdfService
$klasgemiddelde=$pdfServ->berekenKlasgemiddelde($trim, $klas);

//nieuwe pdf
$pdf = new PDF();

//nieuwe pagina
$pdf->AddPage();

$pdf->Cell(0, 10, "Rapport ".$trim, 1, 1, "C");
$pdf->Cell(0, 10, " ", 0, 1, "C");

//kleuren
$prop = array('HeaderColor' => array(255, 150, 100),
    'color1' => array(210, 245, 255),
    'color2' => array(255, 255, 210),
    'padding' => 2);

//aanmaken van 2 kolommen
$pdf->AddCol('naamklas', 45, 'Klas', 'C');
$pdf->AddCol('voornaam', 45, 'Voornaam', 'C');
$pdf->AddCol('familienaam', 45, 'Familienaam', 'C');
$pdf->AddCol('geboortedatum', 45, 'Geboortedatum', 'C');


$pdf->Table($query, $prop);
$pdf->Cell(0, 10, " ", 0, 1, "C");

$pdf->SetFont('times', 'I', 20);
$pdf->Cell(0, 10, "Vakken ", 1, 1, "C");
$pdf->Cell(0, 10, " ", 0, 1, "C");

//aanmaken van 2 kolommen
$pdf->AddCol('vaknaam', 120, 'Vak', 'C');
$pdf->AddCol('percentage', 60, 'Procent', 'C');

//Zet de tabel van punten op pdf;
$pdf->Table($q, $prop);

//pdfService
$pdfServ->deleteViewProcent();

//gemiddelde
$pdf->SetFont('times', 'I', 20);
$pdf->Cell(0, 10, " ", 0, 1, "C");
$pdf->Cell(0, 10, "Resultaat", 1, 1, "C");
$pdf->Ln();
//$pdf->Ln();
$pdf->SetLeftMargin(140);
$pdf->SetRightMargin(15); //origneel 160

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('courier', '', 14);
$pdf->Cell(0, 10, "Uw score:", 0, 1, "C");

$pdf->SetTextColor(255, 150, 100);
$pdf->SetFont('courier', 'B', 16);
$pdf->Cell(0, 10, $gemiddelde, 1, 1, "C");

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('courier', '', 14);
$pdf->Cell(0, 10, "Klasgemiddelde:", 0, 1, "C");

$pdf->SetTextColor(255, 150, 100);
$pdf->SetFont('courier', 'B', 16);
$pdf->Cell(0, 10, $klasgemiddelde, 1, 1, "C");

//naam download-file
$downloadfilename = $vnaam . "_" . $fnaam . "_" . $trim;

//output in de url en in de titel van de pagina
$pdf->Output($downloadfilename . ".pdf","I");
header('Location: ' . $downloadfilename . ".pdf");
}else{
    //pdfService
    $pdfServ->deleteViewProcent();
    header('Location: klaslijst.php');
}

?>
