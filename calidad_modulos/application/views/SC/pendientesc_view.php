<div class="content-header row">
	<div class="content-header-left col-md-12 col-12 mb-2">
		<h2 class="content-header-title mb-0">
			<i class="fa ft-alert-circle"></i> SOLICITUDES PENDIENTES SOBRE CONSUMO
		</h2>
	</div>
</div>
<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">TABLA SOLICITUDES PENDIENTES SOBRE CONSUMO</h4>
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
						<div class="table-responsive" id="datos"></div>
					</div>
				</div><!-- / card-->
			</div><!-- / col-12-->
		</div><!-- row -->
	</div>
</div>

<script type="text/javascript">
	var controlador_vista = 'SC/Ctrl_pendiente/';
	var id;
	var id_solicitud;
	var nuevaCantidad;
	var nuevoPrecio;
	var observacion;

	$(document).ready(function() {
		Listar(Informacion());
		datosTabla(data = null);
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
				datosTabla(data);
				cargaNoVisible();
			}
		});
	}

	function Aprobar() {

		id_solicitud = $('#detalle_id').val();
		observacion = $('#detalle_observacion').val();

		nuevaCantidad = $('#detalle_nueva_cantidad').val();
		nuevaCantidad = replaceAll(nuevaCantidad, ".", "");

		nuevoPrecio = $('#detalle_nuevo_precio').val();
		nuevoPrecio = replaceAll(nuevoPrecio, ".", "");


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
					'observacion': observacion,
					'n_orden': null
				},
				success: function(data) {
					resumenSolicitudes();
					alerta(2);
					cargaVisible();
					Listar(id);
					ocultarModal('modal_detalle');
				}
			});
		}
	}

	function Rechazar() {

		id_solicitud = $('#detalle_id').val();
		observacion = $('#detalle_observacion').val();

		nuevaCantidad = $('#detalle_nueva_cantidad').val();
		nuevaCantidad = replaceAll(nuevaCantidad, ".", "");

		nuevoPrecio = $('#detalle_nuevo_precio').val();
		nuevoPrecio = replaceAll(nuevoPrecio, ".", "");

		if (observacion == '') {

			visible('detalle_alerta');
			let texto = 'Para "RECHAZAR, debe indicar una observación';
			$("#detalle_mensaje").html(texto);
			enfocar('detalle_observacion');

		} else {

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
							'observacion': observacion,
							'n_orden': null
						},
						success: function(data) {
							resumenSolicitudes();
							alerta(2);
							cargaVisible();
							Listar(id);
							ocultarModal('modal_detalle');
						}
					});
				}
			})
		}
	}

	function Eliminar(contador) {

		if (contador == 'modal') {

			id_solicitud = $('#detalle_id').val();
		} else {

			id_solicitud = $('#idSolicitud' + contador).html();
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
						resumenSolicitudes();
						alerta(2);
						cargaVisible();
						Listar(id);
						ocultarModal('modal_detalle');
					}
				});
			}
		})
	}

	function replaceAll(text, busca, reemplaza) {
		while (text.toString().indexOf(busca) != -1)
			text = text.toString().replace(busca, reemplaza);
		return text;
	}
</script>