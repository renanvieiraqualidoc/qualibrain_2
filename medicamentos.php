<?php

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


    function get_percentage($totalp, $numberp)
    {
      if ( $totalp > 0 ) {
       return round($numberp / ($totalp / 100),2);
      } else {
        return 0;
      }
    }



// Função de porcentagem: N é X% de N
function porcentagem_nx ( $parcial, $total ) {
    return ( $parcial * 100 ) / $total;

}

//pbm
$select_pbmc = "SELECT count(1) FROM Products where active='1' and qty_stock_rms>0 and pbm='1'";
$resultado_pbmc = mysqli_query($conn,$select_pbmc);
$total_pbmc = mysqli_fetch_array($resultado_pbmc)[0];






//***********GERAL PRODUTOS**************//

if (isset($_GET['vpbm'])) {
$pbma = $_GET['vpbm'];

}else{

$pbma = '5';
}



////cashback

//Cashback qtd
$select_cashback_geral = "SELECT count(1) FROM Products where active=1 and current_cashback > 0 and qty_stock_rms>0 and pbm <> $pbma and department = 'medicamento'";
$resultado_cashback_geral = mysqli_query($conn,$select_cashback_geral);
$margem_cashback_geral = mysqli_fetch_array($resultado_cashback_geral)[0];


$consultatotalcashback = "SELECT qty_stock_rms, current_cashback from Products where active=1 and current_cashback > 0 and qty_stock_rms>0 and pbm <> $pbma and department = 'medicamento'";
$res_cashback = mysqli_query($conn,$consultatotalcashback);
        while($rowcashback = mysqli_fetch_array($res_cashback)){

$valoritemcashback = $valoritemcashback + ($rowcashback[0] * $rowcashback[1]);

}



//tabelados


$select_tabelados_geral = " SELECT count(1) from Products where active ='1' and tabulated_price > 0 and qty_stock_rms>0 and pbm <> $pbma and department = 'medicamento'";
$resultado_tabelados_geral = mysqli_query($conn,$select_tabelados_geral);
$margem_tabelados_geral = mysqli_fetch_array($resultado_tabelados_geral)[0];







//Margem Bruta Simulada Geral Consulta
$select_margembruta_geral = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_margembruta_geral = mysqli_query($conn,$select_margembruta_geral);
$margem_bruta_geral = mysqli_fetch_array($resultado_margembruta_geral)[0];


//Margem Bruta Simulada Geral Consulta Curva A
$select_margembruta_geral_a = "SELECT AVG(current_gross_margin_percent)  FROM Products where active=1 and curve='A' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_margembruta_geral_a = mysqli_query($conn,$select_margembruta_geral_a);
$margem_bruta_geral_a = mysqli_fetch_array($resultado_margembruta_geral_a)[0];
 
//Margem Bruta Simulada Geral Consulta Curva B
$select_margembruta_geral_b = "SELECT AVG(current_gross_margin_percent)  FROM Products where active=1 and curve='B' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_margembruta_geral_b = mysqli_query($conn,$select_margembruta_geral_b);
$margem_bruta_geral_b = mysqli_fetch_array($resultado_margembruta_geral_b)[0];

//Margem Bruta Simulada Geral Consulta Curva C
$select_margembruta_geral_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='C' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_margembruta_geral_c = mysqli_query($conn,$select_margembruta_geral_c);
$margem_bruta_geral_c = mysqli_fetch_array($resultado_margembruta_geral_c)[0];




//Margem Para o Menor Preco Geral Consulta
$select_margemmenor_geral = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_margemmenor_geral = mysqli_query($conn,$select_margemmenor_geral);
$margemmenor_geral = mysqli_fetch_array($resultado_margemmenor_geral)[0];

//Margem Para o Menor Preco Geral Consulta Curva A
$select_margemmenor_geral_a = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='A' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_margemmenor_geral_a = mysqli_query($conn,$select_margemmenor_geral_a);
$margemmenor_geral_a = mysqli_fetch_array($resultado_margemmenor_geral_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_geral_b = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='B' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_margemmenor_geral_b = mysqli_query($conn,$select_margemmenor_geral_b);
$margemmenor_geral_b = mysqli_fetch_array($resultado_margemmenor_geral_b)[0];


//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_geral_c = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='C' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_margemmenor_geral_c = mysqli_query($conn,$select_margemmenor_geral_c);
$margemmenor_geral_c = mysqli_fetch_array($resultado_margemmenor_geral_c)[0];


//Qtd Produtos Geral
$select_qtd_geral = "SELECT count(Products.sku) FROM Products where active=1 and qty_stock_rms > 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral = mysqli_query($conn,$select_qtd_geral);
$qtd_geral = mysqli_fetch_array($resultado_qtd_geral)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a = "SELECT count(1) FROM Products where active=1 and curve='A' and qty_stock_rms > 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_a = mysqli_query($conn,$select_qtd_geral_a);
$qtd_geral_a = mysqli_fetch_array($resultado_qtd_geral_a)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b = "SELECT count(1) FROM Products where active=1 and curve='B'  and qty_stock_rms > 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_b = mysqli_query($conn,$select_qtd_geral_b);
$qtd_geral_b = mysqli_fetch_array($resultado_qtd_geral_b)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c = "SELECT count(1) FROM Products where active=1 and curve='C'  and qty_stock_rms > 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_c = mysqli_query($conn,$select_qtd_geral_c);
$qtd_geral_c = mysqli_fetch_array($resultado_qtd_geral_c)[0];



//quantidade financiando



$consultatotalestoquef = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and current_gross_margin_percent < 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_estoquef = mysqli_query($conn,$consultatotalestoquef);
$qtd_geral_estoquef = mysqli_fetch_array($resultado_qtd_geral_estoquef)[0];

$consultatotalestoquef5 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_estoquef5 = mysqli_query($conn,$consultatotalestoquef5);
$qtd_geral_estoquef5 = mysqli_fetch_array($resultado_qtd_geral_estoquef5)[0];




$consultatotalestoquef10 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_estoquef10 = mysqli_query($conn,$consultatotalestoquef10);
$qtd_geral_estoquef10 = mysqli_fetch_array($resultado_qtd_geral_estoquef10)[0];


$consultatotalestoquef20 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_estoquef20 = mysqli_query($conn,$consultatotalestoquef20);
$qtd_geral_estoquef20 = mysqli_fetch_array($resultado_qtd_geral_estoquef20)[0];

$consultatotalestoquef30 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_estoquef30 = mysqli_query($conn,$consultatotalestoquef30);
$qtd_geral_estoquef30 = mysqli_fetch_array($resultado_qtd_geral_estoquef30)[0];

$consultatotalestoquef30a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and current_gross_margin_percent < -0.30 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_estoquef30a = mysqli_query($conn,$consultatotalestoquef30a);
$qtd_geral_estoquef30a = mysqli_fetch_array($resultado_qtd_geral_estoquef30a)[0];


//registered_at/////

$consulregister = "SELECT MAX(updated_at) from Products where active='1' and qty_stock_rms>0  ";
$res_dataregister = mysqli_query($conn,$consulregister);
        while($rowreg = mysqli_fetch_array($res_dataregister)){
$register_at=$rowreg[0];


}


$valortotalitemestoque= ($qtd_geral_estoquef30a + $qtd_geral_estoquef30 + $qtd_geral_estoquef20 + $qtd_geral_estoquef10 + $qtd_geral_estoquef5);

$consultatotalpayonlyf5 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN  -0.05001 and -0.0001) and pbm <> $pbma and department = 'medicamento'";
$res_datatotalpayonlyf5 = mysqli_query($conn,$consultatotalpayonlyf5);
        while($row22f5 = mysqli_fetch_array($res_datatotalpayonlyf5)){

$valoritempof5 = $valoritempof5 + ($row22f5[0] * $row22f5[1]);
$valoritempof51 = $valoritempof51 + ($row22f5[2] * $row22f5[1]);
}

$valoritempof5t = ($valoritempof5 - $valoritempof51);


$consultatotalpayonlyf10 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma and department = 'medicamento'";
$res_datatotalpayonlyf10 = mysqli_query($conn,$consultatotalpayonlyf10);
        while($row22f10 = mysqli_fetch_array($res_datatotalpayonlyf10)){

$valoritempof102 = $valoritempof102 + ($row22f10[0] * $row22f10[1]);
$valoritempof101 = $valoritempof101 + ($row22f10[2] * $row22f10[1]);
}

$valoritempof10t = ($valoritempof102 - $valoritempof101);

$consultatotalpayonlyf20 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma and department = 'medicamento'";
$res_datatotalpayonlyf20 = mysqli_query($conn,$consultatotalpayonlyf20);
        while($row22f20 = mysqli_fetch_array($res_datatotalpayonlyf20)){

$valoritempof20 = $valoritempof20 + ($row22f20[0] * $row22f20[1]);
$valoritempof201 = $valoritempof201 + ($row22f20[2] * $row22f20[1]);
}

$valoritempof20t = ($valoritempof20 - $valoritempof201);


$consultatotalpayonlyf30 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma and department = 'medicamento'";
$res_datatotalpayonlyf30 = mysqli_query($conn,$consultatotalpayonlyf30);
        while($row22f30 = mysqli_fetch_array($res_datatotalpayonlyf30)){

$valoritempof30 = $valoritempof30 + ($row22f30[0] * $row22f30[1]);
$valoritempof301 = $valoritempof301 + ($row22f30[2] * $row22f30[1]);
}

$valoritempof30t = ($valoritempof30 - $valoritempof301);



$consultatotalpayonlyf30a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent < -0.30) and pbm <> $pbma and department = 'medicamento'";
$res_datatotalpayonlyf30a = mysqli_query($conn,$consultatotalpayonlyf30a);
        while($row22f30a = mysqli_fetch_array($res_datatotalpayonlyf30a)){

$valoritempof30a = $valoritempof30a + ($row22f30a[0] * $row22f30a[1]);
$valoritempof301a = $valoritempof301a + ($row22f30a[2] * $row22f30a[1]);
}

$valoritempof30ta = ($valoritempof30a - $valoritempof301a);





$select_qtd_geral_financiando = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando = mysqli_query($conn,$select_qtd_geral_financiando);
$qtd_geral_financiando = mysqli_fetch_array($resultado_qtd_geral_financiando)[0];


//Qtd Produtos Financiando Geral Curva A
$select_qtd_geral_financiando_a = "SELECT count(1) FROM Products where active=1 and curve='A' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_a = mysqli_query($conn,$select_qtd_geral_financiando_a);
$qtd_geral_financiando_a = mysqli_fetch_array($resultado_qtd_geral_financiando_a)[0];

//Qtd Produtos Financiando Geral Curva B
$select_qtd_geral_financiando_b = "SELECT count(1) FROM Products where active=1 and curve='B' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_b = mysqli_query($conn,$select_qtd_geral_financiando_b);
$qtd_geral_financiando_b = mysqli_fetch_array($resultado_qtd_geral_financiando_b)[0];


//Qtd Produtos Financiando Geral Curva C
$select_qtd_geral_financiando_c = "SELECT count(1) FROM Products where active=1 and curve='C' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_c = mysqli_query($conn,$select_qtd_geral_financiando_c);
$qtd_geral_financiando_c = mysqli_fetch_array($resultado_qtd_geral_financiando_c)[0];



//Financiando margens

$select_qtd_geral_financiando_igual = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent = 0 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_igual = mysqli_query($conn,$select_qtd_geral_financiando_igual);
$qtd_geral_financiando_igual = mysqli_fetch_array($resultado_qtd_geral_financiando_igual)[0];



//Qtd Produtos Financiando entre 0 e 5
$select_qtd_geral_financiando_cinco = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.05 and -0.001)  and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_cinco = mysqli_query($conn,$select_qtd_geral_financiando_cinco);
$qtd_geral_financiando_cinco = mysqli_fetch_array($resultado_qtd_geral_financiando_cinco)[0];





//Qtd Produtos Financiando entre 5 e 10
$select_qtd_geral_financiando_dez = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.10 and -0.04999)  and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_dez = mysqli_query($conn,$select_qtd_geral_financiando_dez);
$qtd_geral_financiando_dez = mysqli_fetch_array($resultado_qtd_geral_financiando_dez)[0];




//Qtd Produtos Financiando entre 10 e 20
$select_qtd_geral_financiando_vinte = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.20 and -0.0999)  and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_vinte = mysqli_query($conn,$select_qtd_geral_financiando_vinte);
$qtd_geral_financiando_vinte = mysqli_fetch_array($resultado_qtd_geral_financiando_vinte)[0];



//Qtd Produtos Financiando entre 20 e 30
$select_qtd_geral_financiando_trinta = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.30 and -0.19999)  and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_trinta = mysqli_query($conn,$select_qtd_geral_financiando_trinta);
$qtd_geral_financiando_trinta = mysqli_fetch_array($resultado_qtd_geral_financiando_trinta)[0];

//Qtd Produtos Financiando acima de 30
$select_qtd_geral_financiando_atrinta = "SELECT count(1) FROM Products where active=1  and current_gross_margin_percent < -0.30  and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_financiando_atrinta = mysqli_query($conn,$select_qtd_geral_financiando_atrinta);
$qtd_geral_financiando_atrinta = mysqli_fetch_array($resultado_qtd_geral_financiando_atrinta)[0];

 $valortotalitemcusto = ($valoritempof51 + $valoritempof101 + $valoritempof201 + $valoritempof301 + $valoritempof301a);
$valortotalitempa = ($valoritempof5 + $valoritempof102 + $valoritempof20 + $valoritempof30 + $valoritempof30a);
$valortotalitemdefict = (($valoritempof5t) + ($valoritempof10t) + ($valoritempof20t) + ($valoritempof30t) + ($valoritempof30ta));

//quantidade sacrificando operacao

$select_qtd_geral_soperacao = "SELECT count(1) FROM Products where active=1 and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_soperacao = mysqli_query($conn,$select_qtd_geral_soperacao);
$qtd_geral_soperacao = mysqli_fetch_array($resultado_qtd_geral_soperacao)[0];


//Qtd Produtos  Geral Curva A
$select_qtd_geral_soperacao_a = "SELECT count(1) FROM Products where active=1 and curve='A' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_soperacao_a = mysqli_query($conn,$select_qtd_geral_soperacao_a);
$qtd_geral_soperacao_a = mysqli_fetch_array($resultado_qtd_geral_soperacao_a)[0];

//Qtd Produtos  Geral Curva B
$select_qtd_geral_soperacao_b = "SELECT count(1) FROM Products where active=1 and curve='B' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_soperacao_b = mysqli_query($conn,$select_qtd_geral_soperacao_b);
$qtd_geral_soperacao_b = mysqli_fetch_array($resultado_qtd_geral_soperacao_b)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_soperacao_c = "SELECT count(1) FROM Products where active=1 and curve='C' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_soperacao_c = mysqli_query($conn,$select_qtd_geral_soperacao_c);
$qtd_geral_soperacao_c = mysqli_fetch_array($resultado_qtd_geral_soperacao_c)[0];



//quantidade sacrificando lucro

$select_qtd_geral_slucro = "SELECT count(1) FROM Products where active=1 and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_slucro = mysqli_query($conn,$select_qtd_geral_slucro);
$qtd_geral_slucro = mysqli_fetch_array($resultado_qtd_geral_slucro)[0];


//Qtd Produtos  Geral Curva A
$select_qtd_geral_slucro_a = "SELECT count(1) FROM Products where active=1 and curve='A' and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_slucro_a = mysqli_query($conn,$select_qtd_geral_slucro_a);
$qtd_geral_slucro_a = mysqli_fetch_array($resultado_qtd_geral_slucro_a)[0];

//Qtd Produtos  Geral Curva B
$select_qtd_geral_slucro_b = "SELECT count(1) FROM Products where active=1 and curve='B' and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_slucro_b = mysqli_query($conn,$select_qtd_geral_slucro_b);
$qtd_geral_slucro_b = mysqli_fetch_array($resultado_qtd_geral_slucro_b)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_slucro_c = "SELECT count(1) FROM Products where active=1 and curve='C' and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_slucro_c = mysqli_query($conn,$select_qtd_geral_slucro_c);
$qtd_geral_slucro_c = mysqli_fetch_array($resultado_qtd_geral_slucro_c)[0];








//concorrente com menor preco

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraia = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraia = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraia);
$qtd_geral_concorrente_drogaraia = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraia)[0];

//Qtd Produtos Drogaraia Menor Curva A
$select_qtd_geral_concorrente_drogaraia_a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and curve='A' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraia_a = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraia_a);
$qtd_geral_concorrente_drogaraia_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraia_a)[0];

//Qtd Produtos Drogaraia Menor Curva B
$select_qtd_geral_concorrente_drogaraia_b = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and curve='B' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraia_b = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraia_b);
$qtd_geral_concorrente_drogaraia_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraia_b)[0];

//Qtd Produtos Drogaraia Menor Curva C
$select_qtd_geral_concorrente_drogaraia_c = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and curve='C' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraia_c = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraia_c);
$qtd_geral_concorrente_drogaraia_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraia_c)[0];



//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasil = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasil = mysqli_query($conn,$select_qtd_geral_concorrente_drogasil);
$qtd_geral_concorrente_drogasil = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasil)[0];

//Qtd Produtos Drogasil Menor A
$select_qtd_geral_concorrente_drogasil_a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and curve='A' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasil_a = mysqli_query($conn,$select_qtd_geral_concorrente_drogasil_a);
$qtd_geral_concorrente_drogasil_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasil_a)[0];


//Qtd Produtos Drogasil Menor B
$select_qtd_geral_concorrente_drogasil_b = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and curve='B' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasil_b = mysqli_query($conn,$select_qtd_geral_concorrente_drogasil_b);
$qtd_geral_concorrente_drogasil_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasil_b)[0];


//Qtd Produtos Drogasil Menor C
$select_qtd_geral_concorrente_drogasil_c = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and curve='C' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasil_c = mysqli_query($conn,$select_qtd_geral_concorrente_drogasil_c);
$qtd_geral_concorrente_drogasil_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasil_c)[0];




//Qtd Produtos Onofre Menor
$select_qtd_geral_concorrente_onofre = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.belezanaweb.com.br' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_onofre = mysqli_query($conn,$select_qtd_geral_concorrente_onofre);
$qtd_geral_concorrente_onofre = mysqli_fetch_array($resultado_qtd_geral_concorrente_onofre)[0];

//Qtd Produtos Onofre Menor A
$select_qtd_geral_concorrente_onofre_a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.belezanaweb.com.br' and curve='A' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_onofre_a = mysqli_query($conn,$select_qtd_geral_concorrente_onofre_a);
$qtd_geral_concorrente_onofre_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_onofre_a)[0];


//Qtd Produtos Onofre Menor B
$select_qtd_geral_concorrente_onofre_b = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.belezanaweb.com.br' and curve='B' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_onofre_b = mysqli_query($conn,$select_qtd_geral_concorrente_onofre_b);
$qtd_geral_concorrente_onofre_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_onofre_b)[0];


//Qtd Produtos Onofre Menor C
$select_qtd_geral_concorrente_onofre_c = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.belezanaweb.com.br' and curve='C' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_onofre_c = mysqli_query($conn,$select_qtd_geral_concorrente_onofre_c);
$qtd_geral_concorrente_onofre_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_onofre_c)[0];





//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariasp = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariasp = mysqli_query($conn,$select_qtd_geral_concorrente_drogariasp);
$qtd_geral_concorrente_drogariasp = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariasp)[0];

//Qtd Produtos Drogaria SP Menor A
$select_qtd_geral_concorrente_drogariasp_a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and curve='A' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariasp_a = mysqli_query($conn,$select_qtd_geral_concorrente_drogariasp_a);
$qtd_geral_concorrente_drogariasp_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariasp_a)[0];

//Qtd Produtos Drogaria SP Menor B
$select_qtd_geral_concorrente_drogariasp_b = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and curve='B' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariasp_b = mysqli_query($conn,$select_qtd_geral_concorrente_drogariasp_b);
$qtd_geral_concorrente_drogariasp_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariasp_b)[0];


//Qtd Produtos Drogaria SP Menor C
$select_qtd_geral_concorrente_drogariasp_c = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and curve='C' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariasp_c = mysqli_query($conn,$select_qtd_geral_concorrente_drogariasp_c);
$qtd_geral_concorrente_drogariasp_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariasp_c)[0];



//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarma = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarma = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarma);
$qtd_geral_concorrente_ultrafarma = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarma)[0];


//Qtd Produtos Ultrafarma Menor A
$select_qtd_geral_concorrente_ultrafarma_a = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and curve='A' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarma_a = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarma_a);
$qtd_geral_concorrente_ultrafarma_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarma_a)[0];

//Qtd Produtos Ultrafarma Menor B
$select_qtd_geral_concorrente_ultrafarma_b = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and curve='B' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarma_b = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarma_b);
$qtd_geral_concorrente_ultrafarma_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarma_b)[0];

//Qtd Produtos Ultrafarma Menor C
$select_qtd_geral_concorrente_ultrafarma_c = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and curve='C' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarma_c = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarma_c);
$qtd_geral_concorrente_ultrafarma_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarma_c)[0];


//concorrente com menor preco financiando




//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraiaf = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf);
 $qtd_geral_concorrente_drogaraiaf = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf)[0];

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraiaf5 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf5);
 $qtd_geral_concorrente_drogaraiaf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf5)[0];


//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraiaf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf10);
 $qtd_geral_concorrente_drogaraiaf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf10)[0];


//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraiaf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf20);
 $qtd_geral_concorrente_drogaraiaf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf20)[0];

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraiaf30 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf30);
 $qtd_geral_concorrente_drogaraiaf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf30)[0];

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf30a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and current_gross_margin_percent < -0.30  and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogaraiaf30a = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf30a);
 $qtd_geral_concorrente_drogaraiaf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf30a)[0];


//Qtd Produtos Financiando acima de 30
//(current_gross_margin_percent BETWEEN -0.05 and -0.001)
//(current_gross_margin_percent BETWEEN -0.10 and -0.04999)
//(current_gross_margin_percent BETWEEN -0.20 and -0.0999)
//(current_gross_margin_percent BETWEEN -0.30 and -0.19999)
// current_gross_margin_percent < -0.30 




//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasilf = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf);
$qtd_geral_concorrente_drogasilf = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf)[0];


//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasilf5 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf5);
$qtd_geral_concorrente_drogasilf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf5)[0];


//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasilf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf10);
$qtd_geral_concorrente_drogasilf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf10)[0];

//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasilf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf20);
$qtd_geral_concorrente_drogasilf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf20)[0];

//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasilf30 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf30);
$qtd_geral_concorrente_drogasilf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf30)[0];

//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf30a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and current_gross_margin_percent < -0.30  and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogasilf30a = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf30a);
$qtd_geral_concorrente_drogasilf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf30a)[0];





//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariaspf = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf);
$qtd_geral_concorrente_drogariaspf = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariaspf5 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf5);
$qtd_geral_concorrente_drogariaspf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf5)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariaspf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf10);
$qtd_geral_concorrente_drogariaspf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf10)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and  (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariaspf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf20);
$qtd_geral_concorrente_drogariaspf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf20)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariaspf30 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf30);
$qtd_geral_concorrente_drogariaspf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf30)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf30a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and current_gross_margin_percent < -0.30 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_drogariaspf30a = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf30a);
$qtd_geral_concorrente_drogariaspf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf30a)[0];






//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarmaf = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf);
$qtd_geral_concorrente_ultrafarmaf = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf)[0];

//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf5 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarmaf5 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf5);
$qtd_geral_concorrente_ultrafarmaf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf5)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf10 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and  (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarmaf10 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf10);
$qtd_geral_concorrente_ultrafarmaf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf10)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf20 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarmaf20 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf20);
$qtd_geral_concorrente_ultrafarmaf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf20)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf30 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarmaf30 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf30);
$qtd_geral_concorrente_ultrafarmaf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf30)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf30a = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br'  and current_gross_margin_percent < -0.30 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_ultrafarmaf30a = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf30a);
$qtd_geral_concorrente_ultrafarmaf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf30a)[0];





//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_belezanawebf = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf);
$qtd_geral_concorrente_belezanawebf = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf)[0];

//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf5 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_belezanawebf5 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf5);
$qtd_geral_concorrente_belezanawebf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf5)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf10 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and  (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_belezanawebf10 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf10);
$qtd_geral_concorrente_belezanawebf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf10)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf20 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_belezanawebf20 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf20);
$qtd_geral_concorrente_belezanawebf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf20)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf30 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_belezanawebf30 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf30);
$qtd_geral_concorrente_belezanawebf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf30)[0];
//quantidade financiando
//Qtd Produtos Financiando acima de 30
//(current_gross_margin_percent BETWEEN -0.05 and -0.001)
//(current_gross_margin_percent BETWEEN -0.10 and -0.04999)
//(current_gross_margin_percent BETWEEN -0.20 and -0.0999)
//(current_gross_margin_percent BETWEEN -0.30 and -0.19999)
// current_gross_margin_percent < -0.30 


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf30a = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br'  and current_gross_margin_percent < -0.30 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_concorrente_belezanawebf30a = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf30a);
$qtd_geral_concorrente_belezanawebf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf30a)[0];


//////RUPTURA///////////////


//Qtd Produtos Geral
$select_qtd_geral_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_ruptura = mysqli_query($conn,$select_qtd_geral_ruptura);
$qtd_geral_ruptura = mysqli_fetch_array($resultado_qtd_geral_ruptura)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='A' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_a_ruptura = mysqli_query($conn,$select_qtd_geral_a_ruptura);
$qtd_geral_a_ruptura = mysqli_fetch_array($resultado_qtd_geral_a_ruptura)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='B' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_b_ruptura = mysqli_query($conn,$select_qtd_geral_b_ruptura);
$qtd_geral_b_ruptura = mysqli_fetch_array($resultado_qtd_geral_b_ruptura)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='C' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_c_ruptura = mysqli_query($conn,$select_qtd_geral_c_ruptura);
$qtd_geral_c_ruptura = mysqli_fetch_array($resultado_qtd_geral_c_ruptura)[0];





//////EXCLUSIVO///////////////

//Qtd Produtos Geral
$select_qtd_geral_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_exclusivo = mysqli_query($conn,$select_qtd_geral_exclusivo);
$qtd_geral_exclusivo = mysqli_fetch_array($resultado_qtd_geral_exclusivo)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='A' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_a_exclusivo = mysqli_query($conn,$select_qtd_geral_a_exclusivo);
$qtd_geral_a_exclusivo = mysqli_fetch_array($resultado_qtd_geral_a_exclusivo)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='B' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_b_exclusivo = mysqli_query($conn,$select_qtd_geral_b_exclusivo);
$qtd_geral_b_exclusivo = mysqli_fetch_array($resultado_qtd_geral_b_exclusivo)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='C' and qty_stock_rms>'0' and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_c_exclusivo = mysqli_query($conn,$select_qtd_geral_c_exclusivo);
$qtd_geral_c_exclusivo = mysqli_fetch_array($resultado_qtd_geral_c_exclusivo)[0];



$consultatotalestoque = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_geral_estoque = mysqli_query($conn,$consultatotalestoque);
$qtd_geral_estoque = mysqli_fetch_array($resultado_qtd_geral_estoque)[0];

////CUSTO
$consultatotalcusto = "SELECT price_cost, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma and department = 'medicamento'";
$res_datatotalcusto = mysqli_query($conn,$consultatotalcusto);
        while($row = mysqli_fetch_array($res_datatotalcusto)){

$valoritem = $valoritem + ($row[0] * $row[1]);



}


////PAGUE APENEAS

$consultatotalpayonly = "SELECT price_pay_only, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma and department = 'medicamento'";
$res_datatotalpayonly = mysqli_query($conn,$consultatotalpayonly);
        while($row22 = mysqli_fetch_array($res_datatotalpayonly)){

$valoritempo = $valoritempo + ($row22[0] * $row22[1]);

}


////financiando
$consultatotalpayonlyf = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma and department = 'medicamento'";
$res_datatotalpayonlyf = mysqli_query($conn,$consultatotalpayonlyf);
        while($row22f = mysqli_fetch_array($res_datatotalpayonlyf)){

$valoritempof = $valoritempof + ($row22f[0] * $row22f[1]);
$valoritempof1 = $valoritempof1 + ($row22f[2] * $row22f[1]);
}





$valoritempof10 = ($valoritempof - $valoritempof1);
//Abaixo do Custo

$consultatotalpvenda = "SELECT gross_margin, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma and department = 'medicamento'";
$res_datatotalpvenda = mysqli_query($conn,$consultatotalpvenda);
        while($row223 = mysqli_fetch_array($res_datatotalpvenda)){

$valoritempv = $valoritempv + ($row223[0] * $row223[1]);

}





//Qtd Concorrentes 1
$select_qtd_concorrente1 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=1 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente1 = mysqli_query($conn,$select_qtd_concorrente1);
$qtd_concorrente1 = mysqli_fetch_array($resultado_qtd_concorrente1)[0];

//Qtd Concorrentes 2
$select_qtd_concorrente2 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=2 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente2 = mysqli_query($conn,$select_qtd_concorrente2);
$qtd_concorrente2 = mysqli_fetch_array($resultado_qtd_concorrente2)[0];

//Qtd Concorrentes 3
$select_qtd_concorrente3 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=3 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente3 = mysqli_query($conn,$select_qtd_concorrente3);
$qtd_concorrente3 = mysqli_fetch_array($resultado_qtd_concorrente3)[0];


//Qtd Concorrentes 4
$select_qtd_concorrente4 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=4 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente4 = mysqli_query($conn,$select_qtd_concorrente4);
$qtd_concorrente4 = mysqli_fetch_array($resultado_qtd_concorrente4)[0];


//Qtd Concorrentes 5
$select_qtd_concorrente5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=5 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente5 = mysqli_query($conn,$select_qtd_concorrente5);
$qtd_concorrente5 = mysqli_fetch_array($resultado_qtd_concorrente5)[0];


//Concorrentes em Ruptura



//Qtd Concorrentes 1
$select_qtd_concorrente1r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=1 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente1r = mysqli_query($conn,$select_qtd_concorrente1r);
$qtd_concorrente1r = mysqli_fetch_array($resultado_qtd_concorrente1r)[0];

//Qtd Concorrentes 2
$select_qtd_concorrente2r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=2 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente2r = mysqli_query($conn,$select_qtd_concorrente2r);
$qtd_concorrente2r = mysqli_fetch_array($resultado_qtd_concorrente2r)[0];

//Qtd Concorrentes 3
$select_qtd_concorrente3r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=3 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente3r = mysqli_query($conn,$select_qtd_concorrente3r);
$qtd_concorrente3r = mysqli_fetch_array($resultado_qtd_concorrente3r)[0];


//Qtd Concorrentes 4
$select_qtd_concorrente4r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=4 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente4r = mysqli_query($conn,$select_qtd_concorrente4r);
$qtd_concorrente4r = mysqli_fetch_array($resultado_qtd_concorrente4r)[0];


//Qtd Concorrentes 5
$select_qtd_concorrente5r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=5 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente5r = mysqli_query($conn,$select_qtd_concorrente5r);
$qtd_concorrente5r = mysqli_fetch_array($resultado_qtd_concorrente5r)[0];


//Concorrentes em Ruptura Disponiveis



//Qtd Concorrentes 1
$select_qtd_concorrente1ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=1 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente1ra = mysqli_query($conn,$select_qtd_concorrente1ra);
$qtd_concorrente1ra = mysqli_fetch_array($resultado_qtd_concorrente1ra)[0];

//Qtd Concorrentes 2
$select_qtd_concorrente2ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=2 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente2ra = mysqli_query($conn,$select_qtd_concorrente2ra);
$qtd_concorrente2ra = mysqli_fetch_array($resultado_qtd_concorrente2ra)[0];

//Qtd Concorrentes 3
$select_qtd_concorrente3ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=3 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente3ra = mysqli_query($conn,$select_qtd_concorrente3ra);
$qtd_concorrente3ra = mysqli_fetch_array($resultado_qtd_concorrente3ra)[0];


//Qtd Concorrentes 4
$select_qtd_concorrente4ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=4 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente4ra = mysqli_query($conn,$select_qtd_concorrente4ra);
$qtd_concorrente4ra = mysqli_fetch_array($resultado_qtd_concorrente4ra)[0];


//Qtd Concorrentes 5
$select_qtd_concorrente5ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=5 and pbm <> $pbma and department = 'medicamento'";
$resultado_qtd_concorrente5ra = mysqli_query($conn,$select_qtd_concorrente5ra);
$qtd_concorrente5ra = mysqli_fetch_array($resultado_qtd_concorrente5ra)[0];
/* This will give an error. Note the output
 * above, which is before the header() call */



//***********genericoS**************//



///////Geral generico////////////

////CUSTO
$select_generico_custo_geral = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'generico' and qty_stock_rms>0 and pbm <> $pbma";
$resultado_generico_custo_geral = mysqli_query($conn,$select_generico_custo_geral);
        while($rowmcg = mysqli_fetch_array($resultado_generico_custo_geral)){

$generico_custo_geral = $generico_custo_geral + ($rowmcg[0] * $rowmcg[1]);



}


$select_generico_custo_geral_a = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'generico' and qty_stock_rms>0 and pbm <> $pbma and curve ='A' ";
$resultado_generico_custo_geral_a = mysqli_query($conn,$select_generico_custo_geral_a);
        while($rowmcg_a = mysqli_fetch_array($resultado_generico_custo_geral_a)){

$generico_custo_geral_a = $generico_custo_geral_a + ($rowmcg_a[0] * $rowmcg_a[1]);



}




$select_generico_custo_geral_b = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'generico' and qty_stock_rms>0 and pbm <> $pbma and curve ='B' ";
$resultado_generico_custo_geral_b = mysqli_query($conn,$select_generico_custo_geral_b);
        while($rowmcg_b = mysqli_fetch_array($resultado_generico_custo_geral_b)){

$generico_custo_geral_b = $generico_custo_geral_b + ($rowmcg_b[0] * $rowmcg_b[1]);



}


$select_generico_custo_geral_c = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'generico' and qty_stock_rms>0 and pbm <> $pbma and curve ='C' ";
$resultado_generico_custo_geral_c = mysqli_query($conn,$select_generico_custo_geral_c);
        while($rowmcg_c = mysqli_fetch_array($resultado_generico_custo_geral_c)){

$generico_custo_geral_c = $generico_custo_geral_c + ($rowmcg_c[0] * $rowmcg_c[1]);



}



//Pague Apenas generico


$select_pagueapenas_generico = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'generico' and qty_stock_rms>0 and pbm <> $pbma";
$resultado_pagueapenas_generico = mysqli_query($conn,$select_pagueapenas_generico);
        while($row22mpa = mysqli_fetch_array($resultado_pagueapenas_generico)){

$preco_pagueapenas_generico = $preco_pagueapenas_generico + ($row22mpa[0] * $row22mpa[1]);

}




//Pague Apenas generico Curva A

$select_pagueapenas_generico_a = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'generico' and qty_stock_rms>0 and pbm <> $pbma  and curve='A'";
$resultado_pagueapenas_generico_a = mysqli_query($conn,$select_pagueapenas_generico_a);
        while($row22mpa_a = mysqli_fetch_array($resultado_pagueapenas_generico_a)){

$preco_pagueapenas_generico_a = $preco_pagueapenas_generico_a + ($row22mpa_a[0] * $row22mpa_a[1]);

}









//Pague Apenas generico Curva B

$select_pagueapenas_generico_b = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'generico' and qty_stock_rms>0 and pbm <> $pbma  and curve='B'";
$resultado_pagueapenas_generico_b = mysqli_query($conn,$select_pagueapenas_generico_b);
        while($row22mpa_b = mysqli_fetch_array($resultado_pagueapenas_generico_b)){

$preco_pagueapenas_generico_b = $preco_pagueapenas_generico_b + ($row22mpa_b[0] * $row22mpa_b[1]);

}



//Pague Apenas generico Curva C

$select_pagueapenas_generico_c = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'generico' and qty_stock_rms>0 and pbm <> $pbma  and curve='C'";
$resultado_pagueapenas_generico_c = mysqli_query($conn,$select_pagueapenas_generico_c);
        while($row22mpa_c = mysqli_fetch_array($resultado_pagueapenas_generico_c)){

$preco_pagueapenas_generico_c = $preco_pagueapenas_generico_c + ($row22mpa_c[0] * $row22mpa_c[1]);

}




//Lucro Bruto


$preco_venda_generico = ($preco_pagueapenas_generico - $generico_custo_geral);


$preco_venda_generico_a = ($preco_pagueapenas_generico_a - $generico_custo_geral_a);


$preco_venda_generico_b = ($preco_pagueapenas_generico_b - $generico_custo_geral_b);


$preco_venda_generico_c = ($preco_pagueapenas_generico_c - $generico_custo_geral_c);


$select_qtd_geral_financiandom = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'generico'";
$resultado_qtd_geral_financiandom = mysqli_query($conn,$select_qtd_geral_financiandom);
$qtd_geral_financiandom = mysqli_fetch_array($resultado_qtd_geral_financiandom)[0];

$select_qtd_geral_financiandom_a = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'generico' and curve='A'";
$resultado_qtd_geral_financiandom_a = mysqli_query($conn,$select_qtd_geral_financiandom_a);
$qtd_geral_financiandom_a = mysqli_fetch_array($resultado_qtd_geral_financiandom_a)[0];

$select_qtd_geral_financiandom_b = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'generico' and curve='B'";
$resultado_qtd_geral_financiandom_b = mysqli_query($conn,$select_qtd_geral_financiandom_b);
$qtd_geral_financiandom_b = mysqli_fetch_array($resultado_qtd_geral_financiandom_b)[0];

$select_qtd_geral_financiandom_c = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'generico' and curve='C'";
$resultado_qtd_geral_financiandom_c = mysqli_query($conn,$select_qtd_geral_financiandom_c);
$qtd_geral_financiandom_c = mysqli_fetch_array($resultado_qtd_geral_financiandom_c)[0];


////financiando
$select_financiando_genericos = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'generico'";
$res_datatotalfinanciandom = mysqli_query($conn,$select_financiando_genericos);
        while($row22fm = mysqli_fetch_array($res_datatotalfinanciandom)){

$valoritempofm = $valoritempofm + ($row22fm[0] * $row22fm[1]);
$valoritempofm1 = $valoritempofm1 + ($row22fm[2] * $row22fm[1]);
}





$valoritempofm10 = ($valoritempofm - $valoritempofm1);





$select_financiando_genericos_a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'generico' and curve='A'";
$res_datatotalfinanciandom_a = mysqli_query($conn,$select_financiando_genericos_a);
        while($row22fm_a = mysqli_fetch_array($res_datatotalfinanciandom_a)){

$valoritempofm_a = $valoritempofm_a + ($row22fm_a[0] * $row22fm_a[1]);
$valoritempofm1_a = $valoritempofm1_a + ($row22fm_a[2] * $row22fm_a[1]);
}





$valoritempofm10_a = ($valoritempofm_a - $valoritempofm1_a);



$select_financiando_genericos_b = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'generico' and curve='B'";
$res_datatotalfinanciandom_b = mysqli_query($conn,$select_financiando_genericos_b);
        while($row22fm_b = mysqli_fetch_array($res_datatotalfinanciandom_b)){

$valoritempofm_b = $valoritempofm_b + ($row22fm_b[0] * $row22fm_b[1]);
$valoritempofm1_b = $valoritempofm1_b + ($row22fm_b[2] * $row22fm_b[1]);
}





$valoritempofm10_b = ($valoritempofm_b - $valoritempofm1_b);



$select_financiando_genericos_c = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'generico' and curve='C'";
$res_datatotalfinanciandom_c = mysqli_query($conn,$select_financiando_genericos_c);
        while($row22fm_c = mysqli_fetch_array($res_datatotalfinanciandom_c)){

$valoritempofm_c = $valoritempofm_c + ($row22fm_c[0] * $row22fm_c[1]);
$valoritempofm1_c = $valoritempofm1_c + ($row22fm_c[2] * $row22fm_c[1]);
}





$valoritempofm10_c = ($valoritempofm_c - $valoritempofm1_c);








//estoque
$consultatotalestoquem = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'generico'";
$resultado_qtd_geral_estoquem = mysqli_query($conn,$consultatotalestoquem);
$qtd_geral_estoquem = mysqli_fetch_array($resultado_qtd_geral_estoquem)[0];

$consultatotalestoquem_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'generico' and Curve='A'";
$resultado_qtd_geral_estoquem_a = mysqli_query($conn,$consultatotalestoquem_a);
$qtd_geral_estoquem_a = mysqli_fetch_array($resultado_qtd_geral_estoquem_a)[0];

$consultatotalestoquem_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'generico' and Curve='B'";
$resultado_qtd_geral_estoquem_b = mysqli_query($conn,$consultatotalestoquem_b);
$qtd_geral_estoquem_b = mysqli_fetch_array($resultado_qtd_geral_estoquem_b)[0];

$consultatotalestoquem_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'generico' and Curve='C'";
$resultado_qtd_geral_estoquem_c = mysqli_query($conn,$consultatotalestoquem_c);
$qtd_geral_estoquem_c = mysqli_fetch_array($resultado_qtd_geral_estoquem_c)[0];



//qtd produtos abaixo do custo





//Margem Bruta Simulada genericos Consulta 
$select_margembruta_genericos = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and category = 'generico' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_genericos = mysqli_query($conn,$select_margembruta_genericos);
$margem_bruta_generico = mysqli_fetch_array($resultado_margembruta_genericos)[0];

//Margem Bruta Simulada genericos Consulta Curva A
$select_margembruta_genericos_a = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='A' and category = 'generico' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_genericos_a = mysqli_query($conn,$select_margembruta_genericos_a);
$margem_bruta_generico_a = mysqli_fetch_array($resultado_margembruta_genericos_a)[0];

//Margem Bruta Simulada genericos Consulta Curva B
$select_margembruta_genericos_b = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='B' and category = 'generico' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_genericos_b = mysqli_query($conn,$select_margembruta_genericos_b);
$margem_bruta_generico_b = mysqli_fetch_array($resultado_margembruta_genericos_b)[0];

//Margem Bruta Simulada genericos Consulta Curva C 
$select_margembruta_genericos_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='C' and category = 'generico' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_genericos_c = mysqli_query($conn,$select_margembruta_genericos_c);
$margem_bruta_generico_c = mysqli_fetch_array($resultado_margembruta_genericos_c)[0];







//Margem Para o Menor Preco Geral Consulta
$select_margemmenor_genericos = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and category = 'generico' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_genericos = mysqli_query($conn,$select_margemmenor_genericos);
$margemmenor_generico = mysqli_fetch_array($resultado_margemmenor_genericos)[0];




//Margem Para o Menor Preco Geral Consulta Curva A
$select_margemmenor_genericos_a = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='A' and category = 'generico' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_genericos_a = mysqli_query($conn,$select_margemmenor_genericos_a);
$margemmenor_generico_a = mysqli_fetch_array($resultado_margemmenor_genericos_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_genericos_b = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='B' and category = 'generico' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_genericos_b = mysqli_query($conn,$select_margemmenor_genericos_b);
$margemmenor_generico_b = mysqli_fetch_array($resultado_margemmenor_genericos_b)[0];

//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_genericos_c = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='C' and category = 'generico' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_genericos_c = mysqli_query($conn,$select_margemmenor_genericos_c);
$margemmenor_generico_c = mysqli_fetch_array($resultado_margemmenor_genericos_c)[0];




//Qtd Produtos genericos
$select_qtd_genericos = "SELECT count(1) FROM Products where active=1 and category = 'generico'  and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_genericos = mysqli_query($conn,$select_qtd_genericos);
$qtd_generico = mysqli_fetch_array($resultado_qtd_genericos)[0];


//Qtd Produtos genericos Curva A
$select_qtd_genericos_a = "SELECT count(1) FROM Products where active=1 and curve='A' and category = 'generico' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_genericos_a = mysqli_query($conn,$select_qtd_genericos_a);
$qtd_generico_a = mysqli_fetch_array($resultado_qtd_genericos_a)[0];



//Qtd Produtos genericos Curva B
$select_qtd_genericos_b = "SELECT count(1)FROM Products where active=1 and curve='B' and category = 'generico' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_genericos_b = mysqli_query($conn,$select_qtd_genericos_b);
$qtd_generico_b = mysqli_fetch_array($resultado_qtd_genericos_b)[0];

//Qtd Produtos genericos Curva C
$select_qtd_genericos_c = "SELECT count(1) FROM Products where active=1 and curve='C' and category = 'generico'  and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_genericos_c = mysqli_query($conn,$select_qtd_genericos_c);
$qtd_generico_c = mysqli_fetch_array($resultado_qtd_genericos_c)[0];




///////////RUPTURA genericoS////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_genericos = "SELECT count(1) FROM Products where active=1 and category = 'generico'  and qty_stock_rms ='0' and pbm <> $pbma";
$resultado_qtd_geral_ruptura_genericos = mysqli_query($conn,$select_qtd_geral_ruptura_genericos);
$qtd_geral_ruptura_genericos = mysqli_fetch_array($resultado_qtd_geral_ruptura_genericos)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_genericos = "SELECT count(1) FROM Products where active=1  and category = 'generico' and curve='A'  and qty_stock_rms ='0' and pbm <> $pbma";
$resultado_qtd_geral_a_ruptura_genericos = mysqli_query($conn,$select_qtd_geral_a_ruptura_genericos);
$qtd_geral_a_ruptura_genericos = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_genericos)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_genericos = "SELECT count(1) FROM Products where active=1 and category = 'generico' and curve='B' and qty_stock_rms ='0' and pbm <> $pbma";
$resultado_qtd_geral_b_ruptura_genericos = mysqli_query($conn,$select_qtd_geral_b_ruptura_genericos);
$qtd_geral_b_ruptura_genericos = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_genericos)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_genericos = "SELECT count(1) FROM Products where active=1 and category = 'generico' and curve='C' and qty_stock_rms ='0' and pbm <> $pbma";
$resultado_qtd_geral_c_ruptura_genericos = mysqli_query($conn,$select_qtd_geral_c_ruptura_genericos);
$qtd_geral_c_ruptura_genericos = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_genericos)[0];





//Qtd Produtos Geral
$select_qtd_geral_ee_genericos = "SELECT count(1) FROM Products where active=1 and category = 'generico' and qty_competitors='0' and pbm <> $pbma  and qty_stock_rms >'0' ";
$resultado_qtd_geral_ee_genericos = mysqli_query($conn,$select_qtd_geral_ee_genericos_genericos);
$qtd_geral_ee_genericos = mysqli_fetch_array($resultado_qtd_geral_ee_genericos_genericos)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ee_genericos = "SELECT count(1) FROM Products where active=1  and category = 'generico' and qty_competitors='0' and curve='A' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_geral_a_ee_genericos = mysqli_query($conn,$select_qtd_geral_a_ee_genericos);
$qtd_geral_a_ee = mysqli_fetch_array($resultado_qtd_geral_a_ee_genericos)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ee_genericos = "SELECT count(1) FROM Products where active=1 and category = 'generico' and qty_competitors='0' and curve='B' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_geral_b_ee_genericos = mysqli_query($conn,$select_qtd_geral_b_ee_genericos);
$qtd_geral_b_ee_genericos = mysqli_fetch_array($resultado_qtd_geral_b_ee_genericos)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ee_genericos = "SELECT count(1) FROM Products where active=1 and category = 'generico' and qty_competitors='0' and curve='C' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_geral_c_ee_genericos = mysqli_query($conn,$select_qtd_geral_c_ee_genericos);
$qtd_geral_c_ee_genericos = mysqli_fetch_array($resultado_qtd_geral_c_ee_genericos)[0];




//***********similarS**************//




///////////RUPTURA similarS////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_similar = "SELECT count(1) FROM Products where active=1 and category = 'similar' and qty_stock_rms='0' and pbm <> $pbma";
$resultado_qtd_geral_ruptura_similar = mysqli_query($conn,$select_qtd_geral_ruptura_similar);
$qtd_geral_ruptura_similar = mysqli_fetch_array($resultado_qtd_geral_ruptura_similar)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_similar = "SELECT count(1) FROM Products where active=1  and category = 'similar' and qty_stock_rms='0' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_a_ruptura_similar = mysqli_query($conn,$select_qtd_geral_a_ruptura_similar);
$qtd_geral_a_ruptura_similar = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_similar)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_similar = "SELECT count(1) FROM Products where active=1 and category = 'similar' and qty_stock_rms='0' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_b_ruptura_similar = mysqli_query($conn,$select_qtd_geral_b_ruptura_similar);
$qtd_geral_b_ruptura_similar = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_similar)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_similar = "SELECT count(1) FROM Products where active=1 and category = 'similar' and qty_stock_rms='0' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_c_ruptura_similar = mysqli_query($conn,$select_qtd_geral_c_ruptura_similar);
$qtd_geral_c_ruptura_similar = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_similar)[0];



///////Geral similar////////////

////CUSTO
$select_similar_custo_geral = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'similar' and qty_stock_rms>0 and pbm <> $pbma";
$resultado_similar_custo_geral = mysqli_query($conn,$select_similar_custo_geral);
        while($rownmcg = mysqli_fetch_array($resultado_similar_custo_geral)){

$similar_custo_geral = $similar_custo_geral + ($rownmcg[0] * $rownmcg[1]);



}


$select_similar_custo_geral_a = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'similar' and qty_stock_rms>0 and pbm <> $pbma and curve ='A' ";
$resultado_similar_custo_geral_a = mysqli_query($conn,$select_similar_custo_geral_a);
        while($rownmcg_a = mysqli_fetch_array($resultado_similar_custo_geral_a)){

$similar_custo_geral_a = $similar_custo_geral_a + ($rownmcg_a[0] * $rownmcg_a[1]);



}




$select_similar_custo_geral_b = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'similar' and qty_stock_rms>0 and pbm <> $pbma and curve ='B' ";
$resultado_similar_custo_geral_b = mysqli_query($conn,$select_similar_custo_geral_b);
        while($rownmcg_b = mysqli_fetch_array($resultado_similar_custo_geral_b)){

$similar_custo_geral_b = $similar_custo_geral_b + ($rownmcg_b[0] * $rownmcg_b[1]);



}


$select_similar_custo_geral_c = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'similar' and qty_stock_rms>0 and pbm <> $pbma and curve ='C' ";
$resultado_similar_custo_geral_c = mysqli_query($conn,$select_similar_custo_geral_c);
        while($rownmcg_c = mysqli_fetch_array($resultado_similar_custo_geral_c)){

$similar_custo_geral_c = $similar_custo_geral_c + ($rownmcg_c[0] * $rownmcg_c[1]);



}



//Pague Apenas Medicamento


$select_pagueapenas_similar = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'similar' and qty_stock_rms>0 and pbm <> $pbma";
$resultado_pagueapenas_similar = mysqli_query($conn,$select_pagueapenas_similar);
        while($row22nmpa = mysqli_fetch_array($resultado_pagueapenas_similar)){

$preco_pagueapenas_similar = $preco_pagueapenas_similar + ($row22nmpa[0] * $row22nmpa[1]);

}




//Pague Apenas Medicamento Curva A

$select_pagueapenas_similar_a = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'similar' and qty_stock_rms>0 and pbm <> $pbma  and curve='A'";
$resultado_pagueapenas_similar_a = mysqli_query($conn,$select_pagueapenas_similar_a);
        while($row22nmpa_a = mysqli_fetch_array($resultado_pagueapenas_similar_a)){

$preco_pagueapenas_similar_a = $preco_pagueapenas_similar_a + ($row22nmpa_a[0] * $row22nmpa_a[1]);

}









//Pague Apenas Medicamento Curva B

$select_pagueapenas_similar_b = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'similar' and qty_stock_rms>0 and pbm <> $pbma  and curve='B'";
$resultado_pagueapenas_similar_b = mysqli_query($conn,$select_pagueapenas_similar_b);
        while($row22nmpa_b = mysqli_fetch_array($resultado_pagueapenas_similar_b)){

$preco_pagueapenas_similar_b = $preco_pagueapenas_similar_b + ($row22nmpa_b[0] * $row22nmpa_b[1]);

}



//Pague Apenas Medicamento Curva C

$select_pagueapenas_similar_c = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'similar' and qty_stock_rms>0 and pbm <> $pbma  and curve='C'";
$resultado_pagueapenas_similar_c = mysqli_query($conn,$select_pagueapenas_similar_c);
        while($row22nmpa_c = mysqli_fetch_array($resultado_pagueapenas_similar_c)){

$preco_pagueapenas_similar_c = $preco_pagueapenas_similar_c + ($row22nmpa_c[0] * $row22nmpa_c[1]);

}




//Lucro Bruto


$preco_venda_similar = ($preco_pagueapenas_similar - $similar_custo_geral);


$preco_venda_similar_a = ($preco_pagueapenas_similar_a - $similar_custo_geral_a);


$preco_venda_similar_b = ($preco_pagueapenas_similar_b - $similar_custo_geral_b);


$preco_venda_similar_c = ($preco_pagueapenas_similar_c - $similar_custo_geral_c);


$select_qtd_geral_financiandonm = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'similar'";
$resultado_qtd_geral_financiandonm = mysqli_query($conn,$select_qtd_geral_financiandonm);
$qtd_geral_financiandonm = mysqli_fetch_array($resultado_qtd_geral_financiandonm)[0];

$select_qtd_geral_financiandonm_a = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'similar' and curve='A'";
$resultado_qtd_geral_financiandonm_a = mysqli_query($conn,$select_qtd_geral_financiandonm_a);
$qtd_geral_financiandonm_a = mysqli_fetch_array($resultado_qtd_geral_financiandonm_a)[0];

$select_qtd_geral_financiandonm_b = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'similar' and curve='B'";
$resultado_qtd_geral_financiandonm_b = mysqli_query($conn,$select_qtd_geral_financiandonm_b);
$qtd_geral_financiandonm_b = mysqli_fetch_array($resultado_qtd_geral_financiandonm_b)[0];

$select_qtd_geral_financiandonm_c = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'similar' and curve='C'";
$resultado_qtd_geral_financiandonm_c = mysqli_query($conn,$select_qtd_geral_financiandonm_c);
$qtd_geral_financiandonm_c = mysqli_fetch_array($resultado_qtd_geral_financiandonm_c)[0];


////financiando
$select_financiando_similars = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'similar'";
$res_datatotalfinanciandonm = mysqli_query($conn,$select_financiando_similars);
        while($row22fnm = mysqli_fetch_array($res_datatotalfinanciandonm)){

$valoritempofnm = $valoritempofnm + ($row22fnm[0] * $row22fnm[1]);
$valoritempofnm1 = $valoritempofnm1 + ($row22fnm[2] * $row22fnm[1]);
}





$valoritempofnm10 = ($valoritempofnm - $valoritempofnm1);





$select_financiando_similars_a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'similar' and curve='A'";
$res_datatotalfinanciandonm_a = mysqli_query($conn,$select_financiando_similars_a);
        while($row22fnm_a = mysqli_fetch_array($res_datatotalfinanciandonm_a)){

$valoritempofnm_a = $valoritempofnm_a + ($row22fnm_a[0] * $row22fnm_a[1]);
$valoritempofnm1_a = $valoritempofnm1_a + ($row22fnm_a[2] * $row22fnm_a[1]);
}





$valoritempofnm10_a = ($valoritempofnm_a - $valoritempofnm1_a);



$select_financiando_similars_b = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'similar' and curve='B'";
$res_datatotalfinanciandonm_b = mysqli_query($conn,$select_financiando_similars_b);
        while($row22fnm_b = mysqli_fetch_array($res_datatotalfinanciandonm_b)){

$valoritempofnm_b = $valoritempofnm_b + ($row22fnm_b[0] * $row22fnm_b[1]);
$valoritempofnm1_b = $valoritempofnm1_b + ($row22fnm_b[2] * $row22fnm_b[1]);
}





$valoritempofnm10_b = ($valoritempofnm_b - $valoritempofnm1_b);



$select_financiando_similars_c = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'similar' and curve='C'";
$res_datatotalfinanciandonm_c = mysqli_query($conn,$select_financiando_similars_c);
        while($row22fnm_c = mysqli_fetch_array($res_datatotalfinanciandonm_c)){

$valoritempofnm_c = $valoritempofnm_c + ($row22fnm_c[0] * $row22fnm_c[1]);
$valoritempofnm1_c = $valoritempofnm1_c + ($row22fnm_c[2] * $row22fnm_c[1]);
}





$valoritempofnm10_c = ($valoritempofnm_c - $valoritempofnm1_c);








//estoque
$consultatotalestoquenm = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'similar'";
$resultado_qtd_geral_estoquenm = mysqli_query($conn,$consultatotalestoquenm);
$qtd_geral_estoquenm = mysqli_fetch_array($resultado_qtd_geral_estoquenm)[0];

$consultatotalestoquenm_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'similar' and Curve='A'";
$resultado_qtd_geral_estoquenm_a = mysqli_query($conn,$consultatotalestoquenm_a);
$qtd_geral_estoquenm_a = mysqli_fetch_array($resultado_qtd_geral_estoquenm_a)[0];

$consultatotalestoquenm_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'similar' and Curve='B'";
$resultado_qtd_geral_estoquenm_b = mysqli_query($conn,$consultatotalestoquenm_b);
$qtd_geral_estoquenm_b = mysqli_fetch_array($resultado_qtd_geral_estoquenm_b)[0];

$consultatotalestoquenm_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'similar' and Curve='C'";
$resultado_qtd_geral_estoquenm_c = mysqli_query($conn,$consultatotalestoquenm_c);
$qtd_geral_estoquenm_c = mysqli_fetch_array($resultado_qtd_geral_estoquenm_c)[0];







//Margem Bruta Simulada similars Consulta 
$select_margembruta_similars = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_similars = mysqli_query($conn,$select_margembruta_similars);
$margem_bruta_similar = mysqli_fetch_array($resultado_margembruta_similars)[0];



//Margem Bruta Simulada similars Consulta Curva A
$select_margembruta_similars_a = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma";
$resultado_margembruta_similars_a = mysqli_query($conn,$select_margembruta_similars_a);
$margem_bruta_similar_a = mysqli_fetch_array($resultado_margembruta_similars_a)[0];

//Margem Bruta Simulada similars Consulta Curva B
$select_margembruta_similars_b = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma";
$resultado_margembruta_similars_b = mysqli_query($conn,$select_margembruta_similars_b);
$margem_bruta_similar_b = mysqli_fetch_array($resultado_margembruta_similars_b)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva C 
$select_margembruta_similars_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma";
$resultado_margembruta_similars_c = mysqli_query($conn,$select_margembruta_similars_c);
$margem_bruta_similar_c = mysqli_fetch_array($resultado_margembruta_similars_c)[0];






//Margem Para o Menor Preco similar Geral Consulta
$select_margemmenor_similars = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_similars = mysqli_query($conn,$select_margemmenor_similars);
$margemmenor_similar = mysqli_fetch_array($resultado_margemmenor_similars)[0];





//Margem Para o Menor similar Preco Geral Consulta Curva A
$select_margemmenor_similars_a = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma";
$resultado_margemmenor_similars_a = mysqli_query($conn,$select_margemmenor_similars_a);
$margemmenor_similar_a = mysqli_fetch_array($resultado_margemmenor_similars_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_similars_b = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma";
$resultado_margemmenor_similars_b = mysqli_query($conn,$select_margemmenor_similars_b);
$margemmenor_similar_b = mysqli_fetch_array($resultado_margemmenor_similars_b)[0];

//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_similars_c = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma";
$resultado_margemmenor_similars_c = mysqli_query($conn,$select_margemmenor_similars_c);
$margemmenor_similar_c = mysqli_fetch_array($resultado_margemmenor_similars_c)[0];






//Qtd Produtos similars
$select_qtd_similars = "SELECT count(1) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_qtd_similars = mysqli_query($conn,$select_qtd_similars);
$qtd_similar = mysqli_fetch_array($resultado_qtd_similars)[0];

//Qtd Produtos similars Curva A
$select_qtd_similars_a = "SELECT count(1) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve =  'A' and pbm <> $pbma";
$resultado_qtd_similars_a = mysqli_query($conn,$select_qtd_similars_a);
$qtd_similar_a = mysqli_fetch_array($resultado_qtd_similars_a)[0];



//Qtd Produtos Nao  Medicamentos Curva B
$select_qtd_similars_b = "SELECT count(1) FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve =  'B' and pbm <> $pbma";
$resultado_qtd_similars_b = mysqli_query($conn,$select_qtd_similars_b);
$qtd_similar_b = mysqli_fetch_array($resultado_qtd_similars_b)[0];

//Qtd Produtos similars Curva C
$select_qtd_similars_c = "SELECT count(1)FROM Products where active=1 and category = 'similar' and qty_stock_rms >'0' and curve =  'C' and pbm <> $pbma";
$resultado_qtd_similars_c = mysqli_query($conn,$select_qtd_similars_c);
$qtd_similar_c = mysqli_fetch_array($resultado_qtd_similars_c)[0];






///////Geral marca////////////

////CUSTO
$select_marca_custo_geral = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'marca' and qty_stock_rms > 0 and pbm <> $pbma";
$resultado_marca_custo_geral = mysqli_query($conn,$select_marca_custo_geral);
        while($rowfcg = mysqli_fetch_array($resultado_marca_custo_geral)){

$marca_custo_geral = $marca_custo_geral + ($rowfcg[0] * $rowfcg[1]);



}


$select_marca_custo_geral_a = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'marca' and qty_stock_rms>0 and pbm <> $pbma and curve ='A' and qty_stock_rms > 0 ";
$resultado_marca_custo_geral_a = mysqli_query($conn,$select_marca_custo_geral_a);
        while($rowfcg_a = mysqli_fetch_array($resultado_marca_custo_geral_a)){

$marca_custo_geral_a = $marca_custo_geral_a + ($rowfcg_a[0] * $rowfcg_a[1]);



}




$select_marca_custo_geral_b = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'marca' and qty_stock_rms>0 and pbm <> $pbma and curve ='B'  and qty_stock_rms > 0 ";
$resultado_marca_custo_geral_b = mysqli_query($conn,$select_marca_custo_geral_b);
        while($rowfcg_b = mysqli_fetch_array($resultado_marca_custo_geral_b)){

$marca_custo_geral_b = $marca_custo_geral_b + ($rowfcg_b[0] * $rowfcg_b[1]);



}


$select_marca_custo_geral_c = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'marca' and qty_stock_rms>0 and pbm <> $pbma and curve ='C' and qty_stock_rms > 0 ";
$resultado_marca_custo_geral_c = mysqli_query($conn,$select_marca_custo_geral_c);
        while($rowfcg_c = mysqli_fetch_array($resultado_marca_custo_geral_c)){

$marca_custo_geral_c = $marca_custo_geral_c + ($rowfcg_c[0] * $rowfcg_c[1]);



}



//Pague Apenas marca


$select_pagueapenas_marca = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'marca' and qty_stock_rms>0 and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_pagueapenas_marca = mysqli_query($conn,$select_pagueapenas_marca);
        while($row22fpa = mysqli_fetch_array($resultado_pagueapenas_marca)){

$preco_pagueapenas_marca = $preco_pagueapenas_marca + ($row22fpa[0] * $row22fpa[1]);

}




//Pague Apenas marca Curva A

$select_pagueapenas_marca_a = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'marca' and qty_stock_rms>0 and pbm <> $pbma  and curve='A' and qty_stock_rms > 0 ";
$resultado_pagueapenas_marca_a = mysqli_query($conn,$select_pagueapenas_marca_a);
        while($row22fpa_a = mysqli_fetch_array($resultado_pagueapenas_marca_a)){

$preco_pagueapenas_marca_a = $preco_pagueapenas_marca_a + ($row22fpa_a[0] * $row22fpa_a[1]);

}









//Pague Apenas marca Curva B

$select_pagueapenas_marca_b = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'marca' and qty_stock_rms>0 and pbm <> $pbma  and curve='B' and qty_stock_rms > 0 ";
$resultado_pagueapenas_marca_b = mysqli_query($conn,$select_pagueapenas_marca_b);
        while($row22fpa_b = mysqli_fetch_array($resultado_pagueapenas_marca_b)){

$preco_pagueapenas_marca_b = $preco_pagueapenas_marca_b + ($row22fpa_b[0] * $row22fpa_b[1]);

}



//Pague Apenas marca Curva C

$select_pagueapenas_marca_c = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'marca' and qty_stock_rms>0 and pbm <> $pbma  and curve='C' and qty_stock_rms > 0 ";
$resultado_pagueapenas_marca_c = mysqli_query($conn,$select_pagueapenas_marca_c);
        while($row22fpa_c = mysqli_fetch_array($resultado_pagueapenas_marca_c)){

$preco_pagueapenas_marca_c = $preco_pagueapenas_marca_c + ($row22fpa_c[0] * $row22fpa_c[1]);

}




//Lucro Bruto


$preco_venda_marca = ($preco_pagueapenas_marca - $marca_custo_geral);


$preco_venda_marca_a = ($preco_pagueapenas_marca_a - $marca_custo_geral_a);


$preco_venda_marca_b = ($preco_pagueapenas_marca_b - $marca_custo_geral_b);


$preco_venda_marca_c = ($preco_pagueapenas_marca_c - $marca_custo_geral_c);


$select_qtd_geral_financiandof = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'marca'";
$resultado_qtd_geral_financiandof = mysqli_query($conn,$select_qtd_geral_financiandof);
$qtd_geral_financiandof = mysqli_fetch_array($resultado_qtd_geral_financiandof)[0];

$select_qtd_geral_financiandof_a = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'marca' and curve='A'";
$resultado_qtd_geral_financiandof_a = mysqli_query($conn,$select_qtd_geral_financiandof_a);
$qtd_geral_financiandof_a = mysqli_fetch_array($resultado_qtd_geral_financiandof_a)[0];

$select_qtd_geral_financiandof_b = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'marca' and curve='B'";
$resultado_qtd_geral_financiandof_b = mysqli_query($conn,$select_qtd_geral_financiandof_b);
$qtd_geral_financiandof_b = mysqli_fetch_array($resultado_qtd_geral_financiandof_b)[0];

$select_qtd_geral_financiandof_c = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'marca' and curve='C'";
$resultado_qtd_geral_financiandof_c = mysqli_query($conn,$select_qtd_geral_financiandof_c);
$qtd_geral_financiandof_c = mysqli_fetch_array($resultado_qtd_geral_financiandof_c)[0];


////financiando
$select_financiando_marcas = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'marca'";
$res_datatotalfinanciandof = mysqli_query($conn,$select_financiando_marcas);
        while($row22ff = mysqli_fetch_array($res_datatotalfinanciandof)){

$valoritempoff = $valoritempoff + ($row22ff[0] * $row22ff[1]);
$valoritempoff1 = $valoritempoff1 + ($row22ff[2] * $row22ff[1]);
}





$valoritempoff10 = ($valoritempoff - $valoritempoff1);





$select_financiando_marcas_a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'marca' and curve='A'";
$res_datatotalfinanciandof_a = mysqli_query($conn,$select_financiando_marcas_a);
        while($row22ff_a = mysqli_fetch_array($res_datatotalfinanciandof_a)){

$valoritempoff_a = $valoritempoff_a + ($row22ff_a[0] * $row22ff_a[1]);
$valoritempoff1_a = $valoritempoff1_a + ($row22ff_a[2] * $row22ff_a[1]);
}





$valoritempoff10_a = ($valoritempoff_a - $valoritempoff1_a);



$select_financiando_marcas_b = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'marca' and curve='B'";
$res_datatotalfinanciandof_b = mysqli_query($conn,$select_financiando_marcas_b);
        while($row22fm_b = mysqli_fetch_array($res_datatotalfinanciandof_b)){

$valoritempoff_b = $valoritempoff_b + ($row22ff_b[0] * $row22ff_b[1]);
$valoritempoff1_b = $valoritempoff1_b + ($row22ff_b[2] * $row22ff_b[1]);
}





$valoritempoff10_b = ($valoritempoff_b - $valoritempoff1_b);



$select_financiando_marcas_c = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'marca' and curve='C'";
$res_datatotalfinanciandof_c = mysqli_query($conn,$select_financiando_marcas_c);
        while($row22ff_c = mysqli_fetch_array($res_datatotalfinanciandof_c)){

$valoritempoff_c = $valoritempoff_c + ($row22ff_c[0] * $row22ff_c[1]);
$valoritempoff1_c = $valoritempoff1_c + ($row22ff_c[2] * $row22ff_c[1]);
}





$valoritempoff10_c = ($valoritempoff_c - $valoritempoff1_c);








//estoque
$consultatotalestoquef = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'marca'";
$resultado_qtd_geral_estoquef = mysqli_query($conn,$consultatotalestoquef);
$qtd_geral_estoquef = mysqli_fetch_array($resultado_qtd_geral_estoquef)[0];

$consultatotalestoquef_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'marca' and Curve='A'";
$resultado_qtd_geral_estoquef_a = mysqli_query($conn,$consultatotalestoquef_a);
$qtd_geral_estoquef_a = mysqli_fetch_array($resultado_qtd_geral_estoquef_a)[0];

$consultatotalestoquef_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'marca' and Curve='B'";
$resultado_qtd_geral_estoquef_b = mysqli_query($conn,$consultatotalestoquef_b);
$qtd_geral_estoquef_b = mysqli_fetch_array($resultado_qtd_geral_estoquef_b)[0];

$consultatotalestoquef_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'marca' and Curve='C'";
$resultado_qtd_geral_estoquef_c = mysqli_query($conn,$consultatotalestoquef_c);
$qtd_geral_estoquef_c = mysqli_fetch_array($resultado_qtd_geral_estoquef_c)[0];





//Margem Bruta Simulada marca Consulta 
$select_margembruta_marca = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and category = 'marca' and pbm <> $pbma";
$resultado_margembruta_marca = mysqli_query($conn,$select_margembruta_marca);
$margem_bruta_marca = mysqli_fetch_array($resultado_margembruta_marca)[0];




//Margem Bruta Simulada marca Consulta 
$select_margembruta_marca_a = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and category = 'marca' and curve = 'A' and pbm <> $pbma";
$resultado_margembruta_marca_a = mysqli_query($conn,$select_margembruta_marca_a);
$margem_bruta_marca_a = mysqli_fetch_array($resultado_margembruta_marca_a)[0];


//Margem Bruta Simulada marca Consulta 
$select_margembruta_marca_b = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and category = 'marca' and curve = 'B' and pbm <> $pbma";
$resultado_margembruta_marca_b = mysqli_query($conn,$select_margembruta_marca_b);
$margem_bruta_marca_b = mysqli_fetch_array($resultado_margembruta_marca_b)[0];


//Margem Bruta Simulada marca Consulta 
$select_margembruta_marca_c = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and category = 'marca' and curve = 'C' and pbm <> $pbma";
$resultado_margembruta_marca_c = mysqli_query($conn,$select_margembruta_marca_c);
$margem_bruta_marca_c = mysqli_fetch_array($resultado_margembruta_marca_c)[0];









//Margem Para o Menor Preco marca Consulta
$select_margemmenor_marca = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and category = 'marca' and pbm <> $pbma";
$resultado_margemmenor_marca = mysqli_query($conn,$select_margemmenor_marca);
$margemmenor_marca = mysqli_fetch_array($resultado_margemmenor_marca)[0];



//Margem Para o Menor Preco marca Consulta
$select_margemmenor_marca_a = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and category = 'marca' and curve = 'A' and pbm <> $pbma";
$resultado_margemmenor_marca_a = mysqli_query($conn,$select_margemmenor_marca_a);
$margemmenor_marca_a = mysqli_fetch_array($resultado_margemmenor_marca_a)[0];



//Margem Para o Menor Preco marca Consulta
$select_margemmenor_marca_b = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and category = 'marca' and curve = 'B' and pbm <> $pbma";
$resultado_margemmenor_marca_b = mysqli_query($conn,$select_margemmenor_marca_b);
$margemmenor_marca_b = mysqli_fetch_array($resultado_margemmenor_marca_b)[0];


//Margem Para o Menor Preco marca Consulta
$select_margemmenor_marca_c = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and category = 'marca' and curve = 'C' and pbm <> $pbma";
$resultado_margemmenor_marca_c = mysqli_query($conn,$select_margemmenor_marca_c);
$margemmenor_marca_c = mysqli_fetch_array($resultado_margemmenor_marca_c)[0];




//Qtd Produtos marca
$select_qtd_marca = "SELECT count(1) FROM Products where active=1 and category = 'marca' and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_qtd_marca = mysqli_query($conn,$select_qtd_marca);
$qtd_marca = mysqli_fetch_array($resultado_qtd_marca)[0];


//Qtd Produtos marca
$select_qtd_marca_a = "SELECT count(1) FROM Products where active=1 and category = 'marca' and curve = 'A' and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_qtd_marca_a = mysqli_query($conn,$select_qtd_marca_a);
$qtd_marca_a = mysqli_fetch_array($resultado_qtd_marca_a)[0];

//Qtd Produtos marca
$select_qtd_marca_b = "SELECT count(1) FROM Products where active=1 and category = 'marca' and curve = 'B' and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_qtd_marca_b = mysqli_query($conn,$select_qtd_marca_b);
$qtd_marca_b = mysqli_fetch_array($resultado_qtd_marca_b)[0];

//Qtd Produtos marca
$select_qtd_marca_c = "SELECT count(1) FROM Products where active=1 and category = 'marca'  and curve = 'C' and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_qtd_marca_c = mysqli_query($conn,$select_qtd_marca_c);
$qtd_marca_c = mysqli_fetch_array($resultado_qtd_marca_c)[0];

///////////RUPTURA marca////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_marca = "SELECT count(1) FROM Products where active=1 and category = 'marca' and qty_stock_rms='0' and pbm <> $pbma ";
$resultado_qtd_geral_ruptura_marca = mysqli_query($conn,$select_qtd_geral_ruptura_marca);
$qtd_geral_ruptura_marca = mysqli_fetch_array($resultado_qtd_geral_ruptura_marca)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_marca = "SELECT count(1) FROM Products where active=1  and category = 'marca' and qty_stock_rms='0' and curve='A' and pbm <> $pbma ";
$resultado_qtd_geral_a_ruptura_marca = mysqli_query($conn,$select_qtd_geral_a_ruptura_marca);
$qtd_geral_a_ruptura_marca = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_marca)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_marca = "SELECT count(1) FROM Products where active=1 and category = 'marca' and qty_stock_rms='0' and curve='B' and pbm <> $pbma ";
$resultado_qtd_geral_b_ruptura_marca = mysqli_query($conn,$select_qtd_geral_b_ruptura_marca);
$qtd_geral_b_ruptura_marca = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_marca)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_marca = "SELECT count(1) FROM Products where active=1 and category = 'marca' and qty_stock_rms='0' and curve='C' and pbm <> $pbma  ";
$resultado_qtd_geral_c_ruptura_marca = mysqli_query($conn,$select_qtd_geral_c_ruptura_marca);
$qtd_geral_c_ruptura_marca = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_marca)[0];



?>





<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>QualiBrain - Qualidoc</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/comum.css" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    
<?php include('sidebar.html'); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
      <?php include('topbar.php'); ?>
        
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
<form name='index' id='index' method='GET'>
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Medicamento</h1>
<input type=hidden value='<?php echo $vpbm;?>' name='vpbm' id='vpbm'>
<?php 
if ($pbma == '1'){

echo '<div class="custom-control custom-switch">';
echo  '<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>';
echo  '<label class="custom-control-label" for="customSwitch1">Cenário Sem PBM</label>';
echo '</div>'; 
}
if ($pbma <> '1'){
echo '<div class="custom-control custom-switch">';
echo  '<input type="checkbox" class="custom-control-input" id="customSwitch1" >';
echo  '<label class="custom-control-label" for="customSwitch1">Cenário Sem PBM</label>';
echo '</div>'; 
}






///////Geral autocuidado////////////

////CUSTO
$select_autocuidado_custo_geral = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'autocuidado' and qty_stock_rms > 0 and pbm <> $pbma";
$resultado_autocuidado_custo_geral = mysqli_query($conn,$select_autocuidado_custo_geral);
        while($acrowfcg = mysqli_fetch_array($resultado_autocuidado_custo_geral)){

$autocuidado_custo_geral = $autocuidado_custo_geral + ($acrowfcg[0] * $acrowfcg[1]);



}


$select_autocuidado_custo_geral_a = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'autocuidado' and qty_stock_rms>0 and pbm <> $pbma and curve ='A' and qty_stock_rms > 0 ";
$resultado_autocuidado_custo_geral_a = mysqli_query($conn,$select_autocuidado_custo_geral_a);
        while($acrowfcg_a = mysqli_fetch_array($resultado_autocuidado_custo_geral_a)){

$autocuidado_custo_geral_a = $autocuidado_custo_geral_a + ($acrowfcg_a[0] * $acrowfcg_a[1]);



}




$select_autocuidado_custo_geral_b = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'autocuidado' and qty_stock_rms>0 and pbm <> $pbma and curve ='B'  and qty_stock_rms > 0 ";
$resultado_autocuidado_custo_geral_b = mysqli_query($conn,$select_autocuidado_custo_geral_b);
        while($acrowfcg_b = mysqli_fetch_array($resultado_autocuidado_custo_geral_b)){

$autocuidado_custo_geral_b = $autocuidado_custo_geral_b + ($acrowfcg_b[0] * $acrowfcg_b[1]);



}


$select_autocuidado_custo_geral_c = "SELECT price_cost, qty_stock_rms from Products where active='1' and category = 'autocuidado' and qty_stock_rms>0 and pbm <> $pbma and curve ='C' and qty_stock_rms > 0 ";
$resultado_autocuidado_custo_geral_c = mysqli_query($conn,$select_autocuidado_custo_geral_c);
        while($acrowfcg_c = mysqli_fetch_array($resultado_autocuidado_custo_geral_c)){

$autocuidado_custo_geral_c = $autocuidado_custo_geral_c + ($acrowfcg_c[0] * $acrowfcg_c[1]);



}



//Pague Apenas autocuidado


$select_pagueapenas_autocuidado = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'autocuidado' and qty_stock_rms>0 and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_pagueapenas_autocuidado = mysqli_query($conn,$select_pagueapenas_autocuidado);
        while($acrow22fpa = mysqli_fetch_array($resultado_pagueapenas_autocuidado)){

$preco_pagueapenas_autocuidado = $preco_pagueapenas_autocuidado + ($acrow22fpa[0] * $acrow22fpa[1]);

}




//Pague Apenas autocuidado Curva A

$select_pagueapenas_autocuidado_a = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'autocuidado' and qty_stock_rms>0 and pbm <> $pbma  and curve='A' and qty_stock_rms > 0 ";
$resultado_pagueapenas_autocuidado_a = mysqli_query($conn,$select_pagueapenas_autocuidado_a);
        while($acrow22fpa_a = mysqli_fetch_array($resultado_pagueapenas_autocuidado_a)){

$preco_pagueapenas_autocuidado_a = $preco_pagueapenas_autocuidado_a + ($acrow22fpa_a[0] * $acrow22fpa_a[1]);

}









//Pague Apenas autocuidado Curva B

$select_pagueapenas_autocuidado_b = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'autocuidado' and qty_stock_rms>0 and pbm <> $pbma  and curve='B' and qty_stock_rms > 0 ";
$resultado_pagueapenas_autocuidado_b = mysqli_query($conn,$select_pagueapenas_autocuidado_b);
        while($acrow22fpa_b = mysqli_fetch_array($resultado_pagueapenas_autocuidado_b)){

$preco_pagueapenas_autocuidado_b = $preco_pagueapenas_autocuidado_b + ($acrow22fpa_b[0] * $acrow22fpa_b[1]);

}



//Pague Apenas autocuidado Curva C

$select_pagueapenas_autocuidado_c = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and category = 'autocuidado' and qty_stock_rms>0 and pbm <> $pbma  and curve='C' and qty_stock_rms > 0 ";
$resultado_pagueapenas_autocuidado_c = mysqli_query($conn,$select_pagueapenas_autocuidado_c);
        while($acrow22fpa_c = mysqli_fetch_array($resultado_pagueapenas_autocuidado_c)){

$preco_pagueapenas_autocuidado_c = $preco_pagueapenas_autocuidado_c + ($acrow22fpa_c[0] * $acrow22fpa_c[1]);

}




//Lucro Bruto


$preco_venda_autocuidado = ($preco_pagueapenas_autocuidado - $autocuidado_custo_geral);


$preco_venda_autocuidado_a = ($preco_pagueapenas_autocuidado_a - $autocuidado_custo_geral_a);


$preco_venda_autocuidado_b = ($preco_pagueapenas_autocuidado_b - $autocuidado_custo_geral_b);


$preco_venda_autocuidado_c = ($preco_pagueapenas_autocuidado_c - $autocuidado_custo_geral_c);


$select_qtd_geral_financiandofac = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'autocuidado'";
$resultado_qtd_geral_financiandofac = mysqli_query($conn,$select_qtd_geral_financiandofac);
$qtd_geral_financiandofac = mysqli_fetch_array($resultado_qtd_geral_financiandofac)[0];

$select_qtd_geral_financiandofac_a = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'autocuidado' and curve='A'";
$resultado_qtd_geral_financiandofac_a = mysqli_query($conn,$select_qtd_geral_financiandofac_a);
$qtd_geral_financiandofac_a = mysqli_fetch_array($resultado_qtd_geral_financiandofac_a)[0];

$select_qtd_geral_financiandofac_b = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'autocuidado' and curve='B'";
$resultado_qtd_geral_financiandofac_b = mysqli_query($conn,$select_qtd_geral_financiandofac_b);
$qtd_geral_financiandofac_b = mysqli_fetch_array($resultado_qtd_geral_financiandofac_b)[0];

$select_qtd_geral_financiandofac_c = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and category = 'autocuidado' and curve='C'";
$resultado_qtd_geral_financiandofac_c = mysqli_query($conn,$select_qtd_geral_financiandofac_c);
$qtd_geral_financiandofac_c = mysqli_fetch_array($resultado_qtd_geral_financiandofac_c)[0];


////financiando
$select_financiando_autocuidados = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'autocuidado'";
$res_datatotalfinanciandofac = mysqli_query($conn,$select_financiando_autocuidados);
        while($acrow22ff = mysqli_fetch_array($res_datatotalfinanciandofac)){

$acvaloritempoff = $acvaloritempoff + ($acrow22ff[0] * $acrow22ff[1]);
$acvaloritempoff1 = $acvaloritempoff1 + ($acrow22ff[2] * $acrow22ff[1]);
}





$acvaloritempoff10 = ($acvaloritempoff - $acvaloritempoff1);





$select_financiando_autocuidados_a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'autocuidado' and curve='A'";
$res_datatotalfinanciandofac_a = mysqli_query($conn,$select_financiando_autocuidados_a);
        while($acrow22ff_a = mysqli_fetch_array($res_datatotalfinanciandofac_a)){

$acvaloritempoff_a = $acvaloritempoff_a + ($acrow22ff_a[0] * $acrow22ff_a[1]);
$acvaloritempoff1_a = $acvaloritempoff1_a + ($acrow22ff_a[2] * $acrow22ff_a[1]);
}





$acvaloritempoff10_a = ($acvaloritempoff_a - $acvaloritempoff1_a);



$select_financiando_autocuidados_b = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'autocuidado' and curve='B'";
$res_datatotalfinanciandofac_b = mysqli_query($conn,$select_financiando_autocuidados_b);
        while($acrow22fm_b = mysqli_fetch_array($res_datatotalfinanciandofac_b)){

$acvaloritempoff_b = $acvaloritempoff_b + ($acrow22ff_b[0] * $acrow22ff_b[1]);
$acvaloritempoff1_b = $acvaloritempoff1_b + ($acrow22ff_b[2] * $acrow22ff_b[1]);
}





$acvaloritempoff10_b = ($acvaloritempoff_b - $acvaloritempoff1_b);



$select_financiando_autocuidados_c = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and category = 'autocuidado' and curve='C'";
$res_datatotalfinanciandofac_c = mysqli_query($conn,$select_financiando_autocuidados_c);
        while($acrow22ff_c = mysqli_fetch_array($res_datatotalfinanciandofac_c)){

$acvaloritempoff_c = $acvaloritempoff_c + ($acrow22ff_c[0] * $acrow22ff_c[1]);
$acvaloritempoff1_c = $acvaloritempoff1_c + ($acrow22ff_c[2] * $acrow22ff_c[1]);
}





$acvaloritempoff10_c = ($acvaloritempoff_c - $acvaloritempoff1_c);








//estoque
$consultatotalestoqueac = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'autocuidado'";
$resultado_qtd_geral_estoqueac = mysqli_query($conn,$consultatotalestoqueac);
$qtd_geral_estoqueac = mysqli_fetch_array($resultado_qtd_geral_estoqueac)[0];

$consultatotalestoqueac_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'autocuidado' and Curve='A'";
$resultado_qtd_geral_estoqueac_a = mysqli_query($conn,$consultatotalestoqueac_a);
$qtd_geral_estoqueac_a = mysqli_fetch_array($resultado_qtd_geral_estoqueac_a)[0];

$consultatotalestoqueac_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'autocuidado' and Curve='B'";
$resultado_qtd_geral_estoqueac_b = mysqli_query($conn,$consultatotalestoqueac_b);
$qtd_geral_estoqueac_b = mysqli_fetch_array($resultado_qtd_geral_estoqueac_b)[0];

$consultatotalestoqueac_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'autocuidado' and Curve='C'";
$resultado_qtd_geral_estoqueac_c = mysqli_query($conn,$consultatotalestoqueac_c);
$qtd_geral_estoqueac_c = mysqli_fetch_array($resultado_qtd_geral_estoqueac_c)[0];





//Margem Bruta Simulada autocuidado Consulta 
$select_margembruta_autocuidado = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and category = 'autocuidado' and pbm <> $pbma";
$resultado_margembruta_autocuidado = mysqli_query($conn,$select_margembruta_autocuidado);
$margem_bruta_autocuidado = mysqli_fetch_array($resultado_margembruta_autocuidado)[0];




//Margem Bruta Simulada autocuidado Consulta 
$select_margembruta_autocuidado_a = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and category = 'autocuidado' and curve = 'A' and pbm <> $pbma";
$resultado_margembruta_autocuidado_a = mysqli_query($conn,$select_margembruta_autocuidado_a);
$margem_bruta_autocuidado_a = mysqli_fetch_array($resultado_margembruta_autocuidado_a)[0];


//Margem Bruta Simulada autocuidado Consulta 
$select_margembruta_autocuidado_b = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and category = 'autocuidado' and curve = 'B' and pbm <> $pbma";
$resultado_margembruta_autocuidado_b = mysqli_query($conn,$select_margembruta_autocuidado_b);
$margem_bruta_autocuidado_b = mysqli_fetch_array($resultado_margembruta_autocuidado_b)[0];


//Margem Bruta Simulada autocuidado Consulta 
$select_margembruta_autocuidado_c = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and category = 'autocuidado' and curve = 'C' and pbm <> $pbma";
$resultado_margembruta_autocuidado_c = mysqli_query($conn,$select_margembruta_autocuidado_c);
$margem_bruta_autocuidado_c = mysqli_fetch_array($resultado_margembruta_autocuidado_c)[0];









//Margem Para o Menor Preco autocuidado Consulta
$select_margemmenor_autocuidado = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and category = 'autocuidado' and pbm <> $pbma";
$resultado_margemmenor_autocuidado = mysqli_query($conn,$select_margemmenor_autocuidado);
$margemmenor_autocuidado = mysqli_fetch_array($resultado_margemmenor_autocuidado)[0];



//Margem Para o Menor Preco autocuidado Consulta
$select_margemmenor_autocuidado_a = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and category = 'autocuidado' and curve = 'A' and pbm <> $pbma";
$resultado_margemmenor_autocuidado_a = mysqli_query($conn,$select_margemmenor_autocuidado_a);
$margemmenor_autocuidado_a = mysqli_fetch_array($resultado_margemmenor_autocuidado_a)[0];



//Margem Para o Menor Preco autocuidado Consulta
$select_margemmenor_autocuidado_b = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and category = 'autocuidado' and curve = 'B' and pbm <> $pbma";
$resultado_margemmenor_autocuidado_b = mysqli_query($conn,$select_margemmenor_autocuidado_b);
$margemmenor_autocuidado_b = mysqli_fetch_array($resultado_margemmenor_autocuidado_b)[0];


//Margem Para o Menor Preco autocuidado Consulta
$select_margemmenor_autocuidado_c = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and category = 'autocuidado' and curve = 'C' and pbm <> $pbma";
$resultado_margemmenor_autocuidado_c = mysqli_query($conn,$select_margemmenor_autocuidado_c);
$margemmenor_autocuidado_c = mysqli_fetch_array($resultado_margemmenor_autocuidado_c)[0];




//Qtd Produtos autocuidado
$select_qtd_autocuidado = "SELECT count(1) FROM Products where active=1 and category = 'autocuidado' and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_qtd_autocuidado = mysqli_query($conn,$select_qtd_autocuidado);
$qtd_autocuidado = mysqli_fetch_array($resultado_qtd_autocuidado)[0];


//Qtd Produtos autocuidado
$select_qtd_autocuidado_a = "SELECT count(1) FROM Products where active=1 and category = 'autocuidado' and curve = 'A' and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_qtd_autocuidado_a = mysqli_query($conn,$select_qtd_autocuidado_a);
$qtd_autocuidado_a = mysqli_fetch_array($resultado_qtd_autocuidado_a)[0];

//Qtd Produtos autocuidado
$select_qtd_autocuidado_b = "SELECT count(1) FROM Products where active=1 and category = 'autocuidado' and curve = 'B' and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_qtd_autocuidado_b = mysqli_query($conn,$select_qtd_autocuidado_b);
$qtd_autocuidado_b = mysqli_fetch_array($resultado_qtd_autocuidado_b)[0];

//Qtd Produtos autocuidado
$select_qtd_autocuidado_c = "SELECT count(1) FROM Products where active=1 and category = 'autocuidado'  and curve = 'C' and pbm <> $pbma and qty_stock_rms > 0 ";
$resultado_qtd_autocuidado_c = mysqli_query($conn,$select_qtd_autocuidado_c);
$qtd_autocuidado_c = mysqli_fetch_array($resultado_qtd_autocuidado_c)[0];

///////////RUPTURA autocuidado////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_autocuidado = "SELECT count(1) FROM Products where active=1 and category = 'autocuidado' and qty_stock_rms='0' and pbm <> $pbma ";
$resultado_qtd_geral_ruptura_autocuidado = mysqli_query($conn,$select_qtd_geral_ruptura_autocuidado);
$qtd_geral_ruptura_autocuidado = mysqli_fetch_array($resultado_qtd_geral_ruptura_autocuidado)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_autocuidado = "SELECT count(1) FROM Products where active=1  and category = 'autocuidado' and qty_stock_rms='0' and curve='A' and pbm <> $pbma ";
$resultado_qtd_geral_a_ruptura_autocuidado = mysqli_query($conn,$select_qtd_geral_a_ruptura_autocuidado);
$qtd_geral_a_ruptura_autocuidado = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_autocuidado)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_autocuidado = "SELECT count(1) FROM Products where active=1 and category = 'autocuidado' and qty_stock_rms='0' and curve='B' and pbm <> $pbma ";
$resultado_qtd_geral_b_ruptura_autocuidado = mysqli_query($conn,$select_qtd_geral_b_ruptura_autocuidado);
$qtd_geral_b_ruptura_autocuidado = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_autocuidado)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_autocuidado = "SELECT count(1) FROM Products where active=1 and category = 'autocuidado' and qty_stock_rms='0' and curve='C' and pbm <> $pbma  ";
$resultado_qtd_geral_c_ruptura_autocuidado = mysqli_query($conn,$select_qtd_geral_c_ruptura_autocuidado);
$qtd_geral_c_ruptura_autocuidado = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_autocuidado)[0];




?>


  
  <label class="" >Atualizado em: <?php echo $register_at;?></label>


<script>



var id_switch = document.getElementById('customSwitch1');


id_switch.addEventListener('change',function(){
  if(this.checked == true){
 


 window.location = 'medicamentos.php?vpbm=1';

 }else{
 

 window.location = 'medicamentos.php?vpbm=5';

}
});
</script>
            <a href="#" data-toggle="modal" data-target="#relatoriomodal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Relatorio Geral</a>
          </div>
         
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Produtos Abaixo do Custo(SKU)</div>
                      
                    
<div class="h5 mb-0 font-weight-bold text-primary"><font size=3px> (-5% / -0,1%)-  </font><a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_cinco;?> </font></b></a></div>
     <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px>(-10% / -5%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_dez;?> </font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>(-20% / -10%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_vinte;?></font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>(-30% / -20%)- </font> <a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_trinta;?></font></b></a></div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>(< -30% )-  </font><a href='#'><font color='black' size=3px><?php echo $qtd_geral_financiando_atrinta;?> </font></a> </div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>R$ <?php echo  number_format($valortotalitemdefict, 0, ',', '.') ;?></font><font size=1px></font></div> 


                    </div>
                    <div class="col-auto">

                      <i class="fas fa-sort-amount-down fa-2x text-gray-300"></i>

                    </div>
                  </div>
                </div>
              </div>

            </div>



            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Demonstração financeira</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo  number_format($qtd_geral_estoque, 0, ',', '.') ;?><font size=2px>(estoque)</font></div>


<div class="h5 mb-0 font-weight-bold text-primary"><font size=3px>R$ <?php echo  number_format($valoritem, 0, ',', '.') ;?></font><font size=2px>(custo)</font></div>
     <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px>R$ <?php echo  number_format($valoritempo, 0, ',', '.') ;?></font><font size=2px>(receita)</font></div>
<div class="h5 mb-0 font-weight-bold text-success"><font size=3px>R$ <?php $valoritempva=($valoritempo - $valoritem );  echo  number_format($valoritempva, 0, ',', '.') ;?></font><font size=2px>(lucro bruto)</font></div>  
<div class="h5 mb-0 font-weight-bold text-info"><font size=3px>R$ <?php echo  number_format($valoritemcashback, 0, ',', '.') ;?></font><font size=2px>(cashback)</font></div>  


</div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

      <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Média Margem de Operação</div>
                     
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php $margem_bruta_geral1=($margem_bruta_geral * 100); echo  number_format($margem_bruta_geral1, 2, ',', '.') . '%';?></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margem_bruta_geral * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-primary"><font size=3px><?php $margem_bruta_geral1_a=($margem_bruta_geral_a * 100); echo  number_format($margem_bruta_geral1_a, 2, ',', '.') . '%';?>&nbsp;&nbsp;</font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margem_bruta_geral_a * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>

<div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px><?php $margem_bruta_geral1b=($margem_bruta_geral_b * 100); echo  number_format($margem_bruta_geral1b, 2, ',', '.') . '%';?>&nbsp;&nbsp;</font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margem_bruta_geral_b * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-danger"><font size=3px><?php $margem_bruta_geral1c=($margem_bruta_geral_c * 100); echo  number_format($margem_bruta_geral1c, 2, ',', '.') . '%';?>&nbsp;&nbsp;</font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margem_bruta_geral_c * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>


                    </div>
                    <div class="col-auto">
                      <i class="fa fa-percent fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Margem Dif. Menor Preço</div>
                     
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php $margemmenor_geral1=($margemmenor_geral * 100); echo  number_format($margemmenor_geral1, 2, ',', '.') . '%';?></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margemmenor_geral * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-primary"><font size=3px><?php $margemmenor_geral1a=($margemmenor_geral_a * 100); echo  number_format($margemmenor_geral1a, 2, ',', '.') . '%';?>&nbsp;&nbsp;</font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margemmenor_geral_a * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>

<div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px><?php $margemmenor_geral1b=($margemmenor_geral_b * 100); echo  number_format($margemmenor_geral1b, 2, ',', '.') . '%';?>&nbsp;&nbsp;</font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margemmenor_geral_b * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-danger"><font size=3px><?php $margemmenor_geral1c=($margemmenor_geral_c * 100); echo  number_format($margemmenor_geral1c, 2, ',', '.') . '%';?>&nbsp;&nbsp;</font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margemmenor_geral_c * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>


                    </div>
                    <div class="col-auto">
                      <i class="fa fa-percent fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
   <div class="col-xl-12 col-md-6 mb-4">
  <div class="row">
    <div class="col-sm">
<div class="alert alert-success" role="alert">
  Total SKUs <a href="#" class="alert-link" data-toggle="modal" data-target="#totalprodutosmodal"><?php echo  number_format($qtd_geral, 0, ',', '.');?></a>
</div>
    </div>
 <div class="col-sm">
<div class="alert alert-success" role="alert">
  Total Curva A <a href="#" class="alert-link"><?php echo  number_format($qtd_geral_a, 0, ',', '.');?></a>
</div>



    </div>

    <div class="col-sm">
<div class="alert alert-success" role="alert">
  Total Curva B <a href="#" class="alert-link"><?php echo  number_format($qtd_geral_b, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-success" role="alert">
  Total Curva C <a href="#" class="alert-link"><?php echo  number_format($qtd_geral_c, 0, ',', '.');?></a>
</div>
    </div>



	                      	
  </div>
<div class="col mr-2">
<a href="#"><span class="badge badge-warning cachbackicon" style="" data-toggle="modal" data-target="#cashbackmodal">Cashback: <?php echo number_format($margem_cashback_geral, 0, ',', '.');?> </span></a>

<a href="#"><span class="badge badge-danger cachbackicon" style="" data-toggle="modal" data-target="#tabeladomodal">Tabelados: <?php echo number_format($margem_tabelados_geral, 0, ',', '.');?> </span></a>

<a href="#"><span class="badge badge-success cachbackicon" style="" data-toggle="modal" data-target="#pbmmodal">PBM: <?php echo number_format($total_pbmc, 0, ',', '.');?> </span></a>

</div></div>
   <div class="col-xl-12 col-md-6 mb-4">
<h4 class="m-0 small font-weight-bold text-danger">PRODUTOS EM RUPTURA</h4>
  <div class="row">
    <div class="col-sm">

<div class="alert alert-danger" role="alert">
  Total SKUs <a href="#" class="alert-link" data-toggle="modal" data-target="#rupturamodal"> <?php echo  number_format($qtd_geral_ruptura, 0, ',', '.');?></a>
</div>
    </div>
 <div class="col-sm">
<div class="alert alert-danger" role="alert">
  Total Curva A <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_a_ruptura, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-danger" role="alert">
  Total Curva B <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_b_ruptura, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-danger" role="alert">
  Total Curva C <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_c_ruptura, 0, ',', '.');?></a>
</div>
    </div>

  </div>

</div>
<div class="col-xl-12 col-md-6 mb-4">
<h4 class="m-0 small font-weight-bold text-danger">PRODUTOS ABAIXO DO CUSTO</h4>
  <div class="row">
    <div class="col-sm">

<div class="alert alert-danger" role="alert">
  Total SKUs <a href="#" data-toggle="modal" data-target="#financiandomodal" class="alert-link"> <?php echo  number_format($qtd_geral_financiando, 0, ',', '.');?></a>
</div>
    </div>
 <div class="col-sm">
<div class="alert alert-danger" role="alert">
  Total Curva A <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_financiando_a, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-danger" role="alert">
  Total Curva B <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_financiando_b, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-danger" role="alert">
  Total Curva C <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_financiando_c, 0, ',', '.');?></a>
</div>
    </div>


 
   <div class="col-xl-12 col-md-6 mb-4">
<h4 class="m-0 small font-weight-bold text-danger">PRODUTOS COM ESTOQUE EXCLUSIVO</h4>
  <div class="row">
    <div class="col-sm">

<div class="alert alert-info" role="alert">
  Total SKUs <a href="#" class="alert-link" data-toggle="modal" data-target="#exclusivomodal"> <?php echo  number_format($qtd_geral_exclusivo, 0, ',', '.');?></a>
</div>
    </div>
 <div class="col-sm">
<div class="alert alert-info" role="alert">
  Total Curva A <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_a_exclusivo, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-info" role="alert">
  Total Curva B <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_b_exclusivo, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-info" role="alert">
  Total Curva C <a href="#" class="alert-link"> <?php echo  number_format($qtd_geral_c_exclusivo, 0, ',', '.');?></a>
</div>
    </div>

  </div>

</div>
<div class="container">
 <div class="row">
    <div class="col-12">
     <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Genérico</h6><div class="alert alert-light" role="alert"><b>Custo:</b> R$ <?php echo number_format($generico_custo_geral, 2, ',', '.');?> - <b>Receita:</b> R$ <?php echo number_format($preco_pagueapenas_generico, 2, ',', '.');?> - <b>Lucro Bruto:</b> R$ <?php echo number_format($preco_venda_generico, 2, ',', '.');?> - <b>Margem Op.:</b> <?php $margem_bruta_generico = $margem_bruta_generico * 100; echo number_format($margem_bruta_generico, 2, ',', '.'). '%';?> - <b>Média Diferença Menor Preco:</b> <?php $margemmenor_generico = $margemmenor_generico * 100; echo number_format($margemmenor_generico, 2, ',', '.'). '%';?> - <b>Qtd de SKUs:</b> <?php echo number_format($qtd_generico, 0, ',', '.');?> - <b>Estoque:</b> <?php echo number_format($qtd_geral_estoquem, 0, ',', '.');?> - <b>Qtd SKUs Ruptura:</b> <?php echo number_format($qtd_geral_ruptura_genericos, 0, ',', '.');?> - <b>Qtd SKUs Abaixo do Custo:</b> <?php echo number_format($qtd_geral_financiandom, 0, ',', '.');?>  - <b>Déficit Abaixo do Custo:</b><font color=red> R$ <?php echo number_format($valoritempofm10, 2, ',', '.');?></font> </div>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample2">
                  <div class="card-body">
                   
 <div class="row">
    <div class="col-sm">
<center><p><b>Curva #A</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($generico_custo_geral_a, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_generico_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_generico_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_generico_a = $margem_bruta_generico_a * 100; echo number_format($margem_bruta_generico_a, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_generico_a = $margemmenor_generico_a * 100; echo number_format($margemmenor_generico_a, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_generico_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquem_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_a_ruptura_genericos, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandom_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofm10_a, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #B</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($generico_custo_geral_b, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_generico_b, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_generico_b, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_generico_b = $margem_bruta_generico_b * 100; echo number_format($margem_bruta_generico_b, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_generico_b = $margemmenor_generico_b * 100; echo number_format($margemmenor_generico_b, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_generico_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquem_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_b_ruptura_genericos, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandom_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofm10_b, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #C</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($generico_custo_geral_c, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_generico_c, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_generico_c, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_generico_c = $margem_bruta_generico_c * 100; echo number_format($margem_bruta_generico_c, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_generico_c = $margemmenor_generico_c * 100; echo number_format($margemmenor_generico_c, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_generico_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquem_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_c_ruptura_genericos, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandom_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofm10_c, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>

  </div>
<div style="float:right"><a href="genericos.php" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right" ></i>
                    </span>
                    <span class="text"  data-toggle="modal" >Detalhar</span>
                  </a></div><br>
</div>
                  </div>
                </div>
              </div>
  </div>
</div>
<div class="container">
 <div class="row">
    <div class="col-12">
     <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1">
         <h6 class="m-0 font-weight-bold text-primary">Similar</h6><div class="alert alert-light" role="alert"><b>Custo:</b> R$ <?php echo number_format($similar_custo_geral, 2, ',', '.');?> - <b>Receita:</b> R$ <?php echo number_format($preco_pagueapenas_similar, 2, ',', '.');?> - <b>Lucro Bruto:</b> R$ <?php echo number_format($preco_venda_similar, 2, ',', '.');?> - <b>Margem Op.:</b> <?php $margem_bruta_similar = $margem_bruta_similar * 100; echo number_format($margem_bruta_similar, 2, ',', '.'). '%';?> - <b>Média Diferença Menor Preco:</b> <?php $margemmenor_similar = $margemmenor_similar * 100; echo number_format($margemmenor_similar, 2, ',', '.'). '%';?> - <b>Qtd de SKUs:</b> <?php  echo number_format($qtd_similar, 0, ',', '.');?> - <b>Estoque:</b> <?php echo number_format($qtd_geral_estoquenm, 0, ',', '.');?> - <b>Qtd SKUs Ruptura:</b> <?php echo number_format($qtd_geral_ruptura_similar, 0, ',', '.');?> - <b>Qtd SKUs Abaixo do Custo:</b> <?php echo number_format($qtd_geral_financiandonm, 0, ',', '.');?>  - <b>Déficit Abaixo do Custo:</b><font color=red> R$ <?php echo number_format($valoritempofnm10, 2, ',', '.');?></font> </div>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample1">
                                    <div class="card-body">
                   
 <div class="row">
    <div class="col-sm">
<center><p><b>Curva #A</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($similar_custo_geral_a, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_similar_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_similar_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_similar_a = $margem_bruta_similar_a * 100; echo number_format($margem_bruta_similar_a, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_similar_a = $margemmenor_similar_a * 100; echo number_format($margemmenor_similar_a, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_similar_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquenm_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_a_ruptura_similars, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandonm_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofnm10_a, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #B</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($similar_custo_geral_b, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_similar_b, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_similar_b, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_similar_b = $margem_bruta_similar_b * 100; echo number_format($margem_bruta_similar_b, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_similar_b = $margemmenor_similar_b * 100; echo number_format($margemmenor_similar_b, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_similar_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquenm_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_b_ruptura_similars, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandonm_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofnm10_b, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #C</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($similar_custo_geral_c, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_similar_c, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_similar_c, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_similar_c = $margem_bruta_similar_c * 100; echo number_format($margem_bruta_similar_c, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_similar_c = $margemmenor_similar_c * 100; echo number_format($margemmenor_similar_c, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_similar_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquenm_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_c_ruptura_similar, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandonm_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofnm10_c, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>

  </div>
<div style="float:right"><a href="similars.php" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Detalhar</span>
                  </a></div><br>
</div>

                  </div>
                </div>
              </div>
  </div>
</div>
<div class="container">
 <div class="row">
    <div class="col-12">
     <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample1ac" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1ac">
                   <h6 class="m-0 font-weight-bold text-primary">AutoCuidado</h6><div class="alert alert-light" role="alert"><b>Custo:</b> R$ <?php echo number_format($autocuidado_custo_geral, 2, ',', '.');?> - <b>Receita:</b> R$ <?php echo number_format($preco_pagueapenas_autocuidado, 2, ',', '.');?> - <b>Lucro Bruto:</b> R$ <?php echo number_format($preco_venda_autocuidado, 2, ',', '.');?> - <b>Margem Op.:</b> <?php $margem_bruta_autocuidado = $margem_bruta_autocuidado * 100; echo number_format($margem_bruta_autocuidado, 2, ',', '.'). '%';?> - <b>Média Diferença Menor Preco:</b> <?php $margemmenor_autocuidado = $margemmenor_autocuidado * 100; echo number_format($margemmenor_autocuidado, 2, ',', '.'). '%';?> - <b>Qtd de SKUs:</b> <?php  echo number_format($qtd_autocuidado, 0, ',', '.');?> - <b>Estoque:</b> <?php echo number_format($qtd_geral_estoqueac, 0, ',', '.');?> - <b>Qtd SKUs Ruptura:</b> <?php echo number_format($qtd_geral_ruptura_autocuidado, 0, ',', '.');?> - <b>Qtd SKUs Abaixo do Custo:</b> <?php echo number_format($qtd_geral_financiandofac, 0, ',', '.');?>  - <b>Déficit Abaixo do Custo:</b><font color=red> R$ <?php echo number_format($acvaloritempoff10, 2, ',', '.');?></font> </div>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample1ac">
                                    <div class="card-body">
                   
 <div class="row">
    <div class="col-sm">
<center><p><b>Curva #A</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($autocuidado_custo_geral_a, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_autocuidado_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_autocuidado_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_autocuidado_a = $margem_bruta_autocuidado_a * 100; echo number_format($margem_bruta_autocuidado_a, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_autocuidado_a = $margemmenor_autocuidado_a * 100; echo number_format($margemmenor_autocuidado_a, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_autocuidado_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoqueac_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_a_ruptura_autocuidados, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandoac_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofac10_a, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #B</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($autocuidado_custo_geral_b, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_autocuidado_b, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_autocuidado_b, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_autocuidado_b = $margem_bruta_autocuidado_b * 100; echo number_format($margem_bruta_autocuidado_b, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_autocuidado_b = $margemmenor_autocuidado_b * 100; echo number_format($margemmenor_autocuidado_b, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_autocuidado_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoqueac_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_b_ruptura_autocuidados, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandoac_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofac10_b, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #C</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($autocuidado_custo_geral_c, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_autocuidado_c, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_autocuidado_c, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_autocuidado_c = $margem_bruta_autocuidado_c * 100; echo number_format($margem_bruta_autocuidado_c, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_autocuidado_c = $margemmenor_autocuidado_c * 100; echo number_format($margemmenor_autocuidado_c, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_autocuidado_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoqueac_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_c_ruptura_autocuidado, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandoac_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempofac10_c, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>

  </div>
<div style="float:right"><a href="autocuidados.php" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Detalhar</span>
                  </a></div><br>
</div>

                  </div>
                </div>
              </div>
  </div>
</div>
<div class="container">
 <div class="row">
    <div class="col-12">
     <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCard4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExamplem4">
        <h6 class="m-0 font-weight-bold text-primary">Marca</h6><div class="alert alert-light" role="alert"><b>Custo:</b> R$ <?php echo number_format($marca_custo_geral, 2, ',', '.');?> - <b>Receita:</b> R$ <?php echo number_format($preco_pagueapenas_marca, 2, ',', '.');?> - <b>Lucro Bruto:</b> R$ <?php echo number_format($preco_venda_marca, 2, ',', '.');?> - <b>Margem Op.:</b> <?php $margem_bruta_marca = $margem_bruta_marca * 100; echo number_format($margem_bruta_marca, 2, ',', '.'). '%';?> - <b>Média Diferença Menor Preco:</b> <?php $margemmenor_marca = $margemmenor_marca * 100; echo number_format($margemmenor_marca, 2, ',', '.'). '%';?> - <b>Qtd de SKUs:</b> <?php echo number_format($qtd_marca, 0, ',', '.');?> - <b>Estoque:</b> <?php echo number_format($qtd_geral_estoquef, 0, ',', '.');?> - <b>Qtd SKUs Ruptura:</b> <?php echo number_format($qtd_geral_ruptura_marca, 0, ',', '.');?> - <b>Qtd SKUs Abaixo do Custo:</b> <?php echo number_format($qtd_geral_financiandof, 0, ',', '.');?>  - <b>Déficit Abaixo do Custo:</b><font color=red> R$ <?php echo number_format($valoritempoff10, 2, ',', '.');?></font> </div>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCard4">
                  <div class="card-body">
                   
 <div class="row">
    <div class="col-sm">
<center><p><b>Curva #A</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($marca_custo_geral_a, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_marca_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_marca_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_marca_a = $margem_bruta_marca_a * 100; echo number_format($margem_bruta_marca_a, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_marca_a = $margemmenor_marca_a * 100; echo number_format($margemmenor_marca_a, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_marca_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquef_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_a_ruptura_marca, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandof_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempoff10_a, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #B</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($marca_custo_geral_b, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_marca_b, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_marca_b, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_marca_b = $margem_bruta_marca_b * 100; echo number_format($margem_bruta_marca_b, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_marca_b = $margemmenor_marca_b * 100; echo number_format($margemmenor_marca_b, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_marca_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquef_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_b_ruptura_marca, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandof_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempoff10_b, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #C</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($marca_custo_geral_c, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_marca_c, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_marca_c, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_marca_c = $margem_bruta_marca_c * 100; echo number_format($margem_bruta_marca_c, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_marca_c = $margemmenor_marca_c * 100; echo number_format($margemmenor_marca_c, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_marca_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquef_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_c_ruptura_marca, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">SKUs Abaixo do Custo:</th>

      <td><?php echo number_format($qtd_geral_financiandof_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Déficit:</th>

      <td><font color=red>R$ <?php echo number_format($valoritempoff10_c, 0, ',', '.');?></font></td>
    </tr>

  </tbody>
</table>
    </div>

  </div>
<div style="float:right"><a href="marca.php" class="btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-arrow-right" ></i>
                    </span>
                    <span class="text"  data-toggle="modal" >Detalhar</span>
                  </a></div><br>
</div>
                  </div>
                </div>
              </div>
  </div>
</div>
          <!-- Content Row -->


<div class="container">
  <div class="row">
    <div class="col">


   

           
       
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
   <?php include('footer.html')?>;
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Deseja Mesmo Sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Selecione Sair Caso Queira Mesmo Sair.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logoff.php">Sair</a>
        </div>
      </div>
    </div>
  </div>






<!-- Ruptura Modal-->

  <div class="modal fade" id="rupturamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos em Ruptura</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

<div class="container">
  <div class="row">
    <div class="col-sm">
<div class="card-header">
                 Quantidade de Produtos Por Curva
                </div>
<div class="chart-pie pt-4 pb-2">
<canvas id="rupturaChart"></canvas>

</div>
    </div>
    <div class="col-sm">
<div class="card-header">
                 Rupturas Disponíveis Nos Concorrentes 
                </div>

<table class="table table-sm">
   <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">N. Concorrentes</th>
      <th scope="col">Disponíveis</th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1 Concorrente</th>
      <td><?php echo $qtd_concorrente1ra?></td>
       <td><?php echo $qtd_concorrente1r?></td>
    </tr>
    <tr>
      <th scope="row">2 Concorrentes</th>
      <td><?php echo $qtd_concorrente2r?></td>
       <td><?php echo $qtd_concorrente2ra?></td>
    </tr>
    <tr>
      <th scope="row">3 Concorrentes</th>
      <td><?php echo $qtd_concorrente3r?></td>
      <td><?php echo $qtd_concorrente3ra?></td>
    </tr>
<tr>
      <th scope="row">4 Concorrentes</th>
      <td ><?php echo $qtd_concorrente4r?></td>
      <td ><?php echo $qtd_concorrente4ra?></td>
    </tr>
<tr>
      <th scope="row">5 Concorrentes</th>
      <td ><?php echo $qtd_concorrente5r?></td>
      <td ><?php echo $qtd_concorrente5ra?></td>
    </tr>
  </tbody>
</table>
   
</div>

  </div>
</div>

 <div class="float-right"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxlsruptura.php'>Exportar</a></button></div></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>CONCORRENTES</th>

<th>MARCA</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>CONCORRENTES</th>

<th>MARCA</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalprodutosruptura = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, marca,qty_competitors from Products where active='1' and qty_stock_rms=0  and pbm <> $pbma  and department='medicamento'";
$res_datatotalruptura = mysqli_query($conn,$consultatotalprodutosruptura);
        while($rowr = mysqli_fetch_array($res_datatotalruptura)){
     
                echo    '<tr>';
                                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowr[0].'>'.$rowr[0].'</a></td>';
                    echo  '<td>'.utf8_encode($rowr[1]).'</td>';
 echo  '<td>'.utf8_encode($rowr[2]).'</td>';
 echo  '<td>'.utf8_encode($rowr[3]).'</td>';
 echo  '<td>'.$rowr[4].'</td>';
echo  '<td>'.$rowr[5].'</td>';
echo  '<td>'.$rowr[6].'</td>';
echo  '<td>'.$rowr[7].'</td>';
echo  '<td>'.$rowr[8].'</td>';
echo  '<td>'.round((float)$rowr[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowr[10] * 100).'%</td>';
echo  '<td>'.$rowr[11].'</td>';
echo  "<td>". number_format($rowr[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowr[12].'</td>';
echo  '</tr>';
 
}
?>               
                  </tbody>
                </table></div>
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>



<!-- Abaixo do Custo Modal-->




  <div class="modal fade" id="financiandomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabe2l">Produtos Abaixo do Custo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
         <div class="modal-body">



<div class="container">
  <div class="row">
    <div class="col-sm">
<div class="card-header">
                 Porcentagem Negativa de Margem Por SKU
                </div>
<div class="chart-pie pt-4 pb-2">
<canvas id="financiandoChart"></canvas>

</div>
              <span class="mr-2">     
  <table class="table table-sm">



<tr>

<th>#</th><th>Custo</th><th>Valor Venda</th><th>Déficit</th><th>Estoque</th>
</th>
</tr>
<tr>


<th>-5%/-1%</th><td>R$ <?php echo number_format($valoritempof51, 0, ',', '.');?> </td><td>R$ <?php echo number_format($valoritempof5, 0, ',', '.');?></td><td><font color='red'>R$ <?php echo number_format($valoritempof5t, 0, ',', '.');?></font></td><td><?php echo number_format($qtd_geral_estoquef5, 0, ',', '.');?></td>
</th>
</tr>
<th>-10%/-5%</th><td>R$ <?php echo number_format($valoritempof101, 0, ',', '.');?> </td><td>R$ <?php echo number_format($valoritempof102, 0, ',', '.');?></td><td><font color='red'>R$ <?php echo number_format($valoritempof10t, 0, ',', '.');?></font></td><td><?php echo number_format($qtd_geral_estoquef10, 0, ',', '.');?></td></td>
</th>
</tr>
<th>-20%/-10%</th><td>R$ <?php echo number_format($valoritempof201, 0, ',', '.');?> </td><td>R$ <?php echo number_format($valoritempof20, 0, ',', '.');?></td><td><font color='red'>R$ <?php echo number_format($valoritempof20t, 0, ',', '.');?></font></td><td><?php echo number_format($qtd_geral_estoquef20, 0, ',', '.');?></td>
</th>
</tr>
<th>-30%/-20%</th><td>R$ <?php echo number_format($valoritempof301, 0, ',', '.');?> </td><td>R$ <?php echo number_format($valoritempof30, 0, ',', '.');?></td><td><font color='red'>R$ <?php echo number_format($valoritempof30t, 0, ',', '.');?></font></font></td><td><?php echo number_format($qtd_geral_estoquef30, 0, ',', '.');?></td>

</th>
</tr>

<th>≤-30%</th><td>R$ <?php echo number_format($valoritempof301a, 0, ',', '.');?> </td><td>R$ <?php echo number_format($valoritempof30a, 0, ',', '.');?></td><td><font color='red'>R$ <?php echo number_format($valoritempof30ta, 0, ',', '.');?></font></td><td><?php echo number_format($qtd_geral_estoquef30a, 0, ',', '.');?></td>


</th>
</tr>
<th>Total</th><td>R$ <?php echo number_format($valortotalitemcusto, 0, ',', '.');?> </td><td>R$ <?php echo number_format($valortotalitempa, 0, ',', '.');?></td><td><font color='red'><b>R$ <?php echo number_format($valortotalitemdefict, 0, ',', '.');?></b></font></td><td><?php echo number_format($valortotalitemestoque, 0, ',', '.');?></td></b>


</th>
</tr>

<!--<th>Total</th><td><?php echo $qtd_geral_estoquef;?> </td> -->

</table>
</span>
    </div>
    <div class="col-sm">
<div class="card-header">
Concorrentes Com Menor Preço
                </div>
   
<div class="chart-pie pt-4 pb-2">
<canvas id="financiandoChartc"></canvas>

</div>

</div>

  </div>
</div>

<div class="float-right"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxlsfinanciando.php'>Exportar</a></button></div></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>MARCA</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>MARCA</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php


$consultatotalprodutosfinanciando = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, marca, qty_stock_rms from Products where active='1' and current_gross_margin_percent < 0 and qty_stock_rms > 0 and pbm <> $pbma and department='medicamento'";
$res_datatotalfinanciando = mysqli_query($conn,$consultatotalprodutosfinanciando);
        while($rowf = mysqli_fetch_array($res_datatotalfinanciando)){
     
                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowf[0].'>'.$rowf[0].'</a></td>';
                    echo  '<td>'.utf8_encode($rowf[1]).'</td>';
 echo  '<td>'.utf8_encode($rowf[2]).'</td>';
 echo  '<td>'.utf8_encode($rowf[3]).'</td>';
 echo  '<td>'.$rowf[4].'</td>';
echo  '<td>'.$rowf[5].'</td>';
echo  '<td>'.$rowf[6].'</td>';
echo  '<td>'.$rowf[7].'</td>';
echo  '<td>'.$rowf[8].'</td>';
echo  '<td>'.round((float)$rowf[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowf[10] * 100).'%</td>';
echo  '<td>'.$rowf[11].'</td>';
echo  "<td>". number_format($rowf[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowf[12].'</td>';
echo  '</tr>';
 
}
?>               
                  </tbody>
                </table></div>
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


<!-- RELATORIOS Modal-->

  <div class="modal fade" id="relatoriomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Relatórios</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                             <th>GERAL</th>
                      <th>MEDICAMENTOS</th>
                      <th>PERFUMARIA</th>

                      <th>NAO MEDICAMENTOS</th>
                    

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                    <tr>
                      
                             <th>GERAL</th>
                      <th>MEDICAMENTOS</th>
                      <th>PERFUMARIA</th>

                      <th>NAO MEDICAMENTOS</th>
                    

                    </tr>


                  </tfoot>
                  <tbody>

<tr>
<td>Relatório Geral de Produtos</td><td>Relatório Geral de Produtos</td><td>Relatório Geral de Produtos</td><td>Relatório Geral de Produtos</td>
</tr>   
<tr>
<td>Relatório Geral de Rupturas</td><td>Relatório Geral de Rupturas</td><td>Relatório Geral de Rupturas</td><td>Relatório Geral de Rupturas</td>
</tr>   
<tr>
<td>Relatório Geral de Abaixo do Custo</td><td>Relatório Geral de Abaixo do Custo</td><td>Relatório Geral de Abaixo do Custo</td><td>Relatório Geral de Abaixo do Custo</td>
</tr>   
<tr>
<td>Relatório Geral de Estoque Exclusivo</td><td>Relatório Geral de Estoque Exclusivo</td><td>Relatório Geral de Estoque Exclusivo</td><td>Relatório Geral de Estoque Exclusivo</td>
</tr>   
<tr>
<td>Relatório Geral de Cashback</td><td>Relatório Geral de Cashback</td><td>Relatório Geral de Cashback</td><td>Relatório Geral de Cashback</td>
</tr>   
<tr>
<td>Relatório Geral de PMB</td><td>Relatório Geral de PMB</td><td>Relatório Geral de PMB</td><td>Relatório Geral de PMB</td>
</tr>   
<tr>
<td>Relatório Geral de Tabelados</td><td>Relatório Geral de Tabelados</td><td>Relatório Geral de Tabelados</td><td>Relatório Geral de Tabelados</td>
</tr>   




                  </tbody>
                </table>
<table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                             <th>Relatórios Sortimento</th>
</tr>
<tr>
<td><a href='relatorio/exportxlsdrogaraia.php'>Drogaraia Sortimento</a></td>
</tr>
<tr>
<td><a href='relatorio/exportxlsdrogasil.php'>Drogasil Sortimento</a></td>
</tr>
<tr>
<td><a href='relatorio/exportxlsonofre.php'>Onofre Sortimento</a></td>
</tr>
<tr>
<td><a href='relatorio/exportxlsdrogariasp.php'>Drogaria SP Sortimento</a></td>
</tr>
<tr>
<td><a href='relatorio/exportxlsultrafarma.php'>Ultrafarma Sortimento</a></td>
</tr>

</table>

</div>
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>



<!-- PBM Modal-->

  <div class="modal fade" id="pbmmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Com PBM</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxlspbm.php'>Exportar</a></button></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>MARCA</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>MARCA</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalpbm = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, marca,qty_stock_rms from Products where active='1' and qty_stock_rms > '0' and pbm =1  and department='medicamento'";
$res_datapbmt = mysqli_query($conn,$consultatotalpbm);
        while($rowcb = mysqli_fetch_array($res_datapbmt)){
     
                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowcb[0].'>'.$rowcb[0].'</a></td>';
                    echo  '<td>'.utf8_encode($rowcb[1]).'</td>';
 echo  '<td>'.utf8_encode($rowcb[2]).'</td>';
 echo  '<td>'.utf8_encode($rowcb[3]).'</td>';
 echo  '<td>'.$rowcb[4].'</td>';
echo  '<td>'.$rowcb[5].'</td>';
echo  '<td>'.$rowcb[6].'</td>';
echo  '<td>'.$rowcb[7].'</td>';
echo  '<td>'.$rowcb[8].'</td>';
echo  '<td>'.round((float)$rowcb[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowcb[10] * 100).'%</td>';
echo  '<td>'.$rowcb[11].'</td>';
echo  "<td>". number_format($rowcb[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowcb[12].'</td>';
echo  '</tr>';
 
}
?>               
                  </tbody>
                </table></div>
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>











<!-- CashBack Modal-->

  <div class="modal fade" id="cashbackmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Com CashBack</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="float-right"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/cashbackxls.php'>Exportar</a></button></div></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">

                  <thead class="thead-dark">
                    <tr>
                      
                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>CASHBACK</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>CASHBACK</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalcashback = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, current_cashback,qty_stock_rms from Products where active='1' and qty_stock_rms > '0' and current_cashback > 0 and pbm <> $pbma  and department='medicamento'";
$res_datacashbackt = mysqli_query($conn,$consultatotalcashback);
        while($rowcb = mysqli_fetch_array($res_datacashbackt)){
     
                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowcb[0].'>'.$rowcb[0].'</a></td>';
                    echo  '<td>'.utf8_encode($rowcb[1]).'</td>';
 echo  '<td>'.utf8_encode($rowcb[2]).'</td>';
 echo  '<td>'.utf8_encode($rowcb[3]).'</td>';
 echo  '<td>'.$rowcb[4].'</td>';
echo  '<td>'.$rowcb[5].'</td>';
echo  '<td>'.$rowcb[6].'</td>';
echo  '<td>'.$rowcb[7].'</td>';
echo  '<td>'.$rowcb[8].'</td>';
echo  '<td>'.round((float)$rowcb[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowcb[10] * 100).'%</td>';
echo  '<td>'.$rowcb[11].'</td>';
echo  "<td>". number_format($rowcb[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowcb[12].'</td>';
echo  '</tr>';
 
}
?>               
                  </tbody>
                </table></div>
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>
















<!-- Tabelados Modal-->

  <div class="modal fade" id="tabeladomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Tabelados</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>TABELADO</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>TABELADO</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotaltabelado = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, tabulated_price,qty_stock_rms from Products where active='1' and qty_stock_rms > '0' and tabulated_price > 0 and pbm <> $pbma  and department='medicamento'";
$res_datatabelado = mysqli_query($conn,$consultatotaltabelado);
        while($rowta = mysqli_fetch_array($res_datatabelado)){
     
                echo    '<tr>';
                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowta[0].'>'.$rowta[0].'</a></td>';;
                    echo  '<td>'.utf8_encode($rowta[1]).'</td>';
 echo  '<td>'.utf8_encode($rowta[2]).'</td>';
 echo  '<td>'.utf8_encode($rowta[3]).'</td>';
 echo  '<td>'.$rowta[4].'</td>';
echo  '<td>'.$rowta[5].'</td>';
echo  '<td>'.$rowta[6].'</td>';
echo  '<td>'.$rowta[7].'</td>';
echo  '<td>'.$rowta[8].'</td>';
echo  '<td>'.round((float)$rowta[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowta[10] * 100).'%</td>';
echo  '<td>'.$rowta[11].'</td>';
echo  "<td>". number_format($rowta[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowta[12].'</td>';
echo  '</tr>';
 
}
?>               
                  </tbody>
                </table></div>
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>











<!-- Estoque Exclusivo Modal-->

  <div class="modal fade" id="exclusivomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Estoque Exclusivo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="float-right"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxlsexclusivo.php'>Exportar</a></button></div></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>STATUS</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>STATUS</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalprodutosexclusivo = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, situation_code_fk,qty_stock_rms from Products where active='1' and qty_stock_rms > '0' and qty_competitors='0' and pbm <> $pbma  and department='medicamento'";
$res_datatotalexclusivo = mysqli_query($conn,$consultatotalprodutosexclusivo);
        while($rowe = mysqli_fetch_array($res_datatotalexclusivo)){
     
                echo    '<tr>';
                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowe[0].'>'.$rowe[0].'</a></td>';
                    echo  '<td>'.utf8_encode($rowe[1]).'</td>';
 echo  '<td>'.utf8_encode($rowe[2]).'</td>';
 echo  '<td>'.utf8_encode($rowe[3]).'</td>';
 echo  '<td>'.$rowe[4].'</td>';
echo  '<td>'.$rowe[5].'</td>';
echo  '<td>'.$rowe[6].'</td>';
echo  '<td>'.$rowe[7].'</td>';
echo  '<td>'.$rowe[8].'</td>';
echo  '<td>'.round((float)$rowe[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowe[10] * 100).'%</td>';
echo  '<td>'.$rowe[11].'</td>';
echo  "<td>". number_format($rowe[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowe[12].'</td>';
echo  '</tr>';
 
}
?>               
                  </tbody>
                </table></div>
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>








<script>




// chart colors





  $(function () {
    $('#myTab a:last').tab('show')
  })
</script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<!-- myModal PRODUTOS NOSSOS -->
<div id="totalprodutosmodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
               <h4>Total Produtos</h4> <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">



<!----------TOTAL PRODUTOS-------------->





<div class="container">
<br>
  <div class="row">
    <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                Produtos Por Curva e Situação
                </div>

 <div class="chart-area">
<canvas id="totalChart" height=200 ></canvas>


                  </div>
  <div class="mt-4 text-center small">
                    <span class="mr-2">
                   <table border=1>



<tr>
<th>Curva</th><th>Ruptura</th><th>Abaixo/Igual Custo</th><th>Sacrificando Margem OP.</th><th>Sacrificando Margem Lucro</th><th>Estoque Exclusivo</th>
</th>
</tr>
<tr>
<th>A</th><td><?php echo $qtd_geral_a_ruptura;?> </td><td><?php echo $qtd_geral_financiando_a;?></td><td><?php echo $qtd_geral_soperacao_a;?></td><td><?php echo $qtd_geral_slucro_a;?></td><td><?php echo $qtd_geral_a_exclusivo;?></td>
</th>
</tr>
<tr>
<th>B</th><td><?php echo $qtd_geral_b_ruptura;?> </td><td><?php echo $qtd_geral_financiando_b;?></td><td><?php echo $qtd_geral_soperacao_b;?></td><td><?php echo $qtd_geral_slucro_b;?></td><td><?php echo $qtd_geral_b_exclusivo;?></td>
</th>
</tr>
<tr>
<th>C</th><td><?php echo $qtd_geral_c_ruptura;?> </td><td><?php echo $qtd_geral_financiando_c;?></td><td><?php echo $qtd_geral_soperacao_c;?></td><td><?php echo $qtd_geral_slucro_c;?></td><td><?php echo $qtd_geral_c_exclusivo;?></td>
</th>
</tr>
<tr>
<th>TOTAL</th><td><?php echo $qtd_geral_ruptura;?> </td><td><?php echo $qtd_geral_financiando;?></td><td><?php echo $qtd_geral_soperacao;?></td><td><?php echo $qtd_geral_slucro;?></td><td><?php echo $qtd_geral_exclusivo;?></td>
</th>
</tr>
</table>
<?php 


?> 
<table border=1>
<tr>
<th>Estoque total - </th><td ><b><font color=red><?php echo number_format($qtd_geral_estoque, 0, ',', '.');?></font></b> </td><th>Custo Total</th><td><b><font color=red>R$ <?php echo number_format($valoritem, 2, ',', '.');?></font></b> </td></th>
<th>Pague Apenas</th><td><b><font color=red>R$ <?php echo number_format($valoritempo, 2, ',', '.');?></font></b> </td></th>
<th>Margem Bruta</th><td><b><font color=red>R$ <?php echo number_format($valoritempv, 2, ',', '.');?></font></b> </td></th>
</tr>
</table>
                    </span>
                  </div>

    </div></div>
      <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
Ranking de Menor Preço por Concorrente 
                </div>
<div class="chart-pie pt-4 pb-2">
                    <canvas id="menorconcorrenteChart"></canvas>
                  </div>  <div class="mt-4 text-center ">
              <span class="mr-2">     
  <table class="table table-sm">



<tr>
<th>Concorrente</th><th>Curva A</th><th>Curva B</th><th>Curva C</th><th>Total</th>
</th>
</tr>
<tr>
<th>Drogaraia</th><td><?php echo $qtd_geral_concorrente_drogaraia_a;?> </td><td><?php echo $qtd_geral_concorrente_drogaraia_b;?></td><td><?php echo $qtd_geral_concorrente_drogaraia_c;?></td><td><?php echo $qtd_geral_concorrente_drogaraia;?></td>
</th>
</tr>
<th>Drogasil</th><td><?php echo  $qtd_geral_concorrente_drogasil_a;?> </td><td><?php echo  $qtd_geral_concorrente_drogasil_b;?></td><td><?php echo  $qtd_geral_concorrente_drogasil_c;?></td><td><?php echo $qtd_geral_concorrente_drogasil;?></td>
</th>
</tr>
<th>BelezaNaWeb</th><td><?php echo $qtd_geral_concorrente_onofre_a;?> </td><td><?php echo $qtd_geral_concorrente_onofre_b;?></td><td><?php echo $qtd_geral_concorrente_onofre_c;?></td><td><?php echo $qtd_geral_concorrente_onofre;?></td>
</th>
</tr>
<th>DrogariaSP</th><td><?php echo $qtd_geral_concorrente_drogariasp_a;?> </td><td><?php echo $qtd_geral_concorrente_drogariasp_b;?></td><td><?php echo $qtd_geral_concorrente_drogariasp_c;?></td><td><?php echo $qtd_geral_concorrente_drogariasp;?></td>

</th>
</tr>
<th>Ultrafarma</th><td><?php echo $qtd_geral_concorrente_ultrafarma_a;?> </td><td><?php echo $qtd_geral_concorrente_ultrafarma_b;?></td><td><?php echo $qtd_geral_concorrente_ultrafarma_c;?></td><td><?php echo $qtd_geral_concorrente_ultrafarma;?></td>
</th>

</tr>

</table>

<table class="table" border=1>
 <thead style="font-size:11px">
<tr>
<th>1 Concorrente</th><th>2 Concorrentes</th><th>3 Concorrentes</th><th>4 Concorrentes</th><th>5 Concorrentes</th>
</tr>
</thead>
<tbody style="font-size:12px; font-color:red; font-weight: bold;">
<td><?php echo $qtd_concorrente1;?></td><td><?php echo $qtd_concorrente2;?></td><td><?php echo $qtd_concorrente3;?></td><td><?php echo $qtd_concorrente4;?></td><td><?php echo $qtd_concorrente5;?></td>
</tr>
</tbody>
</table>
                    </span>
                  </div>

    </div></div>

  </div>
</div>


                      <div class="float-right"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxls.php'>Exportar</a></button></div></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>Concorrentes</th>
<th>Marca</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>



                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>ESTOQUE</th>

<th>Concorrentes</th>
<th>Marca</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalprodutos = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, qty_stock_rms, qty_competitors, marca  from Products where active='1' and pbm <> $pbma  and department='medicamento'";
$res_datatotal = mysqli_query($conn,$consultatotalprodutos);
        while($row = mysqli_fetch_array($res_datatotal)){
     
                echo    '<tr>';
                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$row[0].'>'.$row[0].'</a></td>';
                    echo  '<td>'.utf8_encode($row[1]).'</td>';
 echo  '<td>'.utf8_encode($row[2]).'</td>';
 echo  '<td>'.utf8_encode($row[3]).'</td>';
 echo  '<td>'.$row[4].'</td>';
echo  '<td>'.$row[5].'</td>';
echo  '<td>'.$row[6].'</td>';
echo  '<td>'.$row[7].'</td>';
echo  '<td>'.$row[8].'</td>';
echo  '<td>'.round((float)$row[9] * 100).'%</td>';
echo  '<td>'.round((float)$row[10] * 100).'%</td>';
echo  '<td>'.$row[11].'</td>';
echo  "<td>". number_format($row[13], 0, ',', '.') ."</td>";
echo  '<td>'.$row[13].'</td>';
echo  '<td>'.$row[14].'</td>';

echo  '</tr>';
 
}
?>               
                  </tbody>
                </table>

</div>


</div>
















  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>


  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>



</body>




<script>

$(document).ready(function() {
    $('table.display').DataTable();
} );

var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];


var totalRuptura = <?php echo $qtd_geral_ruptura;?>;
var totalRupturaA = <?php echo $qtd_geral_a_ruptura;?>;
var totalRupturaB = <?php echo $qtd_geral_b_ruptura;?>;
var totalRupturaC = <?php echo $qtd_geral_c_ruptura;?>;


var totalp = <?php echo $qtd_geral;?>;
var totalpA = <?php echo $qtd_geral_a;?>;
var totalpB = <?php echo $qtd_geral_b;?>;
var totalpC = <?php echo $qtd_geral_c;?>;
var financiando =<?php echo $qtd_geral_financiando;?>;
var financiandoA =<?php echo $qtd_geral_financiando_a;?>;
var financiandoB =<?php echo $qtd_geral_financiando_b;?>;
var financiandoC =<?php echo $qtd_geral_financiando_c;?>;

var sacrificandomo =<?php echo $qtd_geral_soperacao;?>;
var sacrificandomoA =<?php echo $qtd_geral_soperacao_a;?>;
var sacrificandomoB =<?php echo $qtd_geral_soperacao_b;?>;
var sacrificandomoC =<?php echo $qtd_geral_soperacao_c;?>;

var sacrificandoml =<?php echo $qtd_geral_slucro;?>;
var sacrificandomlA =<?php echo $qtd_geral_slucro_a;?>;
var sacrificandomlB =<?php echo $qtd_geral_slucro_b;?>;
var sacrificandomlC =<?php echo $qtd_geral_slucro_c;?>;

var estoqueexclusivo =<?php echo $qtd_geral_exclusivo;?>;
var estoqueexclusivoA =<?php echo $qtd_geral_a_exclusivo;?>;
var estoqueexclusivoB =<?php echo $qtd_geral_b_exclusivo;?>;
var estoqueexclusivoC =<?php echo $qtd_geral_c_exclusivo;?>;

var concorrenteUltra=<?php echo $qtd_geral_concorrente_ultrafarma;?>;

var concorrenteRaia=<?php echo $qtd_geral_concorrente_drogaraia;?>;

var concorrenteSil=<?php echo $qtd_geral_concorrente_drogasil;?>;

var concorrenteDSP=<?php echo $qtd_geral_concorrente_drogariasp;?>;

var concorrenteOnofre=<?php echo $qtd_geral_concorrente_onofre;?>;




/* bar chart */
var ctx = document.getElementById("totalChart").getContext("2d");

var data = {
  labels: ["TOTAL", "CURVA A", "CURVA B","CURVA C" ],
  datasets: [{
    label: "Total Produtos",
    backgroundColor: "blue",
    data: [totalp, totalpA, totalpB, totalpC]
  }, {
    label: "Ruptura",
    backgroundColor: "gray",
    data: [totalRuptura, totalRupturaA, totalRupturaB, totalRupturaC]

 }, {
    label: "Abaixo/Igual Custo",
    backgroundColor: "red",
    data: [financiando, financiandoA, financiandoB, financiandoC]
  
 }, {
label: "Sacrificando Margem de OP.",
    backgroundColor: "green",
    data: [sacrificandomo,sacrificandomoA,sacrificandomoB,sacrificandomoC]
  
 }, {
    label: "Sacrificando Margem Lucro",
    backgroundColor: "purple",
    data: [sacrificandoml, sacrificandomlA, sacrificandomlB, sacrificandomlC]
 
 }, {
    label: "Estoque Exclusivo",
    backgroundColor: "black",
    data: [estoqueexclusivo, estoqueexclusivoA, estoqueexclusivoB, estoqueexclusivoC]
 }]

};

var myBarChart = new Chart(ctx, {
  type: 'bar',
  data: data,
  options: {
    barValueSpacing: 6,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,

        }
      }]
    }
  }
});





/* 3 donut charts */
var donutOptions = {
  cutoutPercentage: 85, 
  legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
};



// donut 3
var chDonutData3 = {
    labels: ['Angular', 'React', 'Other'],
    datasets: [
      {
        backgroundColor: colors.slice(0,3),
        borderWidth: 0,
        data: [21, 45, 55, 33]
      }
    ]
};
var chDonut3 = document.getElementById("chDonut3");
if (chDonut3) {
  new Chart(chDonut3, {
      type: 'pie',
      data: chDonutData3,
      options: donutOptions
  });
}




// donut 3
var chDonutDataMC = {
    labels: ['Drogaraia', 'Drogasil', 'BelezaNaWeb', 'DrogariaSP', 'Ultrafarma'],
    datasets: [
      {
        backgroundColor: colors.slice(0,5),
        borderWidth: 0,
        data: [concorrenteRaia, concorrenteSil, concorrenteOnofre, concorrenteDSP, concorrenteUltra]
      }
    ]
};
var menorconcorrenteChart = document.getElementById("menorconcorrenteChart");
if (menorconcorrenteChart) {
  new Chart(menorconcorrenteChart, {
      type: 'pie',
      data: chDonutDataMC,
      options: donutOptions
  });
}




// donut 3
var chDonutDataMC1 = {
    labels: ['Curva A', 'Curva B', 'Curva C'],
    datasets: [
      {
        backgroundColor: colors.slice(0,5),
        borderWidth: 0,
        data: [totalRupturaA, totalRupturaB, totalRupturaC]
      }
    ]
};
var rupturaChart = document.getElementById("rupturaChart");
if (rupturaChart) {
  new Chart(rupturaChart, {
      type: 'pie',
      data: chDonutDataMC1,
      options: donutOptions
  });
}

var financiando5=<?php echo $qtd_geral_financiando_cinco;?>;
var financiando10=<?php echo $qtd_geral_financiando_dez;?>;
var financiando20=<?php echo $qtd_geral_financiando_vinte;?>;
var financiando30=<?php echo $qtd_geral_financiando_trinta;?>;
var financiando30a=<?php echo $qtd_geral_financiando_atrinta;?>;




// donut 3
var chDonutDataMC12 = {
    labels: ['(-5% / -1%)', '(-10% / -5%)', '(-20% / -10%)','(-30% / -20%)','(≤ -30% )' ],
    datasets: [
      {
        backgroundColor: colors.slice(0,5),
        borderWidth: 0,
        data: [financiando5, financiando10, financiando20, financiando30, financiando30a],
          render: 'percentage',      
}
    ]
};
var financiandoChart = document.getElementById("financiandoChart");
if (financiandoChart) {
  new Chart(financiandoChart, {
      type: 'pie',
      data: chDonutDataMC12,
      options: donutOptions
  });
}
var cfultra=<?php echo $qtd_geral_concorrente_ultrafarmaf;?>;                  
var cfraia=<?php echo $qtd_geral_concorrente_drogaraiaf;?>;                  
var cfsil=<?php echo $qtd_geral_concorrente_drogasilf;?>;                  
var cfsp=<?php echo $qtd_geral_concorrente_drogariaspf;?>;                  

var cfultra5=<?php echo $qtd_geral_concorrente_ultrafarmaf5;?>;                  
var cfraia5=<?php echo $qtd_geral_concorrente_drogaraiaf5;?>;                  
var cfsil5=<?php echo $qtd_geral_concorrente_drogasilf5;?>;                  
var cfsp5=<?php echo $qtd_geral_concorrente_drogariaspf5;?>;                  

var cfultra10=<?php echo $qtd_geral_concorrente_ultrafarmaf10;?>;                  
var cfraia10=<?php echo $qtd_geral_concorrente_drogaraiaf10;?>;                  
var cfsil10=<?php echo $qtd_geral_concorrente_drogasilf10;?>;                  
var cfsp10=<?php echo $qtd_geral_concorrente_drogariaspf10;?>;                  

var cfultra20=<?php echo $qtd_geral_concorrente_ultrafarmaf20;?>;                  
var cfraia20=<?php echo $qtd_geral_concorrente_drogaraiaf20;?>;                  
var cfsil20=<?php echo $qtd_geral_concorrente_drogasilf20;?>;                  
var cfsp20=<?php echo $qtd_geral_concorrente_drogariaspf20;?>;                  

var cfultra30=<?php echo $qtd_geral_concorrente_ultrafarmaf30;?>;                  
var cfraia30=<?php echo $qtd_geral_concorrente_drogaraiaf30;?>;                  
var cfsil30=<?php echo $qtd_geral_concorrente_drogasilf30;?>;                  
var cfsp30=<?php echo $qtd_geral_concorrente_drogariaspf30;?>;                  

var cfultra30a=<?php echo $qtd_geral_concorrente_ultrafarmaf30a;?>;                  
var cfraia30a=<?php echo $qtd_geral_concorrente_drogaraiaf30a;?>;                  
var cfsil30a=<?php echo $qtd_geral_concorrente_drogasilf30a;?>;                  
var cfsp30a=<?php echo $qtd_geral_concorrente_drogariaspf30a;?>;                  

var cfbnw=<?php echo $qtd_geral_concorrente_belezanawebf;?>;    
var cfbnw5=<?php echo $qtd_geral_concorrente_belezanawebf5;?>;                  
var cfbnw10=<?php echo $qtd_geral_concorrente_belezanawebf10;?>;                  
var cfbnw20=<?php echo $qtd_geral_concorrente_belezanawebf20;?>;                  
var cfbnw30=<?php echo $qtd_geral_concorrente_belezanawebf30;?>;                  
var cfbnw30a=<?php echo $qtd_geral_concorrente_belezanawebf30a;?>;                  

/* bar chart */
var ctxfc = document.getElementById("financiandoChartc").getContext("2d");

var data1 = {
  labels: ["(Total)", "(-5% / -1%)", "(-10% / -5%)", "(-20% / -10%)", "(-30% / -20%)", "(≤-30%)"],
  datasets: [{
    label: "DROGARAIA",
    backgroundColor: "blue",
    data: [cfraia, cfraia5, cfraia10, cfraia20, cfraia30, cfraia30a]
  }, {
    label: "DROGASIL",
    backgroundColor: "red",
    data: [cfsil, cfsil5, cfsil10, cfsil20, cfsil30, cfsil30a]
}, {
    label: "ULTRAFARMA",
    backgroundColor: "green",
    data: [cfultra, cfultra5, cfultra10, cfultra20, cfultra30, cfultra30a]
}, {
    label: "DROGARIASAOPAULO",
    backgroundColor: "gray",
    data: [cfsp, cfsp5, cfsp10, cfsp20, cfsp30, cfsp30a]
}, {
    label: "BELEZANAWEB",
    backgroundColor: "yellow",
    data: [cfbnw, cfbnw5, cfbnw10, cfbnw20, cfbnw30, cfbnw30a]

 }]

};
var myBarChart = new Chart(ctxfc, {
  type: 'bar',
  data: data1,
  options: {
    barValueSpacing: 6,
    scales: {
      yAxes: [{
        ticks: {
          min: 0,

        }
      }]
    }
  }
});



</script>
</html>
