<?php
require_once "../modelo/clienteDao.php";

//Se instancia un objeno ClienteDao para listar los clientes
$cli = new ClienteDao();
//Se llama al metodo mostrarClientes
$list= $cli->mostrarClientes();
echo $list;

