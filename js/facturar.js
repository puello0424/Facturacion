$(document).ready(function () {

    //Se oculta la tabla de los detalles de la factura al cargar la pagina
    $(".detallesProductos").hide();

    //Se invoca el metodo llenarSelecCliente al cargar la pagina
    llenarSelecCliente();
    //Se invoca el metodo llenarSelecProducto al cargar la pagina
    llenarSelecProducto();

    //Cuando se hace click en el boton guardar se llama a la funcion guardar
    $("#guardar").click(function () {
        guardar();
    });

    //Cuando se hace click en el boton agregar se llama a la funcion getDetalles
    $("#agregar").click(function () {
        getDetalles();
    });

    //Cuando se hace click en el boton facturar se llama a la funcion guardarFactura
    $("#facturar").click(function () {
        guardarFactura();
    });
});

// Select c.firstname ,f.date,f.total,COUNT(d.facturaid) FROM cliente c INNER JOIN facturacion f on c.id = f.clienteid INNER JOIN detalle d on d.facturaid = f.id INNER JOIN producto p on p.id = d.productoid GROUP by d.facturaid
//Arreglo de los detalles de la factura
var detalles = [];
//Total de la factura
var total = 0;
//Id del cliente al que se le hace la factura
var clienteId=0;

function limpiar() {
    //Se colocan el null los valores de los objetos usados
    $("#selectProducto").val("");
    $("#selectCliente").val("");
    $("#cantidad").val(null);    
    detalles = [];
    total = 0;
    clienteId = 0;
    //Se habilita la seleccion del cliente
    $("#selectCliente").prop('disabled', false);
    //Se oculta la tabla de los detalles
    $(".detallesProductos").hide();
    //Se eliminan los datos de la tabla de los detalles
    $("tbody").children().remove();
}

function getDetalles() {
    //Se obtiene el id del cliente 
    clienteId = $("#selectCliente").val();
    //Se obtiene la informacion del producto
    var datosProducto = $("#selectProducto").val();
    //Se obtiene la cantidad de productos
    var cantidad = $("#cantidad").val();

    //Se valida que todas las variables tengan un valor
    if (clienteId != null && datosProducto != null && cantidad != "") {
        //Se divide la informacion del producto
        datos = datosProducto.split(",");
        //id, nombre del producto, precio
        productoId = datos[0];
        producto = datos[1];
        price = datos[2];
        //Se desahibila la seleccion del cliente
        $("#selectCliente").prop('disabled', true);
        //Se agregan al arreglo detalles la informacion del producto
        detalles.push({ productoId, cantidad, subtotal:(price*cantidad)});
        //Se colocan el null los valores de los objetos usados
        $("#selectProducto").val("");
        $("#cantidad").val(null);

        //Se agregan a la tabla los datos del producto
        agregarFila(producto, price, cantidad);
        //Se muestra la tabla de detalles
        $(".detallesProductos").show();
        //Se actualiza el valor del total en la vista
        document.getElementById('label').innerHTML = total;
    }

}

function agregarFila(producto, price, cantidad) {
    //console.log(typeof (producto));
    //Se agrega a la tabla de detalle la informacion del producto 
    $("#tabla").append(
        "<tr>" +
        "<td>" + producto + "</td>" +
        "<td>" + price + "</td>" +
        "<td>" + cantidad + "</td>" +
        "<td>" + (price * cantidad) + "</td>" +
        "</tr>");
    //Se actualiza el valor del total
    total += (price * cantidad);
}

function llenarSelecCliente() {

    //Se obtienen los datos de los clientes
    $("#load").show();
    $.ajax({
        url: '../controlador/controladorClienteList.php',
        type: 'POST',
        dataType: 'JSON',
        success: function (json) {
            $.each(json, function (index, value) {
                //console.log(value.id);
                //Se llena selectCliente con la informacion de los clientes
                $("#selectCliente").append("<option value='" + value.id + "'>" + value.firstName + "</option>");
            }); // for each
            $("#load").hide();
        } // ajax              

    });
}

function llenarSelecProducto() {
    
    $("#load").show();
    //Se obtienen los datos de los productos
    $.ajax({
        url: '../controlador/controladorProductoList.php',
        type: 'POST',
        dataType: 'JSON',
        success: function (json) {
            $.each(json, function (index, value) {
                //Se crea un arreglo con los datos del producto
                datos = [value.id, value.name, value.price];
                //console.log(value['id']);
                //Se llena selectCliente con la informacion del producto
                $("#selectProducto").append("<option value='" + datos + "'>" + value.name + "</option>");

            }); // for each
            $("#load").hide();
        } // ajax              

    });
}

function guardarDetalles(facturaid){
    //Se guardan los datos de los detalles
    $.each(detalles,function(index,value){
        //console.log(value.productoId, facturaid, value.cantidad, value.subtotal);
        guardarDetalle(value.productoId, facturaid, value.cantidad, value.subtotal);
    });
    //Se recarga la pagina
    location.reload(true);
}

function guardarFactura() {
    //Se crea una nueva factura
    $.ajax({
        url: '../controlador/controladorFacturaAdd.php',
        type: 'POST',
        dataType: 'JSON',
        data: { clienteId: clienteId, total: total },
        success: function (json) {
            //console.log(json.id[0]);
            if (json.mensaje == "Guardo con Exito!!") {
                //console.log(json.id[0]);
                //Se invoca el metodo guardarDetalles
                guardarDetalles(json.id[0]);
                
            }
        },
        error: function (x1, x2, x3) {
            console.log(x3);
        }
    });
}

function guardarDetalle(productoid, facturaid, cantidad, subtotal) {
    //console.log(productoid, facturaid, cantidad, subtotal);
    //Se crea un nuevo detalle
    $.ajax({
        url: '../controlador/controladorDetalleAdd.php',
        type: 'POST',
        dataType: 'JSON',
        data: { productoid: productoid, facturaid: facturaid, cantidad: cantidad, subtotal: subtotal },
        success: function (json) {
            //console.log(json.id[0]);
            if (json.mensaje == "Guardo con Exito!!") {
                //limpiar();
            }
        },
        error: function (x1, x2, x3) {
            console.log(x3);
        }
    });
}