<?php
//Initialize the session
session_start();

header('Content-Type: text/html; charset=UTF-8');

include_once("../config/dbconfig.php");

// Dados de configuração do FTP da precifica
$ftp_server = "ftp.monitor.precifica.com.br";
$ftp_user_name = "qualidoc";
$ftp_user_pass = "q51l3d4c";

$conn_id = ftp_connect($ftp_server); // Estabelece uma conexão FTP

if($conn_id) { // Valida se o FTP realmente existe
    $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); // Efetua login com os dados do FTP
    if($login_result) { // Valida se o login foi efetuado
       $file_path = '../upload/relatorio_qualidoc.csv.zip';
       $d = ftp_get($conn_id, $file_path, 'relatorio_qualidoc.csv.zip', FTP_BINARY);
       if($d) {
         $zip = new ZipArchive;
         $res = $zip->open($file_path);
         if($res) {
             $zip->extractTo("../upload");
             $zip->close();
             $filenamecsv = '../upload/relatorio_qualidoc.csv';
             // echo "<pre>";
             // print_r($res);
             // echo "</pre>";
             // die("teste");
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
                                             '"'.trim(str_replace('";', '', $fields[30])).'"' ?? '',
                                             str_replace('"', '', $fields[16]) != "" ? trim(str_replace(",", ".", str_replace('"', '', $fields[16]))) : 0,
                                             '"'.trim($fields[23]).'"' ?? '',
                                             '"'.trim($fields[24]).'"' ?? '',
                                             '"'.trim($fields[26]).'"' ?? '',
                                             str_replace('"', '', $fields[28]) != "" ? trim(str_replace(",", ".", str_replace('"', '', $fields[28]))) : 0);
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
             unlink($filenamecsv);
             ftp_close($conn_id);
         }
         else {
            $msg = 'Não foi possível descompactar a planilha!';
            $success = false;
         }
       }
       else {
         $msg = 'Não foi possível baixar a última planilha!';
         $success = false;
       }
    }
    else {
       $msg = 'As credenciais do FTP são inválidas!';
       $success = false;
    }
}
else {
    $msg = "FTP inexistente!";
    $success = false;
}

echo json_encode(array('success' => $success, 'msg' => $msg));?>
