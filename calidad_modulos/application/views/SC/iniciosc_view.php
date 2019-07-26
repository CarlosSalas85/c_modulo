<script src="https:/code.highcharts.com/highcharts.js"></script>
<script src="https:/code.highcharts.com/modules/exporting.js"></script>

<div class="content-header row">
    <div class="content-header-left col-md-12 col-12 mb-2">
        <h2 class="content-header-title mb-0">
            <i class="fa fa-home"></i> INICIO SOBRECONSUMO
        </h2>
    </div>
</div>
<div class="content-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">RESUMEN SOBRE CONSUMO</h4>
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
                    <div class="card-body card-dashboard">

                        <div class="row">
                            <div class="col-md-6" id="grafico_causales"></div>
                            <div class="col-md-6" id="grafico_recursos"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 text-center">
                                <div id="grafico_estados"></div>
                            </div>
                            <div class="col-md-8 text-center">
                                <span>
                                    <h3>PROMEDIO DÍAS EN APROBAR SOLOCITUDES</h3>
                                </span>
                                <div class="col-12">
                                    <div class="card bg-success">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias1_aprobado"></h3>
                                                        <span class="white texto_dias" id="causal1_aprobado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias2_aprobado"></h3>
                                                        <span class="white texto_dias" id="causal2_aprobado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias3_aprobado"></h3>
                                                        <span class="white texto_dias" id="causal3_aprobado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias4_aprobado"></h3>
                                                        <span class="white texto_dias" id="causal4_aprobado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias5_aprobado"></h3>
                                                        <span class="white texto_dias" id="causal5_aprobado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias6_aprobado"></h3>
                                                        <span class="white texto_dias" id="causal6_aprobado"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <span>
                                    <h3>PROMEDIO DÍAS EN CERRAR SOLOCITUDES</h3>
                                </span>
                                <div class="col-12">
                                    <div class="card bg-primary">
                                        <div class="card-content">
                                            <div class="row">
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias1_cerrado"></h3>
                                                        <span class="white texto_dias" id="causal1_cerrado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias2_cerrado"></h3>
                                                        <span class="white texto_dias" id="causal2_cerrado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias3_cerrado"></h3>
                                                        <span class="white texto_dias" id="causal3_cerrado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias4_cerrado"></h3>
                                                        <span class="white texto_dias" id="causal4_cerrado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias5_cerrado"></h3>
                                                        <span class="white texto_dias" id="causal5_cerrado"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-sm-12 border-right-primary border-right-lighten-3">
                                                    <div class="card-body text-center">
                                                        <h3 class="white" id="dias6_cerrado"></h3>
                                                        <span class="white texto_dias" id="causal6_cerrado"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div><!-- / card-->
                </div><!-- / col-12-->
            </div><!-- row -->
        </div>
    </div>
</div>

<script type="text/javascript">
    let causal = 0;
    let parcial = 0;
    var totalDesviacion = 0;

    $(document).ready(function() {
        graficoEstados();
        graficosCausales();
        graficoRecursos();
        diasAprobar();
        diasCerrar();
    });

    function graficosCausales() {
        let datos = [];
        let total = 0;
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_resumen + "graficosCausales",
            type: 'post',
            data: {
                'id': id
            },
            success: function(data) {

                let response = $.parseJSON(data);
                response = Object.create(response);

                $.each(response.datos, function(i, item) {
                    total = parseInt(item.total) + total;
                })

                $.each(response.datos, function(i, item) {

                    causal = parseInt(item.total);
                    parcial = Math.round((causal * 100) / total);
                    datos.push({
                        "name": item.CausalesNombre + ': <strong> ' + causal + '</strong>',
                        "y": parcial,
                        "selected": false
                    })

                })

                var chartdata = {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Solicitudes por CAUSALES'
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
                $('#grafico_causales').highcharts(chartdata);
            }
        });
    }

    function graficoEstados() {
        let estado;
        let datos = [];
        let total = 0;

        cantidadSolicitudes(function(response) {

            $.each(response.datos, function(i, item) {
                total = parseInt(item.total) + total;
            })
            $.each(response.datos, function(i, item) {

                switch (item.SolicitudEstado) {
                    case '1':
                        estado = 'PENDIENTES';
                        break;

                    case '2':
                        estado = 'APROBADAS';
                        break;

                    case '3':
                        estado = 'RECHAZADAS';
                        break;

                    case '4':
                        estado = 'CERRADAS';
                        break;

                    default:
                        break;
                }

                causal = parseInt(item.total);
                parcial = Math.round((causal * 100) / total);
                datos.push({
                    "name": estado + ': <strong> ' + causal + '</strong>',
                    "y": parcial,
                    "selected": false
                })

            })

            var chartdata = {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Solicitudes por ESTADOS'
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
            $('#grafico_estados').highcharts(chartdata);
            $('#total_solicitudes').html(total);
            visible('vista_solicitudes');
        });
    }

    function graficoRecursos() {
        let datos = [];
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_resumen + "graficoRecursos",
            type: 'post',
            data: {
                'id': id
            },
            success: function(data) {

                let response = $.parseJSON(data);
                response = Object.create(response);

                $.each(response.datos, function(i, item) {
                    let total = parseInt(item.total);
                    datos.push({
                        "name": item.SolicitudRecurso_nombre,
                        "data": [total]
                    })

                    totalDesviacion = totalDesviacion + total;
                })

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
                $('#grafico_recursos').highcharts(chartdata);
                $('#total_desviacion').html('$ ' + formatoNumero(totalDesviacion));
                visible('vista_desviacion');

            }
        });
    }

    function diasAprobar() {
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_resumen + "diasAprobar",
            type: 'get',
            success: function(data) {

                let response = $.parseJSON(data);
                response = Object.create(response);

                $('#dias1_aprobado').html(response.datos.dias1Neto);
                $('#dias2_aprobado').html(response.datos.dias2Neto);
                $('#dias3_aprobado').html(response.datos.dias3Neto);
                $('#dias4_aprobado').html(response.datos.dias4Neto);
                $('#dias5_aprobado').html(response.datos.dias5Neto);
                $('#dias6_aprobado').html(response.datos.dias6Neto);

                $('#causal1_aprobado').html(response.datos.causal1);
                $('#causal2_aprobado').html(response.datos.causal2);
                $('#causal3_aprobado').html(response.datos.causal3);
                $('#causal4_aprobado').html(response.datos.causal4);
                $('#causal5_aprobado').html(response.datos.causal5);
                $('#causal6_aprobado').html(response.datos.causal6);

            }
        });
    }

    function diasCerrar() {
        $.ajax({
            url: "<?php echo base_url(); ?>" + controlador_resumen + "diasCerrar",
            type: 'get',
            success: function(data) {

                let response = $.parseJSON(data);
                response = Object.create(response);

                $('#dias1_cerrado').html(response.datos.dias1Neto);
                $('#dias2_cerrado').html(response.datos.dias2Neto);
                $('#dias3_cerrado').html(response.datos.dias3Neto);
                $('#dias4_cerrado').html(response.datos.dias4Neto);
                $('#dias5_cerrado').html(response.datos.dias5Neto);
                $('#dias6_cerrado').html(response.datos.dias6Neto);

                $('#causal1_cerrado').html(response.datos.causal1);
                $('#causal2_cerrado').html(response.datos.causal2);
                $('#causal3_cerrado').html(response.datos.causal3);
                $('#causal4_cerrado').html(response.datos.causal4);
                $('#causal5_cerrado').html(response.datos.causal5);
                $('#causal6_cerrado').html(response.datos.causal6);

            }
        });
    }
</script>

<style type="text/css">
    .texto_dias {
        font-size: 11px;
    }
</style>