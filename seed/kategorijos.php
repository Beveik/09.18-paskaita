<?php require("connection.php"); ?>
<?php require("functions.php"); ?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php require("includes.php"); ?>
</head>
<body>
<div class="container">
        <?php require("design-parts/meniu.php"); ?>
        <?php require("design-parts/jumbotron.php"); ?>
        <?php showJumbotron("", $vartotojas[1], "sveiki prisijungę!" ); ?>
        
        <h2> Kategorijų atvaizdavimas </h2>
        <form action="admin.php" method="get">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Aprašymas</th>
                    <th>Rodyti</th>
                </tr>
            <?php
            $sql = "SELECT * FROM kategorijos"; //kuri kategorija yra tevine/ kuri vaikine
            $result = $prisijungimas->query($sql);

            while($category = mysqli_fetch_array($result)) {
                $categoryID = $category["ID"];
                echo "<tr>";
                    echo "<td>".$category["ID"]."</td>";
                    echo "<td>".$category["pavadinimas"]."</td>";
                    echo "<td>".$category["aprasymas"]."</td>";

                    if($category["rodyti"] == 0) {
                        echo "<td>
                            <input type='checkbox' value='$categoryID' name='category[]'/> 
                        </td>";
                    } else {
                        echo "<td><input type='checkbox' value='$categoryID' name='category[]' checked='true'/> 
                        </td>";
                        
                    }

                    
                echo "</tr>";

            }
            
            ?>
            </table>
            <input type="submit" name="submit1" value="Išsaugoti"/>
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

            // header("Location: admin.php");
            echo "<script type='text/javascript'>window.top.location='admin.php';</script>";

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