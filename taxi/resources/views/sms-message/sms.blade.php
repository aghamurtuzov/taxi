@extends('main.layout')

@section('addLink')
    <a href="{{ route('getSmsNew',['id' => 0,'type' => 0]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded"><b><i class="icon-plus3"></i></b> Sms Göndər</a>
@endsection

@section('content')



    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Sms</h5>
                            </div>

                            <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'sms-message','view'=>'sms' ]) }}"
                                  name="listForm" accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="order_id"
                                                       value="{{ request()->input('order_id') }}" class="form-control"
                                                       placeholder="Sifarişə görə axtar">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="destination_type"
                                                        class="select-fixed-single destination_type" tabindex="-1"
                                                        aria-hidden="true">
                                                    <option value="">Qəbul edənin növü</option>
                                                    <option @if( request()->input('destination_type') == 2) selected
                                                            @endif value="2">Müştəri
                                                    </option>
                                                    <option @if( request()->input('destination_type') == 1) selected
                                                            @endif value="1">Taksi
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="destination_id"
                                                       value="{{ request()->input('destination_id') }}"
                                                       class="form-control destination"
                                                       placeholder="Qəbul edənə görə axtar">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="user_id" class="select-search" tabindex="-1"
                                                        aria-hidden="true">
                                                    <option value="">-- İstifadəçiyə görə axtar --</option>
                                                    @foreach($users as $user)
                                                        <option @if( request()->input('user_id') == $user->id) selected
                                                                @endif value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="icon-calendar22"></i></span>
                                                    <input name="from_date" type="date"
                                                           class="form-control"
                                                           placeholder="Başlama tarixi"
                                                           value="{{ request()->input('from_date') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="icon-calendar22"></i></span>
                                                    <input name="to_date" type="date"
                                                           class="form-control "
                                                           placeholder="Bitmə tarixi"
                                                           value="{{ request()->input('to_date') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'sms') }}?_token={{ csrf_token() }}
                                                            &order_id={{ request()->get('order_id') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &destination_type={{ request()->get('destination_type') }}
                                                            &destination_id={{ request()->get('destination_id') }}
                                                            &user_id={{ request()->get('user_id') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &column_name=order_id
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'order_id') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Sifariş Nömrəsi</a></th>

                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'sms') }}?_token={{ csrf_token() }}
                                                            &order_id={{ request()->get('order_id') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &destination_type={{ request()->get('destination_type') }}
                                                            &destination_id={{ request()->get('destination_id') }}
                                                            &user_id={{ request()->get('user_id') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &column_name=destination_type
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'destination_type') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Qəbul Edənin Növü</a></th>

                                                <th><strong>Qəbul edən</strong></th>

                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'sms') }}?_token={{ csrf_token() }}
                                                            &order_id={{ request()->get('order_id') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &destination_type={{ request()->get('destination_type') }}
                                                            &destination_id={{ request()->get('destination_id') }}
                                                            &user_id={{ request()->get('user_id') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &column_name=user_id
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'user_id') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        İstifadəçi</a></th>

                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'sms') }}?_token={{ csrf_token() }}
                                                            &order_id={{ request()->get('order_id') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &destination_type={{ request()->get('destination_type') }}
                                                            &destination_id={{ request()->get('destination_id') }}
                                                            &user_id={{ request()->get('user_id') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &column_name=type
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'type') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Növ</a></th>

                                                <th><strong>Push</strong></th>

                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'sms') }}?_token={{ csrf_token() }}
                                                            &order_id={{ request()->get('order_id') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &destination_type={{ request()->get('destination_type') }}
                                                            &destination_id={{ request()->get('destination_id') }}
                                                            &user_id={{ request()->get('user_id') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &column_name=date
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'date') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Tarix</a></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{ $result->order_id }}</td>
                                                    <td>{{ $result->destination_type == 1 ? 'Taksi' : 'Müştəri' }}</td>
                                                    <td>{{ $result->destination_type == 1 ? $result->taxiName->phone??'' : $result->customerName->phone??'' }}</td>
                                                    <td>{{ $result->fullName() }} </td>
                                                    <td>{{ $result->type == 1 ? 'Qəbul edidi pushu' : $result->type == 2 ? 'Çatdım pushu' :  'Xüsusi push' }}</td>
                                                    <td>{{ $result->message }}</td>
                                                    <td>{{ $result->date }}</td>
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
