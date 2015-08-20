
<!DOCTYPE html>
<html>
    <head>
                                          <script src="js/pace.min.js"></script>
    <link rel="stylesheet" href="css/loader.css" media="screen">
<!-- al de meta tags       -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smartschool voor leerkrachten, de aanwezigheidslijst">
        <meta name="keywords" content="smartschool,leerkrachten,aanwezigheidslijst">
<!-- //De CSS files die gebruikt worden    -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="css/responsiveslides.css" media="screen">
<!-- //al de javascript files die gebruikt worden-->
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
        <script>
            $(document).ready(function() {
                //listens for typing on the desired field
                $("#emailadres").keyup(function() {
                    //gets the value of the field
                    var email = $("#emailadres").val();
                    var atpos = email.indexOf("@");
                    var dotpos = email.lastIndexOf(".");
                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
                        $("#emailerror").html("email not validate");
                    }
                    else {
                        //the email is not available
                        $("#emailerror").html("email is validate");
                        var valid_email = true;
                    }
                });
                $(document).click(function() {
                   var valid_naam = $("#voornaam").val();
                   var valid_fnaam = $("#familienaam").val();
                   var valid_datum = $("#datepicker").val();
                   var email = $("#emailadres").val();
                   var atpos = email.indexOf("@");
                    var dotpos = email.lastIndexOf(".");
                    if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= email.length) {
                        $("#emailerror").html("email not validate");
                    }
                    else {
                        //the email is not available
                        $("#emailerror").html("email is validate");
                        var valid_email = true;
                    }
                   if (!empty(valid_naam) || !empty(valid_fnaam) || !empty(valid_datum || valid_email === true)){
                   }
                });
            });
        
            $(function() {
                $("#datepicker").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "-100:+0"
                });
            });
        
            function validateForm() {
                var x = document.forms["formaanmelden"]["emailadres"].value;
                var atpos = x.indexOf("@");
                var dotpos = x.lastIndexOf(".");
                if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                    alert("Not a valid e-mail address");
                    return false;
                }
                var x = document.forms["formaanmelden"]["voornaam"].value;
                if (x == null || x == "") {
                    alert("voornaam moet ingevult worden");
                    return false;
                }
                var x = document.forms["formaanmelden"]["familienaam"].value;
                if (x == null || x == "") {
                    alert("familienaam moet ingevult worden");
                    return false;
                }
                var x = document.forms["formaanmelden"]["geboortedatum"].value;
                if (x == null || x == "") {
                    alert("First name must be filled out");
                    return false;
                }
            }
        </script>
        <title>Smartschool > Klaslijst</title>
    </head>
    <body>
<!--        de container rond heel de webpagina-->
        <section class="wikkel">
<!-- Hier volgt de code voor de imageslider bovenaan de webpagina-->
            <header>

          
          <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
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
                <li style="margin-top: 30px; " ><a href="aanwezigheden.php">Afwezigheden</a></li>
                <li style="margin-top: 30px; " class=" dropdown">
              <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                Klas informatie <?php echo " ",$klasnaam;?>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                <li role="presentation"><a role="menuitem" tabindex="-1" href="klaslijst.php">Klaslijst</a></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="leerlingaanmelden.php">Leerling toevoegen</a></li>
              </ul>
            </li>
                <li style="margin-top: 30px;"><a href="agenda.php">Agenda</a></li>
                <li style="margin-top: 30px;" class="active dropdown">
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
                <li role="presentation" class="disabled"><a role="menuitem" tabindex="-1" href="#">Vak aanpassen</a></li>
              </ul>
              
            </li>
            <li style="margin-top: 30px;"><a href="overgangKlas.php">Overgang</a></li>
              </ul>
                <ul class="nav navbar-nav navbar-right">
            <li id="fat-menu" class="dropdown"  style="margin-top: 30px;margin-right: 10px;">
              <a id="drop3" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                Uitloggen
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                <li role="presentation" class="dropdown-header">Hallo, <?php print($GebruikerNaam)?></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="klaslijst.php?log=logout">uitloggen?</a></li>
              </ul>
            </li>
          </ul>
                
            </div><!-- /.navbar-collapse -->
          </nav>
        </header>
<!-- Dit is de hoofdmenu van de webpagina, hier zit ook de hoofdtitel van de webpagina-->

<!-- De uitlogknop-->
<!-- section klasse waar de onderkant van webpagina bevind                 -->
            <section class="OnderWeb">
<!-- Tussenklasse voor de submenu van de webpagina-->
<!--  begin form test-->
                <h2>Test updaten</h2>
                <form class="InvoerForm Verwerken" method="post" id="testform" name="formaanmelden" action="toetsenupdate.php?action=afw&vak=<?php echo $vak,"&toets=",$toets ?>" onsubmit="return validateForm();">
                                       <div  ng-show="userForm.Testnaam.$invalid && !userForm.Testnaam.$pristine" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <span class="sr-only">Error:</span>Naam van test moet ingevuld worden</div>
                    <div   ng-show="userForm.testdatum.$invalid && !userForm.testdatum.$pristine" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Datum van test moet ingevuld worden</div>
                    <div   ng-show="userForm.puntentotaal.$invalid && !userForm.puntentotaal.$pristine" class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Puntentotaal van de test moet ingevuld worden</div>
                    <div class="TussenForm TussenFormTest">
                    <label for="vak">vak &nbsp=
                        <?php echo $vak; ?>
                    </label>
                    <label for="puntentotaal">puntentotaal van de test
                        <input type="number" value="<?php echo $test->GetPuntentotaal(); ?>"name="puntentotaal" id="puntentotaal" required><br>
                    </label>
                    <label for="testnaam">testnaam &nbsp*
                        <input type="text" value="<?php echo $toets; ?>" name="testnaam" onchange="this.value = this.value.replace(/^\s+|\s+$/g, '');
                        valid_naam.checked = this.value;" id="testnaam" required/><input class="verwijderen" type="checkbox" disabled name="valid_naam"><span class="juist"></span><br>
                    </label>
                     <label for="testdatum">datum van test &nbsp*
                            <input type="text" value="<?php echo $test->getDatum(); ?>"name="testdatum" placeholder="mm/dd/yyyy" onchange="this.value = this.value.replace(/^\s+|\s+$/g, '');
                                        valid_datum.checked = this.value;" id="datepicker" required><input  class="verwijderen" type="checkbox" disabled name="valid_datum"><span class="juist"></span><br>
                        </label>   
                    <input class="buttonToevoegen buttonToevoegenTest" type="submit" value="Test updaten"/>
                    </div>
                </form>
<!--                 einde form test-->
            </section>
<!-- Einde beide sections-->
        </section>
<!-- Begin van de footer dat bovenaan de pagina staat-->
<!-- Einde footer -->
        <script type="text/javascript" charset="utf-8">
            $(function() {
                $('body').hide().show();
            });
        </script>
    </body>
</html>
