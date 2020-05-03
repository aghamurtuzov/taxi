function toBlankPage() {
    $('body').undelegate();

    for(i=0;i<intervalIDs.length;i++) clearInterval(intervalIDs[i]);

    intervalIDs = new Array(0);

    $('body').delegate('a[data-href]', 'click', function(){
        if ( !$(this).parent().is('.aktif') ){
            var href = $(this).attr('data-href');
            $.ajaxLoad(href);
        }
        return false
    });
}

$(function(){

	$.ajaxLoad = function(href, data, method = 'get'){
		$('.loader').fadeIn(500);

        toBlankPage();

        $.ajax({
			type: method,
			url: href,
			data: data,
			dataType: "html",
			success: function(result){
				$('.loader').fadeOut(500);
                $('.content').empty();
				$('.content').html(result);
				//$('a[data-href="'+href+'"]').parent().addClass('aktif');
			}
		});
	}
});