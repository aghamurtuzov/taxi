@extends('main.layout')
@section('content')





    <!-- sms-message -->
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Proritet Endirimi</h5>
                            </div>

                            <div class="panel-body">
                                @if(Session::has('success-message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success-message') }}</p>
                                @endif
                                    @if(Session::has('taxi-not-found-message'))
                                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('taxi-not-found-message') }}</p>
                                    @endif
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <p class="alert alert-class alert-danger">{{ $error }}</p>
                                    @endforeach
                                @endif
                                <form action="{{ route('postPriorityDecreaseEdit') }}"
                                      class="form-horizontal"
                                      method="post" accept-charset="utf-8">
                                    @csrf
                                    <fieldset class="content-group">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Kategoriya</label>
                                            <div class="col-lg-10">
                                                <select name="category" class="select-search form-control">
                                                    <option>-- Kategoriya seç ---</option>
                                                    @foreach($taxiCategories as $taxiCategory)
                                                        <option value="{{ $taxiCategory->id }}">{{ $taxiCategory->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Endirim(%)</label>
                                            <div class="col-lg-10">
                                                <input name="discount" type="number" min="1" class="form-control"
                                                       value="" placeholder="Endirim(%)" %>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Tətbiq et <i
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