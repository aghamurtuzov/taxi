@extends('main.layout')
@section('content')



@section('addLink')
    <a href="{{ route('getOperatorSubgroupEdit',['id' => 0,'code' => $module->code]) }}"
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
                            <h5 class="panel-title">Alt Qrup</h5>
                        </div>
                        <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'operator','view'=>'operator-subgroup' ]) }}"
                              name="listForm" method="get" accept-charset="utf-8">
                            @csrf
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="name" value="{{request()->input('name')}}"
                                                   class="form-control" placeholder="Ad">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="group" class="select-fixed-single">
                                                <option value="">-- Üst kateqoriyasını seç --</option>
                                                @foreach($groups as $group)
                                                    <option @if(request()->input('group') == $group->id) selected
                                                            @endif value="{{$group->id}}"> {{$group->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="status" class="select" aria-hidden="true">
                                                <option value="">-- Status seç --</option>
                                                <option @if(request()->input('status') == '1') selected
                                                        @endif value="1">Aktiv
                                                </option>
                                                <option @if( request()->input('status') == '0') selected
                                                        @endif value="0">Deaktiv
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-default btn-block"><i
                                                    class="icon-search4"></i></button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover"
                                           style="border-top:1px solid #ddd">
                                        <thead>
                                        <tr>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator-subgroup') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&group={{ request()->get('group')}}&status={{ request()->get('status') }}&column_name=name&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'name') sort-amount-up icon-sort-amount-desc @endif"></i>Ad</a>
                                            </th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator-subgroup') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&group={{ request()->get('group')}}&status={{ request()->get('status') }}&column_name=group&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'group') sort-amount-up icon-sort-amount-desc @endif"></i>Qrup</a>
                                            </th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator-subgroup') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&group={{ request()->get('group')}}&status={{ request()->get('status') }}&column_name=status&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'status') sort-amount-up icon-sort-amount-desc @endif"></i>Status</a>
                                            </th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator-subgroup') }}?_token={{ csrf_token() }}&name={{ request()->get('name') }}&group={{ request()->get('group')}}&status={{ request()->get('status') }}&column_name=permission&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'permission') sort-amount-up icon-sort-amount-desc @endif"></i>İcazə</a>
                                            </th>

                                            <th><strong>Əməliyyat</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $result)
                                            <tr>
                                                <td>{{$result->name}}</td>
                                                <td>{{$result->groupName->name}}</td>
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
                                                <td></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default"
                                                           href="{{ route('getOperatorSubgroupEdit',['id' => $result->id,'code' => $module->code]) }}"><i
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