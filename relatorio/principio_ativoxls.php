
<?php
$buscasku = $_GET['buscasku'];
$buscastatus = $_GET['buscasku'];


/**
 * Connect to MySQL using PDO.
 */

$user = 'admin';
$password = 'KyCKIVFAcmyVmwzji5uO';
$server = 'cockpit.c7yft9tue2sa.us-east-2.rds.amazonaws.com:3306';
$database = 'fspider';

$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
 
//Query our MySQL table

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$sql="SELECT principio_ativo.sku as SKU, Products.reference_code as EAN, Products.title as NOME, principio_ativo.uniao as PRINCIPIO_ATIVO,
marca.marca as MARCA, sum(vendas.qtd) as VENDA_ACUMULADA, REPLACE(Products.current_gross_margin_percent, '.',',') as MARGEM_BRUTA,
 REPLACE(Products.diff_current_pay_only_lowest, '.',',') as DISCREPANCIA, Products.department as DEPARTAMENTO, Products.category as CATEGORIA
FROM principio_ativo inner join marca on marca.sku = principio_ativo.sku inner join Products on Products.sku=principio_ativo.sku inner join vendas
on vendas.sku=principio_ativo.sku
WHERE principio_ativo.principio_ativo <> '' and Products.active=1 and Products.descontinuado<>1 and principio_ativo.uniao IN (
    SELECT uniao
    FROM principio_ativo
    GROUP BY uniao
    HAVING COUNT(uniao) > 1
)group by vendas.sku order by principio_ativo.uniao";
$stmt = $pdo->query($sql);
 
//Retrieve the data from our table.
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
//The name of the Excel file that we want to force the
//browser to download.
$filename = 'Total_Produtos.xls';
 
//Send the correct headers to the browser so that it knows
//it is downloading an Excel file.
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename");  
header("Pragma: no-cache"); 
header("Expires: 0");
 header('Content-Type: text/html; charset=utf-8');
//Define the separator line
$separator = "\t";
 
//If our query returned rows
if(!empty($rows)){
    
    //Dynamically print out the column names as the first row in the document.
    //This means that each Excel column will have a header.
    echo implode($separator, array_keys($rows[0])) . "\n";
    
    //Loop through the rows
    foreach($rows as $row){
        
        //Clean the data and remove any special characters that might conflict
        foreach($row as $k => $v){
            $row[$k] = str_replace($separator . "$", "", $row[$k]);
            $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
            $row[$k] = trim($row[$k]);
        }
        
        //Implode and print the columns out using the 
        //$separator as the glue parameter
        echo implode($separator, $row) . "\n";
    }
}
?>
