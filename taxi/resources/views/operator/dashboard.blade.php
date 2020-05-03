@extends('main.layout')
@section('content')



<style>

</style>

    <!-- Page container -->
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <div class="row">
                    <h2 style="text-align:center">Bu gün {{$orders*5}} ({{$orders}} %) sifariş qəbul etmisiz !</h2>
                    <div class="col-md-12" style="display: flex;justify-content: center;align-items:center">
                        <!-- Basic pie chart -->
                        <div id="canvas-holder" style="width:55%; ">
                            <canvas id="chart-area"></canvas>
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

    <script type="text/javascript" src="https://www.chartjs.org/dist/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://www.chartjs.org/samples/latest/utils.js"></script>

    <script>
        var percent1 = {{$fully}};
        var percent2 = {{$orders}};

        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        percent1,
                        percent2,

                    ],
                    backgroundColor: [
                        window.chartColors.gray,
                        window.chartColors.red,

                    ],
                    label: 'Dataset 1'
                }],

            },
            options: {
                responsive: true
            }
        };

        window.onload = function() {
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
        };

        document.getElementById('randomizeData').addEventListener('click', function() {
            config.data.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return percent1;
                });
            });

            window.myPie.update();
        });

        var colorNames = Object.keys(window.chartColors);
        document.getElementById('addDataset').addEventListener('click', function() {
            var newDataset = {
                backgroundColor: [],
                data: [],
                label: 'New dataset ' + config.data.datasets.length,
            };



            config.data.datasets.push(newDataset);
            window.myPie.update();
        });

        document.getElementById('removeDataset').addEventListener('click', function() {
            config.data.datasets.splice(0, 1);
            window.myPie.update();
        });
    </script>


@endsection
