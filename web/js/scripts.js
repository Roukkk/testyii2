$(function(){
	
	$('.table').on('blur', '.requestname', function(e){
		var input = $(this);
		var id = input.attr('id');
		var name = input.val();
		
		input.css({borderColor : "#5cb85c"});
		setTimeout(function(){
			  input.css({borderColor : "inherit"});
			}, 500);		
		e.preventDefault();
			
		$.ajax({
			url: 'updatename',
			data: {id:id,name:name},
			type: 'POST',
			success: function(response){
				input.val(response);
				
			},
			error: function(){
				alert('Error');
			}
			
		});
	});
	
	$('.table').on('blur', '.requestmail', function(e){
		var input = $(this);
		var id = input.attr('id');
		var email = input.val();
		
		input.css({borderColor : "#5cb85c"});
		setTimeout(function(){
			  input.css({borderColor : "inherit"});
			}, 500);		
		e.preventDefault();
			
		$.ajax({
			url: 'updatemail',
			data: {id:id,email:email},
			type: 'POST',
			success: function(response){
				input.val(response);
				
			},
			error: function(){
				alert('Error');
			}
			
		});
	});
	
	$('.table').on('blur', '.requesttext', function(e){
		var input = $(this);
		var id = input.attr('id');
		var text = input.val();
		
		input.css({borderColor : "#5cb85c"});
		setTimeout(function(){
			  input.css({borderColor : "inherit"});
			}, 500);		
		e.preventDefault();
			
		$.ajax({
			url: 'updatetext',
			data: {id:id,text:text},
			type: 'POST',
			success: function(response){
				input.val(response);
				
			},
			error: function(){
				alert('Error');
			}
			
		});
	});
});