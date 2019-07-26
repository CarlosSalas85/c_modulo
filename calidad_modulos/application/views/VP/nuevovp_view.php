<div class="content-header row">
	<div class="content-header-left col-md-12 col-12 mb-2">
		<h2 class="content-header-title mb-0">
			<i class="fa fa-save" style="font-size:36px;color:greis"></i> NUEVA SOLICITUD VIVIENDAPILOTO
		</h2>
	</div>
</div>
<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">TABLA RECURSOS VIVIENDA PILOTO</h4>
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
								<div class="row">
									<div class="col-md-10">
										<select class="form-control" disabled="" id="tipologia">
											<option>Seleccione Tipología</option>
										</select>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-10">
										<select class="form-control" disabled="disabled" id="proceso">
											<option>Seleccione Proceso</option>
										</select>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-10">
										<select class="form-control" disabled="disabled" id="actividad">
											<option>Seleccione Actividad</option>
										</select>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-md-10">
										<select class="form-control" disabled="disabled" id="subactividad">
											<option>Seleccione Subactividad</option>
										</select>
									</div>
								</div>
								<br>
							</div>
							<div class="col-12 col-md-6">
								<?php $this->load->view('VP/informacion_vp_view'); ?>
							</div>
						</div>
					</div>
					<div class="col-md-12 text-right" id="boton_agregar" style="display: none;">
						<button type="button" class="btn btn-primary" onclick="Modal()">
							<i class="fa fa-plus-square"></i>
							<span> Agregar Recurso</span>
						</button>
					</div>
					<div class="col-md-12">
						<div class="table-responsive-xl" id="datos"></div>
					</div>
				</div><!-- / card-->
			</div><!-- / col-12-->
		</div><!-- row -->
	</div>
</div>

<div class="modal fade text-left" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-info">
				<h3 class="modal-title">
					<i class="ft ft-edit"></i>
					<span class="font-weight-bold">REGISTRO SOLICITUD DE RECURSO</span>
				</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_registro" action="javascript:Validar()">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-9 form-group">
							<i class="fa fa-arrow-down"></i>
							<span>Recursos:</span>
							<select class="selectpicker form-control" id="select_recurso" data-container="body" data-live-search="true" data-size="5">
							</select>
						</div>
						<div class="col-md-9" id="alerta_recurso" style="display: none">
							<div class="alert alert-icon-right alert-warning alert-dismissible" role="alert">
								<strong>Advertencia! </strong>
								<span id="mensaje_modal"></span>
							</div>
						</div>
					</div>
					<hr>
					<div class="row form-group">
						<div class="col-md-6">
							<i class="fa fa-text-width"></i>
							<span>Nombre:</span>
							<input type="text" class="form-control form-control-sm" id="nombre_recurso" readonly="true">
						</div>
						<div class="col-md-3">
							<i class="fa fa-barcode"></i>
							<span>Código:</span>
							<input type="text" class="form-control form-control-sm" id="codigo_recurso" readonly="true">
						</div>
						<div class="col-md-3">
							<i class="fa fa-database"></i>
							<span>Unidad:</span>
							<input type="text" class="form-control form-control-sm" id="unidad_recurso" readonly="true">
						</div>
					</div>
					<div class="row form-group">
						<div class="col-md-3">
							<i class="fa fa-sort-numeric-asc"></i>
							<span>Cantidad:</span>
							<input type="number" class="form-control form-control-sm" id="cantidad" required="required" value="0" readonly="true">
						</div>
						<div class="col-md-3">
							<i class="fa fa-usd"></i>
							<span>Precio:</span>
							<input type="number" class="form-control form-control-sm" id="precio" required="required" value="0" readonly="true">
						</div>
						<div class="col-md-3">
							<i class="fa fa-sort-numeric-asc"></i>
							<span class="text-primary">Nueva Cantidad:</span>
							<input type="number" min="1" class="form-control form-control-sm" id="nueva_cantidad" required="required">
						</div>
						<div class="col-md-3">
							<i class="fa fa-usd"></i>
							<span class="text-primary">Nuevo Precio:</span>
							<input type="number" min="1" class="form-control form-control-sm" id="nuevo_precio" required="required">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="reset" class="btn btn-outline-secondary btn-sm" data-dismiss="modal" value="Cerrar">
					<input type="submit" class="btn btn-outline-primary btn-sm" value="Guardar">
				</div>
			</form>
		</div>
	</div>
</div>

<style type="text/css">
	.bootstrap-select.form-control-sm .dropdown-toggle {
		padding: 0.45rem 0.5rem !important;
	}
</style>

<script type="text/javascript">
	var controlador_vista = 'VP/Ctrl_nuevo/';
	var codPresupuesto;
	var recursosTabla = [];

	$(document).ready(function() {
		Presupuesto();
		cambioTipologia();
		cambioProceso();
		cambioActividad();
		cambioSubactividad();
		datosTabla(data = null);
		cambioMaeRecursos();
		maeRecursos();
	});

	function Presupuesto() {
		var id = $('#id_obra').val();
		if (id != 0) {
			$.ajax({
				url: "<?php echo base_url(); ?>" + controlador_vista + "Presupuesto",
				type: 'post',
				data: {
					'id': id
				},
				success: function(data) {

					var response = $.parseJSON(data);
					response = Object.create(response);
					codPresupuesto = response.datos.proyectoPresupuesto;

					if (codPresupuesto != null) {
						cargaVisible();
						Tipologias(codPresupuesto);
					}
				}
			});
		} else {}
	}

	function Tipologias(id) {
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_vista + "Tipologias",
			type: 'post',
			data: {
				'id': id
			},
			success: function(data) {
				var response = $.parseJSON(data);
				var select = '<option value="0">Seleccione Tipología</option>';
				$.each(response, function(i, item) {
					select += '<option value="' + item.CodigoCabecera + '">' + item.DescripcionCabecera + '</option>';
				});
				$("#tipologia").html(select);
				inhabilitar('tipologia');
				cargaNoVisible();
			}
		});
	}

	function cambioTipologia() {
		$("#tipologia").change(function() {
			cargaVisible();
			invisible('boton_agregar');
			id = cambioSelect('tipologia');

			habilitar('proceso');
			habilitar('actividad');
			habilitar('subactividad');

			datosTabla(data = null);
			if (id == 0) {
				cargaNoVisible();
			} else {
				Proceso(id);
			}
		})
	}

	function Proceso(id) {
		obra = codPresupuesto;

		alert(id);
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_vista + "Proceso",
			type: 'post',
			data: {
				'id': obra,
				'cod': id
			},
			success: function(data) {
				var response = $.parseJSON(data);
				var select = '<option value="0">Seleccione Proceso</option>';
				$.each(response, function(i, item) {
					select += '<option value="' + item.CodigoNivel1 + '">' + item.DescripcionNivel1 + '</option>';
				});
				$("#proceso").html(select);
				inhabilitar('proceso');
				cargaNoVisible();
			}
		});
	}

	function cambioProceso() {
		$("#proceso").change(function() {
			cargaVisible();
			invisible('boton_agregar');
			id = cambioSelect('proceso');

			habilitar('actividad');
			habilitar('subactividad');

			datosTabla(data = null);
			if (id == 0) {
				cargaNoVisible();
			} else {
				Actividad(id);
			}
		})
	}

	function Actividad(id) {
		obra = codPresupuesto;
		tipologia = $("#tipologia").val();
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_vista + "Actividad",
			type: 'post',
			data: {
				'id': obra,
				'cod': tipologia,
				'nivel': id
			},
			success: function(data) {
				var response = $.parseJSON(data);
				var select = '<option value="0">Seleccione Actividad</option>';
				$.each(response, function(i, item) {
					select += '<option value="' + item.CodigoActividadPpto + '">' + item.DescripcionPpto + '</option>';
				});
				$("#actividad").html(select);
				inhabilitar('actividad');
				cargaNoVisible();
			}
		});
	}

	function cambioActividad() {
		$("#actividad").change(function() {
			cargaVisible();
			invisible('boton_agregar');
			id = cambioSelect('actividad');
			habilitar('subactividad');
			datosTabla(data = null);
			if (id == 0) {
				cargaNoVisible();
			} else {
				Subactividad(id);
			}
		})
	}

	function Subactividad(id) {
		obra = codPresupuesto;
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_vista + "Subactividad",
			type: 'post',
			data: {
				'id': obra,
				'cod': id
			},
			success: function(data) {
				var response = $.parseJSON(data);
				var select = '<option value="0">Seleccione Subactividad</option>';
				$.each(response, function(i, item) {
					select += '<option value="' + item.CodigoRecurso + '">' + item.DescripcionRecurso + '</option>';
				});
				$("#subactividad").html(select);
				inhabilitar('subactividad');
				cargaNoVisible();
			}
		});
	}

	function cambioSubactividad() {
		$("#subactividad").change(function() {
			cargaVisible();
			invisible('boton_agregar');
			id = cambioSelect('subactividad');
			datosTabla(data = null);
			if (id == 0) {
				cargaNoVisible();
			} else {
				Recursos(id);
			}
		})
	}

	function Recursos(id) {
		obra = codPresupuesto;
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_vista + "Recursos",
			type: 'post',
			data: {
				'id': obra,
				'cod': id
			},
			success: function(data) {
				datosTabla(data);
				cargaNoVisible();
			}
		});
	}

	function Registro(form, contador) {

		var CodigoRecurso;
		var DescripcionRecurso;
		var CodigoUnidad;
		var CantidadRecursoActividad;
		var PrecioRecurso;
		var nuevaCantidad;
		var nuevoPrecio;
		var CodigoActividad = $('#subactividad').find('option:selected').text();
		var id = $('#id_obra').val();

		if (form == 'tabla') {

			CodigoRecurso = $('#CodigoRecurso' + contador).html();
			DescripcionRecurso = $('#DescripcionRecurso' + contador).html();
			CodigoUnidad = $('#CodigoUnidad' + contador).html();
			CantidadRecursoActividad = $('#CantidadRecursoActividad' + contador).html();
			PrecioRecurso = $('#PrecioRecurso' + contador).html();
			nuevaCantidad = $('#nuevaCantidad' + contador).val();
			nuevoPrecio = $('#nuevoPrecio' + contador).val();

		} else if (form == 'modal') {

			CodigoRecurso = $('#codigo_recurso').val();
			DescripcionRecurso = $('#nombre_recurso').val();
			CodigoUnidad = $('#unidad_recurso').val();
			CantidadRecursoActividad = 0;
			PrecioRecurso = 0;
			nuevaCantidad = $('#nueva_cantidad').val();
			nuevoPrecio = $('#nuevo_precio').val();
		}

		if ($('#nuevaCantidad' + contador).val() == 0 || $('#nuevoPrecio' + contador).val() == 0) {
			alerta(3);
		} else if (DescripcionRecurso == '') {
			$('#mensaje_modal').html('Seleccione un recurso para enviar al solicitud');
			visible('alerta_recurso');
		} else {
			$.ajax({
				url: "<?php echo base_url(); ?>" + controlador_vista + "Registro",
				type: 'post',
				data: {
					'CodigoRecurso': CodigoRecurso,
					'DescripcionRecurso': DescripcionRecurso,
					'CodigoUnidad': CodigoUnidad,
					'CantidadRecursoActividad': CantidadRecursoActividad,
					'PrecioRecurso': PrecioRecurso,
					'nuevaCantidad': nuevaCantidad,
					'nuevoPrecio': nuevoPrecio,

					'CodigoActividad': CodigoActividad,
					'Obra_idObra': id,

				},
				success: function(data) {

					if (data != 0) {
						alerta(2);
						cantidadSolicitudes(id);

						if (form == 'modal') {
							ocultarModal('modal_registro');
						} else {
							$('#nuevaCantidad' + contador).val(0);
							$('#nuevoPrecio' + contador).val(0);
						}

					} else {
						alerta(4);
					}
				}
			});
		}
	}

	function cambioSelect(valor) {
		$("#" + valor + " option:selected").each(function() {
			id = $("#" + valor + "").val();
		});
		return id;
	}

	function datosTabla(data) {
		var html = '<table class="table table-hover table-striped" id="tabla" style="width:100%">' +
			'<thead>' +
			'<tr class="thead-dark">' +
			'<th>#</th>' +
			'<th>Código</th>' +
			'<th>Descripción</th>' +
			'<th>Unidad</th>' +
			'<th>Cantidad</th>' +
			'<th>Precio $</th>' +
			'<th>N-Cantidad</th>' +
			'<th>N-Precio $</th>' +
			'<th>Acción</th>' +
			'</tr>' +
			'</thead><tbody>';

		if (data === null) {
			html += '';
		} else {
			var response = $.parseJSON(data);
			var contador = 1;
			var form = 'tabla';
			recursosTabla = [''];
			var x = 0;

			$.each(response, function(i, item) {

				recursosTabla[i] = item.CodigoRecurso;

				html += '<tr>';
				html += '<td>' + contador + '</td>';
				html += '<td  id="CodigoRecurso' + contador + '">' + item.CodigoRecurso + '</td>';
				html += '<td id="DescripcionRecurso' + contador + '">' + item.DescripcionRecurso + '</td>';
				html += '<td align="left" id="CodigoUnidad' + contador + '">' + item.CodigoUnidad + '</td>';
				html += '<td align="left" id="CantidadRecursoActividad' + contador + '">' + item.CantidadRecursoActividad + '</td>';
				html += '<td align="left" id="PrecioRecurso' + contador + '">' + item.PrecioRecurso + '</td>';

				html += '<td><input type="number" min="1" value="0" class="form-control form-control-sm" id="nuevaCantidad' + contador + '"/></td>'
				html += '<td><input type="number" min="1" value="0" class="form-control form-control-sm" id="nuevoPrecio' + contador + '"/></td>'

				html += '<td align="left"><button class="btn btn-primary btn-sm fa fa-floppy-o" onclick="Registro(\'' + form + '\',' + contador + ');" title="Registro"></button></td>';
				html += '</tr>';
				contador++;
				i++;
			});
			visible('boton_agregar');

		}
		html += '</tbody></table>';
		$("#datos").html(html);
		tabla_format();
	}

	function Modal() {
		document.getElementById('form_registro').reset();
		invisible('alerta_recurso');
		verModal('modal_registro');
		$('.selectpicker').selectpicker({
			noneResultsText: 'No hay resultados'
		});
	}

	function maeRecursos() {
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_vista + "maeRecursos",
			type: 'get',
			data: {},
			success: function(data) {
				var response = $.parseJSON(data);
				var select;

				select += '<option value="0">Seleccione un Recurso</option>'
				$.each(response, function(i, item) {
					select += '<option value="' + item.recCodigo + '">' + item.recCodigo + ' -- ' + item.recDescripcion + '</option>';
				});
				$('#select_recurso').html(select).selectpicker("refresh");
			}
		});
	}

	function cambioMaeRecursos() {
		$("#select_recurso").change(function() {
			id = cambioSelect('select_recurso');
			detalleRecurso(id);
		});
	}

	function detalleRecurso(id) {
		if (id != 0) {
			$.ajax({
				url: "<?php echo base_url(); ?>" + controlador_vista + "detalleRecurso",
				type: 'post',
				data: {
					'id': id
				},
				success: function(data) {
					var response = $.parseJSON(data);
					$.each(response, function(i, item) {
						if (recursosTabla.includes('' + item.recCodigo + '')) {
							$('#mensaje_modal').html('Recurso ya esta en la Actividad');
							visible('alerta_recurso');
						} else {
							$('#nombre_recurso').val(item.recDescripcion);
							$('#codigo_recurso').val(item.recCodigo);
							$('#unidad_recurso').val(item.recUnidad);
							invisible('alerta_recurso');
						}
					});
				}
			});
		} else {
			document.getElementById('form_registro').reset();
		}
	}

	function Validar() {
		var form = 'modal';
		var contador = null;

		if ($('#select_recurso').val() == 0) {
			$('#mensaje_modal').html('Seleccione un recurso para enviar al solicitud');
			visible('alerta_recurso');
		} else {
			invisible('alerta_recurso');
			Registro(form, contador);
		}

	}
</script>