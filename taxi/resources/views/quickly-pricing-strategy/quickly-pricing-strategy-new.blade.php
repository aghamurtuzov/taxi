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
                                <form action="http://otos.ru/administrator/price_strategy_fast/create" class="form-horizontal" method="post" accept-charset="utf-8">
                                    <fieldset class="content-group">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Tarif</label>
                                            <div class="col-lg-10">
                                                <select name="tariff[]" multiple class="select-search form-control">
                                                    <option  value="1">Ekonom</option>
                                                    <option  value="3">Biznes</option>
                                                    <option  value="4">Minivan</option>
                                                    <option  value="5">Furqon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Faız(%)</label>
                                            <div class="col-lg-10">
                                                <input name="percent" type="number" min = "-100" max= "100" class="form-control" value="" placeholder="Faız(%)">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Bitmə Tarixi</label>
                                            <div class="col-lg-10">
                                                <input type="text" name="end_time" value="" placeholder="Bitmə Tarixi" id="end_time" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Açıqlama</label>
                                            <div class="col-lg-10">
                                                <textarea class="form-control" rows="5" cols="5" name ="description" maxlength="64" placeholder="Açıqlama"></textarea>
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