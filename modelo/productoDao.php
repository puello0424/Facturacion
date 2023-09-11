<?php
require_once "conexion.php";
class ProductoDao extends Conexion
{

	//Agregar un producto
	public function agregarProducto($name, $price)
	{
		$mensaje = "Sin mensaje";
		$id = 0;
		try {
			//Conexion
			$conexion = Conexion::conectar();
			//Se agrega el producto
			$sql = "INSERT INTO producto (name, price) VALUES (:name,:price)";

			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(":name", $name, PDO::PARAM_STR);
			$stmt->bindParam(":price", $price, PDO::PARAM_STR);

			$stmt->execute();
			$fila = $stmt->rowCount();
			if ($fila == 1) {
				//Se confirma que se guardara el producto
				$mensaje = "Guardo con Exito!!";
				//Se obtiene el codigo del producto
				$sql2 = "SELECT Max(id) FROM producto";
				$stmt = $conexion->prepare($sql2);
				$stmt->execute();
				$id = $stmt->fetch();
			} else if ($fila == 0) {
				//El producto no se agrego
				$mensaje = "Problemas al Guardar";
			}
		} catch (PDOException $e) {
			//Errores al realizar la sentencia SQL
			if ($e->errorInfo[1] == 1062) {
				$mensaje = "registro duplicado";
			} else {
				echo $e->errorInfo[1];
			}
		}
		//Se devuelve el mensaje y el codigo del producto agregado
		$array = array("mensaje" => $mensaje, "id" => $id);
		echo json_encode($array);
	}


	//Mostratr todos los productos registrados
	public function mostrarProductos()
	{
		//Se retornan todos los productos registrados
		$stmt = Conexion::conectar()->prepare("SELECT id,name,price FROM producto");
		$stmt->execute();
		$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		echo json_encode($array);
	}

	//Se edita el precio de un producto
	public function editarProducto($id, $price)
	{
		$mensaje = "Sin mensaje";
		try {
			$conexion = Conexion::conectar();
			//Se edita el producto
			$sql = "UPDATE producto SET price=:price WHERE id=:id";
			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(":price", $price, PDO::PARAM_STR);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);

			$stmt->execute();
			$fila = $stmt->rowCount();

			if ($fila == 1) {
				//Se confirma que se editara el producto
				$mensaje = "Editado con Exito!!";
			} else if ($fila == 0) {
				//No se edito el producto
				$mensaje = "No se pudo editar";
			}
		} catch (PDOException $e) {
			echo $e->errorInfo[1];
		}
		//Se devuelve el mensaje 
		$array = array("mensaje" => $mensaje);
		echo json_encode($array);
	}

	//Se elimina un producto
	public function eliminarProducto($id)
	{
		$mensaje = "Sin mensaje";
		try {
			//Se elimina el producto
			$conexion = Conexion::conectar();
			$sql = "DELETE FROM producto WHERE id =:id";
			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->execute();
			$fila = $stmt->rowCount();
			if ($fila == 1) {
				//Se confirma la eliminacion del producto
				$mensaje = "Eliminado con Exito!!";
			} else if ($fila == 0) {
				//No se pudo eliminar el producto
				$mensaje = "Problemas al eliminar";
			}
		} catch (PDOException $e) {
			echo $e->errorInfo[1];
		}
		//Se devuelve el mensaje
		$array = array("mensaje" => $mensaje);
		echo json_encode($array);
	}
}
