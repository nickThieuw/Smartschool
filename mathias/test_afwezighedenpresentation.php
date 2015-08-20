<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">

        <title>Smartschool</title>

        <link rel="stylesheet" href="css/style.css" media="screen">
        <!--hier al een shiv gebruiken voor html5 en wat met normalize.css?-->
    </head>
    <body>
        <section class="wikkel">
            <header>
                <h1><span class="hoofding">Smart School</span></h1>

                <nav class="hoofdmenu">
                    <ul>
                        <!--leraar-->
                        <li><a href="">opvolging</a></li>
                        <li class="actief"><a href="">leerlingen</a></li>
                        <li><a href="">agenda</a></li>
                        <!--ouders-->
                        <li><a href="">gegevens</a></li>                     
                        <li><a href="">links</a></li>
                    </ul>
                </nav>
            </header>
            <img class="verfvlek" src="images/verfvlek.png" alt="verfvlek" />
            <section>
                <article class="bgKlaslijst">
                    <!--hier komt de inhoud--> 
                    <form method="post" action="aanwezigheden.php?action=afw" id="inlogform">
                        <div class="klaslijst"><!--omvatende div die de klaslijst heeft als inhoud-->
                            <?php foreach ($klaslijst as $leerling) { ?>

                                <div class="passpoort"><!--repeterende div die voor iedere leerling van de klas herhaald wordt-->
                                    <img src="Foto_leerling/defaul_foto.png" alt="default" style="width:100px;height:100px"><br/>
                                    <b>Voornaam</b>: <?php echo " ", $leerling->getVoornaam(); ?><br/>
                                    Familienaam: <?php echo " ", $leerling->getFamilienaam(); ?><br/>
                                    Geboortedatum: <?php echo " ", $leerling->getGeboortedatum(); ?><br/>
                                    <label id="afwezig">afwezig</label>
                                    <?php print($leerling->getLeerlingid());?>
                                    <input type="checkbox" name="afwezig<?php echo $leerling->getLeerlingid()?>" value="<?php echo $leerling->getLeerlingid()?>" id="afwezig"/>
                                </div><!--einde reeterende div-->

                            <?php } ?>
                        </div><!--einde omvatende div-->
                        <input type="submit" value="afwezigheden doorgeven"/>
                    </form>
                </article>
            </section>
            <section class="Uitloggen">
                <a href="aanwezigheden.php?log=logout">uitloggen</a>
            </section>
        </section>   
        <footer>
            <blockquote>Created by <a href="#">Niels</a>, <a href="#">Mathias</a>, <a href="#">Kevin</a> en <a href="#">Nick</a></blockquote>
        </footer>
    </body>
</html>

