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
?>


<html>
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




	<div class="modal-body border">


<br>
<div class="container">
  <div class="row">
    <div class="col-6">
<h4>Cenario Atual</h4>    
  <div class="container ">
  <div class="row">
    <div class="col-sm">
      <select class="custom-select" name="departamento" id="departamento" >
  <option selected value="">Departamento</option>

  <option value="medicamento">Medicamento</option>
  <option value="perfumaria">Perfumaria</option>
  <option value="NAO">Nao Medicamento</option>



</select>
    </div>
    <div class="col-sm">
  <select class="custom-select" name="categoria" id="categoria" >
  <option selected value="">Categoria</option>


  <option value="dermocosm">Dermocosmetico</option>
  <option value="beleza">Beleza</option>
  <option value="generico">Generico</option>



</select>
  
  
    </div>
    <div class="col-sm">
     <select class="custom-select" name="curva" id="curva" >
  <option selected value="">Curva</option>
<option value="A">Curva A</option>

  <option value="B">Curva B</option>
  <option value="C">Curva C</option>



</select>
    </div>
  </div>
</div>
    
    
    </div>
    <div class="col">
<h4>Cenario Simulado</h4>    

 <div class="container">
  <div class="row">
    <div class="col-sm">
      <label for="points">Discrepância:</label>

<input type="range" value="0" min="0" max="30" id="discsim" oninput="this.nextElementSibling.value = this.value">
<output>0</output>

    </div>
    <div class="col-sm">
      <label for="points">Margem:</label>

<input type="range" value="0" min="0" max="50" id="margemsim" oninput="this.nextElementSibling.value = this.value">
<output>0</output>

    </div>
  </div>
</div>
   
   
    </div>
  </div>



  


 


    


   


 
<br>
<div class="row">
    <div class="col-6">
      <div class="container">
  <div class="row">
    <div class="col-sm border">
<label for="points">Discrepância:</label>

<input type="range" value="0" min="0" max="30" id="disc1" oninput="this.nextElementSibling.value = this.value">
<output>0</output>
<input type="range" value="500" min="3" max="500" id="disc2" oninput="this.nextElementSibling.value = this.value">
<output>500</output>
     
    </div>
    <div class="col-sm border">
        
<label for="points">Margem:</label>

<input type="range" value="-80" id="marg1" min="-80" max="40" oninput="this.nextElementSibling.value = this.value">
<output>-80</output>
<input type="range" value="40" id="marg2" min="-40" max="40" oninput="this.nextElementSibling.value = this.value">
<output>40</output>


   
    </div>
  </div>
</div>
    
    
    </div>
    <div class="col">
 <div class="container">
  <div class="row">
    <div class="col-sm">

<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Markup</label>
    <input type="number" class="form-control" id="markup" aria-describedby="markuphelp" placeholder="0">
    <small id="markuphelp" class="form-text text-muted">Digite o Markup desejado.</small>
  </div>
    </div>
    <div class="col-sm">
    </div>
 
  </div>
</div>
   
   
    </div>

   



</div>






<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){ /* PREPARE THE SCRIPT */
    $("#departamento").change(function(){ /* WHEN YOU CHANGE AND SELECT FROM THE SELECT FIELD */
//$("#element option:selected").
      var departamento = $("#departamento").val(); /* GET THE VALUE OF THE SELECTED DATA */
var categoria = $("#categoria").val();
var curva = $("#curva").val();
var marg1 = $("#marg1").val();
var marg2 = $("#marg2").val();
var disc1 = $("#disc1").val();
var disc2 = $("#disc2").val();

     // var dataString = departamento; /* STORE THAT TO A DATA STRING */
var dataString = departamento;

     $.ajax({ /* THEN THE AJAX CALL */        type: "POST", /* TYPE OF METHOD TO USE TO PASS THE DATA */
        url: "get-datasimulator.php", /* PAGE WHERE WE WILL PASS THE DATA */
        data: {departamento: departamento, curva: curva, categoria: categoria, disc1: disc1, disc2: disc2, marg1:marg1, marg2:marg2},
 /* THE DATA WE WILL BE PASSING */
        success: function(result){ /* GET THE TO BE RETURNED DATA */
          $("#show").html(result); /* THE RETURNED DATA WILL BE SHOWN IN THIS DIV */
        }
      });

    });
  });
</script>






<br>
<div id="show">
  <!-- ITEMS TO BE DISPLAYED HERE -->
</div>
<br>


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

<script>

$(document).ready(function() {
    $('table.display').DataTable( {
        "order": [[ 2, "desc" ]]
    } );
} );

</script>


</body>
</html>
