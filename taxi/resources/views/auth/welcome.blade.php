

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMARTTAXI</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/core.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/components.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/colors.css')}}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="{{asset('assets/js/plugins/loaders/pace.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/libraries/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/loaders/blockui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/ui/nicescroll.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/ui/drilldown.js')}}"></script>
    <!-- /core JS files -->

    <script type="text/javascript" src="{{asset('assets/js/plugins/velocity/velocity.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/velocity/velocity.ui.min.js')}}"></script>

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/validation/validate.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/forms/styling/uniform.min.js"')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/core/time.js')}}"></script>

    <script type="text/javascript" src="{{asset('assets/js/load/intro.js')}}"></script>
    <!-- /theme JS files -->

</head>

<body class="login-container login-cover">
<script type="text/javascript">
    var days = [
        'Bazar',
        'Bazar ertəsi',
        'Çərşənbə axşamı',
        'Çərşənbə',
        'Cümə axşamı',
        'Cümə',
        'Şənbə'
    ];
    var months = [
        'Yanvar',
        'Fevral',
        'Mart',
        'Aprel',
        'May',
        'İyun',
        'İyul',
        'Avqust',
        'Sentyabr',
        'Oktyabr',
        'Noyabr',
        'Dekabr'
    ];
</script>
<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <div class="row">

                <div class="col-md-3 col-md-offset-3">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel administrator text-center bg-danger-800 has-bg-image">
                                <div class="panel-body">
                                    <div class="content-group mt-6 no-margin-bottom" style="margin-top: 60px;">
                                        <a href="{{ route('getLogin') }}"><i class="icon-user-tie icon-3x text-white"></i></a>
                                    </div>
                                    <h4 class="text-semibold no-margin-bottom mt-4">Administrator</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel text-center bg-orange-800 has-bg-image">
                                <div class="panel-body">
                                    <div class="content-group mt-6 no-margin-bottom">
                                        <a href="{{ route('getLogin') }}"><i class="icon-calculator4 icon-3x text-white"></i></a>
                                    </div>
                                    <h4 class="text-semibold no-margin-bottom mt-5">Cashier</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="panel text-center bg-grey-800 has-bg-image">
                                <div class="panel-body">
                                    <div class="content-group mt-6 no-margin-bottom ">
                                        <a href="{{ route('getLogin') }}"><i class="icon-headset icon-3x text-white"></i></a>
                                    </div>
                                    <h4 class="text-semibold no-margin-bottom mt-5">Operator</h4>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="col-md-3">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel text-center bg-success-700 has-bg-image" >
                                <div class="panel-body">
                                    <div class="content-group mt-6 no-margin-bottom">
                                        <a href="{{ route('getLogin') }}"><i class="icon-steering-wheel icon-3x text-white"></i></a>
                                    </div>
                                    <h4 class="text-semibold no-margin-bottom mt-5">Taxi Park</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel text-center bg-primary-700 has-bg-image" >
                                <div class="panel-body">
                                    <div class="content-group mt-6 no-margin-bottom">
                                        <a href="{{ route('getLogin') }}"><i class="icon-car2 icon-3x text-white"></i></a>
                                    </div>
                                    <h4 class="text-semibold no-margin-bottom mt-5">Dispatcher</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel text-center bg-purple-800 has-bg-image">
                                <div class="panel-body">
                                    <div class="content-group mt-6 no-margin-bottom">
                                        <a href="{{ route('getLogin') }}"><i class="icon-pie5 icon-3x text-white"></i></a>
                                    </div>
                                    <h4 class="text-semibold no-margin-bottom mt-5">Accounting</h4>
                                </div>
                            </div>
                        </div>

                    </div>




                </div>

                <div class="col-md-3 text-right">
                    <div style="top: 50px;bottom: unset;right:100px;"  class="time">
                        <h1 class="clock"></h1>
                        <h2 class="date">Şənbə, 4 noyabr 2017</h2>
                    </div>
                </div>
            </div>

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
