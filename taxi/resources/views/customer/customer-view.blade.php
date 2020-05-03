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
                                    {{ $result->fullName() }}                           </h6>
                            </div>

                            <a href="#" class="display-inline-block content-group-sm">
                                <img src="http://otos.ru/upload/taxi/default.png" class="img-circle img-responsive"
                                     alt="" style="width: 110px; height: 110px;">
                            </a>

                            <div class="content-group-sm">
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
                                        <div class="col-md-4">
                                            <label>Qrup</label>
                                            <input type="text" value=" {{ $result->groupName->name }}  " readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Ad</label>
                                            <input type="text" value="{{ $result->firstname }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Soyad</label>
                                            <input type="text" value="{{ $result->lastname }}" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Cinsi</label>
                                            <input type="text" value="{{ $result->gender ? 'Kişi' : 'Qadın' }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Doğum tarixi</label>
                                            <input type="text" value="{{ $result->birthday }}" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Telefon</label>
                                            <input type="text" value="{{ $result->phone }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-6">
                                            <label>Poçt adresi</label>
                                            <input type="text" value="{{ $result->email }}" readonly
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Balans</label>
                                            <input type="text" value="{{ $result->account ? number_format($result->account->balance, 2) : '' }} ₼" readonly class="form-control">
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
                                    Nəticə yoxdur
                                </div>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="transactions">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Müştəridən</h6>
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
                                                <td>{{ $tF->from_account == 1 ? 'Şirkət' : $result->fullNameWithNumber() }}</td>
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
                                <h6 class="panel-title">Müştəriyə</h6>
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
                                                <td>{{ $to->to_account == 1 ? 'Şirkət' : $result->fullNameWithNumber()  }}</td>
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
                                        @foreach ($messages as $message)
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

                    <div class="tab-pane fade" id="sms">

                        <!-- Orders history -->
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Smslər</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <div>
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th><span>Göndərən</span></th>
                                            <th><span>Nömrə</span></th>
                                            <th><span>Mesaj</span></th>
                                            <th><span>Oxunmağı</span></th>
                                            <th><span>Tarix</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($smses as $sms)
                                            <tr>
                                                <td>{{ $sms->user_id }}</td>
                                                <td>{{ $sms->number }}</td>
                                                <td>{!! $sms->message !!}</td>
                                                <td>{{ $sms->type == 1 ? 'Qəbul edidi mesajı' : $sms->type == 2 ? 'Çatdım mesajı' :  'Xüsusi mesaj' }}</td>
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


@section('script')



@endsection
