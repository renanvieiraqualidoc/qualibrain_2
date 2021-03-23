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
    echo "Você não tem permissao para acessar. Entre em contato com o administrador ";
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
           $sql = "INSERT INTO produtos_juridico (codigo, descricao, data, url_monitor, preco_custo, website_monitorado, url_monitorado, hora, preco_oferta) VALUES ";
           $i = 0;
           while (($getData = fgetcsv($file, 10000, "|")[0]) !== false) {
             if($i < 3) {
               $fields = explode(";", $getData);
               // echo trim($fields[0])."<br/>";
               $sql .= "(".trim($fields[0]).", ".trim($fields[1]).", '".trim(implode('-', array_reverse(explode('/', str_replace('"', '', $fields[26])))))."', ".trim($fields[31]).", ".trim(str_replace(",", ".", str_replace('"', '', $fields[17]))).', '.trim($fields[24]).', '.trim($fields[25]).', '.trim($fields[27]).', '.trim(str_replace(",", ".", str_replace('"', '', $fields[17]))).');';
               // echo "<pre>";
               // print_r($fields);
               // echo "</pre>";
               // die($sql);
             }
             $i++;
           }
           die($sql);
           fclose($file);
       }
       else {
           $msg = 'Não foi possível salvar o arquivo!';
           $success = false;
       }
    }

    echo json_encode(array('success' => $success, 'msg' => $msg));
}?>
