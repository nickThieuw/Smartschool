<?php

// content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');
require_once ('DBconfig.php');
//if(isset($_POST["voornaam"])){
//        //$vnaam=$_POST["voornaam"];
//            
//    
//}
//if(isset($_POST["familienaam"])){
//        //$fnaam=$_POST["familienaam"];
//}
//if(isset($_POST["trimister"])){
//        $trim=$_POST["trimister"];
//}    
//if(isset($_POST["klas"])){
//        $klas=$_POST["klas"];
//}
$vnaam="never";
$fnaam="debakker";
$trim=1;
$klas=1;

$klasgemiddelde=array();
$leerling=array();
mysql_connect(DBconfig::$DB_HOST, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD)
        or die('Could not connect: ' . mysql_error());
mysql_select_db(DBconfig::$DB_NAME)or die('Could not select database');

//op hans debakker en trimester 1 kan je testen
//SQL-opdrachten
mysql_connect(DBconfig::$DB_HOST, DBconfig::$DB_USERNAME, DBconfig::$DB_PASSWORD)
        or die('Could not connect: ' . mysql_error());
mysql_select_db(DBconfig::$DB_NAME)or die('Could not select database');

//nieuwe procenttabel
$sqlA="create view procent2 as select trimister, leerlingID, vakid, ((sum(punten)/sum(puntentotaal))*100)
        as percentage, klasidvak from basistabel
        where klasidleerling = klasidvak
        group by trimister, leerlingID, vakid, klasidvak";
$sqlB="drop view procent2";

//opdrachten
$sql1 = "create view klasgemiddelde_per_vak as SELECT vakid, sum(percentage)/count(percentage)
         as klasgemiddelde  FROM  procent2 where trimister='$trim' and klasidvak='$klas' group by vakid";
$sql2 = "SELECT vaknaam, klasgemiddelde FROM klasgemiddelde_per_vak inner join vak
            on klasgemiddelde_per_vak.vakid=vak.vakid order by vaknaam";
$sql3 = "drop view klasgemiddelde_per_vak";
$sql4 = "SELECT distinct vaknaam, percentage  FROM  procent2 inner join basistabel
        on procent2.leerlingID=basistabel.leerlingID
        and procent2.vakID=basistabel.vakID 
        where procent2.trimister='$trim'
        and voornaam like '$vnaam' and familienaam like '$fnaam'
        order by procent2.vakID";

//create view procent2
$resultA= mysql_query($sqlA) or die('Query failed A; '.mysql_error());

//create view klasgemiddelde per vak
$result1 = mysql_query($sql1) or die('Query failed 1; ' . mysql_error());

//haal de gegevens van klasgemiddelde
$result2 = mysql_query($sql2) or die('Query failed 2; ' . mysql_error());
if ($result2) {
    while ($row = mysql_fetch_assoc($result2)) {
        //max 3 letters substring en uppercase
        $klasgemiddelde[strtoupper(substr($row["vaknaam"], 0, 3))] = $row["klasgemiddelde"];
    }
}
//drop view
$result3 = mysql_query($sql3) or die('Query failed 3; ' . mysql_error());

//uitvoer punten van de leerling
$result4 = mysql_query($sql4) or die('Query failed 4; ' . mysql_error());
if ($result4) {
    while ($row2 = mysql_fetch_assoc($result4)) {
        //max 3 letters substring en uppercase
        $leerling[strtoupper(substr($row2["vaknaam"], 0, 3))] = $row2["percentage"];
    }
}
//drop view
$resultB= mysql_query($sqlB) or die('Query failed B; '.mysql_error());

//gemiddeldes totaal berekenen
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

//arrays afleiden voor de grafiek
$datax = array();
//$datay= array(0,10,20,30,40,50,60,70,80,90,100);
$data1y = array();
$data2y = array();

//kontrole van array, iedere andere key stop ik in leerling met waarde 0
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

// Create the graph -- these two calls are required 
$graph = new Graph(650, 450);
$graph->SetScale("textlin");


$graph->SetShadow();
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
$b1plot->SetLegend("klasgemiddelde: ".$klasgemid."%");
$b2plot->SetLegend("leerling: ".$gemiddeldeLeerling."%");
$graph->legend->Pos(0.65,0.90,"right","center");

// Create the grouped bar plot
$gbplot = new GroupBarPlot(array($b1plot, $b2plot));


// ...and add it to the graPH
$graph->Add($gbplot);

// .. and finally stroke the image back to browser
$graph->Stroke();
//    $gdImgHandler = $graph->Stroke(_IMG_HANDLER);
//    $fileName = "../images/tmp/imagefile.png";
//    $graph->img->Stream($fileName);
//    $graph->img->Headers();
//    $graph->img->Stream();

?>


