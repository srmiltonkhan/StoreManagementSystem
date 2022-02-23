<!-- Add Dashboard Parent File -->
<?php require 'dashboard_parent_file.php';?>
 <!-- HTML and Head Taq Section -->
<?php echo $html_and_head_section; ?>
      <!-- Body and Header Section -->
    <?php echo $body_and_header_section; ?>
      <!-- Side Navbar Section -->
    <?php echo $side_nabar_and_content_inner_section; ?>
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">User Control</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >Users Information</div>
                <div class="col p-1" align="right">
                  <button class="btn btn-primary btn-sm launch-modal" data-toggle="modal" data-target="#user_modal" id="add_button"><i class="fas fa-plus-square"></i> Add User</button>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="user_data" class="table table-bordered table-hover table-striped table-sm" >
                      <thead class="thead-dark">
                        <tr>
                          <th width="3%">ID</th>
                          <th width="7%">Image</th>
                          <th width="20%">User Name</th>
                          <th width="18%">Email</th>
                          <th width="10%">User Mobile</th>
                          <th width="20%">User Department</th>
                          <th width="7%">Status</th>
                          <th width="16%">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>
          </section>
          <div id="user_details_modal" class="modal fade">
            <div class="modal-dialog modal-lg">
                <form method="post" id="user_form">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">test</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <Div id="user_details_data"></Div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- user update modal -->
              <div class="modal fade" id="user_modal">
               <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        <form method="post" id="insert_user_form" enctype="multipart/form-data">
                            <div class="modal-header">
                              <h6 class="modal-title"></h6>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
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
                               <div class="form-row p-1">
                                <div class="col-md-6">
                                    <label for='user_image'>Profile Image<span class="text-red">*</span></label>
                                  <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control-sm" id="user_image" name="user_image" maxlength="50" onchange="loadFile(event)"style="cursor: pointer;">
                                    <label class="custom-file-label" id="user_image" name="user_image" for="customFile" class="reset_label" style="cursor: pointer;">Choose Image File</label>
                                    <div id="invalid_feedback_user_image" class="text-danger reset_label mt-2"></div>
                                    <div id="invalid_feedback_user_image_validation" class="text-danger reset_label"></div>
                                    <div id="file_error" class="reset_label"></div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                   <img id="user_uploaded_image" width="100" height="100" class="img-thumbnail" />
                                </div>
                                 <script type="text/javascript">
                                    $(".custom-file-input").on("change",function(){
                                      var user_image = $(this).val().split("\\").pop();
                                      $(this).siblings(".custom-file-label").addClass("selected").html(user_image)
                                    });
                                    var loadFile = function(event) {
                                      var image = document.getElementById('user_uploaded_image');
                                      image.src = URL.createObjectURL(event.target.files[0]);
                                    };
                                  </script>                                
                              </div>                                                                                                                       
                            </div>
                              <div class="modal-footer">
                              <input type="hidden" name="user_id" id="user_id" >
                              <input type="hidden" name="action_hidden" id="action_hidden" >
                              <input type="submit" name="action_submit" id="action_submit"class="btn btn-primary btn-sm mb-0">
                              <button type="button" class="btn btn-info btn-sm mb-0" class="close" data-dismiss="modal" id="close_btn_category">Close</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
        <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
<script type="text/javascript" language="javascript" >
  //Password Matched verification
  $("#user_confirm_password").keyup(function(){
      if ($("#user_password").val() != $("#user_confirm_password").val()) {
        $("#invalid_feedback_password_match").html("Password doesn't match").css("color","red");
      }else{
        $("#invalid_feedback_password_match").html("Password has been matched").css("color","green");
      }
    });
$('document').ready(function(){
        $('#add_button').click(function(){
          $('#insert_user_form')[0].reset();
          $('#alert_action').empty();
          $('.modal-title').html("Add User");
          $('#action_submit').val('Save');
          $('#action_hidden').val('Add');   
        });
   // insert data into Database
        $(document).on('submit','#insert_user_form',function(event){
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
            $('#invalid_feedback_user_name').html('Please Enter Your Name.').css("color","red");
          }else if (user_email == '') {
             $('#invalid_feedback_user_email').html('Please Enter Your Name.').css("color","red");
             $('#invalid_feedback_user_name').empty();
           }else if (user_mobile == '') {
            $('#invalid_feedback_user_mobile').html('Please Enter Your Name.').css("color","red");
            $('#invalid_feedback_user_email').empty();
           }else if (user_department == '') {
            $('#invalid_feedback_user_department').html('Please Select Your Department Name.').css("color","red");
            $('#invalid_feedback_user_mobile').empty();
           }else if (user_designation == '') {
            $('#invalid_feedback_user_designation').html('Please Enter Your Designation.').css("color","red");
            $('#invalid_feedback_user_department').empty();
           }else if (user_password == '') {
            $('#invalid_feedback_user_password').html('Please Enter Your Password.').css("color","red");
            $('#invalid_feedback_user_designation').empty();
           }else if (user_confirm_password == '') {
            $('#invalid_feedback_user_confirm_password').html('Please Enter Your Confirm Password.').css("color","red");
            $('#invalid_feedback_user_password').empty();
           }else if (extension == '') {
            $('#invalid_feedback_user_image').html('Please Select Your Profile Image.').css("color","red");
            $('#invalid_feedback_user_confirm_password').empty();
           }else if (jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1) {
            document.getElementById('invalid_feedback_user_image_validation').innerHTML = 'Please Choose Valid Profile Image.';
            $('#invalid_feedback_user_image').empty();
            $('#user_image').val('');
            return false;     
          }else if (file_size>30721) {
            $("#file_error").html("File size is greater than 15 KB").css("color","red");
          }else{
              $.ajax({
              url:"user_registration_action.php",
              method:'POST',
              data:new FormData(this),
              contentType:false,
              processData:false,
              success:function(data){
                $('#alert_action').fadeIn().html('<div class = "alert alert-success">'+data+'</div>');
                $('#insert_user_form')[0].reset();
                $("#invalid_feedback_password_match").empty();
                $("#user_department").val('').selectpicker("refresh");
                $('.reset_label').empty();  
                $('#user_modal').modal("hide");
                dataTable.ajax.reload();
              }
            });
          }
      });
  // fetch data from database
        var dataTable = $('#user_data').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
          url:"user_control_fetch.php",
          type:"POST"
        },
        "columnDefs":[
          {
            "targets":[0, 3, 4],
            "orderable":false,
          },
        ],
      });
// view data from Database 
      $(document).on('click', '.view', function(){
          var user_id = $(this).attr("id");
          var btn_action = 'btn_user_details';
          $.ajax({
              url:"user_control_action.php",
              method:"POST",
              data:{user_id:user_id, btn_action:btn_action},
              success:function(data){
                  $('#user_details_modal').modal('show');
                  $('.modal-title').html('User Details');
                  $('#user_details_data').html(data);
              }
          })
      });
 // Update
     $(document).on('click','.update',function(){
      var user_id = $(this).attr("id");
      $.ajax({
        url: "user_registration_action.php",
        method: "POST",
        data:{user_id:user_id},
        dataType:"json",
        success:function(data){
          $('#user_modal').modal("show")
          $('.modal-title').html("Edit User")
          $('#user_name').val(data.user_name);
          $('#user_email').val(data.user_email);
          $('#user_mobile').val(data.user_mobile);
          $('#user_department').val(data.user_department);
          $('#user_designation').val(data.user_designation);
          $('#user_password').val(data.user_password);
          $('#user_confirm_password').val(data.user_password);
          $('#user_uploaded_image').html(data.user_image);
          $('#user_id').val(user_id);
          $('#action_hidden').val("Edit");
          $('#action_submit').val("Edit");
          $('#alert_action').fadeIn('<div class="alert alert-info">'+data+'</div>');
          dataTable.ajax.reload();
        }
      })
    });     
// Category delete Section
      $(document).on('click', '.btn_active_inactive', function(){
      var user_id = $(this).attr('id');
      var status = $(this).data("status");
      var btn_action = 'active_inactive';
      if(confirm("Are you sure you want to active this account?")){
         $.ajax({
          url:"user_control_action.php",
          method:"POST",
          data:{user_id:user_id, status:status, btn_action:btn_action},
          success:function(data){
            $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
             dataTable.ajax.reload();
          }
         })
      }
      else{
       return false;
      }
     });
  });
</script>

