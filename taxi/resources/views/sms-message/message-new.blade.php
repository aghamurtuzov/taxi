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
        }

        .search_result li:hover {
            background-color: #f5f5f5;
        }

        .selected {
            background: #56b0ff;
        }

        .destination {
            padding: 10px 0;
            border: 1px dashed #bdb9b9;
            background: #f5f5f5;
            cursor: move;
        }
    </style>


    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Push Göndər</h5>
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
                                <form action="{{ route('postMessageEdit',['code' => $module->code]) }}"
                                      class="form-horizontal"
                                      method="post" accept-charset="utf-8">
                                    @csrf
                                    <fieldset class="content-group">
                                        <!-- Destination Type -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Qəbul edənin növü</label>
                                            <div class="col-lg-10">
                                                <select @if($result['destination_type']??'') disabled
                                                        @endif name="destination_type"
                                                        class="select-fixed-single destinationType">
                                                    <option @if(isset($result['destination_type']) && $result['destination_type'] == 1) selected @endif value="1">Taksi</option>
                                                    <option @if(isset($result['destination_type']) && $result['destination_type'] == 2) selected @endif value="2">Müştəri</option>
                                                    <option value="3">Müştəri Qrupu</option>
                                                    <option value="4">Toplu push(Taksilərə)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Destination -->
                                        <div class="form-group destinationIdField">
                                            <label class="control-label col-lg-2">Qəbul edən</label>
                                            <div class="col-lg-10">
                                                <input @if($result) disabled @endif  data-type="1" type="text"
                                                       name="destination" value="{{ $result['destination']??'' }}"
                                                       class="form-control destinationIdInput"
                                                       autocomplete="off">
                                                <input type="hidden" name="destination_id"
                                                       value="{{ $result['destination_id']??'' }}"
                                                       class="form-control destinationIdInputHidden"
                                                       autocomplete="off" id="destination">
                                                <ul class="search_result"></ul>
                                            </div>
                                        </div>

                                        <!-- sms-message template -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Sms şablonu</label>
                                            <div class="col-lg-10">
                                                <select name="message_template" class="select-fixed-single smsTemplate">
                                                    <option value="0"> --- Sms şablonu seç ---</option>
                                                    @foreach($messageTemplates as $template)
                                                        <option value="{{ $template->message }}">
                                                            {{ $template->message }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Başlıq</label>
                                            <div class="col-lg-10">
                                                <input name="title" type="text" class="form-control" value=""
                                                       placeholder="Başlıq">
                                            </div>
                                        </div>
                                        <!-- Message -->
                                        <div class="form-group messageField">
                                            <label class="control-label col-lg-2">Push</label>
                                            <div class="col-lg-10">
                                                <textarea maxlength="160" name="message"
                                                          class="form-control messageText" rows="5"
                                                          id="comment"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="text-right">
                                        <button id="createButton" type="submit" class="btn btn-primary">Göndər <i
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
