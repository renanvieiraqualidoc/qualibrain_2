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
            <b-field>
                <b-input placeholder="Código da Filial"
                    type="search"
                    @input="loadAsyncData"
                    v-model="filial"
                    icon="magnify"
                    icon-right-clickable
                    @icon-right-click="this.filial = ''">
                </b-input>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <b-datepicker
                    v-model="date"
                    @blur="loadAsyncData"
                    placeholder="Data">
                </b-datepicker>
            </b-field>
            <section>
              <div class="columns is-desktop is-mobile">
                <h1 class="title">Tabela de hoje</h1>
                <div class="column">
                  <b-table bordered striped narrowed sticky-header :data="data_1">
                    <b-table-column centered subheading="Total:"><template v-slot="props"></template></b-table-column>
                    <b-table-column field="hora" label="Hora" centered>
                        <template v-slot="props">
                            {{ props.row.hora }}
                        </template>
                    </b-table-column>
                    <b-table-column field="qtd_nf" label="NF" centered :subheading="total_final_qtd_nf_1">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Quantidade de notas faturadas" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.qtd_nf }}
                        </template>
                    </b-table-column>
                    <b-table-column field="total_faturado" label="Faturado" centered :subheading="total_faturado_final_1">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Total faturado" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.total_faturado }}
                        </template>
                    </b-table-column>
                    <b-table-column field="tkm" label="TKM" centered :subheading="avg_ticket">
                        <template v-slot="props">
                            {{ props.row.tkm }}
                        </template>
                    </b-table-column>
                  </b-table>
                </div>
                <div class="column">
                  <h1 class="title">Tabela de ontem</h1>
                  <b-table bordered striped narrowed sticky-header :data="data_2">
                    <b-table-column centered subheading="Total:"><template v-slot="props"></template></b-table-column>
                    <b-table-column field="qtd_nf" label="NF" centered :subheading="total_final_qtd_nf_2">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Quantidade de notas faturadas" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.qtd_nf }}
                        </template>
                    </b-table-column>
                    <b-table-column field="total_faturado" label="Faturado" centered :subheading="total_faturado_final_2">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Total faturado" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.total_faturado }}
                        </template>
                    </b-table-column>
                    <b-table-column field="tkm" label="TKM" centered :subheading="avg_ticket_2">
                        <template v-slot="props">
                            {{ props.row.tkm }}
                        </template>
                    </b-table-column>
                    <b-table-column field="fat" label="Hoje" centered :subheading="fat_comp_hj_1">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Faturamento comparado a hoje" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                          <span :class="
                                  [
                                      'tag',
                                      {'is-warning': props.row.fat >= 101 && props.row.fat <= 110},
                                      {'is-danger': props.row.fat > 110}
                                  ]">
                              {{ props.row.fat }}%
                          </span>
                        </template>
                    </b-table-column>
                  </b-table>
                </div>
                <div class="column">
                  <h1 class="title">Tabela da semana passada</h1>
                  <b-table bordered striped narrowed sticky-header :data="data_3">
                    <b-table-column centered subheading="Total:"><template v-slot="props"></template></b-table-column>
                    <b-table-column field="qtd_nf" label="NF" centered :subheading="total_final_qtd_nf_3">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Quantidade de notas faturadas" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.qtd_nf }}
                        </template>
                    </b-table-column>
                    <b-table-column field="total_faturado" label="Faturado" centered :subheading="total_faturado_final_3">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Total faturado" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                            {{ props.row.total_faturado }}
                        </template>
                    </b-table-column>
                    <b-table-column field="tkm" label="TKM" centered :subheading="avg_ticket_3">
                        <template v-slot="props">
                            {{ props.row.tkm }}
                        </template>
                    </b-table-column>
                    <b-table-column field="fat" label="Hoje" centered :subheading="fat_comp_hj_2">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Faturamento comparado a hoje" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                          <span :class="
                                  [
                                      'tag',
                                      {'is-warning': props.row.fat >= 101 && props.row.fat <= 110},
                                      {'is-danger': props.row.fat > 110}
                                  ]">
                              {{ props.row.fat }}%
                          </span>
                        </template>
                    </b-table-column>
                    <b-table-column field="fat2" label="Ontem" centered :subheading="fat_comp_ontem">
                        <template v-slot:header="{ column }">
                          <b-tooltip label="Faturamento comparado a ontem" append-to-body dashed>
                            {{ column.label }}
                          </b-tooltip>
                        </template>
                        <template v-slot="props">
                          <span :class="
                                  [
                                      'tag',
                                      {'is-warning': props.row.fat2 >= 101 && props.row.fat2 <= 110},
                                      {'is-danger': props.row.fat2 > 110}
                                  ]">
                              {{ props.row.fat2 }}%
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
                data_1: [],
                total_final_qtd_nf_1: 0,
                total_faturado_final_1: 0,
                avg_ticket: 0,
                data_2: [],
                total_final_qtd_nf_2: 0,
                total_faturado_final_2: 0,
                avg_ticket_2: 0,
                fat_comp_hj_1: 0,
                data_3: [],
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

            axios.get("api.php?filial=" + this.filial + "&data=" + ((this.date == null) ? '' : this.date.toLocaleDateString())).then((response) => {
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
                  // Tabela de hoje
                  t.data_1.push({
                    hora: item.hour,
                    qtd_nf: item.quantity,
                    total_faturado: "R$ " + item.value.toFixed(2).replace(".", ","),
                    tkm: "R$ " + (item.value/item.quantity).toFixed(2).replace(".", ",")
                  })
                  t.total_final_qtd_nf_1 += item.quantity
                  t.total_faturado_final_1 += item.value
                  t.avg_ticket += item.avgTicket

                  // Tabela de ontem
                  t.data_2.push({
                    qtd_nf: item.quantityDayBefore,
                    total_faturado: "R$ " + item.valueDayBefore.toFixed(2).replace(".", ","),
                    tkm: "R$ " + item.avgTicketDayBefore.toFixed(2).replace(".", ","),
                    fat: ((item.valueDayBefore/item.value)*100).toFixed(2),
                  })
                  t.total_final_qtd_nf_2 += item.quantityDayBefore
                  t.total_faturado_final_2 += item.valueDayBefore
                  t.avg_ticket_2 += item.avgTicketDayBefore

                  // Tabela da semana passada
                  t.data_3.push({
                    qtd_nf: item.quantityWeekAgo,
                    total_faturado: "R$ " + item.valueWeekAgo.toFixed(2).replace(".", ","),
                    tkm: "R$ " + item.avgTicketWeekAgo.toFixed(2).replace(".", ","),
                    fat: ((item.valueWeekAgo/item.value)*100).toFixed(2),
                    fat2: ((item.valueWeekAgo/item.valueDayBefore)*100).toFixed(2),
                  })
                  t.total_final_qtd_nf_3 += item.quantityWeekAgo
                  t.total_faturado_final_3 += item.valueWeekAgo
                  t.avg_ticket_3 += item.avgTicketWeekAgo
                })

                t.fat_comp_hj_1 = ((t.total_faturado_final_2/t.total_faturado_final_1)*100).toFixed(2).replace(".", ",") + "%"
                t.fat_comp_hj_2 = ((t.total_faturado_final_3/t.total_faturado_final_1)*100).toFixed(2).replace(".", ",") + "%"
                t.fat_comp_ontem = ((t.total_faturado_final_3/t.total_faturado_final_2)*100).toFixed(2).replace(".", ",") + "%"
                t.total_faturado_final_1 = "R$ " + t.total_faturado_final_1.toFixed(2).replace(".", ",")
                t.avg_ticket = "R$ " + (t.avg_ticket/response.data.items.length).toFixed(2).replace(".", ",")
                t.total_faturado_final_2 = "R$ " + t.total_faturado_final_2.toFixed(2).replace(".", ",")
                t.avg_ticket_2 = "R$ " + (t.avg_ticket_2/response.data.items.length).toFixed(2).replace(".", ",")
                t.total_faturado_final_3 = "R$ " + t.total_faturado_final_3.toFixed(2).replace(".", ",")
                t.avg_ticket_3 = "R$ " + (t.avg_ticket_3/response.data.items.length).toFixed(2).replace(".", ",")
            }).catch((error) => {
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
                throw error
            })
            t.loading = false
          }
        },
        mounted() {
            this.loadAsyncData()
        }
    })
</script>
