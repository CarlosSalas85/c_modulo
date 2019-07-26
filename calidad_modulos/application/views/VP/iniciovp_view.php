<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <h2 class="content-header-title mb-0">
            <i class="fa ft-bar-chart-2" style="font-size:36px;color:greis"></i> INICIO VIVIENDA PILOTO
        </h2>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">RESUMEN VIVIENDA PILOTO</h4>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <?php $this->load->view('VP/informacion_vp_view'); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div id="grafico_cantidad_solicitudes"></div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div id="top_recursos"></div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div id="top_actividad"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- / card-->
            </div><!-- / col-12-->
        </div><!-- row -->
    </div>
</div>

<script type="text/javascript">
    var controlador_vista = 'VP/Ctrl_inicio/';
    var totalDesviacion = 0;

    $(document).ready(function() {
        graficoToprecursos(Informacion());
        graficoTopactividades(Informacion());
    });

    function graficoToprecursos(id) {
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_vista + "graficoToprecursos",
            type: 'post',
            data: {
                'id': id
            },
            success: function(data) {
                let response = $.parseJSON(data);
                response = Object.create(response);
                let datos = [];

                $.each(response.datos, function(i, item) {
                    let total = parseInt(item.total);
                    datos.push({
                        "name": item.Vp_solicitudDescripcion,
                        "data": [total]
                    })

                    totalDesviacion = totalDesviacion + total;
                });

                var chartdata = {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Top Recursos'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: ['']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: ''
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>{point.x}</b><br/>',
                        pointFormat: '{series.name}<br/>Total: $ {point.y}'
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [datos]
                };

                chartdata.series = datos;
                $('#top_recursos').highcharts(chartdata);
                $('#total_desviacion').html('$ ' + new Intl.NumberFormat('de-DE').format(totalDesviacion));
            }
        });
    }

    function graficoTopactividades(id) {
        cargaVisible();
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_vista + "graficoTopactividades",
            type: 'post',
            data: {
                'id': id
            },
            success: function(data) {
                var response = $.parseJSON(data);
                response = Object.create(response);
                var datos = [];
                $.each(response.datos, function(i, item) {
                    var total = parseInt(item.total);
                    datos.push({
                        "name": item.Vp_solicitudActividad,
                        "data": [total]
                    })
                });

                var chartdata = {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Top Actividades'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: ['']
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: ''
                        }
                    },
                    tooltip: {
                        headerFormat: '<b>{point.x}</b><br/>',
                        pointFormat: '{series.name}<br/>Total: $ {point.y}'
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [datos]
                };

                chartdata.series = datos;
                $('#top_actividad').highcharts(chartdata);
                cargaNoVisible();
            }
        });
    }
</script>
