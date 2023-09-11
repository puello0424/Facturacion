<?php
require_once "../modelo/productoDao.php";

//Se instancia un objeno ProductoDao para agregar el producto
$produc = new ProductoDao();
//Se llama al metodo mostrarProductos
$list = $produc->mostrarProductos();
echo $list;
