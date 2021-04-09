<?php

// Inicia
$curl = curl_init();

// Configura
curl_setopt_array($curl, [
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'http://ultraclinica.totvscloud.com.br:2000/RMS/RMSSERVICES/PDV/stockprice?MainStore=1007&Store=1007&productid="1039911"'
]);

// Envio e armazenamento da resposta
$response = curl_exec($curl);

// Fecha e limpa recursos
curl_close($curl);

?>
