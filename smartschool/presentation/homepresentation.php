<!DOCTYPE html>
<html>
    <head>
<!-- al de meta tags-->       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smartschool inlogscherm">
        <meta name="keywords" content="smartschool,inlogscherm">
<!-- De CSS files die gebruikt worden-->    
        <link rel="stylesheet" href="css/style.css" media="screen">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
         <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
       
          <script>
  $(function() {
    $( "#dialog" ).dialog();
  });

  </script>
            <title>Smartschool > Inloggen</title>
    </head>
<!-- Speciale body id, doordat inlogscherm een andere vormgeving heeft-->
    <body>
<!-- de container rond heel de webpagina-->
        <section class="wikkelInlog">
<!-- header bevat alleen maar de hoofdtitel van de webpagina-->
<header class="headerInlog">
            <h1>Smartschool</h1>
        </header>
<!-- Klasse voor achtergrond van het inlogformulier-->
<!-- Titel dat verandert van kleur-->
<!-- Inlogformulier-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="wrap">
                <p class="form-title">
                    Inloggen</p>
                <img class="" alt="login" src="images/guest.png" style="position: absolute; top: -200px; right:20px;" />
                <form class="Verwerken login"  method="post" action="home.php?submited=true">
                <input type="text"  name="gebruikersnaam"  id="gebruikersnaam" placeholder="Email" required autofocus="" />
                <input type="password"  name="wachtwoord"  id="wachtwoord" placeholder="Wachtwoord" required />
                <div class="checkbox pull-right">
                                <label>
                                    <input type="checkbox" />
                                    Herinner mij!
                                </label>
                            </div>
                <input type="submit" value="Sign In" class="btn btn-success btn-sm" />
                </form>
            </div>
        </div>
    </div>
    <div class="posted-by">Created by 
            <a href="#">Niels</a>, 
            <a href="#">Mathias</a>, 
            <a href="#">Kevin Wostijn</a> en 
            <a href="#">Nick</a></div>
</div>
<!-- Einde div TussenInlogForm-->
<!--Einde klasse voor achtergrond van inlogformulier-->
<!-- Einde container-->
        </section>  
<!-- Begin van de footer dat bovenaan de pagina staat-->
<!-- Einde footer-->  
    </body>
</html>


