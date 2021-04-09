<?php

// Inicia
$curl = curl_init();

// Configura
curl_setopt_array($curl, [
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'http://ultraclinica.totvscloud.com.br:2001/RMS/RMSSERVICES/ReportWebAPI/api/v1/SaleHistory/GetCompareSales/RMS/RMSSERVICES/ReportWebAPI/api/v1/SaleHistory/GetByDate?filial=1007&dataVenda=2021-04-08'
]);

// Envio e armazenamento da resposta
$response = curl_exec($curl);

// Fecha e limpa recursos
curl_close($curl);?>
