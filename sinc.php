<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

include_once("config/dbconfig.php");






//drogaraia Sync
$drogaraia_url = "INSERT IGNORE INTO drogaraia_url (url)
SELECT quali_drogaraia
FROM tbl_excel";

if ($conn->query($drogaraia_url) === TRUE) {
  echo "Atualizado URLS E SKUS PARA DROGASIL<br>";
} else {
  echo "Error: " . $drogaraia_url . "<br>" . $conn->error;
}

 sleep(3);

$drogaraia = "
UPDATE drogaraia_products
INNER JOIN tbl_excel ON (drogaraia_products.ean = tbl_excel.quali_ean)
SET drogaraia_products.sku_quali = tbl_excel.quali_sku
";

if ($conn->query($drogaraia) === TRUE) {
  echo "Cruzamento DROGARAIA executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}

 sleep(3);



//drogasil Sync
$drogasil_url = "INSERT IGNORE INTO drogasil_url (url)
SELECT quali_drogasil
FROM tbl_excel";

if ($conn->query($drogasil_url) === TRUE) {
  echo "Atualizado URLS E SKUS PARA DROGASIL<br>";
} else {
  echo "Error: " . $drogasil_url . "<br>" . $conn->error;
}

 sleep(3);

$drogasil = "
UPDATE drogasil_products
INNER JOIN tbl_excel ON (drogasil_products.url = tbl_excel.quali_drogasil)
SET drogasil_products.sku_quali = tbl_excel.quali_sku
";

if ($conn->query($drogasil) === TRUE) {
  echo "Cruzamento DROGASIL executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}

 sleep(3);



//ONOFRE Sync
$onofre_url = "INSERT IGNORE INTO onofre_url (url)
SELECT quali_onofre
FROM tbl_excel";

if ($conn->query($onofre_url) === TRUE) {
  echo "Atualizado URLS E SKUS PARA ONOFRE<br>";
} else {
  echo "Error: " . $onofre_url . "<br>" . $conn->error;
}

 sleep(3);

$onofre = "
UPDATE onofre_products
INNER JOIN tbl_excel ON (onofre_products.url = tbl_excel.quali_onofre)
SET onofre_products.sku_quali = tbl_excel.quali_sku
";

if ($conn->query($onofre) === TRUE) {
  echo "Cruzamento ONOFRE executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}

 sleep(3);



//ultrafarma Sync

$ultrafarma_url = "INSERT IGNORE INTO ultrafarma_url (url)
SELECT quali_ultrafarma
FROM tbl_excel";

if ($conn->query($ultrafarma_url) === TRUE) {
  echo "Atualizado URLS E SKUS PARA ULTRAFARMA<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

 
 sleep(3);

$ultrafarma = "
UPDATE ultrafarma_products
INNER JOIN tbl_excel ON (ultrafarma_products.url = tbl_excel.quali_ultrafarma)
SET ultrafarma_products.sku_quali = tbl_excel.quali_sku
";
if ($conn->query($ultrafarma) === TRUE) {
  echo "Cruzamento ULTRAFARMA executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}

 sleep(3);

//drogaria_SP Sync

$drogariasp_url = "INSERT IGNORE INTO drogariasp_url (url)
SELECT quali_drogaria_sao_paulo
FROM tbl_excel";

if ($conn->query($drogariasp_url) === TRUE) {
  echo "Atualizado URLS E SKUS PARA Drogaria SAO PAULO<br>";
} else {
  echo "Error: " . $drogariasp_url . "<br>" . $conn->error;
}

 sleep(3);
 
$drogariasp = "
UPDATE drogariasp_products
INNER JOIN tbl_excel ON (drogariasp_products.url = tbl_excel.quali_drogaria_sao_paulo)
SET drogariasp_products.sku_quali = tbl_excel.quali_sku
";
if ($conn->query($drogariasp) === TRUE) {
  echo "Cruzamento DROGARIA SAO PAULO executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}

 sleep(3);

//BelezanaWeb Sync

$belezanaweb_url = "INSERT IGNORE INTO belezanaweb_url (url)
SELECT quali_belezanaweb
FROM tbl_excel";

if ($conn->query($belezanaweb_url) === TRUE) {
  echo "Atualizado URLS E SKUS PARA BELEZANAWEB<br>";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

 sleep(3);
 
$belezanaweb = "
UPDATE belezanaweb_products
INNER JOIN tbl_excel ON (belezanaweb_products.url = tbl_excel.quali_belezanaweb)
SET belezanaweb_products.sku_quali = tbl_excel.quali_sku
";
if ($conn->query($belezanaweb) === TRUE) {
  echo "Cruzamento BELEZANAWEB executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}



 sleep(3);
//pbm
$productspbm = "
UPDATE Products
INNER JOIN pbm ON (Products.sku = pbm.sku)
SET Products.pbm = '1'
";
if ($conn->query($productspbm) === TRUE) {
  echo "PBM ATUALIZADO E executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}

 sleep(3);
//pbm
$productsconf = "
INSERT IGNORE INTO tbl_excel (quali_sku)
SELECT sku
FROM Products
";
if ($conn->query($productsconf) === TRUE) {
  echo "PBM ATUALIZADO E executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}


UPDATE tbl_excel
INNER JOIN rms ON (rms.sku = tbl_excel.quali_sku)
SET tbl_excel.quali_ean = rms.ean



$conn->close();

