<?php 
    require_once("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redagavimas</title>
    <style>
    .hide {
            display:none;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php require_once("includes.php"); 
require_once("design-parts/meniu.php");?>
<?php 

if(!isset($_COOKIE["kukis"])) { 
    header("Location: index.php");    
} else { 
    $vartotojas = explode("|", $_COOKIE["kukis"]); 
}

 if ($vartotojas[3]==2){

if(isset($_GET["ID"])) {
    $id = $_GET["ID"];
    $sql = "SELECT * FROM puslapiai WHERE ID = $id";

    //kiek rezultatu gaunam? 1 

    $result = $prisijungimas->query($sql);//vykdome uzklausa 

    if($result->num_rows == 1) {
        $puslapiai = mysqli_fetch_array($result);
        $hideForm = false;
    
    } else {
        $hideForm = true;
    }
}

if(isset($_GET["submit"])) {

   if(isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"]) && isset($_GET["nuoroda"]) && !empty($_GET["nuoroda"]) && isset($_GET["santrauka"]) && !empty($_GET["santrauka"]) && isset($_GET["turinys"]) && !empty($_GET["turinys"]) && isset($_GET["kategorijos_id"]) && !empty($_GET["kategorijos_id"]) ) {
    // if(isset($_GET["pavadinimas"]) && isset($_GET["nuoroda"]) && isset($_GET["santrauka"]) && isset($_GET["turinys"]) && isset($_GET["kategorijos_id"])  ) {
        // if(isset($_GET["pavadinimas"])) {
        $id = $_GET["ID"];
        $pavadinimas = $_GET["pavadinimas"];
        $nuoroda = $_GET["nuoroda"];
        $santrauka = $_GET["santrauka"];
        $kategorijos_id = $_GET["kategorijos_id"];
        $turinys = $_GET["turinys"];

        $sql = "UPDATE `puslapiai` SET `pavadinimas`='$pavadinimas',`nuoroda`='$nuoroda', `santrauka`='$santrauka', `kategorijos_id`='$kategorijos_id', `turinys`='$turinys' WHERE `ID` = $id";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Puslapis redaguotas sėkmingai.";
            $class = "success";
        } else {
            $message =  "Redagavimas nepavyko.";
            $class = "danger";
        }
    } else {
        $id = $puslapiai["ID"];
        $pavadinimas = $puslapiai["pavadinimas"];
        $nuoroda = $puslapiai["nuoroda"];
        $santrauka = $puslapiai["santrauka"];
        $kategorijos_id = $puslapiai["kategorijos_id"];
        $turinys = $puslapiai["turinys"];

        $sql = "UPDATE `puslapiai` SET `pavadinimas`='$pavadinimas',`nuoroda`='$nuoroda', `santrauka`='$santrauka', `kategorijos_id`='$kategorijos_id', `turinys`='$turinys' WHERE `ID` = $id";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Vartotojas redaguotas sėkmingai";
            $class = "success";
        } else {
            $message =  "Redagavimas nepavyko.";
            $class = "danger";
        }
    }
}

?>

<div class="container">
        <h1>Redagavimas</h1> <br>
        <?php if($hideForm == false) { ?>
            <form action="urledit.php" method="get">
                
                <input class="hide" type="text" name="ID" value ="<?php echo $puslapiai["ID"]; ?>" />

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input class="form-control" type="text" name="pavadinimas" value="<?php echo $puslapiai["pavadinimas"]; ?>" />
                </div>
                <div class="form-group">
                    <label for="nuoroda">Nuoroda</label>
                    <input class="form-control" type="text" name="nuoroda" value="<?php echo $puslapiai["nuoroda"]; ?>"/>
                </div>

                <div class="form-group">
                <label for="santrauka">Santrauka</label>
                <textarea id="santrauka" name="santrauka" class="form-control" > <?php echo $puslapiai["santrauka"]; ?> </textarea>
                </div>

                <div class="form-group">
                <label for="turinys">Turinys</label>
                <textarea id="turinys" name="turinys" class="form-control"><?php echo $puslapiai["turinys"]; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="kategorija">Kategorija</label>
                    <input class="form-control" type="text" name="kategorija" value="<?php echo $puslapiai["kategorijos_id"]; ?>"/>
                </div>

                <a href="vartotojas.php">Back</a><br>
                <button class="btn btn-primary" type="submit" name="submit">Išsaugoti pakeitimus</button>
            </form>
            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <h2> Įvyko klaida. </h2>
            <a href="vartotojas.php">Back</a>
        <?php }?>    
    </div>
  <?php }  else {
        header("Location:404.php");
    }
    ?>
    </div>
    <script>
    $(document).ready(function() {
        $('#turinys').summernote({focus: true});
        $('#santrauka').summernote({focus: true});
    });
  </script>
</body>
</html>