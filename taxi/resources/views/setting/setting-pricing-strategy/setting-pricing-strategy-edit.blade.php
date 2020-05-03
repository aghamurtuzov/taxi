@extends('main.layout')
@section('content')
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Qiymət Strategiyası Yarat</h5>
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
                                    action="{{ route('postSettingPricingStrategyEdit',['id' => $result->id??0,'code' => $module->code]) }}"
                                    class="form-horizontal" method="post" accept-charset="utf-8">
                                    @csrf
                                    <fieldset class="content-group">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Ad</label>
                                            <div class="col-lg-10">
                                                <input name="name" type="text" class="form-control"
                                                       value="{{ $result->name??'' }}" placeholder="Ad">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Tarif</label>
                                            <div class="col-lg-10">
                                                <select name="tariff_id" class="select-search form-control">
                                                    @foreach($tariffs as $tarif)
                                                        <option
                                                            @if(isset($result->tariff) && $result->tariff_id== $tariff->id) selected
                                                            @endif  value="{{$tarif->id}}">{{$tarif->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Endirim</label>
                                            <div class="col-lg-10">
                                                <input name="discount" type="text" class="form-control"
                                                       value="{{ $result->discount??'' }}" placeholder="Endirim">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Endirim status</label>
                                            <div class="col-lg-10">
                                                <select name="is_fix_or_percent" class="select-search form-control">
                                                    <option value="">Seç</option>
                                                    <option
                                                        @if(isset($result->is_fix_or_percent) && $result->is_fix_or_percent == 0 ) selected
                                                        @endif value="0">
                                                        Fix
                                                    </option>
                                                    <option
                                                        @if(isset($result->is_fix_or_percent) && $result->is_fix_or_percent == 1 ) selected
                                                        @endif  value="1">
                                                        Faiz
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Sıralama</label>
                                            <div class="col-lg-10">
                                                <input name="priority" type="text" class="form-control"
                                                       value="{{ $result->priority??'' }}" placeholder="Sıralama">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Qüvvədə olduğu vaxt</label>
                                            <div class="col-lg-10">
                                                <select name="for" class="select-search form-control">
                                                    <option @if(!isset($result->weekday)) selected @endif value="1">
                                                        Tarix
                                                    </option>
                                                    <option @if(isset($result->weekday)) selected @endif  value="2">
                                                        Həftə Günləri
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="dateSection">
                                            <label class="control-label col-lg-2">Tarix</label>
                                            <div class="col-lg-10">
                                                <input type="text" name="date" class="form-control taxi_birthday"
                                                       value="{{ $result->date??'' }}" required="required">
                                            </div>
                                        </div>

                                        <div id="weekdaySection" class="form-group">
                                            <label class="control-label col-lg-2">Həftə Günləri</label>
                                            <div class="col-lg-10">
                                                <select name="weekday[]" multiple class="select-search form-control">
                                                    <option
                                                        @if(isset($result->weekday) && count($result->dataWeek()) && in_array("1",$result->dataWeek())) selected
                                                        @endif
                                                        value="1">Bazar ertəsi
                                                    </option>
                                                    <option
                                                        @if(isset($result->weekday) && count($result->dataWeek()) && in_array("2",$result->dataWeek())) selected
                                                        @endif
                                                        value="2">Çərşənbə axşamı
                                                    </option>
                                                    <option
                                                        @if(isset($result->weekday) && count($result->dataWeek()) && in_array("3",$result->dataWeek())) selected
                                                        @endif
                                                        value="3">Çərşənbə
                                                    </option>
                                                    <option
                                                        @if(isset($result->weekday) && count($result->dataWeek()) && in_array("4",$result->dataWeek())) selected
                                                        @endif
                                                        value="4">Cümə axşamı
                                                    </option>
                                                    <option
                                                        @if(isset($result->weekday) && count($result->dataWeek()) && in_array("5",$result->dataWeek())) selected
                                                        @endif
                                                        value="5">Cümə
                                                    </option>
                                                    <option
                                                        @if(isset($result->weekday) && count($result->dataWeek()) && in_array("6",$result->dataWeek())) selected
                                                        @endif
                                                        value="6">Şənbə
                                                    </option>
                                                    <option
                                                        @if(isset($result->weekday) && count($result->dataWeek()) && in_array("7",$result->dataWeek())) selected
                                                        @endif
                                                        value="7">Bazar
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Başlama Tarixi</label>
                                            <div class="col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                                    <input name="start_time" type="text" class="form-control"
                                                           id="anytime-time" value="00:00">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Bitmə Tarixi</label>
                                            <div class="col-lg-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                                    <input name="end_time" type="text" class="form-control"
                                                           id="anytime-time1" value="23:59">
                                                </div>
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
                </div>

            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>


        $('select[name="for"]').on('change', function () {

            if ($('select[name="for"] option:selected').val() == "1") {
                $('#dateSection').show();
                $('#weekdaySection').hide();
                $('#weekdaySection option').attr('selected', false);
                $(".select2-selection__rendered .select2-selection__choice").remove();
            } else {
                $('[name="date"]').val(null);
                $('#dateSection').hide();
                $('#weekdaySection').show();
            }
        })


    </script>


@endsection
