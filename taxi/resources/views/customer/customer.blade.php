@extends('main.layout')


@section('addLink')
    <a href="{{  route('getCustomerEdit',['id' => 0]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded"><b><i class="icon-plus3"></i></b> Əlavə et</a>
@endsection

@section('content')




    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Müştərilər</h5>
                            </div>
                            <form
                                action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'customer','view'=>'customer' ]) }}"
                                name="listForm" accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="firstname"
                                                       value="{{ request()->input('firstname') }}" class="form-control"
                                                       placeholder="Məmməd">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="lastname"
                                                       value="{{ request()->input('lastname') }}" class="form-control"
                                                       placeholder="Məmmədov">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" name="phone" value="{{ request()->input('phone') }}"
                                                       class="form-control"
                                                       placeholder="994555555555">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="group_id" class="select-search form-control">
                                                    <option selected value="">-- Qrup seç --</option>
                                                    @foreach($customerGroups as $c)
                                                        <option @if(request()->input('group_id') == $c->id) selected
                                                                @endif value="{{ $c->id }}">{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="status" class="select-fixed-single">
                                                    <option selected value="">-- Satus seç --</option>
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
                                            <div class="form-group">
                                                <select name="banned" class="select-fixed-single">
                                                    <option selected value="">-- Bloklanmanı seç --</option>
                                                    <option @if(request()->input('banned') == '1') selected
                                                            @endif value="1">Bloklanıb
                                                    </option>
                                                    <option @if( request()->input('banned') == '0') selected
                                                            @endif value="0">Bloklanmayıb
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-default btn-block"><i
                                                    class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <hr>
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=firstname&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'firstname') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Ad
                                                    </a>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=lastname&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'lastname') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Soyad
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=birthday&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'birthday') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Doğum tarixi
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=group&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'group') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Qrup
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=gender&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'gender') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Cinsi
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=email&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'email') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Poçt adresi
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=phone&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'phone') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Telefon
                                                    </a>
                                                </th>
                                                <th>
                                                    {{--<a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=balance&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">--}}
                                                    {{--<i class="@if( request()->get('column_name') == 'balance') sort-amount-up icon-sort-amount-desc @endif"></i>--}}
                                                    Balans
                                                    {{--</a>--}}
                                                </th>

                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=discount&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'discount') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Endirim
                                                    </a>
                                                </th>

                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=status&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'status') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Status
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'customer/customer') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&firstname={{ request()->get('name') }}&lastname={{ request()->get('lastname') }}&from_date={{ request()->get('from_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date={{ request()->get('to_date') }}&to_date_submit={{ request()->get('to_date_submit') }}&phone={{ request()->get('phone') }}&group_id={{ request()->get('group_id') }}&status={{ request()->get('status') }}&banned={{ request()->get('banned') }}&column_name=banned&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'banned') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Bloklanması
                                                    </a>
                                                </th>

                                                <th><strong>Əməliyyat</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{ $result->firstname??'' }}</td>
                                                    <td>{{ $result->lastname??'' }}</td>
                                                    <td>{{ $result->birthday??'' }}</td>
                                                    <td>{{ $result->groupName->name??'' }}</td>
                                                    <td>{{ $result->gender ? 'Kişi' : 'Qadın' }}</td>
                                                    <td>{{ $result->email??'' }}</td>
                                                    <td>{{ $result->phone??'' }}</td>
                                                    <td>{{ $result->account ? number_format($result->account->balance, 2) : '' }}
                                                        ₼
                                                    </td>
                                                    <td>{{ $result->discount??'' }}</td>
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
                                                                       data-status="1"
                                                                       data-code="{{ $module->code }}"
                                                                       data-column="status"><span
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
                                                                       data-status="0"
                                                                       data-code="{{ $module->code }}"
                                                                       data-column="status"><span
                                                                            class="status-mark bg-success position-left"></span>Aktiv</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div id="isBanned_{{ $result->id }}" class="btn-group"
                                                             style="{{ $result->banned ? '' : 'display:none' }}">

                                                            <a href="#"
                                                               class="statusCurrent label bg-danger dropdown-toggle"
                                                               data-toggle="dropdown" aria-expanded="false">Bloklanıb
                                                                <span class="caret"></span></a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a type="button" class="statusToChange"
                                                                       data-id="{{ $result->id }}" data-status="1"
                                                                       data-code="{{ $module->code }}"
                                                                       data-column="banned"><span
                                                                            class="status-mark bg-success position-left"></span>Bloklanmayıb</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div id="isNotBanned_{{ $result->id }}" class="btn-group"
                                                             style="{{ $result->banned ? 'display:none' : '' }}">

                                                            <a href="#"
                                                               class="statusCurrent label bg-success dropdown-toggle"
                                                               data-toggle="dropdown" aria-expanded="false">Bloklanmayıb
                                                                <span class="caret"></span></a>

                                                            <ul class="dropdown-menu dropdown-menu-right">
                                                                <li>
                                                                    <a type="button" class="statusToChange"
                                                                       data-id="{{ $result->id }}" data-status="0"
                                                                       data-code="{{ $module->code }}"
                                                                       data-column="banned"><span
                                                                            class="status-mark bg-danger position-left"></span>Bloklanıb</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <ul class="icons-list">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle"
                                                                   data-toggle="dropdown">
                                                                    <i class="icon-cog7"></i>
                                                                    <span class="caret"></span>
                                                                </a>
                                                                <ul class="dropdown-menu dropdown-menu-solid">
                                                                    <li>
                                                                        <a href="{{ route('getMessageNew',['id' => $result->id,'type' => 2]) }}"><i
                                                                                class="icon-bubble-dots3"></i>Mesaj
                                                                            Göndər</a></li>
                                                                    <li>
                                                                        <a href="{{ route('getSmsNew',['id' => $result->id,'type' => 2]) }}"><i
                                                                                class="icon-envelope"></i>Sms Göndər</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('getCustomerView',['id' => $result->id]) }}"><i
                                                                                class="icon-eye"></i> Profilə
                                                                            bax</a></li>
                                                                    <li>
                                                                        <a href="{{ route('getCustomerEdit',['id' => $result->id]) }}"><i
                                                                                class="icon-pencil7"></i> Redaktə et</a>
                                                                    </li>

                                                                </ul>
                                                            </li>
                                                        </ul>
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



@endsection
