<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

//DB INFO.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'gab40lan';
$DATABASE_NAME = 'fspider';







// Try and connect using the info above.
$conn = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$drogaraia = "
UPDATE quali_url
INNER JOIN drogaraia_products ON (quali_url.ean = drogaraia_products.ean)
SET quali_url.drogaraia = drogaraia_products.url
";

if ($conn->query($drogaraia) === TRUE) {
  echo "Cruzamento DROGARAIA executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}


$drogasil = "
UPDATE quali_url
INNER JOIN drogasil_products ON (quali_url.ean = drogasil_products.ean)
SET quali_url.drogasil = drogasil_products.url
";

if ($conn->query($drogasil) === TRUE) {
  echo "Cruzamento DROGASIL executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}


$onofre = "
UPDATE quali_url
INNER JOIN onofre_products ON (quali_url.ean = onofre_products.ean)
SET quali_url.onofre = onofre_products.url
";

if ($conn->query($onofre) === TRUE) {
  echo "Cruzamento ONOFRE executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}



$drogariasp = "
UPDATE quali_url
INNER JOIN drogariasp_products ON (quali_url.ean = drogariasp_products.ean)
SET quali_url.drogariasp = drogariasp_products.url
";

if ($conn->query($drogariasp) === TRUE) {
  echo "Cruzamento DROGARIASP executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}

$ultrafarma = "
UPDATE quali_url
INNER JOIN ultrafarma_products ON (quali_url.ean = ultrafarma_products.ean)
SET quali_url.ultrafarma = ultrafarma_products.url
";

if ($conn->query($ultrafarma) === TRUE) {
  echo "Cruzamento ULTRAFARMA executado com sucesso<br>";
} else {
  echo "Error updating record: " . $conn->error;
}
$sql = "SELECT url, sku, ean, drogaraia, drogasil, onofre, drogariasp, ultrafarma FROM quali_url";
$res_data = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_array($res_data)){
echo '*******************************************************************';
echo '<br>';
echo 'URL - ';
echo $row[0];
echo '<br>';
echo 'SKU - ';
echo $row[1];
echo '<br>';
echo 'EAN - ';
echo $row[2];
echo '<br>';
echo 'DROGARAIA : ';
echo $row[3];
echo '<br>';
echo 'DROGASIL : ';
echo $row[4];
echo '<br>';
echo 'ONOFRE : ';
echo $row[5];
echo '<br>';
echo 'DROGARIASP : ';
echo $row[6];
echo '<br>';
echo 'ULTRAFARMA - ';
echo $row[7];
echo '<br>';
echo '*******************************************************************';
echo '<br>';
echo '<br>';
}

?>
