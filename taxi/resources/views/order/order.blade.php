@extends('main.layout')
@section('content')

@section('script-app')

    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

@endsection


@section('addLink')
    <a href="{{ route('getOrderNew') }}"
       class="btn bg-success-400 btn-labeled btn-rounded" style="margin-top: -20px;"><b><i class="icon-plus3"></i></b>
        Əlavə et</a><br>
@endsection
<style>
    .sweet-alert input {
        display: initial;
        width: auto;
        height: auto;
        margin: auto;
    }
</style>
<div class="page-container">
    <div class="page-content">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            <h5 class="panel-title">Sifarişlər</h5>
                            <br>
                            <div class="w-100">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <select class="select-search select-search-status">
                                            <option selected value="all">Hamısı</option>
                                            <option value="0">Adi</option>
                                            <option value="600">Açıq</option>
                                            <option value="700">Ön</option>
                                            <option value="4">Tamamlanmış</option>
                                        </select>
                                    </div>
                                </div>

                                {{--                                <span class="pull-left cancel_request"--}}
                                {{--                                      style="margin-right: 20px; cursor:pointer;color:red;"><i--}}
                                {{--                                        class="icon-circle position-left opened"></i>Ləğv etmə sorğuları(<span--}}
                                {{--                                        class="cancel_request_count">{{ $cancel_request_count }}</span>)</span>--}}
                                {{--                                    <span class="pull-left" style="margin-right: 20px; cursor:pointer"><i--}}
                                {{--                                            class="icon-circle position-left future"></i> ÖN</span>--}}
                                {{--                                    <span class="pull-left" style="margin-right: 20px; cursor:pointer"><i--}}
                                {{--                                            class="icon-circle position-left operator"></i> OPERATORDAN GƏLƏN</span>--}}
                                {{--                                    <span class="pull-left" style="margin-right: 20px; cursor:pointer"><i--}}
                                {{--                                            class="icon-circle position-left "></i> GÖZLƏMƏ MƏLUMATLARI</span>--}}

                                <span class="pull-right filter" style="cursor:pointer"><i
                                        class="icon-circle position-left "></i> FİLTER</span>
                                <span class="pull-right esas" style="margin-right: 20px; cursor:pointer"><i
                                        class="icon-circle position-left"></i> ƏSAS </span>
                            </div>
                            <br>
                            <br><br>
                        </div>

                        <div class="panel-body">
                            <form
                                action="{{ route('getModuleSearch',['code'=> $module->code,'viewMain' => 'order','view'=>'order' ]) }}"
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
                                                       class="form-control" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bitiş tarixi</label>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                <input name="date_to" type="date" class="form-control "
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
                                <input type="hidden" name="perPage">
                            </form>
                            <!-- Searh Form -->
                            <hr>
                            <div>
                                <table class="table table-bordered table-striped table-hover" id="order-table">
                                    <thead>
                                    <tr>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                #</a></th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                Müştəri</a></th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                Tarif</a></th>
                                        <th style="border: 1px solid #828282;">Timer</th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                Mənbəyi</a></th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                Operator</a></th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                <i class="icon-coin-dollar"></i></a></th>

                                        <th style="border: 1px solid #828282;"><a href="javascript:void(0)"> Ünvan
                                                A</a></th>
                                        <th style="border: 1px solid #828282;"><a href="javascript:void(0)"> Ünvan
                                                Z</a></th>

                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                <i class="icon-road"></i></a></th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                Taxi</a></th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                <i class="icon-hour-glass"></i></a></th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                Status</a></th>
                                        <th style="border: 1px solid #828282;"><a
                                                href=""><i></i>
                                                Tarix</a></th>

                                        <th style="border: 1px solid #828282;">Qeyd</th>
                                        <th style="border: 1px solid #828282;">Əməliyyat</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results as $result)
                                        <tr data-id="{{ $result->id }}" data-status="{{ $result->status }}"
                                            data-status-history="{{ $result->statusHistory }}" style="background:{{ $result->bgName() }} ">
                                            <td>{{$result->id}}</td>
                                            <td>{!! $result->fullCustomerNameWithNumber() !!}</td>
                                            <td>{{$result->orderDetailName ? ($result->orderDetailName->tariff ? $result->orderDetailName->tariffName->name : '') : ''}}</td>
                                            <td class="timer">{{$result->timer}} dəq</td>
                                            <td style="text-align: center">{!!  $result->source ? '<i
                                                             class="icon-phone"></i>' : '<i
                                                             class="icon-mobile"></i>' !!}</td>
                                            <td>{!! $result->orderDetailName->userName->first_name . ' <br>' . $result->orderDetailName->userName->last_name !!}</td>
                                            <td>{{$result->orderDetailName->price}} AZN {{ $result->orderDetailName->operator_price ? '('.$result->orderDetailName->operator_price.' AZN)' : ''}}</td>
                                            <td>{{$result->orderDetailName->routeName()[0]}}</td>
                                            <td>{{$result->orderDetailName->routeName()[$result->orderDetailName->routeName()['last']]}}</td>
                                            <td>{{$result->orderDetailName->order_value}}</td>
                                            <td>{{$result->taxiName ? $result->taxiName->code : '-'}}</td>
                                            <td>{{$result->orderDetailName->timeout}}</td>
                                            @if($result->statusHistory == 40)
                                                <td class="status-text"
                                                    style="background-color:pink;color:#fff;">Sifariş ləğv edilmə
                                                    gözləyir
                                                </td>
                                            @else
                                                <td class="status-text">
                                                    @if($result->statusName() == 'searching')
                                                        <img src="{{ asset('assets/images/loader.gif') }}" width="30">
                                                    @elseif($result->statusName() == 'finished')
                                                        <i class="icon-checkmark"></i>
                                                    @else
                                                        <button
                                                                class="btn btn-{{ $result->colorName() }}">
                                                            {{$result->statusName()}}
                                                        </button>
                                                    @endif
                                                </td>
                                            @endif
                                            <td>{{$result->orderDetailName->order_date}}</td>
                                            <td>{{$result->orderDetailName->description}}</td>

                                            <td>
                                                <div class="btn-group">


                                                    <a class=" btn btn-default"
                                                       href="{{ route('getOrderView',['id' => $result->id]) }}"><i
                                                            class="icon-eye"></i></a>

                                                    @if($result->statusName() == 'finished' || $result->statusName() == 'Ləğv')

                                                    @else
                                                    <a class="edit-pencil btn btn-default"
                                                       href="{{ route('getOrderUpdate',['id' => $result->id]) }}"><i
                                                            class="icon-pencil7"></i></a>

                                                    <a class="cancel-order btn btn-default"
                                                       data-order-id="{{ $result->id }}" data-toggle="modal"
                                                       data-target="#myModal" href="javascript:;"><i
                                                            class="icon-trash"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                            <div class="heading-elements">
{{--								<span class="heading-text header-text-footer text-semibold">--}}
{{--									<select name="perPage" class="select">--}}
{{--										<option @if(isset($perPage) && $perPage == 20) selected--}}
{{--                                                @endif value="20">20</option>--}}
{{--                                        <option @if(isset($perPage) && $perPage == 50) selected--}}
{{--                                                @endif  value="50">50</option>--}}
{{--                                        <option @if(isset($perPage) && $perPage == 100) selected--}}
{{--                                                @endif  value="100">100</option>--}}
{{--                                        <option @if(isset($perPage) && $perPage == 200) selected--}}
{{--                                                @endif  value="200">200</option>--}}
{{--									</select>--}}
{{--								</span>--}}
{{--                                <div class="text-right">--}}
{{--                                    <ul class="pagination pagination-separated pull-right">--}}
{{--                                        {{ $results->links('vendor.pagination.bootstrap-4') }}--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

@if(count($results))
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3><span id="remove-order-span"></span> - nömrəli sifarişi ləğv etmək istədiyinizə
                        əminsiniz?</h3>
                </div>
                <div class="modal-body">
                    <div class="col-md-6 text-center">
                        <h3>Balans cərimələ: <Br>
                            <label class="switch">
                                <input name="is_balance_penalty" type="checkbox" value="1">
                                <span class="slider round"></span>
                            </label>
                        </h3>
                    </div>
                    <div class="col-md-6 text-center">
                        <h3>Prioritet cərimələ: <Br>
                            <label class="switch">
                                <input name="is_priority_penalty" type="checkbox" value="1">
                                <span class="slider round"></span>
                            </label>
                        </h3>
                    </div>


                </div>
                <div class="modal-footer">
                    <center>
                        @foreach($result->cancelReason() as $cr)
                            <button data-id="{{$cr->id}}"
                                    class="cancel-order-buttons btn btn-primary"> {{$cr->name}}</button>
                        @endforeach

                        <button type="button" class="btn btn-danger closee" data-dismiss="modal">Bağla</button>
                    </center>
                </div>
            </div>

        </div>
    </div>
@endif

@endsection

@section('script')
    <script>

        var myVar = setInterval(myTimer, 60000);

        function myTimer() {
            $('#order-table tbody tr').each(function () {
                let timer = parseInt($(this).find('.timer').text());
                timer += 1;
                $(this).find('.timer').text(timer + ' dəq');
            });
        }

        $('.cancel_request').on('click', function (e) {
            e.preventDefault();

            $('#order-table tbody tr').hide();

            $('#order-table tbody tr').each(function () {
                let st = $(this).attr('data-status-history');
                if (st == 40) {
                    $(this).show();
                }
            });

        });
        var order_id = '';
        var edit_pencil = '';
        var cancel_order='';
        var status_icon = ''
        $("tbody").on('click','.cancel-order',function () {
            $('input[name="is_balance_penalty"]').prop('checked',false);
            $('input[name="is_priority_penalty"]').prop('checked',false);
            $("#remove-order-span").html($(this).attr('data-order-id'));
            order_id = $(this).attr('data-order-id');
            console.log(order_id);
            cancel_order=$(this);
            edit_pencil= $(this).siblings('.edit-pencil');
            status_icon = $(this).parents('tr').find('.status-text');

        });
        $('.cancel-order-buttons').on('click', function (e) {
            e.preventDefault();


            var is_balance_penalty = '';
            var is_priority_penalty = '';
            if ($('input[name="is_balance_penalty"]').prop("checked")) {
                is_balance_penalty = 1;
            } else {
                is_balance_penalty = 0;
            }

            if ($('input[name="is_priority_penalty"]').prop("checked")) {
                is_priority_penalty = 1;
            } else {
                is_priority_penalty = 0;
            }

            $('.closee').click();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                type: 'post',
                url: '{{ route('postOrderDispetcerOrOperatorCancel') }}',
                dataType: 'json',
                data: {
                    order_id: order_id,
                    is_balance_penalty: is_balance_penalty,
                    is_priority_penalty: is_priority_penalty,
                },

                success: function (data) {
                    if (data['success']) {
                        swal({
                            title: "Silindi",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });
                        edit_pencil.hide();
                        cancel_order.hide();
                        status_icon.html('<button class="btn btn-danger">Ləğv</button>');
                        console.log(data);
                    } else {
                        swal({
                            title: "Silə bilməzsiniz",
                            text: data['message'],
                            type: "error",
                            confirmButtonColor: "#F44336"
                        });
                    }
                }
            });

        });


        $(".filter").click(function () {
            $('.search-bar').toggle();
        });
        $(".esas").click(function () {
            $('.search-bar').hide();
        });

        $('.select-search-status').on('change', function (e) {
            e.preventDefault();

            $('#order-table tbody tr').hide();


            let status = $(this).find('option:selected').val();

            if (status == 'all') {
                $('#order-table tbody tr').show();
            } else if (status == 0) {
                $('#order-table tbody tr').each(function () {
                    let _tr = $(this);
                    let st = _tr.attr('data-status');
                    if (st != 600 && st != 700 && st != 4) {
                        _tr.show();
                    }
                });
            } else {
                $('#order-table tbody tr[data-status="' + status + '"]').show();
            }

        });
        window.Echo.channel('order')
            .listen('OrderEvent', (e) => {
                var host = window.location.hostname;
                let html = '    <td>' + e.order.id + '</td>\n' +
                    '           <td>' + e.order.full_customer_phone + '</td>\n' +
                    '           <td>' + e.order.tariff_name + '</td>\n' +
                    '           <td>' + e.order.timer + ' dəq</td>\n' +
                    '           <td>' ;
                if(e.order.source == 1){
                    html+='<i class="icon-phone"></i>';
                }
                else{
                    html+='<i class="icon-mobile"></i>';
                }

                html+='</td>\n' +
                    '           <td>' + e.order.full_user_name + '</td>\n' +
                    '           <td>' + e.order.price + '</td>\n' +
                    '           <td>' + e.order.orign_name + '</td>\n' +
                    '           <td>' + e.order.destination[e.order.destination.length - 1].name + '</td>\n' +
                    '           <td>' + e.order.order_value + '</td>\n' +
                    '           <td>';
                if(e.order.taxi_code){
                    html+=e.order.taxi_code;
                }
                else{
                    html+='-';
                }
                html+= '</td>\n' +
                    '           <td>' + e.order.timeout + '</td>\n' +
                    '           <td class="status-text" >';
                if(e.order.status_text == 'searching'){
                    html+='<img src="{{ asset('assets/images/loader.gif') }}" width="30">';
                }
                else if(e.order.status_text=='finished'){
                    html+='<i class="icon-checkmark"></i>';
                }
                else{
                    html+= '<button  class="btn btn-'+e.order.color+'">'+e.order.status_text+'</button>';

                }

                html+='</td>\n' +
                    '           <td>' + e.order.date + '</td>\n' +
                    '           <td>' + e.order.description + '</td>\n' +
                    ' <td>\n' +
                    '                                                <div class="btn-group">\n' +
                    '                                                    <a class="edit-pencil btn btn-default"\n' +
                    '                                                       href="/order/update/' + e.order.id + '"><i\n' +
                    '                                                            class=" icon-pencil7"></i></a>\n' +
                    '\n' +
                    '                                                    <a class="btn btn-default"\n' +
                    '                                                          href="/order-view/' + e.order.id + '"><i\n' +
                    '                                                            class="icon-eye"></i></a>\n' +
                    '\n' +
                    '                                                    <a class="cancel-order btn btn-default"\n' +
                    '                                                       data-order-id="' + e.order.id + '" href="javascript:;" data-toggle="modal" data-target="#myModal"><i\n' +
                    '                                                            class="icon-trash"></i></a>\n' +
                    '\n' +
                    '                                                </div>\n' +
                    '                                            </td>';
                if (!e.type) {
                    $('#order-table').prepend('<tr data-id="' + e.order.id + '" data-status="' + e.order.status + '">' + html + '</tr>');
                } else {
                    $('#order-table').find('tr[data-id = "' + e.order.id + '"]').html(html);
                    $('#order-table').find('tr[data-id = "' + e.order.id + '"]').attr('data-status', e.order.status);
                }

                $('.select-search-status').trigger('change');

            });

    </script>




@endsection
