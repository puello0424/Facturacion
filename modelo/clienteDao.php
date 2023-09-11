<?php
require_once "conexion.php";
class ClienteDao extends Conexion
{
	
	//Se agrega un cliente
	public function agregarCliente($identification, $firstName, $lastName, $phone)
	{
		
		$mensaje = "Sin mensaje";
		try {

			//Se agrega un nuevo cliente 
			$conexion = Conexion::conectar();
			$sql = "INSERT INTO cliente (identification, firstname, lastname, phone)  VALUES (:identification, :firstName, :lastName, :phone)";
			//INSERT INTO `cliente` (`id`, `identification`, `firstname`, `lastname`, `phone`) VALUES (NULL, '1231312321', 'dasfsdfsd', 'sdfsdfsdf', '3123123');
			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(":identification", $identification, PDO::PARAM_STR);
			$stmt->bindParam(":firstName", $firstName, PDO::PARAM_STR);
			$stmt->bindParam(":lastName", $lastName, PDO::PARAM_STR);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);

			$stmt->execute();
			$fila = $stmt->rowCount();
			if ($fila == 1) {
				//Se confirma que se agregara el cliente
				$mensaje = "Guardo con Exito!!";
				//Se obtiene el id del cliente agregado
				$sql2 = "SELECT Max(id) FROM cliente";
				$stmt = $conexion->prepare($sql2);
				$stmt->execute();
				$id = $stmt->fetch();
			} else if ($fila == 0) {
				//No se pudo aguardar el cliente
				$mensaje = "Problemas al Guardar";
			}
		} catch (PDOException $e) {
			if ($e->errorInfo[1] == 1062) {
				$mensaje = "registro duplicado";
			} else {
				echo $e->errorInfo[1];
			}
		}

		//Se devuelve el mensaje y el id del cliente
		$array = array("mensaje" => $mensaje, "id" => $id);
		echo json_encode($array);
	}

	//Mostratr todos los clientes registrados
	public function mostrarClientes()
	{
		//Se muestran todos los cliente registrados
		$stmt = Conexion::conectar()->prepare("SELECT id,identification,firstName,lastName,phone FROM cliente");
		$stmt->execute();
		$array = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$stmt = null;
		echo json_encode($array);
	}

	//Se edita el precio de un cliente
	public function editarCliente($id, $phone)
	{
		$mensaje = "Sin mensaje";
		try {
			$conexion = Conexion::conectar();
			//Se edita el telefono del cliente
			$sql = "UPDATE cliente SET phone=:phone WHERE id=:id";
			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(":phone", $phone, PDO::PARAM_STR);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);

			$stmt->execute();
			$fila = $stmt->rowCount();

			if ($fila == 1) {
				//Se pudo editar el cliente
				$mensaje = "Editado con Exito!!";
			} else if ($fila == 0) {
				//No se pudo editar el cliente
				$mensaje = "No se pudo editar";
			}
		} catch (PDOException $e) {
			echo $e->errorInfo[1];
		}
		//Se devuelve el mensaje
		$array = array("mensaje" => $mensaje);
		echo json_encode($array);
	}

	//Se elimina un cliente
	public function eliminarCliente($id)
	{
		$mensaje = "Sin mensaje";
		try {
			//Se elimina el cliente
			$conexion = Conexion::conectar();
			$sql = "DELETE FROM cliente WHERE id =:id";
			$stmt = $conexion->prepare($sql);
			$stmt->bindParam(":id", $id, PDO::PARAM_STR);
			$stmt->execute();
			$fila = $stmt->rowCount();
			if ($fila == 1) {
				//Se confirma la eliminacion del cliente
				$mensaje = "Eliminado con Exito!!";
			} else if ($fila == 0) {
				//No se pudo eliminar el cliente
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
