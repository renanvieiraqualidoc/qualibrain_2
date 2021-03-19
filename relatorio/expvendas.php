
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


 $sql= "Select vendas.sku as SKU, sum(vendas.qtd) as VENDA_ACUMULADA,  Products.reference_code as EAN, Products.title as NOME, 
 principio_ativo.principio_ativo as PRINCIPIO_ATIVO, principio_ativo.apresentacao as APRESENTACAO, Products.department as DEPARTAMENTO,
Products.category as CATEGORIA, Situation.situation as SITUACAO, Status.status as STATUS, REPLACE(Products.qty_stock_rms,'.',',') as ESTOQUE_RMS, 
REPLACE(tabulated_price, '.', ',' ) as PRECO_TABELADO, REPLACE(tabulated_price_suggestion, '.', ',' )  as SUGESTAO_TABELADO, 
 REPLACE(lowest_price, '.', ',' ) AS MENOR_PRECO,
Products.lowest_price_competitor AS CONCORRENTE_MENOR_PRECO, Products.qty_competitors as QTD_CONCORRENTES,
Products.qty_competitors_available as QTD_CONCORRENTES_ATIVOS, REPLACE(Products.price_cost, '.', ',' ) AS CUSTO, 
 REPLACE(Products.margin, '.', ',' ) AS MARGEM_BRUTA, 
REPLACE(Products.sale_price, '.', ',' ) AS PRECO_DE_VENDA, REPLACE(Products.current_price_pay_only, '.', ',' ) AS PAGUE_APENAS, 
 REPLACE(Products.current_less_price_around, '.',',') as MENOR_PRECO_POR_AI,
 REPLACE(Products.current_margin_value, '.',',') as MARGEM_VALOR, REPLACE(Products.current_cashback, '.',',') as CASHBACK,
REPLACE(current_gross_margin, '.', ',' ) AS MARGEM_APOS_CASHBACK, REPLACE(Products.current_gross_margin_percent, '.',',') as MARGEM_BRUTA_PORCENTO, 
 REPLACE(Products.diff_current_pay_only_lowest, '.',',') as DIFERENCA_PARA_O_MENOR_CONCORRENTE,
Products.curve as CURVA, Products.pbm as PBM, descontinuado.situation as SITUACAO_DESCONTINUADO,
marca.marca as MARCA, marca.fabricante as FABRICANTE, Products.otc as OTC, Products.descontinuado as DESCONTINUADO, 
 Products.controlled_substance as CONTROLADO, Products.active as ATIVO from vendas inner join Products on Products.sku=vendas.sku 
 INNER JOIN Situation on Products.situation_code_fk = Situation.code INNER JOIN Status on Products.status_code_fk = Status.code
INNER JOIN principio_ativo ON principio_ativo.sku = Products.sku INNER JOIN descontinuado on Products.sku = descontinuado.sku 
 INNER JOIN marca on Products.sku = marca.sku where vendas.data='2021-02-15' group by sku";
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
