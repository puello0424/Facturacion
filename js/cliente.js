$(document).ready(function () {
    //Se invoca el metodo llenarTablaVistaCliente al cargar la pagina
    llenarTablaVistaCliente();

    //Se oculta el mensaje al cargar la pagina
    $("#mensaje").hide();

    //Cuando se hace click en el boton guardar se llama a la funcion guardar
    $("#guardar").click(function () {
        guardar();
    });
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
    }, 2000);
}


function confirmDelete(id) {
    //Confirmar la eliminacion del cliente
    $("#confirmDelete").click(function () {
        eliminar(id);
    });
}

function editarDatos(id, identification, name, lastName, phone) {
    //console.log(id);
    //Se cargan los datos del cliente en el modal
    $("#clientIdentificacionEdit").val(identification);
    $("#clientNameEdit").val(name);
    $("#clientApellidoEdit").val(lastName);
    $("#clientPhoneEdit").val(phone);
    //Confirmar la edicion del cliente
    $("#confirmEdit").click(function () {
        editar(id);
    });
}

function limpiar() {
    //Se borran los datos de identificacion,nombre,apellido y telefono
    $("#clientIdentificacion").val("");
    $("#clientName").val("");
    $("#clientApellido").val("");
    $("#clientPhone").val("");
    //Se vuelve a cargar los datos en la tabla
    $("tbody").children().remove();
    llenarTablaVistaCliente();
}
function agregarFila(id, identification, firstName, lastName, phone) {
    //Se agrega los datos del cliente en la tabla
    $("#tabla").append(
        "<tr id=cliente" + id + ">" +
        "<td>" + identification + "</td>" +
        "<td>" + firstName + "</td>" +
        "<td>" + lastName + "</td>" +
        "<td>" + phone + "</td>" +
        "<td> " +
        //Boton para editar el cliente
        "<button id=editar class='btn btn-info' onclick=editarDatos(" + id + ",'" + identification + "','" + firstName + "','" + lastName + "','" + phone + "') data-toggle='modal' data-target='#editModal' >Editar</button> " +
        //Boton para eliminar el cliente
        "<button id=eliminar class='btn btn-danger' onclick=confirmDelete(" + id + ")   data-toggle='modal' data-target='#deleteModal'>Eliminar</button></td> " +
        "</tr>");
}

function guardar() {
    //Se obtienen los datos del cliente
    var identification = $("#clientIdentificacion").val();
    var firstName = $("#clientName").val();
    var lastName = $("#clientApellido").val();
    var phone = $("#clientPhone").val();

    //Se agrega el cliente
    $.ajax({
        url: '../controlador/controladorClienteAdd.php',
        type: 'POST',
        dataType: 'JSON',
        data: { identification: identification, firstName: firstName, lastName: lastName, phone: phone },
        success: function (json) {
            //console.log(json.mensaje)
            //Se muestra el mensaje
            $('#retorno').text(json.mensaje);
            subirmensaje();
            $('#mensaje').show();
            $("#mensaje").fadeIn();
            $("#mensaje").fadeIn("slow");
            $("#mensaje").fadeIn(3000);
            if (json.mensaje == "Guardo con Exito!!") {
                //$("tabla").children().remove()
                //Se invoca el metodo limpiar
                limpiar();
            }
        },
        error: function (x1, x2, x3) {
            console.log(x3);
            console.log(x1);
            console.log(x2);
        }
    });

}

function llenarTablaVistaCliente() {

    //Se obtienen los datos de los clientes registrados
    $("#load").show();
    $.ajax({
        url: '../controlador/controladorClienteList.php',
        type: 'POST',
        dataType: 'JSON',
        success: function (json) {
            //Se agregan los datos a la tabla
            $("#tabla").append("<tbody>");
            $.each(json, function (index, value) {
                //console.log(value.phone);
                //Se agregan los datos de cada cliente
                agregarFila(value.id, value.identification, value.firstName, value.lastName, value.phone);
            }); // for each
            $("#tabla").append("</center>");
            $("#load").hide();
        } // ajax              

    });
}

function editar(id) {
    //Se obtiene el nuevo telefono
    var phone = $("#clientPhoneEdit").val();
    //Se edita el producto
    $.ajax({
        url: '../controlador/controladorClienteEdit.php',
        type: 'POST',
        dataType: 'JSON',
        data: { id: id, phone: phone },
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
                //limpiar();
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
    //Se elimina el cliente
    $.ajax({
        url: '../controlador/controladorClienteDelete.php',
        type: 'POST',
        dataType: 'JSON',
        data: { id: id },
        success: function (json) {
            console.log(json);
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
