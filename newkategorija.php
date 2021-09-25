<?php require("connection.php"); ?>
<?php require("functions.php"); ?>
<?php require_once("prisijungimas.php"); 
$vartotojas = explode("|", $_COOKIE["kukis"]);?>
    <?php require_once("includes.php"); 
require_once("design-parts/meniu.php");?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nauja kategorija</title>




</head>
<body>
<?php 


if(!isset($_COOKIE["kukis"])) { 
    header("Location: index.php");    
}


if(isset($_GET["submit"])) {
    if(isset($_GET["pavadinimas"]) && isset($_GET["tevinis_id"]) &&  isset($_GET["nuoroda"]) && !empty($_GET["tevinis_id"]) && !empty($_GET["pavadinimas"]) && isset($_GET["aprasymas"]) && !empty($_GET["aprasymas"]) && !empty($_GET["nuoroda"])) {

        $pavadinimas = $_GET["pavadinimas"];
        $nuoroda = $_GET["nuoroda"];
        $aprasymas = $_GET["aprasymas"];
        
        if ($_GET["tevinis_id"]!="13"){
            $tevinis_id = $_GET["tevinis_id"];
        } else {
            $tevinis_id=0;
        }


        $sql = "INSERT INTO `kategorijos`(`pavadinimas`, `nuoroda`, `aprasymas`, `tevinis_id`, `rodyti` ) 
            VALUES ('$pavadinimas','$nuoroda','$aprasymas','$tevinis_id', 0 )";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Kategorija pridėta sėkmingai.";
            $class = "success";
        } else {
            $message =  "Kategorija nepridėta.";
            $class = "danger";
        }
    } else {
        $message =  "Užpildykite visus laukelius";
        $class = "danger";
    }
}

?>

<div class="container">
<?php

if ($vartotojas[3]==2){ ?> 


        <h1>Nauja kategorija</h1>
            <form action="newkategorija.php" method="get">

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input class="form-control" type="text" name="pavadinimas" placeholder="Pavadinimas" />
                </div>
                <div class="form-group">
                    <label for="nuoroda">Nuoroda</label>
                    <input class="form-control" type="text" name="nuoroda" placeholder="Nuoroda" />
                </div>
                <div class="form-group">
                    <label for="aprasymas">Aprašymas</label>
                    <textarea id="aprasymas" name="aprasymas" class="form-control" placeholder="Aprašymas"></textarea>
                  
                </div>

                <div class="form-group">
                    <label for="tevinis_id">Kategorija</label>
                  
                    <select class="form-control" name="tevinis_id">
                        <?php 
                         $sql = "SELECT * FROM kategorijos";
                         $result = $prisijungimas->query($sql);

                         while($tevinis = mysqli_fetch_array($result)) {

                            if($kategorijos["tevinis_id"] == $tevinis["ID"] ) {
                                echo "<option value='".$tevinis["ID"]."' selected='true'>";
                            } else {
                                echo "<option value='".$tevinis["ID"]."'>";
                            }
                                
                                echo $tevinis["pavadinimas"];
                            echo "</option>";
                       }
                        ?>
                    </select>
                </div>
                
<button class="btn btn-primary" type="submit" name="submit">Pridėti kategoriją</button><br>
                <a href="vartotojas.php">Back</a>
                
            </form>

            <?php if(isset($message)) { ?>
                <div class="alert alert-<?php echo $class; ?>" role="alert">
                <?php echo $message; ?>
                </div>
            <?php } ?>
        
              <?php } ?>
    </div>
    <script>
    $(document).ready(function() {
        $('#aprasymas').summernote({focus: true});
        
    });
  </script>
</body>
</html>