

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
<?php require_once("connection.php"); ?>
        
        <?php require_once("design-parts/jumbotron.php"); ?>
        <div class="container">
<?php require_once("design-parts/meniu.php"); ?>
</div>
<?php

$url = $_GET["href"]; // kontaktai , apie-mus, paslaugos

$sql = "SELECT * FROM puslapiai 
WHERE nuoroda='$url'";

$result = $prisijungimas->query($sql);

//Kiek irasu grazins? 1
if($result->num_rows != 0) {
    $puslapiai = mysqli_fetch_array($result);
    // var_dump($puslapiai);
} else {
    echo "<script type='text/javascript'>window.top.location='puslapiai.php';</script>";
}

?>
    <div class="container">


        <?php 
        // var_dump($puslapiai);
        showJumbotron("", $puslapiai["pavadinimas"], $puslapiai["santrauka"]); ?>
        <div class="container">
        <p class="catd-text"><a  href="vartotojas.php?catID=<?php echo $puslapiai["ID"] ?>" ><?php echo $puslapiai["kategorijos_pavadinimas"]; ?></a>  </p>
        <?php echo $puslapiai["turinys"]; ?>
        <br>
        <?php echo $puslapiai["kategorijos_id"]; ?>
        <br><a href="vartotojas.php">Back</a><br>
        <?php $vartotojas = explode("|", $_COOKIE["kukis"]);
        if ($vartotojas[3]==2){?>
                        <br>
                        <a href='urledit.php?ID=<?php echo $puslapiai["ID"]; ?>'>Redaguoti</a>
                        <br>
                        <a href='puslapiai.php?ID=<?php echo $puslapiai["ID"];?>'>Ištrinti</a>

                        <?php
                        if (isset($_GET["ID"])) {
                $id = $_GET["ID"];
                $sql = "DELETE FROM `puslapiai` WHERE `ID` = $id";

                if (mysqli_query($prisijungimas, $sql)) {
                    $message = "Puslapis ištrintas sėkmingai.";
                    $class = "success";
                } else {
                    $message = "Puslapio ištrinti nepavyko.";
                    $class = "danger";
                }
            }
            ?>
      <?php } ?>

     </div>
     </div>
</body>
</html>