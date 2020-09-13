jQuery(document).ready(function($){
	
	$('.love-send a').on('click',function(){
		var data = {
			post_id:$('.love-send a').data('id'),
			action:'data_save_func'
		};
		$.ajax({
			'type':'post',
			'data':data,
			'url':ajaxtut.ajax_url ,
			success:function(data)
			{
				$('.love-send a').html('I like the post' + data);
			}

		});
	});
});