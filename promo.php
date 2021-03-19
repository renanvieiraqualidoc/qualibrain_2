<?php
include_once("config/dbconfig.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Promoções  - OVERVIEW</title>

    <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/sb-admin-2.min.css" rel="stylesheet">
<link href="css/comum.css" rel="stylesheet">



</head>

<body id="page-top" onload="myFunction()">


<style>
#divContent{
  overflow:scroll; 
  border:solid 1px red;
max-width:600px;
max-height:200px;
display:none;
height:200px;
}

/* mobile phone */
@media screen and (max-width:300px)and (max-height:200px){
    #divContent{
     overflow:scroll; 
       border:solid 1px green;
    }
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
    height: 360px;
    left: 50%;
    margin: -120px 0 0 -160px;
    padding: 10px;
    position: fixed;
    top: 50%;
    width: 620px;
    z-index: 1000;
}



#modal-background.active, #modal-content.active {
    display: block;
}​


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
<form method='post' name='busca' id='busca'>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"></h1>
            <input type="file"  id="file" name="file" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
          </div>
</form>
<div class="card">
  <div class="card-header">
Promoções 
  </div>
  <div class="card-body">
 <div class="table-responsive">
   <blockquote class="blockquote mb-0">
      <center><p></p></center>
<div> <center>    <button id="startProgress" class="btn btn-primary" type="button" name="startProgress" value="start progress"/>Ativar Promoções </button></center></di$
<br>
    </blockquote>
    
            <table class="display table table-bordered table-sm table-hover" id="" width="100%" cellspacing="0">


                  <thead class="thead-dark">
                    <tr>

                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      
                      <th>PAGUE APENAS</th>
<th>PAGUE APENAS PROMO</th>
<th>CASHBACK</th>
<th>CASHBACK PROMO</th>



                 
<th>ESTOQUE</th>
<th>PROMO</th>
<th>INICIO</th>
<th>VALIDADE</th>
<th>AÇÃO</th>

                    </tr>
                  </thead>
                  <tfoot class="thead-dark">

               <tr>

                             <th>SKU</th>
                      <th>TITULO</th>
                      <th>DEPARTAMENTO</th>

                      <th>CATEGORIA</th>
                      <th>CUSTO</th>

                      
                      <th>PAGUE APENAS</th>
<th>PAGUE APENAS PROMO</th>
<th>CASHBACK</th>
<th>CASHBACK PROMO</th>



                 
<th>ESTOQUE</th>
<th>PROMO</th>
<th>INICIO</th>
<th>VALIDADE</th>
<th>AÇÃO</th>

                    </tr>
                  </tfoot>
                  <tbody>

<style>
.header
{cursor: pointer;}
</style>

<?php

$consultatotalpromo = "SELECT promo.sku, Products.title, Products.department, Products.category, Products.price_cost, Products.current_price_pay_only,
promo.target_price, Products.current_cashback, promo.target_cashback, Products.qty_stock_rms, promo.nome, promo.inicio, promo.validade, promo.active from promo INNER JOIN Products ON promo.sku = Products.sku";
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
 echo  '<td>'.$rowtp[9].'</td>';
 echo  '<td>'.$rowtp[10].'</td>';
 echo  '<td>'.$rowtp[11].'</td>';
echo  '<td>'.$rowtp[12].'</td>';

if ($rowtp[12] = 1 ) {
echo  '<td><center><i class="fa fa-toggle-on fa-2x" aria-hidden="true"></i></center></td>';
}else{
echo  '<td><center><i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i></center></td>';
}


echo    '</tr>';

}
 mysqli_close($conn);
?>



                  </tbody>
                </table>
</div>
    

  


       
        
 


<div id="modal-background"></div>

<div id="modal-content">  <div class="modal-header">
        <h5 class="modal-title">Inserindo Produtos. Aguarde...</h5>
<button type="button" class="close" data-dismiss="#modal-background #modal-content" id="fechamodal" "aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <form action="" method="POST" >
<br>
<div id="spinner">
<div class="d-flex justify-content-center">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
</div>
 
</div>

</div>
<br>

<div id="progress-wrp">
      <center><div class="row" id="divContent">
<div id="progress"></div>   
 
</div></center>




 
 </form>


  </div>

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


 <script type="text/javascript">
   

$('#file').on('change', function() {
    var file_data = $('#file').prop('files')[0];   
    var form_data = new FormData();                  
    form_data.append('file', file_data);
 $("#modal-content, #modal-background").toggleClass("active");
    $.ajax({
        url: 'updatepromo.php', // point to server-side PHP script 
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



$(document).ready(function(){
        $("#startProgress").click(function(){
 $("#modal-content, #modal-background").toggleClass("active");
$("#fechamodal").css("display", "none");

   $("#spinner").css("display", "block");
$("#divContent").css("display", "block");

 $.ajax({
            xhr: function() {

                    var xhr = new window.XMLHttpRequest();
                    xhr.addEventListener("progress", function(e){
                        //console.log(e.currentTarget.response);
                        $("#progress").html(e.currentTarget.response);
                    });
                return xhr;

            }
            , type: 'post'
            , cache: false
            , url: "script/upurlquali.php"
, success:function(response) {
$("#spinner").css("display", "none");

$("#fechamodal").css("display", "block");

     }
        });

    });

});

$(document).ready(function(){
        $("#fechamodal").click(function(){

    location.reload();
});
})
</script>

<script>
$(document).ready(function() {
    $('table.display').DataTable();
} );
</script>


</body>

</html>

