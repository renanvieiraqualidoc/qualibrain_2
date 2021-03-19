<?php

// Connect to the database
include_once("../config/dbconfig.php");


$select_pbmc = "SELECT * FROM Products";
$resultado_pbmc = mysqli_query($conn,$select_pbmc);
$total_pbmc = mysqli_fetch_array($resultado_pbmc);

print_r($total_pbmc);

?>
