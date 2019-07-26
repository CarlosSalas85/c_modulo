<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <h2 class="content-header-title mb-0">
            <i class="fa ft-x-square"></i> SOLICITUDES RECHAZADAS SOBRE CONSUMO
        </h2>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">TABLA SOLICITUDES RECHAZADAS SOBRE CONSUMO</h4>
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
    var controlador_vista = 'SC/Ctrl_rechazado/';

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
</script>