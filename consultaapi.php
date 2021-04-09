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
          <div id="app" >
            <h1 class="title">Consulta de Faturamento</h1>
            <b-field>
                <b-datepicker
                    v-model="date"
                    @blur="loadAsyncData"
                    placeholder="Data">
                </b-datepicker>
            </b-field>
            <!-- <section>
                <b-table
                    bordered
                    striped
                    narrowed
                    sticky-header
                    paginated
                    backend-pagination
                    backend-sorting
                    detailed
                    detail-key="codigo"
                    @details-open="(row) => set_data_items(row)"
                    @page-change="onPageChange"
                    @sort="onSort"
                    :default-sort-direction="defaultSortOrder"
                    :default-sort="[sortField, sortOrder]"
                    :per-page="perPage"
                    :total="total"
                    :loading="loading"
                    :data="data"
                    :columns="columns">
                    <template slot="detail" slot-scope="props">
                        <b-table sortable :data="data_items" :selected.sync="selected">
                          <b-table-column centered subheading="Média:"><template v-slot="props"></template></b-table-column>
                          <b-table-column field="items.preco_custo" label="Preço Custo" sortable centered>
                              <template v-slot="props">
                                  {{ props.row.preco_custo }}
                              </template>
                          </b-table-column>
                          <b-table-column field="items.website_monitorado" label="Website Monitorado" centered>
                              <template v-slot="props">
                                  {{ props.row.website_monitorado }}
                              </template>
                          </b-table-column>
                          <b-table-column field="items.url_monitorado" label="URL Produto Monitorado" centered>
                              <template v-slot="props">
                                  {{ props.row.url_monitorado }}
                              </template>
                          </b-table-column>
                          <b-table-column field="items.data" label="Data" centered sortable>
                              <template v-slot="props">
                                  {{ props.row.data }}
                              </template>
                          </b-table-column>
                          <b-table-column field="items.hora" label="Hora" centered sortable>
                              <template v-slot="props">
                                  {{ props.row.hora }}
                              </template>
                          </b-table-column>
                          <b-table-column field="items.preco_oferta" label="Preço Oferta" centered :subheading="media(props.row)" sortable>
                              <template v-slot="props">
                                  {{ props.row.preco_oferta }}
                              </template>
                          </b-table-column>
                        </b-table>
                    </template>
                </b-table>
            </section> -->
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
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                date: new Date(),
                // data: [],
                // loading: false,
                // total: 0,
                // perPage: 1000,
                // page: 1,
                // defaultSortOrder: 'desc',
                // sortField: 'data',
                // codigo: '',
                // sortOrder: 'desc',
                // data_group: [],
                // data_items: [],
                // selected: null,
                // columns: [{ field: 'codigo', label: 'Código SKU', sortable: true, centered: true },
                //           { field: 'descricao', label: 'Descrição do Produto', sortable: true, centered: true },
                //           { field: 'url_monitor', label: 'URL Monitor', centered: true }]
            }
        },
        methods: {
          // set_data_items(row) {
          //   this.data_group.filter(r => {
          //     if (r.codigo == row.codigo) {
          //       this.data_items = r.items
          //     }
          //   })
          // },
          // media(row) {
          //   let soma = 0
          //   let it = 0
          //   let items = []
          //   this.data_group.filter(r => {
          //     if (r.codigo == row.codigo) {
          //       items = r.items
          //     }
          //   })
          //
          //   items.filter(i => {
          //     if(!i.website_monitorado.includes("qualidoc") && i.preco_oferta.replace( /^\D+/g, '').replace(",", ".") != 0) {
          //       soma += parseFloat(i.preco_oferta.replace( /^\D+/g, '').replace(",", "."))
          //       it++
          //     }
          //   })
          //   return "R$ " + (soma/it).toFixed(2).replace(".", ",")
          // },
          // onPageChange(page) {
          //     this.page = page
          //     this.loadAsyncData()
          // },
          // onSort(field, order) {
          //     this.sortField = field
          //     this.sortOrder = order
          //     this.loadAsyncData()
          // },
          // emptyData() {
          //     while(this.data.length > 0) {
          //         this.data.pop();
          //     }
          // },
          loadAsyncData() {
            const t = this
            // this.loading = true
            let response = {
              "items": [{
                    "hour":0,
                    "date":"08/04/2021 00:00:00",
                    "quantity":20,
                    "value":2346.86,
                    "avgTicket":117.34,
                    "dayBefore":"07/04/2021 00:00:00",
                    "quantityDayBefore":7,
                    "valueDayBefore":487.23,
                    "avgTicketDayBefore":69.6,
                    "weekAgo":"01/04/2021 00:00:00",
                    "quantityWeekAgo":28,
                    "valueWeekAgo":3606.4,
                    "avgTicketWeekAgo":128.8
                },
                {
                    "hour":1,
                    "date":"08/04/2021 00:00:00",
                    "quantity":5,
                    "value":2040.6,
                    "avgTicket":408.12,
                    "dayBefore":"07/04/2021 00:00:00",
                    "quantityDayBefore":3,
                    "valueDayBefore":352.49,
                    "avgTicketDayBefore":117.5,
                    "weekAgo":"01/04/2021 00:00:00",
                    "quantityWeekAgo":6,
                    "valueWeekAgo":497.82,
                    "avgTicketWeekAgo":82.97
                },
                {
                    "hour":2,
                    "date":"08/04/2021 00:00:00",
                    "quantity":5,
                    "value":783.25,
                    "avgTicket":156.65,
                    "dayBefore":"07/04/2021 00:00:00",
                    "quantityDayBefore":3,
                    "valueDayBefore":168.92,
                    "avgTicketDayBefore":56.31,
                    "weekAgo":"01/04/2021 00:00:00",
                    "quantityWeekAgo":3,
                    "valueWeekAgo":260.17,
                    "avgTicketWeekAgo":86.72
                },
                {
                    "hour":3,
                    "date":"08/04/2021 00:00:00",
                    "quantity":3,
                    "value":261.58,
                    "avgTicket":87.19,
                    "dayBefore":"07/04/2021 00:00:00",
                    "quantityDayBefore":1,
                    "valueDayBefore":47.72,
                    "avgTicketDayBefore":47.72,
                    "weekAgo":"01/04/2021 00:00:00",
                    "quantityWeekAgo":3,
                    "valueWeekAgo":126.77,
                    "avgTicketWeekAgo":42.26
                }
              ],
              "quantityItems":4,
              "item":null
            }
            console.log(response.items)
            // axios.get("api.php?data=" + ((this.date == null) ? '' : this.date.toLocaleDateString())).then((response) => {
                // t.emptyData()
                // t.data_group = []
                // t.data_items = []
                // let currentTotal = response.data.total_results
                // if (response.data.total_results / t.perPage > 1000) {
                //     currentTotal = t.perPage * 1000
                // }
                // t.total = currentTotal
                // response.data.results.forEach((item) => {
                //   if(!t.data_group.some(d => d.codigo == item.codigo)) { // Não existe
                //     t.data.push({
                //       codigo: item.codigo,
                //       descricao: item.descricao,
                //       url_monitor: item.url_monitor
                //     })
                //     t.data_group.push({
                //       codigo: item.codigo,
                //       descricao: item.descricao,
                //       url_monitor: item.url_monitor,
                //       items: [{
                //         preco_custo: item.preco_custo,
                //         website_monitorado: item.website_monitorado,
                //         url_monitorado: item.url_monitorado,
                //         preco_oferta: item.preco_oferta,
                //         hora: item.hora,
                //         data: item.data
                //       }]
                //     })
                //   }
                //   else { // Já existe
                //     t.data_group.map(d => {
                //       if(d.codigo == item.codigo) {
                //         d.items.push({
                //           preco_custo: item.preco_custo,
                //           website_monitorado: item.website_monitorado,
                //           url_monitorado: item.url_monitorado,
                //           preco_oferta: item.preco_oferta,
                //           hora: item.hora,
                //           data: item.data
                //         })
                //       }
                //     })
                //   }
                // })
                // t.loading = false
            // }).catch((error) => {
                // t.emptyData()
                // t.data_group = []
                // t.data_items = []
                // t.total = 0
                // t.loading = false
            //     throw error
            // })
          }
        },
        mounted() {
            this.loadAsyncData()
        }
    })
</script>
