<?php

// Inicia
$curl = curl_init();

// Configura
curl_setopt_array($curl, [
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => 'http://dominio-exemplo.com.br/?item=valor-do-item'
]);

// Envio e armazenamento da resposta
$response = curl_exec($curl);

// Fecha e limpa recursos
curl_close($curl);

?>
