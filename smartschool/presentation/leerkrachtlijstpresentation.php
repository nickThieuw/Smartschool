<!DOCTYPE html>
<html>
    <head>
<!-- al de meta tags-->       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smartschool voor leerkrachten, de aanwezigheidslijst">
        <meta name="keywords" content="smartschool,leerkrachten,aanwezigheidslijst">
<!-- al de javascript files die gebruikt worden-->
<script src="js/modernizr.custom.42943.js"></script>
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- De CSS files die gebruikt worden-->  
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
         <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
            <title>Smartschool > Leerkrachten</title>
       <script>
            $('#nav').affix({
            });
        </script>
        <title>Smartschool > Leerkracht toevoegen</title>
    </head>
    <body>
        <!-- de container rond heel de webpagina-->
        <section class="wikkel">
            <!-- Hier volgt de code voor de imageslider bovenaan de webpagina-->
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
                            <li class="active" style="margin-top: 20px; " class=" dropdown">
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
                            <li style="margin-top: 20px;"><a  href="overgang.php">Overgang</a></li>


                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li style="margin-top: 20px; margin-right: 10px;"><a href="leerkrachtaanmelden.php?log=logout"> Uitloggen</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </header>     
<!-- De uitlogknop-->
<!-- section klasse waar de onderkant van webpagina bevind-->                 
            <section class="OnderWeb">
<!-- Tussenklasse voor de submenu van de webpagina-->
                <h2>Leerkrachten</h2>
<!--omvatende div die de klaslijst heeft als inhoud-->
                    <?php foreach ($leerkrachtlijst as $leerkracht){ ?>
                    
        <div class="col-sm-4 col-md-3">
        <div class="thumbnail">
                <img class="MobileMenuImg" style="height: 200px; width: 100%; display: block;"  src="<?php $foto_path=$leerkracht->getFoto(); $beschikbaar=file_exists($foto_path); if($beschikbaar){ echo $foto_path; }else{ echo "Foto_leerling/defaul_foto.png"; }?>" alt="default" style="width:100px;height:100px">
            </a>
            <div class="caption">
                <h3><?php echo " ",$leerkracht->getVoornaam(); ?> <?php echo " ",$leerkracht->getFamilienaam(); ?></h3>
            <b>Klas:</b> <?php $klasid=$leerkracht->getKlasid(); $klas=$klassvc->getklas($klasid); echo $klas->getNaamklas(); ?><br/>
                <div class="btnCenter">
            
            <a role="button" class="btn btn-success btn-sm btnVormgeving"  href="leerkrachtprofiel.php?update=yes&leerkrachtupid=<?php echo $leerkracht->getLeerkrachtid(); ?>">update</a>
            </div>
            </div>
        </div>
      </div>
<!--repeterende div die voor iedere leerling van de klas herhaald wordt-->
                    <?php } ?>
<!--einde omvatende div-->
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
