<!DOCTYPE html>
<html ng-app="SmartschoolAngCode">
    <head>
<!-- al de meta tags-->       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smartschool voor leerkrachten, leerling toevoegen">
        <meta name="keywords" content="smartschool,leerkrachten,leerling,toeveoegen">
<!-- De CSS files die gebruikt worden-->    
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
        
<!-- al de javascript files die gebruikt worden-->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
        <script src="http://code.angularjs.org/1.3.9/i18n/angular-locale_nl-be.js"></script>
        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.js"></script>
        <script src="js/app.js"></script>
             <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <title>Smartschool > Klaslijst</title>
        <script>
    $('#nav').affix({
});
    </script>
    </head>
    <body>
<!-- de container rond heel de webpagina-->
        <section class="wikkel">
<!--imageslider bovenaan website-->
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
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav" id="navbar-nav" style="box-shadow: rgba(6, 57, 106, 0) 0px 1px 5px 0px;">
                <li style="margin-top: 20px; " ><a href="aanwezigheden.php">Afwezigheden</a></li>
                <li style="margin-top: 20px; " class=" dropdown">
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
                <li style="margin-top: 20px;" class="dropdown active">
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
                    <li style="margin-top: 20px; margin-right: 10px;"><a href="klaslijst.php?log=logout"> Uitloggen</a></li>
          </ul>
                
            </div><!-- /.navbar-collapse -->
          </nav>
        </header>
            <!-- De uitlogknop-->
            <!-- section klasse waar de onderkant van webpagina bevind-->                 
            <section class="OnderWeb">   
<h2>punten van <?php echo $toets ?></h2>
  <a class="btn btn-success btn-sm btnVormgeving" href="toetsenpagina.php?vak=<?php echo $vak ?>"><< terug naar toetsenlijst</a>     
                 <?php if (!isset($puntenlijst[0])) {
                        ?>
                <a class="btn btn-success btn-sm btnVormgeving" href="puntentoevoegen.php?vak=<?php echo $vak ?>&toets=<?php echo $toets; ?>">punten toevoegen</a> <?php
                    } else {
                        ?><a class="btn btn-success btn-sm btnVormgeving" href="puntenupdate.php?vak=<?php echo $vak ?>&toets=<?php echo $toets; ?>">punten aanpassen</a> <?php }
                    ?>
                  
                <!-- Tussenklasse voor de submenu van de webpagina-->
                <div class="row rowPunt">
                    <?php foreach ($klaslijst as $leerling) { 
                            $printed =false;
                                foreach($puntenlijst as $punten){
                                    $tbleerlingid = $leerling->getLeerlingid();
                                    $tbpuntenllid = $punten->getLeerlingid();
                                    if($tbleerlingid == $tbpuntenllid){
                        ?>
                                    <div class="col-sm-4 col-md-3">

                                    <div class="thumbnail">
                                        <img class="MobileMenuImg" src="<?php $foto_path=$leerling->getFoto(); $beschikbaar=file_exists($foto_path); if($beschikbaar){ echo $foto_path; }else{ echo "Foto_leerling/defaul_foto.png"; }?>?>" alt="default" style="width:100px;height:100px">

                                        <div class="caption">
                                            <h3><?php echo " ", $leerling->getVoornaam(); ?> <?php echo " ", $leerling->getFamilienaam(); ?></h3>
                                            <p>Punten: <?php if(isset($punten)){ echo " ", $punten->getPunten(),"/", $test->getPuntentotaal();} ?></p>
                                        </div>
                                    </div>
                                  </div>
                                <!-- Klasse die de vormgeving bevat van de persoonlijke gegevens-->
                                <!--einde repeterende div-->
                                <?php   $j++;
                                        $printed = true;
                                }
                            }
                            if($printed == false){ 
                                ?>
                                <div class="col-sm-4 col-md-3">

                                    <div class="thumbnail">
                                        <img class="MobileMenuImg" src="<?php $foto_path=$leerling->getFoto(); $beschikbaar=file_exists($foto_path); if($beschikbaar){ echo $foto_path; }else{ echo "Foto_leerling/defaul_foto.png"; }?>?>" alt="default" style="width:100px;height:100px">

                                        <div class="caption">
                                            <h3><?php echo " ", $leerling->getVoornaam(); ?> <?php echo " ", $leerling->getFamilienaam(); ?></h3>
                                            <p>Punten:Geen<?php echo "/", $test->getPuntentotaal(); ?></p>
                                        </div>
                                    </div>
                                  </div>
                                      <?php
                                      $j++;
                            }
                    }
                    ?>
</div>
            </section>
            <!-- Einde beide sections-->
        </section>
        <!-- Begin van de footer dat bovenaan de pagina staat-->
        <!-- Einde footer-->  
        <script type="text/javascript" charset="utf-8">

            $(function() {
                $('body').hide().show();
            });
        </script>
    </body>
</html>
