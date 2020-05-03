// Default initialization
$('.select').select2({
    minimumResultsForSearch: Infinity
});

// Select with search
$('.select-search').select2();

$('.select-fixed-single').select2({
    minimumResultsForSearch: Infinity,
    width: '100%'
});

$('.preventEnter').on('keypress', function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#createButton').trigger('click');
    }
})
    
$('select.smsTemplate').on('change', function() {
    
    $('textarea.messageText').val(this.value);
    
});
$('select[name="destination_type"]').on("change", function(){
    $('input[name="destination"]').val("");
    $('input[name="destination_id"]').val("");
}); 
$(function(){
    reinit();
});
function reinit() {

    $('body').delegate('input[name="destination"]', "keydown", function(event) {
        keyCode = event.which;

        if (keyCode=='13') {
            event.preventDefault();
        }
    });

    var enteredTexts = null;
    var allowRequest = true;

    $('body').delegate('input[name="destination"]', "keyup", function(event) {
        console.log('keyup');
        keyCode = event.which;

        var box_search = $(this);
        if(keyCode!=38&&keyCode!=40&&keyCode!=13){
            var text = this.value;
            if (text.length > 0) {
                if(allowRequest) {
                    allowRequest = false;
                    if(enteredTexts!=null){
                        //text = enteredTexts;
                        enteredTexts = null;
                    }
                    var destination_type  = $('select.destinationType option:checked').val();
                    if(destination_type == 1){var url = baseUrl+'/api/track/getTaxiByCode';}
                    else if(destination_type == 2){var url = baseUrl+'/api/track/getCustomerByPhone';}
                    else if(destination_type == 3){var url = baseUrl+'/api/track/getCustomerGroupByName';}

                    if(destination_type == 1 || destination_type == 2 || destination_type == 3){
                            $.ajax({
                            type: 'get',
                            url: url,
                            data: {
                                'code': text
                            },
                            response: 'json',
                            contentType: "application/json",
                            dataType: 'json',
                            success: function (data) {
                                box_search.parent().find(".search_result").empty();
                                if(destination_type == 1){
                                    var len = data['taxies'].length;
                                    if (len > 0) {
                                        for (var i = 0; i < len; i++) {
                                            if(data['taxies'][i]["fcm_registered_id"] != ""){
                                                box_search.parent().find(".search_result").append('<li data-id="' + data['taxies'][i]["id"] + '" >' + data['taxies'][i]["code"] + ' - ' + data['taxies'][i]['phone'] + '</li>').fadeIn();
                                            }
                                        }
                                    }
                                }
                                else if(destination_type == 3){
                                    var len = data['groups'].length;
                                    if (len > 0) {
                                        for (var i = 0; i < len; i++) {
                                            box_search.parent().find(".search_result").append('<li data-id="' + data['groups'][i]["id"] + '" >' + data['groups'][i]["name"]+'</li>').fadeIn();
                                        }
                                    }
                                }
                                else{
                                    var len = data['customers'].length;
                                    if (len > 0) {
                                        for (var i = 0; i < len; i++) {
                                            if(data['customers'][i]['fcm_token'] != null){
                                               box_search.parent().find(".search_result").append('<li data-id="' + data['customers'][i]["id"] + '" >' + data['customers'][i]["phone"] + '</li>').fadeIn();
                                            }
                                        }
                                    }
                                }
                                allowRequest = true;
                                if(enteredTexts!=null&&enteredTexts != text){
                                    //$('.address-search').trigger('keyup');
                                }
                            }
                        })
                    }
                }else{
                    enteredTexts = text;
                }
            }
            else{
                $(this).next().val("");
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

    $('body').delegate('input[name="destination"]', 'focusout', function(){
        $(this).parent().find(".search_result").fadeOut();
    })
    $('body').delegate('.search_result li', "click", function() {
        s_user = $(this).text();
        var box_street = $(this).parent().parent();

        $(this).parent().prev().prev().val(s_user);
        $(this).parent().prev().val($(this).attr('data-id'));

        $(this).parent().fadeOut();

    })
}