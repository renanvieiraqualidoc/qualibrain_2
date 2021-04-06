<?php
header('Content-Type: text/html; charset=utf-8');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <!-- Custom styles for this template-->
    <link href="./css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <?php include('sidebar.html'); ?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php include('topbar.php'); ?>
        <div class="container-fluid">
          <div id="app" class="container">
            <h1 class="title">Fazer upload de planilha</h1>
            <b-field class="file is-primary"  :class="{'has-name': !!file}">
                <b-upload v-model="file" class="file-label" rounded>
                    <span class="file-cta">
                        <b-icon class="file-icon" icon="upload"></b-icon>
                        <span class="file-label">Clique para fazer upload</span>
                    </span>
                    <span class="file-name" v-if="file">
                        {{ file.name }}
                    </span>
                </b-upload>
            </b-field>
            <b-button tag="button" :loading="loading" native-type="submit" @click="upload">Atualizar</b-button>
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
        data () {
          return {
            file: null,
            loading: false,
            message: '',
            type: ''
          }
        },
        methods: {
          async upload() {
            if(this.file != null) {
              this.loading = true
              if (this.file.name.substring(this.file.name.lastIndexOf('.')+1) == 'csv') {
                let form = new FormData()
                form.append('file', this.file)
                const t = this
                axios.post('juridico/salva_planilha.php', form, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    t.$buefy.notification.open({
                        message: response.data.msg,
                        type: response.data.success ? 'is-success' : 'is-danger',
                        position: 'is-bottom-right',
                        hasIcon: true
                    })
                    t.loading = false
                })
              }
              else {
                this.$buefy.notification.open({
                    message: 'Formato de arquivo deve ser CSV!',
                    type: 'is-danger',
                    position: 'is-bottom-right',
                    hasIcon: true
                })
                this.loading = false
              }
            }
          }
        }
    })
</script>

<style type="text/css">
  .file.is-primary .file-cta {
    background-color: #3157c8;
  }

  .field.file.is-primary:hover > label > span.file-cta {
    background-color: #5f7dd8;
  }
</style>
