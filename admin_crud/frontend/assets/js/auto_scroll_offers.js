$(document).ready(function(){
      var limit = 8;
      var start = 0;
      var action = "inactive";

      function load_data(limit, start) {
        $.ajax({
          url: "fetch_scroll_offers.php",
          method:"POST",
          data:{limit:limit, start:start},
          cache:false,
          success:function(data) {
            $("#productImages").append(data);
            if (data == '') {
              $("#message").html("<button class='btn btn-warning btn-block'>No more products avaliable</button>");
              action = "active";
            } else {
              $("#message").html('<img src="./assets/images/loader.gif" width="50px" height="50px">');
              action = "inactive";
            }
    
              $( "input[name='rateyoid']" ).each( function() {
      				  var current_rating = $(this).val();	
      				  $(this).parent().find('div').rateYo({
        				  starWidth: '15px',
        				  halfStar: true,
                  readOnly: true,
        				  rating: current_rating
      				  });
			        });
            
          }
        });
      }

      if (action == "inactive") {
        action = "active";
        load_data(limit, start);
      } 
      $(window).scroll(function(){
        if($(window).scrollTop() + $(window).height() > $("#productImages").height() && action == "inactive") {
          action = "active";
          start = start + limit;
          setTimeout(function(){
            load_data(limit, start);
          }, 2000);
        }
      });

 });
