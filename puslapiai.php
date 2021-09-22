
<?php require_once("connection.php"); ?>

<?php

$url = $_GET["href"]; // kontaktai , apie-mus, paslaugos

$sql = "SELECT * FROM puslapiai 
WHERE nuoroda='$url'";

$result = $prisijungimas->query($sql);

//Kiek irasu grazins? 1
if($result->num_rows != 0) {
    $puslapiai = mysqli_fetch_array($result);
} else {
    header("Location:404.php");
}

?>




<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $puslapiai["pavadinimas"]; ?></title>
    <?php require_once("includes.php"); ?>
</head>
<body>
    <div class="container">
        <?php require_once("design-parts/meniu.php"); ?>
        <?php require_once("design-parts/jumbotron.php"); ?>

        <?php showJumbotron($puslapiai["ID"], $puslapiai["pavadinimas"], $puslapiai["santrauka"]); ?>
        <div class="container">
        <?php echo $puslapiai["turinys"]; ?>
        <?php echo $puslapiai["kategorijos_id"]; ?>
        
        <?php $vartotojas = explode("|", $_COOKIE["kukis"]);
        if ($vartotojas[3]==2){?>
                        <br>
                        <a href='urledit.php?ID=<?php echo $puslapiai["ID"]; ?>'>Redaguoti</a>
      <?php } ?>

     </div>
     </div>
</body>
</html>