jQuery(document).ready(function($){

$('.love-send a').on('click',function(event){
	event.preventDefault();
	var data = {
		post_id:$('.love-send a').data('id'),
		action:'testfunc'
	};
	$.get({
		'data':data,
		'type':'get',
		'url':ajaxtut.ajax_url,
		success:function(data){
			$('.love-send a').html('I like this'+data);
		}

	});
    prevent
       
	});

});