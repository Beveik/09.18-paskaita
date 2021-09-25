<?php require("connection.php"); ?>
<?php require("functions.php"); ?>
<?php require_once("prisijungimas.php"); 
$vartotojas = explode("|", $_COOKIE["kukis"]);?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategorijos</title>
    <?php require("includes.php"); ?>
</head>
<body>
<div class="container">
        <?php require("design-parts/meniu.php"); ?>
        <?php require("design-parts/jumbotron.php"); ?>
        <?php showJumbotron("", $vartotojas[1], "sveiki prisijungę!" ); ?>
        
        <h2> Kategorijų atvaizdavimas </h2>
        <form action="kategorijos.php" method="get">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Nuoroda</th>
                    <th>Aprašymas</th>
                    <th>Tėvinis</th>
                    <th>Rodyti</th>
                    <th>Redaguoti</th>
                </tr>
            <?php
            // $sql = "SELECT * FROM kategorijos"; //kuri kategorija yra tevine/ kuri vaikine
            $sql = "SELECT 
            kategorijos1.ID,
            kategorijos1.pavadinimas, 
            kategorijos1.nuoroda, 
            kategorijos1.aprasymas,
            kategorijos1.rodyti, 
            kategorijos1.tevinis_id,
            kategorijos2.ID AS kategorijos_id,
            kategorijos2.pavadinimas AS tevinis_pavadinimas
            FROM `kategorijos` AS kategorijos1
LEFT JOIN kategorijos AS kategorijos2
ON kategorijos1.tevinis_id = kategorijos2.ID
WHERE 1
ORDER BY kategorijos1.ID ASC";
            $result = $prisijungimas->query($sql);

            while($category = mysqli_fetch_array($result)) {
                $categoryID = $category["ID"];
                echo "<tr>";
                    echo "<td>".$category["ID"]."</td>";
                    echo "<td>".$category["pavadinimas"]."</td>";
                    echo "<td>".$category["nuoroda"]."</td>";
                    echo "<td>".$category["aprasymas"]."</td>";
                    

                echo "<td>".$category["tevinis_pavadinimas"]."</td>";
            // }

                    if($category["rodyti"] == 0) {
                        echo "<td>
                            <input type='checkbox' value='$categoryID' name='category[]'";
                            if ($category["ID"]==13){
                                echo "disabled";
                            }
                            echo "/></td>"; 
                    } else {
                        echo "<td><input type='checkbox' value='$categoryID' name='category[]'   ";
                        if ($category["ID"]==13){
                            echo "disabled";
                        } else {
                            echo "checked='true'";
                        }
                        echo "/></td>"; 
                        
                    }
  
                    echo "<td>
                    <a href='sidebaredit.php?ID=".$category["ID"]."'>Redaguoti</a>
                    </td>";
                    
                echo "</tr>";

            }
        
            ?>
            </table>
            <a href="vartotojas.php">Back</a><br>
            <input class="btn btn-primary" type="submit" name="submit1" value="Išsaugoti"/>
        </form>
        
        <?php 
        if(isset($_GET["submit1"])) {

            // 1 atvaizduoja 0 paslepia
            //jeigu egzistuoja masyve, vadinasi checkobx pazymeta, vadinasi turi buti 1
            //jeigu masyve neegzistuoja, vadinasi checkbox kategorija nepazymeta, vadinasi turi buti 0
            $reiksmes = $_GET["category"];
            var_dump($reiksmes);


            $sql = "UPDATE `kategorijos` SET `rodyti`= 0";
            $result = $prisijungimas->query($sql);

            foreach ($reiksmes as $reiksme) {
                $sql = "UPDATE `kategorijos` SET `rodyti`= 1 WHERE ID=$reiksme";
                $result = $prisijungimas->query($sql);
            }

            echo "<script type='text/javascript'>window.top.location='kategorijos.php';</script>";

        }
        
        ?>
    </div>
</body>
</html>






<?php 

//1. Sonines juostos atvaizdavimas
// Sonine juosta kaireje puseje
// Sonine juosta desineje puseje
// Sonines juostos neatvaizduoti

//2. Kategoriju matomumas
// Kad mes galetume pasirinkti, kurias kategorijas norime matyti, kuriu ne



?>