<?php function showJumbotron($page_id, $page_name, $page_summary) { ?>
    <div class="container">
<div class="jumbotron">         
    <?php   if (isset($_COOKIE["kukis"])) {
       
  echo "<form action='index.php' class='logout' method ='post'>";
   echo "<button class='btn btn-primary' type='submit' name='atsijungti'>Atsijungti</button>";
}
  if (isset($_POST["atsijungti"])) {

    setcookie("kukis", "", time() - 36000, "/");
    header("Location: index.php");
  }      
  echo "</form>";
?>


            <h1 class="display-4"><?php echo $page_name; ?></h1>
            <p class="lead"><?php echo $page_summary;  ?></p>


            
</div>
</div>
<?php } ?>