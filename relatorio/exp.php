<?php
$buscasku = $_GET['buscasku'];
$buscastatus = $_GET['buscasku'];




/**
 * Connect to MySQL using PDO.
 */

$username = 'admin';
$password = 'KyCKIVFAcmyVmwzji5uO';
$hostname = 'cockpit.c7yft9tue2sa.us-east-2.rds.amazonaws.com:3306';
$database = 'fspider';


    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    				 
//Query our MySQL table
$sql = "SELECT Situation.description FROM Products INNER JOIN Situation on Products.situation_code_fk = Situation.code";
$stmt = $pdo->query($sql);
 
//Retrieve the data from our table.
    
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
//The name of the Excel file that we want to force the
//browser to download.
$filename = 'Total_Produtos.xls';
 
//Send the correct headers to the browser so that it knows
//it is downloading an Excel file.

header("Content-Disposition: attachment; filename=$filename");  


header("Content-Type: application/vnd.ms-excel; charset=UTF-8"); 
header("Pragma: public"); 
header("Expires: 0"); 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download"); 
header("Content-Type: application/octet-stream"); 
header("Content-Type: application/download"); 
header("Content-Disposition: attachment;filename=TotalProdutos.xls "); 
header("Content-Transfer-Encoding: binary "); 
 
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
