@extends('main.layout')
@section('content')



@section('addLink')
    <a href="{{ route('getOperatorEdit',['id' => 0,'code' => $module->code]) }}"
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
                            <h5 class="panel-title">İstifadəçilər</h5>
                        </div>
                        <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'operator','view'=>'operator' ]) }}"
                              name="listForm" method="get" accept-charset="utf-8">
                            @csrf
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="name" value="{{request()->input('name')}}"
                                                   class="form-control" placeholder="Ada görə axtar">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="username" value="{{request()->input('username')}}"
                                                   class="form-control" placeholder="İstifadəçi adına görə axtar">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="phone" value="{{request()->input('phone')}}"
                                                   class="form-control" placeholder="Telefona görə axtar">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select name="status" class="select-fixed-single">
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
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-default btn-block"><i
                                                    class="icon-search4"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>
                                                <strong>ID</strong>
                                            </th>

                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&username={{ request()->get('username')}}&phone={{ request()->get('phone')}}&status={{ request()->get('status') }}&column_name=first_name&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'first_name') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                    Tam Adı </a></th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&username={{ request()->get('username')}}&phone={{ request()->get('phone')}}&status={{ request()->get('status') }}&column_name=username&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'username') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                    İstifadəçi adı </a></th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&username={{ request()->get('username')}}&phone={{ request()->get('phone')}}&status={{ request()->get('status') }}&column_name=email&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'email') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                    Email </a></th>
                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&username={{ request()->get('username')}}&phone={{ request()->get('phone')}}&status={{ request()->get('status') }}&column_name=phone&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'phone') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                    Telefon </a></th>
                                            <th><strong>Qrup</strong></th>

                                            <th>
                                                <a href="{{ Url('module/search/'.$module->code.'/operator/operator') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&username={{ request()->get('username')}}&phone={{ request()->get('phone')}}&status={{ request()->get('status') }}&column_name=active&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                    <i class="@if( request()->get('column_name') == 'active') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                    Status </a></th>

                                            <th><strong>Sip nömrə</strong></th>

                                            <th><strong>Əməliyyat</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $result)
                                            <tr>
                                                <td>{{$result->id}}</td>
                                                <td>{{$result->first_name.' '.$result->last_name}}</td>
                                                <td>{{$result->username}}</td>
                                                <td>{{$result->email}}</td>
                                                <td>{{$result->phone}}</td>
                                                <td>{{ $result->subgroup .'('. $result->group . ')' }}</td>
                                                <td>
                                                    <div id="isActive_{{ $result->id }}" class="btn-group"
                                                         style="{{ $result->active ? '' : 'display:none' }}">

                                                        <a href="#"
                                                           class="statusCurrent label bg-success dropdown-toggle"
                                                           data-toggle="dropdown" aria-expanded="false">Aktiv <span
                                                                    class="caret"></span></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a type="button" class="statusToChange"
                                                                   data-id="{{ $result->id }}"
                                                                   data-status="1" data-column="active"
                                                                   data-code="{{ $module->code }}"><span
                                                                            class=" status-mark bg-danger
                                                                       position-left"></span>Deaktiv</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div id="isDeactive_{{ $result->id }}" class="btn-group"
                                                         style="{{ $result->active ? 'display:none' : '' }}">

                                                        <a href="#"
                                                           class="statusCurrent label bg-danger dropdown-toggle"
                                                           data-toggle="dropdown" aria-expanded="false">Deaktiv
                                                            <span class="caret"></span></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a type="button" class="statusToChange"
                                                                   data-id="{{ $result->id }}"
                                                                   data-status="0" data-column="active"
                                                                   data-code="{{ $module->code }}"><span
                                                                            class="status-mark bg-success position-left"></span>Aktiv</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>{{$result->sip}}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default"
                                                           href="{{ route('getOperatorEdit',['id' => $result->id,'code' => $module->code]) }}"><i
                                                                    class="icon-pencil7"></i></a>

                                                        <a class="btn btn-default"
                                                           href="{{ route('getOperatorView',['id' => $result->id]) }}"><i
                                                                    class="icon-eye"></i></a>

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
                                    <div class="text-right">
                                        <ul class="pagination pagination-separated pull-right">
                                            {{ $results->links('vendor.pagination.bootstrap-4') }}
                                        </ul>
                                    </div>
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
