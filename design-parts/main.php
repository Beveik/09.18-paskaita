
<?php require_once("connection.php"); ?>


<div class="container">
<div class="row">
    <div class="col-lg-3">
        <h3>Šoninė juosta/Sidebar</h3>
    </div>
    <div class="col-lg-9">
        <div class="row">
        <?php 

            $sql = "SELECT * FROM puslapiai
            ORDER BY puslapiai.ID DESC
            ";

            $result = $prisijungimas->query($sql);

            while($puslapiai = mysqli_fetch_array($result)) {
            ?>
            <div class="card col-lg-4" style="width: 18rem;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $puslapiai["pavadinimas"]; ?></h5>
                   
                    <p class="card-text"><?php echo $puslapiai["santrauka"]; ?></p>
                    <a href="puslapiai.php?href=<?php echo $puslapiai["nuoroda"]; ?>" class="btn btn-primary">Plačiau</a>
                    <?php if ($vartotojas[3]==2){?>
                        
                        <a href='urledit.php?ID=<?php echo $puslapiai["ID"]; ?>'>Redaguoti</a>
                         <!-- <form action='main.php' class='redaguoti' method ='get'>
      <button class='btn btn-primary' type='submit' name='redaguoti'>Redaguoti</button>
                    </form> -->
      <?php } ?>
                </div>
            </div>

            <?php } ?>    
        </div>
    </div>
</div>
</div>
<?php
// if (isset($_GET["redaguoti"])) {
//     echo "<a href='urledit.php'>Redaguoti</a>";
// }
?>