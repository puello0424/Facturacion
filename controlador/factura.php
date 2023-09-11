<?php
require_once "../modelo/PDFDao.php";
//Se reciben el id  desde la generar el Excel de la factura
$id=$_POST["id"];
//Se instancia un objeno ExcelDao 
$pdf = new PDFDao();
//Se llama al metodo crearPDF
echo $pdf->crearPDF($id);


