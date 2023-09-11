<!DOCTYPE html>
<html>

<head>
  <title>Facturar</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--JQuery -->
  <script type="text/javascript" src="./jquery/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="./jquery/jquery-3.2.1.min.js"></script>
  <!------->
  <!--Bootstrap -->
  <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <!------->
  <!---Archivo de estilo--->
  <link rel="stylesheet" href="img/vistas.css">
  <!------->
  <!-- Archivo JS -->
  <script src="../js/facturas.js"></script>
  <!------->
</head>

<body>
  <!--Detalles de la factura -->
  <div id="panel" class="card">
    <div class="card bg-primary text-white">
      <center>
        <h4>Facturas</h4>
      </center>
    </div>
    <div class="card-body">
      <!-- Gif de carga--->
      <center>
        </select>
        <img id="load" src="img/load.gif" alt="loading" width="60" height="60"><br>
      </center>
      <!------->
      <br>
      <!--Tabla de Facturas -->
      <table id="tabla" class="table-striped">
        <thead>
          <tr>
            <th>Factura</th>
            <th>Nombre</th>
            <th>Fecha y Hora</th>
            <th>Total</th>
            <th>Cant.Detalles</th>
            <th>Cant.Productos</th>
            <th></th>
          </tr>
        </thead>
      </table>
      <label id="label"></label><br>
    </div>
  </div>
  <!---- ---->

  <br>
  <!-- Redireccion a las demas vistas---->
  <a href="clientes.php" class="btn btn-danger">Clientes</a>
  <a href="productos.php" class="btn btn-danger">Productos</a>
  <a href="facturar.php" class="btn btn-danger">Facturar</a>

</body>

</html>