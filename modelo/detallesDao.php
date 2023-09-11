<?php
require_once "conexion.php";
class DetallesDao extends Conexion
{

	//Se agrega un detalle
	public function agregarDetalle($productoid, $facturaid, $cantidad, $subtotal)
	{
		$mensaje = "Sin mensaje";
		try {

			//Se agrega el detalle
			$conexion = Conexion::conectar();

			$sql = "INSERT INTO detalle (productoid, facturaid, cantidad, subtotal) VALUES (:productoid, :facturaid, :cantidad, :subtotal)";

			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(":productoid", $productoid, PDO::PARAM_STR);
			$stmt->bindParam(":facturaid", $facturaid, PDO::PARAM_STR);
			$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
			$stmt->bindParam(":subtotal", $subtotal, PDO::PARAM_STR);

			$stmt->execute();
			$fila = $stmt->rowCount();
			if ($fila == 1) {
				//Se confirma que se agregara el detalle
				$mensaje = "Guardo con Exito!!";
			} else if ($fila == 0) {
				//No e pudo agregar
				$mensaje = "Problemas al Guardar";
			}
		} catch (PDOException $e) {
			if ($e->errorInfo[1] == 1062) {
				$mensaje = "registro duplicado";
			} else {
				echo $e->errorInfo[1];
			}
		}
		//Se devuelve el mensaje
		$array = array("mensaje" => $mensaje);
		echo json_encode($array);
	}

	//Mostratr todos los detalle registrados
	public function mostrarDetalles($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT id, productoid, facturaid, cantidad, subtotal FROM detalle WHERE id = :id");
		$stmt->bindParam(":id", $id, PDO::PARAM_STR);
		$stmt->execute();
		$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		echo json_encode($array);
	}
}
