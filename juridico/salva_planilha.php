<?php
//Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

include_once("../config/dbconfig.php");

$usuario = $_SESSION['username'];

$select_user = "SELECT permission FROM users where username = '$usuario'";
$resultado_user = mysqli_query($conn,$select_user);
$total_user = mysqli_fetch_array($resultado_user)[0];

if ($total_user <> 2) {
    echo "Você não tem permissão para acessar. Entre em contato com o administrador ";
    die();
}
else {
    if ( 0 < $_FILES['file']['error'] ) {
       $msg = 'Error: ' . $_FILES['file']['error'];
       $success = false;
    }
    else {
       $msg = 'upload/'.$_FILES['file']['name'];
       if(move_uploaded_file($_FILES['file']['tmp_name'], '../upload/' . $_FILES['file']['name'])) {
           $file = fopen("../upload/{$_FILES['file']['name']}", "r");
           fwrite($file_dump, "INSERT INTO produtos_juridico (codigo, descricao, data, url_monitor, preco_custo, website_monitorado, url_monitorado, hora, preco_oferta) VALUES ");
           $sql = "INSERT INTO produtos_juridico (codigo, descricao, data, url_monitor, preco_custo, website_monitorado, url_monitorado, hora, preco_oferta) VALUES ";
           $i = 0;
           while (($getData = fgetcsv($file, 10000, "|")) !== false) {
             if($i > 0) {
               $fields = explode(";", $getData[0]);
               $fields_array = array();
               array_push($fields_array,
                                         trim($fields[0]) ?? 0,
                                         trim($fields[1]) ?? '',
                                         '"'.trim(implode('-', array_reverse(explode('/', str_replace('"', '', $fields[26]))))).'"' ?? '""',
                                         trim($fields[31]) ?? '',
                                         trim(str_replace(",", ".", str_replace('"', '', $fields[17]))) ?? 0.00,
                                         trim($fields[24]) ?? '',
                                         trim($fields[25]) ?? '',
                                         trim($fields[27]) ?? '',
                                         str_replace('"', '', $fields[29]) != "" ? trim(str_replace(",", ".", str_replace('"', '', $fields[29]))) : 0);
               $sql .= "(".implode(", ", $fields_array)."),\n";
             }
             $i++;
           }
           fclose($file);
           $sql = substr($sql, 0, -2);
           $sql .= ";";
           $file_dump = fopen('../export_sql/data.sql', 'w');
           fwrite($file_dump, $sql);
           fclose($file_dump);
           $msg = 'Arquivo dump gerado!';
           $success = true;
       }
       else {
           $msg = 'Não foi possível salvar o arquivo!';
           $success = false;
       }
    }

    echo json_encode(array('success' => $success, 'msg' => $msg));
}?>
