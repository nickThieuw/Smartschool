<!DOCTYPE html>
<html>
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
        <title>Smartschool > Verzonden</title>
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
                <li style="margin-top: 20px;"><a href="berichttoevoegen.php"><span class="glyphicon glyphicon-plus"></span> Nieuw bericht</a></li>
                  <li style="margin-top: 20px; "><a href="berichtenzien.php">Postvak IN</a></li>
                  <li style="margin-top: 20px;" class="active"><a href="berichtenverzonden.php">Verzonden berichten</a></li>
                
              </ul>
                <ul class="nav navbar-nav navbar-right">
          </ul>
                
            </div><!-- /.navbar-collapse -->
          </nav>
        </header>
    
        <section class="OnderWeb">
            <h2>Verzonden berichten</h2>

    <?php
 
    foreach ($bGegevens as $value){

        
        
        ?>
    
    <a class="LinkDes " href="bekijkverzondenbericht.php?onderwerp=<?php print($value['titel']);?>&&conversatie=<?php print($value['conversatie']);?>&&id=<?php print($value['id']);?>">
       
        <div class="row"> 
            <span class="col-md-1"></span>
            <div style="color:purple" class="col-md-2"><?php
        //print($value['fromStatus']);
        if($value['fromStatus'] == 1){
            $leerkrachtServ = new leerkrachtservice();
            $leerkracht = $leerkrachtServ->getByid($value['fromId']);
            $voornaam = ucfirst($leerkracht->getVoornaam());
            $familienaam = ucfirst($leerkracht->getFamilienaam());
            print($voornaam. " " .$familienaam);
          
        }else{
            $leerlingServ = new leerlingservice();
            $leerling = $leerlingServ->getleerlingbyid($value['fromId']);
            $voornaam = ucfirst($leerling->getVoornaam());
            $familienaam = ucfirst($leerling->getFamilienaam());
            print($voornaam. " " .$familienaam);
        }

        ?>
           </div>
            <div class="col-md-4"><?php print(ucfirst(stripcslashes($value['titel'])));?></div>
            <div class="pull-right col-md-2"><?php print($value['datumTijd']);?></div>

        </div>
    </a>


    <?php } ?>
 


            
          
        </section>
        </section>
</body>
</html>
