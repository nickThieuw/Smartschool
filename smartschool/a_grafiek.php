<?php
//test url voor in de browser: localhost/smartschool/smartschool/leerlingDetail.php?leerlingid=8

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
require_once ('data/DBconfig.php');

require_once ("business/leerlingservice.php");
require_once 'business/pdf_en_grafiekservice.php';

if(isset($_GET['leerlingid'])){
    $id=$_GET['leerlingid'];
}else{
    $id=1;
}

    $date1 = new DateTime();
            $maand = $date1->format("m");
            if ($maand >= 9) {
                $trimister = 1;
            } else {
                if ($maand <= 4) {
                    $trimister = 2;
                } else{
                    $trimister = 3;
                }
            }


$leerlingsvc = new leerlingservice();
$leerlingobj = $leerlingsvc->getleerlingbyid($id);

//VARIABELEN
$klas = $leerlingobj->getKlasid();
$vnaam = $leerlingobj->getVoornaam();
$fnaam = $leerlingobj->getFamilienaam();

$klasgemiddelde=array();
$leerling=array();

//SERVICELAAG
$grafiekServ= new Pdf_en_GrafiekService();
$leerling = $grafiekServ->maakPuntenLeerling($trimister, $id);
$klasgemiddelde = $grafiekServ->maakKlasgemiddelde($trimister, $klas);

// Create the graph -- these two calls are required 
$graph = new Graph(650, 450);
$graph->SetScale("textlin");

/////////////////////////////////////////IF LEERLING || KLASGEMIDDELDE IS EMPTY
/////////////////////////////////////////MAAK ZELF ARRAYS

if(empty($leerling)||empty($klasgemiddelde)){
    
    //punten leerling
    
    $leerling=array("WIS"=>95,
    "GES"=>45,
    "AAR"=>75,
    "NED"=>69,
    "LO"=>76);
    
    $klasgemiddelde=array("WIS"=>81,
    "GES"=>63,
    "AAR"=>70,
    "NED"=>73,
    "LO"=>65);
        
    $txt = new Text();
    $txt->SetFont(FF_ARIAL,FS_NORMAL,25);
    $txt->SetColor('gray');
    $txt->Set(" VOORBEELDGRAFIEK");
    $txt->SetParagraphAlign('left');
    $txt->SetPos(0.56,0.65,'right');
    $txt->SetBox('black');
    $graph->Add($txt);
    
   
}

//TOTAAL KLASGEMIDDELDE EN TOTAAL GEMIDDELDE LEERLING BEREKENEN
$counter=0;
$totaal=0;
foreach ($klasgemiddelde as $key => $value) {
    $totaal+=$value;
    $counter++;
}
$klasgemid=round(($totaal/$counter),1)."%";

$counter2=0;
$totaal2=0;
foreach ($leerling as $value) {
    $totaal2+=$value;
    $counter2++;
}
$gemiddeldeLeerling=round(($totaal2/$counter2),1)."%";

//ARRAYS VOOR DE GRAFIEK
$datax = array();
$data1y = array();
$data2y = array();

//KONTROLE VAN ARRAY, ALS EEN LEERLING GEEN PUNTEN HEEFT VOOR EEN VAK KRIJGT HIJ
//EEN NUL VOOR DAT VAK ENKEL OM DE GRAFIEK TE LATEN KLOPPEN
foreach (array_diff_key($klasgemiddelde, $leerling) as $key => $value) {
    $leerling[$key] = 0;
}
ksort($klasgemiddelde);
ksort($leerling);

foreach ($klasgemiddelde as $key => $value) {
    array_push($datax, $key);
    array_push($data1y, $value);
}
foreach ($leerling as $value) {
    array_push($data2y, $value);
}



//$graph->SetShadow();
$graph->img->SetMargin(50,50,50,90);

//setFonts
$graph->title->SetFont(FF_VERDANA, FS_NORMAL, 10);
$graph->xaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
$graph->yaxis->SetFont(FF_VERDANA, FS_NORMAL, 10);
$graph->yaxis->title->SetFont(FF_VERDANA, FS_NORMAL, 10);
$graph->xaxis->title->SetFont(FF_VERDANA, FS_NORMAL, 10);
 
         

//nog set Font doen
$graph->title->Set($vnaam." ".$fnaam);
$graph->xaxis->title->Set("VAKKEN");
$graph->yaxis->title->Set("PROCENT");

//add txt if fake grafiek


// Show 0 label on Y-axis (default is not to show)
$graph->yscale->ticks->SupressZeroLabel(false);

// Setup X-axis labels
$graph->xaxis->SetTickLabels($datax);

// Create the bar plots
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("orange");
$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("blue");

//procentjes
$b1plot->value->Show();
$b1plot->value->SetFont(FF_ARIAL, FS_BOLD, 10);
$b1plot->value->SetAngle(45);
$b1plot->value->SetFormat('%0.1f');
$b2plot->value->Show();
$b2plot->value->SetFont(FF_ARIAL, FS_BOLD, 10);
$b2plot->value->SetAngle(45);
$b2plot->value->SetFormat('%0.1f');



//legende
$b1plot->SetLegend("klasgemiddelde: ".$klasgemid);
$b2plot->SetLegend("leerling: ".$gemiddeldeLeerling);
$graph->legend->Pos(0.65,0.90,"right","center");

// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot, $b2plot));


// ...and add it to the graPH
$graph->Add($gbplot);

// .. and finally stroke the image back to browser
$graph->Stroke();


?>