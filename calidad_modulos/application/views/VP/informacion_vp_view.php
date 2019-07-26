<script src="https:/code.highcharts.com/highcharts.js"></script>
<script src="https:/code.highcharts.com/modules/exporting.js"></script>

<input style="display:none;" type="text" id="id_obra" value="<?= $_SESSION['idObra'] ?>">

<div class="row" style="display:none;" id="alerta">
	<div class="col-md-12">
		<div class="alert alert-icon-right alert-warning alert-dismissible mb-2" role="alert">
			<strong>Advertencia! </strong>
			<label id="mensaje"></label>
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
</div>
<div class="row">
	<div class="col-md-4">
		<div class="card border-warning">
			<div class="card-content">
				<div class="card-body">
					<div class="media d-flex">
						<div class="media-body">
							<i class="ft-alert-circle warning"></i>
							<a href="<?= base_url() ?>VP/Ctrl_pendiente/inicio">Pendientes</a>
						</div>
						<div class="badge badge-pill badge-warning" id="total_pendientes">0</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card border-success">
			<div class="card-content">
				<div class="card-body">
					<div class="media d-flex">
						<div class="media-body">
							<i class="ft-check-square success"></i>
							<a href="<?= base_url() ?>VP/Ctrl_aprobado/inicio">Aprobadas</a>
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
							<a href="<?= base_url() ?>VP/Ctrl_rechazado/inicio">Rechazadas</a>
						</div>
						<div class="badge badge-pill badge-danger" id="total_rechazadas">0</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var controlador = 'VP/Ctrl_nuevo/';
	var id;

	$(document).ready(function() {
		Informacion();
		cantidadSolicitudes();
	});

	function Informacion() {
		id = $('#id_obra').val();
		if (id != 0) {
			var texto = 'OBRA no cuenta con presupuesto, comunicarse con Administrador de Sistema';
			$.ajax({
				url: "<?php echo base_url(); ?>" + controlador + "Presupuesto",
				type: 'post',
				data: {
					'id': id
				},
				success: function(data) {

					var response = $.parseJSON(data);
					response = Object.create(response);
					$('#cod_presupuesto').html(response.datos.proyectoPresupuesto);
					$('#cod_centrocosto').html(response.datos.proyectoCentrocosto);

					if (response.datos.proyectoPresupuesto === null) {
						visible('alerta');
						$('#mensaje').html(texto);
					}

				}
			});
		} else {
			var texto = 'Seleccione una Obra desde el Menú OBRAS';
			visible('alerta');
			$('#mensaje').html(texto);
		}
		return id;
	}

	function cantidadSolicitudes() {
		id = $('#id_obra').val();
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador + "cantidadSolicitudes",
			type: 'post',
			data: {
				'id': id
			},
			success: function(data) {
				var response = $.parseJSON(data);
				response = Object.create(response);

				$('#total_pendientes').html(response.datos.pendientes);
				$('#total_aprobadas').html(response.datos.aprobadas);
				$('#total_rechazadas').html(response.datos.rechazadas);

				graficocantidadSolicitudes(response);
			}
		});
	}

	function graficocantidadSolicitudes(response) {
		var datos = [];

		var total = parseInt(response.datos.total);
		var pendientes = Math.round((parseInt(response.datos.pendientes) * 100) / total);
		var aprobadas = Math.round((parseInt(response.datos.aprobadas) * 100) / total);
		var rechazadas = Math.round((parseInt(response.datos.rechazadas) * 100) / total);

		//alert(rechazadas);

		datos.push({
			"name": 'Pendientes',
			"y": pendientes,
			"selected": true
		}, {
			"name": 'Rechazadas',
			"y": rechazadas,
			"selected": true
		}, {
			"name": 'Aprobadas',
			"y": aprobadas,
			"selected": true
		});

		var chartdata = {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Solicitudes'
			},
			tooltip: {
				pointFormat: '{series.name}:<b>{point.percentage:.1f}%</b>'
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						distance: -50,
						format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
						filter: {
							property: 'percentage',
							operator: '>',
							value: 4
						}
					}
				}
			},
			series: [{
				data: datos,
				name: 'Total',
			}]
		}
		chartdata.data = datos;
		$('#grafico_cantidad_solicitudes').highcharts(chartdata);
	}

	function detalle(estado, id, obra, actividad, codigo, descripcion, unidad, cantidad, precio, fecha, usuario, correo, n_cantidad, n_precio) {
		let estado_color;
		if (estado == 'PENDIENTE') {
			estado_color = '<span class="bg-warning text-white rounded text-center col-md-2">' + estado + '</span>';

			if (<?= $_SESSION['id_perfil'] ?> == 2) {
				visible('aprobar_modal');
				visible('rechazar_modal');
				visible('eliminar_modal');
			} else if (<?= $_SESSION['id_perfil'] ?> == 4) {
				visible('eliminar_modal');
			} else if (<?= $_SESSION['id_perfil'] ?> == 5) {
				visible('aprobar_modal');
				visible('rechazar_modal');
			}



			document.getElementById("detalle_nueva_cantidad").readOnly = false;
			document.getElementById("detalle_nuevo_precio").readOnly = false;
		} else if (estado == 'APROBADA') {
			estado_color = '<span class="bg-success text-white rounded text-center col-md-2">' + estado + '</span>';
			estadosSolicitud(id);
		} else if (estado == 'RECHAZADA') {
			estado_color = '<span class="bg-danger text-white rounded text-center col-md-2">' + estado + '</span>';
			estadosSolicitud(id);
		}

		$('#detalle_estado').html(estado_color);
		$('#detalle_id').val(id);
		$('#detalle_obra').val(obra);
		$('#detalle_actividad').val(actividad);
		$('#detalle_codigo').val(codigo);
		$('#detalle_descripcion').val(descripcion);
		$('#detalle_unidad').val(unidad);
		$('#detalle_cantidad').val(cantidad);
		$('#detalle_precio').val(precio);
		$('#detalle_fecha').html(fecha);
		$('#detalle_usuario').val(usuario);
		$('#detalle_correo').val(correo);
		$('#detalle_nueva_cantidad').val(n_cantidad);
		$('#detalle_nuevo_precio').val(n_precio);
		verModal('modal_detalle');
	}

	function estadosSolicitud(id) {
		visible('estados');
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador + "estadosSolicitud",
			type: 'post',
			data: {
				'id': id
			},
			success: function(data) {

				var html = '<table class="table table-hover table-striped" id="tabla">' +
					'<thead>' +
					'<tr class="thead-light">' +
					'<th>Correo</th>' +
					'<th>Cantidad</th>' +
					'<th>Precio</th>' +
					'<th>Estado</th>' +
					'<th>Fecha</th>' +
					'</tr>' +
					'</thead><tbody>';

				var response = $.parseJSON(data);
				response = Object.create(response);

				if (response.registros === 0) {
					html += '';
				} else {

					$.each(response.datos, function(i, item) {

						var salida = formato(item.vp_solicitud_estadoFecha);
						var boton;

						if (item.vp_solicitud_estadoEstado == 1) {
							boton = 'bg-warning';
							item.vp_solicitud_estadoEstado = 'PENDIENTE';
						} else if (item.vp_solicitud_estadoEstado == 2) {
							boton = 'bg-success';
							item.vp_solicitud_estadoEstado = 'APROBADA';
						} else if (item.vp_solicitud_estadoEstado == 3) {
							boton = 'bg-danger';
							item.vp_solicitud_estadoEstado = 'RECHAZADA';
						}

						html += '<tr>';
						html += '<td>' + item[0].usuarioEmail + '</td>';
						html += '<td align="center">' + item.vp_solicitud_estadoCantidad + '</td>';
						html += '<td align="center">' + item.vp_solicitud_estadoPrecio + '</td>';
						html += '<td><div class="' + boton + ' text-white rounded text-center">' + item.vp_solicitud_estadoEstado + '</div></td>';
						html += '<td>' + salida + '</td>';
						html += '</tr>';
					});

				}
				html += '</tbody></table>';
				$("#estados").html(html);
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

				<div class="row form-group">
					<div class="col-md-9">
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

				<div class="row form-group">
					<div class="col-md-6">
						<i class="fa fa-user"></i>
						<span>Usuario:</span>
						<input type="text" class="form-control form-control-sm" id="detalle_usuario" readonly="true">
					</div>
					<div class="col-md-6">
						<i class="fa fa-envelope"></i>
						<span>Correo:</span>
						<input type="text" class="form-control form-control-sm" id="detalle_correo" readonly="true">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-9">
						<i class="fa fa-home"></i>
						<span>Obra:</span>
						<input type="text" class="form-control form-control-sm" id="detalle_obra" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-barcode"></i>
						<span>ID:</span>
						<input type="text" class="form-control form-control-sm" id="detalle_id" readonly="true">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-9">
						<i class="fa fa-cube"></i>
						<span>Actividad:</span>
						<input type="text" class="form-control form-control-sm" id="detalle_actividad" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-database"></i>
						<span>Unidad:</span>
						<input type="text" class="form-control form-control-sm" id="detalle_unidad" readonly="true">
					</div>
				</div>


				<div class="row form-group">
					<div class="col-md-9">
						<i class="fa fa-text-width"></i>
						<span>Nombre:</span>
						<input type="text" class="form-control form-control-sm" id="detalle_descripcion" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-barcode"></i>
						<span>Código:</span>
						<input type="text" class="form-control form-control-sm" id="detalle_codigo" readonly="true">
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-3">
						<i class="fa fa-sort-numeric-asc"></i>
						<span>Cantidad:</span>
						<input type="number" class="form-control form-control-sm" id="detalle_cantidad" required="required" value="0" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-usd"></i>
						<span>Precio:</span>
						<input type="number" class="form-control form-control-sm" id="detalle_precio" required="required" value="0" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-sort-numeric-asc"></i>
						<span class="text-primary">Nueva Cantidad:</span>
						<input type="number" min="1" class="form-control form-control-sm" id="detalle_nueva_cantidad" readonly="true">
					</div>
					<div class="col-md-3">
						<i class="fa fa-usd"></i>
						<span class="text-primary">Nuevo Precio:</span>
						<input type="number" min="1" class="form-control form-control-sm" id="detalle_nuevo_precio" readonly="true">
					</div>
				</div>

				<div class="row form-group">
					<div class="col-md-12">
						<div class="table-responsive" id="estados" style="display:none;"></div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal" value="Cerrar">
				<input type="button" class="btn btn-outline-primary btn-sm" value="Aprobar" onclick="Aprobar('modal')" style="display:none;" id="aprobar_modal">
				<input type="button" class="btn btn-outline-warning btn-sm" value="Rechazar" onclick="Rechazar('modal')" style="display:none;" id="rechazar_modal">
				<input type="button" class="btn btn-outline-danger btn-sm" value="Eliminar" onclick="Eliminar('modal')" style="display:none;" id="eliminar_modal">
			</div>

		</div>
	</div>
</div>