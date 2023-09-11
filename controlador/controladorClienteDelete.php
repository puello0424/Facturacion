<?php
require_once "../modelo/clienteDao.php";
//Se reciben el id  desde la vista para eliminar el producto
$id=$_POST["id"];

//Se instancia un objeno ClienteDao para eliminar el cliente
$cli = new ClienteDao();
//Se llama al metodo eliminarCliente con el id del cliente
echo $cli->eliminarCliente($id);


