@extends('main.layout')
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

        #map {
            height: 60vh;
        }
    </style>
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Turniket girişi Yarat</h5>
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
                                <form
                                    action="{{ route('postRegionTurnstileAccessEdit',['id' => $result->id??0,'code' => $module->code]) }}"
                                    class="form-horizontal" method="post" accept-charset="utf-8">
                                    @csrf
                                    <fieldset class="content-group">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Ad</label>
                                            <div class="col-lg-10 has-feedback has-feedback-left">
                                                <input id="street"
                                                       type="text" name="name"
                                                       value=""
                                                       class="form-control input-roundless addressInput"
                                                       autocomplete="off" onclick="this.select();">
                                                <input type="hidden" name="object_id" value="" class="object_id">
                                                <div class="form-control-feedback">
                                                    <i class="icon-pin-alt"></i>
                                                </div>
                                                <ul class="search_result"></ul>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Qiymət (AZN)</label>
                                            <div class="col-lg-10">
                                                <input name="price" type="number" min="0" step="0.01"
                                                       class="form-control" value="" placeholder="Qiymət AZN">
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
                                <h5 class="panel-title">Turniket girişləri</h5>
                            </div>
                            <form
                                action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'region','view'=>'turnstile-access.region-turnstile-access' ]) }}"
                                name="listForm" method="get" accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group">
                                                <input type="text" name="object_name"
                                                       value="{{request()->input('object_name')}}" class="form-control"
                                                       placeholder="Kafe">
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
                                                    <a href="{{ Url('module/search/'.$module->code.'/region/turnstile-access.region-turnstile-access') }}?_token={{ csrf_token() }}&object_name={{ request()->get('object_name') }}&column_name=object_id&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'object_id') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Ad</a></th>
                                                <th>
                                                    <a href="{{ Url('module/search/'.$module->code.'/region/turnstile-access.region-turnstile-access') }}?_token={{ csrf_token() }}&object_name={{ request()->get('object_name') }}&column_name=price&order_type={{ request()->get('order_type') == 'asc' ? 'desc' : 'asc' }}&perPage={{ request()->get('perPage') }}">
                                                        <i class="@if( request()->get('column_name') == 'price') sort-amount-up icon-sort-amount-desc @endif"></i>
                                                        Qiymət</a></th>

                                                <th>Əməliyyat</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{$result->objectName->name}}</td>
                                                    <td>{{$result->price}} AZN</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="btn btn-default"
                                                               href="{{ route('getRegionTurnstileAccessEdit',['id' => $result->id,'code' => $module->code]) }}"><i
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



@section('script')

    <script>

        $(function () {
            addressSearch();
            $('.addressInput').trigger("keyup");
        });


        $('body').delegate('.addressInput', 'focusout', function () {
            $(this).parent().find(".search_result").fadeOut();
        })

        $('body').delegate('.addressInput', 'focusin', function () {
            $(this).trigger('keyup');
        })


    </script>

@endsection
