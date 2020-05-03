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

$('.preventEnter').on('keypress', function(event){
    var charCode = event.which;

    if (charCode=='13') {
        event.preventDefault();
        $('#searchButton').trigger('click');
    }
})

$('.deleteModal').on('click', function() {

    id = $(this).data('id');

    swal({
            title: "Do you realy want to delete",
            type: "error",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: "#F44336",
            showLoaderOnConfirm: true
        },
        function() {
            $.ajax({
                type: 'get',
                url: baseUrl+'/operator/note/delete/'+id,
                dataType: 'json',
                success: function (data) {
                    if(data['success']){
                        swal({
                            title: "Note deleted",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });

                        $('button[data-id = '+data['id']+']').parent().parent().parent().remove();
                    }else{
                        swal({
                            title: "Note can not be deleted",
                            text: data['message'],
                            type: "error",
                            confirmButtonColor: "#F44336"
                        });
                    }
                }
            });
        });
});

$('body').delegate('.cancelModal','click', function() {

    id = $(this).data('id');

    swal({
            title: "Həqiqətəndə ləğv etmək istəyirsiniz?",
            type: "error",
            showCancelButton: true,
            closeOnConfirm: false,
            confirmButtonColor: "#F44336",
            showLoaderOnConfirm: true
        },
        function() {
            $.ajax({
                type: 'get',
                url: baseUrl+"/operator/order/cancel/"+id,
                dataType: 'json',
                success: function (data) {
                    if(data['success']){
                        swal({
                            title: "Ləğv olundu",
                            type: "success",
                            confirmButtonColor: "#4CAF50"
                        });
                        $('#searchButton').trigger('click');
                    }else{
                        swal({
                            title: "Ləğv olunmadı",
                            type: "error",
                            confirmButtonColor: "#F44336"
                        });
                    }
                }
            });
        });
});