<?php
require_once "conexion.php";
class FacturasDao extends Conexion
{

	//Mostratr todas las facturas
	public function mostrarFacturas()
	{
		//Se seleccionan los datos de las facturas
		$stmt = Conexion::conectar()->prepare("SELECT idFactura,firstname, date, total, cantDetalles, cantidadProductos FROM facturas");
		$stmt->execute();
		$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		echo json_encode($array);
	}

}
