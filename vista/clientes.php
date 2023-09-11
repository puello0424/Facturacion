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
    <script src="../js/cliente.js"></script>
    <!------->
</head>

<body>
    <!---Tabla Clientes-->
    <div id="panelInventario" class="card">
        <div class="card bg-primary text-white">
            <center>
                <h4>Mostrar clientes</h4>
            </center>
        </div>
        <div class="card-body">
            <center>
                <!-- Gif de carga--->
                <img id="load" src="img/load.gif" alt="loading" width="40" height="40">
                <!---Mensaje con informacion sobre las operaciones (agregar,editar,eliminar)-->
                <div id="mensaje" class="alert alert-primary">
                    <h2 id="retorno"></h2>
                </div>
            </center>
            <br>
            <!---Tabla con los clientes existentes--->
            <table id="tabla" class="table-striped">
                <thead>
                    <tr>
                        <th>Identification</th>
                        <th>FirstName</th>
                        <th>LastName</th>
                        <th>Phone</th>
                    </tr>
                </thead>
            </table>
            <!------->
        </div>
        <!---Buton para agregar a un nuevo cliente---->
        <center>
            <button id="agregar" class="btn btn-success" data-toggle='modal' data-target='#addModal'>Agregar</button>
        </center>
        <!------->
        <p></p>
    </div>
    <br>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!--Formulario--->
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="col-form-label">Identification del Cliente</label>
                            <input type="number" class="form-control" id="clientIdentificacionEdit" readonly>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="clientNameEdit" readonly>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Apellido del Cliente</label>
                            <input type="text" class="form-control" id="clientApellidoEdit" readonly>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Telefono del Cliente</label>
                            <input type="number" class="form-control" id="clientPhoneEdit">
                        </div>
                    </form>
                </div>
                <!------->
                <div class="modal-footer">
                    <!----Boton para cancelar--->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!---Boron para editar el cliente--->
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
                    <center>¿Esta seguro de eliminar este cliente?</center>
                </div>
                <div class="modal-footer">
                    <!---Boton para cancelar---->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!----Boton para eliminar el cliente--->
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="confirmDelete">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------- -->



    <!-- Modal Agregar -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!---Formulario---->
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="col-form-label">Identification del Cliente</label>
                            <input type="number" class="form-control" id="clientIdentificacion">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Nombre del Cliente</label>
                            <input type="text" class="form-control" id="clientName">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Apellido del Cliente</label>
                            <input type="text" class="form-control" id="clientApellido">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Telefono del Cliente</label>
                            <input type="number" class="form-control" id="clientPhone">
                        </div>
                    </form>
                </div>
                <!------->
                <div class="modal-footer">
                    <!---Boton para cancelar---->
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <!---Boton para agregar un nuevo cliente---->
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="confirmAdd">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ---------- -->


    <br>
    <!-- Redireccion a las demas vistas---->
    <a href="productos.php" class="btn btn-danger">Productos</a>
    <a href="facturar.php" class="btn btn-danger">Facturar</a>
    <a href="facturas.php" class="btn btn-danger">Facturas</a>
    <br>

</body>

</html>