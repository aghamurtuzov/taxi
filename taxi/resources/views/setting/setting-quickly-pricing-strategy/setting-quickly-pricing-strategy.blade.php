@extends('main.layout')
@section('content')


@section('addLink')
    <a href="{{ route('getSettingQuicklyPricingStrategyEdit',['id' => 0,'code' => $module->code]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded" style="margin-top: -20px;"><b><i class="icon-plus3"></i></b>
        Əlavə et</a><br>
@endsection



<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title">Sürətli Qiymət Strategiyası</h5>
                        </div>
                        <form
                            action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'setting','view'=>'setting-quickly-pricing-strategy.setting-quickly-pricing-strategy' ]) }}"
                            name="listForm" method="get" accept-charset="utf-8">
                            @csrf
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="tariff" class="select-search form-control">
                                                <option value="">-- Tarif seç --</option>
                                                @foreach($tariffs as $tarif)
                                                    <option @if(request()->input('tariff') == $tarif->id) selected
                                                            @endif value="{{$tarif->id}}">{{$tarif->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="start_time"
                                                   value="{{request()->input('start_time')}}"
                                                   placeholder="Başlama Tarixi" id="start_time" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="end_time" value="{{request()->input('end_time')}}"
                                                   placeholder="Bitmə Tarixi" id="end_time" class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-default btn-block"><i
                                                class="icon-search4"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><strong>Tarif</strong></th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/setting/setting-quickly-pricing-strategy.setting-quickly-pricing-strategy') }}?_token={{ csrf_token() }}&tariff={{ request()->get('tariff') }}&start_time={{ request()->get('start_time') }}&end_time={{ request()->get('end_time') }}&column_name=percent&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i
                                                        class="@if( request()->get('column_name') == 'percent') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                    Faiz</a></th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/setting/setting-quickly-pricing-strategy.setting-quickly-pricing-strategy') }}?_token={{ csrf_token() }}&tariff={{ request()->get('tariff') }}&start_time={{ request()->get('start_time') }}&end_time={{ request()->get('end_time') }}&column_name=start_time&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i
                                                        class="@if( request()->get('column_name') == 'start_time') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                    Başlama Tarixi</a></th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/setting/setting-quickly-pricing-strategy.setting-quickly-pricing-strategy') }}?_token={{ csrf_token() }}&tariff={{ request()->get('tariff') }}&start_time={{ request()->get('start_time') }}&end_time={{ request()->get('end_time') }}&column_name=end_time&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i
                                                        class="@if( request()->get('column_name') == 'end_time') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                    Bitmə Tarixi</a></th>

                                            <th><strong>Açıqlama</strong></th>
                                            <th><strong>Əməliyyat</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $result)
                                            <tr>
                                                <td>
                                                    @foreach($tarifs as $tarif)
                                                        @if(in_array($tarif->id,$result->tariffList()))
                                                            {{$tarif->name.''}}<br>
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td>{{$result->percent}}%</td>
                                                <td>{{$result->start_time}}</td>
                                                <td>{{$result->end_time}}</td>
                                                <td>{{$result->description}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger deleteModal"
                                                                data-id="{{ $result->id }}"
                                                                data-code="{{ $module->code }}">Söndür
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                                <div class="heading-elements">
                                <span class="heading-text header-text-footer text-semibold">
                                    <select name="perPage" class="select">
                                        <option @if(isset($perPage) && $perPage == 20) selected
                                                @endif value="20">20</option>
                                        <option @if(isset($perPage) && $perPage == 50) selected
                                                @endif  value="50">50</option>
                                        <option @if(isset($perPage) && $perPage == 100) selected
                                                @endif  value="100">100</option>
                                        <option @if(isset($perPage) && $perPage == 200) selected
                                                @endif  value="200">200</option>
                                    </select>
                                </span>
                                    <ul class="pagination pagination-separated pull-right">
                                        {{ $results->links('vendor.pagination.bootstrap-4') }}
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection



@section('script')

    <script>
        $('.deleteModal').on('click', function () {
            id = $(this).data('id');
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
                        type: 'get',
                        url: 'http://otos.ru/az/administrator/price_strategy_fast/deactivate/' + id,
                        dataType: 'json',
                        success: function (data) {
                            if (data['success']) {
                                swal({
                                    title: "Sürətli qiymət strategiyası söndürüldü",
                                    type: "success",
                                    confirmButtonColor: "#4CAF50"
                                });

                                $('button[data-id = ' + data['id'] + ']').parent().parent().parent().remove();
                            } else {
                                swal({
                                    title: "",
                                    text: data['message'],
                                    type: "error",
                                    confirmButtonColor: "#F44336"
                                });
                            }
                        }
                    });
                });
        });
        $('#start_time').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            locale: {
                format: 'YYYY-MM-DD H:mm'
            }
        });
        $('#start_time').val("");
        $('#end_time').daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            locale: {
                format: 'YYYY-MM-DD H:mm'
            }
        });
        $('#end_time').val("");

        $('.select[name="perPage"]').on('change', function () {
            document.listForm.submit();
        })
    </script>

@endsection
