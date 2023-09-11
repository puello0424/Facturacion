<?php
require_once "../modelo/clienteDao.php";
//Se reciben los datos desde la vista para editar cliente
$id = $_POST["id"];
$phone=$_POST["phone"];

//Se instancia un objeno ClienteDao para editar el cliente
$cli = new ClienteDao();
//Se llama al metodo editarCliente con el id del cliente y el nuevo telefono
echo $cli->editarCliente($id,$phone);


