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
    <title>Puslapiai</title>
    <?php require("includes.php"); ?>
</head>
<body>
<div class="container">
        <?php require("design-parts/meniu.php"); ?>
        <?php require("design-parts/jumbotron.php"); ?>
        <?php showJumbotron("", $vartotojas[1], "sveiki prisijungę!" ); ?>
        
        <h2> Puslapių atvaizdavimas </h2>
        <form action="puslapiaiatvaizdavimas.php" method="get">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Pavadinimas</th>
                    <th>Nuoroda</th>
                    <th>Turinys</th>
                    <th>Santrauka</th>
                    <th>Kategorijos</th>
                    <th>Rodyti</th>
                    <th>Veiksmai</th>
                </tr>
            <?php
            
            $sql = "SELECT puslapiai.ID AS puslapiai_ID,
            puslapiai.pavadinimas, 
            puslapiai.nuoroda, 
            puslapiai.santrauka,
            puslapiai.turinys,
            puslapiai.rodyti, 
            puslapiai.kategorijos_id,
            kategorijos.ID,
            kategorijos.pavadinimas AS kategorijos_pavadinimas
            FROM `puslapiai`
LEFT JOIN kategorijos
ON puslapiai.kategorijos_id = kategorijos.ID
WHERE 1
ORDER BY puslapiai.ID ASC;";
            $result = $prisijungimas->query($sql);

            while($puslapiai = mysqli_fetch_array($result)) {
                $puslapiaiID = $puslapiai["puslapiai_ID"];
                echo "<tr>";
                    echo "<td>".$puslapiai["puslapiai_ID"]."</td>";
                    echo "<td>".$puslapiai["pavadinimas"]."</td>";
                    echo "<td>".$puslapiai["nuoroda"]."</td>";
                    echo "<td>".$puslapiai["turinys"]."</td>";
                    echo "<td>".$puslapiai["santrauka"]."</td>";

                echo "<td>".$puslapiai["kategorijos_pavadinimas"]."</td>";
            // }
            

                    if($puslapiai["rodyti"] == 0) {
                        echo "<td>
                            <input type='checkbox' value='$puslapiaiID' name='puslapiai[]'/></td>";
                           
                    } else {
                        echo "<td><input type='checkbox' value='$puslapiaiID' name='puslapiai[]' checked='true' /></td> ";
                    }
  
                    echo "<td>
                    <a href='urledit.php?ID=".$puslapiai["puslapiai_ID"]."'>Redaguoti</a>
                    <br>
                    <a href='puslapiai.php?ID=" .$puslapiai["puslapiai_ID"]."'>Ištrinti</a>
                        </td>";

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
            
                    
                    
                echo "</tr>";

            }
        
            ?>
            </table>
            <a href="vartotojas.php">Back</a><br>
            <input class="btn btn-primary" type="submit" name="submit" value="Išsaugoti"/>
        </form>
        
        <?php 
        if(isset($_GET["submit"])) {

            $reiksmes = $_GET["puslapiai"];
            var_dump($reiksmes);


            $sql = "UPDATE `puslapiai` SET `rodyti`= 0";
            $result = $prisijungimas->query($sql);

            foreach ($reiksmes as $reiksme) {
                $sql = "UPDATE `puslapiai` SET `rodyti`= 1 WHERE ID=$reiksme";
                $result = $prisijungimas->query($sql);
            }

            echo "<script type='text/javascript'>window.top.location='puslapiaiatvaizdavimas.php';</script>";

        }
        
        ?>
        <?php if (isset($message)) { ?>
            <div class="alert alert-<?php echo $class; ?>">
                <?php echo $message; ?>
            </div>

        <?php } ?>
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