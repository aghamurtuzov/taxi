@extends('main.layout')
@section('content')





    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <div class="row">
                    <div class="col-md-12">
                        <!-- Basic pie chart -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Sifarişlərin statusu</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="chart-container has-scroll">
                                    <div class="chart has-fixed-height has-minimum-width" id="basic_pie"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /bacis pie chart -->
                    </div>
                </div>
            </div>







            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
    <!-- /page container -->

    <script type="text/javascript" src="http://otos.ru/assets/js/plugins/visualization/echarts/echarts.js"></script>

    <script>
        $(function() {


            //İllik sifariş sayı
            require.config({
                paths: {
                    echarts: 'http://otos.ru//assets/js/plugins/visualization/echarts'
                }
            });



            // Configuration
            // ------------------------------

            require(
                // Add necessary charts
                [
                    'echarts',
                    'echarts/theme/limitless',
                    'echarts/chart/line',
                    'echarts/chart/bar',
                    'echarts/chart/pie',


                    'echarts/chart/scatter',
                    'echarts/chart/k',
                    'echarts/chart/radar',
                    'echarts/chart/gauge'
                ],

                function (ec, limitless) {

                    var basic_pie = ec.init(document.getElementById('basic_pie'), limitless);
                    basic_pie_options = {

                        // Add title
                        title: {
                            text: 'Sifarişlərin statusu',
                            x: 'center'
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'item',
                            formatter: "{a} <br/>{b}: {c} ({d}%)"
                        },

                        // Add legend
                        legend: {
                            orient: 'vertical',
                            x: 'left',
                            data: ['İcraya göndərilməyib', 'Gözləyir', 'Qəbul edilib', 'Müştəriyə çatdı', 'Müştəri çatdı', 'Bitdi', 'Ləğv edilib']
                        },

                        // Display toolbox
                        toolbox: {
                            show: true,
                            orient: 'vertical',
                            feature: {
                                mark: {
                                    show: true,
                                    title: {
                                        mark: 'Markline switch',
                                        markUndo: 'Undo markline',
                                        markClear: 'Clear markline'
                                    }
                                },
                                dataView: {
                                    show: true,
                                    readOnly: false,
                                    title: 'View data',
                                    lang: ['View chart data', 'Bağla', 'Yenilə']
                                },
                                magicType: {
                                    show: true,
                                    title: {
                                        pie: 'Switch to pies',
                                        funnel: 'Switch to funnel',
                                    },
                                    type: ['pie', 'funnel'],
                                    option: {
                                        funnel: {
                                            x: '25%',
                                            y: '20%',
                                            width: '50%',
                                            height: '70%',
                                            funnelAlign: 'left',
                                            max: 1548
                                        }
                                    }
                                },
                                restore: {
                                    show: true,
                                    title: 'Restore'
                                },
                                saveAsImage: {
                                    show: true,
                                    title: 'Same as image',
                                    lang: ['Save']
                                }
                            }
                        },

                        // Enable drag recalculate
                        calculable: true,

                        // Add series
                        series: [{
                            name: 'Statuslar',
                            type: 'pie',
                            radius: '70%',
                            center: ['50%', '57.5%'],
                            data: [
                                {value: 0, name: 'İcraya göndərilməyib'},
                                {value: 0, name: 'Gözləyir'},
                                {value: 0, name: 'Qəbul edilib'},
                                {value: 0, name: 'Müştəriyə çatdı'},
                                {value: 0, name: 'Müştərini götürdü'},
                                {value: 0, name: 'Bitdi'},
                                {value: 0, name: 'Ləğv edilib'}
                            ]
                        }]
                    };
                    basic_pie.setOption(basic_pie_options);


                }

            )


        })
    </script>


@endsection