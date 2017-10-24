$(document).ready(function() {
		$("#add_cat").click(function() {
			$("#textdiv").toggle();
            $("#addcatdiverror").html("");
		});
		$("#textinput").keyup(function(event){

            $("#addcatdiverror").html("");
			var category = $(this).val();
			var firstletter = category.charAt(0);
			var capitalreg = new RegExp(/^[A-Z]*$/);
			if(capitalreg.test(firstletter) && category != ''){

			    if(event.keyCode == 13){

			        $.ajax({
			        	url:"create_cat.php",
			        	type:"post",
			        	dataType:"json",
			        	data:{category:category},
			        	success:function(response) {
			        		if (response.success == true) {
			        			location.reload();
			        		}
			        	}
			        });
			    }
			} else {
				$("#addcatdiverror").html("<p class='text-danger'>Enter first letter in capital</p>");
			}
		});
	});
	function subCat(id) {
		$('#subtextdiv_'+id+'').toggle();
        $('#subcatdiverror_'+id).html('');
	}
	function editCat(id) {
		$('#edittextdiv_'+id+'').toggle();
        $('#editcatdiverror_'+id).html("");
	}
	function editSubCat(id) {
		$('#editsubtextdiv_'+id+'').toggle();
        $('#editsubcatdiverror_'+id).html("");
	}
	function editCatText(id,cc,event) {

        $('#editcatdiverror_'+id).html("");
        var x = event.which || event.keyCode;
        var jq = $(cc);
        var category =jq.val();
        var firstletter = category.charAt(0);
        var capitalreg = new RegExp(/^[A-Z]*$/);
        if(capitalreg.test(firstletter) && category != ''){
            if(event.keyCode == 13){
                $.ajax({
                    url:"edit_cat.php",
                    type:"post",
                    dataType:"json",
                    data:{category:category, item_id:id},
                    success:function(response) {
                          
                        if (response.success == true) {
                        	location.reload();
                        }
                    }
                });
            } 
        }else {
            $('#editcatdiverror_'+id).html("<p class='text-danger'>Enter first letter in capital</p>");
        }
	}

	function editSubCatText(id,cc,event) {

        $('#editsubcatdiverror_'+id).html("");
        var x = event.which || event.keyCode;
        var jq = $(cc);
        var subcategory =jq.val();
        var firstletter = subcategory.charAt(0);
        var capitalreg = new RegExp(/^[A-Z]*$/);
        if(capitalreg.test(firstletter) && subcategory != ''){
            if(event.keyCode == 13){
                $.ajax({
                    url:"edit_sub_cat.php",
                    type:"post",
                    dataType:"json",
                    data:{subcategory:subcategory, sub_cat_id:id},
                    success:function(response) {
                          
                        if (response.success == true) {
                        	location.reload();
                        }
                    }
                });
            } 
        }else {
            $('#editsubcatdiverror_'+id).html("<p class='text-danger'>Enter first letter in capital</p>");
        }
	}
	function deleteCat(id) {
		var result = confirm("Are you sure to delete this category");
		if (result) {
		    $.ajax({
		    	url:"delete_cat.php",
                type:"post",
                dataType:"json",
                data:{item_id:id},
                success:function(response) {
                    if (response.success == true) {
                    	location.reload();
                    }
                }
		    })
		}
	}

	function delSubCat(id) {
		var result = confirm("Are you sure to delete this subcategory");
		if (result) {
		    $.ajax({
		    	url:"del_sub_cat.php",
                type:"post",
                dataType:"json",
                data:{sub_cat_id:id},
                success:function(response) {
                    if (response.success == true) {
                    	location.reload();
                    }
                }
		    })
		}
	}

	function addSubCat(id,cc,event) {
		$('#subcatdiverror_'+id).html('');
        var x = event.which || event.keyCode;
        var jq = $(cc);
        var subcategory =jq.val();
        var firstletter = subcategory.charAt(0);
        var capitalreg = new RegExp(/^[A-Z]*$/);
        if(capitalreg.test(firstletter) && subcategory != ''){
            if(event.keyCode == 13){
                $.ajax({
                    url:"add_sub_cat.php",
                    type:"post",
                    dataType:"json",
                    data:{subcategory:subcategory, cat_id:id},
                    success:function(response) {
                          
                        if (response.success == true) {
                        	location.reload();
                        }
                    }
                });
            } 
        }else {
            $('#subcatdiverror_'+id).html("<p class='text-danger'>Enter first letter in capital</p>");
        }
	}