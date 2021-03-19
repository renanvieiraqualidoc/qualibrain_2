
    
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


require_once __DIR__.'/SimpleXLSX.php';

header('Content-Type: text/html; charset=utf-8');


// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}



error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);


include_once("config/dbconfig.php");


 if ( 0 < $_FILES['file']['error'] ) {
       echo 'Error: ' . $_FILES['file']['error'] . '<br>';
   }
   else {
       move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name']);
    }

    $xlsx = new SimpleXLSX( 'upload/' . $_FILES['file']['name'] );
   
	
    foreach ($xlsx->rows() as $fields)
    {
       $sku = $fields[0];
$nome = $fields[1];
$descr=$fields[2];
$inicio = $fields[3];
$validade=$fields[4];
$instagram=$fields[7];


$home=$fields[8];

$vtarget_cashback=number_format($fields[5]);
echo"vtargetprice - ";
echo $vtarget_price=number_format($fields[6]);
echo "-";

$limit_order=$fields[9];

//cashback
$sql1="select current_price_pay_only from Products where sku=$fields[0]";
$resultado_pagueapenas = mysqli_query($conn,$sql1);
$vpagueapenas = mysqli_fetch_array($resultado_pagueapenas)[0];

$sql2="select current_cashback from Products where sku=$fields[0]";
$resultado_cashback = mysqli_query($conn,$sql2);
$vatualcashback = mysqli_fetch_array($resultado_cashback)[0];

//custo->qualicash
$sql3="select price_cost from Products where sku=$fields[0]";
$resultado_custo = mysqli_query($conn,$sql3);
echo "custo-"; 
echo $vcusto = mysqli_fetch_array($resultado_custo)[0];


$vpagueapenas =number_format($vpagueapenas,2);
$vatualcashback =number_format($vatualcashback,2);
$vcusto=number_format($vcusto,2);

//echo $vpagueapenas = str_replace(".",",", $vpagueapenas);

//if no cashback 
$target_cashback = ($vpagueapenas * $vtarget_cashback) / 100 ;
echo "***";
echo $price_target = ($vtarget_price * $vcusto ) / 100;
echo "**";
 $target_price = ($vcusto + $price_target);

if ($target_cashback <= 0) {
$target_cashback = $vatualcashback;
};



//if NO PRICE TARGEt


$target_cashback = number_format($target_cashback,2);
$target_price = number_format($target_price,2);

$sql = "INSERT INTO promo (sku, nome, inicio, validade, target_cashback, target_price, limit_order, instagram, home)
VALUES ('$sku','$nome', '$inicio', '$validade', '$target_cashback', $target_price, '$limit_order', $instagram, $home) ON DUPLICATE KEY UPDATE  
nome='$nome', inicio='$inicio', validade='$validade', target_cashback=$target_cashback, target_price='$target_price', limit_order='$limit_order', instagram='$instagram', home='$home'";

if ($conn->query($sql) === TRUE) {
  echo $sku. " - Dados incluidos com Sucesso - Target_Cashback = ".$target_cashback. " - Target_Price = ".$target_price;
} else {
  echo "Erro ao Processar Planilha, Informe o Erro: " . $sql . "Para o Profissional de TI echo " . $conn->error;
echo  "\n";

}

        
		
    }

$conn->close();




?>


