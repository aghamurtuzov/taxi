

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

            <!-- Form with validation -->



            <form action="http://otos.ru/auth/login" method="post" accept-charset="utf-8">
                <div class="panel panel-body login-form">
                    <div class="thumb thumb-rounded">
                        <img src="http://otos.ru/assets/images/profile.svg" alt="">
                    </div>


                    <div class="form-group form-group-login has-feedback has-feedback-left">
                        <input type="text" name="identity" value="" id="identity" class="form-control input-xlg" placeholder="Username" autocomplete="off" required="required"  />
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-login has-feedback has-feedback-left">
                        <input type="password" name="password" value="" id="password" class="form-control input-xlg" placeholder="Password" autocomplete="off" required="required"  />
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-login has-feedback has-feedback-left">

                        <select name="sip" class="form-control input-xlg">
                            <option value=""></option>
                            <option value="100001">100001</option>
                            <option value="100002">100002</option>
                            <option value="100003">100003</option>
                            <option value="100004">100004</option>
                            <option value="100005">100005</option>
                            <option value="100006">100006</option>
                            <option value="100007">100007</option>
                            <option value="100008">100008</option>
                            <option value="100009">100009</option>
                            <option value="100010">100010</option>
                            <option value="100011">100011</option>
                            <option value="100012">100012</option>
                            <option value="100013">100013</option>
                            <option value="100014">100014</option>
                        </select>

                        <div class="form-control-feedback">
                            <i class="icon-phone text-muted"></i>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="DAXIL OL"  class="btn btn-block btn-default" />



                </div>
            </form>				<!-- /form with validation -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->
<div class="time">
    <h1 class="clock"></h1>
    <h2 class="date">Şənbə, 4 noyabr 2017</h2>
</div>
</body>
</html>
