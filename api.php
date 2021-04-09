<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//set_time_limit(0);

// Iniciamos a função do CURL:
$chA = curl_init("http://ultraclinica.totvscloud.com.br:2000/RMS/RMSSERVICES/ReportWebAPI/api/v1/SaleHistory/GetCompareSales?filial=1007&dataVenda=2021-04-08");

curl_setopt_array($chA, [
    CURLOPT_CUSTOMREQUEST => 'GET', // Equivalente ao -X:
    CURLOPT_HTTPHEADER => [ // Equivalente ao -H:
      'Content-Type: application/vnd.api+json',
      'Accept: application/vnd.api+json'
    ],
    CURLOPT_RETURNTRANSFER => 1, // Permite obter o resultado
]);

echo $resposta1 = curl_exec($chA);
curl_close($chA);?>
