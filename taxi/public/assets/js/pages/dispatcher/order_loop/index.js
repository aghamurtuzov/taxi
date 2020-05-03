$('.select[name="perPage"]').on('change', function(){
    document.listForm.submit();
})

// Default initialization
$('.select').select2({
    minimumResultsForSearch: Infinity
});

// Select with search
$('.select-search').select2();

function changeStatus(){

    $object = $(this);

    id = $object.data('id');
    statusChangeTo = $object.data('status');

    if(statusChangeTo) statusChangeTo=0;
    else statusChangeTo=1;

    $.ajax({
        url: baseUrl+'/dispatcher/orderLoop/updateStatus',
        method: 'get',
        data: {
            id : id,
            statusChangeTo : statusChangeTo
        },
        dataType: 'json',
        success: function(data) {
            if(data['success']){
                if(data['newStatus']==='1'){
                    $('#isActive_'+data['id']).show();
                    $('#isDeactive_'+data['id']).hide();
                }else{
                    $('#isActive_'+data['id']).hide();
                    $('#isDeactive_'+data['id']).show();
                }
            }
        }
    });
}
$('.statusToChange').on('click', changeStatus);

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
                url: baseUrl+'/dispatcher/orderLoop/delete/'+id,
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