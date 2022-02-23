
<?php include("db_connection.php");?>
<!-- Add Dashboard Parent File -->
<?php require 'dashboard_parent_file.php';?>
<!-- Add Function File -->
<?php require 'function.php';?>
 <!-- HTML and Head Taq Section -->
<?php echo $html_and_head_section; ?>
      <!-- Body and Header Section -->
    <?php echo $body_and_header_section; ?>
      <!-- Side Navbar Section -->
    <?php echo $side_nabar_and_content_inner_section; ?>
          <!-- Page Header-->
          <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Inventory Information</h2>
            </div>
          </header>
          <!-- Dashboard Counts Section-->
          <section class="dashboard-counts no-padding-bottom">
            <div class="container-fluid">
              <!-- Alert Section -->     
              <p id="alert_action" class="mb-0"></p>     
              <!-- Table Section -->
               <div class="row border">
                <div class="col p-1" >Brand List</div>
                <div class="col p-1" align="right">
                  <button class="btn btn-primary btn-sm launch-modal" data-toggle="modal" data-target="#brand_modal" id="add_button"><i class="fas fa-plus-square"></i> Add Brand</button>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="brand_data" class="table table-bordered table-hover table-striped table-sm" >
                      <thead class="thead-dark">
                        <tr>
                          <th width="5%">ID</th>
                          <th width="30%">Category Name</th>
                          <th width="35%">Brand Name</th>
                          <th width="15%">Brand Status</th>
                          <th width="15%">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>
            <div class="modal fade" id="brand_modal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        <form method="post" id="brand_form" name="brand_form" novalidate>
                            <div class="modal-header">
                              <h6 class="modal-title"></h6>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="select_category">Select Category</label>
                                    <select class="form-control selectpicker border" name="category_id" id="category_id" data-live-search="true" data-size="8" data-live-search-style="startsWith" required='1'>
                                      <option value=''>Select Category</option>
                                      <?php echo fill_category_list ($pdo_conn);?>
                                    </select>
                                    <div id="invalid_feedback_brand_category_id" class="text-danger"></div>
                                </div>                                                              
                                <div class="form-group">
                                  <label>Brand Name</label>
                                  <input type="text" name="brand_name" id="brand_name" class="form-control" required="1" maxlength="50">
                                  <div id="invalid_feedback_brand" class="text-danger"></div>
                                </div>
                            </div>
                             <div class="modal-footer">
                              <input type="hidden" name="brand_id" id="brand_id" >
                              <input type="hidden" name="btn_action_hidden" id="btn_action_hidden" >
                              <input type="submit" name="action_submit" id="action_submit" class="btn btn-primary btn-sm mb-0">
                              <button type="button" class="btn btn-info btn-sm mb-0" class="close" data-dismiss="modal" id="close_btn_brand">Close</button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
          </section>
          <!-- end Page Side Navbar Content Inner and Page Footer Section-->
    <?php echo $end_page_sidenav_content_footer_section; ?>
    <!-- End Body and HTML TaqJavaScript Section-->
    <?php echo $end_body_html_and_java_script_section; ?>
<script>
  $(document).ready(function(){
    // category button value add
    $('#add_button').click(function(){
      $('#brand_form')[0].reset();
        $('#alert_action').empty();
          $('.modal-title').html("Add Brand");
          $('#invalid_feedback_brand').empty();
          $('#invalid_feedback_brand_category_id').empty();
           $('#action_submit').val('Save');
            $('#btn_action_hidden').val('Add');
            $("#category_id").val('').selectpicker("refresh");

    });
        // Create Section
    $(document).on('submit','#brand_form',function(event){
        event.preventDefault();
         var category_id = $('#category_id').val();
         var brand_name = $('#brand_name').val();
         if(category_id == '') {
            document.getElementById('invalid_feedback_brand_category_id').innerHTML = 'Please select category name.';
         }else if(brand_name == ''){
            document.getElementById('invalid_feedback_brand').innerHTML = 'Please enter brand name.';
            $('#invalid_feedback_brand_category_id').empty();
         }else {
          var form_data = $(this).serialize();
          $.ajax({
          url:"brand_action.php",
          method: "POST",
          data: form_data,
          success:function(data){
            $('#brand_form')[0].reset();
            $('#brand_modal').modal('hide');
            $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
            $('#action_submit').attr('disabled',false);
            brand_data_table.ajax.reload();
            $('#invalid_feedback_brand').empty();
            $('#invalid_feedback_brand_category_id').empty();
          }
        })
         }
      });
    // Category Table reload Section
          var brand_data_table = $('#brand_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
              url:"brand_fetch.php",
              type:"POST"
            },
            "columnDefs":[
              {
                "targets":[3,4],
                "orderable":false,
              },
            ],
          });
          //Update Section
      $(document).on('click','.update',function(){
        var brand_id = $(this).attr("id");
        var btn_action_hidden = 'fetch_single';
        $.ajax({
          url: 'brand_action.php',
          method: "POST",
          data:{brand_id:brand_id,btn_action_hidden:btn_action_hidden},
          dataType:"json",
          success:function(data){
            $('#brand_modal').modal('show');
            $('.modal-title').html("Edit Brand");
            $('#category_id').val(data.category_id);
            $('#brand_name').val(data.brand_name);
            $('#brand_id').val(brand_id);
            $('#action_submit').val('Edit');
            $('#btn_action_hidden').val('Edit');
            $('#alert_action').empty();
          }
        })
      });
      //Delete Action 
      $(document).on('click','.delete',function(){
        var brand_id = $(this).attr("id");
        var status = $(this).data('status');
        var btn_action_hidden = 'delete';
        if (confirm("Are you want to change the status?")) {
          $.ajax({
            url: "brand_action.php",
            method: "POST",
            data:{brand_id:brand_id,status:status,btn_action_hidden:btn_action_hidden},
            success:function(data){
              $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
              brand_data_table.ajax.reload();
            }
          })
        }
      });
  });
</script>

