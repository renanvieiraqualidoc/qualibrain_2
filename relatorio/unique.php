<?php
$buscasku = $_GET['buscasku'];
$buscastatus = $_GET['buscasku'];


/**
 * Connect to MySQL using PDO.
 */
$user = 'root';
$password = 'gab40lan';
$server = 'localhost';
$database = 'fspider';
$pdo = new PDO("mysql:host=$server;dbname=$database", $user, $password);
 
//Query our MySQL table
$sql = "SELECT * FROM Products where active='1' and qty_stock_rms > '0' and qty_competitors='0'";
$stmt = $pdo->query($sql);
 
//Retrieve the data from our table.
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
//The name of the Excel file that we want to force the
//browser to download.
$filename = 'Total_ProdutosEstoqueExclusivo.xls';
 
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
        echo utf8_encode(implode($separator, $row)) . "\n";
    }
}
?>
