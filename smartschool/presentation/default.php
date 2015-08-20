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
                <script>
    // You can also use "$(window).load(function() {"
            $(function () {
                
                var test = document.getElementById("test");
                
                test.addEventListener('change', function() {
                    var vak = document.getElementById("vak");
                    var vaklabel = document.getElementById("vaklabel");
                    var puntentotaal = document.getElementById("puntentotaal");
                    var puntentotaallabel = document.getElementById("puntentotaallabel");
                    var info = document.getElementById("info");
                    if(test.checked){
                       vaklabel.style.display = "block";
                       vak.style.display = "block";
                       vak.removeAttribute("disabled");
                       info.setAttribute("disabled",true);
                       puntentotaallabel.style.display = "block";
                       puntentotaal.style.display = "block";
                       puntentotaal.removeAttribute("disabled");
                       
                    } else{
                        vaklabel.style.display = "none";
                        vak.setAttribute("disabled",true);
                        info.removeAttribute("disabled");
                        puntentotaallabel.style.display="none";
                        puntentotaal.setAttribute("disabled",true);
                    }
                    
                });
                
                
             });
        </script>
            <!--<script src="js/pace.min.js"></script>
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
                <nav data-spy="affix" data-offset-top="50" id="nav"  class="navbar navbar-default navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div  class="collapse navbar-collapse head" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav" id="navbar-nav" style="box-shadow: rgba(6, 57, 106, 0) 0px 1px 5px 0px;">
                <li class="nav-logo hidden-xs" style="margin-bottom: 0px;"><h1>Smartschool</h1></li>
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
            <li style="margin-top: 20px;" class="active"><a href="agenda.php">Agenda</a></li>
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
            <section class="OnderWeb">
                <h2>Agenda</h2>
            <div id='calendar'></div>
            <div class="AgendaDialog" id='dialog'>
                <p>om een evenement toe te voegen vul de volgende velden in</p>

                <div>
                    <div class="form-group">
            <label class="col-md-2 control-label" for="title">Titel:*</label>
            <div class="input-group col-md-8">
                <input id="title" type="text" name="title" class="form-control"  required>
            </div>
            </div>
                    <div class="form-group">
            <label class="col-md-2 control-label" for="info">Info:*</label>
            <div class="input-group col-md-8">
                <textarea name="info" id="info" rows="5" placeholder="extra info over evenement"></textarea>
            </div>
            </div>
                     <div class="form-group">
            <label class="col-md-2 control-label" for="test">Test?:</label>
            <div class="input-group col-md-8">
                <input type="checkbox" id="test"/>
            </div>
            </div>
                   
                    <label id ="vaklabel" for="vak">vak:
                            <select id="vak"> 
                                <?php
                                $m = 0;
                                while ($m < count($vakkenlijst)){ ?>
                                <option value="<?php echo $vakkenlijst[$m]->getVaknaam()?>"><?php echo $vakkenlijst[$m]->getVaknaam()?></option>
                                <?php $m++;} ?>
                            </select>
                        </label><br>
                   <label id="puntentotaallabel" for="puntentotaal">puntentotaal*:
                       <input type="text" id="puntentotaal" /></label>
                   
                   <input type="hidden" id="start" value=""/>
                   <input type="hidden" id="end" value=""/>
                </div>
            </div>
            </section>
        </section>
</body>
</html>
