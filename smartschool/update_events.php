<?php
session_start();

require_once("business/leerkrachtservice.php");
require_once("business/evenementservice.php");

$evenementservice = new evenementservice();
$leerkrachtsvc = new leerkrachtservice();
if (isset($_GET["log"]) && $_GET["log"] == "logout" && isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] &&
        isset($_SESSION["rechten"]) && $_SESSION["rechten"] == "leerkracht_level") {
    session_destroy();
}

if (isset($_SESSION["aangemeld"]) && $_SESSION["aangemeld"] && isset($_SESSION["rechten"]) &&
        $_SESSION["rechten"] == "leerkracht_level" && !isset($_GET["log"])) {
        $leerkacht = unserialize($_SESSION["gebruiker"]);
        //initialiseer alle services
        $klasid = $leerkacht->getKlasid(); //haalt klasid op om toegang tot andere klassen te vermijden
        $id=$_POST['id'];
        $title = $_POST['title'];
        if(isset($_POST['info'])){
            $info = $_POST['info'];
        }else{
            $info="";
        }
        $start = $_POST['start'];
        $end = $_POST['end'];

        $evenementservice->UpdateEvenement($id, $title, $info, $start, $end, $klasid);
        header("location:agenda.php");
        exit(0);
        }
    //header("location: home.php");
    //exit(0);
