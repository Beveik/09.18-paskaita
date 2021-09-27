<?php if ($vartotojas[3]==2){?>
            <div class="container">
            <div class="row">
            
 <div class="col-lg-4">
 
  
            <h3>Nauja kategorija </h3>

            <a class="btn btn-primary" href='newkategorija.php'>Sukurti</a>
            <br><br>
<h3>Kategorijų redagavimas</h3>
    <a class="btn btn-primary" href="kategorijos.php">Redaguoti</a>
    <br><br>
            </div>
            <div class="col-lg-4">
            <h3>Sidebar atvaizdavimas </h3>
        <form action="vartotojas.php">
            <?php
                $sql = "SELECT reiksme FROM nustatymai WHERE ID = 1 "; // 1 irasas
                $result = $prisijungimas->query($sql);

                $selected_value = mysqli_fetch_array($result);


                $checked = array(0,0,0);
                
                if($selected_value[0] == 0) {
                    $checked[0] = "checked";
                } else if ($selected_value[0] == 1) {
                    $checked[1] = "checked";
                } else if ($selected_value[0] == 2) {
                    $checked[2] = "checked";
                }  


            
            ?>
            <input type="radio" name="sidebar" value="0" <?php echo $checked[0]; ?>/> Sidebar neatvaizduojamas </br>
            <input type="radio" name="sidebar" value="1" <?php echo $checked[1]; ?>/> Sidebar kairėje </br>
            <input type="radio" name="sidebar" value="2" <?php echo $checked[2]; ?>/> Sidebar dešinėje </br>
            <input class="btn btn-primary" type="submit" name="submit" value="Išsaugoti">
            
        </form>
        
        <br>
        
        <?php
        // 0 reiks kad sidebar neatvaizduojamas
        // 1 reiks kad sidebar yra kaireje puseje
        // 2 reiks kad sidebar yra desineje puseje
        if(isset($_GET["submit"])) {
            
            $sidebar = $_GET["sidebar"];

            $sql = "UPDATE `nustatymai` SET `reiksme`='$sidebar' WHERE ID = 1";
            $result = $prisijungimas->query($sql);

            if($result) {
                echo "Nustatymas pakeistas sėkmingai";

                echo "<script type='text/javascript'>window.top.location='vartotojas.php';</script>";
            } else {
                echo "Kažkas įvyko negerai";
            }
        
        }
        

        ?>
        </div>
        <div class="col-lg-4">
 
  
            <h3>Naujas puslapis </h3>

            <a class="btn btn-primary" href='newpage.php'>Sukurti</a>
            </div>
            </div>
</div>
            <?php } ?>