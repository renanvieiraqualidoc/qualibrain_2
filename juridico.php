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

header('Content-Type: text/html; charset=utf-8'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>QualiBrain - Qualidoc</title>
    <link rel="stylesheet" href="https://unpkg.com/buefy/dist/buefy.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.8.55/css/materialdesignicons.min.css">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../css/comum.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include('sidebar.html'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include('topbar.php'); ?>
        <div class="container-fluid">
          <div id="app" class="container">
            <section>
                <b-table
                    bordered
                    striped
                    narrowed
                    sticky-header
                    paginated
                    pagination-simple
                    per-page="10"
                    detailed
                    detail-key="codigo"
                    @details-open="(row) => set_data_items(row)"
                    :data="data"
                    :columns="columns">
                    <template slot="detail" slot-scope="props">
                        <b-table sortable :data="data_items" :columns="columns_items" :selected.sync="selected"></b-table>
                    </template>
                </b-table>
            </section>
          </div>
        </div>
      </div>
      <?php include('footer.html')?>;
    </div>
  </div>

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
</body>
</html>

<script src="https://unpkg.com/vue"></script>
<script src="https://unpkg.com/buefy/dist/buefy.min.js"></script>
<script src="https://rawgit.com/vuejs-tips/v-money/master/dist/v-money.js"></script>
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                data: [],
                data_group: [],
                data_items: [],
                selected: [],
                money: {
                   decimal: ',',
                   thousands: '.',
                   prefix: 'R$ ',
                   suffix: ' #',
                   precision: 2,
                   masked: false
                },
                columns: [{ field: 'codigo', label: 'Código SKU', sortable: true, searchable: true, centered: true, width: "148" },
                          { field: 'descricao', label: 'Descrição do Produto', sortable: true, centered: true, width: "468" },
                          { field: 'data', label: 'Data', sortable: true, searchable: true, centered: true, width: "85" },
                          { field: 'url_monitor', label: 'URL Monitor', centered: true, width: "581" }],
                columns_items: [{ field: 'preco_custo', label: 'Preço de Custo', sortable: true, centered: true, width: "162" },
                                { field: 'website_monitorado', label: 'Website Monitorado', centered: true },
                                { field: 'url_monitorado', label: 'URL Produto Monitorado', centered: true },
                                { field: 'hora', label: 'Hora', sortable: true, searchable: true, centered: true, width: "91" },
                                { field: 'preco_oferta', label: 'Preço Oferta', sortable: true, centered: true, width: "154" }]
            }
        },
        methods: {
          set_data_items(row) {
            this.data_group.filter(r => {
              if (r.codigo == row.codigo) {
                this.data_items = r.items
              }
            })
          },
          loadAsyncData() {
            let response = [{
              'codigo': '1000586',
              'descricao': 'Novalgina 1g 10 Comprimidos',
              'preco_custo': 15.3,
              'website_monitorado': 'www.drogariasaopaulo.com.br',
              'url_monitorado': 'https://www.drogariasaopaulo.com.br/analgesico-novalgina-1g-10-comprimidos/p',
              'data': '05/03/2021',
              'hora': '07:00',
              'preco_oferta': 17.9,
              'url_monitor': 'https://monitor.precifica.com.br/index.php/Produtos?act=edit&id=13717542'
            },
            {
              'codigo': '1000586',
              'descricao': 'Novalgina 1g 10 Comprimidos',
              'preco_custo': 15.3,
              'website_monitorado': 'www.drogaraia.com.br',
              'url_monitorado': 'https://www.drogaraia.com.br/novalgina-1-grama-10-comprimidos.html',
              'data': '05/03/2021',
              'hora': '07:00',
              'preco_oferta': 20.96,
              'url_monitor': 'https://monitor.precifica.com.br/index.php/Produtos?act=edit&id=13717542'
            },
            {
              'codigo': '1000837',
              'descricao': 'Apevitin BC Xarope 240ml',
              'preco_custo': 11.83,
              'website_monitorado': 'www.ultrafarma.com.br',
              'url_monitorado': 'https://www.ultrafarma.com.br/apevitin-bc-xarope-com-240ml',
              'data': '05/03/2021',
              'hora': '07:00',
              'preco_oferta': '',
              'url_monitor': 'https://monitor.precifica.com.br/index.php/Produtos?act=edit&id=13717567'
            },
            {
              'codigo': '1000837',
              'descricao': 'Apevitin BC Xarope 240ml',
              'preco_custo': 11.83,
              'website_monitorado': 'www.qualidoc.com.br',
              'url_monitorado': 'https://www.qualidoc.com.br/apevitin-bc-xarope-240ml/product/1000837',
              'data': '05/03/2021',
              'hora': '07:00',
              'preco_oferta': 17.75,
              'url_monitor': 'https://monitor.precifica.com.br/index.php/Produtos?act=edit&id=13717567'
            },
            {
              'codigo': '1000845',
              'descricao': 'Nesina 25mg 30 Comprimidos Revestidos',
              'preco_custo': 74.49,
              'website_monitorado': 'www.drogasil.com.br',
              'url_monitorado': 'https://www.drogasil.com.br/nesina-25-mg-30-comprimidos-revestidos.html',
              'data': '05/03/2021',
              'hora': '07:00',
              'preco_oferta': 74.49,
              'url_monitor': 'https://monitor.precifica.com.br/index.php/Produtos?act=edit&id=13717568'
            },
            {
              'codigo': '1000845',
              'descricao': 'Nesina 25mg 30 Comprimidos Revestidos',
              'preco_custo': 74.49,
              'website_monitorado': 'www.ultrafarma.com.br',
              'url_monitorado': 'https://www.ultrafarma.com.br/nesina-25-mg-com-30-comprimidos',
              'data': '05/03/2021',
              'hora': '07:00',
              'preco_oferta': 90.76,
              'url_monitor': 'https://monitor.precifica.com.br/index.php/Produtos?act=edit&id=13717568'
            }]

            // Agrupa os produtos pelos códigos SKU's
            response.filter(r => {
              // Verifica se código já foi inserido
              if(!this.data_group.some(data => data.codigo == r.codigo)) { // Não existe
                this.data.push({
                  codigo: r.codigo,
                  descricao: r.descricao,
                  data: r.data,
                  url_monitor: r.url_monitor
                })
                this.data_group.push({
                  codigo: r.codigo,
                  descricao: r.descricao,
                  data: r.data,
                  url_monitor: r.url_monitor,
                  items: [{
                    preco_custo: '<money v-model="' + r.preco_custo + '" v-bind="money">' + r.preco_custo + '</money>',
                    // preco_custo: '<input v-model="' + r.preco_custo + '" />',
                    website_monitorado: r.website_monitorado,
                    url_monitorado: r.url_monitorado,
                    preco_oferta: r.preco_oferta,
                    hora: r.hora
                  }]
                })
              }
              else { // Já existe
                this.data_group.map(data => {
                  if(data.codigo == r.codigo) {
                    data.items.push({
                      preco_custo: r.preco_custo,
                      website_monitorado: r.website_monitorado,
                      url_monitorado: r.url_monitorado,
                      preco_oferta: r.preco_oferta,
                      hora: r.hora
                    })
                  }
                })
              }
            })
          }
        },
        mounted() {
            this.loadAsyncData()
        }
    })
</script>
