<!DOCTYPE html>
<html ng-app="SmartschoolAngCode">
    <head>
        <!-- al de meta tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- De CSS files die gebruikt worden--> 
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <!-- al de javascript files die gebruikt worden-->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
        <script src="http://code.angularjs.org/1.3.9/i18n/angular-locale_nl-be.js"></script>
        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.js"></script>
        <script src="js/app.js"></script>  
        
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        

        
        <script>
            $('#nav').affix({
            });
        </script>
        <title>Smartschool > admin overgang</title>
    </head>
  <body>
<!-- Hier volgt de code voor de imageslider bovenaan de webpagina-->
<!-- Dit is de hoofdmenu van de webpagina, hier zit ook de hoofdtitel van de webpagina-->
            <header>


                <nav  data-spy="affix" data-offset-top="50" id="nav"  class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="nav-brand"><h1>Smartschool</h1></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div  class="collapse navbar-collapse head" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="navbar-nav" style="box-shadow: rgba(6, 57, 106, 0) 0px 1px 5px 0px;">
                            <li style="margin-top: 20px; " class=" dropdown">
                                <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                    Leerkrachten
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="leerkrachtlijst.php" >Leerkrachtenlijst</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="leerkrachtaanmelden.php">Leerkracht toevoegen</a></li>
                                </ul>
                            </li>
                            <li style="margin-top: 20px;"><a  href="klassenlijst.php">Klassen</a></li>
 <li style="margin-top: 20px;"><a  href="agenda.php">Agenda</a></li>
                            <li class="active" style="margin-top: 20px;"><a  href="overgang.php">Overgang</a></li>


                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li style="margin-top: 20px; margin-right: 10px;"><a href="leerkrachtaanmelden.php?log=logout"> Uitloggen</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </header>  
<!-- De uitlogknop-->
           
<!-- De form die de aanwezigheden opvangt en doorgeeft aan de database-->
<section class="OnderWeb">
<h2>Overgang voor volgend schooljaar</h2>
            <!--start items om info te tonen omtrent overgang-->
                <!--start table overzicht-->
                <div class="table-responsive">
                <table class="table table-hover">
                    <th> &nbsp; klas &nbsp; </th>
                    <th> &nbsp; Nieuw klas &nbsp; </th>
                    <th> &nbsp; Uitgevoerd &nbsp; </th>
                    <th> &nbsp; geslaagden &nbsp; </th>
                    <th> &nbsp; totaal leerlingen &nbsp; </th>
                        <?php
                        for($y=0;$y<$totrows;$y++){
                            echo '<tr>';
                            echo '<td>';
                            echo $klasnamenArr[$y];
                            echo '</td>';
                            echo '<td>';
                            echo $nieuwklasnamenArr[$y];
                            echo '</td>';
                            echo '<td>';
                            echo $foundklasoverArr[$y];
                            echo '</td>';
                            echo '<td>';
                            echo $geslaagdenArr[$y];
                            echo '</td>';
                            echo '<td>';
                            echo $totleerlingenklasArr[$y];
                            echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
                </div>
                <!--Einde table overzicht-->
                <br/>
                <?php 
                if($show == true){
                ?>
                <p>Alle Leerkrachten volbrachten hun taak!</p>
                <?php 
                }else{
                ?>
                <p>Er zijn Leerkrachten die hun taak nog niet volbracht hebben!</p>
                <?php 
                //$leerkrachtsvc->validationcontrol(5);
                $leerkrachtsvc->getadmin();
                }
                ?>
                <br/>
                <!--start van het formulier-->
                <form class="form-horizontal Verwerken" method="POST" action="overgang.php?Code=Send" role="form" name="codeForm">
                    <label for="code">Validatie Code : </label><input type="text" name="code" id="code" value="" required/>
                    <input class="btn btn-success btn-sm btnVormgeving" type="submit" value="Voltooien"/> 
                </form>
                <!--einde van frormulier-->
            <!--einde items om overgang te regelen-->
            </section>
<!-- Einde beide sections-->

        <script type="text/javascript" charset="utf-8">
            $(function() {
                $('body').hide().show();
            });
        </script>
  </body>
</html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

