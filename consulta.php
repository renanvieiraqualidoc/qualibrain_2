<?php


//***********GERAL PRODUTOS**************//
include_once("config/dbconfig.php");
if (isset($_POST['vpbm'])) {
$pbma = $_POST['vpbm'];

}else{

$pbma = '5';
}



////cashback

//Cashback qtd
$select_cashback_geral = "SELECT count(1) FROM Products where current_cashback <> 0 and qty_stock_rms>0 and pbm <> $pbma";
$resultado_cashback_geral = mysqli_query($conn,$select_cashback_geral);
$margem_cashback_geral = mysqli_fetch_array($resultado_cashback_geral)[0];


$consultatotalcashback = "SELECT qty_stock_rms, current_cashback from Products where current_cashback <> 0 and qty_stock_rms>0 and pbm <> $pbma";
$res_cashback = mysqli_query($conn,$consultatotalcashback);
        while($rowcashback = mysqli_fetch_array($res_cashback)){

$valoritemcashback = $valoritemcashback + ($rowcashback[0] * $rowcashback[1]);

}



//tabelados


$select_tabelados_geral = " SELECT count(1) from Products where tabulated_price <> 0 and qty_stock_rms>0 and pbm <> $pbma";
$resultado_tabelados_geral = mysqli_query($conn,$select_tabelados_geral);
$margem_tabelados_geral = mysqli_fetch_array($resultado_tabelados_geral)[0];







//Margem Bruta Simulada Geral Consulta
$select_margembruta_geral = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_margembruta_geral = mysqli_query($conn,$select_margembruta_geral);
$margem_bruta_geral = mysqli_fetch_array($resultado_margembruta_geral)[0];


//Margem Bruta Simulada Geral Consulta Curva A
$select_margembruta_geral_a = "SELECT AVG(current_gross_margin_percent)  FROM Products where active=1 and curve='A' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_margembruta_geral_a = mysqli_query($conn,$select_margembruta_geral_a);
$margem_bruta_geral_a = mysqli_fetch_array($resultado_margembruta_geral_a)[0];
 
//Margem Bruta Simulada Geral Consulta Curva B
$select_margembruta_geral_b = "SELECT AVG(current_gross_margin_percent)  FROM Products where active=1 and curve='B' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_margembruta_geral_b = mysqli_query($conn,$select_margembruta_geral_b);
$margem_bruta_geral_b = mysqli_fetch_array($resultado_margembruta_geral_b)[0];

//Margem Bruta Simulada Geral Consulta Curva C
$select_margembruta_geral_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='C' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_margembruta_geral_c = mysqli_query($conn,$select_margembruta_geral_c);
$margem_bruta_geral_c = mysqli_fetch_array($resultado_margembruta_geral_c)[0];




//Margem Para o Menor Preco Geral Consulta
$select_margemmenor_geral = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_margemmenor_geral = mysqli_query($conn,$select_margemmenor_geral);
$margemmenor_geral = mysqli_fetch_array($resultado_margemmenor_geral)[0];

//Margem Para o Menor Preco Geral Consulta Curva A
$select_margemmenor_geral_a = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='A' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_margemmenor_geral_a = mysqli_query($conn,$select_margemmenor_geral_a);
$margemmenor_geral_a = mysqli_fetch_array($resultado_margemmenor_geral_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_geral_b = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='B' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_margemmenor_geral_b = mysqli_query($conn,$select_margemmenor_geral_b);
$margemmenor_geral_b = mysqli_fetch_array($resultado_margemmenor_geral_b)[0];


//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_geral_c = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='C' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_margemmenor_geral_c = mysqli_query($conn,$select_margemmenor_geral_c);
$margemmenor_geral_c = mysqli_fetch_array($resultado_margemmenor_geral_c)[0];


//Qtd Produtos Geral
$select_qtd_geral = "SELECT count(Products.sku) FROM Products where active=1 and pbm <> $pbma and pbm <> $pbma";
$resultado_qtd_geral = mysqli_query($conn,$select_qtd_geral);
$qtd_geral = mysqli_fetch_array($resultado_qtd_geral)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a = "SELECT count(1) FROM Products where active=1 and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_a = mysqli_query($conn,$select_qtd_geral_a);
$qtd_geral_a = mysqli_fetch_array($resultado_qtd_geral_a)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b = "SELECT count(1) FROM Products where active=1 and curve='B'  and pbm <> $pbma";
$resultado_qtd_geral_b = mysqli_query($conn,$select_qtd_geral_b);
$qtd_geral_b = mysqli_fetch_array($resultado_qtd_geral_b)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c = "SELECT count(1) FROM Products where active=1 and curve='C'  and pbm <> $pbma";
$resultado_qtd_geral_c = mysqli_query($conn,$select_qtd_geral_c);
$qtd_geral_c = mysqli_fetch_array($resultado_qtd_geral_c)[0];




//quantidade financiando



$consultatotalestoquef = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_estoquef = mysqli_query($conn,$consultatotalestoquef);
$qtd_geral_estoquef = mysqli_fetch_array($resultado_qtd_geral_estoquef)[0];

$consultatotalestoquef5 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN  -0.05001 and -0.0001) and pbm <> $pbma";
$resultado_qtd_geral_estoquef5 = mysqli_query($conn,$consultatotalestoquef5);
$qtd_geral_estoquef5 = mysqli_fetch_array($resultado_qtd_geral_estoquef5)[0];




$consultatotalestoquef10 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.09999 and -0.05) and pbm <> $pbma";
$resultado_qtd_geral_estoquef10 = mysqli_query($conn,$consultatotalestoquef10);
$qtd_geral_estoquef10 = mysqli_fetch_array($resultado_qtd_geral_estoquef10)[0];


$consultatotalestoquef20 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.199 and -0.10) and pbm <> $pbma";
$resultado_qtd_geral_estoquef20 = mysqli_query($conn,$consultatotalestoquef20);
$qtd_geral_estoquef20 = mysqli_fetch_array($resultado_qtd_geral_estoquef20)[0];

$consultatotalestoquef30 = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.299 and -0.20) and pbm <> $pbma";
$resultado_qtd_geral_estoquef30 = mysqli_query($conn,$consultatotalestoquef30);
$qtd_geral_estoquef30 = mysqli_fetch_array($resultado_qtd_geral_estoquef30)[0];

$consultatotalestoquef30a = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and current_gross_margin_percent < -0.30 and pbm <> $pbma";
$resultado_qtd_geral_estoquef30a = mysqli_query($conn,$consultatotalestoquef30a);
$qtd_geral_estoquef30a = mysqli_fetch_array($resultado_qtd_geral_estoquef30a)[0];

$valortotalitemestoque= ($qtd_geral_estoquef30a + $qtd_geral_estoquef30 + $qtd_geral_estoquef20 + $qtd_geral_estoquef10 + $qtd_geral_estoquef5);

$consultatotalpayonlyf5 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN  -0.05001 and -0.0001) and pbm <> $pbma";
$res_datatotalpayonlyf5 = mysqli_query($conn,$consultatotalpayonlyf5);
        while($row22f5 = mysqli_fetch_array($res_datatotalpayonlyf5)){

$valoritempof5 = $valoritempof5 + ($row22f5[0] * $row22f5[1]);
$valoritempof51 = $valoritempof51 + ($row22f5[2] * $row22f5[1]);
}

$valoritempof5t = ($valoritempof5 - $valoritempof51);


$consultatotalpayonlyf10 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN -0.09999 and -0.05) and pbm <> $pbma";
$res_datatotalpayonlyf10 = mysqli_query($conn,$consultatotalpayonlyf10);
        while($row22f10 = mysqli_fetch_array($res_datatotalpayonlyf10)){

$valoritempof102 = $valoritempof102 + ($row22f10[0] * $row22f10[1]);
$valoritempof101 = $valoritempof101 + ($row22f10[2] * $row22f10[1]);
}

$valoritempof10t = ($valoritempof102 - $valoritempof101);

$consultatotalpayonlyf20 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN -0.199 and -0.10) and pbm <> $pbma";
$res_datatotalpayonlyf20 = mysqli_query($conn,$consultatotalpayonlyf20);
        while($row22f20 = mysqli_fetch_array($res_datatotalpayonlyf20)){

$valoritempof20 = $valoritempof20 + ($row22f20[0] * $row22f20[1]);
$valoritempof201 = $valoritempof201 + ($row22f20[2] * $row22f20[1]);
}

$valoritempof20t = ($valoritempof20 - $valoritempof201);


$consultatotalpayonlyf30 = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and (current_gross_margin_percent BETWEEN -0.299 and -0.20) and pbm <> $pbma";
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





$select_qtd_geral_financiando = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent < 0 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando = mysqli_query($conn,$select_qtd_geral_financiando);
$qtd_geral_financiando = mysqli_fetch_array($resultado_qtd_geral_financiando)[0];


//Qtd Produtos Financiando Geral Curva A
$select_qtd_geral_financiando_a = "SELECT count(1) FROM Products where active=1 and curve='A' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_a = mysqli_query($conn,$select_qtd_geral_financiando_a);
$qtd_geral_financiando_a = mysqli_fetch_array($resultado_qtd_geral_financiando_a)[0];

//Qtd Produtos Financiando Geral Curva B
$select_qtd_geral_financiando_b = "SELECT count(1) FROM Products where active=1 and curve='B' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_b = mysqli_query($conn,$select_qtd_geral_financiando_b);
$qtd_geral_financiando_b = mysqli_fetch_array($resultado_qtd_geral_financiando_b)[0];


//Qtd Produtos Financiando Geral Curva C
$select_qtd_geral_financiando_c = "SELECT count(1) FROM Products where active=1 and curve='C' and current_gross_margin_percent < 0  and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_c = mysqli_query($conn,$select_qtd_geral_financiando_c);
$qtd_geral_financiando_c = mysqli_fetch_array($resultado_qtd_geral_financiando_c)[0];



//Financiando margens

$select_qtd_geral_financiando_igual = "SELECT count(1) FROM Products where active=1 and current_gross_margin_percent = 0 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_igual = mysqli_query($conn,$select_qtd_geral_financiando_igual);
$qtd_geral_financiando_igual = mysqli_fetch_array($resultado_qtd_geral_financiando_igual)[0];



//Qtd Produtos Financiando entre 0 e 5
$select_qtd_geral_financiando_cinco = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.05001 and -0.0001)  and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_cinco = mysqli_query($conn,$select_qtd_geral_financiando_cinco);
$qtd_geral_financiando_cinco = mysqli_fetch_array($resultado_qtd_geral_financiando_cinco)[0];





//Qtd Produtos Financiando entre 5 e 10
$select_qtd_geral_financiando_dez = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.09999 and -0.05)  and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_dez = mysqli_query($conn,$select_qtd_geral_financiando_dez);
$qtd_geral_financiando_dez = mysqli_fetch_array($resultado_qtd_geral_financiando_dez)[0];




//Qtd Produtos Financiando entre 10 e 20
$select_qtd_geral_financiando_vinte = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.199 and -0.10)  and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_vinte = mysqli_query($conn,$select_qtd_geral_financiando_vinte);
$qtd_geral_financiando_vinte = mysqli_fetch_array($resultado_qtd_geral_financiando_vinte)[0];



//Qtd Produtos Financiando entre 20 e 30
$select_qtd_geral_financiando_trinta = "SELECT count(1) FROM Products where active=1 and (current_gross_margin_percent BETWEEN -0.299 and -0.20)  and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_trinta = mysqli_query($conn,$select_qtd_geral_financiando_trinta);
$qtd_geral_financiando_trinta = mysqli_fetch_array($resultado_qtd_geral_financiando_trinta)[0];

//Qtd Produtos Financiando acima de 30
$select_qtd_geral_financiando_atrinta = "SELECT count(1) FROM Products where active=1  and current_gross_margin_percent < -0.30  and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_financiando_atrinta = mysqli_query($conn,$select_qtd_geral_financiando_atrinta);
$qtd_geral_financiando_atrinta = mysqli_fetch_array($resultado_qtd_geral_financiando_atrinta)[0];

 $valortotalitemcusto = ($valoritempof51 + $valoritempof101 + $valoritempof201 + $valoritempof301 + $valoritempof301a);
$valortotalitempa = ($valoritempof5 + $valoritempof102 + $valoritempof20 + $valoritempof30 + $valoritempof30a);
$valortotalitemdefict = (($valoritempof5t) + ($valoritempof10t) + ($valoritempof20t) + ($valoritempof30t) + ($valoritempof30ta));

//quantidade sacrificando operacao

$select_qtd_geral_soperacao = "SELECT count(1) FROM Products where active=1 and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_soperacao = mysqli_query($conn,$select_qtd_geral_soperacao);
$qtd_geral_soperacao = mysqli_fetch_array($resultado_qtd_geral_soperacao)[0];


//Qtd Produtos  Geral Curva A
$select_qtd_geral_soperacao_a = "SELECT count(1) FROM Products where active=1 and curve='A' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_soperacao_a = mysqli_query($conn,$select_qtd_geral_soperacao_a);
$qtd_geral_soperacao_a = mysqli_fetch_array($resultado_qtd_geral_soperacao_a)[0];

//Qtd Produtos  Geral Curva B
$select_qtd_geral_soperacao_b = "SELECT count(1) FROM Products where active=1 and curve='B' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_soperacao_b = mysqli_query($conn,$select_qtd_geral_soperacao_b);
$qtd_geral_soperacao_b = mysqli_fetch_array($resultado_qtd_geral_soperacao_b)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_soperacao_c = "SELECT count(1) FROM Products where active=1 and curve='C' and situation_code_fk=4 and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_soperacao_c = mysqli_query($conn,$select_qtd_geral_soperacao_c);
$qtd_geral_soperacao_c = mysqli_fetch_array($resultado_qtd_geral_soperacao_c)[0];



//quantidade sacrificando lucro

$select_qtd_geral_slucro = "SELECT count(1) FROM Products where active=1 and situation_code_fk=5 and qty_stock_rms>'0' and pbm <> $pbma";
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


//concorrente com menor preco financiando




//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and current_gross_margin_percent < 0 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf);
 $qtd_geral_concorrente_drogaraiaf = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf)[0];

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf5 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.05 and -0.001) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf5 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf5);
 $qtd_geral_concorrente_drogaraiaf5 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf5)[0];


//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.0999 and -0.05) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf10);
 $qtd_geral_concorrente_drogaraiaf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf10)[0];


//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.1999 and -0.10) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogaraiaf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogaraiaf20);
 $qtd_geral_concorrente_drogaraiaf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogaraiaf20)[0];

//Qtd Produtos Drogaraia Menor
$select_qtd_geral_concorrente_drogaraiaf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogaraia.com.br' and (current_gross_margin_percent BETWEEN -0.2999 and -0.20) and pbm <> $pbma";
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
$select_qtd_geral_concorrente_drogasilf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.0999 and -0.05) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasilf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf10);
$qtd_geral_concorrente_drogasilf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf10)[0];

//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.1999 and -0.10) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogasilf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogasilf20);
$qtd_geral_concorrente_drogasilf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogasilf20)[0];

//Qtd Produtos Drogasil Menor
$select_qtd_geral_concorrente_drogasilf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogasil.com.br' and (current_gross_margin_percent BETWEEN -0.2999 and -0.20) and pbm <> $pbma";
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

$select_qtd_geral_concorrente_drogariaspf10 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and (current_gross_margin_percent BETWEEN -0.0999 and -0.05) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariaspf10 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf10);
$qtd_geral_concorrente_drogariaspf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf10)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf20 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and  (current_gross_margin_percent BETWEEN -0.1999 and -0.10) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_drogariaspf20 = mysqli_query($conn,$select_qtd_geral_concorrente_drogariaspf20);
$qtd_geral_concorrente_drogariaspf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_drogariaspf20)[0];


//Qtd Produtos Drogaria SP Menor

$select_qtd_geral_concorrente_drogariaspf30 = "SELECT count(1) FROM Products where active=1 and qty_stock_rms>'0' and lowest_price_competitor='www.drogariasaopaulo.com.br' and (current_gross_margin_percent BETWEEN -0.2999 and -0.20) and pbm <> $pbma";
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
$select_qtd_geral_concorrente_ultrafarmaf10 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and  (current_gross_margin_percent BETWEEN -0.0999 and -0.05) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarmaf10 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf10);
$qtd_geral_concorrente_ultrafarmaf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf10)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf20 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and (current_gross_margin_percent BETWEEN -0.1999 and -0.10) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_ultrafarmaf20 = mysqli_query($conn,$select_qtd_geral_concorrente_ultrafarmaf20);
$qtd_geral_concorrente_ultrafarmaf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_ultrafarmaf20)[0];


//Qtd Produtos Ultrafarma Menor
$select_qtd_geral_concorrente_ultrafarmaf30 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.ultrafarma.com.br' and (current_gross_margin_percent BETWEEN -0.2999 and -0.20) and pbm <> $pbma";
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
$select_qtd_geral_concorrente_belezanawebf10 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and  (current_gross_margin_percent BETWEEN -0.0999 and -0.05) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf10 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf10);
$qtd_geral_concorrente_belezanawebf10 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf10)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf20 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and (current_gross_margin_percent BETWEEN -0.1999 and -0.10) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf20 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf20);
$qtd_geral_concorrente_belezanawebf20 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf20)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf30 = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br' and (current_gross_margin_percent BETWEEN -0.2999 and -0.20) and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf30 = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf30);
$qtd_geral_concorrente_belezanawebf30 = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf30)[0];


//Qtd Produtos belezanaweb Menor
$select_qtd_geral_concorrente_belezanawebf30a = "SELECT count(1) FROM Products where active=1  and qty_stock_rms>'0'and lowest_price_competitor='www.belezanaweb.com.br'  and current_gross_margin_percent < -0.30 and pbm <> $pbma";
$resultado_qtd_geral_concorrente_belezanawebf30a = mysqli_query($conn,$select_qtd_geral_concorrente_belezanawebf30a);
$qtd_geral_concorrente_belezanawebf30a = mysqli_fetch_array($resultado_qtd_geral_concorrente_belezanawebf30a)[0];


//////RUPTURA///////////////


//Qtd Produtos Geral
$select_qtd_geral_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and pbm <> $pbma";
$resultado_qtd_geral_ruptura = mysqli_query($conn,$select_qtd_geral_ruptura);
$qtd_geral_ruptura = mysqli_fetch_array($resultado_qtd_geral_ruptura)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_a_ruptura = mysqli_query($conn,$select_qtd_geral_a_ruptura);
$qtd_geral_a_ruptura = mysqli_fetch_array($resultado_qtd_geral_a_ruptura)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_b_ruptura = mysqli_query($conn,$select_qtd_geral_b_ruptura);
$qtd_geral_b_ruptura = mysqli_fetch_array($resultado_qtd_geral_b_ruptura)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura = "SELECT count(1) FROM Products where active=1 and qty_stock_rms='0' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_c_ruptura = mysqli_query($conn,$select_qtd_geral_c_ruptura);
$qtd_geral_c_ruptura = mysqli_fetch_array($resultado_qtd_geral_c_ruptura)[0];





//////EXCLUSIVO///////////////

//Qtd Produtos Geral
$select_qtd_geral_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_exclusivo = mysqli_query($conn,$select_qtd_geral_exclusivo);
$qtd_geral_exclusivo = mysqli_fetch_array($resultado_qtd_geral_exclusivo)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='A' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_a_exclusivo = mysqli_query($conn,$select_qtd_geral_a_exclusivo);
$qtd_geral_a_exclusivo = mysqli_fetch_array($resultado_qtd_geral_a_exclusivo)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='B' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_b_exclusivo = mysqli_query($conn,$select_qtd_geral_b_exclusivo);
$qtd_geral_b_exclusivo = mysqli_fetch_array($resultado_qtd_geral_b_exclusivo)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_exclusivo = "SELECT count(1) FROM Products where active=1 and qty_competitors='0' and curve='C' and qty_stock_rms>'0' and pbm <> $pbma";
$resultado_qtd_geral_c_exclusivo = mysqli_query($conn,$select_qtd_geral_c_exclusivo);
$qtd_geral_c_exclusivo = mysqli_fetch_array($resultado_qtd_geral_c_exclusivo)[0];

//***********MEDICAMENTOS**************//



///////Geral Medicamento////////////


////CUSTO
$select_medicamento_custo_geral = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma";
$resultado_medicamento_custo_geral = mysqli_query($conn,$select_medicamento_custo_geral);
        while($rowmcg = mysqli_fetch_array($resultado_medicamento_custo_geral)){

$medicamento_custo_geral = $medicamento_custo_geral + ($rowmcg[0] * $rowmcg[1]);



}


$select_medicamento_custo_geral_a = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='A' ";
$resultado_medicamento_custo_geral_a = mysqli_query($conn,$select_medicamento_custo_geral_a);
        while($rowmcg_a = mysqli_fetch_array($resultado_medicamento_custo_geral_a)){

$medicamento_custo_geral_a = $medicamento_custo_geral_a + ($rowmcg_a[0] * $rowmcg_a[1]);



}




$select_medicamento_custo_geral_b = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='B' ";
$resultado_medicamento_custo_geral_b = mysqli_query($conn,$select_medicamento_custo_geral_b);
        while($rowmcg_b = mysqli_fetch_brray($resultado_medicamento_custo_geral_b)){

$medicamento_custo_geral_b = $medicamento_custo_geral_b + ($rowmcg_b[0] * $rowmcg_b[1]);



}


$select_medicamento_custo_geral_c = "SELECT price_cost, qty_stock_rms from Products where active='1' and department = 'MEDICAMENTO' and qty_stock_rms>0 and pbm <> $pbma and curve ='B' ";
$resultado_medicamento_custo_geral_c = mysqli_query($conn,$select_medicamento_custo_geral_c);
        while($rowmcg_c = mysqli_fetch_crray($resultado_medicamento_custo_geral_c)){

$medicamento_custo_geral_c = $medicamento_custo_geral_c + ($rowmcg_c[0] * $rowmcg_c[1]);



}










//Pague Apenas Medicamento

$select_pagueapenas_medicamento = "SELECT AVG(current_price_pay_only) FROM Products where active=1 and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_pagueapenas_medicamento = mysqli_query($conn,$select_pagueapenas_medicamento);
$preco_pagueapenas_medicamento = mysqli_fetch_array($resultado_pagueapenas_medicamento)[0];

//Pague Apenas Medicamento Curva A

$select_pagueapenas_medicamento_a = "SELECT AVG(current_price_pay_only) FROM Products where active=1 and curve='A' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_pagueapenas_medicamento_a = mysqli_query($conn,$select_pagueapenas_medicamento_a);
$preco_pagueapenas_medicamento_a = mysqli_fetch_array($resultado_pagueapenas_medicamento_a)[0];

//Pague Apenas Medicamento Curva B

$select_pagueapenas_medicamento_b = "SELECT AVG(current_price_pay_only) FROM Products where active=1 and curve='B' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_pagueapenas_medicamento_b = mysqli_query($conn,$select_pagueapenas_medicamento_b);
$preco_pagueapenas_medicamento_b = mysqli_fetch_array($resultado_pagueapenas_medicamento_b)[0];

//Pague Apenas Medicamento Curva C

$select_pagueapenas_medicamento_c = "SELECT AVG(current_price_pay_only) FROM Products where active=1 and curve='C' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_pagueapenas_medicamento_c = mysqli_query($conn,$select_pagueapenas_medicamento_c);
$preco_pagueapenas_medicamento_c = mysqli_fetch_array($resultado_pagueapenas_medicamento_c)[0];





//Preco de Venda Medicamentos Geral Consulta

$select_precovenda_medicamentos = "SELECT AVG(sale_price) FROM Products where active=1 and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_preco_venda_medicamentos = mysqli_query($conn,$select_precovenda_medicamentos);
$preco_venda_medicamento = mysqli_fetch_array($resultado_preco_venda_medicamentos)[0];


//Preco de Venda Medicamentos Geral Consulta Curva A

$select_precovenda_medicamentos_a = "SELECT AVG(sale_price) FROM Products where active=1 and curve='A' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_preco_venda_medicamentos_a = mysqli_query($conn,$select_precovenda_medicamentos_a);
$preco_venda_medicamento_a = mysqli_fetch_array($resultado_preco_venda_medicamentos_a)[0];


//Preco de Venda Medicamentos Geral Consulta Curva B

$select_precovenda_medicamentos_b = "SELECT AVG(sale_price)FROM Products where active=1 and curve='B' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_preco_venda_medicamentos_b = mysqli_query($conn,$select_precovenda_medicamentos_b);
$preco_venda_medicamento_b = mysqli_fetch_array($resultado_preco_venda_medicamentos_b)[0];


//Preco de Venda Medicamentos Geral Consulta Curva C

$select_precovenda_medicamentos_c = "SELECT AVG(sale_price) FROM Products where active=1 and curve='C' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_preco_venda_medicamentos_c = mysqli_query($conn,$select_precovenda_medicamentos_c);
$preco_venda_medicamento_c = mysqli_fetch_array($resultado_preco_venda_medicamentos_c)[0];




//Margem Bruta Simulada Medicamentos Consulta 
$select_margembruta_medicamentos = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_medicamentos = mysqli_query($conn,$select_margembruta_medicamentos);
$margem_bruta_medicamento = mysqli_fetch_array($resultado_margembruta_medicamentos)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva A
$select_margembruta_medicamentos_a = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='A' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_medicamentos_a = mysqli_query($conn,$select_margembruta_medicamentos_a);
$margem_bruta_medicamento_a = mysqli_fetch_array($resultado_margembruta_medicamentos_a)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva B
$select_margembruta_medicamentos_b = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='B' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_medicamentos_b = mysqli_query($conn,$select_margembruta_medicamentos_b);
$margem_bruta_medicamento_b = mysqli_fetch_array($resultado_margembruta_medicamentos_b)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva C 
$select_margembruta_medicamentos_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and curve='C' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_medicamentos_c = mysqli_query($conn,$select_margembruta_medicamentos_c);
$margem_bruta_medicamento_c = mysqli_fetch_array($resultado_margembruta_medicamentos_c)[0];







//Margem Para o Menor Preco Geral Consulta
$select_margemmenor_medicamentos = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_medicamentos = mysqli_query($conn,$select_margemmenor_medicamentos);
$margemmenor_medicamento = mysqli_fetch_array($resultado_margemmenor_medicamentos)[0];




//Margem Para o Menor Preco Geral Consulta Curva A
$select_margemmenor_medicamentos_a = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='A' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_medicamentos_a = mysqli_query($conn,$select_margemmenor_medicamentos_a);
$margemmenor_medicamento_a = mysqli_fetch_array($resultado_margemmenor_medicamentos_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_medicamentos_b = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='B' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_medicamentos_b = mysqli_query($conn,$select_margemmenor_medicamentos_b);
$margemmenor_medicamento_b = mysqli_fetch_array($resultado_margemmenor_medicamentos_b)[0];

//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_medicamentos_c = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and curve='C' and department = 'Medicamento' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_medicamentos_c = mysqli_query($conn,$select_margemmenor_medicamentos_c);
$margemmenor_medicamento_c = mysqli_fetch_array($resultado_margemmenor_medicamentos_c)[0];




//Qtd Produtos Medicamentos
$select_qtd_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento'  and pbm <> $pbma";
$resultado_qtd_medicamentos = mysqli_query($conn,$select_qtd_medicamentos);
$qtd_medicamento = mysqli_fetch_array($resultado_qtd_medicamentos)[0];


//Qtd Produtos Medicamentos Curva A
$select_qtd_medicamentos_a = "SELECT count(1) FROM Products where active=1 and curve='A' and department = 'Medicamento' and pbm <> $pbma";
$resultado_qtd_medicamentos_a = mysqli_query($conn,$select_qtd_medicamentos_a);
$qtd_medicamento_a = mysqli_fetch_array($resultado_qtd_medicamentos_a)[0];



//Qtd Produtos Medicamentos Curva B
$select_qtd_medicamentos_b = "SELECT count(1)FROM Products where active=1 and curve='B' and department = 'Medicamento' and pbm <> $pbma";
$resultado_qtd_medicamentos_b = mysqli_query($conn,$select_qtd_medicamentos_b);
$qtd_medicamento_b = mysqli_fetch_array($resultado_qtd_medicamentos_b)[0];

//Qtd Produtos Medicamentos Curva C
$select_qtd_medicamentos_c = "SELECT count(1) FROM Products where active=1 and curve='C' and department = 'Medicamento'  and pbm <> $pbma";
$resultado_qtd_medicamentos_c = mysqli_query($conn,$select_qtd_medicamentos_c);
$qtd_medicamento_c = mysqli_fetch_array($resultado_qtd_medicamentos_c)[0];




///////////RUPTURA MEDICAMENTOS////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento'  and qty_stock_rms ='0' and pbm <> $pbma";
$resultado_qtd_geral_ruptura_medicamentos = mysqli_query($conn,$select_qtd_geral_ruptura_medicamentos);
$qtd_geral_ruptura_medicamentos = mysqli_fetch_array($resultado_qtd_geral_ruptura_medicamentos)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_medicamentos = "SELECT count(1) FROM Products where active=1  and department = 'Medicamento' and curve='A'  and qty_stock_rms ='0' and pbm <> $pbma";
$resultado_qtd_geral_a_ruptura_medicamentos = mysqli_query($conn,$select_qtd_geral_a_ruptura_medicamentos);
$qtd_geral_a_ruptura_medicamentos = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_medicamentos)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and curve='B' and qty_stock_rms ='0' and pbm <> $pbma";
$resultado_qtd_geral_b_ruptura_medicamentos = mysqli_query($conn,$select_qtd_geral_b_ruptura_medicamentos);
$qtd_geral_b_ruptura_medicamentos = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_medicamentos)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and curve='C' and qty_stock_rms ='0' and pbm <> $pbma";
$resultado_qtd_geral_c_ruptura_medicamentos = mysqli_query($conn,$select_qtd_geral_c_ruptura_medicamentos);
$qtd_geral_c_ruptura_medicamentos = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_medicamentos)[0];





//Qtd Produtos Geral
$select_qtd_geral_ee_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and qty_competitors='0' and pbm <> $pbma";
$resultado_qtd_geral_ee_medicamentos = mysqli_query($conn,$select_qtd_geral_ee_medicamentos_medicamentos);
$qtd_geral_ee_medicamentos = mysqli_fetch_array($resultado_qtd_geral_ee_medicamentos_medicamentos)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ee_medicamentos = "SELECT count(1) FROM Products where active=1  and department = 'Medicamento' and qty_competitors='0' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_a_ee_medicamentos = mysqli_query($conn,$select_qtd_geral_a_ee_medicamentos);
$qtd_geral_a_ee = mysqli_fetch_array($resultado_qtd_geral_a_ee_medicamentos)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ee_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and qty_competitors='0' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_b_ee_medicamentos = mysqli_query($conn,$select_qtd_geral_b_ee_medicamentos);
$qtd_geral_b_ee_medicamentos = mysqli_fetch_array($resultado_qtd_geral_b_ee_medicamentos)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ee_medicamentos = "SELECT count(1) FROM Products where active=1 and department = 'Medicamento' and qty_competitors='0' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_c_ee_medicamentos = mysqli_query($conn,$select_qtd_geral_c_ee_medicamentos);
$qtd_geral_c_ee_medicamentos = mysqli_fetch_array($resultado_qtd_geral_c_ee_medicamentos)[0];


///////Geral Perfumaria////////////

//Custo Perfumaria
$select_perfumaria_custo_geral = "select AVG(price_cost) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria'
 and pbm <> $pbma";
$resultado_perfumaria_custo_geral = mysqli_query($conn,$select_perfumaria_custo_geral);
$perfumaria_custo_geral = mysqli_fetch_array($resultado_perfumaria_custo_geral)[0];


//Custo Perfumaria Curva A
$select_perfumaria_custo_geral_a = "select AVG(price_cost) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma";
$resultado_perfumaria_custo_geral_a = mysqli_query($conn,$select_perfumaria_custo_geral_a);
$perfumaria_custo_geral_a = mysqli_fetch_array($resultado_perfumaria_custo_geral_a)[0];

//Custo Perfumaria Curva B
$select_perfumaria_custo_geral_b = "select AVG(price_cost) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma";
$resultado_perfumaria_custo_geral_b = mysqli_query($conn,$select_perfumaria_custo_geral_b);
$perfumaria_custo_geral_b= mysqli_fetch_array($resultado_perfumaria_custo_geral_b)[0];

//Custo Perfumaria Curva C
$select_perfumaria_custo_geral_c = "select AVG(price_cost) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'C' and pbm <> $pbma";
$resultado_perfumaria_custo_geral_c = mysqli_query($conn,$select_perfumaria_custo_geral_c);
$perfumaria_custo_geral_c = mysqli_fetch_array($resultado_perfumaria_custo_geral_c)[0];


//Pague Apenas Perfumaria

$select_pagueapenas_perfumaria = "SELECT AVG(current_price_pay_only) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria'
 and pbm <> $pbma";
$resultado_pagueapenas_perfumaria = mysqli_query($conn,$select_pagueapenas_perfumaria);
$preco_pagueapenas_perfumaria = mysqli_fetch_array($resultado_pagueapenas_perfumaria)[0];


//Pague Apenas Perfumaria Curva A
$select_pagueapenas_perfumaria_a = "SELECT AVG(current_price_pay_only) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma";
$resultado_pagueapenas_perfumaria_a = mysqli_query($conn,$select_pagueapenas_perfumaria_a);
$preco_pagueapenas_perfumaria_a = mysqli_fetch_array($resultado_pagueapenas_perfumaria_a)[0];


//Pague Apenas Perfumaria Curva B
$select_pagueapenas_perfumaria_b = "SELECT AVG(current_price_pay_only) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma";
$resultado_pagueapenas_perfumaria_b = mysqli_query($conn,$select_pagueapenas_perfumaria_b);
$preco_pagueapenas_perfumaria_b = mysqli_fetch_array($resultado_pagueapenas_perfumaria_b)[0];

//Pague Apenas Perfumaria Curva C
$select_pagueapenas_perfumaria_c = "SELECT AVG(current_price_pay_only) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'C' and pbm <> $pbma";
$resultado_pagueapenas_perfumaria_c = mysqli_query($conn,$select_pagueapenas_perfumaria_c);
$preco_pagueapenas_perfumaria_c = mysqli_fetch_array($resultado_pagueapenas_perfumaria_c)[0];







//Preco de Venda Perfumaria Geral Consulta

$select_precovenda_perfumaria = "SELECT AVG(sale_price) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and pbm <> $pbma";
$resultado_preco_venda_perfumaria = mysqli_query($conn,$select_precovenda_perfumaria);
$preco_venda_perfumaria = mysqli_fetch_array($resultado_preco_venda_perfumaria)[0];


$select_precovenda_perfumaria_a = "SELECT AVG(sale_price) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma";
$resultado_preco_venda_perfumaria_a = mysqli_query($conn,$select_precovenda_perfumaria_a);
$preco_venda_perfumaria_a = mysqli_fetch_array($resultado_preco_venda_perfumaria_a)[0];

$select_precovenda_perfumaria_b = "SELECT AVG(sale_price) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma";
$resultado_preco_venda_perfumaria_b = mysqli_query($conn,$select_precovenda_perfumaria_b);
$preco_venda_perfumaria_b = mysqli_fetch_array($resultado_preco_venda_perfumaria_b)[0];

$select_precovenda_perfumaria_c = "SELECT AVG(sale_price) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'C' and pbm <> $pbma";
$resultado_preco_venda_perfumaria_c = mysqli_query($conn,$select_precovenda_perfumaria_c);
$preco_venda_perfumaria_c = mysqli_fetch_array($resultado_preco_venda_perfumaria_c)[0];






//Margem Bruta Simulada Perfumaria Consulta 
$select_margembruta_perfumaria = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and pbm <> $pbma";
$resultado_margembruta_perfumaria = mysqli_query($conn,$select_margembruta_perfumaria);
$margem_bruta_perfumaria = mysqli_fetch_array($resultado_margembruta_perfumaria)[0];




//Margem Bruta Simulada Perfumaria Consulta 
$select_margembruta_perfumaria_a = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma";
$resultado_margembruta_perfumaria_a = mysqli_query($conn,$select_margembruta_perfumaria_a);
$margem_bruta_perfumaria_a = mysqli_fetch_array($resultado_margembruta_perfumaria_a)[0];


//Margem Bruta Simulada Perfumaria Consulta 
$select_margembruta_perfumaria_b = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma";
$resultado_margembruta_perfumaria_b = mysqli_query($conn,$select_margembruta_perfumaria_b);
$margem_bruta_perfumaria_b = mysqli_fetch_array($resultado_margembruta_perfumaria_b)[0];


//Margem Bruta Simulada Perfumaria Consulta 
$select_margembruta_perfumaria_c = "SELECT AVG(current_gross_margin_percent) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'C' and pbm <> $pbma";
$resultado_margembruta_perfumaria_c = mysqli_query($conn,$select_margembruta_perfumaria_c);
$margem_bruta_perfumaria_c = mysqli_fetch_array($resultado_margembruta_perfumaria_c)[0];









//Margem Para o Menor Preco Perfumaria Consulta
$select_margemmenor_perfumaria = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and pbm <> $pbma";
$resultado_margemmenor_perfumaria = mysqli_query($conn,$select_margemmenor_perfumaria);
$margemmenor_perfumaria = mysqli_fetch_array($resultado_margemmenor_perfumaria)[0];



//Margem Para o Menor Preco Perfumaria Consulta
$select_margemmenor_perfumaria_a = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma";
$resultado_margemmenor_perfumaria_a = mysqli_query($conn,$select_margemmenor_perfumaria_a);
$margemmenor_perfumaria_a = mysqli_fetch_array($resultado_margemmenor_perfumaria_a)[0];



//Margem Para o Menor Preco Perfumaria Consulta
$select_margemmenor_perfumaria_b = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma";
$resultado_margemmenor_perfumaria_b = mysqli_query($conn,$select_margemmenor_perfumaria_b);
$margemmenor_perfumaria_b = mysqli_fetch_array($resultado_margemmenor_perfumaria_b)[0];


//Margem Para o Menor Preco Perfumaria Consulta
$select_margemmenor_perfumaria_c = "SELECT AVG(diff_current_pay_only_lowest) from Products where active=1  and qty_stock_rms >'0' and department = 'Perfumaria' and curve = 'C' and pbm <> $pbma";
$resultado_margemmenor_perfumaria_c = mysqli_query($conn,$select_margemmenor_perfumaria_c);
$margemmenor_perfumaria_c = mysqli_fetch_array($resultado_margemmenor_perfumaria_c)[0];




//Qtd Produtos Perfumaria
$select_qtd_perfumaria = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and pbm <> $pbma";
$resultado_qtd_perfumaria = mysqli_query($conn,$select_qtd_perfumaria);
$qtd_perfumaria = mysqli_fetch_array($resultado_qtd_perfumaria)[0];


//Qtd Produtos Perfumaria
$select_qtd_perfumaria_a = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and curve = 'A' and pbm <> $pbma";
$resultado_qtd_perfumaria_a = mysqli_query($conn,$select_qtd_perfumaria_a);
$qtd_perfumaria_a = mysqli_fetch_array($resultado_qtd_perfumaria_a)[0];

//Qtd Produtos Perfumaria
$select_qtd_perfumaria_b = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and curve = 'B' and pbm <> $pbma";
$resultado_qtd_perfumaria_b = mysqli_query($conn,$select_qtd_perfumaria_b);
$qtd_perfumaria_b = mysqli_fetch_array($resultado_qtd_perfumaria_b)[0];

//Qtd Produtos Perfumaria
$select_qtd_perfumaria_c = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria'  and curve = 'C' and pbm <> $pbma";
$resultado_qtd_perfumaria_c = mysqli_query($conn,$select_qtd_perfumaria_c);
$qtd_perfumaria_c = mysqli_fetch_array($resultado_qtd_perfumaria_c)[0];

///////////RUPTURA PERFUMARIA////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_perfumaria = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and qty_stock_rms='0' and pbm <> $pbma";
$resultado_qtd_geral_ruptura_perfumaria = mysqli_query($conn,$select_qtd_geral_ruptura_perfumaria);
$qtd_geral_ruptura_perfumaria = mysqli_fetch_array($resultado_qtd_geral_ruptura_perfumaria)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_perfumaria = "SELECT count(1) FROM Products where active=1  and department = 'Perfumaria' and qty_stock_rms='0' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_a_ruptura_perfumaria = mysqli_query($conn,$select_qtd_geral_a_ruptura_perfumaria);
$qtd_geral_a_ruptura_perfumaria = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_perfumaria)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_perfumaria = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and qty_stock_rms='0' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_b_ruptura_perfumaria = mysqli_query($conn,$select_qtd_geral_b_ruptura_perfumaria);
$qtd_geral_b_ruptura_perfumaria = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_perfumaria)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_perfumaria = "SELECT count(1) FROM Products where active=1 and department = 'Perfumaria' and qty_stock_rms='0' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_c_ruptura_perfumaria = mysqli_query($conn,$select_qtd_geral_c_ruptura_perfumaria);
$qtd_geral_c_ruptura_perfumaria = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_perfumaria)[0];




//***********NAO MEDICAMENTOS**************//




///////////RUPTURA NAO MEDICAMENTOS////////////////////////

//Qtd Produtos Geral
$select_qtd_geral_ruptura_naomedicamento = "SELECT count(1) FROM Products where active=1 and department = 'Nao Medicamento' and qty_stock_rms='0' and pbm <> $pbma";
$resultado_qtd_geral_ruptura_naomedicamento = mysqli_query($conn,$select_qtd_geral_ruptura_naomedicamento);
$qtd_geral_ruptura_naomedicamento = mysqli_fetch_array($resultado_qtd_geral_ruptura_naomedicamento)[0];

//Qtd Produtos Geral Curva A
$select_qtd_geral_a_ruptura_naomedicamento = "SELECT count(1) FROM Products where active=1  and department = 'Nao Medicamento' and qty_stock_rms='0' and curve='A' and pbm <> $pbma";
$resultado_qtd_geral_a_ruptura_naomedicamento = mysqli_query($conn,$select_qtd_geral_a_ruptura_naomedicamento);
$qtd_geral_a_ruptura_naomedicamento = mysqli_fetch_array($resultado_qtd_geral_a_ruptura_naomedicamento)[0];

//Qtd Produtos Geral Curva B
$select_qtd_geral_b_ruptura_naomedicamento = "SELECT count(1) FROM Products where active=1 and department = 'Nao Medicamento' and qty_stock_rms='0' and curve='B' and pbm <> $pbma";
$resultado_qtd_geral_b_ruptura_naomedicamento = mysqli_query($conn,$select_qtd_geral_b_ruptura_naomedicamento);
$qtd_geral_b_ruptura_naomedicamento = mysqli_fetch_array($resultado_qtd_geral_b_ruptura_naomedicamento)[0];


//Qtd Produtos Geral Curva C
$select_qtd_geral_c_ruptura_naomedicamento = "SELECT count(1) FROM Products where active=1 and department = 'Nao Medicamento' and qty_stock_rms='0' and curve='C' and pbm <> $pbma";
$resultado_qtd_geral_c_ruptura_naomedicamento = mysqli_query($conn,$select_qtd_geral_c_ruptura_naomedicamento);
$qtd_geral_c_ruptura_naomedicamento = mysqli_fetch_array($resultado_qtd_geral_c_ruptura_naomedicamento)[0];



///////Geral Medicamento////////////

//Custo NAO Medicamento
$select_naomedicamento_custo_geral = "select AVG(price_cost) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_naomedicamento_custo_geral = mysqli_query($conn,$select_naomedicamento_custo_geral);
$naomedicamento_custo_geral = mysqli_fetch_array($resultado_naomedicamento_custo_geral)[0];



//Custo Nao Medicamento Curva A
$select_naomedicamento_custo_geral_a = "select AVG(price_cost) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma";
$resultado_naomedicamento_custo_geral_a = mysqli_query($conn,$select_naomedicamento_custo_geral_a);
$naomedicamento_custo_geral_a = mysqli_fetch_array($resultado_naomedicamento_custo_geral_a)[0];

//Custo Nao Medicamento Curva B
$select_naomedicamento_custo_geral_b = "select AVG(price_cost) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma";
$resultado_naomedicamento_custo_geral_b = mysqli_query($conn,$select_naomedicamento_custo_geral_b);
$naomedicamento_custo_geral_b = mysqli_fetch_array($resultado_naomedicamento_custo_geral_b)[0];


//Custo Nao Medicamento Curva C
$select_naomedicamento_custo_geral_c = "select AVG(price_cost) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma";
$resultado_naomedicamento_custo_geral_c = mysqli_query($conn,$select_naomedicamento_custo_geral_c);
$naomedicamento_custo_geral_c = mysqli_fetch_array($resultado_naomedicamento_custo_geral_c)[0];





//Pague Apenas Nao Medicamento

$select_pagueapenas_naomedicamento = "SELECT AVG(current_price_pay_only) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_pagueapenas_naomedicamento = mysqli_query($conn,$select_pagueapenas_naomedicamento);
$preco_pagueapenas_naomedicamento = mysqli_fetch_array($resultado_pagueapenas_naomedicamento)[0];




//Pague Apenas Nao Medicamento Curva A

$select_pagueapenas_naomedicamento_a = "SELECT AVG(current_price_pay_only) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma";
$resultado_pagueapenas_naomedicamento_a = mysqli_query($conn,$select_pagueapenas_naomedicamento_a);
$preco_pagueapenas_naomedicamento_a = mysqli_fetch_array($resultado_pagueapenas_naomedicamento_a)[0];

//Pague Apenas Nao Medicamento Curva B

$select_pagueapenas_naomedicamento_b = "SELECT AVG(current_price_pay_only) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma";
$resultado_pagueapenas_naomedicamento_b = mysqli_query($conn,$select_pagueapenas_naomedicamento_b);
$preco_pagueapenas_naomedicamento_b = mysqli_fetch_array($resultado_pagueapenas_naomedicamento_b)[0];

//Pague Apenas Medicamento Curva C

$select_pagueapenas_naomedicamento_c = "SELECT AVG(current_price_pay_only) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma";
$resultado_pagueapenas_naomedicamento_c = mysqli_query($conn,$select_pagueapenas_naomedicamento_c);
$preco_pagueapenas_naomedicamento_c = mysqli_fetch_array($resultado_pagueapenas_naomedicamento_c)[0];




//Preco de Venda Nao Medicamentos Geral Consulta

$select_precovenda_naomedicamentos = "SELECT AVG(sale_price) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_preco_venda_naomedicamentos = mysqli_query($conn,$select_precovenda_naomedicamentos);
$preco_venda_naomedicamento = mysqli_fetch_array($resultado_preco_venda_naomedicamentos)[0];



//Preco de Venda Nao Medicamentos Geral Consulta Curva A

$select_precovenda_naomedicamentos_a = "SELECT AVG(sale_price) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma";
$resultado_preco_venda_naomedicamentos_a = mysqli_query($conn,$select_precovenda_naomedicamentos_a);
$preco_venda_naomedicamento_a = mysqli_fetch_array($resultado_preco_venda_naomedicamentos_a)[0];


//Preco de Venda Nao Medicamentos Geral Consulta Curva B

$select_precovenda_naomedicamentos_b = "SELECT AVG(sale_price) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma";
$resultado_preco_venda_naomedicamentos_b = mysqli_query($conn,$select_precovenda_naomedicamentos_b);
$preco_venda_naomedicamento_b = mysqli_fetch_array($resultado_preco_venda_naomedicamentos_b)[0];


//Preco de Venda Nao Medicamentos Geral Consulta Curva C

$select_precovenda_naomedicamentos_c = "SELECT AVG(sale_price) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma";
$resultado_preco_venda_naomedicamentos_c = mysqli_query($conn,$select_precovenda_naomedicamentos_c);
$preco_venda_naomedicamento_c = mysqli_fetch_array($resultado_preco_venda_naomedicamentos_c)[0];









//Margem Bruta Simulada Nao Medicamentos Consulta 
$select_margembruta_naomedicamentos = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margembruta_naomedicamentos = mysqli_query($conn,$select_margembruta_naomedicamentos);
$margem_bruta_naomedicamento = mysqli_fetch_array($resultado_margembruta_naomedicamentos)[0];



//Margem Bruta Simulada Nao Medicamentos Consulta Curva A
$select_margembruta_naomedicamentos_a = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma";
$resultado_margembruta_naomedicamentos_a = mysqli_query($conn,$select_margembruta_naomedicamentos_a);
$margem_bruta_naomedicamento_a = mysqli_fetch_array($resultado_margembruta_naomedicamentos_a)[0];

//Margem Bruta Simulada Nao Medicamentos Consulta Curva B
$select_margembruta_naomedicamentos_b = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma";
$resultado_margembruta_naomedicamentos_b = mysqli_query($conn,$select_margembruta_naomedicamentos_b);
$margem_bruta_naomedicamento_b = mysqli_fetch_array($resultado_margembruta_naomedicamentos_b)[0];

//Margem Bruta Simulada Medicamentos Consulta Curva C 
$select_margembruta_naomedicamentos_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma";
$resultado_margembruta_naomedicamentos_c = mysqli_query($conn,$select_margembruta_naomedicamentos_c);
$margem_bruta_naomedicamento_c = mysqli_fetch_array($resultado_margembruta_naomedicamentos_c)[0];






//Margem Para o Menor Preco Nao Medicamento Geral Consulta
$select_margemmenor_naomedicamentos = "SELECT AVG(diff_current_pay_only_lowest) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and pbm <> $pbma";
$resultado_margemmenor_naomedicamentos = mysqli_query($conn,$select_margemmenor_naomedicamentos);
$margemmenor_naomedicamento = mysqli_fetch_array($resultado_margemmenor_naomedicamentos)[0];





//Margem Para o Menor Nao Medicamento Preco Geral Consulta Curva A
$select_margemmenor_naomedicamentos_a = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'A' and pbm <> $pbma";
$resultado_margemmenor_naomedicamentos_a = mysqli_query($conn,$select_margemmenor_naomedicamentos_a);
$margemmenor_naomedicamento_a = mysqli_fetch_array($resultado_margemmenor_naomedicamentos_a)[0];

//Margem Para o Menor Preco Geral Consulta Curva B
$select_margemmenor_naomedicamentos_b = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'B' and pbm <> $pbma";
$resultado_margemmenor_naomedicamentos_b = mysqli_query($conn,$select_margemmenor_naomedicamentos_b);
$margemmenor_naomedicamento_b = mysqli_fetch_array($resultado_margemmenor_naomedicamentos_b)[0];

//Margem Para o Menor Preco Geral Consulta Curva C
$select_margemmenor_naomedicamentos_c = "SELECT AVG(current_gross_margin_percent) FROM Products where active=1 and department = 'NAO MEDICAMENTO' and qty_stock_rms >'0' and curve = 'C' and pbm <> $pbma";
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



$consultatotalestoque = "SELECT SUM(qty_stock_rms)FROM Products where active=1 and pbm <> $pbma";
$resultado_qtd_geral_estoque = mysqli_query($conn,$consultatotalestoque);
$qtd_geral_estoque = mysqli_fetch_array($resultado_qtd_geral_estoque)[0];

////CUSTO
$consultatotalcusto = "SELECT price_cost, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma";
$res_datatotalcusto = mysqli_query($conn,$consultatotalcusto);
        while($row = mysqli_fetch_array($res_datatotalcusto)){

$valoritem = $valoritem + ($row[0] * $row[1]);



}


////PAGUE APENEAS

$consultatotalpayonly = "SELECT price_pay_only, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma";
$res_datatotalpayonly = mysqli_query($conn,$consultatotalpayonly);
        while($row22 = mysqli_fetch_array($res_datatotalpayonly)){

$valoritempo = $valoritempo + ($row22[0] * $row22[1]);

}


////financiando
$consultatotalpayonlyf = "SELECT price_pay_only, qty_stock_rms, price_cost from Products where active='1' and qty_stock_rms>0 and current_gross_margin_percent < 0 and pbm <> $pbma";
$res_datatotalpayonlyf = mysqli_query($conn,$consultatotalpayonlyf);
        while($row22f = mysqli_fetch_array($res_datatotalpayonlyf)){

$valoritempof = $valoritempof + ($row22f[0] * $row22f[1]);
$valoritempof1 = $valoritempof1 + ($row22f[2] * $row22f[1]);
}





$valoritempof10 = ($valoritempof - $valoritempof1);
//Abaixo do Custo

$consultatotalpvenda = "SELECT gross_margin, qty_stock_rms from Products where active='1' and qty_stock_rms>0 and pbm <> $pbma";
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
/* This will give an error. Note the output
 * above, which is before the header() call */

?>
