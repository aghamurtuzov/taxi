@extends('main.layout')
@section('content')





    <div class="page-container" style="min-height:276.1171875px">
        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
                <!-- Bordered striped table -->
                <div class="panel panel-white">

                    <div class="panel-heading">
                        <h5 class="panel-title">Taxilər</h5>
                    </div>

                    <form action="http://otos.ru/az/administrator/taxi" name="listForm" method="get"
                          accept-charset="utf-8">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="number" value="" class="form-control"
                                               placeholder="Nömrə">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="color" value="" class="form-control"
                                               placeholder="Rəng">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" min="0" name="from_year" value="" class="form-control"
                                               placeholder="Başlama İli">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="number" min="0" name="to_year" value="" class="form-control"
                                               placeholder="Bitmə İli">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="brand"
                                                class="select-search form-control auto_brand select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option selected="" value="">-- Marka --</option>
                                            <option value="2">ACG Cars</option>
                                            <option value="3">Acura</option>
                                            <option value="6">Aston Martin</option>
                                            <option value="7">Audi</option>
                                            <option value="9">BMW</option>
                                            <option value="10">BMW Alpina</option>
                                            <option value="11">BYD</option>
                                            <option value="12">Baic</option>
                                            <option value="13">Bentley</option>
                                            <option value="14">Brilliance</option>
                                            <option value="16">Buick</option>
                                            <option value="18">Cadillac</option>
                                            <option value="21">Changan</option>
                                            <option value="22">Chery</option>
                                            <option value="23">Chevrolet</option>
                                            <option value="24">Chrysler</option>
                                            <option value="25">Citroen</option>
                                            <option value="27">Daewoo</option>
                                            <option value="28">Daihatsu</option>
                                            <option value="31">Dodge</option>
                                            <option value="32">DongFeng</option>
                                            <option value="34">FAW</option>
                                            <option value="35">Fiat</option>
                                            <option value="36">Ford</option>
                                            <option value="38">GAC</option>
                                            <option value="39">GEM Cars</option>
                                            <option value="40">GIBBS</option>
                                            <option value="41">GMC</option>
                                            <option value="42">Gabro</option>
                                            <option value="43">Gaz</option>
                                            <option value="44">Geely</option>
                                            <option value="46">Great Wall</option>
                                            <option value="47">HOWO</option>
                                            <option value="48">Hamtaz</option>
                                            <option value="49">Haojue</option>
                                            <option value="50">Harley-Davidson</option>
                                            <option value="51">Haval</option>
                                            <option value="52">Hisun</option>
                                            <option value="53">Honda</option>
                                            <option value="54">Hummer</option>
                                            <option value="55">Hyundai</option>
                                            <option value="56">IJ</option>
                                            <option value="58">Infiniti</option>
                                            <option value="59">Iran Khodro</option>
                                            <option value="60">Isuzu</option>
                                            <option value="61">ItalCar</option>
                                            <option value="62">Iveco</option>
                                            <option value="63">JAC</option>
                                            <option value="64">JMC</option>
                                            <option value="65">Jaguar</option>
                                            <option value="66">Jeep</option>
                                            <option value="67">Jiajue</option>
                                            <option value="68">Jonway</option>
                                            <option value="70">KTM</option>
                                            <option value="71">KamAz</option>
                                            <option value="72">Kawasaki</option>
                                            <option value="73">Kia</option>
                                            <option value="74">Kinroad</option>
                                            <option value="75">KrAZ</option>
                                            <option value="76">LADA (VAZ)</option>
                                            <option value="77">Land Rover</option>
                                            <option value="78">Lexus</option>
                                            <option value="79">Lifan</option>
                                            <option value="80">Lincoln</option>
                                            <option value="81">LuAz</option>
                                            <option value="82">MAN</option>
                                            <option value="83">MAZ</option>
                                            <option value="84">MG</option>
                                            <option value="85">Marshell</option>
                                            <option value="86">Maserati</option>
                                            <option value="87">Mazda</option>
                                            <option value="88">Megelli</option>
                                            <option value="89">Mercedes</option>
                                            <option value="90">Mercedes-Maybach</option>
                                            <option value="91">Mini</option>
                                            <option value="92">Minsk</option>
                                            <option value="93">Mitsubishi</option>
                                            <option value="94">Moskvich</option>
                                            <option value="95">Nissan</option>
                                            <option value="96">Opel</option>
                                            <option value="97">PAZ</option>
                                            <option value="98">Paykan</option>
                                            <option value="99">Peugeot</option>
                                            <option value="100">Plymouth</option>
                                            <option value="101">Polaris</option>
                                            <option value="102">Pontiac</option>
                                            <option value="103">Porsche</option>
                                            <option value="104">RAF</option>
                                            <option value="105">Renault</option>
                                            <option value="106">Rolls-Royce</option>
                                            <option value="107">Rover</option>
                                            <option value="108">SEAT</option>
                                            <option value="109">Saab</option>
                                            <option value="110">Saipa</option>
                                            <option value="111">Saturn</option>
                                            <option value="112">Scania</option>
                                            <option value="116">Skoda</option>
                                            <option value="118">Smart</option>
                                            <option value="119">Ssang Yong</option>
                                            <option value="120">Subaru</option>
                                            <option value="121">Suzuki</option>
                                            <option value="123">Tesla</option>
                                            <option value="124">Tofas</option>
                                            <option value="125">Toyota</option>
                                            <option value="129">Volkswagen</option>
                                            <option value="130">Volvo</option>
                                            <option value="134">ZAZ</option>
                                            <option value="135">Samand</option>
                                            <option value="136">London Taxis</option>
                                            <option value="144">Dacia</option>
                                            <option value="145">Rexton</option>
                                            <option value="146">AzSamand</option>
                                            <option value="147">Ravon</option>
                                        </select><span class="select2 select2-container select2-container--default"
                                                       dir="ltr" style="width: 100%;"><span class="selection"><span
                                                        class="select2-selection select2-selection--single"
                                                        role="combobox" aria-haspopup="true" aria-expanded="false"
                                                        tabindex="0" aria-labelledby="select2-brand-ny-container"><span
                                                            class="select2-selection__rendered"
                                                            id="select2-brand-ny-container" title="-- Marka --">-- Marka --</span><span
                                                            class="select2-selection__arrow" role="presentation"><b
                                                                role="presentation"></b></span></span></span><span
                                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="model"
                                                class="select-search form-control auto_model select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option value="">-- Model --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="body" class="select-search form-control select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option selected="" value="">-- Ban Növü --</option>
                                            <option value="1">Avtobus</option>
                                            <option value="3">Furqon</option>
                                            <option value="4">Hetçbek</option>
                                            <option value="5">Kabrio</option>
                                            <option value="6">Kupe</option>
                                            <option value="7">Mikroavtobus</option>
                                            <option value="8">Minivan</option>
                                            <option value="9">Offroader / SUV</option>
                                            <option value="10">Pikap</option>
                                            <option value="12">Sedan</option>
                                            <option value="13">Universal</option>
                                            <option value="14">Van</option>
                                            <option value="15">Yük maşını</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="fuel" class="select-search form-control select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option selected="" value="">-- Yanacaq --</option>
                                            <option value="1">Benzin</option>
                                            <option value="2">Dizel</option>
                                            <option value="3">Qaz</option>
                                            <option value="4">Elektro</option>
                                            <option value="5">Hibrid</option>
                                            <option value="12">ee</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="tariff"
                                                class="select-search form-control select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option selected="" value="">-- Tarif --</option>
                                            <option value="1">Ekonom</option>
                                            <option value="3">Biznes</option>
                                            <option value="4">Minivan</option>
                                            <option value="5">Furqon</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="category"
                                                class="select-search form-control select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option selected="" value="">-- Kateqoriya --</option>
                                            <option value="1">Köhnə sürücülər</option>
                                            <option value="2">Reklamlı+şahmat</option>
                                            <option value="3">Adi sürücülər</option>
                                            <option value="4">İdarə heyəti</option>
                                            <option value="5">Reklam
                                            </option>
                                            <option value="6">Şahmat
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="driver_language"
                                                class="select-search form-control select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option selected="" value="">-- Dil --</option>
                                            <option value="1">Azərbaycan dili</option>
                                            <option value="2">Rus dili</option>
                                            <option value="3">Türk dili</option>
                                            <option value="4">Ərəb dili</option>
                                            <option value="5">İngilis dili</option>
                                            <option value="6">İspan dili</option>
                                            <option value="7">Alman dili</option>
                                            <option value="8">Fransız dili</option>
                                            <option value="11">Yunan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="option"
                                                class="select-search form-control select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option selected="" value="">-- Seçim --</option>
                                            <option value="1">Kondisioner</option>
                                            <option value="2">Wi-Fi</option>
                                            <option value="3">Smooking</option>
                                            <option value="8">Kuryer</option>
                                            <option value="9">GPS</option>
                                            <option value="10">Uşaq kreslosu</option>
                                            <option value="11">Heyvan daşıma</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="fullname" value="" class="form-control"
                                               placeholder="Tam adı">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="code" value="" class="form-control"
                                               placeholder="Tabel nömrəsi">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="phone" value="" class="form-control"
                                               placeholder="Telefon">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="status" class="select-fixed-single select2-hidden-accessible"
                                                tabindex="-1" aria-hidden="true">
                                            <option selected="" value="">-- Status --</option>
                                            <option value="1">Sifarişdə</option>
                                            <option value="0">Boş</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" name="from_date" value=""
                                                   class="form-control daterange-single picker__input"
                                                   placeholder="Başlama Tarixi" readonly="" id="P1732968584"
                                                   aria-haspopup="true" aria-expanded="false" aria-readonly="false"
                                                   aria-owns="P1732968584_root">
                                            <div class="picker" id="P1732968584_root" aria-hidden="true">
                                                <div class="picker__holder" tabindex="-1">
                                                    <div class="picker__frame">
                                                        <div class="picker__wrap">
                                                            <div class="picker__box">
                                                                <div class="picker__header">
                                                                    <div class="picker__month">October</div>
                                                                    <div class="picker__year">2019</div>
                                                                    <div class="picker__nav--prev" data-nav="-1"
                                                                         role="button" aria-controls="P1732968584_table"
                                                                         title="Previous month"></div>
                                                                    <div class="picker__nav--next" data-nav="1"
                                                                         role="button" aria-controls="P1732968584_table"
                                                                         title="Next month"></div>
                                                                </div>
                                                                <table class="picker__table" id="P1732968584_table"
                                                                       role="grid" aria-controls="P1732968584"
                                                                       aria-readonly="true">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1569700800000"
                                                                                 role="gridcell"
                                                                                 aria-label="29 September, 2019">29
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1569787200000"
                                                                                 role="gridcell"
                                                                                 aria-label="30 September, 2019">30
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus picker__day--today picker__day--highlighted"
                                                                                 data-pick="1569873600000"
                                                                                 role="gridcell"
                                                                                 aria-label="1 October, 2019"
                                                                                 aria-activedescendant="true">1
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1569960000000"
                                                                                 role="gridcell"
                                                                                 aria-label="2 October, 2019">2
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570046400000"
                                                                                 role="gridcell"
                                                                                 aria-label="3 October, 2019">3
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570132800000"
                                                                                 role="gridcell"
                                                                                 aria-label="4 October, 2019">4
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570219200000"
                                                                                 role="gridcell"
                                                                                 aria-label="5 October, 2019">5
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570305600000"
                                                                                 role="gridcell"
                                                                                 aria-label="6 October, 2019">6
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570392000000"
                                                                                 role="gridcell"
                                                                                 aria-label="7 October, 2019">7
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570478400000"
                                                                                 role="gridcell"
                                                                                 aria-label="8 October, 2019">8
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570564800000"
                                                                                 role="gridcell"
                                                                                 aria-label="9 October, 2019">9
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570651200000"
                                                                                 role="gridcell"
                                                                                 aria-label="10 October, 2019">10
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570737600000"
                                                                                 role="gridcell"
                                                                                 aria-label="11 October, 2019">11
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570824000000"
                                                                                 role="gridcell"
                                                                                 aria-label="12 October, 2019">12
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570910400000"
                                                                                 role="gridcell"
                                                                                 aria-label="13 October, 2019">13
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570996800000"
                                                                                 role="gridcell"
                                                                                 aria-label="14 October, 2019">14
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571083200000"
                                                                                 role="gridcell"
                                                                                 aria-label="15 October, 2019">15
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571169600000"
                                                                                 role="gridcell"
                                                                                 aria-label="16 October, 2019">16
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571256000000"
                                                                                 role="gridcell"
                                                                                 aria-label="17 October, 2019">17
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571342400000"
                                                                                 role="gridcell"
                                                                                 aria-label="18 October, 2019">18
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571428800000"
                                                                                 role="gridcell"
                                                                                 aria-label="19 October, 2019">19
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571515200000"
                                                                                 role="gridcell"
                                                                                 aria-label="20 October, 2019">20
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571601600000"
                                                                                 role="gridcell"
                                                                                 aria-label="21 October, 2019">21
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571688000000"
                                                                                 role="gridcell"
                                                                                 aria-label="22 October, 2019">22
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571774400000"
                                                                                 role="gridcell"
                                                                                 aria-label="23 October, 2019">23
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571860800000"
                                                                                 role="gridcell"
                                                                                 aria-label="24 October, 2019">24
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571947200000"
                                                                                 role="gridcell"
                                                                                 aria-label="25 October, 2019">25
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572033600000"
                                                                                 role="gridcell"
                                                                                 aria-label="26 October, 2019">26
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572120000000"
                                                                                 role="gridcell"
                                                                                 aria-label="27 October, 2019">27
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572206400000"
                                                                                 role="gridcell"
                                                                                 aria-label="28 October, 2019">28
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572292800000"
                                                                                 role="gridcell"
                                                                                 aria-label="29 October, 2019">29
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572379200000"
                                                                                 role="gridcell"
                                                                                 aria-label="30 October, 2019">30
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572465600000"
                                                                                 role="gridcell"
                                                                                 aria-label="31 October, 2019">31
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572552000000"
                                                                                 role="gridcell"
                                                                                 aria-label="1 November, 2019">1
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572638400000"
                                                                                 role="gridcell"
                                                                                 aria-label="2 November, 2019">2
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572724800000"
                                                                                 role="gridcell"
                                                                                 aria-label="3 November, 2019">3
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572811200000"
                                                                                 role="gridcell"
                                                                                 aria-label="4 November, 2019">4
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572897600000"
                                                                                 role="gridcell"
                                                                                 aria-label="5 November, 2019">5
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572984000000"
                                                                                 role="gridcell"
                                                                                 aria-label="6 November, 2019">6
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1573070400000"
                                                                                 role="gridcell"
                                                                                 aria-label="7 November, 2019">7
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1573156800000"
                                                                                 role="gridcell"
                                                                                 aria-label="8 November, 2019">8
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1573243200000"
                                                                                 role="gridcell"
                                                                                 aria-label="9 November, 2019">9
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="picker__footer">
                                                                    <button class="picker__button--today" type="button"
                                                                            data-pick="1569873600000" disabled=""
                                                                            aria-controls="P1732968584">Bugun
                                                                    </button>
                                                                    <button class="picker__button--clear" type="button"
                                                                            data-clear="1" disabled=""
                                                                            aria-controls="P1732968584">Temizle
                                                                    </button>
                                                                    <button class="picker__button--close" type="button"
                                                                            data-close="true" disabled=""
                                                                            aria-controls="P1732968584">Bagla
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="from_date_submit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="icon-calendar22"></i></span>
                                            <input type="text" name="to_date" value=""
                                                   class="form-control daterange-single picker__input"
                                                   placeholder="Bitmə Tarixi" readonly="" id="P1228651169"
                                                   aria-haspopup="true" aria-expanded="false" aria-readonly="false"
                                                   aria-owns="P1228651169_root">
                                            <div class="picker" id="P1228651169_root" aria-hidden="true">
                                                <div class="picker__holder" tabindex="-1">
                                                    <div class="picker__frame">
                                                        <div class="picker__wrap">
                                                            <div class="picker__box">
                                                                <div class="picker__header">
                                                                    <div class="picker__month">October</div>
                                                                    <div class="picker__year">2019</div>
                                                                    <div class="picker__nav--prev" data-nav="-1"
                                                                         role="button" aria-controls="P1228651169_table"
                                                                         title="Previous month"></div>
                                                                    <div class="picker__nav--next" data-nav="1"
                                                                         role="button" aria-controls="P1228651169_table"
                                                                         title="Next month"></div>
                                                                </div>
                                                                <table class="picker__table" id="P1228651169_table"
                                                                       role="grid" aria-controls="P1228651169"
                                                                       aria-readonly="true">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1569700800000"
                                                                                 role="gridcell"
                                                                                 aria-label="29 September, 2019">29
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1569787200000"
                                                                                 role="gridcell"
                                                                                 aria-label="30 September, 2019">30
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus picker__day--today picker__day--highlighted"
                                                                                 data-pick="1569873600000"
                                                                                 role="gridcell"
                                                                                 aria-label="1 October, 2019"
                                                                                 aria-activedescendant="true">1
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1569960000000"
                                                                                 role="gridcell"
                                                                                 aria-label="2 October, 2019">2
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570046400000"
                                                                                 role="gridcell"
                                                                                 aria-label="3 October, 2019">3
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570132800000"
                                                                                 role="gridcell"
                                                                                 aria-label="4 October, 2019">4
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570219200000"
                                                                                 role="gridcell"
                                                                                 aria-label="5 October, 2019">5
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570305600000"
                                                                                 role="gridcell"
                                                                                 aria-label="6 October, 2019">6
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570392000000"
                                                                                 role="gridcell"
                                                                                 aria-label="7 October, 2019">7
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570478400000"
                                                                                 role="gridcell"
                                                                                 aria-label="8 October, 2019">8
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570564800000"
                                                                                 role="gridcell"
                                                                                 aria-label="9 October, 2019">9
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570651200000"
                                                                                 role="gridcell"
                                                                                 aria-label="10 October, 2019">10
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570737600000"
                                                                                 role="gridcell"
                                                                                 aria-label="11 October, 2019">11
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570824000000"
                                                                                 role="gridcell"
                                                                                 aria-label="12 October, 2019">12
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570910400000"
                                                                                 role="gridcell"
                                                                                 aria-label="13 October, 2019">13
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1570996800000"
                                                                                 role="gridcell"
                                                                                 aria-label="14 October, 2019">14
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571083200000"
                                                                                 role="gridcell"
                                                                                 aria-label="15 October, 2019">15
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571169600000"
                                                                                 role="gridcell"
                                                                                 aria-label="16 October, 2019">16
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571256000000"
                                                                                 role="gridcell"
                                                                                 aria-label="17 October, 2019">17
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571342400000"
                                                                                 role="gridcell"
                                                                                 aria-label="18 October, 2019">18
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571428800000"
                                                                                 role="gridcell"
                                                                                 aria-label="19 October, 2019">19
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571515200000"
                                                                                 role="gridcell"
                                                                                 aria-label="20 October, 2019">20
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571601600000"
                                                                                 role="gridcell"
                                                                                 aria-label="21 October, 2019">21
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571688000000"
                                                                                 role="gridcell"
                                                                                 aria-label="22 October, 2019">22
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571774400000"
                                                                                 role="gridcell"
                                                                                 aria-label="23 October, 2019">23
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571860800000"
                                                                                 role="gridcell"
                                                                                 aria-label="24 October, 2019">24
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1571947200000"
                                                                                 role="gridcell"
                                                                                 aria-label="25 October, 2019">25
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572033600000"
                                                                                 role="gridcell"
                                                                                 aria-label="26 October, 2019">26
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572120000000"
                                                                                 role="gridcell"
                                                                                 aria-label="27 October, 2019">27
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572206400000"
                                                                                 role="gridcell"
                                                                                 aria-label="28 October, 2019">28
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572292800000"
                                                                                 role="gridcell"
                                                                                 aria-label="29 October, 2019">29
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572379200000"
                                                                                 role="gridcell"
                                                                                 aria-label="30 October, 2019">30
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--infocus"
                                                                                 data-pick="1572465600000"
                                                                                 role="gridcell"
                                                                                 aria-label="31 October, 2019">31
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572552000000"
                                                                                 role="gridcell"
                                                                                 aria-label="1 November, 2019">1
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572638400000"
                                                                                 role="gridcell"
                                                                                 aria-label="2 November, 2019">2
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572724800000"
                                                                                 role="gridcell"
                                                                                 aria-label="3 November, 2019">3
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572811200000"
                                                                                 role="gridcell"
                                                                                 aria-label="4 November, 2019">4
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572897600000"
                                                                                 role="gridcell"
                                                                                 aria-label="5 November, 2019">5
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1572984000000"
                                                                                 role="gridcell"
                                                                                 aria-label="6 November, 2019">6
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1573070400000"
                                                                                 role="gridcell"
                                                                                 aria-label="7 November, 2019">7
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1573156800000"
                                                                                 role="gridcell"
                                                                                 aria-label="8 November, 2019">8
                                                                            </div>
                                                                        </td>
                                                                        <td role="presentation">
                                                                            <div class="picker__day picker__day--outfocus"
                                                                                 data-pick="1573243200000"
                                                                                 role="gridcell"
                                                                                 aria-label="9 November, 2019">9
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                                <div class="picker__footer">
                                                                    <button class="picker__button--today" type="button"
                                                                            data-pick="1569873600000" disabled=""
                                                                            aria-controls="P1228651169">Bugun
                                                                    </button>
                                                                    <button class="picker__button--clear" type="button"
                                                                            data-clear="1" disabled=""
                                                                            aria-controls="P1228651169">Temizle
                                                                    </button>
                                                                    <button class="picker__button--close" type="button"
                                                                            data-close="true" disabled=""
                                                                            aria-controls="P1228651169">Bagla
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="to_date_submit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-default btn-block"><i class="icon-search4"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="totalCount" value="Taxilərin sayı: 1814 ədəd"
                                               readonly="" class="form-control">
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr>
                                        @foreach($columns as $column)
                                            <th>
                                                <a href="#"><i></i>
                                                    {{ $column->name }}</a>
                                            </th>
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>0001</td>
                                        <td>Renault Qara 2008</td>
                                        <td><a href="#" data-toggle="modal" data-target="#modal_box"
                                               data-popup="tooltip" data-href="http://otos.ru/admin/taxi/statistics/1"
                                               class="stats" data-original-title="" title=""><span
                                                        class="label label-flat border-success text-success-600 position-right">10-AB-123</span></a>
                                        </td>
                                        <td>Kamran Nəcəfzadə Taleh</td>
                                        <td>
                                            <i data-popup="tooltip" title=""
                                               data-original-title="Cihaz qeydiyyatdan keçib"
                                               class="icon-checkmark-circle2"></i>

                                            <i data-popup="tooltip" title=""
                                               data-original-title="Tənzimləmələr istifadə edilir"
                                               class="icon-cog2"></i>

                                            <i data-popup="tooltip" title="" data-original-title="Balanssız işləyir"
                                               class="icon-checkmark"></i>

                                            <span data-popup="tooltip" title=""
                                                  data-original-title="Tarifdən asılı olmayaraq göstərilən faiz çıxılır"
                                                  class="label label-flat border-danger text-danger-600">50 %</span>
                                        </td>

                                        <td class="text-center">
                                            <ul class="icons-list">
                                                <li class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                        <i class="icon-menu7"></i>
                                                        <span class="caret"></span>
                                                    </a>

                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a target="_blank"
                                                               href="http://otos.ru/az/administrator/taxi/track/1"><i
                                                                        class="icon-location3"></i> Xəritədə bax</a>
                                                        </li>
                                                        <li>
                                                            <a href="http://otos.ru/az/administrator/message/single/1/1"><i
                                                                        class="icon-bubble-dots3"></i>Mesaj Göndər</a>
                                                        </li>
                                                        <li><a href="http://otos.ru/az/administrator/smsbox/single/1/1"><i
                                                                        class="icon-envelope"></i>Sms Göndər</a></li>
                                                        <li><a href="http://otos.ru/az/administrator/taxi/profile/1"><i
                                                                        class="icon-eye"></i> Bax</a></li>
                                                        <li><a href="http://otos.ru/az/administrator/taxi/update/1"><i
                                                                        class="icon-pencil7"></i> Redektə et</a></li>
                                                        <li><a href="http://otos.ru/az/administrator/taxi/setting/1"><i
                                                                        class="icon-cog3"></i> Tənzimləmələr</a></li>
                                                        <li>
                                                            <a href="http://otos.ru/az/administrator/taxi/testApplication/1"><i
                                                                        class="icon-pulse2"></i> Test</a></li>
                                                        <li><a href="#" class="taxi-delete" data-id="1"><i
                                                                        class="icon-trash"></i> Sil</a></li>
                                                        <li>
                                                            <a href="http://otos.ru/az/administrator/banned_taxi/singleBlock/1"
                                                               class="taxi-block" data-id="1">
                                                                <i class="icon-blocked"></i> Blokla
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel-footer"><a class="heading-elements-toggle"><i class="icon-more"></i></a>
                            <a class="heading-elements-toggle"><i class="icon-more"></i></a>
                            <div class="heading-elements">
								<span class="heading-text header-text-footer text-semibold">
									<select name="perPage" class="select select2-hidden-accessible" tabindex="-1"
                                            aria-hidden="true">
										<option value="20">20</option>
										<option value="50">50</option>
										<option value="100">100</option>
										<option value="200">200</option>
									</select>
								</span>
                                <div class="text-right">
                                    <ul class="pagination pagination-separated pull-right">
                                        <li class="active"><a href="">1</a></li>
                                        <li class="page"><a href="http://otos.ru/az/administrator/taxi/index/2"
                                                            data-ci-pagination-page="2">2</a></li>
                                        <li class="page"><a href="http://otos.ru/az/administrator/taxi/index/3"
                                                            data-ci-pagination-page="3">3</a></li>
                                        <li class="next page"><a href="http://otos.ru/az/administrator/taxi/index/2"
                                                                 data-ci-pagination-page="2" rel="next">İrəli →</a></li>
                                        <li class="next page"><a href="http://otos.ru/az/administrator/taxi/index/91"
                                                                 data-ci-pagination-page="91">Son »</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection