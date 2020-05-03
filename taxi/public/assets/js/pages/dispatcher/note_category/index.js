$('.select').select2({
    minimumResultsForSearch: Infinity
});

$('.select[name="perPage"]').on('change', function(){
    $('#searchButton').trigger('click');
})

$('.preventEnter').on('keypress', function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#searchButton').trigger('click');
    }
})