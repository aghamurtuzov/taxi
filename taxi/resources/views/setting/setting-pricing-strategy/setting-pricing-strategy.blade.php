@extends('main.layout')
@section('content')

@section('addLink')
    <a href="{{ route('getSettingPricingStrategyEdit',['id' => 0,'code' => $module->code]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded" style="margin-top: -20px;"><b><i class="icon-plus3"></i></b> Əlavə et</a><br>
@endsection



    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Qiymət Strategiyası</h5>
                            </div>
                            <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'setting','view'=>'setting-pricing-strategy.setting-pricing-strategy' ]) }}" name="listForm" method="get" accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" name="name" value="{{request()->input('name')}}" class="form-control" placeholder="Ad">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <select name="tariff" class="select-search form-control">
                                                    <option  value="">-- Tarif seç --</option>
                                                    @foreach($tariffs as $tarif)
                                                    <option @if(request()->input('tariff_id') == $tarif->id) selected  @endif value="{{$tarif->id}}">{{$tarif->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-default btn-block"><i class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div>


                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-pricing-strategy.setting-pricing-strategy') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&tariff={{ request()->get('tariff') }}&column_name=name&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'name') sort-amount-up icon-sort-amount-desc @endif"></i> Ad</a></th>
                                                    <th><strong>Tarif</strong></th>
                                                    <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-pricing-strategy.setting-pricing-strategy') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&tariff={{ request()->get('tariff') }}&column_name=discount&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'discount') sort-amount-up icon-sort-amount-desc @endif"></i>Endirim</a></th>
                                                    <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-pricing-strategy.setting-pricing-strategy') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&tariff={{ request()->get('tariff') }}&column_name=priority&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'priority') sort-amount-up icon-sort-amount-desc @endif"></i>Sıralama</a></th>
                                                    <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-pricing-strategy.setting-pricing-strategy') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&tariff={{ request()->get('tariff') }}&column_name=date&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'date') sort-amount-up icon-sort-amount-desc @endif"></i> Qüvvədə olduğu Tarix</a></th>
                                                    <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-pricing-strategy.setting-pricing-strategy') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&tariff={{ request()->get('tariff') }}&column_name=start_time&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'start_time') sort-amount-up icon-sort-amount-desc @endif"></i> Başlama Tarixi</a></th>
                                                    <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-pricing-strategy.setting-pricing-strategy') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&tariff={{ request()->get('tariff') }}&column_name=end_time&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'end_time') sort-amount-up icon-sort-amount-desc @endif"></i> Bitmə Tarixi</a></th>
                                                    <th><strong>Əməliyyat</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{$result->name}}</td>
                                                    <td>{{$result->tariffName->name}}</td>
                                                    <td>{{$result->discount}} {{ $result->is_fix_or_percent ? '%' : '' }}</td>
                                                    <td>{{$result->priority}}</td>
                                                    <td>
                                                        @if(empty($result->weekday))

                                                         Tarix: {{$result->date}}

                                                        @else
                                                        Həftənin günləri:

                                                        @if(in_array("1",$result->dataWeek()))
                                                            Bazar ertəsi
                                                        @endif
                                                        @if(in_array("2",$result->dataWeek()))
                                                            Çərşənbə axşamı
                                                        @endif
                                                        @if(in_array("3",$result->dataWeek()))
                                                            Çərşənbə
                                                        @endif
                                                        @if(in_array("4",$result->dataWeek()))
                                                            Cümə axşamı
                                                        @endif
                                                        @if(in_array("5",$result->dataWeek()))
                                                            Cümə
                                                        @endif
                                                        @if(in_array("6",$result->dataWeek()))
                                                            Şənbə
                                                        @endif
                                                        @if(in_array("7",$result->dataWeek()))
                                                            Bazar
                                                        @endif

                                                        @endif
                                                    </td>
                                                    <td>{{$result->start_time}}</td>
                                                    <td>{{$result->end_time}}</td>
                                                    <td>
                                                       <div class="btn-group">

                                                         <a class="btn btn-default"
                                                               href="{{ route('getSettingPricingStrategyEdit',['id' => $result->id,'code' => $module->code]) }}"><i
                                                                        class="icon-pencil7"></i></a>

                                                        <button type="button" class="btn btn-default deleteModal"
                                                                    data-id="{{ $result->id }}"
                                                                    data-code="{{ $module->code }}"><i
                                                                        class="icon-trash"></i></button>

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
                            </form>					</div>
                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection
