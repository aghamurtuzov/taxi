
    if ($('select.complainantType').val() == 1) {
        $('select.guiltyType').val('0');
        $('select.guiltyType').prop('disabled', 'disabled');
        $('select#guilty').val('0');
        $('select.guilty').prop('disabled','disabled');
        $("#guiltyForm").slideUp( "slow", function() {});
      }
      if($('select.complainantType').val() == 2) {
        $('select.guiltyType').prop('disabled', false);
        $('select.guilty').prop('disabled',false);
      }
      if($('select.guiltyType').val() == 1){
        $("#guiltyForm").slideDown( "slow", function() {});
      }

    $('select[name=\'complainant_type\']').on('change', function() {
      var complainant_type = this.value;
      var guilty_type = $('select.guiltyType').val();
      $('input[name="complainant"]').val("");
      $('input[name="complainant_id"]').val("");

      if (this.value == 1) {
        $('select.guiltyType').val('0');
        $('select.guiltyType').prop('disabled', 'disabled');
        $('select#guilty').val('0');
        $('select.guilty').prop('disabled','disabled');
        $( "#guiltyForm" ).slideUp( "slow", function() {});
      }
      if (this.value == 2) {
        $('select.guiltyType').prop('disabled', false);
        $('select.guilty').prop('disabled',false);
      }
        
    });
    $('select[name=\'complainant_type\']').trigger('change');

    $('select[name=\'guilty_type\']').on('change', function() {
        var guilty_type = this.value;
        if(this.value == 0){
            $('select#guilty').val('0');
            $( "#guiltyForm" ).slideUp( "slow", function() {});
        }
        if(this.value == 1){
            $( "#guiltyForm" ).slideDown( "slow", function() {});
        }
    });
    $('select[name=\'guilty_type\']').trigger('change');

    $(function(){
        reinit();
    });
    function reinit() {

        $('body').delegate('input[name="complainant"]', "keydown", function(event) {
            keyCode = event.which;

            if (keyCode=='13') {
                event.preventDefault();
            }
        });

        var enteredTexts = null;
        var allowRequest = true;

        $('body').delegate('input[name="complainant"]', "keyup", function(event) {
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
                        var complainant_type  = $('select.complainantType').val();
                        if(complainant_type == 1){var url = 'http://ulduz.smarttaxi.cloud/api/track/getTaxiByCode';}
                        else if(complainant_type == 2){var url = 'http://ulduz.smarttaxi.cloud/api/track/getCustomerByPhone';}
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
                                if(complainant_type == 1){
                                    var len = data['taxies'].length;
                                    if (len > 0) {
                                        for (var i = 0; i < len; i++) {
                                            box_search.parent().find(".search_result").append('<li data-id="' + data['taxies'][i]["id"] + '" >' + data['taxies'][i]["code"] + ' - ' + data['taxies'][i]['phone'] + '</li>').fadeIn();
                                        }
                                    }
                                }else{
                                    var len = data['customers'].length;
                                    if (len > 0) {
                                        for (var i = 0; i < len; i++) {
                                            box_search.parent().find(".search_result").append('<li data-id="' + data['customers'][i]["id"] + '" >' + data['customers'][i]["phone"] + '</li>').fadeIn();
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

        $('body').delegate('input[name="complainant"]', 'focusout', function(){
            $(this).parent().find(".search_result").fadeOut();
        })
        /*--*/
        $('body').delegate('input[name="guilty"]', "keyup", function(event) {
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
                        $.ajax({
                            type: 'get',
                            url: 'http://ulduz.smarttaxi.cloud/api/track/getTaxiByCode',
                            data: {
                                'code': text
                            },
                            response: 'json',
                            contentType: "application/json",
                            dataType: 'json',
                            success: function (data) {
                                box_search.parent().find(".search_result2").empty();
                                var len = data['taxies'].length;
                                if (len > 0) {
                                    for (var i = 0; i < len; i++) {
                                        box_search.parent().find(".search_result2").append('<li data-id="' + data['taxies'][i]["id"] + '" >' + data['taxies'][i]["code"] + ' - ' + data['taxies'][i]['phone'] + '</li>').fadeIn();
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
                else{
                    $(this).next().val("");
                }
            }
            else{
                var $listItems = box_search.parent().find(".search_result2 >li");

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

        $('body').delegate('input[name="guilty"]', 'focusout', function(){
            $(this).parent().find(".search_result2").fadeOut();
        })
        /*--*/
        $('body').delegate('.search_result li', "click", function() {
            s_user = $(this).text();
            var box_street = $(this).parent().parent();

            $(this).parent().prev().prev().val(s_user);
            $(this).parent().prev().val($(this).attr('data-id'));

            $(this).parent().fadeOut();

        })
        $('body').delegate('.search_result2 li', "click", function() {
            s_user = $(this).text();
            var box_street = $(this).parent().parent();

            $(this).parent().prev().prev().val(s_user);
            $(this).parent().prev().val($(this).attr('data-id'));

            $(this).parent().fadeOut();

        })
    }


$('.select[name="perPage"]').on('change', function(){
    $('#listForm').submit();
})
// Default initialization
$('.select').select2({
    minimumResultsForSearch: Infinity
});

// Select with search
$('.select-search').select2();

$('.daterange-single').pickadate({
    monthsFull: months,
    weekdaysShort: days,
    today: 'Bugun',
    clear: 'Temizle',
    close: 'Bagla',
    formatSubmit: 'yyyy-mm-dd'
});