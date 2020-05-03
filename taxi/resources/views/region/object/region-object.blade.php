    @extends('main.layout')



@section('addLink')
    <a style="margin-top: -20px" href="{{ route('getRegionObjectEdit',['id' =>0,'code' => $module->code]) }}"
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
                                <h5 class="panel-title">Obyektlər</h5>
                            </div>
                            <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'region','view'=>'object.region-object' ]) }}"
                                  name="listForm" method="get"
                                  accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Rayona görə axtar</label>
                                                <select name="district" class="select" aria-hidden="true">
                                                    <option  value="">-- Seçim edin --</option>
                                                    @foreach($districts as $district)
                                                    <option @if(request()->input('district') == $district->id) selected
                                                            @endif value="{{$district->id}}">
                                                            {{$district->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Şəhərə görə axtar</label>
                                                <select name="city" class="select" aria-hidden="true">
                                                    <option  value="">-- Seçim edin --</option>
                                                    @foreach($cities as $city)
                                                    <option @if(request()->input('city') == $city->id) selected
                                                            @endif value="{{$city->id}}">
                                                            {{$city->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Regiona görə axtar</label>
                                                <select name="region" class="select" aria-hidden="true">
                                                    <option  value="">-- Seçim edin --</option>
                                                    @foreach($regions as $region)
                                                    <option @if(request()->input('region') == $region->id) selected
                                                            @endif value="{{$region->id}}">
                                                            {{$region->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Küçəyə görə axtar</label>
                                                <input type="text" name="street" value="{{request()->input('street')}}" class="form-control"
                                                       placeholder="Küçəyə görə axtar">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Ada görə axtar</label>
                                                <input type="text" name="name" value="{{request()->input('name')}}" class="form-control"
                                                       placeholder="Ada görə axtar">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kateqoriyaya görə axtar</label>
                                                <select name="type" class="select" aria-hidden="true">
                                                    <option  value="">-- Seçim edin --</option>
                                                    @foreach($types as $type)
                                                    <option @if(request()->input('type') == $type->id) selected
                                                            @endif value="{{$type->id}}">
                                                            {{$type->name}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Statusa görə axtar</label>
                                                <select name="status" class="select" aria-hidden="true">
                                                    <option  value="">-- Seçim edin --</option>
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
                                            <label>Axtar</label>
                                            <button type="submit" class="btn btn-default btn-block"><i
                                                        class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover"
                                               style="border-top:1px solid #ddd">
                                            <thead>

                                                <tr>
                                                    <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=name
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'name') sort-amount-up icon-sort-amount-desc @endif"></i> Ad</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=description
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'description') sort-amount-up icon-sort-amount-desc @endif"></i> Açıqlama</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=region
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'region') sort-amount-up icon-sort-amount-desc @endif"></i> Region</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=city
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'city') sort-amount-up icon-sort-amount-desc @endif"></i> Şəhər</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=district
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'district') sort-amount-up icon-sort-amount-desc @endif"></i> Rayon</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=street
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'street') sort-amount-up icon-sort-amount-desc @endif"></i> Küçə</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=type
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'type') sort-amount-up icon-sort-amount-desc @endif"></i> Kateqoriya</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=keyword
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'keyword') sort-amount-up icon-sort-amount-desc @endif"></i> Açar söz</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=number
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'number') sort-amount-up icon-sort-amount-desc @endif"></i> Nömrə</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=priority
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'priority') sort-amount-up icon-sort-amount-desc @endif"></i> Prioritet</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=sort
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'sort') sort-amount-up icon-sort-amount-desc @endif"></i> Sıralama</a></th>

                                                        <th><a href="{{ Url('module/search/'.$module->code.'/region/object.region-object') }}?
                                                    _token={{ csrf_token() }}
                                                            &name={{ request()->get('name') }}
                                                            &page={{request()->input('page')?request()->input('page'):1}}
                                                            &street={{ request()->get('street') }}
                                                            &city={{ request()->get('city')}}
                                                            &region={{ request()->get('region')}}
                                                            &type={{ request()->get('type')}}
                                                            &district={{ request()->get('district')}}
                                                            &status={{ request()->get('status') }}
                                                            &column_name=status
                                                            &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                            &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'status') sort-amount-up icon-sort-amount-desc @endif"></i> Status</a></th>
                                                        <th>Əməliyyat</th>
                                                </tr>

                                            </thead>
                                            <tbody>

                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{ $result->name }}</td>
                                                    <td>{{ $result->description }}</td>

                                                    <td>{{ $result->regionName->name??'' }}</td>
                                                    <td>{{ $result->cityName->name??'' }}</td>
                                                    <td>{{ $result->districtName->name??'' }}</td>
                                                    <td>{{ $result->streetName->name??'' }}</td>
                                                    <td>{{ $result->typeName->name??'' }}</td>

                                                    <td>{{ $result->keyword }}</td>
                                                    <td>{{ $result->number }}</td>
                                                    <td>{{  $result->priority }}</td>
                                                    <td>{{  $result->sort }}</td>
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
                                                               href="{{ route('getRegionObjectEdit',['id' => $result->id,'code' => $module->code]) }}"><i
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
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




@endsection

