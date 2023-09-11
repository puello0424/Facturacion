<?php
require_once "../modelo/detallesDao.php";
//Se reciben los datos desde la vista para agregar un nuevo detalle
$productoid=$_POST["productoid"];
$facturaid=$_POST["facturaid"];
$cantidad = $_POST["cantidad"];
$subtotal = $_POST["subtotal"];

//Se instancia un objeno DetalleDao para agregar el detalle
$datos = new DetallesDao();
//Se llama al metodo agregarDetalle con los parametrso necesarios para agregar un nuevo detalle
echo $datos->agregarDetalle($productoid, $facturaid, $cantidad, $subtotal);
