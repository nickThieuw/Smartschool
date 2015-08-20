<?php
session_start();
require_once 'entities/leerling.php';

 $_SESSION["return_url"]="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

 if (isset($_SESSION["gebruiker"])){
                        $leerl=$_SESSION["gebruiker"];
                        $origineelLeerling =  unserialize($leerl);        
                        $leerlingId = $origineelLeerling->getLeerlingId();
 
 }else{
     header('location: home.php');
     exit(0);
 }
 
 include 'presentation/puntenOuders.php';