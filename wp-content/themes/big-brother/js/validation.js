(function($){$(document).ready(function() {

	var err = {};
	err.name = "Ви забули вказати своє ім\'я";
	err.email = "Ви не вказали вашу електронну адресу";
	err.sub = "Ви не вказали тему повідомлення";
	err.body = "Повідомлення не повинно бути порожнім";


 	function name(event){
		var re = /^.{3,15}$/;
		var span = $(this).parent().find('span');
		if($(this).val() == "") {
			err.name = "Ви забули вказати своє ім\'я";
			span.addClass("error").removeClass("success").html(err.name);
		} else if(re.test($(this).val())) {
			delete err.name;
			span.removeClass("error").addClass("success").html("Ваше ім'я");
		} else {
			err.name = "Неправильно вказано ім\'я";
			span.addClass("error").removeClass("success").html(err.name);
		}
	}
	$('[name = "formData[name]"]').focusout(name).keydown(name).keyup(name);

	function email(event){
		var re = /([a-z0-9_\.\-]{1,20})@([a-z0-9\.\-]{1,20})\.([a-z]{2,4})|is/;
		var span = $(this).parent().find('span');
		if($(this).val() == "") {
			err.email = "Ви не вказали вашу електронну адресу";
			span.addClass("error").removeClass("success").html(err.email);
		} else if(re.test($(this).val())) {
			delete err.email;
			span.removeClass("error").addClass("success").html("Електронна пошта");
		} else {
			err.email = "Неправильна адреса електронної пошти";
			span.addClass("error").removeClass("success").html(err.email);
		}
	}
  $('[name = "formData[email]"]').focusout(email).keydown(email).keyup(email);
	function sub(event){
		var span = $(this).parent().find('span');
		if($(this).val() == "") {
			err.sub = "Ви не вказали тему повідомлення";
			span.addClass("error").removeClass("success").html(err.sub);
		} else {
			span.removeClass("error").addClass("success").html("Тема повідомлення");
			delete err.sub;
		}
	}
	$('[name = "formData[sub]"]').focusout(sub).keydown(sub).keyup(sub);
	function body(event){
		var span = $(this).parent().find('span');
		if($(this).val() == "") {
			err.body = "Повідомлення не повинно бути порожнім";
			span.addClass("error").removeClass("success").html(err.body);
		} else {
			span.removeClass("error").addClass("success").html("Текст повідомлення:");
			delete err.body;
		}
	}
	$('[name = "formData[body]"]').focusout(body).keydown(body).keyup(body);

	$("#mailForm").submit(function(){
		 //console.log(err);
		if  (Object.keys(err).length){
			$('[name = "formData[name]"]').focusout(); 
			$('[name = "formData[email]"]').focusout(); 
			$('[name = "formData[sub]"]').focusout(); 
			$('[name = "formData[body]"]').focusout(); 
			return false;	
		}
		return true;
	})




});})(jQuery);
