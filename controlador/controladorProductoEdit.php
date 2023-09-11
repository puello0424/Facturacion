<?php
require_once "../modelo/productoDao.php";
//Se reciben los datos desde la vista para editar producto
$id = $_POST["id"];
$price=$_POST["price"];

//Se instancia un objeno ProductoDao para agregar el producto
$produc = new ProductoDao();
//Se llama al metodo editarProducto con el id del producto y el nuevo precio
echo $produc->editarProducto($id,$price);


