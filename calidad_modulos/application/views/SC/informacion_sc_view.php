<div class="row">
	<div class="col-12 col-md-6">
		<div class="row">
			<div class="col-md-10">
				<div class="card">
					<div class="card-content">
						<div class="media bg-grad-info white">
							<div class="media-body p-1">
								<span><?= $_SESSION['nombreObra'] ?></span>
							</div>
							<div class="media-middle p-1">
								<span>
									<i class="ft-chevrons-down white font-large-1"></i>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="vista_desviacion" style="display:none;">
			<div class="col-md-10">
				<div class="card">
					<div class="card-content">
						<div class="media bg-grad-warning white">
							<div class="media-body p-1">
								<h4>
									<i class="fa fa-money"></i>
									Desviación
								</h4>
							</div>
							<div class="media-right p-1 media-middle">
								<h2 id="total_desviacion">0</h2>
							</div>
						</div>
						<span>(*) Solo se consideran solicitudes 'CERRADAS'</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row" id="vista_solicitudes" style="display:none;">
			<div class="col-md-10">
				<div class="card">
					<div class="card-content">
						<div class="media bg-grad-success white">
							<div class="media-body p-1">
								<h4>
									<i class="fa fa-database"></i>
									Cantidad Solicitudes
								</h4>
							</div>
							<div class="media-right p-1 media-middle">
								<h2 id="total_solicitudes">0</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-md-6">
			<div class="form-inline" style="display: none;" id="carga">
				<h4>
					<i class="fa fa-spinner fa-spin" style="font-size:20px"></i> Cargando información...
				</h4>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-6">
		<input style="display: none;" type="text" id="id_obra" value="<?= $_SESSION['idObra'] ?>">
		<input style="display: none;" type="text" id="id_perfil" value="<?= $_SESSION['id_perfil'] ?>">

		<div class="row" style="display: none;" id="alerta">
			<div class="col-md-12">
				<div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
					<strong>Advertencia! </strong>
					<span id="mensaje"></span>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="card bg-grad-success">
					<div class="card-content">
						<div class="card-body">
							<div class="media d-flex">
								<div class="align-self-left">
									<i class="ft-bookmark white font-large-2 float-left"></i>
								</div>
								<div class="media-body white text-right">
									<span>Presupuesto</span>
									<h5 id="cod_presupuesto"></h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card bg-grad-info">
					<div class="card-content">
						<div class="card-body">
							<div class="media d-flex">
								<div class="align-self-left">
									<i class="ft-bookmark white font-large-2 float-left"></i>
								</div>
								<div class="media-body white text-right">
									<span>CentroCosto</span>
									<h5 id="cod_centrocosto"></h5>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-warning">
					<div class="card-content">
						<div class="card-body">
							<div class="media d-flex">
								<div class="media-body">
									<i class="ft-alert-circle warning"></i>
									<a href="<?= base_url() ?>SC/Ctrl_pendiente/inicio">Pendientes</a>
								</div>
								<div class="badge badge-pill badge-warning" id="total_pendientes">0</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card border-success">
					<div class="card-content">
						<div class="card-body">
							<div class="media d-flex">
								<div class="media-body">
									<i class="ft-check-square success"></i>
									<a href="<?= base_url() ?>SC/Ctrl_aprobado/inicio">Aprobadas</a>
								</div>
								<div class="badge badge-pill badge-success" id="total_aprobadas">0</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-danger">
					<div class="card-content">
						<div class="card-body">
							<div class="media d-flex">
								<div class="media-body">
									<i class="ft-x-square danger"></i>
									<a href="<?= base_url() ?>SC/Ctrl_rechazado/inicio">Rechazadas</a>
								</div>
								<div class="badge badge-pill badge-danger" id="total_rechazadas">0</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card border-info">
					<div class="card-content">
						<div class="card-body">
							<div class="media d-flex">
								<div class="media-body">
									<i class="ft-lock info"></i>
									<a href="<?= base_url() ?>SC/Ctrl_cerrado/inicio">Cerradas</a>
								</div>
								<div class="badge badge-pill badge-info" id="total_cerradas">0</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var controlador = 'SC/Ctrl_nuevo/';
	var controlador_resumen = 'SC/Ctrl_inicio/';
	var id = $('#id_obra').val();
	var id_perfil = $('#id_perfil').val();

	$(document).ready(function() {
		Informacion();
		resumenSolicitudes();
	});

	function Informacion() {
		if (id != 0) {
			let texto = 'OBRA no cuenta con centro de costo, comunicarse con Administrador de Sistema';
			$.ajax({
				url: "<?php echo base_url(); ?>" + controlador + "Centrocosto",
				type: 'post',
				data: {
					'id': id
				},
				success: function(data) {

					let response = $.parseJSON(data);
					response = Object.create(response);
					$('#cod_presupuesto').html(response.datos.proyectoPresupuesto);
					$('#cod_centrocosto').html(response.datos.proyectoCentrocosto);

					if (response.datos.proyectoCentrocosto == 0) {
						visible('alerta');
						$('#mensaje').html(texto);
					}

				}
			});
		} else {
			let texto = 'Seleccione una Obra desde el Menú OBRAS';
			visible('alerta');
			$('#mensaje').html(texto);
		}
		return id;
	}

	function datosTabla(data) {
		let eliminar = '';
		let cerrar = '';
		let numero_orden = '';
		let estiloEstado;

		var html = '<table class="table table-hover table-striped" id="tabla">' +
			'<thead>' +
			'<tr class="thead-dark">' +
			'<th></th>' +
			'<th>ID</th>' +
			'<th>Obra</th>' +
			'<th>Código</th>' +
			'<th>Descripción</th>' +
			'<th>Unidad</th>' +
			'<th>En Orden</th>' +
			'<th>Por Comprar</th>' +
			'<th>Recepción</th>' +
			'<th>Estado</th>' +
			'<th>Causal</th>' +
			'<th>Usuario</th>' +
			'<th>Correo</th>' +
			'<th>N-Cantidad</th>' +
			'<th>N-Precio $</th>' +
			'<th>Fecha</th>' +
			'<th id="accion_titulo">Acción</th>' +
			'</tr>' +
			'</thead><tbody>';

		let response = $.parseJSON(data);
		response = Object.create(response);

		if (response.registros === 0) {
			html += '';
		} else {
			let contador = 1;

			$.each(response.datos, function(i, item) {

				let salida = formato(item.Solicitud_estadosFecha);

				if (item.SolicitudEstado == 1) {

					item.SolicitudEstado = 'PENDIENTE';
					item.SolicitudObservacion = '';
					eliminar = '<button class="btn btn-danger btn-sm fa fa-trash-o" onclick="Eliminar(' + contador + ')" title="Eliminar"></button>';
					estiloEstado = 'bg-warning';

				} else if (item.SolicitudEstado == 2) {

					let datos_cerrar = new Array(
						item.idSolicitud,
						item.Solicitud_estadosNueva_cantidad,
						item.Solicitud_estadosNuevo_total,
					);

					item.SolicitudEstado = 'APROBADA';
					estiloEstado = 'bg-success';
					cerrar = '<input type="text" id="numero_orden_' + item.idSolicitud + '" /> <input type="checkbox" value="' + item.idSolicitud + '"/>' +
						' <button class="btn btn-primary btn-sm fa fa-lock" onclick="Cerrar(' + datos_cerrar + ')" title="Cerrar"></button>';


				} else if (item.SolicitudEstado == 3) {

					item.SolicitudEstado = 'RECHAZADA';
					estiloEstado = 'bg-danger';

				} else if (item.SolicitudEstado == 4) {

					item.SolicitudEstado = 'CERRADA';
					estiloEstado = 'bg-primary';
					numero_orden = item.SolicitudNumero_orden;
				}

				item.Solicitud_cantidad = formatoNumero(item.Solicitud_cantidad);
				item.Solicitud_Total = formatoNumero(item.Solicitud_Total);
				item.SolicitudCantidad_enOrden = formatoNumero(item.SolicitudCantidad_enOrden);
				item.SolicitudCantidad_porComprar = formatoNumero(item.SolicitudCantidad_porComprar);
				item.SolicitudCantidad_recepcion = formatoNumero(item.SolicitudCantidad_recepcion);
				item.Solicitud_estadosNueva_cantidad = formatoNumero(item.Solicitud_estadosNueva_cantidad);
				item.Solicitud_estadosNuevo_total = formatoNumero(item.Solicitud_estadosNuevo_total);

				let datos = new Array(
					'\'' + item.SolicitudEstado + '\'',
					item.idSolicitud,
					'\'' + item[0] + '\'',
					'\'' + item.SolicitudRecurso_codigo + '\'',
					'\'' + item.SolicitudRecurso_nombre + '\'',
					'\'' + item.SolicitudRecurso_unidad + '\'',
					'\'' + item.Solicitud_cantidad + '\'',
					'\'' + item.Solicitud_Total + '\'',
					'\'' + item.SolicitudCantidad_enOrden + '\'',
					'\'' + item.SolicitudCantidad_porComprar + '\'',
					'\'' + item.SolicitudCantidad_recepcion + '\'',
					'\'' + salida + '\'',
					'\'' + item[1].usuarioNombre + '\'',
					'\'' + item[1].usuarioEmail + '\'',
					'\'' + item.Solicitud_estadosNueva_cantidad + '\'',
					'\'' + item.Solicitud_estadosNuevo_total + '\'',
					'\'' + item.SolicitudArchivo + '\'',
					'\'' + item.SolicitudJustificacion + '\'',
					'\'' + item.SolicitudObservacion + '\'',
					'\'' + item.SolicitudNumero_orden + '\'',
					'\'' + item.CausalesNombre + '\'',
					'\'' + item.SolicitudObservacion + '\''
				);

				html += '<tr>';
				html += '<td><button class="btn btn-primary btn-sm fa fa-eye" onclick="detalle(' + datos + ')" title="Detalle"></button></td>';
				html += '<td  id="idSolicitud' + contador + '">' + item.idSolicitud + '</td>';
				html += '<td>' + item[0] + '</td>';
				html += '<td>' + item.SolicitudRecurso_codigo + '</td>';
				html += '<td>' + item.SolicitudRecurso_nombre + '</td>';
				html += '<td>' + item.SolicitudRecurso_unidad + '</td>';
				html += '<td align="center">' + item.SolicitudCantidad_enOrden + '</td>';
				html += '<td align="center">' + item.SolicitudCantidad_porComprar + '</td>';
				html += '<td align="center">' + item.SolicitudCantidad_recepcion + '</td>';

				html += '<td><div class="' + estiloEstado + ' text-white rounded text-center">' + item.SolicitudEstado + '</div></td>';

				html += '<td align="center">' + item.CausalesNombre + '</td>';
				html += '<td>' + item[1].usuarioNombre + '</td>';
				html += '<td>' + item[1].usuarioEmail + '</td>';
				html += '<td align="center">' + item.Solicitud_estadosNueva_cantidad + '</td>';
				html += '<td align="center">' + item.Solicitud_estadosNuevo_total + '</td>';

				html += '<td>' + salida + '</td>';

				html += '<td align="center">';

				if (id_perfil == 5 || id_perfil == 34 || id_perfil == 35 || id_perfil == 10) {

				} else if (id_perfil == 11) {

					html += cerrar;
					html += numero_orden;

				} else if (id_perfil == 2) {

					html += eliminar;
					html += cerrar;
					html += numero_orden;
				}
				html += '</td>';
				html += '</tr>';
				contador++;
				i++;
			});

		}
		html += '</tbody></table>';
		$("#datos").html(html);
		tabla_exportar();

		if (numero_orden != '') {
			$('#accion_titulo').html('N° Orden');
		}
	}

	function resumenSolicitudes() {

		$('#total_pendientes').html(0);
		$('#total_aprobadas').html(0);
		$('#total_rechazadas').html(0);
		$('#total_cerradas').html(0);

		cantidadSolicitudes(function(response) {

			$.each(response.datos, function(i, item) {

				switch (item.SolicitudEstado) {
					case '1':
						$('#total_pendientes').html(item.total);
						break;

					case '2':
						$('#total_aprobadas').html(item.total);
						break;

					case '3':
						$('#total_rechazadas').html(item.total);
						break;

					case '4':
						$('#total_cerradas').html(item.total);
						break;


					default:
						break;
				}
			});
		});
	}

	function cantidadSolicitudes(callback) {
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_resumen + "cantidadSolicitudes",
			type: 'post',
			data: {
				'id': id
			},
			success: function(data) {
				let response = $.parseJSON(data);
				response = Object.create(response);
				callback(response);
			}
		});
	}

	function detalle(estado, idSolicitud, obra, codigo, descripcion, unidad, cantidad, total, orden, comprar, recepcion, fecha, usuario, correo, n_cantidad, n_precio, archivo, justificacion, observacion, numero_orden, causal, observacion) {
		let estado_color;

		invisible('detalle_alerta');
		invisible('detalle_cambio');
		invisible('info_numero_orden');

		if (estado == 'PENDIENTE') {
			estado_color = '<span class="bg-warning text-white rounded text-center col-md-2">' + estado + '</span>';

			if (id_perfil == 2) {
				visible('aprobar_modal');
				visible('rechazar_modal');
				visible('eliminar_modal');
			} else if (id_perfil == 4) {
				visible('eliminar_modal');
			} else if (id_perfil == 5 || id_perfil == 34 || id_perfil == 35 || id_perfil == 10) {
				visible('aprobar_modal');
				visible('rechazar_modal');
			}

			document.getElementById("detalle_nueva_cantidad").readOnly = false;
			document.getElementById("detalle_nuevo_precio").readOnly = false;

		} else if (estado == 'APROBADA') {
			estado_color = '<span class="bg-success text-white rounded text-center col-md-2">' + estado + '</span>';
			historialSolicitud(idSolicitud);
		} else if (estado == 'RECHAZADA') {
			estado_color = '<span class="bg-danger text-white rounded text-center col-md-2">' + estado + '</span>';
			historialSolicitud(idSolicitud);
		} else if (estado == 'CERRADA') {
			estado_color = '<span class="bg-primary text-white rounded text-center col-md-2">' + estado + '</span>';
			historialSolicitud(idSolicitud);
			visible('info_numero_orden');
		}

		let url_archivo;
		if (archivo == '') {
			url_archivo = '';
		} else {
			url_archivo = '<a href="<?= base_url() . 'assets/img/'; ?>' + archivo + '" target="_blank"  class="btn btn-link"><i class="fa fa-file-image-o" style="font-size:24px"></i> Ver archivo</a>';
		}

		$('#detalle_idObra').val(id);
		$('#detalle_causal').html(causal);
		$('#detalle_estado').html(estado_color);
		$('#detalle_id').val(idSolicitud);
		$('#detalle_obra').val(obra);
		$('#detalle_descripcion').val(descripcion);
		$('#detalle_codigo').val(codigo);
		$('#detalle_unidad').val(unidad);
		$('#detalle_cantidad').val(cantidad);
		$('#detalle_total').val(total);
		$('#detalle_fecha').html(fecha);
		$('#detalle_usuario').val(usuario);
		$('#detalle_correo').val(correo);
		$('#detalle_nueva_cantidad').val(n_cantidad);
		$('#detalle_nuevo_precio').val(n_precio);
		$('#detalle_justificacion').val(justificacion);
		$('#detalle_archivo').html(url_archivo);
		$('#detalle_observacion').val(observacion);
		$('#detalle_n_orden').html(numero_orden);

		if (causal == 'CAMBIO DE RECURSO') {
			detalleRecurso(idSolicitud);
		}
		verModal('modal_detalle');
	}

	function detalleRecurso(idSolicitud) {

		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador + "detalleRecurso",
			type: 'post',
			data: {
				'id': idSolicitud
			},
			success: function(data) {

				let response = $.parseJSON(data);
				response = Object.create(response);

				$('#detalle_cambiodescripcion').val(response.datos.Solicitud_recursoDescripcion);
				$('#detalle_cambiocodigo').val(response.datos.Solicitud_recursoCodigo);
				$('#detalle_cambiounidad').val(response.datos.Solicitud_recursoUnidad);
				$('#detalle_cambiocantidad').val(response.datos.Solicitud_recursoCantidad);
				$('#detalle_cambiototal').val(response.datos.Solicitud_recursoPrecio);

				visible('detalle_cambio');

			}
		});

	}

	function historialSolicitud(idSolicitud) {

		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador + "historialSolicitud",
			type: 'post',
			data: {
				'id': idSolicitud
			},
			success: function(data) {

				var html = '<table class="table table-hover table-striped" id="tabla">' +
					'<thead>' +
					'<tr class="thead-light">' +
					'<th>Correo</th>' +
					'<th>Cantidad</th>' +
					'<th>Total</th>' +
					'<th>Estado</th>' +
					'<th>Fecha</th>' +
					'</tr>' +
					'</thead><tbody>';

				let response = $.parseJSON(data);
				response = Object.create(response);

				if (response.registros === 0) {
					html += '';
				} else {

					$.each(response.datos, function(i, item) {

						var salida = formato(item.Solicitud_estadosFecha);
						var boton;

						var cantidad = formatoNumero(item.Solicitud_estadosNueva_cantidad);
						var total = formatoNumero(item.Solicitud_estadosNuevo_total);

						if (item.Solicitud_estadosEstado == 1) {
							boton = 'bg-warning';
							item.Solicitud_estadosEstado = 'PENDIENTE';
						} else if (item.Solicitud_estadosEstado == 2) {
							boton = 'bg-success';
							item.Solicitud_estadosEstado = 'APROBADA';
						} else if (item.Solicitud_estadosEstado == 3) {
							boton = 'bg-danger';
							item.Solicitud_estadosEstado = 'RECHAZADA';
						} else if (item.Solicitud_estadosEstado == 4) {
							boton = 'bg-primary';
							item.Solicitud_estadosEstado = 'CERRADA';
						}

						html += '<tr>';
						html += '<td>' + item[0].usuarioEmail + '</td>';
						html += '<td align="center">' + cantidad + '</td>';
						html += '<td align="center">$ ' + total + '</td>';
						html += '<td><div class="' + boton + ' text-white rounded text-center">' + item.Solicitud_estadosEstado + '</div></td>';
						html += '<td>' + salida + '</td>';
						html += '</tr>';
					});

				}
				html += '</tbody></table>';
				$("#historial_solicitud").html(html);

			}
		});

	}
</script>

<div class="modal fade text-left" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h3 class="modal-title">
					<i class="ft ft-edit"></i>
					<span class="font-weight-bold">DETALLE SOLICITUD DE RECURSO</span>
				</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<input type="text" id="detalle_idObra" style="display:none;" />

				<div class="row form-group">
					<div class="col-md-5">
						<i class="fa fa-info"></i>
						<span>Causal: </span>
						<span id="detalle_causal" class="font-weight-bold"></span>
					</div>
					<div class="col-md-4">
						<i class="fa fa-info"></i>
						<span>Estado: </span>
						<span id="detalle_estado"></span>
					</div>
					<div class="col-md-3">
						<i class="fa fa-calendar"></i>
						<span>Fecha: </span>
						<span id="detalle_fecha"></span>
					</div>
				</div>

				<div class="row form-group" style="display:none;" id="info_numero_orden">
					<div class="col-md-6">
						<i class="fa fa-info"></i>
						<span>N° de Orden: </span>
						<span id="detalle_n_orden" class="font-weight-bold"></span>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-6">
						<i class="fa fa-user"></i>
						<span>Usuario:</span>
						<input type="text" class="form-control" id="detalle_usuario" readonly="true">
					</div>
					<div class="col-md-6">
						<i class="fa fa-envelope"></i>
						<span>Correo:</span>
						<input type="text" class="form-control" id="detalle_correo" readonly="true">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-9">
						<i class="fa fa-home"></i>
						<span>Obra:</span>
						<input type="text" class="form-control" id="detalle_obra" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-barcode"></i>
						<span>ID:</span>
						<input type="text" class="form-control" id="detalle_id" readonly="true">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-9">
						<i class="fa fa-text-width"></i>
						<span>Recurso:</span>
						<input type="text" class="form-control" id="detalle_descripcion" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-barcode"></i>
						<span>Código:</span>
						<input type="text" class="form-control" id="detalle_codigo" readonly="true">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<i class="fa fa-database"></i>
						<span>Unidad:</span>
						<input type="text" class="form-control" id="detalle_unidad" readonly="true">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<i class="fa fa-sort-numeric-asc"></i>
						<span>Cantidad:</span>
						<input type="text" class="form-control" id="detalle_cantidad" required="required" value="0" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-usd"></i>
						<span>Total:</span>
						<input type="text" class="form-control" id="detalle_total" required="required" value="0" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-sort-numeric-asc"></i>
						<span class="text-primary">Nueva Cantidad:</span>
						<input type="text" class="form-control" id="detalle_nueva_cantidad" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-usd"></i>
						<span class="text-primary">Nuevo Total:</span>
						<input type="text" class="form-control" id="detalle_nuevo_precio" readonly="true">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<i class="fa fa-edit"></i>
						<span>Justificación:</span>
						<textarea id="detalle_justificacion" class="form-control" readonly="true"></textarea>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<i class="fa fa-edit"></i>
						<span class="text-primary">Observación:</span>
						<textarea id="detalle_observacion" class="form-control"></textarea>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12" id="detalle_alerta" style="display: none">
						<div class="alert alert-icon-right alert-warning alert-dismissible" role="alert">
							<strong>Advertencia! </strong>
							<span id="detalle_mensaje"></span>
						</div>
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12" id="detalle_archivo">
					</div>
				</div>

				<div id="detalle_cambio" style="display:none;">
					<div class="row form-group">
						<div class="col-md-9">
							<i class="fa fa-info"></i>
							<span class="text-info font-weight-bold"> INFORMACIÓN RECURSO ANTERIOR</span>
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-9">
							<i class="fa fa-text-width"></i>
							<span>Recurso:</span>
							<input type="text" class="form-control" id="detalle_cambiodescripcion" readonly="true">
						</div>
						<div class="col-md-3">
							<i class="fa fa-barcode"></i>
							<span>Código:</span>
							<input type="text" class="form-control" id="detalle_cambiocodigo" readonly="true">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-3">
							<i class="fa fa-database"></i>
							<span>Unidad:</span>
							<input type="text" class="form-control" id="detalle_cambiounidad" readonly="true">
						</div>
						<div class="col-md-3">
							<i class="fa fa-sort-numeric-asc"></i>
							<span>Cantidad:</span>
							<input type="number" class="form-control" id="detalle_cambiocantidad" required="required" value="0" readonly="true">
						</div>
						<div class="col-md-3">
							<i class="fa fa-usd"></i>
							<span>Total:</span>
							<input type="number" class="form-control" id="detalle_cambiototal" required="required" value="0" readonly="true">
						</div>
					</div>
				</div>

				<div id="historial_solicitud">
				</div>
			</div>

			<div class="row form-group">
				<div class="col-md-12">
					<div class="table-responsive" id="estados" style="display:none;"></div>
				</div>
			</div>

			<div class="modal-footer">
				<input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal" value="Cerrar">
				<input type="button" class="btn btn-outline-primary btn-sm" value="Aprobar" onclick="Aprobar()" style="display:none;" id="aprobar_modal">
				<input type="button" class="btn btn-outline-warning btn-sm" value="Rechazar" onclick="Rechazar()" style="display:none;" id="rechazar_modal">
				<input type="button" class="btn btn-outline-danger btn-sm" value="Eliminar" onclick="Eliminar('modal')" style="display:none;" id="eliminar_modal">
			</div>

		</div>
	</div>
</div>