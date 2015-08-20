<?php
require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/gemeenteservice.php");

$leerlingsvc= new leerlingservice();

$leerling= $leerlingsvc->getleerlingbyid(6);

print_r($leerling);
echo "<br/><br/><br/>";

?>
<!--repeterende div die voor iedere leerling van de klas herhaald wordt-->
                    <div class="passpoort">
                        <img src="<?php echo $leerling->getFoto();?>" alt="leerling" style="width:100px;height:100px"><br/>
                        <b>Voornaam</b>: <?php echo " ", $leerling->getVoornaam(); ?><br/>
                        <b>Familienaam</b>: <?php echo " ", $leerling->getFamilienaam(); ?><br/>
                        <b>Geboortedatum</b>: <?php echo " ", $leerling->getGeboortedatum(); ?><br/>
                        <a  class="drama bgBewDel" target=_blank href="generate-pdf.php?voornaam=<?php echo $leerling->getVoornaam();?>&familienaam=<?php echo $leerling->getFamilienaam();?>&trimister=1">Rapport</a>
                        <span>&nbsp;</span>
                        <a  class="drama bgBewDel bgBewDelRechts" href="leerlingprofiel.php?update=yes&leerlingid=<?php echo $leerling->getLeerlingid(); ?>">update</a>
<!--einde repeterende div-->                 
                    </div>
<?php
$filename=$leerling->getFoto();
print_r($filename);
echo '<br/>';
$ramp=file_exists($filename);
if($ramp){
    echo 'file beschikbaar';
}  else {
    echo 'geen file';
}
//unlink($filename);

