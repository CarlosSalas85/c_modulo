$(document).ready(function () {
    tabla_format();
    tabla_exportar();
});

function cargaVisible() {
    document.getElementById('carga').style.display = 'inherit';
}

function cargaNoVisible() {
    document.getElementById('carga').style.display = 'none';
}

function visible(elemento) {
    document.getElementById('' + elemento + '').style.display = "block";
}

function invisible(elemento) {
    document.getElementById('' + elemento + '').style.display = "none";
}

function inhabilitar(elemento) {
    document.getElementById('' + elemento + '').disabled = false;
}

function habilitar(elemento) {
    document.getElementById('' + elemento + '').disabled = true;
}

function verModal(elemento) {
    $('#' + elemento + '').appendTo('body').modal('show');
}

function ocultarModal(elemento) {
    $('#' + elemento + '').appendTo('body').modal('hide');
}

function formato(elemento) {
    return elemento.replace(/^(\d{4})-(\d{2})-(\d{2})$/g, '$3-$2-$1');
}

function formatoNumero(elemento) {
    return new Intl.NumberFormat("de-DE").format(elemento);
}

function valorVacio(elemento) {
    document.getElementById('' + elemento + '').value = '';
}

function vaciarFormulario(elemento) {
    document.getElementById('' + elemento + '').reset();
}

function enfocar(elemento) {
    document.getElementById('' + elemento + '').focus();
}

function alerta(valor) {
    var type;
    var title;
    var text;
    switch (valor) {
        case 1:
            type = 'warning';
            title = 'Aviso';
            text = 'Solicitud sobre los $10.000.000, verificar antes de Guardar';
            break;
        case 2:
            type = 'success';
            title = 'Bien';
            text = 'Operación realizada con exito';
            break;
        case 3:
            type = 'warning';
            title = 'Advertencia';
            text = 'Revise los campos antes de guardar';
            break;
        case 4:
            type = 'error';
            title = 'Alerta';
            text = '';
            break;
            
    }
    Swal.fire({
        type: type,
        title: title,
        text: text,
        showConfirmButton: false,
    });
}

function datosTabla(data) {
    var html = '<table class="table table-hover table-striped" id="tabla">' +
        '<thead>' +
        '<tr class="thead-dark">' +
        '<th></th>' +
        '<th>ID</th>' +
        '<th>Obra</th>' +
        '<th>Actividad</th>' +
        '<th>Código</th>' +
        '<th>Descripción</th>' +
        '<th>Unidad</th>' +
        '<th>Cantidad</th>' +
        '<th>Precio $</th>' +
        '<th>N-Cantidad</th>' +
        '<th>N-Precio $</th>' +
        '<th>Fecha</th>' +
        '<th>Estado</th>' +
        '<th>Usuario</th>' +
        '<th>Correo</th>' +
        '</tr>' +
        '</thead><tbody>';

    var response = $.parseJSON(data);
    response = Object.create(response);

    if (response.registros === 0) {
        html += '';
    } else {

        $.each(response.datos, function (i, item) {
            var boton;
            var contador;

            var salida = formato(item.vp_solicitud_estadoFecha);
            if (item.vp_solicitudEstado == 2) {
                boton = 'bg-success';
                item.vp_solicitudEstado = 'APROBADA';
            } else if (item.vp_solicitudEstado == 3) {
                boton = 'bg-danger';
                item.vp_solicitudEstado = 'RECHAZADA';
            }

            var datos = new Array(
                '\'' + item.vp_solicitudEstado + '\'',
                item.idVp_solicitud,
                '\'' + item[0] + '\'',
                '\'' + item.Vp_solicitudActividad + '\'',
                '\'' + item.Vp_solicitudRecurso + '\'',
                '\'' + item.Vp_solicitudDescripcion + '\'',
                '\'' + item.Vp_solicitudUnidad + '\'',
                item.Vp_solicitudCantidad,
                item.Vp_solicitudPrecio,
                '\'' + salida + '\'',
                '\'' + item[1].usuarioNombre + '\'',
                '\'' + item[1].usuarioEmail + '\'',
                item.vp_solicitud_estadoCantidad,
                item.vp_solicitud_estadoPrecio,
            );

            html += '<tr>';
            html += '<td><button class="btn btn-primary btn-sm fa fa-eye" onclick="detalle(' + datos + ')" title="Detalle"></button></td>';
            html += '<td  id="idVp_solicitud' + contador + '">' + item.idVp_solicitud + '</td>';
            html += '<td>' + item[0] + '</td>';
            html += '<td>' + item.Vp_solicitudActividad + '</td>';
            html += '<td>' + item.Vp_solicitudRecurso + '</td>';
            html += '<td>' + item.Vp_solicitudDescripcion + '</td>';
            html += '<td>' + item.Vp_solicitudUnidad + '</td>';
            html += '<td align="center">' + item.Vp_solicitudCantidad + '</td>';
            html += '<td align="center">' + item.Vp_solicitudPrecio + '</td>';
            html += '<td align="center">' + item.vp_solicitud_estadoCantidad + '</td>';
            html += '<td align="center">' + item.vp_solicitud_estadoPrecio + '</td>';
            html += '<td>' + salida + '</td>';
            html += '<td><div class="' + boton + ' text-white rounded text-center">' + item.vp_solicitudEstado + '</div></td>';
            html += '<td>' + item[1].usuarioNombre + '</td>';
            html += '<td>' + item[1].usuarioEmail + '</td>';
            html += '</tr>';
            contador++;
        });

    }
    html += '</tbody></table>';
    $("#datos").html(html);
    tabla_exportar();
}

function tabla_format() {
    $('#tabla').dataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'colvis',
            text: '<i class="ft-check-square"></i> Mostrar/Ocultar',
        }],
        "sPaginationType": "full_numbers",
        "language": {
            "sProcessing": "Cargando...",
            "sLengthMenu": "Ver _MENU_ registros",
            "sZeroRecords": "No se produjo ningún resultado",
            "sEmptyTable": "No existen registros para mostrar",
            "sInfo": "Resultado _START_ - _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Registros 0 - 0 de 0 Entradas",
            "sInfoFiltered": "(Filtrado de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sPrevious": "Anterior",
                "sNext": "Siguiente",
                "sLast": "Ultimo"
            },
        }
    });
}

function tabla_exportar() {
    $('#tabla').dataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [{
            extend: 'colvis',
            text: '<i class="ft-check-square"></i> Mostrar/Ocultar',
        }, {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o fa-2x"></i>',
            autoFilter: true,
            sheetName: 'Solicitudes',
            exportOptions: {
                columns: ':visible'
            }
        }, {
            extend: 'print',
            text: '<i class="fa fa-print fa-2x"></i>',
            exportOptions: {
                columns: ':visible'
            },
            customize: function (win) {
                $(win.document.body)
                    .css('font-size', '10pt')
                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            }
        }],
        "sPaginationType": "full_numbers",
        "language": {
            "sProcessing": "Cargando...",
            "sLengthMenu": "Ver _MENU_ registros",
            "sZeroRecords": "No se produjo ningún resultado",
            "sEmptyTable": "No existen registros para mostrar",
            "sInfo": "Resultado _START_ - _END_ de _TOTAL_ registros",
            "sInfoEmpty": "Registros 0 - 0 de 0 Entradas",
            "sInfoFiltered": "(Filtrado de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "oPaginate": {
                "sFirst": "Primero",
                "sPrevious": "Anterior",
                "sNext": "Siguiente",
                "sLast": "Ultimo"
            },
        }
    });

}