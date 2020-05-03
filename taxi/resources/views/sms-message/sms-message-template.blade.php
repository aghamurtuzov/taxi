@extends('main.layout')



@section('addLink')
    <a href="{{ route('getSmsMessageTemplateNew',['id' => 0,'code' => $module->code]) }}"
       class="btn bg-success-400 btn-labeled btn-rounded"><b><i class="icon-plus3"></i></b> {{ $templateName ? $templateName : 'Sms'  }} şablonu
        yarat</a>
@endsection

@section('content')


    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">{{ $templateName ? $templateName : 'Sms'  }} Şablonu</h5>

                            </div>

                            <form action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'sms-message','view'=>'sms-message-template' ]) }}"
                                  name="listForm" method="get"
                                  accept-charset="utf-8">
                                @csrf
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="message" value="{{ request()->get('message') }}" class="form-control"
                                                       placeholder="Push">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-default btn-block"><i
                                                        class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover"
                                               style="border-top:1px solid #ddd">
                                            <thead>
                                            <tr>
                                                <th>Push</th>
                                                <th>Əməliyyat</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($results as $result)
                                                <tr>
                                                    <td>{{ $result->message }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <a class="btn btn-default"
                                                               href="{{ route('getSmsMessageTemplateNew',['id' => $result->id,'code' => $module->code]) }}"><i
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
                                        <div class="text-right">
                                            <ul class="pagination pagination-separated pull-right">
                                                {{ $results->links('vendor.pagination.bootstrap-4') }}
                                            </ul>
                                        </div>
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