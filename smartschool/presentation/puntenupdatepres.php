<!DOCTYPE html>
<html>
    <head>
                                          <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">
<!-- al de meta tags-->       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smartschool voor leerkrachten, de aanwezigheidslijst">
        <meta name="keywords" content="smartschool,leerkrachten,aanwezigheidslijst">
<!-- al de javascript files die gebruikt worden-->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
            <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
           <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
   
<!-- De CSS files die gebruikt worden-->    
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        
      <link rel="stylesheet" href="css/style.css" media="screen">
        <title>Smartschool > update punten van toets</title>
    </head>
    <body>
<!-- de container rond heel de webpagina-->
        <section class="wikkel">
<!-- Hier volgt de code voor de imageslider bovenaan de webpagina-->
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
                <li style="margin-top: 20px; " class="dropdown">
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
                <li style="margin-top: 20px;" class="active dropdown">
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
              
            </li></ul>
                
            </div><!-- /.navbar-collapse -->
          </nav>
        </header>
<!-- Dit is de hoofdmenu van de webpagina, hier zit ook de hoofdtitel van de webpagina-->
<!-- De uitlogknop-->
            <section class="OnderWeb">
<!--  begin form test-->
<h2><?php echo $vak,'<br/>', $toets; ?></h2>
<!-- De form die de aanwezigheden opvangt en doorgeeft aan de database-->
                    <form  ng-controller="validationApp" class="form-horizontal puntenUpdate" method="post" action="puntenupdate.php?action=afw&vak=<?php echo $vak ?>&toets=<?php echo $toets ?>" id="inlogform">
                        <a class="btn btn-success btn-sm btnVormgeving" href="toetsenpagina.php?vak=<?php echo $vak ?>"><< terug naar toetsenlijst</a>
                        <input  class="btn btn-success btn-sm btnVormgeving" type="submit" value="punten updaten >>"/>
                        
<!--omvatende div die de klaslijst heeft als inhoud-->     
<div class="row">
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
                                            <div class="input-group">
                                            <input class="form-control" type="number" value="<?php if(isset($punten)){ echo $punten->getPunten();} ?>" name="punten<?php  echo $j ?>"/><div class="input-group-addon"> / <?php echo $test->getPuntentotaal(); ?></label></div>
                                            </div>
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
                                            <div class="input-group">
                                                <input class="form-control" type="number" value="" placeholder="Geen" name="punten<?php  echo $j ?>"/><div class="input-group-addon"> / <?php echo $test->getPuntentotaal(); ?></label></div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                      <?php
                                      $j++;
                            }
                    }
                    ?>
</div>
<!--einde omvatende div-->
                        
                    </form>
<!--                 einde form test-->
            </section>
<!-- Einde beide sections-->
        </section>
<!-- Begin van de footer dat boveaan de pagina staat-->
<!-- Einde footer-->  
        <script type="text/javascript" charset="utf-8">
            $(function() {
                $('body').hide().show();
            });
        </script>
    </body>
</html>
