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

    </style>



<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title">Qəzalı obyekt əlavə et</h5>
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
                               <form action="{{ route('postRegionDangerObjectEdit',['id' => $result->id??0,'code' => $module->code]) }}" class="form-horizontal" method="post" accept-charset="utf-8">
                               	@csrf
                                <fieldset class="content-group">
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Ad</label>
                                        <div class="col-lg-10 has-feedback has-feedback-left">
                                            <input id="street"
                                                   type="text" name="name"
                                                   value="{{ $result->name??'' }}"
                                                   class="form-control input-roundless addressInput"
                                                   autocomplete="off" onclick="this.select();">
                                            <input type="hidden" name="latitude" value="{{ $result->latitude??'' }}" class="latitude">
                                            <input type="hidden" name="longitude" value="{{ $result->longitude??'' }}" class="longitude">
                                            <div class="form-control-feedback">
                                                <i class="icon-pin-alt"></i>
                                            </div>
                                            <ul class="search_result"></ul>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Sıralama</label>
                                        <div class="col-lg-10">
                                            <input name="sort" min="0" type="number" class="form-control" value="{{ $result->sort??'' }}" placeholder="Sıralama">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Radius</label>
                                        <div class="col-lg-10">
                                            <input name="radius" min="0" step="0.1" type="number" class="form-control" value="{{ $result->radius??'' }}" placeholder="Radius">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Status</label>
                                        <div class="col-lg-10">
                                            <select name="status" class="select form-control">
                                                <option @if(isset($result->status) && $result->status) selected @endif value="1">Aktiv
                                                </option>
                                                <option @if(isset($result->status) && !$result->status) selected @endif value="0">Deaktiv
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Əlavə et <i class="icon-arrow-right14 position-right"></i></button>
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

        $(function() {
            addressSearch();
            $('.addressInput').trigger("keyup");
        });


        $('body').delegate('.addressInput', 'focusout', function(){
            $(this).parent().find(".search_result").fadeOut();
        })

        $('body').delegate('.addressInput', 'focusin', function(){
            $(this).trigger('keyup');
        })




    </script>

@endsection