$(function () {
    $.ajax({
        type: 'get',
        url: 'http://ulduz.smarttaxi.cloud/operator/dashboard/getStatistic',
        response: 'json',
        contentType: "application/json",
        dataType: 'json',
        success: function (response)
        {   
            var names = [];
            var values = [];
            $.each(response,function(){
                names.push(this.name);
                values.push(this.value);
            });
            console.log(names);
            console.log(values);

            

            require.config({
                paths: {
                    echarts: '/assets/js/plugins/visualization/echarts'
                }
            });

            require(
                [
                    'echarts',
                    'echarts/theme/limitless',
                    'echarts/chart/pie',
                    'echarts/chart/funnel'
                ],


                // Charts setup
                function (ec, limitless) {


                    // Initialize charts
                    // ------------------------------
                    var rose_diagram_hidden = ec.init(document.getElementById('rose_diagram_hidden'), limitless);



                    // Placeholder style
                    var placeHolderStyle = {
                        normal: {
                            color: 'rgba(0,0,0,0)',
                            label: {show: false},
                            labelLine: {show: false}
                        },
                        emphasis: {
                            color: 'rgba(0,0,0,0)'
                        }
                    };



                    //
                    // Nightingale roses with hidden labels options
                    //

                    rose_diagram_hidden_options = {

                        // Add title
                        title: {
                            text: 'Günlük sifarişlər',
                            subtext: 'Operatorların günlük sifariş göstəriciləri',
                            x: 'center'
                        },

                        // Add tooltip
                        tooltip: {
                            formatter: "{a} <br/>{b}: ({d}%)"
                        },

                        // Add legend
                        legend: {
                            x: 'left',
                            y: 'top',
                            orient: 'vertical',
                            data: names
                        },



                        // Enable drag recalculate
                        calculable: true,

                        // Add series
                        series: [
                            {
                                name: 'Operator',
                                type: 'pie',
                                radius: ['15%', '73%'],
                                center: ['50%', '57%'],
                                roseType: 'radius',

                                // Funnel
                                width: '40%',
                                height: '78%',
                                x: '30%',
                                y: '17.5%',
                                max: 450,

                                itemStyle: {
                                    normal: {
                                        label: {
                                            show: false
                                        },
                                        labelLine: {
                                            show: false
                                        }
                                    },
                                    emphasis: {
                                        label: {
                                            show: true
                                        },
                                        labelLine: {
                                            show: true
                                        }
                                    }
                                },
                                data: response

                            }
                        ]
                    };


                    //
                    // Multiple donuts options
                    //

                    // Top text label
                    var labelTop = {
                        normal: {
                            label: {
                                show: true,
                                position: 'center',
                                formatter: '{b}\n',
                                textStyle: {
                                    baseline: 'middle',
                                    fontWeight: 300,
                                    fontSize: 15
                                }
                            },
                            labelLine: {
                                show: false
                            }
                        }
                    };

                    // Format bottom label
                    var labelFromatter = {
                        normal: {
                            label: {
                                formatter: function (params) {
                                    return '\n\n' + (100 - params.value) + '%'
                                }
                            }
                        }
                    }

                    // Bottom text label
                    var labelBottom = {
                        normal: {
                            color: '#eee',
                            label: {
                                show: true,
                                position: 'center',
                                textStyle: {
                                    baseline: 'middle'
                                }
                            },
                            labelLine: {
                                show: false
                            }
                        },
                        emphasis: {
                            color: 'rgba(0,0,0,0)'
                        }
                    };

                    // Set inner and outer radius
                    var radius = [60, 75];




                    // Apply options
                    // ------------------------------

                    rose_diagram_hidden.setOption(rose_diagram_hidden_options);

                    // Resize charts
                    // ------------------------------

                    window.onresize = function () {
                        setTimeout(function (){
                            rose_diagram_hidden.resize();
                        }, 200);
                    }
                }
            );
        }
    })
});