<?php
require_once "../modelo/facturaDao.php";
//Se reciben los datos desde la vista para agregar una nueva factura
$clienteId=$_POST["clienteId"];
$total=$_POST["total"];

//Se instancia un objeno FacturaDao para agregar la factura
$datos = new FacturaDao();
//Se llama al metodo agregarFactura con los parametrso necesarios para agregar una nueva factura
echo $datos->agregarFactura($clienteId,$total);
