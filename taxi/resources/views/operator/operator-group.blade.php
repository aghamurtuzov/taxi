@extends('main.layout')
@section('content')





    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Qrupların listi</h5>
                            </div>
                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><strong>ID</strong></th>
                                            <th><strong>Ad</strong></th>
                                            <th><strong>Açıqlama</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                       
                                        @foreach($results as $result)
                                        <tr>
                                            <th>{{$result->id}}</th>
                                            <th>{{$result->name}}</th>
                                            <th>{{$result->description}}</th>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel-footer">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection