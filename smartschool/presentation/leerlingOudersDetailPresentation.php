<!DOCTYPE html>
<html>
    <head>
<!--Inladen van alles in webpagina gebeurt hier-->        
    <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">
<!--meta tags-->    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link href="css/carousel.css" rel="stylesheet" media="screen">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script>
    $('#nav').affix({
});
    </script>
    
    <link href="css/carousel.css" rel="stylesheet" media="screen">
        <title>Smartschool > Gegevens</title>
        <!--hier al een shiv gebruiken voor html5 en wat met normalize.css?-->
    </head>
    <body id="bodyOuders">
        <section class="container-fluid">
            <header>
    <nav  data-spy="affix" data-offset-top="50" id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
      <!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="nav-brand"><h1>Smartschool</h1></a>
        </div>
        <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-6">
          <ul class="nav navbar-nav navbar-right mobileVersNon">
            <li>
                
                <a href="HomeOuders.php"><span class="glyphicon glyphicon-home linkGly linkHomeGly"></span><br/>Home</a>
            </li>
            <li class="active"><a href="DetailOuders.php"><span class="glyphicon glyphicon-folder-open linkGly linkGegGly"></span><br/>Gegevens</a></li>
            <li><a href="puntenOuder.php"><span class="glyphicon glyphicon-pencil linkGly linkPuntGly"></span><br/>Punten</a></li>
            <li><a href="agendaOuder.php"><span class="glyphicon glyphicon-calendar linkGly linkAgGly"></span><br/>Agenda</a></li>
            <li><a href="interessanteLinksOuder.php"><span class="glyphicon glyphicon-list linkGly linksGly"></span><br/>links</a></li>
            <li class="dropdown">
              <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                  <span class="glyphicon glyphicon-envelope linkGly linkMailGly"></span><br/>Mail
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation" class="dropdown-header">Berichten</li> 
                <li role="presentation"><a role="menuitem" tabindex="-1" href="berichtenzien.php">Postvak in</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="berichtenverzonden.php">Verzonden</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="Berichttoevoegen.php">Nieuw bericht</a></li>
              </ul>
              
            </li>
            <li><a href="HomeOuders.php?log=logout"><span class="glyphicon glyphicon-log-out linkGly linkuitGly"></span><br/>Uitloggen</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>
        </header>
                        <section class="DesOuders">
                            <h2 class="H2Ouders">Gegevens van <?php echo " ",$leerling->getVoornaam(); ?> <?php echo " ",$leerling->getFamilienaam(); ?></h2>
                            <div class="row ">
      
                                    <img class=" col-lg-4 img-circle" style="width: 45%;" src="<?php echo $leerling->getFoto();?>" alt="default"><br/>
                                    <div class="col-lg-6 OnderWebDetailOuders">
                               Voornaam: <span class="pull-right"><?php echo " ",$leerling->getVoornaam(); ?></span><br/><br/>
                                <span class="">Familienaam:</span> <span class="pull-right"><?php echo " ",$leerling->getFamilienaam(); ?></span><br/><br/>
                                <span class="">Geboortedatum:</span> <span class="pull-right"><?php echo " ",$leerling->getGeboortedatum(); ?></span><br/><br/>
                                <span class="">Telefoonnummer:</span> <span class="pull-right"><?php echo " ",$leerling->getTelefoonnr(); ?></span><br/><br/>
                                <span class="">Email:</span> <span class="pull-right"><a href="mailto:<?php print($leerling->getEmailadres()); ?>"><?php echo " ",$leerling->getEmailadres(); ?></a></span><br/><br/>
                                <hr class="divider">
                                <iframe height="250" width="100%" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php echo " ",$leerling->getStraat(); ?> <?php echo " ",$leerling->getHuisNr(); ?> <?php if($leerling->getPostcode() == 0){/*niks*/}else{ $postcodeid=$leerling->getPostcode(); $gemeente=$gemeentesvc->getGemeenteById($postcodeid); echo $gemeente->getPostcode();} ?> <?php if($leerling->getPostcode() == 0){/*niks*/}else{ echo $gemeente->getGemeente_naam();} ?>%2C%20Belgium&key=AIzaSyDrc65RO7wWLLIBcIC9vp4fXVlpDWWqMuo"></iframe>
                                <span class="">Woonplaats:</span> <span class="pull-right"><?php echo " ",$leerling->getStraat(); ?><?php echo " ",$leerling->getHuisNr(); ?></span><br/><br/>
                                <span class="">Gemeente:</span> <span class="pull-right"><?php if($leerling->getPostcode() == 0){/*niks*/}else{ $postcodeid=$leerling->getPostcode(); $gemeente=$gemeentesvc->getGemeenteById($postcodeid); echo $gemeente->getPostcode();} ?> <?php if($leerling->getPostcode() == 0){/*niks*/}else{ echo $gemeente->getGemeente_naam();} ?></span><br/><br/>
<hr class="divider">
                                <span class="">Naam van ouders:</span> <span class="pull-right"><?php echo " ",$leerling->getVoornaamouder1(); ?><?php echo " ",$leerling->getFamilienaamouder1(); ?></span><br/><br/>
                                <span class="pull-right"><?php echo " ",$leerling->getVoornaamouder2(); ?><?php echo " ",$leerling->getFamilienaamouder2(); ?></span><br/><br/>
                             <hr class="divider">                    
                                <span class="">GSM nummers van ouders:</span> <span class="pull-right"><?php echo " ",$leerling->getGSMouder1(); ?></span><br/><br/>
                                <span class="pull-right"><?php echo " ",$leerling->getGSMouder2(); ?></span><br/>
                                    </div>
                              
                            </div><!--einde reeterende div-->
                </section>
        </section>
    </body>
</html>
