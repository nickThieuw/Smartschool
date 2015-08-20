<?php 
session_start();

require_once 'business/BerichtenService.php';
require_once 'business/leerkrachtservice.php';
require_once 'business/leerlingservice.php';
require_once 'entities/leerling.php';
require_once 'entities/leerkracht.php';

if(isset($_SESSION['rechten'])){    
unset($_SESSION['verzonden']);
    
//ik heb zijn id nodig en zijn status
$berichtenS = new BerichtenService();

//from en status
$from = $_SESSION['fromId'];
$status = $_SESSION['fromStatus'];

//from en status steken we in toId en toStatus om alle berichten te krijgen
$bGegevens = $berichtenS->getAlleBerichtGegvens($from, $status);

include 'presentation/presBerichtenzien.php';

}else{
    header('location: home.php');
    exit(0);
}
?>