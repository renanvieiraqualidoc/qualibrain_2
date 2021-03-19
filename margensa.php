<?php
if(!empty($_POST["allbooks"])){
  

//Qtd Produtos Financiando Curva A entre 0 e 5
$select_qtd_geral_financiando_cinco_curva_a = "SELECT count(1) FROM Products where active=1 and descontinuado <> 1 and curve = 'A' and (current_gross_margin_percent BETWEEN -0.05 and -0.0001)  and qty_s$
$resultado_qtd_geral_financiando_cinco_curva_a = mysqli_query($conn,$select_qtd_geral_financiando_cinco_curva_a);
echo $qtd_geral_financiando_cinco_curva_a = mysqli_fetch_array($resultado_qtd_geral_financiando_cinco_curva_a)[0];



 // echo $output; /* PRINT THE OUTPUT YOU WANT, IT WILL BE RETURNED TO THE ORIGINAL PAGE */
}

?>
