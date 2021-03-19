<?php
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


//***********Sortimentos Monitorados**************//

//Drogaraia
$select_drogaraia = "SELECT count(1) FROM drogaraia_products where sku_quali=''";
$resultado_drogaraia = mysqli_query($conn,$select_drogaraia);
$total_drogaraia = mysqli_fetch_array($resultado_drogaraia)[0];

$select_drogaraia_total = "SELECT count(1) FROM drogaraia_products";
$resultado_drogaraia_total = mysqli_query($conn,$select_drogaraia_total);
$total_drogaraia_total = mysqli_fetch_array($resultado_drogaraia_total)[0];


//Ultrafarma
$select_ultrafarma = "SELECT count(1) FROM ultrafarma_products where sku_quali=''";
$resultado_ultrafarma = mysqli_query($conn,$select_ultrafarma);
$total_ultrafarma = mysqli_fetch_array($resultado_ultrafarma)[0];

$select_ultrafarma_total = "SELECT count(1) FROM ultrafarma_products";
$resultado_ultrafarma_total = mysqli_query($conn,$select_ultrafarma_total);
$total_ultrafarma_total = mysqli_fetch_array($resultado_ultrafarma_total)[0];


//DrogariaSP
$select_drogariasp = "SELECT count(1) FROM drogariasp_products where sku_quali=''";
$resultado_drogariasp = mysqli_query($conn,$select_drogariasp);
$total_drogariasp = mysqli_fetch_array($resultado_drogariasp)[0];

$select_drogariasp_total = "SELECT count(1) FROM drogariasp_products";
$resultado_drogariasp_total = mysqli_query($conn,$select_drogariasp_total);
$total_drogariasp_total = mysqli_fetch_array($resultado_drogariasp_total)[0];







?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Quali-Brain - Qualidoc</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">QualiBrain</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
         
          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Média de Custo (R$)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo number_format($custo_geral, 3, ',', '.');?></div>
                    
<div class="h5 mb-0 font-weight-bold text-primary"><font size=3px>R$ <?php echo  number_format($custo_geral_a, 2, ',', '.') ;?>  (Curva A)</font></div>
     <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px>R$ <?php echo  number_format($custo_geral_b, 2, ',', '.') ;?> (Curva B)</font></div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>R$ <?php echo  number_format($custo_geral_c, 2, ',', '.') ;?> (Curva C)</font></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Média Pague Apenas (R$)</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800">R$ <?php echo  number_format($preco_pagueapenas_geral, 2, ',', '.') ;?></div>
  
<div class="h5 mb-0 font-weight-bold text-primary"><font size=3px>R$ <?php echo  number_format($preco_pagueapenas_geral_a, 2, ',', '.') ;?>  (Curva A)</font></div>
     <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px>R$ <?php echo  number_format($preco_pagueapenas_geral_b, 2, ',', '.') ;?> (Curva B)</font></div>
<div class="h5 mb-0 font-weight-bold text-danger"><font size=3px>R$ <?php echo  number_format($preco_pagueapenas_geral_c, 2, ',', '.') ;?> (Curva C)</font></div>      
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
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo round((float)$margem_bruta_geral * 100 ) . '%';?></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margem_bruta_geral * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-primary"><font size=3px><?php echo round((float)$margem_bruta_geral_a * 100 ) . '%';?></font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margem_bruta_geral_a * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>

<div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px><?php echo round((float)$margem_bruta_geral_b * 100 ) . '%';?></font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margem_bruta_geral_b * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-danger"><font size=3px><?php echo round((float)$margem_bruta_geral_c * 100 ) . '%';?></font></div>
 
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
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo round((float)$margemmenor_geral * 100 ) . '%';?></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margemmenor_geral * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-primary"><font size=3px><?php echo round((float)$margemmenor_geral_a * 100 ) . '%';?></font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margemmenor_geral_a * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>

<div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-warning"><font size=3px><?php echo round((float)$margemmenor_geral_b * 100 ) . '%';?></font></div>
 
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo round((float)$margemmenor_geral_b * 100 ) . '%';?>" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
            </div>

                      </div>
 <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 font-weight-bold text-danger"><font size=3px><?php echo round((float)$margemmenor_geral_c * 100 ) . '%';?></font></div>
 
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
  Total Produtos <a href="#" class="alert-link"><?php echo  number_format($qtd_geral, 0, ',', '.');?></a>
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
</div>
<div class="container">
 <div class="row">
    <div class="col-12">
     <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Medicamentos </h6><div class="alert alert-light" role="alert"><b>Média Custo:</b> R$ <?php echo number_format($medicamento_custo_geral, 2, ',', '.');?> - <b>Média Pague Apenas:</b> R$ <?php echo number_format($preco_pagueapenas_medicamento, 2, ',', '.');?> - <b>Média Preço Venda:</b> R$ <?php echo number_format($preco_venda_medicamento, 2, ',', '.');?> <br> <b>Média Margem Op.:</b> <?php echo round((float)$margem_bruta_medicamento * 100 ) . '%';?> - <b>Média Diferença Menor Preco:</b> <?php echo round((float)$margemmenor_medicamento * 100 ) . '%';?> - <b>Qtd de Produtos:</b> <?php echo number_format($qtd_medicamento, 0, ',', '.');?></div>
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
      <th scope="row">Média Custo:</th>
      <td>R$ <?php echo number_format($medicamento_custo_geral_a, 2, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_medicamento_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_medicamento_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_medicamento_a * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_medicamento_a * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_medicamento_a, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #B</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Média Custo:</th>
      <td>R$ <?php echo number_format($medicamento_custo_geral_b, 3, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_medicamento_b, 3, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_medicamento_b, 3, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_medicamento_b * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_medicamento_b * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_medicamento_b, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #C</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Média Custo:</th>
      <td>R$ <?php echo number_format($medicamento_custo_geral_c, 3, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_medicamento_c, 3, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_medicamento_c, 3, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_medicamento_c * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_medicamento_c * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_medicamento_c, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>

  </div>
<div style="float:right"><a href="#" class="btn btn-secondary btn-icon-split">
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
                <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample1">
                  <h6 class="m-0 font-weight-bold text-primary">Nao Medicamentos</h6><div class="alert alert-light" role="alert"><b>Média Custo:</b> R$ <?php echo number_format($naomedicamento_custo_geral, 2, ',', '.');?> - <b>Média Pague Apenas:</b> R$ <?php echo number_format($preco_pagueapenas_naomedicamento, 2, ',', '.');?> - <b>Média Preço Venda:</b> R$ <?php echo number_format($preco_venda_naomedicamento, 2, ',', '.');?> <br> <b>Média Margem Op.:</b> <?php echo round((float)$margem_bruta_naomedicamento * 100 ) . '%';?> - <b>Média Diferença Menor Preco:</b> <?php echo round((float)$margemmenor_naomedicamento * 100 ) . '%';?> - <b>Qtd de Produtos:</b> <?php echo number_format($qtd_naomedicamento, 0, ',', '.');?></div>
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
      <th scope="row">Média Custo:</th>
      <td>R$ <?php echo number_format($naomedicamento_custo_geral_a, 3, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_naomedicamento_a, 3, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_naomedicamento_a, 3, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_naomedicamento_a * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_naomedicamento_a * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_naomedicamento_a, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #B</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Média Custo:</th>
      <td>R$ <?php echo number_format($naomedicamento_custo_geral_b, 3, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_naomedicamento_b, 3, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_naomedicamento_b, 3, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_naomedicamento_b * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_naomedicamento_b * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_naomedicamento_b, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #C</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Média Custo:</th>
      <td>R$ <?php echo number_format($naomedicamento_custo_geral_c, 3, ',', '.');?></td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$ <?php echo number_format($preco_pagueapenas_naomedicamento_c, 3, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_naomedicamento_c, 3, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_naomedicamento_c * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_naomedicamento_c * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_naomedicamento_c, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>

  </div>
<div style="float:right"><a href="#" class="btn btn-secondary btn-icon-split">
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
                  <h6 class="m-0 font-weight-bold text-primary">Perfumaria</h6><div class="alert alert-light" role="alert"><b>Média Custo:</b> R$ <?php echo number_format($perfumaria_custo_geral, 2, ',', '.');?> - <b>Média Pague Apenas:</b> R$ <?php echo number_format($preco_pagueapenas_perfumaria, 2, ',', '.');?> - <b>Média Preço Venda:</b> R$ <?php echo number_format($preco_venda_perfumaria, 2, ',', '.');?> <br> <b>Média Margem Op.:</b> <?php echo round((float)$margem_bruta_perfumaria * 100 ) . '%';?> - <b>Média Diferença Menor Preco:</b> <?php echo round((float)$margemmenor_perfumaria * 100 ) . '%';?> - <b>Qtd de Produtos:</b> <?php echo number_format($qtd_perfumaria, 0, ',', '.');?></div>
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
      <th scope="row">Média Custo:</th>
      <td>R$ <?php echo number_format($perfumaria_custo_geral_a, 2, ',', '.');?> </td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$  <?php echo number_format($preco_pagueapenas_perfumaria_a, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_perfumaria_a, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_perfumaria_a * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_perfumaria_a * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_perfumaria_a, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #B</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Média Custo:</th>
      <td>R$ R$ <?php echo number_format($perfumaria_custo_geral_b, 2, ',', '.');?> </td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$  <?php echo number_format($preco_pagueapenas_perfumaria_b, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_perfumaria_b, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_perfumaria_b * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_perfumaria_b * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_perfumaria_b, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>
    <div class="col-sm">
<center><p><b>Curva #C</b></p></center>
<table  class="table table-striped">

  <tbody>
    <tr>
      <th scope="row">Média Custo:</th>
      <td>R$ R$ <?php echo number_format($perfumaria_custo_geral_c, 2, ',', '.');?> </td>


    </tr>
    <tr>
      <th scope="row">Média Pague Apenas:</th>
    
      <td>R$  <?php echo number_format($preco_pagueapenas_perfumaria_c, 2, ',', '.');?></td>
    </tr>
    <tr>
      <th scope="row">Média Preço Venda:</th>

      <td>R$ <?php echo number_format($preco_venda_perfumaria_c, 2, ',', '.');?></td>
    </tr>
<tr>
      <th scope="row">Média Margem Op.:</th>

      <td><?php echo round((float)$margem_bruta_perfumaria_c * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Média Diferença Menor Preco:</th>

      <td><?php echo round((float)$margemmenor_perfumaria_c * 100 ) . '%';?></td>
    </tr>
<tr>
      <th scope="row">Qtd de Produtos:</th>

      <td><?php echo number_format($qtd_perfumaria_c, 0, ',', '.');?></td>
    </tr>
  </tbody>
</table>
    </div>

  </div>
<div style="float:right"><a href="#" class="btn btn-secondary btn-icon-split">
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
          <!-- Content Row -->


<div class="container">
  <div class="row">
    <div class="col">


    <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Sortimento Concorrentes Monitorados</h6>
                </div>

                  <div class="card-body">
                                    <h4 class="small font-weight-bold">DROGARAIA <span class="float-right">NAO TEMOS - <a href='drogaraia_table?table=1'><?php echo number_format($total_drogaraia, 0, ',', '.');?></a></span></h4>

                  <div class="progress mb-4" >
                    <div class="progress-bar bg-warning" role="progressbar" style="width:<?php echo get_percentage($total_drogaraia_total,$total_drogaraia).'%';?> " aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"><center><?php echo number_format($total_drogaraia_total, 0, ',', '.');?></center></div>
                  </div>
                 <h4 class="small font-weight-bold">Drogasil <span class="float-right">20%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Onofre <span class="float-right">60%</span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Ultrafarma - Total de Produtos <?php echo number_format($total_ultrafarma_total, 0, ',', '.');?> <span class="float-right">Nao Temos <a href='drogaraia_table?table=1'><?php echo number_format($total_ultrafarma, 0, ',', '.');?></a></span></h4>
                  <div class="progress mb-4">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                  <h4 class="small font-weight-bold">Drogaria SP- Total de Produtos <?php echo number_format($total_drogariasp_total, 0, ',', '.');?> <span class="float-right">Nao Temos <a href='drogaraia_table?table=1'><?php echo number_format($total_drogariasp, 0, ',', '.');?></a></span></h4>                 <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>



    </div>
    <div class="col">
    <!-- Basic Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Sortimento Concorrentes Nao Monitorados</h6>
                </div>
                <div class="card-body">
                  
                </div>
              </div>

    </div>
  </div>

           
       
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
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
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

</html>
