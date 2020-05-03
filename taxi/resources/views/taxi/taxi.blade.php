@extends('main.layout')

@section('addLink')

    <a href="{{ route('getTaxiEdit',['id' => 0]) }}" class="btn bg-success-400 btn-labeled btn-rounded"><b><i
                class="icon-plus3"></i></b> Əlavə et</a>
    </div>
    </div>
    <div class="breadcrumb-line">


        <ul class="breadcrumb-elements">
            <li><a href="{{ route('getTaxi') }}"><i class="icon-three-bars position-left"></i> BÜTÜN</a></li>
            <li>
                <a href="{{ Url('module/search/'.$module->code.'/'.'taxi/taxi') }}?_token={{ csrf_token() }}&number={{ request()->get('number') }}
                    &color={{ request()->get('color') }}
                    &from_year={{ request()->get('from_year') }}
                    &from_date_submit={{ request()->get('from_date_submit') }}
                    &to_year={{ request()->get('to_year') }}
                    &to_date_submit={{ request()->get('to_date_submit') }}
                    &brand={{ request()->get('brand') }}
                    &model={{ request()->get('model') }}
                    &body={{ request()->get('body') }}
                    &fuel={{ request()->get('fuel') }}
                    &tariff={{ request()->get('tariff') }}
                    &category={{ request()->get('category') }}
                    &driver_language={{ request()->get('driver_language') }}
                    &option={{ request()->get('option') }}
                    &fullname={{ request()->get('fuel') }}
                    &code={{ request()->get('code') }}
                    &phone={{ request()->get('phone') }}
                    &status=1
                    &perPage={{ request()->get('perPage') }}">
                    <i class="icon-checkmark-circle position-left"></i>
                    AKTİV</a></li>
            <li>
                <a href="{{ Url('module/search/'.$module->code.'/'.'taxi/taxi') }}?_token={{ csrf_token() }}&number={{ request()->get('number') }}
                    &color={{ request()->get('color') }}
                    &from_year={{ request()->get('from_year') }}
                    &from_date_submit={{ request()->get('from_date_submit') }}
                    &to_year={{ request()->get('to_year') }}
                    &to_date_submit={{ request()->get('to_date_submit') }}
                    &brand={{ request()->get('brand') }}
                    &model={{ request()->get('model') }}
                    &body={{ request()->get('body') }}
                    &fuel={{ request()->get('fuel') }}
                    &tariff={{ request()->get('tariff') }}
                    &category={{ request()->get('category') }}
                    &driver_language={{ request()->get('driver_language') }}
                    &option={{ request()->get('option') }}
                    &fullname={{ request()->get('fuel') }}
                    &code={{ request()->get('code') }}
                    &phone={{ request()->get('phone') }}
                    &status=0
                    &perPage={{ request()->get('perPage') }}">
                    <i class="icon-circle position-left"></i>
                    DEAKTİV</a></li>
            <li><a href="http://otos.ru/administrator/taxi?delete=1"><i class="icon-database-remove position-left"></i>
                    SİLİNMİŞ</a></li>
            <li><a href="{{ route('getTaxiMap') }}"><i class="icon-pin-alt position-left"></i> XƏRİTƏ</a>
            </li>
            <li><a href="http://otos.ru/administrator/taxi/arxiv"><i class="icon-archive position-left"></i> ARXIV</a>
            </li>
        </ul>

        <a class="breadcrumb-elements-toggle"><i class="icon-menu-open"></i></a>


        @endsection

        @section('content')





            <div class="page-container" style="min-height:276.1171875px">
                <!-- Page content -->
                <div class="page-content">

                    <!-- Main content -->
                    <div class="content-wrapper">
                        <!-- Bordered striped table -->
                        <div class="panel panel-white">

                            <div class="panel-heading">
                                <h5 class="panel-title">Taxilər</h5>
                            </div>

                            <form
                                action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'taxi','view'=>'taxi' ]) }}"
                                name="listForm" accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="number"
                                                       value="{{ request()->input('number') }}"
                                                       class="form-control"
                                                       placeholder="Nömrə">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="color" class="form-control">
                                                    @foreach($colors as $color)
                                                        <option @if(request()->input('color') == $color->id) selected
                                                                @endif value="{{ $color->id }}">{{ $color->color_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="brand"
                                                        class="select-search form-control auto_brand select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option value="">-- Marka --</option>
                                                    @foreach($brands as $b)
                                                        <option @if(request()->input('brand') == $b->id) selected
                                                                @endif value="{{ $b->id }}">{{ $b->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="model"
                                                        class="select-search form-control auto_model select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option value="">-- Model --</option>
                                                    @foreach($models as $m)
                                                        <option @if(request()->input('model') == $m->id) selected
                                                                @endif value="{{ $m->id }}">{{ $m->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="body"
                                                        class="select-search form-control select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option selected="" value="">-- Ban Növü --</option>
                                                    @foreach($bodies as $b)
                                                        <option @if(request()->input('body') == $b->id) selected
                                                                @endif value="{{ $b->id }}">{{ $b->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="fuel"
                                                        class="select-search form-control select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option selected="" value="">-- Yanacaq --</option>
                                                    @foreach($fuels as $f)
                                                        <option @if(request()->input('fuel') == $f->id) selected
                                                                @endif value="{{ $f->id }}">{{ $f->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="tariff"
                                                        class="select-search form-control select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option selected="" value="">-- Tarif --</option>
                                                    @foreach($tariffs as $t)
                                                        <option @if(request()->input('tariff') == $t->id) selected
                                                                @endif value="{{ $t->id }}">{{ $t->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="category"
                                                        class="select-search form-control select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option selected="" value="">-- Kateqoriya --</option>
                                                    @foreach($categories as $c)
                                                        <option @if(request()->input('category') == $c->id) selected
                                                                @endif value="{{ $c->id }}">{{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="driver_language"
                                                        class="select-search form-control select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option selected="" value="">-- Dil --</option>
                                                    @foreach($driver_languages as $d)
                                                        <option
                                                            @if(request()->input('driver_languages') == $d->id) selected
                                                            @endif value="{{ $d->id }}">{{ $d->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="option"
                                                        class="select-search form-control select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option selected="" value="">-- Xüsusiyyətlər --</option>
                                                    @foreach($options as $o)
                                                        <option @if(request()->input('option') == $o->id) selected
                                                                @endif value="{{ $o->id }}">{{ $o->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="fullname"
                                                       value="{{ request()->input('fullname') }}"
                                                       class="form-control"
                                                       placeholder="Tam adı">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="code" value="{{ request()->input('code') }}"
                                                       class="form-control"
                                                       placeholder="Tabel nömrəsi">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="phone" value="{{ request()->input('phone') }}"
                                                       class="form-control"
                                                       placeholder="Telefon">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="status"
                                                        class="select-fixed-single select2-hidden-accessible"
                                                        tabindex="-1" aria-hidden="true">
                                                    <option selected="" value="">-- Status --</option>
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
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i
                                                            class="icon-calendar22"></i></span>
                                                    <input name="from_date" type="date"
                                                           class="form-control "
                                                           placeholder="Başlama tarixi"
                                                           value="{{ request()->input('from_date') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
                                            <button type="submit" class="btn btn-default btn-block"><i
                                                    class="icon-search4"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <span>Taxilərin sayı: {{ count($results) }} ədəd</span>
                                            </div>
                                        </div>
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th>

                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'taxi/taxi') }}?_token={{ csrf_token() }}&number={{ request()->get('number') }}
                                                        &color={{ request()->get('color') }}
                                                        &page={{request()->input('page')?request()->input('page'):1}}
                                                        &from_year={{ request()->get('from_year') }}
                                                        &from_date_submit={{ request()->get('from_date_submit') }}
                                                        &to_year={{ request()->get('to_year') }}
                                                        &to_date_submit={{ request()->get('to_date_submit') }}
                                                        &brand={{ request()->get('brand') }}
                                                        &model={{ request()->get('model') }}
                                                        &body={{ request()->get('body') }}
                                                        &fuel={{ request()->get('fuel') }}
                                                        &tariff={{ request()->get('tariff') }}
                                                        &category={{ request()->get('category') }}
                                                        &driver_language={{ request()->get('driver_language') }}
                                                        &option={{ request()->get('option') }}
                                                        &fullname={{ request()->get('fuel') }}
                                                        &code={{ request()->get('code') }}
                                                        &phone={{ request()->get('phone') }}
                                                        &status={{ request()->get('status') }}
                                                        &column_name=code
                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                        &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'code') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        TABEL</a></th>

                                                <th class="text-center"><strong>AVTOMOBİL</strong></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'taxi/taxi') }}?_token={{ csrf_token() }}&number={{ request()->get('number') }}
                                                        &color={{ request()->get('color') }}
                                                        &page={{request()->input('page')?request()->input('page'):1}}
                                                        &from_year={{ request()->get('from_year') }}
                                                        &from_date_submit={{ request()->get('from_date_submit') }}
                                                        &to_year={{ request()->get('to_year') }}
                                                        &to_date_submit={{ request()->get('to_date_submit') }}
                                                        &brand={{ request()->get('brand') }}
                                                        &model={{ request()->get('model') }}
                                                        &body={{ request()->get('body') }}
                                                        &fuel={{ request()->get('fuel') }}
                                                        &tariff={{ request()->get('tariff') }}
                                                        &category={{ request()->get('category') }}
                                                        &driver_language={{ request()->get('driver_language') }}
                                                        &option={{ request()->get('option') }}
                                                        &fullname={{ request()->get('fuel') }}
                                                        &code={{ request()->get('code') }}
                                                        &phone={{ request()->get('phone') }}
                                                        &status={{ request()->get('status') }}
                                                        &column_name=number
                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                        &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'number') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        NÖMRƏ</a></th>
                                                <th class="text-center"><strong>SÜRÜCÜ</strong></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'taxi/taxi') }}?_token={{ csrf_token() }}&number={{ request()->get('number') }}
                                                        &color={{ request()->get('color') }}
                                                        &page={{request()->input('page')?request()->input('page'):1}}
                                                        &from_year={{ request()->get('from_year') }}
                                                        &from_date_submit={{ request()->get('from_date_submit') }}
                                                        &to_year={{ request()->get('to_year') }}
                                                        &to_date_submit={{ request()->get('to_date_submit') }}
                                                        &brand={{ request()->get('brand') }}
                                                        &model={{ request()->get('model') }}
                                                        &body={{ request()->get('body') }}
                                                        &fuel={{ request()->get('fuel') }}
                                                        &tariff={{ request()->get('tariff') }}
                                                        &category={{ request()->get('category') }}
                                                        &driver_language={{ request()->get('driver_language') }}
                                                        &option={{ request()->get('option') }}
                                                        &fullname={{ request()->get('fuel') }}
                                                        &code={{ request()->get('code') }}
                                                        &phone={{ request()->get('phone') }}
                                                        &status={{ request()->get('status') }}
                                                        &column_name=phone
                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                        &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'phone') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        TELEFON</a></th>
                                                <th><strong>KATEQORİYA</strong></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'taxi/taxi') }}?_token={{ csrf_token() }}&number={{ request()->get('number') }}
                                                        &color={{ request()->get('color') }}
                                                        &page={{request()->input('page')?request()->input('page'):1}}
                                                        &from_year={{ request()->get('from_year') }}
                                                        &from_date_submit={{ request()->get('from_date_submit') }}
                                                        &to_year={{ request()->get('to_year') }}
                                                        &to_date_submit={{ request()->get('to_date_submit') }}
                                                        &brand={{ request()->get('brand') }}
                                                        &model={{ request()->get('model') }}
                                                        &body={{ request()->get('body') }}
                                                        &fuel={{ request()->get('fuel') }}
                                                        &tariff={{ request()->get('tariff') }}
                                                        &category={{ request()->get('category') }}
                                                        &driver_language={{ request()->get('driver_language') }}
                                                        &option={{ request()->get('option') }}
                                                        &fullname={{ request()->get('fuel') }}
                                                        &code={{ request()->get('code') }}
                                                        &phone={{ request()->get('phone') }}
                                                        &status={{ request()->get('status') }}
                                                        &column_name=free
                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                        &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'free') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        VƏZİYYƏT</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'taxi/taxi') }}?_token={{ csrf_token() }}&number={{ request()->get('number') }}
                                                        &color={{ request()->get('color') }}
                                                        &page={{request()->input('page')?request()->input('page'):1}}
                                                        &from_year={{ request()->get('from_year') }}
                                                        &from_date_submit={{ request()->get('from_date_submit') }}
                                                        &to_year={{ request()->get('to_year') }}
                                                        &to_date_submit={{ request()->get('to_date_submit') }}
                                                        &brand={{ request()->get('brand') }}
                                                        &model={{ request()->get('model') }}
                                                        &body={{ request()->get('body') }}
                                                        &fuel={{ request()->get('fuel') }}
                                                        &tariff={{ request()->get('tariff') }}
                                                        &category={{ request()->get('category') }}
                                                        &driver_language={{ request()->get('driver_language') }}
                                                        &option={{ request()->get('option') }}
                                                        &fullname={{ request()->get('fuel') }}
                                                        &code={{ request()->get('code') }}
                                                        &phone={{ request()->get('phone') }}
                                                        &status={{ request()->get('status') }}
                                                        &column_name=status
                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                        &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'status') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        STATUS</a></th>
                                                <th>
                                                    <strong >
                                                        BALANS</strong></th>
                                                <th><strong>PRİORİTET</strong></th>
                                                <th><strong>TARIF</strong></th>

                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/'.'taxi/taxi') }}?_token={{ csrf_token() }}&number={{ request()->get('number') }}
                                                        &color={{ request()->get('color') }}
                                                        &page={{request()->input('page')?request()->input('page'):1}}
                                                        &from_year={{ request()->get('from_year') }}
                                                        &from_date_submit={{ request()->get('from_date_submit') }}
                                                        &to_year={{ request()->get('to_year') }}
                                                        &to_date_submit={{ request()->get('to_date_submit') }}
                                                        &brand={{ request()->get('brand') }}
                                                        &model={{ request()->get('model') }}
                                                        &body={{ request()->get('body') }}
                                                        &fuel={{ request()->get('fuel') }}
                                                        &tariff={{ request()->get('tariff') }}
                                                        &category={{ request()->get('category') }}
                                                        &driver_language={{ request()->get('driver_language') }}
                                                        &option={{ request()->get('option') }}
                                                        &fullname={{ request()->get('fuel') }}
                                                        &code={{ request()->get('code') }}
                                                        &phone={{ request()->get('phone') }}
                                                        &status={{ request()->get('status') }}
                                                        &column_name=date
                                                        &order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}
                                                        &perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'date') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        TARİX</a></th>
                                                <th><i class="icon-checkmark-circle2"></i> <i class="icon-cog2"></i> <i
                                                        class="icon-wallet"></i> <i class="icon-percent"></i></th>

                                                <th class="text-center"><i class="icon-menu7"></i></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{ $result->code }}</td>
                                                    <td>{{ $result->car()}}</td>
                                                    <td><a href="javascript:void()"
                                                           class="stats" data-original-title="" title=""><span
                                                                class="label label-flat border-success text-success-600 position-right">{{ $result->number }}</span></a>
                                                    </td>
                                                    <td>{{ $result->fullName() }}</td>
                                                    <td><a href="tel:{{ $result->phone }}"><i
                                                                class="icon-phone2"></i> {{ $result->phone }}</a>
                                                    </td>
                                                    <td>{{ $result->categoryName->name }}</td>
                                                    <td>
                                                        <span
                                                            class="label {{ $result->action ? 'label-danger' : 'label-success' }} label-success">{{ $result->action ? 'Sifarişdə' : 'Boş' }}</span>
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
                                                    <td>{{ $result->account ? number_format($result->account->balance, 2) : '' }}
                                                        ₼
                                                    </td>
                                                    <td>{{ $result->priority }}</td>
                                                    <td>{{ $result->tariffName() }}</td>
                                                    <td>{{ $result->date }}</td>
                                                    <td>
                                                        @if($result->device_id)
                                                            <i data-popup="tooltip" title=""
                                                               data-original-title="Cihaz qeydiyyatdan keçib"
                                                               class="icon-checkmark-circle2"></i>
                                                        @else
                                                            <i data-popup="tooltip" title=""
                                                               data-original-title="Cihaz qeydiyyatdan keçməyib"
                                                               class="icon-radio-unchecked"></i>
                                                        @endif
                                                        <i data-popup="tooltip" title=""
                                                           data-original-title="Tənzimləmələr istifadə edilir"
                                                           class="icon-cog2"></i>
                                                        @if($result->free)
                                                            <i data-popup="tooltip" title=""
                                                               data-original-title="Balanssız işləyir"
                                                               class="icon-checkmark"></i>
                                                        @else
                                                            <i data-popup="tooltip" title=""
                                                               data-original-title="Balansından istifadə edilir"
                                                               class="icon-wallet"></i>
                                                        @endif
                                                        @if($result->custom_fee)
                                                            <span data-popup="tooltip" title=""
                                                                  data-original-title="Tarifdən asılı olmayaraq göstərilən faiz çıxılır"
                                                                  class="label label-flat border-danger text-danger-600">{{ $result->custom_fee }}
                                                                %</span>
                                                        @else
                                                            <i data-popup="tooltip" title=""
                                                               data-original-title="Tarifinə uyğun faiz çıxılır"
                                                               class="icon-percent"></i>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        <ul class="icons-list">
                                                            <li class="dropdown">
                                                                <a href="#" class="dropdown-toggle"
                                                                   data-toggle="dropdown">
                                                                    <i class="icon-menu7"></i>
                                                                    <span class="caret"></span>
                                                                </a>

                                                                <ul class="dropdown-menu dropdown-menu-right taxi-dropdown">
                                                                    <li><a target="_blank"
                                                                           href="{{ route('getTaxiMap',['id' => $result->id]) }}"><i
                                                                                class="icon-location3"></i> Xəritədə
                                                                            bax</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('getMessageNew',['id' => $result->id,'type' => 1]) }}"><i
                                                                                class="icon-bubble-dots3"></i>Mesaj
                                                                            Göndər</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('getSmsNew',['id' => $result->id,'type' => 1]) }}"><i
                                                                                class="icon-envelope"></i>Sms Göndər</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('getTaxiView',['id' => $result->id]) }}"><i
                                                                                class="icon-eye"></i> Bax</a></li>
                                                                    <li>
                                                                        <a href="{{ route('getTaxiEdit',['id' => $result->id]) }}"><i
                                                                                class="icon-pencil7"></i> Redektə et</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('getTaxiDriverSetting',['id' => $result->id]) }}"><i
                                                                                class="icon-cog3"></i> Tənzimləmələr</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="test-taxi"
                                                                           data-taxi-id="{{ $result->id }}" href="#"><i
                                                                                class="icon-pulse2"></i> Test</a>
                                                                    </li>
                                                                    <li><a href="javascript:;"
                                                                           class="taxi-delete deleteModal"
                                                                           data-id="{{ $result->id }}"
                                                                           data-code="{{ $module->code }}"><i
                                                                                class="icon-trash"></i> Sil</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('getTaxiBlockedEdit',['id' => $result->id]) }}"
                                                                           class="taxi-block" data-id="1">
                                                                            <i class="icon-blocked"></i> Blokla
                                                                        </a>
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

                                <div class="panel-footer"><a class="heading-elements-toggle"><i
                                            class="icon-more"></i></a>
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

        @endsection


        @section('script')

            <script>

                $('.test-taxi').on('click', function (e) {
                    e.preventDefault();

                    let taxi_id = $(this).attr('data-taxi-id');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        type: 'post',
                        url: '{{ route('postTaxiTest') }}',
                        dataType: 'json',
                        data: {
                            taxi_id: taxi_id,
                        },

                        success: function (data) {
                            if (data['success']) {
                                swal({
                                    title: "Test sifariş göndərildi",
                                    type: "success",
                                    confirmButtonColor: "#4CAF50"
                                });
                            }
                        }
                    });
                });

            </script>


@endsection

