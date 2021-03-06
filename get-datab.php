<?php


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



if (isset($_POST['vpbm'])) {
$pbma = $_POST['vpbm'];

}else{

$pbma = '1';
}
$pbma;

if(!empty($_POST["departamentob"])){
$departamento=$_POST["departamentob"];
}else{
echo $departamento= "";
}


$select_qtd_geral_ruptura_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1 and curve = 'B' and 
qty_stock_rms='0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_ruptura_b = mysqli_query($conn,$select_qtd_geral_ruptura_curva_b);
$qtd_geral_ruptura_b = mysqli_fetch_array($resultado_qtd_geral_ruptura_b)[0];

$select_qtd_geral_perfumaria_inativos_curva_b = "SELECT count(1) FROM Products where active=0 and descontinuado <> 1 and curve = 'B' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_perfumaria_inativos_b = mysqli_query($conn,$select_qtd_geral_perfumaria_inativos_curva_b);
$qtd_geral_inativos_perfumaria_b = mysqli_fetch_array($resultado_qtd_geral_perfumaria_inativos_b)[0];

$select_qtd_geral_perfumaria_descontinuado_curva_b = "SELECT count(1) FROM Products where descontinuado = 1 and curve = 'B' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_perfumaria_descontinuado_b = mysqli_query($conn,$select_qtd_geral_perfumaria_descontinuado_curva_b);
$qtd_geral_descontinuado_perfumaria_b = mysqli_fetch_array($resultado_qtd_geral_perfumaria_descontinuado_b)[0];

$select_qtd_geral_perfumaria_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1 and curve = 'B' and 
qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_perfumaria_b = mysqli_query($conn,$select_qtd_geral_perfumaria_curva_b);
$qtd_geral_perfumaria_b = mysqli_fetch_array($resultado_qtd_geral_perfumaria_b)[0];

$select_qtd_stock_geral_perfumaria_curva_b = "SELECT SUM(qty_stock_rms) FROM Products where active=1 and descontinuado <> 1 and curve = 'B' and 
qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_stock_geral_perfumaria_b = mysqli_query($conn,$select_qtd_stock_geral_perfumaria_curva_b);
$qtd_stock_geral_perfumaria_b = mysqli_fetch_array($resultado_qtd_stock_geral_perfumaria_b)[0];


echo "<font size='2px'>";
echo "<b>QUANTIDADE DE SKU's : </b>";
echo $qtd_geral_perfumaria_b;
echo " | <b>RUPTURA : </b>";
echo $qtd_geral_ruptura_b;
echo " | <b>INATIVOS : </b>";
echo $qtd_geral_inativos_perfumaria_b;

echo "<br>";
echo "<b>DESCONTINUADOS : </b>";
echo $qtd_geral_descontinuado_perfumaria_b;

echo " | <b>QUANTIDADE EM ESTOQUE : </b>";
echo number_format($qtd_stock_geral_perfumaria_b, 0, ',', '.');
echo "</font>";



//Qtd Produtos Curva B margem de op. entre 0 e 5
$select_qtd_geral_mp_cinco_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve ='B' and (current_gross_margin_percent BETWEEN 0 and 0.05)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_mp_cinco_curva_b = mysqli_query($conn,$select_qtd_geral_mp_cinco_curva_b);
$qtd_geral_mp_cinco_curva_b = mysqli_fetch_array($resultado_qtd_geral_mp_cinco_curva_b)[0];


//Qtd Produtos Curva B margem de op entre 5 e 10
$select_qtd_geral_mp_dez_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve ='B' and (current_gross_margin_percent BETWEEN 0.0501 and 0.10)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_mp_dez_curva_b = mysqli_query($conn,$select_qtd_geral_mp_dez_curva_b);
$qtd_geral_mp_dez_curva_b = mysqli_fetch_array($resultado_qtd_geral_mp_dez_curva_b)[0];

//Qtd Produtos Curva B de op entre 10 e 20
$select_qtd_geral_mp_vinte_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve ='B' and (current_gross_margin_percent BETWEEN 0.1001 and 0.20)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_mp_vinte_curva_b = mysqli_query($conn,$select_qtd_geral_mp_vinte_curva_b);
$qtd_geral_mp_vinte_curva_b = mysqli_fetch_array($resultado_qtd_geral_mp_vinte_curva_b)[0];


//Qtd Produtos Curva B margem de op entre 20 e 30
$select_qtd_geral_mp_trinta_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve ='B' and (current_gross_margin_percent BETWEEN 0.2001 and 0.30)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_mp_trinta_curva_b = mysqli_query($conn,$select_qtd_geral_mp_trinta_curva_b);
$qtd_geral_mp_trinta_curva_b = mysqli_fetch_array($resultado_qtd_geral_mp_trinta_curva_b)[0];


//Qtd Produtos Curva B margem de op acima de 30
$select_qtd_geral_mp_atrinta_curva_b = "SELECT count(1) FROM Products where active=1
 and descontinuado <> 1 and curve ='B' and current_gross_margin_percent > 0.3001  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_mp_atrinta_curva_b = mysqli_query($conn,$select_qtd_geral_mp_atrinta_curva_b);
$qtd_geral_mp_atrinta_curva_b = mysqli_fetch_array($resultado_qtd_geral_mp_atrinta_curva_b)[0];


//Qtd Produtos Curva B discrep entre 0 e 5
$select_qtd_geral_discrep_cinco_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve ='B' and (diff_current_pay_only_lowest BETWEEN 0 and 0.05)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%' and qty_competitors_available > 0";
$resultado_qtd_geral_discrep_cinco_curva_b = mysqli_query($conn,$select_qtd_geral_discrep_cinco_curva_b);
$qtd_geral_discrep_cinco_curva_b = mysqli_fetch_array($resultado_qtd_geral_discrep_cinco_curva_b)[0];

//Qtd Produtos Curva B discrep entre 5 e 10
$select_qtd_geral_discrep_dez_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve ='B' and (diff_current_pay_only_lowest BETWEEN 0.0501 and 0.10)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%' and qty_competitors_available > 0";
$resultado_qtd_geral_discrep_dez_curva_b = mysqli_query($conn,$select_qtd_geral_discrep_dez_curva_b);
$qtd_geral_discrep_dez_curva_b = mysqli_fetch_array($resultado_qtd_geral_discrep_dez_curva_b)[0];

//Qtd Produtos Curva B discrep entre 10 e 20
$select_qtd_geral_discrep_vinte_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve ='B' and (diff_current_pay_only_lowest BETWEEN 0.1001 and 0.20)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%' and qty_competitors_available > 0";
$resultado_qtd_geral_discrep_vinte_curva_b = mysqli_query($conn,$select_qtd_geral_discrep_vinte_curva_b);
$qtd_geral_discrep_vinte_curva_b = mysqli_fetch_array($resultado_qtd_geral_discrep_vinte_curva_b)[0];



//Qtd Produtos Curva B discrep entre 20 e 30
$select_qtd_geral_discrep_trinta_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve ='B' and (diff_current_pay_only_lowest BETWEEN 0.2001 and 0.30)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%' and qty_competitors_available > 0";
$resultado_qtd_geral_discrep_trinta_curva_b = mysqli_query($conn,$select_qtd_geral_discrep_trinta_curva_b);
$qtd_geral_discrep_trinta_curva_b = mysqli_fetch_array($resultado_qtd_geral_discrep_trinta_curva_b)[0];


//Qtd Produtos Curva B discrep acima de 30
$select_qtd_geral_discrep_atrinta_curva_b = "SELECT count(1) FROM Products where active=1
 and descontinuado <> 1 and curve ='B' and diff_current_pay_only_lowest > 0.3001  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%' and qty_competitors_available > 0";
$resultado_qtd_geral_discrep_atrinta_curva_b = mysqli_query($conn,$select_qtd_geral_discrep_atrinta_curva_b);
$qtd_geral_discrep_atrinta_curva_b = mysqli_fetch_array($resultado_qtd_geral_discrep_atrinta_curva_b)[0];



//Qtd Produtos Financiando Curva B entre 0 e 5
$select_qtd_geral_financiando_cinco_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1 and curve = 'B' 
and (current_gross_margin_percent BETWEEN -0.05 and -0.0001)   and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_financiando_cinco_curva_b = mysqli_query($conn,$select_qtd_geral_financiando_cinco_curva_b);
$qtd_geral_financiando_cinco_curva_b = mysqli_fetch_array($resultado_qtd_geral_financiando_cinco_curva_b)[0];

//Qtd Produtos Financiando  Curva B entre 5 e 10
$select_qtd_geral_financiando_dez_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1 and curve = 'B'
and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_financiando_dez_curva_b = mysqli_query($conn,$select_qtd_geral_financiando_dez_curva_b);
$qtd_geral_financiando_dez_curva_b = mysqli_fetch_array($resultado_qtd_geral_financiando_dez_curva_b)[0];

//Qtd Produtos Financiando  Curva B  entre 10 e 20
$select_qtd_geral_financiando_vinte_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1
 and curve = 'B' and (current_gross_margin_percent BETWEEN -0.20 and -0.09999) and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_financiando_vinte_curva_b = mysqli_query($conn,$select_qtd_geral_financiando_vinte_curva_b);
$qtd_geral_financiando_vinte_curva_b = mysqli_fetch_array($resultado_qtd_geral_financiando_vinte_curva_b)[0];


//Qtd Produtos Financiando  Curva B entre 20 e 30
$select_qtd_geral_financiando_trinta_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1 and curve = 'B'
 and (current_gross_margin_percent BETWEEN -0.30 and -0.19999)  and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_financiando_trinta_curva_b = mysqli_query($conn,$select_qtd_geral_financiando_trinta_curva_b);
$qtd_geral_financiando_trinta_curva_b = mysqli_fetch_array($resultado_qtd_geral_financiando_trinta_curva_b)[0];


//Qtd Produtos Financiando  Curva B acima de 30
$select_qtd_geral_financiando_atrinta_curva_b = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1 and curve = 'B'
  and current_gross_margin_percent < -0.30   and qty_stock_rms>'0' and pbm <> $pbma and department like '%$departamento%'";
$resultado_qtd_geral_financiando_atrinta_curva_b = mysqli_query($conn,$select_qtd_geral_financiando_atrinta_curva_b);
$qtd_geral_financiando_atrinta_curva_b = mysqli_fetch_array($resultado_qtd_geral_financiando_atrinta_curva_b)[0];






echo "<center>";
echo '<div class="container">';

echo '<div class="row">';
    echo '<div class="col-sm">';
echo '<div class="card" style="width: 18rem;">';
  echo '<div class="card-header">';
   echo '<b> Margem de Opera????o </b>';
  echo '</div>';
  echo '<ul class="list-group list-group-flush">';
    echo '<li class="list-group-item"><b>0% - 5%</b>  |  '.$qtd_geral_mp_cinco_curva_b. ' SKUs</li>';
    echo '<li class="list-group-item"><b>5,1% - 10%</b>  |  '.$qtd_geral_mp_dez_curva_b. ' SKUs</li>';
echo '<li class="list-group-item"><b>10,1% - 20%</b>  |  '.$qtd_geral_mp_vinte_curva_b. ' SKUs</li>';
echo '<li class="list-group-item"><b>20,1% - 30%</b>  |  '.$qtd_geral_mp_trinta_curva_b. ' SKUs</li>';
echo '<li class="list-group-item"><b> > 30%</b>  |  '.$qtd_geral_mp_atrinta_curva_b. ' SKUs</li>';

echo '</ul>';
echo '</div>';      


    echo '</div>';
    echo '<div class="col-sm">';
      echo '<div class="card" style="width: 18rem;">';
  echo '<div class="card-header">';
   echo '<b> Margem de Opera????o Negativa </b>';
  echo '</div>';
  echo '<ul class="list-group list-group-flush">';
     echo '<li class="list-group-item"><b>-5% - 0%</b>  |  '.$qtd_geral_financiando_cinco_curva_b. ' SKUs </li>';
    echo '<li class="list-group-item"><b>-10% - -5,1%</b>  |  '.$qtd_geral_financiando_dez_curva_b. ' SKUs </li>';
echo '<li class="list-group-item"><b>-20% - -10,1%</b>  |  '.$qtd_geral_financiando_vinte_curva_b. ' SKUs </li>';
echo '<li class="list-group-item"><b>30% - 20,1%</b>  |  '.$qtd_geral_financiando_trinta_curva_b. ' SKUs </li>';
echo '<li class="list-group-item"><b> < -30%</b>  |  '.$qtd_geral_financiando_atrinta_curva_b. ' SKUs </li>';
  echo '</ul>';
echo '</div>';
    echo '</div>';
    

echo '<div class="col-sm">';
      echo '<div class="card" style="width: 18rem;">';
  echo '<div class="card-header">';
   echo '<b> Discrep??ncia </b>';
 echo '</div>';
  echo '<ul class="list-group list-group-flush">';
     echo '<li class="list-group-item"><b>0% - 5%</b>  |  ' .$qtd_geral_discrep_cinco_curva_b.  ' SKUs</li>';
     echo '<li class="list-group-item"><b>5,1% - 10%</b>  |  ' .$qtd_geral_discrep_dez_curva_b.  ' SKUs</li>';
     echo '<li class="list-group-item"><b>10,1% - 20%</b>  |  ' .$qtd_geral_discrep_vinte_curva_b.  ' SKUs</li>';
     echo '<li class="list-group-item"><b>20,1% - 30%</b>  |  ' .$qtd_geral_discrep_trinta_curva_b.  ' SKUs</li>';
     echo '<li class="list-group-item"><b> > 30% </b>  |  ' .$qtd_geral_discrep_atrinta_curva_b.  ' SKUs</li>';
    
  echo '</ul>';
echo '</div>';
    echo '</div>';



  echo '</div>';
echo '</div>';
echo '</center>';

?>
