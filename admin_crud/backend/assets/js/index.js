//global declaration of datatable
var dataTable;
var subCatId='', catId='';
$(document).ready(function(){

	dataTable = $("#datatableId").DataTable({
		"ajax": { 
            "url": "retrieve.php",
            "type": "POST",
            "dataType": "json",
            "data": function(d) {
                d.sub_cat_id = subCatId;
                d.cat_id = catId;
            }
        },
        "order": []
	});



	$('.number').keypress(function(event) {

     if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
          return true;

     else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
          event.preventDefault();

	});

//add user button function
	$("#addProductBtn").on('click', function(){
		$('#addProductForm')[0].reset();
		$('.text-danger').remove();
		$(".messages").html('');
		$("#message").html('');
		$("#preimages").html('');
	});
//add user form validation
		$('#addProductForm').on('submit', function(e){
			e.preventDefault();

			var productname = $('#productname').val();
			var specifications = $('#specifications').val();
			var productimage = $('#productimage').val();
			var price = $('#price').val();
			var namereg = new RegExp(/^[a-zA-Z ]*$/);

			
			if(productname == "") {
				$('#productname').after('<p class="text-danger">Please enter product name</p>');
			}
			if(!namereg.test(productname)) {
				$('#productname').after('<p class="text-danger">Productname allowed characters only</p>');
			}
			if (price == "") {
				$('#price').after('<p class="text-danger">Please enter product price</p>');
			}
			if(specifications == "") {
				$('#specifications').after('<p class="text-danger">Specifications should not be blank</p>');
			}
			if(productimage == "" ) {
				$('#productimage').after('<p class="text-danger">Please upload image</p>');
			}
		});

		$("#productimage").change(function(){
			var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
			if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only these formats are allowed : "+fileExtension.join(', '));
        	} else {
			    $.ajax({
					url: "upload.php",
		            type:'POST',
		            data:new FormData($('#addProductForm')[0]),
		            dataType:'json',
		            contentType: false,
			        processData: false,
		            success:function(response){
		            	
		            	imgs = response['imgs'];
		            	imgdata = '';
		            	hdnImgs = '';
		            	for(i=0;i<imgs.length;i++)
		            	{
		        		imgdata += "<img src='"+imgs[i]+"' width='100px' height='100px' class='img-thumbnail'>";
		        		hdnImgs += imgs[i]+',';
		            	}
		            	$('#imgs').val(hdnImgs);
		            	$("#preimages").html(imgdata);	
		            }
				});
			}
		});


		$('#addProductForm').on('submit', function(e){
			e.preventDefault();
			$('.text-danger').remove();
			var productname = $('#productname').val();
			var specifications = $('#specifications').val();
			var productimage = $('#productimage').val();
			var maincategory = $('#addselcatdd option:selected').val();
			var subcategory = $('#addsubcatdd option:selected').val();
			
			var price = $('#price').val();
			var namereg = new RegExp(/^[a-zA-Z ]*$/);

			if(productname == "") {
				$('#productname').after('<p class="text-danger">Please enter product name</p>');
			}
			if(!namereg.test(productname)) {
				$('#productname').after('<p class="text-danger">Productname allowed characters only</p>');
			}
			if (price == "") {
				$('#price').after('<p class="text-danger">Please enter product price</p>');
			}
			if(specifications == "") {
				$('#specifications').after('<p class="text-danger">Specifications should not be blank</p>');
			}
			if(productimage == "") {
				$('#productimage').after('<p class="text-danger">Please upload image</p>');
			}
			if(maincategory == 0) {
				$('#addselcatdd').after('<p class="text-danger">Please select category</p>');
			}
			if(subcategory == 0) {
				$('#addsubcatdd').after('<p class="text-danger">Please select sub-category</p>');
			}


	//ajax request to insert.php	
			if(productname && productimage && specifications && price && maincategory && subcategory) {
				$.ajax({
					url: "insert.php",
			        type:'POST',
			        data:new FormData(this),
			        dataType: 'json',
			        contentType: false,
			        processData: false,
			        success:function(response){
			        	if(response.success == true) {

			        		$(".messages").html('<div class="alert alert-success" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong> '+response.messages+
							'</div>');
			        	$('#addProductForm')[0].reset();
			        	$("#addimage").addClass('hide');
			        	$("#addProductModal").modal("hide");
			        	dataTable.ajax.reload(null, false);
			        	$(".messages").show();
			        	$(".messages").fadeOut(3000);

			        	} else {
			        		$("#message").html('<div class="alert alert-warning " role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'+response.messages+
							'</div>');
			        	}

			        }
			       
			    });
			}
		return false;
		});   //form validation ending


$('#btn_update').on('click', function(){
					
		$('.text-danger').remove();

//edit user form validation		
		var editproductname = $('#editproductname').val();
		var editspecifications = $('#editspecifications').val();
		var editproductimage = $('#editproductimage').val();
		var editmaincategory = $('#editmaincatdd option:selected').val();
		var editsubcategory = $('#editsubcatdd option:selected').val();
		var editprice = $("#editprice").val();
		var editimgs = $("#editimgs").val();
		// var imgsrc = $("")
		var editnamereg = new RegExp(/^[a-zA-Z ]*$/);
		
		
		if(editproductname == "") {
			$('#editproductname').after('<p class="text-danger">Please enter product name</p>');
		}
		else if(!editnamereg.test(editproductname)) {
			$('#editproductname').after('<p class="text-danger">Productname allowed characters only</p>');
		} else {
			$('.text-danger').remove();
		}
		if (editprice == "") {
			$('#editprice').after('<p class="text-danger">Please enter product price</p>');
		}
		if(editspecifications == "") {
			$('#editspecifications').after('<p class="text-danger">Specifications should not be blank</p>');
		}
		if(editmaincategory == 0) {
			$('#editmaincatdd').after('<p class="text-danger">Please select category</p>');
		}
		if(editsubcategory == 0) {
			$('#editsubcatdd').after('<p class="text-danger">Please select sub-category</p>');
		}
		if(editproductimage == "" && editimgs == "") {
			$('#editproductimage').after('<p class="text-danger">Please upload image</p>');
		}
		else
		{
			editproductimage = 1;
		}
		
		if (editproductname && editspecifications && editproductimage && editprice) {
			 $.ajax({
			 	url: 'update.php',
			 	type: 'POST',
			 	data: new FormData($('#editProductForm')[0]),
			 	dataType: "json",
			 	 processData: false,
				 contentType: false,
			 	success: function(response){
			 		if (response.success == true) {
			 			//alert message on success
			 			$(".messages").html('<div class="alert alert-success" role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong> '+response.messages+
						'</div>');


			 			$("#editProductModal").modal("hide");
						dataTable.ajax.reload(null, false);
						$(".messages").show();
			        	$(".messages").fadeOut(3000);
					
			 		} else {

			 			//alert message on failure
			 			$("#editMessage").html('<div class="alert alert-warning " role="alert">'+
						  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
						  '<strong><span class="glyphicon glyphicon-exclamation-sign"></span></strong>'+response.messages+
						'</div>');
			 		}
			 	}
			 });
		}
		return false;
	});

});
//add user and datatable ending

//delete user function starting
function delProduct(id = null) {
	if (id) {
		$("#delProductBtn").unbind('click').bind('click', function(){
			$.ajax({
				url: 'delete.php',
				type: 'post',
				data: {product_id: id},
				dataType: 'json',
				success: function(response) {
					if (response.success == true) {

						//alert message on success
						$(".messages").html('<div class="alert alert-success" role="alert">'+
							  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
							  '<strong><span class="glyphicon glyphicon-ok-sign"></span></strong>'+response.messages+
							'</div>');

						$("#delProductModal").modal("hide");
						dataTable.ajax.reload(null, false);
						$(".messages").show();
			        	$(".messages").fadeOut(3000);
						

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
var preimgdata;
var prehdnImgs;
function editProduct(id = null) {
	if (id) {
		$('.text-danger').remove();
		$("#editMessage").html('');
		$('#product_id').val(id);
		$("#editproductimage").val('');
		$("#extraimages").html('');


		$.ajax({
			url: "getSelectedUser.php",
			type: "post",
			data: {pro_id: id},
			dataType: "json",
			success: function(response) {
				console.log(response);
				$("#editproductname").val(response['data'][0].name);
				$("#editspecifications").val(response['data'][0].specification);
				$("#editprice").val(response['data'][0].price);
				$("#editmaincatdd").val(response['data'][0].c_id);
				$(".selectsub").val(response['data'][0].sc_id);				




				imgs = response['imgs'];
        
            	preimgdata = '';
            	prehdnImgs = '';
            	
            	for(i=0;i<imgs.length;i++)
            	{
            		preimgdata += "<img src='uploads/"+imgs[i]+"' width='100px' height='100px' class='img-thumbnail' id='editimage'>";
            		prehdnImgs += imgs[i]+',';
            	}
            	$('#editimgs').val(prehdnImgs);
            	$("#editimages").html(preimgdata);
            			
			}
		});

	} else {
		alert("Error : Refresh the page again");
	}

	$("#editproductimage").change(function(){
		$('#editimgs').val('');
        $("#editimages").html('');
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
            alert("Only these formats are allowed : "+fileExtension.join(', '));
        } else {

	    $.ajax({
				url: "upload.php",
	            type:'POST',
	            data:new FormData($('#editProductForm')[0]),
	            dataType:'json',
	            contentType: false,
		        processData: false,
	            success:function(response){
	            	

	            	imgs = response['imgs'];
	        
	            	imgdata = '';
	            	hdnImgs = '';
	            	
	            	for(i=0;i<imgs.length;i++)
	            	{
	            		imgdata += "<img src='"+imgs[i]+"' width='100px' height='100px' class='img-thumbnail'>";
	            		hdnImgs += imgs[i]+',';
	            	}
	            	$('#editimgs').val(hdnImgs);
	            	$('#extimgs').val(prehdnImgs);
	            	$("#editimages").html(preimgdata);	
	            	$("#extraimages").html(imgdata);
	            }
		});
	}
	});


}

function delImg(id)
{
	$.ajax({
	  url:"del_img.php",
	  type:"post",
	  data:{image_id:id},
	  dataType:"json",
	  success:function(response) {
	  	if(response.success == true) {
	  		dataTable.ajax.reload(null, false);
	  	}
	  }
	});
}

function sortSubCat(selSubCatId,selCatId) {
        subCatId = selSubCatId;
        catId = selCatId;
        dataTable.ajax.reload();
}

//edit user function ending

