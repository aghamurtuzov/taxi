@extends('main.layout')
@section('content')





    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Taksi Parametrləri</h5>
                                <div class="heading-elements">
                                    <button type="button" class="btn btn-danger heading-btn"><i
                                                class="icon icon-cross2"></i> Sil
                                    </button>
                                    <button onclick="location.href='{{ route('postTaxiDriverSettingStandard',['id' => $result->id??'' ]) }}'"
                                            type="button" class="btn btn-primary heading-btn reset-taxi-parameter"><i
                                                class="icon icon-reset"></i> Standart
                                    </button>
                                </div>
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
                                <form action="{{ route('postTaxiDriverSetting',['id' => $result->id??$id,'code' => $module->code]) }}"
                                      class="form-horizontal"
                                      method="post" accept-charset="utf-8">
                                    @csrf
                                    <div class="tabbable nav-tabs-vertical nav-tabs-left">
                                        <ul class="nav nav-tabs nav-tabs-highlight">
                                            <li class="active"><a href="#general" data-toggle="tab"><i
                                                            class="icon-menu7 position-left"></i> Ümumi</a></li>
                                            <li><a href="#public_order" data-toggle="tab"><i
                                                            class="icon-flag7 position-left"></i> Açıq sifarişlər</a>
                                            </li>
                                            <li><a href="#future_order" data-toggle="tab"><i
                                                            class="icon-alarm position-left"></i> Ön sifarişlər</a></li>
                                            <li><a href="#in_order" data-toggle="tab"><i
                                                            class="icon-cart-add position-left"></i> Sifarişin
                                                    içində</a></li>
                                            <li><a href="#in_photo_control" data-toggle="tab"><i
                                                            class="glyphicon glyphicon-eye-open position-left"></i> Foto Nəzarət</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active has-padding" id="general">
                                                <fieldset class="content-group">
                                                    <legend>Ümumi</legend>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Qiyməti göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input id="show_price" type="checkbox" name="show_price"
                                                                   {{ $result->show_price??'' ? 'checked' : '' }} class="switchery-primary">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Təyinatı göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="show_destination"
                                                                   {{ $result->show_destination??'' ? 'checked' : '' }}     class="switchery-primary1"
                                                                   selected>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Naviqatorlar</label>
                                                        <div class="col-lg-8 multi-select-full">
                                                            <select name="navigator[]" multiple="multiple"
                                                                    class="select">
                                                                <optgroup label="Naviqatorlar">
                                                                    <option @if(isset($result) && in_array(1, $result->navigatorArray() )) selected
                                                                            @endif value="1">Waze
                                                                    </option>
                                                                    <option @if(isset($result) && in_array(2, $result->navigatorArray() )) selected
                                                                            @endif value="2">City Guide
                                                                    </option>
                                                                    <option @if(isset($result) && in_array(3, $result->navigatorArray() )) selected
                                                                            @endif value="3">GeoNet
                                                                    </option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">İstək saniyəsi</label>
                                                        <div class="col-lg-8">
                                                            <input name="request_second" type="number" min="5"
                                                                   class="form-control"
                                                                   value="{{ $result->request_second??'1200' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Sifarişin radiusu</label>
                                                        <div class="col-lg-8">
                                                            <input name="order_radius" type="number" min="1" max="10"
                                                                   class="form-control"
                                                                   value="{{ $result->order_radius??'2' }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Yer</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="offline_location"
                                                                   {{ $result->offline_location??'' ? 'checked' : '' }}      class="switchery-primary2">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="tab-pane has-padding" id="public_order">
                                                <fieldset>
                                                    <legend>AÇIQ SİFARİŞLƏR</legend>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Açıq sifarişin gediləcək
                                                            yerlərini göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="public_order_show_destination"
                                                                   {{ $result->public_order_show_destination??'' ? 'checked' : '' }}    class="switchery-primary3">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Açıq sifarişin qiymətini
                                                            göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="public_order_show_price"
                                                                   {{ $result->public_order_show_price??'' ? 'checked' : '' }}   class="switchery-primary4">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Açıq sifarişin olduğu
                                                            göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="public_order_show_orign"
                                                                   {{ $result->public_order_show_orign??'' ? 'checked' : '' }}  class="switchery-primary5">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Açıq sifarişin götürə
                                                            bilmə radiusu</label>
                                                        <div class="col-lg-8">
                                                            <input name="public_order_radius" type="number" min="1"
                                                                   max="10" class="form-control"
                                                                   value="{{ $result->public_order_radius??'2' }}">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="tab-pane has-padding" id="future_order">
                                                <fieldset>
                                                    <legend>ÖN SİFARİŞLƏR</legend>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Ön sifarişin gediləcək
                                                            yerlərini göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="future_order_show_destination"
                                                                   {{ $result->future_order_show_destination??'' ? 'checked' : '' }}     class="switchery-primary6">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Ön sifarişin qiymətini
                                                            göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="future_order_show_price"
                                                                   {{ $result->future_order_show_price??'' ? 'checked' : '' }}   class="switchery-primary7">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Ön sifarişin olduğu
                                                            göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="future_order_show_orign"
                                                                   {{ $result->future_order_show_orign??'' ? 'checked' : '' }}   class="switchery-primary8">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Ön sifarişin götürə bilmə
                                                            radiusu</label>
                                                        <div class="col-lg-8">
                                                            <input name="future_order_radius" type="number" min="1"
                                                                   max="10" class="form-control"
                                                                   value="{{ $result->future_order_radius??'2' }}">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="tab-pane has-padding" id="in_order">
                                                <fieldset>
                                                    <legend>SİFARİŞİN İÇİ</legend>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Müştəriyə çatmamış qiyməti
                                                            göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="show_price_in_order"
                                                                   {{ $result->show_price_in_order??'' ? 'checked' : '' }}      class="switchery-primary9">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Müştəriyə çatmamış gözləmə
                                                            müddətini göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="show_time"
                                                                   {{ $result->show_time??'' ? 'checked' : '' }}     class="switchery-primary10">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Müştəriyə çatmamış
                                                            gediləcək yerləri göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="show_destination_in_order"
                                                                   {{ $result->show_destination_in_order??'' ? 'checked' : '' }}     class="switchery-primary11">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-lg-4">Müştəriyə çatmamış
                                                            gediləcək məsafəni göstər</label>
                                                        <div class="col-lg-8 checkbox checkbox-switcher">
                                                            <input type="checkbox" name="show_distance"
                                                                   {{ $result->show_distance??'' ? 'checked' : '' }}    class="switchery-primary12">
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="tab-pane has-padding" id="in_photo_control">
                                                <fieldset>
                                                    <legend>Fotolara Nəzarət</legend>
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="thumbnail">                                                      
                                                                    <a class="image-photo-control" href="javascript:;" >
                                                                        <img src="https://globalvoices.org/wp-content/uploads/2019/12/53317886_2320847401272564_3631416697266634752_n-1-800x450.jpg" />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="thumbnail">                                                      
                                                                    <a class="image-photo-control" href="javascript:;" >
                                                                        <img src="https://globalvoices.org/wp-content/uploads/2019/12/53317886_2320847401272564_3631416697266634752_n-1-800x450.jpg" />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="thumbnail">                                                      
                                                                    <a class="image-photo-control" href="javascript:;" >
                                                                        <img src="https://globalvoices.org/wp-content/uploads/2019/09/27423947912_6650a14c5c_o-800x450.jpg" />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="thumbnail">                                                      
                                                                    <a class="image-photo-control" href="javascript:;" >
                                                                        <img src="https://globalvoices.org/wp-content/uploads/2019/12/53317886_2320847401272564_3631416697266634752_n-1-800x450.jpg" />
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Yadda saxla <i
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


<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#imageModal">Open Modal</button>

<!-- Modal -->
<div id="imageModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
       <img id="image-modal" src="" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


    <script type="text/javascript">

        $('.image-photo-control').on('click',function(e){
            e.preventDefault();
            let imageSrc = $(this).find('img').attr('src');
            
            $('#image-modal').attr('src',imageSrc);
            $('#imageModal').modal('show'); 

        });



        var primary = document.querySelector('.switchery-primary');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary1');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary2');
        var switchery = new Switchery(primary, {color: '#2196F3'});

        // Public Order
        var primary = document.querySelector('.switchery-primary3');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary4');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary5');
        var switchery = new Switchery(primary, {color: '#2196F3'});

        //Future Order
        var primary = document.querySelector('.switchery-primary6');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary7');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary8');
        var switchery = new Switchery(primary, {color: '#2196F3'});


        //In Order
        var primary = document.querySelector('.switchery-primary9');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary10');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary11');
        var switchery = new Switchery(primary, {color: '#2196F3'});
        var primary = document.querySelector('.switchery-primary12');
        var switchery = new Switchery(primary, {color: '#2196F3'});


    </script>



@endsection