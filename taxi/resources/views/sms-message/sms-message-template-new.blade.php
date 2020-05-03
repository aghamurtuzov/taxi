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
                                <h5 class="panel-title">{{ $templateName }}Push Şablonu Yarat</h5>
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
                                <form action="{{ route('postSmsMessageTemplateEdit',['id' => $result->id??'0','code' => $module->code]) }}"
                                      class="form-horizontal"
                                      method="post" accept-charset="utf-8">
                                    @csrf
                                    <fieldset class="content-group">
                                        <!-- Message -->
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Push</label>
                                            <div class="col-lg-10">
                                                <textarea maxlength="160" name="message" class="form-control" rows="5"
                                                          id="comment" placeholder="Yarat">{{ $result->message??'' }}</textarea>
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