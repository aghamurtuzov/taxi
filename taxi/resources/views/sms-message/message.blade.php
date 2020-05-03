@extends('main.layout')

@section('addLink')
    <a href="{{ route('getMessageNew',['id' => 0,'type' => 0]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded"><b><i class="icon-plus3"></i></b> Push Göndər</a>
@endsection

@section('content')



    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h5 class="panel-title">Pushlar</h5>
                    </div>
                    <div class="panel-body">
                        <form
                            action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'sms-message','view'=>'message' ]) }}"
                            name="listForm" accept-charset="utf-8">
                        @csrf
                        <!-- Searh Form -->
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Göndərən</label>
                                        <select name="user_id" class="select-search">
                                            <option value="">-- Göndərənə görə axtar --</option>
                                            @foreach($users as $user)
                                                <option @if( request()->input('user_id') == $user->id) selected
                                                        @endif value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Qəbul edənin növü</label>
                                        <select name="destination_type" class="select-fixed-single">
                                            <option selected value="">-- Seçim edin --</option>
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
                                        <label>Qəbul edən</label>
                                        <input type="text" name="destination_id"
                                               value="{{ request()->input('destination_id') }}"
                                               class="form-control destination">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="read" class="select-fixed-single">
                                            <option value="">-- Seçim edin --</option>
                                            <option @if( request()->input('read') == 1) selected @endif value="1">
                                                Oxundu
                                            </option>
                                            <option value="0">
                                                Oxunmayıb
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Başlama Tarixi</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" name="date_from" placeholder="Başlama tarixi"
                                                   class="form-control daterange-single"
                                                   value="{{ request()->input('date_from') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Bitmə Tarixi</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" name="date_to" placeholder="Bitmə tarixi"
                                                   class="form-control daterange-single"
                                                   value="{{ request()->input('date_to') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default btn-block"
                                                style="margin-top: 26px;"><i class="icon-search4"></i></button>
                                    </div>
                                </div>
                            </div>

                            <!-- Searh Form -->


                            <hr/>

                            <div>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th>
                                            <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'message') }}?_token={{ csrf_token() }}
                                                &destination_type={{ request()->get('destination_type') }}
                                                &destination_id={{ request()->get('destination_id') }}
                                                &user_id={{ request()->get('user_id') }}
                                                &read={{ request()->get('read') }}
                                                &date_from={{ request()->get('date_from') }}
                                                &date_to={{ request()->get('date_to') }}
                                                &column_name=destination_type
                                                &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                &perPage={{ request()->get('perPage') }}">

                                                <i class="@if( request()->get('column_name') == 'destination_type') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                Qəbul edənin növü</a></th>
                                        <th>
                                            <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'message') }}?_token={{ csrf_token() }}
                                                &destination_type={{ request()->get('destination_type') }}
                                                &destination_id={{ request()->get('destination_id') }}
                                                &user_id={{ request()->get('user_id') }}
                                                &read={{ request()->get('read') }}
                                                &date_from={{ request()->get('date_from') }}
                                                &date_to={{ request()->get('date_to') }}
                                                &column_name=destination_id
                                                &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                &perPage={{ request()->get('perPage') }}">

                                                <i class="@if( request()->get('column_name') == 'destination_id') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                Qəbul edən</a></th>
                                        <th>
                                            <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'message') }}?_token={{ csrf_token() }}
                                                &destination_type={{ request()->get('destination_type') }}
                                                &destination_id={{ request()->get('destination_id') }}
                                                &user_id={{ request()->get('user_id') }}
                                                &read={{ request()->get('read') }}
                                                &date_from={{ request()->get('date_from') }}
                                                &date_to={{ request()->get('date_to') }}
                                                &column_name=user_id
                                                &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                &perPage={{ request()->get('perPage') }}">

                                                <i class="@if( request()->get('column_name') == 'user_id') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                Göndərən</a></th>
                                        <th>
                                            <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'message') }}?_token={{ csrf_token() }}
                                                &destination_type={{ request()->get('destination_type') }}
                                                &destination_id={{ request()->get('destination_id') }}
                                                &user_id={{ request()->get('user_id') }}
                                                &read={{ request()->get('read') }}
                                                &date_from={{ request()->get('date_from') }}
                                                &date_to={{ request()->get('date_to') }}
                                                &column_name=title
                                                &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                &perPage={{ request()->get('perPage') }}">

                                                <i class="@if( request()->get('column_name') == 'title') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                Başlıq</a></th>
                                        <th>
                                            <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'message') }}?_token={{ csrf_token() }}
                                                &destination_type={{ request()->get('destination_type') }}
                                                &destination_id={{ request()->get('destination_id') }}
                                                &user_id={{ request()->get('user_id') }}
                                                &read={{ request()->get('read') }}
                                                &date_from={{ request()->get('date_from') }}
                                                &date_to={{ request()->get('date_to') }}
                                                &column_name=message
                                                &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                &perPage={{ request()->get('perPage') }}">

                                                <i class="@if( request()->get('column_name') == 'message') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                Push</a></th>
                                        <th>
                                            <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'message') }}?_token={{ csrf_token() }}
                                                &destination_type={{ request()->get('destination_type') }}
                                                &destination_id={{ request()->get('destination_id') }}
                                                &user_id={{ request()->get('user_id') }}
                                                &read={{ request()->get('read') }}
                                                &date_from={{ request()->get('date_from') }}
                                                &date_to={{ request()->get('date_to') }}
                                                &column_name=read
                                                &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                &perPage={{ request()->get('perPage') }}">

                                                <i class="@if( request()->get('column_name') == 'read') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                Oxundu</a></th>
                                        <th>
                                            <a href="{{ Url('module/search/'.$module->code.'/'.'sms-message'.'/'.'message') }}?_token={{ csrf_token() }}
                                                &destination_type={{ request()->get('destination_type') }}
                                                &destination_id={{ request()->get('destination_id') }}
                                                &user_id={{ request()->get('user_id') }}
                                                &read={{ request()->get('read') }}
                                                &date_from={{ request()->get('date_from') }}
                                                &date_to={{ request()->get('date_to') }}
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
                                            <td>{{ $result->destination_type == 1 ? 'Taksi' : 'Müştəri' }}</td>
                                            <td>{{ $result->destination_type == 1 ? $result->taxiName->phone??'-' : $result->customerName->phone??'-' }}</td>
                                            <td>{{ $result->fullName() }} </td>
                                            <td>{{ $result->title }} </td>
                                            <td>{{ $result->message }} </td>
                                            <td><span class="label bg-success-400">@if($result->read) Oxundu @else
                                                        Oxunmayıb @endif</span></td>
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
                    </form>            </div>
            </div>
        </div>
    </div>



@endsection
