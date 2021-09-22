<?php

//dažniausiai šie prisijungimai yra duodami
$duomenuBazesServeris= "localhost";
$duomenuBazesSlapyvardis= "root";
$duomenuBazesSlaptazodis= "";
$duomenuBazesPavadinimas= "blogosistema";

$prisijungimas=mysqli_connect($duomenuBazesServeris, $duomenuBazesSlapyvardis, $duomenuBazesSlaptazodis, $duomenuBazesPavadinimas);
//false - kai prisijungimas nesėkmingas, jei negrąžino nieko, tai yra sėkmingas

if($prisijungimas==false) {
die("Nepavyko prisijungti prie duomenų bazės ".mysqli_connect_error());
} 
//else {
    //echo "Prisijungta sėkmingai!<br><br>";
//}
?>