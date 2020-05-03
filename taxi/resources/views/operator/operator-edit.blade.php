@extends('main.layout')
@section('content')
    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">İstifadəçi əlavə et</h5>
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
                                @if(Session::has('danger-message'))
                                    <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('danger-message') }}</p>
                                @endif
                                <form action="{{ route('postOperatorEdit',['id' => $result->user_id??0,'code' => $module->code]) }}"
                                      class="form-horizontal" method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Ad</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="first_name" class="form-control"
                                                   value="{{ $result->first_name??old('first_name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Soyad</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="last_name" class="form-control"
                                                   value="{{ $result->last_name??old('last_name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Atasının adı</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="father_name" class="form-control"
                                                   value="{{ $result->father_name??old('father_name') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Email</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="email" class="form-control"
                                                   value="{{ $result->email??'info@ulduztaxi.az' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Şirkət</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="company" class="form-control"
                                                   value="{{ $result->company??'ULDUZ TAXI' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Telefon</label>
                                        <div class="col-lg-10">
                                            <div class="input-group">
                                                <span class="input-group-addon">994</span>
                                                <input type="text" name="phone" class="form-control"
                                                       value="{{ $result->phone??'555105000' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">İstifadəçi adı</label>
                                        <div class="col-lg-10">
                                            <input type="text" name="username" class="form-control"
                                                   value="{{ $result->username??old('username') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Şifrə</label>
                                        <div class="col-lg-10">
                                            <input type="password" value="0" name="password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Şifrəni təsdiqlə</label>
                                        <div class="col-lg-10">
                                            <input type="password" value="0" name="confirm_password"
                                                   class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Qrup</label>
                                        <div class="col-lg-10">
                                            <select name="parent_group" class="select" id="parentGroup">
                                                <option>-- Qrup seç --</option>
                                                @foreach($groups as $group)
                                                    <option @if(isset($result->group_id) && $result->group_id == $group->id) selected
                                                            @endif  value="{{$group->id}}"> {{$group->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Alt Qrup</label>
                                        <div class="col-lg-10">
                                            <select name="sub_group" class="select-search" id="subGroup">
                                                @if(isset($result->group_id))
                                                    <option value="{{$result->subgroup_id}}">{{$result->name}}</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">SIP Nömrə</label>
                                        <div class="col-lg-10">
                                            <input type="number" name="sip" class="form-control"
                                                   value="{{ $result->sip??old('sip') }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">SIP Şifrə</label>
                                        <div class="col-lg-10">
                                            <input type="password" name="sip_password" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-lg-2">Status</label>
                                        <div class="col-lg-10">
                                            <select name="active" class="select-fixed-single">
                                                <option @if(isset($result->active) && $result->active) selected
                                                        @endif value="1">Yayımla
                                                </option>
                                                <option @if(isset($result->active) && !$result->active) selected
                                                        @endif value="0">Deaktiv
                                                </option>
                                            </select>
                                        </div>
                                    </div>
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