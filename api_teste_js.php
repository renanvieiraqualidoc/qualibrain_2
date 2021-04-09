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
  <div id="app"></div>
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

            }
        },
        methods: {
          loadAsyncData() {
            axios.get('http://ultraclinica.totvscloud.com.br:2000/RMS/RMSSERVICES/PDV/stockprice?MainStore=1007&Store=1007&productid="1039911"').then((response) => {

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
