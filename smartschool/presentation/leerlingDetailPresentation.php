<!DOCTYPE html>
<html ng-app="SmartschoolAngCode">
    <head>
            <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> <link rel="stylesheet" href="css/style.css" media="screen">
        
<!-- al de javascript files die gebruikt worden-->
    <script>
    $('#nav').affix({
});
    </script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
        <script src="http://code.angularjs.org/1.3.9/i18n/angular-locale_nl-be.js"></script>
        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.js"></script>
        <script src="js/app.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
       
  
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <title>Smartschool > Klaslijst</title>


        <!--hier al een shiv gebruiken voor html5 en wat met normalize.css?-->
    </head>
    <body>
        <section class="wikkel">
<!-- Hier volgt de code voor de imageslider bovenaan de webpagina-->

<!-- Dit is de hoofdmenu van de webpagina, hier zit ook de hoofdtitel van de webpagina-->
        <header>
                <nav data-spy="affix" data-offset-top="50" id="nav"  class="navbar navbar-default navbar-fixed-top" role="navigation">
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
                <li style="margin-top: 20px; " ><a href="aanwezigheden.php">Afwezigheden</a></li>
                <li style="margin-top: 20px; " class="active dropdown">
              <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                Klas informatie <?php echo " ",$klasnaam;?>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="klaslijst.php">Klaslijst</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="leerlingaanmelden.php">Leerling toevoegen</a></li>
              </ul>
            </li>
                <li style="margin-top: 20px;"><a href="agenda.php">Agenda</a></li>
                <li style="margin-top: 20px;" class="dropdown">
              <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                Testen
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation" class="dropdown-header">Testen</li> 
                <li role="presentation"><a role="menuitem" tabindex="-1" href="toetsenpagina.php">Lijst van testen</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="toetsentoevoegen.php">Test toevoegen</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation" class="dropdown-header">Vakken</li> 
                <li role="presentation"><a role="menuitem" tabindex="-1" href="vakkentoevoegen.php">Vak toevoegen</a></li>
              </ul>
              
            </li>
            <li style="margin-top: 20px;"><a href="overgangKlas.php">Overgang</a></li>
              </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li style="margin-top: 20px; margin-right:20px;" class="dropdown">
              <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                  <span class="glyphicon glyphicon-user"></span> Account
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation" class="dropdown-header">Berichten</li> 
                
                <li role="presentation"><a role="menuitem" tabindex="-1" href="berichtenzien.php">Postvak in</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="berichtenverzonden.php">Verzonden</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="Berichttoevoegen.php">Nieuw bericht</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation" class="dropdown-header">Uitloggen</li> 
                <li role="presentation"><a href="klaslijst.php?log=logout"> Uitloggen</a></li>
              </ul>
              
            </li>
          </ul>
                
            </div><!-- /.navbar-collapse -->
          </nav>
        </header>
        <section class="OnderWeb OnderWebDetailLeerkrachten">
            <h2 class="H2Leerkrachten">Gegevens van <?php echo " ",$leerling->getVoornaam(); ?> <?php echo " ",$leerling->getFamilienaam(); ?></h2>
                <div class="row ">
                    <img class=" col-lg-4" style="width: 45%;" src="<?php $foto_path=$leerling->getFoto(); $beschikbaar=file_exists($foto_path); if($beschikbaar){ echo $foto_path; }else{ echo "Foto_leerling/defaul_foto.png"; }?>" alt="default"><br/>
                    <div class="col-lg-6 OnderWebDetailOuders">
<div ng-controller="Collapse">
    <a class="Collapse" ng-click="isCollapsed = !isCollapsed">Grafiek met gescoorde punten <span class="glyphicon glyphicon-plus"></span></a>
        <hr class="Colldivider">
            <div collapse="isCollapsed">
                <a href="a_grafiek.php?leerlingid=<?php echo $leerling->getLeerlingId(); ?>" target="_blank">
                <?php if(isset($_SESSION["voorbeeld"])&& $_SESSION["voorbeeld"]==true) {?>
                <label style="color: #000; position: absolute; left: 10%; top: 72.5%; font-size: 4em;">Voorbeeld</label>
                <?php } ?>
                <img class="img-responsive " style="margin-top: 0.5em; " src="a_grafiek.php?leerlingid=<?php echo $leerling->getLeerlingId(); ?>" />
                </a>
                    <hr class="divider">
            </div>
</div>
<div ng-controller="Collapse">
    <a  class="Collapse" ng-click="isCollapsed = !isCollapsed">Basisgegevens <span class="glyphicon glyphicon-plus"></span></a>
	<hr class="Colldivider">
            <div collapse="isCollapsed">
                Voornaam: <span class="pull-right"><?php echo " ",$leerling->getVoornaam(); ?></span><br/><br/>
                Familienaam: <span class="pull-right"><?php echo " ",$leerling->getFamilienaam(); ?></span><br/><br/>
                Geboortedatum: <span class="pull-right"><?php echo " ",$leerling->getGeboortedatum(); ?></span><br/><br/>
                Telefoonnummer: <span class="pull-right"><?php echo " ",$leerling->getTelefoonnr(); ?></span><br/><br/>
                Email: <span class="pull-right"><a href="mailto:<?php print($leerling->getEmailadres()); ?>"><?php echo " ",$leerling->getEmailadres(); ?></a></span><br/><br/>
                    <hr class="divider">
            </div>
</div>
<div ng-controller="Collapse">
    <a class="Collapse" ng-click="isCollapsed = !isCollapsed">Woonplaats <span class="glyphicon glyphicon-plus"></span></a>
	<hr class="Colldivider">
            <div collapse="isCollapsed">
                <iframe height="250" width="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo " ",$leerling->getStraat(); ?> <?php echo " ",$leerling->getHuisNr(); ?> <?php if($leerling->getPostcode() == 0){/*niks*/}else{ $postcodeid=$leerling->getPostcode(); $gemeente=$gemeentesvc->getGemeenteById($postcodeid); echo $gemeente->getPostcode();} ?> <?php if($leerling->getPostcode() == 0){/*niks*/}else{ echo $gemeente->getGemeente_naam();} ?>%2C%20Belgium&key=AIzaSyDrc65RO7wWLLIBcIC9vp4fXVlpDWWqMuo"></iframe>
                Woonplaats: <span class="pull-right"><?php echo " ",$leerling->getStraat(); ?><?php echo " ",$leerling->getHuisNr(); ?></span><br/><br/>
                Gemeente: <span class="pull-right"><?php if($leerling->getPostcode() == 0){/*niks*/}else{ $postcodeid=$leerling->getPostcode(); $gemeente=$gemeentesvc->getGemeenteById($postcodeid); echo $gemeente->getPostcode();} ?> <?php if($leerling->getPostcode() == 0){/*niks*/}else{ echo $gemeente->getGemeente_naam();} ?></span><br/><br/>
                    <hr class="divider">
            </div>
</div>
<div ng-controller="Collapse">
    <a class="Collapse" ng-click="isCollapsed = !isCollapsed">Gegevens ouders <span class="glyphicon glyphicon-plus"></span></a>
	<hr class="Colldivider">
            <div collapse="isCollapsed">
                Naam van ouders: <span class="pull-right"><?php echo " ",$leerling->getVoornaamouder1(); ?><?php echo " ",$leerling->getFamilienaamouder1(); ?></span><br/><br/>
                <span class="pull-right"><?php echo " ",$leerling->getVoornaamouder2(); ?><?php echo " ",$leerling->getFamilienaamouder2(); ?></span><br/><br/>
                    <hr class="divider">                    
                GSM nummers van ouders: <span class="pull-right"><?php echo " ",$leerling->getGSMouder1(); ?></span><br/><br/>
                <span class="pull-right"><?php echo " ",$leerling->getGSMouder2(); ?></span><br/>
                    <hr class="divider">
            </div>
</div>                        <!--KEVIN DEZE IMG HIERONDER IS DE GRAFIEK-->                           
</div>
</div>
<!--einde reeterende div-->
                </section>
        </section>   
    </body>
</html>
