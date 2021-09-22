<?php require_once("connection.php"); ?>
    <?php
    if (isset($_POST["submit"])) {
        if (isset($_POST["slapyvardis"]) && isset($_POST["slaptazodis"]) && !empty($_POST["slapyvardis"]) && !empty($_POST["slaptazodis"])) {
            $slapyvardis = $_POST["slapyvardis"];
            $slaptazodis = $_POST["slaptazodis"];


            $sql = "SELECT * FROM `vartotojai` WHERE slapyvardis='$slapyvardis' AND slaptazodis='$slaptazodis'";
            $result = $prisijungimas->query($sql);

            if ($result->num_rows == 1) {

                $user_info = mysqli_fetch_array($result);
                // var_dump($user_info);
                $cookie_array = array(
                    $user_info["ID"],
                    $user_info["slapyvardis"],
                    $user_info["slaptazodis"],
                    $user_info["teises_id"]
                );
                $cookie_array = implode("|", $cookie_array);
                setcookie("kukis", $cookie_array, time() + 36000, "/");
                header("Location: vartotojas.php");
                // $sql =  "UPDATE `vartotojai` SET `paskutinis_prisijungimas`=now() WHERE slapyvardis='$slapyvardis' AND slaptazodis='$slaptazodis'";
                $result = $prisijungimas->query($sql);
            } else {
                $message = "Neteisingi prisijungimo duomenys.";
            }
        } else {
            $message = "Laukeliai yra tušti arba duomenys neteisingi.";
        }
    }

    
    ?>
    <?php
    if (!isset($_COOKIE["kukis"])) { ?>
        <div class="container">
            
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="slapyvardis">Slapyvardis</label>
                    <input type="text" name="slapyvardis" />
                    <label for="slaptazodis">Slaptažodis</label>
                    <input type="password" name="slaptazodis" />
                
                    <button class="btn btn-primary" type="submit" name="submit">Prisijungti</button>
                </div>
            </form>
            <?php
            if (isset($message)) { ?>
                <div class="alert alert-danger" role="alert"> <?php echo $message; ?>
                </div>
        <?php
            }
        } 
        ?>

        </div>

