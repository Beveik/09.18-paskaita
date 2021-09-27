<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>18 paskaita</title>
    <?php require_once("includes.php"); ?>
</head>
<body>
<div class="container">
        <?php require_once("design-parts/meniu.php"); ?>
        <?php require_once("prisijungimas.php"); 
        $vartotojas = explode("|", $_COOKIE["kukis"]);?>
        <?php require_once("design-parts/jumbotron.php"); ?>
        
        <?php showJumbotron("", $vartotojas[1], "sveiki prisijungę!" ); ?>
        
            

        <?php require_once("adminaccount.php"); ?> 
        <?php require_once("design-parts/main.php"); ?>
       
    </div>
    
    
</body>
</html>
