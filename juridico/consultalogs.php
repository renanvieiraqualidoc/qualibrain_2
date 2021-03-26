<?php
//Initialize the session
session_start();

header('Content-Type: text/html; charset=UTF-8');

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

include_once("../config/dbconfig.php");

$response = array();
$query = "SELECT * FROM produtos_juridico
          ORDER BY {$_GET['sort_by']} {$_GET['sort_order']}, id ASC
          LIMIT {$_GET['per_page']} OFFSET ".(($_GET['page']-1)*$_GET['per_page']);
//die("<pre>$query</pre>");
$results = mysqli_query($conn,$query);
while($row = mysqli_fetch_array($results)) {
    array_push($response, array('codigo' => $row['codigo'],
                                'descricao' => $row['descricao'],
                                'preco_custo' => $row['preco_custo'],
                                'website_monitorado' => $row['website_monitorado'],
                                'url_monitorado' => $row['url_monitorado'],
                                'data' => implode('/', array_reverse(explode('-', str_replace('"', '', $row['data'])))),
                                'hora' => date ('H:i',strtotime($row['hora'])),
                                'preco_oferta' => $row['preco_oferta'],
                                'url_monitor' => $row['url_monitor']));
}

$query = "SELECT COUNT(*) AS qtd FROM produtos_juridico";
$results = mysqli_query($conn,$query);
$qtd = mysqli_fetch_array($results)[0];

echo json_encode(array ('page' => $_GET['page'],
                        'results' => $response,
                        'total_pages' => intdiv($qtd, $_GET['per_page']),
                        'total_results' => $qtd));?>
