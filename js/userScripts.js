$(function() {
	changeWidth(980);

	$('#buttons input').click(function(){
		changeWidth($(this).val());
	});

	function changeWidth(menuWidth){
		var menuItems = $('#menu li').size();
		var itemWidth = (menuWidth/menuItems)-2;

		$('#menu').css({
			'width': menuWidth +'px'
		});
		$('#menu a').css({
			'width': itemWidth +'px'
		});
	}
});
$(document).ready(function(){ 
	$('.splLink').click(function(){ 
		$(this).parent().children('div.splCont').toggle('normal');
	});
	
	$("#testin").blur(
		function (){
			$.ajax({
				url: '/create_account/userInDataBase/',
				type: 'POST',
				data: "name=" + $("#testin").val(),
				dataType : "json",
				success:  function(json){
						$('#testdv').html('<span>'+json.login+'</span>');
				}
			});
			return false;
		}
		);
	
	
	$("#authorizaion").submit(
		function (){
			$.ajax({
				url: '/login/',
				type: 'POST',
				data: "act=login&login=" + $("#inputLogin").val()+"&password="+$("#inputPassword").val(),
				dataType : "json", 
				success:  function(json){
					if(json.status == 'ok')
						window.location.href=json.redirect;
					else
						$('.redText>span').replaceWith('<span>'+json.errorMsg+'</span>');
				}
			});
			return false;
		}
		);
	$("#inputLogin").focus();
	
});

