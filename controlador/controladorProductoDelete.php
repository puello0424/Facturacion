<?php
require_once "../modelo/productoDao.php";
//Se reciben el id  desde la vista para eliminar el producto
$id=$_POST["id"];

//Se instancia un objeno ProductoDao para agregar el producto
$produc = new ProductoDao();
//Se llama al metodo eliminarProducto con el id del producto
echo $produc->eliminarProducto($id);


