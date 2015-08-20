<!DOCTYPE html>
<html ng-app="SmartschoolAngCode">
    <head>
                  <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">
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
        <script>
            $(function() {
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
            });
        </script>
            <!--<script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">-->
   <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>     
        <title>Smartschool > leerling Updaten</title>
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
                 <a class="nav-brand"><h1>Smartschool</h1></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div  class="collapse navbar-collapse head" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav" id="navbar-nav" style="box-shadow: rgba(6, 57, 106, 0) 0px 1px 5px 0px;">
                <li style="margin-top: 20px; " ><a href="aanwezigheden.php">Afwezigheden</a></li>
                <li style="margin-top: 20px; " class="active dropdown">
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
                <h2>Update gegevens van <?php echo $leerling->getVoornaam(); ?> <?php echo $leerling->getFamilienaam(); ?></h2>
<p class="extraInfo">Verander hier de gegevens van de leerling. Hier moet <u>voornaam</u>, <u>naam</u>, <u>geboortedatum</u> en <u>email</u> ingevuld worden</p>
                <form class="form-horizontal Verwerken"  ng-controller="validationApp" method="post" name="userForm" action="leerlingprofiel.php?update=yes&action=process&leerlingid=<?php echo $leerling->getLeerlingid();?>" enctype="multipart/form-data"  ng-submit="submitForm(userForm.$valid)" novalidate>   
 <div ng-show="userForm.Voornaam.$invalid && !userForm.Voornaam.$pristine" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Voornaam moet ingevuld worden</div>
 <div  ng-show="userForm.Familienaam.$invalid && !userForm.Familienaam.$pristine" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Familienaam moet ingevuld worden</div>
                    <div ng-show="userForm.geboortedatum.$invalid && !userForm.geboortedatum.$pristine" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Geboortedatum moet ingevuld worden</div>
    <p><?php if(isset($_GET["error"]) && $_GET["error"]=="postcode"){echo "U vulde één van beide velden in. Maar indien postcode/gemeente info gewenst is moeten ze beide ingevuld worden.";}?></p>
    <div class="form-group" ng-class="{ 'has-error' : userForm.Voornaam.$invalid && !userForm.Voornaam.$pristine }">
            <label class="col-md-2 control-label" for="Voornaam">Voornaam*</label>
            <div class="input-group  col-md-3" >
                <input id="Voornaam" type="text" name="Voornaam"  class="form-control" ng-model="user.Voornaam" ng-init="user.Voornaam='<?php echo $leerling->getVoornaam(); ?>'"  value="<?php echo $leerling->getVoornaam(); ?>" required>
            </div>
            </div>
             <div class="form-group" ng-class="{ 'has-error' : userForm.Familienaam.$invalid && !userForm.Familienaam.$pristine }">
            <label class="col-md-2 control-label" for="Familienaam">Familienaam*</label>
            <div class="input-group col-md-3">
                <input id="Familienaam" type="text" name="Familienaam"  class="form-control" ng-model="user.Familienaam" ng-init="user.Familienaam='<?php echo $leerling->getFamilienaam(); ?>'"  value="<?php echo $leerling->getFamilienaam(); ?>" required>
           </div>
            </div>
         <div class="form-group " ng-class="{ 'has-error' : userForm.geboortedatum.$invalid && !userForm.geboortedatum.$pristine }" >
    <label class="col-md-2 control-label"  for="datepicker">Geboortedatum*</label>
    <div class="input-group col-md-3" >
        <input class="form-control" type="text" name="geboortedatum" id="datepicker" ng-model="user.geboortedatum" ng-init="user.geboortedatum='<?php echo $leerling->getGeboortedatum(); ?>'" value="<?php echo $leerling->getGeboortedatum(); ?>" required>
         </div>
  </div>
    <div class="form-group">
    <label class="col-md-2 control-label" for="foto">Foto</label>
    <div class="input-group col-md-3">
         <input class="form-control" type="file" name="foto_leerling" id="" value="foto_leerling" p>
    </div>
  </div> 
        <div class="form-group">
    <label class="col-md-2 control-label"  for="straat">Straat</label>
    <div class="input-group col-md-3">
         <input class="form-control" value="<?php echo $leerling->getStraat(); ?>"  type="text" name="straat" id="straat">
    </div>
  </div> 
  <div class="form-group">
    <label class="col-md-2 control-label" for="huisnr">Huisnummer</label>
    <div class="input-group col-md-3">
         <input class="form-control" value="<?php if($leerling->getHuisnr() == 0){/*niks*/}else{echo $leerling->getHuisnr();} ?>" type="number" name="huisnr" id="huisnr">
    </div>
  </div>
      <div class="form-group">
    <label class="col-md-2 control-label" for="bus">Bus</label>
    <div class="input-group col-md-3">
         <input class="form-control" value="<?php echo $leerling->getBus(); ?>" type="text" name="bus" id="bus">
    </div>
  </div>
          <div class="form-group">
    <label class="col-md-2 control-label" for="postcode">Postcode</label>
    <div class="input-group col-md-3">
         <input class="form-control" value="<?php if($leerling->getPostcode() == 0){/*niks*/}else{ $postcodeid=$leerling->getPostcode(); $gemeente=$gemeentesvc->getGemeenteById($postcodeid); echo $gemeente->getPostcode();} ?>" type="number" name="postcode" id="postcode"><br>
    </div>
  </div>
          <div class="form-group">
    <label class="col-md-2 control-label" for="bus">Gemeente</label>
    <div class="input-group col-md-3">
         <input class="form-control" value="<?php if($leerling->getPostcode() == 0){/*niks*/}else{ echo $gemeente->getGemeente_naam();} ?>" type="text" name="gemeente" id="gemeente">
    </div>
  </div>
          <div class="form-group">
    <label class="col-md-2 control-label" for="bus">Telefoonnummer</label>
    <div class="input-group col-md-3">
         <input class="form-control" value="<?php if($leerling->getTelefoonnr() == 0){/*niks*/}else{echo $leerling->getTelefoonnr();}?>" type="text" name="telefoonnr" id="tel">
    </div>
  </div>
    <div class="desOuders">
        <div class="row">
            <label class="col-md-2 control-label" for="bus">Eerste ouder</label>
            <div class="col-md-2">
                <div class="input-group">
                    <input class="form-control" value="<?php echo $leerling->getVoornaamouder1(); ?>" type="text" name="voornaamouder1" id="vnouder1" placeholder="Voornaam">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <input class="form-control" value="<?php echo $leerling->getFamilienaamouder1(); ?>" type="text" name="familienaamouder1" id="fnouder1" placeholder="Familienaam">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <input class="form-control" value="<?php if($leerling->getGSMouder1() == 0){/*niks*/}else{echo $leerling->getGSMouder1();} ?>" type="text" name="GSMouder1" placeholder="GSM nummer" id="gsmouder1">
                </div>
            </div>
        </div>
            <div class="row">
            <label class="col-md-2 control-label" for="bus">Tweede ouder</label>
            <div class="col-md-2">
                <div class="input-group">
                    <input class="form-control" value="<?php echo $leerling->getVoornaamouder2(); ?>" type="text" name="voornaamouder2" id="vnouder2" placeholder="Voornaam">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <input class="form-control" value="<?php echo $leerling->getFamilienaamouder2(); ?>" type="text" name="familienaamouder2" id="fnouder2" placeholder="Familienaam">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <input class="form-control" value="<?php if($leerling->getGSMouder2() == 0){/*niks*/}else{echo $leerling->getGSMouder2();}?>" type="text" name="GSMouder2" placeholder="GSM nummer" id="gsmouder1">
                </div>
            </div>
        </div>
    </div>
     <div ng-show="userForm.email.$invalid && !userForm.email.$pristine" class="alert alert-danger" role="alert">Geef een correct email op(vb.Naam@host.be)</div>
        <div class="form-group" ng-class="{ 'has-error' : userForm.email.$invalid && !userForm.email.$pristine }">
            <label  class="col-md-2 control-label" for="email">Email</label>
            <div class="input-group col-md-3">
                <input type="email" name="email" class="form-control" ng-model="user.email" ng-init="user.email='<?php echo $leerling->getEmailadres(); ?>'" value="<?php echo $leerling->getEmailadres(); ?>" required>
            </div>
            </div>
                    <div class="col-md-2">
                            <input class="btn btn-success btn-sm" type="submit" ng-disabled="userForm.$invalid" value="Update leerling"><br>
                    </div>
                    </form>
                    <!-- einde form-->    
            </section>
        </section>
<!-- Einde beide sections-->
<!-- Begin van de footer dat bovenaan de pagina staat-->
<!-- Einde footer-->  
        <script type="text/javascript" charset="utf-8">
            $(function() {
                $('body').hide().show();
            });
        </script>
    </body>
</html>
