<!DOCTYPE html>
<html>

<head>
    <title>Producto</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--JQuery -->
    <script type="text/javascript" src="./jquery/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="./jquery/jquery-3.2.1.min.js"></script>
    <!------->
    <!--Bootstrap -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <!------->
    <!---Archivo de estilo--->
    <link rel="stylesheet" href="img/vistas.css">
    <!------->
    <!-- Archivo JS -->
    <script src="../js/producto.js"></script>
    <!------->
</head>

<body>
    <!--Tabla de productos existentes -->
    <div id="panelInventario" class="card">
        <div class="card bg-primary text-white">
            <center>
                <h4>Mostrar Productos</h4>
            </center>
        </div>
        <div class="card-body">
            <center>
                <!---Gif de carga--->
                <img id="load" src="img/load.gif" alt="loading" width="40" height="40">
                <!---Mensaje de informacion de las operaciones (agregar,eliminar,editar)--->
                <div id="mensaje" class="alert alert-primary">
                    <h2 id="retorno"></h2>
                </div>
                <!------->
            </center>
            <br>
            <!--Tabla de los productos--->
            <table id="tabla" class="table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                </thead>
            </table>
            <!------->
        </div>
        <!--Boton para agregar un nuevo producto--->
        <center>
            <button id="agregar" class="btn btn-success" data-toggle='modal' data-target='#addModal'>Agregar</button>
        </center>
        <!------->
        <p></p>
    </div>
    <!-- -->


    <!-- Modal Agregar -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Productos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!---Formulario---->
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="col-form-label">Nombre Producto</label>
                            <input type="text" class="form-control" id="productName">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Precio Producto</label>
                            <input type="number" class="form-control" id="productPrice">
                        </div>
                    </form>
                </div>
                <!------->
                <div class="modal-footer">
                    <!--Boton para cancelar--->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!----Boton para agregar-->
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="confirmAdd">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------- -->

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!---Formulario--->
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="col-form-label">Nombre Producto</label>
                            <input type="text" class="form-control" id="productNameEdit" readonly>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Precio Producto</label>
                            <input type="number" class="form-control" id="procuctPriceEdit">
                        </div>
                    </form>
                </div>
                <!------->
                <div class="modal-footer">
                    <!---Boton para cancelar---->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!---Boton para editar---->
                    <button type="button" class="btn btn-info" data-dismiss="modal" id="confirmEdit">Editar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------- -->

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <center>¿Esta seguro de eliminar este producto?</center>
                </div>
                <div class="modal-footer">
                    <!---Boton para cancelar---->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!----Boton para eliminar--->
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------- -->

    <br>
    <!-- Redireccion a las demas vistas---->
    <a href="clientes.php" class="btn btn-danger">Clientes</a>
    <a href="facturar.php" class="btn btn-danger">Facturar</a>
    <a href="facturas.php" class="btn btn-danger">Facturas</a>
    <br>

</body>

</html>