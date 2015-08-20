<!DOCTYPE html>
<html>
<head>
        <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">
    <link href='./css/fullcalendar_1.css' rel='stylesheet' />
<link href='./css/fullcalendar.print_1.css' rel='stylesheet' media='print' />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css" media="screen">

<link href="http://code.jquery.com/ui/1.10.4/themes/cupertino/jquery-ui.css" rel="stylesheet">
<style>
         .ui-widget-header,.ui-state-default, ui-button{
            font-weight: bold;
            color: black;
            
         }
         .invalid { border:1px solid red; }
         .test{
             background-color: yellow;
         }
        
      </style>
<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="http://code.jquery.com/jquery-2.1.3.js"></script>
<!--<script src='./js/jquery-ui-1.10.2.custom.min.js'></script>-->
<script src="js/moment.js"></script>
<script src='./js/fullcalendar.js'></script>
<script src="js/agenda_ouders.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
                          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
            <!--<script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">-->
                <script>
    $('#nav').affix({
});
    </script>
    </head>
    <body id="bodyOuders">
                <section class="container-fluid">
            <header>
    <nav data-spy="affix" data-offset-top="50" id="nav" class="navbar navbar-default navbar-fixed-top" role="navigation">
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
                
                <a href="HomeOuders.php"><span class="glyphicon glyphicon-home  linkGly linkHomeGly"></span><br/>Home</a>
            </li>
            <li><a href="DetailOuders.php"><span class="glyphicon glyphicon-folder-open linkGly linkGegGly"></span><br/>Gegevens</a></li>
            <li><a href="puntenOuder.php"><span class="glyphicon glyphicon-pencil linkGly linkPuntGly"></span><br/>Punten</a></li>
            <li class="active"><a href="agendaOuder.php"><span class="glyphicon glyphicon-calendar linkGly linkAgGly"></span><br/>Agenda</a></li>
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
        <h2 class="H2Ouders">Agenda</h2>
                    <div id="calendar"></div> 
        </section>
    </section>
</body>

</html>