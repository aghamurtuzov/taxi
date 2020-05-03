@extends('main.layout')
@section('content')





    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
            <div class="sidebar sidebar-main sidebar-default sidebar-separate" style="width: 280px;">
                <div class="sidebar-content">

                    <!-- User details -->
                    <div class="content-group">
                        <div class="panel-body bg-indigo-400 border-radius-top text-center"
                             style="background-image: url(http://otos.ru/assets/images/bg.png); background-size: contain;">
                            <div class="content-group-sm">
                                <h6 class="text-semibold no-margin-bottom">
                                    {{ $result->fullname() }}                            </h6>
                            </div>

                            <a href="#" class="display-inline-block content-group-sm">
                                <img src="http://otos.ru/upload/taxi/default.png" class="img-circle img-responsive"
                                     alt="" style="width: 110px; height: 110px;">
                            </a>

                            <div class="content-group-sm">
                                <span class="label label-default"> {{ $result->code }}</span>
                                <span class="label label-success">Online</span>
                            </div>

                            <div class="content-group-sm">
                                <span class="label label-default"> {{ $result->date }}</span>
                            </div>
                        </div>

                        <div class="panel no-border-top no-border-radius-top">
                            <ul class="navigation">
                                <li class="navigation-header">Navigation</li>
                                <li class="active"><a href="#profile" data-toggle="tab"><i class="icon-files-empty"></i>
                                        Profil</a></li>
                                <li><a href="#orders" data-toggle="tab"><i class="icon-cart "></i> Sifarişlər</a></li>
                                <li><a href="#transactions" data-toggle="tab"><i class="icon-coin-dollar"></i>
                                        Əməliyyatlar</a></li>
                                <li><a href="#priorityTransactions" data-toggle="tab"><i class="icon-files-empty"></i>
                                        Prioritetlər</a></li>
                                <li><a href="#messages" data-toggle="tab"><i class="icon-bell3"></i> Mesajlar</a></li>
                                <li><a href="#taxi_devices" data-toggle="tab"><i class="icon-enter5"></i> Giriş cəhtləri</a>
                                </li>
                                <li><a href="#foto_nezaret" data-toggle="tab"><i class="icon-gallery"></i> Foto nəzarət</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /user details -->
                </div>
            </div>
            <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Tab content -->
                <div class="tab-content">

                    <div class="tab-pane fade in active" id="profile">
                        <!-- Profile info -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Profile information</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Adı</label>
                                            <input type="text" value="{{ $result->firstname }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Soyadı</label>
                                            <input type="text" value="{{ $result->lastname }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Ata adı</label>
                                            <input type="text" value="{{ $result->fathername }}" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Cinsi</label>
                                            <input type="text" value="{{ $result->sex ? 'Kişi' : 'Qadın' }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Doğum günü</label>
                                            <input type="text" value="{{ $result->birthday }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Qeydiyyat ünvanı</label>
                                            <input type="text" value="{{ $result->address }}" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Mobil</label>
                                            <input type="text" value="{{ $result->phone }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Mobil 2</label>
                                            <input type="text" value="{{ $result->mobile }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>E-mail</label>
                                            <input type="text" value="{{ $result->email }}" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Balans</label>
                                            <input type="text" value="{{ $result->account ? number_format($result->account->balance, 2) : '' }} ₼" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Prioritet</label>
                                            <input type="text" value="{{ $result->priority }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Seçimlər</label>
                                            <input type="text" value="{{ $result->optionName() }}" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /profile info -->

                    </div>


                    <div class="tab-pane fade" id="orders">

                        <!-- Available hours -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Sifarişlər</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>#</span></th>
                                            <th><span>Müştəri</span></th>
                                            <th><span>Tarif</span></th>
                                            <th><span>Başlanğıc nöqtəsi</span></th>
                                            <th><span>Operator</span></th>
                                            <th><span>Qiymət</span></th>
                                            <th><span>Sifarişin qiyməti</span></th>
                                            <th><span>Gözləyir</span></th>
                                            <th><span>Status</span></th>
                                            <th><span>Tarix</span></th>

                                            <th>Əməliyyat</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1053581">1053581</a>
                                            </td>
                                            <td>994503771148</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Sebine Babayeva</td>
                                            <td>2.30</td>
                                            <td>3.31 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-22 08:43:51</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1053581"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1053581"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1053581"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1052220">1052220</a>
                                            </td>
                                            <td>994502680543</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Metanet Nerimanlı</td>
                                            <td>2.71</td>
                                            <td>4.82 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 16:10:36</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1052220"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1052220"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1052220"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1052151">1052151</a>
                                            </td>
                                            <td>994555126768</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Sebine Babayeva</td>
                                            <td>2.61</td>
                                            <td>4.46 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 15:41:54</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1052151"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1052151"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1052151"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1051955">1051955</a>
                                            </td>
                                            <td>994504247636</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Ellada Elizade</td>
                                            <td>5.90</td>
                                            <td>15.33 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 14:12:50</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051955"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051955"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051955"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1051899">1051899</a>
                                            </td>
                                            <td>994559067886</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Arzu Habilova</td>
                                            <td>2.20</td>
                                            <td>1.22 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 13:47:33</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051899"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051899"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051899"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1051720">1051720</a>
                                            </td>
                                            <td>994503179717</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Sebine Semedova</td>
                                            <td>5.52</td>
                                            <td>14.85 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 12:31:07</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051720"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051720"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051720"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1051647">1051647</a>
                                            </td>
                                            <td>994503448213</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Sebine Semedova</td>
                                            <td>4.66</td>
                                            <td>11.80 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 11:57:00</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051647"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051647"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051647"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1051549">1051549</a>
                                            </td>
                                            <td>994555390590</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Sebine Babayeva</td>
                                            <td>2.20</td>
                                            <td>2.66 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 11:15:54</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051549"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051549"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051549"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1051363">1051363</a>
                                            </td>
                                            <td>994556617010</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Elnare Mansurova</td>
                                            <td>2.26</td>
                                            <td>3.22 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 09:46:05</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051363"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051363"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051363"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1051297">1051297</a>
                                            </td>
                                            <td>994558243378</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Arzu Habilova</td>
                                            <td>3.10</td>
                                            <td>6.20 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-21 09:14:16</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051297"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051297"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051297"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1050377">1050377</a>
                                            </td>
                                            <td>994514397135</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Sevinc Ibrahimova</td>
                                            <td>4.43</td>
                                            <td>10.97 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 19:02:20</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1050377"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1050377"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1050377"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1050240">1050240</a>
                                            </td>
                                            <td>994558774013</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Tulay Teymurova</td>
                                            <td>5.30</td>
                                            <td>13.51 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 18:08:42</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1050240"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1050240"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1050240"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1050136">1050136</a>
                                            </td>
                                            <td>994507054335</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Nigar Rustemova</td>
                                            <td>4.00</td>
                                            <td>6.29 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 17:35:21</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1050136"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1050136"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1050136"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1050076">1050076</a>
                                            </td>
                                            <td>994552744900</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Elnare Mansurova</td>
                                            <td>2.50</td>
                                            <td>4.08 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 17:13:28</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1050076"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1050076"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1050076"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1049981">1049981</a>
                                            </td>
                                            <td>994513162030</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Tulay Teymurova</td>
                                            <td>4.50</td>
                                            <td>11.08 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 16:24:02</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049981"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049981"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049981"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1049901">1049901</a>
                                            </td>
                                            <td>994504621111</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Sebine Semedova</td>
                                            <td>2.59</td>
                                            <td>4.38 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 15:37:30</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049901"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049901"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049901"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1049738">1049738</a>
                                            </td>
                                            <td>994552563355</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Aynur Bayramova</td>
                                            <td>5.95</td>
                                            <td>16.21 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 14:14:27</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049738"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049738"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049738"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1049680">1049680</a>
                                            </td>
                                            <td>994702267100</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Sebine Semedova</td>
                                            <td>3.66</td>
                                            <td>8.21 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 13:49:34</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049680"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049680"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049680"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1049541">1049541</a>
                                            </td>
                                            <td>994502333302</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Leman Azmemmedova</td>
                                            <td>2.30</td>
                                            <td>3.34 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 12:41:02</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049541"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049541"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049541"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="http://otos.ru/administrator/order/view/1049496">1049496</a>
                                            </td>
                                            <td>994508823480</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>Əli Məmmədli</td>
                                            <td>2.20</td>
                                            <td>1.06 km</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitib</span></td>
                                            <td>2018-02-20 12:13:54</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049496"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049496"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049496"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="transactions">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Taksidən</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>ID</span></th>
                                            <th><span>Göndərən</span></th>
                                            <th><span>Hesabın növü</span></th>
                                            <th><span>Qəbul edən</span></th>
                                            <th><span>Hesabın növü</span></th>
                                            <th><span>İstifadəçi</span></th>
                                            <th><span>Sifariş</span></th>
                                            <th><span>Növ</span></th>
                                            <th><span>Məbləğ</span></th>
                                            <th><span>Tarix</span></th>

                                            <th><strong>Əməliyyat</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactionsFrom as $tF)
                                            <tr>
                                                <td>{{ $tF->id }}</td>
                                                <td>{{ $tF->from_account == 1 ? 'Şirkət' : $result->fullNameWithCodeAndNumber() }}</td>
                                                <td>{{ $tF->accountTypeName($tF->from_account_type) }}</td>
                                                <td>{{ $tF->to_account == 1 ? 'Şirkət' : $tF->getAccountName('accountToName') }}</td>
                                                <td>{{ $tF->accountTypeName($tF->to_account_type) }}</td>
                                                <th>{{ $tF->userName() ? $tF->userName->first_name . ' ' . $tF->userName->last_name : '' }}</th>
                                                <td>{{ $tF->order }}</td>
                                                <td>{{ $tF->typeName()}}</td>
                                                <td>{{ number_format($tF->amount, 2, '.', '') }}<span
                                                            class="azn"> AZN</span></td>
                                                <td>{{ $tF->date }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default"
                                                           href="http://otos.ru/az/administrator/transaction/return_amount/46367"><i
                                                                    class="icon-arrow-left8"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Taksiyə</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>ID</span></th>
                                            <th><span>Göndərən</span></th>
                                            <th><span>Hesabın növü</span></th>
                                            <th><span>Qəbul edən</span></th>
                                            <th><span>Hesabın növü</span></th>
                                            <th><span>İstifadəçi</span></th>
                                            <th><span>Sifariş</span></th>
                                            <th><span>Növ</span></th>
                                            <th><span>Məbləğ</span></th>
                                            <th><span>Tarix</span></th>

                                            <th><strong>Əməliyyat</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transactionsTo as $to)
                                            <tr>
                                                <td>{{ $to->id }}</td>
                                                <td>{{ $to->from_account == 1 ? 'Şirkət' : $to->getAccountName('accountFromName') }}</td>
                                                <td>{{ $to->accountTypeName($to->from_account_type) }}</td>
                                                <td>{{ $to->to_account == 1 ? 'Şirkət' : $result->fullNameWithCodeAndNumber()  }}</td>
                                                <td>{{ $to->accountTypeName($to->to_account_type) }}</td>
                                                <th>{{ $to->userName() ? $to->userName->first_name . ' ' . $to->userName->last_name : '' }}</th>
                                                <td>{{ $to->order }}</td>
                                                <td>{{ $to->typeName()}}</td>
                                                <td>{{ number_format($to->amount, 2, '.', '') }}<span
                                                            class="azn"> AZN</span></td>
                                                <td>{{ $to->date }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default"
                                                           href="http://otos.ru/az/administrator/transaction/return_amount/46367"><i
                                                                    class="icon-arrow-left8"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="priorityTransactions">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Prioritet əməliyyatı</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>
                                                <span> Prioritet</span>
                                            </th>
                                            <th>
                                                <span>Açıqlama</span>
                                            </th>
                                            <th>
                                                <span>Tarix</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($priorities as $priority)
                                            <tr>
                                                <td>{{ $priority->priority }}</td>
                                                <td>{{ $priority->description }}</td>
                                                <td>{{ $priority->date }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="messages">

                        <!-- Orders history -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Mesajlar</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>Göndərən</span></th>
                                            <th><span>Başlıq</span></th>
                                            <th><span>Mesaj</span></th>
                                            <th><span>Oxunmağı</span></th>
                                            <th><span>Tarix</span></th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($messages as $message)
                                            <tr>
                                                <td>{{ $message->user_id }}</td>
                                                <td>{{ $message->title }}</td>
                                                <td>{!! $message->message !!}</td>
                                                <td>{{ $message->read ? 'Oxunub' : 'Oxunmayıb' }}</td>
                                                <td>{{ $message->date }}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /orders history -->

                    </div>

                    <div class="tab-pane fade" id="taxi_devices">

                        <!-- Orders history -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Device</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                </div>
                            </div>
                        </div>
                        <!-- /orders history -->

                    </div>



                    <div class="tab-pane fade" id="foto_nezaret">

                        <!-- Orders history -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Foto nəzarət</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body" >
                                <div class="row">
                                    <div class="col-md-6" style="margin-bottom: 15px">
                                        <img class="taxi_img" src="https://lp-cms-production.imgix.net/2019-06/55425108.jpg?fit=crop&q=40&sharp=10&vib=20&auto=format&ixlib=react-8.6.4" width="100%" height="240" data-toggle="modal" data-target="#myModal">
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 15px">
                                        <img class="taxi_img" src="https://cdn.londonandpartners.com/assets/73295-640x360-london-skyline-ns.jpg" width="100%" height="240" data-toggle="modal" data-target="#myModal">
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 15px">
                                        <img class="taxi_img" src="https://images.unsplash.com/photo-1513635269975-59663e0ac1ad?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" width="100%" height="240" data-toggle="modal" data-target="#myModal">
                                    </div>
                                    <div class="col-md-6" style="margin-bottom: 15px">
                                        <img class="taxi_img" src="{{$result->code}}-" width="100%" height="240" data-toggle="modal" data-target="#myModal">
                                    </div>
                                </div>
                            </div>









                        </div>
                        <!-- /orders history -->

                    </div>


                </div>
                <!-- /tab content -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

@endsection




<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
               <img src="https://images.unsplash.com/photo-1505761671935-60b3a7427bad?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80" width="100%">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div> 
    </div>
</div>
</div>


@section('script')
<script>
    $(".taxi_img").click(function(){
        $(".modal-body img").attr("src",$(this).attr("src"));
    });
</script>

@endsection
