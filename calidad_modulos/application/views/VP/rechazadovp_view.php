<div class="content-header row">
	<div class="content-header-left col-md-12 col-12 mb-2">
		<h2 class="content-header-title mb-0">
			<i class="fa ft-x-square"></i> SOLICITUDES RECHAZADAS VIVIENDA PILOTO
		</h2>
	</div>
</div>
<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">TABLA SOLICITUDES RECHAZADAS VIVIENDA PILOTO</h4>
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
	var idObra;
	var controlador_vista = 'VP/Ctrl_rechazado/';

	$(document).ready(function() {
		idObra = Informacion();
		Listar(idObra);
		datosTabla(data = null);
	});

	function Listar(idObra) {
		cargaVisible();
		$.ajax({
			url: "<?php echo base_url(); ?>" + controlador_vista + "Listar",
			type: 'post',
			data: {
				'id': idObra
			},
			success: function(data) {
				datosTabla(data);
				cargaNoVisible();
			}
		});
	}
</script>