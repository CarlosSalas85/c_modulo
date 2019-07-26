<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <h2 class="content-header-title mb-0">
            <i class="fa fa-save"></i> NUEVA SOLICITUD SOBRECONSUMO
        </h2>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">TABLA RECURSOS Centrocosto</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body card-dashboard">
                        <?php $this->load->view('SC/informacion_sc_view'); ?>
                    </div>

                    <div class="col-md-12">

                        <div class="form-inline form-group" id="boton_nopresupuestado" style="display:none;">
                            <button class="btn btn-primary" onclick="Nopresupuestado()">
                                <i class="fa fa-plus-circle"></i> AGREGAR RECURSO
                            </button>
                        </div>

                        <div class="table-responsive-xl" id="datos"></div>
                    </div>
                </div><!-- / card-->
            </div><!-- / col-12-->
        </div><!-- row -->
    </div>
</div>

<script type="text/javascript">
    var controlador_vista = 'SC/Ctrl_nuevo/';
    var idObra;
    var recursosTabla = [];

    $(document).ready(function() {
        Centrocosto();
        datosTabla(data = null);
        obtenerCausales();
        maeRecursos();
    });

    function Centrocosto() {
        idObra = $('#id_obra').val();
        if (idObra != 0) {
            $.ajax({
                url: "<?php echo base_url(); ?>" + controlador_vista + "Centrocosto",
                type: 'post',
                data: {
                    'id': idObra
                },
                success: function(data) {

                    let response = $.parseJSON(data);
                    response = Object.create(response);
                    codCentrocosto = response.datos.proyectoCentrocosto;

                    if (codCentrocosto != 0) {
                        cargaVisible();
                        recursosCentrocosto(codCentrocosto);
                    } else {}
                }
            });
        } else {}
    }

    function recursosCentrocosto(centrocosto) {
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_vista + "recursosCentrocosto",
            type: 'post',
            data: {
                'id': centrocosto
            },
            success: function(data) {
                datosTabla(data);
            }
        });
    }

    function datosTabla(data) {
        let html = '<table class="table table-hover table-striped" id="tabla" style="width:100%">' +
            '<thead>' +
            '<tr class="thead-dark">' +
            '<th>#</th>' +
            '<th>Código</th>' +
            '<th>Descripción</th>' +
            '<th>Unidad</th>' +
            '<th>Cantidad</th>' +
            '<th>Total</th>' +
            '<th>Orden</th>' +
            '<th>Recepciondas</th>' +
            '<th>Por Comprar</th>' +
            '<th>Acción</th>' +
            '</tr>' +
            '</thead><tbody>';

        if (data === null) {
            html += '';
        } else {

            let response = $.parseJSON(data);
            response = Object.create(response);
            let contador = 1;

            $.each(response, function(i, item) {

                recursosTabla[contador] = item.Recurso;

                item.CantidadPpto = formatoNumero(item.CantidadPpto);
                item.PrecioPpto = formatoNumero(item.PrecioPpto);
                item.CantidadComp = formatoNumero(item.CantidadComp);
                item.CantidadRecep = formatoNumero(item.CantidadRecep);
                item.CantidadTraspasada = formatoNumero(item.CantidadTraspasada);

                html += '<tr>';
                html += '<td>' + contador + '</td>';
                html += '<td id="Recurso' + contador + '">' + item.Recurso + '</td>';
                html += '<td id="Descripcion' + contador + '">' + item.Descripcion + '</td>';
                html += '<td align="center" id="Unidad' + contador + '">' + item.Unidad + '</td>';
                html += '<td align="center" id="Cantidad' + contador + '">' + item.CantidadPpto + '</td>';
                html += '<td align="center" id="Total' + contador + '">' + item.PrecioPpto + '</td>';
                html += '<td align="center" id="cantidad_orden' + contador + '">' + item.CantidadComp + '</td>';
                html += '<td align="center" id="cantidad_recep' + contador + '">' + item.CantidadRecep + '</td>';
                html += '<td align="center" id="cantidad_porcomp' + contador + '">' + item.CantidadTraspasada + '</td>';
                html += '<td>';
                html += '<button class="btn btn-primary btn-sm fa fa-floppy-o" onclick="Sobreconsumo(' + contador + ')" title="Registro SOBRECONSUMO"></button> ';
                html += '<button class="btn btn-success btn-sm fa fa-floppy-o" onclick="Cambiorecurso(' + contador + ')" title="Registro CAMBIO DE RECURSO"></button>';
                html += '</td>';
                html += '</tr>';
                contador++;
            });
            visible('boton_nopresupuestado');
        }
        html += '</tbody></table>';
        $("#datos").html(html);
        tabla_format();
        cargaNoVisible();
    }

    function Sobreconsumo(contador) {
        invisible('alertaSobre');
        vaciarFormulario('form_registro');

        let recurso = $("#Recurso" + contador).html();

        $("#id_obra_sc").val(id);
        $("#Descripcion").val($("#Descripcion" + contador).html());
        $("#Recurso").val(recurso);
        $("#Unidad").val($("#Unidad" + contador).html());
        $("#Cantidad").val($("#Cantidad" + contador).html());
        $("#Total").val($("#Total" + contador).html());
        $("#cantidad_orden").val($("#cantidad_orden" + contador).html());
        $("#cantidad_porcomp").val($("#cantidad_porcomp" + contador).html());
        $("#cantidad_recep").val($("#cantidad_recep" + contador).html());

        ultimoPrecio(recurso, function(data) {

            $("#ultimo_precio").val(data);
            let ultimo_precio = data;
            ultimo_precio = formatoNumero(ultimo_precio);
            $("#ultimo_precio_vista").val(ultimo_precio);

        });
        verModal('modal_sobreconsumo');
    }

    function Validar() {

        let valor_causal = $('#sobreConsumo').val();

        if (valor_causal == 1 || valor_causal == 4) {
            if (($('#archivo').val()) === '') {

                visible('alertaSobre');
                let texto = 'Debe adjuntar archivo para enviar la solicitud.';
                $("#mensajeSobre").html(texto);

            } else {
                registro(1);

            }
        } else {
            registro(1);

        }
    }

    function Cambiorecurso(contador) {

        vaciarFormulario('form_registroCambio');
        invisible('alertaCambio_archivo');
        invisible('alertaCambio');
        habilitar('guardarCambio');

        $("#id_obra_cr").val(id);
        $("#DescripcionAnterior").val($("#Descripcion" + contador).html());
        $("#RecursoAnterior").val($("#Recurso" + contador).html());
        $("#UnidadAnterior").val($("#Unidad" + contador).html());
        $("#CantidadAnterior").val($("#Cantidad" + contador).html());
        $("#TotalAnterior").val($("#Total" + contador).html());
        $("#cantidad_ordenAnterior").val($("#cantidad_orden" + contador).html());
        $("#cantidad_porcompAnterior").val($("#cantidad_porcomp" + contador).html());
        $("#cantidad_recepAnterior").val($("#cantidad_recep" + contador).html());
        verModal('modal_cambiorecurso');
    }

    function Nopresupuestado() {
        vaciarFormulario('form_registroNo');
        invisible('alertaNo_archivo');
        invisible('alertaNo');
        habilitar('guardarNo');

        $("#id_obra_np").val(id);

        verModal('modal_nopresupuestado');
    }

    function registro(valor) {

        let formulario;
        let causal;
        let modal;

        switch (valor) {
            case 1:
                formulario = 'form_registro';
                causal = 'registroSobreConsumo';
                modal = 'modal_sobreconsumo';
                break;

            case 2:
                formulario = 'form_registroNo';
                causal = 'registroNoPresupuestado';
                modal = 'modal_nopresupuestado';

                break;
            case 3:
                formulario = 'form_registroCambio';
                causal = 'registroCambioRecurso';
                modal = 'modal_cambiorecurso';

                break;
            default:

        }

        let formData = new FormData($("#" + formulario + "")[0]);

        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_vista + causal,
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                if (data != 0) {
                    ocultarModal(modal);
                    alerta(2);
                    resumenSolicitudes();
                } else {
                    alerta(4);
                }
            }
        });

    }

    function obtenerCausales() {
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_vista + "obtenerCausales",
            type: 'get',
            data: {},
            success: function(data) {
                let response = $.parseJSON(data);
                response = Object.create(response);
                let select;
                let select2;
                let select3;

                $.each(response.datos, function(i, item) {

                    if (item.CausalesTipo == 'SOBRE CONSUMO') {
                        select += '<option value="' + item.idCausales + '">' + item.CausalesNombre + '</option>';
                    }
                    if (item.CausalesTipo == 'NO PRESUPUESTADO') {
                        select2 += '<option value="' + item.idCausales + '">' + item.CausalesNombre + '</option>';
                    } else if (item.CausalesTipo == 'CAMBIO DE RECURSO') {
                        select3 += '<option value="' + item.idCausales + '">' + item.CausalesNombre + '</option>';
                    }
                });

                $("#sobreConsumo").html(select);
                $("#noPresupuestado").html(select2);
                $("#cambioRecursoSelect").html(select3);
            }
        });
    }

    function sumar(elemento) {

        let nueva_cantidad;
        let ultimo_precio;
        let desviacion;
        let desviacion_vista;

        if (elemento == 'Sobre') {

            nueva_cantidad = 'nueva_cantidad';
            ultimo_precio = 'ultimo_precio';
            desviacion = 'desviacion';
            desviacion_vista = 'desviacion_vista';

        } else if (elemento == 'No') {

            nueva_cantidad = 'nueva_cantidadNo';
            ultimo_precio = 'ultimo_precioNo';
            desviacion = 'desviacionNo';
            desviacion_vista = 'desviacionNo_vista';

        } else if (elemento == 'Cambio') {

            nueva_cantidad = 'nueva_cantidadCambio';
            ultimo_precio = 'ultimo_precioCambio';
            desviacion = 'desviacionCambio';
            desviacion_vista = 'desviacionCambio_vista';

        }
        
        nueva_cantidadCantidad = document.getElementById(nueva_cantidad).value;
        ultimo_precioCantidad = document.getElementById(ultimo_precio).value;
        desviacionCantidad = nueva_cantidadCantidad * ultimo_precioCantidad;
        document.getElementById(desviacion).value = desviacionCantidad;

        if(desviacionCantidad > 10000000){
            alerta(1);
        }

        desviacionCantidad = formatoNumero(desviacionCantidad);
        document.getElementById(desviacion_vista).value = desviacionCantidad;

    }

    function ultimoPrecio(recurso, callback) {
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_vista + "ultimoPrecio",
            type: 'post',
            data: {
                "id": recurso,
            },
            success: function(data) {
                let response = $.parseJSON(data);
                response = Object.create(response);
                callback(response[0].OrdDPrecioUnitario);
            }
        })
    }

    function validarArchivo(id) {
        let archivo;

        if (id == 1) {
            archivo = document.getElementById('archivo');
        } else if (id == 2) {
            archivo = document.getElementById('archivoNo');
        } else if (id == 3) {
            archivo = document.getElementById('archivoCambio');
        }

        let archivo_ruta = archivo.value;
        let archivo_permitido = /(.pfd|.PDF|.png|.PNG|.jpeg|.JPEG|.jpg|.JPG)$/i;

        if (!archivo_permitido.exec(archivo_ruta)) {

            let texto = 'El archivo <strong>' + archivo_ruta + '</strong> no está permitido.';

            if (id == 1) {

                visible('alertaSobre');
                valorVacio('archivo');
                $("#mensajeSobre").html(texto);

            } else if (id == 2) {

                visible('alertaNo_archivo');
                valorVacio('archivoNo');
                $("#mensajeNo_archivo").html(texto);

            } else if (id == 3) {

                visible('alertaCambio_archivo');
                valorVacio('archivoCambio');
                $("#mensajeCambio_archivo").html(texto);

            }

        } else {

            if (id == 1) {

                invisible('alertaSobre');

            } else if (id == 2) {

                invisible('alertaNo_archivo');

            } else if (id == 3) {

                invisible('alertaCambio_archivo');

            }
        }
    }

    function limpiar() {
        valorVacio('archivo');
        invisible('alertaSobre');
    }

    function maeRecursos() {
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_vista + "maeRecursos",
            type: 'get',
            data: {},
            success: function(data) {
                let response = $.parseJSON(data);
                let select;
                select += '<option value="0">SELECCIONE UN RECURSO</option>';
                $.each(response, function(i, item) {
                    select += '<option value="' + item.recCodigo + '">' + item.recCodigo + ' => ' + item.recDescripcion + ' => ' + item.recUnidad + '</option>';
                });
                $('#select_recurosCambio').html(select).selectpicker("refresh");
                $('#select_recurosNo').html(select).selectpicker("refresh");
            }
        });
    }

    function detalleMaerecurso(elemento) {
        let recurso = $('#select_recuros' + elemento + '').val();
        let coincidencia = false;
        invisible('alerta' + elemento + '');

        if (recurso != 0) {

            for (i = 0; i < recursosTabla.length; i++) {
                if (recursosTabla[i] == recurso) {

                    let texto = 'El recurso no califica para realizar la solicitud';
                    visible('alerta' + elemento + '');
                    $('#mensaje' + elemento + '').html(texto);
                    coincidencia = true;
                    habilitar('guardar' + elemento + '');
                }
            }

            if (coincidencia == false) {
                let detalleRecurso = $('#select_recuros' + elemento + ' option:selected').text();
                let valores = detalleRecurso.split('=>');

                $('#Descripcion' + elemento + '').val(valores[1]);
                $('#Recurso' + elemento + '').val(valores[0]);
                $('#Unidad' + elemento + '').val(valores[2]);

                ultimoPrecio(valores[0], function(data) {

                    $('#ultimo_precio' + elemento + '').val(data);
                    let ultimo_precio = data;
                    ultimo_precio = formatoNumero(ultimo_precio);
                    $('#ultimo_precio' + elemento + '_vista').val(ultimo_precio);
                    sumar(elemento);
                });
                inhabilitar('guardar' + elemento + '');
            }
        } else {}
    }
</script>

<!-- Modal Registro Sobreconsumo -->
<div class="modal fade bg-default" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_sobreconsumo">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5>
                    <i class="fa fa-file"></i> REGISTRO SOLICITUD SOBRECONSUMO
                </h5>
                <div class="col-md-2 offset-md-6">
                    <span>Fecha actual: </span>
                    <?= FECHA_ACTUAL; ?>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:Validar()" enctype="multipart/form-data" id="form_registro" name="form_registro">
                <div class="modal-body">

                    <div class="container-fliud">

                        <input type="text" id="id_obra_sc" name="id_obra_sc" style="display:none;">

                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-left">INFORMACIÓN DEL RECURSO</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">Nombre:</p>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm " id="Descripcion" name="Descripcion" readonly="true">
                            </div>
                            <div class="col-md-1">
                                <p class="text-right">Código:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="Recurso" name="Recurso" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Unidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="Unidad" name="Unidad" readonly="true">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-left">RESUMEN DE VALORES DEL RECURSO</p>
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Cantidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="Cantidad" name="Cantidad" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Total:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="Total" name="Total" readonly="true">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">En Orden:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="cantidad_orden" name="cantidad_orden" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Por Comprar:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="cantidad_porcomp" name="cantidad_porcomp" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Recepcionadas:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="cantidad_recep" name="cantidad_recep" readonly="true">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-success font-weight-bold">SOLICITUD DE SOBRE CONSUMO</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">(*) Nueva Cantidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" min="1" class="form-control form-control-sm" id="nueva_cantidad" onkeyup="sumar('Sobre')" name="nueva_cantidad" required="required">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Ultimo Precio $:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" id="ultimo_precio" name="ultimo_precio" style="display:none;">
                                <input type="text" class="form-control form-control-sm " id="ultimo_precio_vista" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Desviación $:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" id="desviacion" name="desviacion" style="display:none;">
                                <input type="text" class="form-control form-control-sm " id="desviacion_vista" readonly="true">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">(*) Seleccione Causal:</p>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control form-control-sm" id="sobreConsumo" name="sobreConsumo" onchange="limpiar()"></select>
                            </div>
                            <div class="col-md-2">
                                <p class="text-right" id="texto_causal"></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">(*) Justificación:</p>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="2" id="justificacion" name="justificacion" required="required"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 offset-md-2 form-group">
                                <input type="file" class="form-control-file" id="archivo" name="archivo" onchange="return validarArchivo(1)">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 offset-md-2" id="alertaSobre" style="display: none">
                                <div class="alert alert-icon-right alert-warning alert-dismissible" role="alert">
                                    <strong>Advertencia! </strong>
                                    <span id="mensajeSobre"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <p class="text-info font-weight-bold">Archivos permitidos: .png, .pdf, .jpg, .jpeg</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <p class="float-left" style="font-size: 15px;">(*) Campos obligatorios</p>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                            <input type="submit" name="" class="btn btn-primary btn-sm" value="Guardar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Registro Sobreconsumo -->

<!-- Modal Registro Cambio de Recurso -->
<div class="modal fade bg-default" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_cambiorecurso">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5>
                    <i class="fa fa-file"></i> REGISTRO SOLICITUD SOBRECONSUMO CAMBIO DE RECURSO
                </h5>
                <div class="col-md-2 offset-md-4">
                    <span>Fecha actual: </span>
                    <?= FECHA_ACTUAL; ?>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:registro(3)" enctype="multipart/form-data" id="form_registroCambio" name="form_registroCambio">
                <div class="modal-body">

                    <div class="container-fliud">

                        <input type="text" id="id_obra_cr" name="id_obra_cr" style="display: none;">

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">(*) Seleccione Causal:</p>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control form-control-sm" id="cambioRecursoSelect" name="cambioRecursoSelect"></select>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-left">INFORMACIÓN DEL RECURSO A CAMBIAR</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">Nombre:</p>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm " id="DescripcionAnterior" name="DescripcionAnterior" readonly="true">
                            </div>
                            <div class="col-md-1">
                                <p class="text-right">Código:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="RecursoAnterior" name="RecursoAnterior" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Unidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="UnidadAnterior" name="UnidadAnterior" readonly="true">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-left">RESUMEN DE VALORES DEL RECURSO A CAMBIAR</p>
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Cantidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="CantidadAnterior" name="CantidadAnterior" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Total:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="TotalAnterior" name="TotalAnterior" readonly="true">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">En Orden:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="cantidad_ordenAnterior" name="cantidad_ordenAnterior" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Por Comprar:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="cantidad_porcompAnterior" name="cantidad_porcompAnterior" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Recepcionadas:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="cantidad_recepAnterior" name="cantidad_recepAnterior" readonly="true">
                            </div>
                        </div>


                        <hr>

                        <div class="row form-group">
                            <div class="col-md-2">
                                <p class="text-right">(*) Seleccione Recurso:</p>
                            </div>
                            <div class="col-md-6">
                                <select class="selectpicker form-control" id="select_recurosCambio" data-container="body" data-live-search="true" data-size="5" onchange="detalleMaerecurso('Cambio')">
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 offset-md-2" id="alertaCambio" style="display: none">
                                <div class="alert alert-icon-right alert-warning alert-dismissible" role="alert">
                                    <strong>Advertencia! </strong>
                                    <span id="mensajeCambio"></span>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-left">INFORMACIÓN DEL RECURSO</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">Nombre:</p>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm " id="DescripcionCambio" name="DescripcionCambio" readonly="true">
                            </div>
                            <div class="col-md-1">
                                <p class="text-right">Código:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="RecursoCambio" name="RecursoCambio" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Unidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="UnidadCambio" name="UnidadCambio" readonly="true">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-success font-weight-bold">SOLICITUD CAMBIO DE RECURSO</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">(*) Nueva Cantidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" min="1" class="form-control form-control-sm" id="nueva_cantidadCambio" onkeyup="sumar('Cambio')" name="nueva_cantidadCambio" required="required">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Ultimo Precio $:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" id="ultimo_precioCambio" name="ultimo_precioCambio" style="display:none;">
                                <input type="text" class="form-control form-control-sm " id="ultimo_precioCambio_vista" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Desviación $:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" id="desviacionCambio" name="desviacionCambio" style="display:none;">
                                <input type="text" class="form-control form-control-sm " id="desviacionCambio_vista" readonly="true">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">(*) Justificación:</p>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="2" id="justificacionCambio" name="justificacionCambio" required="required"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 offset-md-2 form-group">
                                <input type="file" class="form-control-file" id="archivoCambio" name="archivoCambio" onchange="return validarArchivo(3)">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 offset-md-2" id="alertaCambio_archivo" style="display: none">
                                <div class="alert alert-icon-right alert-warning alert-dismissible" role="alert">
                                    <strong>Advertencia! </strong>
                                    <span id="mensajeCambio_archivo"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <p class="text-info font-weight-bold">Archivos permitidos: .png, .pdf, .jpg, .jpeg</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <p class="float-left" style="font-size: 15px;">(*) Campos obligatorios</p>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                            <input type="submit" name="" class="btn btn-primary btn-sm" value="Guardar" id="guardarCambio">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Registro Cambio de Recurso -->

<!-- Modal Registro No Presupuestado -->
<div class="modal fade bg-default" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_nopresupuestado">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5>
                    <i class="fa fa-file"></i> REGISTRO SOLICITUD SOBRECONSUMO RECURSO NO PRESUPUESTADO
                </h5>
                <div class="col-md-2 offset-md-3">
                    <span>Fecha actual: </span>
                    <?= FECHA_ACTUAL; ?>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:registro(2)" enctype="multipart/form-data" id="form_registroNo" name="form_registroNo">
                <div class="modal-body">

                    <div class="container-fliud">

                        <input type="text" id="id_obra_np" name="id_obra_np" style="display: none;">

                        <div class="row">
                            <div class="col-md-3">
                                <p class="text-right">(*) Seleccione Causal:</p>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control form-control-sm" id="noPresupuestado" name="noPresupuestado"></select>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-3">
                                <p class="text-right">(*) Seleccione Recurso:</p>
                            </div>
                            <div class="col-md-6">
                                <select class="selectpicker form-control" id="select_recurosNo" data-container="body" data-live-search="true" data-size="5" onchange="detalleMaerecurso('No')">
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 offset-md-3" id="alertaNo" style="display: none">
                                <div class="alert alert-icon-right alert-warning alert-dismissible" role="alert">
                                    <strong>Advertencia! </strong>
                                    <span id="mensajeNo"></span>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4">
                                <p class="text-left">INFORMACIÓN DEL RECURSO</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">Nombre:</p>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control form-control-sm " id="DescripcionNo" name="DescripcionNo" readonly="true">
                            </div>
                            <div class="col-md-1">
                                <p class="text-right">Código:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="RecursoNo" name="RecursoNo" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Unidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control form-control-sm " id="UnidadNo" name="UnidadNo" readonly="true">
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="text-success font-weight-bold">SOLICITUD RECURSO NO PRESUPUESTADO</h6>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">(*) Nueva Cantidad:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" min="1" class="form-control form-control-sm" id="nueva_cantidadNo" onkeyup="sumar('No')" name="nueva_cantidadNo" required="required">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Ultimo Precio $:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" id="ultimo_precioNo" name="ultimo_precioNo" style="display:none;">
                                <input type="text" class="form-control form-control-sm " id="ultimo_precioNo_vista" readonly="true">
                            </div>
                            <div class="col-md-2">
                                <p class="text-right">Desviación $:</p>
                            </div>
                            <div class="col-md-2">
                                <input type="number" id="desviacionNo" name="desviacionNo" style="display:none;">
                                <input type="text" class="form-control form-control-sm " id="desviacionNo_vista" readonly="true">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <p class="text-right">(*) Justificación:</p>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="2" id="justificacionNo" name="justificacionNo" required="required"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 offset-md-2 form-group">
                                <input type="file" class="form-control-file" id="archivoNo" name="archivoNo" onchange="return validarArchivo(2)">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 offset-md-2" id="alertaNo_archivo" style="display: none">
                                <div class="alert alert-icon-right alert-warning alert-dismissible" role="alert">
                                    <strong>Advertencia! </strong>
                                    <span id="mensajeNo_archivo"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <p class="text-info font-weight-bold">Archivos permitidos: .png, .pdf, .jpg, .jpeg</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <p class="float-left" style="font-size: 15px;">(*) Campos obligatorios</p>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                            <input type="submit" name="" class="btn btn-primary btn-sm" value="Guardar" id="guardarNo">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Registro No Presupuestado -->