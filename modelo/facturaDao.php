<?php
require_once "conexion.php";
class FacturaDao extends Conexion
{

	//Se agrega una Factura
	public function agregarFactura($clientId, $total)
	{
		$mensaje = "Sin mensaje";
		try {

			//Se agrega una factura
			$conexion = Conexion::conectar();
			$sql = "INSERT INTO facturacion(clienteid, date, total) VALUES (:clientId,NOW(),:total)";

			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(":clientId", $clientId, PDO::PARAM_STR);
			$stmt->bindParam(":total", $total, PDO::PARAM_STR);

			$stmt->execute();
			$fila = $stmt->rowCount();
			if ($fila == 1) {
				//Se confirma que se agregue la factura
				$mensaje = "Guardo con Exito!!";
				//Se obtiene el id fe la factura agregada
				$sql2 = "SELECT Max(id) FROM facturacion";
				$stmt = $conexion->prepare($sql2);
				$stmt->execute();
				$id = $stmt->fetch();
			} else if ($fila == 0) {
				//No se pudo agregar la factura
				$mensaje = "Problemas al Guardar";
			}
		} catch (PDOException $e) {
			if ($e->errorInfo[1] == 1062) {
				$mensaje = "registro duplicado";
			} else {
				echo $e->errorInfo[1];
			}
		}
		//Se devuelve el mensaje y el id de la factura
		$array = array("mensaje" => $mensaje, "id" => $id);
		echo json_encode($array);
	}

	//Mostratr todos las facturas
	public function mostrarFacturas()
	{
		//Se muestran los datos de las facturas
		$stmt = Conexion::conectar()->prepare("SELECT id, clienteid, date, total FROM facturacion");
		$stmt->execute();
		$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		echo json_encode($array);
	}
}
