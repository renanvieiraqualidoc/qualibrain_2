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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/comum.css" rel="stylesheet">
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
            <div class="columns is-mobile">
              <div class="column">
                <b-input placeholder="Código da Filial"
                    type="search"
                    @input="loadAsyncData"
                    v-model="filial"
                    icon="magnify"
                    icon-right-clickable
                    @icon-right-click="this.filial = ''">
                </b-input>
              </div>
            </div>
            <div class="columns is-mobile">
              <div class="column">
                <b-field>
                  <b-datepicker
                      v-model="date"
                      locale="pt-CA"
                      :mobile-native="false"
                      @blur="loadAsyncData"
                      placeholder="Data">
                  </b-datepicker>
                </b-field>
              </div>
            </div>
            <br/>
            <section>
              <div class="columns is-desktop is-mobile">
                <div class="column">
                  <b-table bordered striped narrowed sticky-header :loading="loading" :data="data">
                    <b-table-column centered :label="date.toLocaleDateString('pt-BR')" cell-class="is-sticky-column-one" header-class="is-sticky-column-one"><template v-slot="props"></template></b-table-column>
                    <b-table-column field="hora" label="Hora" :td-attrs="columnTdAttrs" centered>
                        <template v-slot="props">
                            {{ props.row.hora }}
                        </template>
                    </b-table-column>
                    <b-table-column field="qtd_nf" label="NF" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Quantidade de notas faturadas" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.qtd_nf_1 }}
                        </template>
                    </b-table-column>
                    <b-table-column field="total_faturado" label="Faturado" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Total faturado" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.total_faturado_1 }}
                        </template>
                    </b-table-column>
                    <b-table-column field="tkm" label="TKM" centered :td-attrs="columnTdAttrs">
                        <template v-slot="props">
                            {{ props.row.tkm_1 }}
                        </template>
                    </b-table-column>
                    <b-table-column centered :label="date_ontem.toLocaleDateString('pt-BR')" cell-class="is-sticky-column-two" header-class="is-sticky-column-two"><template v-slot="props"></template></b-table-column>
                    <b-table-column field="qtd_nf" label="NF" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Quantidade de notas faturadas" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.qtd_nf_2 }}
                        </template>
                    </b-table-column>
                    <b-table-column field="total_faturado" label="Faturado" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Total faturado" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.total_faturado_2 }}
                        </template>
                    </b-table-column>
                    <b-table-column field="tkm" label="TKM" centered :td-attrs="columnTdAttrs">
                        <template v-slot="props">
                            {{ props.row.tkm_2 }}
                        </template>
                    </b-table-column>
                    <b-table-column field="fat" label="Fat. Comp. Hoje" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Faturamento comparado a hoje" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                          <span :class="
                                  [
                                      'tag',
                                      {'is-warning': props.row.fat_1 >= 101 && props.row.fat_1 <= 110},
                                      {'is-danger': props.row.fat_1 > 110}
                                  ]">
                              {{ props.row.fat_1 == '-' ? '-' : props.row.fat_1.replace(".", ",") + '%' }}
                          </span>
                        </template>
                    </b-table-column>
                    <b-table-column centered :label="date_semana_passada.toLocaleDateString('pt-BR')" cell-class="is-sticky-column-three" header-class="is-sticky-column-three"><template v-slot="props"></template></b-table-column>
                    <b-table-column field="qtd_nf" label="NF" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Quantidade de notas faturadas" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.qtd_nf_3 }}
                        </template>
                    </b-table-column>
                    <b-table-column field="total_faturado" label="Faturado" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Total faturado" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.total_faturado_3 }}
                        </template>
                    </b-table-column>
                    <b-table-column field="tkm" label="TKM" centered :td-attrs="columnTdAttrs">
                        <template v-slot="props">
                            {{ props.row.tkm_3 }}
                        </template>
                    </b-table-column>
                    <b-table-column field="fat" label="Fat. Comp. Hoje" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Faturamento comparado a hoje" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                          <span :class="
                                  [
                                      'tag',
                                      {'is-warning': props.row.fat_2 >= 101 && props.row.fat_2 <= 110},
                                      {'is-danger': props.row.fat_2 > 110}
                                  ]">
                            {{ props.row.fat_2 == '-' ? '-' : props.row.fat_2.replace(".", ",") + '%' }}
                          </span>
                        </template>
                    </b-table-column>
                    <b-table-column field="fat2" label="Fat. Comp. Ontem" centered :td-attrs="columnTdAttrs">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Faturamento comparado a ontem" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                          <span :class="
                                  [
                                      'tag',
                                      {'is-warning': props.row.fat_3 >= 101 && props.row.fat_3 <= 110},
                                      {'is-danger': props.row.fat_3 > 110}
                                  ]">
                              {{ props.row.fat_3 == '-' ? '-' : props.row.fat_3.replace(".", ",") + '%' }}
                          </span>
                        </template>
                    </b-table-column>
                  </b-table>
                </div>
              </div>
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
<script>
    new Vue({
        el: '#app',
        data() {
            return {
                date: new Date(),
                date_ontem: new Date(),
                date_semana_passada: new Date(),
                data: [],
                total_final_qtd_nf_1: 0,
                total_faturado_final_1: 0,
                avg_ticket: 0,
                total_final_qtd_nf_2: 0,
                total_faturado_final_2: 0,
                avg_ticket_2: 0,
                fat_comp_hj_1: 0,
                total_final_qtd_nf_3: 0,
                total_faturado_final_3: 0,
                avg_ticket_3: 0,
                fat_comp_hj_2: 0,
                fat_comp_ontem: 0,
                loading: false,
                filial: 1007
            }
        },
        methods: {
          columnTdAttrs(row, column) {
              if (row.hora === 'Total') {
                  if (column.label !== 'Fat. Comp. Hoje' && column.label !== 'Fat. Comp. Ontem') {
                      return {
                          class: 'has-text-weight-bold',
                          style: {
                              'text-align': 'left !important'
                          }
                      }
                  }
              }
              return null
          },
          loadAsyncData() {
            const t = this
            this.loading = true
            // let response = []
            // response.data = {
            //   "items": [{
            //         "hour":0,
            //         "date":"08/04/2021 00:00:00",
            //         "quantity":20,
            //         "value":2346.86,
            //         "avgTicket":117.34,
            //         "dayBefore":"07/04/2021 00:00:00",
            //         "quantityDayBefore":7,
            //         "valueDayBefore":487.23,
            //         "avgTicketDayBefore":69.6,
            //         "weekAgo":"01/04/2021 00:00:00",
            //         "quantityWeekAgo":28,
            //         "valueWeekAgo":3606.4,
            //         "avgTicketWeekAgo":128.8
            //     },
            //     {
            //         "hour":1,
            //         "date":"08/04/2021 00:00:00",
            //         "quantity":5,
            //         "value":2040.6,
            //         "avgTicket":408.12,
            //         "dayBefore":"07/04/2021 00:00:00",
            //         "quantityDayBefore":3,
            //         "valueDayBefore":352.49,
            //         "avgTicketDayBefore":117.5,
            //         "weekAgo":"01/04/2021 00:00:00",
            //         "quantityWeekAgo":6,
            //         "valueWeekAgo":497.82,
            //         "avgTicketWeekAgo":82.97
            //     },
            //     {
            //         "hour":2,
            //         "date":"08/04/2021 00:00:00",
            //         "quantity":5,
            //         "value":783.25,
            //         "avgTicket":156.65,
            //         "dayBefore":"07/04/2021 00:00:00",
            //         "quantityDayBefore":3,
            //         "valueDayBefore":168.92,
            //         "avgTicketDayBefore":56.31,
            //         "weekAgo":"01/04/2021 00:00:00",
            //         "quantityWeekAgo":3,
            //         "valueWeekAgo":260.17,
            //         "avgTicketWeekAgo":86.72
            //     },
            //     {
            //         "hour":3,
            //         "date":"08/04/2021 00:00:00",
            //         "quantity":3,
            //         "value":261.58,
            //         "avgTicket":87.19,
            //         "dayBefore":"07/04/2021 00:00:00",
            //         "quantityDayBefore":1,
            //         "valueDayBefore":47.72,
            //         "avgTicketDayBefore":47.72,
            //         "weekAgo":"01/04/2021 00:00:00",
            //         "quantityWeekAgo":3,
            //         "valueWeekAgo":126.77,
            //         "avgTicketWeekAgo":42.26
            //     }
            //   ],
            //   "quantityItems":4,
            //   "item":null
            // }

            axios.get("api.php?filial=" + this.filial + "&data=" + this.date.toLocaleDateString('en-CA')).then((response) => {
                t.data_1 = []
                t.data_2 = []
                t.data_3 = []
                t.total_final_qtd_nf_1 = 0
                t.total_faturado_final_1 = 0
                t.avg_ticket = 0
                t.total_final_qtd_nf_2 = 0
                t.total_faturado_final_2 = 0
                t.avg_ticket_2 = 0
                t.fat_comp_hj_1 = 0
                t.total_final_qtd_nf_3 = 0
                t.total_faturado_final_3 = 0
                t.avg_ticket_3 = 0
                t.fat_comp_hj_2 = 0
                t.fat_comp_ontem = 0
                response.data.items.forEach((item) => {
                  t.data.push({
                    // Tabela de hoje
                    hora: item.hour,
                    qtd_nf_1: item.quantity,
                    total_faturado_1: "R$ " + item.value.toFixed(2).replace(".", ","),
                    tkm_1: item.value != 0 ? "R$ " + (item.value/item.quantity).toFixed(2).replace(".", ",") : '-',
                    // Tabela de ontem
                    qtd_nf_2: item.quantityDayBefore,
                    total_faturado_2: "R$ " + item.valueDayBefore.toFixed(2).replace(".", ","),
                    tkm_2: "R$ " + item.avgTicketDayBefore.toFixed(2).replace(".", ","),
                    fat_1: item.value != 0 ? ((item.valueDayBefore/item.value)*100).toFixed(2) : '-',
                    // Tabela da semana passada
                    qtd_nf_3: item.quantityWeekAgo,
                    total_faturado_3: "R$ " + item.valueWeekAgo.toFixed(2).replace(".", ","),
                    tkm_3: "R$ " + item.avgTicketWeekAgo.toFixed(2).replace(".", ","),
                    fat_2: item.value != 0 ? ((item.valueWeekAgo/item.value)*100).toFixed(2) : '-',
                    fat_3: item.valueDayBefore != 0 ? ((item.valueWeekAgo/item.valueDayBefore)*100).toFixed(2) : '-'
                  })

                  t.total_final_qtd_nf_1 += item.quantity
                  t.total_faturado_final_1 += item.value
                  t.avg_ticket += item.avgTicket
                  t.total_final_qtd_nf_2 += item.quantityDayBefore
                  t.total_faturado_final_2 += item.valueDayBefore
                  t.avg_ticket_2 += item.avgTicketDayBefore
                  t.total_final_qtd_nf_3 += item.quantityWeekAgo
                  t.total_faturado_final_3 += item.valueWeekAgo
                  t.avg_ticket_3 += item.avgTicketWeekAgo
                })

                t.fat_comp_hj_1 = ((t.total_faturado_final_2/t.total_faturado_final_1)*100).toFixed(2)
                t.fat_comp_hj_2 = ((t.total_faturado_final_3/t.total_faturado_final_1)*100).toFixed(2)
                t.fat_comp_ontem = ((t.total_faturado_final_3/t.total_faturado_final_2)*100).toFixed(2)
                t.total_faturado_final_1 = "R$ " + t.total_faturado_final_1.toFixed(2).replace(".", ",")
                t.avg_ticket = "R$ " + (t.avg_ticket/response.data.items.length).toFixed(2).replace(".", ",")
                t.total_faturado_final_2 = "R$ " + t.total_faturado_final_2.toFixed(2).replace(".", ",")
                t.avg_ticket_2 = "R$ " + (t.avg_ticket_2/response.data.items.length).toFixed(2).replace(".", ",")
                t.total_faturado_final_3 = "R$ " + t.total_faturado_final_3.toFixed(2).replace(".", ",")
                t.avg_ticket_3 = "R$ " + (t.avg_ticket_3/response.data.items.length).toFixed(2).replace(".", ",")

                // Totais
                t.data.push({
                  // Totais de hoje
                  '': '',
                  hora: 'Total',
                  qtd_nf_1: t.total_final_qtd_nf_1,
                  total_faturado_1: t.total_faturado_final_1,
                  tkm_1: t.avg_ticket,
                  // Totais de ontem
                  '': '',
                  qtd_nf_2: t.total_final_qtd_nf_2,
                  total_faturado_2: t.total_faturado_final_2,
                  tkm_2: t.avg_ticket_2,
                  fat_1: t.fat_comp_hj_1,
                  // Totais da semana passada
                  '': '',
                  qtd_nf_3: t.total_final_qtd_nf_3,
                  total_faturado_3: t.total_faturado_final_3,
                  tkm_3: t.avg_ticket_3,
                  fat_2: t.fat_comp_hj_2,
                  fat_3: t.fat_comp_ontem
                })

                t.date_ontem.setDate(t.date.getDate() - 1)
                t.date_semana_passada.setDate(t.date.getDate() - 7)
                t.loading = false
            }).catch((error) => {
                t.data = []
                t.total_final_qtd_nf_1 = 0
                t.total_faturado_final_1 = 0
                t.avg_ticket = 0
                t.total_final_qtd_nf_2 = 0
                t.total_faturado_final_2 = 0
                t.avg_ticket_2 = 0
                t.fat_comp_hj_1 = 0
                t.total_final_qtd_nf_3 = 0
                t.total_faturado_final_3 = 0
                t.avg_ticket_3 = 0
                t.fat_comp_hj_2 = 0
                t.fat_comp_ontem = 0
                t.loading = false
                throw error
            })
          }
        },
        mounted() {
            this.loadAsyncData()
        }
    })
</script>

<style>
.is-sticky-column-one {
    background: #56926c !important;
    color: white !important;
}
.is-sticky-column-two {
    background: #71927d !important;
    color: white !important;
}
.is-sticky-column-three {
    background: #949a96 !important;
    color: white !important;
}
</style>
