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

$('.preventEnter').on('keypress', function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#searchButton').trigger('click');
    }
})