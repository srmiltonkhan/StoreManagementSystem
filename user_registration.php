<?php include("db_connection.php");?>
<!-- Add Dashboard Parent File -->
<?php require 'dashboard_parent_file.php';?>
 <!-- HTML and Head Taq Section -->
<?php echo $html_and_head_section; ?>
<body style="background-color: #f2f2f2">
	<div class="container">
		<div class="py-5">
			<p id="alert_action" class="mb-0"></p> 
			<div class="custom-bg-secondary">
				<h1 class="py-3 pl-5">User Registration</h1>
			</div>
			<div class="margin">
						<div class="bg-white p-3">
								<div class="border p-2">
										<form method="post" id="user_registration_form" enctype="multipart/form-data">
											<div class="form-row p-1">
												<div class="col">
													<label for='user_name'>Name <span class="text-red">*</span></label>
													<input type="text" name="user_name" id="user_name" class="form-control form-control-sm" maxlength="50">
													<div id="invalid_feedback_user_name" class="text-danger reset_label"></div>
												</div>
											</div>
											<div class="form-row  p-1">
												<div class="col-md-6">
													<label for='user_email'>Email <span class="text-red">*</span></label>
													<input type="email" name="user_email" id="user_email" class="form-control form-control-sm" maxlength="50">
													<div id="invalid_feedback_user_email" class="text-danger reset_label"></div>
												</div>
												<div class="col">
													<label for='user_mobile'>Mobile <span class="text-red">*</span></label>
													<input type="text" name="user_mobile" id="user_mobile" class="form-control form-control-sm" maxlength="15">
													<div id="invalid_feedback_user_mobile" class="text-danger reset_label"></div>
												</div>
											</div>
											<div class="form-row  p-1">
												<div class="col-md-6">
													<label for='user_department'>Department <span class="text-red">*</span></label>
													<select name="user_department" id="user_department" class="form-control form-control-sm selectpicker border" data-live-search="true" data-size="5">
														<option value="">Select Your Department</option>
														<?php require('department_select_option.php');?>
													</select>
													<div id="invalid_feedback_user_department" class="text-danger reset_label"></div>
												</div>
												<div class="col">
													<label for='user_designation'>Designation<span class="text-red">*</span></label>
													<input type="text" name="user_designation" id="user_designation" class="form-control form-control-sm" maxlength="50">
													<div id="invalid_feedback_user_designation" class="text-danger reset_label"></div>
												</div>
											</div>									
											<div class="form-row  p-1">
												<div class="col-md-6">
													<label for='user_password'>Password <span class="text-red">*</span></label>
													<input type="password" name="user_password" id="user_password" class="form-control form-control-sm" maxlength="50">
													<div id="invalid_feedback_user_password" class="text-danger reset_label"></div>
												</div>
												<div class="col">
													<label for='user_confirm_password'>Confirm Password <span class="text-red">*</span></label>
													<input type="password" name="user_confirm_password" id="user_confirm_password" class="form-control form-control-sm">
													<div id="invalid_feedback_user_confirm_password" class="text-danger reset_label"></div>
													<div id="invalid_feedback_password_match"></div>
												</div>
											</div>
											<div class="form-row mt-2  p-1">
												<div class="col">
														<label for='user_image'>Profile Image<span class="text-red">*</span></label>
													<div class="custom-file">
														<input type="file" class="custom-file-input form-control-sm" id="user_image" name="user_image" maxlength="50">
														<label class="custom-file-label" id="user_image" name="user_image" for="customFile" class="reset_label">Choose Image File</label>
														<div id="invalid_feedback_user_image" class="text-danger"></div>
														<div id="invalid_feedback_user_image_validation" class="text-danger reset_label"></div>
														<div id="file_error" class="reset_label"></div>
													</div>
													<script type="text/javascript">
														$(".custom-file-input").on("change",function(){
															var user_image = $(this).val().split("\\").pop();
															$(this).siblings(".custom-file-label").addClass("selected").html(user_image)
														})
													</script>
												</div>
											</div>	
										<div class="form-row mt-5">
												<div class="col-md-4">
												</div>
												<div class="col-md-4">
												</div>											
												<div class="col-md-4">
													<input type="hidden" name="user_id_hidden" id="user_id_hidden">
													<input type="hidden" name="action_hidden" id="action_hidden">
													<input type="submit" name="action_submit" id="action_submit" value="Register" class="btn btn-primary btn-sm form-control form-control-sm">
												</div>	
										</div>
										<div class="form-row p-3">
											<div class="col">
												<span>Already Have an account? <b><a href="#">Login Here</a></b></span>
											</div>
										</div>																																					
										</form>
								</div>
							</div>
			</div>
		</div>
	</div>
</body>
<!-- End Body and HTML TaqJavaScript Section-->
<?php echo $end_body_html_and_java_script_section; ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#user_confirm_password").keyup(function(){
			if ($("#user_password").val() != $("#user_confirm_password").val()) {
				$("#invalid_feedback_password_match").html("Password doesn't match").css("color","red");
			}else{
				$("#invalid_feedback_password_match").html("Password has been matched").css("color","green");
			}
		});
		$('#action_hidden').val('Add');
		$(document).on('submit', '#user_registration_form', function(event){
			event.preventDefault();
			var user_name = $('#user_name').val();
			var user_email = $('#user_email').val();
			var user_mobile = $('#user_mobile').val();
			var user_department = $('#user_department').val();
			var user_designation = $('#user_designation').val();
			var user_password = $('#user_password').val();
			var user_confirm_password = $('#user_confirm_password').val();
			var extension = $('#user_image').val().split('.').pop().toLowerCase();
			var file_size = $('#user_image')[0].files[0].size;
			if (user_name == '') {
				document.getElementById('invalid_feedback_user_name').innerHTML = 'Please Enter Your Name.';
			}else if (user_email == '') {
				document.getElementById('invalid_feedback_user_email').innerHTML = 'Please Enter Your Email Address.';
				$('#invalid_feedback_user_name').empty();
			}else if (user_mobile == '') {
				document.getElementById('invalid_feedback_user_mobile').innerHTML = 'Please Enter Your Mobile Number.';
				$('#invalid_feedback_user_email').empty();
			}else if (user_department == '') {
				document.getElementById('invalid_feedback_user_department').innerHTML = 'Please Select Your Department.';
				$('#invalid_feedback_user_mobile').empty();
			}else if (user_designation == '') {
				document.getElementById('invalid_feedback_user_designation').innerHTML = 'Enter Your Designation.';
				$('#invalid_feedback_user_department').empty();
			}else if (user_password == '') {
				document.getElementById('invalid_feedback_user_password').innerHTML = 'Enter Your Password.';
				$('#invalid_feedback_user_designation').empty();
			}else if (user_confirm_password == '') {
				document.getElementById('invalid_feedback_user_confirm_password').innerHTML = 'Enter Your Confirm Password.';
				$('#invalid_feedback_user_password').empty();
			}else if (extension == '') {
				document.getElementById('invalid_feedback_user_image').innerHTML = 'Please Choose Your Profile Image.';
				$('#invalid_feedback_user_confirm_password').empty();
			}else if (jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {
				document.getElementById('invalid_feedback_user_image_validation').innerHTML = 'Please Choose Valid Profile Image.';
				$('#invalid_feedback_user_image').empty();
				$('#user_image').val('');
				return false;			
			}else if (file_size>15365) {
				$("#file_error").html("File size is greater than 15 KB").css("color","red");
			}
			else{
					$.ajax({
					url:"user_registration_action.php",
					method:'POST',
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){
						$('#alert_action').fadeIn().html('<div class = "alert alert-success">'+data+'</div>');
						$('#user_registration_form')[0].reset();
						$("#invalid_feedback_password_match").empty();
						$("#user_department").val('').selectpicker("refresh");
						$('.reset_label').empty();	
					}
				});
			}
		});
	});
</script>