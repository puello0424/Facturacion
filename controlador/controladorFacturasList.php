<?php
require_once "../modelo/facturasDao.php";

//Se instancia un objeno FacturaDao
$facturas = new FacturasDao();
//Se llama al metodo mostrarFacturas
$list= $facturas->mostrarFacturas();
echo $list;

