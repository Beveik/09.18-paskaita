<?php require_once("connection.php"); ?>
<?php 

$sql = "SELECT reiksme FROM nustatymai WHERE ID = 1 "; // 1 irasas
$result = $prisijungimas->query($sql);
$selected_value = mysqli_fetch_array($result);

// 0 reiks kad sidebar neatvaizduojamas
        // 1 reiks kad sidebar yra kaireje puseje
        // 2 reiks kad sidebar yra desineje puseje

?>
<div class="container">
<div class="row">


    <?php if ($selected_value[0] == 1) {
        require("sidebar.php");
    } ?>
    
    <?php if($selected_value[0] == 0) { ?>
        <div class="col-lg-12">
    <?php } else {?>
        <div class="col-lg-9">
    <?php } ?>
        <div class="row">
        <?php 
            if(isset($_GET["catID"]) && !empty($_GET["catID"])) { //egzistuoja
                $catID = $_GET["catID"];
                
                $sql = "SELECT puslapiai.ID AS puslapiai_ID,
                puslapiai.pavadinimas, 
                puslapiai.nuoroda, 
                puslapiai.santrauka, 
                kategorijos.pavadinimas AS kategorijos_pavadinimas,
                kategorijos.ID
                FROM puslapiai 
                LEFT JOIN kategorijos
                ON puslapiai.kategorijos_id = kategorijos.ID
                WHERE puslapiai.kategorijos_id = $catID
                ORDER BY puslapiai.ID DESC";    
            } else {
                $sql = "SELECT puslapiai.ID AS puslapiai_ID,
                puslapiai.pavadinimas, 
                puslapiai.nuoroda, 
                puslapiai.santrauka, 
                kategorijos.pavadinimas AS kategorijos_pavadinimas,
                kategorijos.ID
                FROM puslapiai 
                LEFT JOIN kategorijos
                ON puslapiai.kategorijos_id = kategorijos.ID
                ORDER BY puslapiai.ID DESC";
            }

            $result = $prisijungimas->query($sql);

            while($puslapiai = mysqli_fetch_array($result)) {
            ?>
            <div class="card col-lg-4" style="width: 18rem;">
                <img class="card-img-top" src="https://media.istockphoto.com/photos/camera-and-lens-zoom-closeup-picture-id1152344841?s=612x612" alt="Card image cap" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $puslapiai["pavadinimas"]; ?></h5>
                   
                    <p class="card-text"><?php echo $puslapiai["santrauka"]; ?></p>
                    <p class="catd-text"><a  href="vartotojas.php?catID=<?php echo $puslapiai["ID"]; ?>" ><?php echo $puslapiai["kategorijos_pavadinimas"]; ?></a>  </p>
                    <a href="puslapiai.php?href=<?php echo $puslapiai["nuoroda"]; ?>" class="btn btn-primary">Plačiau</a>
                    <?php if ($vartotojas[3]==2){?>
                        <br>
                        <a href="urledit.php?ID=<?php echo $puslapiai["puslapiai_ID"]; ?>">Redaguoti</a>
                        <br>
                        <a href='puslapiai.php?ID=<?php echo $puslapiai["puslapiai_ID"];?>'>Ištrinti</a>

                        <?php
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
            ?>
      <?php } ?>
                </div>
            </div>

            <?php } ?>    
        </div>
    </div>

<?php if ($selected_value[0] == 2) {
        require("sidebar.php");
    } ?>
</div>
</div>