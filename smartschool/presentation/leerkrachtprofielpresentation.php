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
  
        <title>Smartschool > Leerkracht profiel</title>

        <link rel="stylesheet" href="css/style.css" media="screen">
        <!--hier al een shiv gebruiken voor html5 en wat met normalize.css?-->
    </head>
    <body>
        <section class="wikkel">
            <header>
                <h1><span class="hoofding">Smart School</span></h1>
                <nav>
                    <h4>Menu</h4><img id="MenuIcon" src="images/menuIcon.png" alt="menuIcon.png"/>
                    <ul>
                        <!--leraar-->
                        <li><a href="aanwezigheden.php">Aanwezigheden<img id="AanwezigheidIcon" src="images/aanwezigheidIcon.png" alt="aanwezigheidIcon.png" /></a></li>
                        <li><a class="actief" href="klaslijst.php">leerlingen<img id="LeerlingIcon" src="images/leerlingIcon.png" alt="leerlingIcon.png" /></a>
                            <ul>
                                <li><a class="actief" href="klaslijst.php">Klaslijst</a></li>
                                <li><a  href="leerlingaanmelden.php">Leerlingen toevoegen</a></li>
                            </ul>
                        </li>
                        <li><a  href="default.html">agenda<img src="images/agendaIcon.png" alt="agendaIcon.png" /></a></li>
                        <li><a class="uitlog" href="klaslijst.php?log=logout">uitloggen<img id="closeIcon" src="images/closeIcon.png" alt="UitlogIcon.png"/></a></li>
                    </ul>
                </nav>

            </header>
            <section>
                <article class="bgKlaslijst">
                    <!--hier komt de inhoud-->   
                    
                    <div class="klaslijst"><!--omvatende div die de klaslijst heeft als inhoud-->
                        <div class="passpoort"><!--repeterende div die voor iedere leerling van de klas herhaald wordt-->
                            <img src="<?php echo $leerkracht->getFoto(); ?>" alt="default" style="width:100px;height:100px"><br/>
                            <b>Voornaam</b>: <?php echo " ",$leerkracht->getVoornaam(); ?><br/>
                            Familienaam: <?php echo " ",$leerkracht->getFamilienaam(); ?><br/>
                            Geboortedatum: <?php echo " ",$leerkracht->getGeboortedatum(); ?><br/>
                            
                        </div><!--einde reeterende div-->
                    </div><!--einde omvatende div-->
                </article>
            </section>
            <section class="Uitloggen">
                <a href="klaslijst.php?log=logout">uitloggen</a>
            </section>
        </section>   
    </body>
</html>
