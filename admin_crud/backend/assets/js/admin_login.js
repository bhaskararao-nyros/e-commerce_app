$(document).ready(function(){

	$("#username").focus(function() {
		$(this).attr('placeholder', "");
		$("#nametext").removeClass('hide');
	});
	$("#password").focus(function() {
		$(this).attr('placeholder', "");
		$("#passtext").removeClass('hide');
	});
	$("#username").blur(function() {
		$(this).attr('placeholder', "Enter username");
		$("#nametext").addClass('hide');
	});
	$("#password").blur(function() {
		$(this).attr('placeholder', "Enter password");
		$("#passtext").addClass('hide');
	});

	$("#login_btn").click(function() {
		name = $("#username").val();
		password = $("#password").val();
		remember = $("#remember").val();

		if(name == "") {
			$("#nameErr").html('<p>*Username required</p>');
		} else {
			$("#nameErr").html('');
		}
		if(password == "") {
			$("#passErr").html('<p>*Password required</p>');
			return false;
		} else {
			$("#passErr").html('');
		}
		
	});
});
