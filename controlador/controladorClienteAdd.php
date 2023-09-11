<?php
require_once "../modelo/clienteDao.php";
//Se reciben los datos desde la vista para agregar un nuevo cliente
$identification=$_POST["identification"];
$firstName=$_POST["firstName"];
$lastName = $_POST["lastName"];
$phone = $_POST["phone"];

//Se instancia un objeno ClienteDao para agregar el cliente
$datos = new ClienteDao();
//Se llama al metodo agregarCliente con los parametrso necesarios para agregar un nuevo cliente
echo $datos->agregarCliente($identification, $firstName, $lastName, $phone);
