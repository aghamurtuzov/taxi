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
    format: "yyyy",
    viewMode: "years",
    minViewMode: "years",
    viewSelect: 'decade',
    autoclose: true
});

$( "#searchlink" ).click(function() {
    event.preventDefault();
    $('.search-box').toggle();
});
$('select.auto_brand').on('change', function() {
    var type = this.value;
    var model_id = '<?php echo $this->input->get("model"); ?>';
    if(type != ''){
        $.ajax({
            type: 'get',
            url: 'http://ulduz.smarttaxi.cloud/az/dispatcher/taxi/ajaxGetModelsByBrand/'+this.value,
            dataType: 'json',
            success: function (response) {
                $('select.auto_model').empty();
                $('select.auto_model')
                if(response.success){
                     $.each(response.data, function() {
                        $('select.auto_model')
                         .append($("<option></option>")
                            .attr({
                                "value":this.id
                            })
                            .text(this.name));
                    });
                }
            }
        });
    }
    
});
$('select.auto_brand').trigger('change');
$('.preventEnter').on('keypress', function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#searchButton').trigger('click');
    }
})