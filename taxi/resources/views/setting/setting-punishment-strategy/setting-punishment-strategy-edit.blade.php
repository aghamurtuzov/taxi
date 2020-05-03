@extends('main.layout')
@section('content')
<!-- sms -->
<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title">Cərimə Strategiyası Yarat</h5>
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
                           <form action="{{ route('postSettingPunishmentStrategyEdit',['id' => $result->id??0,'code' => $module->code]) }}" class="form-horizontal" method="post" accept-charset="utf-8">
                            @csrf
                            <fieldset class="content-group">

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Başlama Tarixi </label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                            <input name = "from_time" type="text" class="form-control" id="anytime-time" value="{{ $result->from_time??'' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Bitmə Tarixi</label>
                                    <div class="col-lg-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-watch2"></i></span>
                                            <input name= "to_time" type="text" class="form-control" id="anytime-time1" value="{{ $result->to_time??'' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-lg-2">Qiymət</label>
                                    <div class="col-lg-10">
                                        <input name= "penalty" type="text" class="form-control"  value="{{ $result->penalty??'' }}">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label col-lg-2">Əməliyyat</label>
                                    <div class="col-lg-10">
                                        <select name="action" class="select-fixed-single destinationType">
                                                <option @if(isset($result->action) && $result->action == 4) selected @endif  value="4">Dispetçer tərəfindən və ya taksi özünin sifarişi ləğv etməsi</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Ödəmə methodu</label>
                                    <div class="col-lg-10">
                                        <select name="payment_method" class="select-fixed-single destinationType">
                                            <option @if(isset($result->payment_method) && $result->payment_method == 1 ) selected @endif value="1">Nəğd</option>
                                            <option @if(isset($result->payment_method) && $result->payment_method == 2 ) selected @endif value="2">Nəğdsiz</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Vacib</label>
                                    <div class="col-lg-10">
                                        <select name="important" class="select-fixed-single destinationType">
                                            <option @if(isset($result->important) && $result->important == 1 ) selected @endif value="1">Vacib</option>
                                            <option @if(isset($result->important) && $result->important == 0 ) selected @endif value="0">Vacib deyil</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Status</label>
                                    <div class="col-lg-10">
                                        <select name="status" class="select-fixed-single destinationType">
                                            <option @if(isset($result->status) && $result->status == 0) selected @endif
                                              value="0">Deaktiv</option>
                                            <option @if(isset($result->status) && $result->status == 1) selected @endif value="1">Aktiv</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Yarat <i class="icon-arrow-right14 position-right"></i></button>
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
$(document).ready(function(){

});
// Time picker
$("#anytime-time").AnyTime_picker({
    format: "%H:%i"
});
$("#anytime-time1").AnyTime_picker({
    format: "%H:%i"
});
</script>

@endsection
