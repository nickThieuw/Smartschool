<?php
require_once ("business/leerkrachtservice.php");
require_once ("business/leerlingservice.php");
require_once ("business/gemeenteservice.php");
    $leerlingsvc = new leerlingservice();
    $gemeentesvc = new gemeenteservice();
$id = 4;

$leerling = $leerlingsvc->getleerlingbyid($id);

include ('presentation/leerlingOudersdetailPresentation.php');

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];