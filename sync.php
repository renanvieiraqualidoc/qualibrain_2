<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

include_once("config/dbconfig.php");

// DEFINE O FUSO HORARIO COMO O HORARIO DE BRASILIA
    date_default_timezone_set('America/Sao_Paulo');
// CRIA UMA VARIAVEL E ARMAZENA A HORA ATUAL DO FUSO-HORÀRIO DEFINIDO (BRASÍLIA)
   echo $dataLocal = date("Y-m-d H:i:s");

$updata = "UPDATE Products SET update_time = '.$dataLocal.'";
if ($conn->query($updata) === TRUE) {
  echo "Atualizar Data --> OK <br>";
} else {
  echo "Error: " . $updata . "<br>" . $conn->error;
}



$sync_insert = "INSERT IGNORE INTO fspider.Products (sku) 
SELECT sku FROM cockpit.Products";


sleep(3);

if ($conn->query($sync_insert) === TRUE) {
  echo "Inserir novos SKU'S --> OK <br>";
} else {
  echo "Error: " . $sync_insert . "<br>" . $conn->error;
}


$sync2_insert = "INSERT IGNORE INTO fspider.descontinuado (sku) 
SELECT sku FROM cockpit.Products";

sleep(3);


if ($conn->query($sync2_insert) === TRUE) {
  echo "Inserir novos SKU'S para descontinuados--> OK <br>";
} else {
  echo "Error: " . $sync2_insert . "<br>" . $conn->error;
}

$sync3_insert = "INSERT IGNORE INTO fspider.principio_ativo (sku) 
SELECT sku FROM cockpit.Products";

sleep(3);

if ($conn->query($sync3_insert) === TRUE) {
  echo "Inserir novos SKU'S para principio ativo --> OK <br>";
} else {
  echo "Error: " . $sync3_insert . "<br>" . $conn->error;
}
sleep(3);

$sync4_insert = "INSERT IGNORE INTO fspider.marca (sku) 
SELECT sku FROM cockpit.Products";

if ($conn->query($sync4_insert) === TRUE) {
  echo "Inserir novos SKU'S para marcas e fabricantes --> OK <br>";
} else {
  echo "Error: " . $sync4_insert . "<br>" . $conn->error;
}


sleep(3);



$sync_update="UPDATE fspider.Products INNER JOIN cockpit.Products ON (fspider.Products.sku = cockpit.Products.sku) SET fspider.Products.current_cashback = cockpit.Products.current_cashback, fspider.Products.status_code_fk=cockpit.Products.status_code_fk,
fspider.Products.situation_code_fk = cockpit.Products.situation_code_fk,
fspider.Products.title = cockpit.Products.title,
fspider.Products.active = cockpit.Products.active,
fspider.Products.department = cockpit.Products.department,
fspider.Products.category = cockpit.Products.category,
fspider.Products.qty_stock = cockpit.Products.qty_stock,
fspider.Products.qty_stock_rms = cockpit.Products.qty_stock_rms,
fspider.Products.tabulated_price = cockpit.Products.tabulated_price,
fspider.Products.tabulated_price_suggestion = cockpit.Products.tabulated_price_suggestion,
fspider.Products.minimum_price = cockpit.Products.minimum_price,
fspider.Products.maximum_price = cockpit.Products.maximum_price,
fspider.Products.lowest_price = cockpit.Products.lowest_price,
fspider.Products.lowest_price_competitor = cockpit.Products.lowest_price_competitor,
fspider.Products.qty_competitors = cockpit.Products.qty_competitors,
fspider.Products.qty_competitors_available = cockpit.Products.qty_competitors_available,
fspider.Products.price_cost = cockpit.Products.price_cost,
fspider.Products.margin = cockpit.Products.margin,
fspider.Products.sale_price = cockpit.Products.sale_price,
fspider.Products.price_pay_only = cockpit.Products.price_pay_only,
fspider.Products.less_price_around = cockpit.Products.less_price_around,
fspider.Products.margin_value = cockpit.Products.margin_value,
fspider.Products.cashback = cockpit.Products.cashback,
fspider.Products.gross_margin = cockpit.Products.gross_margin,
fspider.Products.gross_margin_percent = cockpit.Products.gross_margin_percent,
fspider.Products.diff_pay_only_lowest = cockpit.Products.diff_pay_only_lowest,
fspider.Products.current_price_pay_only = cockpit.Products.current_price_pay_only,
fspider.Products.current_less_price_around = cockpit.Products.current_less_price_around,
fspider.Products.current_margin_value = cockpit.Products.current_margin_value,
fspider.Products.current_gross_margin = cockpit.Products.current_gross_margin,
fspider.Products.current_gross_margin_percent = cockpit.Products.current_gross_margin_percent,
fspider.Products.diff_current_pay_only_lowest = cockpit.Products.diff_current_pay_only_lowest";

if ($conn->query($sync_update) === TRUE) {
  echo "Atualizar Novos SKU's --> OK <br>";
} else {
  echo "Error: " . $sync_update . "<br>" . $conn->error;
}  

sleep(3);

$uppbm= "UPDATE Products AS b INNER JOIN pbm AS g ON b.sku = g.sku SET b.pbm = 1";

if ($conn->query($uppbm) === TRUE) {
  echo "Atualizar Novos PBMs --> OK <br>";
} else {
  echo "Error: " . $uppbm . "<br>" . $conn->error;
}  

sleep(3);

$upotc= "UPDATE Products AS b INNER JOIN otc AS g ON b.sku = g.sku SET b.otc = 1";

if ($conn->query($upotc) === TRUE) {
  echo "Atualizar Novos OTCs --> OK <br>";
} else {
  echo "Error: " . $upotc . "<br>" . $conn->error;
}  

sleep(3);

$upcontrolados= "UPDATE Products AS b INNER JOIN controlados AS g ON b.sku = g.sku SET b.controlled_substance = 1";

if ($conn->query($upcontrolados) === TRUE) {
  echo "Atualizar Novos Controlados --> OK <br>";
} else {
  echo "Error: " . $upcontrolados . "<br>" . $conn->error;
}  

sleep(3);
$updescontinuado= "UPDATE Products AS b INNER JOIN descontinuado AS g ON b.sku = g.sku SET b.descontinuado = 1 where g.situation = 'Definitivamente' or g.situation='Temporariamente'";

if ($conn->query($updescontinuado) === TRUE) {
  echo "Atualizar Novos Descontinuados --> OK <br>";
} else {
  echo "Error: " . $updescontinuado . "<br>" . $conn->error;
}  


sleep(3);


$upconcatprin= "UPDATE principio_ativo SET uniao=CONCAT('principio_ativo.principio_ativo ',' ', 'principio_ativo.apresentacao'), situacao =1 where situacao <>1";

if ($conn->query($upconcatprin) === TRUE) {
  echo "Concat Principio_ATivo --> OK <br>";
} else {
  echo "Error: " . $upconcatprin . "<br>" . $conn->error;
}  


sleep(3);

$sqlta1="UPDATE Products SET title = REPLACE(title,'Š','S')";	if ($conn->query($sqlta1) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta2="UPDATE Products SET title = REPLACE(title,'š','s')";	if ($conn->query($sqlta2) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta3="UPDATE Products SET title = REPLACE(title,'Ð','Dj')";	if ($conn->query($sqlta3) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta4="UPDATE Products SET title = REPLACE(title,'Ž','Z')";	if ($conn->query($sqlta4) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta5="UPDATE Products SET title = REPLACE(title,'ž','z')";	if ($conn->query($sqlta5) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta6="UPDATE Products SET title = REPLACE(title,'À','A')";	if ($conn->query($sqlta6) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta7="UPDATE Products SET title = REPLACE(title,'Á','A')";	if ($conn->query($sqlta7) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta8="UPDATE Products SET title = REPLACE(title,'Â','A')";	if ($conn->query($sqlta8) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta9="UPDATE Products SET title = REPLACE(title,'Ã','A')";	if ($conn->query($sqlta9) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta10="UPDATE Products SET title = REPLACE(title,'Ä','A')";	if ($conn->query($sqlta10) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta11="UPDATE Products SET title = REPLACE(title,'Å','A')";	if ($conn->query($sqlta11) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta12="UPDATE Products SET title = REPLACE(title,'Æ','A')";	if ($conn->query($sqlta12) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta13="UPDATE Products SET title = REPLACE(title,'Ç','C')";	if ($conn->query($sqlta13) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta14="UPDATE Products SET title = REPLACE(title,'È','E')";	if ($conn->query($sqlta14) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta15="UPDATE Products SET title = REPLACE(title,'É','E')";	if ($conn->query($sqlta15) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta16="UPDATE Products SET title = REPLACE(title,'Ê','E')";	if ($conn->query($sqlta16) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta17="UPDATE Products SET title = REPLACE(title,'Ë','E')";	if ($conn->query($sqlta17) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta18="UPDATE Products SET title = REPLACE(title,'Ì','I')";	if ($conn->query($sqlta18) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta19="UPDATE Products SET title = REPLACE(title,'Í','I')";	if ($conn->query($sqlta19) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta20="UPDATE Products SET title = REPLACE(title,'Î','I')";	if ($conn->query($sqlta20) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta21="UPDATE Products SET title = REPLACE(title,'Ï','I')";	if ($conn->query($sqlta21) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta22="UPDATE Products SET title = REPLACE(title,'Ñ','N')";	if ($conn->query($sqlta22) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta23="UPDATE Products SET title = REPLACE(title,'Ò','O')";	if ($conn->query($sqlta23) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta24="UPDATE Products SET title = REPLACE(title,'Ó','O')";	if ($conn->query($sqlta24) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta25="UPDATE Products SET title = REPLACE(title,'Ô','O')";	if ($conn->query($sqlta25) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta26="UPDATE Products SET title = REPLACE(title,'Õ','O')";	if ($conn->query($sqlta26) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta27="UPDATE Products SET title = REPLACE(title,'Ö','O')";	if ($conn->query($sqlta27) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta28="UPDATE Products SET title = REPLACE(title,'Ø','O')";	if ($conn->query($sqlta28) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta29="UPDATE Products SET title = REPLACE(title,'Ù','U')";	if ($conn->query($sqlta29) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta30="UPDATE Products SET title = REPLACE(title,'Ú','U')";	if ($conn->query($sqlta30) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta31="UPDATE Products SET title = REPLACE(title,'Û','U')";	if ($conn->query($sqlta31) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta32="UPDATE Products SET title = REPLACE(title,'Ü','U')";	if ($conn->query($sqlta32) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta33="UPDATE Products SET title = REPLACE(title,'Ý','Y')";	if ($conn->query($sqlta33) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta34="UPDATE Products SET title = REPLACE(title,'Þ','B')";	if ($conn->query($sqlta34) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta35="UPDATE Products SET title = REPLACE(title,'ß','Ss')";	if ($conn->query($sqlta35) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta36="UPDATE Products SET title = REPLACE(title,'à','a')";	if ($conn->query($sqlta36) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta37="UPDATE Products SET title = REPLACE(title,'á','a')";	if ($conn->query($sqlta37) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta38="UPDATE Products SET title = REPLACE(title,'â','a')";	if ($conn->query($sqlta38) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta39="UPDATE Products SET title = REPLACE(title,'ã','a')";	if ($conn->query($sqlta39) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta40="UPDATE Products SET title = REPLACE(title,'ä','a')";	if ($conn->query($sqlta40) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta41="UPDATE Products SET title = REPLACE(title,'å','a')";	if ($conn->query($sqlta41) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta42="UPDATE Products SET title = REPLACE(title,'æ','a')";	if ($conn->query($sqlta42) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta43="UPDATE Products SET title = REPLACE(title,'ç','c')";	if ($conn->query($sqlta43) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta44="UPDATE Products SET title = REPLACE(title,'è','e')";	if ($conn->query($sqlta44) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta45="UPDATE Products SET title = REPLACE(title,'é','e')";	if ($conn->query($sqlta45) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta46="UPDATE Products SET title = REPLACE(title,'ê','e')";	if ($conn->query($sqlta46) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta47="UPDATE Products SET title = REPLACE(title,'ë','e')";	if ($conn->query($sqlta47) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta48="UPDATE Products SET title = REPLACE(title,'ì','i')";	if ($conn->query($sqlta48) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta49="UPDATE Products SET title = REPLACE(title,'í','i')";	if ($conn->query($sqlta49) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta50="UPDATE Products SET title = REPLACE(title,'î','i')";	if ($conn->query($sqlta50) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta51="UPDATE Products SET title = REPLACE(title,'ï','i')";	if ($conn->query($sqlta51) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta52="UPDATE Products SET title = REPLACE(title,'ð','o')";	if ($conn->query($sqlta52) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta53="UPDATE Products SET title = REPLACE(title,'ñ','n')";	if ($conn->query($sqlta53) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta54="UPDATE Products SET title = REPLACE(title,'ò','o')";	if ($conn->query($sqlta54) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta55="UPDATE Products SET title = REPLACE(title,'ó','o')";	if ($conn->query($sqlta55) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta56="UPDATE Products SET title = REPLACE(title,'ô','o')";	if ($conn->query($sqlta56) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta57="UPDATE Products SET title = REPLACE(title,'õ','o')";	if ($conn->query($sqlta57) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta58="UPDATE Products SET title = REPLACE(title,'ö','o')";	if ($conn->query($sqlta58) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta59="UPDATE Products SET title = REPLACE(title,'ø','o')";	if ($conn->query($sqlta59) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta60="UPDATE Products SET title = REPLACE(title,'ù','u')";	if ($conn->query($sqlta60) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta61="UPDATE Products SET title = REPLACE(title,'ú','u')";	if ($conn->query($sqlta61) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta62="UPDATE Products SET title = REPLACE(title,'û','u')";	if ($conn->query($sqlta62) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta63="UPDATE Products SET title = REPLACE(title,'ý','y')";	if ($conn->query($sqlta63) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta64="UPDATE Products SET title = REPLACE(title,'ý','y')";	if ($conn->query($sqlta64) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta65="UPDATE Products SET title = REPLACE(title,'þ','b')";	if ($conn->query($sqlta65) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta66="UPDATE Products SET title = REPLACE(title,'ÿ','y')";	if ($conn->query($sqlta66) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta67="UPDATE Products SET title = REPLACE(title,'ƒ','f')";	if ($conn->query($sqlta67) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta68="UPDATE Products SET title = REPLACE(title,'ě','e')";	if ($conn->query($sqlta68) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta69="UPDATE Products SET title = REPLACE(title,'ž','z')";	if ($conn->query($sqlta69) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta70="UPDATE Products SET title = REPLACE(title,'š','s')";	if ($conn->query($sqlta70) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta71="UPDATE Products SET title = REPLACE(title,'č','c')";	if ($conn->query($sqlta71) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta72="UPDATE Products SET title = REPLACE(title,'ř','r')";	if ($conn->query($sqlta72) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta73="UPDATE Products SET title = REPLACE(title,'ď','d')";	if ($conn->query($sqlta73) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta74="UPDATE Products SET title = REPLACE(title,'ť','t')";	if ($conn->query($sqlta74) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta75="UPDATE Products SET title = REPLACE(title,'ň','n')";	if ($conn->query($sqlta75) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta76="UPDATE Products SET title = REPLACE(title,'ů','u')";	if ($conn->query($sqlta76) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta77="UPDATE Products SET title = REPLACE(title,'Ě','E')";	if ($conn->query($sqlta77) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta78="UPDATE Products SET title = REPLACE(title,'Ž','Z')";	if ($conn->query($sqlta78) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta79="UPDATE Products SET title = REPLACE(title,'Š','S')";	if ($conn->query($sqlta79) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta80="UPDATE Products SET title = REPLACE(title,'Č','C')";	if ($conn->query($sqlta80) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta81="UPDATE Products SET title = REPLACE(title,'Ř','R')";	if ($conn->query($sqlta81) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta82="UPDATE Products SET title = REPLACE(title,'Ď','D')";	if ($conn->query($sqlta82) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta83="UPDATE Products SET title = REPLACE(title,'Ť','T')";	if ($conn->query($sqlta83) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta84="UPDATE Products SET title = REPLACE(title,'Ň','N')";	if ($conn->query($sqlta84) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta85="UPDATE Products SET title = REPLACE(title,'Ů','U')";	if ($conn->query($sqlta85) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta86="UPDATE Products SET department = REPLACE(department,'Š','S')";	if ($conn->query($sqlta86) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta87="UPDATE Products SET department = REPLACE(department,'š','s')";	if ($conn->query($sqlta87) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta88="UPDATE Products SET department = REPLACE(department,'Ð','Dj')";	if ($conn->query($sqlta88) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta89="UPDATE Products SET department = REPLACE(department,'Ž','Z')";	if ($conn->query($sqlta89) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta90="UPDATE Products SET department = REPLACE(department,'ž','z')";	if ($conn->query($sqlta90) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta91="UPDATE Products SET department = REPLACE(department,'À','A')";	if ($conn->query($sqlta91) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta92="UPDATE Products SET department = REPLACE(department,'Á','A')";	if ($conn->query($sqlta92) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta93="UPDATE Products SET department = REPLACE(department,'Â','A')";	if ($conn->query($sqlta93) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta94="UPDATE Products SET department = REPLACE(department,'Ã','A')";	if ($conn->query($sqlta94) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta95="UPDATE Products SET department = REPLACE(department,'Ä','A')";	if ($conn->query($sqlta95) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta96="UPDATE Products SET department = REPLACE(department,'Å','A')";	if ($conn->query($sqlta96) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta97="UPDATE Products SET department = REPLACE(department,'Æ','A')";	if ($conn->query($sqlta97) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta98="UPDATE Products SET department = REPLACE(department,'Ç','C')";	if ($conn->query($sqlta98) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta99="UPDATE Products SET department = REPLACE(department,'È','E')";	if ($conn->query($sqlta99) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta100="UPDATE Products SET department = REPLACE(department,'É','E')";	if ($conn->query($sqlta100) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta101="UPDATE Products SET department = REPLACE(department,'Ê','E')";	if ($conn->query($sqlta101) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta102="UPDATE Products SET department = REPLACE(department,'Ë','E')";	if ($conn->query($sqlta102) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta103="UPDATE Products SET department = REPLACE(department,'Ì','I')";	if ($conn->query($sqlta103) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta104="UPDATE Products SET department = REPLACE(department,'Í','I')";	if ($conn->query($sqlta104) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta105="UPDATE Products SET department = REPLACE(department,'Î','I')";	if ($conn->query($sqlta105) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta106="UPDATE Products SET department = REPLACE(department,'Ï','I')";	if ($conn->query($sqlta106) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta107="UPDATE Products SET department = REPLACE(department,'Ñ','N')";	if ($conn->query($sqlta107) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta108="UPDATE Products SET department = REPLACE(department,'Ò','O')";	if ($conn->query($sqlta108) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta109="UPDATE Products SET department = REPLACE(department,'Ó','O')";	if ($conn->query($sqlta109) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta110="UPDATE Products SET department = REPLACE(department,'Ô','O')";	if ($conn->query($sqlta110) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta111="UPDATE Products SET department = REPLACE(department,'Õ','O')";	if ($conn->query($sqlta111) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta112="UPDATE Products SET department = REPLACE(department,'Ö','O')";	if ($conn->query($sqlta112) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta113="UPDATE Products SET department = REPLACE(department,'Ø','O')";	if ($conn->query($sqlta113) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta114="UPDATE Products SET department = REPLACE(department,'Ù','U')";	if ($conn->query($sqlta114) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta115="UPDATE Products SET department = REPLACE(department,'Ú','U')";	if ($conn->query($sqlta115) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta116="UPDATE Products SET department = REPLACE(department,'Û','U')";	if ($conn->query($sqlta116) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta117="UPDATE Products SET department = REPLACE(department,'Ü','U')";	if ($conn->query($sqlta117) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta118="UPDATE Products SET department = REPLACE(department,'Ý','Y')";	if ($conn->query($sqlta118) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta119="UPDATE Products SET department = REPLACE(department,'Þ','B')";	if ($conn->query($sqlta119) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta120="UPDATE Products SET department = REPLACE(department,'ß','Ss')";	if ($conn->query($sqlta120) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta121="UPDATE Products SET department = REPLACE(department,'à','a')";	if ($conn->query($sqlta121) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta122="UPDATE Products SET department = REPLACE(department,'á','a')";	if ($conn->query($sqlta122) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta123="UPDATE Products SET department = REPLACE(department,'â','a')";	if ($conn->query($sqlta123) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta124="UPDATE Products SET department = REPLACE(department,'ã','a')";	if ($conn->query($sqlta124) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta125="UPDATE Products SET department = REPLACE(department,'ä','a')";	if ($conn->query($sqlta125) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta126="UPDATE Products SET department = REPLACE(department,'å','a')";	if ($conn->query($sqlta126) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta127="UPDATE Products SET department = REPLACE(department,'æ','a')";	if ($conn->query($sqlta127) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta128="UPDATE Products SET department = REPLACE(department,'ç','c')";	if ($conn->query($sqlta128) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta129="UPDATE Products SET department = REPLACE(department,'è','e')";	if ($conn->query($sqlta129) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta130="UPDATE Products SET department = REPLACE(department,'é','e')";	if ($conn->query($sqlta130) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta131="UPDATE Products SET department = REPLACE(department,'ê','e')";	if ($conn->query($sqlta131) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta132="UPDATE Products SET department = REPLACE(department,'ë','e')";	if ($conn->query($sqlta132) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta133="UPDATE Products SET department = REPLACE(department,'ì','i')";	if ($conn->query($sqlta133) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta134="UPDATE Products SET department = REPLACE(department,'í','i')";	if ($conn->query($sqlta134) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta135="UPDATE Products SET department = REPLACE(department,'î','i')";	if ($conn->query($sqlta135) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta136="UPDATE Products SET department = REPLACE(department,'ï','i')";	if ($conn->query($sqlta136) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta137="UPDATE Products SET department = REPLACE(department,'ð','o')";	if ($conn->query($sqlta137) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta138="UPDATE Products SET department = REPLACE(department,'ñ','n')";	if ($conn->query($sqlta138) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta139="UPDATE Products SET department = REPLACE(department,'ò','o')";	if ($conn->query($sqlta139) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta140="UPDATE Products SET department = REPLACE(department,'ó','o')";	if ($conn->query($sqlta140) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta141="UPDATE Products SET department = REPLACE(department,'ô','o')";	if ($conn->query($sqlta141) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta142="UPDATE Products SET department = REPLACE(department,'õ','o')";	if ($conn->query($sqlta142) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta143="UPDATE Products SET department = REPLACE(department,'ö','o')";	if ($conn->query($sqlta143) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta144="UPDATE Products SET department = REPLACE(department,'ø','o')";	if ($conn->query($sqlta144) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta145="UPDATE Products SET department = REPLACE(department,'ù','u')";	if ($conn->query($sqlta145) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta146="UPDATE Products SET department = REPLACE(department,'ú','u')";	if ($conn->query($sqlta146) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta147="UPDATE Products SET department = REPLACE(department,'û','u')";	if ($conn->query($sqlta147) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta148="UPDATE Products SET department = REPLACE(department,'ý','y')";	if ($conn->query($sqlta148) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta149="UPDATE Products SET department = REPLACE(department,'ý','y')";	if ($conn->query($sqlta149) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta150="UPDATE Products SET department = REPLACE(department,'þ','b')";	if ($conn->query($sqlta150) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta151="UPDATE Products SET department = REPLACE(department,'ÿ','y')";	if ($conn->query($sqlta151) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta152="UPDATE Products SET department = REPLACE(department,'ƒ','f')";	if ($conn->query($sqlta152) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta153="UPDATE Products SET department = REPLACE(department,'ě','e')";	if ($conn->query($sqlta153) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta154="UPDATE Products SET department = REPLACE(department,'ž','z')";	if ($conn->query($sqlta154) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta155="UPDATE Products SET department = REPLACE(department,'š','s')";	if ($conn->query($sqlta155) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta156="UPDATE Products SET department = REPLACE(department,'č','c')";	if ($conn->query($sqlta156) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta157="UPDATE Products SET department = REPLACE(department,'ř','r')";	if ($conn->query($sqlta157) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta158="UPDATE Products SET department = REPLACE(department,'ď','d')";	if ($conn->query($sqlta158) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta159="UPDATE Products SET department = REPLACE(department,'ť','t')";	if ($conn->query($sqlta159) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta160="UPDATE Products SET department = REPLACE(department,'ň','n')";	if ($conn->query($sqlta160) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta161="UPDATE Products SET department = REPLACE(department,'ů','u')";	if ($conn->query($sqlta161) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta162="UPDATE Products SET department = REPLACE(department,'Ě','E')";	if ($conn->query($sqlta162) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta163="UPDATE Products SET department = REPLACE(department,'Ž','Z')";	if ($conn->query($sqlta163) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta164="UPDATE Products SET department = REPLACE(department,'Š','S')";	if ($conn->query($sqlta164) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta165="UPDATE Products SET department = REPLACE(department,'Č','C')";	if ($conn->query($sqlta165) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta166="UPDATE Products SET department = REPLACE(department,'Ř','R')";	if ($conn->query($sqlta166) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta167="UPDATE Products SET department = REPLACE(department,'Ď','D')";	if ($conn->query($sqlta167) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta168="UPDATE Products SET department = REPLACE(department,'Ť','T')";	if ($conn->query($sqlta168) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta169="UPDATE Products SET department = REPLACE(department,'Ň','N')";	if ($conn->query($sqlta169) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta170="UPDATE Products SET department = REPLACE(department,'Ů','U')";	if ($conn->query($sqlta170) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta171="UPDATE Products SET category = REPLACE(category,'Š','S')";	if ($conn->query($sqlta171) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta172="UPDATE Products SET category = REPLACE(category,'š','s')";	if ($conn->query($sqlta172) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta173="UPDATE Products SET category = REPLACE(category,'Ð','Dj')";	if ($conn->query($sqlta173) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta174="UPDATE Products SET category = REPLACE(category,'Ž','Z')";	if ($conn->query($sqlta174) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta175="UPDATE Products SET category = REPLACE(category,'ž','z')";	if ($conn->query($sqlta175) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta176="UPDATE Products SET category = REPLACE(category,'À','A')";	if ($conn->query($sqlta176) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta177="UPDATE Products SET category = REPLACE(category,'Á','A')";	if ($conn->query($sqlta177) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta178="UPDATE Products SET category = REPLACE(category,'Â','A')";	if ($conn->query($sqlta178) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta179="UPDATE Products SET category = REPLACE(category,'Ã','A')";	if ($conn->query($sqlta179) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta180="UPDATE Products SET category = REPLACE(category,'Ä','A')";	if ($conn->query($sqlta180) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta181="UPDATE Products SET category = REPLACE(category,'Å','A')";	if ($conn->query($sqlta181) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta182="UPDATE Products SET category = REPLACE(category,'Æ','A')";	if ($conn->query($sqlta182) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta183="UPDATE Products SET category = REPLACE(category,'Ç','C')";	if ($conn->query($sqlta183) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta184="UPDATE Products SET category = REPLACE(category,'È','E')";	if ($conn->query($sqlta184) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta185="UPDATE Products SET category = REPLACE(category,'É','E')";	if ($conn->query($sqlta185) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta186="UPDATE Products SET category = REPLACE(category,'Ê','E')";	if ($conn->query($sqlta186) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta187="UPDATE Products SET category = REPLACE(category,'Ë','E')";	if ($conn->query($sqlta187) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta188="UPDATE Products SET category = REPLACE(category,'Ì','I')";	if ($conn->query($sqlta188) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta189="UPDATE Products SET category = REPLACE(category,'Í','I')";	if ($conn->query($sqlta189) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta190="UPDATE Products SET category = REPLACE(category,'Î','I')";	if ($conn->query($sqlta190) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta191="UPDATE Products SET category = REPLACE(category,'Ï','I')";	if ($conn->query($sqlta191) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta192="UPDATE Products SET category = REPLACE(category,'Ñ','N')";	if ($conn->query($sqlta192) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta193="UPDATE Products SET category = REPLACE(category,'Ò','O')";	if ($conn->query($sqlta193) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta194="UPDATE Products SET category = REPLACE(category,'Ó','O')";	if ($conn->query($sqlta194) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta195="UPDATE Products SET category = REPLACE(category,'Ô','O')";	if ($conn->query($sqlta195) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta196="UPDATE Products SET category = REPLACE(category,'Õ','O')";	if ($conn->query($sqlta196) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta197="UPDATE Products SET category = REPLACE(category,'Ö','O')";	if ($conn->query($sqlta197) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta198="UPDATE Products SET category = REPLACE(category,'Ø','O')";	if ($conn->query($sqlta198) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta199="UPDATE Products SET category = REPLACE(category,'Ù','U')";	if ($conn->query($sqlta199) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta200="UPDATE Products SET category = REPLACE(category,'Ú','U')";	if ($conn->query($sqlta200) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta201="UPDATE Products SET category = REPLACE(category,'Û','U')";	if ($conn->query($sqlta201) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta202="UPDATE Products SET category = REPLACE(category,'Ü','U')";	if ($conn->query($sqlta202) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta203="UPDATE Products SET category = REPLACE(category,'Ý','Y')";	if ($conn->query($sqlta203) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta204="UPDATE Products SET category = REPLACE(category,'Þ','B')";	if ($conn->query($sqlta204) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta205="UPDATE Products SET category = REPLACE(category,'ß','Ss')";	if ($conn->query($sqlta205) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta206="UPDATE Products SET category = REPLACE(category,'à','a')";	if ($conn->query($sqlta206) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta207="UPDATE Products SET category = REPLACE(category,'á','a')";	if ($conn->query($sqlta207) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta208="UPDATE Products SET category = REPLACE(category,'â','a')";	if ($conn->query($sqlta208) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta209="UPDATE Products SET category = REPLACE(category,'ã','a')";	if ($conn->query($sqlta209) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta210="UPDATE Products SET category = REPLACE(category,'ä','a')";	if ($conn->query($sqlta210) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta211="UPDATE Products SET category = REPLACE(category,'å','a')";	if ($conn->query($sqlta211) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta212="UPDATE Products SET category = REPLACE(category,'æ','a')";	if ($conn->query($sqlta212) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta213="UPDATE Products SET category = REPLACE(category,'ç','c')";	if ($conn->query($sqlta213) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta214="UPDATE Products SET category = REPLACE(category,'è','e')";	if ($conn->query($sqlta214) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta215="UPDATE Products SET category = REPLACE(category,'é','e')";	if ($conn->query($sqlta215) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta216="UPDATE Products SET category = REPLACE(category,'ê','e')";	if ($conn->query($sqlta216) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta217="UPDATE Products SET category = REPLACE(category,'ë','e')";	if ($conn->query($sqlta217) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta218="UPDATE Products SET category = REPLACE(category,'ì','i')";	if ($conn->query($sqlta218) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta219="UPDATE Products SET category = REPLACE(category,'í','i')";	if ($conn->query($sqlta219) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta220="UPDATE Products SET category = REPLACE(category,'î','i')";	if ($conn->query($sqlta220) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta221="UPDATE Products SET category = REPLACE(category,'ï','i')";	if ($conn->query($sqlta221) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta222="UPDATE Products SET category = REPLACE(category,'ð','o')";	if ($conn->query($sqlta222) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta223="UPDATE Products SET category = REPLACE(category,'ñ','n')";	if ($conn->query($sqlta223) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta224="UPDATE Products SET category = REPLACE(category,'ò','o')";	if ($conn->query($sqlta224) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta225="UPDATE Products SET category = REPLACE(category,'ó','o')";	if ($conn->query($sqlta225) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta226="UPDATE Products SET category = REPLACE(category,'ô','o')";	if ($conn->query($sqlta226) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta227="UPDATE Products SET category = REPLACE(category,'õ','o')";	if ($conn->query($sqlta227) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta228="UPDATE Products SET category = REPLACE(category,'ö','o')";	if ($conn->query($sqlta228) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta229="UPDATE Products SET category = REPLACE(category,'ø','o')";	if ($conn->query($sqlta229) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta230="UPDATE Products SET category = REPLACE(category,'ù','u')";	if ($conn->query($sqlta230) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta231="UPDATE Products SET category = REPLACE(category,'ú','u')";	if ($conn->query($sqlta231) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta232="UPDATE Products SET category = REPLACE(category,'û','u')";	if ($conn->query($sqlta232) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta233="UPDATE Products SET category = REPLACE(category,'ý','y')";	if ($conn->query($sqlta233) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta234="UPDATE Products SET category = REPLACE(category,'ý','y')";	if ($conn->query($sqlta234) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta235="UPDATE Products SET category = REPLACE(category,'þ','b')";	if ($conn->query($sqlta235) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta236="UPDATE Products SET category = REPLACE(category,'ÿ','y')";	if ($conn->query($sqlta236) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta237="UPDATE Products SET category = REPLACE(category,'ƒ','f')";	if ($conn->query($sqlta237) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta238="UPDATE Products SET category = REPLACE(category,'ě','e')";	if ($conn->query($sqlta238) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta239="UPDATE Products SET category = REPLACE(category,'ž','z')";	if ($conn->query($sqlta239) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta240="UPDATE Products SET category = REPLACE(category,'š','s')";	if ($conn->query($sqlta240) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta241="UPDATE Products SET category = REPLACE(category,'č','c')";	if ($conn->query($sqlta241) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta242="UPDATE Products SET category = REPLACE(category,'ř','r')";	if ($conn->query($sqlta242) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta243="UPDATE Products SET category = REPLACE(category,'ď','d')";	if ($conn->query($sqlta243) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta244="UPDATE Products SET category = REPLACE(category,'ť','t')";	if ($conn->query($sqlta244) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta245="UPDATE Products SET category = REPLACE(category,'ň','n')";	if ($conn->query($sqlta245) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta246="UPDATE Products SET category = REPLACE(category,'ů','u')";	if ($conn->query($sqlta246) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta247="UPDATE Products SET category = REPLACE(category,'Ě','E')";	if ($conn->query($sqlta247) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta248="UPDATE Products SET category = REPLACE(category,'Ž','Z')";	if ($conn->query($sqlta248) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta249="UPDATE Products SET category = REPLACE(category,'Š','S')";	if ($conn->query($sqlta249) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta250="UPDATE Products SET category = REPLACE(category,'Č','C')";	if ($conn->query($sqlta250) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta251="UPDATE Products SET category = REPLACE(category,'Ř','R')";	if ($conn->query($sqlta251) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta252="UPDATE Products SET category = REPLACE(category,'Ď','D')";	if ($conn->query($sqlta252) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta253="UPDATE Products SET category = REPLACE(category,'Ť','T')";	if ($conn->query($sqlta253) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta254="UPDATE Products SET category = REPLACE(category,'Ň','N')";	if ($conn->query($sqlta254) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta255="UPDATE Products SET category = REPLACE(category,'Ů','U')";	if ($conn->query($sqlta255) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqlta256="UPDATE Products set active=0 where diff_current_pay_only_lowest > 1000";	if ($conn->query($sqlta256) === TRUE) { echo "1. Products updated successfully"; } else { echo "Error updating record: " . $conn->error; }

$sqltpa86="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Š','S')";	if ($conn->query($sqltpa86) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa87="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'š','s')";	if ($conn->query($sqltpa87) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa88="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ð','Dj')";	if ($conn->query($sqltpa88) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa89="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ž','Z')";	if ($conn->query($sqltpa89) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa90="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ž','z')";	if ($conn->query($sqltpa90) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa91="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'À','A')";	if ($conn->query($sqltpa91) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa92="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Á','A')";	if ($conn->query($sqltpa92) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa93="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Â','A')";	if ($conn->query($sqltpa93) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa94="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ã','A')";	if ($conn->query($sqltpa94) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa95="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ä','A')";	if ($conn->query($sqltpa95) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa96="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Å','A')";	if ($conn->query($sqltpa96) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa97="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Æ','A')";	if ($conn->query($sqltpa97) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa98="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ç','C')";	if ($conn->query($sqltpa98) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa99="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'È','E')";	if ($conn->query($sqltpa99) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa100="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'É','E')";	if ($conn->query($sqltpa100) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa101="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ê','E')";	if ($conn->query($sqltpa101) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa102="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ë','E')";	if ($conn->query($sqltpa102) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa103="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ì','I')";	if ($conn->query($sqltpa103) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa104="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Í','I')";	if ($conn->query($sqltpa104) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa105="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Î','I')";	if ($conn->query($sqltpa105) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa106="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ï','I')";	if ($conn->query($sqltpa106) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa107="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ñ','N')";	if ($conn->query($sqltpa107) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa108="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ò','O')";	if ($conn->query($sqltpa108) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa109="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ó','O')";	if ($conn->query($sqltpa109) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa110="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ô','O')";	if ($conn->query($sqltpa110) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa111="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Õ','O')";	if ($conn->query($sqltpa111) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa112="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ö','O')";	if ($conn->query($sqltpa112) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa113="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ø','O')";	if ($conn->query($sqltpa113) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa114="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ù','U')";	if ($conn->query($sqltpa114) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa115="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ú','U')";	if ($conn->query($sqltpa115) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa116="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Û','U')";	if ($conn->query($sqltpa116) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa117="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ü','U')";	if ($conn->query($sqltpa117) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa118="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ý','Y')";	if ($conn->query($sqltpa118) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa119="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Þ','B')";	if ($conn->query($sqltpa119) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa120="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ß','Ss')";	if ($conn->query($sqltpa120) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa121="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'à','a')";	if ($conn->query($sqltpa121) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa122="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'á','a')";	if ($conn->query($sqltpa122) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa123="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'â','a')";	if ($conn->query($sqltpa123) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa124="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ã','a')";	if ($conn->query($sqltpa124) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa125="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ä','a')";	if ($conn->query($sqltpa125) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa126="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'å','a')";	if ($conn->query($sqltpa126) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa127="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'æ','a')";	if ($conn->query($sqltpa127) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa128="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ç','c')";	if ($conn->query($sqltpa128) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa129="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'è','e')";	if ($conn->query($sqltpa129) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa130="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'é','e')";	if ($conn->query($sqltpa130) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa131="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ê','e')";	if ($conn->query($sqltpa131) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa132="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ë','e')";	if ($conn->query($sqltpa132) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa133="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ì','i')";	if ($conn->query($sqltpa133) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa134="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'í','i')";	if ($conn->query($sqltpa134) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa135="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'î','i')";	if ($conn->query($sqltpa135) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa136="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ï','i')";	if ($conn->query($sqltpa136) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa137="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ð','o')";	if ($conn->query($sqltpa137) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa138="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ñ','n')";	if ($conn->query($sqltpa138) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa139="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ò','o')";	if ($conn->query($sqltpa139) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa140="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ó','o')";	if ($conn->query($sqltpa140) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa141="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ô','o')";	if ($conn->query($sqltpa141) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa142="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'õ','o')";	if ($conn->query($sqltpa142) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa143="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ö','o')";	if ($conn->query($sqltpa143) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa144="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ø','o')";	if ($conn->query($sqltpa144) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa145="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ù','u')";	if ($conn->query($sqltpa145) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa146="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ú','u')";	if ($conn->query($sqltpa146) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa147="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'û','u')";	if ($conn->query($sqltpa147) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa148="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ý','y')";	if ($conn->query($sqltpa148) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa149="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ý','y')";	if ($conn->query($sqltpa149) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa150="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'þ','b')";	if ($conn->query($sqltpa150) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa151="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ÿ','y')";	if ($conn->query($sqltpa151) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa152="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ƒ','f')";	if ($conn->query($sqltpa152) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa153="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ě','e')";	if ($conn->query($sqltpa153) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa154="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ž','z')";	if ($conn->query($sqltpa154) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa155="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'š','s')";	if ($conn->query($sqltpa155) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa156="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'č','c')";	if ($conn->query($sqltpa156) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa157="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ř','r')";	if ($conn->query($sqltpa157) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa158="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ď','d')";	if ($conn->query($sqltpa158) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa159="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ť','t')";	if ($conn->query($sqltpa159) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa160="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ň','n')";	if ($conn->query($sqltpa160) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa161="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'ů','u')";	if ($conn->query($sqltpa161) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa162="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ě','E')";	if ($conn->query($sqltpa162) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa163="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ž','Z')";	if ($conn->query($sqltpa163) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa164="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Š','S')";	if ($conn->query($sqltpa164) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa165="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Č','C')";	if ($conn->query($sqltpa165) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa166="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ř','R')";	if ($conn->query($sqltpa166) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa167="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ď','D')";	if ($conn->query($sqltpa167) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa168="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ť','T')";	if ($conn->query($sqltpa168) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa169="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ň','N')";	if ($conn->query($sqltpa169) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltpa170="UPDATE principio_ativo SET principio_ativo = REPLACE(principio_ativo,'Ů','U')";	if ($conn->query($sqltpa170) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }


$sqltma86="UPDATE marca SET marca = REPLACE(marca,'Š','S')";	if ($conn->query($sqltma86) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma87="UPDATE marca SET marca = REPLACE(marca,'š','s')";	if ($conn->query($sqltma87) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma88="UPDATE marca SET marca = REPLACE(marca,'Ð','Dj')";	if ($conn->query($sqltma88) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma89="UPDATE marca SET marca = REPLACE(marca,'Ž','Z')";	if ($conn->query($sqltma89) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma90="UPDATE marca SET marca = REPLACE(marca,'ž','z')";	if ($conn->query($sqltma90) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma91="UPDATE marca SET marca = REPLACE(marca,'À','A')";	if ($conn->query($sqltma91) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma92="UPDATE marca SET marca = REPLACE(marca,'Á','A')";	if ($conn->query($sqltma92) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma93="UPDATE marca SET marca = REPLACE(marca,'Â','A')";	if ($conn->query($sqltma93) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma94="UPDATE marca SET marca = REPLACE(marca,'Ã','A')";	if ($conn->query($sqltma94) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma95="UPDATE marca SET marca = REPLACE(marca,'Ä','A')";	if ($conn->query($sqltma95) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma96="UPDATE marca SET marca = REPLACE(marca,'Å','A')";	if ($conn->query($sqltma96) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma97="UPDATE marca SET marca = REPLACE(marca,'Æ','A')";	if ($conn->query($sqltma97) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma98="UPDATE marca SET marca = REPLACE(marca,'Ç','C')";	if ($conn->query($sqltma98) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma99="UPDATE marca SET marca = REPLACE(marca,'È','E')";	if ($conn->query($sqltma99) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma100="UPDATE marca SET marca = REPLACE(marca,'É','E')";	if ($conn->query($sqltma100) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma101="UPDATE marca SET marca = REPLACE(marca,'Ê','E')";	if ($conn->query($sqltma101) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma102="UPDATE marca SET marca = REPLACE(marca,'Ë','E')";	if ($conn->query($sqltma102) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma103="UPDATE marca SET marca = REPLACE(marca,'Ì','I')";	if ($conn->query($sqltma103) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma104="UPDATE marca SET marca = REPLACE(marca,'Í','I')";	if ($conn->query($sqltma104) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma105="UPDATE marca SET marca = REPLACE(marca,'Î','I')";	if ($conn->query($sqltma105) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma106="UPDATE marca SET marca = REPLACE(marca,'Ï','I')";	if ($conn->query($sqltma106) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma107="UPDATE marca SET marca = REPLACE(marca,'Ñ','N')";	if ($conn->query($sqltma107) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma108="UPDATE marca SET marca = REPLACE(marca,'Ò','O')";	if ($conn->query($sqltma108) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma109="UPDATE marca SET marca = REPLACE(marca,'Ó','O')";	if ($conn->query($sqltma109) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma110="UPDATE marca SET marca = REPLACE(marca,'Ô','O')";	if ($conn->query($sqltma110) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma111="UPDATE marca SET marca = REPLACE(marca,'Õ','O')";	if ($conn->query($sqltma111) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma112="UPDATE marca SET marca = REPLACE(marca,'Ö','O')";	if ($conn->query($sqltma112) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma113="UPDATE marca SET marca = REPLACE(marca,'Ø','O')";	if ($conn->query($sqltma113) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma114="UPDATE marca SET marca = REPLACE(marca,'Ù','U')";	if ($conn->query($sqltma114) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma115="UPDATE marca SET marca = REPLACE(marca,'Ú','U')";	if ($conn->query($sqltma115) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma116="UPDATE marca SET marca = REPLACE(marca,'Û','U')";	if ($conn->query($sqltma116) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma117="UPDATE marca SET marca = REPLACE(marca,'Ü','U')";	if ($conn->query($sqltma117) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma118="UPDATE marca SET marca = REPLACE(marca,'Ý','Y')";	if ($conn->query($sqltma118) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma119="UPDATE marca SET marca = REPLACE(marca,'Þ','B')";	if ($conn->query($sqltma119) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma120="UPDATE marca SET marca = REPLACE(marca,'ß','Ss')";	if ($conn->query($sqltma120) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma121="UPDATE marca SET marca = REPLACE(marca,'à','a')";	if ($conn->query($sqltma121) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma122="UPDATE marca SET marca = REPLACE(marca,'á','a')";	if ($conn->query($sqltma122) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma123="UPDATE marca SET marca = REPLACE(marca,'â','a')";	if ($conn->query($sqltma123) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma124="UPDATE marca SET marca = REPLACE(marca,'ã','a')";	if ($conn->query($sqltma124) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma125="UPDATE marca SET marca = REPLACE(marca,'ä','a')";	if ($conn->query($sqltma125) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma126="UPDATE marca SET marca = REPLACE(marca,'å','a')";	if ($conn->query($sqltma126) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma127="UPDATE marca SET marca = REPLACE(marca,'æ','a')";	if ($conn->query($sqltma127) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma128="UPDATE marca SET marca = REPLACE(marca,'ç','c')";	if ($conn->query($sqltma128) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma129="UPDATE marca SET marca = REPLACE(marca,'è','e')";	if ($conn->query($sqltma129) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma130="UPDATE marca SET marca = REPLACE(marca,'é','e')";	if ($conn->query($sqltma130) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma131="UPDATE marca SET marca = REPLACE(marca,'ê','e')";	if ($conn->query($sqltma131) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma132="UPDATE marca SET marca = REPLACE(marca,'ë','e')";	if ($conn->query($sqltma132) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma133="UPDATE marca SET marca = REPLACE(marca,'ì','i')";	if ($conn->query($sqltma133) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma134="UPDATE marca SET marca = REPLACE(marca,'í','i')";	if ($conn->query($sqltma134) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma135="UPDATE marca SET marca = REPLACE(marca,'î','i')";	if ($conn->query($sqltma135) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma136="UPDATE marca SET marca = REPLACE(marca,'ï','i')";	if ($conn->query($sqltma136) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma137="UPDATE marca SET marca = REPLACE(marca,'ð','o')";	if ($conn->query($sqltma137) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma138="UPDATE marca SET marca = REPLACE(marca,'ñ','n')";	if ($conn->query($sqltma138) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma139="UPDATE marca SET marca = REPLACE(marca,'ò','o')";	if ($conn->query($sqltma139) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma140="UPDATE marca SET marca = REPLACE(marca,'ó','o')";	if ($conn->query($sqltma140) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma141="UPDATE marca SET marca = REPLACE(marca,'ô','o')";	if ($conn->query($sqltma141) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma142="UPDATE marca SET marca = REPLACE(marca,'õ','o')";	if ($conn->query($sqltma142) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma143="UPDATE marca SET marca = REPLACE(marca,'ö','o')";	if ($conn->query($sqltma143) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma144="UPDATE marca SET marca = REPLACE(marca,'ø','o')";	if ($conn->query($sqltma144) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma145="UPDATE marca SET marca = REPLACE(marca,'ù','u')";	if ($conn->query($sqltma145) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma146="UPDATE marca SET marca = REPLACE(marca,'ú','u')";	if ($conn->query($sqltma146) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma147="UPDATE marca SET marca = REPLACE(marca,'û','u')";	if ($conn->query($sqltma147) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma148="UPDATE marca SET marca = REPLACE(marca,'ý','y')";	if ($conn->query($sqltma148) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma149="UPDATE marca SET marca = REPLACE(marca,'ý','y')";	if ($conn->query($sqltma149) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma150="UPDATE marca SET marca = REPLACE(marca,'þ','b')";	if ($conn->query($sqltma150) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma151="UPDATE marca SET marca = REPLACE(marca,'ÿ','y')";	if ($conn->query($sqltma151) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma152="UPDATE marca SET marca = REPLACE(marca,'ƒ','f')";	if ($conn->query($sqltma152) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma153="UPDATE marca SET marca = REPLACE(marca,'ě','e')";	if ($conn->query($sqltma153) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma154="UPDATE marca SET marca = REPLACE(marca,'ž','z')";	if ($conn->query($sqltma154) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma155="UPDATE marca SET marca = REPLACE(marca,'š','s')";	if ($conn->query($sqltma155) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma156="UPDATE marca SET marca = REPLACE(marca,'č','c')";	if ($conn->query($sqltma156) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma157="UPDATE marca SET marca = REPLACE(marca,'ř','r')";	if ($conn->query($sqltma157) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma158="UPDATE marca SET marca = REPLACE(marca,'ď','d')";	if ($conn->query($sqltma158) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma159="UPDATE marca SET marca = REPLACE(marca,'ť','t')";	if ($conn->query($sqltma159) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma160="UPDATE marca SET marca = REPLACE(marca,'ň','n')";	if ($conn->query($sqltma160) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma161="UPDATE marca SET marca = REPLACE(marca,'ů','u')";	if ($conn->query($sqltma161) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma162="UPDATE marca SET marca = REPLACE(marca,'Ě','E')";	if ($conn->query($sqltma162) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma163="UPDATE marca SET marca = REPLACE(marca,'Ž','Z')";	if ($conn->query($sqltma163) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma164="UPDATE marca SET marca = REPLACE(marca,'Š','S')";	if ($conn->query($sqltma164) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma165="UPDATE marca SET marca = REPLACE(marca,'Č','C')";	if ($conn->query($sqltma165) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma166="UPDATE marca SET marca = REPLACE(marca,'Ř','R')";	if ($conn->query($sqltma166) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma167="UPDATE marca SET marca = REPLACE(marca,'Ď','D')";	if ($conn->query($sqltma167) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma168="UPDATE marca SET marca = REPLACE(marca,'Ť','T')";	if ($conn->query($sqltma168) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma169="UPDATE marca SET marca = REPLACE(marca,'Ň','N')";	if ($conn->query($sqltma169) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltma170="UPDATE marca SET marca = REPLACE(marca,'Ů','U')";	if ($conn->query($sqltma170) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }

$sqltfab86="UPDATE marca SET fabricante = REPLACE(fabricante,'Š','S')";	if ($conn->query($sqltfab86) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab87="UPDATE marca SET fabricante = REPLACE(fabricante,'š','s')";	if ($conn->query($sqltfab87) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab88="UPDATE marca SET fabricante = REPLACE(fabricante,'Ð','Dj')";	if ($conn->query($sqltfab88) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab89="UPDATE marca SET fabricante = REPLACE(fabricante,'Ž','Z')";	if ($conn->query($sqltfab89) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab90="UPDATE marca SET fabricante = REPLACE(fabricante,'ž','z')";	if ($conn->query($sqltfab90) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab91="UPDATE marca SET fabricante = REPLACE(fabricante,'À','A')";	if ($conn->query($sqltfab91) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab92="UPDATE marca SET fabricante = REPLACE(fabricante,'Á','A')";	if ($conn->query($sqltfab92) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab93="UPDATE marca SET fabricante = REPLACE(fabricante,'Â','A')";	if ($conn->query($sqltfab93) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab94="UPDATE marca SET fabricante = REPLACE(fabricante,'Ã','A')";	if ($conn->query($sqltfab94) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab95="UPDATE marca SET fabricante = REPLACE(fabricante,'Ä','A')";	if ($conn->query($sqltfab95) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab96="UPDATE marca SET fabricante = REPLACE(fabricante,'Å','A')";	if ($conn->query($sqltfab96) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab97="UPDATE marca SET fabricante = REPLACE(fabricante,'Æ','A')";	if ($conn->query($sqltfab97) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab98="UPDATE marca SET fabricante = REPLACE(fabricante,'Ç','C')";	if ($conn->query($sqltfab98) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab99="UPDATE marca SET fabricante = REPLACE(fabricante,'È','E')";	if ($conn->query($sqltfab99) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab100="UPDATE marca SET fabricante = REPLACE(fabricante,'É','E')";	if ($conn->query($sqltfab100) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab101="UPDATE marca SET fabricante = REPLACE(fabricante,'Ê','E')";	if ($conn->query($sqltfab101) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab102="UPDATE marca SET fabricante = REPLACE(fabricante,'Ë','E')";	if ($conn->query($sqltfab102) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab103="UPDATE marca SET fabricante = REPLACE(fabricante,'Ì','I')";	if ($conn->query($sqltfab103) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab104="UPDATE marca SET fabricante = REPLACE(fabricante,'Í','I')";	if ($conn->query($sqltfab104) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab105="UPDATE marca SET fabricante = REPLACE(fabricante,'Î','I')";	if ($conn->query($sqltfab105) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab106="UPDATE marca SET fabricante = REPLACE(fabricante,'Ï','I')";	if ($conn->query($sqltfab106) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab107="UPDATE marca SET fabricante = REPLACE(fabricante,'Ñ','N')";	if ($conn->query($sqltfab107) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab108="UPDATE marca SET fabricante = REPLACE(fabricante,'Ò','O')";	if ($conn->query($sqltfab108) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab109="UPDATE marca SET fabricante = REPLACE(fabricante,'Ó','O')";	if ($conn->query($sqltfab109) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab110="UPDATE marca SET fabricante = REPLACE(fabricante,'Ô','O')";	if ($conn->query($sqltfab110) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab111="UPDATE marca SET fabricante = REPLACE(fabricante,'Õ','O')";	if ($conn->query($sqltfab111) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab112="UPDATE marca SET fabricante = REPLACE(fabricante,'Ö','O')";	if ($conn->query($sqltfab112) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab113="UPDATE marca SET fabricante = REPLACE(fabricante,'Ø','O')";	if ($conn->query($sqltfab113) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab114="UPDATE marca SET fabricante = REPLACE(fabricante,'Ù','U')";	if ($conn->query($sqltfab114) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab115="UPDATE marca SET fabricante = REPLACE(fabricante,'Ú','U')";	if ($conn->query($sqltfab115) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab116="UPDATE marca SET fabricante = REPLACE(fabricante,'Û','U')";	if ($conn->query($sqltfab116) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab117="UPDATE marca SET fabricante = REPLACE(fabricante,'Ü','U')";	if ($conn->query($sqltfab117) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab118="UPDATE marca SET fabricante = REPLACE(fabricante,'Ý','Y')";	if ($conn->query($sqltfab118) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab119="UPDATE marca SET fabricante = REPLACE(fabricante,'Þ','B')";	if ($conn->query($sqltfab119) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab120="UPDATE marca SET fabricante = REPLACE(fabricante,'ß','Ss')";	if ($conn->query($sqltfab120) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab121="UPDATE marca SET fabricante = REPLACE(fabricante,'à','a')";	if ($conn->query($sqltfab121) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab122="UPDATE marca SET fabricante = REPLACE(fabricante,'á','a')";	if ($conn->query($sqltfab122) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab123="UPDATE marca SET fabricante = REPLACE(fabricante,'â','a')";	if ($conn->query($sqltfab123) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab124="UPDATE marca SET fabricante = REPLACE(fabricante,'ã','a')";	if ($conn->query($sqltfab124) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab125="UPDATE marca SET fabricante = REPLACE(fabricante,'ä','a')";	if ($conn->query($sqltfab125) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab126="UPDATE marca SET fabricante = REPLACE(fabricante,'å','a')";	if ($conn->query($sqltfab126) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab127="UPDATE marca SET fabricante = REPLACE(fabricante,'æ','a')";	if ($conn->query($sqltfab127) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab128="UPDATE marca SET fabricante = REPLACE(fabricante,'ç','c')";	if ($conn->query($sqltfab128) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab129="UPDATE marca SET fabricante = REPLACE(fabricante,'è','e')";	if ($conn->query($sqltfab129) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab130="UPDATE marca SET fabricante = REPLACE(fabricante,'é','e')";	if ($conn->query($sqltfab130) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab131="UPDATE marca SET fabricante = REPLACE(fabricante,'ê','e')";	if ($conn->query($sqltfab131) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab132="UPDATE marca SET fabricante = REPLACE(fabricante,'ë','e')";	if ($conn->query($sqltfab132) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab133="UPDATE marca SET fabricante = REPLACE(fabricante,'ì','i')";	if ($conn->query($sqltfab133) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab134="UPDATE marca SET fabricante = REPLACE(fabricante,'í','i')";	if ($conn->query($sqltfab134) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab135="UPDATE marca SET fabricante = REPLACE(fabricante,'î','i')";	if ($conn->query($sqltfab135) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab136="UPDATE marca SET fabricante = REPLACE(fabricante,'ï','i')";	if ($conn->query($sqltfab136) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab137="UPDATE marca SET fabricante = REPLACE(fabricante,'ð','o')";	if ($conn->query($sqltfab137) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab138="UPDATE marca SET fabricante = REPLACE(fabricante,'ñ','n')";	if ($conn->query($sqltfab138) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab139="UPDATE marca SET fabricante = REPLACE(fabricante,'ò','o')";	if ($conn->query($sqltfab139) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab140="UPDATE marca SET fabricante = REPLACE(fabricante,'ó','o')";	if ($conn->query($sqltfab140) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab141="UPDATE marca SET fabricante = REPLACE(fabricante,'ô','o')";	if ($conn->query($sqltfab141) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab142="UPDATE marca SET fabricante = REPLACE(fabricante,'õ','o')";	if ($conn->query($sqltfab142) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab143="UPDATE marca SET fabricante = REPLACE(fabricante,'ö','o')";	if ($conn->query($sqltfab143) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab144="UPDATE marca SET fabricante = REPLACE(fabricante,'ø','o')";	if ($conn->query($sqltfab144) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab145="UPDATE marca SET fabricante = REPLACE(fabricante,'ù','u')";	if ($conn->query($sqltfab145) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab146="UPDATE marca SET fabricante = REPLACE(fabricante,'ú','u')";	if ($conn->query($sqltfab146) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab147="UPDATE marca SET fabricante = REPLACE(fabricante,'û','u')";	if ($conn->query($sqltfab147) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab148="UPDATE marca SET fabricante = REPLACE(fabricante,'ý','y')";	if ($conn->query($sqltfab148) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab149="UPDATE marca SET fabricante = REPLACE(fabricante,'ý','y')";	if ($conn->query($sqltfab149) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab150="UPDATE marca SET fabricante = REPLACE(fabricante,'þ','b')";	if ($conn->query($sqltfab150) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab151="UPDATE marca SET fabricante = REPLACE(fabricante,'ÿ','y')";	if ($conn->query($sqltfab151) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab152="UPDATE marca SET fabricante = REPLACE(fabricante,'ƒ','f')";	if ($conn->query($sqltfab152) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab153="UPDATE marca SET fabricante = REPLACE(fabricante,'ě','e')";	if ($conn->query($sqltfab153) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab154="UPDATE marca SET fabricante = REPLACE(fabricante,'ž','z')";	if ($conn->query($sqltfab154) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab155="UPDATE marca SET fabricante = REPLACE(fabricante,'š','s')";	if ($conn->query($sqltfab155) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab156="UPDATE marca SET fabricante = REPLACE(fabricante,'č','c')";	if ($conn->query($sqltfab156) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab157="UPDATE marca SET fabricante = REPLACE(fabricante,'ř','r')";	if ($conn->query($sqltfab157) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab158="UPDATE marca SET fabricante = REPLACE(fabricante,'ď','d')";	if ($conn->query($sqltfab158) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab159="UPDATE marca SET fabricante = REPLACE(fabricante,'ť','t')";	if ($conn->query($sqltfab159) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab160="UPDATE marca SET fabricante = REPLACE(fabricante,'ň','n')";	if ($conn->query($sqltfab160) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab161="UPDATE marca SET fabricante = REPLACE(fabricante,'ů','u')";	if ($conn->query($sqltfab161) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab162="UPDATE marca SET fabricante = REPLACE(fabricante,'Ě','E')";	if ($conn->query($sqltfab162) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab163="UPDATE marca SET fabricante = REPLACE(fabricante,'Ž','Z')";	if ($conn->query($sqltfab163) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab164="UPDATE marca SET fabricante = REPLACE(fabricante,'Š','S')";	if ($conn->query($sqltfab164) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab165="UPDATE marca SET fabricante = REPLACE(fabricante,'Č','C')";	if ($conn->query($sqltfab165) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab166="UPDATE marca SET fabricante = REPLACE(fabricante,'Ř','R')";	if ($conn->query($sqltfab166) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab167="UPDATE marca SET fabricante = REPLACE(fabricante,'Ď','D')";	if ($conn->query($sqltfab167) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab168="UPDATE marca SET fabricante = REPLACE(fabricante,'Ť','T')";	if ($conn->query($sqltfab168) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab169="UPDATE marca SET fabricante = REPLACE(fabricante,'Ň','N')";	if ($conn->query($sqltfab169) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltfab170="UPDATE marca SET fabricante = REPLACE(fabricante,'Ů','U')";	if ($conn->query($sqltfab170) === TRUE) { echo "1. marca updated successfully"; } else { echo "Error updating record: " . $conn->error; }

$sqltaap1="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Š','S')";	if ($conn->query($sqltaap1) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap2="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'š','s')";	if ($conn->query($sqltaap2) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap3="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ð','Dj')";	if ($conn->query($sqltaap3) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap4="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ž','Z')";	if ($conn->query($sqltaap4) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap5="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ž','z')";	if ($conn->query($sqltaap5) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap6="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'À','A')";	if ($conn->query($sqltaap6) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap7="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Á','A')";	if ($conn->query($sqltaap7) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap8="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Â','A')";	if ($conn->query($sqltaap8) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap9="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ã','A')";	if ($conn->query($sqltaap9) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap10="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ä','A')";	if ($conn->query($sqltaap10) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap11="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Å','A')";	if ($conn->query($sqltaap11) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap12="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Æ','A')";	if ($conn->query($sqltaap12) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap13="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ç','C')";	if ($conn->query($sqltaap13) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap14="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'È','E')";	if ($conn->query($sqltaap14) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap15="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'É','E')";	if ($conn->query($sqltaap15) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap16="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ê','E')";	if ($conn->query($sqltaap16) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap17="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ë','E')";	if ($conn->query($sqltaap17) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap18="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ì','I')";	if ($conn->query($sqltaap18) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap19="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Í','I')";	if ($conn->query($sqltaap19) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap20="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Î','I')";	if ($conn->query($sqltaap20) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap21="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ï','I')";	if ($conn->query($sqltaap21) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap22="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ñ','N')";	if ($conn->query($sqltaap22) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap23="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ò','O')";	if ($conn->query($sqltaap23) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap24="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ó','O')";	if ($conn->query($sqltaap24) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap25="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ô','O')";	if ($conn->query($sqltaap25) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap26="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Õ','O')";	if ($conn->query($sqltaap26) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap27="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ö','O')";	if ($conn->query($sqltaap27) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap28="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ø','O')";	if ($conn->query($sqltaap28) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap29="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ù','U')";	if ($conn->query($sqltaap29) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap30="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ú','U')";	if ($conn->query($sqltaap30) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap31="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Û','U')";	if ($conn->query($sqltaap31) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap32="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ü','U')";	if ($conn->query($sqltaap32) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap33="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ý','Y')";	if ($conn->query($sqltaap33) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap34="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Þ','B')";	if ($conn->query($sqltaap34) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap35="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ß','Ss')";	if ($conn->query($sqltaap35) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap36="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'à','a')";	if ($conn->query($sqltaap36) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap37="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'á','a')";	if ($conn->query($sqltaap37) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap38="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'â','a')";	if ($conn->query($sqltaap38) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap39="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ã','a')";	if ($conn->query($sqltaap39) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap40="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ä','a')";	if ($conn->query($sqltaap40) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap41="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'å','a')";	if ($conn->query($sqltaap41) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap42="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'æ','a')";	if ($conn->query($sqltaap42) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap43="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ç','c')";	if ($conn->query($sqltaap43) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap44="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'è','e')";	if ($conn->query($sqltaap44) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap45="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'é','e')";	if ($conn->query($sqltaap45) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap46="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ê','e')";	if ($conn->query($sqltaap46) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap47="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ë','e')";	if ($conn->query($sqltaap47) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap48="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ì','i')";	if ($conn->query($sqltaap48) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap49="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'í','i')";	if ($conn->query($sqltaap49) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap50="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'î','i')";	if ($conn->query($sqltaap50) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap51="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ï','i')";	if ($conn->query($sqltaap51) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap52="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ð','o')";	if ($conn->query($sqltaap52) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap53="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ñ','n')";	if ($conn->query($sqltaap53) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap54="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ò','o')";	if ($conn->query($sqltaap54) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap55="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ó','o')";	if ($conn->query($sqltaap55) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap56="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ô','o')";	if ($conn->query($sqltaap56) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap57="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'õ','o')";	if ($conn->query($sqltaap57) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap58="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ö','o')";	if ($conn->query($sqltaap58) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap59="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ø','o')";	if ($conn->query($sqltaap59) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap60="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ù','u')";	if ($conn->query($sqltaap60) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap61="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ú','u')";	if ($conn->query($sqltaap61) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap62="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'û','u')";	if ($conn->query($sqltaap62) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap63="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ý','y')";	if ($conn->query($sqltaap63) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap64="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ý','y')";	if ($conn->query($sqltaap64) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap65="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'þ','b')";	if ($conn->query($sqltaap65) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap66="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ÿ','y')";	if ($conn->query($sqltaap66) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap67="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ƒ','f')";	if ($conn->query($sqltaap67) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap68="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ě','e')";	if ($conn->query($sqltaap68) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap69="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ž','z')";	if ($conn->query($sqltaap69) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap70="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'š','s')";	if ($conn->query($sqltaap70) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap71="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'č','c')";	if ($conn->query($sqltaap71) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap72="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ř','r')";	if ($conn->query($sqltaap72) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap73="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ď','d')";	if ($conn->query($sqltaap73) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap74="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ť','t')";	if ($conn->query($sqltaap74) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap75="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ň','n')";	if ($conn->query($sqltaap75) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap76="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'ů','u')";	if ($conn->query($sqltaap76) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap77="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ě','E')";	if ($conn->query($sqltaap77) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap78="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ž','Z')";	if ($conn->query($sqltaap78) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap79="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Š','S')";	if ($conn->query($sqltaap79) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap80="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Č','C')";	if ($conn->query($sqltaap80) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap81="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ř','R')";	if ($conn->query($sqltaap81) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap82="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ď','D')";	if ($conn->query($sqltaap82) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap83="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ť','T')";	if ($conn->query($sqltaap83) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap84="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ň','N')";	if ($conn->query($sqltaap84) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }
$sqltaap85="UPDATE principio_ativo SET apresentacao = REPLACE(apresentacao,'Ů','U')";	if ($conn->query($sqltaap85) === TRUE) { echo "1. principio_ativo updated successfully"; } else { echo "Error updating record: " . $conn->error; }

$conn->close();

?>
