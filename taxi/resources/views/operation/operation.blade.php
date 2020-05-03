@extends('main.layout')

@section('addLink')
    <a href="{{ route('getOperationBalanceIncrease') }}" class="btn bg-success-400 btn-labeled btn-rounded"><b><i
                    class="icon-plus3"></i></b> Balans Artır</a>
    <a href="{{ route('getOperationBalancePunishment') }}" class="btn bg-success-400 btn-labeled btn-rounded"><b><i
                    class="icon-plus3"></i></b> Balans Cərimələ</a>
    <a href="{{ route('getOperationBalanceCashing') }}" class="btn bg-success-400 btn-labeled btn-rounded"><b><i
                    class="icon-plus3"></i></b> Nəğdiləşdirmə</a>
@endsection


@section('content')




    <style>
        .search_result, .search_result1 {
            width: 500px;
            display: block;
            position: absolute;
            z-index: 999;
            padding-left: 0;
            background: white;
            border: 1px solid #ddd;
            display: none;
        }

        .search_result li {
            list-style: none;
            padding: 10px;
            cursor: pointer;
        }

        .search_result li:hover {
            background-color: #f5f5f5;
        }

        .search_result1 li {
            list-style: none;
            padding: 10px;
            cursor: pointer;
        }

        .search_result1 li:hover {

        .selected {
            background: #56b0ff;
        }

        .destination {
            padding: 10px 0;
            border: 1px dashed #bdb9b9;
            background: #f5f5f5;
            cursor: move;
        }
    </style>
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Pul Köçürmələri</h5>
                            </div>
                            <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'operation','view'=>'operation' ]) }}"
                                  name="listForm" accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="sender_type" data-js-type="0"
                                                        class="select destinationType">
                                                    <option value="">-- Göndərənin növü --</option>
                                                    <option @if( request()->input('sender_type') == 1) selected
                                                            @endif value="1">Taksi
                                                    </option>
                                                    <option @if( request()->input('sender_type') == 2) selected
                                                            @endif value="2">Müştəri
                                                    </option>
                                                    <option @if( request()->input('sender_type') == 3) selected
                                                            @endif value="3">Müştəri Qrup
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input data-type="{{ request()->input('sender_type') }}" type="text"
                                                       name="destination_name"
                                                       value=""
                                                       class="form-control destinationIdInput"
                                                       autocomplete="off" placeholder="Göndərən">
                                                <input type="hidden" name="destination"
                                                       value=""
                                                       class="form-control destinationIdInputHidden"
                                                       autocomplete="off" id="destination">
                                                <ul class="search_result"></ul>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="receiver_type" data-js-type="1"
                                                        class="select destinationType">
                                                    <option value="" Selected>-- Qəbul edənin növü --</option>
                                                    <option @if( request()->input('receiver_type') == 1) selected
                                                            @endif value="1">Taksi
                                                    </option>
                                                    <option @if( request()->input('receiver_type') == 2) selected
                                                            @endif value="2">Müştəri
                                                    </option>
                                                    <option @if( request()->input('receiver_type') == 3) selected
                                                            @endif value="3">Müştəri Qrup
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input data-type="1" type="text"
                                                       name="destination_name_2"
                                                       value=""
                                                       class="form-control destinationIdInput"
                                                       autocomplete="off" placeholder="Qəbul edən">
                                                <input type="hidden" name="destination_2"
                                                       value=""
                                                       class="form-control destinationIdInputHidden"
                                                       autocomplete="off" id="destination">
                                                <ul class="search_result"></ul>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="user" class="select-search">
                                                    <option selected value="">-- İstifadəçi seç --</option>
                                                    @foreach($users as $user)
                                                        <option @if( request()->input('user') == $user->id) selected
                                                                @endif value="{{ $user->id }}
                                                                        ">{{ $user->fullname() }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="type" class="select">
                                                    <option value="">-- Əməliyyatın növünü seç --</option>
                                                    <option @if( request()->input('type') == 1) selected
                                                            @endif value="1">Sifariş
                                                    </option>
                                                    <option @if( request()->input('type') == 2) selected
                                                            @endif value="2">Geri qayıtma
                                                    </option>
                                                    <option @if( request()->input('type') == 3) selected
                                                            @endif value="3">Cərimə
                                                    </option>
                                                    <option @if( request()->input('type') == 4) selected
                                                            @endif value="4">Balans
                                                    </option>
                                                    <option @if( request()->input('type') == 5) selected
                                                            @endif value="5">Nəğdiləşdirmə
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" name="order_id"
                                                       value="{{ request()->input('order_id') }}" class="form-control"
                                                       placeholder="Sifariş ID">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" name="min_amount"
                                                       value="{{ request()->input('min_amount') }}" class="form-control"
                                                       placeholder="Minimum Məbləğ">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" name="max_amount"
                                                       value="{{ request()->input('max_amount') }}" class="form-control"
                                                       placeholder="Maksimum Məbləğ">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="icon-calendar22"></i></span>
                                                    <input name="from_date" placeholder="Başlanğıc tarixi" type="date"
                                                           class="form-control"
                                                           value="{{ request()->input('from_date') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="icon-calendar22"></i></span>
                                                    <input name="to_date" placeholder="Bitmə tarixi" type="date"
                                                           class="form-control "
                                                           value="{{ request()->input('to_date') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-default btn-block"><i
                                                        class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div>
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th><strong>ID</strong></th>
                                                <th><strong>Göndərən</strong></th>
                                                <th><strong>Hesab növü</strong></th>
                                                <th><strong>Qəbul edən</strong></th>
                                                <th><strong>Hesab növü</strong></th>
                                                <th><strong>İstifadəçi</strong></th>
                                                <th><strong>Sifariş</strong></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'operation'.'/'.'operation') }}?_token={{ csrf_token() }}&sender_type={{ request()->get('sender_type') }}&destination_name={{ request()->get('destination_name') }}&destination={{ request()->get('destination') }}&receiver_type={{ request()->get('receiver_type') }}&destination_name_2={{ request()->get('status') }}&destination_2={{ request()->get('status') }}&user={{ request()->get('user') }}&type={{ request()->get('type') }}&min_amount={{ request()->get('min_amount') }}&max_amount={{ request()->get('max_amount') }}&order_id={{ request()->get('order_id') }}&from_date={{ request()->get('from_date') }}&to_date={{ request()->get('to_date') }}&from_date_submit={{ request()->get('from_date_submit') }}&to_date_submit={{ request()->get('to_date_submit') }}&column_name=type&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'type') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Əməliyyatın növü</a></th>
                                                <th><strong>Məbləğ</strong></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'operation'.'/'.'operation') }}?_token={{ csrf_token() }}
                                                            &sender_type={{ request()->get('sender_type') }}
                                                            &destination_name={{ request()->get('destination_name') }}
                                                            &destination={{ request()->get('destination') }}
                                                            &receiver_type={{ request()->get('receiver_type') }}
                                                            &destination_name_2={{ request()->get('status') }}
                                                            &destination_2={{ request()->get('status') }}
                                                            &user={{ request()->get('user') }}
                                                            &type={{ request()->get('type') }}
                                                            &min_amount={{ request()->get('min_amount') }}
                                                            &max_amount={{ request()->get('max_amount') }}
                                                            &order_id={{ request()->get('order_id') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &from_date_submit={{ request()->get('from_date_submit') }}
                                                            &to_date_submit={{ request()->get('to_date_submit') }}
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
                                                    <td>{{ $result->id }}</td>
                                                    <td>{{ $result->from_account == 1 ? 'Şirkət' : $result->getAccountName('accountFromName') }}</td>
                                                    <td>{{ $result->accountTypeName($result->from_account_type) }}</td>
                                                    <td>{{ $result->to_account == 1 ? 'Şirkət' : $result->getAccountName('accountToName') }}</td>
                                                    <td>{{ $result->accountTypeName($result->to_account_type) }}</td>
                                                    <th>{{ $result->userName() ? $result->userName->first_name . ' ' . $result->userName->last_name : '' }}</th>
                                                    <td>{{ $result->order }}</td>
                                                    <td>{{ $result->typeName()}}</td>
                                                    <td>{{ number_format($result->amount, 2, '.', '') }}<span
                                                                class="azn"> AZN</span></td>
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

        // $('.destinationType2').on('change', function (e) {
        //     e.preventDefault();
        //
        //     $('.destinationIdField2').show();
        //     $('.destinationIdInput2').val('');
        //     $('.search_result2').empty();
        //     $('.search_result2').hide();
        //
        //     let type = $(this).val();
        //
        //     if (type == 4) {
        //         $('.destinationIdField2').hide();
        //         $('.destinationIdInputHidden2').val(0);
        //     }
        //
        //     $('.destinationIdInput2').attr('data-type', type);
        //
        //
        // });
    </script>

@endsection
