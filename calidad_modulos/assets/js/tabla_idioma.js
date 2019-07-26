


function carga_visible() {
    document.getElementById('carga').style.display = 'inherit';
}

function carga_noVisible() {
    document.getElementById('carga').style.display = 'none';
}

function modalAyuda(valor) {
    var card_titulo;
    var card_texto;
    var valor = valor;
    switch (valor) {
        //solicitudNueva_view
        case 1:
            card_titulo = 'Seleccione un Centro de Costo para cargar los recursos asociados';
            card_texto = 'Nota: La velocidad de carga depende de su conexión a internet.';
            break;
        case 2:
            card_titulo = 'Solo aplica cuando corresponde a "RECURSO NO PRESUPUESTADO"';
            card_texto = 'Nota: No se permite el registro de una solicitud de un recurso ya PRESUPUESTADO.';
            break;
        case 3:
            card_titulo = 'Solo aplica cuando corresponde a "ROBO O HURTO", "MAYOR CANTIDAD DE RECURSO" o "MERMAS DE BODEGA"';
            card_texto = 'Nota: ROBO O HURTO y MERMAS DE BODEGA, deben llevar archivo adjunto correspondiente. "CAMBIO DE RECURSO" se realiza como solicitud independiente.';
            break;
            //solicitudNueva_view
            //solicitudEstados
        case 4:
            card_titulo = 'Carga las solicitudes en estado "PENDIENTE". Se pueden filtrar por Centro de Costo';
            card_texto = 'Nota: Si es usuario "ADMINISTRADOR DE OBRA", primero debe seleccionar un Centro de Costo para cargar las solicitudes.';
            break;
        case 5:
            card_titulo = 'Muestra el detalle de la Solicitud';
            card_texto = 'Nota: Solo los usuarios: "PGR", "PREVENCIÓN" y "PRESUPUESTO" pueden aprobar o rechazar una solicitud.';
            break;
        case 6:
            card_titulo = 'Carga las solicitudes en estado "APROBADAS". Se pueden filtrar por Centro de Costo';
            card_texto = 'Nota: Si es usuario "ADMINISTRADOR DE OBRA", primero debe seleccionar un Centro de Costo para cargar las solicitudes.';
            break;
        case 7:
            card_titulo = 'Muestra el detalle de la Solicitud';
            card_texto = 'Nota: Solo los usuarios: "ADQUISICIÓN" pueden registrar el Número de Orden de la solicitud';
            break;
        case 8:
            card_titulo = 'Carga las solicitudes en estado "RECHAZADAS". Se pueden filtrar por Centro de Costo';
            card_texto = 'Nota: Si es usuario "ADMINISTRADOR DE OBRA", primero debe seleccionar un Centro de Costo para cargar las solicitudes.';
            break;
        case 9:
            card_titulo = 'Muestra el detalle de la Solicitud';
            card_texto = 'Nota: la solicitud se considera "CERRADA", no es posible realizar mas acciónes';
            break;
        case 10:
            card_titulo = 'Carga las solicitudes en estado "CERRADAS". Se pueden filtrar por Centro de Costo';
            card_texto = 'Nota: Si es usuario "ADMINISTRADOR DE OBRA", primero debe seleccionar un Centro de Costo para cargar las solicitudes.';
            break;
        case 11:
            card_titulo = 'Muestra el detalle de la Solicitud';
            card_texto = 'Nota: la solicitud se considera "CERRADA", no es posible realizar mas acciónes';
            break;
            //solicitudEstados
            //solicitudReportes
        case 12:
            card_titulo = 'Descarga un reporte en Excel con todas las solicitudes registradas';
            card_texto = 'Nota: La velocidad de descarga del reporte dependerá de la cantidad de registro y la velocidad de conexión a Internet';
            break;
        case 13:
            card_titulo = 'Descarga un reporte en Excel con todas las solicitudes registradas con el Estado "PENDIENTE"';
            card_texto = 'Nota: La velocidad de descarga del reporte dependerá de la cantidad de registro y la velocidad de conexión a Internet';
            break;
        case 14:
            card_titulo = 'Descarga un reporte en Excel con todas las solicitudes registradas con el Estado "APROBADAS"';
            card_texto = 'Nota: La velocidad de descarga del reporte dependerá de la cantidad de registro y la velocidad de conexión a Internet';
            break;
        case 15:
            card_titulo = 'Descarga un reporte en Excel con todas las solicitudes registradas con el Estado "RECHAZADAS"';
            card_texto = 'Nota: La velocidad de descarga del reporte dependerá de la cantidad de registro y la velocidad de conexión a Internet';
            break;
        case 16:
            card_titulo = 'Descarga un reporte en Excel con todas las solicitudes registradas con el Estado "CERRADAS"';
            card_texto = 'Nota: La velocidad de descarga del reporte dependerá de la cantidad de registro y la velocidad de conexión a Internet';
            break;
        case 17:
            card_titulo = 'Descarga un reporte en Excel con todas las solicitudes registradas de la obra seleccionada';
            card_texto = 'Nota: La velocidad de descarga del reporte dependerá de la cantidad de registro y la velocidad de conexión a Internet';
            break;
            //solicitudReportes
            //recursosSolicitud
        case 18:
            card_titulo = 'Nueva solicitud de recurso que no esta disponible';
            card_texto = 'Verificar que el recurso solictado en no se encuentre disponible en el MaeRecursos';
            break;
        case 19:
            card_titulo = 'Muestra detalle de la solicitud';
            card_texto = 'Nota: Pefil Administrador de Obra, puede eliminar la solicitud, solo si esta en estado "SOLICITADOA". Perfil Adquisición, puede aprobar o rechazar la solicitud.';
            break;
            //recursosSolicitud
        default:
            card_titulo = '';
            card_texto = '';
    }
    $("#card_titulo").html(card_titulo);
    $("#card_texto").html(card_texto);
    $("#modalAyuda").appendTo('body').modal('show');
}