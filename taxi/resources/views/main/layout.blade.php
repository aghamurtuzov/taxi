<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Smart taxi</title>

    <!-- Global stylesheets -->
    <link href="{{ asset('assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/colors.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <!-- /global stylesheets -->

    <!-- Core JS files -->

    @yield('script-app')

    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/pace.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/core/libraries/bootstrap.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/plugins/loaders/blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/nicescroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/drilldown.js') }}"></script>

    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript"
            src="{{ asset('assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switch.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/bootbox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>

    <script type="text/javascript"
            src="{{ asset('assets/js/core/libraries/jquery_ui/interactions.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/prism.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/anytime.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/picker.time.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/pickadate/legacy.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/ui/dragula.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/pickers/color/spectrum.js') }}"></script>


    <script type="text/javascript" src="{{ asset('assets/js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/components_modals.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/layout_navbar_secondary_fixed.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/plugins/forms/selects/select2.min.js') }}"></script>


    <script type="text/javascript" src="{{ asset('assets/js/pages/sidebar_dual.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/form_select2.js') }}"></script>

    <script type="text/javascript" src="{{ asset('assets/js/pages/form_select2.js') }}"></script>

    <!-- /theme JS files -->
    @yield('css')

</head>

<body>

<script type="text/javascript">
    var days = ['', '', '', '', '', '', ''];
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
</script>

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ route('getOperatorDashboard') }}"><img
                src="http://otos.ru//assets/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">


        <p class="navbar-text"><span class="label bg-success-400">Xətdə</span></p>

        <ul class="nav navbar-nav navbar-right">
            <li>
                <button class="btn btn-success btn-xs btnPriceStrategy " style="margin-top: 8px;"><i
                        class="icon-alarm"></i></button>
            </li>

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="http://otos.ru/upload/user/default.png" alt="Fərid Nuriyev">
                    <span>Fərid Nuriyev</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
{{--                    <li><a href="{{ route('getOperatorView',['id' => 1]) }}"><i class="icon-user-plus"></i>Mənim--}}
{{--                            Profilim</a></li>--}}

                    <li class="divider"></li>
                    <li><a href="{{ route('getOperatorEdit',['id' => 1,'code' => '719010']) }}"><i
                                class="icon-cog5"></i>Redaktə et</a></li>
                    <li><a href="http://taxi.otos.ru/logout"><i class="icon-switch2"></i>Cıxış</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            @can("administrator")
            <li class="active"><a href="{{ route('getOperatorDashboard') }}"><i
                        class="icon-display4 position-left"></i> DASHBOARD</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-car2 position-left"></i> TAKSİ <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getTaxi') }}">Taksilər</a></li>
                    <li><a href="{{ route('getTaxiCategory') }}"> Kateqoriyalar</a></li>
                    <li><a href="{{ route('getTaxiCharacteristics') }}"> Aqreqatlar</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('getCarLanguage') }}"> Dil </a></li>
                    <li><a href="{{ route('getTaxiBlocked') }}"> Bloklanmış Taksilər</a></li>
                </ul>
            </li>
            @endcan
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cart position-left"></i> SİFARİŞ <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getOrders') }}">Sifarişlər</a></li>
                    <li><a href="{{ route('getOrderNew') }}">Yeni Sifariş</a></li>
{{--                    <li><a href="http://otos.ru/az/administrator/orderLoop">Avto Dayə</a></li>--}}
                </ul>
            </li>

            {{--            <li class="dropdown">--}}
            {{--                <a href="{{ route('getOrderSearchPlace') }}">--}}
            {{--                    <i class="icon-cart position-left"></i> Google search place--}}
            {{--                </a>--}}
            {{--            </li>--}}

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-user-tie position-left"></i> MÜŞTƏRİ <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getCustomer') }}"> Müştərilər </a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('getCustomerGroup') }}">Müştəri Qrupları </a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-car position-left"></i> AVTOMOBİL <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getCarMark') }}"> Marka </a></li>
                    <li><a href="{{ route('getCarModel') }}"> Model </a></li>
                    <li><a href="{{ route('getCarFuelType') }}"> Yanacaq Növü </a></li>
                    <li><a href="{{ route('getCarBanType') }}"> Ban Növü </a></li>
                <!-- <li><a href="{{ route('getCarLanguage') }}"> Dil </a></li> -->
                <!-- <li><a href="{{ route('getCarDevice') }}"> Qurğu </a></li> -->
                </ul>
            </li>

            <!-- USER -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-users position-left"></i> İSTİFADƏÇİ <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getOperator') }}"> İstifadəçilər</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('getOperatorGroup') }}">Qruplar</a></li>
                    <li><a href="{{ route('getOperatorSubGroup') }}">Alt Qruplar</a></li>
                </ul>
            </li>

            <!-- SMS -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-envelop position-left"></i> SMS <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getSms') }}">Smslər</a></li>
                    <li><a href="{{ route('getSmsNew',['id' => 0,'type' => 0]) }}"> Yeni sms</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('getSmsMessageTemplate',['type' => 'sms']) }}"> Sms Şablonu</a></li>
                </ul>
            </li>

            <!-- MESSAGE -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-bell3 position-left"></i> PUSH <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getMessage') }}">Push </a></li>
                    <li><a href="{{ route('getMessageNew',['id' => 0,'type' => 0]) }}"> Push Göndər</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('getSmsMessageTemplate',['type' => 'message' ]) }}"> Push Şablonu</a></li>
                </ul>
            </li>

            <!-- TRANSACTION -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-coin-dollar position-left"></i>ƏMƏLİYYAT<span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getOperation') }}">Əməliyyatlar</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('getOperationBalanceIncrease') }}">Balans Artır</a></li>
                    <li><a href="{{ route('getOperationBalancePunishment') }}">Balans Cərimələ</a></li>
                </ul>

            </li>
            <!-- Priority -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-coin-dollar position-left"></i>PRİORİTET<span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getPriorityOperation') }}"> Prioritet Əməliyyatı</a></li>
                    <li><a href="{{ route('getPriorityDecrease') }}">Prioritet Azaldılması</a></li>
                    <li class="divider"></li>
                </ul>

            </li>

            <!-- NOTE -->
        {{--<li class="dropdown">--}}
        {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
        {{--<i class="icon-notebook position-left"></i>QEYD<span class="caret"></span>--}}
        {{--</a>--}}
        {{--<ul class="dropdown-menu width-250">--}}
        {{--<li><a href="{{ route('getNote') }}">Qeydlər</a></li>--}}
        {{--<li><a href="{{ route('getNoteNew') }}"> Qeyd əlavə et</a></li>--}}
        {{--<li class="divider"></li>--}}
        {{--<li><a href="{{ route('getNoteCategory') }}">Kateqoriyalar</a></li>--}}
        {{--</ul>--}}
        {{--</li>--}}

        <!-- STATISTICS -->
            <!-- <li class="dropdown">
                <a href="#">
                    <i class="icon-stats-growth position-left"></i>STATİSTİKA <span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="http://otos.ru//az/administrator/statistics/"> Taksi </a></li>
                    <li><a href="http://otos.ru//az/administrator/statistics/"> Müştəri </a></li>
                    <li><a href="http://otos.ru//az/administrator/statistics/"> Zəng </a></li>
                    <li><a href="http://otos.ru//az/administrator/statistics/"> Sifariş </a></li>
                </ul>
            </li> -->

            <!-- REGION -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-stats-growth position-left"></i>BÖLGƏ<span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                <!-- <li><a href="{{ route('getRegionCountry') }}">Ölkə</a></li> -->
                <!-- <li><a href="{{ route('getRegionAll') }}">Bölgə</a></li> -->
                <!-- <li><a href="{{ route('getRegionCity') }}">Şəhər</a></li> -->
                    <li><a href="{{ route('getRegionDistrict') }}">Rayon</a></li>
                    <li><a href="{{ route('getRegionObject') }}">Obyekt</a></li>
                    <li><a href="{{ route('getRegionObjectCategory') }}">Obyekt Kateqoriyaları</a></li>
                    <li><a href="{{ route('getRegionSpecialObject') }}">Xüsusi Obyekt</a></li>
                    <li><a href="{{ route('getRegionSpecialObjectCategory') }}">Xüsusi Obyekt
                            Kateqoriyaları</a></li>
                <!-- <li><a href="{{ route('getRegionDangerousObject') }}">Təhlükəli Obyekt</a></li> -->
                    <li><a href="{{ route('getRegionTurnstileAccess') }}">Turniket Girişi</a></li>
                    <li><a href="{{ route('getRegionStreet') }}">Küçə</a></li>
                    <li><a href="{{ route('getRegionAddress') }}">Ünvan</a></li>
                </ul>
            </li>

            <!-- CALLS -->
            <li class="dropdown">
                <a href="#"><i class="icon-phone-wave position-left"></i>ZƏNG</a>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-cog position-left"></i>PARAMETR<span class="caret"></span>
                </a>
                <ul class="dropdown-menu width-250">
                    <li><a href="{{ route('getSettingAreaPricing') }}">Ərazi qiymətləndirmə</a></li>
                <!-- <li><a href="{{ route('getSettingLanguage') }}">Dil</a></li> -->
                    <li><a href="{{ route('getSettingTariff') }}">Tarif</a></li>
                    <li><a href="{{ route('getSettingPricingStrategy') }}">Kampaniyalar</a></li>
                <!-- <li><a href="{{ route('getSettingQuicklyPricingStrategy') }}">Sürətli Qiymət Strategiyası</a> -->
                    </li>
                    <li><a href="{{ route('getSettingPriorityStrategy') }}">Prioritet Strategiyası</a></li>
                    <li><a href="{{ route('getSettingPunishmentStrategy') }}">Cərimə Strategiyası</a></li>
                    <li><a href="{{ route('getSettingUserLoginAttemps') }}">İstifadəçi Giriş Cəhdləri</a></li>
                    <li><a href="{{ route('getSettingReasonCancellation') }}">Ləğv etmə səbəbləri</a></li>
                    <li><a href="{{ route('getSettingParameter') }}">Parametrlər</a></li>
                </ul>
            </li>

            <!-- <li class=""><a href="#"><i
                        class="icon-display4 position-left"></i> STATISTIKA</a></li> -->
        </ul>

    </div>
</div>
<!-- /second navbar -->


<!-- Page header -->
<div class="page-header page-header-default border-bottom-lg border-bottom-primary">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <i class="icon-arrow-left52 position-left"></i>
                <span class="text-semibold">Home</span> - Ana Səhifə
                <small class="display-block"></small>
            </h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                @yield('addLink')
            </div>
        </div>
        <div class="breadcrumb-line">

            <ul class="breadcrumb breadcrumb-caret">
                <li><a href="http://otos.ru/az/administrator/dashboard"><i class="icon-home2 position-left"></i> Smart
                        Taxi</a></li>
                <li class="active">Ana Səhifə</li>
            </ul>

            <ul class="breadcrumb-elements">
            </ul>

            <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>
        </div>
    </div>
</div>
<!-- /page header -->
@yield('content')


<!-- Footer -->
<div class="navbar navbar-default navbar-fixed-bottom">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second"><i
                    class="icon-circle-up2"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second">
        <div class="navbar-text">
            &copy; 2016-<?php echo date('Y'); ?>. <a href="#">Smart Taxi</a>
        </div>

        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="#">System logs</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- /footer -->


@yield('script')

<script>

    $(function () {
        $('.date-new').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            locale: {
                format: 'YYYY/MM/DD',
            },
            maxYear: parseInt(moment().format('YYYY'), 10)
        });
    });

    $('.resetDate').on('click', function (e) {
        e.preventDefault();
        $('.date-new').val('');
    });

    $('.daterange-single').pickadate({
        // monthsFull: months,
        // weekdaysShort: days,
        today: 'Bugun',
        clear: 'Temizle',
        close: 'Bagla',
        formatSubmit: 'yyyy/mm/dd',
    });

    $('.daterange-single-3').pickadate({
        // monthsFull: months,
        // weekdaysShort: days,
        today: 'Bugun',
        clear: 'Temizle',
        close: 'Bagla',
        formatSubmit: 'hh:mm',
    });

    // Single picker
    $('.daterange-single-2').daterangepicker({
        singleDatePicker: true,
        format: 'Y-m-d'
    });

    // Display color formats
    $(".colorpicker-show-input").spectrum({
        showInput: true
    });


</script>


<script type="text/javascript">
    $('button.btnPriceStrategy').click(function () {
        window.location.href = '{{ route('getSettingQuicklyPricingStrategyEdit',['id' => 0,'code' => '186589']) }}';
    });
</script>


<script>
    $('.deleteModal').on('click', function () {

        id = $(this).data('id');
        code = $(this).data('code');

        swal({
                title: "Silmək istədiyinizdən əminsiniz?",
                type: "error",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: "#F44336",
                showLoaderOnConfirm: true
            },
            function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    type: 'post',
                    url: '{{ route('postModuleDelete') }}',
                    dataType: 'json',
                    data: {
                        id: id,
                        code: code
                    },
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "Silindi",
                                type: "success",
                                confirmButtonColor: "#4CAF50"
                            });

                            $('button[data-id = ' + id + ']').parent().parent().parent().remove();
                            $('a[data-id = ' + id + ']').closest('tr').remove();
                        } else {
                            swal({
                                title: "Silə bilməzsiniz",
                                text: data['message'],
                                type: "error",
                                confirmButtonColor: "#F44336"
                            });
                        }
                    }
                });
            });
    });

    function changeStatus() {
        $object = $(this);

        id = $object.data('id');
        code = $object.data('code');
        status = $object.data('status');
        status = (status == true) ? 0 : 1;
        column = $object.data('column');

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            url: '{{ route('postModuleStatus') }}',
            method: 'post',
            data: {
                id: id,
                code: code,
                status: status,
                column: column,
            },
            dataType: 'json',
            success: function (data) {
                if (data['success']) {
                    if (data['status'] === '1') {
                        if (column == 'banned') {
                            $('#isBanned_' + id).show();
                            $('#isNotBanned_' + id).hide();
                            return false;
                        }
                        if (column == 'selected') {
                            $('#isSelect_' + id).show();
                            $('#isNotSelect_' + id).hide();
                            return false;
                        }
                        if (column == 'select') {
                            $('#isSelect_' + id).show();
                            $('#isNotSelect_' + id).hide();
                            return false;
                        }
                        $('#isActive_' + id).show();
                        $('#isDeactive_' + id).hide();
                    } else {
                        if (column == 'banned') {
                            $('#isBanned_' + id).hide();
                            $('#isNotBanned_' + id).show();
                            return false;
                        }
                        if (column == 'selected') {
                            $('#isSelect_' + id).hide();
                            $('#isNotSelect_' + id).show();
                            return false;
                        }
                        if (column == 'select') {
                            $('#isSelect_' + id).hide();
                            $('#isNotSelect_' + id).show();
                            return false;
                        }
                        $('#isActive_' + id).hide();
                        $('#isDeactive_' + id).show();
                    }
                }
            }
        });
    }

    $('.statusToChange').on('click', changeStatus)
    $('.select[name="perPage"]').on('change', function () {
        document.listForm.submit();
    });

    function nowDate() {
        date = new Date;
        date = date.getFullYear() + '-' + date.getMonth() + '-' + date.getDay() + ' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds();
        return date;
    }

    $('.bannedTaxi').on('click', function () {
        $object = $(this);

        id = $object.data('id');
        code = $(this).data('code');
        status = $object.data('status');
        status = (status == true) ? 0 : 1;
        column = $(this).data('column');

        swal({
                title: "Söndürmək istədiyinizdən əminsiniz?",
                type: "error",
                showCancelButton: true,
                closeOnConfirm: false,
                confirmButtonColor: "#F44336",
                showLoaderOnConfirm: true
            },
            function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    url: '{{ route('postModuleStatus') }}',
                    method: 'post',
                    data: {
                        id: id,
                        code: code,
                        status: status,
                        column: column,
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data['success']) {
                            swal({
                                title: "Bloklanma söndürüldü",
                                type: "success",
                                confirmButtonColor: "#4CAF50"
                            });
                            var parent = $('button[data-id = ' + id + ']').parent();
                            $('button[data-id = ' + id + ']').remove();
                            parent.append('<span class="label label-default">İşləmir</span>');
                            parent.parent().find('.end_time').text(nowDate());
                        } else {
                            swal({
                                title: "Silinmə zamanı səhv baş verdi",
                                text: data['message'],
                                type: "error",
                                confirmButtonColor: "#F44336"
                            });
                        }
                    }
                });
            });
    });

    $('.destinationIdInput').on('keyup', function (e) {
        e.preventDefault();

        let object_ = $(this);
        let text = $(this).val();
        var type = $(this).attr('data-type');

        object_.parent().find('.search_result').empty();
        object_.parent().find('.search_result').hide();

        object_.parent().find('#destination').val('');

        if (text.length < 4) {
            return false;
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            type: 'post',
            url: '{{ route('postDestinationSearch') }}',
            dataType: 'json',
            data: {
                text: text,
                type: type,
            },
            success: function (data) {
                if (data.success !== false) {

                    $.each(data.results, function (v, result) {
                            console.log(result);
                            let html = '';
                            switch (type) {
                                case '1':
                                    let action = result.action != 0 ? 'Sifarişdə' : 'Boş';
                                    let disabled = result.action != 0 ? 'pointer-events:none;\n' + 'opacity:0.4;' : '';
                                    let color = result.action != 0 ? '#ff0000' : '#33cc33';
                                    html += "<li style='" + disabled + "' onclick='parseDestionation(this);' data-id=" + result.id + ">" + result.code + "-" + result.firstname + " " + result.lastname + " <span style='color:" + color + ";'>(" + action + ")" + "</span></li>";
                                    break;
                                case '2':
                                    html += "<li onclick='parseDestionation(this);' data-id=" + result.id + ">" + result.phone + "</li>";
                                    break;
                                case '3':
                                    html += "<li onclick='parseDestionation(this);' data-id=" + result.id + ">" + result.name + "</li>";
                                    break;
                                default:
                                    html = false;
                            }
                            if (html != false) {
                                object_.parent().find('.search_result').show();
                                object_.parent().find('.search_result').append(html);
                            }
                        }
                    );

                }
            }
        });


    });

    $('.destinationType').on('change', function (e) {
        e.preventDefault();

        let js_type = $(this).attr('data-js-type') ? $(this).attr('data-js-type') : 0;

        $('.panel-body').find('.destinationIdField').eq(js_type).show();
        $('.panel-body').find('.destinationIdInput').eq(js_type).val('');
        $('.panel-body').find('.search_result').eq(js_type).empty();
        $('.panel-body').find('.search_result').eq(js_type).hide();
        $('.panel-body').find('.destinationIdInputHidden').eq(js_type).val('');

        let type = $(this).val();

        if (type == 4) {
            $('.panel-body').find('.destinationIdField').eq(js_type).hide();
            $('.panel-body').find('.destinationIdInputHidden').eq(js_type).val(0);
        }

        $('.panel-body').find('.destinationIdInput').eq(js_type).attr('data-type', type);


    });

    function parseDestionation(t) {
        let text = $(t).text();
        let id = $(t).attr('data-id');
        let object_ = $(t);

        object_.parent().parent().find('.destinationIdInput').attr('value', text);
        object_.parent().parent().find('.destinationIdInput').val(text);
        object_.parent().parent().find('.destinationIdInputHidden').val(id);
        object_.parent().parent().find('.search_result').empty();
        $('.search_result').hide();

        let is_map = $('.destinationIdInput').attr('data-map');
        if (is_map == 1) {
            getTaxies();
        }

    }

    function addressSearch() {
        $('.addressInput').on('keyup', function (e) {
            e.preventDefault();

            let text = $(this).val();
            if (text.length < 4) {
                return false;
            }

            $('.search_result').empty();
            $('.search_result').hide();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'post',
                url: '{{ route('postDestinationSearchAddress') }}',
                dataType: 'json',
                data: {
                    text: text,
                },
                success: function (data) {
                    if (data.success !== false) {
                        setTimeout(function () {
                            $.each(data.results, function (v, result) {
                                    let html = '';
                                    // if (result.type == 2) {
                                    //     html += "<li onclick='parseDestinationStreet(this);' data-type=" + result.type + " data-id=" + result.id + ">" + result.name + "</li>";
                                    // } else {
                                    html += "<li onclick='parseDestinationStreet(this);' data-type=" + result.type + "  data-lat=" + result.latitude + " data-lng=" + result.longitude + " data-id=" + result.id + ">" + result.name + "</li>";
                                    // }
                                    if (html != false) {
                                        $('.search_result').show();
                                        $('.search_result').append(html);
                                    }
                                }
                            );
                        }, 500);

                    }
                }
            });
        });
    }

    function parseDestinationStreet(t) {
        let text = $(t).text();
        let id = $(t).attr('data-id');
        let lat = $(t).attr('data-lat');
        let lng = $(t).attr('data-lng');


        $('#street').val(text);
        $('.object_id').val(id);
        $('.latitude').val(lat);
        $('.longitude').val(lng);
        $('.search_result').empty();
        $('.search_result').hide();
        $('.destinationIdInputHidden').val(id);

    }

    $('select#parentGroup').on('change', function () {
        type = this.value;
        // $("input.number").val("");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            type: 'post',
            url: '{{ route('postSubGroups') }}',
            dataType: 'json',
            data: {
                id: type
            },
            success: function (response) {

                if (response.status == "true") {
                    $('#subGroup').empty();
                    $.each(response.subgroups, function () {
                        $('#subGroup')
                            .append($("<option></option>")
                                .attr({
                                    "value": this.id
                                })
                                .text(this.name));
                    });
                } else {
                    $('#subGroup').empty();
                }
            }
        });
    });


    $("body").delegate(".delete_plan_for_time_item", "click", function () {
        $(this).parent().remove();
    });

    // $('#createPlanForTime').on('click', function () {
    //
    //     to_times = $('input[name="end[]"]');
    //     from_times = $('input[name="start[]"]');
    //     from_time = "";
    //     if (jQuery.type(to_times.value) === 'undefined') {
    //         from_time = $('input[name="end[]"]').val();
    //         if (from_time != "") $('input[name="end[]"]').attr('readonly', 'readonly');
    //     } else {
    //         if (parseInt(to_times[to_times.length - 1].value) > parseInt(from_times[from_times.length - 1].value)) {
    //             $(to_times[to_times.length - 1]).attr('readonly', 'readonly');
    //             from_time = to_times[to_times.length - 1].value;
    //         }
    //     }
    //
    //     if (from_time != "") {
    //         item = "                                     <div class=\"plan_for_time_item\">\n" +
    //             "                                            <label class=\"control-label col-lg-1\">Başlama vaxtı</label>\n" +
    //             "                                            <div class=\"col-lg-2\">\n" +
    //             "                                                <input name=\"min_from_time[]\" type=\"text\" value='" + from_time + "' readonly class=\"form-control\" placeholder=\"Başlama vaxtı\">\n" +
    //             "                                            </div>\n" +
    //             "                                            <label class=\"control-label col-lg-1\">Bitmə vaxtı</label>\n" +
    //             "                                            <div class=\"col-lg-2\">\n" +
    //             "                                                <input name=\"min_to_time[]\" type=\"text\" class=\"form-control\" placeholder=\"Bitmə vaxtı\">\n" +
    //             "                                            </div>\n" +
    //             "                                            <label class=\"control-label col-lg-1\">Qiymət</label>\n" +
    //             "                                            <div class=\"col-lg-2\">\n" +
    //             "                                                <input name=\"min_time_price[]\" type=\"text\" class=\"form-control\" placeholder=\"Qiymət\">\n" +
    //             "                                            </div>\n" +
    //             "                                           <label class=\"control-label col-lg-1\">\n" +
    //             "                                                <input name=\"min_time_fix[]\" type=\"checkbox\">\n" +
    //             "                                                Fiks\n" +
    //             "                                            </label>" +
    //             "                                            <button type=\"button\" class=\"delete_plan_for_time_item btn btn-danger\">Sil</button>\n" +
    //             "                                            <br>\n" +
    //             "                                           <br>" +
    //             "                                        </div>";
    //
    //         $('#plan_for_time_block').append(item);
    //     } else {
    //         swal({
    //             title: "Düzgün zaman daxil edin",
    //             type: "error",
    //             closeOnConfirm: true,
    //             confirmButtonColor: "#F44336"
    //         });
    //     }
    // });

    $("body").delegate(".delete_plan_for_distance_item", "click", function () {
        $(this).parent().remove();
    });

    $('#createPlanForDistance').on('click', function () {
        to_distances = $('input[name="end[]"]');
        from_distances = $('input[name="start[]"]');
        from_distance = "";
        if (jQuery.type(to_distances.val()) === 'undefined') {
            from_distance = 'yeni';
        } else {
            if (parseInt(to_distances[to_distances.length - 1].value) > parseInt(from_distances[from_distances.length - 1].value)) {
                $(from_distances[from_distances.length - 1]).attr('readonly', 'readonly');
                from_distance = to_distances[to_distances.length - 1].value;
            }
        }

        if (from_distance != "") {
            item = "<div class=\"plan_for_distance_item\">\n" +
                "                                                <label class=\"control-label col-lg-1\">Məsafədən</label>\n" +
                "                                                <div class=\"col-lg-2\">\n" +
                "                                                    <input name=\"start[]\" type=\"text\" value='" + from_distance + "' readonly class=\"form-control\" placeholder=\"Məsafədən\">\n" +
                "                                                </div>\n" +
                "                                                <label class=\"control-label col-lg-1\">Məsafəyə</label>\n" +
                "                                                <div class=\"col-lg-2\">\n" +
                "                                                    <input name=\"end[]\" type=\"text\" class=\"form-control\" placeholder=\"Məsafəyə\">\n" +
                "                                                </div>\n" +
                "                                                <label class=\"control-label col-lg-1\">Qiymət</label>\n" +
                "                                                <div class=\"col-lg-2\">\n" +
                "                                                    <input name=\"price[]\" type=\"text\" class=\"form-control\" placeholder=\"Qiymət\">\n" +
                "                                                </div>\n" +
                "                                               <label class=\"control-label col-lg-1\">\n" +
                "                                                    <input name=\"fix[]\" type=\"checkbox\">\n" +
                "                                                    Fiks\n" +
                "                                                </label>" +
                "                                                <button type=\"button\" class=\"delete_plan_for_distance_item btn btn-danger\">Sil</button>\n" +
                "                                                <br>\n" +
                "                                                <br>\n" +
                "                                            </div>";

            $('.plan_for_distance_block:last').append(item);
            console.log('sds');
        } else {
            swal({
                title: "Düzgün məsafə daxil edin",
                type: "error",
                closeOnConfirm: true,
                confirmButtonColor: "#F44336"
            });
        }
    });

    $("body").delegate(".fix_checker", "change", function () {
        if ($(this).is(':checked')) {
            $(this).next().val(1);
        } else {
            $(this).next().val(0);
        }
    });

    $('select[name="for"]').trigger('change');
    // Time picker
    $("#anytime-time").AnyTime_picker({
        format: "%H:%i"
    });
    $("#anytime-time1").AnyTime_picker({
        format: "%H:%i"
    });
    $('.taxi_birthday').daterangepicker({
        showDropdowns: true,
        singleDatePicker: true,
        applyClass: 'bg-slate-600',
        cancelClass: 'btn-default',
        locale: {
            format: 'YYYY-MM-DD'
        },
        minYear: '1900',
    });


    $('.smsTemplate').on('change', function (e) {
        e.preventDefault();

        $('.messageText').text('');
        let value = $(this).val();

        if (value != 0) {
            $('.messageField').hide();
            $('.messageText').text(value);
        } else {
            $('.messageField').show();
        }

    });


</script>


</body>
</html>
