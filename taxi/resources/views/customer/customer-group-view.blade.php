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
                                    {{ $result->name }}                            </h6>
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
                                <li><a href="#profile" data-toggle="tab"><i class="icon-files-empty"></i>
                                        Profil</a></li>
                                <li><a href="#customers" data-toggle="tab"><i class="icon-people"></i> Müştərilər</a>
                                </li>
                                <li><a href="#transactions" data-toggle="tab"><i class="icon-coin-dollar"></i>
                                        Əməliyyatlar</a></li>
                                <li class="active"><a href="#orders" data-toggle="tab"><i class="icon-cart"></i>
                                        Sifarişlər</a></li>
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

                    <div class="tab-pane fade" id="profile">
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
                                            <label>Ad</label>
                                            <input type="text" value="{{ $result->name }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Endirim</label>
                                            <input type="text" value="{{ $result->discount }}" readonly
                                                   class="form-control">
                                        </div>
                                        <div class="col-md-3">
                                            <label>Status</label>
                                            <br>
                                            <label href="#"
                                                   class="label bg-success">{{ $result->status ? 'Aktiv' : 'Aktiv deyil' }}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Balans</label>
                                            <input type="text"
                                                   value="{{ $result->account ? number_format($result->account->balance, 2) : '' }} ₼"
                                                   readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /profile info -->

                    </div>

                    <div class="tab-pane fade" id="customers">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Müştərilər</h6>
                                <div class="heading-elements">
                                </div>
                            </div>

                            <div class="panel-body">
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        <th><span>Ad</span></th>
                                        <th><span>Soyad</span></th>
                                        <th><span>Doğum tarixi</span></th>
                                        <th><span>Qrup</span></th>
                                        <th><span>Cinsi</span></th>
                                        <th><span>Elektron Poçt</span></th>
                                        <th><span>Telefon</span></th>
                                        <th><span>Balans</span></th>
                                        <th><span>Status</span></th>
                                        <th><span>Bloklanması</span></th>

                                        <th><strong>Əməliyyat</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->firstname }}</td>
                                            <td>{{ $customer->lastname }}</td>
                                            <td>{{ $customer->birthday }}</td>
                                            <td>{{ $customer->groupName->name }}</td>
                                            <td>{{ $customer->gender ? 'Kişi' : 'Qadın' }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>0.00</td>
                                            <td>
                                                <label
                                                    class="label bg-success">{{ $customer->status ? 'Aktiv' : 'Aktiv deyil' }}</label>
                                            </td>
                                            <td>
                                                <label
                                                    class="label bg-success">{{ $customer->status ? 'Bloklanıb' : 'Bloklanmayıb' }}</label>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/customer/update/23229"><i
                                                            class="icon-pencil7"></i></a>
                                                    <a class="btn btn-default"
                                                       href="http://otos.ru/administrator/customer/profile/23229"><i
                                                            class="icon-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /available hours -->

                    </div>

                    <div class="tab-pane fade" id="transactions">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Müştəri Qrupundan</h6>
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
                                                <td>{{ $tF->from_account == 1 ? 'Şirkət' : $result->name }}</td>
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
                                <h6 class="panel-title">Müştəri Qrupuna</h6>
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
                                                <td>{{ $to->to_account == 1 ? 'Şirkət' : $result->name  }}</td>
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


                    <div class="tab-pane fade in active" id="orders">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h6 class="panel-title">Sifarişlər <br>Yekun məbləğ: <span class="final_count">20</span> AZN</h6>
                                <div class="heading-elements">
                                    <span class="pull-right filter" style="cursor:pointer"><i
                                            class="icon-circle position-left "></i> FİLTER</span>
                                </div>
                            </div>

                            <div class="panel-body">

                                <form
                                    action="{{ route('getCustomerGroupOrdersSearch',['id' => $result->id]) }}"
                                    name="listForm" method="get" accept-charset="utf-8">
                                    @csrf

                                    <div class="row search-bar" style="display: none">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Telefon</label>
                                                <input type="text" name="customer_phone" value="" class="form-control"
                                                       placeholder="Telefon">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Taksinin tabeli</label>
                                                <input type="text" name="taxi_id" value="" class="form-control preventEnter"
                                                       placeholder="Taksinin tabeli">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tarif</label>
                                                <select name="tariff" class="select-search">
                                                    <option value="">-- Seçim et --</option>
                                                    @foreach($tariffs as $tariff)
                                                        <option value="{{$tariff->id}}">{{$tariff->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="select-search">
                                                    <option selected value="">-- Seçim et --</option>
                                                    <option value="0">İcra edilmədi</option>
                                                    <option value="1">Gözləyir</option>
                                                    <option value="2">Qəbul edildi</option>
                                                    <option value="3">Çatdı</option>
                                                    <option value="4">Bitdi</option>
                                                    <option value="5">Ləğv edildi</option>
                                                    <option value="8">Müştəri götürüldü</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Başlangıc tarixi</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                    <input name="date_from" type="date"
                                                           class="form-control " value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Bitiş tarixi</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                    <input name="date_to" type="date" class="form-control"
                                                           value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Minimum Qiymət</label>
                                                <input type="text" name="price_min" value="" class="form-control"
                                                       placeholder="Minimum Qiymət">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Maksimum Qiymət</label>
                                                <input type="text" name="price_max" value="" class="form-control"
                                                       placeholder="Maksimum Qiymət">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Sifarişin növü</label>
                                                <select name="order_order_type" class="select-search">
                                                    <option value="">-- Seçim et --</option>
                                                    <option value="1">Adi</option>
                                                    <option value="2">Vaxt</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Başlangıc dəyər (km/saat)</label>
                                                <input type="text" name="order_value_from" value="" class="form-control"
                                                       placeholder="Başlangıc dəyər (km/saat)">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Son dəyər (km/saat)</label>
                                                <input type="text" name="order_value_to" value="" class="form-control"
                                                       placeholder="Son dəyər (km/saat)">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Ödəmə</label>
                                                <select name="payment_method" class="select-search">
                                                    <option value="">-- Seçim et --</option>
                                                    <option value="1">Nəğd</option>
                                                    <option value="2">Nəğdsiz</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="address" value="" class="form-control"
                                                       placeholder="Ünvan">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="order_id" value="" class="form-control"
                                                       placeholder="Sifariş ID">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row search-bar" style="display: none">
                                        <div class="col-md-12 text-center">
                                            <button type="submit" class="btn btn-default btn-block"><i
                                                    class="icon-search4"></i></button>
                                        </div>
                                    </div>

                                </form>
                                <!-- Searh Form -->
                                <hr>


                                <div>
                                    <table class="table table-bordered table-striped table-hover" id="order-table">
                                        <thead>
                                        <tr>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    #</a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    Müştəri</a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    Tarif</a></th>
                                            <th style="border: 1px solid #828282;">Timer</th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    Mənbəyi</a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    Operator</a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    <i class="icon-coin-dollar"></i></a></th>

                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"> Ünvan
                                                    A</a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"> Ünvan
                                                    Z</a></th>

                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    <i class="icon-road"></i></a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    Taxi</a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    <i class="icon-hour-glass"></i></a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    Status</a></th>
                                            <th style="border: 1px solid #828282;"><a href="javascript:void(0)"><i></i>
                                                    Tarix</a></th>

                                            <th style="border: 1px solid #828282;">Qeyd</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($results as $order)
                                            <tr data-id="{{ $order->id }}" data-status="{{ $order->status }}"
                                                data-status-history="{{ $order->statusHistory }}">
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->fullCustomerNameWithNumber()}}</td>
                                                <td>{{$order->orderDetailName ? ($order->orderDetailName->tariff ? $order->orderDetailName->tariffName->name : '') : ''}}</td>
                                                <td>-</td>
                                                <td>{!!  $order->source ? '<i
                                                             class="icon-phone"></i>' : '<i
                                                             class="icon-mobile"></i>' !!}</td>
                                                <td>{{$order->orderDetailName->userName->first_name . ' ' . $order->orderDetailName->userName->last_name}}</td>
                                                <td class="price">{{$order->orderDetailName->price}} AZN</td>
                                                <td>{{$order->orderDetailName->routeName()[0]}}</td>
                                                <td>{{$order->orderDetailName->routeName()[$order->orderDetailName->routeName()['last']]}}</td>
                                                <td>{{$order->orderDetailName->order_value}}</td>
                                                <td>{{$order->taxiName ? $order->fullTaxiNameWithCodeAndNumber() : 'Taksi təyin olunmayıb'}}</td>
                                                <td>{{$order->orderDetailName->timeout}}</td>
                                                @if($order->statusHistory == 40)
                                                    <td class="status-text"
                                                        style="background-color:pink;color:#fff;">Sifariş ləğv edilmə
                                                        gözləyir
                                                    </td>
                                                @else
                                                    <td class="status-text"
                                                        style="background-color: {{ $order->colorName() }};color:#fff;">{{$order->statusName()}}</td>
                                                @endif
                                                <td>{{$order->orderDetailName->order_date}}</td>
                                                <td>{{$order->description}}</td>

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
                        </div>


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

    <script>
        $(".filter").click(function () {
            $('.search-bar').toggle();
        });

        var sum = 0;
        // iterate through each td based on class and add the values
        $(".price").each(function() {

            var myvall = $(this).text() * 1;
            // add only if the value is number

                sum += myvall;

        });
        $('.final_count').html(sum);
    </script>

@endsection
