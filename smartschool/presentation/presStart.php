<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smartschool voor leerkrachten, de aanwezigheidslijst">
        <meta name="keywords" content="smartschool,leerkrachten,aanwezigheidslijst">
<!-- De CSS files die gebruikt worden-->    
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" media="screen">
        <title>Smartschool > Aanwezigheidslijst</title>
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
        div {
            border: 1px solid #000000;
            width: 80%;
            margin: 0 auto;
            margin-top: 10%;
            
        }
        header {
            background-color: #CCCCCC;
        }
        h2 {
            margin-top: 0;
        }
        span {
            font-size: 16px;
            color: white;
            float: right;
            margin-right: 2.5%;
        }
    </style>
</head>
<body> 
    <div>
        <header>
            <h2>Berichten<span><?php if(isset($_SESSION['verzonden'])){ print($_SESSION['verzonden']);}?></span></h2>
        </header>
        <a href="berichtenzien.php">Postvak in</a><br>
        <a href="berichtenverzonden.php">Verzonden items</a><br>
        <a href="Berichttoevoegen.php">Maak een bericht</a>
    </div>
</body>
</html>