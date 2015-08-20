<!DOCTYPE html>
<html ng-app="SmartschoolAngCode">
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
        <!-- De CSS files die gebruikt worden-->    
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
<script src="http://code.angularjs.org/1.3.9/i18n/angular-locale_nl-be.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.js"></script>
    <script src="js/app.js"></script>
     <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <title>Smartschool > Update naam van vak</title>
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
            <!-- De uitlogknop-->
            <!-- section klasse waar de onderkant van webpagina bevind-->                 
            <section class="OnderWeb">
                <!-- Tussenklasse voor de submenu van de webpagina-->
                <h2 class="TussenTitel">verander naam van vak</h2>
                <p class="extraInfo">Vul hier de naam van het nieuwe vak in</p>
   <form class="form-horizontal Verwerken" ng-controller="validationApp" method="post" name="userForm" action="vakkenupdate.php?action=afw&vak=<?php echo $vaknaam ?>" enctype="multipart/form-data"  ng-submit="submitForm(userForm.$valid)" novalidate>
                     <div  ng-show="userForm.vakNaam.$invalid && !userForm.vakNaam.$pristine" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Naam van vak moet ingevuld worden</div>
       <input class="btn btn-success btn-sm" ng-disabled="userForm.$invalid" type="submit" value="Naam van vak veranderen"/>
          <div class="form-group" ng-class="{ 'has-error' : userForm.vakNaam.$invalid && !userForm.vakNaam.$pristine }">
            <label class="col-md-2 control-label" for="vakNaam">Naam van vak*</label>
            <div class="input-group col-md-3">
                <input id="vakNaam" type="text" name="vakNaam"  class="form-control" ng-model="user.vakNaam" ng-init="user.vakNaam='<?php echo $vaknaam ?>'"  value="<?php echo $vaknaam ?>" required>
            </div>
            </div>            
     </form>
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
