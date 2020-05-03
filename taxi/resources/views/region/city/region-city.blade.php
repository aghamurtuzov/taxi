@extends('main.layout')
@section('content')





    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Şəhər Yarat</h5>
                            </div>

                            <div class="panel-body">
                                @if(Session::has('success-message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success-message') }}</p>
                                @endif
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <p class="alert alert-class alert-danger">{{ $error }}</p>
                                    @endforeach
                                @endif
                                <form action="{{ route('postRegionCityEdit',['id' => 0,'code' => $module->code]) }}"
                                      class="form-horizontal" method="post" accept-charset="utf-8">
                                    @csrf
                                    <fieldset class="content-group">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Ad</label>
                                            <div class="col-lg-10">
                                                <input name="name" type="text" class="form-control"
                                                       value="{{ old('name') }}" placeholder="Ad">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Bölgə</label>
                                            <div class="col-lg-10">
                                                <select name="region" class="select-search">
                                                    @foreach($regions as $region)
                                                        <option @if( old('region') == $region->id) selected
                                                                @endif  value="{{$region->id}}">{{$region->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Ölkə</label>
                                            <div class="col-lg-10">
                                                <select name="country" class="select">
                                                    @foreach($countries as $country)
                                                        <option @if( old('country') == $country->id) selected
                                                                @endif value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Sıralama</label>
                                            <div class="col-lg-10">
                                                <input name="sort" type="text" class="form-control"
                                                       value="{{ old('sort') }}" placeholder="Sıralama">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Status</label>
                                            <div class="col-lg-10">
                                                <select name="status" class="select">
                                                    <option @if(request()->input('status') == '1') selected
                                                            @endif value="1">Aktiv
                                                    </option>
                                                    <option @if( request()->input('status') == '0') selected
                                                            @endif value="0">Deaktiv
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Yarat <i
                                                class="icon-arrow-right14 position-right"></i></button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Şəhərlər</h5>
                            </div>

                            <form
                                action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'region','view'=>'city.region-city' ]) }}"
                                name="listForm" method="get" accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="name" value="{{request()->input('name')}}"
                                                       class="form-control" placeholder="Abşeron">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select name="region" class="select-search form-control">
                                                    <option value="">-- Bölgəni seç --</option>
                                                    @foreach($regions as $region)
                                                        <option @if(request()->input('region') == $region->id) selected
                                                                @endif  value="{{$region->id}}">{{$region->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <select name="country" class="select">
                                                    <option value="">-- Ölkə seç --</option>
                                                    @foreach($countries as $country)
                                                        <option
                                                            @if(request()->input('country') == $country->id) selected
                                                            @endif  value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <select name="status" class="select">
                                                    <option selected value="">-- Statusu seç --</option>
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
                                            <button type="submit" class="btn btn-default btn-block"><i
                                                    class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/region/city.region-city') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&country={{ request()->get('country')}}&status={{ request()->get('status') }}&column_name=name&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'name') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Ad</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/region/city.region-city') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&country={{ request()->get('country')}}&status={{ request()->get('status') }}&column_name=region&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'region') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Bölgə</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/region/city.region-city') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&country={{ request()->get('country')}}&status={{ request()->get('status') }}&column_name=country&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'country') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Ölkə</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/region/city.region-city') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&country={{ request()->get('country')}}&status={{ request()->get('status') }}&column_name=sort&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'sort') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Sıralama</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/region/city.region-city') }}?_token={{ csrf_token() }}&page={{request()->input('page')?request()->input('page'):1}}&name={{ request()->get('name') }}&region={{ request()->get('region')}}&country={{ request()->get('country')}}&status={{ request()->get('status') }}&column_name=status&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'status') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Status</a></th>

                                                <th><strong>Əməliyyat</strong></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{$result->name}}</td>
                                                    <td>{{$result->regionName->name??''}}</td>
                                                    <td>{{$result->countryName->name??''}}</td>
                                                    <td><span class="badge badge-flat badge-primary text-primary-600"
                                                              style="border-color: rgb(255, 166, 0);">{{$result->sort}}</span>
                                                    </td>
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
                                                               href="{{ route('getRegionCityEdit',['id' => $result->id,'code' => $module->code]) }}"><i
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
