@extends('main.layout')
@section('content')




    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Qeyd</h5>
                            </div>
                            <form action="http://otos.ru/az/administrator/note" name="listForm" method="get" accept-charset="utf-8">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="complainant_type" class="select complainant_type" tabindex="-1" aria-hidden="true">
                                                    <option value="">Şikayətcinin növü</option>
                                                    <option  value="2">Müştəri</option>
                                                    <option  value="1">Taksi</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="complainant" value="" class="form-control complainant">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                    <input name="from_date" placeholder = "Başlama tarixi" type="text" class="form-control daterange-single"  value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                    <input name="to_date" type="text" placeholder = "Bitmə tarixi" class="form-control daterange-single"  value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default btn-block"><i class="icon-search4"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" style="border-top:1px solid #ddd">
                                            <thead>
                                            </tr>
                                            <th><a href="http://otos.ru/az/administrator/note?complainant_type=&complainat_id=&user_id=&order_id=&category_id=&guilty_id=&date=&perPage=&column_name=complainant_type&order_type=asc"><i ></i> Şikayətcinin növü</a></th>

                                            <th><a href="http://otos.ru/az/administrator/note?complainant_type=&complainat_id=&user_id=&order_id=&category_id=&guilty_id=&date=&perPage=&column_name=complainat_id&order_type=asc"><i ></i> Şikayətci</a></th>
                                            <th><a href="http://otos.ru/az/administrator/note?complainant_type=&complainat_id=&user_id=&order_id=&category_id=&guilty_id=&date=&perPage=&column_name=user_id&order_type=asc"><i ></i> İstifadəçi</a></th>
                                            <th><a href="http://otos.ru/az/administrator/note?complainant_type=&complainat_id=&user_id=&order_id=&category_id=&guilty_id=&date=&perPage=&column_name=order_id&order_type=asc"><i ></i> Sifariş</a></th>
                                            <th><a href="http://otos.ru/az/administrator/note?complainant_type=&complainat_id=&user_id=&order_id=&category_id=&guilty_id=&date=&perPage=&column_name=category_id&order_type=asc"><i ></i> Kateqoriya</a></th>
                                            <th><a href="http://otos.ru/az/administrator/note?complainant_type=&complainat_id=&user_id=&order_id=&category_id=&guilty_id=&date=&perPage=&column_name=guilty_id&order_type=asc"><i ></i> Günahkar</a></th>
                                            <th><strong>Açıqlama</strong></th>
                                            <th><a href="http://otos.ru/az/administrator/note?complainant_type=&complainat_id=&user_id=&order_id=&category_id=&guilty_id=&date=&perPage=&column_name=date&order_type=asc"><i ></i> Tarix</a></th>
                                            <th><strong>Əməliyyat</strong></th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td>Taxi</td>
                                                <td>001-Fərid Nuriyev</td>
                                                <td>
                                                    Nurlan Huseynov                                                </td>
                                                <td>0</td>
                                                <td>Şikayət</td>
                                                <td></td>
                                                <td>ooooooooooo</td>
                                                <td>2018-02-03</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default" href="http://otos.ru/az/administrator/note/update/1"><i class="icon-pencil7"></i></a>
                                                        <button type="button" class="btn btn-default deleteModal" data-id="1"><i class="icon-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                                    <div class="heading-elements">
                                <span class="heading-text header-text-footer text-semibold">
                                    <select name="perPage" class="select">
                                        <option  value="20">20</option>
                                        <option  value="50">50</option>
                                        <option  value="100">100</option>
                                        <option  value="200">200</option>
                                    </select>
                                </span>
                                    </div>
                                </div>
                            </form>                    </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection