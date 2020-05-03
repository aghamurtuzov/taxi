@extends('main.layout')
@section('content')

@section('addLink')
    <a href="{{ route('getSettingPunishmentStrategyEdit',['id' => 0,'code' => $module->code]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded" style="margin-top: -20px;"><b><i class="icon-plus3"></i></b> Əlavə et</a><br>
@endsection







    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Cərimə Strategiyası</h5>
                            </div>


                            <div class="panel-body">
                                <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'setting','view'=>'setting-punishment-strategy.setting-punishment-strategy' ]) }}" name="listForm" method="get" accept-charset="utf-8">
                                @csrf
                                    <div class="row">

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                                    <input name = "from_time" type="text" class="form-control" id="anytime-time" value="{{request()->input('from_time')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                                    <input name = "to_time" type="text" class="form-control" id="anytime-time1" value="{{request()->input('to_time')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="action" class="select-fixed-single destinationType">
                                                    <option value="">-- Əməliyyat seç ---</option>
                                                    <option @if(request()->input('action') == '1') selected
                                                            @endif value="1">Tamamlanıb</option>
                                                    <option @if(request()->input('action') == '2') selected
                                                            @endif value="2">Ləğv edilib</option>
                                                    <option @if(request()->input('action') == '3') selected
                                                            @endif value="3">Vaxtı bitib</option>
                                                    <option @if(request()->input('action') == '4') selected
                                                            @endif value="4">Dispetçer tərəfindən və ya taksi özünin
                                                        sifarişi ləğv etməsi
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input name="penalty" type="number" class="form-control" value="{{request()->input('penalty')}}" placeholder="Cərimə">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="status" class="select" aria-hidden="true">
                                                    <option  value="">-- Status --</option>
                                                    <option @if(request()->input('status') == '1') selected
                                                            @endif value="1">Aktiv
                                                    </option>
                                                    <option @if( request()->input('status') == '0') selected
                                                            @endif value="0">Deaktiv
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-default btn-block"><i class="icon-search4"></i></button>
                                        </div>
                                    </div>








                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" style="border-top:1px solid #ddd">
                                    <thead>
                                        <tr>


                                            <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-punishment-strategy.setting-punishment-strategy') }}?_token={{ csrf_token() }}&from_time={{ request()->get('from_time') }}&to_time={{ request()->get('to_time') }}&&action={{ request()->get('action') }}&&penalty={{ request()->get('penalty')}}&status={{ request()->get('status') }}&&column_name=from_time&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'from_time') sort-amount-up icon-sort-amount-desc @endif"></i> Başlama Vaxtı</a></th>

                                            <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-punishment-strategy.setting-punishment-strategy') }}?_token={{ csrf_token() }}&from_time={{ request()->get('from_time') }}&to_time={{ request()->get('to_time') }}&&action={{ request()->get('action') }}&&penalty={{ request()->get('penalty')}}&status={{ request()->get('status') }}&&column_name=to_time&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'to_time') sort-amount-up icon-sort-amount-desc @endif"></i> Bitmə Vaxtı</a></th>

                                            <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-punishment-strategy.setting-punishment-strategy') }}?_token={{ csrf_token() }}&from_time={{ request()->get('from_time') }}&to_time={{ request()->get('to_time') }}&&action={{ request()->get('action') }}&&penalty={{ request()->get('penalty')}}&status={{ request()->get('status') }}&&column_name=action&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'action') sort-amount-up icon-sort-amount-desc @endif"></i> Əməliyyat</a></th>
                                            <th><strong> Cərimə</strong></th>

                                            <th><strong> Ödəmə</strong></th>

                                            <th><a href="{{ Url('module/search/'.$module->code.'/setting/setting-punishment-strategy.setting-punishment-strategy') }}?_token={{ csrf_token() }}&from_time={{ request()->get('from_time') }}&to_time={{ request()->get('to_time') }}&&action={{ request()->get('action') }}&&punishment={{ request()->get('punishment')}}&status={{ request()->get('status') }}&&column_name=status&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}"><i class="@if( request()->get('column_name') == 'status') sort-amount-up icon-sort-amount-desc @endif"></i> Status</a></th>

                                            <th><strong>Əməliyyat</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($results as $result)
                                        <tr>

                                             <td>{{$result->from_time}}</td>
                                             <td>{{$result->to_time}}</td>

                                             <td>
                                                @if($result->action == 4) Dispetçer tərəfindən və ya taksi özünin sifarişi ləğv etməsi @endif


                                             </td>
                                             <td>{{$result->penalty}}</td>
                                             <td>
                                                @if($result->payment_method == 1) Nəğd @endif
                                                @if($result->payment_method == 2) Nəğdsiz @endif


                                            </td>
                                             <td>
                                                 <div id="isActive_{{ $result->id }}" class="btn-group"
                                                             style="{{ $result->status ? '' : 'display:none' }}">

                                                            <a href="#"
                                                               class="statusCurrent label bg-success dropdown-toggle"
                                                               data-toggle="dropdown" aria-expanded="false">Aktiv <span
                                                                        class="caret"></span></a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a type="button" class="statusToChange"
                                                                       data-id="{{ $result->id }}"
                                                                       data-status="1" data-column="status"
                                                                       data-code="{{ $module->code }}"><span
                                                                                class=" status-mark bg-danger
                                                                       position-left"></span>Deaktiv</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div id="isDeactive_{{ $result->id }}" class="btn-group"
                                                             style="{{ $result->status ? 'display:none' : '' }}">

                                                            <a href="#"
                                                               class="statusCurrent label bg-danger dropdown-toggle"
                                                               data-toggle="dropdown" aria-expanded="false">Deaktiv
                                                                <span class="caret"></span></a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a type="button" class="statusToChange"
                                                                       data-id="{{ $result->id }}"
                                                                       data-status="0" data-column="status"
                                                                       data-code="{{ $module->code }}"><span
                                                                                class="status-mark bg-success position-left"></span>Aktiv</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                             </td>

                                             <td>
                                                <div class="btn-group">

                                                     <a class="btn btn-default"
                                                           href="{{ route('getSettingPunishmentStrategyEdit',['id' => $result->id,'code' => $module->code]) }}"><i
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
                            </form>                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
