<?php
require_once "../modelo/productoDao.php";
//Se reciben los datos desde la vista para agregar un nuevo producto
$name=$_POST["name"];
$price=$_POST["price"];

//Se instancia un objeno ProductoDao para agregar el producto
$produc = new ProductoDao();
//Se llama al metodo agregarProducto con los parametrso necesarios para agregar un nuevo cliente
echo $produc->agregarProducto($name,$price);


