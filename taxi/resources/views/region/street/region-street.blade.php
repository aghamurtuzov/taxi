@extends('main.layout')
@section('content')

@section('addLink')
    <a href="{{ route('getRegionStreetEdit',['id' => 0,'code' => $module->code]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded" style="margin-top: -20px;"><b><i class="icon-plus3"></i></b> Küçə əlavə et</a><br>
@endsection




    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Küçələr</h5>
                            </div>
                            <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'region','view'=>'street.region-street' ]) }}" name="listForm" method="get" accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Küçəyə görə axtar</label>
                                                <input type="text" name="name" value="{{request()->input('name')}}" class="form-control" placeholder="Küçəyə görə axtar">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bölgəyə görə axtar</label>
                                                <input type="text" name="region" value="{{request()->input('region')}}" class="form-control" placeholder="Bölgəyə görə axtar">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Şəhərə görə axtar</label>
                                                <input type="text" name="city" value="{{request()->input('city')}}" class="form-control" placeholder="Şəhərə görə axtar">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Açar sözə görə axtar</label>
                                                <input type="text" name="keyword" value="{{request()->input('keyword')}}" class="form-control" placeholder="Açar sözə görə axtar">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Prioritetə görə axtar</label>
                                                <input type="number" min="0" name="priority" value="{{request()->input('priority')}}" class="form-control" placeholder="Prioritetə görə axtar">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sıralamaya görə axtar</label>
                                                <input type="number" min="0" name="sort" value="{{request()->input('sort')}}" class="form-control" placeholder="Sıralamaya görə axtar">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Statusa görə axtar</label>
                                                <select name="status" class="select"  aria-hidden="true">
                                                    <option  value="">-- Status seç --</option>
                                                    <option @if(request()->input('status') == '1') selected
                                                            @endif value="1">Aktiv
                                                    </option>
                                                    <option @if( request()->input('status') == '0') selected
                                                            @endif value="0">Deaktiv
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Axtar</label>
                                            <button type="submit" class="btn btn-default btn-block"><i class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th><strong>№</strong></th>
                                                <th><a href="{{ Url('module/search/'.$module->code.'/region/street.region-street') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&city={{ request()->get('city')}}&keyword={{ request()->get('keyword')}}&priority={{ request()->get('priority')}}&sort={{ request()->get('sort')}}&status={{ request()->get('status') }}&column_name=name&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                <i class="@if( request()->get('column_name') == 'name') sort-amount-up icon-sort-amount-desc @endif"></i> Küçə Adı</a></th>
                                                <th><a href="{{ Url('module/search/'.$module->code.'/region/street.region-street') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&city={{ request()->get('city')}}&keyword={{ request()->get('keyword')}}&priority={{ request()->get('priority')}}&sort={{ request()->get('sort')}}&status={{ request()->get('status') }}&column_name=region&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                <i class="@if( request()->get('column_name') == 'region') sort-amount-up icon-sort-amount-desc @endif"></i>Bölgə</a></th>
                                                <th><a href="{{ Url('module/search/'.$module->code.'/region/street.region-street') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&city={{ request()->get('city')}}&keyword={{ request()->get('keyword')}}&priority={{ request()->get('priority')}}&sort={{ request()->get('sort')}}&status={{ request()->get('status') }}&column_name=city&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                <i class="@if( request()->get('column_name') == 'city') sort-amount-up icon-sort-amount-desc @endif"></i> Şəhər</a></th>
                                                <th><a href="{{ Url('module/search/'.$module->code.'/region/street.region-street') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&city={{ request()->get('city')}}&keyword={{ request()->get('keyword')}}&priority={{ request()->get('priority')}}&sort={{ request()->get('sort')}}&status={{ request()->get('status') }}&column_name=keyword&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                <i class="@if( request()->get('column_name') == 'keyword') sort-amount-up icon-sort-amount-desc @endif"></i>Açar söz</a></th>
                                                <th><a href="{{ Url('module/search/'.$module->code.'/region/street.region-street') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&city={{ request()->get('city')}}&keyword={{ request()->get('keyword')}}&priority={{ request()->get('priority')}}&sort={{ request()->get('sort')}}&status={{ request()->get('status') }}&column_name=priority&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                <i class="@if( request()->get('column_name') == 'priority') sort-amount-up icon-sort-amount-desc @endif"></i> Prioritet</a></th>
                                                <th><a href="{{ Url('module/search/'.$module->code.'/region/street.region-street') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&city={{ request()->get('city')}}&keyword={{ request()->get('keyword')}}&priority={{ request()->get('priority')}}&sort={{ request()->get('sort')}}&status={{ request()->get('status') }}&column_name=sort&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                <i class="@if( request()->get('column_name') == 'sort') sort-amount-up icon-sort-amount-desc @endif"></i> Sıralama</a></th>
                                                <th><a href="{{ Url('module/search/'.$module->code.'/region/street.region-street') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&city={{ request()->get('city')}}&keyword={{ request()->get('keyword')}}&priority={{ request()->get('priority')}}&sort={{ request()->get('sort')}}&status={{ request()->get('status') }}&column_name=status&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                <i class="@if( request()->get('column_name') == 'status') sort-amount-up icon-sort-amount-desc @endif"></i> Status</a></th>
                                                <th><strong>Əməliyyat</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                 @php $a= 0 @endphp
                                            @foreach($results as $result)
                                            <tr>
                                                <td>{{++$a}}</td>
                                                <td>{{$result->name}}</td>
                                                <td>{{$result->regionName->name??''}}</td>
                                                <td>{{$result->cityName->name??''}}</td>
                                                <td>{{$result->keyword}}</td>
                                                <td>{{$result->priority}}</td>
                                                <td>{{$result->sort}}</td>
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
                                                    <div class="btn-group">
                                                         <a class="btn btn-default"
                                                               href="{{ route('getRegionStreetEdit',['id' => $result->id,'code' => $module->code]) }}"><i
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection
