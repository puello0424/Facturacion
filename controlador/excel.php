<?php
require_once "../modelo/excelDao.php";
//Se reciben el id  desde la generar el Excel de la factura
$id=$_POST["id"];
//Se instancia un objeno ExcelDao 
$excel = new ExcelDao();
//Se llama al metodo crearExcel
echo $excel->crearExcel($id);


