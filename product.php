
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
                  <button class="btn btn-primary btn-sm launch-modal" data-toggle="modal" data-target="#product_modal" id="add_button"><i class="fas fa-plus-square"></i> Add Product</button>
                </div>
               </div>
              <div class="row bg-light border border-top-0 p-2">
                  <div class="table-responsive">
                    <table id="product_data" class="table table-bordered table-hover table-striped table-sm" >
                      <thead class="thead-dark">
                        <tr>
                          <th width="5%">ID</th>
                          <th width="20%">Category Name</th>
                          <th width="20%">Brand Name</th>
                          <th width="20%">Product Name</th>
                          <th width="15%">Product Status</th>
                          <th width="20%">Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
               </div>
            </div>
            <div class="modal fade" id="product_modal">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        <form method="post" id="product_form" name="product_form" novalidate>
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
                                    <div id="invalid_feedback_category" class="text-danger"></div>
                                </div>  
                             <div class="form-group">
                                <label>Select Brand</label>
                                <select class="form-control" name="brand_id" id="brand_id" data-size="6" required>
                                    <option value=''>Select Brand</option>
                                </select>
                                <div id="invalid_feedback_brand" class="text-danger"></div>
                            </div>                                                            
                                <div class="form-group">
                                  <label>Product Name</label>
                                  <input type="text" name="product_name" id="product_name" class="form-control" required="1" maxlength="50">
                                  <div id="invalid_feedback_product" class="text-danger"></div>
                                </div>
                            </div>
                                <div class="modal-footer">
                                <input type="hidden" name="product_id" id="product_id" >
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
    $('#add_button').click(function(){
      $('#product_form')[0].reset();
      $('.modal-title').html("Add Product");
      $('#category_id').val('').selectpicker("refresh");
      $('#action_submit').val('Save');
      $('#btn_action_hidden').val('Add');
      $('#alert_action').empty();
      $('#invalid_feedback_category').empty();
      $('#invalid_feedback_brand').empty();
      $('#invalid_feedback_product').empty();

    });
    //Retrive Data in Brand Dropdown
    $('#category_id').change(function(){
        var category_id = $('#category_id').val();
        var btn_action_hidden = 'load_brand';
        $.ajax({
            url:"product_action.php",
            method:"POST",
            data:{category_id:category_id, btn_action_hidden:btn_action_hidden},
            success:function(data){
                $('#brand_id').html(data);

            }
        });
    });
    //Create Section
        $(document).on('submit', '#product_form', function(event){
        event.preventDefault();
        var category_id = $('#category_id').val();
        var brand_id = $('#brand_id').val();
        var product_name = $('#product_name').val();
        if (category_id == '') {
          document.getElementById('invalid_feedback_category').innerHTML = 'Please Select Category Name.';
        }else if (brand_id == '') {
           document.getElementById('invalid_feedback_brand').innerHTML = 'Please Select Brand Name.';
           $('#invalid_feedback_category').empty();
        }else if(product_name == ''){
          document.getElementById('invalid_feedback_product').innerHTML = 'Please Enter Product Name.';
          $('#invalid_feedback_brand').empty();
        }
        else{
        var form_data = $(this).serialize();
        $.ajax({
            url:"product_action.php",
            method:"POST",
            data:form_data,
            success:function(data)
            {
                $('#product_form')[0].reset();
                $('#product_modal').modal('hide');
                $('#alert_action').fadeIn().html('<div class="alert alert-success">'+data+'</div>');
                $('#action_submit').attr('disabled', false);
                product_data_table.ajax.reload();
            }
        })
      }
    });
    //Fetch Data from DB
          var product_data_table = $('#product_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
              url:"product_fetch.php",
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
    $(document).on('click', '.update', function(){
        var product_id = $(this).attr("id");
        var btn_action_hidden = 'fetch_single';
        $.ajax({
            url:"product_action.php",
            method:"POST",
            data:{product_id:product_id, btn_action_hidden:btn_action_hidden},
            dataType:"json",
            success:function(data){
                $('#product_modal').modal('show');
                $('#category_id').val(data.category_id);
                $('#brand_id').val(data.brand_id);
                $('#product_name').val(data.product_name);
                $('.modal-title').html("Edit Product");
                $('#product_id').val(product_id);
                $('#action_submit').val("Edit");
                $('#btn_action_hidden').val("Edit");
            }
        })
    });
    //delete section
        $(document).on('click', '.delete', function(){
        var product_id = $(this).attr("id");
        var status = $(this).data("status");
        var btn_action_hidden = 'delete';
        if(confirm("Are you sure you want to change status?"))
        {
            $.ajax({
                url:"product_action.php",
                method:"POST",
                data:{product_id:product_id, status:status, btn_action_hidden:btn_action_hidden},
                success:function(data){
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
                    product_data_table.ajax.reload();
                }
            });
        }
        else
        {
            return false;
        }
    });
});
</script>

