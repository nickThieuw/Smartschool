<!DOCTYPE html>
<html>
    <head>
<!--meta tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smartschool voor ouders, homepagina">
        <meta name="keywords" content="smartschool ouders school">
<!--Pageloader-->
        <script src="js/pace.min.js"></script>
        <link rel="stylesheet" href="css/loader.css" media="screen">
<!--Bootstrap-->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> 
<!--angular-->
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
        <script src="http://code.angularjs.org/1.3.9/i18n/angular-locale_nl-be.js"></script>
        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.js"></script>
        <script src="JS/app.js"></script>
<!--JQuery-->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<!--Hoofd CSS file-->
        <link rel="stylesheet" href="css/style.css" media="screen">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!--script om header navigatie te veranderen na een bepaalde afstand-->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script>
            $('#nav').affix({});
        </script>
<!--Titel van Webpagina-->
        <title>Smartschool voor ouders > Home</title>
    </head>
<!--id gegeven aan body zodat ik dezelfde CSS file kan gebruiken maar toch een andere stijl kan toekennen-->
    <body id="bodyOuders">
        <section class="container-fluid">
<!--header wordt gebruikt als navigatie-->
            <header>
<!--nav wordt gebruikt-->
                <nav data-spy="affix" data-offset-top="50" id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-6">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
<!--Opmaak naam van website blijft hetzelfde voor zowel de mobile versie als voor desktop versie-->
                            <a class="nav-brand"><h1>Smartschool</h1></a>
                        </div>
                        <div class="collapse navbar-collapse " id="bs-example-navbar-collapse-6">
                            <ul class="nav navbar-nav navbar-right mobileVersNon">
<!--Hier toont de website op welke pagina je bevindt-->      
                                <li class="active">
                                    <a href="HomeOuders.php"><span class="glyphicon glyphicon-home linkGly linkHomeGly"></span><br/>Home</a>
                                </li>
                                <li>
                                    <a href="DetailOuders.php"><span class="glyphicon glyphicon-folder-open linkGly linkGegGly"></span><br/>Gegevens</a>
                                </li>
                                <li>
                                    <a href="puntenOuder.php"><span class="glyphicon glyphicon-pencil linkGly linkPuntGly"></span><br/>Punten</a>
                                </li>
                                <li>
                                    <a href="agendaOuder.php"><span class="glyphicon glyphicon-calendar linkGly linkAgGly"></span><br/>Agenda</a>
                                </li>
                                <li>
                                    <a href="interessanteLinksOuder.php"><span class="glyphicon glyphicon-list linkGly linksGly"></span><br/>links</a>
                                </li>
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
                                <li>
                                    <a href="HomeOuders.php?log=logout"><span class="glyphicon glyphicon-log-out linkGly linkuitGly"></span><br/>Uitloggen</a>
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div>
                </nav>
            </header>
            <section class="DesOuders">
<!--carousel dat bovenaan pagina staat-->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="images/Foto_Ouders/krokusvakantie.jpg" alt="First slide">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h1 class="carrTitle">Prettige krokusvakantie</h1>
                                        <p class="carrUitleg">Een week lang geen school, joepie!</p>
                                    </div>
                                </div>
                        </div>
                        <div class="item">
                            <img  src="images/Foto_Ouders/12.lined-paper-texture.jpg" alt="Second slide">
                                <div class="container">
                                    <div class="carousel-caption">
                                        <h1 class="carrTitle">Punten testen</h1>
                                        <p class="carrUitleg2">Via deze link vindt u direct de punten van uw zoon of dochter</p>
                                        <p><a class="btn btn-success btn-sm btnVormgeving" href="#" role="button">Meer info</a></p>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="container marketing">

<!-- drie kolommen van tekst onder de carousel -->
                <div class="row">
                    <div class="col-lg-4">
                        <img class="img-circle testi" src="images/Foto_Ouders/school-kids-circle.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <h2>Gegevens leerling</h2>
                        <p>Hieronder vindt u alle gegevens van de leerling. Zoals naam, klas, lesgever</p>
                        <p><a class="btn btn-success btn-sm btnVormgeving" href="DetailOuders.php" role="button">Bekijk details »</a></p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4 OuderLink">
                        <img class="img-circle testi" src="images/Foto_Ouders/credit-report-card.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <h2>Punten leerling</h2>
                        <p>Hier vindt u alle punten van de leerling voor het hele trimester</p>
                        <p><a class="btn btn-success btn-sm btnVormgeving" href="puntenOuder.php" role="button">Bekijk details »</a></p>
                    </div><!-- /.col-lg-4 -->
                    <div class="col-lg-4">
                        <img class="img-circle testi" src="images/Foto_Ouders/Agenda.jpg" alt="Generic placeholder image" style="width: 140px; height: 140px;">
                        <h2>Agenda</h2>
                        <p>Hieronder vindt u de agenda met alle vakantiedagen, uitstappen,...</p>
                        <p><a class="btn btn-success btn-sm btnVormgeving" href="agendaOuder.php" role="button">Bekijk details »</a></p>
                    </div><!-- /.col-lg-4 -->
                </div><!-- /.row -->
                <hr class="featurette-divider">
                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Welkom op de nieuwe website van smartschool. <span class="text-muted">It'll blow your mind.</span></h2>
                        <p class="lead">Zoals u kunt zien hebben we de website in een nieuw jasje gestopt.Met nieuwe functionaliteit zoals het bekijken van de gegevens van uw zoon/dochter, de punten die uw zoon/dochter behaalde en nog zoveel meer.</p>
                        <p><a class="btn btn-default" href="#" role="button">Meer info »</a></p>
                    </div>
                    <div class="col-md-5">
                        <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="500x500" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgdmlld0JveD0iMCAwIDUwMCA1MDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxkZWZzLz48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjE5MC4zMTI1IiB5PSIyNTAiIHN0eWxlPSJmaWxsOiNBQUFBQUE7Zm9udC13ZWlnaHQ6Ym9sZDtmb250LWZhbWlseTpBcmlhbCwgSGVsdmV0aWNhLCBPcGVuIFNhbnMsIHNhbnMtc2VyaWYsIG1vbm9zcGFjZTtmb250LXNpemU6MjNwdDtkb21pbmFudC1iYXNlbGluZTpjZW50cmFsIj41MDB4NTAwPC90ZXh0PjwvZz48L3N2Zz4=" data-holder-rendered="true">
                    </div>
                </div>
                <hr class="featurette-divider">
                <div class="row featurette">
                    <div class="col-md-5">
                        <img class="featurette-image img-responsive" data-holder-rendered="true">
                    </div>
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
                        <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
                    </div>
                </div>
                <hr class="featurette-divider">
                </div>
            </section>
        </section>
<!--Footer met namen auteuren-->
    <footer>
           Created by 
            <a href="#">Niels</a>, 
            <a href="#">Mathias</a>, 
            <a href="#">Kevin Wostijn</a> en 
            <a href="#">Nick</a>
    </footer>
</body>
</html>
