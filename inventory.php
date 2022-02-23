
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
                <div class="col p-1" >Product List</div>
                <div class="col p-1" align="right">
                  <button class="btn btn-primary btn-sm launch-modal" data-toggle="modal" data-target="#ctg_bnd_pdt_modal" id="add_button"><i class="fas fa-plus-square"></i> Add Product</button>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="category_data" class="table table-bordered table-hover table-striped table-sm" >
                      <thead class="thead-dark">
                        <tr>
                          <th width="5%">ID</th>
                          <th width="65%">Category Name</th>
                          <th width="15%">Category Status</th>
                          <th width="15%">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>
            <div class="modal fade" id="ctg_bnd_pdt_modal">
              <div class="modal-dialog modal-lg">
               
                <div class="modal-content">
                  <ul class="nav nav-tabs nav-pills" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#product">Product</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#brand">Brand</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#category">Category</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                      <div id="category" class="tab-pane">
                        <form method="post" id="category_form" name="category_form" class="needs-validation" novalidate>
                            <div class="modal-header">
                              <h6 class="modal-title-category">Add Category</h6>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                  <label>Category Name</label>
                                  <input type="text" name="category_name" id="category_name" class="form-control" required="1" maxlength="50">
                                  <div id="invalid_feedback_category" class="text-danger"></div>
                                </div>
                                <div class="modal-footer">
                                <input type="hidden" name="category_id" id="category_id" >
                                <input type="hidden" name="btn_action" id="btn_action" >
                                <input type="submit" name="action" id="action" value="Save" class="btn btn-primary btn-sm mb-0">
                                <button type="button" class="btn btn-info btn-sm mb-0" class="close" data-dismiss="modal" id="close_btn_category">Close</button>
                                </div>
                            </div>
                            </form>
                        </div>
                      

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

    // button value add
    $('#add_button').click(function(){
      $('#category_form')[0].reset();
        $('#alert_action').empty();
          $('.modal-title-category').html("Add Category");
           $('#action').val('Save');
            $('#btn_action').val('Add');
    });
    // Create Section
    $(document).on('submit','#category_form',function(event){
        event.preventDefault();
         var category_name = $('#category_name').val();
        // $('#action').attr('disabled','disabled');
        var form_data = $(this).serialize();
         if(category_name != '') {
        $.ajax({
          url:"category_action.php",
          method: "POST",
          data: form_data,
          success:function(data){
            $('#category_form')[0].reset();
            $('#ctg_bnd_pdt_modal').modal('hide');
            $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
            $('#action').attr('disabled',false);
            categorydataTable.ajax.reload();
            $('#invalid_feedback_category').empty();
          }
        })
         }else {
          document.getElementById('invalid_feedback_category').innerHTML = 'Please Enter Valid Category Name.';
         }
      });
    $('#close_btn_category').click(function(){
        $('#invalid_feedback_category').empty();
    });

  var categorydataTable = $('#category_data').DataTable({
    "processing":true,
    "serverSide":true,
    "order":[],
    "ajax":{
      url:"category_fetch.php",
      type:"POST"
    },
    "columnDefs":[
      {
        "targets":[],
        "orderable":false,
      },
    ],

  });

 $(document).on('click', '.update', function(){
  var category_id = $(this).attr("id");
  var btn_action = 'fetch_single';
  $.ajax({
   url:"category_action.php",
   method:"POST",
   data:{category_id:category_id, btn_action:btn_action},
   dataType:"json",
   success:function(data)
   {
    $('#ctg_bnd_pdt_modal').modal('show');
    $('#category_name').val(data.category_name);
    $('.modal-title-category').html("<i class='fas fa-pencil-square-o'></i> Edit Category");
    $('#category_id').val(category_id);
    $('#action').val('Edit');
    $('#btn_action').val("Edit");
   }
  })
 });
  $(document).on('click', '.delete', function(){
  var category_id = $(this).attr('id');
  var status = $(this).data("status");
  var btn_action = 'delete';
  if(confirm("Are you sure you want to change status?")){
     $.ajax({
      url:"category_action.php",
      method:"POST",
      data:{category_id:category_id, status:status, btn_action:btn_action},
      success:function(data){
        $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
         categorydataTable.ajax.reload();
      }
     })
  }
  else{
   return false;
  }
 });

  });




</script>

