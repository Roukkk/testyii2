$(function(){
	
	
	/* скролл*/
	$(document).on('click', '#nextstep1', function(){
		
		$('#step2').fadeIn(400);
		$('.footer-block').hide(400);
		$('html, body').animate({scrollTop:$(document).height()}, 'slow');
		bid=$('#adddetail').attr("border");
		pid=$('#adddetail').attr("price_id");
        $.ajax({
			async: true,
          type: "GET",
          url: "/index.php/orders/addpos",
          data: {border:bid,price_id:pid},
          success: function(data) {
            $("#orderPjax").html(data);
			totalSumm();
			updateCollection();
          },
          error:  function(xhr, str){
			alert("Возникла ошибка4: " + xhr.responseCode);
          }
        });
	});
	
	
	
	
	///сортировка результатов расчета
	$("#sort").change(function () {
		var mylist = $('.dealers-list-body');
		var listitems = mylist.children('div').get();
		
		if($("#sort").val()==1){
			
			listitems.sort(function(a, b) {
				var compA = parseInt($(a).attr('days'));
				var compB =parseInt($(b).attr('days'));
				return (compA  < compB) ? -1 : (compA > compB) ? 1 : 0;
			 });
		}else{
			listitems.sort(function(a, b) {
				var compA = parseInt($(a).attr('money'));
				var compB = parseInt($(b).attr('money'));
				return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
			 });
		}
		
		$.each(listitems, function(idx, itm) { mylist.append(itm); });
	});
	
	$(document).ready(function () {
		var mylist = $('.dealers-list-body');
		var listitems = mylist.children('div').get();
		
			listitems.sort(function(a, b) {
				var compA = parseInt($(a).attr('lenght'));
				var compB = parseInt($(b).attr('lenght'));
				return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
			 });

		
		$.each(listitems, function(idx, itm) { mylist.append(itm); });
	});
	

	
	//отправка заказа
	
	$(document).on('click', '#send', function(event){
		if (!event) {event=window.event}
		event.preventDefault();
		var personal = $('#personal').prop('checked');
		var organization = $('#organization').val();
		var name = $('#name').val();
		var orderId = $('#order_id').val();
		var phone = $('#phone').val();
		var email = $('#email').val();
		var town = $('#town').val();
		var shipping_adress = $('#shipping_adress').val();
		var placedelivery = $('#placedelivery').val();
		var type = 'service';
		var exec=true;
		if(personal != true){
			exec = false;
		}
		var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
		if($('.hideown').attr('is_hide') == 1){
			 type ='own';
		}
		if(name == ''){
			$('#name').addClass('error');
			exec = false;
		}else{
			$('#name').removeClass('error');
		}
		if(phone == ''){
			$('#phone').addClass('error');
			exec = false;
		}else{
			$('#phone').removeClass('error');
		}
		if(email == ''||!pattern.test(email)){
			$('#email').addClass('error');
			exec = false;
		}else{
			$('#email').removeClass('error');
		}
		if(town == ''){
			$('#town').addClass('error');
			exec = false;
		}else{
			$('#town').removeClass('error');
		}
		if(shipping_adress == '' && type=='service') {
			$('#shipping_adress').addClass('error');
			exec = false;
		}else{
			$('#shipping_adress').removeClass('error');
		}
		if(exec ==true&&$('#email').hasClass('error')==false && $('#shipping_adress').hasClass('error')==false){
			$('#pp_accepted').html("Ожидайте, ваш заказ обрабатывается.");
			$('#sendfancy').click();
			$.ajax({
				async: true,
				type: "POST",
				url: "/index.php/cart/finish",
				data: {name:name,phone:phone,email:email,town:town,
					shipping_adress:shipping_adress
					,placedelivery:placedelivery
					,type:type,organisation:organization
					,order_id:orderId},
				success: function(data) {
					$('#pp_accepted').html(data);
					return true;	
				},
				error:  function(xhr, str){
				  alert("Возникла ошибка10: " + xhr.responseCode);
				}
			});
		}
		return false;
	});
	
	


});