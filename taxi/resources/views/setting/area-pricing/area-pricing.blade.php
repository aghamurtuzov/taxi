@extends('main.layout')
@section('content')

@section('addLink')
    <a href="{{ route('getSettingAreaPricingNew') }}"
       class="btn bg-success-400 btn-labeled btn-rounded" style="margin-top: -20px;"><b><i class="icon-plus3"></i></b>
        Əlavə et</a><br>
@endsection



<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title">Ərazi qiymətləndirmə</h5>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Ad</th>
                                    <th>Qiymət(%)</th>
                                    <th>Qiymət statusu</th>
                                    <th>Status</th>
                                    <th><strong>Əməliyyat</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($results as $result)
                                    <tr>
                                        <td>{{$result->name}}</td>
                                        <td>{{$result->amount }} %</td>
                                        <td>{{$result->amount_status ? 'Artım' : 'Endirim'}}</td>
                                        <td>{{$result->status ? 'Aktiv' : 'Deaktiv'}}</td>
                                        <td>
                                            <div class="btn-group">

                                                <a class="btn btn-default"
                                                   href="{{ route('getSettingAreaPricingEdit',['id' => $result->id]) }}"><i
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
                            <ul class="pagination pagination-separated pull-right">
                                {{ $results->links('vendor.pagination.bootstrap-4') }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>


@endsection
