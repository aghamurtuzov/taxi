@extends('main.layout')







@section('addLink')

    <a href="{{ route('getTaxiBlockedEdit',['id' => 0]) }}"

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

                                <h5 class="panel-title">Bloklanmış taksi</h5>

                            </div>

                            <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'taxi','view'=>'taxi-blocked' ]) }}"

                                  name="listForm" method="get"

                                  accept-charset="utf-8">

                                @csrf

                                <div class="panel-body">

                                    <div class="row">

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <input type="text" name="code" value="{{ request()->input('code') }}" class="form-control"

                                                       autocomplete="off" placeholder="Tabel nömrəsi">

                                            </div>

                                        </div>



                                        <div class="col-md-2">

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i

                                                                class="icon-calendar22"></i></span>

                                                    <input name="start_time" placeholder="" type="date"

                                                           class="form-control " value="{{ request()->input('start_time') }}">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-2">

                                            <div class="form-group">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i

                                                                class="icon-calendar22"></i></span>

                                                    <input name="end_time" placeholder="" type="date"

                                                           class="form-control " value="{{ request()->input('end_time') }}">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">

                                                <select name="status" class="select" tabindex="-1" aria-hidden="true">

                                                    <option selected value="">Status seç</option>

                                                    <option @if(request()->input('status') == '1') selected

                                                            @endif value="1">Söndür

                                                    </option>

                                                    <option @if( request()->input('status') == '0') selected

                                                            @endif value="0">İşləmir

                                                    </option>

                                                </select>

                                            </div>

                                        </div>



                                        <div class="col-md-2">

                                            <div class="form-group">

                                                <button type="submit" class="btn btn-default btn-block"><i

                                                            class="icon-search4"></i></button>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-bordered table-striped table-hover"

                                               style="border-top:1px solid #ddd">

                                            <thead>

                                            </tr>

                                            <th>



                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'taxi'.'/'.'taxi-blocked') }}?_token={{ csrf_token() }}

                                                            &code={{ request()->get('code') }}

                                                            &start_time={{ request()->get('start_time') }}

                                                            &start_time_submit={{ request()->get('start_time_submit') }}

                                                            &end_time={{ request()->get('end_time') }}

                                                            &end_time_submit={{ request()->get('end_time_submit') }}

                                                            &status={{ request()->get('status') }}

                                                            &column_name=taxi_id

                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'taxi_id') sort-amount-up icon-sort-amount-desc @endif"></i>

                                                        Taksi</a>

                                            </th>







                                            <th>

                                                <a href="{{ Url('module/search/'.$module->code.'/'.'taxi'.'/'.'taxi-blocked') }}?_token={{ csrf_token() }}

                                                        &code={{ request()->get('code') }}

                                                        &start_time={{ request()->get('start_time') }}

                                                        &start_time_submit={{ request()->get('start_time_submit') }}

                                                        &end_time={{ request()->get('end_time') }}

                                                        &end_time_submit={{ request()->get('end_time_submit') }}

                                                        &status={{ request()->get('status') }}

                                                        &column_name=start_time

                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">

                                                    <i class="@if( request()->get('column_name') == 'start_time') sort-amount-up icon-sort-amount-desc @endif"></i>

                                                    Başlama vaxtı</a></th>



                                            <th>

                                                <a href="{{ Url('module/search/'.$module->code.'/'.'taxi'.'/'.'taxi-blocked') }}?_token={{ csrf_token() }}

                                                        &code={{ request()->get('code') }}

                                                        &start_time={{ request()->get('start_time') }}

                                                        &start_time_submit={{ request()->get('start_time_submit') }}

                                                        &end_time={{ request()->get('end_time') }}

                                                        &end_time_submit={{ request()->get('end_time_submit') }}

                                                        &status={{ request()->get('status') }}

                                                        &column_name=end_time

                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">

                                                    <i class="@if( request()->get('column_name') == 'end_time') sort-amount-up icon-sort-amount-desc @endif"></i>

                                                    Bitmə vaxtı</a></th>



                                            <th><strong>Açıqlama</strong></th>



                                            <th>

                                                <a href="{{ Url('module/search/'.$module->code.'/'.'taxi'.'/'.'taxi-blocked') }}?_token={{ csrf_token() }}

                                                        &code={{ request()->get('code') }}

                                                        &start_time={{ request()->get('start_time') }}

                                                        &start_time_submit={{ request()->get('start_time_submit') }}

                                                        &end_time={{ request()->get('end_time') }}

                                                        &end_time_submit={{ request()->get('end_time_submit') }}

                                                        &status={{ request()->get('status') }}

                                                        &column_name=status

                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">

                                                    <i class="@if( request()->get('column_name') == 'status') sort-amount-up icon-sort-amount-desc @endif"></i>

                                                    Status</a></th>

                                            </tr>

                                            </thead>

                                            <tbody>

                                            @foreach($results as $ban)

                                                <tr>

                                                    <td>{{ $ban->taxiTabelAndFullName() }}</td>

                                                    <td>{{ $ban->start_time }}</td>

                                                    <td class="end_time">{{ $ban->end_time }}</td>

                                                    <td>{{ $ban->description }}</td>

                                                    <td class="deactiveBtn">

                                                        @if($ban->status)

                                                            <button type="button" class="btn btn-danger bannedTaxi"

                                                                    data-id="{{ $ban->id }}"

                                                                    data-code="{{ $module->code }}"

                                                                    data-status="1"

                                                                    data-column="status">Söndür

                                                            </button>

                                                        @else

                                                            <span class="label label-default">İşləmir</span>

                                                        @endif

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





@section('script')



    <script>







    </script>



@endsection
