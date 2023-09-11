<?php
class Conexion
{
	public static function conectar()
	{
		//Se establece la conexion a la vase de datos
		$usuario = "root";
		$pass = "";
		$con = new PDO("mysql:host=localhost;dbname=facturacion", $usuario, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		return $con;
	}
}
