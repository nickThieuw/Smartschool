<!DOCTYPE html>
<html>
<head>
    <link href='./css/fullcalendar_1.css' rel='stylesheet' />
<link href='./css/fullcalendar.print_1.css' rel='stylesheet' media='print' />
<link rel='stylesheet' href='./cupertino/theme.css' />
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.css" media="screen">

<link href="http://code.jquery.com/ui/1.10.4/themes/cupertino/jquery-ui.css" rel="stylesheet">
<style>
         .ui-widget-header,.ui-state-default, ui-button{
            font-weight: bold;
            color: black;
            
         }
         .invalid { color: red; }
         label{
             margin-top:15px;
             float:left;
             clear:left;
             width:80%;
         }
         textarea,select,#title {
            display: inline-block;
            width:80%;
            float:right;
         }
         label#puntentotaal{
             margin-top:15px;
             float:left;
             clear:left;
             width:80%;
         }
         input#puntentotaal{
            display: inline-block;
            width: 60%;
            float:right;
         }
         .test{
             background-color: yellow;
         }
        
      </style>
<!--<script src="http://code.jquery.com/jquery-1.10.2.js"></script>-->
<script src="http://code.jquery.com/jquery-2.1.3.js"></script>
<!--<script src='./js/jquery-ui-1.10.2.custom.min.js'></script>-->
<script src="js/moment.js"></script>
<script src='./js/fullcalendar.js'></script>
<script src="js/agenda.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
                          <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
 <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<!--            <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">-->
                <script>
    $('#nav').affix({
});

    
    </script>
    </head>
    <body>
<!-- de container rond heel de webpagina-->
        <section class="wikkel">
<!--imageslider bovenaan website-->
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
 <li class="active" style="margin-top: 20px;"><a  href="agenda.php">Agenda</a></li>
                            <li style="margin-top: 20px;"><a  href="overgang.php">Overgang</a></li>


                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li style="margin-top: 20px; margin-right: 10px;"><a href="leerkrachtaanmelden.php?log=logout"> Uitloggen</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </header>    
            <section class="OnderWeb">
                <h2>Agenda</h2>
            <div id='calendar'></div>
            <div id='dialog'>
                <p>om een evenement toe te voegen vul de volgende velden in</p>

                <div>
                   <label for="title">title*:
                   <input type="text" id="title"/></label></br>

                   <label for="info">info:
                   <textarea name="info" id="info" placeholder="extra info over evenement"></textarea></label></br>

                   <label for="vakantie">vakantie:
                   <input type="checkbox" id="vakantie"/></label>
                   
                   <input type="hidden" id="start" value=""/>
                   <input type="hidden" id="end" value=""/>
                </div>
            </div>
            </section>
        </section>
</body>
</html>
