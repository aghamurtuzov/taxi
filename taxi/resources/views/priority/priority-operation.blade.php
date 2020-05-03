@extends('main.layout')


@section('addLink')
    <a href="{{ route('getPriorityOperationNew',['id' => 0]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded"><b><i class="icon-plus3"></i></b>Əlavə et</a>
@endsection


@section('content')





    <style>
        .search_result {
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
                                <h5 class="panel-title">Prioritet Əməliyyatı</h5>
                            </div>
                            <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'priority','view'=>'priority-operation' ]) }}"
                                  name="listForm" method="get"
                                  accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input data-type="1" type="text"
                                                       name="taxi" value="{{request()->input('taxi')}}"
                                                       class="form-control destinationIdInput"
                                                       autocomplete="off" placeholder="Taksi tabeli">
                                                <input type="hidden" name="taxi_id"
                                                       value="{{request()->input('taxi_id')}}"
                                                       class="form-control destinationIdInputHidden"
                                                       autocomplete="off" id="destination">
                                                <ul class="search_result"></ul>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" name="min_priority"
                                                       value="{{request()->input('min_priority')}}" class="form-control"
                                                       placeholder="Minimum prioritet">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" name="max_priority"
                                                       value="{{request()->input('max_priority')}}" class="form-control"
                                                       placeholder="Maksimum prioritet">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="icon-calendar22"></i></span>
                                                    <input name="from_date" placeholder="Başlama Tarixi" type="date"
                                                           class="form-control "
                                                           value="{{request()->input('from_date')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                                class="icon-calendar22"></i></span>
                                                    <input name="to_date" placeholder="Bitmə Tarixi" type="date"
                                                           class="form-control "
                                                           value="{{request()->input('to_date')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-default btn-block"><i
                                                        class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'priority'.'/'.'priority-operation') }}?_token={{ csrf_token() }}
                                                            &taxi_id={{ request()->get('taxi_id') }}
                                                            &taxi={{ request()->get('taxi') }}
                                                            &min_priority={{ request()->get('min_priority') }}
                                                            &max_priority={{ request()->get('max_priority') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &column_name=taxi_id
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'taxi_id') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Taksi</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'priority'.'/'.'priority-operation') }}?_token={{ csrf_token() }}
                                                            &taxi_id={{ request()->get('taxi_id') }}
                                                            &taxi={{ request()->get('taxi') }}
                                                            &min_priority={{ request()->get('min_priority') }}
                                                            &max_priority={{ request()->get('max_priority') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &column_name=priority
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'priority') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Prioritet</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'priority'.'/'.'priority-operation') }}?_token={{ csrf_token() }}
                                                            &taxi_id={{ request()->get('taxi_id') }}
                                                            &taxi={{ request()->get('taxi') }}
                                                            &min_priority={{ request()->get('min_priority') }}
                                                            &max_priority={{ request()->get('max_priority') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &column_name=description
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">

                                                        <i class="@if( request()->get('column_name') == 'description') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Açıqlama</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'priority'.'/'.'priority-operation') }}?_token={{ csrf_token() }}
                                                            &taxi_id={{ request()->get('taxi_id') }}
                                                            &taxi={{ request()->get('taxi') }}
                                                            &min_priority={{ request()->get('min_priority') }}
                                                            &max_priority={{ request()->get('max_priority') }}
                                                            &from_date={{ request()->get('from_date') }}
                                                            &to_date={{ request()->get('to_date') }}
                                                            &from_date={{ request()->get('from_date') }}
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
                                                    <td>{{ $result->taxiName->code . '-' . $result->taxiName->firstname . ' ' .  $result->taxiName->lastname }}</td>
                                                    <td>{{ $result->priority??'' }}</td>
                                                    <td>{{ $result->description??'' }}</td>
                                                    <td>{{ $result->date??'' }}</td>
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
                                        {{ $results->links('vendor.pagination.bootstrap-4') }}
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
