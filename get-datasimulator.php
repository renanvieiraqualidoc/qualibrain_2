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
echo $pbma;
echo "<br>";

if(!empty($_POST["departamento"])){
$departamento=$_POST["departamento"];
}else{
$departamento= "";
}



if(!empty($_POST["categoria"])){
$categoria=$_POST["categoria"];
}else{
$categoria= "";
}




if(!empty($_POST["curva"])){
$curva=$_POST["curva"];
}else{
$curva= "";
}



if(!empty($_POST["disc1"])){
$disc1=$_POST["disc1"] / 100;
}else{
$disc1= "0";
}

if(!empty($_POST["disc2"])){
$disc2=$_POST["disc2"] / 100;
}else{
$disc2= "0";
}




if(!empty($_POST["marg1"])){
$marg1=$_POST["marg1"] / 100;
}else{
$marg1= "0";
}

if(!empty($_POST["marg2"])){
$marg2=$_POST["marg2"] / 100;
}else{
$marg2= "0";
}

//SKUS
$qtd_consulta_simulator = "SELECT count(1) FROM Products where active='1' and descontinuado<>1 and department like '%$departamento%' and category like '%$categoria%' and curve like '%$curva%' and
 (current_gross_margin_percent BETWEEN $marg1 and $marg2) and (diff_current_pay_only_lowest BETWEEN $disc1 and $disc2)";
$resultado_consulta_simulator = mysqli_query($conn,$qtd_consulta_simulator);
$qtd_simulator = mysqli_fetch_array($resultado_consulta_simulator)[0];
echo "<p>Total SKUs -<b> ";
echo  number_format($qtd_simulator, 0, ',', '.') ;
echo "</b> | ";


$consultatotalestoque = "SELECT SUM(qty_stock_rms)FROM Products where active='1' and department like '%$departamento%' and category like '%$categoria%' and curve like '%$curva%' and
 (current_gross_margin_percent BETWEEN $marg1 and $marg2) and (diff_current_pay_only_lowest BETWEEN $disc1 and $disc2)";
$resultado_qtd_geral_estoque = mysqli_query($conn,$consultatotalestoque);
$qtd_geral_estoque = mysqli_fetch_array($resultado_qtd_geral_estoque)[0];
echo "Estoque Total -<b> ";
echo  number_format($qtd_geral_estoque, 0, ',', '.') ;
echo " </b> | ";
////CUSTO
$consultatotalcusto = "SELECT price_cost, qty_stock_rms from Products where active='1' and descontinuado<>1 and department
 like '%$departamento%' and category like '%$categoria%' and curve like '%$curva%' and
 (current_gross_margin_percent BETWEEN $marg1 and $marg2) and (diff_current_pay_only_lowest BETWEEN $disc1 and $disc2)";
$res_datatotalcusto = mysqli_query($conn,$consultatotalcusto);
        while($row = mysqli_fetch_array($res_datatotalcusto)){

$valoritem = $valoritem + ($row[0] * $row[1]);



}

echo "Custo Total - <b> R$ ";
echo  number_format($valoritem, 0, ',', '.') ;
echo "</b> | ";




////PAGUE APENEAS

$consultatotalpayonly = "SELECT price_pay_only, qty_stock_rms from Products where active='1' and descontinuado<>1 and department 
 like '%$departamento%' and category like '%$categoria%' and curve like '%$curva%' and
 (current_gross_margin_percent BETWEEN $marg1 and $marg2) and (diff_current_pay_only_lowest BETWEEN $disc1 and $disc2)";
$res_datatotalpayonly = mysqli_query($conn,$consultatotalpayonly);
        while($row22 = mysqli_fetch_array($res_datatotalpayonly)){

$valoritempo = $valoritempo + ($row22[0] * $row22[1]);

}

echo "Receita - <b>R$ ";
echo  number_format($valoritempo, 0, ',', '.') ;
echo "</b> | ";

$valorlb=($valoritempo - $valoritem);

echo "Lucro Bruto - <b>(R$ ";
echo  number_format($valorlb, 0, ',', '.') ;
echo ")</b></p>";


$consultatotalvendas="SELECT sum(vendas.qtd) from vendas inner join Products on Products.sku=vendas.sku where
Products.active='1' and Products.department like '%$departamento%' and Products.category like '%$categoria%' and Products.curve like '%$curva%' and
 (Products.current_gross_margin_percent BETWEEN $marg1 and $marg2) and (Products.diff_current_pay_only_lowest BETWEEN $disc1 and $disc2)";
$resultado_totalvendas = mysqli_query($conn,$consultatotalvendas);
echo "<p>Vendas Acumuladas - <b>";
echo $qtd_total_vendas = mysqli_fetch_array($resultado_totalvendas)[0];
echo "</b></p>";
?>
<html>
<!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Discrepancia</div>
                      
                    
<div class="h5 mb-0 font-weight-bold text-warning"><font size=3px> (-5% / -0,1%)-  </font><a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_cinco;?> </font></b></a></div>
     <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px>(-10% / -5%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_dez;?> </font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>(-20% / -10%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_vinte;?></font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>(-30% / -20%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_trinta;?></font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>(< -30% )-  </font><a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_atrinta;?> </font></a> </div>
<div class="h5 mb-0 font-weight-bold text-info"><font size=3px> (0% / 5%)-  </font><a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_cinco;?> </font></b></a></div>
     <div class="h5 mb-0 font-weight-bold text-info"><font size=3px>(5% / 10%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_dez;?> </font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-success"><font size=3px>(10% / 15%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_vinte;?></font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-success"><font size=3px>(15% / 20%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_trinta;?></font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-success"><font size=3px>(20% / 30% )-  </font><a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_atrinta;?> </font></a> </div>
<div class="h5 mb-0 font-weight-bold text-primary"><font size=3px>(< -30% )-  </font><a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_atrinta;?> </font></a> </div>


                    </div>
                    <div class="col-auto">

                      <i class="fas fa-sort-amount-down fa-2x text-gray-300"></i>

                    </div>
                  </div>
                </div>
              </div>

            </div>



</div>

</div>
</html>
<?php
$consultatotalsimulator = "SELECT Products.sku, Products.category, Products.department, Products.category, Products.curve from Products
 where active='1' and department like '%$departamento%' and category like '%$categoria%' and curve like '%$curva%' and
 (current_gross_margin_percent BETWEEN $marg1 and $marg2) and (diff_current_pay_only_lowest BETWEEN $disc1 and $disc2)";
$res_datasimulator = mysqli_query($conn,$consultatotalsimulator);

 while($rowsim = mysqli_fetch_array($res_datasimulator)){

echo $rowsim[0];
echo "-";
echo $rowsim[1];
echo "-";

echo $rowsim[2];
echo "-";
echo $rowsim[3];
echo "-";
echo $rowsim[4];

echo "<br>";
}

?>
