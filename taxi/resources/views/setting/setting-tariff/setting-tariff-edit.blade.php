@extends('main.layout')
@section('content')

    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Tarif Yarat</h5>
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
                                    action="{{ route('postSettingTariffEdit',['id' => $result->id??0,'code' => $module->code]) }}"
                                    class="form-horizontal" method="post" accept-charset="utf-8">
                                    @csrf
                                    <fieldset>
                                        <legend class="text-bold">Ümumi</legend>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Ad</label>
                                            <div class="col-lg-10">
                                                <input name="name" type="text" class="form-control"
                                                       value="{{$result->name??''}}" placeholder="Ad">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Pulsuz gözləmə müddəti (dəq)</label>
                                            <div class="col-lg-10">
                                                <input name="free_timeout" type="text" class="form-control"
                                                       value="{{$result->free_timeout??''}}"
                                                       placeholder="Pulsuz gözləmə müddəti (dəq)">
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend class="text-bold">Ödəniş</legend>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Əlavə gözləməyə görə ödəniş (1
                                                dəq)</label>
                                            <div class="col-lg-10">
                                                <input name="timeout_fee" type="text" class="form-control"
                                                       value="{{$result->timeout_fee??''}}"
                                                       placeholder="Əlavə gözləməyə görə ödəniş (1 dəq)">
                                            </div>
                                        </div>
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label class="control-label col-lg-2">Məsafəyə görə xidmət haqqı (%)</label>--}}
                                        {{--                                            <div class="col-lg-10">--}}
                                        {{--                                                <input name="distance_fee" type="text" class="form-control"--}}
                                        {{--                                                       value="{{$result->distance_fee??''}}"--}}
                                        {{--                                                       placeholder="Məsafəyə görə xidmət haqqı (%)">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Əlavə gediş nöqtələrinə görə
                                                ödəniş</label>
                                            <div class="col-lg-10">
                                                <input name="per_destination_fee" type="text" class="form-control"
                                                       value="{{$result->per_destination_fee??''}}"
                                                       placeholder="Əlavə gediş nöqtələrinə görə ödəniş">
                                            </div>
                                        </div>
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label class="control-label col-lg-2">Vaxta görə xidmət haqqı (%)</label>--}}
                                        {{--                                            <div class="col-lg-10">--}}
                                        {{--                                                <input name="time_fee" type="text" class="form-control"--}}
                                        {{--                                                       value="{{$result->time_fee??''}}"--}}
                                        {{--                                                       placeholder="Vaxta görə xidmət haqqı (%)">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </fieldset>
                                    <fieldset>
                                        <legend class="text-bold">Başqa</legend>
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label class="control-label col-lg-2">İlkin təyinat</label>--}}
                                        {{--                                            <div class="col-lg-10">--}}
                                        {{--                                                <select name="default" class="form-control select">--}}
                                        {{--                                                    <option--}}
                                        {{--                                                        @if(isset($result->default) && $result->default == 1) selected--}}
                                        {{--                                                        @endif  value="1">İlkin təyinat--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                    <option--}}
                                        {{--                                                        @if(isset($result->default) && $result->default == 0) selected--}}
                                        {{--                                                        @endif  value="0">İlkin təyinat yoxdur--}}
                                        {{--                                                    </option>--}}
                                        {{--                                                </select>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label class="control-label col-lg-2">Sıralama</label>--}}
                                        {{--                                            <div class="col-lg-10">--}}
                                        {{--                                                <input name="sort" type="text" class="form-control"--}}
                                        {{--                                                       value="{{$result->sort??''}}" placeholder="Sıralama">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Status</label>
                                            <div class="col-lg-10">
                                                <select name="status" class="form-control select">
                                                    <option @if(isset($result->status) && $result->status == 0) selected
                                                            @endif  value="1">Aktiv
                                                    </option>
                                                    <option @if(isset($result->status) && $result->status == 0) selected
                                                            @endif  value="0">Deaktiv
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    {{--                                    @if(isset($result->plan_for_time))--}}
                                    {{--                                        <fieldset>--}}
                                    {{--                                            <legend class="text-bold">Vaxt planı</legend>--}}

                                    {{--                                            @foreach($result->plan_for_time as $plan)--}}

                                    {{--                                                <div class="form-group">--}}
                                    {{--                                                    <div id="plan_for_time_block">--}}
                                    {{--                                                        <div class="plan_for_time_item">--}}
                                    {{--                                                            <label class="control-label col-lg-1">Başlama vaxtı</label>--}}
                                    {{--                                                            <div class="col-lg-2">--}}
                                    {{--                                                                <input name="starts[]" type="text"--}}
                                    {{--                                                                       class="form-control"--}}
                                    {{--                                                                       value="@if(isset($plan['start'])){{$plan['start'] }} @endif"--}}
                                    {{--                                                                       readonly placeholder="Başlama vaxtı">--}}
                                    {{--                                                            </div>--}}
                                    {{--                                                            <label class="control-label col-lg-1">Bitmə vaxtı</label>--}}
                                    {{--                                                            <div class="col-lg-2">--}}
                                    {{--                                                                <input name="ends[]" type="text"--}}
                                    {{--                                                                       class="form-control"--}}
                                    {{--                                                                       value="@if(isset($plan['end'])){{$plan['end']}} @endif"--}}
                                    {{--                                                                       placeholder="Bitmə vaxtı">--}}
                                    {{--                                                            </div>--}}
                                    {{--                                                            <label class="control-label col-lg-1">Qiymət</label>--}}
                                    {{--                                                            <div class="col-lg-2">--}}
                                    {{--                                                                <input name="prices[]" type="text"--}}
                                    {{--                                                                       class="form-control"--}}
                                    {{--                                                                       value="@if(isset($plan['price'])){{$plan['price']}} @endif"--}}
                                    {{--                                                                       placeholder="Qiymət">--}}
                                    {{--                                                            </div>--}}
                                    {{--                                                            <label class="control-label col-lg-1">--}}
                                    {{--                                                                <input--}}
                                    {{--                                                                    @if (isset($plan['fix']) && $plan['fix'] == 1) checked--}}
                                    {{--                                                                    @endif class="fixs" type="checkbox">--}}
                                    {{--                                                                <input name="fix[]" type="hidden" value="">--}}
                                    {{--                                                                Fiks </label>--}}
                                    {{--                                                            <br>--}}
                                    {{--                                                            <br>--}}
                                    {{--                                                            <br>--}}
                                    {{--                                                        </div>--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                            <button id="createPlanForTime" type="button"--}}
                                    {{--                                                    class="btn btn-primary col-md-12">Vaxt planı yarat--}}
                                    {{--                                            </button>--}}
                                    {{--                                        </fieldset>--}}

                                    {{--                                    @else--}}
                                    {{--                                        <fieldset>--}}
                                    {{--                                            <legend class="text-bold">Vaxt planı</legend>--}}


                                    {{--                                            <div class="form-group">--}}
                                    {{--                                                <div id="plan_for_time_block">--}}
                                    {{--                                                    <div class="plan_for_time_item">--}}
                                    {{--                                                        <label class="control-label col-lg-1">Başlama vaxtı</label>--}}
                                    {{--                                                        <div class="col-lg-2">--}}
                                    {{--                                                            <input name="starts[]" type="text"--}}
                                    {{--                                                                   class="form-control" value="0" readonly--}}
                                    {{--                                                                   placeholder="Başlama vaxtı">--}}
                                    {{--                                                        </div>--}}
                                    {{--                                                        <label class="control-label col-lg-1">Bitmə vaxtı</label>--}}
                                    {{--                                                        <div class="col-lg-2">--}}
                                    {{--                                                            <input name="ends[]" type="text" class="form-control"--}}
                                    {{--                                                                   placeholder="Bitmə vaxtı">--}}
                                    {{--                                                        </div>--}}
                                    {{--                                                        <label class="control-label col-lg-1">Qiymət</label>--}}
                                    {{--                                                        <div class="col-lg-2">--}}
                                    {{--                                                            <input name="prices[]" type="text"--}}
                                    {{--                                                                   class="form-control" placeholder="Qiymət">--}}
                                    {{--                                                        </div>--}}
                                    {{--                                                        <label class="control-label col-lg-1">--}}
                                    {{--                                                            <input class="fix_checker" type="checkbox">--}}
                                    {{--                                                            <input name="fixs[]" type="hidden" value="">--}}
                                    {{--                                                            Fiks </label>--}}
                                    {{--                                                        <br>--}}
                                    {{--                                                        <br>--}}
                                    {{--                                                        <br>--}}
                                    {{--                                                    </div>--}}
                                    {{--                                                </div>--}}
                                    {{--                                            </div>--}}

                                    {{--                                            <button id="createPlanForTime" type="button"--}}
                                    {{--                                                    class="btn btn-primary col-md-12">Vaxt planı yarat--}}
                                    {{--                                            </button>--}}
                                    {{--                                        </fieldset>--}}

                                    {{--                                    @endif--}}
                                    @if(isset($result->plan_for_distance) && count($result->plan_for_distance))
                                        <fieldset>
                                            <legend class="text-bold">Məsafə planı</legend>
                                            @foreach($result->plan_for_distance as $pland)
                                                <div class="form-group">
                                                    <div class="plan_for_distance_block">
                                                        <div class="plan_for_time_item">
                                                            <label class="control-label col-lg-1">Başlama vaxtı</label>
                                                            <div class="col-lg-2">
                                                                <input name="start[]" type="text"
                                                                       class="form-control"
                                                                       value="@if(isset($pland['start'])){{$pland['start']}} @else 0 @endif "
                                                                       readonly placeholder="Məsafədən">
                                                            </div>
                                                            <label class="control-label col-lg-1">Məsafəyə</label>
                                                            <div class="col-lg-2">
                                                                <input name="end[]" type="text"
                                                                       class="form-control end-input"
                                                                       value="@if(isset($pland['end'])){{$pland['end']}} @else 0 @endif"
                                                                       placeholder="Məsafəyə">
                                                            </div>
                                                            <label class="control-label col-lg-1">Qiymət</label>
                                                            <div class="col-lg-2">
                                                                <input name="price[]" type="text"
                                                                       class="form-control"
                                                                       value="@if(isset($pland['price'])){{$pland['price']}} @endif"
                                                                       placeholder="Qiymət">
                                                            </div>
                                                            <label class="control-label col-lg-1">
                                                                <input  name="fix[]"
                                                                    @if (isset($pland['fix']) && $pland['fix'] == 1) checked
                                                                    @endif class="fix" type="checkbox">
                                                                Fiks </label>
                                                            <button type="button"
                                                                    class="delete_plan_for_distance_item btn btn-danger">
                                                                Sil
                                                            </button>
                                                            <br>
                                                            <br>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <button id="createPlanForDistance" type="button"
                                                    class="btn btn-primary col-md-12">Məsafə planı yarat
                                            </button>
                                        </fieldset>

                                    @else


                                        <fieldset>
                                            <legend class="text-bold">Məsafə planı</legend>

                                            <div class="form-group">
                                                <div class="plan_for_distance_block">
                                                    <div class="plan_for_time_item">
                                                        <label class="control-label col-lg-1">Başlama vaxtı</label>
                                                        <div class="col-lg-2">
                                                            <input name="start[]" type="text"
                                                                   class="form-control" value="0" readonly
                                                                   placeholder="Məsafədən">
                                                        </div>
                                                        <label class="control-label col-lg-1">Məsafəyə</label>
                                                        <div class="col-lg-2">
                                                            <input name="end[]" type="text" value=""
                                                                   class="form-control end-input"
                                                                   placeholder="Məsafəyə">
                                                        </div>
                                                        <label class="control-label col-lg-1">Qiymət</label>
                                                        <div class="col-lg-2">
                                                            <input name="price[]" type="text" value=""
                                                                   class="form-control" placeholder="Qiymət">
                                                        </div>
                                                        <label class="control-label col-lg-1">
                                                            <input name="fix[]" class="fix_checker" type="checkbox">
                                                            Fiks </label>
                                                        <br>
                                                        <br>
                                                        <br>
                                                    </div>
                                                </div>
                                            </div>

                                            <button id="createPlanForDistance" type="button"
                                                    class="btn btn-primary col-md-12">Məsafə planı yarat
                                            </button>
                                        </fieldset>



                                    @endif


                                    <br>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Yarat <i
                                                class="icon-arrow-right14 position-right"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('script')

    <script>

        $('.end-input').on('keyup', function (e) {
            e.preventDefault();

            let endValue = $(this).val();
            let index = $( "input[name='end[]']" ).index( $(this) );
            let start = $('input[name="start[]"]');

            $(start[index + 1]).val(endValue);
        })


    </script>

@endsection
