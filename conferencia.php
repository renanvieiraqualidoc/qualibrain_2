 <?php


include_once("dbconfig.php");


$hoje = date('d/m/Y');

include 'salvos.php';
$status = $_GET['buscastatus'];
$buscasku = $_GET['buscasku'];
$buscastatus = $_GET['buscasku'];
$buscaprioridade = $_GET['buscaprioridade'];

//Paginacao
        if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 1;
        $offset = ($pageno-1) * $no_of_records_per_page;

      

        $total_pages_sql = "SELECT COUNT(*) FROM tbl_excel ";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);
 


$consulta1 = "SELECT COUNT (*) FROM tbl_excel Where (quali_sku like '%$buscasku%') AND (prioridade like '%$buscaprioridade%')";
$resultado1 = mysqli_query($conn,$consulta1);
$total_consulta = mysqli_fetch_array($resultado1)[0];



//Consulta
        $sql = "SELECT * FROM tbl_excel Where (quali_sku like '%$buscasku%') AND (prioridade like '%$buscaprioridade%')  ORDER BY prioridade, prioridade ASC LIMIT $offset, $no_of_records_per_page";

  $res_data = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($res_data)){

        $qualisku = $row[1];
		$qualiean = utf8_encode($row[2]);
		$qualidesc = utf8_encode($row[3]);
		$qualiurl = $row[4];
		$qualistatus = $row[5];
		$urlraia=$row[8];
		$urlsp=$row[12];
		$urlultra=$row[14];


		$urlbnw=$row[18];
				
				//STATUS
		$statusraia=$row[9];
		$statusdsp=$row[13];
		$statusultra=$row[15];
		
		$statusbnw=$row[19];
		$prioridade =$row[21];		
		$user =$row[19];			

		}
        mysqli_close($conn);
    ?>
    

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CONFERENCIA - OVERVIEW</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top" onload="myFunction()">
<div id="modal-background"></div>

<div id="modal-content">

<p>Processando Planilha, Aguarde...</p>
	<center><img src="includes/img/spinner-white.gif"></center>
</div>


<style>
p {
      margin: 0!important;
}

#progress-wrp {
  border: 1px solid #0099CC;
  padding: 1px;
  position: relative;
  height: 30px;
  border-radius: 3px;
  margin: 10px;
  text-align: left;
  background: #fff;
  box-shadow: inset 1px 3px 6px rgba(0, 0, 0, 0.12);
}

#progress-wrp .progress-bar {
  height: 100%;
  border-radius: 3px;
  background-color: #f39ac7;
  width: 0;
  box-shadow: inset 1px 1px 10px rgba(0, 0, 0, 0.11);
}

#progress-wrp .status {
  top: 3px;
  left: 50%;
  position: absolute;
  display: inline-block;
  color: #000000;
}
#modal-background {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: white;
    opacity: .50;
    -webkit-opacity: .5;
    -moz-opacity: .5;
    filter: alpha(opacity=50);
    z-index: 1000;
}

#modal-content {
    background-color: white;
    border-radius: 10px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    box-shadow: 0 0 20px 0 #222;
    -webkit-box-shadow: 0 0 20px 0 #222;
    -moz-box-shadow: 0 0 20px 0 #222;
    display: none;
    height: 240px;
    left: 50%;
    margin: -120px 0 0 -160px;
    padding: 10px;
    position: fixed;
    top: 50%;
    width: 320px;
    z-index: 1000;
}



#modal-background.active, #modal-content.active {
    display: block;
}​

.zoom {
  padding: 50px;

  transition: transform .2s; /* Animation */
  width: 200px;
  height: 200px;
  margin: 0 auto;
}


.zoom:hover {
  transform: scale(4.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}

.container {
  position: relative;

    


}

/* Bottom 
  left text */

  .bottom-left {
  position: absolute;
  
  bottom: 8px;
  left: 16px;
}

/* Top left text */
.top-left {
  position: 
  absolute;
  top: 8px;
  left: 16px;
}

  
/* Top right text */
.top-right {
  
  position: absolute;
  top: 8px;
  
  right: 16px;
}

/* Bottom right text */

  .bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

/* Centered text 
  */
.centered {
  position: 
  absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
    white-space: nowrap;
} 
#alertraia{
  display: none;


}
#controladoraia{
  display: none;


}
#alertdsp{
  display: none;


}
#controladodsp{
  display: none;


}



#alertultra{
  display: none;


}

#controladobnw{
  display: none;


}
#bnwcontrolado{
  display: none;


}

#controladoultra{
  display: none;


}
#ultracontrolado{
  display: none;


}
#controladog{
  display: none;


}

#alertbnw
{
  display: none;


}

#raiabox{
  display: none;

}

#ultrabox{
  display: none;

}

#bnwbox{
  display: none;

}

#spbox{
  display: none;

}


</style>





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
        <!-- Begin Page Content -->
<form method='get' name='busca' id='busca'>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <input type="file"  id="file" name="file" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
          </div>


        <div class="container-fluid">
 <div class="container">
  <div class="row">
    <div class="col-sm">
         <div class="alert alert-success">

<div class="container">
  <div class="row">
    <div class="col-sm">

<div class="input-group mb-3"  id="check">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">FILTRAR PRIORIDADE</span>
  </div>
<select name="buscaprioridade" id="buscaprioridade">
<option value=<?php echo $prioridade;?>>Prioridade <?php echo $prioridade;?></option>
<option value="">Tudo</option>
<option value=1>Prioridade 1</option>
<option value=2>Prioridade 2</option>
<option value=3>Prioridade 3</option>
<option value=4>Prioridade 4</option>
<option value=5>Prioridade 5</option>
<option value=6>Prioridade 6</option>
<option value=7>Prioridade 7</option>
<option value=8>Prioridade 8</option>
<option value=9>Prioridade 9</option>
<option value=10>Prioridade 10</option>

</select> 
</div>
</div>
    <div class="col-sm">
<div class="input-group mb-3"  id="check">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">FILTRAR STATUS</span>
  </div>
<select name="buscastatus" id="buscastatus">
<option value="<?php echo $status;?>"><?php echo $status;?></option>
<option value="srevisao">Falta Revisar</option>
<option value="">Tudo</option>
<option value="revisado">Revisados</option>
<option value="cadastro">Cadastro</option>

<option value="verificar">Verificar</option>
<option value="sem concorrente">Sem Concorrente</option>

</select> 
Foram encontrados <?php echo $total_consulta;?> itens para a consulta realizada!</div>

</div>
 
</div>
</div>



</div>
 <!-- Default Card Example -->
              <div class="card mb-4">
                
                <div class="card-body">
 

<div class="container">
  <div class="row">
    <div class="col-sm">


	
	<input type=hidden id="quali_sku" name="quali_sku" value='<?php echo ($qualisku); ?>'>
	<input type=hidden id="quali_ean" name="quali_ean" value='<?php echo ($qualiean); ?>'>
		<input type=hidden id="quali_desc"  name="quali_desc" value='<?php echo ($qualidesc); ?>'>
		
		<div id="header"><b>QUALIDOC</b></div>
		<div id="header"><a href="http://monitor.precifica.com.br/index.php/produtos?q=<?php echo ($qualisku); ?>" target=_blank>SKU: <?php echo ($qualisku); ?></a></div>
		<div id="header">EAN: <?php echo ($qualiean); ?></div>
		<div id="header">Titulo: <?php echo ($qualidesc); ?></div>
		<div id="header"><a href="<?php echo ($qualiurl); ?>" target=_blank>URL: <?php echo ($qualiurl); ?></a></div>

	<nav aria-label="Page navigation example">
  <ul class="pagination">
        <li><a class="page-link" href='<?php echo "?buscasku=".$buscasku."&buscaprioridade=".$buscaprioridade."&buscastatus=".$status."&pageno=1";?>' > << </a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?buscasku=".$buscasku."&buscaprioridade=".$buscaprioridade."&buscastatus=".$status."&pageno=".($pageno - 1); } ?>#check"><</a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
   <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?buscasku=".$buscasku."&buscaprioridade=".$buscaprioridade."&buscastatus=".$status."&pageno=".($pageno + 1); } ?>#check">></a>
        </li> <input type='text' name='buscasku' id='buscasku' placeholder='BUSCAR SKU'><img id="buscar" src="upload/search.png" widht=26px height=26px onclick='submit_busca();'></li></ul>
</nav>
</form>
   <script>
function submit_busca(){
document.getElementById("buscaprioridade").value="";
document.getElementById("buscastatus").value="";
    document.getElementById("busca").submit();
    }
</script>
    </div>
    <div class="col-sm">

<form method="post" id="form-update" name="form-update" action="update.php">

<div class="input-group mb-3"  id="check">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-addon1">STATUS</span>
  </div>
<select class="custom-select" id="statusquali">
      <option value='<?php echo ($qualistatus); ?>'selected><?php echo ($qualistatus); ?> </option>
    <option value="REVISADO <?php echo $hoje;?>">REVISADO OK</option>    
<option value="ERRO DE CADASTRO">ERRO DE CADASTRO</option>
    <option value="SEM CONCORRENTES">SEM CONCORRENTES</option>
<option value="VERIFICAR">OUTROS VERIFICAR</option>

  </select>

</div>

<div class="alert alert-danger" id="controladog"><strong>Produto Controlado</strong></div>



    </div>
  </div>
</div>

                </div>
              </div>




	




   

  
  





        



                  <div class="container">
  <div class="row">
    <div class="col-sm">






 <div class="card shadow mb" id="raiabox">
                <!-- Card Header - Accordion -->

<a class="d-block card-header py-3" target=_blank href="<?php echo ($urlraia);?>">
                  <h6 class="m-0 font-weight-bold text-primary">DROGARAIA</h6>
                </a>
               

                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
               
	<input type="hidden" name="drogaraiaurlv" id="drogaraiaurlv">
	<input type="hidden" name="onofreurlv" id="onofreurlv">
	<input type="hidden" name="drogasilurlv" id="drogasilurlv">
			<input type="hidden" id="statusraia2"  name="statusraia" value="<?php echo ($statusraia); ?>" disabled/>
  

  <div class="container">
  <center><img class="zoom" id="img" width=30% height=30%>
</center>
   <div class="centered alert alert-danger" id="alertraia"><strong><span id="dindisponivel"></span></strong></div>
  <div class="alert alert-danger" id="controladoraia"><span id="dcontrolado"></span></div>
</div> 



<div ><center><b><span id="dname">	<img src="includes/img/spinner-white.gif"></span></b></center></div>
 



    <div class="card-body">
<div ><center></center></div>
<div><p><b>EAN: </b><span id="dean"></span></p>
<p><b> Registro MS: </b><span id="drms"></span></p>
<p><b> Valor: </b><span id="dprice"></span></p>
<p><b> Valor Promocional: </b><span id="dsprice"></span></p>
<p><b> Marca: </b><span id="dmarca"></span></p>
<p><b>Fabricante: </b><span id="dfabricante"></span></p>
<p><b> Volume: </b><span id="dvolume"></span></p>
<p><b> Quantidade: </b><span id="dqtd"></span></p></div>
      </div>
    
<input type="text" id="drogaraiaurl" name="drogaraiaurl" style="width:100%!important" disabled/>
<select class="" id="statusraia" style="width:100%!important" disabled>
      <option value='<?php echo ($statusraia); ?>'selected><?php echo ($statusraia); ?> </option>
      <option value='URL NAO ENCONTRADA'>URL NAO ENCONTRADA</option>
      <option value='PRODUTO INDISPONIVEL'>PRODUTO INDISPONÍVEL</option>
 <option value='URL REDIRECIONANDO'>URL REDIRECIONANDO</option>
      <option value='PRODUTO CONTROLADO'>PRODUTO CONTROLADO/SEM PREÇO</option>
      <option value='VALIDADE'>VALIDADE</option>
          
 <option value='REVISADO OK' >REVISADO OK</option>
      


    </select>

	

<div class="card-body">
<div class="d-flex justify-content-between align-items-center">
<div class="btn-group">
<button type="button" id="alteraurlraia" class="btn btn-sm btn-outline-secondary">Editar</button>
<button type="button" id="validaraiaurl" class="btn btn-sm btn-outline-secondary" disabled/>Validar</button>
</div>
<small class="text-muted">&nbsp;&nbsp;<?php echo ($user); ?></small>
</div>
</div>
                </div>
              </div>
    </div>



    <div class="col-sm">
 <div class="card shadow mb-4" id="spbox">
                <!-- Card Header - Accordion -->

     <a class="d-block card-header py-3" target=_blank href="<?php echo ($urlsp);?>">             <h6 class="m-0 font-weight-bold text-primary">DROGARIA SP</h6>
                </a>
               
               

         <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
       

  <div class="container">
  <center><img class="zoom" id="imgdsp" width=30% height=30%>
</center>
   <div class="centered alert alert-danger" id="alertdsp"><strong><span id="dspindisponivel"></span></strong></div>
  <div class="alert alert-danger" id="controladodsp"><span id="dspcontrolado"></span></div>
</div> 



<div ><center><b><span id="dspname">	<img src="includes/img/spinner-white.gif"></span></b></center></div>
 



    <div class="card-body">
<div ><center></center></div>
<div><p><b>EAN: </b><span id="dspean"></span></p>
<p><b> Registro MS: </b><span id="dsprms"></span></p>
<p><b> Valor: </b><span id="dspprice"></span></p>
<p><b> Valor Promocional: </b><span id="dspsprice"></span></p>
<p><b> Marca: </b><span id="dspmarca"></span></p>
<p><b>Fabricante: </b><span id="dspfabricante"></span></p>
<p><b> Volume: </b><span id="dspvolume"></span></p>
<p><b> Quantidade: </b><span id="dspqtd"></span></p></div>
      </div>
    
<input type="text" id="spurl" name="spurl" value="<?php echo ($urlsp);?>" size="90" style="width:100%!important" disabled/>
	<input type="hidden" name="spurlv" id="spurlv">
				<input type=hidden id="statusdsp2" style="width:100%!important"  name="statusdsp" value='<?php echo ($statusdsp); ?>' disabled/>
  <select class="" id="statusdsp" style="width:100%!important" disabled>
      <option value='<?php echo ($statusdsp); ?>'selected><?php echo ($statusdsp); ?> </option>
      <option value='URL NAO ENCONTRADA'>URL NAO ENCONTRADA</option>
      <option value='PRODUTO INDISPONIVEL'>PRODUTO INDISPONÍVEL</option>
 <option value='URL REDIRECIONANDO'>URL REDIRECIONANDO</option>
      <option value='PRODUTO CONTROLADO'>PRODUTO CONTROLADO/SEM PREÇO</option>
      <option value='VALIDADE'>VALIDADE</option>
          
 <option value='REVISADO OK' >REVISADO OK</option>
      


    </select>

	

<div class="card-body">
<div class="d-flex justify-content-between align-items-center">
<div class="btn-group">
<button type="button" id="alteraurlsp" class="btn btn-sm btn-outline-secondary">Editar</button>
<button type="button" id="validaspurl" class="btn btn-sm btn-outline-secondary" disabled/>Validar</button>
</div>
<small class="text-muted">&nbsp;&nbsp;<?php echo ($user); ?></small>
</div>
</div>
                </div>
              </div>
    </div>











    <div class="col-sm">
 <div class="card shadow mb-4" id="ultrabox">
                <!-- Card Header - Accordion -->
             <a class="d-block card-header py-3" target=_blank href="<?php echo ($urlultra);?>">
                  <h6 class="m-0 font-weight-bold text-primary">ULTRAFARMA</h6>
                </a>
               
               
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                  <div class="card-body">
                  
<div class="container">
  <center><img class="zoom" id="imgultra" width=30% height=30%>
</center>
   <div class="centered alert alert-danger" id="alertultra"><strong><span id="ultraindisponivel"></span></strong></div>
  <div class="centered alert alert-danger" id="ultracontrolado"></div>
</div> 


<div ><center><b><span id="ultraname">	<img src="includes/img/spinner-white.gif"></span></b></center></div>
 

	<input type="hidden" name="ultraurlv" id="ultraurlv">
				<input type=hidden id="statusultra2"  name="statusultra2" value='<?php echo ($statusultra); ?>' disabled/>


    <div class="card-body">
<div ><center></center></div>
<div><p><b>EAN: </b><span id="ultraean"></span></p>
<p><b> Registro MS: </b><span id="ultrarms"></span></p>
<p><b> Valor: </b><span id="ultrasprice"></span></p>
<p><b> Valor Promocional: </b><span id="ultraprice"></span></p>
<p><b> Marca: </b><span id="ultramarca"></span></p>
<p><b>Fabricante: </b><span id="ultrafabricante"></span></p>
<p><b> Volume: </b><span id="ultravolume"></span></p>
<p><b> Quantidade: </b><span id="ultraqtd"></span></p></div>
      </div>
	<input type="text" id="ultraurl" name="ultraurl" style="width:100%!important" disabled/>
<select class="" style="width:100%!important" id="statusultra" disabled>
      <option value='<?php echo ($statusultra); ?>'selected><?php echo ($statusultra); ?> </option>
      <option value='URL NAO ENCONTRADA'>URL NAO ENCONTRADA</option>
      <option value='PRODUTO INDISPONIVEL'>PRODUTO INDISPONÍVEL</option>
 <option value='URL REDIRECIONANDO'>URL REDIRECIONANDO</option>
      <option value='PRODUTO CONTROLADO'>PRODUTO CONTROLADO/SEM PREÇO</option>
      <option value='VALIDADE'>VALIDADE</option>
          
 <option value='REVISADO OK' >REVISADO OK</option>
</select>
      


    </select>

<div class="card-body">
<div class="d-flex justify-content-between align-items-center">
<div class="btn-group">
<button type="button" id="alteraurlultra" class="btn btn-sm btn-outline-secondary">Editar</button>
<button type="button" id="validaultraurl" class="btn btn-sm btn-outline-secondary" disabled/>Validar</button>
</div>
<small class="text-muted">&nbsp;&nbsp;<?php echo ($user); ?></small>
</div>
</div>
                </div>
              </div>
    </div>
                  </div>
                </div>
              </div>







 
              

  


<div class="container">
  <div class="row">
    <div class="col-sm">
<div class="card shadow mb-4" id="bnwbox">
                <!-- Card Header - Accordion -->
                <a class="d-block card-header py-3" target=_blank href="<?php echo ($urlbnw);?>">
                  <h6 class="m-0 font-weight-bold text-primary">BELEZA NA WEB</h6>
                </a>
               





         <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
       

  <div class="container">
  <center><img class="zoom" id="imgbnw" width=30% height=30%>
</center>
   <div class="centered alert alert-danger" id="alertbnw"><strong><span id="bnwindisponivel"></span></strong></div>
  <div class="alert alert-danger" id="controladobnw"><span id="bnwcontrolado"></span></div>
</div> 



<div ><center><b><span id="bnwname">	<img src="includes/img/spinner-white.gif"></span></b></center></div>
 



    <div class="card-body">
<div ><center></center></div>
<div><p><b>EAN: </b><span id="bnwean"></span></p>
<p><b> Registro MS: </b><span id="bnwrms"></span></p>
<p><b> Valor: </b><span id="bnwprice"></span></p>
<p><b> Valor Promocional: </b><span id="bnwsprice"></span></p>
<p><b> Marca: </b><span id="bnwmarca"></span></p>
<p><b>Fabricante: </b><span id="bnwfabricante"></span></p>
<p><b> Volume: </b><span id="bnwvolume"></span></p>
<p><b> Quantidade: </b><span id="bnwqtd"></span></p></div>
      </div>
    
<input type="text" id="bnwurl" name="bnwurl" value="<?php echo ($urlsp);?>" size="90" style="width:100%!important" disabled/>
	<input type="hidden" name="bnwurlv" id="bnwurlv">
				<input type=hidden id="statusbnw2" style="width:100%!important"  name="statusbnw" value='<?php echo ($statusdsp); ?>' disabled/>
  <select class="" id="statusbnw" style="width:100%!important" disabled>
      <option value='<?php echo ($statusbnw); ?>'selected><?php echo ($statusbnw); ?> </option>
      <option value='URL NAO ENCONTRADA'>URL NAO ENCONTRADA</option>
      <option value='PRODUTO INDISPONIVEL'>PRODUTO INDISPONÍVEL</option>
 <option value='URL REDIRECIONANDO'>URL REDIRECIONANDO</option>
      <option value='PRODUTO CONTROLADO'>PRODUTO CONTROLADO/SEM PREÇO</option>
      <option value='VALIDADE'>VALIDADE</option>
          
 <option value='REVISADO OK' >REVISADO OK</option>
      


    </select>

	
</div>
<div class="card-body">
<div class="d-flex justify-content-between align-items-center">
<div class="btn-group">
<button type="button" id="alteraurlbnw" class="btn btn-sm btn-outline-secondary">Editar</button>
<button type="button" id="validabnwurl" class="btn btn-sm btn-outline-secondary" disabled/>Validar</button>
</div>
<small class="text-muted">&nbsp;&nbsp;<?php echo ($user); ?></small>
</div>
</div>
                </div>
    </div>
    <div class="col-sm">

    </div>
    <div class="col-sm">

    </div>
  </div>
</div>




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
          <a class="btn btn-primary" href="logout.php">Logout</a>
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

 
<script>

$(document).ready(function() {
  $('#buscaprioridade').on('change', function() {
     document.forms['busca'].submit();


});
});

$(document).ready(function() {
  $('#buscastatus').on('change', function() {
     document.forms['busca'].submit();
  });
});


function myFunction() {




	
	var data = new Date(),
        dia  = data.getDate().toString(),
        diaF = (dia.length == 1) ? '0'+dia : dia,
        mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = (mes.length == 1) ? '0'+mes : mes,
        anoF = data.getFullYear();
    
	

	
	if (document.getElementById('statusraia').value  == "") {
	document.getElementById('statusraia').value = "Revisado " + diaF+"/"+mesF+"/"+anoF;
};
	

	if (document.getElementById('statusultra').value  == "") {
document.getElementById('statusultra').value = "Revisado " + diaF+"/"+mesF+"/"+anoF;
};
	
	if (document.getElementById('statusdsp').value  == "") {

document.getElementById('statusdsp').value = "Revisado " + diaF+"/"+mesF+"/"+anoF;
};
	if (document.getElementById('statusbnw').value  == "") {

	document.getElementById('statusbnw').value = "Revisado " + diaF+"/"+mesF+"/"+anoF;
	};
	
  var drogaraiaurlv = $('#drogaraiaurlv').val();
var drogasilurlv = $('#drogasilurlv').val();
    var onofreurlv = $('#onofreurlv').val();
  var quali_sku = $('#quali_sku').val();
var ultraurlv = $('#ultraurlv').val();
  var spurlv = $('#spurlv').val();

  var bnwurlv = $('#bnwurlv').val();

//STATUS
var statusraia = $('#statusraia').val();
var statusonofre = $('#statusraia').val();
var statusdrogasil = $('#statusraia').val();
var statusquali = $('#statusquali').val();
var statusdsp = $('#statusdsp').val();
var statusultra = $('#statusultra').val();

var statusbnw = $('#statusbnw').val();


      $.ajax
        ({
          type: "POST",
          url: "update1.php",
          data: { "quali_sku": quali_sku,  "statusbnw":statusbnw,  "statusdsp":statusdsp,  "statusultra":statusultra,  "statusraia":statusraia, "statusonofre":statusonofre, "statusdrogasil":statusdrogasil, "bnwurlv":bnwurlv,  "ultraurlv":ultraurlv, "drogaraiaurlv": drogaraiaurlv, "drogasilurlv": drogasilurlv, "onofreurlv":onofreurlv, "spurlv": spurlv, "statusquali":statusquali},
          success: function (data) {
            $('.result').html(data);
        }
        });

}



$('#file').on('change', function() {
    var file_data = $('#file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
 $("#modal-content, #modal-background").toggleClass("active");
    $.ajax({
        url: 'uploadxls.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(php_script_response){
            alert(php_script_response); // display response from the PHP script, if any
    location.reload();
        }
     });
});



	

//Quali

$("#statusquali").on('change', function() {
var drogaraiaurlv = $('#drogaraiaurlv').val();
var drogasilurlv = $('#drogasilurlv').val();
    var onofreurlv = $('#onofreurlv').val();
  var quali_sku = $('#quali_sku').val();
var ultraurlv = $('#ultraurlv').val();
  var spurlv = $('#spurlv').val();

  var bnwurlv = $('#bnwurlv').val();

//STATUS
var statusraia = $('#statusraia').val();
var statusonofre = $('#statusraia').val();
var statusdrogasil = $('#statusraia').val();

var statusdsp = $('#statusdsp').val();
var statusultra = $('#statusultra').val();
var statusquali = $('#statusquali').val();

var statusbnw = $('#statusbnw').val();


      $.ajax
        ({
          type: "POST",
          url: "update.php",
          data: { "quali_sku": quali_sku,  "statusbnw":statusbnw, "statusdsp":statusdsp,  "statusultra":statusultra,  "statusraia":statusraia, "statusonofre":statusonofre, "statusdrogasil":statusdrogasil, "bnwurlv":bnwurlv, "ultraurlv":ultraurlv, "drogaraiaurlv": drogaraiaurlv, "drogasilurlv": drogasilurlv, "onofreurlv":onofreurlv, "spurlv": spurlv, "statusquali":statusquali},
          success: function (data) {
            $('.result').html(data);
        }
        });

});



//Drogaria SP Altera URL
$(function() {
      $("#alteraurlsp").click( function()
           {
             $( "#spurl" ).prop( "disabled", false );
			 $( "#validaspurl" ).prop( "disabled", false );
$( "#statusdsp" ).prop( "disabled", false );
           
		   }
      );
});


$(function() {
      $("#validaspurl").click( function()
           {
             $( "#spurl" ).prop( "disabled", true );
			 			 $( "#validaspurl" ).prop( "disabled", true );
$( "#statusdsp" ).prop( "disabled", true );
      var urlsp = $('#spurl').val();
	  $('#spurlv').val(urlsp);



var req2 = $('#spurl').val();

$.ajax({
      type: "POST",
      dataType: "json",
      url: "drogariasp.php", //Relative or absolute path to response.php file
       data: { 
        'req2': req2 
       
    },
    dataType: 'json',
      success: function(data1) {


if (data1.controlado != null){
$('#controladog').css('display','block');
};


$('#dspname').html(data1.nome);
 $("#imgdsp").attr("src", (data1.img));
   $('#dspean').html(data1.ean);
     $('#dspsku').html(data1.sku);
    $('#dspprice').html(data1.pricen);
     $('#dspsprice').html(data1.sprice);
     $('#dspmarca').html(data1.marca);
   $('#dspfabricante').html(data1.fabricante);
    $('#dsprms').html(data1.rms);
     $('#dspvolume').html(data1.volume);
     $('#dspindisponivel').html(data1.indisponivel);

     $('#dspcontrolado').html(data1.controlado);

     $('#dspqtd').html(data1.qtd);


data1= undefined;

 }
    

});




  var drogaraiaurlv = $('#drogaraiaurlv').val();
var drogasilurlv = $('#drogasilurlv').val();
    var onofreurlv = $('#onofreurlv').val();
  var quali_sku = $('#quali_sku').val();
var ultraurlv = $('#ultraurlv').val();
  var spurlv = $('#spurlv').val();

  var bnwurlv = $('#bnwurlv').val();

//STATUS
var statusraia = $('#statusraia').val();
var statusonofre = $('#statusraia').val();
var statusdrogasil = $('#statusraia').val();

var statusdsp = $('#statusdsp').val();
var statusultra = $('#statusultra').val();
var statusquali = $('#statusquali').val();

var statusbnw = $('#statusbnw').val();


      $.ajax
        ({
          type: "POST",
          url: "update.php",
          data: { "quali_sku": quali_sku,  "statusbnw":statusbnw, "statusdsp":statusdsp,  "statusultra":statusultra,  "statusraia":statusraia, "statusonofre":statusonofre, "statusdrogasil":statusdrogasil, "bnwurlv":bnwurlv, "ultraurlv":ultraurlv, "drogaraiaurlv": drogaraiaurlv, "drogasilurlv": drogasilurlv, "onofreurlv":onofreurlv, "spurlv": spurlv, "statusquali":statusquali},
          success: function (data) {
            $('.result').html(data);
        }
        });
	  }

	
	
	
	
	);

	  
	  
	  
});

	  
	  
	  
	  
	  
	  
//ULTRAFARMA
$(function() {
      $("#alteraurlultra").click( function()
           {
             $( "#ultraurl" ).prop( "disabled", false );
			 $( "#validaultraurl" ).prop( "disabled", false );
           $( "#statusultra" ).prop( "disabled", false );
		   }
      );
});


$(function() {
      $("#validaultraurl").click( function()
           {
             $( "#ultraurl" ).prop( "disabled", true );
			 			 $( "#validaultraurl" ).prop( "disabled", true );

		 $( "#statusultra" ).prop( "disabled", true );

      var urlultra = $('#ultraurl').val();
	  $('#ultraurlv').val(urlultra);

var req3 = $('#ultraurl').val();

$.ajax({
      type: "POST",
      dataType: "json",
      url: "ultrafarma.php", //Relative or absolute path to response.php file
       data: { 
        'req3': req3 
       
    },
    dataType: 'json',
      success: function(data2) {

if (data2.indisponivel != null){
$('#alertultra').css('display','block');
$('#ultraindisponivel').html("Produto Indisponivel");
};
if (data2.controlado != ''){
$('#controladog').css('display','block');
};


$('#ultraname').html(data2.nome);
 $("#imgultra").attr("src", (data2.img));
   $('#ultraean').html(data2.ean);
     $('#ultrasku').html(data2.sku);
    $('#ultraprice').html(data2.pricen);
     $('#ultrasprice').html(data2.sprice);
     $('#ultramarca').html(data2.marca);
   $('#ultrafabricante').html(data2.fabricante);
    $('#ultrarms').html(data2.rms);
     $('#ultravolume').html(data2.volume);
   //  $('#ultraindisponivel').html(data2.indisponivel);

   // $('#ultracontrolado').html(data2.controlado);

     $('#ultraqtd').html(data2.qtd);

data2= undefined;

 }
    

});



  var drogaraiaurlv = $('#drogaraiaurlv').val();
var drogasilurlv = $('#drogasilurlv').val();
    var onofreurlv = $('#onofreurlv').val();
  var quali_sku = $('#quali_sku').val();
var ultraurlv = $('#ultraurlv').val();
  var spurlv = $('#spurlv').val();
 var statusquali = $('#statusquali').val();

  var bnwurlv = $('#bnwurlv').val();

//STATUS
var statusraia = $('#statusraia').val();
var statusonofre = $('#statusraia').val();
var statusdrogasil = $('#statusraia').val();

var statusdsp = $('#statusdsp').val();
var statusultra = $('#statusultra').val();

var statusbnw = $('#statusbnw').val();


      $.ajax
        ({
          type: "POST",
          url: "update.php",
          data: { "quali_sku": quali_sku,  "statusbnw":statusbnw,  "statusdsp":statusdsp,  "statusultra":statusultra,  "statusraia":statusraia, "statusonofre":statusonofre, "statusdrogasil":statusdrogasil, "bnwurlv":bnwurlv, "ultraurlv":ultraurlv, "drogaraiaurlv": drogaraiaurlv, "drogasilurlv": drogasilurlv, "onofreurlv":onofreurlv, "spurlv": spurlv, "statusquali":statusquali},
          success: function (data) {
            $('.result').html(data);
         }
        });
	  }

	
	
	
	
	);

	  
	  
	  
});

	  
	  
	
	  
	 //BELEZANAWEB
	  

$(function() {
      $("#alteraurlbnw").click( function()
           {
             $( "#bnwurl" ).prop( "disabled", false );
			 $( "#validabnwurl" ).prop( "disabled", false );
            $( "#statusbnw" ).prop( "disabled", false );
           
		   }
      );
});


$(function() {
      $("#validabnwurl").click( function()
           {
             $( "#bnwurl" ).prop( "disabled", true );
			 			 $( "#validabnwurl" ).prop( "disabled", true );
$( "#statusbnw" ).prop( "disabled", true );
           

      var urlfd = $('#bnwurl').val();
	  $('#bnwurlv').val(urlfd);

//BelezaNaWeb Busca Dados No Concorrente
			
var req6 = $('#bnwurl').val();

$.ajax({
      type: "POST",
      dataType: "json",
      url: "belezanaweb.php", //Relative or absolute path to response.php file
       data: { 
        'req6': req6 
       
    },
    dataType: 'json',
      success: function(data3) {

if (data3.indisponivel != null){
$('#alertbnw').css('display','block');
$('#bnwindisponivel').html("Produto Indisponivel");
};
if (data3.controlado != null){
$('#controladog').css('display','block');
};


$('#bnwname').html(data3.nome);
 $("#imgbnw").attr("src", (data3.img));
   $('#bnwean').html(data3.ean);
     $('#bnwsku').html(data3.sku);
    $('#bnwprice').html(data3.pricen);
     $('#bnwsprice').html(data3.sprice);
     $('#bnwmarca').html(data3.marca);
   $('#bnwfabricante').html(data3.fabricante);
    $('#bnwrms').html(data3.rms);
     $('#bnwvolume').html(data2.volume);
     //$('#bnwindisponivel').html(data3.indisponivel);

     $('#bnwcontrolado').html(data3.controlado);

     $('#bnwqtd').html(data3.qtd);

data3= undefined;

 }
    

});

  var drogaraiaurlv = $('#drogaraiaurlv').val();
var drogasilurlv = $('#drogasilurlv').val();
    var onofreurlv = $('#onofreurlv').val();
  var quali_sku = $('#quali_sku').val();
var ultraurlv = $('#ultraurlv').val();
  var spurlv = $('#spurlv').val();
 
  var bnwurlv = $('#bnwurlv').val();

//STATUS
var statusraia = $('#statusraia').val();
var statusonofre = $('#statusraia').val();
var statusdrogasil = $('#statusraia').val();
var statusquali = $('#statusquali').val();

var statusdsp = $('#statusdsp').val();
var statusultra = $('#statusultra').val();

var statusbnw = $('#statusbnw').val();


      $.ajax
        ({
          type: "POST",
          url: "update.php",
          data: { "quali_sku": quali_sku,  "statusbnw":statusbnw, "statusdsp":statusdsp,  "statusultra":statusultra,  "statusraia":statusraia, "statusonofre":statusonofre, "statusdrogasil":statusdrogasil, "bnwurlv":bnwurlv, "ultraurlv":ultraurlv, "drogaraiaurlv": drogaraiaurlv, "drogasilurlv": drogasilurlv, "onofreurlv":onofreurlv, "spurlv": spurlv, "statusquali":statusquali},
          success: function (data) {
            $('.result').html(data);
          }
        });
	  }

	
	
	
	
	);

	  
	  
	  
});
  
	  
	  
	  
	  
	  
	  
	  
	  
	  
//Drogaraia Altera URL
$(function() {
      $("#alteraurlraia").click( function()
           {
             $( "#drogaraiaurl" ).prop( "disabled", false );
			 $( "#validaraiaurl" ).prop( "disabled", false );
 $( "#statusraia" ).prop( "disabled", false );
           
		   }
      );

});
$(function() {
      $("#validaraiaurl").click( function()
           {
             $( "#drogaraiaurl" ).prop( "disabled", true );

$( "#statusraia" ).prop( "disabled", true );
 			 			 $( "#validaraiaurl" ).prop( "disabled", true );

      var urldrogaraia = $('#drogaraiaurl').val();
	  $('#drogaraiaurlv').val(urldrogaraia);
	  var urldrogasil = urldrogaraia.replace('drogaraia', 'drogasil');
  $('#drogasilurlv').val(urldrogasil);	
	var urlonofre = urldrogaraia.replace('drogaraia', 'onofre');
	  $('#onofreurlv').val(urlonofre);
	  
	  
	  
	  
var req = $('#drogaraiaurl').val();

$.ajax({
      type: "POST",
      dataType: "json",
      url: "drogaraia.php", //Relative or absolute path to response.php file
       data: { 
        'req': req 
       
    },
    dataType: 'json',
      success: function(data) {
if (data.indisponivel != null){
$('#alertraia').css('display','block');

}else{
$('#alertraia').css('display','none');

};
if (data.controlado != null){
$('#controladog').css('display','block');

}else{
$('#controladoraia').css('display','none');

};
$('#dname').html(data.nome);
       
     
   $('#dean').html(data.ean);

     $('#dprice').html(data.pricen);
     $('#dsprice').html(data.sprice);
     $('#dmarca').html(data.marca);
    $('#dfabricante').html(data.fabricante);
     $('#drms').html(data.rms);
     $('#dvolume').html(data.volume);
     $('#dindisponivel').html(data.indisponivel);
     $('#dsku').html(data.sku);
     $('#dcontrolado').html(data.controlado);

     $('#dqtd').html(data.qtd);

 $("#img").attr("src", (data.img));


data= undefined;


 }
    

});
	  
	  
	


  var drogaraiaurlv = $('#drogaraiaurlv').val();
var drogasilurlv = $('#drogasilurlv').val();
    var onofreurlv = $('#onofreurlv').val();
  var quali_sku = $('#quali_sku').val();
var ultraurlv = $('#ultraurlv').val();
  var spurlv = $('#spurlv').val();

  var bnwurlv = $('#bnwurlv').val();

//STATUS
var statusraia = $('#statusraia').val();
var statusonofre = $('#statusraia').val();
var statusdrogasil = $('#statusraia').val();
var statusquali = $('#statusquali').val();

var statusdsp = $('#statusdsp').val();
var statusultra = $('#statusultra').val();

var statusbnw = $('#statusbnw').val();


      $.ajax
        ({
          type: "POST",
          url: "update.php",
          data: { "quali_sku": quali_sku,  "statusbnw":statusbnw, "statusdsp":statusdsp,  "statusultra":statusultra,  "statusraia":statusraia, "statusonofre":statusonofre, "statusdrogasil":statusdrogasil, "bnwurlv":bnwurlv, "ultraurlv":ultraurlv, "drogaraiaurlv": drogaraiaurlv, "drogasilurlv": drogasilurlv, "onofreurlv":onofreurlv, "spurlv": spurlv, "statusquali":statusquali},
          success: function (data) {
            $('.result').html(data);
          }
        });
	  }

	
	
	
	
	);

	  
	  
	  
});


	(function($) {
		$(function() {
	
//DROGARAIA
	var urldrogaraia = "<?php echo $urlraia; ?>";
	
	
	$('#drogaraiaurl').val(urldrogaraia);
	$('#drogaraiaurlv').val(urldrogaraia);
	var urldrogasil = urldrogaraia.replace('drogaraia', 'drogasil');
  $('#drogasilurlv').val(urldrogasil);	
	var urlonofre = urldrogaraia.replace('drogaraia', 'onofre');
	  $('#onofreurlv').val(urlonofre);
	  
// DROGARIA SAO PAULO
		var urlsp = "<?php echo $urlsp; ?>";
	$('#spurl').val(urlsp);
	$('#spurlv').val(urlsp);

//ULTRAFARMA
		var urlultra = "<?php echo $urlultra; ?>";
	$('#ultraurl').val(urlultra);
	$('#ultraurlv').val(urlultra);

//BELEZANAWEB	
	var urlbnw = "<?php echo $urlbnw; ?>";
	$('#bnwurl').val(urlbnw);
	$('#bnwurlv').val(urlbnw);





		
 



 //DrogaRaia Busca Dados No Concorrente
			
var req = $('#drogaraiaurl').val();
if (req !== ""){
$('#raiabox').css('display','block');
}
$.ajax({
      type: "POST",
      dataType: "json",
      url: "drogaraia.php", //Relative or absolute path to response.php file
       data: { 
        'req': req 
       
    },
    dataType: 'json',
      success: function(data) {
if (data.indisponivel != null){
$('#alertraia').css('display','block');

};
if (data.controlado != null){
$('#controladog').css('display','block');

};
$('#dname').html(data.nome);
       
     
   $('#dean').html(data.ean);

     $('#dprice').html(data.pricen);
     $('#dsprice').html(data.sprice);
     $('#dmarca').html(data.marca);
    $('#dfabricante').html(data.fabricante);
     $('#drms').html(data.rms);
     $('#dvolume').html(data.volume);
     $('#dindisponivel').html(data.indisponivel);
     $('#dsku').html(data.sku);
     $('#dcontrolado').html(data.controlado);

     $('#dqtd').html(data.qtd);

 $("#img").attr("src", (data.img));

data= undefined;

 }
    

});

//DrogaSaoPaulo Busca Dados No Concorrente
			
var req2 = $('#spurl').val();
if (req2 !== ""){
$('#spbox').css('display','block');
}
$.ajax({
      type: "POST",
      dataType: "json",
      url: "drogariasp.php", //Relative or absolute path to response.php file
       data: { 
        'req2': req2 
       
    },
    dataType: 'json',
      success: function(data1) {


if (data1.controlado != null){
$('#controladog').css('display','block');
};


$('#dspname').html(data1.nome);
 $("#imgdsp").attr("src", (data1.img));
   $('#dspean').html(data1.ean);
     $('#dspsku').html(data1.sku);
    $('#dspprice').html(data1.pricen);
     $('#dspsprice').html(data1.sprice);
     $('#dspmarca').html(data1.marca);
   $('#dspfabricante').html(data1.fabricante);
    $('#dsprms').html(data1.rms);
     $('#dspvolume').html(data1.volume);
     $('#dspindisponivel').html(data1.indisponivel);

     $('#dspcontrolado').html(data1.controlado);

     $('#dspqtd').html(data1.qtd);

data1= undefined;

 }
    

});




//Ultrafarma Busca Dados No Concorrente
			
var req3 = $('#ultraurl').val();
if (req3 !== ""){
$('#ultrabox').css('display','block');
}
$.ajax({
      type: "POST",
      dataType: "json",
      url: "ultrafarma.php", //Relative or absolute path to response.php file
       data: { 
        'req3': req3 
       
    },
    dataType: 'json',
      success: function(data2) {

if (data2.indisponivel != null){
$('#alertultra').css('display','block');
$('#ultraindisponivel').html("Produto Indisponivel");

};
if (data2.controlado != ''){

$('#controladog').css('display','block');
};


$('#ultraname').html(data2.nome);
 $("#imgultra").attr("src", (data2.img));
   $('#ultraean').html(data2.ean);
     $('#ultrasku').html(data2.sku);
    $('#ultraprice').html(data2.pricen);
     $('#ultrasprice').html(data2.sprice);
     $('#ultramarca').html(data2.marca);
   $('#ultrafabricante').html(data2.fabricante);
    $('#ultrarms').html(data2.rms);
     $('#ultravolume').html(data2.volume);
   //  $('#ultraindisponivel').html(data2.indisponivel);

    // $('#ultracontrolado').html(data2.controlado);

     $('#ultraqtd').html(data2.qtd);

data2= undefined;

 }
    

});





//BelezaNaWeb Busca Dados No Concorrente
			
var req6 = $('#bnwurl').val();
if (req6 !== ""){
$('#bnwbox').css('display','block');
}
$.ajax({
      type: "POST",
      dataType: "json",
      url: "belezanaweb.php", //Relative or absolute path to response.php file
       data: { 
        'req6': req6 
       
    },
    dataType: 'json',
      success: function(data3) {

if (data3.indisponivel != null){
$('#alertbnw').css('display','block');
$('#bnwindisponivel').html("Produto Indisponivel");
};
if (data3.controlado != null){

$('#controladog').css('display','block');
};


$('#bnwname').html(data3.nome);
 $("#imgbnw").attr("src", (data3.img));
   $('#bnwean').html(data3.ean);
     $('#bnwsku').html(data3.sku);
    $('#bnwprice').html(data3.pricen);
     $('#bnwsprice').html(data3.sprice);
     $('#bnwmarca').html(data3.marca);
   $('#bnwfabricante').html(data3.fabricante);
    $('#bnwrms').html(data3.rms);
     $('#bnwvolume').html(data3.volume);
   // $('#bnwindisponivel').html(data3.indisponivel);

   //  $('#bnwcontrolado').html(data3.controlado);

     $('#bnwqtd').html(data3.qtd);

data3= undefined;

 }
    

});









		})
	})





(jQuery);


</script>




</body>

</html>
