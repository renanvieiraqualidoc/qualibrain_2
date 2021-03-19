<?php

include_once("config/dbconfig.php");
$sku = $_GET['buscasku'];


$newURL="http://18.217.191.86:8080/pricer/change/?sku=".$sku;

header('Location: '.$newURL);
?>

