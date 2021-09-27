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
    if(isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"])  &&  isset($_GET["nuoroda"]) && !empty($_GET["kategorijos_id"]) && isset($_GET["kategorijos_id"])  && isset($_GET["turinys"]) && !empty($_GET["turinys"]) && !empty($_GET["nuoroda"]) && !empty($_GET["santrauka"]) && isset($_GET["santrauka"])) {

        $pavadinimas = $_GET["pavadinimas"];
        $nuoroda = $_GET["nuoroda"];
        $turinys = $_GET["turinys"];
        $santrauka = $_GET["santrauka"];
        $kategorijos_id = $_GET["kategorijos_id"];



        $sql = "INSERT INTO `puslapiai`(`pavadinimas`, `nuoroda`, `turinys`, `santrauka`, `kategorijos_id` ) 
            VALUES ('$pavadinimas','$nuoroda','$turinys', '$santrauka', '$kategorijos_id')";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Puslapis pridėtas sėkmingai.";
            $class = "success";
        } else {
            $message =  "Puslapis nepridėtas.";
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


        <h1>Naujas puslapis</h1>
            <form action="newpage.php" method="get">

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input class="form-control" type="text" name="pavadinimas" placeholder="Pavadinimas" />
                </div>
                <div class="form-group">
                    <label for="nuoroda">Nuoroda</label>
                    <input class="form-control" type="text" name="nuoroda" placeholder="Nuoroda" />
                </div>
                <div class="form-group">
                    <label for="turinys">Turinys</label>
                    <textarea id="turinys" name="turinys" class="form-control" placeholder="Turinys"></textarea>
                  
                </div>
                <div class="form-group">
                    <label for="santrauka">Santrauka</label>
                    <textarea id="santrauka" name="santrauka" class="form-control" placeholder="Santrauka"></textarea>
                  
                </div>

                <div class="form-group">
                    <label for="kategorijos_id">Kategorija</label>
                  
                    <select class="form-control" name="kategorijos_id">
                    <!-- <option value="900">Nepriskirta jokiai kategorijai</option> -->
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
                
<button class="btn btn-primary" type="submit" name="submit">Pridėti puslapį</button><br>
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
        $('#turinys').summernote({focus: true});
        $('#santrauka').summernote({focus: true});
    });
  </script>
</body>
</html>