$(document).ready(function () {
    //Se invoca el metodo llenarTablaVistaFacturas al cargar la pagina
    llenarTablaVistaFacturas();

});


function agregarFila(idFactura, firstname, date, total, cantDetalles, cantidadProductos) {
    //console.log(typeof (producto));
    //Se agrega a la tabla los datos de la factura
    $("#tabla").append(
        "<tr>" +
        //Id de la factura
        "<td>" + idFactura + "</td>" +
        //Nombre del cliente
        "<td>" + firstname + "</td>" +
        //Fecha de facturacion
        "<td>" + date + "</td>" +
        //Total de la factura
        "<td>" + total + "</td>" +
        //Cantidad de detalle
        "<td>" + cantDetalles + "</td>" +
        //Cantidad de productos
        "<td>" + cantidadProductos + "</td>" +
        "<td> " +
        //Boton para la creacion de un archivo excel con los datos de la factura
        "<form action='../controlador/excel.php' method='post'>" +
        "<button class='btn btn-info' name = 'id' value = '" + idFactura + "' type = 'submit' > Excel</button>" +
        "</form>" +
        //Boton para la creacion de un archivo PDF con los datos de la factura
        "<form action='../controlador/factura.php' method='post'>" +
            "<button class='btn btn-info' name = 'id' value = '" + idFactura + "' type = 'submit' >PDF</button>" +
        "</form>" +
        "</td > " +
        "</tr>"); 

}


function llenarTablaVistaFacturas() {
    //Se obtienen las facturas registradas
    $("#load").show();
    $.ajax({
        url: '../controlador/controladorFacturasList.php',
        type: 'POST',
        dataType: 'JSON',
        success: function (json) {
            //Se agrega la informacion en el cuerpo de la tabla
            $("#tabla").append("<tbody>");
            
            $.each(json, function (index, value) {
                //console.log(value);
                //Se recorre cada uno de los resultados obtenidos
                //Se imprimen los datos de la factura en la tabla
                agregarFila(value.idFactura, value.firstname, value.date, value.total, value.cantDetalles, value.cantidadProductos);
            }); // for each
            $("#tabla").append("</center>");
            $("#load").hide();
        } // ajax              
    });
}

