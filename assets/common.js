jQuery(document).ready(function($){
	function _delete($){
		$('.btn-delete').on('click', function(e){
			e.preventDefault();
			var data_list = '.' + $(this).attr('data-result_to');
			var cf = confirm($(this).attr('data-confirm'));
			if( cf == true ){
				$.ajax({
					url: '/',
					type: 'POST',
					data: {
						module : $(this).attr('data-module'),
						action : 'delete',
						ID : $(this).attr('data-id'),
					},
					success: function(response){
						console.log(response);
						$(data_list).html(response);
						//location.reload();
						_delete($);
					}
				});
			}
		});
	}
	
	_delete($);
	$('form').submit(function(e){
		e.preventDefault();
		var _form = $(this);
		var formData = $(this).serialize();
		if( typeof  $(this).attr('data-confirm') !== 'undefined' ){
			var cf = confirm($(this).attr('data-confirm'));
			if( cf !== true ){
				return false;
			}
		}
		$.ajax({
			url: '/',
			type: 'POST',
			data: {
				data: formData
			},
			success: function(response){
				if( response.status == 'success' ){
					if( typeof response.redirect_to !== 'undefined' ){
						location.replace(response.redirect_to);
					}else{
						$('.message').addClass('alert alert-success');
						$('.message').text(response.message);
						_form[0].reset();
					}
				}else{
					$('.message').addClass('alert alert-danger');
					$('.message').text(response.message);
				}
			},
			error: function(response){
				console.log(response);
			}
		});
	});
});