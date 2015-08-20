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
    <style>
        .BerichtenInfoTekst{
            padding-top: 1em;
            color: darkblue;
        }
        .bericht {
            margin: 0 auto;
            margin-bottom: 2.5%;
        }
        .bericht pre {
            text-align: left;
            width: 100%;
            height: 100%;
            color: darkblue;
            margin: 2% auto;  
        }
        textarea {
            background: none;
            color: blue;
            width: 80%;
            height: 150px;
            margin: 2% 0;
           
        }
        form {
            margin-bottom: 2.5%;
                
        }
         .verplicht {
            border-width: 3px;
            border-color: #FF4500;
        }
        h2{
            color: darkgreen !important;
            font-weight: bold;
        }
    </style>
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
                  <li style="margin-top: 20px; " ><a href="berichtenzien.php">Postvak IN</a></li>
                <li style="margin-top: 20px;" class="active"><a href="berichtenverzonden.php">Verzonden berichten</a></li>
                
              </ul>
                <ul class="nav navbar-nav navbar-right">
          </ul>
                
            </div><!-- /.navbar-collapse -->
          </nav>
        </header>
        <section class="OnderWeb">
       <?php foreach ($conversatie as $value) {
                if($value['fromStatus'] == 1){
     
                        $leerkrachtServ = new leerkrachtservice();
                        $leerkracht = $leerkrachtServ->getByid($value['fromId']);
                        $voornaam = ucfirst($leerkracht->getVoornaam());
                        $familienaam = ucfirst($leerkracht->getFamilienaam());
                        $van = $voornaam. " " .$familienaam;
                }else{                  
                        $leerlingServ = new leerlingservice();
                        $leerling = $leerlingServ->getleerlingbyid($value['fromId']);
                        $voornaam = ucfirst($leerling->getVoornaam());
                        $familienaam = ucfirst($leerling->getFamilienaam());
                        $van = $voornaam. " " .$familienaam;
                }
                if($value['toStatus'] == 1){

                        $leerkrachtServ = new leerkrachtservice();
                        $leerkracht = $leerkrachtServ->getByid($value['toId']);
                        $voornaam = ucfirst($leerkracht->getVoornaam());
                        $familienaam = ucfirst($leerkracht->getFamilienaam());
                        $naar = $voornaam. " " .$familienaam;
                }else{                  
                        $leerlingServ = new leerlingservice();
                        $leerling = $leerlingServ->getleerlingbyid($value['toId']);
                        $voornaam = ucfirst($leerling->getVoornaam());
                        $familienaam = ucfirst($leerling->getFamilienaam());
                        $naar = $voornaam. " " .$familienaam;
                }?>
 
            <div class="Berichtenvenster">
                <p class="BerichtenInfoTekst"><b>Van: </b> <?php print($van);?>, 
                    <b> Naar: </b> <?php print($naar);?>,<b> Datum: </b>
                        <?php print($value['datumTijd']);?></p>
        <h2>Onderwerp: <?php print(stripcslashes($value['titel']));?></h2>
        <div class="bericht">
            <pre> <?php print(stripcslashes($value['bericht']));?></pre>
        </div>
    </div>
            <?php }?>
             </section>
    </section>
    
</body>
</html>