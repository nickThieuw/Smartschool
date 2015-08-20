<!DOCTYPE html>
<html ng-app="SmartschoolAngCode">
    <head>
<!-- al de meta tags-->       
    <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smartschool voor leerkrachten, de aanwezigheidslijst">
        <meta name="keywords" content="smartschool,leerkrachten,aanwezigheidslijst">
<!-- De CSS files die gebruikt worden-->    
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <title>Smartschool > Postvak In</title>
<!-- al de javascript files die gebruikt worden-->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
                <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.16/angular.js"></script>
        <script src="http://code.angularjs.org/1.3.9/i18n/angular-locale_nl-be.js"></script>
        <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.12.0.js"></script>
        <script src="js/app.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
            <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
                <script>
    $('#nav').affix({
});
    </script>
    
</head>
<body>
    <section class="wikkel">
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
                <li style="margin-top: 20px; "><a href="<?php print($_SESSION["return_url"]) ?>"><< Vorige pagina</a></li>
                <li style="margin-top: 20px;"  class="active" ><a href="berichttoevoegen.php"><span class="glyphicon glyphicon-plus"></span> Nieuw bericht</a></li>
                  <li style="margin-top: 20px; "><a href="berichtenzien.php">Postvak IN</a></li>
                <li style="margin-top: 20px;"><a href="berichtenverzonden.php">Verzonden berichten</a></li>
                
              </ul>
                <ul class="nav navbar-nav navbar-right">
          </ul>
                
            </div><!-- /.navbar-collapse -->
          </nav>
        </header>
        <section class="OnderWeb">
            <h2>Nieuw bericht opmaken</h2>
                <p class="extraInfo">Hier kan je een nieuw bericht opmaken en versturen. <u>Onderwerp</u> en <u>bericht</u> moet ingevuld worden</p>
                
    <form  ng-controller="validationApp" name="userForm"  class="form-horizontal Berichten" method="post" action="berichttoevoegen.php?action=voegtoe"  enctype="multipart/form-data" ng-submit="submitForm(userForm.$valid)" novalidate>
         <div class="form-group">
    <label class="col-md-2 control-label"  for="wie">Naar:</label>
    <div class="input-group col-md-5">
        <select  class="form-control" name="to" size="1" id="wie" >
            <!--value niks moet nog opgevangen worden-->
        <option value="">--Maak uw keuze--</option>
            <?php
            if($_SESSION['rechten'] === "leerkracht_level"){
             foreach ($klaslijst as $value) {
                 if($value->getLeerlingid() === $toId){

                    print"<option value='".$value->getLeerlingid()."' selected>"
                    .$value->getVoornaam()." ".$value->getFamilienaam()."</option>";   
                }else{ 
                    print"<option value='".$value->getLeerlingid()."'>"
                    .$value->getVoornaam()." ".$value->getFamilienaam()."</option>";   
               }
             }
            }else{
              foreach ($leerkrachtlijst as $value) {
                  if($value->getLeerkrachtid() === $toId){
                      print"<option value='".$value->getLeerkrachtid()."' selected>"
                    .$value->getVoornaam()." ".$value->getFamilienaam()."</option>";
                  }else{
                     print"<option value='".$value->getLeerkrachtid()."'>"
                    .$value->getVoornaam()." ".$value->getFamilienaam()."</option>";
            }
            }
            }
            ?> 
          </select>
    </div>
  </div>
  <div class="form-group"  ng-class="{ 'has-error' : userForm.titel.$invalid && !userForm.titel.$pristine }">
    <label class="col-md-2 control-label" for="titel">Onderwerp:*</label>
    <div class="input-group col-md-5">
        <input class="form-control" class="form-control" type="text" name="titel" id="titel" value="<?php if(isset($titel)){ print($titel);}?>" <?php if($onderwerpBool){ print("class='verplicht'");}?>  ng-model="user.titel" required>
    </div>
  </div> 
          <div class="form-group" ng-class="{ 'has-error' : userForm.bericht.$invalid && !userForm.bericht.$pristine }">
    <label class="col-md-2 control-label"  for="bericht">Bericht:*</label>
    <div class="input-group col-md-5">
    <textarea name="bericht" id="bericht" rows="20" <?php if($textaeraBool){ print("class='verplicht'");}?>   ng-model="user.bericht" required><?php if(isset($bericht)){ print($bericht);}?></textarea> <br>    
    </div>
  </div>  
        <input class="btn btn-success btn-sm" type="submit" name="Submit" value="Stuur bericht"  ng-disabled="userForm.$invalid"> 
        <input class="btn btn-success btn-sm" type="reset" name="Reset" value="Reset">  

        </form>
        </section>
    </section>
    </body>
    
</html>
