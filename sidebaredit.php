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
    $sql = "SELECT * FROM kategorijos WHERE ID = $id";

    //kiek rezultatu gaunam? 1 

    $result = $prisijungimas->query($sql);//vykdome uzklausa 

    if($result->num_rows == 1) {
        $kategorijos = mysqli_fetch_array($result);
        $hideForm = false;
    
    } else {
        $hideForm = true;
    }
}

if(isset($_GET["submit"])) {

//   if(isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"]) && isset($_GET["nuoroda"]) && !empty($_GET["nuoroda"]) && isset($_GET["santrauka"]) && !empty($_GET["santrauka"]) && isset($_GET["turinys"]) && !empty($_GET["turinys"]) && isset($_GET["kategorijos_id"]) && !empty($_GET["kategorijos_id"]) ) {

    if(isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"]) && isset($_GET["aprasymas"]) && !empty($_GET["aprasymas"]) && isset($_GET["nuoroda"]) && !empty($_GET["nuoroda"]) && isset($_GET["tevinis_id"]) && !empty($_GET["tevinis_id"]) ) {
        // if(isset($_GET["pavadinimas"]) && isset($_GET["nuoroda"]) && isset($_GET["santrauka"]) && isset($_GET["turinys"]) && isset($_GET["kategorijos_id"])  ) {
        // if(isset($_GET["pavadinimas"])) {
        $id = $_GET["ID"];
        $pavadinimas = $_GET["pavadinimas"];
        $nuoroda = $_GET["nuoroda"];
        $aprasymas = $_GET["aprasymas"];
        
        
        if ($_GET["tevinis_id"]!="13"){
            $tevinis_id = $_GET["tevinis_id"];
        } else {
            $tevinis_id=0;
        }

        $sql = "UPDATE `kategorijos` SET `pavadinimas`='$pavadinimas',`nuoroda`='$nuoroda', `aprasymas`='$aprasymas', `tevinis_id`=$tevinis_id WHERE `ID` = $id";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Kategorija redaguota sėkmingai.";
            $class = "success";
        } else {
            $message =  "Redagavimas nepavyko.";
            $class = "danger";
        }
    } else {
        $id = $kategorijos["ID"];
        $pavadinimas = $kategorijos["pavadinimas"];
        $nuoroda = $kategorijos["nuoroda"];
        $aprasymas = $kategorijos["aprasymas"];
        
        if ($_GET["tevinis_id"]!="13"){
            $tevinis_id = $kategorijos["tevinis_id"];
        } else {
            $tevinis_id=0;
        }
        

        $sql = "UPDATE `kategorijos` SET `pavadinimas`='$pavadinimas',`nuoroda`='$nuoroda', `aprasymas`='$aprasymas', `tevinis_id`='$tevinis_id' WHERE `ID` = $id";

        if(mysqli_query($prisijungimas, $sql)) {
            $message =  "Kategorija1 redaguota sėkmingai.";
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
            <form action="sidebaredit.php" method="get">
                
                <input class="hide" type="text" name="ID" value ="<?php echo $kategorijos["ID"]; ?>" />

                <div class="form-group">
                    <label for="pavadinimas">Pavadinimas</label>
                    <input class="form-control" type="text" name="pavadinimas" value="<?php echo $kategorijos["pavadinimas"]; ?>" />
                </div>
                <div class="form-group">
                    <label for="nuoroda">Nuoroda</label>
                    <input class="form-control" type="text" name="nuoroda" value="<?php echo $kategorijos["nuoroda"]; ?>"/>
                </div>

                <div class="form-group">
                <label for="aprasymas">Aprašymas</label>
                <textarea id="aprasymas" name="aprasymas" class="form-control" > <?php echo $kategorijos["aprasymas"]; ?> </textarea>
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

                <a href="kategorijos.php">Back</a><br>
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