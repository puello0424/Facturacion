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
  <script src="../js/facturar.js"></script>
  <!------->
</head>

<body>
  <!--Detalles de la factura -->
  <div id="panel" class="card">
    <div class="card bg-primary text-white">
      <center>
        <h4>Generar Factura</h4>
      </center>
    </div>
    <div class="card-body">
      <center>
        <!---Gif de carga---->
        <img id="load" src="img/load.gif" alt="loading" width="60" height="60"><br>
      </center>
      <br>
      <!---Seleccion del cliente dueño de la factura--->
      <select id="selectCliente" class="form-control">
        <option disabled selected value>Seleccione el cliente</option>
      </select>
      <!------->
      <br>
      <!----Seleccion de los productos que va a tener la factura--->
      <select id="selectProducto" class="form-control">
        <option disabled selected value>Seleccione el producto</option>
      </select>
      <!------->
      <br>
      <!---Cantidad del producto--->
      <label class="col-form-label">Cantidad</label>
      <input type="number" class="form-control" id="cantidad">
      <br>
      <!---Boton para agregar el producto a la factura---->
      <center>
        <button class="btn btn-info" id="agregar">Agregar</button>
      </center>
      <!------->


      <div class="detallesProductos">
        <!--Tabla de productos agregados a la factura -->
        <table id="tabla" class="table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>P.Unitario</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
            </tr>
          </thead>
        </table>
        <!------->
        <!--Total de la factura--->
        <div align="right">
          <strong>Total: </strong><label id="label"></label><br>
        </div>
        <!------->
        <br>
        <!--Boton para generar la factura con los productos seleccionados--->
        <center>
          <button class="btn btn-info" id="facturar">Facturar</button>
        </center>
        <!------->
      </div>
    </div>
    <br>
  </div>
  <!---- ---->

  <br>
  <!-- Redireccion a las demas vistas---->
  <a href="clientes.php" class="btn btn-danger">Clientes</a>
  <a href="productos.php" class="btn btn-danger">Productos</a>
  <a href="facturas.php" class="btn btn-danger">Facturas</a>
  <br>
</body>

</html>