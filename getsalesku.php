<?php
date_default_timezone_set('America/Sao_Paulo');



 



 

$hoje = date("Y-m-d");
set_time_limit(0);

include_once("config/dbconfig.php");

function checkmydate($date) {
  $tempDate = explode('-', $date);
  return checkdate($tempDate[1], $tempDate[2], $tempDate[0]);
}




if (isset($_POST['vfilial'])) {
$vfilial = $_POST['vfilial'];

}else{

$vfilial = '1007';
}
 
if (isset($_POST['vdata'])) {
$vdata = $_POST['vdata'];

}else{
$vdata = $hoje;
}


if ($vdata > $hoje){

$vdata=$hoje;

}

//$chkdt=checkmydate($vdata);
//if ($chkdt <> '1') {
//$vdata = $hoje;

//} 



//true

 

$ontem = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $vdata) ) ));
$semana = date('Y-m-d',(strtotime ( '-7 day' , strtotime ( $vdata) ) ));
 

// Iniciamos a função do CURL:
$chA = curl_init("http://ultraclinica.totvscloud.com.br:2000/RMS/RMSSERVICES/ReportWebAPI/api/v1/SaleHistory/GetByDate?filial=1007&dataVenda=".$vdata);
 

curl_setopt_array($chA, [

 

    // Equivalente ao -X:
    CURLOPT_CUSTOMREQUEST => 'GET',

 

    // Equivalente ao -H:
    CURLOPT_HTTPHEADER => [

 

'Content-Type: application/vnd.api+json',
'Accept: application/vnd.api+json'

 


    ],

 

    // Permite obter o resultado
    CURLOPT_RETURNTRANSFER => 1,
]);

 


//$resposta = json_decode(curl_exec($ch), true);
$resposta1 = curl_exec($chA);

$ProductMargin=array();
$arrResp1=array();
$arrResp1 = json_decode($resposta1, true); // o teu array criado a partir do json de resposta
$resposta=($arrResp1["items"]);
foreach ($resposta as $inf){

$sku=$inf['productCode'];

 $sData=$inf['salesDate'];
$sQty=$inf['salesQuantity'];
$sValue=$inf['salesValue'];




$sql = 'SELECT price_cost, department, category FROM Products where sku ="'. $sku .'"';
$result = $conn->query($sql);




if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $price_cost=$row["price_cost"];
    $department=$row["department"];
  $category=$row["category"];








  }
} else {
  echo "0 results";
}

$price_costT=$price_cost * $sQty;


$TotalQtyVendas=$TotalQtyVendas + $sQty;
$TotalValueVendas=$TotalValueVendas + $sValue;
$TotalPriceCost=$TotalPriceCost + $price_costT;


//$ProductMargin[][0]["SKU"]=$sku;
//$ProductMargin["DEPARTAMENTO"]=$department;
//$ProductMargin["CATEGORIA"]=$category;
//$ProductMargin[]["CUSTO"]=$price_cost;
//$ProductMargin[]["QUANTIDADE"]=$sQty;
//$ProductMargin[]["VALOR"]=$sValue;



}

print_r($ProductMargin);

echo $TotalQtyVendas;
echo '<br>';
echo $TotalValueVendas;
echo '<br>';
echo $sTotalPriceCost;
echo '<br>';
echo $sTotalValuePercent = ($TotalPriceCost / $TotalValueVendas) * 100 ."%";
echo "<br>";

?>
