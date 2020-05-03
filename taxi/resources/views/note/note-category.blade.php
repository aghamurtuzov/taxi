@extends('main.layout')
@section('content')






    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Qeyd kateqoriyası yarat</h5>
                            </div>
                            <div class="panel-body">
                                <form action="http://otos.ru/administrator/note_category/create" class="form-horizontal" method="post" accept-charset="utf-8">
                                    <fieldset class="content-group">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Ad</label>
                                            <div class="col-lg-10">
                                                <input name="name" type="text" class="form-control" value="" placeholder="Ad">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Sıralama</label>
                                            <div class="col-lg-10">
                                                <input name="sort" type="text" class="form-control" value="" placeholder="Sıralama">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-lg-2">Status</label>
                                            <div class="col-lg-10">
                                                <select name="status" class="select">
                                                    <option  value="1">Aktiv</option>
                                                    <option selected value="0">Deaktiv</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Yarat <i class="icon-arrow-right14 position-right"></i></button>
                                    </div>

                                </form>						</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Qeydin Kateqoriyaları</h5>
                            </div>
                            <form action="http://otos.ru/az/administrator/note_category" name="listForm" method="get" accept-charset="utf-8">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" value="" class="form-control" placeholder="Reklam">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="status" class="select">
                                                    <option selected value="">-- Status seç --</option>
                                                    <option  value="1">Aktiv</option>
                                                    <option  value="0">Deaktiv</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-default btn-block"><i class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        <table class="table table-bordered table-striped table-hover">
                                            <thead>
                                            <tr>
                                                <th><a href="http://otos.ru/az/administrator/note_category?name=&code=&status=&perPage=&column_name=name&order_type=asc"><i ></i> Ad</a></th>
                                                <th><a href="http://otos.ru/az/administrator/note_category?name=&code=&status=&perPage=&column_name=sort&order_type=asc"><i ></i> Sıralama</a></th>
                                                <th><a href="http://otos.ru/az/administrator/note_category?name=&code=&status=&perPage=&column_name=status&order_type=asc"><i ></i> Status</a></th>

                                                <th>Əməliyyat</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <tr>
                                                <td>Şikayət</td>
                                                <td><span class="badge badge-flat badge-primary text-primary-600" style="border-color: rgb(255, 250, 0);">1</span></td>
                                                <td>
                                                    <div id="isActive_1" class="btn-group" style="">

                                                        <a href="#" class="statusCurrent label bg-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Aktiv <span class="caret"></span></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a type="button" class="statusToChange" data-id="1" data-status="1"><span class="status-mark bg-danger position-left"></span>Deaktiv</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div id="isDeactive_1" class="btn-group" style="display: none">

                                                        <a href="#" class="statusCurrent label bg-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Deaktiv <span class="caret"></span></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a type="button" class="statusToChange" data-id="1" data-status="0"><span class="status-mark bg-success position-left"></span>Aktiv</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default" href="http://otos.ru/az/administrator/note_category/update/1"><i class="icon-pencil7"></i></a>
                                                        <button type="button" class="btn btn-default deleteModal" data-id="1"><i class="icon-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Təklif</td>
                                                <td><span class="badge badge-flat badge-primary text-primary-600" style="border-color: rgb(10, 255, 0);">2</span></td>
                                                <td>
                                                    <div id="isActive_2" class="btn-group" style="">

                                                        <a href="#" class="statusCurrent label bg-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Aktiv <span class="caret"></span></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a type="button" class="statusToChange" data-id="2" data-status="1"><span class="status-mark bg-danger position-left"></span>Deaktiv</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div id="isDeactive_2" class="btn-group" style="display: none">

                                                        <a href="#" class="statusCurrent label bg-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Deaktiv <span class="caret"></span></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a type="button" class="statusToChange" data-id="2" data-status="0"><span class="status-mark bg-success position-left"></span>Aktiv</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default" href="http://otos.ru/az/administrator/note_category/update/2"><i class="icon-pencil7"></i></a>
                                                        <button type="button" class="btn btn-default deleteModal" data-id="2"><i class="icon-trash"></i></button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Ümumi</td>
                                                <td><span class="badge badge-flat badge-primary text-primary-600" style="border-color: rgb(-240, 255, 0);">3</span></td>
                                                <td>
                                                    <div id="isActive_3" class="btn-group" style="">

                                                        <a href="#" class="statusCurrent label bg-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Aktiv <span class="caret"></span></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a type="button" class="statusToChange" data-id="3" data-status="1"><span class="status-mark bg-danger position-left"></span>Deaktiv</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div id="isDeactive_3" class="btn-group" style="display: none">

                                                        <a href="#" class="statusCurrent label bg-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Deaktiv <span class="caret"></span></a>

                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li>
                                                                <a type="button" class="statusToChange" data-id="3" data-status="0"><span class="status-mark bg-success position-left"></span>Aktiv</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="btn btn-default" href="http://otos.ru/az/administrator/note_category/update/3"><i class="icon-pencil7"></i></a>
                                                        <button type="button" class="btn btn-default deleteModal" data-id="3"><i class="icon-trash"></i></button>
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
                            </form>					</div>
                    </div>
                </div>

            </div>
        </div>
    </div>



@endsection