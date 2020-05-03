@extends('main.layout')
@section('content')





    <div class="page-container">
        <div class="page-content">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h5 class="panel-title">Giriş Cəhdləri</h5>
                            </div>
                            <form action="http://otos.ru/az/administrator/login_logs " name="listForm" method="get" accept-charset="utf-8">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Search by User</label>
                                                <select name="user_id" class="select-search" tabindex="-1" aria-hidden="true">
                                                    <option value="">-- Search by User --</option>
                                                    <option value="1" >Fərid Nuriyev</option>
                                                    <option value="13" >Amina Abbasova</option>
                                                    <option value="14" >Agayeva Gunay</option>
                                                    <option value="15" >Aygul Axundova</option>
                                                    <option value="16" >Leman Azmemmedova</option>
                                                    <option value="17" >Aynur Babayeva</option>
                                                    <option value="18" >Sebine Babayeva</option>
                                                    <option value="19" >Aynur Bayramova</option>
                                                    <option value="20" >Konul Dadaşova</option>
                                                    <option value="21" >Fatime Ehmedova</option>
                                                    <option value="22" >Jale Elesgerova</option>
                                                    <option value="23" >Kemale Elesgerova</option>
                                                    <option value="24" >Umid Eliyev</option>
                                                    <option value="25" >Mensure Eliyeva</option>
                                                    <option value="26" >Ulker Eliyeva</option>
                                                    <option value="28" >Cavid Elizade</option>
                                                    <option value="29" >Ellada Elizade</option>
                                                    <option value="30" >Tulay Esedova</option>
                                                    <option value="31" >Arzu Habilova</option>
                                                    <option value="32" >Sekine Haciyeva</option>
                                                    <option value="33" >Aytac Hesenova</option>
                                                    <option value="34" >Sevinc Ibrahimova</option>
                                                    <option value="35" >Nermin Ibrahimxelilova</option>
                                                    <option value="36" >Elnare Mansurova</option>
                                                    <option value="37" >konul Memmedli</option>
                                                    <option value="38" >Amaliya Memmedova</option>
                                                    <option value="39" >Guler Memmedova</option>
                                                    <option value="40" >Sevda Memmedova</option>
                                                    <option value="41" >Tugra Memmedova</option>
                                                    <option value="42" >Sevinc Mirzeyeva</option>
                                                    <option value="43" >Metanet Nerimanlı</option>
                                                    <option value="44" >Ferid Nuriyev</option>
                                                    <option value="45" >Nermin Paşayeva</option>
                                                    <option value="46" >Sehla Qafarova</option>
                                                    <option value="47" >Ruslan Rafiyev</option>
                                                    <option value="48" >Eldar Resulov</option>
                                                    <option value="49" >Nigar Rustemova</option>
                                                    <option value="50" >Rasime Sadiqova</option>
                                                    <option value="51" >Sebine Semedova</option>
                                                    <option value="52" >Sevinc Semedova</option>
                                                    <option value="53" >Tunzale Zohrabzade</option>
                                                    <option value="54" >Farhad Abdurahmanov</option>
                                                    <option value="55" >Aysel Abdurəhmanova</option>
                                                    <option value="56" >Afet Allahverdiyeva </option>
                                                    <option value="57" >Jale Agaliyeva</option>
                                                    <option value="58" >Aida Sadiqova</option>
                                                    <option value="59" >Edera Antokova</option>
                                                    <option value="60" >Orxan Asgerov</option>
                                                    <option value="61" >Babayeva Elnarə</option>
                                                    <option value="62" >Sebine  Babayeva</option>
                                                    <option value="63" >Narmin  Cavadzade</option>
                                                    <option value="64" >Intizar Ceferova</option>
                                                    <option value="65" >Könül Dadaşova</option>
                                                    <option value="66" >Ayten Ehmedova</option>
                                                    <option value="67" >Bahar Əkbərova</option>
                                                    <option value="68" >Firuze Elekberova</option>
                                                    <option value="69" >Ülkər Ələkbərova</option>
                                                    <option value="70" >Zerife Eliyeva</option>
                                                    <option value="71" >Ruslan Əsədov</option>
                                                    <option value="72" >Zumrud Ferecova</option>
                                                    <option value="73" >Aygül Fərzəliyeva</option>
                                                    <option value="74" >Sakina Hacıyeva</option>
                                                    <option value="75" >Aysel Həsənova</option>
                                                    <option value="76" >Nərmin Ibrahimxəlilova</option>
                                                    <option value="77" >Rəvanə Kərimova</option>
                                                    <option value="78" >Lətifə  Kərimzadə</option>
                                                    <option value="79" >Togrul Məmmədov</option>
                                                    <option value="80" >Nəzrin Məmmədova</option>
                                                    <option value="81" >Ilqar Mikayilov</option>
                                                    <option value="82" >Gulshen  Musayeva</option>
                                                    <option value="83" >Eldar Rəsulov</option>
                                                    <option value="84" >Sabina Səmədova</option>
                                                    <option value="85" >Elşən Umbatov</option>
                                                    <option value="86" >Vusal Ali</option>
                                                    <option value="90" >Taxipark Taxipark</option>
                                                    <option value="91" >Accounting Accounting</option>
                                                    <option value="92" >Operator Operator</option>
                                                    <option value="93" >Dispatcher Dispatcher</option>
                                                    <option value="94" >Cashier Cashier</option>
                                                    <option value="95" >Rüfət Heybətov</option>
                                                    <option value="96" >Aysel Qarayusifli</option>
                                                    <option value="97" >Nurlan Huseynov</option>
                                                    <option value="98" >Eldar Rəsulov</option>
                                                    <option value="99" >Farhad Misirli</option>
                                                    <option value="100" >Umid Elyev</option>
                                                    <option value="101" >Tulay Teymurova</option>
                                                    <option value="102" >Ferhad Misirli</option>
                                                    <option value="103" >Emin Elizade</option>
                                                    <option value="104" >test test</option>
                                                    <option value="105" >Əli Məmmədli</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>From date</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                    <input name="from_date" placeholder = "Başlama tarixi" type="text" class="form-control daterange-single"  value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>To date</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                                    <input name="to_date" placeholder = "Bitmə tarixi" type="text" class="form-control daterange-single"  value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label>Search</label>
                                            <button type="submit" class="btn btn-default btn-block"><i class="icon-search4"></i></button>
                                        </div>
                                    </div>
                                    <div>
                                        Nəticə yoxdur                                </div>
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