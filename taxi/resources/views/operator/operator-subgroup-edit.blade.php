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
                            <h5 class="panel-title">Alt qrup yarat</h5>
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
                            <form action="{{ route('postOperatorSubgroupEdit',['id' => $result->id??0,'code' => $module->code]) }}" class="form-horizontal" method="post" accept-charset="utf-8">
                                @csrf
                            <fieldset class="content-group">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Üst Kateqoriya</label>
                                    <div class="col-lg-10">
                                        <select name="group" class="select-fixed-single">
                                            <option value="">-- Üst kateqoriyasını seç --</option>
                                            @foreach($groups as $group)
                                            <option @if(isset($result->group) && $result->group== $group->id) selected @endif   value="{{$group->id}}"> {{$group->name}}</option>
                                            @endforeach      
                                                                                                                              
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Ad</label>
                                    <div class="col-lg-10">
                                        <input type="Text" name="name" class="form-control" value="{{ $result->name??'' }}" placeholder="Ad">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">İcazə</label>
                                    <div class="col-lg-10">
                                        <textarea name= "permission" class="form-control" rows="5">
                                            {{ $result->permission??'' }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Status</label>
                                    <div class="col-lg-10">
                                        <div class="form-group">
                                            <select name="status" class="select-fixed-single">
                                               <option @if(isset($result->status) && $result->status) selected @endif value="1">Aktiv
                                                </option>
                                            <option @if(isset($result->status) && !$result->status) selected @endif value="0">Deaktiv
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Yarat <i class="icon-arrow-right14 position-right"></i></button>
                            </div>

                            </form>                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection