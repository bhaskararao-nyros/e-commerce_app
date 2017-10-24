//global declaration of datatable
var dataTable;

$(document).ready(function(){
	dataTable = $("#datatableId").DataTable({
		"ajax": "retrieve.php",
		"order": []
	});

	$('.numonly').on('keypress',function(evt) {
		   	var charCode = (evt.which) ? evt.which : event.keyCode
         	if (charCode > 31 && (charCode < 48 || charCode > 57))
            	return false;
            return true;
	  	});

//add user button function
	$("#addUserBtn").on('click', function(){
		$('#addUserForm')[0].reset();
		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		$(".messages").html('');
		$("#message").html('');

//add user form validation
		$('#addUserForm').unbind('submit').bind('submit', function(){
			var form = $(this);
			$('.text-danger').remove();

			var name = $('#name').val();
			var email = $('#email').val();
			var phone = $('#phone').val();
			var address = $('#address').val();
			var phonereg = new RegExp(/([0-9])+$/);
			var namereg = new RegExp(/^([A-Za-z])+$/);

			
			if(name == "") {
				$("#name").closest('.form-group').addClass('has-error');
				$('#name').after('<p class="text-danger">Please enter your name</p>');
			}
			else if(!namereg.test(name)) {
				$("#name").closest('.form-group').addClass('has-error');
				$('#name').after('<p class="text-danger">Name allowed characters only</p>');
				return false;
			}else if(name.length < 3 ) {
				$("#name").closest('.form-group').addClass('has-error');
				$('#name').after('<p class="text-danger">Name must be atleast 3 characters</p>');
				return false;
			}
			else {
				$("#name").closest('.form-group').removeClass('has-error');
				$("#name").closest('.form-group').addClass('has-success');
			}
			if(email == "") {
				$("#email").closest('.form-group').addClass('has-error');
				$('#email').after('<p class="text-danger">Please enter your email</p>');
			}else {
				$("#email").closest('.form-group').removeClass('has-error');
				$("#email").closest('.form-group').addClass('has-success');
			}
			if(phone == "") {
				$("#phone").closest('.form-group').addClass('has-error');
				$('#phone').after('<p class="text-danger">Please enter your phone number</p>');
			}
			else if(!phonereg.test(phone)) {
				$("#phone").closest('.form-group').addClass('has-error');
				$('#phone').after('<p class="text-danger">Phone number allowed numbers only</p>');
				return false;
			}
			else if(phone.length != 10) {
				$("#phone").closest('.form-group').addClass('has-error');
				$('#phone').after('<p class="text-danger">Phone length should be 10 digits</p>');
				return false;
			}
			else {
				$("#phone").closest('.form-group').removeClass('has-error');
				$("#phone").closest('.form-group').addClass('has-success');

			}
			if(address == "") {
				$("#address").closest('.form-group').addClass('has-error');
				$('#address').after('<p class="text-danger">Please enter your address</p>');
			}else {
				$("#address").closest('.form-group').removeClass('has-error');
				$("#address").closest('.form-group').addClass('has-success');
			}

	//ajax request to insert.php		
			if (name && email && phone && address) {
				$.ajax({
					url : form.attr('action'),
					type : form.attr('method'),
					data : form.serialize(),
					dataType : 'json',
					success:function(response){
						$(".form-group").removeClass("has-error").removeClass("has-success");
						if (response.success == true) {

							//alert message on success
							$(".messages").html('<div class="alert alert-success" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong> '+response.messages+
							'</div>');

								$("#addUserForm")[0].reset();
								$("#addUserModal").modal("hide");
								dataTable.ajax.reload(null, false);
						}else {

							//alert message on failure
							$("#message").html('<div class="alert alert-warning " role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'+response.messages+
							'</div>');
							$("#email").focus();
						}
					}
				});
			}
			return false;
		});
	});
});
//add user and datatable ending

//delete user function starting
function delUser(id = null) {
	if (id) {
		$("#delUserBtn").unbind('click').bind('click', function(){
			$.ajax({
				url: 'delete.php',
				type: 'post',
				data: {user_id: id},
				dataType: 'json',
				success: function(response) {
					if (response.success == true) {

						//alert message on success
						$(".messages").html('<div class="alert alert-success" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong>'+response.messages+
							'</div>');

						dataTable.ajax.reload(null, false);
						$("#delUserModal").modal('hide');

					} else {

						//alert message on failure
						$(".messages").html('<div class="alert alert-warning " role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'+response.messages+
							'</div>');
					}
				}
			});
		});
	}else {
		alert("Error : Refresh the page again");
	}
}
//delete user function ending

//edit user function starting
function editUser(id = null) {
	if (id) {

		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();
		$("#editMessage").html('');
		$("#user_id").remove();

		$.ajax({
			url: "getSelectedUser.php",
			type: "post",
			data: {user_id: id},
			dataType: "json",
			success: function(response) {
				$("#editName").val(response.name);
				$("#editEmail").val(response.email);
				$("#editPhone").val(response.phone);
				$("#editAddress").val(response.address);

				$("#editUserId").append('<input type="hidden" name="user_id" id="user_id" value="'+response.id+'"/>');
				
				$('#editUserForm').unbind('submit').bind('submit', function(){
					var form = $(this);

					$('.text-danger').remove();

			//edit user form validation		
					var editName = $('#editName').val();
					var editEmail = $('#editEmail').val();
					var editPhone = $('#editPhone').val();
					var editAddress = $('#editAddress').val();
					var phonereg = new RegExp(/([0-9])+$/);
					var namereg = new RegExp(/^([A-Za-z])+$/);
					
					if(editName == "") {
						$("#editName").closest('.form-group').addClass('has-error');
						$('#editName').after('<p class="text-danger">Please enter your name</p>');
					}
					else if(!namereg.test(editName)) {
						$("#editName").closest('.form-group').addClass('has-error');
						$('#editName').after('<p class="text-danger">Name allowed characters only</p>');
						return false;
					}else if(editName.length < 3 ) {
						$("#editName").closest('.form-group').addClass('has-error');
						$('#editName').after('<p class="text-danger">Name length must not lessthan 3 characters</p>');
						return false;
					}
					else {
						$("#editName").closest('.form-group').removeClass('has-error');
						$("#editName").closest('.form-group').addClass('has-success');
					}
					if(editEmail == "") {
						$("#editEmail").closest('.form-group').addClass('has-error');
						$('#editEmail').after('<p class="text-danger">Please enter your email</p>');
					}else {
						$("#editEmail").closest('.form-group').removeClass('has-error');
						$("#editEmail").closest('.form-group').addClass('has-success');
					}
					if(editPhone == "") {
						$("#editPhone").closest('.form-group').addClass('has-error');
						$('#editPhone').after('<p class="text-danger">Please enter your phone number</p>');
					}
					else if(!phonereg.test(editPhone)) {
						$("#editPhone").closest('.form-group').addClass('has-error');
						$('#editPhone').after('<p class="text-danger">Phone number allowed numbers only</p>');
						return false;
					}
					else if(editPhone.length != 10) {
						$("#editPhone").closest('.form-group').addClass('has-error');
						$('#editPhone').after('<p class="text-danger">Phone number should be 10 digits length</p>');
						return false;
					}
					else {
						$("#editPhone").closest('.form-group').removeClass('has-error');
						$("#editPhone").closest('.form-group').addClass('has-success');
					}
					if(editAddress == "") {
						$("#editAddress").closest('.form-group').addClass('has-error');
						$('#editAddress').after('<p class="text-danger">Please enter your address</p>');
					}else {
						$("#editAddress").closest('.form-group').removeClass('has-error');
						$("#editAddress").closest('.form-group').addClass('has-success');
					}
					
					if (editName && editEmail && editPhone && editAddress) {
						 $.ajax({
						 	url: form.attr("action"),
						 	type: form.attr("method"),
						 	data: form.serialize(),
						 	dataType: "json",
						 	success: function(response){
						 		if (response.success == true) {

						 			//alert message on success
						 			$(".messages").html('<div class="alert alert-success" role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong> '+response.messages+
									'</div>');

						 			$("#editUserModal").modal("hide");
									dataTable.ajax.reload(null, false);
						 		} else {

						 			//alert message on failure
						 			$("#editMessage").html('<div class="alert alert-warning " role="alert">'+
									  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
									  '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'+response.messages+
									'</div>');
									$("#editEmail").focus();
						 		}
						 	}
						 })
					}
					return false;
				});
			}
		});

	} else {
		alert("Error : Refresh the page again");
	}
}
//edit user function ending