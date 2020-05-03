@extends('main.layout')
@section('content')




<div class="page-container">
	<div class="page-content">
		<div class="content-wrapper">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-white">
						<div class="panel-heading">
							<h5 class="panel-title">Sürətli qiymət strategiyası yarat</h5>
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
                           <form action="{{ route('postSettingQuicklyPricingStrategyEdit',['id' => $result->id??0,'code' => $module->code]) }}" class="form-horizontal" method="post" accept-charset="utf-8">
                            @csrf
                            <fieldset class="content-group">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Tarif</label>
                                    <div class="col-lg-10">
                                        <select name="tariff[]" multiple class="select-search form-control">
                                                 @foreach($tariffs as $tarif)
                                                <option  value="{{$tarif->id}}">{{$tarif->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Faız(%)</label>
                                    <div class="col-lg-10">
                                        <input name="percent" type="number" min = "-100" max= "100" class="form-control" value="{{ old('percent')}}" placeholder="Faız(%)">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Bitmə Tarixi</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="end_time" value="{{old('end_time') }}" placeholder="Bitmə Tarixi" id="end_time" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Açıqlama</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" rows="5" cols="5" name ="description" maxlength="64" placeholder="Açıqlama">{{ old('desctiption') }}</textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Yarat <i class="icon-arrow-right14 position-right"></i></button>
                            </div>

                            </form>						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>









@endsection

@section('script')

<script>

$('select[name="for"]').trigger('change');
// Time picker
$('#end_time').daterangepicker({
       singleDatePicker: true,
       timePicker: true,
       timePicker24Hour: true,
       locale: {
           format: 'YYYY-MM-DD H:mm'
       }
   }).val("");

</script>


@endsection
