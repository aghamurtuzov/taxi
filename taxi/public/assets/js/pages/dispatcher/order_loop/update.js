$('.select').select2({
    minimumResultsForSearch: Infinity
});

// Select with search
$('.select-search').select2();

$('body').delegate('.preventEnter', "keypress",function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#updateOrder').trigger('click');
    }
})

function destinatonItemFunc(option='', id='', type=1, latitude='', longitude='', price=0) {

    if(type===1) {
        nameCol = 10;
        numberStreetIsActive = 'none';
        numberStreetStr = '<option value=""></option>';
    }
    else {
        nameCol = 7;
        numberStreetIsActive = 'block';
        numberStreetStr = '';
    }

    switcheryRand = Math.ceil(Math.random()*1000);

    if(price) {
        objectTourniquetIsActive = 'block';
    }
    else {
        objectTourniquetIsActive = 'none';
    }

    item =
        '                <div class="form-group destination">' +
        '                  <div class="col-lg-'+nameCol+' has-feedback has-feedback-left">\n' +
        '                     <input type="text" name="address[]" required value="'+option+'" class="form-control address-search input-roundless" autocomplete="off" onclick="this.select();">\n' +
        '                     <input type="hidden" name="destination_id[]" value="'+id+'" class="destination-id">\n' +
        '                     <input type="hidden" name="destination_type[]" value="'+type+'" class="type">\n' +
        '                     <input type="hidden" name="longitude[]" value="'+longitude+'" class="longitude">\n' +
        '                     <input type="hidden" name="latitude[]" value="'+latitude+'" class="latitude">\n' +
        '                     <div class="form-control-feedback">\n' +
        '                        <i class="icon-pin-alt"></i>\n' +
        '                     </div>\n' +
        '                     <ul class="search_result"></ul>\n' +
        '                  </div>\n' +
        '                  <div class="col-lg-3 number_street" style="display: '+numberStreetIsActive+'">' +
        '                     <select name="number_street[]" class="form-control select-search">' +
        numberStreetStr +
        '                     </select>' +
        '                  </div>' +
        '                  <div class="col-lg-3 object_tourniquet" style="display: '+objectTourniquetIsActive+'">' +
        '                     <div class="col-md-5 checkbox checkbox-switchery switchery-xs">\n' +
        '                         <label>' +
        '                            <input type="checkbox" id="switchery_will_pay_'+switcheryRand+'" name="tourniquet_will_pay[]" value="1" class="switchery-will-pay" checked>' +
        '                         </label>\n' +
        '                     </div>' +
        '                     <label class="tourniquet_price_label">' +
        order_tourniquet+' ('+ (price/100).toFixed(2) + ')'+
    '                     </label>\n' +
    '                     <input type="hidden" name="tourniquet_price[]" value="'+price+'" class="tourniquet_price">' +
    '                  </div>' +
    '                  <div class="col-lg-2">\n' +
    '                     <button type="button" class="btn btn-block btn-danger deleteDestination"><i class="icon-trash"></i></button>\n' +
    '                  </div>' +
    '               </div>';

    $('#destinations').append(item);

    var primary = document.querySelector('#switchery_will_pay_'+switcheryRand);
    var switchery = new Switchery(primary, { color: '#2196F3' });

}

$('body').delegate('.switchery-will-pay', "change", function(){
    if($(this).is(':checked')){
        $(this).val(1);
    }else{
        $(this).val(0);
    }
});

$(function() {
    reinit();
    reinitTaxi();
});

function reinit() {

    $('body').delegate('.address-search', "keydown", function(event) {
        keyCode = event.which;

        if (keyCode=='13') {
            event.preventDefault();
        }
    });

    var enteredTexts = null;
    var allowRequest = true;

    $('body').delegate('.address-search', "keyup", function(event) {
        keyCode = event.which;

        var box_search = $(this);
        if(keyCode!=38&&keyCode!=40&&keyCode!=13){
            var text = this.value;
            if (text.length >= 3) {
                if(allowRequest) {
                    allowRequest = false;
                    if(enteredTexts!=null){
                        //text = enteredTexts;
                        enteredTexts = null;
                    }

                    $.ajax({
                        type: 'get',
                        url: baseUrl+'/api/address/search',
                        data: {
                            'q': text
                        },
                        response: 'json',
                        contentType: "application/json",
                        dataType: 'json',
                        success: function (data) {
                            box_search.parent().find(".search_result").empty();
                            var len = data.length;
                            if (len > 0) {
                                for (var i = 0; i < len; i++) {
                                    if (data[i]['type'] === '2') {
                                        box_search.parent().find(".search_result").append('<li data-id="' + data[i]["id"] + '" data-type="' + data[i]["type"] + '" >' + data[i]['name'] + '</li>').fadeIn();
                                    }
                                    if (data[i]['type'] === '1') {
                                        box_search.parent().find(".search_result").append('<li data-id="' + data[i]["id"] + '" data-type="' + data[i]["type"] + '" data-price="' + data[i]["price"] + '" data-longitude="' + data[i]["longitude"] + '" data-latitude="' + data[i]["latitude"] + '">' + data[i]["name"] + '</li>').fadeIn();
                                    }
                                }
                            }
                            allowRequest = true;
                            if(enteredTexts!=null&&enteredTexts != text){
                                //$('.address-search').trigger('keyup');
                            }
                        }
                    })
                }else{
                    enteredTexts = text;
                }
            }
        }
        else{
            var $listItems = box_search.parent().find(".search_result >li");

            var $selected = $listItems.filter('.selected'),
                $current;

            $listItems.removeClass('selected');

            if (keyCode == 40) // Down key
            {
                if (!$selected.length || $selected.is(':last-child')) {
                    $current = $listItems.eq(0);
                }
                else {
                    $current = $selected.next();
                }
                $current.addClass('selected');
            }
            else if (keyCode == 38) // Up key
            {
                if (!$selected.length || $selected.is(':first-child')) {
                    $current = $listItems.last();
                }
                else {
                    $current = $selected.prev();
                }
                $current.addClass('selected');
            }
            else if(keyCode == '13'){
                $selected.trigger('click');
            }
        }
    })

    $('body').delegate('.address-search', 'focusout', function(){
        $(this).parent().find(".search_result").fadeOut();
    })

    $('body').delegate('.address-search', 'focusin', function(){
        //$('.address-search').trigger('keyup');
    })

    $('body').delegate('.search_result li', "click", function() {
        s_user = $(this).text();
        var box_street = $(this).parent().parent();

        $(this).parent().parent().find('.address-search').val(s_user);
        $(this).parent().parent().find('.latitude').val($(this).attr('data-latitude'));
        $(this).parent().parent().find('.longitude').val($(this).attr('data-longitude'));
        $(this).parent().parent().find('.destination-id').val($(this).attr('data-id'));
        $(this).parent().parent().find('.type').val($(this).attr('data-type'));

        $(this).parent().fadeOut();

        $(this).parent().empty();

        box_street.parent().find(".number_street").children('select').empty();

        if ($(this).data('type') == '2') {

            box_street.parent().find(".number_street").show();
            box_street.parent().find(".object_tourniquet").hide();
            boxClass = 'col-lg-7 has-feedback has-feedback-left';

            destinationID = $(this).data('id');
            $.ajax({
                type: 'get',
                url: baseUrl+'/api/address/getnumbers',
                data: {
                    destinationID: destinationID
                },
                response: 'json',
                contentType: "application/json",
                dataType: 'json',
                success: function(data) {
                    var len = data['numbers'].length;
                    for (var i = 0; i < len; i++) {
                        box_street.parent().find(".number_street").children('select').append('<option data-longitude="' + data['numbers'][i]["longitude"] + '" data-latitude="' + data['numbers'][i]["latitude"] + '">' + data['numbers'][i]['number'] + '</option>').fadeIn();
                    }

                    $('.select-search').select2();

                    box_street.parent().find(".number_street").children('select').trigger('change');
                }
            })
        }else{
            box_street.parent().find(".number_street").children('select').append('<option value=""></option>');

            box_street.parent().find(".number_street").hide();

            if($(this).attr('data-price')>0) {

                box_street.parent().find(".object_tourniquet").show();

                boxClass = 'col-lg-7 has-feedback has-feedback-left';
            }else{
                box_street.parent().find(".object_tourniquet").hide();
                boxClass = 'col-lg-10 has-feedback has-feedback-left';
            }
        }

        if($(this).attr('data-price')!="null") price = $(this).attr('data-price');
        else price = 0;

        box_street.parent().find(".tourniquet_price").val(price)
        box_street.parent().find(".tourniquet_price_label").text(order_tourniquet+' ('+ (price/100).toFixed(2)+')')

        box_street.attr('class', boxClass);

        if($(this).attr('data-type')=='1') {
            addFromMark(box_street.find('.address-search'));
            if($('select[name="order_type"] option:checked').val()=='1') distanceCalculate();
            priceCalculate();
        }
    })

    $('body').delegate('.number_street', "change", function() {

        $(this).prev().find('.latitude').val($('option:selected', this).attr('data-latitude'));
        $(this).prev().find('.longitude').val($('option:selected', this).attr('data-longitude'));

        addFromMark($(this).prev().find('.address-search'));
        if($('select[name="order_type"] option:checked').val()=='1') distanceCalculate();
        priceCalculate();
    })
}

function reinitTaxi() {

    $('body').delegate('input[name="taxi"]', "keydown", function(event) {
        keyCode = event.which;

        if (keyCode=='13') {
            event.preventDefault();
        }
    });

    $('body').delegate('input[name="taxi"]', "keyup", function(event) {
        keyCode = event.which;

        var box_search = $(this);
        if(keyCode!=38&&keyCode!=40&&keyCode!=13){
            var text = this.value;
            if (text.length > 0) {
                $.ajax({
                    type: 'get',
                    url: baseUrl+'/api/track/getTaxiByCode',
                    data: {
                        'code': text
                    },
                    response: 'json',
                    contentType: "application/json",
                    dataType: 'json',
                    success: function (data) {
                        box_search.parent().find("#search_result_taxi").empty();
                        var len = data['taxies'].length;
                        if (len > 0) {
                            for (var i = 0; i < len; i++) {
                                box_search.parent().find("#search_result_taxi").append('<li data-id="' + data['taxies'][i]["id"] + '" >' + data['taxies'][i]["code"] + ' - ' + data['taxies'][i]['firstname'] + ' ' + data['taxies'][i]['lastname'] + '</li>').fadeIn();
                            }
                        }
                    }
                })
            }
            else{
                $(this).next().val("");
            }
        }
        else{
            var $listItems = box_search.parent().find("#search_result_taxi >li");

            var $selected = $listItems.filter('.selected'),
                $current;

            $listItems.removeClass('selected');

            if (keyCode == 40) // Down key
            {
                if (!$selected.length || $selected.is(':last-child')) {
                    $current = $listItems.eq(0);
                }
                else {
                    $current = $selected.next();
                }
                $current.addClass('selected');
            }
            else if (keyCode == 38) // Up key
            {
                if (!$selected.length || $selected.is(':first-child')) {
                    $current = $listItems.last();
                }
                else {
                    $current = $selected.prev();
                }
                $current.addClass('selected');
            }
            else if(keyCode == '13'){
                $selected.trigger('click');
            }
        }
    })

    $('body').delegate('input[name="taxi"]', 'focusout', function(){
        $(this).parent().find("#search_result_taxi").fadeOut();
    })

    $('body').delegate('input[name="taxi"]', 'focusin', function(){
        //$('.address-search').trigger('keyup');
    })

    $('body').delegate('#search_result_taxi li', "click", function() {

        s_user = $(this).text();
        var box_street = $(this).parent().parent();

        $(this).parent().prev().prev().val(s_user);
        $(this).parent().prev().val($(this).attr('data-id'));

        $(this).parent().fadeOut();
    })
}

$(function(){

    $('.switchery-will-pay').each(function(){
        var switchery = new Switchery(this, { color: '#2196F3' });
    })

})

$('#order_date').daterangepicker({
    singleDatePicker: true,
    timePicker: true,
    timePicker24Hour: true,
    locale: {
        format: 'YYYY-MM-DD H:mm'
    }
});

$("#order_time").AnyTime_picker({
    format: "%H:%i"
});

$('input[name=\'tarix\']').on('change', function() {
    //var value = this.val();
    $('.order_date_block').toggle();
    $('#selected_block').toggle();
    var tarixx =  $('input[name=tarix]:checked').val();
    if(tarixx == 0) {
        if($('#selected').prop('checked')) {
            var selected = 1;
        } else {
            var selected = 0;
        }
        if(selected == 1)
        {
            get_empty_taxi();
        }

    }
    else{
        $('#empty-taxi').html('');
    }
});

$('body').delegate('#customer_phone', "keyup", function() {
    customerPhone = $(this).val();

    if(customerPhone.length==12){
        $.ajax({
            url: baseUrl+'/dispatcher/order/ajaxGetLastOrders',
            dataType: 'json',
            data: {
                customer_phone: customerPhone
            },
            success: function (data) {
                $('#order_history_body').empty();

                if(data['success']){
                    tbody = "";
                    for(i=0; i<data['orderHistories'].length;i++){
                        tbody +=
                            "                                <tr>" +
                            "                                     <td>"+data['orderHistories'][i]['id']+"</td>" +
                            "                                     <td class=\"routes\">" +
                            data['orderHistories'][i]['route_names']+
                            "                                     </td>\n" +
                            "                                     <td>"+data['orderHistories'][i]['tariff_name']+"/"+data['orderHistories'][i]['order_value']+" h</td>\n" +
                            "                                     <td>"+(data['orderHistories'][i]['price']/100).toFixed(2)+"</td>\n" +
                            "                                     <td>\n" +
                            "                                         <div class=\"btn-group\">\n" +
                            "                                             <button type=\"button\" class=\"btn btn-default executeHistory\" data-id='"+data['orderHistories'][i]['id']+"'><i class=\"icon-arrow-left8\"></i></button>\n" +
                            "                                         </div>\n" +
                            "                                     </td>\n" +
                            "                                 </tr>";
                    }

                    $('#order_history_body').append(tbody);

                    $('#customer_id').val(data['customer_id']);
                }
            }
        });
    }else{
        $('#order_history_body').empty();

        tbody = "";

        $('#order_history_body').append(tbody);
    }
});

$('body').delegate('.executeHistory', "click", function(){
    $('#destinations').empty();

    $routes = $(this).parent().parent().parent().find('.routes').find('li');

    if($('select[name="order_type"] option:checked').val()=="2") {
        destinatonItemFunc($($routes[0]).text(), $($routes[0]).data('id'), $($routes[0]).data('type'), $($routes[0]).data('lat'), $($routes[0]).data('lng'), $($routes[0]).data('price'));

        $box = $("#destinations div:last-child");

        $box.find(".number_street").children('select').empty();

        if($($routes[0]).data('type')=='1') {
            $box.find(".number_street").children('select').append('<option value=""></option>');
            $box.find(".number_street").hide();

            if ($($routes[0]).data('price') > 0) {

                $box.find(".object_tourniquet").show();

                boxClass = 'col-lg-7 has-feedback has-feedback-left';
            } else {
                $box.find(".object_tourniquet").hide();
                boxClass = 'col-lg-10 has-feedback has-feedback-left';
            }
        }else{

            destinationID = $($routes[0]).data('id');
            $.ajax({
                type: 'get',
                url: baseUrl+'/api/address/getnumbers',
                data: {
                    destinationID: destinationID
                },
                response: 'json',
                contentType: "application/json",
                dataType: 'json',
                success: function(data) {
                    var len = data['numbers'].length;
                    for (var i = 0; i < len; i++) {
                        $box.find(".number_street").children('select').append('<option data-longitude="' + data['numbers'][i]["longitude"] + '" data-latitude="' + data['numbers'][i]["latitude"] + '">' + data['numbers'][i]['number'] + '</option>').fadeIn();
                    }

                    $('.select-search').select2();

                    $box.find(".number_street").children('select').trigger('change');
                }
            })

            if($(this).attr('data-price')!="null") price = $(this).attr('data-price');
            else price = 0;

            $box.find(".tourniquet_price").val(price)
            $box.find(".tourniquet_price_label").text(order_tourniquet+' ('+ (price/100).toFixed(2)+')')

            $box.find(".number_street").show();
            $box.find(".object_tourniquet").hide();
            boxClass = 'col-lg-7 has-feedback has-feedback-left';
        }
    }else {
        for (i = 0; i < $routes.length; i++) {
            destinatonItemFunc($($routes[i]).text(), $($routes[i]).data('id'), $($routes[i]).data('type'), $($routes[i]).data('lat'), $($routes[i]).data('lng'), $($routes[i]).data('price'));
            $box = $("#destinations > div:last-child");
            //$box.find(".number_street").children('select').append('<option value=""></option>');

            if($($routes[i]).data('type')=='1') {
                $box.find(".number_street").hide();

                if ($($routes[i]).data('price') > 0) {

                    $box.find(".object_tourniquet").show();

                    boxClass = 'col-lg-7 has-feedback has-feedback-left';
                } else {
                    $box.find(".object_tourniquet").hide();
                    boxClass = 'col-lg-10 has-feedback has-feedback-left';
                }
            }else{

                destinationID = $($routes[i]).data('id');
                $.ajax({
                    type: 'get',
                    url: baseUrl+'/api/address/getnumbers',
                    data: {
                        destinationID: destinationID
                    },
                    response: 'json',
                    contentType: "application/json",
                    dataType: 'json',
                    success: function(data) {
                        var len = data['numbers'].length;
                        for (var i = 0; i < len; i++) {
                            $box.find(".number_street").children('select').append('<option data-longitude="' + data['numbers'][i]["longitude"] + '" data-latitude="' + data['numbers'][i]["latitude"] + '">' + data['numbers'][i]['number'] + '</option>').fadeIn();
                        }

                        $('.select-search').select2();

                        $box.find(".number_street").children('select').trigger('change');
                    }
                })

                if($($routes[i]).data('price')!="null") price = $(this).attr('data-price');
                else price = 0;

                $box.find(".tourniquet_price").val(price)
                $box.find(".tourniquet_price_label").text(order_tourniquet+' ('+ (price/100).toFixed(2)+')')

                $box.find(".number_street").show();
                $box.find(".object_tourniquet").hide();
                boxClass = 'col-lg-7 has-feedback has-feedback-left';

            }

            $box.find('> div:first-child').attr('class', boxClass);


        }
    }

    addFromMark();
    if($('select[name="order_type"] option:checked').val()=='1') distanceCalculate();
    priceCalculate();

});

$('select[name="order_type"]').on('change', function(){

    destinationCreateButtom =
        "                              <div class=\"form-group\">\n" +
        "                                 <div class=\"col-lg-12\">\n" +
        "                                    <a id=\"createDestination\" class=\"btn btn-default btn-icon btn-block\"><i class=\"icon-plus3\"></i> "+order_another_address+"</a>\n" +
        "                                 </div>\n" +
        "                              </div>";

    $('#destinations').empty();
    $('#createDestination').parent().parent().remove();

    if ($('select[name="order_type"] option:checked').val()=="1"){
        destinatonItemFunc();
        destinatonItemFunc();
        $('#destinations').after(destinationCreateButtom);
        $('#orderValue').find('label').text('Mesafe')
        $('#orderValue').find('input').attr('readonly', true)
        $('#orderValue').find('input').val(0);

    }else{
        destinatonItemFunc();
        $('#orderValue').find('label').text('Vaxt')
        $('#orderValue').find('input').attr('readonly', false)
        $('#orderValue').find('input').val(0);
    }

    var primary = document.querySelector('.switchery-will-pay');
    var switchery = new Switchery(primary, { color: '#2196F3' });

    addFromMark();
    priceCalculate();
});

$('select[name="tariff"]').on('change', function(){
    priceCalculate();
});

$('select[name="options[]"]').on('change', function(){
    priceCalculate();
});

$('#timeout').on('change', function(){
    priceCalculate();
});

$('body').delegate('.switchery-will-pay', 'change', function(){
    priceCalculate();
});

$('input[name="order_value"]').on('change', function(){
    priceCalculate();
});

$('input[name="order_date"]').on('change', function(){
    priceCalculate();
});

$('body').delegate('.deleteDestination', 'click', function(){
    if($('.destination').length>1) {
        $(this).parent().parent().remove();
        addFromMark();
        if($('select[name="order_type"] option:checked').val()=='1') distanceCalculate();
        priceCalculate();
    }

});

function distanceCalculate(){
    var latitudes = [];
    $('.latitude').each(function(){
        if($(this).val()!="") latitudes.push($(this).val())
    })

    var longitudes = [];
    $('.longitude').each(function(){
        if($(this).val()!="") longitudes.push($(this).val())
    })

    if(latitudes.length>1&&longitudes.length>1) {
        $.ajax({
            url: baseUrl+"/api/distance/calc",
            type: 'post',
            dataType: 'json',
            data: {
                latitudes: latitudes,
                longitudes: longitudes
            },
            success: function (data) {
                if (data['success']) {
                    $('#new_distance').val(data['distance'])
                }
                priceCalculate();
            }
        });
    }
}

function priceCalculate(){

    tariff = $('select[name="tariff"] option:checked').val();
    orderType = $('select[name="order_type"] option:checked').val();

    var options = [];
    $('select[name="options[]"] option:checked').each(function() {
        options.push($(this).val());
    });

    timeout = $('input[name="timeout"]').val();

    orderValue = $('input[name="order_value"]').val();

    destinations = [];
    $('.destination-id').each(function() {
        if($(this).val()!="") destinations.push($(this).val());
    });

    tourniquetWillPays = [];
    $('.switchery-will-pay').each(function() {
        tourniquetWillPays.push($(this).val());
    });

    tourniquetPrices = [];
    $('.tourniquet_price').each(function() {
        if($(this).val()!="") tourniquetPrices.push($(this).val());
        else tourniquetPrices.push(0);
    });

    isCurrentTime = $('input[name="isCurrentTime"]').is(':checked');

    if(isCurrentTime){
        date = new Date();
        orderDate = date.getFullYear() + "-" + (date.getMonth()+1) + "-" + date.getDate() + " " + date.getHours() + ":" + date.getMinutes();
        orderWeekday = date.getDay();
    }else{
        orderDate = $('input[name="order_date"]').val();
        orderWeekday = (new Date(orderDate)).getDay();
    }

    if(true){
        $.ajax({
            url: baseUrl+"/api/price/calc",
            dataType: 'json',
            data: {
                tariff: tariff,
                orderType: orderType,
                options: options,
                timeout: timeout,
                orderValue: orderValue,
                destinations: destinations,
                tourniquetWillPays: tourniquetWillPays,
                tourniquetPrices: tourniquetPrices,
                orderDate: orderDate,
                orderWeekday: orderWeekday
            },
            success: function (data) {
                if(data['success']){
                    $('input[name="price"]').val(data['orderPrice']);

                }
            }
        });
    }
}

$('body').delegate('#createDestination', 'click', function(){

    destinatonItemFunc();

    var primary = document.querySelector('.switchery-will-pay');
    var switchery = new Switchery(primary, { color: '#2196F3' });
});

$('input[name="isCurrentTime"]').on('change', function(){
    if($('input[name="isCurrentTime"]').is(':checked')){
        $('#futureOrderDate').hide();
    }else{
        $('#futureOrderDate').show();
    }

    priceCalculate();
});

drop.on('dragend', function(){
    addFromMark();
    if($('select[name="order_type"] option:checked').val()=='1') {
        distanceCalculate();
    }
})

var primary = document.querySelector('.switchery-calculate');
var switchery = new Switchery(primary, { color: '#2196F3' });

var primary = document.querySelector('.switchery-search');
var switchery = new Switchery(primary, { color: '#2196F3' });

var primary = document.querySelector('.switchery-public');
var switchery = new Switchery(primary, { color: '#2196F3' });

var map;
var markers = new Array();
var taxiMarkers = new Array();
var latitude;
var longitude;
var input;
var marker_indexes;
var directionsService;
var directionsDisplay;
function initialize() {
    var styledMapType = new google.maps.StyledMapType(
        [
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fffdf9"
                    },
                    {
                        "lightness": "-3"
                    },
                    {
                        "saturation": "-64"
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "labels",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffc4d1"
                    },
                    {
                        "lightness": "51"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#c35e89"
                    }
                ]
            },
            {
                "featureType": "poi.attraction",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#7b2f4f"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#f2e5ff"
                    }
                ]
            },
            {
                "featureType": "poi.business",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#beaecb"
                    }
                ]
            },
            {
                "featureType": "poi.government",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "lightness": "42"
                    }
                ]
            },
            {
                "featureType": "poi.government",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#29222e"
                    }
                ]
            },
            {
                "featureType": "poi.government",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#eeeeee"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffe3e3"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#ad7070"
                    }
                ]
            },
            {
                "featureType": "poi.medical",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#8e2727"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#cceaa2"
                    }
                ]
            },
            {
                "featureType": "poi.park",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#316b49"
                    }
                ]
            },
            {
                "featureType": "poi.school",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fdf3c9"
                    }
                ]
            },
            {
                "featureType": "poi.sports_complex",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffe8e8"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#f0f6ff"
                    },
                    {
                        "lightness": "100"
                    },
                    {
                        "saturation": "-10"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#fbba49"
                    },
                    {
                        "saturation": "-23"
                    }
                ]
            },
            {
                "featureType": "road",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#11110e"
                    },
                    {
                        "saturation": "11"
                    },
                    {
                        "lightness": "42"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffd94e"
                    },
                    {
                        "lightness": "30"
                    },
                    {
                        "saturation": "100"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#b6872a"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#53021f"
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "color": "#fff7f9"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ddf0fa"
                    },
                    {
                        "saturation": "-50"
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#595440"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "all",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#ffecec"
                    },
                    {
                        "lightness": "24"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#fbeaea"
                    }
                ]
            },
            {
                "featureType": "transit.line",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "saturation": "100"
                    },
                    {
                        "lightness": "0"
                    },
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#e0dfdf"
                    },
                    {
                        "weight": "10.00"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#32dafe"
                    },
                    {
                        "lightness": "61"
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "color": "#01a0c1"
                    }
                ]
            }
        ],
        {name: 'Ulduz Taxi *5000'});

    directionsService = new google.maps.DirectionsService;
    directionsDisplay = new google.maps.DirectionsRenderer;

    var mapOptions = {
        zoom: 13,
        mapTypeControlOptions: {
            mapTypeIds: ['styled_map']
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        center: new google.maps.LatLng(40.415613, 49.896340),
        gestureHandling: 'greedy'
    };

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    map.addListener('mousedown', function(event) {
        input = $(document.activeElement);
    });

    // This event listener will call addMarker() when the map is clicked.
    map.addListener('click', function(event) {
        if(input&&input.attr('name') == "address[]") {

            var myLatLng = event.latLng;
            var lat = myLatLng.lat();
            var lng = myLatLng.lng();

            $.ajax({
                url: baseUrl+"/api/address/getNoNamedAddress",
                method: 'get',
                data: {
                    latitude: lat,
                    longitude: lng
                },
                dataType: 'json',
                success: function(data) {

                    if(data['success']){
                        input.val(data['data']['name']);
                        input.next().val(data['data']['id']);
                        input.next().next().val(1);
                        input.parent().attr('class', 'col-lg-10 has-feedback has-feedback-left')
                        input.parent().parent().find('.number_street').css('display', 'none')
                        input.parent().parent().find('.object_tourniquet').css('display', 'none')
                        input.parent().find('input[name="longitude[]"]').val(lng);
                        input.parent().find('input[name="latitude[]"]').val(lat);
                        addFromMark(input, false);
                        if($('select[name="order_type"] option:checked').val()=='1') distanceCalculate();
                        else priceCalculate();
                    }
                }
            });
        }
    });

    directionsDisplay.setMap(map);

    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');
    var trafficLayer = new google.maps.TrafficLayer();
    trafficLayer.setMap(map);
}

function calculateAndDisplayRoute() {
    var waypts = [];
    var longitudeArray = document.getElementsByClassName('longitude');
    var latitudeArray = document.getElementsByClassName('latitude');

    if (longitudeArray.length > 2) {
        for (var i = 1; i < longitudeArray.length - 1; i++) {
            var coord = latitudeArray[i].value + "," + longitudeArray[i].value;
            waypts.push({
                location: coord,
                stopover: true
            });
        }
    }

    var longitude_length = longitudeArray.length - 1;
    var latitude_length = latitudeArray.length - 1;
    var origin_long = longitudeArray[0].value;
    var origin_lati = latitudeArray[0].value;
    var destination_long = longitudeArray[longitude_length].value;
    var destination_lati = latitudeArray[latitude_length].value;
    var origin = new google.maps.LatLng(origin_lati, origin_long);
    var destination = new google.maps.LatLng(destination_lati, destination_long);
    directionsService.route({
        origin: origin,
        destination: destination,
        waypoints: waypts,
        optimizeWaypoints: true,
        travelMode: 'DRIVING'
    }, function(response, status) {
        if (status === 'OK') {
            directionsDisplay.setDirections(response);
        }
    });
}

function addMarkers(latitude, longitude, inputLoc = false, text, setCenter = true){

    var icon_base_url = baseUrl.substring(0,baseUrl.length-3)+'/assets/images/taxi_codes/'+text+'_origin_pin_2.png';

    var image = {
        url: icon_base_url,
        size: new google.maps.Size(40, 40),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(20, 40)
    };

    var marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(latitude, longitude),
        icon: image,
        title: $($('input[name="address[]"]')[0]).val() + " " + $($('select[name="number_street[]"]')[0]).val()
    });

    var contentString = $($('input[name="address[]"]')[0]).val() + " " + $($('select[name="number_street[]"]')[0]).val()

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    if(setCenter) map.setCenter(new google.maps.LatLng(latitude, longitude));

    var lastIndex = markers.length;

    marker['index'] = lastIndex;
    markers[lastIndex] = marker;

    if(inputLoc) {
        inputLoc.parent().parent().find("input[name='marker_index[]']").val(lastIndex);
    }

    /*
    google.maps.event.addListener(marker, 'dragend', function (event) {

        marker_indexes = $("input[name='marker_index[]']");

        for(i=0;i<marker_indexes.length;i++){
            console.log($(marker_indexes[i]).val()+" == "+this.index)
            if($(marker_indexes[i]).val()==this.index){
                $($($(marker_indexes[i])).parent().parent().find('input[name="longitude[]"]')[0]).val(event.latLng.lng())
                $($($(marker_indexes[i])).parent().parent().find('input[name="latitude[]"]')[0]).val(event.latLng.lat())
            }
        }
    });
    */
}

function removeMarkers(){
    for (var i = 0; i < markers.length; i++) {

        markers[i].setMap(null);
    }
}

function addFromMark(inputLoc = false, setCenter = true){
    removeMarkers();
    longitude = $('.longitude');
    latitude = $('.latitude');

    var longitudeArray = new Array();
    var latitudeArray = new Array();

    /*
    $('.longitude').each(function(i){
        if($(latitude[i]).val()!=''||$(longitude[i]).val()!='') {
            longitudeArray[longitudeArray.length] = $(longitude[i]).val();
            latitudeArray[latitudeArray.length] = $(latitude[i]).val();
            addMarkers($(latitude[i]).val(), $(longitude[i]).val(), inputLoc, String.fromCharCode(65+i), setCenter);
        }
    })
    */

    calculateAndDisplayRoute();
}


function addTaxiMarkers(marker_data){

    if(marker_data.live == 1){
        imageType = 'taxi_pin_green.png';
    }
    else{
        imageType = 'taxi_pin_black.png';
    }

    var icon_base_url = baseUrl.substring(0,baseUrl.length-3)+'/assets/images/taxi_codes/'+marker_data.code+'_'+imageType;

    var image = {
        url: icon_base_url,
        size: new google.maps.Size(40, 40),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(0, 40)
    };
    var marker = new google.maps.Marker({
        map: map,
        position: new google.maps.LatLng(marker_data.latitude, marker_data.longitude),
        icon: image,
        title: marker_data.code+' - '+marker_data.firstname+' '+marker_data.lastname+' - '+marker_data.number

    });

    var contentString = marker_data.code+' - '+marker_data.firstname+' '+marker_data.lastname+' - '+marker_data.number;

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    marker.addListener('click', function() {
        infowindow.open(map, marker);
    });

    taxiMarkers.push(marker);
}

function removeTaxiMarkers(){
    for (var i = 0; i < taxiMarkers.length; i++) {
        taxiMarkers[i].setMap(null);
    }
}

var doAjaxRequest = true;

function ajaxRequest(){

    var tariff = $('select[name="tariff"] option:selected').val();
    var live = 1;

    $.ajax({
        url: baseUrl+"/api/track/mapFromTaxi",
        method: 'get',
        data: {
            tariff : tariff,
            live : live
        },
        dataType: 'json',
        success: function(data) {
            removeTaxiMarkers();

            if(data['success']){
                var json_length = data['taxies'].length;
                for(i =0; i < json_length; i++)
                {
                    addTaxiMarkers(data['taxies'][i]);
                }
            }

            doAjaxRequest = true;
        }
    });

    doAjaxRequest = false;
}

var intervalID;

$.getScript("https://maps.googleapis.com/maps/api/js?key=AIzaSyB2oPlgMNLui6Js_QKiLxbS82MFu7doonA&callback=initialize")
    .done(function( script, textStatus ) {
        $('#customer_phone').trigger('keyup');
        $('#isCurrentTime').trigger('change');

        intervalID = setInterval(function(){
            if(doAjaxRequest) {
                ajaxRequest();
            }
        }, 15000);

        if(doAjaxRequest) {
            ajaxRequest();
        }

        addFromMark(false, false);
    });