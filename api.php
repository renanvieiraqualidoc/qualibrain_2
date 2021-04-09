<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//set_time_limit(0);

// Iniciamos a função do CURL:
$chA = curl_init("http://ultraclinica.totvscloud.com.br:2000/RMS/RMSSERVICES/ReportWebAPI/api/v1/SaleHistory/GetCompareSales?filial=1007&dataVenda=".implode('-', array_reverse(explode('/', $_GET['data']))));

curl_setopt_array($chA, [
    CURLOPT_CUSTOMREQUEST => 'GET', // Equivalente ao -X:
    CURLOPT_HTTPHEADER => [ // Equivalente ao -H:
      'Content-Type: application/vnd.api+json',
      'Accept: application/vnd.api+json'
    ],
    CURLOPT_RETURNTRANSFER => 1, // Permite obter o resultado
]);

// echo $resposta1 = curl_exec($chA);

// $response = [{"items":[{"hour":0,"date":"08/04/2021 00:00:00","quantity":20,"value":2346.86,"avgTicket":117.34,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":7,"valueDayBefore":487.23,"avgTicketDayBefore":69.6,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":28,"valueWeekAgo":3606.4,"avgTicketWeekAgo":128.8},{"hour":1,"date":"08/04/2021 00:00:00","quantity":5,"value":2040.6,"avgTicket":408.12,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":3,"valueDayBefore":352.49,"avgTicketDayBefore":117.5,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":6,"valueWeekAgo":497.82,"avgTicketWeekAgo":82.97},{"hour":2,"date":"08/04/2021 00:00:00","quantity":5,"value":783.25,"avgTicket":156.65,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":3,"valueDayBefore":168.92,"avgTicketDayBefore":56.31,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":3,"valueWeekAgo":260.17,"avgTicketWeekAgo":86.72},{"hour":3,"date":"08/04/2021 00:00:00","quantity":3,"value":261.58,"avgTicket":87.19,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":1,"valueDayBefore":47.72,"avgTicketDayBefore":47.72,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":3,"valueWeekAgo":126.77,"avgTicketWeekAgo":42.26},{"hour":4,"date":"08/04/2021 00:00:00","quantity":41,"value":4561.11,"avgTicket":111.25,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":51,"valueDayBefore":5655.26,"avgTicketDayBefore":110.89,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":48,"valueWeekAgo":6832.35,"avgTicketWeekAgo":142.34},{"hour":5,"date":"08/04/2021 00:00:00","quantity":6,"value":419.94,"avgTicket":69.99,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":10,"valueDayBefore":1534.24,"avgTicketDayBefore":153.42,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":2,"valueWeekAgo":217.06,"avgTicketWeekAgo":108.53},{"hour":6,"date":"08/04/2021 00:00:00","quantity":12,"value":1514.87,"avgTicket":126.24,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":16,"valueDayBefore":1685.71,"avgTicketDayBefore":105.36,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":18,"valueWeekAgo":2375.91,"avgTicketWeekAgo":132.0},{"hour":7,"date":"08/04/2021 00:00:00","quantity":17,"value":1980.19,"avgTicket":116.48,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":22,"valueDayBefore":3362.09,"avgTicketDayBefore":152.82,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":11,"valueWeekAgo":2078.71,"avgTicketWeekAgo":188.97},{"hour":8,"date":"08/04/2021 00:00:00","quantity":28,"value":3337.34,"avgTicket":119.19,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":35,"valueDayBefore":3571.8,"avgTicketDayBefore":102.05,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":35,"valueWeekAgo":6201.77,"avgTicketWeekAgo":177.19},{"hour":9,"date":"08/04/2021 00:00:00","quantity":46,"value":5098.2,"avgTicket":110.83,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":50,"valueDayBefore":5490.18,"avgTicketDayBefore":109.8,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":55,"valueWeekAgo":8533.01,"avgTicketWeekAgo":155.15},{"hour":10,"date":"08/04/2021 00:00:00","quantity":76,"value":7422.69,"avgTicket":97.67,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":81,"valueDayBefore":9026.63,"avgTicketDayBefore":111.44,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":55,"valueWeekAgo":7100.43,"avgTicketWeekAgo":129.1},{"hour":11,"date":"08/04/2021 00:00:00","quantity":63,"value":6347.67,"avgTicket":100.76,"dayBefore":"07/04/2021 00:00:00","quantityDayBefore":74,"valueDayBefore":8991.09,"avgTicketDayBefore":121.5,"weekAgo":"01/04/2021 00:00:00","quantityWeekAgo":61,"valueWeekAgo":6754.15,"avgTicketWeekAgo":110.72}],"quantityItems":12,"item":null}];

// echo $response;
curl_close($chA);?>
