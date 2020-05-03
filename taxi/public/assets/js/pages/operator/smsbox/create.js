$(document).ready(function(){
    $('select.destinationType').on('change', function() {
        $("input.number").val("");
        $.ajax({
            type: 'get',
            url: baseUrl+'/operator/smsbox/ajaxgetDestinations/'+this.value,
            dataType: 'json',
            success: function (response) {

                $('#destination').empty();
                $('#destination')
                $.each(response.data, function() {
                    $('#destination')
                        .append($("<option></option>")
                            .attr({
                                "value":this.id
                            })
                            .text(this.firstname));
                });

                $('select.destination').trigger('change');
            }
        });
    });

    $('select.destinationType').trigger('change');

    $('select.destination').on('change', function() {
        var destination_type =  $('select.destinationType').val();
        var destnation_id  = $(this).val();
        $.ajax({
            type: 'get',
            url: baseUrl+'/operator/smsbox/ajaxgetDestinationByType/'+destination_type+'/'+destnation_id,
            dataType: 'json',
            success: function (response) {
                if(response.success){
                    $("input.number").val(response.data[0]['phone']);
                }
            }
        });
    });


});

// Default initialization
$('.select').select2({
    minimumResultsForSearch: Infinity
});

// Select with search
$('.select-search').select2();

$('.select-fixed-single').select2({
    minimumResultsForSearch: Infinity,
    width: 250
});

$('body').delegate('.preventEnter', "keypress", function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#createButton').trigger('click');
    }
});