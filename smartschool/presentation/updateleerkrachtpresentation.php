<!DOCTYPE html>
<html ng-app="SmartschoolAngCode">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <script>
            $(function() {
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
            });</script>          
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
        <script src="http://code.angularjs.org/1.3.9/i18n/angular-locale_nl-be.js"></script>
        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.js"></script>
        <script src="js/app.js"></script>  
            <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">
        <title>Smartschool > Leerkracht updaten</title>
        <!--hier al een shiv gebruiken voor html5 en wat met normalize.css?-->
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
                            <li style="margin-top: 20px; " class="active dropdown">
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
                            <li style="margin-top: 20px;"><a  href="#">Agenda</a></li>
                            <li style="margin-top: 20px;"><a  href="overgang.php">Overgang</a></li>


                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li style="margin-top: 20px; margin-right: 10px;"><a href="leerkrachtaanmelden.php?log=logout"> Uitloggen</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav>
            </header>  
            <section class="OnderWeb">
                    <!--hier komt de inhoud-->   
                    <!-- start form -->
                    <h2>Bijwerken leerkracht: <?php echo $leerkachtup->getVoornaam(); ?> <?php echo $leerkachtup->getFamilienaam(); ?></h2>
<form  ng-controller="validationApp" class="form-horizontal Verwerken" role="form" method="post" name="userForm" action="leerkrachtprofiel.php?action=process&leerkrachtupid=<?php echo $leerkachtup->getLeerkrachtid(); ?>"   enctype="multipart/form-data" ng-submit="submitForm(userForm.$valid)" novalidate>   
                              <div ng-show="userForm.Voornaam.$invalid && !userForm.Voornaam.$pristine" class="alert alert-danger" role="alert">Voornaam moet ingevuld worden</div>
 <div  ng-show="userForm.Familienaam.$invalid && !userForm.Familienaam.$pristine" class="alert alert-danger" role="alert">Familienaam moet ingevuld worden</div>
                    <div ng-show="userForm.geboortedatum.$invalid && !userForm.geboortedatum.$pristine" class="alert alert-danger" role="alert">Geboortedatum moet ingevuld worden</div>
    <div class="form-group" ng-class="{ 'has-error' : userForm.Voornaam.$invalid && !userForm.Voornaam.$pristine }">
            <label class="col-md-2 control-label" for="Voornaam">Voornaam*</label>
            <div class="input-group col-md-3">
                <input id="Voornaam" type="text" name="Voornaam" class="form-control" ng-model="user.Voornaam" ng-init="user.Voornaam='<?php echo $leerkachtup->getVoornaam(); ?>'" value="<?php echo $leerkachtup->getVoornaam(); ?>" required>
            </div>
            </div>
                              <div class="form-group" ng-class="{ 'has-error' : userForm.Familienaam.$invalid && !userForm.Familienaam.$pristine }">
            <label class="col-md-2 control-label" for="Familienaam">Familienaam*</label>
            <div class="input-group col-md-3">
                <input id="Familienaam" type="text" name="Familienaam" class="form-control" ng-model="user.Familienaam" ng-init="user.Familienaam='<?php echo $leerkachtup->getFamilienaam(); ?>'"  value="<?php echo $leerkachtup->getFamilienaam(); ?>" required>
            </div>
            </div>
     <div class="form-group " ng-class="{ 'has-error' : userForm.geboortedatum.$invalid && !userForm.geboortedatum.$pristine }" >
    <label class="col-md-2 control-label"  for="datepicker">Geboortedatum*</label>
    <div class="input-group col-md-3" >
        <input class="form-control" type="text" name="geboortedatum" id="datepicker" ng-model="user.geboortedatum" ng-init="user.geboortedatum='<?php echo $leerkachtup->getGeboortedatum(); ?>'" value="<?php echo $leerkachtup->getGeboortedatum(); ?>" required>
        </div>
  </div>
                             <div ng-show="userForm.email.$invalid && !userForm.email.$pristine" class="alert alert-danger" role="alert">Geef een correct email op(vb.Naam@host.be)</div>
    
                    <div class="form-group" ng-class="{ 'has-error' : userForm.email.$invalid && !userForm.email.$pristine }">
            <label  class="col-md-2 control-label" for="email">Email</label>
            <div class="input-group col-md-3">
                <input type="email" name="email" class="form-control" ng-model="user.email" ng-init="user.email='<?php echo $leerkachtup->getEmailadres(); ?>'"  value="<?php echo $leerkachtup->getEmailadres(); ?>" required>
            </div>
            </div>
                            <div class="form-group">
    <label class="col-md-2 control-label" for="foto">Foto</label>
    <div class="input-group col-md-3">
         <input class="form-control" type="file" name="foto_leerkracht" id="" value="foto_leerling" p>
    </div>
  </div> 
                                                                         <div class="form-group">
    <label class="col-md-2 control-label" for="klas" title="Verplicht invullen">Klas</label>
    <div class="input-group col-md-3">
         <input class="form-control"   value="<?php echo $klasnaam  ?>"  type="text" name="klas" id="klas" required>
        </div>
  </div> 
                            <input class="btn btn-success btn-sm btnVormgeving" type="submit" value="Update gegevens"   ng-disabled="userForm.$invalid"><br>
                       
                    </form>
                    <!-- einde form-->
            </section>
        </section>   

    </body>
</html>


