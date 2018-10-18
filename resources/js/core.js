$( document ).ready(function() {
   $( "#file_tree_form" ).submit(function( event ) { 
	  event.preventDefault();
	  var flag = 0;
	  var file_path = $("#file_path").val();
	  
	  if(file_path == '' || file_path == null){  
		  flag++;
		   $(".error").show().html('<p style="color:red">Please provide file path</p>'); 
		}  else {
			$(".error").empty(); 
		} 
		
		if (flag == 0) {
			 
			    $(".submit-button").hide();
				$(".process-button").show();
				$.ajax({
					type: "POST",
					url: "mod/add.php",
					data: { 'file_path' : file_path }, 
					dataType: 'json',
					success: function(data){
				 
						  if(data.status === 'success') {
							$("#file_tree_form").hide();	
							$(".response").show().html("<div class='alert alert-success'>"+data.message+"</div>"); 
							setTimeout(function() {
								window.location.href = "tree-list.php";
							}, 5000);
							  
						  } else {
							  $(".response").show().html("<div class='alert alert-danger'>"+data.message+"</div>"); 
							  $(".submit-button").show();
							  $(".process-button").hide();
						  }  
					}
					});
			
			
		}
	 
	  
	  
	});
});