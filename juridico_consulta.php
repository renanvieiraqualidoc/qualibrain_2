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
    <link href="./vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="./vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
    <link href="./css/comum.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include('sidebar.html'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include('topbar.php'); ?>
        <div class="container-fluid">
          <div id="app" class="container">
            <h1 class="title">Consulta de Logs</h1>
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
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://rawgit.com/vuejs-tips/v-money/master/dist/v-money.js"></script>
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                data: [],
                data_group: [],
                response: [],
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
            const t = this

            axios.get('juridico/consultalogs.php').then(({ data }) => {
                data.forEach((item) => {
                    t.response.push(item)
                    if(!t.data_group.some(d => d.codigo == item.codigo)) { // Não existe
                      t.data.push({
                        codigo: item.codigo,
                        descricao: item.descricao,
                        data: item.data,
                        url_monitor: item.url_monitor
                      })
                      t.data_group.push({
                        codigo: item.codigo,
                        descricao: item.descricao,
                        data: item.data,
                        url_monitor: item.url_monitor,
                        items: [{
                          preco_custo: item.preco_custo,
                          website_monitorado: item.website_monitorado,
                          url_monitorado: item.url_monitorado,
                          preco_oferta: item.preco_oferta,
                          hora: item.hora
                        }]
                      })
                    }
                    else { // Já existe
                      t.data_group.map(d => {
                        if(d.codigo == item.codigo) {
                          d.items.push({
                            preco_custo: item.preco_custo,
                            website_monitorado: item.website_monitorado,
                            url_monitorado: item.url_monitorado,
                            preco_oferta: item.preco_oferta,
                            hora: item.hora
                          })
                        }
                      })
                    }
                })
            }).catch((error) => {
                throw error
            })
          }
        },
        mounted() {
            this.loadAsyncData()
        }
    })
</script>
