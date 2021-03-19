
    
<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


require_once __DIR__.'/SimpleXLSX.php';

header('Content-Type: text/html; charset=utf-8');


// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}



error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);


include_once("config/dbconfig.php");


 if ( 0 < $_FILES['file']['error'] ) {
       echo 'Error: ' . $_FILES['file']['error'] . '<br>';
   }
   else {
       move_uploaded_file($_FILES['file']['tmp_name'], 'upload/' . $_FILES['file']['name']);
    }

    $xlsx = new SimpleXLSX( 'upload/' . $_FILES['file']['name'] );
   
	
    foreach ($xlsx->rows() as $fields)
    {
       $sku = $fields[0];
$fabrica = $fields[1];
$marca=$fields[2];
$nomedavan = $fields[3];
$programa=$fields[4];
$active=$fields[5];




$sql = "INSERT INTO pbm (sku, fabrica, marca, nome_da_van, programa, active)
VALUES ('$sku','$fabrica', '$marca', '$nomedavan', '$programa', $active) ON DUPLICATE KEY UPDATE  
fabrica='$fabrica', marca='$marca', nome_da_van='$nomedavan', programa='$programa', active=$active";

if ($conn->query($sql) === TRUE) {
  echo $sku. " - Dados incluidos com Sucesso";
} else {
  echo "Erro ao Processar Planilha, Informe o Erro: " . $sql . "Para o Profissional de TI echo " . $conn->error;
echo  "\n";

}

        
		
    }

$conn->close();




?>


