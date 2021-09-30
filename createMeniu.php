<?php require_once("connection.php"); ?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meniu create</title>
    <?php require_once("includes.php"); ?>
</head>
<body>
<div class="container">
<?php require_once("design-parts/meniu.php"); ?>
        <?php require_once("design-parts/jumbotron.php"); ?>
        <?php showJumbotron("", "Meniu", "Susikurkite Meniu"); ?>
        
<form action="createMeniu.php" method="get">
<a href="vartotojas.php">Back</a><br>
<input type="radio" name="meniuTipas" value="1" checked="true"> Pasirinkta nuoroda   <br>
<input type="radio" name="meniuTipas" value="2"> Nuoroda į kategoriją <br>
<input type="radio" name="meniuTipas" value="3"> Nuoroda į puslapį <br>
<input type="submit" name= "submit" value="Sukurti">

</form>
<?php
if (isset($_GET["meniuTipas"])) {
    $meniuTipas=$_GET["meniuTipas"]; // 1, 2 arba 3
if ($meniuTipas==1){ ?>
    <h3> Pasirinkta nuoroda</h3>
    <form action="createMeniu.php" method="get">
    <input type="hidden" name="meniuTipas" value="<?php echo $meniuTipas; ?>" >
<input class="form-control" type="text" name="pavadinimas" placeholder="Įveskite pavadinimą">
<input class="form-control" type="text" name="nuoroda" placeholder="Įveskite nuorodą">
<!-- <input class="form-control" type="text" name="target" placeholder="Įveskite, kaip atsidarys nuoroda"> -->

<input  type="radio" name="target" value="_self"> Atsidarys tame pačiame</br>
                        <input  type="radio" name="target" value="_blank"> Atsidarys kitame lange</br>

<input class="form-control" type="text" name="alt" placeholder="Įveskite nuorodos aprašymą">
<input class="btn btn-primary" type="submit" name= "create" value="Sukurti">

    </form>
    <?php 
                        if(isset($_GET["create"])) {
                        $pavadinimas = $_GET["pavadinimas"];
                        $nuoroda = $_GET["nuoroda"];
                        $target = $_GET["target"];
                        $alt = $_GET["alt"];
                        $sql = "INSERT INTO `meniu`(`pavadinimas`, `nuoroda`, `target`, `alt`) VALUES ('$pavadinimas','$nuoroda','$target','$alt')";
                        
                        if(mysqli_query($prisijungimas, $sql)) {
                            echo "Meniu punktas sukurtas sėkmingai";
                            echo "<br>";
                        } else {
                            echo "Kažkas įvyko negerai";
                            echo "<br>";
                        }
                    }

                    ?>


<?php } else if ($meniuTipas==2){ ?>
    <h3> Nuoroda į kategoriją</h3>
    <form action="createMeniu.php" method="get">

    <input type="hidden" name="meniuTipas" value="<?php echo $meniuTipas; ?>" >
    
                               <br> <p>Pasirinkite kategoriją:</p>
                        <select name="categories">
                            <?php 
                            
                                $sql = "SELECT ID, pavadinimas FROM kategorijos";
                                $result = $prisijungimas->query($sql);
                                while($categories = mysqli_fetch_array($result)) {
                                    $id = $categories["ID"];
                                    $pavadinimas = $categories["pavadinimas"];
                                    
                                    echo "<option name='pavadinimas' value='$id'>$pavadinimas</option><br>";
                                }
                                
                            ?>
                        </select><br><br>
                                <input class='form-control' type='text' name='pavadinimas' value='Įveskite kategorijos pavadinimą, jei norite jį pakeisti' checked='true'>
                                <br>
                        <input  type="radio" name="target" value="_self" checked="true"> Atsidarys tame pačiame</br>
                        <input  type="radio" name="target" value="_blank"> Atsidarys kitame lange</br>
                        <br>
                        <input class="form-control" type="text" name="alt" placeholder="Įveskite nuorodos aprašymą">
                        <input class="btn btn-primary" type="submit" name="create" value="Create">                 
                        
                        
                        <?php
                        //hidden laukelio kuris nurodo meniu tipa
                        // selectas, kuriame yra nurodytos visos kategorijos
                        // target laukelis
                        //alt laukelis
                        
                        //mes pagal selecta turetume pasiimti kategorijos ID x
                        //pagal kategorijos ID kreiptis i duomenu baze su SELECT ir gauti pavadinima kategorijos x
                        //irasas yra vienas vienintelis, gauname jo pavadinima x
                        //sita gauta informacija + target ir alt yra irasoma i meniu lentele

                        if(isset($_GET["create"])) {
                            $category_id = $_GET["categories"]; // 1 2, 42 ir t.t.
                            $sql = "SELECT pavadinimas FROM kategorijos WHERE ID = $category_id";//viena vieniteli irasa
                            $result = $prisijungimas->query($sql);
                            
                            $category = mysqli_fetch_array($result);

                            if(isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"])){
                                $pavadinimas = $_GET["pavadinimas"];

                            } else {
                            $pavadinimas = $category["pavadinimas"]; //pasirinktos kategorijos pavadinima, musu meniu punkto pavadinimas
                        }
                            $target = $_GET["target"];
                            $alt = $_GET["alt"];

                            $nuoroda = "vartotojas.php?catID=".$category_id;

                            $sql = "INSERT INTO `meniu`(`pavadinimas`, `nuoroda`, `target`, `alt`) VALUES ('$pavadinimas','$nuoroda','$target','$alt')";
                        
                            if(mysqli_query($prisijungimas, $sql)) {
                                    echo "Meniu punktas sukurtas sėkmingai";
                                    echo "<br>";
                            } else {
                                    echo "Kazkas ivyko negerai";
                                    echo "<br>";
                            }
                        }



                        
                        ?>      
    </form>
    <?php } else if ($meniuTipas==3){ ?>
    <h3>Nuoroda į puslapį</h3>
    <form action="createMeniu.php" method="get">
    <input type="hidden" name="meniuTipas" value="<?php echo $meniuTipas; ?>" >

    <br> <p>Pasirinkite puslapį:</p>
                        <select name="pages">
                            <?php 
                                $sql = "SELECT  pavadinimas, nuoroda FROM puslapiai";
                                $result = $prisijungimas->query($sql);
                                while($pages = mysqli_fetch_array($result)) {
                                    $nuoroda = $pages["nuoroda"];
                                    $pavadinimas = $pages["pavadinimas"];
                                    
                                    echo "<option value='$nuoroda'>$pavadinimas</option>";
                                }
                            
                            ?>
                        </select><br>
                        <input class='form-control' type='text' name='pavadinimas' value='Įveskite puslapio pavadinimą, jei norite jį pakeisti' checked='true'>
                                <br>
                        <input  type="radio" name="target" value="_self" checked="true"> Atsidarys tame pačiame</br>
                        <input  type="radio" name="target" value="_blank"> Atsidarys kitame lange</br>
                        <br>
                        <input class="form-control" type="text" name="alt" placeholder="Įveskite nuorodos aprašymą">
                        <br>
                        <input class="btn btn-primary" type="submit" name="create" value="Create">

    </form>
    <?php 
                    if(isset($_GET["create"])) {

                        $pages_href = $_GET["pages"];
                        $sql = "SELECT pavadinimas FROM puslapiai WHERE nuoroda = '$pages_href'";//viena vieniteli irasa
                        $result = $prisijungimas->query($sql);
                        
                        $page = mysqli_fetch_array($result);
                        // $pavadinimas = $page["pavadinimas"]; //pasirinktos puslapio pavadinima, musu meniu punkto pavadinimas

                        if(isset($_GET["pavadinimas"]) && !empty($_GET["pavadinimas"])){
                            $pavadinimas = $_GET["pavadinimas"];

                        } else {
                        $pavadinimas = $page["pavadinimas"]; //pasirinktos kategorijos pavadinima, musu meniu punkto pavadinimas
                    }
                        $target = $_GET["target"];
                        $alt = $_GET["alt"];

                        $nuoroda = "puslapiai.php?href=".$pages_href;

                        $sql = "INSERT INTO `meniu`(`pavadinimas`, `nuoroda`, `target`, `alt`) VALUES ('$pavadinimas','$nuoroda','$target','$alt')";
                    
                        if(mysqli_query($prisijungimas, $sql)) {
                                echo "Meniu punktas sukurtas sėkmingai";
                                echo "<br>";
                        } else {
                                echo "Kazkas ivyko negerai";
                                echo "<br>";
                        }
                    }
                    
                    ?>

                    
                <?php } ?>  
   


<?php } ?>





</div>
</body>
</html>