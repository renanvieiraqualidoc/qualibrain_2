

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

//Promo
$select_promo = "SELECT count(1) From promo";
$resultado_promo = mysqli_query($conn,$select_promo);
$total_promo = mysqli_fetch_array($resultado_promo)[0];


//Promo-home
$select_promo1 = "SELECT count(1) From promo where home=1";
$resultado_promo1 = mysqli_query($conn,$select_promo1);
$total_promo_home = mysqli_fetch_array($resultado_promo1)[0];


header('Content-Type: text/html; charset=utf-8');
//***********Sortimentos Monitorados**************//


//***********GERAL PRODUTOS**************//

if (isset($_GET['vpbm'])) {
$pbma = $_GET['vpbm'];

}else{

$pbma = '5';
}



////cashback

//Cashback qtd
$select_cashback_geral = "SELECT count(1) FROM Products where active=1 and current_cashback > 0 and qty_stock_rms>0 and pbm <> $pbma";
$resultado_cashback_geral = mysqli_query($conn,$select_cashback_geral);
$margem_cashback_geral = mysqli_fetch_array($resultado_cashback_geral)[0];



$select_descontinuado_geral = "SELECT count(1) FROM Products where active=1 and descontinuado = 1 and pbm <> $pbma";
$resultado_descontinuado_geral = mysqli_query($conn,$select_descontinuado_geral);
$total_descontinuado_geral = mysqli_fetch_array($resultado_descontinuado_geral)[0];


$select_otc_geral = "SELECT count(1) FROM Products where active=1 and otc = 1 and pbm <> $pbma";
$resultado_otc_geral = mysqli_query($conn,$select_otc_geral);
$total_otc_geral = mysqli_fetch_array($resultado_otc_geral)[0];





$select_termol_geral = "SELECT count(1) FROM termolabo where ativo=1";
$resultado_termol_geral = mysqli_query($conn,$select_termol_geral);
$total_termol_geral = mysqli_fetch_array($resultado_termol_geral)[0];



$consultatotalcashback = "SELECT qty_stock_rms, current_cashback from Products where active=1 and current_cashback > 0 and qty_stock_rms>0 and pbm <> $pbma";
$res_cashback = mysqli_query($conn,$consultatotalcashback);
        while($rowcashback = mysqli_fetch_array($res_cashback)){

$valoritemcashback = $valoritemcashback + ($rowcashback[0] * $rowcashback[1]);

}



//tabelados


//$select_tabelados_geral = " SELECT count(1) from Products where active=1 and tabulated_price > 0 and qty_stock_rms>0 and pbm <> $pbma";
//$resultado_tabelados_geral = mysqli_query($conn,$select_tabelados_geral);
//$margem_tabelados_geral = mysqli_fetch_array($resultado_tabelados_geral)[0];

//controlados

$select_controlados_geral = " SELECT count(1) from Products where active=1 and controlled_substance = 1 and pbm <> $pbma and descontinuado <> 1";
$resultado_controlados_geral = mysqli_query($conn,$select_controlados_geral);
$margem_controlados_geral = mysqli_fetch_array($resultado_controlados_geral)[0];







//Margem Bruta Simulada Geral Consulta
$select_margembruta_geral = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_margembruta_geral = mysqli_query($conn,$select_margembruta_geral);
$margem_bruta_geral = mysqli_fetch_array($resultado_margembruta_geral)[0];


//Margem Bruta Simulada Geral Consulta Curva A
$select_margembruta_geral_a = "SELECT AVG(current_gross_margin_percent)  FROM Products where active=1 and curve='A' and qty_stock_rms>'0' and pbm <> $pbma  and descontinuado <> 1";
$resultado_margembruta_geral_a = mysqli_query($conn,$select_margembruta_geral_a);
$margem_bruta_geral_a = mysqli_fetch_array($resultado_margembruta_geral_a)[0];
 
//Margem Bruta Simulada Geral Consulta Curva B
$select_margembruta_geral_b = "SELECT AVG(current_gross_margin_percent)  FROM Products where active=1 and curve='B' and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_margembruta_geral_b = mysqli_query($conn,$select_margembruta_geral_b);
$margem_bruta_geral_b = mysqli_fetch_array($resultado_margembruta_geral_b)[0];

//Margem Bruta Simulada Geral Consulta Curva C
$select_margembruta_geral_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='C' and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_margembruta_geral_c = mysqli_query($conn,$select_margembruta_geral_c);
$margem_bruta_geral_c = mysqli_fetch_array($resultado_margembruta_geral_c)[0];





//Margem Para o Menor Preco Geral Consulta
$select_margemmenor_geral = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1 and qty_competitors_available > 0";
$resultado_margemmenor_geral = mysqli_query($conn,$select_margemmenor_geral);
$margemmenor_geral = mysqli_fetch_array($resultado_margemmenor_geral)[0];

//Margem Para o Menor Preco Geral Consulta Curva A
$select_margemmenor_geral_a = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='A' and qty_stock_rms>'0' and pbm <> $pbma  and descontinuado <> 1 and qty_competitors_available > 0";
$resultado_margemmenor_geral_a = mysqli_query($conn,$select_margemmenor_geral_a);
$margemmenor_geral_a = mysqli_fetch_array($resultado_margemmenor_geral_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_geral_b = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='B' and qty_stock_rms>'0' and pbm <> $pbma  and descontinuado <> 1  and qty_competitors_available > 0";
$resultado_margemmenor_geral_b = mysqli_query($conn,$select_margemmenor_geral_b);
$margemmenor_geral_b = mysqli_fetch_array($resultado_margemmenor_geral_b)[0];


//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_geral_c = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='C' and qty_stock_rms>'0' and pbm <> $pbma  and descontinuado <> 1  and qty_competitors_available > 0";
$resultado_margemmenor_geral_c = mysqli_query($conn,$select_margemmenor_geral_c);
$margemmenor_geral_c = mysqli_fetch_array($resultado_margemmenor_geral_c)[0];

//Qtd Produtos Geral
$select_qtd_geral = "SELECT count(Products.sku) FROM Products where active=1 and pbm <> $pbma ";
$resultado_qtd_geral = mysqli_query($conn,$select_qtd_geral);
$qtd_geral = mysqli_fetch_array($resultado_qtd_geral)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a = "SELECT count(1) FROM Products where active=1 and curve='A' and qty_stock_rms > 0 and pbm <> $pbma";
$resultado_qtd_geral_a = mysqli_query($conn,$select_qtd_geral_a);
$qtd_geral_a = mysqli_fetch_array($resultado_qtd_geral_a)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b = "SELECT count(1) FROM Products where active=1 and curve='B'  and qty_stock_rms > 0 and pbm <> $pbma";
$resultado_qtd_geral_b = mysqli_query($conn,$select_qtd_geral_b);
$qtd_geral_b = mysqli_fetch_array($resultado_qtd_geral_b)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c = "SELECT count(1) FROM Products where active=1 and curve='C'  and qty_stock_rms > 0 and pbm <> $pbma";
$resultado_qtd_geral_c = mysqli_query($conn,$select_qtd_geral_c);
$qtd_geral_c = mysqli_fetch_array($resultado_qtd_geral_c)[0];






$consultatotalestoquef = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_estoquef = mysqli_query($conn,$consultatotalestoquef);
$qtd_geral_estoquef = mysqli_fetch_array($resultado_qtd_geral_estoquef)[0];

$consultatotalestoquef5 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent  BETWEEN -0.05 and -0.001) and pbm <> $pbma";
$resultado_qtd_geral_estoquef5 = mysqli_query($conn,$consultatotalestoquef5);
$qtd_geral_estoquef5 = mysqli_fetch_array($resultado_qtd_geral_estoquef5)[0];




$consultatotalestoquef10 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma";
$resultado_qtd_geral_estoquef10 = mysqli_query($conn,$consultatotalestoquef10);
$qtd_geral_estoquef10 = mysqli_fetch_array($resultado_qtd_geral_estoquef10)[0];


$consultatotalestoquef20 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma";
$resultado_qtd_geral_estoquef20 = mysqli_query($conn,$consultatotalestoquef20);
$qtd_geral_estoquef20 = mysqli_fetch_array($resultado_qtd_geral_estoquef20)[0];

$consultatotalestoquef30 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN  -0.30 and -0.19999) and pbm <> $pbma";
$resultado_qtd_geral_estoquef30 = mysqli_query($conn,$consultatotalestoquef30);
$qtd_geral_estoquef30 = mysqli_fetch_array($resultado_qtd_geral_estoquef30)[0];

$consultatotalestoquef30a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and current_gross_margin_percent < -0.30 and pbm <> $pbma";
$resultado_qtd_geral_estoquef30a = mysqli_query($conn,$consultatotalestoquef30a);
$qtd_geral_estoquef30a = mysqli_fetch_array($resultado_qtd_geral_estoquef30a)[0];


//registered_at/////

$consulregister = "SELECT MAX(updated_at) from Products where active='1' and qty_stock_rms>0 limit 1";
$res_dataregister = mysqli_query($conn,$consulregister);
        while($rowreg = mysqli_fetch_array($res_dataregister)){
$register_at=$rowreg[0];


}


//quantidade financiando
//Qtd Produtos Financiando acima de 30
//(current_gross_margin_percent BETWEEN -0.05 and -0.001)
//(current_gross_margin_percent BETWEEN -0.10 and -0.04999)
//(current_gross_margin_percent BETWEEN -0.20 and -0.0999)
//(current_gross_margin_percent BETWEEN -0.30 and -0.19999)
// current_gross_margin_percent < -0.30 

$valortotalitemestoque= ($qtd_geral_estoquef30a + $qtd_geral_estoquef30 + $qtd_geral_estoquef20 + $qtd_geral_estoquef10 + $qtd_geral_estoquef5);

$consultatotalpayonlyf5 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN  -0.05 and -0.001) and pbm <> $pbma";
$res_datatotalpayonlyf5 = mysqli_query($conn,$consultatotalpayonlyf5);
        while($row22f5 = mysqli_fetch_array($res_datatotalpayonlyf5)){

$valoritempof5 = $valoritempof5 + ($row22f5[0] * $row22f5[1]);
$valoritempof51 = $valoritempof51 + ($row22f5[2] * $row22f5[1]);
}

$valoritempof5t = ($valoritempof5 - $valoritempof51);


$consultatotalpayonlyf10 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma";
$res_datatotalpayonlyf10 = mysqli_query($conn,$consultatotalpayonlyf10);
        while($row22f10 = mysqli_fetch_array($res_datatotalpayonlyf10)){

$valoritempof102 = $valoritempof102 + ($row22f10[0] * $row22f10[1]);
$valoritempof101 = $valoritempof101 + ($row22f10[2] * $row22f10[1]);
}

$valoritempof10t = ($valoritempof102 - $valoritempof101);

$consultatotalpayonlyf20 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma";
$res_datatotalpayonlyf20 = mysqli_query($conn,$consultatotalpayonlyf20);
        while($row22f20 = mysqli_fetch_array($res_datatotalpayonlyf20)){

$valoritempof20 = $valoritempof20 + ($row22f20[0] * $row22f20[1]);
$valoritempof201 = $valoritempof201 + ($row22f20[2] * $row22f20[1]);
}

$valoritempof20t = ($valoritempof20 - $valoritempof201);


$consultatotalpayonlyf30 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN  -0.30 and -0.19999) and pbm <> $pbma";
$res_datatotalpayonlyf30 = mysqli_query($conn,$consultatotalpayonlyf30);
        while($row22f30 = mysqli_fetch_array($res_datatotalpayonlyf30)){

$valoritempof30 = $valoritempof30 + ($row22f30[0] * $row22f30[1]);
$valoritempof301 = $valoritempof301 + ($row22f30[2] * $row22f30[1]);
}

$valoritempof30t = ($valoritempof30 - $valoritempof301);



$consultatotalpayonlyf30a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent < -0.30) and pbm <> $pbma";
$res_datatotalpayonlyf30a = mysqli_query($conn,$consultatotalpayonlyf30a);
        while($row22f30a = mysqli_fetch_array($res_datatotalpayonlyf30a)){

$valoritempof30a = $valoritempof30a + ($row22f30a[0] * $row22f30a[1]);
$valoritempof301a = $valoritempof301a + ($row22f30a[2] * $row22f30a[1]);
}

$valoritempof30ta = ($valoritempof30a - $valoritempof301a);





$select_qtd_geral_financiando = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando = mysqli_query($conn,$select_qtd_geral_financiando);
$qtd_geral_financiando = mysqli_fetch_array($resultado_qtd_geral_financiando)[0];


//Qtd Produtos Financiando Geral Curva A
$select_qtd_geral_financiando_a = "SELECT count(1) FROM Products where active=1 and curve='A' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_a = mysqli_query($conn,$select_qtd_geral_financiando_a);
$qtd_geral_financiando_a = mysqli_fetch_array($resultado_qtd_geral_financiando_a)[0];

//Qtd Produtos Financiando Geral Curva B
$select_qtd_geral_financiando_b = "SELECT count(1) FROM Products where active=1 and curve='B' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_b = mysqli_query($conn,$select_qtd_geral_financiando_b);
$qtd_geral_financiando_b = mysqli_fetch_array($resultado_qtd_geral_financiando_b)[0];


//Qtd Produtos Financiando Geral Curva C
$select_qtd_geral_financiando_c = "SELECT count(1) FROM Products where active=1 and curve='C' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_c = mysqli_query($conn,$select_qtd_geral_financiando_c);
$qtd_geral_financiando_c = mysqli_fetch_array($resultado_qtd_geral_financiando_c)[0];



//Financiando margens

$select_qtd_geral_financiando_igual = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent = 0 and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_igual = mysqli_query($conn,$select_qtd_geral_financiando_igual);
$qtd_geral_financiando_igual = mysqli_fetch_array($resultado_qtd_geral_financiando_igual)[0];



//Qtd Produtos Financiando entre 0 e 5
$select_qtd_geral_financiando_cinco = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.05 and -0.0001)  and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_cinco = mysqli_query($conn,$select_qtd_geral_financiando_cinco);
$qtd_geral_financiando_cinco = mysqli_fetch_array($resultado_qtd_geral_financiando_cinco)[0];





//Qtd Produtos Financiando entre 5 e 10
$select_qtd_geral_financiando_dez = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.10 and -0.04999)  and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_dez = mysqli_query($conn,$select_qtd_geral_financiando_dez);
$qtd_geral_financiando_dez = mysqli_fetch_array($resultado_qtd_geral_financiando_dez)[0];




//Qtd Produtos Financiando entre 10 e 20
$select_qtd_geral_financiando_vinte = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.20 and -0.09999)  and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_vinte = mysqli_query($conn,$select_qtd_geral_financiando_vinte);
$qtd_geral_financiando_vinte = mysqli_fetch_array($resultado_qtd_geral_financiando_vinte)[0];



//Qtd Produtos Financiando entre 20 e 30
$select_qtd_geral_financiando_trinta = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.30 and -0.19999)  and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_trinta = mysqli_query($conn,$select_qtd_geral_financiando_trinta);
$qtd_geral_financiando_trinta = mysqli_fetch_array($resultado_qtd_geral_financiando_trinta)[0];

//Qtd Produtos Financiando acima de 30
$select_qtd_geral_financiando_atrinta = "SELECT count(1) FROM Products where active=1  and current_gross_margin_percent < -0.30  and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_financiando_atrinta = mysqli_query($conn,$select_qtd_geral_financiando_atrinta);
$qtd_geral_financiando_atrinta = mysqli_fetch_array($resultado_qtd_geral_financiando_atrinta)[0];

 $valortotalitemcusto = ($valoritempof51 + $valoritempof101 + $valoritempof201 + $valoritempof301 + $valoritempof301a);
$valortotalitempa = ($valoritempof5 + $valoritempof102 + $valoritempof20 + $valoritempof30 + $valoritempof30a);
$valortotalitemdefict = (($valoritempof5t) + ($valoritempof10t) + ($valoritempof20t) + ($valoritempof30t) + ($valoritempof30ta));

//quantidade sacrificando operacao

$select_qtd_geral_soperacao = "SELECT count(1) FROM Products where active=1 and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_soperacao = mysqli_query($conn,$select_qtd_geral_soperacao);
$qtd_geral_soperacao = mysqli_fetch_array($resultado_qtd_geral_soperacao)[0];


//Qtd Produtos  Geral Curva A
$select_qtd_geral_soperacao_a = "SELECT count(1) FROM Products where active=1 and curve='A' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma  and descontinuado <> 1";
$resultado_qtd_geral_soperacao_a = mysqli_query($conn,$select_qtd_geral_soperacao_a);
$qtd_geral_soperacao_a = mysqli_fetch_array($resultado_qtd_geral_soperacao_a)[0];

//Qtd Produtos  Geral Curva B
$select_qtd_geral_soperacao_b = "SELECT count(1) FROM Products where active=1 and curve='B' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma  and descontinuado <> 1";
$resultado_qtd_geral_soperacao_b = mysqli_query($conn,$select_qtd_geral_soperacao_b);
$qtd_geral_soperacao_b = mysqli_fetch_array($resultado_qtd_geral_soperacao_b)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_soperacao_c = "SELECT count(1) FROM Products where active=1 and curve='C' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma  and descontinuado <> 1";
$resultado_qtd_geral_soperacao_c = mysqli_query($conn,$select_qtd_geral_soperacao_c);
$qtd_geral_soperacao_c = mysqli_fetch_array($resultado_qtd_geral_soperacao_c)[0];



//quantidade sacrificando lucro

$select_qtd_geral_slucro = "SELECT count(1) FROM Products where active=1 and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma  and descontinuado <> 1";
$resultado_qtd_geral_slucro = mysqli_query($conn,$select_qtd_geral_slucro);
$qtd_geral_slucro = mysqli_fetch_array($resultado_qtd_geral_slucro)[0];


//Qtd Produtos  Geral Curva A
$select_qtd_geral_slucro_a = "SELECT count(1) FROM Products where active=1 and curve='A' and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_slucro_a = mysqli_query($conn,$select_qtd_geral_slucro_a);
$qtd_geral_slucro_a = mysqli_fetch_array($resultado_qtd_geral_slucro_a)[0];

//Qtd Produtos  Geral Curva B
$select_qtd_geral_slucro_b = "SELECT count(1) FROM Products where active=1 and curve='B' and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_slucro_b = mysqli_query($conn,$select_qtd_geral_slucro_b);
$qtd_geral_slucro_b = mysqli_fetch_array($resultado_qtd_geral_slucro_b)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_slucro_c = "SELECT count(1) FROM Products where active=1 and curve='C' and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_slucro_c = mysqli_query($conn,$select_qtd_geral_slucro_c);
$qtd_geral_slucro_c = mysqli_fetch_array($resultado_qtd_geral_slucro_c)[0];








//concorrente com menor preco

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraia = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraia = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraia);
$qtd_geral_concorrente_drogaraia = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraia)[0];

//Qtd Produtos Drogaraia Menor Curva A
$select_qtd_geral_concorrente_drogaraia_a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraia_a = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraia_a);
$qtd_geral_concorrente_drogaraia_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraia_a)[0];

//Qtd Produtos Drogaraia Menor Curva B
$select_qtd_geral_concorrente_drogaraia_b = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraia_b = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraia_b);
$qtd_geral_concorrente_drogaraia_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraia_b)[0];

//Qtd Produtos Drogaraia Menor Curva C
$select_qtd_geral_concorrente_drogaraia_c = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraia_c = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraia_c);
$qtd_geral_concorrente_drogaraia_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraia_c)[0];



//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasil = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasil = mysqli_query($conn,$select_qtd_geral_concorrente_drogasil);
$qtd_geral_concorrente_drogasil = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasil)[0];

//Qtd Produtos Drogasil Menor A
$select_qtd_geral_concorrente_drogasil_a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasil_a = mysqli_query($conn,$select_qtd_geral_concorrente_drogasil_a);
$qtd_geral_concorrente_drogasil_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasil_a)[0];


//Qtd Produtos Drogasil Menor B
$select_qtd_geral_concorrente_drogasil_b = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasil_b = mysqli_query($conn,$select_qtd_geral_concorrente_drogasil_b);
$qtd_geral_concorrente_drogasil_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasil_b)[0];


//Qtd Produtos Drogasil Menor C
$select_qtd_geral_concorrente_drogasil_c = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasil_c = mysqli_query($conn,$select_qtd_geral_concorrente_drogasil_c);
$qtd_geral_concorrente_drogasil_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasil_c)[0];




//Qtd Produtos Onofre Menor
$select_qtd_geral_concorrente_onofre = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.belezanaweb.com.br' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_onofre = mysqli_query($conn,$select_qtd_geral_concorrente_onofre);
$qtd_geral_concorrente_onofre = mysqli_fetch_array($resultado_qtd_geral_concorrente_onofre)[0];

//Qtd Produtos Onofre Menor A
$select_qtd_geral_concorrente_onofre_a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.belezanaweb.com.br' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_onofre_a = mysqli_query($conn,$select_qtd_geral_concorrente_onofre_a);
$qtd_geral_concorrente_onofre_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_onofre_a)[0];


//Qtd Produtos Onofre Menor B
$select_qtd_geral_concorrente_onofre_b = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.belezanaweb.com.br' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_onofre_b = mysqli_query($conn,$select_qtd_geral_concorrente_onofre_b);
$qtd_geral_concorrente_onofre_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_onofre_b)[0];


//Qtd Produtos Onofre Menor C
$select_qtd_geral_concorrente_onofre_c = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.belezanaweb.com.br' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_onofre_c = mysqli_query($conn,$select_qtd_geral_concorrente_onofre_c);
$qtd_geral_concorrente_onofre_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_onofre_c)[0];





//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariasp = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariasp = mysqli_query($conn,$select_qtd_geral_concorrente_drogariasp);
$qtd_geral_concorrente_drogariasp = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariasp)[0];

//Qtd Produtos Drogaria SP Menor A
$select_qtd_geral_concorrente_drogariasp_a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariasp_a = mysqli_query($conn,$select_qtd_geral_concorrente_drogariasp_a);
$qtd_geral_concorrente_drogariasp_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariasp_a)[0];

//Qtd Produtos Drogaria SP Menor B
$select_qtd_geral_concorrente_drogariasp_b = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariasp_b = mysqli_query($conn,$select_qtd_geral_concorrente_drogariasp_b);
$qtd_geral_concorrente_drogariasp_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariasp_b)[0];


//Qtd Produtos Drogaria SP Menor C
$select_qtd_geral_concorrente_drogariasp_c = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariasp_c = mysqli_query($conn,$select_qtd_geral_concorrente_drogariasp_c);
$qtd_geral_concorrente_drogariasp_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariasp_c)[0];



//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarma = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarma = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarma);
$qtd_geral_concorrente_ultrafarma = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarma)[0];


//Qtd Produtos Ultrafarma Menor A
$select_qtd_geral_concorrente_ultrafarma_a = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarma_a = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarma_a);
$qtd_geral_concorrente_ultrafarma_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarma_a)[0];

//Qtd Produtos Ultrafarma Menor B
$select_qtd_geral_concorrente_ultrafarma_b = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarma_b = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarma_b);
$qtd_geral_concorrente_ultrafarma_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarma_b)[0];

//Qtd Produtos Ultrafarma Menor C
$select_qtd_geral_concorrente_ultrafarma_c = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarma_c = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarma_c);
$qtd_geral_concorrente_ultrafarma_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarma_c)[0];



//Qtd Produtos paguemenos Menor
$select_qtd_geral_concorrente_paguemenos = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.paguemenos.com.br' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenos = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenos);
$qtd_geral_concorrente_paguemenos = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenos)[0];


//Qtd Produtos paguemenos Menor A
$select_qtd_geral_concorrente_paguemenos_a = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.paguemenos.com.br' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenos_a = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenos_a);
$qtd_geral_concorrente_paguemenos_a = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenos_a)[0];

//Qtd Produtos paguemenos Menor B
$select_qtd_geral_concorrente_paguemenos_b = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.paguemenos.com.br' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenos_b = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenos_b);
$qtd_geral_concorrente_paguemenos_b = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenos_b)[0];

//Qtd Produtos paguemenos Menor C
$select_qtd_geral_concorrente_paguemenos_c = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.paguemenos.com.br' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenos_c = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenos_c);
$qtd_geral_concorrente_paguemenos_c = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenos_c)[0];




//concorrente com menor preco financiando




//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf);
 $qtd_geral_concorrente_drogaraiaf = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf)[0];

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.0001) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf5 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf5);
 $qtd_geral_concorrente_drogaraiaf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf5)[0];


//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf10);
 $qtd_geral_concorrente_drogaraiaf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf10)[0];


//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf20);
 $qtd_geral_concorrente_drogaraiaf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf20)[0];

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf30 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf30);
 $qtd_geral_concorrente_drogaraiaf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf30)[0];

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf30a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and current_gross_margin_percent < -0.30  and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf30a = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf30a);
 $qtd_geral_concorrente_drogaraiaf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf30a)[0];





//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasilf = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf);
$qtd_geral_concorrente_drogasilf = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf)[0];


//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasilf5 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf5);
$qtd_geral_concorrente_drogasilf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf5)[0];


//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasilf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf10);
$qtd_geral_concorrente_drogasilf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf10)[0];

//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasilf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf20);
$qtd_geral_concorrente_drogasilf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf20)[0];

//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasilf30 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf30);
$qtd_geral_concorrente_drogasilf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf30)[0];

//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf30a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and current_gross_margin_percent < -0.30  and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasilf30a = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf30a);
$qtd_geral_concorrente_drogasilf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf30a)[0];





//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariaspf = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf);
$qtd_geral_concorrente_drogariaspf = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariaspf5 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf5);
$qtd_geral_concorrente_drogariaspf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf5)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariaspf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf10);
$qtd_geral_concorrente_drogariaspf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf10)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and  (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariaspf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf20);
$qtd_geral_concorrente_drogariaspf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf20)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariaspf30 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf30);
$qtd_geral_concorrente_drogariaspf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf30)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf30a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and current_gross_margin_percent < -0.30 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariaspf30a = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf30a);
$qtd_geral_concorrente_drogariaspf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf30a)[0];






//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarmaf = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf);
$qtd_geral_concorrente_ultrafarmaf = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf)[0];

//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf5 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarmaf5 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf5);
$qtd_geral_concorrente_ultrafarmaf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf5)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf10 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and  (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarmaf10 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf10);
$qtd_geral_concorrente_ultrafarmaf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf10)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf20 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and (current_gross_margin_percent  BETWEEN -0.20 and -0.0999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarmaf20 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf20);
$qtd_geral_concorrente_ultrafarmaf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf20)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf30 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarmaf30 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf30);
$qtd_geral_concorrente_ultrafarmaf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf30)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf30a = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br'  and current_gross_margin_percent < -0.30 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarmaf30a = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf30a);
$qtd_geral_concorrente_ultrafarmaf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf30a)[0];






//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf);
$qtd_geral_concorrente_belezanawebf = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf)[0];

//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf5 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf5 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf5);
$qtd_geral_concorrente_belezanawebf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf5)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf10 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and  (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf10 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf10);
$qtd_geral_concorrente_belezanawebf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf10)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf20 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf20 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf20);
$qtd_geral_concorrente_belezanawebf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf20)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf30 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf30 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf30);
$qtd_geral_concorrente_belezanawebf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf30)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf30a = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br'  and current_gross_margin_percent < -0.30 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf30a = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf30a);
$qtd_geral_concorrente_belezanawebf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf30a)[0];



//Qtd Produtos paguemenosMenor
$select_qtd_geral_concorrente_paguemenosf = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.paguemenos.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenosf = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenosf);
 $qtd_geral_concorrente_paguemenosf = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenosf)[0];

//Qtd Produtos paguemenosMenor
$select_qtd_geral_concorrente_paguemenosf5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.paguemenos.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.0001) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenosf5 = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenosf5);
 $qtd_geral_concorrente_paguemenosf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenosf5)[0];


//Qtd Produtos paguemenosMenor
$select_qtd_geral_concorrente_paguemenosf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.paguemenos.com.br' and (current_gross_margin_percent BETWEEN -0.10 and -0.04999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenosf10 = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenosf10);
 $qtd_geral_concorrente_paguemenosf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenosf10)[0];


//Qtd Produtos paguemenosMenor
$select_qtd_geral_concorrente_paguemenosf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.paguemenos.com.br' and (current_gross_margin_percent BETWEEN -0.20 and -0.0999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenosf20 = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenosf20);
 $qtd_geral_concorrente_paguemenosf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenosf20)[0];

//Qtd Produtos paguemenosMenor
$select_qtd_geral_concorrente_paguemenosf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.paguemenos.com.br' and (current_gross_margin_percent BETWEEN -0.30 and -0.19999) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenosf30 = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenosf30);
 $qtd_geral_concorrente_paguemenosf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenosf30)[0];

//Qtd Produtos paguemenosMenor
$select_qtd_geral_concorrente_paguemenosf30a = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.paguemenos.com.br' and current_gross_margin_percent < -0.30  and pbm <> $pbma";
$resultado_qtd_geral_concorrente_paguemenosf30a = mysqli_query($conn,$select_qtd_geral_concorrente_paguemenosf30a);
 $qtd_geral_concorrente_paguemenosf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_paguemenosf30a)[0];



//////RUPTURA///////////////


//Qtd Produtos Geral
$select_qtd_geral_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_ruptura = mysqli_query($conn,$select_qtd_geral_ruptura);
$qtd_geral_ruptura = mysqli_fetch_array($resultado_qtd_geral_ruptura)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='A' and pbm <> $pbma and descontinuado <> 1";
$resultado_qtd_geral_a_ruptura = mysqli_query($conn,$select_qtd_geral_a_ruptura);
$qtd_geral_a_ruptura = mysqli_fetch_array($resultado_qtd_geral_a_ruptura)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='B' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_b_ruptura = mysqli_query($conn,$select_qtd_geral_b_ruptura);
$qtd_geral_b_ruptura = mysqli_fetch_array($resultado_qtd_geral_b_ruptura)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='C' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_c_ruptura = mysqli_query($conn,$select_qtd_geral_c_ruptura);
$qtd_geral_c_ruptura = mysqli_fetch_array($resultado_qtd_geral_c_ruptura)[0];





//////EXCLUSIVO///////////////

//Qtd Produtos Geral
$select_qtd_geral_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and qty_stock_rms>'0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_exclusivo = mysqli_query($conn,$select_qtd_geral_exclusivo);
$qtd_geral_exclusivo = mysqli_fetch_array($resultado_qtd_geral_exclusivo)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='A' and qty_stock_rms>'0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_a_exclusivo = mysqli_query($conn,$select_qtd_geral_a_exclusivo);
$qtd_geral_a_exclusivo = mysqli_fetch_array($resultado_qtd_geral_a_exclusivo)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='B' and qty_stock_rms>'0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_b_exclusivo = mysqli_query($conn,$select_qtd_geral_b_exclusivo);
$qtd_geral_b_exclusivo = mysqli_fetch_array($resultado_qtd_geral_b_exclusivo)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='C' and qty_stock_rms>'0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_c_exclusivo = mysqli_query($conn,$select_qtd_geral_c_exclusivo);
$qtd_geral_c_exclusivo = mysqli_fetch_array($resultado_qtd_geral_c_exclusivo)[0];

//***********MEDICAMENTOS**************//



///////Geral Medicamento////////////

////CUSTO
$select_medicamento_custo_geral = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and descontinuado<>1";
$resultado_medicamento_custo_geral = mysqli_query($conn,$select_medicamento_custo_geral);
        while($rowmcg = mysqli_fetch_array($resultado_medicamento_custo_geral)){

$medicamento_custo_geral = $medicamento_custo_geral + ($rowmcg[0] * $rowmcg[1]);



}


$select_medicamento_custo_geral_a = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='A'  and descontinuado<>1";
$resultado_medicamento_custo_geral_a = mysqli_query($conn,$select_medicamento_custo_geral_a);
        while($rowmcg_a = mysqli_fetch_array($resultado_medicamento_custo_geral_a)){

$medicamento_custo_geral_a = $medicamento_custo_geral_a + ($rowmcg_a[0] * $rowmcg_a[1]);



}




$select_medicamento_custo_geral_b = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='B'  and descontinuado<>1";
$resultado_medicamento_custo_geral_b = mysqli_query($conn,$select_medicamento_custo_geral_b);
        while($rowmcg_b = mysqli_fetch_array($resultado_medicamento_custo_geral_b)){

$medicamento_custo_geral_b = $medicamento_custo_geral_b + ($rowmcg_b[0] * $rowmcg_b[1]);



}


$select_medicamento_custo_geral_c = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='C'  and descontinuado<>1";
$resultado_medicamento_custo_geral_c = mysqli_query($conn,$select_medicamento_custo_geral_c);
        while($rowmcg_c = mysqli_fetch_array($resultado_medicamento_custo_geral_c)){

$medicamento_custo_geral_c = $medicamento_custo_geral_c + ($rowmcg_c[0] * $rowmcg_c[1]);



}



//Pague Apenas Medicamento


$select_pagueapenas_medicamento = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and descontinuado<>1";
$resultado_pagueapenas_medicamento = mysqli_query($conn,$select_pagueapenas_medicamento);
        while($row22mpa = mysqli_fetch_array($resultado_pagueapenas_medicamento)){

$preco_pagueapenas_medicamento = $preco_pagueapenas_medicamento + ($row22mpa[0] * $row22mpa[1]);

}




//Pague Apenas Medicamento Curva A

$select_pagueapenas_medicamento_a = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma  and curve='A' and descontinuado<>1";
$resultado_pagueapenas_medicamento_a = mysqli_query($conn,$select_pagueapenas_medicamento_a);
        while($row22mpa_a = mysqli_fetch_array($resultado_pagueapenas_medicamento_a)){

$preco_pagueapenas_medicamento_a = $preco_pagueapenas_medicamento_a + ($row22mpa_a[0] * $row22mpa_a[1]);

}









//Pague Apenas Medicamento Curva B

$select_pagueapenas_medicamento_b = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma  and curve='B' and descontinuado<>1";
$resultado_pagueapenas_medicamento_b = mysqli_query($conn,$select_pagueapenas_medicamento_b);
        while($row22mpa_b = mysqli_fetch_array($resultado_pagueapenas_medicamento_b)){

$preco_pagueapenas_medicamento_b = $preco_pagueapenas_medicamento_b + ($row22mpa_b[0] * $row22mpa_b[1]);

}



//Pague Apenas Medicamento Curva C

$select_pagueapenas_medicamento_c = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma  and curve='C' and descontinuado<>1";
$resultado_pagueapenas_medicamento_c = mysqli_query($conn,$select_pagueapenas_medicamento_c);
        while($row22mpa_c = mysqli_fetch_array($resultado_pagueapenas_medicamento_c)){

$preco_pagueapenas_medicamento_c = $preco_pagueapenas_medicamento_c + ($row22mpa_c[0] * $row22mpa_c[1]);

}




//Lucro Bruto


$preco_venda_medicamento = ($preco_pagueapenas_medicamento - $medicamento_custo_geral);


$preco_venda_medicamento_a = ($preco_pagueapenas_medicamento_a - $medicamento_custo_geral_a);


$preco_venda_medicamento_b = ($preco_pagueapenas_medicamento_b - $medicamento_custo_geral_b);


$preco_venda_medicamento_c = ($preco_pagueapenas_medicamento_c - $medicamento_custo_geral_c);


$select_qtd_geral_financiandom = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'Medicamento' and descontinuado<>1";
$resultado_qtd_geral_financiandom = mysqli_query($conn,$select_qtd_geral_financiandom);
$qtd_geral_financiandom = mysqli_fetch_array($resultado_qtd_geral_financiandom)[0];

$select_qtd_geral_financiandom_a = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'Medicamento' and curve='A' and descontinuado<>1";
$resultado_qtd_geral_financiandom_a = mysqli_query($conn,$select_qtd_geral_financiandom_a);
$qtd_geral_financiandom_a = mysqli_fetch_array($resultado_qtd_geral_financiandom_a)[0];

$select_qtd_geral_financiandom_b = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'Medicamento' and curve='B' and descontinuado<>1";
$resultado_qtd_geral_financiandom_b = mysqli_query($conn,$select_qtd_geral_financiandom_b);
$qtd_geral_financiandom_b = mysqli_fetch_array($resultado_qtd_geral_financiandom_b)[0];

$select_qtd_geral_financiandom_c = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'Medicamento' and curve='C' and descontinuado<>1";
$resultado_qtd_geral_financiandom_c = mysqli_query($conn,$select_qtd_geral_financiandom_c);
$qtd_geral_financiandom_c = mysqli_fetch_array($resultado_qtd_geral_financiandom_c)[0];


////financiando
$select_financiando_medicamentos = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'Medicamento' and descontinuado<>1";
$res_datatotalfinanciandom = mysqli_query($conn,$select_financiando_medicamentos);
        while($row22fm = mysqli_fetch_array($res_datatotalfinanciandom)){

$valoritempofm = $valoritempofm + ($row22fm[0] * $row22fm[1]);
$valoritempofm1 = $valoritempofm1 + ($row22fm[2] * $row22fm[1]);
}





$valoritempofm10 = ($valoritempofm - $valoritempofm1);





$select_financiando_medicamentos_a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'Medicamento' and curve='A' and descontinuado<>1";
$res_datatotalfinanciandom_a = mysqli_query($conn,$select_financiando_medicamentos_a);
        while($row22fm_a = mysqli_fetch_array($res_datatotalfinanciandom_a)){

$valoritempofm_a = $valoritempofm_a + ($row22fm_a[0] * $row22fm_a[1]);
$valoritempofm1_a = $valoritempofm1_a + ($row22fm_a[2] * $row22fm_a[1]);
}





$valoritempofm10_a = ($valoritempofm_a - $valoritempofm1_a);



$select_financiando_medicamentos_b = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'Medicamento' and curve='B' and descontinuado<>1";
$res_datatotalfinanciandom_b = mysqli_query($conn,$select_financiando_medicamentos_b);
        while($row22fm_b = mysqli_fetch_array($res_datatotalfinanciandom_b)){

$valoritempofm_b = $valoritempofm_b + ($row22fm_b[0] * $row22fm_b[1]);
$valoritempofm1_b = $valoritempofm1_b + ($row22fm_b[2] * $row22fm_b[1]);
}





$valoritempofm10_b = ($valoritempofm_b - $valoritempofm1_b);



$select_financiando_medicamentos_c = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'Medicamento' and curve='C' and descontinuado<>1";
$res_datatotalfinanciandom_c = mysqli_query($conn,$select_financiando_medicamentos_c);
        while($row22fm_c = mysqli_fetch_array($res_datatotalfinanciandom_c)){

$valoritempofm_c = $valoritempofm_c + ($row22fm_c[0] * $row22fm_c[1]);
$valoritempofm1_c = $valoritempofm1_c + ($row22fm_c[2] * $row22fm_c[1]);
}





$valoritempofm10_c = ($valoritempofm_c - $valoritempofm1_c);








//estoque
$consultatotalestoquem = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'Medicamento' and descontinuado<>1";
$resultado_qtd_geral_estoquem = mysqli_query($conn,$consultatotalestoquem);
$qtd_geral_estoquem = mysqli_fetch_array($resultado_qtd_geral_estoquem)[0];

$consultatotalestoquem_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'Medicamento' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquem_a = mysqli_query($conn,$consultatotalestoquem_a);
$qtd_geral_estoquem_a = mysqli_fetch_array($resultado_qtd_geral_estoquem_a)[0];

$consultatotalestoquem_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'Medicamento' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquem_b = mysqli_query($conn,$consultatotalestoquem_b);
$qtd_geral_estoquem_b = mysqli_fetch_array($resultado_qtd_geral_estoquem_b)[0];

$consultatotalestoquem_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'Medicamento' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquem_c = mysqli_query($conn,$consultatotalestoquem_c);
$qtd_geral_estoquem_c = mysqli_fetch_array($resultado_qtd_geral_estoquem_c)[0];




//estoque generico
$consultatotalestoqueg = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'generico' and descontinuado<>1";
$resultado_qtd_geral_estoqueg = mysqli_query($conn,$consultatotalestoqueg);
$qtd_geral_estoqueg = mysqli_fetch_array($resultado_qtd_geral_estoqueg)[0];

$consultatotalestoqueg_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'generico' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoqueg_a = mysqli_query($conn,$consultatotalestoqueg_a);
$qtd_geral_estoqueg_a = mysqli_fetch_array($resultado_qtd_geral_estoqueg_a)[0];

$consultatotalestoqueg_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'generico' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoqueg_b = mysqli_query($conn,$consultatotalestoqueg_b);
$qtd_geral_estoqueg_b = mysqli_fetch_array($resultado_qtd_geral_estoqueg_b)[0];

$consultatotalestoqueg_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'generico' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoqueg_c = mysqli_query($conn,$consultatotalestoqueg_c);
$qtd_geral_estoqueg_c = mysqli_fetch_array($resultado_qtd_geral_estoqueg_c)[0];


//estoque marca
$consultatotalestoquemarc = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'marca' and descontinuado<>1";
$resultado_qtd_geral_estoquemarc = mysqli_query($conn,$consultatotalestoquemarc);
$qtd_geral_estoquemarc = mysqli_fetch_array($resultado_qtd_geral_estoquemarc)[0];

$consultatotalestoquemarc_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'marca' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquemarc_a = mysqli_query($conn,$consultatotalestoquemarc_a);
$qtd_geral_estoquemarc_a = mysqli_fetch_array($resultado_qtd_geral_estoquemarc_a)[0];

$consultatotalestoquemarc_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'marca' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquemarc_b = mysqli_query($conn,$consultatotalestoquemarc_b);
$qtd_geral_estoquemarc_b = mysqli_fetch_array($resultado_qtd_geral_estoquemarc_b)[0];

$consultatotalestoquemarc_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'marca' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquemarc_c = mysqli_query($conn,$consultatotalestoquemarc_c);
$qtd_geral_estoquemarc_c = mysqli_fetch_array($resultado_qtd_geral_estoquemarc_c)[0];



//estoque similar
$consultatotalestoquesimi = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'similar' and descontinuado<>1";
$resultado_qtd_geral_estoquesimi = mysqli_query($conn,$consultatotalestoquesimi);
$qtd_geral_estoquesimi = mysqli_fetch_array($resultado_qtd_geral_estoquesimi)[0];

$consultatotalestoquesimi_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'similar' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquesimi_a = mysqli_query($conn,$consultatotalestoquesimi_a);
$qtd_geral_estoquesimi_a = mysqli_fetch_array($resultado_qtd_geral_estoquesimi_a)[0];

$consultatotalestoquesimi_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'similar' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquesimi_b = mysqli_query($conn,$consultatotalestoquesimi_b);
$qtd_geral_estoquesimi_b = mysqli_fetch_array($resultado_qtd_geral_estoquesimi_b)[0];

$consultatotalestoquesimi_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'similar' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquesimi_c = mysqli_query($conn,$consultatotalestoquesimi_c);
$qtd_geral_estoquesimi_c = mysqli_fetch_array($resultado_qtd_geral_estoquesimi_c)[0];


//estoque autocuidado
$consultatotalestoqueautocu = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'autocuidado' and descontinuado<>1";
$resultado_qtd_geral_estoqueautocu = mysqli_query($conn,$consultatotalestoqueautocu);
$qtd_geral_estoqueautocu = mysqli_fetch_array($resultado_qtd_geral_estoqueautocu)[0];

$consultatotalestoqueautocu_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'autocuidado' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoqueautocu_a = mysqli_query($conn,$consultatotalestoqueautocu_a);
$qtd_geral_estoqueautocu_a = mysqli_fetch_array($resultado_qtd_geral_estoqueautocu_a)[0];

$consultatotalestoqueautocu_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'autocuidado' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoqueautocu_b = mysqli_query($conn,$consultatotalestoqueautocu_b);
$qtd_geral_estoqueautocu_b = mysqli_fetch_array($resultado_qtd_geral_estoqueautocu_b)[0];

$consultatotalestoqueautocu_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'autocuidado' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoqueautocu_c = mysqli_query($conn,$consultatotalestoqueautocu_c);
$qtd_geral_estoqueautocu_c = mysqli_fetch_array($resultado_qtd_geral_estoqueautocu_c)[0];




//qtd produtos abaixo do custo





//Margem Bruta Simulada Medicamentos Consulta 
$select_margembruta_medicamentos = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_medicamentos = mysqli_query($conn,$select_margembruta_medicamentos);
$margem_bruta_medicamento = mysqli_fetch_array($resultado_margembruta_medicamentos)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva A
$select_margembruta_medicamentos_a = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='A' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_medicamentos_a = mysqli_query($conn,$select_margembruta_medicamentos_a);
$margem_bruta_medicamento_a = mysqli_fetch_array($resultado_margembruta_medicamentos_a)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva B
$select_margembruta_medicamentos_b = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='B' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_medicamentos_b = mysqli_query($conn,$select_margembruta_medicamentos_b);
$margem_bruta_medicamento_b = mysqli_fetch_array($resultado_margembruta_medicamentos_b)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva C 
$select_margembruta_medicamentos_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='C' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_medicamentos_c = mysqli_query($conn,$select_margembruta_medicamentos_c);
$margem_bruta_medicamento_c = mysqli_fetch_array($resultado_margembruta_medicamentos_c)[0];







//Margem Para o Menor Preco Geral Consulta
$select_margemmenor_medicamentos = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_medicamentos = mysqli_query($conn,$select_margemmenor_medicamentos);
$margemmenor_medicamento = mysqli_fetch_array($resultado_margemmenor_medicamentos)[0];




//Margem Para o Menor Preco Geral Consulta Curva A
$select_margemmenor_medicamentos_a = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='A' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_medicamentos_a = mysqli_query($conn,$select_margemmenor_medicamentos_a);
$margemmenor_medicamento_a = mysqli_fetch_array($resultado_margemmenor_medicamentos_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_medicamentos_b = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='B' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_medicamentos_b = mysqli_query($conn,$select_margemmenor_medicamentos_b);
$margemmenor_medicamento_b = mysqli_fetch_array($resultado_margemmenor_medicamentos_b)[0];

//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_medicamentos_c = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='C' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_medicamentos_c = mysqli_query($conn,$select_margemmenor_medicamentos_c);
$margemmenor_medicamento_c = mysqli_fetch_array($resultado_margemmenor_medicamentos_c)[0];




//Qtd Produtos Medicamentos
$select_qtd_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento'  and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_medicamentos = mysqli_query($conn,$select_qtd_medicamentos);
$qtd_medicamento = mysqli_fetch_array($resultado_qtd_medicamentos)[0];


//Qtd Produtos Medicamentos Curva A
$select_qtd_medicamentos_a = "SELECT count(1) FROM Products where active=1 and curve='A' and department = 'Medicamento' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_medicamentos_a = mysqli_query($conn,$select_qtd_medicamentos_a);
$qtd_medicamento_a = mysqli_fetch_array($resultado_qtd_medicamentos_a)[0];



//Qtd Produtos Medicamentos Curva B
$select_qtd_medicamentos_b = "SELECT count(1)FROM Products where active=1 and curve='B' and department = 'Medicamento' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_medicamentos_b = mysqli_query($conn,$select_qtd_medicamentos_b);
$qtd_medicamento_b = mysqli_fetch_array($resultado_qtd_medicamentos_b)[0];

//Qtd Produtos Medicamentos Curva C
$select_qtd_medicamentos_c = "SELECT count(1) FROM Products where active=1 and curve='C' and department = 'Medicamento'  and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_medicamentos_c = mysqli_query($conn,$select_qtd_medicamentos_c);
$qtd_medicamento_c = mysqli_fetch_array($resultado_qtd_medicamentos_c)[0];




///////////RUPTURA MEDICAMENTOS////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento'  and qty_stock_rms ='0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_ruptura_medicamentos = mysqli_query($conn,$select_qtd_geral_ruptura_medicamentos);
$qtd_geral_ruptura_medicamentos = mysqli_fetch_array($resultado_qtd_geral_ruptura_medicamentos)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_medicamentos = "SELECT count(1) FROM Products where active=1  and department = 'Medicamento' and curve='A'  and qty_stock_rms ='0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_a_ruptura_medicamentos = mysqli_query($conn,$select_qtd_geral_a_ruptura_medicamentos);
$qtd_geral_a_ruptura_medicamentos = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_medicamentos)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and curve='B' and qty_stock_rms ='0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_b_ruptura_medicamentos = mysqli_query($conn,$select_qtd_geral_b_ruptura_medicamentos);
$qtd_geral_b_ruptura_medicamentos = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_medicamentos)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and curve='C' and qty_stock_rms ='0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_c_ruptura_medicamentos = mysqli_query($conn,$select_qtd_geral_c_ruptura_medicamentos);
$qtd_geral_c_ruptura_medicamentos = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_medicamentos)[0];





//Qtd Produtos Geral
$select_qtd_geral_ee_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and qty_competitors='0' and pbm <> $pbma  and qty_stock_rms >'0' ";
$resultado_qtd_geral_ee_medicamentos = mysqli_query($conn,$select_qtd_geral_ee_medicamentos_medicamentos);
$qtd_geral_ee_medicamentos = mysqli_fetch_array($resultado_qtd_geral_ee_medicamentos_medicamentos)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ee_medicamentos = "SELECT count(1) FROM Products where active=1  and department = 'Medicamento' and qty_competitors='0' and curve='A' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_geral_a_ee_medicamentos = mysqli_query($conn,$select_qtd_geral_a_ee_medicamentos);
$qtd_geral_a_ee = mysqli_fetch_array($resultado_qtd_geral_a_ee_medicamentos)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ee_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and qty_competitors='0' and curve='B' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_geral_b_ee_medicamentos = mysqli_query($conn,$select_qtd_geral_b_ee_medicamentos);
$qtd_geral_b_ee_medicamentos = mysqli_fetch_array($resultado_qtd_geral_b_ee_medicamentos)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ee_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and qty_competitors='0' and curve='C' and pbm <> $pbma and qty_stock_rms >'0' ";
$resultado_qtd_geral_c_ee_medicamentos = mysqli_query($conn,$select_qtd_geral_c_ee_medicamentos);
$qtd_geral_c_ee_medicamentos = mysqli_fetch_array($resultado_qtd_geral_c_ee_medicamentos)[0];


///////Geral perfumaria////////////

////CUSTO
$select_perfumaria_custo_geral = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'perfumaria' and qty_stock_rms > 0 and pbm <> $pbma and descontinuado<>1";
$resultado_perfumaria_custo_geral = mysqli_query($conn,$select_perfumaria_custo_geral);
        while($rowfcg = mysqli_fetch_array($resultado_perfumaria_custo_geral)){

$perfumaria_custo_geral = $perfumaria_custo_geral + ($rowfcg[0] * $rowfcg[1]);



}


$select_perfumaria_custo_geral_a = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'perfumaria' and qty_stock_rms>0 and pbm <> $pbma and curve ='A' and qty_stock_rms > 0  and descontinuado<>1";
$resultado_perfumaria_custo_geral_a = mysqli_query($conn,$select_perfumaria_custo_geral_a);
        while($rowfcg_a = mysqli_fetch_array($resultado_perfumaria_custo_geral_a)){

$perfumaria_custo_geral_a = $perfumaria_custo_geral_a + ($rowfcg_a[0] * $rowfcg_a[1]);



}




$select_perfumaria_custo_geral_b = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'perfumaria' and qty_stock_rms>0 and pbm <> $pbma and curve ='B'  and qty_stock_rms > 0  and descontinuado<>1";
$resultado_perfumaria_custo_geral_b = mysqli_query($conn,$select_perfumaria_custo_geral_b);
        while($rowfcg_b = mysqli_fetch_array($resultado_perfumaria_custo_geral_b)){

$perfumaria_custo_geral_b = $perfumaria_custo_geral_b + ($rowfcg_b[0] * $rowfcg_b[1]);



}


$select_perfumaria_custo_geral_c = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'perfumaria' and qty_stock_rms>0 and pbm <> $pbma and curve ='C' and qty_stock_rms > 0  and descontinuado<>1";
$resultado_perfumaria_custo_geral_c = mysqli_query($conn,$select_perfumaria_custo_geral_c);
        while($rowfcg_c = mysqli_fetch_array($resultado_perfumaria_custo_geral_c)){

$perfumaria_custo_geral_c = $perfumaria_custo_geral_c + ($rowfcg_c[0] * $rowfcg_c[1]);



}



//Pague Apenas perfumaria


$select_pagueapenas_perfumaria = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'perfumaria' and qty_stock_rms>0 and pbm <> $pbma and qty_stock_rms > 0  and descontinuado<>1";
$resultado_pagueapenas_perfumaria = mysqli_query($conn,$select_pagueapenas_perfumaria);
        while($row22fpa = mysqli_fetch_array($resultado_pagueapenas_perfumaria)){

$preco_pagueapenas_perfumaria = $preco_pagueapenas_perfumaria + ($row22fpa[0] * $row22fpa[1]);

}




//Pague Apenas perfumaria Curva A

$select_pagueapenas_perfumaria_a = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'perfumaria' and qty_stock_rms>0 and pbm <> $pbma  and curve='A' and qty_stock_rms > 0  and descontinuado<>1";
$resultado_pagueapenas_perfumaria_a = mysqli_query($conn,$select_pagueapenas_perfumaria_a);
        while($row22fpa_a = mysqli_fetch_array($resultado_pagueapenas_perfumaria_a)){

$preco_pagueapenas_perfumaria_a = $preco_pagueapenas_perfumaria_a + ($row22fpa_a[0] * $row22fpa_a[1]);

}









//Pague Apenas perfumaria Curva B

$select_pagueapenas_perfumaria_b = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'perfumaria' and qty_stock_rms>0 and pbm <> $pbma  and curve='B' and qty_stock_rms > 0  and descontinuado<>1";
$resultado_pagueapenas_perfumaria_b = mysqli_query($conn,$select_pagueapenas_perfumaria_b);
        while($row22fpa_b = mysqli_fetch_array($resultado_pagueapenas_perfumaria_b)){

$preco_pagueapenas_perfumaria_b = $preco_pagueapenas_perfumaria_b + ($row22fpa_b[0] * $row22fpa_b[1]);

}



//Pague Apenas perfumaria Curva C

$select_pagueapenas_perfumaria_c = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'perfumaria' and qty_stock_rms>0 and pbm <> $pbma  and curve='C' and qty_stock_rms > 0  and descontinuado<>1";
$resultado_pagueapenas_perfumaria_c = mysqli_query($conn,$select_pagueapenas_perfumaria_c);
        while($row22fpa_c = mysqli_fetch_array($resultado_pagueapenas_perfumaria_c)){

$preco_pagueapenas_perfumaria_c = $preco_pagueapenas_perfumaria_c + ($row22fpa_c[0] * $row22fpa_c[1]);

}




//Lucro Bruto


$preco_venda_perfumaria = ($preco_pagueapenas_perfumaria - $perfumaria_custo_geral);


$preco_venda_perfumaria_a = ($preco_pagueapenas_perfumaria_a - $perfumaria_custo_geral_a);


$preco_venda_perfumaria_b = ($preco_pagueapenas_perfumaria_b - $perfumaria_custo_geral_b);


$preco_venda_perfumaria_c = ($preco_pagueapenas_perfumaria_c - $perfumaria_custo_geral_c);


$select_qtd_geral_financiandof = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'perfumaria' and descontinuado<>1";
$resultado_qtd_geral_financiandof = mysqli_query($conn,$select_qtd_geral_financiandof);
$qtd_geral_financiandof = mysqli_fetch_array($resultado_qtd_geral_financiandof)[0];

$select_qtd_geral_financiandof_a = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'perfumaria' and curve='A' and descontinuado<>1";
$resultado_qtd_geral_financiandof_a = mysqli_query($conn,$select_qtd_geral_financiandof_a);
$qtd_geral_financiandof_a = mysqli_fetch_array($resultado_qtd_geral_financiandof_a)[0];

$select_qtd_geral_financiandof_b = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'perfumaria' and curve='B' and descontinuado<>1";
$resultado_qtd_geral_financiandof_b = mysqli_query($conn,$select_qtd_geral_financiandof_b);
$qtd_geral_financiandof_b = mysqli_fetch_array($resultado_qtd_geral_financiandof_b)[0];

$select_qtd_geral_financiandof_c = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'perfumaria' and curve='C' and descontinuado<>1";
$resultado_qtd_geral_financiandof_c = mysqli_query($conn,$select_qtd_geral_financiandof_c);
$qtd_geral_financiandof_c = mysqli_fetch_array($resultado_qtd_geral_financiandof_c)[0];


////financiando
$select_financiando_perfumarias = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'perfumaria' and descontinuado<>1";
$res_datatotalfinanciandof = mysqli_query($conn,$select_financiando_perfumarias);
        while($row22ff = mysqli_fetch_array($res_datatotalfinanciandof)){

$valoritempoff = $valoritempoff + ($row22ff[0] * $row22ff[1]);
$valoritempoff1 = $valoritempoff1 + ($row22ff[2] * $row22ff[1]);
}





$valoritempoff10 = ($valoritempoff - $valoritempoff1);





$select_financiando_perfumarias_a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'perfumaria' and curve='A' and descontinuado<>1";
$res_datatotalfinanciandof_a = mysqli_query($conn,$select_financiando_perfumarias_a);
        while($row22ff_a = mysqli_fetch_array($res_datatotalfinanciandof_a)){

$valoritempoff_a = $valoritempoff_a + ($row22ff_a[0] * $row22ff_a[1]);
$valoritempoff1_a = $valoritempoff1_a + ($row22ff_a[2] * $row22ff_a[1]);
}





$valoritempoff10_a = ($valoritempoff_a - $valoritempoff1_a);



$select_financiando_perfumarias_b = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'perfumaria' and curve='B' and descontinuado<>1";
$res_datatotalfinanciandof_b = mysqli_query($conn,$select_financiando_perfumarias_b);
        while($row22fm_b = mysqli_fetch_array($res_datatotalfinanciandof_b)){

$valoritempoff_b = $valoritempoff_b + ($row22ff_b[0] * $row22ff_b[1]);
$valoritempoff1_b = $valoritempoff1_b + ($row22ff_b[2] * $row22ff_b[1]);
}





$valoritempoff10_b = ($valoritempoff_b - $valoritempoff1_b);



$select_financiando_perfumarias_c = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'perfumaria' and curve='C' and descontinuado<>1";
$res_datatotalfinanciandof_c = mysqli_query($conn,$select_financiando_perfumarias_c);
        while($row22ff_c = mysqli_fetch_array($res_datatotalfinanciandof_c)){

$valoritempoff_c = $valoritempoff_c + ($row22ff_c[0] * $row22ff_c[1]);
$valoritempoff1_c = $valoritempoff1_c + ($row22ff_c[2] * $row22ff_c[1]);
}





$valoritempoff10_c = ($valoritempoff_c - $valoritempoff1_c);








//estoque
$consultatotalestoquef = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'perfumaria' and descontinuado<>1";
$resultado_qtd_geral_estoquef = mysqli_query($conn,$consultatotalestoquef);
$qtd_geral_estoquef = mysqli_fetch_array($resultado_qtd_geral_estoquef)[0];

$consultatotalestoquef_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'perfumaria' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquef_a = mysqli_query($conn,$consultatotalestoquef_a);
$qtd_geral_estoquef_a = mysqli_fetch_array($resultado_qtd_geral_estoquef_a)[0];

$consultatotalestoquef_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'perfumaria' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquef_b = mysqli_query($conn,$consultatotalestoquef_b);
$qtd_geral_estoquef_b = mysqli_fetch_array($resultado_qtd_geral_estoquef_b)[0];

$consultatotalestoquef_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'perfumaria' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquef_c = mysqli_query($conn,$consultatotalestoquef_c);
$qtd_geral_estoquef_c = mysqli_fetch_array($resultado_qtd_geral_estoquef_c)[0];


//estoque dermocosmetico
$consultatotalestoquedermo = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'dermocosmetico' and descontinuado<>1";
$resultado_qtd_geral_estoquedermo = mysqli_query($conn,$consultatotalestoquedermo);
$qtd_geral_estoquedermo = mysqli_fetch_array($resultado_qtd_geral_estoquedermo)[0];

$consultatotalestoquedermo_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'dermocosmetico' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquedermo_a = mysqli_query($conn,$consultatotalestoquedermo_a);
$qtd_geral_estoquedermo_a = mysqli_fetch_array($resultado_qtd_geral_estoquedermo_a)[0];

$consultatotalestoquedermo_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'dermocosmetico' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquedermo_b = mysqli_query($conn,$consultatotalestoquedermo_b);
$qtd_geral_estoquedermo_b = mysqli_fetch_array($resultado_qtd_geral_estoquedermo_b)[0];

$consultatotalestoquedermo_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'dermocosmetico' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquedermo_c = mysqli_query($conn,$consultatotalestoquedermo_c);
$qtd_geral_estoquedermo_c = mysqli_fetch_array($resultado_qtd_geral_estoquedermo_c)[0];


//estoque beleza
$consultatotalestoquebeleza = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'beleza' and descontinuado<>1";
$resultado_qtd_geral_estoquebeleza = mysqli_query($conn,$consultatotalestoquebeleza);
$qtd_geral_estoquebeleza = mysqli_fetch_array($resultado_qtd_geral_estoquebeleza)[0];

$consultatotalestoquebeleza_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'beleza' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquebeleza_a = mysqli_query($conn,$consultatotalestoquebeleza_a);
$qtd_geral_estoquebeleza_a = mysqli_fetch_array($resultado_qtd_geral_estoquebeleza_a)[0];

$consultatotalestoquebeleza_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'beleza' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquebeleza_b = mysqli_query($conn,$consultatotalestoquebeleza_b);
$qtd_geral_estoquebeleza_b = mysqli_fetch_array($resultado_qtd_geral_estoquebeleza_b)[0];

$consultatotalestoquebeleza_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'beleza' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquebeleza_c = mysqli_query($conn,$consultatotalestoquebeleza_c);
$qtd_geral_estoquebeleza_c = mysqli_fetch_array($resultado_qtd_geral_estoquebeleza_c)[0];



//estoque higiene
$consultatotalestoquehigiene = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'higiene' and descontinuado<>1";
$resultado_qtd_geral_estoquehigiene = mysqli_query($conn,$consultatotalestoquehigiene);
$qtd_geral_estoquehigiene = mysqli_fetch_array($resultado_qtd_geral_estoquehigiene)[0];

$consultatotalestoquehigiene_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'higiene' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquehigiene_a = mysqli_query($conn,$consultatotalestoquehigiene_a);
$qtd_geral_estoquehigiene_a = mysqli_fetch_array($resultado_qtd_geral_estoquehigiene_a)[0];

$consultatotalestoquehigiene_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'higiene' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquehigiene_b = mysqli_query($conn,$consultatotalestoquehigiene_b);
$qtd_geral_estoquehigiene_b = mysqli_fetch_array($resultado_qtd_geral_estoquehigiene_b)[0];

$consultatotalestoquehigiene_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'higiene' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquehigiene_c = mysqli_query($conn,$consultatotalestoquehigiene_c);
$qtd_geral_estoquehigiene_c = mysqli_fetch_array($resultado_qtd_geral_estoquehigiene_c)[0];


//estoque higiene e beleza
$consultatotalestoquehigieneebeleza = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'HIGIENE E BELEZA' and descontinuado<>1";
$resultado_qtd_geral_estoquehigieneebeleza = mysqli_query($conn,$consultatotalestoquehigieneebeleza);
$qtd_geral_estoquehigieneebeleza = mysqli_fetch_array($resultado_qtd_geral_estoquehigieneebeleza)[0];

$consultatotalestoquehigieneebeleza_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'HIGIENE E BELEZA' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquehigieneebeleza_a = mysqli_query($conn,$consultatotalestoquehigieneebeleza_a);
$qtd_geral_estoquehigieneebeleza_a = mysqli_fetch_array($resultado_qtd_geral_estoquehigieneebeleza_a)[0];

$consultatotalestoquehigieneebeleza_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'HIGIENE E BELEZA' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquehigieneebeleza_b = mysqli_query($conn,$consultatotalestoquehigieneebeleza_b);
$qtd_geral_estoquehigieneebeleza_b = mysqli_fetch_array($resultado_qtd_geral_estoquehigieneebeleza_b)[0];

$consultatotalestoquehigieneebeleza_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'HIGIENE E BELEZA' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquehigieneebeleza_c = mysqli_query($conn,$consultatotalestoquehigieneebeleza_c);
$qtd_geral_estoquehigieneebeleza_c = mysqli_fetch_array($resultado_qtd_geral_estoquehigieneebeleza_c)[0];


//estoque mamae bebe
$consultatotalestoquemamae = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'MAMAE E BEBE' and descontinuado<>1";
$resultado_qtd_geral_estoquemamae = mysqli_query($conn,$consultatotalestoquemamae);
$qtd_geral_estoquemamae = mysqli_fetch_array($resultado_qtd_geral_estoquemamae)[0];

$consultatotalestoquemamae_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'MAMAE E BEBE' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquemamae_a = mysqli_query($conn,$consultatotalestoquemamae_a);
$qtd_geral_estoquemamae_a = mysqli_fetch_array($resultado_qtd_geral_estoquemamae_a)[0];

$consultatotalestoquemamae_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'MAMAE E BEBE' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquemamae_b = mysqli_query($conn,$consultatotalestoquemamae_b);
$qtd_geral_estoquemamae_b = mysqli_fetch_array($resultado_qtd_geral_estoquemamae_b)[0];

$consultatotalestoquemamae_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'MAMAE E BEBE' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquemamae_c = mysqli_query($conn,$consultatotalestoquemamae_c);
$qtd_geral_estoquemamae_c = mysqli_fetch_array($resultado_qtd_geral_estoquemamae_c)[0];












//Margem Bruta Simulada Perfumaria Consulta 
$select_margembruta_perfumaria = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_perfumaria = mysqli_query($conn,$select_margembruta_perfumaria);
$margem_bruta_perfumaria = mysqli_fetch_array($resultado_margembruta_perfumaria)[0];




//Margem Bruta Simulada Perfumaria Consulta 
$select_margembruta_perfumaria_a = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_perfumaria_a = mysqli_query($conn,$select_margembruta_perfumaria_a);
$margem_bruta_perfumaria_a = mysqli_fetch_array($resultado_margembruta_perfumaria_a)[0];


//Margem Bruta Simulada Perfumaria Consulta 
$select_margembruta_perfumaria_b = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_perfumaria_b = mysqli_query($conn,$select_margembruta_perfumaria_b);
$margem_bruta_perfumaria_b = mysqli_fetch_array($resultado_margembruta_perfumaria_b)[0];


//Margem Bruta Simulada Perfumaria Consulta 
$select_margembruta_perfumaria_c = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'C' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_perfumaria_c = mysqli_query($conn,$select_margembruta_perfumaria_c);
$margem_bruta_perfumaria_c = mysqli_fetch_array($resultado_margembruta_perfumaria_c)[0];









//Margem Para o Menor Preco Perfumaria Consulta
$select_margemmenor_perfumaria = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_perfumaria = mysqli_query($conn,$select_margemmenor_perfumaria);
$margemmenor_perfumaria = mysqli_fetch_array($resultado_margemmenor_perfumaria)[0];



//Margem Para o Menor Preco Perfumaria Consulta
$select_margemmenor_perfumaria_a = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_perfumaria_a = mysqli_query($conn,$select_margemmenor_perfumaria_a);
$margemmenor_perfumaria_a = mysqli_fetch_array($resultado_margemmenor_perfumaria_a)[0];



//Margem Para o Menor Preco Perfumaria Consulta
$select_margemmenor_perfumaria_b = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_perfumaria_b = mysqli_query($conn,$select_margemmenor_perfumaria_b);
$margemmenor_perfumaria_b = mysqli_fetch_array($resultado_margemmenor_perfumaria_b)[0];


//Margem Para o Menor Preco Perfumaria Consulta
$select_margemmenor_perfumaria_c = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'C' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_perfumaria_c = mysqli_query($conn,$select_margemmenor_perfumaria_c);
$margemmenor_perfumaria_c = mysqli_fetch_array($resultado_margemmenor_perfumaria_c)[0];




//Qtd Produtos Perfumaria
$select_qtd_perfumaria = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and pbm <> $pbma and qty_stock_rms > 0  and descontinuado<>1";
$resultado_qtd_perfumaria = mysqli_query($conn,$select_qtd_perfumaria);
$qtd_perfumaria = mysqli_fetch_array($resultado_qtd_perfumaria)[0];


//Qtd Produtos Perfumaria
$select_qtd_perfumaria_a = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma and qty_stock_rms > 0  and descontinuado<>1";
$resultado_qtd_perfumaria_a = mysqli_query($conn,$select_qtd_perfumaria_a);
$qtd_perfumaria_a = mysqli_fetch_array($resultado_qtd_perfumaria_a)[0];

//Qtd Produtos Perfumaria
$select_qtd_perfumaria_b = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma and qty_stock_rms > 0  and descontinuado<>1";
$resultado_qtd_perfumaria_b = mysqli_query($conn,$select_qtd_perfumaria_b);
$qtd_perfumaria_b = mysqli_fetch_array($resultado_qtd_perfumaria_b)[0];

//Qtd Produtos Perfumaria
$select_qtd_perfumaria_c = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria'  and curve = 'C' and pbm <> $pbma and qty_stock_rms > 0  and descontinuado<>1";
$resultado_qtd_perfumaria_c = mysqli_query($conn,$select_qtd_perfumaria_c);
$qtd_perfumaria_c = mysqli_fetch_array($resultado_qtd_perfumaria_c)[0];

///////////RUPTURA PERFUMARIA////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_perfumaria = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and qty_stock_rms='0' and pbm <> $pbma  and descontinuado<>1";
$resultado_qtd_geral_ruptura_perfumaria = mysqli_query($conn,$select_qtd_geral_ruptura_perfumaria);
$qtd_geral_ruptura_perfumaria = mysqli_fetch_array($resultado_qtd_geral_ruptura_perfumaria)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_perfumaria = "SELECT count(1) FROM Products where active=1  and department = 'Perfumaria' and qty_stock_rms='0' and curve='A' and pbm <> $pbma  and descontinuado<>1";
$resultado_qtd_geral_a_ruptura_perfumaria = mysqli_query($conn,$select_qtd_geral_a_ruptura_perfumaria);
$qtd_geral_a_ruptura_perfumaria = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_perfumaria)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_perfumaria = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and qty_stock_rms='0' and curve='B' and pbm <> $pbma  and descontinuado<>1";
$resultado_qtd_geral_b_ruptura_perfumaria = mysqli_query($conn,$select_qtd_geral_b_ruptura_perfumaria);
$qtd_geral_b_ruptura_perfumaria = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_perfumaria)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_perfumaria = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and qty_stock_rms='0' and curve='C' and pbm <> $pbma   and descontinuado<>1";
$resultado_qtd_geral_c_ruptura_perfumaria = mysqli_query($conn,$select_qtd_geral_c_ruptura_perfumaria);
$qtd_geral_c_ruptura_perfumaria = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_perfumaria)[0];




//***********NAO MEDICAMENTOS**************//




///////////RUPTURA NAO MEDICAMENTOS////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_naomedicamento = "SELECT count(1) FROM Products where active=1 and department = 'Nao Medicamento' and qty_stock_rms='0' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_ruptura_naomedicamento = mysqli_query($conn,$select_qtd_geral_ruptura_naomedicamento);
$qtd_geral_ruptura_naomedicamento = mysqli_fetch_array($resultado_qtd_geral_ruptura_naomedicamento)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_naomedicamento = "SELECT count(1) FROM Products where active=1  and department = 'Nao Medicamento' and qty_stock_rms='0' and curve='A' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_a_ruptura_naomedicamento = mysqli_query($conn,$select_qtd_geral_a_ruptura_naomedicamento);
$qtd_geral_a_ruptura_naomedicamento = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_naomedicamento)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_naomedicamento = "SELECT count(1) FROM Products where active=1 and department = 'Nao Medicamento' and qty_stock_rms='0' and curve='B' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_b_ruptura_naomedicamento = mysqli_query($conn,$select_qtd_geral_b_ruptura_naomedicamento);
$qtd_geral_b_ruptura_naomedicamento = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_naomedicamento)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_naomedicamento = "SELECT count(1) FROM Products where active=1 and department = 'Nao Medicamento' and qty_stock_rms='0' and curve='C' and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_c_ruptura_naomedicamento = mysqli_query($conn,$select_qtd_geral_c_ruptura_naomedicamento);
$qtd_geral_c_ruptura_naomedicamento = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_naomedicamento)[0];



///////Geral n Medicamento////////////

////CUSTO
$select_naomedicamento_custo_geral = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'NAO MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and descontinuado<>1";
$resultado_naomedicamento_custo_geral = mysqli_query($conn,$select_naomedicamento_custo_geral);
        while($rownmcg = mysqli_fetch_array($resultado_naomedicamento_custo_geral)){

$naomedicamento_custo_geral = $naomedicamento_custo_geral + ($rownmcg[0] * $rownmcg[1]);



}


$select_naomedicamento_custo_geral_a = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'NAO MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='A'  and descontinuado<>1";
$resultado_naomedicamento_custo_geral_a = mysqli_query($conn,$select_naomedicamento_custo_geral_a);
        while($rownmcg_a = mysqli_fetch_array($resultado_naomedicamento_custo_geral_a)){

$naomedicamento_custo_geral_a = $naomedicamento_custo_geral_a + ($rownmcg_a[0] * $rownmcg_a[1]);



}




$select_naomedicamento_custo_geral_b = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'NAO MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='B'  and descontinuado<>1";
$resultado_naomedicamento_custo_geral_b = mysqli_query($conn,$select_naomedicamento_custo_geral_b);
        while($rownmcg_b = mysqli_fetch_array($resultado_naomedicamento_custo_geral_b)){

$naomedicamento_custo_geral_b = $naomedicamento_custo_geral_b + ($rownmcg_b[0] * $rownmcg_b[1]);



}


$select_naomedicamento_custo_geral_c = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'NAO MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='C'  and descontinuado<>1";
$resultado_naomedicamento_custo_geral_c = mysqli_query($conn,$select_naomedicamento_custo_geral_c);
        while($rownmcg_c = mysqli_fetch_array($resultado_naomedicamento_custo_geral_c)){

$naomedicamento_custo_geral_c = $naomedicamento_custo_geral_c + ($rownmcg_c[0] * $rownmcg_c[1]);



}



//Pague Apenas Medicamento


$select_pagueapenas_naomedicamento = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'NAO MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and descontinuado<>1";
$resultado_pagueapenas_naomedicamento = mysqli_query($conn,$select_pagueapenas_naomedicamento);
        while($row22nmpa = mysqli_fetch_array($resultado_pagueapenas_naomedicamento)){

$preco_pagueapenas_naomedicamento = $preco_pagueapenas_naomedicamento + ($row22nmpa[0] * $row22nmpa[1]);

}




//Pague Apenas Medicamento Curva A

$select_pagueapenas_naomedicamento_a = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'NAO MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma  and curve='A' and descontinuado<>1";
$resultado_pagueapenas_naomedicamento_a = mysqli_query($conn,$select_pagueapenas_naomedicamento_a);
        while($row22nmpa_a = mysqli_fetch_array($resultado_pagueapenas_naomedicamento_a)){

$preco_pagueapenas_naomedicamento_a = $preco_pagueapenas_naomedicamento_a + ($row22nmpa_a[0] * $row22nmpa_a[1]);

}









//Pague Apenas Medicamento Curva B

$select_pagueapenas_naomedicamento_b = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'NAO MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma  and curve='B' and descontinuado<>1";
$resultado_pagueapenas_naomedicamento_b = mysqli_query($conn,$select_pagueapenas_naomedicamento_b);
        while($row22nmpa_b = mysqli_fetch_array($resultado_pagueapenas_naomedicamento_b)){

$preco_pagueapenas_naomedicamento_b = $preco_pagueapenas_naomedicamento_b + ($row22nmpa_b[0] * $row22nmpa_b[1]);

}



//Pague Apenas Medicamento Curva C

$select_pagueapenas_naomedicamento_c = "SELECT price_pay_only, qty_stock_rms from Products where active='1'  and department = 'NAO MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma  and curve='C' and descontinuado<>1";
$resultado_pagueapenas_naomedicamento_c = mysqli_query($conn,$select_pagueapenas_naomedicamento_c);
        while($row22nmpa_c = mysqli_fetch_array($resultado_pagueapenas_naomedicamento_c)){

$preco_pagueapenas_naomedicamento_c = $preco_pagueapenas_naomedicamento_c + ($row22nmpa_c[0] * $row22nmpa_c[1]);

}




//Lucro Bruto


$preco_venda_naomedicamento = ($preco_pagueapenas_naomedicamento - $naomedicamento_custo_geral);


$preco_venda_naomedicamento_a = ($preco_pagueapenas_naomedicamento_a - $naomedicamento_custo_geral_a);


$preco_venda_naomedicamento_b = ($preco_pagueapenas_naomedicamento_b - $naomedicamento_custo_geral_b);


$preco_venda_naomedicamento_c = ($preco_pagueapenas_naomedicamento_c - $naomedicamento_custo_geral_c);


$select_qtd_geral_financiandonm = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'NAO MEDICAMENTO' and descontinuado<>1";
$resultado_qtd_geral_financiandonm = mysqli_query($conn,$select_qtd_geral_financiandonm);
$qtd_geral_financiandonm = mysqli_fetch_array($resultado_qtd_geral_financiandonm)[0];

$select_qtd_geral_financiandonm_a = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'NAO MEDICAMENTO' and curve='A' and descontinuado<>1";
$resultado_qtd_geral_financiandonm_a = mysqli_query($conn,$select_qtd_geral_financiandonm_a);
$qtd_geral_financiandonm_a = mysqli_fetch_array($resultado_qtd_geral_financiandonm_a)[0];

$select_qtd_geral_financiandonm_b = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'NAO MEDICAMENTO' and curve='B' and descontinuado<>1";
$resultado_qtd_geral_financiandonm_b = mysqli_query($conn,$select_qtd_geral_financiandonm_b);
$qtd_geral_financiandonm_b = mysqli_fetch_array($resultado_qtd_geral_financiandonm_b)[0];

$select_qtd_geral_financiandonm_c = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma  and department = 'NAO MEDICAMENTO' and curve='C' and descontinuado<>1";
$resultado_qtd_geral_financiandonm_c = mysqli_query($conn,$select_qtd_geral_financiandonm_c);
$qtd_geral_financiandonm_c = mysqli_fetch_array($resultado_qtd_geral_financiandonm_c)[0];


////financiando
$select_financiando_naomedicamentos = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'NAO MEDICAMENTO' and descontinuado<>1";
$res_datatotalfinanciandonm = mysqli_query($conn,$select_financiando_naomedicamentos);
        while($row22fnm = mysqli_fetch_array($res_datatotalfinanciandonm)){

$valoritempofnm = $valoritempofnm + ($row22fnm[0] * $row22fnm[1]);
$valoritempofnm1 = $valoritempofnm1 + ($row22fnm[2] * $row22fnm[1]);
}





$valoritempofnm10 = ($valoritempofnm - $valoritempofnm1);





$select_financiando_naomedicamentos_a = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'NAO MEDICAMENTO' and curve='A' and descontinuado<>1";
$res_datatotalfinanciandonm_a = mysqli_query($conn,$select_financiando_naomedicamentos_a);
        while($row22fnm_a = mysqli_fetch_array($res_datatotalfinanciandonm_a)){

$valoritempofnm_a = $valoritempofnm_a + ($row22fnm_a[0] * $row22fnm_a[1]);
$valoritempofnm1_a = $valoritempofnm1_a + ($row22fnm_a[2] * $row22fnm_a[1]);
}





$valoritempofnm10_a = ($valoritempofnm_a - $valoritempofnm1_a);



$select_financiando_naomedicamentos_b = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'NAO MEDICAMENTO' and curve='B' and descontinuado<>1";
$res_datatotalfinanciandonm_b = mysqli_query($conn,$select_financiando_naomedicamentos_b);
        while($row22fnm_b = mysqli_fetch_array($res_datatotalfinanciandonm_b)){

$valoritempofnm_b = $valoritempofnm_b + ($row22fnm_b[0] * $row22fnm_b[1]);
$valoritempofnm1_b = $valoritempofnm1_b + ($row22fnm_b[2] * $row22fnm_b[1]);
}





$valoritempofnm10_b = ($valoritempofnm_b - $valoritempofnm1_b);



$select_financiando_naomedicamentos_c = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma  and department = 'NAO MEDICAMENTO' and curve='C' and descontinuado<>1";
$res_datatotalfinanciandonm_c = mysqli_query($conn,$select_financiando_naomedicamentos_c);
        while($row22fnm_c = mysqli_fetch_array($res_datatotalfinanciandonm_c)){

$valoritempofnm_c = $valoritempofnm_c + ($row22fnm_c[0] * $row22fnm_c[1]);
$valoritempofnm1_c = $valoritempofnm1_c + ($row22fnm_c[2] * $row22fnm_c[1]);
}





$valoritempofnm10_c = ($valoritempofnm_c - $valoritempofnm1_c);








//estoque
$consultatotalestoquenm = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'NAO MEDICAMENTO' and descontinuado<>1";
$resultado_qtd_geral_estoquenm = mysqli_query($conn,$consultatotalestoquenm);
$qtd_geral_estoquenm = mysqli_fetch_array($resultado_qtd_geral_estoquenm)[0];

$consultatotalestoquenm_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'NAO MEDICAMENTO' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquenm_a = mysqli_query($conn,$consultatotalestoquenm_a);
$qtd_geral_estoquenm_a = mysqli_fetch_array($resultado_qtd_geral_estoquenm_a)[0];

$consultatotalestoquenm_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'NAO MEDICAMENTO' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquenm_b = mysqli_query($conn,$consultatotalestoquenm_b);
$qtd_geral_estoquenm_b = mysqli_fetch_array($resultado_qtd_geral_estoquenm_b)[0];

$consultatotalestoquenm_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and department = 'NAO MEDICAMENTO' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquenm_c = mysqli_query($conn,$consultatotalestoquenm_c);
$qtd_geral_estoquenm_c = mysqli_fetch_array($resultado_qtd_geral_estoquenm_c)[0];




//estoque alimento adulto
$consultatotalestoquealim = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'alimento adulto' and descontinuado<>1";
$resultado_qtd_geral_estoquealim = mysqli_query($conn,$consultatotalestoquealim);
$qtd_geral_estoquealim = mysqli_fetch_array($resultado_qtd_geral_estoquealim)[0];

$consultatotalestoquealim_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'alimento adulto' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoquealim_a = mysqli_query($conn,$consultatotalestoquealim_a);
$qtd_geral_estoquealim_a = mysqli_fetch_array($resultado_qtd_geral_estoquealim_a)[0];

$consultatotalestoquealim_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'alimento adulto' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoquealim_b = mysqli_query($conn,$consultatotalestoquealim_b);
$qtd_geral_estoquealim_b = mysqli_fetch_array($resultado_qtd_geral_estoquealim_b)[0];

$consultatotalestoquealim_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'alimento adulto' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoquealim_c = mysqli_query($conn,$consultatotalestoquealim_c);
$qtd_geral_estoquealim_c = mysqli_fetch_array($resultado_qtd_geral_estoquealim_c)[0];


//estoque produtos diet
$consultatotalestoqueprodd = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'produtos diet' and descontinuado<>1";
$resultado_qtd_geral_estoqueprodd = mysqli_query($conn,$consultatotalestoqueprodd);
$qtd_geral_estoqueprodd = mysqli_fetch_array($resultado_qtd_geral_estoqueprodd)[0];

$consultatotalestoqueprodd_a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'produtos diet' and Curve='A' and descontinuado<>1";
$resultado_qtd_geral_estoqueprodd_a = mysqli_query($conn,$consultatotalestoqueprodd_a);
$qtd_geral_estoqueprodd_a = mysqli_fetch_array($resultado_qtd_geral_estoqueprodd_a)[0];

$consultatotalestoqueprodd_b = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'produtos diet' and Curve='B' and descontinuado<>1";
$resultado_qtd_geral_estoqueprodd_b = mysqli_query($conn,$consultatotalestoqueprodd_b);
$qtd_geral_estoqueprodd_b = mysqli_fetch_array($resultado_qtd_geral_estoqueprodd_b)[0];

$consultatotalestoqueprodd_c = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and category = 'produtos diet' and Curve='C' and descontinuado<>1";
$resultado_qtd_geral_estoqueprodd_c = mysqli_query($conn,$consultatotalestoqueprodd_c);
$qtd_geral_estoqueprodd_c = mysqli_fetch_array($resultado_qtd_geral_estoqueprodd_c)[0];









//Margem Bruta Simulada Nao Medicamentos Consulta 
$select_margembruta_naomedicamentos = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_naomedicamentos = mysqli_query($conn,$select_margembruta_naomedicamentos);
$margem_bruta_naomedicamento = mysqli_fetch_array($resultado_margembruta_naomedicamentos)[0];



//Margem Bruta Simulada Nao Medicamentos Consulta Curva A
$select_margembruta_naomedicamentos_a = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_naomedicamentos_a = mysqli_query($conn,$select_margembruta_naomedicamentos_a);
$margem_bruta_naomedicamento_a = mysqli_fetch_array($resultado_margembruta_naomedicamentos_a)[0];

//Margem Bruta Simulada Nao Medicamentos Consulta Curva B
$select_margembruta_naomedicamentos_b = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_naomedicamentos_b = mysqli_query($conn,$select_margembruta_naomedicamentos_b);
$margem_bruta_naomedicamento_b = mysqli_fetch_array($resultado_margembruta_naomedicamentos_b)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva C 
$select_margembruta_naomedicamentos_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma and descontinuado<>1";
$resultado_margembruta_naomedicamentos_c = mysqli_query($conn,$select_margembruta_naomedicamentos_c);
$margem_bruta_naomedicamento_c = mysqli_fetch_array($resultado_margembruta_naomedicamentos_c)[0];






//Margem Para o Menor Preco Nao Medicamento Geral Consulta
$select_margemmenor_naomedicamentos = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_naomedicamentos = mysqli_query($conn,$select_margemmenor_naomedicamentos);
$margemmenor_naomedicamento = mysqli_fetch_array($resultado_margemmenor_naomedicamentos)[0];





//Margem Para o Menor Nao Medicamento Preco Geral Consulta Curva A
$select_margemmenor_naomedicamentos_a = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_naomedicamentos_a = mysqli_query($conn,$select_margemmenor_naomedicamentos_a);
$margemmenor_naomedicamento_a = mysqli_fetch_array($resultado_margemmenor_naomedicamentos_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_naomedicamentos_b = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_naomedicamentos_b = mysqli_query($conn,$select_margemmenor_naomedicamentos_b);
$margemmenor_naomedicamento_b = mysqli_fetch_array($resultado_margemmenor_naomedicamentos_b)[0];

//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_naomedicamentos_c = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma and descontinuado<>1";
$resultado_margemmenor_naomedicamentos_c = mysqli_query($conn,$select_margemmenor_naomedicamentos_c);
$margemmenor_naomedicamento_c = mysqli_fetch_array($resultado_margemmenor_naomedicamentos_c)[0];






//Qtd Produtos Nao Medicamentos
$select_qtd_naomedicamentos = "SELECT count(1) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_qtd_naomedicamentos = mysqli_query($conn,$select_qtd_naomedicamentos);
$qtd_naomedicamento = mysqli_fetch_array($resultado_qtd_naomedicamentos)[0];

//Qtd Produtos Nao Medicamentos Curva A
$select_qtd_naomedicamentos_a = "SELECT count(1) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve =  'A' and pbm <> $pbma";
$resultado_qtd_naomedicamentos_a = mysqli_query($conn,$select_qtd_naomedicamentos_a);
$qtd_naomedicamento_a = mysqli_fetch_array($resultado_qtd_naomedicamentos_a)[0];



//Qtd Produtos Nao  Medicamentos Curva B
$select_qtd_naomedicamentos_b = "SELECT count(1) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve =  'B' and pbm <> $pbma";
$resultado_qtd_naomedicamentos_b = mysqli_query($conn,$select_qtd_naomedicamentos_b);
$qtd_naomedicamento_b = mysqli_fetch_array($resultado_qtd_naomedicamentos_b)[0];

//Qtd Produtos Nao Medicamentos Curva C
$select_qtd_naomedicamentos_c = "SELECT count(1)FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve =  'C' and pbm <> $pbma";
$resultado_qtd_naomedicamentos_c = mysqli_query($conn,$select_qtd_naomedicamentos_c);
$qtd_naomedicamento_c = mysqli_fetch_array($resultado_qtd_naomedicamentos_c)[0];



$consultatotalestoque = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma and descontinuado<>1";
$resultado_qtd_geral_estoque = mysqli_query($conn,$consultatotalestoque);
$qtd_geral_estoque = mysqli_fetch_array($resultado_qtd_geral_estoque)[0];

////CUSTO
$consultatotalcusto = "SELECT price_cost, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma and descontinuado<>1";
$res_datatotalcusto = mysqli_query($conn,$consultatotalcusto);
        while($row = mysqli_fetch_array($res_datatotalcusto)){

$valoritem = $valoritem + ($row[0] * $row[1]);



}


////PAGUE APENEAS

$consultatotalpayonly = "SELECT price_pay_only, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma and descontinuado<>1";
$res_datatotalpayonly = mysqli_query($conn,$consultatotalpayonly);
        while($row22 = mysqli_fetch_array($res_datatotalpayonly)){

$valoritempo = $valoritempo + ($row22[0] * $row22[1]);

}


////financiando
$consultatotalpayonlyf = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma and descontinuado<>1";
$res_datatotalpayonlyf = mysqli_query($conn,$consultatotalpayonlyf);
        while($row22f = mysqli_fetch_array($res_datatotalpayonlyf)){

$valoritempof = $valoritempof + ($row22f[0] * $row22f[1]);
$valoritempof1 = $valoritempof1 + ($row22f[2] * $row22f[1]);
}





$valoritempof10 = ($valoritempof - $valoritempof1);
//Abaixo do Custo

$consultatotalpvenda = "SELECT gross_margin, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma and descontinuado<>1";
$res_datatotalpvenda = mysqli_query($conn,$consultatotalpvenda);
        while($row223 = mysqli_fetch_array($res_datatotalpvenda)){

$valoritempv = $valoritempv + ($row223[0] * $row223[1]);

}





//Qtd Concorrentes 1
$select_qtd_concorrente1 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=1 and pbm <> $pbma";
$resultado_qtd_concorrente1 = mysqli_query($conn,$select_qtd_concorrente1);
$qtd_concorrente1 = mysqli_fetch_array($resultado_qtd_concorrente1)[0];

//Qtd Concorrentes 2
$select_qtd_concorrente2 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=2 and pbm <> $pbma";
$resultado_qtd_concorrente2 = mysqli_query($conn,$select_qtd_concorrente2);
$qtd_concorrente2 = mysqli_fetch_array($resultado_qtd_concorrente2)[0];

//Qtd Concorrentes 3
$select_qtd_concorrente3 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=3 and pbm <> $pbma";
$resultado_qtd_concorrente3 = mysqli_query($conn,$select_qtd_concorrente3);
$qtd_concorrente3 = mysqli_fetch_array($resultado_qtd_concorrente3)[0];


//Qtd Concorrentes 4
$select_qtd_concorrente4 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=4 and pbm <> $pbma";
$resultado_qtd_concorrente4 = mysqli_query($conn,$select_qtd_concorrente4);
$qtd_concorrente4 = mysqli_fetch_array($resultado_qtd_concorrente4)[0];


//Qtd Concorrentes 5
$select_qtd_concorrente5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=5 and pbm <> $pbma";
$resultado_qtd_concorrente5 = mysqli_query($conn,$select_qtd_concorrente5);
$qtd_concorrente5 = mysqli_fetch_array($resultado_qtd_concorrente5)[0];



//Qtd Concorrentes 6
$select_qtd_concorrente6 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms >'0' and qty_competitors=6 and pbm <> $pbma";
$resultado_qtd_concorrente6 = mysqli_query($conn,$select_qtd_concorrente6);
$qtd_concorrente6 = mysqli_fetch_array($resultado_qtd_concorrente6)[0];




//Concorrentes em Ruptura



//Qtd Concorrentes 1
$select_qtd_concorrente1r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=1 and pbm <> $pbma";
$resultado_qtd_concorrente1r = mysqli_query($conn,$select_qtd_concorrente1r);
$qtd_concorrente1r = mysqli_fetch_array($resultado_qtd_concorrente1r)[0];

//Qtd Concorrentes 2
$select_qtd_concorrente2r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=2 and pbm <> $pbma";
$resultado_qtd_concorrente2r = mysqli_query($conn,$select_qtd_concorrente2r);
$qtd_concorrente2r = mysqli_fetch_array($resultado_qtd_concorrente2r)[0];

//Qtd Concorrentes 3
$select_qtd_concorrente3r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=3 and pbm <> $pbma";
$resultado_qtd_concorrente3r = mysqli_query($conn,$select_qtd_concorrente3r);
$qtd_concorrente3r = mysqli_fetch_array($resultado_qtd_concorrente3r)[0];


//Qtd Concorrentes 4
$select_qtd_concorrente4r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=4 and pbm <> $pbma";
$resultado_qtd_concorrente4r = mysqli_query($conn,$select_qtd_concorrente4r);
$qtd_concorrente4r = mysqli_fetch_array($resultado_qtd_concorrente4r)[0];


//Qtd Concorrentes 5
$select_qtd_concorrente5r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=5 and pbm <> $pbma";
$resultado_qtd_concorrente5r = mysqli_query($conn,$select_qtd_concorrente5r);
$qtd_concorrente5r = mysqli_fetch_array($resultado_qtd_concorrente5r)[0];


//Qtd Concorrentes 6
$select_qtd_concorrente6r = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors=6 and pbm <> $pbma";
$resultado_qtd_concorrente6r = mysqli_query($conn,$select_qtd_concorrente6r);
$qtd_concorrente6r = mysqli_fetch_array($resultado_qtd_concorrente6r)[0];


//Concorrentes em Ruptura Disponiveis



//Qtd Concorrentes 1
$select_qtd_concorrente1ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=1 and pbm <> $pbma";
$resultado_qtd_concorrente1ra = mysqli_query($conn,$select_qtd_concorrente1ra);
$qtd_concorrente1ra = mysqli_fetch_array($resultado_qtd_concorrente1ra)[0];

//Qtd Concorrentes 2
$select_qtd_concorrente2ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=2 and pbm <> $pbma";
$resultado_qtd_concorrente2ra = mysqli_query($conn,$select_qtd_concorrente2ra);
$qtd_concorrente2ra = mysqli_fetch_array($resultado_qtd_concorrente2ra)[0];

//Qtd Concorrentes 3
$select_qtd_concorrente3ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=3 and pbm <> $pbma";
$resultado_qtd_concorrente3ra = mysqli_query($conn,$select_qtd_concorrente3ra);
$qtd_concorrente3ra = mysqli_fetch_array($resultado_qtd_concorrente3ra)[0];


//Qtd Concorrentes 4
$select_qtd_concorrente4ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=4 and pbm <> $pbma";
$resultado_qtd_concorrente4ra = mysqli_query($conn,$select_qtd_concorrente4ra);
$qtd_concorrente4ra = mysqli_fetch_array($resultado_qtd_concorrente4ra)[0];


//Qtd Concorrentes 5
$select_qtd_concorrente5ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=5 and pbm <> $pbma";
$resultado_qtd_concorrente5ra = mysqli_query($conn,$select_qtd_concorrente5ra);
$qtd_concorrente5ra = mysqli_fetch_array($resultado_qtd_concorrente5ra)[0];

//Qtd Concorrentes 6
$select_qtd_concorrente6ra = "SELECT count(1) FROM Products where active=1 and qty_stock_rms ='0' and qty_competitors_available=6 and pbm <> $pbma";
$resultado_qtd_concorrente6ra = mysqli_query($conn,$select_qtd_concorrente6ra);
$qtd_concorrente6ra = mysqli_fetch_array($resultado_qtd_concorrente6ra)[0];



/* This will give an error. Note the output
 * above, which is before the header() call */

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
            <h1 class="h3 mb-0 text-gray-800">QualiBrain</h1>
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
?>


  
  


<script>



var id_switch = document.getElementById('customSwitch1');


id_switch.addEventListener('change',function(){
  if(this.checked == true){
 


 window.location = 'index.php?vpbm=1';

 }else{
 

 window.location = 'index.php?vpbm=5';

}
});
</script>
            <a href="#" data-toggle="modal" data-target="#relatoriomodal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-bars fa-sm text-white-50"></i> Regras Gerais</a>
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
  Total Curva A <a href="#" class="alert-link" data-toggle="modal" data-target="#totalprodutosmodala"><?php echo  number_format($qtd_geral_a, 0, ',', '.');?></a>
</div>



    </div>

    <div class="col-sm">
<div class="alert alert-success" role="alert">
  Total Curva B <a href="#" class="alert-link" data-toggle="modal" data-target="#totalprodutosmodalb"><?php echo  number_format($qtd_geral_b, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-success" role="alert">
  Total Curva C <a href="#" class="alert-link" data-toggle="modal" data-target="#totalprodutosmodalc"><?php echo  number_format($qtd_geral_c, 0, ',', '.');?></a>
</div>
    </div>



	                      	
  </div>
<div class="col mr-2">
<a href="#"><span class="badge badge-warning cachbackicon" style="" data-toggle="modal" data-target="#cashbackmodal">Cashback: <?php echo number_format($margem_cashback_geral, 0, ',', '.');?> </span></a>

<a href="#"><span class="badge badge-danger cachbackicon" style="" data-toggle="modal" data-target="#tabeladomodal">Controlados: <?php echo number_format($margem_controlados_geral, 0, ',', '.');?> </span></a>

<a href="#"><span class="badge badge-success cachbackicon" style="" data-toggle="modal" data-target="#pbmmodal">PBM: <?php echo number_format($total_pbmc, 0, ',', '.');?> </span></a>
<a href="#"><span class="badge badge-primary cachbackicon" style="" data-toggle="modal" data-target="#promomodal">Promo: <?php echo $total_promo; ?> </span></a>
<a href="#"><span class="badge badge-warning cachbackicon" style="" data-toggle="modal" data-target="#homemodal">Home: <?php echo $total_promo_home; ?> </span></a>
<a href="#"><span class="badge badge-danger cachbackicon" style="" data-toggle="modal" data-target="#descontinuadomodal">Descontinuados: <?php echo $total_descontinuado_geral; ?> </span></a>
<a href="#"><span class="badge badge-success cachbackicon" style="" data-toggle="modal" data-target="#otcmodal">OTC: <?php echo $total_otc_geral; ?> </span></a>

<a href="#"><span class="badge badge-primary cachbackicon" style="" data-toggle="modal" data-target="#termomodal">Termolábeis: <?php echo $total_termol_geral; ?> </span></a>
<a href="#"><span class="badge badge-warning cachbackicon" style="" data-toggle="modal" data-target="#marcasmodal">Marcas</span></a>

<a href="#"><span class="badge badge-danger cachbackicon" style="" data-toggle="modal" data-target="#principioativomodal">Principio Ativo</span></a>


</div></div>
   <div class="col-xl-12 col-md-6 mb-4">
<h4 class="m-0 small font-weight-bold text-danger">PRODUTOS EM RUPTURA</h4>
<h6>As informações abaixo serão atualizadas após encerramento e endereçamento de todos os produtos no centro de distribuição</h6>

  <div class="row">
    <div class="col-sm">

<div class="alert alert-danger" role="alert">
  Total SKUs <a href="#" class="alert-link" data-toggle="modal" data-target="#rupturamodal"> <?php echo  number_format($qtd_geral_ruptura, 0, ',', '.');?></a>
</div>
    </div>
 <div class="col-sm">
<div class="alert alert-danger" role="alert">
  Total Curva A <a href="#" class="alert-link" data-toggle="modal" data-target="#rupturaamodal" > <?php echo  number_format($qtd_geral_a_ruptura, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-danger" role="alert">
  Total Curva B <a href="#" class="alert-link" data-toggle="modal" data-target="#rupturabmodal"> <?php echo  number_format($qtd_geral_b_ruptura, 0, ',', '.');?></a>
</div>
    </div>
    <div class="col-sm">
<div class="alert alert-danger" role="alert" data-toggle="modal" data-target="#rupturacmodal">
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
                  <h6 class="m-0 font-weight-bold text-primary">Medicamentos </h6><div class="alert alert-light" role="alert"><b>Custo:</b> R$ <?php echo number_format($medicamento_custo_geral, 2, ',', '.');?> - <b>Receita:</b> R$ <?php echo number_format($preco_pagueapenas_medicamento, 2, ',', '.');?> - <b>Lucro Bruto:</b> R$ <?php echo number_format($preco_venda_medicamento, 2, ',', '.');?> - <b>Margem Op.:</b> <?php $margem_bruta_medicamento = $margem_bruta_medicamento * 100; echo number_format($margem_bruta_medicamento, 2, ',', '.'). '%';?> - <b>Média Diferença Menor Preco:</b> <?php $margemmenor_medicamento = $margemmenor_medicamento * 100; echo number_format($margemmenor_medicamento, 2, ',', '.'). '%';?> - <b>Qtd de SKUs:</b> <?php echo number_format($qtd_medicamento, 0, ',', '.');?> - <b>Estoque:</b> <?php echo number_format($qtd_geral_estoquem, 0, ',', '.');?> - <b>Estoque Generico:</b> <?php echo number_format($qtd_geral_estoqueg, 0, ',', '.');?> - <b>Estoque Marca:</b> <?php echo number_format($qtd_geral_estoquemarc, 0, ',', '.');?> - <b>Estoque Similar:</b> <?php echo number_format($qtd_geral_estoquesimi, 0, ',', '.');?> - <b>Estoque Autocuidado:</b> <?php echo number_format($qtd_geral_estoqueautocu, 0, ',', '.');?> - <b>Qtd SKUs Ruptura:</b> <?php echo number_format($qtd_geral_ruptura_medicamentos, 0, ',', '.');?> - <b>Qtd SKUs Abaixo do Custo:</b> <?php echo number_format($qtd_geral_financiandom, 0, ',', '.');?>  - <b>Déficit Abaixo do Custo:</b><font color=red> R$ <?php echo number_format($valoritempofm10, 2, ',', '.');?></font> </div>
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
      <td>R$ <?php echo number_format($medicamento_custo_geral_a, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_medicamento_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_medicamento_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_medicamento_a = $margem_bruta_medicamento_a * 100; echo number_format($margem_bruta_medicamento_a, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_medicamento_a = $margemmenor_medicamento_a * 100; echo number_format($margemmenor_medicamento_a, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_medicamento_a, 0, ',', '.');?></td>
    </tr>


<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_medicamento_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquem_a, 0, ',', '.');?></td>
  </tr>
  <tr>
  <th scope="row">Estoque Generico:</th>

   <td><?php echo number_format($qtd_geral_estoqueg_a, 0, ',', '.');?></td>
  </tr>
  <tr>
  <th scope="row">Estoque Marcas:</th>

    
      <td><?php echo number_format($qtd_geral_estoquemarc_a, 0, ',', '.');?></td>
</tr>
 <tr>
  <th scope="row">Estoque Similar:</th>

      <td><?php echo number_format($qtd_geral_estoquesimi_a, 0, ',', '.');?></td>
</tr>
<tr>
  <th scope="row">Estoque AutoCuidado:</th>

            <td><?php echo number_format($qtd_geral_estoqueautocu_a, 0, ',', '.');?></td>
      
    </tr>
    </tr>

<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_a_ruptura_medicamentos, 0, ',', '.');?></td>
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
      <td>R$ <?php echo number_format($medicamento_custo_geral_b, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_medicamento_b, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_medicamento_b, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_medicamento_b = $margem_bruta_medicamento_b * 100; echo number_format($margem_bruta_medicamento_b, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_medicamento_b = $margemmenor_medicamento_b * 100; echo number_format($margemmenor_medicamento_b, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_medicamento_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_medicamento_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquem_b, 0, ',', '.');?></td>
  </tr>
  <tr>
  <th scope="row">Estoque Generico:</th>

   <td><?php echo number_format($qtd_geral_estoqueg_b, 0, ',', '.');?></td>
  </tr>
  <tr>
  <th scope="row">Estoque Marcas:</th>

    
      <td><?php echo number_format($qtd_geral_estoquemarc_b, 0, ',', '.');?></td>
</tr>
 <tr>
  <th scope="row">Estoque Similar:</th>

      <td><?php echo number_format($qtd_geral_estoquesimi_b, 0, ',', '.');?></td>
</tr>
<tr>
  <th scope="row">Estoque AutoCuidado:</th>

            <td><?php echo number_format($qtd_geral_estoqueautocu_b, 0, ',', '.');?></td>
      
    </tr>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_b_ruptura_medicamentos, 0, ',', '.');?></td>
    
    
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
      <td>R$ <?php echo number_format($medicamento_custo_geral_c, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_medicamento_c, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_medicamento_c, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_medicamento_c = $margem_bruta_medicamento_c * 100; echo number_format($margem_bruta_medicamento_c, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_medicamento_c = $margemmenor_medicamento_c * 100; echo number_format($margemmenor_medicamento_c, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_medicamento_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquem_c, 0, ',', '.');?></td>
  </tr>
  <tr>
  <th scope="row">Estoque Generico:</th>

   <td><?php echo number_format($qtd_geral_estoqueg_c, 0, ',', '.');?></td>
  </tr>
  <tr>
  <th scope="row">Estoque Marcas:</th>

    
      <td><?php echo number_format($qtd_geral_estoquemarc_c, 0, ',', '.');?></td>
</tr>
 <tr>
  <th scope="row">Estoque Similar:</th>

      <td><?php echo number_format($qtd_geral_estoquesimi_c, 0, ',', '.');?></td>
</tr>
<tr>
  <th scope="row">Estoque AutoCuidado:</th>

            <td><?php echo number_format($qtd_geral_estoqueautocu_c, 0, ',', '.');?></td>
      
    </tr>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_c_ruptura_medicamentos, 0, ',', '.');?></td>
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
<div style="float:right"><a href="medicamentos.php" class="btn btn-secondary btn-icon-split">
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
                  <h6 class="m-0 font-weight-bold text-primary">Nao Medicamentos</h6><div class="alert alert-light" role="alert"><b>Custo:</b> R$ <?php echo number_format($naomedicamento_custo_geral, 2, ',', '.');?> - <b>Receita:</b> R$ <?php echo number_format($preco_pagueapenas_naomedicamento, 2, ',', '.');?> - <b>Lucro Bruto:</b> R$ <?php echo number_format($preco_venda_naomedicamento, 2, ',', '.');?> - <b>Margem Op.:</b> <?php $margem_bruta_naomedicamento = $margem_bruta_naomedicamento * 100; echo number_format($margem_bruta_naomedicamento, 2, ',', '.'). '%';?> - <b>Média Diferença Menor Preco:</b> <?php $margemmenor_naomedicamento = $margemmenor_naomedicamento * 100; echo number_format($margemmenor_naomedicamento, 2, ',', '.'). '%';?> - <b>Qtd de SKUs:</b> <?php  echo number_format($qtd_naomedicamento, 0, ',', '.');?> - <b>Estoque:</b> <?php echo number_format($qtd_geral_estoquenm, 0, ',', '.');?> - <b>Estoque Alimento Adulto:</b> <?php echo number_format($qtd_geral_estoquealim, 0, ',', '.');?> -<b>Estoque Produto Diet:</b> <?php echo number_format($qtd_geral_estoqueprodd, 0, ',', '.');?> - <b>Qtd SKUs Ruptura:</b> <?php echo number_format($qtd_geral_ruptura_naomedicamento, 0, ',', '.');?> - <b>Qtd SKUs Abaixo do Custo:</b> <?php echo number_format($qtd_geral_financiandonm, 0, ',', '.');?>  - <b>Déficit Abaixo do Custo:</b><font color=red> R$ <?php echo number_format($valoritempofnm10, 2, ',', '.');?></font> </div>
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
      <td>R$ <?php echo number_format($naomedicamento_custo_geral_a, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_naomedicamento_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_naomedicamento_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_naomedicamento_a = $margem_bruta_naomedicamento_a * 100; echo number_format($margem_bruta_naomedicamento_a, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_naomedicamento_a = $margemmenor_naomedicamento_a * 100; echo number_format($margemmenor_naomedicamento_a, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_naomedicamento_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquenm_a, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque Aliemento Adulto:</th>

      <td><?php echo number_format($qtd_geral_estoquealim_a, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque Produtos Diet:</th>

      <td><?php echo number_format($qtd_geral_estoqueprodd_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_a_ruptura_naomedicamentos, 0, ',', '.');?></td>
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
      <td>R$ <?php echo number_format($naomedicamento_custo_geral_b, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_naomedicamento_b, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_naomedicamento_b, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_naomedicamento_b = $margem_bruta_naomedicamento_b * 100; echo number_format($margem_bruta_naomedicamento_b, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_naomedicamento_b = $margemmenor_naomedicamento_b * 100; echo number_format($margemmenor_naomedicamento_b, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_naomedicamento_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquenm_b, 0, ',', '.');?></td>
    </tr>

  <tr>
      <th scope="row">Estoque Aliemento Adulto:</th>

      <td><?php echo number_format($qtd_geral_estoquealim_b, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque Produtos Diet:</th>

      <td><?php echo number_format($qtd_geral_estoqueprodd_b, 0, ',', '.');?></td>
    </tr>

<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_b_ruptura_naomedicamentos, 0, ',', '.');?></td>
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
      <td>R$ <?php echo number_format($naomedicamento_custo_geral_c, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_naomedicamento_c, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_naomedicamento_c, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_naomedicamento_c = $margem_bruta_naomedicamento_c * 100; echo number_format($margem_bruta_naomedicamento_c, 2, ',', '.').'%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_naomedicamento_c = $margemmenor_naomedicamento_c * 100; echo number_format($margemmenor_naomedicamento_c, 2, ',', '.') .'%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_naomedicamento_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquenm_c, 0, ',', '.');?></td>
    </tr>
  <tr>
      <th scope="row">Estoque Aliemento Adulto:</th>

      <td><?php echo number_format($qtd_geral_estoquealim_c, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque Produtos Diet:</th>

      <td><?php echo number_format($qtd_geral_estoqueprodd_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_c_ruptura_naomedicamento, 0, ',', '.');?></td>
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
<div style="float:right"><a href="naomedicamentos.php" class="btn btn-secondary btn-icon-split">
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
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                       <h6 class="m-0 font-weight-bold text-primary">Perfumaria </h6><div class="alert alert-light" role="alert"><b>Custo:</b> R$ <?php echo number_format($perfumaria_custo_geral, 2, ',', '.');?> - <b>Receita:</b> R$ <?php echo number_format($preco_pagueapenas_perfumaria, 2, ',', '.');?> - <b>Lucro Bruto:</b> R$ <?php echo number_format($preco_venda_perfumaria, 2, ',', '.');?> - <b>Margem Op.:</b> <?php $margem_bruta_perfumaria = $margem_bruta_perfumaria * 100; echo number_format($margem_bruta_perfumaria, 2, ',', '.'). '%';?> - <b>Média Diferença Menor Preco:</b> <?php $margemmenor_perfumaria = $margemmenor_perfumaria * 100; echo number_format($margemmenor_perfumaria, 2, ',', '.'). '%';?> - <b>Qtd de SKUs:</b> <?php echo number_format($qtd_perfumaria, 0, ',', '.');?> - <b>Estoque:</b> <?php echo number_format($qtd_geral_estoquef, 0, ',', '.');?> -  - <b>Estoque Dermocosmeticos:</b> <?php echo number_format($qtd_geral_estoquedermo, 0, ',', '.');?> - <b>Estoque Beleza:</b> <?php echo number_format($qtd_geral_estoquebeleza, 0, ',', '.');?> - <b>Estoque Higiene:</b> <?php echo number_format($qtd_geral_estoquehigiene, 0, ',', '.');?> - <b>Estoque Higiene e Beleza:</b> <?php echo number_format($qtd_geral_estoquehigieneebeleza, 0, ',', '.');?> - <b>Estoque Mamae e Bebe:</b> <?php echo number_format($qtd_geral_estoquemamae, 0, ',', '.');?> - <b>Qtd SKUs Ruptura:</b> <?php echo number_format($qtd_geral_ruptura_perfumaria, 0, ',', '.');?> - <b>Qtd SKUs Abaixo do Custo:</b> <?php echo number_format($qtd_geral_financiandof, 0, ',', '.');?>  - <b>Déficit Abaixo do Custo:</b><font color=red> R$ <?php echo number_format($valoritempoff10, 2, ',', '.');?></font> </div>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse" id="collapseCardExample">
                  <div class="card-body">
                   
 <div class="row">
    <div class="col-sm">
<center><p><b>Curva #A</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Custo:</th>
      <td>R$ <?php echo number_format($perfumaria_custo_geral_a, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_perfumaria_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_perfumaria_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_perfumaria_a = $margem_bruta_perfumaria_a * 100; echo number_format($margem_bruta_perfumaria_a, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_perfumaria_a = $margemmenor_perfumaria_a * 100; echo number_format($margemmenor_perfumaria_a, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_perfumaria_a, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquef_a, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquedermo_a, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquehigiene_a, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquebeleza_a, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquehigieneebeleza_a, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquemamae_a, 0, ',', '.');?></td>
    </tr>
    
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_a_ruptura_perfumaria, 0, ',', '.');?></td>
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
      <td>R$ <?php echo number_format($perfumaria_custo_geral_b, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_perfumaria_b, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_perfumaria_b, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_perfumaria_b = $margem_bruta_perfumaria_b * 100; echo number_format($margem_bruta_perfumaria_b, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_perfumaria_b = $margemmenor_perfumaria_b * 100; echo number_format($margemmenor_perfumaria_b, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_perfumaria_b, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquef_b, 0, ',', '.');?></td>
    </tr>

 <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquedermo_b, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquehigiene_b, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquebeleza_b, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquehigieneebeleza_b, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquemamae_b, 0, ',', '.');?></td>
    </tr>
    
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_b_ruptura_perfumaria, 0, ',', '.');?></td>
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
      <td>R$ <?php echo number_format($perfumaria_custo_geral_c, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Receita:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_perfumaria_c, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Lucro Bruto:</th>

      <td>R$ <?php echo number_format($preco_venda_perfumaria_c, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php $margem_bruta_perfumaria_c = $margem_bruta_perfumaria_c * 100; echo number_format($margem_bruta_perfumaria_c, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preço:</th>

      <td><?php $margemmenor_perfumaria_c = $margemmenor_perfumaria_c * 100; echo number_format($margemmenor_perfumaria_c, 2, ',', '.'). '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de SKUs:</th>

      <td><?php echo number_format($qtd_perfumaria_c, 0, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquef_c, 0, ',', '.');?></td>
    </tr>
    
     <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquedermo_c, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquehigiene_c, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquebeleza_c, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquehigieneebeleza_c, 0, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Estoque:</th>

      <td><?php echo number_format($qtd_geral_estoquemamae_c, 0, ',', '.');?></td>
    </tr>
    
    
<tr>
      <th scope="row">Qtd Ruptura:</th>

      <td><?php echo number_format($qtd_geral_c_ruptura_perfumaria, 0, ',', '.');?></td>
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
<div style="float:right"><a href="perfumaria.php" class="btn btn-secondary btn-icon-split">
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

<tr>
      <th scope="row">6 Concorrentes</th>
      <td ><?php echo $qtd_concorrente6r?></td>
      <td ><?php echo $qtd_concorrente6ra?></td>
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


<th>MARCA</th>
<th>FABRICANTE</th>
<th>N. CONCORRENTE</th>
<th>VENDAS</th>
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

<th>MARCA</th>
<th>FABRICANTE</th>
<th>N. CONCORRENTE</th>
<th>VENDA</th>
                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalprodutosruptura = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only,
 Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest, Products.curve,
 marca.marca, marca.fabricante, Products.qty_competitors, sum(vendas.qtd) from Products Inner join marca on marca.sku=Products.sku inner join vendas on
vendas.sku=Products.sku where active='1' and qty_stock_rms=0 and pbm <> $pbma group by vendas.sku";
$res_datatotalruptura = mysqli_query($conn,$consultatotalprodutosruptura);
        while($rowr = mysqli_fetch_array($res_datatotalruptura)){
     
                echo    '<tr>';
                                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowr[0].'>'.$rowr[0].'</a></td>';
                    echo  '<td>'. $rowr[1].'</td>';
 echo  '<td>'. $rowr[2].'</td>';
 echo  '<td>'. $rowr[3].'</td>';
 echo  '<td>'.$rowr[4].'</td>';
echo  '<td>'.$rowr[5].'</td>';
echo  '<td>'.$rowr[6].'</td>';
echo  '<td>'.$rowr[7].'</td>';
echo  '<td>'.$rowr[8].'</td>';
echo  '<td>'.round((float)$rowr[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowr[10] * 100).'%</td>';
echo  '<td>'.$rowr[11].'</td>';
echo  '<td>'.$rowr[12].'</td>';

echo  '<td>'.$rowr[13].'</td>';
echo  '<td>'.$rowr[14].'</td>';
echo  '<td>'.$rowr[15].'</td>';

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


$consultatotalprodutosfinanciando = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, marca, qty_stock_rms from Products where active='1' and current_gross_margin_percent < 0 and qty_stock_rms > 0 and pbm <> $pbma";
$res_datatotalfinanciando = mysqli_query($conn,$consultatotalprodutosfinanciando);
        while($rowf = mysqli_fetch_array($res_datatotalfinanciando)){
     
                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowf[0].'>'.$rowf[0].'</a></td>';
                    echo  '<td>'. $rowf[1].'</td>';
 echo  '<td>'. $rowf[2].'</td>';
 echo  '<td>'. $rowf[3].'</td>';
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
          <h5 class="modal-title" id="exampleModalLabel1">Regras Pricing</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="dropdown-divider"></div>
              <!-- Collapsable Card Example -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Margem de Operação</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="collapseCardExample">
                                    <div class="card-body">
<strong>Medicamentos Gerais -</strong> 15.75%<br>
                                        <strong>Medicamentos Similar - </strong>40% <br>
<strong>Medicamentos Genérico  - </strong>40% - Markup 1.66 <br>
<strong>Medicamentos Autocuidado - </strong>30%<br>
<strong>Perfumaria Gerais - </strong>42.80% - Markup 1.75<br>
<strong>Perfumaria Dermocosméticos - </strong>20% - Produtos Tabelados - Igualar Valor da menor oferta e manter margem de discrepancia em 30% para Cashback<br>
                                    </div>
                                </div>
                            </div>
 <!-- Discrepancia -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#d2" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">Discrepância</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="d2">
                                    <div class="card-body">
<strong> </strong> <br>
<strong>Perfumaria Dermocosméticos - </strong>30% <br>
<strong>Medicamentos Genéricos - </strong>8% <br>
<strong>Medicamentos Marcas - </strong>8% <br>
<strong>Gerais - </strong>3%
                                    </div>
                                </div>
                            </div>
           <!-- Cashb -->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Accordion -->
                                <a href="#cb2" class="d-block card-header py-3" data-toggle="collapse"
                                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                    <h6 class="m-0 font-weight-bold text-primary">CashBack</h6>
                                </a>
                                <!-- Card Content - Collapse -->
                                <div class="collapse show" id="cb2">
                                    <div class="card-body">
                                      <strong> Regra 1 - </strong>Proibidos os itens que incentivem a desmamação; chupeta, mamadeiras, compostos lácteos pediátricos e Medicamentos.<br>
<strong>Regra 2 - </strong>Possuir margem de operação positiva e maior que 3%.<br>
<strong>Regra 3 - </strong>Possuir pelo menos 0,50 centavos de espaço na margem de operação.<br> 
<strong>Regra 4 - </strong>Possuir pelo menos um concorrente com estoque disponível. 
                                   
 </div>
                                </div>
                            </div>

</div>

        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>





<!----- TOTAL PRODUTOS CURVA A ---->






<div class="modal fade" id="totalprodutosmodala" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Total Produtos Curva A</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
	<div class="modal-body">
<br>
<select class="custom-select" name="departamento" id="departamento" >
  <option selected value="">Selecione o Departamento</option>
<option value="">Geral Curva A</option>

  <option value="medicamento">Medicamento Curva A</option>
  <option value="perfumaria">Perfumaria Curva A</option>
  <option value="NAO">Nao Medicamento Curva A</option>



</select>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#departamento").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */

      var departamento = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
     // var dataString = departamento; /* STORE THAT TO A DATA STRING */
var dataString = departamento;
var vpbm= "<?php echo ($pbma); ?>";

     $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "get-data.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: {departamento: departamento, vpbm:vpbm},
 /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#show").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
  });
</script>

<br>

<br>
<div id="show">
  <!-- ITEMS TO BE DISPLAYED HERE -->
</div>
<br>

<p>Os valores acima referem-se aos produtos de curva A, ativos, com estoque e sem considerar os descontinuados.</p>
<br>
<div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxlsa.php'>Exportar</a></button> </div><br><br><div class="dropdown-divider"></div>

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

<th>CONCORRENTE</th>
<th>MARCA</th>
<th>VENDAS</th>
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

<th>CONCORRENTES</th>
<th>MARCA</th>
<th>VENDAS</th>
                    </tr>
                  </tfoot>
                  <tbody>

<?php


$consultatotalprodutosa1 = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only, Products.current_less_price_around,
 Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest, Products.curve, Products.qty_stock_rms, Products.qty_competitors, marca.marca, sum(vendas.qtd) from Products inner join vendas on vendas.sku=Products.sku inner join marca on marca.sku=Products.sku
 where active='1' and pbm <> $pbma and curve='A' group by vendas.sku";
$res_datatotala1 = mysqli_query($conn,$consultatotalprodutosa1);

 while($rowpa1 = mysqli_fetch_array($res_datatotala1)){
                echo    '<tr>';
echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowpa1[0].'>'.$rowpa1[0].'</a></td>';
echo  '<td>'. $rowpa1[1].'</td>';
 echo  '<td>'. $rowpa1[2].'</td>';
 echo  '<td>'. $rowpa1[3].'</td>';
 echo  '<td>'.$rowpa1[4].'</td>';
echo  '<td>'.$rowpa1[5].'</td>';
echo  '<td>'.$rowpa1[6].'</td>';
echo  '<td>'.$rowpa1[7].'</td>';
echo  '<td>'.$rowpa1[8].'</td>';
echo  '<td>'.round((float)$rowpa1[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowpa1[10] * 100).'%</td>';
echo  '<td>'.$rowpa1[11].'</td>';
echo  '<td>'.$rowpa1[12].'</td>';
echo  '<td>'.$rowpa1[13].'</td>';
echo  '<td>'.$rowpa1[14].'</td>';
echo  '<td>'.$rowpa1[15].'</td>';

echo    '</tr>';

}

?>



</tbody>
</table>
</div>
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>

<!----- TOTAL PRODUTOS CURVA B ---->






<div class="modal fade" id="totalprodutosmodalb" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
	<div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Total Produtos Curva B</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
<br>
<select class="custom-select" name="departamentob" id="departamentob" >
  <option selected value="">Selecione o Departamento</option>
<option value="">Geral Curva B</option>

  <option value="medicamento">Medicamento Curva B</option>
  <option value="perfumaria">Perfumaria Curva B</option>
  <option value="NAO">Nao Medicamento Curva B</option>



</select>


<script type="text/javascript">
  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#departamentob").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */

      var departamentob = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
     // var dataString = departamento; /* STORE THAT TO A DATA STRING */
var dataString = departamentob;
var vpbm= "<?php echo ($pbma); ?>";
     $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "get-datab.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: {departamentob: departamentob, vpbm:vpbm},
 /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#showb").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
  });
</script>




<br>

<br>
<div id="showb">
  <!-- ITEMS TO BE DISPLAYED HERE -->
</div>
<br>

<p>Os valores acima referem-se aos produtos de curva B, ativos, com estoque e sem considerar os descontinuados.</p>
<br>
<div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxlsb.php'>Exportar</a></button> </div><br><br><div class="dropdown-divider"></div>

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

<th>CONCORRENTE</th>
<th>MARCA</th>
<th>VENDAS</th>
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

<th>CONCORRENTES</th>
<th>MARCA</th>
<th>VENDAS</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php


$consultatotalprodutosb1 = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only, Products.current_less_price_around,
 Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest, Products.curve, Products.qty_stock_rms, Products.qty_competitors, marca.marca, sum(vendas.qtd) from Products inner join vendas on vendas.sku=Products.sku inner join marca on marca.sku=Products.sku
 where active='1' and pbm <> $pbma and curve='B' group by vendas.sku";
$res_datatotalb1 = mysqli_query($conn,$consultatotalprodutosb1);

 while($rowpb1 = mysqli_fetch_array($res_datatotalb1)){
                echo    '<tr>';
echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowpb1[0].'>'.$rowpb1[0].'</a></td>';
echo  '<td>'. $rowpb1[1].'</td>';
 echo  '<td>'. $rowpb1[2].'</td>';
 echo  '<td>'. $rowpb1[3].'</td>';
 echo  '<td>'.$rowpb1[4].'</td>';
echo  '<td>'.$rowpb1[5].'</td>';
echo  '<td>'.$rowpb1[6].'</td>';
echo  '<td>'.$rowpb1[7].'</td>';
echo  '<td>'.$rowpb1[8].'</td>';
echo  '<td>'.round((float)$rowpb1[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowpb1[10] * 100).'%</td>';
echo  '<td>'.$rowpb1[11].'</td>';
echo  '<td>'.$rowpb1[12].'</td>';
echo  '<td>'.$rowpb1[13].'</td>';
echo  '<td>'.$rowpb1[14].'</td>';
echo  '<td>'.$rowpb1[15].'</td>';

echo    '</tr>';

}

?>




</tbody>
</table>
</div>
      	<div class="modal-footer">


  <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>


<!----- TOTAL PRODUTOS CURVA C ---->






<div class="modal fade" id="totalprodutosmodalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
	<div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Total Produtos Curva C</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
<br>
<select class="custom-select" name="departamentoc" id="departamentoc" >
  <option selected value="">Selecione o Departamento</option>
<option value="">Geral Curva C</option>

  <option value="medicamento">Medicamento Curva C</option>
  <option value="perfumaria">Perfumaria Curva C</option>
  <option value="NAO">Nao Medicamento Curva C</option>



</select>

<script type="text/javascript">
  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#departamentoc").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */

      var departamentoc = $(this).val(); /* GET THE VALUE OF THE SELECTED DATA */
     // var dataString = departamento; /* STORE THAT TO A DATA STRING */
var dataString = departamentoc;
var vpbm= "<?php echo ($pbma); ?>";
     $.ajax({ /* THEN THE AJAX CALL */
        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "get-datac.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: {departamentoc: departamentoc, vpbm:vpbm},
 /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#showc").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
  });
</script>


<br>

<br>
<div id="showc">
  <!-- ITEMS TO BE DISPLAYED HERE -->
</div>
<br>

<p>Os valores acima referem-se aos produtos de curva C, ativos, com estoque e sem considerar os descontinuados.</p>
<br>
<div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxlsc.php'>Exportar</a></button> </div><br><br><div class="dropdown-divider"></div>

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

<th>CONCORRENTE</th>
<th>MARCA</th>
<th>VENDAS</th>
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

<th>CONCORRENTES</th>
<th>MARCA</th>
<th>VENDAS</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php


$consultatotalprodutosc1 = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only, Products.current_less_price_around,
 Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest, Products.curve, Products.qty_stock_rms, Products.qty_competitors, marca.marca, sum(vendas.qtd) from Products inner join vendas on vendas.sku=Products.sku inner join marca on marca.sku=Products.sku 
 where active='1' and pbm <> $pbma and curve='C' group by vendas.sku";
$res_datatotalc1 = mysqli_query($conn,$consultatotalprodutosc1);

 while($rowpc1 = mysqli_fetch_array($res_datatotalc1)){
                echo    '<tr>';
echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowpc1[0].'>'.$rowpc1[0].'</a></td>';
echo  '<td>'. $rowpc1[1].'</td>';
 echo  '<td>'. $rowpc1[2].'</td>';
 echo  '<td>'. $rowpc1[3].'</td>';
 echo  '<td>'.$rowpc1[4].'</td>';
echo  '<td>'.$rowpc1[5].'</td>';
echo  '<td>'.$rowpc1[6].'</td>';
echo  '<td>'.$rowpc1[7].'</td>';
echo  '<td>'.$rowpc1[8].'</td>';
echo  '<td>'.round((float)$rowpc1[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowpc1[10] * 100).'%</td>';
echo  '<td>'.$rowpc1[11].'</td>';
echo  "<td>". number_format($rowpc1[12], 0, ',', '.') ."</td>";
echo  '<td>'.$rowpc1[13].'</td>';
echo  '<td>'.$rowpc1[14].'</td>';
echo  '<td>'.$rowpc1[15].'</td>';
echo    '</tr>';

}

?>



</tbody>
</table>
</div>
      	<div class="modal-footer">


  <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
        </div>
      </div>
    </div>
  </div>








<!-- Ruptura Curva A Modal-->

  <div class="modal fade" id="rupturaamodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Ruptura Curva A</h5>
   <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
       </div>

        <div class="modal-body"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportrupturaaxls.php'>Exportar</a></button></div><br><br><div class="dropdown-divider"></div>
                


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


<th>MARCA</th>
<th>FABRICANTE</th>
<th>N. CONCORRENTES</th>

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



                     
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>

<th>MARCA</th>
<th>FABRICANTE</th>
<th>N. CONCORRENTES</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalprodutosruptura = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only,
 Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest, Products.curve,
 marca.marca, marca.fabricante, Products.qty_competitors from Products Inner join marca on marca.sku=Products.sku where active='1' and qty_stock_rms=0 and pbm <> $pbma and curve='A'";
$res_datatotalruptura = mysqli_query($conn,$consultatotalprodutosruptura);
        while($rowr = mysqli_fetch_array($res_datatotalruptura)){
     
                echo    '<tr>';
                                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowr[0].'>'.$rowr[0].'</a></td>';
                    echo  '<td>'. $rowr[1].'</td>';
 echo  '<td>'. $rowr[2].'</td>';
 echo  '<td>'. $rowr[3].'</td>';
 echo  '<td>'.$rowr[4].'</td>';
echo  '<td>'.$rowr[5].'</td>';
echo  '<td>'.$rowr[6].'</td>';
echo  '<td>'.$rowr[7].'</td>';
echo  '<td>'.$rowr[8].'</td>';
echo  '<td>'.round((float)$rowr[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowr[10] * 100).'%</td>';
echo  '<td>'.$rowr[11].'</td>';

echo  '<td>'.$rowr[12].'</td>';
echo  '<td>'.$rowr[13].'</td>';
echo  '<td>'.$rowr[14].'</td>';

echo  '</tr>';
 
}
?>               
                  </tbody>
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
        <div class="modal-body">

<?php
$selectpbmactive = "SELECT count(1) FROM pbm where active=1";
$resultado_pbmactive1 = mysqli_query($conn,$selectpbmactive);
$resultado_pbmactive = mysqli_fetch_array($resultado_pbmactive1)[0];

$selectpbminactive = "SELECT count(1) FROM pbm where active=0";
$resultado_pbminactive1 = mysqli_query($conn,$selectpbminactive);
$resultado_pbminactive = mysqli_fetch_array($resultado_pbminactive1)[0];


$selectpbmsellinactive = "SELECT sum(vendas.qtd) FROM pbm inner join vendas on vendas.sku=pbm.sku where pbm.active=0";
$resultado_pbmsellinactive1 = mysqli_query($conn,$selectpbmsellinactive);
$resultado_pbmsellinactive = mysqli_fetch_array($resultado_pbmsellinactive1)[0];

$selectpbmsellactive = "SELECT sum(vendas.qtd) FROM pbm inner join vendas on vendas.sku=pbm.sku where pbm.active=1";
$resultado_pbmsellactive1 = mysqli_query($conn,$selectpbmsellactive);
$resultado_pbmsellactive = mysqli_fetch_array($resultado_pbmsellactive1)[0];




$selectpbmtotalmp = "SELECT avg(Products.current_gross_margin_percent) FROM pbm inner join Products on Products.sku=pbm.sku where Products.active=1 and Products.descontinuado <> 1";
$resultado_pbmtotalmp1 = mysqli_query($conn,$selectpbmtotalmp);
$resultado_pbmtotalmp = mysqli_fetch_array($resultado_pbmtotalmp1)[0];

$selectpbmtotalmpa = "SELECT avg(Products.current_gross_margin_percent) FROM pbm inner join Products on Products.sku=pbm.sku where Products.curve='A' and
 Products.active=1  and Products.descontinuado <> 1";
$resultado_pbmtotalmpa1 = mysqli_query($conn,$selectpbmtotalmpa);
$resultado_pbmtotalmpa = mysqli_fetch_array($resultado_pbmtotalmpa1)[0];

$selectpbmtotalmpb = "SELECT avg(Products.current_gross_margin_percent) FROM pbm inner join Products on Products.sku=pbm.sku where Products.curve='B' and
 Products.active=1 and Products.descontinuado <> 1";
$resultado_pbmtotalmpb1 = mysqli_query($conn,$selectpbmtotalmpb);
$resultado_pbmtotalmpb = mysqli_fetch_array($resultado_pbmtotalmpb1)[0];

$selectpbmtotalmpc = "SELECT avg(Products.current_gross_margin_percent) FROM pbm inner join Products on Products.sku=pbm.sku where Products.curve='C' and
 Products.active=1 and Products.descontinuado <> 1";
$resultado_pbmtotalmpc1 = mysqli_query($conn,$selectpbmtotalmpc);
$resultado_pbmtotalmpc = mysqli_fetch_array($resultado_pbmtotalmpc1)[0];







$selectpbmtotalds = "SELECT avg(Products.diff_current_pay_only_lowest) FROM pbm inner join Products on Products.sku=pbm.sku where
 Products.active=1  and Products.descontinuado <> 1 and Products.qty_competitors_available > 0";
$resultado_pbmtotalds1 = mysqli_query($conn,$selectpbmtotalds);
$resultado_pbmtotalds = mysqli_fetch_array($resultado_pbmtotalds1)[0];

$selectpbmtotaldsa = "SELECT avg(Products.diff_current_pay_only_lowest) FROM pbm inner join Products on Products.sku=pbm.sku where Products.curve='A' and
 Products.active=1  and Products.descontinuado <> 1 and Products.qty_competitors_available > 0";
$resultado_pbmtotaldsa1 = mysqli_query($conn,$selectpbmtotaldsa);
$resultado_pbmtotaldsa = mysqli_fetch_array($resultado_pbmtotaldsa1)[0];

$selectpbmtotaldsb = "SELECT avg(Products.diff_current_pay_only_lowest) FROM pbm inner join Products on Products.sku=pbm.sku where Products.curve='B' and
 Products.active=1  and Products.descontinuado <> 1 and Products.qty_competitors_available > 0";
$resultado_pbmtotaldsb1 = mysqli_query($conn,$selectpbmtotaldsb);
$resultado_pbmtotaldsb = mysqli_fetch_array($resultado_pbmtotaldsb1)[0];

$selectpbmtotaldsc = "SELECT avg(Products.diff_current_pay_only_lowest) FROM pbm inner join Products on Products.sku=pbm.sku where Products.curve='C' and
 Products.active=1  and Products.descontinuado <> 1 and Products.qty_competitors_available > 0";
$resultado_pbmtotaldsc1 = mysqli_query($conn,$selectpbmtotaldsc);
$resultado_pbmtotaldsc = mysqli_fetch_array($resultado_pbmtotaldsc1)[0];



?>

<br>
<div class="container">
  <div class="row">
    <div class="col-sm">
   
     <p> <b>PBM's Ativos</b> - <?php echo $resultado_pbmactive; ?></p>
<p> <b>PBM's Inativos</b> - <?php echo $resultado_pbminactive; ?></p>
   <p> <b>PBM's Vendas Ativos</b> - <?php echo $resultado_pbmsellactive; ?></p>
   <p> <b>PBM's Vendas Inativos</b> - <?php echo $resultado_pbmsellinactive; ?></p>
 </div>
    <div class="col-sm">
   <p>   <b>Margem de OP. </b> ( <?php $resultado_pbmtotalmp=($resultado_pbmtotalmp * 100); echo  number_format($resultado_pbmtotalmp, 2, ',', '.') . '%';?>)
   </p>
   <p>   <b>Curva A </b> ( <?php $resultado_pbmtotalmpa=($resultado_pbmtotalmpa * 100); echo  number_format($resultado_pbmtotalmpa, 2, ',', '.') . '%';?>)
   </p>
   <p>   <b>Curva B </b> ( <?php $resultado_pbmtotalmpb=($resultado_pbmtotalmpb * 100); echo  number_format($resultado_pbmtotalmpb, 2, ',', '.') . '%';?>)
   </p>
   <p>   <b>Curva C </b> ( <?php $resultado_pbmtotalmpc=($resultado_pbmtotalmpc * 100); echo  number_format($resultado_pbmtotalmpc, 2, ',', '.') . '%';?>)
   </p>
    
    </div>

    <div class="col-sm">
    
   <p>   <b>Discrepância </b> ( <?php $resultado_pbmtotalds=($resultado_pbmtotalds * 100); echo  number_format($resultado_pbmtotalds, 2, ',', '.') . '%';?>)</p>
   <p>   <b>Curva A </b>( <?php $resultado_pbmtotaldsa=($resultado_pbmtotaldsa * 100); echo  number_format($resultado_pbmtotaldsa, 2, ',', '.') . '%';?>)</p>
   <p>   <b>Curva B </b>( <?php $resultado_pbmtotaldsb=($resultado_pbmtotaldsb * 100); echo  number_format($resultado_pbmtotaldsb, 2, ',', '.') . '%';?>)</p>
   <p>   <b>Curva C </b>( <?php $resultado_pbmtotaldsc=($resultado_pbmtotaldsc * 100); echo  number_format($resultado_pbmtotaldsc, 2, ',', '.') . '%';?>)</p>
    
    </div>
  </div>
</div>

<br>
<div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportxlspbm.php'>Exportar</a></button> <button type="button" class="btn btn-outline-success">
<a href='importpbm.php'>Importar</a></button></div><br><br><div class="dropdown-divider"></div>
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
<th>VAN</th>
<th>PROGRAMA</th>
<th>ATIVO</th>
<th>VENDA</th>


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
<th>VAN</th>
<th>PROGRAMA</th>
<th>ATIVO</th>
<th>VENDA</th>                    </tr>
                  </tfoot>
                  <tbody>

<?php
 
$consultatotalpbm = "SELECT pbm.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only, Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest, Products.curve, Products.marca, Products.qty_stock_rms, pbm.nome_da_van, pbm.programa, pbm.active, sum(vendas.qtd) from pbm INNER JOIN Products ON pbm.sku=Products.sku inner join vendas on vendas.sku=pbm.sku group by vendas.sku ";
$res_datapbmt = mysqli_query($conn,$consultatotalpbm);
        while($rowterm = mysqli_fetch_array($res_datapbmt)){
     
                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowterm[0].'>'.$rowterm[0].'</a></td>';
                    echo  '<td>'. $rowterm[1].'</td>';
 echo  '<td>'. $rowterm[2].'</td>';
 echo  '<td>'. $rowterm[3].'</td>';
 echo  '<td>'.$rowterm[4].'</td>';
echo  '<td>'.$rowterm[5].'</td>';
echo  '<td>'.$rowterm[6].'</td>';
echo  '<td>'.$rowterm[7].'</td>';
echo  '<td>'.$rowterm[8].'</td>';
echo  '<td>'.round((float)$rowterm[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowterm[10] * 100).'%</td>';
echo  '<td>'.$rowterm[11].'</td>';
echo  "<td>". number_format($rowterm[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowterm[12].'</td>';
echo  '<td>'.$rowterm[14].'</td>';
echo  '<td>'.$rowterm[15].'</td>';
echo  '<td>'.$rowterm[16].'</td>';
echo  '<td>'.$rowterm[17].'</td>';
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







<!-- OTC Modal-->

  <div class="modal fade" id="otcmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos OTC</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportotcxls.php'>Exportar</a></button></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
        <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
<th>ESTOQUE</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>
                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>VENDAS</th>

                    </tr>


                    </tr>
                  </thead>
                  <tfoot class="thead-dark">

  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
<th>ESTOQUE</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>
                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>VENDAS</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php
 
$consultatotalotc = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.qty_stock_rms, Products.price_cost,
 Products.sale_price, Products.current_price_pay_only, Products.current_less_price_around,
Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest, Products.curve,sum(vendas.qtd) from Products
inner join vendas on vendas.sku=Products.sku where Products.otc = 1 and active=1 and descontinuado<>1 group by vendas.sku ";
$res_dataotct = mysqli_query($conn,$consultatotalotc);
        while($rowotc = mysqli_fetch_array($res_dataotct)){

                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowotc[0].'>'.$rowotc[0].'</a></td>';
                    echo  '<td>'. $rowotc[1].'</td>';
 echo  '<td>'. $rowotc[2].'</td>';
 echo  '<td>'. $rowotc[3].'</td>';
 echo  '<td>'.$rowotc[4].'</td>';
echo  '<td>'.$rowotc[5].'</td>';
echo  '<td>'.$rowotc[6].'</td>';
echo  '<td>'.$rowotc[7].'</td>';
echo  '<td>'.$rowotc[8].'</td>';
echo  '<td>'.$rowotc[9].'</td>';
echo  '<td>'.round((float)$rowotc[10] * 100).'%</td>';
echo  '<td>'.round((float)$rowotc[11] * 100).'%</td>';

echo  '<td>'.$rowotc[12].'</td>';
echo  '<td>'.$rowotc[13].'</td>';
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





<!-- Descontinuado Modal-->

  <div class="modal fade" id="descontinuadomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Descontinuados</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportdescontinuadosxls.php'>Exportar</a></button></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
        <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
<th>ESTOQUE</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>
                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>

<th>SITUAÇÃO</th>
                    </tr>


                    </tr>
                  </thead>
                  <tfoot class="thead-dark">

  <tr>
                                        <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
<th>ESTOQUE</th>
                      <th>CUSTO</th>

                      <th>VALOR VENDA</th>
                      <th>PAGUE APENAS</th>
<th>MENOR PRECO</th>
                      <th>CONCORRENTE</th>
<th>MARGEM OP.</th>
<th>DIF. MENOR PRECO</th>

                      <th>CURVA</th>
<th>SITUACAO</th>
                    </tr>
                  </tfoot>
                  <tbody>
<?php
 
$consultatotaldesc = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.qty_stock_rms, Products.price_cost, Products.sale_price,
 Products.current_price_pay_only, Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent,
 Products.diff_current_pay_only_lowest, Products.curve, descontinuado.situation from Products INNER JOIN descontinuado on descontinuado.sku = Products.sku where Products.descontinuado=1";
$res_datadesct = mysqli_query($conn,$consultatotaldesc);
        while($rowdesc = mysqli_fetch_array($res_datadesct)){

                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowdesc[0].'>'.$rowdesc[0].'</a></td>';
                    echo  '<td>'. $rowdesc[1].'</td>';
 echo  '<td>'. $rowdesc[2].'</td>';
 echo  '<td>'. $rowdesc[3].'</td>';
 echo  '<td>'.$rowdesc[4].'</td>';
echo  '<td>'.$rowdesc[5].'</td>';
echo  '<td>'.$rowdesc[6].'</td>';
echo  '<td>'.$rowdesc[7].'</td>';
echo  '<td>'.$rowdesc[8].'</td>';
echo  '<td>'.$rowdesc[9].'</td>';
echo  '<td>'.round((float)$rowdesc[10] * 100).'%</td>';
echo  '<td>'.round((float)$rowdesc[11] * 100).'%</td>';

echo  '<td>'.$rowdesc[12].'</td>';
echo '<td>'.$rowdesc[13].'</td>';

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











<!-- HOME Modal-->

  <div class="modal fade" id="homemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Home</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
	<div class="modal-body"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/promo_home.php'>Exportar</a></button></div><br><br><div class="dropdown-divider"></div>
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
<th>VAN</th>
<th>Programa</th>
<th>Ativo</th>


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
<th>VAN</th>
<th>Programa</th>
<th>Ativo</th>
                    </tr>
                  </tfoot>
                  <tbody>

<?php
$consultatotalpromo = "SELECT promo.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only,
 Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest,
 Products.curve, Products.current_cashback, Products.qty_stock_rms, Products.tabulated_price, promo.nome, promo.descr from promo INNER JOIN Products ON promo.sku = Products.sku where promo.home=1";
$res_datapromo = mysqli_query($conn,$consultatotalpromo);
        while($rowhm = mysqli_fetch_array($res_datapromo)){

                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowhm[0].'>'.$rowhm[0].'</a></td>';
                    echo  '<td>'. $rowhm[1].'</td>';
 echo  '<td>'. $rowhm[2].'</td>';
 echo  '<td>'. $rowhm[3].'</td>';
 echo  '<td>'.$rowhm[4].'</td>';
echo  '<td>'.$rowhm[5].'</td>';
echo  '<td>'.$rowhm[6].'</td>';
echo  '<td>'.$rowhm[7].'</td>';
echo  '<td>'.$rowhm[8].'</td>';
echo  '<td>'.round((float)$rowhm[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowhm[10] * 100).'%</td>';
echo  '<td>'.$rowhm[11].'</td>';
echo  "<td>". number_format($rowhm[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowhm[12].'</td>';
echo  '<td>'.$rowhm[14].'</td>';
echo  '<td>'.$rowhm[15].'</td>';
echo  '<td>'.$rowhm[16].'</td>';
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






   









<!-- Promo Modal-->

  <div class="modal fade" id="promomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Promoção</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
<?php

$updatapromo = "SELECT update_time FROM Products limit 1";
$resultado_updatepromo = mysqli_query($conn,$updatapromo);
$updata_promo = mysqli_fetch_array($resultado_updatepromo)[0];

$selectpromo = "SELECT nome, COUNT(id) 
FROM promo where active=1
GROUP BY nome;";
$resultado_selectpromo = mysqli_query($conn,$selectpromo);


$selectpromo24hs = "SELECT sku, nome, inicio, validade, local 
FROM promo where active=1 and relampago=1";
$resultado_selectpromo24hs = mysqli_query($conn,$selectpromo24hs);

$selectpromo24hsi = "SELECT sku, inicio, validade,nome,  local 
FROM promo where active=1 and relampago=1";
$resultado_selectpromo24hsi = mysqli_query($conn,$selectpromo24hsi);

?>


<div class="container">
  <div class="row">
    <div class="col-sm">
     
    </div>
    <div class="col-sm">
     
    </div>

  </div>
</div>


<div>Atualizado : <?php echo $updata_promo; ?>
<br>
<br>
<div class="card shadow mb-4">
  <div class="row">
    
    <div class="card-body">

                                    <h6 class="m-0 font-weight-bold text-primary">Promoções Ativas</h6>
<br>
<?php 

while($rowsp = mysqli_fetch_array($resultado_selectpromo)){

echo "<b>" .$rowsp[0]. "</b>";
echo " - ";
echo $rowsp[1];
echo " SKU's";
echo "<br>";
}
?>
</div>
     
    <div class="card-body">
     
                                    



    </div>
<style>
.tableFixHead          { overflow-y: auto; height: 100px; }
.tableFixHead thead th { position: sticky; top: 0; }
</style>    
<div class="card-body">

                                    <h6 class="m-0 font-weight-bold text-primary">Promoções 24hs</h6>   
<br>

  <table style="width:100%">
    <thead>
      <tr><th style="text-align:center">SKU</th><th style="text-align:center">Inicio</th><th style="text-align:center">Validade</th></tr>
   
 </thead>
</table>
<div class="tableFixHead">
  <table style="width:100%">
    <tbody>
      
  

<?php 

while($rowsp24i = mysqli_fetch_array($resultado_selectpromo24hsi)){

echo "<tr><td><a target=_blank href=https://www.qualidoc.com.br/cadastro/product/".$rowsp24i[0].">".$rowsp24i[0]."</a></td><td>| ".$rowsp24i[1]."</td><td>| ".$rowsp24i[2]."</td></tr>";


}
?>

    </tbody>
  </table>
</div>


       
    </div>
  </div>
</div>


</div>
<div class="float-right"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/promoxls.php'>Exportar</a></button><button type="button" class="btn btn-outline-success" id='importa_promo'>
<a href='promo.php'>Importar</a></button></div></div><br><br><div class="dropdown-divider"></div>
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
<th>TABELADO</th>
<th>PROMO</th>
<th>DESC.</th>

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
<th>TABELADO</th>
<th>PROMO</th>
<th>DESC</th>              
      </tr>
                  </tfoot>
                  <tbody>

<?php


$consultatotalpromo = "SELECT promo.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only,
 Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest,
 Products.curve, Products.current_cashback, Products.qty_stock_rms, Products.tabulated_price, promo.nome, promo.descr from promo INNER JOIN Products ON promo.sku = Products.sku where promo.active=1";
$res_datapromo = mysqli_query($conn,$consultatotalpromo);
        while($rowtp = mysqli_fetch_array($res_datapromo)){

                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowtp[0].'>'.$rowtp[0].'</a></td>';
                    echo  '<td>'. $rowtp[1].'</td>';
 echo  '<td>'. $rowtp[2].'</td>';
 echo  '<td>'. $rowtp[3].'</td>';
 echo  '<td>'.$rowtp[4].'</td>';
echo  '<td>'.$rowtp[5].'</td>';
echo  '<td>'.$rowtp[6].'</td>';
echo  '<td>'.$rowtp[7].'</td>';
echo  '<td>'.$rowtp[8].'</td>';
echo  '<td>'.round((float)$rowtp[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowtp[10] * 100).'%</td>';
echo  '<td>'.$rowtp[11].'</td>';
echo  "<td>". number_format($rowtp[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowtp[12].'</td>';
echo  '<td>'.$rowtp[14].'</td>';
echo  '<td>'.$rowtp[15].'</td>';
echo  '<td>'.$rowtp[16].'</td>';


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

<th>CASHBACK</th>
<th>TABELADO</th>
                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalcashback = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around,
 lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, current_cashback, qty_stock_rms,
 tabulated_price from Products where active='1' and current_cashback>'0' and pbm <> $pbma and descontinuado<>1";
$res_datacashbackt = mysqli_query($conn,$consultatotalcashback);
        while($rowterm = mysqli_fetch_array($res_datacashbackt)){
     
                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowterm[0].'>'.$rowterm[0].'</a></td>';
                    echo  '<td>'. $rowterm[1].'</td>';
 echo  '<td>'. $rowterm[2].'</td>';
 echo  '<td>'. $rowterm[3].'</td>';
 echo  '<td>'.$rowterm[4].'</td>';
echo  '<td>'.$rowterm[5].'</td>';
echo  '<td>'.$rowterm[6].'</td>';
echo  '<td>'.$rowterm[7].'</td>';
echo  '<td>'.$rowterm[8].'</td>';
echo  '<td>'.round((float)$rowterm[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowterm[10] * 100).'%</td>';
echo  '<td>'.$rowterm[11].'</td>';
echo  "<td>". number_format($rowterm[13], 0, ',', '.') ."</td>";
echo  '<td>'.$rowterm[12].'</td>';
echo  '<td>'.$rowterm[14].'</td>';

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









<!-- Principio_Ativo Modal-->

  <div class="modal fade" id="principioativomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Principio Ativo</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="float-right"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/principio_ativoxls.php'>Exportar</a></button></div></div><br><br><div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="principioativo" width="100%" cellspacing="0">

                  <thead class="thead-dark">
                    <tr>
                      
        <th>SKU</th>
<th>EAN</th>
                      <th>NOME</th>
                      <th>PRINCIPIO ATIVO</th>

                      
                      <th>MARCA</th>

                      <th>VENDA</th>
                      <th>MARGEM</th>
<th>DISCREPÂNCIA</th>



                                         </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>

        <th>SKU</th>
<th>EAN</th>
                      <th>NOME</th>
                      <th>PRINCIPIO ATIVO</th>

                     
                      <th>MARCA</th>

                      <th>VENDA</th>
                      <th>MARGEM</th>
<th>DISCREPÂNCIA</th>



                     

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalprincipio = "SELECT principio_ativo.sku, Products.reference_code, Products.title, principio_ativo.uniao,
marca.marca, sum(vendas.qtd), Products.current_gross_margin_percent,
Products.diff_current_pay_only_lowest
FROM principio_ativo inner join marca on marca.sku = principio_ativo.sku inner join Products on Products.sku=principio_ativo.sku inner join vendas
on vendas.sku=principio_ativo.sku
WHERE principio_ativo.principio_ativo <> '' and Products.active=1 and Products.descontinuado<>1 and Products.category='GENERICO' or Products.category='SIMILAR'
 and principio_ativo.uniao IN (
    SELECT uniao
    FROM principio_ativo
    GROUP BY uniao
    HAVING COUNT(uniao) > 1
)group by vendas.sku order by principio_ativo.uniao desc";
$res_dataprincipio = mysqli_query($conn,$consultatotalprincipio);
        while($rowpri = mysqli_fetch_array($res_dataprincipio)){
     
                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowpri[0].'>'.$rowpri[0].'</a></td>';
                    echo  '<td>'. $rowpri[1].'</td>';
 echo  '<td>'. $rowpri[2].'</td>';
 echo  '<td>'. $rowpri[3].'</td>';
 echo  '<td>'. $rowpri[4].'</td>';

 echo  '<td>'.$rowpri[5].'</td>';
echo  '<td>'.round((float)$rowpri[6] * 100).'%</td>';
echo  '<td>'.round((float)$rowpri[7] * 100).'%</td>';

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












<!-- Termolabil Modal-->

  <div class="modal fade" id="termomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Termolábeis</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><div class="float-right"><div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/termoxls.php'>Exportar</a></button></div></div><br><br><div class="dropdown-divider"></div>
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


<th>VENDAS</th>
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


<th>VENDAS</th>
                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotaltermo = "SELECT termolabo.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price,
 Products.current_price_pay_only, Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent,
 Products.diff_current_pay_only_lowest, Products.curve, Products.qty_stock_rms, sum(vendas.qtd)
 from termolabo inner join Products on Products.sku = termolabo.sku inner join vendas on vendas.sku=termolabo.sku group by sku";
$res_datatermo = mysqli_query($conn,$consultatotaltermo);
        while($rowterm = mysqli_fetch_array($res_datatermo)){
     
                echo    '<tr>';
                echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowterm[0].'>'.$rowterm[0].'</a></td>';
                    echo  '<td>'. $rowterm[1].'</td>';
 echo  '<td>'. $rowterm[2].'</td>';
 echo  '<td>'. $rowterm[3].'</td>';
 echo  '<td>'.$rowterm[4].'</td>';
echo  '<td>'.$rowterm[5].'</td>';
echo  '<td>'.$rowterm[6].'</td>';
echo  '<td>'.$rowterm[7].'</td>';
echo  '<td>'.$rowterm[8].'</td>';
echo  '<td>'.round((float)$rowterm[9] * 100).'%</td>';
echo  '<td>'.round((float)$rowterm[10] * 100).'%</td>';
echo  '<td>'.$rowterm[11].'</td>';
echo  "<td>". number_format($rowterm[12], 0, ',', '.') ."</td>";
echo  '<td>'.$rowterm[13].'</td>';



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







<!-- marcas Modal-->

  <div class="modal fade" id="marcasmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Marcas</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"></div><br><br><div class="dropdown-divider"></div>


<div class="container">
  <div class="row">
    <div class="col-sm">
      <div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/marcasxls.php'>Exportar</a></button></div>
<br><br>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">

                  <thead class="thead-dark">
                    <tr>
                      
              <th>QTD. SKU</th>
                      <th>MARCA</th>
                      <th>MARGEM OP.</th>

                      <th>DISCREPÂNCIA</th>
                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                                        <th>QTD. SKU</th>
                      <th>MARCA</th>
                      <th>MARGEM OP.</th>

                      <th>DISCREPÂNCIA</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
 

$consultatotalmarca = "Select count(Products.sku), marca.marca, avg(Products.current_gross_margin_percent),
 avg(Products.diff_current_pay_only_lowest)
  from Products inner join marca on marca.sku=Products.sku where Products.active=1 and
 Products.descontinuado<>1 group by marca.marca order by marca.marca DESC";
$res_datamarca = mysqli_query($conn,$consultatotalmarca);
        while($rowmarca = mysqli_fetch_array($res_datamarca)){
     
                echo    '<tr>';
                    echo  '<td>'. $rowmarca[0].'</td>';
 echo  '<td>'. $rowmarca[1].'</td>';
echo  '<td>'.round((float)$rowmarca[2] * 100).'%</td>';
echo  '<td>'.round((float)$rowmarca[3] * 100).'%</td>';


echo '</tr>';

}

 

?>               



                  </tbody>
                </table></div>


 <div class="col-sm">
      

      <div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/marcavendasxls.php'>Exportar</a></button></div>
<br><br>

<table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">

                  <thead class="thead-dark">
                    <tr>

                      <th>MARCA</th>

                      <th>VENDAS</th>
<th>#</th>
                    </tr>
                  </thead>
                  <tfoot class="thead-dark">

  <tr>
                                        <th>MARCA</th>

                      <th>VENDAS</th>
<th>#</th>
                    </tr>
                  </tfoot>
                  <tbody>

<?php
 

$consultatotalmarcav = "Select marca.marca, sum(vendas.qtd) from marca inner join vendas on vendas.sku=marca.sku inner join Products on
Products.sku=marca.sku where Products.active=1 and
 Products.descontinuado<>1 group by marca.marca order by marca.marca DESC";
$res_datamarcav = mysqli_query($conn,$consultatotalmarcav);
        while($rowmarcav = mysqli_fetch_array($res_datamarcav)){

                echo    '<tr>';
                    echo  '<td>'. $rowmarcav[0].'</td>';
echo  '<td>'. $rowmarcav[1].'</td>';
echo  '<td>Venda Acumulada</td>';

 echo    '</tr>';

}
?>
   </tbody>
                </table>


    </div>
  </div>
</div>
</div>      
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
          <h5 class="modal-title" id="exampleModalLabel1">Produtos Controlados</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
<div class="btn-group btn-group-toggle" data-toggle="buttons">
<button type="button" class="btn btn-outline-success">
<a href='relatorio/exportcontrolado.php'>Exportar</a></button></div><br><br><div class="dropdown-divider"></div>

<div class="dropdown-divider"></div>
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
<th>CASHBACK</th>
<th>VENDAS</th>

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
<th>CASHBACK</th>
<th>VENDAS</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotaltabelado = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.price_cost, 
Products.sale_price, Products.current_price_pay_only,
 Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent,
 Products.diff_current_pay_only_lowest, Products.curve, Products.tabulated_price, Products.qty_stock_rms, Products.current_cashback, sum(vendas.qtd)
 from Products inner join vendas on vendas.sku=Products.sku where Products.active='1' 
 and controlled_substance = 1 and Products.pbm <> $pbma group by vendas.sku";
$res_datatabelado = mysqli_query($conn,$consultatotaltabelado);
        while($rowta = mysqli_fetch_array($res_datatabelado)){
     
                echo    '<tr>';
                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowta[0].'>'.$rowta[0].'</a></td>';;
                    echo  '<td>'. $rowta[1].'</td>';
 echo  '<td>'. $rowta[2].'</td>';
 echo  '<td>'. $rowta[3].'</td>';
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
echo  '<td>'.$rowta[14].'</td>';
echo  '<td>'.$rowta[15].'</td>';

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
  

$consultatotalprodutosexclusivo = "SELECT sku, title, department, category, price_cost, sale_price, current_price_pay_only, current_less_price_around, lowest_price_competitor, current_gross_margin_percent, diff_current_pay_only_lowest, curve, situation_code_fk,qty_stock_rms from Products where active='1' and qty_stock_rms > '0' and qty_competitors='0' and pbm <> $pbma";
$res_datatotalexclusivo = mysqli_query($conn,$consultatotalprodutosexclusivo);
        while($rowe = mysqli_fetch_array($res_datatotalexclusivo)){
     
                echo    '<tr>';
                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$rowe[0].'>'.$rowe[0].'</a></td>';
                    echo  '<td>'. $rowe[1].'</td>';
 echo  '<td>'. $rowe[2].'</td>';
 echo  '<td>'. $rowe[3].'</td>';
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







<!-- Modal -->
<!-- myModal -->
<div id="drogaraiamodal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#DROGARAIA" role="tab" aria-controls="DROGARAIA">DROGARAIA</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#DROGASIL" role="tab" aria-controls="profile">DROGASIL</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#ONOFRE" role="tab" aria-controls="messages">ONOFRE</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#ULTRAFARMA" role="tab" aria-controls="settings">ULTRAFARMA</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#DROGARIASP" role="tab" aria-controls="settings">DROGARIASP</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#PAGUEMENOS" role="tab" aria-controls="settings">PAGUEMENOS</a>
  </li>
</ul>

<div class="tab-content">


<!----------DROGARAIA-------------->



  <div class="tab-pane active" id="DROGARAIA" role="tabpanel">  

<div class="container">
<br>
  <div class="row">
    <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Quantidade de Produtos Por Curva
                </div>
<div class="chart-pie pt-4 pb-2">
<canvas id="RaiachDonut"></canvas>
                  </div>  <div class="mt-4 text-center small">
                    <span class="mr-2">
                     <h4 class="small font-weight-bold">  <i class="fas fa-circle text-primary"></i> CURVA A - <?php echo $total_drogaraia_a;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> CURVA B - <?php echo $total_drogaraia_b;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-dark"></i> CURVA C - <?php echo $total_drogaraia_c;?>
                    </span>
<span class="mr-2">
                      <i class="fas fa-circle text-info"></i> OUTROS - <?php echo $total_drogaraia_d;?></h4>
                    </span>
                  </div>

    </div></div>
    <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Produtos Mais Vendidos
                </div>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr>
    <td>
       <table cellspacing="0" cellpadding="1" border="1" width="100%" >
         <tr style="color:white;background-color:grey">
           
         </tr>
       </table>
    </td>
  </tr>
  <tr>
    <td>
       <div style="width:100%; height:350px; overflow:auto;">
         <table cellspacing="0" cellpadding="0" class="table table-sm">
          <tr><th>COD</th><th>EAN</th><th>TITULO</th><th>VALOR</th><th>VALORP</th>

<?php                   
$consultadrogaraiamv = "SELECT cod, ean, titulo, valor, valor_p from drogaraia_products where mv=1";
$res_datadrogaraiamv = mysqli_query($conn,$consultadrogaraiamv);


        while($row = mysqli_fetch_array($res_datadrogaraiamv)){  

echo '<tr>';


  echo'<td>'. $row[0];
echo'<td>'. $row[1];
echo'<td>'. $row[2];
echo'<td>'. $row[3];
echo'<td>'. $row[4];

echo '</tr>';  

}
?>               
                        </table>  
       </div>
    </td>
  </tr>
</table>

    </div></div>

  </div>
</div>




                       <div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                      <th>COD. DROGARAIA</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>
                      <th>VALORP</th>
                      <th>CURVA</th>

<th>STATUS</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                      
                      <th>COD. DROGARAIA</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>
                      <th>VALORP</th>
                      <th>CURVA</th>
<th>STATUS</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultadrogaraia = "SELECT cod, ean, titulo, marca, fabricante, quantidade, dosagem, valor, valor_p, curva from drogaraia_products WHERE sku_quali = ''";
$res_dataraia = mysqli_query($conn,$consultadrogaraia);


        while($row = mysqli_fetch_array($res_dataraia)){                 
                echo    '<tr>';
                    echo  '<td>'.$row[0].'</td>';
                    echo  '<td>'.$row[1].'</td>';
 echo  '<td>'.$row[2].'</td>';
 echo  '<td>'.$row[3].'</td>';
 echo  '<td>'.$row[4].'</td>';
echo  '<td>'.$row[5].'</td>';
echo  '<td>'.$row[6].'</td>';


echo  '<td>'.$row[7].'</td>';


echo  '<td>'.$row[8].'</td>';

echo '<td>'.$row[9].'</td>';
   if ($row[7]=='' and $row[8]==''){ 

$stock='Indisponivel';
}else{
$stock='Ativo';

}
echo '<td>'.$stock.'</td>';
     echo              ' </tr>';
 
isset($stock);
}
?>               
                  </tbody>
                </table>

</div>


<!----------DROGASIL-------------->

  <div class="tab-pane" id="DROGASIL" role="tabpanel">

<div class="container">
<br>
  <div class="row">
    <div class="col-sm">

<div class="card mb-4">

               <div class="card-header">
                 Quantidade de Produtos Por Curva
                </div>
<div class="chart-pie pt-4 pb-2">
<canvas id="SilchDonut"></canvas>
                  </div>  <div class="mt-4 text-center small">
                    <span class="mr-2">
                     <h4 class="small font-weight-bold">  <i class="fas fa-circle text-primary"></i> CURVA A - <?php echo $total_drogasil_a;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> CURVA B - <?php echo $total_drogasil_b;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-dark"></i> CURVA C - <?php echo $total_drogasil_c;?>
                    </span>
<span class="mr-2">
                      <i class="fas fa-circle text-info"></i> OUTROS - <?php echo $total_drogasil_d;?></h4>
                    </span>
                  </div>


    </div></div>
      <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Produtos Mais Vendidos
                </div>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr>
    <td>
       <table cellspacing="0" cellpadding="1" border="1" width="100%" >
         <tr style="color:white;background-color:grey">
           
         </tr>
       </table>
    </td>
  </tr>
  <tr>
    <td>
       <div style="width:100%; height:350px; overflow:auto;">
         <table cellspacing="0" cellpadding="0" class="table table-sm">
          <tr><th>COD</th><th>EAN</th><th>TITULO</th><th>VALOR</th><th>VALORP</th>

<?php                   
$consultadrogasilmv = "SELECT cod, ean, titulo, valor from drogasil_products where mv=1";
$res_datadrogasilmv = mysqli_query($conn,$consultadrogasilmv);


        while($row = mysqli_fetch_array($res_datadrogasilmv)){  

echo '<tr>';


  echo'<td>'. $row[0].'</td>';
echo'<td>'. $row[1].'</td>';
echo'<td>'. $row[2].'</td>';
echo'<td>'. $row[3].'</td>';


echo '</tr>';  

}
?>               
                        </table>  
       </div>
    </td>
  </tr>
</table>

    </div></div>

  </div>
</div>


                       <div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                      <th>COD. DROGASIL</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>

                      <th>CURVA</th>

<th>STATUS</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                      
                      <th>COD. DROGASIL</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>

                      <th>CURVA</th>
<th>STATUS</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultadrogasil = "SELECT cod, ean, titulo, marca, fabricante, quantidade, dosagem, valor curva from drogasil_products WHERE sku_quali = ''";
$res_datasil = mysqli_query($conn,$consultadrogasil);


        while($row = mysqli_fetch_array($res_datasil)){                 
                echo    '<tr>';
                    echo  '<td>'.$row[0].'</td>';
                    echo  '<td>'.$row[1].'</td>';
 echo  '<td>'.$row[2].'</td>';
 echo  '<td>'.$row[3].'</td>';
 echo  '<td>'.$row[4].'</td>';
echo  '<td>'.$row[5].'</td>';
echo  '<td>'.$row[6].'</td>';

echo  '<td>'.$row[7].'</td>';



echo '<td>'.$row[9].'</td>';
   if ($row[7]=='' and $row[8]==''){ 

$stock='Indisponivel';
}else{
$stock='Ativo';

}
echo '<td>'.$stock.'</td>';
     echo              ' </tr>';
 
isset($stock);
}
?>               
                  </tbody>
                </table>

</div>


<!----------ONOFRE-------------->


  <div class="tab-pane" id="ONOFRE" role="tabpanel"><div class="container">
<br>
  <div class="row">
    <div class="col-sm">

<div class="card mb-4">

                 <div class="card-header">
                 Quantidade de Produtos Por Curva
                </div>
<div class="chart-pie pt-4 pb-2">
<canvas id="OnofrechDonut"></canvas>
                  </div>  <div class="mt-4 text-center small">
                    <span class="mr-2">
                     <h4 class="small font-weight-bold">  <i class="fas fa-circle text-primary"></i> CURVA A - <?php echo $total_onofre_a;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> CURVA B - <?php echo $total_onofre_b;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-dark"></i> CURVA C - <?php echo $total_onofre_c;?>
                    </span>
<span class="mr-2">
                      <i class="fas fa-circle text-info"></i> OUTROS - <?php echo $total_onofre_d;?></h4>
                    </span>
                  </div>
    </div></div>
<div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Produtos Mais Vendidos
                </div>

<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr>
    <td>
       <table cellspacing="0" cellpadding="1" border="1" width="100%" >
         <tr style="color:white;background-color:grey">
           
         </tr>
       </table>
    </td>
  </tr>
  <tr>
    <td>
       <div style="width:100%; height:350px; overflow:auto;">
         <table cellspacing="0" cellpadding="0" class="table table-sm">
          <tr><th>COD</th><th>EAN</th><th>TITULO</th><th>VALOR</th><th>VALORP</th>

<?php                   
$consultaonofremv = "SELECT cod, ean, titulo, valor from onofre_products where mv=1";
$res_dataonofremv = mysqli_query($conn,$consultaonofremv);


        while($row = mysqli_fetch_array($res_dataonofremv)){  

echo '<tr>';


  echo'<td>'. $row[0].'</td>';
echo'<td>'. $row[1].'</td>';
echo'<td>'. $row[2].'</td>';
echo'<td>'. $row[3].'</td>';


echo '</tr>';  

}
?>               
                        </table>  
       </div>
    </td>
  </tr>
</table>

    </div></div>

  </div>
</div>



                       <div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                      <th>COD. ONOFRE</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>

                      <th>CURVA</th>

<th>STATUS</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                      
                      <th>COD. ONOFRE</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>

                      <th>CURVA</th>
<th>STATUS</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultaonofre = "SELECT cod, ean, titulo, marca, fabricante, quantidade, dosagem, valor,  curva from onofre_products WHERE sku_quali = ''";
$res_dataonofre = mysqli_query($conn,$consultaonofre);


        while($row = mysqli_fetch_array($res_dataonofre)){                 
                echo    '<tr>';
                    echo  '<td>'.$row[0].'</td>';
                    echo  '<td>'.$row[1].'</td>';
 echo  '<td>'.$row[2].'</td>';
 echo  '<td>'.$row[3].'</td>';
 echo  '<td>'.$row[4].'</td>';
echo  '<td>'.$row[5].'</td>';
echo  '<td>'.$row[6].'</td>';

echo  '<td>'.$row[7].'</td>';



echo '<td>'.$row[9].'</td>';
   if ($row[7]=='' and $row[8]==''){ 

$stock='Indisponivel';
}else{
$stock='Ativo';

}
echo '<td>'.$stock.'</td>';
     echo              ' </tr>';
 
isset($stock);
}
?>               
                  </tbody>
                </table></div>



<!----------ULTRAFARMA-------------->


  <div class="tab-pane" id="ULTRAFARMA" role="tabpanel"><div class="container">
<br>
  <div class="row">
    <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Quantidade de Produtos Por Curva
                </div>
<div class="chart-pie pt-4 pb-2">
<canvas id="UltrafarmachDonut"></canvas>
                  </div>  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> CURVA A - 1.555
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> CURVA B - 2999
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> CURVA C - 444
                    </span>
<span class="mr-2">
                      <i class="fas fa-circle text-info"></i> MARCA PROPRIA - 444
                    </span>
                  </div>

    </div></div>
      <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Produtos Mais Vendidos
                </div>

    </div></div>

  </div>
</div>


                       <div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                      <th>COD. ULTRAFARMA</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>
<th>VALORP</th>

                      <th>CURVA</th>

<th>STATUS</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                      
                      <th>COD. ULTRAFARMA</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>
<th>VALORP</th>

                      <th>CURVA</th>
<th>STATUS</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultaultrafarma = "SELECT cod, ean, titulo, marca, fabricante, quantidade, dosagem, valor, valor_p, curva from ultrafarma_products WHERE sku_quali = ''";
$res_dataultrafarma = mysqli_query($conn,$consultaultrafarma);


        while($row = mysqli_fetch_array($res_dataultrafarma)){                 
                echo    '<tr>';
                    echo  '<td>'.$row[0].'</td>';
                    echo  '<td>'.$row[1].'</td>';
 echo  '<td>'.$row[2].'</td>';
 echo  '<td>'.$row[3].'</td>';
 echo  '<td>'.$row[4].'</td>';
echo  '<td>'.$row[5].'</td>';
echo  '<td>'.$row[6].'</td>';

echo  '<td>'.$row[8].'</td>';

echo  '<td>'.$row[7].'</td>';

echo '<td>'.$row[9].'</td>';
   if ($row[7]=='' and $row[8]==''){ 

$stock='Indisponivel';
}else{
$stock='Ativo';

}
echo '<td>'.$stock.'</td>';
     echo              ' </tr>';
 
isset($stock);
}
?>               
                  </tbody>
                </table></div>


<!----------DROGARIASP-------------->

<div class="tab-pane" id="DROGARIASP" role="tabpanel"><div class="container">
<br>
  <div class="row">
    <div class="col-sm">

<div class="card mb-4">

               <div class="card-header">
                 Quantidade de Produtos Por Curva
                </div>
<div class="chart-pie pt-4 pb-2">
<canvas id="DspchDonut"></canvas>
                  </div>  <div class="mt-4 text-center small">
                    <span class="mr-2">
                     <h4 class="small font-weight-bold">  <i class="fas fa-circle text-primary"></i> CURVA A - <?php echo $total_drogariasp_a;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> CURVA B - <?php echo $total_drogariasp_b;?>
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-dark"></i> CURVA C - <?php echo $total_drogariasp_c;?>
                    </span>
<span class="mr-2">
                      <i class="fas fa-circle text-info"></i> OUTROS - <?php echo $total_drogariasp_d;?></h4>
                    </span>
                  </div>

    </div></div>
      <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Produtos Mais Vendidos
                </div>


              <span class="mr-2">     
<table cellspacing="0" cellpadding="0" border="0" width="100%">
  <tr>
    <td>
       <table cellspacing="0" cellpadding="1" border="1" width="100%" >
         <tr style="color:white;background-color:grey">
           
         </tr>
       </table>
    </td>
  </tr>
  <tr>
    <td>
       <div style="width:100%; height:350px; overflow:auto;">
         <table cellspacing="0" cellpadding="0" class="table table-sm">
          <tr><th>COD</th><th>EAN</th><th>TITULO</th><th>VALOR</th><th>VALORP</th>

<?php                   
$consultadrogariaspmv = "SELECT cod, ean, titulo, valor, valor_p from drogariasp_products where mv=1";
$res_datadrogariaspmv = mysqli_query($conn,$consultadrogariaspmv);


        while($row = mysqli_fetch_array($res_datadrogariaspmv)){  

echo '<tr>';


  echo'<td>'. $row[0].'</td>';
echo'<td>'. $row[1].'</td>';
echo'<td>'. $row[2].'</td>';
echo'<td>'. $row[3].'</td>';
echo'<td>'. $row[4].'</td>';

echo '</tr>';  

}
?>               
                        </table>  
       </div>
    </td>
  </tr>
</table>

                    </span>
                  </div>
 
                
                  </div>

    </div></div>





                       <div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                      <th>COD. DROGARIASP</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>
<th>VALORP</th>
                      <th>CURVA</th>

<th>STATUS</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                      
                      <th>COD. DROGARIASP</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>
<th>VALORP</th>
                      <th>CURVA</th>
<th>STATUS</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultadrogariasp = "SELECT cod, ean, titulo, marca, fabricante, quantidade, dosagem, valor, valor_p, curva from drogariasp_products WHERE sku_quali = ''";
$res_datadrogariasp = mysqli_query($conn,$consultadrogariasp);


        while($row = mysqli_fetch_array($res_datadrogariasp)){                 
                echo    '<tr>';
                    echo  '<td>'.$row[0].'</td>';
                    echo  '<td>'.$row[1].'</td>';
 echo  '<td>'.$row[2].'</td>';
 echo  '<td>'.$row[3].'</td>';
 echo  '<td>'.$row[4].'</td>';
echo  '<td>'.$row[5].'</td>';
echo  '<td>'.$row[6].'</td>';


echo  '<td>'.$row[7].'</td>';

echo  '<td>'.$row[8].'</td>';


echo '<td>'.$row[9].'</td>';
   if ($row[7]=='' and $row[8]==''){ 

$stock='Indisponivel';
}else{
$stock='Ativo';

}
echo '<td>'.$stock.'</td>';
     echo              ' </tr>';
 
isset($stock);
}
?>               
                  </tbody>
                </table></div>




<!-----PAGUE MENOS----->

<div class="tab-pane" id="PAGUEMENOS" role="tabpanel"><div class="container">
<br>
  <div class="row">
    <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Quantidade de Produtos Por Curva
                </div>
<div class="chart-pie pt-4 pb-2">
<canvas id="RaiachDonut"></canvas>
                  </div>  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> CURVA A - 1.555
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-success"></i> CURVA B - 2999
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> CURVA C - 444
                    </span>
<span class="mr-2">
                      <i class="fas fa-circle text-info"></i> MARCA PROPRIA - 444
                    </span>
                  </div>

    </div></div>
      <div class="col-sm">

<div class="card mb-4">

                <div class="card-header">
                 Produtos Mais Vendidos
                </div>

    </div></div>

  </div>
</div>


                       <div class="dropdown-divider"></div>
 <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">
                  <thead class="thead-dark">
                    <tr>
                      
                      <th>COD. BELEZANAWEB</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>
<th>VALORP</th>
                      <th>CURVA</th>

<th>STATUS</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">
                  
  <tr>
                      
                      <th>COD. BELEZANAWEB</th>
                      <th>EAN</th>
                      <th>TITULO</th>
                      <th>MARCA</th>

                      <th>FABRICANTE</th>
                      <th>QUANTIDADE</th>
<th>DOSAGEM</th>
                      <th>VALOR</th>
<th>VALORP</th>
                      <th>CURVA</th>
<th>STATUS</th>

                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultapaguemenos = "SELECT cod, ean, titulo, marca, fabricante, quantidade, dosagem, valor, valor_p from paguemenos_products WHERE sku_quali = ''";
$res_datapaguemenos = mysqli_query($conn,$consultapaguemenos);


        while($row = mysqli_fetch_array($res_datapaguemenos)){                 
                echo    '<tr>';
                    echo  '<td>'.$row[0].'</td>';
                    echo  '<td>'.$row[1].'</td>';
 echo  '<td>'.$row[2].'</td>';
 echo  '<td>'.$row[3].'</td>';
 echo  '<td>'.$row[4].'</td>';
echo  '<td>'.$row[5].'</td>';
echo  '<td>'.$row[6].'</td>';

echo  '<td>'.$row[7].'</td>';

echo  '<td>'.$row[8].'</td>';
echo '<td>'.$row[8].'</td>';
   if ($row[7]=='' and $row[8]==''){ 

$stock='Indisponivel';
}else{
$stock='Ativo';

}
echo '<td>'.$stock.'</td>';
     echo              ' </tr>';
 
isset($stock);
}
?>               
                  </tbody>
                </table></div>

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
<th>Ultrafarma</th><td><?php echo $qtd_geral_concorrente_ultrafarma_a;?> </td><td><?php echo $qtd_geral_concorrente_ultrafarma_b;?></td>
<td><?php echo $qtd_geral_concorrente_ultrafarma_c;?></td><td><?php echo $qtd_geral_concorrente_ultrafarma;?></td>
</th>

</tr>

<th>Paguemenos</th><td><?php echo $qtd_geral_concorrente_paguemenos_a;?> </td><td><?php echo $qtd_geral_concorrente_paguemenos_b;?></td>
<td><?php echo $qtd_geral_concorrente_paguemenos_c;?></td><td><?php echo $qtd_geral_concorrente_paguemenos;?></td>
</th>

</tr>


</table>

<table class="table" border=1>
 <thead style="font-size:11px">
<tr>
<th>1 Concorrente</th><th>2 Concorrentes</th><th>3 Concorrentes</th><th>4 Concorrentes</th><th>5 Concorrentes</th><th>6 Concorrentes</th>
</tr>
</thead>
<tbody style="font-size:12px; font-color:red; font-weight: bold;">
<td><?php echo $qtd_concorrente1;?></td><td><?php echo $qtd_concorrente2;?></td><td><?php echo $qtd_concorrente3;?></td>
<td><?php echo $qtd_concorrente4;?></td><td><?php echo $qtd_concorrente5;?></td><td><?php echo $qtd_concorrente6;?></td>
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

<th>CONCORRENTE</th>
<th>MARCA</th>
<th>VENDAS</th>
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

<th>CONCORRENTES</th>
<th>MARCA</th>
<th>VENDAS</th>
                    </tr>
                  </tfoot>
                  <tbody>

<?php
  

$consultatotalprodutos = "SELECT Products.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.sale_price, Products.current_price_pay_only, Products.current_less_price_around, Products.lowest_price_competitor, Products.current_gross_margin_percent, Products.diff_current_pay_only_lowest, Products.curve, Products.qty_stock_rms, Products.qty_competitors, marca.marca, sum(vendas.qtd) from Products inner join vendas on vendas.sku=Products.sku inner join marca on marca.sku=Products.sku where active='1' and pbm <> $pbma group by vendas.sku";
$res_datatotal = mysqli_query($conn,$consultatotalprodutos);
        while($row = mysqli_fetch_array($res_datatotal)){
     
                echo    '<tr>';
                    echo  '<td><a target="_blank" href=https://www.qualidoc.com.br/cadastro/product/'.$row[0].'>'.$row[0].'</a></td>';
                    echo  '<td>'.$row[1].'</td>';
 echo  '<td>'.$row[2].'</td>';
 echo  '<td>'.$row[3].'</td>';
 echo  '<td>'.$row[4].'</td>';
echo  '<td>'.$row[5].'</td>';
echo  '<td>'.$row[6].'</td>';
echo  '<td>'.$row[7].'</td>';
echo  '<td>'.$row[8].'</td>';
echo  '<td>'.round((float)$row[9] * 100).'%</td>';
echo  '<td>'.round((float)$row[10] * 100).'%</td>';
echo  '<td>'.$row[11].'</td>';
echo  "<td>". number_format($row[12], 0, ',', '.') ."</td>";
echo  '<td>'.$row[13].'</td>';
echo  '<td>'.$row[14].'</td>';
echo  '<td>'.$row[15].'</td>';
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
    $('table.display').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
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

var concorrentePaguemenos=<?php echo $qtd_geral_concorrente_paguemenos;?>;


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
    labels: ['Drogaraia', 'Drogasil', 'BelezaNaWeb', 'DrogariaSP', 'Ultrafarma', 'Paguemenos'],
    datasets: [
      {
        backgroundColor: colors.slice(0,5),
        borderWidth: 0,
        data: [concorrenteRaia, concorrenteSil, concorrenteOnofre, concorrenteDSP, concorrenteUltra, concorrentePaguemenos]
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
