$('.select[name="perPage"]').on('change', function(){
    $('#listForm').submit();
})

// Default initialization
$('.select').select2({
    minimumResultsForSearch: Infinity
});

$('.select-fixed-single').select2({
    minimumResultsForSearch: Infinity,
    width: '100%'
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

$('.preventEnter').on('keypress', function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#searchButton').trigger('click');
    }
})