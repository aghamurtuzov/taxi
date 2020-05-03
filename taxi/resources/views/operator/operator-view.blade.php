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
                                    {{$result->first_name.' '.$result->last_name}}  </h6>
                            </div>

                            <a href="#" class="display-inline-block content-group-sm">
                                <img src="http://otos.ru/upload/taxi/default.png" class="img-circle img-responsive"
                                     alt="" style="width: 110px; height: 110px;">
                            </a>

                            <div class="content-group-sm">
                                <span class="label label-default">{{$result->sip}}</span>
                                <span class="label label-success">Online</span>
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
                                <li><a href="#messages" data-toggle="tab"><i class="icon-bell3"></i> Mesajlar</a></li>
                                <li><a href="#sms" data-toggle="tab"><i class="icon-envelop"></i> SMS</a></li>
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
                                        <div class="col-md-3">
                                            <label>İstifadəçi adı</label>
                                            <input type="text" value="{{$result->username}}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Ad</label>
                                            <input type="text" value="{{$result->first_name}}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Soyad</label>
                                            <input type="text" value="{{$result->last_name}}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Şirkət</label>
                                            <input type="text" value="{{$result->company}}" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Telefon</label>
                                            <input type="text" value="{{$result->phone}}" readonly class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>SIP Nömrə</label>
                                            <input type="text" value="{{$result->sip}}" readonly class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Email</label>
                                            <input type="text" value="{{$result->email}}" readonly class="form-control">
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
                                <h6 class="panel-title"></h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>#</span></th>
                                            <th><span>Şirkət</span></th>
                                            <th><span>Tarif</span></th>
                                            <th><span>Başlanğıc nöqtəsi</span></th>
                                            <th><span>Qiymət</span></th>
                                            <th><span>Sifarişin növü</span></th>
                                            <th><span>Sifarişin qiyməti</span></th>
                                            <th><span>Taksi</span></th>
                                            <th><span>Gözləyir</span></th>
                                            <th><span>Status</span></th>
                                            <th><span>Tarix</span></th>

                                            <th>Əməliyyat</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1051050</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>4.91</td>
                                            <td>Yol</td>
                                            <td>12.69</td>
                                            <td>002</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-21 02:39:57</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051050"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051050"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051050"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1051032</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>4.96</td>
                                            <td>Yol</td>
                                            <td>11.79</td>
                                            <td>0001</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-21 02:07:12</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1051032"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1051032"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1051032"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1050999</td>
                                            <td>994559227710</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>4.33</td>
                                            <td>Yol</td>
                                            <td>8.64</td>
                                            <td>2153</td>
                                            <td>5</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-21 01:36:25</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1050999"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1050999"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1050999"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1050962</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>4.96</td>
                                            <td>Yol</td>
                                            <td>11.79</td>
                                            <td>002</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #F44336">Ləğv edildi</span></td>
                                            <td>2018-02-21 00:00:00</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1050962"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1050962"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1050962"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1050728</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>4.96</td>
                                            <td>Yol</td>
                                            <td>11.79</td>
                                            <td>0001</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 22:03:06</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1050728"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1050728"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1050728"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1050663</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>4.96</td>
                                            <td>Yol</td>
                                            <td>11.79</td>
                                            <td>0001</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #F44336">Ləğv edildi</span></td>
                                            <td>2018-02-20 21:29:00</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1050663"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1050663"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1050663"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049982</td>
                                            <td>994555105000</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>0.00</td>
                                            <td>1721</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 00:00:00</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049982"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049982"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049982"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049676</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0002</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 13:44:51</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049676"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049676"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049676"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049672</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0001</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 00:00:00</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049672"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049672"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049672"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049667</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0001</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 13:40:21</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049667"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049667"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049667"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049663</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0002</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #F44336">Ləğv edildi</span></td>
                                            <td>2018-02-20 13:38:27</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049663"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049663"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049663"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049652</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0002</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 13:35:05</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049652"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049652"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049652"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049645</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0002</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 13:32:26</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049645"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049645"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049645"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049643</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0002</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 13:31:19</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049643"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049643"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049643"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049641</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0002</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #F44336">Ləğv edildi</span></td>
                                            <td>2018-02-20 13:30:11</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049641"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049641"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049641"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1049119</td>
                                            <td>994559227710</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>6.08</td>
                                            <td>Yol</td>
                                            <td>15.70</td>
                                            <td>1918</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-20 08:46:00</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1049119"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1049119"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1049119"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1048731</td>
                                            <td>994559227710</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>3.98</td>
                                            <td>Yol</td>
                                            <td>9.37</td>
                                            <td>55514</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-19 23:31:28</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1048731"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1048731"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1048731"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1047774</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0001</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #4CAF50">Bitdi</span></td>
                                            <td>2018-02-19 16:07:41</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1047774"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1047774"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1047774"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1047768</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td>0001</td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #F44336">Ləğv edildi</span></td>
                                            <td>2018-02-19 16:05:55</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1047768"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1047768"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1047768"><i
                                                                class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1047760</td>
                                            <td>994555239888</td>
                                            <td>Ekonom</td>
                                            <td>Zəng</td>
                                            <td>2.20</td>
                                            <td>Yol</td>
                                            <td>2.40</td>
                                            <td></td>
                                            <td>0</td>
                                            <td><span class="label" style="background: #F44336">Ləğv edildi</span></td>
                                            <td>2018-02-19 16:04:10</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/update/1047760"><i
                                                                class="icon-pencil7"></i></a>
                                                    <button type="button" class="btn btn-default deleteModal"
                                                            data-id="1047760"><i class="icon-trash"></i></button>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/order/view/1047760"><i
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
                                <h6 class="panel-title">Pul köçürmələri</h6>
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
                                            <th><span>Əməliyyatın növü</span></th>
                                            <th><span>Məbləğ</span></th>
                                            <th><span>Tarix</span></th>

                                            <th><strong>Əməliyyat</strong></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>46193</td>
                                            <td>1578-Fuad Memmedrzayev (994559443300)</td>
                                            <td>Nəğd</td>

                                            <td>1578-Fuad Memmedrzayev (994559443300)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>10.00</td>
                                            <td>2018-02-22 01:30:44</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/46193"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>46110</td>
                                            <td>2003-Baxışov Namus (994509640139)</td>
                                            <td>Nəğd</td>

                                            <td>2003-Baxışov Namus (994509640139)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>6.06</td>
                                            <td>2018-02-22 00:15:07</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/46110"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>44900</td>
                                            <td>2088-Anar Rehimov (994554549494)</td>
                                            <td>Nəğd</td>

                                            <td>2088-Anar Rehimov (994554549494)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>10.00</td>
                                            <td>2018-02-21 13:21:20</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/44900"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>44466</td>
                                            <td>2088-Anar Rehimov (994554549494)</td>
                                            <td>Nəğd</td>

                                            <td>2088-Anar Rehimov (994554549494)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>14.00</td>
                                            <td>2018-02-21 09:41:45</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/44466"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>43889</td>
                                            <td>050-Mirfazil Seyidov (994519440050)</td>
                                            <td>Nəğd</td>

                                            <td>050-Mirfazil Seyidov (994519440050)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>10.00</td>
                                            <td>2018-02-20 21:47:00</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/43889"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>43726</td>
                                            <td>0001-Kamran Nəcəfzadə (994555239888)</td>
                                            <td>Nəğd</td>

                                            <td>0001-Kamran Nəcəfzadə (994555239888)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>2.00</td>
                                            <td>2018-02-20 20:06:50</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/43726"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>43725</td>
                                            <td>0001-Kamran Nəcəfzadə (994555239888)</td>
                                            <td>Nəğd</td>

                                            <td>0001-Kamran Nəcəfzadə (994555239888)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>3.00</td>
                                            <td>2018-02-20 20:06:24</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/43725"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>43722</td>
                                            <td>0001-Kamran Nəcəfzadə (994555239888)</td>
                                            <td>Nəğd</td>

                                            <td>0001-Kamran Nəcəfzadə (994555239888)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>12.00</td>
                                            <td>2018-02-20 20:05:59</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/43722"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>42994</td>
                                            <td>0002-Ferhad Misirli (994559227710)</td>
                                            <td>Nəğd</td>

                                            <td>0002-Ferhad Misirli (994559227710)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>2.00</td>
                                            <td>2018-02-20 13:44:09</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/42994"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>42963</td>
                                            <td>1600-Famil Cavadov (994515289396)</td>
                                            <td>Nəğd</td>

                                            <td>1600-Famil Cavadov (994515289396)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>15.00</td>
                                            <td>2018-02-20 13:26:36</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/42963"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>39986</td>
                                            <td>1208-Revan Qacayev (994777550669)</td>
                                            <td>Nəğd</td>

                                            <td>1208-Revan Qacayev (994777550669)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>5.00</td>
                                            <td>2018-02-18 23:18:01</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/39986"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>39890</td>
                                            <td>55542-Savalan Ehmedov (994552157875)</td>
                                            <td>Nəğd</td>

                                            <td>55542-Savalan Ehmedov (994552157875)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>5.00</td>
                                            <td>2018-02-18 22:35:42</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/39890"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>39557</td>
                                            <td>212-Rehim Salamov (994553559428)</td>
                                            <td>Nəğd</td>

                                            <td>212-Rehim Salamov (994553559428)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>10.00</td>
                                            <td>2018-02-18 20:30:30</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/39557"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>35867</td>
                                            <td>001-Fərid Nuriyev (994555105000)</td>
                                            <td>Nəğd</td>

                                            <td>001-Fərid Nuriyev (994555105000)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>10.00</td>
                                            <td>2018-02-17 13:20:33</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/35867"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>33328</td>
                                            <td>0001-Kamran Nəcəfzadə (994555239888)</td>
                                            <td>Nəğd</td>

                                            <td>0001-Kamran Nəcəfzadə (994555239888)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>200.00</td>
                                            <td>2018-02-16 10:56:06</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/33328"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>32426</td>
                                            <td>55510-Sohmen Qarayev (994774758015)</td>
                                            <td>Nəğd</td>

                                            <td>55510-Sohmen Qarayev (994774758015)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>5.20</td>
                                            <td>2018-02-15 20:17:07</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/32426"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>29864</td>
                                            <td>001-Fərid Nuriyev (994555105000)</td>
                                            <td>Nəğd</td>

                                            <td>001-Fərid Nuriyev (994555105000)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>5.00</td>
                                            <td>2018-02-14 19:16:50</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/29864"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>29852</td>
                                            <td>88859-Araz Elesgerov (994552769836)</td>
                                            <td>Elektron</td>

                                            <td>Şirkət</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Cərimə</td>
                                            <td>-10.00</td>
                                            <td>2018-02-14 19:11:19</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/29852"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>28990</td>
                                            <td>2107-Isgender Isgenderov (994558941785)</td>
                                            <td>Nəğd</td>

                                            <td>2107-Isgender Isgenderov (994558941785)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>7.00</td>
                                            <td>2018-02-14 12:17:39</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/28990"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>28986</td>
                                            <td>2129-Ilkin Eliyev (994775225543)</td>
                                            <td>Nəğd</td>

                                            <td>2129-Ilkin Eliyev (994775225543)</td>
                                            <td>Elektron</td>
                                            <th>Fərid Nuriyev</th>
                                            <td>0</td>
                                            <td>Balans</td>
                                            <td>5.00</td>
                                            <td>2018-02-14 12:17:22</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/az/administrator/transaction/return_amount/28986"><i
                                                                class="icon-arrow-left8"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                                            <th><span>Təyinatın növü</span></th>
                                            <th><span>Təyinat</span></th>
                                            <th><span>Başlıq</span></th>
                                            <th><span>Mesaj</span></th>
                                            <th><span>Oxunamğı</span></th>
                                            <th><span>Tarix</span></th>

                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($messages as $message)
                                            <tr>
                                                <td>{{ $message->destination_type == 1 ? 'Taksi' : 'Müştəri' }}</td>
                                                <td>{{ $message->destination_type == 1 ? $message->getTaxiOrCustomerName(1) : $message->getTaxiOrCustomerName(2)  }}</td>
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

                    <div class="tab-pane fade" id="sms">

                        <!-- Orders history -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Sms</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover"
                                           style="border-top:1px solid #ddd">
                                        <thead>
                                        <tr>
                                            <th><span>Sifariş nömrəsi</span></th>

                                            <th><span>Qəbul edənin növü</span></th>

                                            <th><span>Qəbul edən</span></th>

                                            <th><span>Smsin növü</span></th>

                                            <th><strong>Mesaj</strong></th>

                                            <th><span>Tarix</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($smses as $sms)
                                            <tr>
                                                <td>{{ $sms->order_id }}</td>
                                                <td>{{ $sms->destination_type == 1 ? 'Taksi' : 'Müştəri' }}</td>
                                                <td>{{ $sms->destination_type == 1 ? $sms->getTaxiOrCustomerName(1) : $sms->getTaxiOrCustomerName(2)  }}</td>
                                                <td>{{ $sms->type == 1 ? 'Qəbul edidi mesajı' : $sms->type == 2 ? 'Çatdım mesajı' :  'Xüsusi mesaj' }}</td>
                                                <td>{!! $sms->message !!}</td>
                                                <td>{{ $sms->date }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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