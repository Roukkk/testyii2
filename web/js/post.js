$(function(){
	
	$('.table').on('click', '.change', function(){
		var span = $(this);
		var id = span.attr('id');
		
		$.ajax({
			url: '',
			data: {span:span,id:id,name:name},
			type: 'POST',
			success: function(data){
				alert(id);
				
			},
			error: function(){
				alert('Error');
			}
			
		});
	});
	
	/*$('.table').on('blur', '.requestmail', function(e){
		var input = $(this);
		var id = input.attr('id');
		var name = input.val();
		
		e.preventDefault();
			
		$.ajax({
			url: 'updatename',
			data: {id:id,name:name},
			type: 'POST',
			success: function(res){
				name(res);
				
			},
			error: function(){
				alert('Error');
			}
			
		});
	});
	
	$('.table').on('blur', '.requesttext', function(e){
		var input = $(this);
		var id = input.attr('id');
		var name = input.val();
		
		e.preventDefault();
			
		$.ajax({
			url: 'updatename',
			data: {id:id,name:name},
			type: 'POST',
			success: function(res){
				name(res);
				
			},
			error: function(){
				alert('Error');
			}
			
		});
	});*/

});