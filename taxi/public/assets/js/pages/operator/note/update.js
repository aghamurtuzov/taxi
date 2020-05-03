$(document).ready(function(){
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
});

$('select.complainantType').on('change', function() {
    var complainant_type = this.value;
    var guilty_type = $('select.guiltyType').val();

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
    $.ajax({
        type: 'get',
        url: baseUrl+'/administrator/note/ajaxgetComplainants/'+complainant_type,
        dataType: 'json',
        success: function (response) {
            $('#complainants').empty();
            $.each(response.data, function() {
                $('#complainants')
                    .append($("<option></option>")
                        .attr("value",this.id)
                        .text(this.firstname));
            });
        }
    });
});

$('select.guiltyType').on('change',function() {

    if(this.value == 0){
        $('select#guilty').val('0');
        $( "#guiltyForm" ).slideUp( "slow", function() {});
    }
    if(this.value == 1){
        $( "#guiltyForm" ).slideDown( "slow", function() {});
        $.ajax({
            type: 'get',
            url: baseUrl+'/administrator/note/ajaxgetComplainants/1',
            dataType: 'json',
            success: function (response) {
                $('#guilty').empty();
                $.each(response.data, function() {
                    $('#guilty')
                        .append($("<option></option>")
                            .attr("value",this.id)
                            .text(this.firstname));
                });
            }
        });
    }
});