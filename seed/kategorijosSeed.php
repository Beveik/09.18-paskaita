<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puslapiu generavimas</title>
</head>
<body>
    <form action="" method="get">
        <button type="submit" name="submit">Sukurti kategorijas</button>
    </form>
    <?php 

    require_once("../connection.php");

    function randomText($n) {
        $text = "";

        
        for($i = 0; $i < $n ; $i++) {
            $randomNumber = rand();
            $hashedText = md5($randomNumber);
            $text .= $hashedText;
        }
        
        return str_replace("a", " ", $text);

    }

    


    if(isset($_GET["submit"])) {
        for ($i=0; $i<10; $i++) {

            $pavadinimas = "pavadinimas".$i;
            $nuoroda = "nuoroda".$i;
            $aprasymas = randomText(20);
            $tevinis_id = 0;


            $sql = "INSERT INTO `kategorijos`(`pavadinimas`, `nuoroda`, `aprasymas`, `tevinis_id` ) 
            VALUES ('$pavadinimas','$nuoroda','$aprasymas', '$tevinis_id')";

            if(mysqli_query($prisijungimas, $sql)) {
                echo "Kategorija pridėta sėkmingai";
                echo "<br>";
            } else {
                echo "Nepridėta";
                echo "<br>";
            }
        }
    }

?>
</body>
</html>