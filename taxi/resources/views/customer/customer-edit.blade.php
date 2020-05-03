@extends('main.layout')

@section('content')









    <div class="page-container">

        <div class="page-content">

            <div class="content-wrapper">

                <div class="row">

                    <div class="col-md-12">

                        <div class="panel panel-white">

                            <div class="panel-heading">

                                <h5 class="panel-title">Müştəri Redaktə et</h5>

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

                                <form action="{{ route('postCustomerEdit',['id' => $result->id??'0','code' => $module->code]) }}"

                                      class="form-horizontal"

                                      method="post" accept-charset="utf-8">

                                    @csrf

                                    <fieldset class="content-group">

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Ad</label>

                                            <div class="col-lg-10">

                                                <input name="firstname" type="text" class="form-control"

                                                       value="{{ $result->firstname??old('firstname') }}"

                                                       placeholder="Ad">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Soyad</label>

                                            <div class="col-lg-10">

                                                <input name="lastname" type="text" class="form-control"

                                                       value="{{ $result->lastname??old('firstname') }}"

                                                       placeholder="Soyad">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Doğum tarixi</label>

                                            <div class="col-lg-10" style="margin-bottom: 20px;">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><i

                                                                class="icon-calendar22"></i></span>

                                                    <input type="text" name="birthday" class="form-control date-new"

                                                           value="2013-08-12">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Endirim</label>

                                            <div class="col-lg-10">

                                                <input type="number" name="discount" class="form-control"

                                                       placeholder="Endirim"

                                                       value="{{ $result->discount??old('firstname') }}">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Endirim Statusu</label>

                                            <div class="col-lg-10">

                                                <select name="is_increase_discount" class="select-search">

                                                   <option value="1">Endirim artımı</option>
                                                   <option value="0">Endirim azalımı</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Qrup</label>

                                            <div class="col-lg-10">

                                                <select name="group" class="select-search">

                                                    @foreach($customerGroups as $group)

                                                        <option @if(isset($result->group) && $group->id == $result->group) selected

                                                                @endif  value="{{ $group->id }}">

                                                            {{ $group->name }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Cinsi</label>

                                            <div class="col-lg-10">

                                                <select name="gender" class="select-fixed-single">

                                                    <option @if(isset($result->gender) && $result->gender == 1) selected

                                                            @endif value="1">Kişi

                                                    </option>

                                                    <option @if(isset($result->gender) && $result->gender == 2) selected

                                                            @endif value="2">Qadın

                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Poçt adresi</label>

                                            <div class="col-lg-10">

                                                <input name="email" type="text" class="form-control"

                                                       value=" {{ $result->email??old('firstname') }}"

                                                       placeholder="Poçt adresi">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Telefon</label>

                                            <div class="col-lg-10">

                                                <input name="phone" type="text" class="form-control"

                                                       value=" {{ $result->phone??old('firstname') }}"

                                                       placeholder="Telefon">

                                            </div>

                                        </div>

                                        <div class="form-group">

                                            <label class="control-label col-lg-2">Status</label>

                                            <div class="col-lg-10">

                                                <select name="status" class="select-fixed-single">

                                                    <option @if(isset($result->status) && $result->status == 1) selected

                                                            @endif value="1">Aktiv

                                                    </option>

                                                    <option @if(isset($result->status) && $result->status == 0) selected

                                                            @endif value="0">

                                                        Deaktiv

                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                    </fieldset>



                                    <div class="text-right">

                                        <button type="submit" class="btn btn-primary">Redaktə et <i

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

