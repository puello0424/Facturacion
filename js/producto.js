$(document).ready(function () {
    //Se oculta el mensaje al cargar la pagina
    $("#mensaje").hide();

    //Se invoca el metodo llenarTablaVistaProductos al cargar la pagina
    llenarTablaVistaProductos();

    //Cuando se hace click en el boton confirmAdd se llama a la funcion guardar
    $("#confirmAdd").click(function () {
        guardar();
    });

    //Cuando se hace click en el mensaje se oculta
    $("#mensaje").click(function () {
        $("#mensaje").hide();
    });

});

function subirmensaje() {
    //Se muestra el mensaje 
    $('html,body').animate({
        scrollTop: $("#mensaje").offset().top
    }, 1000);
}

function limpiar() {
    //Se borran los datos de nombre y precio
    $("#productName").val("");
    $("#productPrice").val("");
    //Se vuelve a cargar los datos en la tabla
    $("tbody").children().remove();
    llenarTablaVistaProductos();
}

function agregarFila(id, name, price) {
    //console.log(typeof(id));
    //Se agrega los datos del producto en la tabla
    $("#tabla").append(
        "<tr id=producto" + id + ">" +
        "<td>" + name + "</td>" +
        "<td>" + price + "</td>" +
        "<td> " +
        //Boton para editar el producto
        "<button id=editar class='btn btn-info' onclick=editarDatos(" + id + ",'" + name + "'," + price + ") data-toggle='modal' data-target='#editModal' >Editar</button> " +
        //Boton para eliminar el producto
        "<button id=eliminar class='btn btn-danger' onclick=confirmDelete(" + id + ")   data-toggle='modal' data-target='#deleteModal'>Eliminar</button></td> " +
        "</tr>");
}


function confirmDelete(id){
    //Confirmar la eliminacion del producto
    $("#confirmDelete").click(function () {
        eliminar(id);
    });
}

function editarDatos(id,name,price) {
    //Se cargan los datos del producto en el modal
    $("#productNameEdit").val(name);
    $("#procuctPriceEdit").val(price);
    //Confirmar la edicion del producto
    $("#confirmEdit").click(function () {
        editar(id);
    });
}

function guardar() {
    //Se obtienen los datos del producto
    var name = $("#productName").val();
    var price = $("#productPrice").val();

    //Se agrega el producto
    $.ajax({
        url: '../controlador/controladorProductoAdd.php',
        type: 'POST',
        dataType: 'JSON',
        data: { name: name, price: price },
        success: function (json) {
            //console.log(json.id[0]);
            //Se muestra el mensaje
            $('#retorno').text(json.mensaje);
            subirmensaje();
            $('#mensaje').show();
            $("#mensaje").fadeIn();
            $("#mensaje").fadeIn("slow");
            $("#mensaje").fadeIn(1000);
            if (json.mensaje == "Guardo con Exito!!") {
                //Se invoca el metodo limpiar
                limpiar();
            }
        },
        error: function (x1, x2, x3) {
            console.log(x3);
        }
    });
}

function llenarTablaVistaProductos() {

    //Se obtienen los datos de los productos registrados
    $("#load").show();
    $.ajax({
        url: '../controlador/controladorProductoList.php',
        type: 'POST',
        dataType: 'JSON',
        success: function (json) {
            //Se agregan los datos a la tabla
            $("#tabla").append("<tbody>");
            $.each(json, function (index, value) {
                //console.log(value.name);
                //Se agregan los datos de cada producto
                agregarFila(value.id, value.name, value.price);
            }); // for each
            $("#tabla").append("</center>");
            $("#load").hide();
        } // ajax              
    });
}

function editar(id) {
    //Se obtiene el nuevo precio
    var price = $("#procuctPriceEdit").val();
    //Se edita el producto
    $.ajax({
        url: '../controlador/controladorProductoEdit.php',
        type: 'POST',
        dataType: 'JSON',
        data: { id: id, price: price },
        success: function (json) {
            //console.log(json);
            //Se muestra el mensaje
            $('#retorno').text(json.mensaje);
            subirmensaje();
            $('#mensaje').show();
            $("#mensaje").fadeIn();
            $("#mensaje").fadeIn("slow");
            $("#mensaje").fadeIn(1000);
            if (json.mensaje == "Editado con Exito!!") {
                //Se recarga la pagina
                location.reload(true);
            }
        },
        error: function (x1, x2, x3) {
            console.log(x3);
        }
    });
}

function eliminar(id) {
    //Se elimina el producto
    $.ajax({
        url: '../controlador/controladorProductoDelete.php',
        type: 'POST',
        dataType: 'JSON',
        data: { id: id },
        success: function (json) {
            //console.log(json);
            //Se muestra el mensaje
            $('#retorno').text(json.mensaje);
            subirmensaje();
            $('#mensaje').show();
            $("#mensaje").fadeIn();
            $("#mensaje").fadeIn("slow");
            $("#mensaje").fadeIn(1000);
            if (json.mensaje == "Eliminado con Exito!!") {
                //Se invoca el metodo limpiar
                limpiar();
            }
        },
        error: function (x1, x2, x3) {
            console.log(x3);
        }
    });
}

