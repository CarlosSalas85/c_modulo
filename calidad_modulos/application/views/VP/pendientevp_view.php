<div class="content-header row">
	<div class="content-header-left col-md-12 col-12 mb-2">
		<h2 class="content-header-title mb-0">
			<i class="fa ft-alert-circle"></i> SOLICITUDES PENDIENTES VIVIENDA PILOTO
		</h2>
	</div>
</div>
<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">TABLA SOLICITUDES PENDIENTES VIVIENDA PILOTO</h4>
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
						<div class="row">
							<div class="col-12 col-md-6">
								<?php $this->load->view('VP/obravp_view'); ?>
							</div>
							<div class="col-12 col-md-6">
								<?php $this->load->view('VP/informacion_vp_view'); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="table-responsive" id="datos"></div>
					</div>
				</div><!-- / card-->
			</div><!-- / col-12-->
		</div><!-- row -->
	</div>
</div>

<script type="text/javascript">
	var controlador_vista = 'VP/Ctrl_pendiente/';
	var id;
	var id_solicitud;
	var nuevaCantidad;
	var nuevoPrecio;

	$(document).ready(function() {
		Listar(Informacion());
		datosTablaEditable(data = null);
	});

	function Listar(id) {
		cargaVisible();
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_vista + "Listar",
			type: 'post',
			data: {
				'id': id
			},
			success: function(data) {
				datosTablaEditable(data);
				cargaNoVisible();
			}
		});
	}

	function datosTablaEditable(data) {
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

			'<th style="display:none">Cantidad</th>' +
			'<th style="display:none">N-Precio $</th>' +
			'<th style="display:none">Fecha</th>' +
			'<th>Estado</th>' +
			'<th>Usuario</th>' +
			'<th>Correo</th>' +
			'<th>N-Cantidad</th>' +
			'<th>N-Precio $</th>' +
			'<th>Fecha</th>' +
			'<th>Acción</th>' +
			'</tr>' +
			'</thead><tbody>';

		var response = $.parseJSON(data);
		response = Object.create(response);

		if (response.registros === 0) {
			html += '';
		} else {
			var contador = 1;

			$.each(response.datos, function(i, item) {

				var salida = formato(item.vp_solicitud_estadoFecha);
				if (item.vp_solicitudEstado == 1) {
					item.vp_solicitudEstado = 'PENDIENTE';
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

				html += '<td style="display:none">' + item.vp_solicitud_estadoCantidad + '</td>';
				html += '<td style="display:none">' + item.vp_solicitud_estadoPrecio + '</td>';
				html += '<td style="display:none">' + salida + '</td>';

				html += '<td><div class="bg-warning text-white rounded text-center">' + item.vp_solicitudEstado + '</div></td>';

				html += '<td>' + item[1].usuarioNombre + '</td>';
				html += '<td>' + item[1].usuarioEmail + '</td>';
				html += '<td><input type="number" min="1" value="' + item.vp_solicitud_estadoCantidad + '" class="form-control form-control-sm col-sm-10" id="vp_solicitud_estadoCantidad' + contador + '"/></td>';
				html += '<td><input type="number" min="1" value="' + item.vp_solicitud_estadoPrecio + '" class="form-control form-control-sm col-sm-10" id="vp_solicitud_estadoPrecio' + contador + '"/></td>';

				html += '<td>' + salida + '</td>';

				html += '<td align="left">';

				var aprobar = '<button class="btn btn-primary btn-sm fa fa-check" onclick="Aprobar(' + contador + ')" title="Aprobar"></button> ';
				var rechazar = '<button class="btn btn-warning btn-sm fa fa-times" onclick="Rechazar(' + contador + ')" title="Rechazar"></button> ';
				var eliminar = '<button class="btn btn-danger btn-sm fa fa-trash-o" onclick="Eliminar(' + contador + ')" title="Eliminar"></button>';

				<?php if ($_SESSION['id_perfil'] == 2) { ?>
					html += aprobar;
					html += rechazar;
					html += eliminar;
				<?php } else if ($_SESSION['id_perfil'] == 4) { ?>
					html += eliminar;
				<?php } else if ($_SESSION['id_perfil'] == 5) { ?>
					html += aprobar;
					html += rechazar;
				<?php } ?>

				html += '</td>';
				html += '</tr>';
				contador++;
				i++;
			});

		}
		html += '</tbody></table>';
		$("#datos").html(html);
		tabla_exportar();
	}

	function Aprobar(contador) {

		if (contador == 'modal') {

			id_solicitud = $('#detalle_id').val();
			nuevaCantidad = $('#detalle_nueva_cantidad').val();
			nuevoPrecio = $('#detalle_nuevo_precio').val();

		} else {

			id_solicitud = $('#idVp_solicitud' + contador).html();
			nuevaCantidad = $('#vp_solicitud_estadoCantidad' + contador).val();
			nuevoPrecio = $('#vp_solicitud_estadoPrecio' + contador).val();
		}

		if (nuevaCantidad == 0 || nuevoPrecio == 0) {
			alerta(3);
		} else {

			$.ajax({
				url: "<?php echo base_url(); ?>" + controlador_vista + "Aprobar",
				type: 'post',
				data: {
					'id': id_solicitud,
					'nuevaCantidad': nuevaCantidad,
					'nuevoPrecio': nuevoPrecio,
				},
				success: function(data) {
					alerta(2);
					cargaVisible();
					Listar(id);
					cantidadSolicitudes(id);
					ocultarModal('modal_detalle');
				}
			});
		}
	}

	function Rechazar(contador) {		

		if (contador == 'modal') {

			id_solicitud = $('#detalle_id').val();
			nuevaCantidad = $('#detalle_nueva_cantidad').val();
			nuevoPrecio = $('#detalle_nuevo_precio').val();

		} else {

			id_solicitud = $('#idVp_solicitud' + contador).html();
			nuevaCantidad = $('#vp_solicitud_estadoCantidad' + contador).val();
			nuevoPrecio = $('#vp_solicitud_estadoPrecio' + contador).val();
		}

		Swal.fire({
			title: 'Confirma Rechazar la Solicitud?',
			text: "",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI',
			cancelButtonText: 'NO',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?php echo base_url(); ?>" + controlador_vista + "Rechazar",
					type: 'post',
					data: {
						'id': id_solicitud,
						'nuevaCantidad': nuevaCantidad,
						'nuevoPrecio': nuevoPrecio,
					},
					success: function(data) {
						alerta(2);
						cargaVisible();
						Listar(id);
						cantidadSolicitudes(id);
						ocultarModal('modal_detalle');
					}
				});
			}
		})
	}

	function Eliminar(contador) {	

		if (contador == 'modal') {

			id_solicitud = $('#detalle_id').val();
		} else {

			id_solicitud = $('#idVp_solicitud' + contador).html();
		}

		Swal.fire({
			title: 'Confirma Eliminar la Solicitud?',
			text: "",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'SI',
			cancelButtonText: 'NO',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?php echo base_url(); ?>" + controlador_vista + "Eliminar",
					type: 'post',
					data: {
						'id': id_solicitud
					},
					success: function(data) {
						alerta(2);
						cargaVisible();
						Listar(id);
						cantidadSolicitudes(id);
						ocultarModal('modal_detalle');
					}
				});
			}
		})
	}
</script>