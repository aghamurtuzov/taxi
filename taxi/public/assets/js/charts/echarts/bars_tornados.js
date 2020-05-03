/* ------------------------------------------------------------------------------
 *
 *  # Echarts - bars and tornados
 *
 *  Bars and tornados chart configurations
 *
 *  Version: 1.0
 *  Latest update: August 1, 2015
 *
 * ---------------------------------------------------------------------------- */

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
            var statistic = [];
            $.each(response, function() {
                if(this.percent >0){
                    names.push(this.name);
                    statistic.push(this.percent);    
                }
            });
            require.config({
                paths: {
                    echarts: '/assets/js/plugins/visualization/echarts'
                }
            });
            require(
                [
                    'echarts',
                    'echarts/theme/limitless',
                    'echarts/chart/bar',
                    'echarts/chart/line'
                ],

                // Charts setup
                function (ec, limitless) {

                    var basic_bars = ec.init(document.getElementById('basic_bars'), limitless);



                    basic_bars_options = {

                        // Setup grid
                        grid: {
                            x: 75,
                            x2: 35,
                            y: 35,
                            y2: 25
                        },

                        // Add tooltip
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow'
                            }
                        },

                        // Add legend
                        legend: {
                            data: ['Year 2013']
                        },

                        // Enable drag recalculate
                        calculable: true,

                        // Horizontal axis
                        xAxis: [{
                            type: 'value',
                            boundaryGap: [0, 0.01]
                        }],

                        // Vertical axis
                        yAxis: [{
                            type: 'category',
                            data: names
                        }],

                        // Add series
                        series: [
                            {
                                name: 'Year 2013',
                                type: 'bar',
                                itemStyle: {
                                    normal: {
                                        color: '#EF5350'
                                    }
                                },
                                data: statistic
                            }
                        ]
                    };


                    var placeHoledStyle = {
                        normal: {
                            barBorderColor: 'rgba(0,0,0,0)',
                            color: 'rgba(0,0,0,0)'
                        },
                        emphasis: {
                            barBorderColor: 'rgba(0,0,0,0)',
                            color: 'rgba(0,0,0,0)'
                        }
                    };
                    var dataStyle = { 
                        normal: {
                            label: {
                                show: true,
                                position: 'insideLeft',
                                formatter: '{c}%'
                            }
                        },
                        emphasis: {
                            label: {
                                show: true
                            }
                        }
                    };

                

                    var labelRight = {
                        normal: {
                            color: '#FF7043',
                            label: {
                                position: 'right'
                            }
                        }
                    };

                

                    basic_bars.setOption(basic_bars_options);

                    window.onresize = function () {
                        setTimeout(function (){
                            basic_bars.resize();
                        }, 200);
                    }
                }
            );
        }
        });
});

    