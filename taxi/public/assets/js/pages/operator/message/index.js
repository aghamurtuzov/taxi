$('.select[name="perPage"]').on('change', function(){
    $('#listForm').submit();
})

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


$('.daterange-single').pickadate({
    monthsFull: months,
    weekdaysShort: days,
    today: 'Bugun',
    clear: 'Temizle',
    close: 'Bagla',
    formatSubmit: 'yyyy-mm-dd'
});

$('.preventEnter').on('keypress', function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#searchButton').trigger('click');
    }
})

$('select[name=\'destination_type\']').on('change', function() {

    url = false;
    if(this.value=='1') url = baseUrl+'/operator/taxi/ajaxgettaxes';
    else if(this.value=='2') url = baseUrl+'/operator/customer/ajaxgetcustomers';

    if(url) {
        $.ajax({
            url: url,
            method: 'get',
            dataType: 'json',
            success: function (json) {
                html = '<option value=""></option>';
                if (json['success']) {
                    for (i = 0; i < json['people'].length; i++) {
                        html += '<option value="' + json['people'][i]['id'] + '" > ';

                        html += json['people'][i]['firstname'] + " " + json['people'][i]['lastname'] + '</option>';
                    }
                }

                $('select[name=\'destination_id\']').html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }else{
        html = '<option value=""></option>';

        $('select[name=\'destination_id\']').html(html);
    }
});

$('select[name=\'destination_type\']').trigger('change');