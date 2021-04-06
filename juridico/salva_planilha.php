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
       $filenamecsv = '../upload/' . $_FILES['file']['name'];
       if(move_uploaded_file($_FILES['file']['tmp_name'], $filenamecsv)) {
           $file = fopen($filenamecsv, "r");
           $sql = "INSERT INTO produtos_juridico (codigo, descricao, data, url_monitor, preco_custo, website_monitorado, url_monitorado, hora, preco_oferta) VALUES ";
           $i = 0;
           while (($getData = fgetcsv($file, 10000, "|")) !== false) {
             if($i > 0) {
               $fields = explode('";"', $getData[0]);
               if(strpos(trim(explode(';"', $fields[0])[0]), 'IA-') === false) {
                 $fields_array = array();
                 $data_csv = trim(implode('-', array_reverse(explode('/', str_replace('"', '', $fields[25])))));
                 array_push($fields_array,
                                           trim(explode(';"', $fields[0])[0]) ?? 0,
                                           '"'.trim(explode(';"', $fields[0])[1]).'"' ?? '',
                                           '"'.trim(implode('-', array_reverse(explode('/', str_replace('"', '', $fields[25]))))).'"' ?? '""',
                                           '"'.trim(str_replace('";', '', $fields[31])).'"' ?? '',
                                           str_replace('"', '', $fields[16]) != "" ? trim(str_replace(",", ".", str_replace('"', '', $fields[16]))) : 0,
                                           '"'.trim($fields[23]).'"' ?? '',
                                           '"'.trim($fields[24]).'"' ?? '',
                                           '"'.trim($fields[26]).'"' ?? '',
                                           str_replace('"', '', $fields[29]) != "" ? trim(str_replace(",", ".", str_replace('"', '', $fields[29]))) : 0);
                 $sql .= "(".implode(", ", $fields_array)."),\n";
               }
             }
             $i++;
           }
           fclose($file);
           $sql = substr($sql, 0, -2);
           $sql .= ";";
           $dump = "../export_sql/data_".$data_csv.".txt";
           $file_dump = fopen($dump, 'w');
           fwrite($file_dump, $sql);
           fclose($file_dump);
           if(trim(shell_exec("mysql -h ".substr($DATABASE_HOST, 0, strpos($DATABASE_HOST, ':'))." -u$DATABASE_USER -p'$DATABASE_PASS' $DATABASE_NAME < $dump 2>&1"))
                        == "mysql: [Warning] Using a password on the command line interface can be insecure.") {
             $msg = 'Planilha atualizada com sucesso!';
             $success = true;
           }
           else {
             $msg = 'Não foi possível salvar o dump!';
             $success = false;
           }
       }
       else {
           $msg = 'Não foi possível salvar o arquivo!';
           $success = false;
       }
       unlink($filenamecsv);
    }
    echo json_encode(array('success' => $success, 'msg' => $msg));
}?>
